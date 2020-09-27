<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;
// $table->id();
// $table->string('name');
// $table->integer('price');
// $table->text('description');
// $table->string('slug');
// $table->string('thumbnail');
// $table->integer('stock');
// $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
// $table->foreignId('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
// $table->timestamps()
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'price' => $faker->numberBetween(10000, 1000000),
        'description' => $faker->paragraph(5, true),
        'stock' => $faker->numberBetween(1, 999),
        'slug' => \Str::slug($faker->sentence()),
        'thumbnail' => 'images/product/'.$faker->image('public/storage/images/product', 640, 480, null, false),
        'category_id' => $faker->numberBetween(1, 14),
        'user_id' => 1
    ];
});
