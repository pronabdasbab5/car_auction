@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Edit Member</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif<br>
                <img src="{{ route('member_image', ['filename' => $data[0]['addressProof']]) }}" alt="Address Proof" height="150" width="300">

                <img src="{{ route('member_image_1', ['filename_1' => $data[0]['idProof']]) }}" alt="ID Proof" height="150" width="300">
            </center><br><br>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ route('verifyusersdata', ['member_id' => $data[0]['id']]) }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden"  name="add_old_img" value="{{ $data[0]['addressProof']}}">
                <input type="hidden"  name="id_old_img" value="{{ $data[0]['idProof']}}">
                
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Category : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="category" class="form-control col-md-7 col-xs-12 text-bold"  required>
                      <option selected disabled></option>
                      @foreach($category as $value)
                         @if($value->id == $data[0]['category_id'])
                              <option value="{{ $value->id }}" class="text-bold" selected>{{ $value->category }}</option>
                         @else
                              <option value="{{ $value->id }}" class="text-bold">{{ $value->category }}</option>
                         @endif
                      @endforeach
                  </select>
                    @error('category')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Name : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="name" id="name"  class="form-control col-md-7 col-xs-12 text-bold" placeholder="Enter Name" value="{{ $data[0]['userName'] }}" required>
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Address Proof: <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="file" name="address_proof" id="address_proof" class="form-control col-md-7 col-xs-12 text-bold" accept="/*">
                    @error('address_proof')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">ID Proof: <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="file" name="id_proof" id="id_proof" class="form-control col-md-7 col-xs-12 text-bold" accept="/*">
                    @error('id_proof')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Email : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="email" name="email" id="email" class="form-control col-md-7 col-xs-12 text-bold" value="{{ $data[0]['email'] }}" required>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Mobile No : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" min="0" name="mobile_no" id="mobile_no" class="form-control col-md-7 col-xs-12 text-bold" value="{{ $data[0]['mobileNo'] }}" required>
                    @error('mobile_no')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Address : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="address" id="address" class="form-control col-md-7 col-xs-12 text-bold" value="{{ $data[0]['address'] }}" required>
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Deposit Amount : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" min="0" name="deposit_amount" id="deposit_amount" class="form-control col-md-7 col-xs-12 text-bold" value="{{ $data[0]['deposit'] }}" placeholder="Deposit Amount" required>
                    @error('deposit_amount')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Buying Amount : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" min="0" name="buying_amount" value="{{ $data[0]['buyingLimit'] }}" id="buying_amount" class="form-control col-md-7 col-xs-12 text-bold" placeholder="Buying Amount" required>
                    @error('buying_amount')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success text-bold">Verify</button>
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
