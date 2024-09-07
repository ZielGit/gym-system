<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('coaches', function ($table) {
    $table->id();
    $table->tinyInteger('document_type')->comment('DNI: 1, FOREIGNER CARD: 4, RUC: 6, PASSPORT: 7');
    $table->string('document_number')->unique();
    $table->string('name');
    $table->string('paternal_surname');
    $table->string('maternal_surname');
    $table->string('email')->nullable()->unique();
    $table->string('phone')->nullable()->unique();
    $table->string('address');
    $table->tinyInteger('status')->default(1)->comment('Disable : 0, Enable : 1');
    $table->timestamps();
});
