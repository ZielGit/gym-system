<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('attendances', function ($table) {
    $table->id();
    $table->foreignId('customer_id')->constrained();
    $table->date('date');
    $table->dateTime('check_in_time');
    $table->dateTime('check_out_time')->nullable();
    $table->foreignId('coach_id')->constrained();
    $table->foreignId('routine_id')->constrained();
    $table->tinyInteger('status')->default(1)->comment('Exit : 0, Entry : 1');
    $table->foreignId('user_id')->constrained();
    $table->timestamps();
});
