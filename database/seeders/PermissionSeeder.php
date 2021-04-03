<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'user',
            'type' => 0,
            'description' => 'May be used by the service',
            'rule_name' => 'user',
            'data' => json_encode('user'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'admin',
            'type' => 1,
            'description' => 'Has access to the administration panel',
            'rule_name' => 'admin',
            'data' => json_encode('admin'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
