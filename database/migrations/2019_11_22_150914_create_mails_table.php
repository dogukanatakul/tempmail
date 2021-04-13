<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default(false);
            $table->string('mail')->nullable();
            $table->string('fromName')->nullable();
            $table->string('fromAddress')->nullable();
            $table->string('subject')->nullable();
            $table->string('date')->nullable();
            $table->string('uuid')->nullable();
            $table->string('toString')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
