<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('plan_details', function ($table) {
    $table->id();
    $table->foreignId('customer_id')->constrained();
    $table->foreignId('plan_id')->constrained();
    $table->date('date');
    $table->dateTime('hour');
    $table->date('due_date');
    $table->tinyInteger('status')->default(1)->comment('Disable : 0, Enable : 1');
    $table->foreignId('user_id')->constrained();
    $table->timestamps();
});
