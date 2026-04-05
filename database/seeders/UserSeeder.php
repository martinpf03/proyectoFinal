<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            for($i=1; $i<=5; $i++){
                $usuario = new User();
                $usuario->name = 'Usuario'.$i;
                $usuario->role = 'cliente';
                $usuario->email = 'usuario'.$i.'@mail.com';
                $usuario->password = Hash::make('abc123.');
                $usuario->save();
        }
    }
}
