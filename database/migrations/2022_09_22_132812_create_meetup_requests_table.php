<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetup_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requestor_id');
            $table->unsignedBigInteger('approver_id');
            $table->string('remarks');
            $table->unsignedBigInteger('post_id');
            $table->dateTime('approved_at');
            $table->dateTime('declined_at');
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
        Schema::dropIfExists('meetup_requests');
    }
}
