<?php

use Illuminate\Database\Seeder;

use App\service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 10; $x++) {
            service::create([
                'name' => 'Servicio ' . $x,
                'status' => service::STATUS_ACTIVE,
            ]);
        }
    }
}
