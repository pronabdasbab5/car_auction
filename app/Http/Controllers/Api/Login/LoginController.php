<?php

namespace App\Http\Controllers\Api\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Members\Members;
use App\Models\Apikey\Apikey;
use File;
use Response;

class LoginController extends BaseController
{
	public function user_login(Request $request) {

		if (!empty($request->input('user_name')) && !empty($request->input('password'))) {
				
			$members = new Members;

			if (auth()->guard('member')->attempt(['mobileNo' => $request->input('user_name'), 'password' => $request->input('password')], $request->get('remember'))) {

				$members_data = $members->where('mobileNo', $request->input('user_name'))
										->where('isVerified', 1)
										->where('status', 1)
										->get();
				
				$api_key       = new Apikey;
				$api_key_count = $api_key->where('userId', $members_data[0]['id'])
										->count();

				if ($api_key_count > 0) {

					$api_token = uniqid('api');
										
					$api_key->where('userId', $members_data[0]['id'])
							->update(['api_token' => $api_token]);

					$data = [
						'user_id'  => $members_data[0]['id'],
						'api_token'=> $api_token,
						'name'     => $members_data[0]['userName'],
						'email'    => $members_data[0]['email'],
						'mobile'   => $members_data[0]['mobileNo'],
					];

					return $this->sendResponse($data, "Login Successfull");
				}
				else {

					$api_token = uniqid('api');

					$api_key->userId    = $members_data[0]['id'];
					$api_key->api_token = $api_token;
										
					if ($api_key->save()) {

						$data = [
							'user_id'  => $members_data[0]['id'],
							'api_token'=> $api_token,
							'name'     => $members_data[0]['userName'],
							'email'    => $members_data[0]['email'],
							'mobile'   => $members_data[0]['mobileNo'],
						];

						return $this->sendResponse($data, "Login Successfull");
					}
					else{
						$data = [];
						return $this->sendResponse($data, "Something wrong while Login");
					}
				}
			} else {
				$data = [];
				return $this->sendResponse($data, "Username or Password incorrect");
			}
		}
		else{

			$data = [];
			return $this->sendResponse($data, "Username or Password are required");
		} 	
	}
}
