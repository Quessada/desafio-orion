<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->delete();

        $clients = [
            ['id' => 1, 'name' => 'Matheus', 'phone' => '(11) 5555-5555', 'cpf' => '53244160611', 'car_plate' => 'MUN-0511'],
            ['id' => 2, 'name' => 'Lucas', 'phone' => '(17) 4444-4444', 'cpf' => '31502429675', 'car_plate' => 'KEK-8927'],
            ['id' => 3, 'name' => 'João', 'phone' => '(15) 1234-567', 'cpf' => '12242778307', 'car_plate' => 'LBC-3639'],
            ['id' => 4, 'name' => 'Marcos', 'phone' => '(23) 2322-2323', 'cpf' => '91218074426', 'car_plate' => 'HZR-7808'],
            ['id' => 5, 'name' => 'Carlos', 'phone' => '(43) 4545-5757', 'phone' => '37777686186', 'cpf' => '', 'car_plate' => 'FRT-8052'],
            ['id' => 6, 'name' => 'Guilherme', 'phone' => '(32) 1232-2133', 'cpf' => '58612848733', 'car_plate' => 'DOW-1746'],
        ];

        DB::table('clients')->insert($clients);
    }
}
