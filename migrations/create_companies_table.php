<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('companies', function ($table) {
    $table->id();
    $table->string('ruc', 11);
    $table->string('name');
    $table->string('tax_domicile');
    $table->string('email')->nullable()->unique();
    $table->string('phone')->nullable()->unique();
    $table->string('logo_path')->nullable();
    $table->timestamps();
});
