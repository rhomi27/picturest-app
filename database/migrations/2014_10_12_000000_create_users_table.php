<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('username');
            $table->text('alamat')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('pictures')->default('user.jpg');
            $table->text('bio')->nullable();
            $table->enum('jenis_kelamin', ['Pria','Wanita'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('status',['aktif','banned'])->default('aktif');
            $table->enum('role', ['user','admin'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
};
