<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradePatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_patterns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191)->nullable();
            $table->unsignedBigInteger('grade_category_id')->index();
            $table->smallInteger('mark_from');
            $table->smallInteger('mark_to');
            $table->unsignedBigInteger('grade_type_id')->index();
            $table->smallInteger('grade_points')->nullable();
            $table->boolean('is_internal')->default(false);
            $table->boolean('is_external')->default(false);
            $table->boolean('is_final')->default(false);
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
        Schema::dropIfExists('grade_patterns');
    }
}
