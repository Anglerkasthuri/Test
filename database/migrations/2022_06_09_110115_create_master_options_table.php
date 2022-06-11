<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36);
            $table->string('title', 191);
            $table->string('code', 191)->nullable();
            $table->unsignedBigInteger('master_category_id')->index();
            $table->unsignedBigInteger('parent_option_id')->nullable()->index();
            $table->unsignedBigInteger('campus_id')->nullable()->index();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('master_options');
    }
}
