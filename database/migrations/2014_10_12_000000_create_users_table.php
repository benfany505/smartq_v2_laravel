<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('username')->unique();
            $table->string('role');
            $table->string('password');
            $table->string('image_url')->nullable();
            $table->string('created_by');
            $table->text('remember_token')->nullable();
            $table->timestamp('last_login_at')->nullable();            
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'fullname' => 'Eza Teknologi Nusantara',
                'username' => 'etn',
                'role' => 'administrator',
                'password' => Hash::make('123456'),
                'image_url' => null,
                'created_by' => 'admin',
                'remember_token' => 'admin',
                'last_login_at' => now(),                
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
        Schema::dropIfExists('users');
    }
};
