<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(LocationTableSeeder::class);
        $this->command->info('Location table seeded!');
    }
}
