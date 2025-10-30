<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_guru', function (Blueprint $table) {
            $table->increments('idguru');
            $table->string('nip');
            $table->string('nuptk');
            $table->string('namaguru');
            $table->string('tempatlahir');
            $table->date('tgllahir');
            $table->enum('jk', ['L', 'P']);
            $table->string('alamat');
            $table->integer('idagama');
            $table->string('tlprumah');
            $table->string('hpguru');
            $table->string('photoguru');
            $table->enum('statusaktif', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
