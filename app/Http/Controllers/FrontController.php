<?php

namespace App\Http\Controllers;

use App\Models\Vehicle\Vehicleimages;
use App\Models\Members\Members;
use App\Models\Category\Category;
use App\Models\Bid\Bid;
use App\Models\Auction\Auction;
use App\Models\Vehicle\Vehicle;
use App\Models\Apikey\Apikey;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Controllers\Api\BaseController as BaseController;

use Illuminate\Http\Request;

use Redirect;
use EloquentBuilder;
use File;
use DateTime;
use Hash;

class FrontController extends BaseController
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
			//dd($memberData);
    		$auctionData = $auction->where('category_id', $memberData->category_id)
                                    ->where('end_date', '>=', $todayDate)
                                    ->where('start_date', '<=', $todayDate)
                                    ->get();
			//dd($auctionData);
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
			return view('user.home')->with('data', $data)->with('memberData', $memberData);
	    } else {

    		return view('user.login')->with('message', "Please ! Fillup the required fields");
    	}
	}
	
	public function fetch_auction_vehicle (Request $request) {
		//dd($request->id);

            $data          = [];
            $vehicle       = new Vehicle;
            $vehicleimages = new Vehicleimages;
            $member        = new Members;
            $bid           = new Bid;
            $auction       = new Auction;
            $auctionData   = $auction->find($request->id);
            $vehicleData   = $vehicle->where('auction_id', $request->id)
                                    ->get();

            foreach ($vehicleData as $key => $value) {

                $vehicleimagesData = $vehicleimages->where('vehicle_id', $value['id'])
                                                    ->get();
                foreach ($vehicleimagesData as $key_1 => $value_1) {

                    $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

                    $vehicle_img[] = [
                        'id' => $value_1['id'],
                        'img'=> $url
                    ];
                }
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($auctionData->end_date);  
                $diff = abs($date2 - $date1);  
                $years = floor($diff / (365*60*60*24));   
                $months = floor(($diff - $years * 365*60*60*24) 
                                               / (30*60*60*24));  
                  
                $days = floor(($diff - $years * 365*60*60*24 -  
                             $months*30*60*60*24)/ (60*60*24));  

                $time = "";

                if (!empty($months)) 
                    $time = $months."M, ".$days."D, ".$hours."H";

                if (!empty($days)) 
                    $time = $days."D";

                $bidCnt = $bid->where('user_id', $request->session()->get('user_id'))
                                ->where('vehicle_id', $value['id'])
                                ->count();

                if($bidCnt == 0){
                    $bids           = 20;
                    $current_amount = 1000;
                    $status         = "Start bidding now !!";
                } else {

                    $bids           = 20 - $bidCnt;
                    $bidData        = $bid->where('user_id', $request->session()->get('user_id'))
                                        ->where('vehicle_id', $value['id'])
                                        ->orderBy('id', 'DESC')
                                        ->first();
                    $current_amount = $bidData->current_bid_amount;

                    if($value['auction_amount'] > $bidData->total_bid_amount)
                        $status = "Lossing !!";

                    if($bidData->total_bid_amount >= $value['auction_amount'])
                        $status = "Right Bid !!";
                }
                /** End Bid Calculation **/
                
                $data [] = [

                    'time'                 => $time,
                    'status'               => $status,
                    'vehicle_id'           => $value['id'],
                    'vehicle_name'         => $value['vehicle_name'],
                    'images'               => $vehicle_img,
                    'regisation_no'        => $value['rc_registration_no'],
                    'regisation_available' => $value['rc_rc_available'],
                    'mfg_month_year'       => $value['bc_mfg_month_year'],
                    'fuel_type'            => $value['bc_fuel_type'],
                    'owner_type'           => $value['bc_owner_type'],
                    'state'                => $value['li_state'],
                    'transmission_type'    => $value['bc_transmission_type'],
                    'total_remaining_bids' => $bids,
                    'state'                => $value['li_state'],
                    'current_bid_amount'   => $current_amount,

                ];

                $vehicle_img = [];
            }

            return $this->sendResponse($data, "Vehicle Retrive Successfull");
	}
	
	public function vehicle_details (Request $request) {

        if ($request->has('userId')) {

            $data          = "";
            $vehicle       = new Vehicle;
            $vehicleimages = new Vehicleimages;
            $member        = new Members;
            $bid           = new Bid;
            $auction       = new Auction;
            $auctionData   = $auction->find($request->input('auction_id'));
            $vehicleData   = $vehicle->where('id', $request->input('vehicle_id'))
                                    ->where('auction_id', $request->input('auction_id'))
                                    ->get();

            $vehicleimagesData = $vehicleimages->where('vehicle_id', $request->input('vehicle_id'))
                                                ->get();

            foreach ($vehicleimagesData as $key_1 => $value_1) {

                $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

                $vehicle_img[] = [
                    'id' => $value_1['id'],
                    'img'=> $url
                ];
            }

            /** Time Calculation **/
            // Declare and define two dates 
            $date1 = strtotime(date('Y-m-d'));  
            $date2 = strtotime($auctionData->end_date);  
                  
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
            /** End of Time Calculation **/

            /** User Bid Calculation **/
            $bidCnt = $bid->where('user_id', $request->input('userId'))
                            ->where('vehicle_id', $request->input('vehicle_id'))
                            ->count();

            if($bidCnt == 0){
                $bids           = 20;
                $current_amount = 1000;
                $status         = "Start bidding now !!";
            } else {

                $bids           = 20 - $bidCnt;
                $bidData        = $bid->where('user_id', $request->input('userId'))
                                        ->where('vehicle_id', $request->input('vehicle_id'))
                                        ->orderBy('id', 'DESC')
                                        ->first();
                $current_amount = $bidData->current_bid_amount;

                if($vehicleData[0]->auction_amount > $bidData->total_bid_amount)
                    $status = "Lossing !!";

                if($bidData->total_bid_amount >= $vehicleData[0]->auction_amount)
                    $status = "Right Bid !!";
            }
            /** End Bid Calculation **/

            $category     = new Category;
            $categoryData = $category->find($vehicleData[0]->li_zone);
                
            $data  = [

                'time'                       => $time,
                'status'                     => $status,
                'vehicle_id'                 => $vehicleData[0]->id,
                'vehicle_name'               => $vehicleData[0]->vehicle_name,
                'images'                     => $vehicle_img,
                'regisation_no'              => $vehicleData[0]->rc_registration_no,
                'regisation_available'       => $vehicleData[0]->rc_rc_available,
                'mfg_month_year'             => $vehicleData[0]->bc_mfg_month_year,
                'fuel_type'                  => $vehicleData[0]->bc_fuel_type,
                'owner_type'                 => $vehicleData[0]->bc_owner_type,
                'state'                      => $vehicleData[0]->li_state,
                'transmission_type'          => $vehicleData[0]->bc_transmission_type,
                'total_remaining_bids'       => $bids,
                'current_bid_amount'         => $current_amount,
                'bc_mfg_month_year'          => $vehicleData[0]->bc_mfg_month_year,
                'bc_color'                   => $vehicleData[0]->bc_color,
                'bc_engine_no'               => $vehicleData[0]->bc_engine_no,
                'bc_chasis_no'               => $vehicleData[0]->bc_chasis_no,
                'bc_transmission_type'       => $vehicleData[0]->bc_transmission_type,
                'bc_fuel_type'               => $vehicleData[0]->bc_fuel_type,
                'bc_owner_type'              => $vehicleData[0]->bc_owner_type,
                'bc_vehicle_type'            => $vehicleData[0]->bc_vehicle_type,
                'bc_ownership'               => $vehicleData[0]->bc_ownership,
                'rc_rc_available'            => $vehicleData[0]->rc_rc_available,
                'rc_registration_no'         => $vehicleData[0]->rc_registration_no,
                'rc_registration_date'       => $vehicleData[0]->rc_registration_date,
                'rc_reg_as'                  => $vehicleData[0]->rc_reg_as,
                'tx_road_text_expiray_date'  => $vehicleData[0]->tx_road_text_expiray_date,
                'tx_permit_type'             => $vehicleData[0]->tx_permit_type,
                'tx_permit_expiray_date'     => $vehicleData[0]->tx_permit_expiray_date,
                'tx_fitness_expiray_date'    => $vehicleData[0]->tx_fitness_expiray_date,
                'tx_road_taxt_validity'      => $vehicleData[0]->tx_road_taxt_validity,
                'hi_car_under_hypothecation' => $vehicleData[0]->hi_car_under_hypothecation,
                'hi_financer_name'           => $vehicleData[0]->hi_financer_name,
                'hi_noc_available'           => $vehicleData[0]->hi_noc_available,
                'hi_repo_date'               => $vehicleData[0]->hi_repo_date,
                'hi_loan_paid_off'           => $vehicleData[0]->hi_loan_paid_off,
                'li_zone'                    => $categoryData->category,
                'li_state'                   => $vehicleData[0]->li_state,
                'li_city'                    => $vehicleData[0]->li_city,
                'li_yard_name'               => $vehicleData[0]->li_yard_name,
                'li_yard_location'           => $vehicleData[0]->li_yard_location,
                'avi_superdari_status'       => $vehicleData[0]->avi_superdari_status,
                'avi_tax_type'               => $vehicleData[0]->avi_tax_type,
                'avi_theft_recover'          => $vehicleData[0]->avi_theft_recover,
                'avi_keys_available'         => $vehicleData[0]->avi_keys_available,
                'summary'                    => $vehicleData[0]->summary,
            ];

            return $this->sendResponse($data, "Vehicle Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
		}
	}
}
