<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleForVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_for_vendor', function (Blueprint $table) {

            $table->unsignedInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')
                ->onDelete('cascade');

            $table->unsignedInteger('role_vendor_id');
            $table->foreign('role_vendor_id')->references('id')->on('role_vendors')
                ->onDelete('cascade');

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
        Schema::table('role_for_vendor', function(Blueprint $table) {
            $table->dropForeign('role_for_vendor_vendor_id_foreign');
            $table->dropForeign('role_for_vendor_role_vendor_id_foreign');
            $table->dropIfExists('role_for_vendor');
        });
    }
}
