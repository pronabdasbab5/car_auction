@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Active Members</h3>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data) > 0)
                            @php
                                $cnt = 1;
                            @endphp
                            @foreach($data as $val)
                                <tr>
                                    <th>{{ $cnt++ }}</th>
                                    <th>{{ $val->userName }}</th>
                                    <th>{{ $val->email }}</th>
                                    <th>{{ $val->mobileNo }}</th>
                                    <th>{{ $val->address }}</th>
                                    <th>
                                        @if($val->status == 1)
                                            @php
                                                $status = "De-Active";
                                                $val_1    = 0;
                                            @endphp
                                        @else
                                            @php
                                                $status = "Active";
                                                $val_1    = 1;
                                            @endphp
                                        @endif
                                        <a href="{{ route('verifyusers', ['member_id' => $val->id]) }}" class="btn btn-warning text-bold">Modify</a>
                                        <a href="{{ route('updatestatus', ['member_id' => $val->id, 'status' => $val_1]) }}" class="btn btn-danger text-bold">{{ $status }}</a>
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
