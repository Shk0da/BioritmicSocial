<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        for ($i = 1; $i <= 1000; $i++) {
            factory(App\Models\User::class, 500)->create()->each(function ($u) {
                \App\Models\Profile::firstOrCreate([
                    'user_id' => $u->id,
                    'birthday' => random_int(1950, 2000) . '-0' . random_int(1, 9) . '-' . random_int(1, 28),
                    'location' => random_int(1, 500),
                    'gender' => random_int(0, 1),
                    'zodiac' => random_int(1, 10),
                    'animal' => random_int(1, 10),
                ]);
            });

            $this->command->info('Пачка ' . $i . ' готова!');
            sleep(10);
        }
    }
}
