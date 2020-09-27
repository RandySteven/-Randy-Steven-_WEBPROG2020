<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['Toy & Hobby', 'Book', 'Student', 'Family', 'Cooking', 'Computer',
                                    'Fashion', 'Gaming', 'Handphone', 'Electronic', 'Office', 'Pet', 'Tour & Travel',
                                    'Wedding']);

        $categories->each(function($c){
            Category::create([
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
