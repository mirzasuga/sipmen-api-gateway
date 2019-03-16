<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('receiver_province_id');
            $table->string('receiver_province_name');
            $table->string('receiver_regency_id');
            $table->string('receiver_regency_name');
            $table->string('receiver_district_id');
            $table->string('receiver_district_name');
            $table->string('receiver_village_id');
            $table->string('receiver_village_name');
            $table->string('receiver_street');
            $table->string('receiver_kodepos');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('package_name');
            $table->integer('package_weight');
            $table->string('package_type');
            $table->tinyInteger('package_is_fragile')->default(0);
            $table->tinyInteger('use_assurance')->default(0);
            $table->enum('jenis_pengiriman', [ 'storing_to_counter', 'request_pickup' ])->default('storing_to_counter');
            $table->double('total_price',10,2);
            $table->double('tarif_price',10,2);
            $table->double('tarif_min_weight',10,2);
            $table->integer('vendor_detail_id');
            $table->integer('user_id');
            $table->string('vendor_branch_id');
            $table->string('vendor_tarif_id');
            $table->datetime('jadwal_kirim')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
