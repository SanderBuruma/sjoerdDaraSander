<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()	{
		DB::table('users')->insert([
			'name' => 'Sander Buruma',
			'email' => 'sanderburuma@gmail.com',
			'password' => '$2y$10$jQY5ljXUPHkKlkREkFhC8eJh6FiDSgo/tGFspsC.1phnt.UgcQhp.', //Bitwarden
		]);
		
		DB::table('roles')->insert([
			'name' => 'Approved',
		]);
		DB::table('roles')->insert([
			'name' => 'Moderator',
		]);
		DB::table('roles')->insert([
			'name' => 'Admin',
		]);
		
		DB::table('users_roles')->insert([
			'user_id' => '1',
			'role_id' => '1',
		]);
		DB::table('users_roles')->insert([
			'user_id' => '1',
			'role_id' => '2',
		]);
		DB::table('users_roles')->insert([
			'user_id' => '1',
			'role_id' => '3',
		]);
	}
}
