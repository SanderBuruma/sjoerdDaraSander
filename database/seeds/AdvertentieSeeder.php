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
		
		function createAdvertentie() {
			
			//seeding information
			$titleSubjects = explode(";","Jas;Motorfiets;Telefoon;Piano;Standbeeld;Munt;Mariabeeld;Katholiek Kruis;Kast;Boog;Springkussen;Foto Sinterklaas;Kerst Beeldjes");
			$prefixes = explode(";",";;Grote ;Kleine ;Mooie ;Zware ;Licht ;Vrolijk ; Toffe");
			$beschrijvingen = [
				"Weinig gebruikt, mooi opgepoetst en met heel veel liefde behandeld.",
				"Mama wil dat ik hem verkoop, maar ik wil hem eigelijk niet kwijt.",
				"Mijn zoon heeft het niet meer nodig. Hopelijk kunt u het gebruiken.",
				"Heel erg waardevol en zeldzaam, bied niet te weinig.",
				"Deze is nog ouder dan ikzelf, is nooit kapot geweest. Heel erg betrouwbaar.",
				"Geërfd van mijn opa. Neemt te veel ruimte op op de zolder.",
			];
			
			//actual creation and insertion of advertentie
			$createdAt = '2018-'.str_pad(random_int(1,12),2,"0",STR_PAD_LEFT).'-'.str_pad(random_int(1,28),2,"0",STR_PAD_LEFT).' '.str_pad(random_int(0,23),2,"0",STR_PAD_LEFT).':'.str_pad(random_int(0,59),2,"0",STR_PAD_LEFT).':'.str_pad(random_int(0,59),2,"0",STR_PAD_LEFT);
			DB::table('advertenties')->insert([
				'user_id' => random_int(1,177), //max is same as the nr of users from initial seed.
				'subcategory_id' => random_int(1,336), // ^
				'title' => $prefixes[array_rand($prefixes)].$titleSubjects[array_rand($titleSubjects)],
				'description' => $beschrijvingen[array_rand($beschrijvingen)],
				'slug' => random_int(1e8,1e9-1)."-".time(),
				'price' => random_int(1,99)*10**(random_int(0,random_int(0,random_int(0,5)))),
				'photo1' => 'placeholder'.random_int(1,14).'.jpeg',
				'photo2' => 'placeholder'.random_int(1,14).'.jpeg',
				'photo3' => 'placeholder'.random_int(1,14).'.jpeg',
				'created_at' => $createdAt,
				'updated_at' => $createdAt,
				]);
			}
			$count = 0;
			while ($count++ < 500) {
				createAdvertentie();
			}
			
	}
}
