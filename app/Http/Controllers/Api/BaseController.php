<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function sendResponse($data, $message) {

        if (count($data) > 0) {
            $response = [
                'code'    => 200,
                'status'  => true,
                'data'    => $data,
                'message' => $message,
            ];
        }
        else {

            $response = [
                'code'    => 200,
                'status'  => true,
                'data'    => $data,
                'message' => $message,
            ];
        }

    	return response()->json($response, 200);
    }

    public function sendResponseAdd($data, $message) {
        
        $response = [
            'code'    => 200,
            'status'  => true,
            'data'    => $data,
            'message' => $message,
        ];
        
        return response()->json($response, 200);
    }

    public function sendResponsePage($data, $message, $page) {

        $products = new Products;

        if (count($data) > 0) {
            $response = [
                'code'      => 200,
                'status'    => true,
                'total_page'=> $page,
                'data'      => $data,
                'message'   => $message,
            ];
        }
        else {

            $response = [
                'code'      => 200,
                'status'    => false,
                'total_page'=> $page,
                'data'      => $data,
                'message'   => $message,
            ];
        }

        return response()->json($response, 200);
    }

    public function errorResponse($error, $errorMessage = [], $code = 404) {

    	$response = [
    		'code'    => 200,
    		'message' => $error,
            'data'    => null
    	];

    	return response()->json($response, $code);
    }
}
