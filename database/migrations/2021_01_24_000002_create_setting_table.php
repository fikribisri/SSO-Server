<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->text('description');
            $table->string('logo',100)->nullable();
            $table->string('logo_small',100)->nullable();
            $table->string('background_login',100)->nullable();
            $table->string('company_name',150)->nullable();
            $table->string('url',150)->nullable();
            $table->string('smtp_host',150)->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_username',150)->nullable();
            $table->string('smtp_password',250)->nullable();
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
        Schema::dropIfExists('setting');
    }
}
