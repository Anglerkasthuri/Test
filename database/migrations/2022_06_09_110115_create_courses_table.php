<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->string('code', 25)->nullable();
            $table->string('short_name', 25)->nullable();
            $table->unsignedBigInteger('campus_id')->nullable()->index();
            $table->unsignedBigInteger('program_category_id')->nullable()->index();
            $table->unsignedBigInteger('program_sub_category_id')->nullable()->index();
            $table->unsignedBigInteger('program_level_id')->nullable()->index();
            $table->unsignedBigInteger('course_type_id')->nullable()->index();
            $table->unsignedBigInteger('course_category_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->string('approval_id', 191)->nullable();
            $table->text('approval_link')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
