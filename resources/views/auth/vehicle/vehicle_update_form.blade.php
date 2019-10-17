@extends('layouts.dapp')

@section('content')
<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h4>Edit Vehicle</h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"><br />
            <center>
                @if(session()->has('msg'))
                    <b>{{ session()->get('msg') }}</b>
                @endif
            </center>
            <!-- Section For New User registration -->
            <form method="POST" autocomplete="off" action="{{ url('updatevehicle') }}/{{ $vehicleData[0]->id }}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                @method('PUT')
                @csrf

            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Auction Group Name : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select name="auction_id" id="auction_id"  class="form-control col-md-7 col-xs-12 text-bold" required>
                      <option selected disabled>Choose Auction Group Name</option>
                      @if(count($auctionData) > 0)
                         @foreach($auctionData as $key => $value)
                            @if($vehicleData[0]->auction_id == $value['id'])
                                <option value="{{ $value['id'] }}" selected>{{ $value['auction_group_name'] }}</option>
                            @else
                                <option value="{{ $value['id'] }}">{{ $value['auction_group_name'] }}</option>
                            @endif
                         @endforeach
                      @endif
                  </select>
                    @error('auction_id')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Vehicle Name : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" name="vehicle_name" id="vehicle_name" value="{{ $vehicleData[0]->vehicle_name }}" placeholder="Vehicle Name" class="form-control col-md-7 col-xs-12 text-bold" required multiple>
                    @error('vehicle_name')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Vehicle Images : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="file" name="vehicle_images[]"  id="vehicle_images" class="form-control col-md-7 col-xs-12 text-bold" accept="/*" multiple>
                    @error('vehicle_images')
                        {{ $message }}
                    @enderror
                </div>

              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Biding Amount : <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="number" min="0" name="biding_amount" value="{{ $vehicleData[0]->auction_amount }}" id="biding_amount" placeholder="Biding Amount" class="form-control col-md-7 col-xs-12 text-bold" required multiple>
                    @error('biding_amount')
                        {{ $message }}
                    @enderror
                </div>
              </div>

            <br>
            <b>Basic Information</b><hr><br>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Mfg Month & Yesr : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="mfg_month_year" id="mfg_month_year" value="{{ $vehicleData[0]->bc_mfg_month_year }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('mfg_month_year')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Color : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="color" id="color" value="{{ $vehicleData[0]->bc_color }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('color')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Engine No : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="engine_no" id="engine_no" value="{{ $vehicleData[0]->bc_engine_no }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('engine_no')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Chasis No : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="chasis_no" id="chasis_no" value="{{ $vehicleData[0]->bc_chasis_no }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('chasis_no')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Transmission Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="transmission_type" id="transmission_type" value="{{ $vehicleData[0]->bc_transmission_type }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('transmission_type')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Fuel Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="fuel_type" id="fuel_type" value="{{ $vehicleData[0]->bc_fuel_type }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('fuel_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Owner Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="owner_type" id="owner_type" value="{{ $vehicleData[0]->bc_owner_type }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('owner_type')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Vehicle Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="vehicle_type" id="vehicle_type" value="{{ $vehicleData[0]->bc_vehicle_type }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('vehicle_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Ownership : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="ownership" id="ownership" value="{{ $vehicleData[0]->bc_ownership }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('ownership')
                        {{ $message }}
                    @enderror
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                </div>
              </div>

              <br>
            <b>Registration Information</b><hr><br>
                <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">RC Available : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="rc_available" id="rc_available" value="{{ $vehicleData[0]->rc_rc_available }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('rc_available')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Registration No : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="registration_no" id="registration_no" value="{{ $vehicleData[0]->rc_registration_no }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('registration_no')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Registration Date : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="registration_date" id="registration_date" value="{{ $vehicleData[0]->rc_registration_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('registration_date')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Reg. As : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="reg_as" id="reg_as" value="{{ $vehicleData[0]->rc_reg_as }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('reg_as')
                        {{ $message }}
                    @enderror
                </div>
              </div>

               <br>
            <b>Tax Information</b><hr><br>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Road Tax Expiry Date : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="road_tax_expiry_date" id="road_tax_expiry_date" value="{{ $vehicleData[0]->tx_road_text_expiray_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('road_tax_expiry_date')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Permit Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="permit_type" id="permit_type" value="{{ $vehicleData[0]->tx_permit_type }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('permit_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Permit Expiry Date : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="permit_expiry_date" id="permit_expiry_date" value="{{ $vehicleData[0]->tx_permit_expiray_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('permit_expiry_date')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Fitness Expiry Date : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="fitness_expiry_date" id="fitness_expiry_date" value="{{ $vehicleData[0]->tx_fitness_expiray_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('fitness_expiry_date')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Road tax validity : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="road_tax_validity" id="road_tax_validity" value="{{ $vehicleData[0]->tx_road_taxt_validity }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('road_tax_validity')
                        {{ $message }}
                    @enderror
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                </div>
              </div>

              <b>Hypothecation Information</b><hr><br>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Car under hypothecation : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="car_under_hypothecation" value="{{ $vehicleData[0]->hi_car_under_hypothecation }}" id="car_under_hypothecation"  class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('car_under_hypothecation')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Financer Name : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="financer_name" id="financer_name" value="{{ $vehicleData[0]->hi_financer_name }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('financer_name')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">NOC available : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="noc_available" id="noc_available" value="{{ $vehicleData[0]->hi_noc_available }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('noc_available')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Repo Date : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="repo_date" id="repo_date" value="{{ $vehicleData[0]->hi_repo_date }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('repo_date')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Load Paid off : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="load_paid_off" id="load_paid_off" value="{{ $vehicleData[0]->hi_loan_paid_off }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('load_paid_off')
                        {{ $message }}
                    @enderror
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                </div>
              </div>

              <b>Location Information</b><hr><br>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">State : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="state" id="state" value="{{ $vehicleData[0]->li_state }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('state')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">City : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="city" id="city" value="{{ $vehicleData[0]->li_city }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('city')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Yard Location : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="yard_location" id="yard_location" value="{{ $vehicleData[0]->li_yard_name }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('yard_location')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Yard Name : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="yard_name" id="yard_name" value="{{ $vehicleData[0]->li_yard_location }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('yard_name')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <b>Additional Vehicle Information</b><hr><br>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Superdari Status : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="superdari_status" id="superdari_status" value="{{ $vehicleData[0]->avi_superdari_status }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('superdari_status')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tax Type : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="tax_type" id="tax_type" value="{{ $vehicleData[0]->avi_tax_type }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('tax_type')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Theft Recover : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="theft_recover" id="theft_recover" value="{{ $vehicleData[0]->avi_theft_recover }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('theft_recover')
                        {{ $message }}
                    @enderror
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Keys Available : <span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="keys_available" id="keys_available" value="{{ $vehicleData[0]->avi_keys_available }}" class="form-control col-md-7 col-xs-12 text-bold" required>
                    @error('keys_available')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Summary : <span class="required">*</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <textarea type="text" name="summary" id="summary" placeholder="Summary" class="form-control col-md-7 col-xs-12 text-bold ckeditor_textarea" required>{{ $vehicleData[0]->summary }}</textarea>
                    @error('summary')
                        {{ $message }}
                    @enderror
                </div>
              </div>

              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-success text-bold">Update Vehicle</button>
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
