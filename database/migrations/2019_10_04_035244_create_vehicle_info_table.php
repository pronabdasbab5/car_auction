<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('auction_id');
            $table->string('vehicle_name', 191);
            $table->integer('auction_amount');
            $table->string('bc_mfg_month_year', 191);
            $table->string('bc_color', 191);
            $table->string('bc_engine_no', 191);
            $table->string('bc_chasis_no', 191);
            $table->string('bc_transmission_type', 191);
            $table->string('bc_fuel_type', 191);
            $table->string('bc_owner_type', 191);
            $table->string('bc_vehicle_type', 191);
            $table->string('bc_ownership', 191);
            $table->string('rc_rc_available', 191);
            $table->string('rc_registration_no', 191);
            $table->string('rc_registration_date', 191);
            $table->string('rc_reg_as', 191);
            $table->string('tx_road_text_expiray_date', 191);
            $table->string('tx_permit_type', 191);
            $table->string('tx_permit_expiray_date', 191);
            $table->string('tx_fitness_expiray_date', 191);
            $table->string('tx_road_taxt_validity', 191);
            $table->string('hi_car_under_hypothecation', 191);
            $table->string('hi_financer_name', 191);
            $table->string('hi_noc_available', 191);
            $table->string('hi_repo_date', 191);
            $table->string('hi_loan_paid_off', 191);
            $table->string('li_zone', 191);
            $table->string('li_state', 191);
            $table->string('li_city', 191);
            $table->string('li_yard_name', 191);
            $table->string('li_yard_location', 191);
            $table->string('avi_superdari_status', 191);
            $table->string('avi_tax_type', 191);
            $table->string('avi_theft_recover', 191);
            $table->string('avi_keys_available', 191);
            $table->text('summary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_info');
    }
}
