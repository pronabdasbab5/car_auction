@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>All Vehicle</h3>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Zone</th>
                            <th>Auction Group Name</th>
                            <th>Vehicle Name</th>
                            <th>Auction Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($vehicleData) > 0)
                            @php
                                $cnt = 1;
                            @endphp
                            @foreach($vehicleData as $val)
                                <tr>
                                    <th>{{ $cnt++ }}</th>
                                    <th>{{ $val->category }}</th>
                                    <th>{{ $val->auction_group_name }}</th>
                                    <th>{{ $val->vehicle_name }}</th>
                                    <th>{{ $val->auction_amount }}</th>
                                    <th>
                                        <a href="{{ route('updatevehicleform', ['vehicle_id' => $val->id]) }}" class="btn btn-warning text-bold">Modify</a>
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
