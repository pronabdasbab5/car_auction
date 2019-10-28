<?php

namespace App\Http\Controllers\Auction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auction\Auction;
use App\Models\Category\Category;
use App\Models\Vehicle\Vehicle;

class AuctionController extends Controller
{
    public function create() 
    {
    	$category = new Category;
    	$data     = $category->get();

    	return view('auth.auction.new_auction', compact('data'));
    }

    public function store(Request $request)
    {
    	$request->validate([
	        'category_id'        => 'bail|required|numeric',
	        'auction_group_name' => 'required',
	        'auction_start_date' => 'required',
	        'auction_end_date'   => 'required',
	    ],
		[
	        'category_id.required' => 'The Category is required',
	        'auction_group_name'   => 'The auction group name is required',
	        'auction_start_date'   => 'The auction start date is required',
	        'auction_end_date'     => 'The auction end date is required',
	    ]);

    	$auction   = new Auction;
        $row_check = $auction->where('category_id', $request->input('category_id'))
        					->where('auction_group_name', ucwords(strtolower($request->input('auction_group_name'))))
        						->count();

        if ($row_check > 0) 
            return redirect()->route('newauction')->with('msg', 'Auction is already added.');
        else {

            $auction->category_id        = $request->input('category_id');
            $auction->auction_group_name = ucwords(strtolower($request->input('auction_group_name')));
            $auction->start_date         = $request->input('auction_start_date');
            $auction->end_date           = $request->input('auction_end_date');

            if($auction->save()) 
                return redirect()->route('newauction')->with('msg', 'Auction has been added successfully');
            else
                return redirect()->route('newauction')->with('msg', 'Something wrong while adding'); 
        }
    }

    public function all_auction($type){

        if($type == 1) 
            return view('auth.auction.running_auction');
        if($type == 2) 
            return view('auth.auction.upcomming_auction');
        if($type == 3) 
            return view('auth.auction.expired_auction');
    }

    public function all_auction_data($type, Request $request){

        $auction = new Auction;

        $columns = array( 
                            0 => 'id', 
                            1 => 'category',
                            2 => 'auctionGroupName',
                            3 => 'startDate',
                            4 => 'endDate',
                            5 => 'time',
                            6 => 'allVehicle',
                            7 => 'action',
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
            if($type == 2)
                $auctionData = $auctionData->where('start_date', '>', $todayDate);
            if($type == 3)
                $auctionData = $auctionData->where('end_date', '<', $todayDate);

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
            if($type == 2)
                $auctionData = $auctionData->where('start_date', '>', $todayDate);
            if($type == 3)
                $auctionData = $auctionData->where('end_date', '<', $todayDate);

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
            if($type == 2)
                $totalFiltered = $totalFiltered->where('auction_group_name.start_date', '>', $todayDate);
            if($type == 3)
                $totalFiltered = $totalFiltered->where('auction_group_name.end_date', '<', $todayDate);

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
                $nestedData['allVehicle']       = "<a href=\"".route('allauctionvehicle', ['auction_id' => $single_data->id])."\" class=\"btn btn-success text-bold\" target=\"_blank\">View All Vehicle</a>";
                $nestedData['action']           = "<a href=\"".route('change_status_auction', ['auction_id' => $single_data->id, 'status' => $status, 'type' => $type])."\" class=\"btn btn-primary text-bold\">$val</a>&nbsp;&nbsp;<a href=\"".route('updateauctionform', ['auction_id' => $single_data->id])."\" class=\"btn btn-warning text-bold\">Modify</a>";

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

    public function all_auction_vehicle ($auctionId) {

        $vehicle     = new Vehicle;
        $vehicleData = $vehicle->where('auction_id', $auctionId)
                                ->get();

        return view('auth.auction.auction_vehicles', ['vehicleData' => $vehicleData]);
    }

    public function change_status_auction($auction_id, $status, $type) {

        $auction = new Auction;
        $auction->where('id', $auction_id)
                                 ->update(['status' => $status, 'updated_at' => now()]);

        if ($type == 1)
            return redirect()->route('allrunningauction', ['type' => $type]);
    }

    public function updateForm($auction_id){

        $auction      = new Auction;
        $auction_data = $auction->find($auction_id);

        $category = new Category;
        $data     = $category->get();

        return view('auth.auction.edit_auction', ['auction_data' => $auction_data], compact('data'));
    }

    public function update(Request $request, $auction_id) {

        $auction = new Auction;
        $auction->where('id', $auction_id)
                ->update(['category_id' => $request->input('category_id'), 'auction_group_name' => ucwords(strtolower($request->input('auction_group_name'))), 'start_date' => $request->input('auction_start_date'), 'end_date' => $request->input('auction_end_date')]);

        return redirect()->route('updateauctionform', ['auction_id' => $auction_id])->with('msg', 'Auction has been updated successfully');
    }

    public function vehicle_details ($vehicleId) {

        $vehicle     = new Vehicle;
        $vehicleData = $vehicle->where('vehicle_info.id', $vehicleId)
                                ->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
                                ->join('category', 'auction_group_name.category_id', '=', 'category.id')
                                ->select('vehicle_info.*', 'auction_group_name.auction_group_name', 'category.category')
                                ->get();

        return view('auth.auction.vehicle_details', ['vehicleData' => $vehicleData]);
    }
}
