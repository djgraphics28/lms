<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CivilStatusSeeder
 */
class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('civil_status')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/civil_status.sql'));
        }
    }
}
