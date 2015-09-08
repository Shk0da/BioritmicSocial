<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->command->info('Таблица пользователей загружена данными!');

        Model::reguard();
    }
}
