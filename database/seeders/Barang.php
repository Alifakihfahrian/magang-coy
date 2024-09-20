<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Barang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Barang')->insert([
            [
                'id' => 1,
                'name' => 'buku',
                'description' => 'bukudesc',
            ],
            [
                'id' => 2,
                'name' => 'mouse',
                'description' => 'mousedesc',
            ],
            [
                'id' => 3,
                'name' => 'pensil',
                'description' => 'pensildesc',
            ],
        ]);
    }
}
