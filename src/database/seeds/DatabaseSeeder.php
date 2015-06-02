<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$admin = User::create([
			'username' => 'admin',
			'email' => 'admin@bestnid.com',
			'password' => 'b3stn1d*',
			'firstName' => 'Admin',
			'lastName' => 'Admin',
			'role' => 'admin'
		]);

		$user = User::create([
			'username' => 'user',
			'email' => 'user@email.com',
			'password' => '123',
			'firstName' => 'User',
			'lastName' => 'Uno'
		]);


		// 1ra forma
		Article::create([
			'name' => 'Articulo 1',
			'user_id' => $user->id
		]);

		// 2da forma
		$a2 = new Article;
		$a2->name = 'Articulo 2';
		$user->articles()->save($a2);

		// 3ra forma
		$a3 = new Article;
		$a3->name = 'Articulo 3';
		$a3->user()->associate($user);
		$a3->save();

		// $this->call('UserTableSeeder');
	}

}
