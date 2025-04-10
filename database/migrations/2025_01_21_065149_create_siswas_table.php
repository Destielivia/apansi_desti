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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->integer('nisn')->unique();
            $table->integer('nik')->unique();
            $table->string('nama');
            $table->string('asal_sekolah');
            $table->string('agama');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('jenis_kelamin');
            $table->string('pas_poto');
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
        Schema::dropIfExists('siswas');
    }
};
