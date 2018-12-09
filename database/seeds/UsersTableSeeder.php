<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$count = 2;
		foreach (["Piet","Jan","Joris","Ali","Mickey","Mark","Lucas","Jonah","Angela","Maria","Elise","Johanna","Katherina","Margriet","Judith","Hosea"] as $v) {
			foreach (["Buruma","Voorwaarts","Linkswaards","Jongsma","Vossens","Jager","Schoenmaker","Botergoed","Smit","Voerenaar","vd Werf"] as $vv) {
                $createdAt = '2018-12-0'.random_int(1,9).' '.random_int(10,23).':'.random_int(10,59).':'.random_int(10,59);
				DB::table('users')->insert([
					'name' => "$v $vv",
                    'email' => "$v$vv@gmail.com",
                    'websiteUrl' => "www.$vv$v.nl",
					'password' => '$2y$10$0LXS7kFPXV3lqzxeONNNiuWPBGBynLvDgPqXOO4ftOtzWJMX4QI82', //aaaaaaaa
					'latitude' => 53.1152292+random_int(-99999,99999)/1e6,
                    'longitude' => 6.5669632+random_int(-99999,99999)/1e6/cos(53.1152292/57.295),
                    'telephone1' => "06-".random_int(1e7,1e8-1),
                    'street' => 'Stationstraat',
                    'streetnr' => random_int(1,random_int(2,random_int(3,255))),
                    'city' => 'Groningen',
                    'province' => 'Groningen',
                    'country' => 'the Netherlands',
					'created_at' => $createdAt,
					'updated_at' => $createdAt,
					'email_verified_at' => $createdAt,
				]);
				DB::table('role_user')->insert([
					'user_id' => $count++,
					'role_id' => 1,
				]);
			}
		}
    }
}
