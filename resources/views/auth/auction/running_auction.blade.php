@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>All Running Auction</h3>
            <a href="{{ route('newauction') }}" style="float: right; font-weight: bolder; font-size: 18px;">New Auction</a>
            <div class="clearfix"></div>
          </div>
            <div class="x_content"><br />
                <table id="all_running_auction" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Category</th>
                            <th>Auction Group Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Time</th>
                            <th>All Vehicle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    
$(document).ready(function(){

    var type = 1;

    $('#all_running_auction').DataTable({

        "processing": true,
        "serverSide": true,
        "ajax":{
            "url": "{{ url('/allauction') }}/1",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}", 'type': type}
        },
        "columns": [
            { "data": "id" },
            { "data": "category" },
            { "data": "auctionGroupName" },
            { "data": "startDate" },
            { "data": "endDate" },
            { "data": "time" },
            { "data": "allVehicle" },
            { "data": "action" },
        ],    
    });
});

</script>
@endsection