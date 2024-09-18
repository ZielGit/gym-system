<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('plans', function ($table) {
    $table->id();
    $table->string('name');
    $table->string('description');
    $table->decimal('price', 12, 2);
    $table->string('condition');
    $table->string('image')->nullable();
    $table->tinyInteger('status')->default(1)->comment('Disable : 0, Enable : 1');
    $table->timestamps();
});
