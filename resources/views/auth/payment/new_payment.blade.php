@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>New Payment Request</h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('add_payment') }}" class="form-horizontal form-label-left">
                @csrf

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Select User : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="user_id" id="user_id"  class="form-control col-md-7 col-xs-12 text-bold" required>
                      <option selected disabled class="text-bold">Select User</option>
                      @foreach($data as $value)
                        <option value="{{ $value->id }}" class="text-bold">{{ $value->userName }} : {{ $value->mobileNo }}</option>
                      @endforeach
                  </select>
                    @error('user_id')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Message : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="msg" id="msg"  class="form-control col-md-7 col-xs-12 text-bold" placeholder="Amount" required>
                    @error('msg')
                        {{ $message }}
                    @enderror
                </div>
              </div>

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Amount : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="amount" id="amount"  class="form-control col-md-7 col-xs-12 text-bold" placeholder="Amount" required>
                    @error('amount')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success text-bold">Create Request</button>
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
