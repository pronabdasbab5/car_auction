@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>All Notification</h3>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($notificationData) > 0)
                            @php
                                $cnt = 1;
                            @endphp
                            @foreach($notificationData as $val)
                                <tr>
                                    <th>{{ $cnt++ }}</th>
                                    <th>{{ $val->title }}</th>
                                    <th>{!! $val->desc !!}</th>
                                    <th>
                                        <a href="{{ route('updatenotification', ['notificationId' => $val->id]) }}" class="btn btn-warning text-bold">Modify</a>
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
