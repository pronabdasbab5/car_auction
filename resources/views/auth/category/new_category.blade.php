@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>New Category</h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ url('newcategory') }}" class="form-horizontal form-label-left">
                @csrf
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Category : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="category" id="category"  class="form-control col-md-7 col-xs-12 text-bold" placeholder="Enter Category" autofocus>
                    @error('category')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success text-bold">Create Category</button>
                  </div>
                </div>
            </form>
            <!-- End New User registration -->
            </div>
          </div>
        </div>
      </div>

    <div class="clearfix"></div>

            <!-- Modal -->
            <div class="modal fade" id="category_modal" role="dialog" style="margin-top: 50px;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="modal_title">Edit Category</h4>
                        </div>
                        <div class="modal-body" id="category_details">
                            <center><b style="font-size: 20px;">Loading ....</b></center>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Category</th>
                            <th>Add Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($data) > 0)

                            @php
                            $sl_no = 0;
                            @endphp

                            @foreach ($data as $value)

                                <tr class="text-bold">
                                    <td>{{ ++$sl_no }}</td>
                                    <td>{{$value['category'] }}</td>
                                    <td>{{$value['created_at']}}</td>
                                    <td>
                                        <a class="btn btn-primary text-bold" id="category_edit_id{{$value['id']}}" onclick="edit_category_model({{$value['id']}});"><i class="fa fa-edit"></i>&nbsp;&nbsp;Modify</a>
                                    </td>
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

@section('script')
<script type="text/javascript">
function edit_category_model(category_id) {

    $('#category_details').html("<center><b style=\"font-size: 20px;\">Loading ....</b></center>");

    $('#category_modal').modal('show');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $.ajax({
        method: "GET",
        url   : "{{ url('/updatecategory/') }}/"+category_id+"",
        success: function(response) {

            $('#category_details').html(response);
        }
    });
}

function save_category_info() {

    var category_id = $('#category_id_modal').text();
    var category_name = $('#category_name_modal').val();

    $('#btn_save_category_info').text('Updating ... ! Please wait');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    if(category_name != ""){

        $.ajax({
            method: "POST",
            url   : "{{ url('/updatecategory') }}/"+category_id,
            data: {

                "category_id": category_id,
                "category_name": category_name
            },
            success: function(response) {

                if(response == "1") {

                    $('#category_modal').modal('hide');
                    location.reload();
                }
                else {

                    $('category_name_text').text('Please ! Enter brand name.');
                    $('#btn_save_category_info').text('Update Category');
                }
            }
        });
    } else{

        $('#category_name_text').text('Please ! Enter category.');
        $('#btn_save_category_info').text('Update Category');
    }

}
</script>
@endsection