<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
        ]);
        // \App\Models\User::factory(10)->create();

        \App\Models\item::factory(10)->create()->each(function ($item) {
            $item->membership()
                ->saveMany(\App\Models\membership::factory(10)->make());
        });
    }
}
