<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36);
            $table->string('title', 191);
            $table->string('nationality', 191);
            $table->unsignedBigInteger('continent_id')->nullable()->index('continent_id');
            $table->unsignedBigInteger('sub_continent_id')->nullable()->index('sub_continent_id');
            $table->unsignedBigInteger('timezone_id')->nullable()->index('timezone_id');
            $table->string('dial_code', 10)->nullable();
            $table->string('iso2_code', 5)->nullable();
            $table->string('iso3_code', 5)->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('deleted_by_id')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
