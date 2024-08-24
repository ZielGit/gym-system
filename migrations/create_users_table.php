<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
    $table->id();
    $table->string('name');
    $table->string('lastname');
    $table->string('email')->unique();
    $table->string('password');
    $table->tinyInteger('status')->default(1)->comment('Disable : 0, Enable : 1');
    $table->timestamps();
});
