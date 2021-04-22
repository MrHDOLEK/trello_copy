<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacketsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packets_permissions')->insert([
            'id' => 1,
            'max_tables' => 7,
            'max_teams' => 5,
        ]);
        DB::table('packets_permissions')->insert([
            'id' => 2,
            'max_tables' => 16,
            'max_teams' => 10,
        ]);
    }
}
