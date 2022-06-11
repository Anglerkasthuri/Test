<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->string('email', 100);
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->unsignedBigInteger('gender_id')->nullable()->index();
            $table->date('date_of_birth')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->string('mobile_number', 50)->nullable();
            $table->string('alternative_mobile_1', 50)->nullable();
            $table->string('alternative_mobile_2', 50)->nullable();
            $table->string('alternative_email_1', 100)->nullable();
            $table->string('alternative_email_2', 100)->nullable();
            $table->string('skype_id', 100)->nullable();
            $table->string('whatsapp_number', 100)->nullable();
            $table->unsignedBigInteger('blood_group_id')->nullable()->index();
            $table->unsignedBigInteger('natinality_id')->nullable()->index();
            $table->string('community', 191)->nullable();
            $table->string('caste', 191)->nullable();
            $table->string('religion', 191)->nullable();
            $table->string('ethnicity', 191)->nullable();
            $table->string('language_known', 191)->nullable();
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
        Schema::dropIfExists('students');
    }
}
