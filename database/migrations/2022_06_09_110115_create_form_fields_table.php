<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->unsignedBigInteger('form_id')->index();
            $table->unsignedBigInteger('form_field_type_id')->nullable()->index('form_fields_field_type_id_index');
            $table->unsignedBigInteger('form_dropdown_type_id')->nullable()->index('form_fields_dropdown_type_id_index');
            $table->unsignedBigInteger('master_category_id')->nullable()->index();
            $table->unsignedBigInteger('system_model_id')->nullable()->index('form_fields_system_master_id_index');
            $table->boolean('is_required')->default(false);
            $table->boolean('show_in_filter')->default(false);
            $table->integer('sequence_number')->nullable();
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
        Schema::dropIfExists('form_fields');
    }
}
