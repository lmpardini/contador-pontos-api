<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = [
                    'id'       => 1,
                    'nome'     => 'Administrador',
                    'email'    => 'admin@mail.com',
                    'password' => bcrypt('admin'),
            ];



//            User::create($usuario);

        DB::table('users')->insert([
            'nome'     => 'Administrador',
            'email'    => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'created_at' => Carbon::now()
        ]);

    }
}
