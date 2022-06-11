<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_durations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->smallInteger('years')->nullable();
            $table->smallInteger('months')->nullable();
            $table->smallInteger('weeks')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by_id')->nullable()->index();
            $table->unsignedBigInteger('updated_by_id')->nullable()->index();
            $table->timestamps();
            $table->unsignedBigInteger('deleted_by_id')->nullable()->index();
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
        Schema::dropIfExists('program_durations');
    }
}
