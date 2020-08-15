<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->integer('id', true)->unsigned()->comment("Id de usuario");
            $table->string('first_name', 30)->comment("Primer y segundo nombre del usuario");
            $table->string('last_name', 30)->comment("Primer y segundo apellido del usuario");
            $table->string('email', 64)->unique('uk_user_email')->comment("Correo electronico del usuario");
            $table->string('password', 255)->comment("Clave del usuario");
            $table->text('token', 255)->nullable()->comment("Token de acceso de usuario");
            $table->tinyInteger('age')->unsigned()->comment("Edad del usuario");
            $table->binary('image')->nullable()->comment("Imagen de perfil de usuario");
            $table->string('description', 255)->nullable()->comment("Descripcion de usuario");
            $table->datetime('created_at')->comment("Fecha de creación del registro");
            $table->datetime('updated_at')->nullable()->comment("Fecha de modificación del registro");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tb_user');
    }
       
}
