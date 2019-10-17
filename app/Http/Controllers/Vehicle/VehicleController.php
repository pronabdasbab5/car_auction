<?php

namespace App\Http\Controllers\Vehicle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\Vehicleimages;
use App\Models\Auction\Auction;
use DB;

class VehicleController extends Controller
{
    public function create() 
    {
    	$category = new Category;
    	$data     = $category->get();

    	return view('auth.vehicle.new_vehicle', compact('data'));
    }

    public function store(Request $request)
    {
    	$request->validate([
	        'auction_id'  			  => 'required|numeric',
            'biding_amount'           => 'required|numeric',
	        'vehicle_name' 		      => 'required',
	        'mfg_month_year' 		  => 'required',
	        'color'                   => 'required',
	        'engine_no' 			  => 'required',
	        'chasis_no' 			  => 'required',
	        'transmission_type' 	  => 'required',
	        'fuel_type' 			  => 'required',
	        'owner_type' 			  => 'required',
	        'vehicle_type' 			  => 'required',
	        'ownership' 			  => 'required',
	        'rc_available' 			  => 'required',
	        'registration_no' 		  => 'required',
	        'registration_date' 	  => 'required',
	        'reg_as' 				  => 'required',
	        'road_tax_expiry_date' 	  => 'required',
	        'permit_type' 			  => 'required',
	        'permit_expiry_date'      => 'required',
	        'fitness_expiry_date'     => 'required',
	        'road_tax_validity'       => 'required',
	        'car_under_hypothecation' => 'required',
	        'financer_name'           => 'required',
	        'noc_available'           => 'required',
	        'repo_date' 			  => 'required',
	        'load_paid_off' 		  => 'required',
	        'state' 				  => 'required',
	        'city' 					  => 'required',
	        'yard_name' 			  => 'required',
	        'yard_location' 		  => 'required',
	        'superdari_status' 		  => 'required',
	        'tax_type' 				  => 'required',
	        'theft_recover' 		  => 'required',
	        'keys_available' 		  => 'required',
	        'summary' 		          => 'required',
	    ],
		[
            'auction_id.required'        => 'The Auction is required',
            'vehicle_name.required'      => 'The Vehicle Name is required', 
            'color.required'             => 'The color is required',
            'engine_no.required'         => 'The Engine No is required',
            'chasis_no.required'         => 'The Chasis No is required',
            'transmission_type.required' => 'The Transmission Type is required',
            'fuel_type.required'         => 'The Fuel Type is required',
	    ]);

    	$vehicle        = new Vehicle;

        $vehicle->auction_id                 = $request->input('auction_id');
        $vehicle->auction_amount             = $request->input('biding_amount');
        $vehicle->vehicle_name               = ucwords(strtolower($request->input('vehicle_name')));
        $vehicle->bc_mfg_month_year          = $request->input('mfg_month_year');
        $vehicle->bc_color                   = $request->input('color');
        $vehicle->bc_engine_no               = $request->input('engine_no');
        $vehicle->bc_chasis_no	             = $request->input('chasis_no');
        $vehicle->bc_transmission_type	     = $request->input('transmission_type');
        $vehicle->bc_fuel_type               = $request->input('fuel_type');
        $vehicle->bc_owner_type              = $request->input('owner_type');
        $vehicle->bc_vehicle_type            = $request->input('vehicle_type');
        $vehicle->bc_ownership               = $request->input('ownership');
        $vehicle->rc_rc_available            = $request->input('rc_available');
        $vehicle->rc_registration_no         = $request->input('registration_no');
        $vehicle->rc_registration_date       = $request->input('registration_date');
        $vehicle->rc_reg_as                  = $request->input('reg_as');
        $vehicle->tx_road_text_expiray_date  = $request->input('road_tax_expiry_date');
        $vehicle->tx_permit_type             = $request->input('permit_type');
        $vehicle->tx_permit_expiray_date     = $request->input('permit_expiry_date');
        $vehicle->tx_fitness_expiray_date    = $request->input('fitness_expiry_date');
        $vehicle->tx_road_taxt_validity      = $request->input('road_tax_validity');
        $vehicle->hi_car_under_hypothecation = $request->input('car_under_hypothecation');
        $vehicle->hi_financer_name           = $request->input('financer_name');
        $vehicle->hi_noc_available           = $request->input('noc_available');
        $vehicle->hi_repo_date               = $request->input('repo_date');
        $vehicle->hi_loan_paid_off           = $request->input('load_paid_off');
        $vehicle->li_zone                    = $request->input('category_id');
        $vehicle->li_state                   = $request->input('state');
        $vehicle->li_city                    = $request->input('city');
        $vehicle->li_yard_name               = $request->input('yard_name');
        $vehicle->li_yard_location           = $request->input('yard_location');
        $vehicle->avi_superdari_status       = $request->input('superdari_status');
        $vehicle->avi_tax_type               = $request->input('tax_type');
        $vehicle->avi_theft_recover          = $request->input('theft_recover');
        $vehicle->avi_keys_available         = $request->input('keys_available');
        $vehicle->summary                    = $request->summary;

        if($vehicle->save()) {

            if($request->hasFile('vehicle_images')) {

                $i = 0;

                foreach($request->file('vehicle_images') as $file) {

                    $image     = $file;
                    $file_name = time().$i.".jpg";

                    $file->storeAs('vehicle_images', $file_name);

                    $i++;
                            
                    $data['vehicle_id'] = $vehicle->id;
                    $data['img_path']   = $file_name;
                    $data['created_at'] = now();
                    $data['updated_at'] = now();

                    DB::table('vehicle_images')->insert($data);
                }
            }

            return redirect()->route('newvehicle')->with('msg', 'Vehicle has been added successfully');
        }
        else
            return redirect()->route('newvehicle')->with('msg', 'Something wrong while adding'); 
    }

    public function all_vehicle(Request $request) {

        $vehicle     = new Vehicle;
        $vehicleData = $vehicle
                            ->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
                            ->join('category', 'auction_group_name.category_id', '=', 'category.id')
                            ->select('vehicle_info.*', 'auction_group_name.auction_group_name', 'category.category')
                            ->orderBy('vehicle_info.id', 'DESC')
                            ->get();

        return view('auth.vehicle.all_vehicle', ['vehicleData' => $vehicleData]);
    }

    public function update_form ($vehicle_id) {

        $vehicle     = new Vehicle;
        $auction     = new Auction;
        $vehicleData = $vehicle->where('vehicle_info.id', $vehicle_id)
                                ->join('auction_group_name', 'vehicle_info.auction_id', '=', 'auction_group_name.id')
                                ->join('category', 'auction_group_name.category_id', '=', 'category.id')
                                ->select('vehicle_info.*')
                                ->get();
        $auctionData = $auction->all();

        return view('auth.vehicle.vehicle_update_form', ['vehicleData' => $vehicleData, 'auctionData' => $auctionData]);
    }

    public function update(Request $request, $vehicleId)
    {
        $request->validate([
            'auction_id'              => 'required|numeric',
            'biding_amount'           => 'required|numeric',
            'vehicle_name'            => 'required',
            'mfg_month_year'          => 'required',
            'color'                   => 'required',
            'engine_no'               => 'required',
            'chasis_no'               => 'required',
            'transmission_type'       => 'required',
            'fuel_type'               => 'required',
            'owner_type'              => 'required',
            'vehicle_type'            => 'required',
            'ownership'               => 'required',
            'rc_available'            => 'required',
            'registration_no'         => 'required',
            'registration_date'       => 'required',
            'reg_as'                  => 'required',
            'road_tax_expiry_date'    => 'required',
            'permit_type'             => 'required',
            'permit_expiry_date'      => 'required',
            'fitness_expiry_date'     => 'required',
            'road_tax_validity'       => 'required',
            'car_under_hypothecation' => 'required',
            'financer_name'           => 'required',
            'noc_available'           => 'required',
            'repo_date'               => 'required',
            'load_paid_off'           => 'required',
            'state'                   => 'required',
            'city'                    => 'required',
            'yard_name'               => 'required',
            'yard_location'           => 'required',
            'superdari_status'        => 'required',
            'tax_type'                => 'required',
            'theft_recover'           => 'required',
            'keys_available'          => 'required',
            'summary'                 => 'required',
        ],
        [
            'auction_id.required'        => 'The Auction is required',
            'vehicle_name.required'      => 'The Vehicle Name is required', 
            'color.required'             => 'The color is required',
            'engine_no.required'         => 'The Engine No is required',
            'chasis_no.required'         => 'The Chasis No is required',
            'transmission_type.required' => 'The Transmission Type is required',
            'fuel_type.required'         => 'The Fuel Type is required',
        ]);

        $vehicle = new Vehicle;

        $vehicle->where('id', $vehicleId)
                ->update([
                    'auction_id'                 => $request->input('auction_id'),
                    'auction_amount'             => $request->input('biding_amount'),
                    'vehicle_name'               => ucwords(strtolower($request->input('vehicle_name'))),
                    'bc_mfg_month_year'          => $request->input('mfg_month_year'),
                    'bc_color'                   => $request->input('color'),
                    'bc_engine_no'               => $request->input('engine_no'),
                    'bc_chasis_no'               => $request->input('chasis_no'),
                    'bc_transmission_type'       => $request->input('transmission_type'),
                    'bc_fuel_type'               => $request->input('fuel_type'),
                    'bc_owner_type'              => $request->input('owner_type'),
                    'bc_vehicle_type'            => $request->input('vehicle_type'),
                    'bc_ownership'               => $request->input('ownership'),
                    'rc_rc_available'            => $request->input('rc_available'),
                    'rc_registration_no'         => $request->input('registration_no'),
                    'rc_registration_date'       => $request->input('registration_date'),
                    'rc_reg_as'                  => $request->input('reg_as'),
                    'tx_road_text_expiray_date'  => $request->input('road_tax_expiry_date'),
                    'tx_permit_type'             => $request->input('permit_type'),
                    'tx_permit_expiray_date'     => $request->input('permit_expiry_date'),
                    'tx_fitness_expiray_date'    => $request->input('fitness_expiry_date'),
                    'tx_road_taxt_validity'      => $request->input('road_tax_validity'),
                    'hi_car_under_hypothecation' => $request->input('car_under_hypothecation'),
                    'hi_financer_name'           => $request->input('financer_name'),
                    'hi_noc_available'           => $request->input('noc_available'),
                    'hi_repo_date'               => $request->input('repo_date'),
                    'hi_loan_paid_off'           => $request->input('load_paid_off'),
                    'li_state'                   => $request->input('state'),
                    'li_city'                    => $request->input('city'),
                    'li_yard_name'               => $request->input('yard_name'),
                    'li_yard_location'           => $request->input('yard_location'),
                    'avi_superdari_status'       => $request->input('superdari_status'),
                    'avi_tax_type'               => $request->input('tax_type'),
                    'avi_theft_recover'          => $request->input('theft_recover'),
                    'avi_keys_available'         => $request->input('keys_available'),
                    'summary'                    => $request->summary
                ]);

        if($request->hasFile('vehicle_images')) {

            /** Deleting Images **/
            $vehicle_images     = new Vehicleimages;
            $vehicle_imagesData = $vehicle_images->where('vehicle_id', $vehicleId)
                                                    ->get();

            foreach ($vehicle_imagesData as $key => $value)
                unlink(storage_path()."\app\\vehicle_images\\".$value['img_path']);

            $vehicle_images->where('vehicle_id', $vehicleId)
                            ->delete();
            /** End of Deleting Images **/

            $i = 0;
            foreach($request->file('vehicle_images') as $file) {

                $image     = $file;
                $file_name = time().$i.".jpg";

                $file->storeAs('vehicle_images', $file_name);

                $i++;
                            
                $data['vehicle_id'] = $vehicleId;
                $data['img_path']   = $file_name;
                $data['created_at'] = now();
                $data['updated_at'] = now();

                DB::table('vehicle_images')->insert($data);
            }
        }

        return redirect()->route('updatevehicleform', ['vehicle_id' => $vehicleId])->with('msg', 'Vehicle has been updated successfully'); 
    }
}
