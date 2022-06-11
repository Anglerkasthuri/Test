<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->unsignedBigInteger('campus_id')->nullable()->index();
            $table->unsignedBigInteger('program_id')->nullable()->index();
            $table->unsignedBigInteger('grade_category_id')->nullable()->index();
            $table->unsignedBigInteger('academic_year_id')->nullable()->index();
            $table->unsignedBigInteger('academic_pattern_id')->nullable()->index();
            $table->unsignedTinyInteger('academic_pattern_number')->nullable();
            $table->unsignedBigInteger('batch_id')->nullable()->index();
            $table->date('duration_from')->nullable();
            $table->date('duration_to')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('medium_of_instruction_id')->nullable()->index();
            $table->unsignedBigInteger('enrollment_type_id')->nullable()->index();
            $table->unsignedBigInteger('enrollment_status_id')->nullable()->index();
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
        Schema::dropIfExists('enrollments');
    }
}
