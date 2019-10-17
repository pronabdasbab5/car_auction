@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4><b>All Winner Bids</b></h4>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Auction Group Name</th>
                            <th>Party Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Address</th>
                            <th>Current Bid Amount</th>
                            <th>Total Bid Amount</th>
                            <th>Vehicle Name</th>
                            <th>Auction Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($bidData) > 0)
                            @php
                                $cnt = 1;
                            @endphp
                            @foreach($bidData as $val)
                                <tr>
                                    <th>{{ $cnt++ }}</th>
                                    <th>{{ $val->auction_group_name }}</th>
                                    <th>{{ $val->userName }}</th>
                                    <th>{{ $val->email }}</th>
                                    <th>{{ $val->mobileNo }}</th>
                                    <th>{{ $val->address }}</th>
                                    <th>{{ $val->current_bid_amount }}</th>
                                    <th>{{ $val->total_bid_amount }}</th>
                                    <th>{{ $val->vehicle_name }}</th>
                                    <th>{{ $val->auction_amount }}</th>
                                    <th>
                                        <a href="{{ route('vehicle_details', ['vehicle_id' => $val->vehicle_id]) }}" class="btn btn-warning text-bold" target="_blank">Vehicle Details</a>
                                    </th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
