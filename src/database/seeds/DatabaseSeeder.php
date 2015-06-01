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

		$user = User::create([
			'username' => 'user1',
			'email' => 'user1@email.com',
			'password' => Hash::make('123'),
			'birthdate' => date('now'),
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
