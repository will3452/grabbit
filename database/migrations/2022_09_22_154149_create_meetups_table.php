<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requestor_id');
            $table->unsignedBigInteger('approver_id');
            $table->string('remarks');
            $table->unsignedBigInteger('post_id');
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('declined_at')->nullable();;
            $table->dateTime('meetup_date');
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
        Schema::dropIfExists('meetups');
    }
}
