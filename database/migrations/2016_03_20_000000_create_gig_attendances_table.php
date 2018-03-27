<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigAttendancesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('gig_attendances', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('gig_id')->unsigned();
            $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade');

            $table->integer('attendance')->default(0); // 0 = not attending, 1 = maybe, 2 = attending
            $table->string('comment')->nullable();
            $table->string('internal_comment')->nullable();
            $table->timestamps();
        });

        Schema::create('gig_attendance_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('gig_attendance_id')->unsigned();
            $table->foreign('gig_attendance_id')->references('id')->on('gig_attendances')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('gig_gig_attendance', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gig_id')->unsigned();
            $table->foreign('gig_id')->references('id')->on('gigs')->onDelete('cascade');

            $table->integer('gig_attendance_id')->unsigned();
            $table->foreign('gig_attendance_id')->references('id')->on('gig_attendances')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('gig_attendance_user');
        Schema::drop('gig_gig_attendance');
        Schema::drop('gig_attendances');
    }
}
