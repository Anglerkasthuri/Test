<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccreditationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accreditations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 36)->unique();
            $table->string('title', 191);
            $table->text('address')->nullable();
            $table->string('contact_number1', 15)->nullable();
            $table->string('contact_number2', 15)->nullable();
            $table->string('whatsapp_number', 15)->nullable();
            $table->string('email_address', 100)->nullable();
            $table->string('skype', 100)->nullable();
            $table->string('fax_number', 15)->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->string('expiry_date')->nullable();
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
        Schema::dropIfExists('accreditations');
    }
}
