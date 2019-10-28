<?php

namespace App\Http\Controllers\Bid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bid\Bid;
use App\Models\Vehicle\Vehicle;
use App\Models\Auction\Auction;

class BidController extends Controller
{
    public function allRunningBids(){

        return view('auth.bid.running_bids');
    }

    public function allauctionbids($type, Request $request){

        $auction = new Auction;

        $columns = array( 
                            0 => 'id', 
                            1 => 'category',
                            2 => 'auctionGroupName',
                            3 => 'startDate',
                            4 => 'endDate',
                            5 => 'time',
                            6 => 'allVehicle',
                        );

        $totalData = $auction->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        $todayDate = date('Y-m-d');

        if(empty($request->input('search.value'))) {            
            
            $auctionData = $auction;

            if($type == 1)
                $auctionData = $auctionData->where('end_date', '>=', $todayDate)
                                        ->where('start_date', '<=', $todayDate);

            $auctionData = $auctionData                            
                            ->join('category', 'auction_group_name.category_id', '=', 'category.id')
                            ->select('auction_group_name.id', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'category.category', 'auction_group_name.status')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            $auctionData = $auction;

            if($type == 1)
                $auctionData = $auctionData->where('end_date', '>=', $todayDate)
                                        ->where('start_date', '<=', $todayDate);
            $auctionData = $auctionData 
                            ->join('category', 'auction_group_name.category_id', '=', 'category.id')
                            ->select('auction_group_name.id', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'category.category', 'auction_group_name.status')
                            ->where('auction_group_name', 'LIKE',"%{$val}%")
                            ->orWhere('start_date', 'LIKE',"%{$search}%")
                            ->orWhere('end_date', 'LIKE',"%{$search}%")
                            ->orWhere('category', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $auction;

            if($type == 1)
                $totalFiltered = $totalFiltered->where('auction_group_name.end_date', '>=', $todayDate)
                                        ->where('auction_group_name.start_date', '<=', $todayDate);

            $totalFiltered = $totalFiltered 
                            ->join('category', 'auction_group_name.category_id', '=', 'category.id')
                            ->select('auction_group_name.id', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'category.category', 'auction_group_name.status')
                            ->where('auction_group_name', 'LIKE',"%{$val}%")
                            ->orWhere('start_date', 'LIKE',"%{$search}%")
                            ->orWhere('end_date', 'LIKE',"%{$search}%")
                            ->orWhere('category', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($auctionData)) {

            $cnt = 1;

            foreach ($auctionData as $single_data) {

                // Declare and define two dates 
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($single_data->end_date);  
                  
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

                if($type != 3) {

                    $time = "";

                    if (!empty($months)) 
                        $time = $months."M, ".$days."D";

                    if (!empty($days)) 
                        $time = $days."D";
                } else {

                    $time = "Expired";
                }

                /** Start of Status **/
                if($single_data->status == 1){

                    $val    = "De-Active";
                    $status = 0;
                }
                else{

                    $val = "Active";
                    $status = 1;
                }
                /** End of Status **/

                $nestedData['id']               = "<b>".$cnt."</b>";
                $nestedData['category']         = "<b>".$single_data->category."</b>";
                $nestedData['auctionGroupName'] = "<b>".$single_data->auction_group_name."</b>";
                $nestedData['startDate']        = "<b>".$single_data->start_date."</b>";
                $nestedData['endDate']          = "<b>".$single_data->end_date."</b>";
                $nestedData['time']             = "<b>".$time."</b>";
                $nestedData['allVehicle']       = "<a href=\"".route('allauctionvehiclebids', ['auction_id' => $single_data->id])."\" class=\"btn btn-success text-bold\" target=\"_blank\">View All Vehicle</a>";

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function all_bider_list($vehicle_id) {
        $bid       = new Bid;
        $bidData   = $bid->where('bid.status', 0)
                        ->where('bid.vehicle_id', $vehicle_id)
                        ->join('members', 'bid.user_id', '=', 'members.id')
                        ->join('vehicle_info', 'bid.vehicle_id', '=', 'vehicle_info.id')
                        ->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
                        ->select('bid.*', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'vehicle_info.vehicle_name', 'vehicle_info.auction_amount', 'members.userName', 'members.email', 'members.mobileNo', 'members.address')
                        ->orderBy('bid.id', 'DESC')
                        ->get();

        return view('auth.bid.bider_list', ['bidData' => $bidData]);
    }

    public function all_auction_vehicle_bids ($auctionId) {

        $vehicle     = new Vehicle;
        $vehicleData = $vehicle->where('auction_id', $auctionId)
                                ->get();

        return view('auth.bid.auction_vehicles', ['vehicleData' => $vehicleData]);
    }

    public function allExpiredBids () {
    	$todayDate = date('Y-m-d');
    	$bid       = new Bid;
    	$bidData   = $bid->where('bid.status', 0)
    					->join('members', 'bid.user_id', '=', 'members.id')
    					->join('vehicle_info', 'bid.vehicle_id', '=', 'vehicle_info.id')
    					->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
    					->where('auction_group_name.end_date', '<', $todayDate)
    					->select('bid.*', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'vehicle_info.vehicle_name', 'vehicle_info.auction_amount', 'members.userName', 'members.email', 'members.mobileNo', 'members.address')
    					->orderBy('bid.id', 'DESC')
    					->get();

    	return view('auth.bid.expired_bids', ['bidData' => $bidData]);
    }

    public function allWinnerBids () {
    	$bid       = new Bid;
    	$bidData   = $bid->where('bid.status', 1)
    					->join('members', 'bid.user_id', '=', 'members.id')
    					->join('vehicle_info', 'bid.vehicle_id', '=', 'vehicle_info.id')
    					->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
    					->select('bid.*', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'vehicle_info.vehicle_name', 'vehicle_info.auction_amount', 'members.userName', 'members.email', 'members.mobileNo', 'members.address')
    					->orderBy('bid.id', 'DESC')
    					->get();

    	return view('auth.bid.winner_bids', ['bidData' => $bidData]);
    }

    public function allWinnerBid ($bidId, $vehicle_id) {
    	$bid = new Bid;
    	$bid->where('id', $bidId)
    		->update([
    			'status' => 1
    		]);

        $vehicle = new Vehicle;
        $vehicle->where('id', $vehicle_id)
            ->update([
                'status' => 1
            ]);

    	return redirect()->route('winner_bids');
    }
}
