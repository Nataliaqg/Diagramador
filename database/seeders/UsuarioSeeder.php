<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([            
            'name' => 'melanie',
            'email' => 'melanie@gmail.com',
            'password' =>bcrypt('12345678')
       ]);
       User::create([            
        'name' => 'Natalia',
        'email' => 'natalia@gmail.com',
        'password' =>bcrypt('12345678')
   ]);

    }
}
