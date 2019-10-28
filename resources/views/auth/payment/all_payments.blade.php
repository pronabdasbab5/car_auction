@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>All Payments</h3>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Message</th>
                            <th>Payment Request ID</th>
                            <th>Payment ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($all_payments) > 0)
                            @php
                                $cnt = 1;
                            @endphp
                            @foreach($all_payments as $val)
                                <tr>
                                    <th>{{ $cnt++ }}</th>
                                    <th>{{ $val->msg }}</th>
                                     <th>{{ $val->payment_request_id }}</th>
                                      <th>{{ $val->payment_id }}</th>
                                    <th>{{ $val->amount }}</th>
                                    <th>
                                        @if($val->status == 1)
                                            <a class="btn btn-primary">Un-Paid</a>
                                        @elseif($val->status == 2)
                                            <a class="btn btn-primary">Paid</a>
                                        @elseif($val->status == 3)
                                            <a class="btn btn-primary">Payment Failed</a>
                                        @endif
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
