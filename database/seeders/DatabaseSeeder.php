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
        'username' => 'Picturest',
        'alamat' => 'banjar',
        'nama_lengkap' => 'Picturest',
        'pictures'=> 'user.jpg',
        'bio' => 'apa lu liat liat',
        'jenis_kelamin' => 'Pria',
        'role' => 'admin',
        'email' => 'picturest@gmail.com',
        'password' => bcrypt('picturest123'),
        ];
        User::create($data);
        User::factory(20)->create();
        Post::factory(100)->create();
        Album::factory(20)->create();
    }
}
