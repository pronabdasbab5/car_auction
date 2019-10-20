<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->string('userName', 100);
            $table->string('email', 190);
            $table->string('mobileNo', 15)->unique();
            $table->text('address');
            $table->string('password', 191);
            $table->string('addressProof', 191);
            $table->string('idProof', 191);
            $table->integer('isVerified')->default(0)->comment("1 = Verified, 0 = None");
            $table->integer('deposit')->nullable();
            $table->integer('buyingLimit')->nullable();
            $table->integer('availableLimit')->nullable();
            $table->integer('status')->default(1)->comment("1 = Active, 0 = De-Active");
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
}
