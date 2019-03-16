<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratJalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('vehicle_id')
                ->foreign('vehicle_id', 'vehicle_id_surat_jalans_foreign')
                ->references('id')
                ->on('vehicles')
                ->onDelete('cascade');
            $table->unsignedInteger('created_by')
                ->foreign('created_by', 'created_by_surat_jalans_foreign')
                ->references('id')
                ->on('vendors')
                ->onDelete('cascade');

            $table->integer('courier_id')->index()->nullable();
            $table->enum('type', ['gudang', 'customer']);
            $table->enum('status', ['idle', 'on the way', 'terima sebagian', 'complete'])->default('idle');

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
        Schema::dropIfExists('surat_jalans');
    }
}
