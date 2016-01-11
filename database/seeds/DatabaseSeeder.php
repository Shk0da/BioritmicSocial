<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run() {
        $this->call('LocationTableSeeder');
        $this->command->info('Location table seeded!');
    }
}