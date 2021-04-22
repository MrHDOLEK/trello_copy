<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packets')->insert([
            'id' => 1,
            'name' => 'Free tier',
            'price' => 0,
            'description' => 'This tier is all user',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_id' => 1,
        ]);
        DB::table('packets')->insert([
            'id' => 2,
            'name' => 'Premium tier',
            'price' => 10,
            'description' => 'This tier gift access a premium fuctions of portal',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'permission_id' => 2,
        ]);

    }
}
