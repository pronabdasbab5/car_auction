<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Response;
use App\Models\Notification\Notification;

class NotificationController extends BaseController
{
    public function all_notification (Request $request) {

    	$data             = [];
	    $notification     = new Notification;
	    $notificationData = $notification->all();

	    foreach ($notificationData as $key => $value) {
	            
	        $data [] = [

	            'id'    => $value['id'],
	            'title' => $value['title'],
	            'desc'  => $value['desc']
	        ];
	    }

	    return $this->sendResponse($data, "Notification Retrive Successfull");
    }
}
