<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36);
            $table->string('title', 191);
            $table->string('code', 191);
            $table->unsignedBigInteger('master_group_id')->index();
            $table->text('description')->nullable();
            $table->boolean('show_in_form')->default(false);
            $table->boolean('is_dependent')->default(false);
            $table->unsignedBigInteger('parent_category_id')->nullable()->index();
            $table->boolean('active')->default(true);
            $table->integer('sequence_number')->nullable();
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
        Schema::dropIfExists('master_categories');
    }
}
