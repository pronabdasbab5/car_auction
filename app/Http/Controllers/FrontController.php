<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use EloquentBuilder;
use GuzzleHttp\Client;

class FrontController extends Controller
{
    //
    public function register(Request $request)
    {
        if ($request->has('members_name') && $request->has('member_email') && $request->has('mobile_no') && $request->has('address') && $request->has('password') && $request->hasFile('address_proof') && $request->hasFile('id_proof')) {

	        $members           = new Members;
	        $row_member_mobile = $members->where('mobileNo', $request->input('mobile_no'))->count();

	        if ($row_member_mobile > 0){

	        	$data = [];
    			return $this->sendResponse($data, "You have already registered.");
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

	                    $data = [
                            "status" => "success",
                            "message" => "Account has been resgistered successfully"
			            ];
	                }
	                else{

	                	unlink(public_path("assets/address_proof/".$address_file_name));

	                    $data = [];
		    			return $this->sendResponse($data, "Something wrong while registering.");
	                }

	            } else {

	            	$data = [];
		    		return $this->sendResponse($data, "Please ! Upload Address Proof and ID Proof.");
	            }  
	        }
    	} else {

    		$data = [];
    		return $this->sendResponse($data, "Please ! Fillup the required fields.");
        }

        return view('welcome')->with('categories', $categories)->with('categoriesCount', "Account has been resgistered successfully");
    }
}
