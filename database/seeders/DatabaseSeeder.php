<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        $data = [
        'username' => 'admin',
        'alamat' => 'banjar',
        'nama_lengkap' => 'admin slepet',
        'pictures'=> 'user.jpg',
        'bio' => 'no bio yet',
        'jenis_kelamin' => 'Pria',
        'role' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),
        ];
        // User::create($data);

        Post::factory(100)->create();
        Album::factory(20)->create();
    }
}
