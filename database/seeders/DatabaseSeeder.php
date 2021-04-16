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
<<<<<<< HEAD
        $this->call(ArticleCategoriesSeeder::class);
        $this->call(ArticleTypesSeeder::class);
=======
        $this->call(CardTableSeeder::class);
        $this->call(TaskCardSeeder::class);
>>>>>>> bf5cdb31afc87c81c795d5311ba4d2840a740d58
    }
}
