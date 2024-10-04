<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('payments', function ($table) {
    $table->id();
    $table->foreignId('plan_detail_id')->constrained();
    $table->foreignId('customer_id')->constrained();
    $table->foreignId('plan_id')->constrained();
    $table->decimal('price', 12, 2);
    $table->date('date');
    $table->dateTime('hour');
    $table->tinyInteger('status')->default(1)->comment('Disable : 0, Enable : 1');
    $table->foreignId('user_id')->constrained();
    $table->timestamps();
});
