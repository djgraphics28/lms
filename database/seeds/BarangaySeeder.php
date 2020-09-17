<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        if (!DB::table('barangays')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/barangay.sql'));
        }
    }
}
