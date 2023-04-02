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
        Schema::create('umums', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan')->nullable();
            $table->string('alamat1')->nullable();
            $table->string('alamat2')->nullable();
            $table->string('telp')->nullable();
            $table->string('logoUrl')->nullable();
            $table->string('volume')->nullable();
            $table->boolean('mute')->default(false);
            $table->string('text')->nullable();
            $table->integer('kecepatan')->default(0);
            $table->string('folder_video')->nullable();
            $table->string('mode_printer')->nullable();
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
        Schema::dropIfExists('umums');
    }
};
