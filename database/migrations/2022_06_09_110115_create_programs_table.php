<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->string('degree_name', 191)->nullable();
            $table->string('code', 191)->nullable();
            $table->string('short_name', 191)->nullable();
            $table->unsignedBigInteger('degree_awarding_body_id')->nullable()->index();
            $table->unsignedBigInteger('campus_id')->nullable()->index();
            $table->unsignedBigInteger('program_category_id')->nullable()->index();
            $table->unsignedBigInteger('program_sub_category_id')->nullable()->index();
            $table->unsignedBigInteger('program_level_id')->nullable()->index();
            $table->unsignedBigInteger('program_group_id')->nullable()->index();
            $table->unsignedBigInteger('program_type_id')->nullable()->index();
            $table->unsignedBigInteger('study_mode_id')->nullable()->index();
            $table->unsignedBigInteger('program_duration_id')->nullable()->index();
            $table->unsignedBigInteger('academic_pattern_id')->nullable()->index();
            $table->smallInteger('number_of_pattern')->nullable();
            $table->unsignedBigInteger('accreditation_id')->nullable()->index();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('programs');
    }
}
