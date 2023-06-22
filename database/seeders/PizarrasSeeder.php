<?php

namespace Database\Seeders;

use App\Models\pizarra;
use Illuminate\Database\Seeder;

class PizarrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pizarra::create([            
             'nombre' => 'melanie',
             'user_id'=> 1
        ]);
    }
}
