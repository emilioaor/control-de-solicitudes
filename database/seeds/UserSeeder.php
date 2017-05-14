<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'user' => 'administrador',
            'password' => bcrypt('12345678'),
            'email' => 'administrador@mail.com',
            'firstnames' => 'Emilio Arturo',
            'lastnames' => 'Ochoa Ramirez',
            'phone' => '04141459498',
            'country' => 'Venezuela',
            'state' => 'Carabobo',
            'level' => User::LEVEL_ADMIN,
        ]);


        for ($x = 1; $x <= 10; $x++) {
            User::create([
                'user' => 'usuario' . $x,
                'password' => bcrypt('12345678'),
                'email' => 'usuario' . $x . '@mail.com',
                'firstnames' => 'Nombre Nombre',
                'lastnames' => 'Apellido Apellido',
                'phone' => '04141459498',
                'country' => 'Venezuela',
                'state' => 'Carabobo',
                'level' => User::LEVEL_USER,
            ]);
        }

    }
}
