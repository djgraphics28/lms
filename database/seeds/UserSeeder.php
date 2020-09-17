<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class RegionsSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('users')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/users.sql'));
        }
    }
}
