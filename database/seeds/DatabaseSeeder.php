<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()	{


		//create roles
		foreach (['Approved','Moderator','Admin','Banned'] as $v) {
			DB::table('roles')->insert([
				'name' => $v
			]);
		}

		//create admin
		DB::table('users')->insert([
			'name' => 'Sander Buruma',
			'email' => 'sanderburuma@gmail.com',
			'password' => '$2y$10$jQY5ljXUPHkKlkREkFhC8eJh6FiDSgo/tGFspsC.1phnt.UgcQhp.', //see my default laravel password entry in Bitwarden
			'latitude' => 53.2152292,
			'longitude' => 6.5669632,
			'created_at' => '2018-12-03 09:49:03',
			'updated_at' => '2018-12-03 09:49:03',
			'email_verified_at' => '2018-12-03 09:50:33',
		]);		
		foreach ([1,2,3] as $v) {
			DB::table('role_user')->insert([
				'user_id' => '1',
				'role_id' => "$v",
			]);
		}

		$count = 2;
		foreach (["Piet","Jan","Joris","Ali","Mickey","Mark","Lucas","Jonah","Angela","Maria","Elise","Johanna","Katherina","Margriet","Judith","Hosea"] as $v) {
			foreach (["Buruma","Voorwaarts","Linkswaards","Jongsma","Vossens","Jager","Schoenmaker","Botergoed","Smit","Voerenaar","vd Werf"] as $vv) {
				DB::table('users')->insert([
					'name' => "$v $vv",
					'email' => "$v$vv@gmail.com",
					'password' => '$2y$10$jQY5ljXUPHkKlkREkFhC8eJh6FiDSgo/tGFspsC.1phnt.UgcQhp.', //see my default laravel password entry in Bitwarden
					'latitude' => 53.1152292+random_int(0,199999)/1e6,
					'longitude' => 6.4669632+random_int(0,199999)/1e6,
					'created_at' => '2018-12-03 09:49:03',
					'updated_at' => '2018-12-03 09:49:03',
					'email_verified_at' => '2018-12-03 09:50:33',
				]);
				DB::table('role_user')->insert([
					'user_id' => $count++,
					'role_id' => 1,
				]);
			}
		}

		foreach ([
			'Antiek & Kunst',
			'Audio',
			'Auto-onderdelen',
			'Boeken',
			'Caravens & Campers',
			'Cd\'s en Dvd\'s',
			'Computers & Software',
			'Contacten & Berichten',
			'Dieren en Dergelijke',
			'Doehetzelf en Verbouw',
			'Fietsen & Brommers',
			'Hobby & Vrije Tijd',
			'Huis & Inrichting',
			'Huizen & Kamers',
			'Kinderen & Baby\'s',
			'Kleding | Dames',
			'Kleding | Heren',
			'Motoren',
			'Muziek & Instrumenten',
			'Postzegels & Munten',
			'Sieraden, Tassen & Uiterlijk',
			'Spelcomputers & Games',
			'Sport & Fitness',
			'Telecommunicatie',
			'Tickets & Kaartjes',
			'Tuin & Terras',
			'Vacatures',
			'Vakantie',
			'Verzamelen',
			'Watersport & Boten',
			'Witgoed & Apparatuur',
			'Zakelijke Goederen',
			'Overig'] as $v) {
			DB::table('categories')->insert([
				'name' => $v
			]);
		}

		$count = 0;
		foreach ([
			['Antiek | Eetgererij', 'Antiek | Meubels', 'Antiek | Gebruiksvoorwerpen', 'Edelsmeden & Sieradenmakers', 'Fotografen', 'Kunst', 'Kunst | Schilderijen', 'Kunstenaars & Portret Schilders', 'Reparatie & Onderhoud', 'Timmerlieden & Meubelmakers'], // 'Antiek & Kunst',
			['Accesoires', 'Audio', 'Audio Draagbaar', 'Film, video & tv', 'Film & Videobewerking', 'Fotografen', 'Fotografie', 'Optische Apparatuur', 'Reparaties'],// 'Audio',
			['Auto-onderdelen', 'Vrachtwagen-onderdelen'],// 'Auto-onderdelen',
			['Eten & Koken', 'Geschiedenis & Politiek', 'Kind & Jeugd', 'Kunst & Cultuur', 'Populaire Fictie', 'School, Studio & Wetenschap', 'Sport & Hobby & Vrije tijd', 'Stripverhalen', 'Taal & Reizen', 'Vertalers, Tolken & Tekstschrijven'],// 'Boeken',
			['Accesoires & Toebehoren', 'Caravens & Campers', 'Diensten', 'Inkoop', 'Reparatie & Onderhoud', 'Tenten & Vouwwagens'],// 'Caravens & Campers',
			['Blue Ray\'s', 'DVDs', 'CDs', 'VHS', 'Vinyl'],// 'Cd\'s en Dvd\'s',
			['Boeken', 'Computer & Internet experts', 'Computeronderdelen', 'Computers', 'Laptops', 'Opslag', 'Randapparatuur', 'Reparatie & Onderhoud', 'Software', 'Tablet & E-Reader', 'Webdesigners & Domeinnamen'], // 'Computers & Software',
			['Bijlles & Taalles', 'Dating, Uitgaan & Relaties', 'Feesten & Evenementen', 'Gezocht & Oproepen'],// 'Contacten & Berichten',
			["Boeken","Diensten | Verzorging, Oppas en Les","Honden","Katten","Knaagdieren en Konijnen","Paarden en Pony's","Reptielen en Amfibieën","Toebehoren","Vee","Vermiste dieren","Vissen","Vogels","Overige Dieren"],// 'Dieren en Dergelijke',
			["Aannemers","Bouwkundig adviseurs en Architecten","Dak en Gevel","Dakdekkers en Rietdekkers","Elektriciens","Gereedschappen","Gevelrenovatie en Voegers","Glaszetters","Klussers en Klusbedrijven","Loodgieters en Installateurs","Gereedschappen | Machines en Apparaten","Materialen","Ramen, Deuren en Kozijnen","Sanitair en Tegels","Schilders en Behangers","Slopers en Sloopwerkzaamheden","Slotenmakers","Stukadoors en Tegelzetters","Timmerlieden en Meubelmakers","Verf en Schilderen","Verhuur","Verlichting, Elektra en Kabels","Verwarming en Ventilatie","Vloerleggers en Parketteurs","Zonweringinstallateurs"],// 'Doehetzelf en Verbouw',
			["Brommeronderdelen en Toebehoren","Brommers","Fietsaccessoires en Onderdelen","Fietsen | Algemeen","Fietsen | Dames","Fietsen | Heren","Fietsen | Kinderen","Fietsenmakers en Bromfietsenmakers","Scooters","Snorfietsen en Snorscooters"],// 'Fietsen & Brommers',
			["Alternatieve geneeskunde","Elektronica","Feestartikelen","Kleding en Stoffen","Knutselen en Handenarbeid","Modelbouw","Modelauto's","Modeltreinen","Restaurants en Cateraars","Sparen","Spel en Strategie","Verzamelkaartspellen","Zaalverhuur en Feestlocaties"],// 'Hobby & Vrije Tijd',
			["Badkamer","Banken en Stoelen","Huishoudelijke hulp","Interieuradviseurs","Kasten","Keuken","Lampen","Schoonmakers en Glazenwassers","Slaapkamer","Slotenmakers","Stoffering","Tafels","Timmerlieden en Meubelmakers","Verhuizers en Opslag","Woonaccessoires"],// 'Huis & Inrichting',
			["Gezocht","Hypotheken en Verzekeringen","Makelaars en Taxateurs","Parkeren","Te huur","Te koop","Te ruil","Verhuizers en Opslag"],// 'Huizen & Kamers',
			["Babybenodigdheden","Babykleding","Boeken","Kinderfeestjes en Entertainers","Kinderkleding","Kindermeubilair","Onderweg","Oppas en Kinderopvang","Speelgoed","Speelgoed | Buiten","Thuiszorg en Kraamhulp"],// 'Kinderen & Baby\'s',
			["Accessoires","Badmode en Ondergoed","Kappers en Thuiskappers","Kleding","Kledingontwerpers","Kledingreparatie","Kledingverhuur","Merkkleding","Schoenen en Beenmode"],// 'Kleding | Dames',
			["Accessoires","Badmode en Ondergoed","Kleding","Kledingontwerpers","Kledingreparatie","Kleermakers en Kledingverhuur","Merkkleding","Schoenen en Sokken"],// 'Kleding | Heren',
			["Accessoires","Monteurs en Garages","Boeken en Handleidingen","Helmen en Kleding","Inkoop","Motoren | Merken","Motoren | Typen","Onderdelen","Rijscholen","Schadeherstellers en Spuiterijen"],// 'Motoren',
			["Apparatuur en Elektronica","Blaasinstrumenten","Drums en Percussie","Muziekles en Zangles","Muzikanten, Artiesten en Dj's","Onderdelen en Toebehoren","Piano's en Toetsen","Reparatie en Onderhoud","Snaarinstrumenten","Strijkinstrumenten"],// 'Muziek & Instrumenten',
			["Bankbiljetten | Europa","Bankbiljetten | Wereld","Brieven en Enveloppen","Munten | Europa","Munten | Wereld","Postzegels | Europa","Postzegels | Wereld","Postzegels | Thema","Toebehoren","Verzamelingen"],// 'Postzegels & Munten',
			["Accessoires","Edelsmeden en Sieradenmakers","Horloges","Kappers en Thuiskappers","Manicure","Pedicure","Schoonheidsspecialisten","Sieraden","Tassen en Koffers","Uiterlijk","Zonnebrillen en Brillen"],// 'Sieraden, Tassen & Uiterlijk',
			["Games | Nintendo","Games | Sony PlayStation","Games | Xbox","Games | Overige","Reparatie en Onderhoud","Spelcomputers | Nintendo","Spelcomputers | Sony PlayStation","Spelcomputers | Xbox","Spelcomputers | Overige","Toebehoren | Nintendo","Toebehoren | Sony PlayStation","Toebehoren | Xbox","Toebehoren | Overige"],// 'Spelcomputers & Games',
			["Balsporten","Behendigheidssporten","Fitness en Gymnastiek","Kleding","Lopen, Fietsen en Skaten","Masseurs en Massagesalons","Rijden en Vliegen","Vechtsporten en Zelfverdediging","Wellness en Ontspanning","Wintersporten",],// 'Sport & Fitness',
			["Datacommunicatie","Mobiele telefoons","Mobiele telefoons | Hoesjes en Frontjes","Mobiele telefoons | Toebehoren","Reparaties","Vaste telefoons en Toebehoren","Zenders en Ontvangers"],// 'Telecommunicatie',
			["Concerten","Cultuur","Recreatie en Festivals","Reizen","Sport"],// 'Tickets & Kaartjes',
			["Bloemen en Planten","Bodem en Grond","Grasmaaiers","Huisjes en Meubelen","Tuinaanleg en Decoratie","Tuinaccessoires","Tuinmannen en Stratenmakers","Zonweringinstallateurs"],// 'Tuin & Terras',
			["Bouw, Transport en Techniek","Dienstverlening","Landbouw en Visserij","Management en Verkoop","Marketing en Grafisch","Overheid en Wetenschap","Stages en Vrijwilligers","Verzorging en Uiterlijk","Profielen"],// 'Vacatures',
			["Bijles, Privé-les en Taalles","Boeken","Campings en Pensions","Huizen | Benelux","Huizen | Europa","Huizen | Buiten Europa","Huizen | Overige","Reizen | Doelgroep","Reizen | Fly-drive en Auto","Reizen | Themareizen","Reizen | Overige","Woningruil"],// 'Vakantie',
			["Ansichten, Prenten en Kaarten","Apparatuur","Automaten","Dier, Steen en Fossiel","Dranken, Glas en Servies","Film, Tv en Vermaak","Kleding en Toebehoren","Poppen, Beren en Figuurtjes","Sport en Scouting","Vervoer en Transport"],// 'Verzamelen',
			["Accessoires en Toebehoren","Bootverhuur","Hengelsport","Motorboten","Reparatie en Onderhoud","Roeien en Kanoën","Surfen, Zwemmen en Waterskiën","Zeilboten en Toebehoren"],// 'Watersport & Boten',
			["Huishouden","Keuken","Onderdelen","Persoonlijke apparatuur","Reparaties"],// 'Witgoed & Apparatuur',
			["Agrarisch","Horeca","Kantoor, Winkel en Bedrijf","Machines en Bouw","Partijgoederen en Retail","Verhuur | Gereedschap"],// 'Zakelijke Goederen',
			[],// 'Overige'
			] as $v) {
				$count++;
				DB::table('subcategories')->insert([
					'name' => 'Overig',
					'category_id' => $count,
				]);
				foreach($v as $vv) {
					DB::table('subcategories')->insert([
						'name' => $vv,
						'category_id' => $count,
					]);
				}

		}
	}
}