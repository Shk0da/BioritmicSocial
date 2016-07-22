<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    public $limit = 1000;

    public function run()
    {
        $countries_list = [];
        $city_list = [];

        $vkCountries = file_get_contents('http://api.vk.com/method/database.getCountries?&need_all=1&count=' . $this->limit);
        $countries = json_decode($vkCountries);

        foreach ($countries->response as $country) {
            $countries_list[$country->cid] = $country->title;
        }

        foreach ($countries_list as $id => $title) {
            $vkCities = file_get_contents('http://api.vk.com/method/database.getCities?&country_id=' . $id . '&count=' . $this->limit);
            $cities = json_decode($vkCities);

            foreach ($cities->response as $city) {
                $city_list[][$title] = $city->title;
            }

        }

        foreach ($city_list as $city) {
            foreach ($city as $name => $item) {
                DB::table('locations')->insert([
                    'country' => $name,
                    'city' => $item,
                ]);
            }
        }
    }
}
