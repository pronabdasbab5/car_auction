<?php

namespace App\Http\Controllers;
use App\Models\Members\Members;
use App\Models\Apikey\Apikey;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

use Redirect;
use EloquentBuilder;
use File;
use DateTime;
use Hash;

class FrontController extends Controller
{
    //
    public function register(Request $request)
    {
        
	        $members           = new Members;
	        $row_member_mobile = $members->where('mobileNo', $request->input('mobile_no'))->count();
			//dd($request);
	        if ($row_member_mobile > 0){
				return view('user.register')->with('message', "You have already registered.");
	        } else {

	        	if($request->hasFile('address_proof') && $request->hasFile('id_proof')) {

	                /** Start of Address Proof Uploading **/
	                $image             = $request->file('address_proof');
	                $address_file_name = time().".jpg";

	                $image_resize = Image::make($image->getRealPath());              
	                $image_resize->resize(450, 300);

	                if(!File::exists(public_path()."/assets"))
	                    File::makeDirectory(public_path()."/assets");

	                if(!File::exists(public_path()."/assets/address_proof")){

	                    File::makeDirectory(public_path()."/assets/address_proof");
	                    File::makeDirectory(public_path()."/assets/id_proof");
	                }

	                $image_resize->save(public_path("assets/address_proof/".$address_file_name));
	                /** End of Address Proof Uploading **/

	               /** Start of ID Proof Uploading **/
	                $image        = $request->file('id_proof');
	                $id_file_name = (time()+1).".jpg";

	                $image_resize = Image::make($image->getRealPath());              
	                $image_resize->resize(450, 300);

	                $image_resize->save(public_path("assets/id_proof/".$id_file_name));
	                /** End of ID Proof Uploading **/

	                $members->userName     = ucwords(strtolower($request->input('members_name')));
	                $members->email        = $request->input('member_email');
	                $members->mobileNo     = $request->input('mobile_no');
	                $members->address      = ucwords(strtolower($request->input('address')));
	                $members->password     = Hash::make($request->input('password'));
	                $members->addressProof = $address_file_name;
	                $members->idProof      = $id_file_name;

	                if($members->save()) {
						//dd($members);
						return view('user.login')->with('message', "Account has been resgistered successfully");
	                }
	                else{

	                	unlink(public_path("assets/address_proof/".$address_file_name));

	                    return view('user.register')->with('message', "Something wrong while registering.");
	                }

	            } else {

	            	return view('user.register')->with('message', "Please ! Upload Address Proof and ID Proof.");
	            }  
	        }
	}
	
	public function login(Request $request) {

		if (!empty($request->input('user_name')) && !empty($request->input('password'))) {
				
			$members = new Members;

			if (auth()->guard('member')->attempt(['mobileNo' => $request->input('user_name'), 'password' => $request->input('password')], $request->get('remember'))) {

				$members_data = $members->where('mobileNo', $request->input('user_name'))
										->where('status', 1)
										->get();
				
				$api_key       = new Apikey;
				$api_key_count = $api_key->where('userId', $members_data[0]['id'])
										->count();

				if ($api_key_count > 0) {

					$api_token = uniqid('api');
										
					$api_key->where('userId', $members_data[0]['id'])
							->update(['api_token' => $api_token]);

					$request->session()->put('user_id', $members_data[0]['id']);
					$request->session()->put('api_token', $api_token);
					return redirect()->route('home');
				}
				else {

					$api_token = uniqid('api');

					if ($api_key->save()) {
						$request->session()->put('user_id', $members_data[0]['id']);
						$request->session()->put('api_token', $api_token);
						return redirect()->route('home');
					}
					else{
						return view('user.login')->with('message', "Something wrong while Login");
					}
				}
			} else {
				return view('user.login')->with('message', "Username or Password incorrect");
			}
		}
		else{

			return view('user.login')->with('message', "Username or Password are required");
		} 	
	}

	public function home (Request $request) {

		//dd($request->session()->get('user_id'));
    	if ($request->session()->get('user_id')) {

	        $todayDate   = date('Y-m-d');
            $data        = [];
	        $vehicle     = new Vehicle;
            $member      = new Members;
    		$auction     = new Auction;
            $memberData  = $member->find($request->session()->get('user_id'));
    		$auctionData = $auction->where('category_id', $memberData->category_id)
                                    ->where('end_date', '>=', $todayDate)
                                    ->where('start_date', '<=', $todayDate)
                                    ->get();

	        foreach ($auctionData as $key => $value) {

	        	// Declare and define two dates 
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($value['end_date']);  
                  
                // Formulate the Difference between two dates 
                $diff = abs($date2 - $date1);  
                  
                // To get the year divide the resultant date into 
                // total seconds in a year (365*60*60*24) 
                $years = floor($diff / (365*60*60*24));  
                  
                // To get the month, subtract it with years and 
                // divide the resultant date into 
                // total seconds in a month (30*60*60*24) 
                $months = floor(($diff - $years * 365*60*60*24) 
                                               / (30*60*60*24));  
                  
                // To get the day, subtract it with years and  
                // months and divide the resultant date into 
                // total seconds in a days (60*60*24) 
                $days = floor(($diff - $years * 365*60*60*24 -  
                             $months*30*60*60*24)/ (60*60*24));  

                $time = "";

                if (!empty($months)) 
                    $time = $months."M, ".$days."D, ".$hours."H";

                if (!empty($days)) 
                    $time = $days."D";

	        	$vehicleCnt = $vehicle->where('auction_id', $value['id'])
	        						->count();
	            
	            $data [] = [

	                'id'                => $value['id'],
	                'auction_group_name'=> $value['auction_group_name'],
	                'total_vehicle'     => $vehicleCnt,
	                'time'              => $time,
	            ];
	        }

	        return $this->sendResponse($data, "Auctions Retrive Successfull");
	    } else {

    		$data = [];
    		return $this->sendResponse($data, "Please ! Fillup the required fields");
    	}
    }
}
