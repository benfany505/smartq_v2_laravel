<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antreans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_layanan');
            $table->integer('nomor_antrean');
            $table->string('kode_loket')->default(0);
            $table->boolean('status_panggilan')->default(false);
            $table->integer('jumlah_recall')->default(0);
            $table->integer('sisa_antrean')->default(0);
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('antreans');
    }
};
