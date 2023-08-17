<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

        // Insert some stuff
        DB::table('umums')->insert(
            array(
                'perusahaan' => 'EZA TEKNOLOGI NUSANTARA',
                'alamat1' => 'Jl. Ir H. Juanda',
                'alamat2' => 'Kuningan Jawa Barat 45512',
                'telp' => '0811 247505',
                'logoUrl' => 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50',
                'volume' => '50',
                'mute' => false,
                'text' => 'Selamat Datang',
                'kecepatan' => 0,
                'folder_video' => 'video',
                'mode_printer' => '0',
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            )
        );
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
