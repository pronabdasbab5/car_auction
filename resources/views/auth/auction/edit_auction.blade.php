@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>Edit Auction Group Name</h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('updateauction', ['auction_id' => $auction_data->id]) }}" class="form-horizontal form-label-left">
                @csrf

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Category : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="category_id" id="category_id"  class="form-control col-md-7 col-xs-12 text-bold" required>
                      <option selected disabled class="text-bold">Choose Category</option>
                      @foreach($data as $value)

                        @if($auction_data->category_id == $value->id)
                            <option value="{{ $value->id }}" class="text-bold" selected>{{ $value->category }}</option>
                        @else
                            <option value="{{ $value->id }}" class="text-bold">{{ $value->category }}</option>
                        @endif
                      @endforeach
                  </select>
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>
              </div>

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Auction Group Name : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="auction_group_name" id="auction_group_name"  class="form-control col-md-7 col-xs-12 text-bold" value="{{ $auction_data->auction_group_name }}" placeholder="Enter Auction Group Name" required>
                    @error('auction_group_name')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Auction Start Date : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="date" name="auction_start_date" id="auction_start_date" value="{{ $auction_data->start_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('auction_start_date')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Auction End Date : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="date" name="auction_end_date" id="auction_end_date" value="{{ $auction_data->end_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('auction_end_date')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success text-bold">Update Auction Group Name</button>
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
