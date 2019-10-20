<?php

namespace App\Http\Controllers\Bid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bid\Bid;
use App\Models\Vehicle\Vehicle;

class BidController extends Controller
{
    public function allRunningBids () {
    	$todayDate = date('Y-m-d');
    	$bid       = new Bid;
    	$bidData   = $bid->where('bid.status', 0)
    					->join('members', 'bid.user_id', '=', 'members.id')
    					->join('vehicle_info', 'bid.vehicle_id', '=', 'vehicle_info.id')
    					->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
    					->where('auction_group_name.end_date', '>=', $todayDate)
                        ->where('auction_group_name.start_date', '<=', $todayDate)
    					->select('bid.*', 'auction_group_name.auction_group_name', 'auction_group_name.start_date', 'auction_group_name.end_date', 'vehicle_info.vehicle_name', 'vehicle_info.auction_amount', 'members.userName', 'members.email', 'members.mobileNo', 'members.address')
    					->orderBy('bid.id', 'DESC')
    					->get();

    	return view('auth.bid.running_bids', ['bidData' => $bidData]);
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

    public function allWinnerBid ($bidId) {
    	$bid = new Bid;
    	$bid->where('id', $bidId)
    		->update([
    			'status' => 1
    		]);

    	return redirect()->route('winner_bids');
    }
}
