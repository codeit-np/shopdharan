<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('city_id');
            $table->foreignId('category_id');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('visible')->default(true);
            $table->boolean('open')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('code')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
