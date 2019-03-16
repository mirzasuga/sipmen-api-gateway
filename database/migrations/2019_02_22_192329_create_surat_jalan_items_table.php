<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratJalanItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalan_items', function (Blueprint $table) {
            $table->unsignedInteger('surat_jalan_id')
                ->foreign('surat_jalan_id', 'surat_jalan_id_surat_jalan_items_foreign')
                ->references('id')
                ->on('surat_jalans')
                ->onDelete('cascade');
            $table->unsignedInteger('resi_id')
                ->foreign('resi_id', 'resi_id_surat_jalan_items_foreign')
                ->references('id')
                ->on('resis')
                ->onDelete('cascade');
            $table->enum('status', ['on the way', 'received']);
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
        Schema::dropIfExists('surat_jalan_items');
    }
}
