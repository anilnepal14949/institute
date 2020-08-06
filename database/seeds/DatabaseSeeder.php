<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use ProIMAN\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('UserTypeSeeder');
		$this->call('UserLevelSeeder');
		$this->call('UserDetailSeeder');
		$this->call('UserSeeder');
		$this->call('StatusSeeder');
	}

}
class UserTypeSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('pro_users_type')->delete();
		DB::insert('insert into pro_users_type (title) values (?)', ['Administrator']);
		DB::insert('insert into pro_users_type (title) values (?)', ['Staff']);
		DB::insert('insert into pro_users_type (title) values (?)', ['Student']);
		DB::insert('insert into pro_users_type (title) values (?)', ['Referer']);
	}

}
class UserLevelSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('pro_users_level')->delete();
		DB::insert('insert into pro_users_level (title) values (?)', ['Administrator']);
		DB::insert('insert into pro_users_level (title) values (?)', ['Accountant']);
		DB::insert('insert into pro_users_level (title) values (?)', ['Teacher']);
		DB::insert('insert into pro_users_level (title) values (?)', ['Student']);
	}

}

class UserDetailSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('pro_users_detail')->delete();
		DB::insert('insert into pro_users_detail (name, address, contact, email, gender, user_type) values (?, ?, ?, ?, ?, ?)', ['admin','kathmandu','9819254695','mg_vtx@yahoo.com','m','1']);
	}

}
class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		User::truncate();
		User::create(array(
			'username' => 'admin',
			'email' => 'mg_vtx@yahoo.com',
			'password' => bcrypt('admin123'),//Hash::make('admin123'),
			'user_id' => '1'
		));
	}

}
class StatusSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('pro_status')->delete();
		DB::table('pro_status')->insert([
			['name' => 'Running', 'description' => 'Running.'],
			['name' => 'On Hold', 'description' => 'Temporary Halt.'],
			['name' => 'Pending', 'description' => 'Will be started soon.'],
			['name' => 'Closed', 'description' => 'Completed.']
		]);
	}

}