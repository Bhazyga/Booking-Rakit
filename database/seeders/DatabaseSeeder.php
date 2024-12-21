<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\pemilik;
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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('adminzz'),
        ]);

        // making pemilik users
        \App\Models\User::factory()->create([
            'name' => 'pemilik',
            'email' => 'pemilik@pemilik.com',
            'role' => 'pemilik',
            'password' => bcrypt('pemilik'),
        ]);
        // filling the pemilik table

        pemilik::factory()->create([
            'name' => 'Abdul Xiboba',
            'user_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.',
            'image' => 'vectimg.png',
            'jenis' => 'rakitkayu',
            'price' => 100,
            'location' => 'Casablanca',
            'status' => 'available',
            'rating' => 5,
            'yearsofexperience' => 5,
        ]);
    }
}
