<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle_info';

    protected $fillable = ['auction_id', 'vehicle_name', 'auction_amount', 'bc_mfg_month_year', 'bc_color', 'bc_engine_no', 'bc_chasis_no', 'bc_transmission_type', 'bc_fuel_type', 'bc_owner_type', 'bc_vehicle_type', 'bc_ownership', 'rc_rc_available', 'rc_registration_no', 'rc_registration_date', 'rc_reg_as', 'tx_road_text_expiray_date', 'tx_permit_type', 'tx_permit_expiray_date', 'tx_fitness_expiray_date', 'tx_road_taxt_validity', 'hi_car_under_hypothecation', 'hi_financer_name', 'hi_noc_available', 'hi_repo_date', 'hi_loan_paid_off', 'li_zone', 'li_state', 'li_city', 'li_yard_name', 'li_yard_location', 'avi_superdari_status', 'avi_tax_type', 'avi_theft_recover', 'avi_keys_available', 'summary'];
}
