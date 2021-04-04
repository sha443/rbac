<?php

use Faker\Generator as Faker;


$factory->define(sha443\rbac\Models\Menu::class, function (Faker $faker) {
    return [
        'display_name' => $faker->name,
        'action' => '/rbac-test',
    ];
});
