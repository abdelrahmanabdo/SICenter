<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();        
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('mobile')
                  ->nullable();
            $table->string('guardianـmobile');
            $table->integer('class_year')
                    ->comment('Class Year of student: 1 , 2 ,3,4,5,6 ');
            $table->integer('appointment')
                    ->comment('Appointment of student: 1 , 2 ,3 ');
            $table->boolean('is_new')
                  ->default(1);
            $table->timestamps();

            /**
             * Foreign Keys
             */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
