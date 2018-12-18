<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		
		$count = 0;
		while ($count++ < 15e2) {
			$createdAt = '2018-12-0'.random_int(1,9).' '.random_int(10,23).':'.random_int(10,59).':'.random_int(10,59);
			DB::table('messages')->insert([
				'user_id' => random_int(1,177), //max is same as the nr of users from initial seed.
				'receiver_id' => random_int(1,177), // ^
				'title' => "Maria Standbeeld",
				'message' => "Geachte heer Vos,

Ik heb interesse in deze advertentie: 
Maria Standbeeld
Alleen niet voor zoveel geld. Is €50,- genoeg?

Met vriendelijke groet,",
				'created_at' => $createdAt,
				'updated_at' => $createdAt,
			]);
		}
	}
}
