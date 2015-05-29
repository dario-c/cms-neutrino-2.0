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

		$this->seedUserRoles();
		$this->seedAdminUser();
		$this->seedBasicLanguages();
		$this->seedExampleTextKeyWithValue();
	}
	
	private function seedUserRoles()
	{
		Neutrino\Role::create(array( 'id' => 1, 'name' => 'admin' ));  			// Manage everything
		Neutrino\Role::create(array( 'id' => 2, 'name' => 'manager' )); 		// Manage most aspects of the site
		Neutrino\Role::create(array( 'id' => 3, 'name' => 'editor' ));			// Scheduling and managing content
		Neutrino\Role::create(array( 'id' => 4, 'name' => 'author' ));			// Write important content
		Neutrino\Role::create(array( 'id' => 5, 'name' => 'contributors' )); 	// Authors with limited rights
		Neutrino\Role::create(array( 'id' => 6, 'name' => 'moderator' ));	 	// Moderate user content
		Neutrino\Role::create(array( 'id' => 7, 'name' => 'user' ));			// Average Joe
	}
	
	private function seedAdminUser()
	{
		$roleAdmin = Neutrino\Role::whereName('admin')->first();
		
		Neutrino\User::create(array(
			'name' 		=> 'Admin',
			'email' 	=> 'dev@caviarcontent.com',
			'password' 	=> 'password',
			'role_id' 	=> $roleAdmin->id
		));
	}
	
	private function seedBasicLanguages()
	{
		Neutrino\Language::create(array( 
			'code' => 'en', 
			'title' => 'English', 
		));

		Neutrino\Language::create(array( 
			'code' => 'nl', 
			'title' => 'Nederlands', 
		));

		Neutrino\Language::create(array( 
			'code' => 'es', 
			'title' => 'Español', 
		));

		Neutrino\Language::create(array( 
			'code' => 'de', 
			'title' => 'Deutsch', 
		));
	}
	
	private function seedExampleTextKeyWithValue()
	{
		$textCategory = Neutrino\TextCategory::create(array( 'title' => 'Global' ));
		
		$textKey = Neutrino\TextKey::create(array( 
			'title' 			=> 'EXAMPLE_TEXT_KEY', 
			'text_category_id' 	=> $textCategory->id
		));
		
		$language = Neutrino\Language::whereCode('en')->first();
		
		Neutrino\TextValue::create(array( 
			'value' 		=> 'Example Text Value', 
			'text_key_id' 	=> $textKey->id,
			'language_id' 	=> $language->id
		));
	}

}
