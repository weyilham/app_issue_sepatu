<?php

namespace Database\Seeders;

use App\Models\Artikel;
use App\Models\Role;
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
        $role = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Laboratorium', 'slug' => 'laboratorium'],
            ['name' => 'Quality Control', 'slug' => 'quality-control'],
        ];
        Role::insert($role);
        User::create([
            'name' => 'Siti Musaropah',
            'username' => 'siti',
            'email' => 'siti@gmail.com',
            'password' => bcrypt('siti'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Mia Mustika',
            'username' => 'miamustika',
            'email' => 'mia@gmail.com',
            'password' => bcrypt('mia'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Ilham Maulana',
            'username' => 'ilhammaulana',
            'email' => 'ilham@gmail.com',
            'password' => bcrypt('ilham'),
            'role_id' => 3,
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


        $artikel = [
            [
                'sepatu_id' => 1,
                'nama_artikel' => 'Adidas Samba',
                'keterangan' => 'adidas samba',
            ],

            [
                'sepatu_id' => 1,
                'nama_artikel' => 'Adidas Stan Smith',
                'keterangan' => 'adidas stan smith',
            ],

            [
                'sepatu_id' => 1,
                'nama_artikel' => 'Adidas Tubular',
                'keterangan' => 'adidas tubular',
            ],

            [
                'sepatu_id' => 3,
                'nama_artikel' => 'NB 550',
                'keterangan' => 'new-belance 550',
            ],

            [
                'sepatu_id' => 3,
                'nama_artikel' => 'NB 550',
                'keterangan' => 'new-belance 550',
            ],

            [
                'sepatu_id' => 3,
                'nama_artikel' => 'NB 750',
                'keterangan' => 'new-belance 750',
            ],

        ];


        Artikel::insert($artikel);
    }
}
