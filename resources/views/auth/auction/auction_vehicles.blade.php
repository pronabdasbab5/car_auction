@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>Auction Vehicles</h4>
            <a href="{{ route('newauction') }}" style="float: right; font-weight: bolder; font-size: 18px;">New Auction</a>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Vechicle Amount</th>
                            <th>Vechicle Name</th>
                            <th>Vechicle Color</th>
                            <th>Fuel Type</th>
                            <th>Owner Type</th>
                            <th>View Full Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach($vehicleData as $key => $value)
                            <tr>
                                <td><b>{{ $cnt++ }}</b></td>
                                <td><b>{{ $value['auction_amount'] }}</b></td>
                                <td><b>{{ $value['vehicle_name'] }}</b></td>
                                <td><b>{{ $value['bc_color'] }}</b></td>
                                <td><b>{{ $value['bc_fuel_type'] }}</b></td>
                                <td><b>{{ $value['bc_owner_type'] }}</b></td>
                                <td><a href="{{ route('vehicle_details', ['vehicleId' => $value['id']]) }}" class="btn btn-warning"><b>View More Details</b></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
