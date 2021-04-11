<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UsersPermissionsSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(TablesSeeder::class);
        $this->call(CardsSeeder::class);
        $this->call(TasksSeeder::class);
        $this->call(CardTableSeeder::class);
        $this->call(TaskCardSeeder::class);
    }
}
