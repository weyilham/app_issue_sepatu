<?php

namespace Database\Seeders;

use App\Models\Sepatu;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Ilham Maulana',
            'username' => 'weyilham',
            'email' => 'weyilham@gmail.com',
            'password' => bcrypt('ilham')
        ]);

        Sepatu::create([
            'nama_merk' => 'Adidas',
            'slug' => 'adidas',
        ]);
        Sepatu::create([
            'nama_merk' => 'Nike',
            'slug' => 'nike',
        ]);
        Sepatu::create([
            'nama_merk' => 'New Belance',
            'slug' => 'new-belance',
        ]);
    }
}
