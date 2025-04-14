<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasirSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'kasir'],
        ]);
    }
}

