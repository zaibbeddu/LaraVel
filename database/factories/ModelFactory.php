<?php

use App\Models\Album;
use App\User;


$Categories =
[
    'abstract',
    'animals',
    'business',
    'cats',
    'city',
    'food',
    'nightlife',
    'fashion',
    'people',
    'nature',
    'sports',
    'technics',
    'transport',
];


$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

    $factory->define(App\Models\Album::class, function (Faker\Generator $faker) use ($Categories) {
        
        return [
            'album_name' => $faker->name,
            'description' => $faker->text(128),
            'album_thumb' => $faker->imageUrl(640,480,$faker->randomElement($Categories)),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    });


        $factory->define(App\Models\Photo::class, function (Faker\Generator $faker) use ($Categories){
    
        
        return [
            'album_id' => Album::inRandomOrder()->first()->id,
            'name' => $faker->text(64),
            'description' => $faker->text(256),
            'img_path' => $faker->imageUrl(640,480,$faker->randomElement($Categories)),
        ];        
    });
    