<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->nullable();
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->integer('created_by');
            $table->integer('vendor_detail_id');
            $table->double('tarif_kg', 20, 0);
            $table->double('berat_barang', 20, 0);
            $table->double('total_biaya', 20, 0);
            $table->tinyInteger('is_fragile')->default(0);
            $table->string('last_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resis');
    }
}
