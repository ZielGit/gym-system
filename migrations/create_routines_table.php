<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('routines', function ($table) {
    $table->id();
    $table->string('day');
    $table->string('description');
    $table->tinyInteger('status')->default(1)->comment('Disable : 0, Enable : 1');
    $table->timestamps();
});
