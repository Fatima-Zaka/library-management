<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Let's truncate our existing records to start from scratch.
         Book::truncate();

         $faker = \Faker\Factory::create();

         // And now, let's create a few articles in our database:
         for ($i = 0; $i < 50; $i++) {
             Book::create([
                 'title' => $faker->sentence,
                 'description' => $faker->paragraph,
                 'ISBN' => $faker->isbn10,
                 'publication_date' => $faker->date
             ]);
         }
    }
}
