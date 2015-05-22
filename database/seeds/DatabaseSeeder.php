<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Neutrino\Role::create(array( 'name' => 'admin' ));
		Neutrino\Role::create(array( 'name' => 'author'  ));
		Neutrino\Role::create(array( 'name' => 'user'  ));

		Neutrino\User::create(array(
			'name' => 'peter',
			'email' => 'peter@qwerty.com',
			'password' => 'password',
			'role_id' => '1'
		));

		Neutrino\User::create(array(
			'name' => 'jane',
			'email' => 'jane@qwerty.com',
			'password' => 'password',
			'role_id' => '2'
		));

		Neutrino\TextCategory::create(array( 'title' => 'menu' ));
		Neutrino\TextCategory::create(array( 'title' => 'button' ));


		Neutrino\TextKey::create(array( 
			'title' => 'send_button', 
			'text_category_id' => '2'
		));

		Neutrino\TextKey::create(array( 
			'title' => 'edit_button', 
			'text_category_id' => '2'
		));

		Neutrino\Language::create(array( 
			'code' => 'en', 
			'title' => 'english', 
		));

		Neutrino\TextValue::create(array( 
			'value' => 'kng', 
			'text_key_id' => '1',
			'language_id' => '1'
		));

		Neutrino\TextValue::create(array( 
			'value' => 'kng', 
			'text_key_id' => '2',
			'language_id' => '1'
		));

		// $this->call('UserTableSeeder');
	}

}
