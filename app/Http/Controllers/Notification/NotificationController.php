<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;

class NotificationController extends Controller
{
    public function showNotificationForm () {
    	return view('auth.notification.new_notification');
    }

    public function create (Request $request) {

    	$request->validate([
	        'title' => 'bail|required',
	        'desc'  => 'required',
	    ],
		[
	        'title.required' => 'The title is required',
	        'desc'           => 'The description is required'
	    ]);

	    $notification = new Notification;

	    $notification->title = ucwords(strtolower($request->input('title')));
	    $notification->desc  = $request->desc;

	    if ($notification->save())
	    	return redirect()->route('newnotification')->with('msg', 'Notification has been uploaded successfully.');
	    else
	    	return redirect()->route('newnotification')->with('msg', 'Something wrong while uploading.');
    }

    public function allNotification () {
    	$notification     = new Notification;
    	$notificationData = $notification->all();
    	return view('auth.notification.all_notification', ['notificationData' => $notificationData]);
    }

    public function showNotificationUpdateForm ($notificationId) {
    	$notification     = new Notification;
    	$notificationData = $notification->find($notificationId);
    	return view('auth.notification.update_notification', ['notificationData' => $notificationData]);
    }

    public function update (Request $request, $notificationId) {
    	$notification = new Notification;
    	$notification->where('id', $notificationId)
    				->update([
    					'title' => $request->input('title'),
    					'desc'  => $request->desc
    				]);

    	return redirect()->route('updatenotification', ['notificationId' => $notificationId])->with('msg', 'Notification has been updated');;
    }
}
