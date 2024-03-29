<?php
namespace App\Http\Controllers\Api\Authcheck;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auction\Auction;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Vehicleimages;
use App\Models\Members\Members;
use App\Models\Category\Category;
use App\Models\Bid\Bid;
use App\Http\Controllers\Api\BaseController as BaseController;
use File;
use Response;
use DB;

class AuctionController extends BaseController
{
    public function fetch_auction (Request $request) {

        if ($request->has('userId')) {

            $todayDate   = date('Y-m-d');
            $data        = [];
            $vehicle     = new Vehicle;
            $member      = new Members;
            $auction     = new Auction;
            $memberData  = $member->find($request->input('userId'));
            $auctionData = $auction->where('category_id', $memberData->category_id)
                                    ->where('end_date', '>=', $todayDate)
                                    ->where('start_date', '<=', $todayDate)
                                    ->get();

            foreach ($auctionData as $key => $value) {

                // Declare and define two dates 
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($value['end_date']);  
                  
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

                $time = "";

                if (!empty($months)) 
                    $time = $months."M, ".$days."D";

                if (!empty($days)) 
                    $time = $days."D";

                $vehicleCnt = $vehicle->where('auction_id', $value['id'])
                                    ->count();
                
                $data [] = [

                    'id'                => $value['id'],
                    'auction_group_name'=> $value['auction_group_name'],
                    'auction_end_date'  => $value['end_date'],
                    'total_vehicle'     => $vehicleCnt,
                    'time'              => $time,
                ];
            }

            return $this->sendResponse($data, "Auctions Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function deposit_buying_limit_available (Request $request) {

        if ($request->has('userId')) {

            $member      = new Members;
            $memberData  = $member->find($request->input('userId'));

            $data = [
                'deposit'         => $memberData->deposit,
                'buying_limit'    => $memberData->buyingLimit,
                'available_limit' => $memberData->availableLimit,
            ];

            return $this->sendResponse($data, "Limit Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function fetch_auction_vehicle (Request $request) {

        if ($request->has('userId')) {

            $data          = [];
            $vehicle       = new Vehicle;
            $vehicleimages = new Vehicleimages;
            $member        = new Members;
            $bid           = new Bid;
            $auction       = new Auction;
            $auctionData   = $auction->find($request->input('auction_id'));
            $vehicleData   = $vehicle->where('auction_id', $request->input('auction_id'))
                                    ->where('status', 0)
                                    ->get();

            foreach ($vehicleData as $key => $value) {

                $vehicleimagesData = $vehicleimages->where('vehicle_id', $value['id'])
                                                    ->get();
                foreach ($vehicleimagesData as $key_1 => $value_1) {

                    $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

                    $vehicle_img[] = [
                        'id' => $value_1['id'],
                        'img'=> $url
                    ];
                }

                /** Time Calculation **/
                // Declare and define two dates 
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($auctionData->end_date);  
                  
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

                $time = "";

                if (!empty($months)) 
                    $time = $months."M, ".$days."D";

                if (!empty($days)) 
                    $time = $days."D";
                /** End of Time Calculation **/

                /** User Bid Calculation **/
                $bidCnt = $bid->where('user_id', $request->input('userId'))
                                ->where('vehicle_id', $value['id'])
                                ->count();

                if($bidCnt == 0){
                    $bids           = 20;
                    $current_amount = 1000;
                    $status         = "Start bidding now !!";
                } else {

                    $bidData        = $bid->where('user_id', $request->input('userId'))
                                        ->where('vehicle_id', $value['id'])
                                        ->orderBy('id', 'DESC')
                                        ->first();
                    $current_amount = $bidData->current_bid_amount;
                    $bids           = $bidData->total_bids;

                    if($value['auction_amount'] > $bidData->total_bid_amount)
                        $status = "Lossing !!";

                    if($bidData->total_bid_amount >= $value['auction_amount'])
                        $status = "Right Bid !!";
                }
                /** End Bid Calculation **/
                
                $data [] = [

                    'time'                 => $time,
                    'status'               => $status,
                    'vehicle_id'           => $value['id'],
                    'vehicle_name'         => $value['vehicle_name'],
                    'images'               => $vehicle_img,
                    'regisation_no'        => $value['rc_registration_no'],
                    'regisation_available' => $value['rc_rc_available'],
                    'mfg_month_year'       => $value['bc_mfg_month_year'],
                    'fuel_type'            => $value['bc_fuel_type'],
                    'owner_type'           => $value['bc_owner_type'],
                    'state'                => $value['li_state'],
                    'transmission_type'    => $value['bc_transmission_type'],
                    'total_remaining_bids' => $bids,
                    'state'                => $value['li_state'],
                    'current_bid_amount'   => $current_amount,

                ];

                $vehicle_img = [];
            }

            return $this->sendResponse($data, "Vehicle Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function vehicle_image ($file_name) {

        $path = storage_path('app/vehicle_images/'.$file_name);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function bid(Request $request) {

        if ($request->has('userId')) {

            $bid     = new Bid;
            $member  = new Members;
            $vehicle = new Vehicle;
            $bidData = $bid->where('vehicle_id', $request->input('vehicle_id'))
                            ->where('user_id', $request->input('userId'))
                            ->orderBy('id', 'DESC')
                            ->first();

            if (!empty($bidData)) {

                $member->where('id', $request->input('userId'))
                        ->decrement('availableLimit', $request->input('bid_amount'));

                $bid->where('user_id', $request->input('userId'))
                        ->where('vehicle_id', $request->input('vehicle_id'))
                        ->update([
                            'current_bid_amount' => $bidData->current_bid_amount + $request->input('bid_amount'),
                            'total_bid_amount'   => $bidData->total_bid_amount + $request-> input('bid_amount'),
                            'total_bids'         => $bidData->total_bids - 1,
                            'updated_at'         => now(),
                        ]);

            } else {

                $member->where('id', $request->input('userId'))
                        ->decrement('availableLimit', $request->input('bid_amount'));

                $bid->insert([
                    'vehicle_id'         => $request->input('vehicle_id'),
                    'user_id'            => $request->input('userId'),
                    'current_bid_amount' => $request->input('bid_amount'),
                    'total_bid_amount'   => $request->input('bid_amount'),
                    'total_bids'         => 19,
                    'created_at'         => now(),
                    'updated_at'         => now()
                ]);
            }

            // $vehicleData_1 = $vehicle->find($request->input('vehicle_id'));

            // $data          = [];
            // $vehicleimages = new Vehicleimages;
            // $member        = new Members;
            // $auction       = new Auction;
            // $auctionData   = $auction->find($vehicleData_1->auction_id);
            // $vehicleData   = $vehicle->where('auction_id', $vehicleData_1->auction_id)
            //                         ->get();

            // foreach ($vehicleData as $key => $value) {

            //     $vehicleimagesData = $vehicleimages->where('vehicle_id', $value['id'])
            //                                         ->get();
            //     foreach ($vehicleimagesData as $key_1 => $value_1) {

            //         $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

            //         $vehicle_img[] = [
            //             'id' => $value_1['id'],
            //             'img'=> $url
            //         ];
            //     }

            //     /** Time Calculation **/
            //     // Declare and define two dates 
            //     $date1 = strtotime(date('Y-m-d'));  
            //     $date2 = strtotime($auctionData->end_date);  
                  
            //     // Formulate the Difference between two dates 
            //     $diff = abs($date2 - $date1);  
                  
            //     // To get the year divide the resultant date into 
            //     // total seconds in a year (365*60*60*24) 
            //     $years = floor($diff / (365*60*60*24));  
                  
            //     // To get the month, subtract it with years and 
            //     // divide the resultant date into 
            //     // total seconds in a month (30*60*60*24) 
            //     $months = floor(($diff - $years * 365*60*60*24) 
            //                                    / (30*60*60*24));  
                  
            //     // To get the day, subtract it with years and  
            //     // months and divide the resultant date into 
            //     // total seconds in a days (60*60*24) 
            //     $days = floor(($diff - $years * 365*60*60*24 -  
            //                  $months*30*60*60*24)/ (60*60*24));  

            //     $time = "";

            //     if (!empty($months)) 
            //         $time = $months."M, ".$days."D, ".$hours."H";

            //     if (!empty($days)) 
            //         $time = $days."D";
            //     * End of Time Calculation *

            //     /** User Bid Calculation **/
            //     $bidCnt = $bid->where('user_id', $request->has('userId'))
            //                     ->where('vehicle_id', $value['id'])
            //                     ->count();

            //     if($bidCnt == 0){
            //         $bids           = 20;
            //         $current_amount = 1000;
            //         $status         = "Start bidding now !!";
            //     } else {

            //         $bids           = 20 - $bidCnt;
            //         $bidData        = $bid->where('user_id', $request->has('userId'))
            //                             ->where('vehicle_id', $value['id'])
            //                             ->orderBy('id', 'DESC')
            //                             ->first();
            //         $current_amount = $bidData->current_bid_amount;

            //         if($value['auction_amount'] > $bidData->total_bid_amount)
            //             $status = "Lossing !!";

            //         if($bidData->total_bid_amount >= $value['auction_amount'])
            //             $status = "Right Bid !!";
            //     }
            //     /** End Bid Calculation **/
                
            //     $data [] = [

            //         'time'                 => $time,
            //         'status'               => $status,
            //         'vehicle_id'           => $value['id'],
            //         'vehicle_name'         => $value['vehicle_name'],
            //         'images'               => $vehicle_img,
            //         'regisation_no'        => $value['rc_registration_no'],
            //         'regisation_available' => $value['rc_rc_available'],
            //         'mfg_month_year'       => $value['bc_mfg_month_year'],
            //         'fuel_type'            => $value['bc_fuel_type'],
            //         'owner_type'           => $value['bc_owner_type'],
            //         'state'                => $value['li_state'],
            //         'transmission_type'    => $value['bc_transmission_type'],
            //         'total_remaining_bids' =>$bids,
            //         'state'                => $value['li_state'],
            //         'current_bid_amount'   => $current_amount,

            //     ];

            //     $vehicle_img = [];
            // }

            // $member->where('id', $request->input('userId'))
            //         ->decrement('buyingLimit', $request->input('bid_amount'));
            
            $data = [
                    'status' => "success"
                ];

            return $this->sendResponse($data, "Bid has benn done Successfully");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function vehicle_details (Request $request) {

        if ($request->has('userId')) {

            $data          = "";
            $vehicle       = new Vehicle;
            $vehicleimages = new Vehicleimages;
            $member        = new Members;
            $bid           = new Bid;
            $auction       = new Auction;
            $auctionData   = $auction->find($request->input('auction_id'));
            $vehicleData   = $vehicle->where('id', $request->input('vehicle_id'))
                                    ->where('auction_id', $request->input('auction_id'))
                                    ->get();

            $vehicleimagesData = $vehicleimages->where('vehicle_id', $request->input('vehicle_id'))
                                                ->get();

            foreach ($vehicleimagesData as $key_1 => $value_1) {

                $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

                $vehicle_img[] = [
                    'id' => $value_1['id'],
                    'img'=> $url
                ];
            }

            /** Time Calculation **/
            // Declare and define two dates 
            $date1 = strtotime(date('Y-m-d'));  
            $date2 = strtotime($auctionData->end_date);  
                  
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

            $time = "";

            if (!empty($months)) 
                $time = $months."M, ".$days."D";

            if (!empty($days)) 
                $time = $days."D";
            /** End of Time Calculation **/

            /** User Bid Calculation **/
            $bidCnt = $bid->where('user_id', $request->input('userId'))
                            ->where('vehicle_id', $request->input('vehicle_id'))
                            ->count();

            if($bidCnt == 0){
                $bids           = 20;
                $current_amount = 1000;
                $status         = "Start bidding now !!";
            } else {

                $bidData        = $bid->where('user_id', $request->input('userId'))
                                        ->where('vehicle_id', $request->input('vehicle_id'))
                                        ->orderBy('id', 'DESC')
                                        ->first();
                $current_amount = $bidData->current_bid_amount;
                $bids           = $bidData->total_bids;

                if($vehicleData[0]->auction_amount > $bidData->total_bid_amount)
                    $status = "Lossing !!";

                if($bidData->total_bid_amount >= $vehicleData[0]->auction_amount)
                    $status = "Right Bid !!";
            }
            /** End Bid Calculation **/

            $category     = new Category;
            $categoryData = $category->find($vehicleData[0]->li_zone);
                
            $data  = [

                'time'                       => $time,
                'status'                     => $status,
                'vehicle_id'                 => $vehicleData[0]->id,
                'auction_id'                 => $vehicleData[0]->auction_id,
                'vehicle_name'               => $vehicleData[0]->vehicle_name,
                'images'                     => $vehicle_img,
                'regisation_no'              => $vehicleData[0]->rc_registration_no,
                'regisation_available'       => $vehicleData[0]->rc_rc_available,
                'mfg_month_year'             => $vehicleData[0]->bc_mfg_month_year,
                'fuel_type'                  => $vehicleData[0]->bc_fuel_type,
                'owner_type'                 => $vehicleData[0]->bc_owner_type,
                'state'                      => $vehicleData[0]->li_state,
                'transmission_type'          => $vehicleData[0]->bc_transmission_type,
                'total_remaining_bids'       => $bids,
                'current_bid_amount'         => $current_amount,
                'bc_mfg_month_year'          => $vehicleData[0]->bc_mfg_month_year,
                'bc_color'                   => $vehicleData[0]->bc_color,
                'bc_engine_no'               => $vehicleData[0]->bc_engine_no,
                'bc_chasis_no'               => $vehicleData[0]->bc_chasis_no,
                'bc_transmission_type'       => $vehicleData[0]->bc_transmission_type,
                'bc_fuel_type'               => $vehicleData[0]->bc_fuel_type,
                'bc_owner_type'              => $vehicleData[0]->bc_owner_type,
                'bc_vehicle_type'            => $vehicleData[0]->bc_vehicle_type,
                'bc_ownership'               => $vehicleData[0]->bc_ownership,
                'rc_rc_available'            => $vehicleData[0]->rc_rc_available,
                'rc_registration_no'         => $vehicleData[0]->rc_registration_no,
                'rc_registration_date'       => $vehicleData[0]->rc_registration_date,
                'rc_reg_as'                  => $vehicleData[0]->rc_reg_as,
                'tx_road_text_expiray_date'  => $vehicleData[0]->tx_road_text_expiray_date,
                'tx_permit_type'             => $vehicleData[0]->tx_permit_type,
                'tx_permit_expiray_date'     => $vehicleData[0]->tx_permit_expiray_date,
                'tx_fitness_expiray_date'    => $vehicleData[0]->tx_fitness_expiray_date,
                'tx_road_taxt_validity'      => $vehicleData[0]->tx_road_taxt_validity,
                'hi_car_under_hypothecation' => $vehicleData[0]->hi_car_under_hypothecation,
                'hi_financer_name'           => $vehicleData[0]->hi_financer_name,
                'hi_noc_available'           => $vehicleData[0]->hi_noc_available,
                'hi_repo_date'               => $vehicleData[0]->hi_repo_date,
                'hi_loan_paid_off'           => $vehicleData[0]->hi_loan_paid_off,
                'li_zone'                    => $categoryData->category,
                'li_state'                   => $vehicleData[0]->li_state,
                'li_city'                    => $vehicleData[0]->li_city,
                'li_yard_name'               => $vehicleData[0]->li_yard_name,
                'li_yard_location'           => $vehicleData[0]->li_yard_location,
                'avi_superdari_status'       => $vehicleData[0]->avi_superdari_status,
                'avi_tax_type'               => $vehicleData[0]->avi_tax_type,
                'avi_theft_recover'          => $vehicleData[0]->avi_theft_recover,
                'avi_keys_available'         => $vehicleData[0]->avi_keys_available,
                'summary'                    => $vehicleData[0]->summary,
            ];

            return $this->sendResponse($data, "Vehicle Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function your_bid (Request $request) {

        if ($request->has('userId')) {

            $todayDate     = date('Y-m-d');
            $data          = [];
            $vehicle       = new Vehicle;
            $vehicleimages = new Vehicleimages;
            $member        = new Members;
            $bid           = new Bid;
            $vehicleData   = $bid->where('bid.user_id', $request->input('userId'))
                                    ->join('vehicle_info', 'bid.vehicle_id', '=', 'vehicle_info.id')
                                    ->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
                                    ->where('auction_group_name.end_date', '>=', $todayDate)
                                    ->where('auction_group_name.start_date', '<=', $todayDate)
                                    ->select('bid.current_bid_amount', 'bid.total_bid_amount', 'vehicle_info.*', 'auction_group_name.end_date', 'auction_group_name.start_date')
                                    ->get();

            $auction  = new Auction;
            foreach ($vehicleData as $key => $value) {

                $vehicleimagesData = $vehicleimages->where('vehicle_id', $value['id'])
                                                    ->get();
                foreach ($vehicleimagesData as $key_1 => $value_1) {

                    $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

                    $vehicle_img[] = [
                        'id' => $value_1['id'],
                        'img'=> $url
                    ];
                }

                $auctionData   = $auction->find($value['auction_id']);

                /** Time Calculation **/
                // Declare and define two dates 
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($auctionData->end_date);  
                  
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

                $time = "";

                if (!empty($months)) 
                    $time = $months."M, ".$days."D";

                if (!empty($days)) 
                    $time = $days."D";
                /** End of Time Calculation **/

                /** User Bid Calculation **/
                $bidCnt = $bid->where('user_id', $request->input('userId'))
                                ->where('vehicle_id', $value['id'])
                                ->count();

                if($bidCnt == 0){
                    $bids           = 20;
                    $current_amount = 1000;
                    $status         = "Start bidding now !!";
                } else {

                    $bidData        = $bid->where('user_id', $request->input('userId'))
                                        ->where('vehicle_id', $value['id'])
                                        ->orderBy('id', 'DESC')
                                        ->first();
                    $current_amount = $bidData->current_bid_amount;
                    $bids           = $bidData->total_bids;

                    if($value['auction_amount'] > $bidData->total_bid_amount)
                        $status = "Lossing !!";

                    if($bidData->total_bid_amount >= $value['auction_amount'])
                        $status = "Right Bid !!";
                }
                /** End Bid Calculation **/
                
                $data [] = [

                    'time'                 => $time,
                    'status'               => $status,
                    'vehicle_id'           => $value['id'],
                    'auction_id'           => $value['auction_id'],
                    'vehicle_name'         => $value['vehicle_name'],
                    'images'               => $vehicle_img,
                    'regisation_no'        => $value['rc_registration_no'],
                    'regisation_available' => $value['rc_rc_available'],
                    'mfg_month_year'       => $value['bc_mfg_month_year'],
                    'fuel_type'            => $value['bc_fuel_type'],
                    'owner_type'           => $value['bc_owner_type'],
                    'state'                => $value['li_state'],
                    'transmission_type'    => $value['bc_transmission_type'],
                    'total_remaining_bids' => $bids,
                    'state'                => $value['li_state'],
                    'current_bid_amount'   => $current_amount,

                ];

                $vehicle_img = [];
            }

            return $this->sendResponse($data, "Vehicle Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function add_wish_list (Request $request) {

        if ($request->has('userId') && $request->has('vehicleId')) {

            $row_cnt = DB::table('whish_list')
                            ->where('userId', $request->input('userId'))
                            ->where('vehicleId', $request->input('vehicleId'))
                            ->count();

            if ($row_cnt > 0) {

               $data = [
                    'status' => "success"
                ];

                return $this->sendResponse($data, "Already added in wish list");
            } else {

                DB::table('whish_list')
                        ->insert([
                            'vehicleId' => $request->input('vehicleId'),
                            'userId'    => $request->input('userId')
                        ]);

                $data = [
                    'status' => "success"
                ];

                return $this->sendResponse($data, "Vehicle added in wish list");
            }
            
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }
    
    public function remove_wish_list (Request $request) {

        if ($request->has('userId') && $request->has('vehicleId')) {

            $row_cnt = DB::table('whish_list')
                            ->where('userId', $request->input('userId'))
                            ->where('vehicleId', $request->input('vehicleId'))
                            ->delete();

            $data = [
                'status' => "success"
            ];

            return $this->sendResponse($data, "Vehicle has been deleted from wish list");
            
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function payment_request_list (Request $request) {

        if ($request->has('userId')) {

            $paymentData = DB::table('payment')
                            ->where('userId', $request->input('userId'))
                            ->where('status', 1)
                            ->orWhere('status', 3)
                            ->select('id', 'msg', 'amount')
                            ->get();

            $data = [];
            foreach ($paymentData as $key => $value) {

                $data[] = [
                    'id' => $value->id,
                    'userId' => $request->input('userId'),
                    'msg' => $value->msg,
                    'amount' => $value->amount,
                ];
            }

            return $this->sendResponse($data, "Payment notification has been recived successfully");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function wish_list (Request $request) {

        if ($request->has('userId')) {

            $data          = [];
            $vehicle       = new Vehicle;
            $vehicleimages = new Vehicleimages;
            $member        = new Members;
            $bid           = new Bid;
            $auction       = new Auction;

            $todayDate   = date('Y-m-d');
            $vehicleData   = DB::table('whish_list')->where('whish_list.userId', $request->input('userId'))
                                ->join('vehicle_info', 'whish_list.vehicleId', '=', 'vehicle_info.id')
                                ->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
                                ->where('auction_group_name.end_date', '>=', $todayDate)
                                ->where('auction_group_name.start_date', '<=', $todayDate)
                                ->select('vehicle_info.*', 'whish_list.userId', 'auction_group_name.start_date', 'auction_group_name.end_date')
                                ->get();

            foreach ($vehicleData as $key => $value) {

                $vehicleimagesData = $vehicleimages->where('vehicle_id', $value->id)
                                                    ->get();
                foreach ($vehicleimagesData as $key_1 => $value_1) {

                    $url = route('vehicle_image', ['file_name' => $value_1['img_path']]);

                    $vehicle_img[] = [
                        'id' => $value_1['id'],
                        'img'=> $url
                    ];
                }

                /** Time Calculation **/
                // Declare and define two dates 
                $date1 = strtotime(date('Y-m-d'));  
                $date2 = strtotime($value->end_date);  
                  
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

                $time = "";

                if (!empty($months)) 
                    $time = $months."M, ".$days."D";

                if (!empty($days)) 
                    $time = $days."D";
                /** End of Time Calculation **/

                /** User Bid Calculation **/
                $bidCnt = $bid->where('user_id', $request->input('userId'))
                                ->where('vehicle_id', $value->id)
                                ->count();

                if($bidCnt == 0){
                    $bids           = 20;
                    $current_amount = 1000;
                    $status         = "Start bidding now !!";
                } else {

                    $bidData        = $bid->where('user_id', $request->input('userId'))
                                        ->where('vehicle_id', $value->id)
                                        ->orderBy('id', 'DESC')
                                        ->first();
                    $current_amount = $bidData->current_bid_amount;
                    $bids           = $bidData->total_bids;

                    if($value->auction_amount > $bidData->total_bid_amount)
                        $status = "Lossing !!";

                    if($bidData->total_bid_amount >= $value->auction_amount)
                        $status = "Right Bid !!";
                }
                /** End Bid Calculation **/
                
                $data [] = [

                    'time'                 => $time,
                    'status'               => $status,
                    'vehicle_id'           => $value->id,
                    'auction_id'           => $value->auction_id,
                    'vehicle_name'         => $value->vehicle_name,
                    'images'               => $vehicle_img,
                    'regisation_no'        => $value->rc_registration_no,
                    'regisation_available' => $value->rc_rc_available,
                    'mfg_month_year'       => $value->bc_mfg_month_year,
                    'fuel_type'            => $value->bc_fuel_type,
                    'owner_type'           => $value->bc_owner_type,
                    'state'                => $value->li_state,
                    'transmission_type'    => $value->bc_transmission_type,
                    'total_remaining_bids' => $bids,
                    'state'                => $value->li_state,
                    'current_bid_amount'   => $current_amount,

                ];

                $vehicle_img = [];
            }

            return $this->sendResponse($data, "Wish List Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function member_data(Request $request) {

        if ($request->has('userId')) {

            $member      = new Members;
            $memberData  = $member->find($request->input('userId'));

            $data = [
                'userId'   => $request->input('userId'),
                'userName' => $memberData->userName,
                'email'    => $memberData->email,
                'mobileNo' => $memberData->mobileNo,
                'address'  => $memberData->address,
            ];

            return $this->sendResponse($data, "Member Info. Retrive Successfull");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }

    public function update_member_data(Request $request) {

        if ($request->has('userId') && $request->has('userName') && $request->has('email') && $request->has('address')) {

            DB::table('members')->where('id', $request->input('userId'))
                        ->update([
                            'userName' => $request->input('userName'),
                            'email' => $request->input('email'),
                            'address' => $request->input('address'),
                        ]);

            $data = [
                'status' => "success"
            ];

            return $this->sendResponse($data, "Member Info. has been updated.");
        } else {

            $data = [];
            return $this->sendResponse($data, "Please ! Fillup the required fields");
        }
    }
}
