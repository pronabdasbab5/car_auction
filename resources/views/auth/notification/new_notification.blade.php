@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>New Notification</h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ url('newnotification') }}" class="form-horizontal form-label-left">
                @csrf

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Title : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="title" id="title" placeholder="Vehicle Name" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('title')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Description : <span class="required">*</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <textarea type="text" name="desc" id="desc" placeholder="Description" class="form-control col-md-7 col-xs-12 text-bold ckeditor_textarea" required></textarea>
                    @error('desc')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success text-bold">Upload Notification</button>
                  </div>
                </div>
            </form>
            <!-- End New User registration -->
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('script')

@endsection
