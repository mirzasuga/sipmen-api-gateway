<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_detail_id')->nullable();
            // $table->unsignedInteger('vendor_detail_id');
            // $table->foreign('vendor_detail_id')->references('id')->on('vendor_details')
            //     ->onDelete('cascade');
            $table->string('name');
            $table->string('username');
            $table->string('mobile_phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
        Schema::table('vendors', function(Blueprint $table) {
            // $table->dropForeignIf('vendors_vendor_detail_id_foreign');
            $table->dropIfExists('vendors');
        });
    }
}
