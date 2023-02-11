<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateFirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create first user
        $user = new \App\Models\User();
        $user->name = 'admin';
        $user->password = bcrypt('admin');
        $user->cep = '12345678';
        $user->address = 'Rua dos Bobos';
        $user->city = 'São Paulo';
        $user->state = 'SP';
        $user->number = 0;
        $user->save();
    }
}
