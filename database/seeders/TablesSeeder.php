<?php

namespace Database\Seeders;

use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
            'name' => 'welcome',
            'users' => json_encode(['admin']),
            'is_visible' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'creator_id' => 2,
            'theme_id' => 1,
        ]);
        Table::createTable('test','test',1);
    }
}
