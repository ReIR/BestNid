<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\User;
use App\Category;

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

		$category1 = Category::create([
				'name' => 'Automóviles'
			]);

		$category2 = Category::create([
				'name' => 'Cocina'
			]);


		// 1ra forma
		Article::create([
			'title' => 'Mercedes Benz',
			'description' => 'Acá está mi auto re pillo.',
			'image' => 'mercedes_benz.png',
			'endDate' => (new DateTime('2015-08-18'))->format('Y-m-d H:i:s'),

			'user_id' => $user->id,
			'category_id' => $category1->id
		]);

		Article::create([
			'title' => 'Audi R8',
			'description' => 'Mi auto es mucho mejor.',
			'image' => 'audi.png',
			'endDate' => (new DateTime('2015-09-21'))->format('Y-m-d H:i:s'),

			'user_id' => $user->id,
			'category_id' => $category1->id
		]);


		Article::create([
			'title' => 'BMW nuevito',
			'description' => 'Casi 0km.',
			'image' => 'bmw.png',
			'endDate' => (new DateTime('2016-03-8'))->format('Y-m-d H:i:s'),

			'user_id' => $user->id,
			'category_id' => $category1->id
		]);

		Article::create([
			'title' => 'Mi falcon',
			'description' => 'Todavia anda.',
			'image' => 'falcon.png',
			'endDate' => (new DateTime('2015-12-24'))->format('Y-m-d H:i:s'),

			'user_id' => $user->id,
			'category_id' => $category1->id
		]);


		Article::create([
			'title' => 'Palo de amasar',
			'description' => 'Instrumento de represión de masas.',
			'image' => 'palo_de_amasar.png',
			'endDate' => (new DateTime('2016-1-1'))->format('Y-m-d H:i:s'),

			'user_id' => $user->id,
			'category_id' => $category2->id
		]);

	}

}
