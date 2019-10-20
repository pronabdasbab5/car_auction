<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use DB;

class NotificationComposer
{
    public function notification(View $view)
    {
        $memberData = DB::table('members')
                        ->where('isVerified', 0)
                        ->count();

        // $newBoatData = DB::table('boat')
        //                 ->where('bookingStatus', '1')
        //                 ->count();

        // $newPackageData = DB::table('package_booking')
        //                 ->where('bookingStatus', '1')
        //                 ->count();

        $view->with('newData', ['newMemberData' => $memberData]);
    }
}
?>