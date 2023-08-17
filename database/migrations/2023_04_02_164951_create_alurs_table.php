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
        Schema::create('alurs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('list_loket');
            $table->string('list_layanan');
            $table->string('list_transfer')->nullable();
            $table->string('keterangan');
            $table->boolean('status');
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
        Schema::dropIfExists('alurs');
    }
};
