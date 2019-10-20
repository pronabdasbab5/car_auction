@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
    	<div class="col-md-1 col-sm-1 col-xs-12">
        </div>
      <div class="col-md-10 col-sm-10 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>Vehicles Details</h4>
            <a href="{{ route('newauction') }}" style="float: right; font-weight: bolder; font-size: 18px;">New Auction</a>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Fields</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                        	<th scope="row">Zone</th>
                        	<td>{{ $vehicleData[0]->category }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Auction Group Name</th>
                        	<td>{{ $vehicleData[0]->auction_group_name }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Auction Amount</th>
                        	<td>{{ $vehicleData[0]->auction_amount }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Vehicle Name</th>
                        	<td>{{ $vehicleData[0]->vehicle_name }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Mfg. Month Year</th>
                        	<td>{{ $vehicleData[0]->bc_mfg_month_year }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Color</th>
                        	<td>{{ $vehicleData[0]->bc_color }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Engine No</th>
                        	<td>{{ $vehicleData[0]->bc_engine_no }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Chasis No</th>
                        	<td>{{ $vehicleData[0]->bc_chasis_no }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Transmission Type</th>
                        	<td>{{ $vehicleData[0]->bc_transmission_type }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Fuel Type</th>
                        	<td>{{ $vehicleData[0]->bc_fuel_type }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Owner Type</th>
                        	<td>{{ $vehicleData[0]->bc_owner_type }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Vehicle Type</th>
                        	<td>{{ $vehicleData[0]->bc_vehicle_type }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Ownership</th>
                        	<td>{{ $vehicleData[0]->bc_ownership }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Rc Available</th>
                        	<td>{{ $vehicleData[0]->rc_rc_available }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Registration No</th>
                        	<td>{{ $vehicleData[0]->rc_registration_no }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Registration Date</th>
                        	<td>{{ $vehicleData[0]->rc_registration_date }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Registration As</th>
                        	<td>{{ $vehicleData[0]->rc_reg_as }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Road Text Expiray Date</th>
                        	<td>{{ $vehicleData[0]->tx_road_text_expiray_date }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Permit Type</th>
                        	<td>{{ $vehicleData[0]->tx_permit_type }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Permit Expiray Date</th>
                        	<td>{{ $vehicleData[0]->tx_permit_expiray_date }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Fitness Expiray Date</th>
                        	<td>{{ $vehicleData[0]->tx_fitness_expiray_date }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Road Text Validity</th>
                        	<td>{{ $vehicleData[0]->tx_road_taxt_validity }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Car Under Hypothecation </th>
                        	<td>{{ $vehicleData[0]->hi_car_under_hypothecation }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Financer Name</th>
                        	<td>{{ $vehicleData[0]->hi_financer_name }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Noc Available </th>
                        	<td>{{ $vehicleData[0]->hi_noc_available }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Repo Date</th>
                        	<td>{{ $vehicleData[0]->hi_repo_date }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Noc Available </th>
                        	<td>{{ $vehicleData[0]->hi_noc_available }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Loan Paid Off </th>
                        	<td>{{ $vehicleData[0]->hi_loan_paid_off }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">State </th>
                        	<td>{{ $vehicleData[0]->li_state }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">City</th>
                        	<td>{{ $vehicleData[0]->li_city }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Yard Name </th>
                        	<td>{{ $vehicleData[0]->li_yard_name }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Yard Location </th>
                        	<td>{{ $vehicleData[0]->li_yard_location }}</td>
                        </tr>


                        <tr>
                        	<th scope="row">Superdari Status/th>
                        	<td>{{ $vehicleData[0]->avi_superdari_status }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Tax Type </th>
                        	<td>{{ $vehicleData[0]->avi_tax_type }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Theft Recover</th>
                        	<td>{{ $vehicleData[0]->avi_theft_recover }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Keys Available </th>
                        	<td>{{ $vehicleData[0]->avi_keys_available }}</td>
                        </tr>
                        <tr>
                        	<th scope="row">Summary </th>
                        	<td>{!! $vehicleData[0]->summary !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
       </div>
       <div class="col-md-1 col-sm-1 col-xs-12">
        </div>
      </div>
</div>
@endsection

@section('script')
@endsection