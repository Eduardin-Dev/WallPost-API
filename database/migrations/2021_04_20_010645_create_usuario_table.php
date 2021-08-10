<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('idusuario');
            $table->string('nm_usuario', 100);
            $table->string('cd_senha', 64);
            $table->string('ds_email', 60)->unique();
            $table->string('ds_celular');
            $table->string('cd_cpf', 20)->unique();
            $table->string('cd_cpnj', 20)->unique();
            $table->binary('imagem_usuario');
            $table->timestamps();
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
        Schema::dropIfExists('usuario');
    }
}
