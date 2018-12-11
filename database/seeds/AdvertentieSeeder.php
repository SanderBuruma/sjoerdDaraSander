<?php

use Illuminate\Database\Seeder;

class AdvertentieSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//something which is hopefully a litle more western saxon european language ish than lorem ipsum
		function jibberish($len) {
			$jibberish = '';
			$vowels = explode(' ','a a a a a a a e e e e e e e e e u i i i i i o o o o');
			$consonants = explode(' ','b b b c c d d d d f f f g g h h j j k k l l m m n n n p p p q r r s s t t v v w w b b b c c d d d d f f f g g h h j j k k l l m m n n n p p p r r s s t t v v w w x y z');
			while (strlen($jibberish) < $len) {
				$word = '';
				$randLen = random_int(2,7)+random_int(2,7);
				while (strlen($word) < $randLen) {
					random_int(0,4)?$word .= $consonants[array_rand($consonants)]:null;
					$word .= $vowels[array_rand($vowels)];
					random_int(0,1)?$word .= $vowels[array_rand($vowels)]:null;
					random_int(0,2)?$word .= $consonants[array_rand($consonants)]:null;
					random_int(0,3)?$word .= ' ':null;
				}
				$jibberish .= $word;
			}
			return $jibberish;
		}

		$count = 0;
		while ($count++ < 5e2) {
			$createdAt = '2018-'.str_pad(random_int(1,12),2,"0",STR_PAD_LEFT).'-'.str_pad(random_int(1,28),2,"0",STR_PAD_LEFT).' '.str_pad(random_int(0,23),2,"0",STR_PAD_LEFT).':'.str_pad(random_int(0,59),2,"0",STR_PAD_LEFT).':'.str_pad(random_int(0,59),2,"0",STR_PAD_LEFT);
			DB::table('advertenties')->insert([
				'user_id' => random_int(1,177), //max is same as the nr of users from initial seed.
				'subcategory_id' => random_int(1,336), // ^
				'title' => jibberish(random_int(12,random_int(12,55))),
				'description' => jibberish(random_int(64,random_int(64,512))),
				'slug' => random_int(1e15,1e16-1)."-".time(),
				'price' => random_int(1,99)*10**(random_int(0,random_int(0,random_int(0,5)))),
				'photo1' => 'placeholder'.random_int(1,14).'.jpeg',
				'photo2' => 'placeholder'.random_int(1,14).'.jpeg',
				'photo3' => 'placeholder'.random_int(1,14).'.jpeg',
				'created_at' => $createdAt,
				'updated_at' => $createdAt,
			]);
		}

	}
}
