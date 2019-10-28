<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PayController extends Controller
{
    public function pay($id, $userId, $amount){

	        $data = DB::table('members')
	        		->where('id', $userId)
	        		->get();
 
	    	$api = new \Instamojo\Instamojo(
	            config('services.instamojo.api_key'),
	            config('services.instamojo.auth_token'),
	            config('services.instamojo.url')
	        );
	 
		    try {
		        $response = $api->paymentRequestCreate(array(
		            "purpose" => "User Payment",
		            "amount" => $amount,
		            "buyer_name" => $data[0]->userName,
		            "send_email" => true,
		            "email" => $data[0]->email,
		            "phone" => $data[0]->mobileNo,
		            "redirect_url" => "http://127.0.0.1:8000/pay_success/".$id
		            ));

		             DB::table('payment')->where('id', $id)->update(['payment_request_id' => $response['id'], 'status' => '3']);
		             
		            header('Location: ' . $response['longurl']);
		            exit();
		    }catch (Exception $e) {
		        print('Error: ' . $e->getMessage());
		    }
	 }
 
	public function success(Request $request, $id){
	    try {
	 
	        $api = new \Instamojo\Instamojo(
	            config('services.instamojo.api_key'),
	            config('services.instamojo.auth_token'),
	            config('services.instamojo.url')
	        );
	 
	        $response = $api->paymentRequestStatus(request('payment_request_id'));
	 
	        if( !isset($response['payments'][0]['status']) ) {
	           print('payment failed');
	        } else if($response['payments'][0]['status'] != 'Credit') {
	            print('payment failed');
	        } 
	      }catch (\Exception $e) {
	         print('payment failed');
	     }

	    if($response['payments'][0]['status'] == 'Credit') {

    		DB::table('payment')->where('id', $id)->update(['payment_id' => $response['payments'][0]['payment_id'], 'status' => '2']);

           	print '<Center>Payment has been done successfully. Thank You</center>';
       	}
	  }
}
