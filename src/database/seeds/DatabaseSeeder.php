<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\User;
use App\Category;
use App\Question;

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

		$user1 = User::create([
			'username' => 'user',
			'email' => 'user@email.com',
			'password' => '123',
			'firstName' => 'User',
			'lastName' => 'Uno'
		]);

		$user2 = User::create([
			'username' => 'user2',
			'email' => 'user2@email.com',
			'password' => '123',
			'firstName' => 'User',
			'lastName' => 'Dos'
		]);

		$category1 = Category::create([
				'name' => 'Automóviles'
			]);

		$category2 = Category::create([
				'name' => 'Cocina'
			]);


		// 1ra forma
		$article1 = Article::create([
			'title' => 'Mercedes Benz',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.',
			'image' => 'mercedes_benz.png',
			'endDate' => (new DateTime('2015-08-18'))->format('Y-m-d H:i:s'),

			'user_id' => $user1->id,
			'category_id' => $category1->id
		]);

		$article2 = Article::create([
			'title' => 'Audi R8',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.',
			'image' => 'audi.png',
			'endDate' => (new DateTime('2015-09-21'))->format('Y-m-d H:i:s'),

			'user_id' => $user1->id,
			'category_id' => $category1->id
		]);


		$article3 = Article::create([
			'title' => 'BMW nuevito',
			'description' => 'Casi 0km.',
			'image' => 'bmw.png',
			'endDate' => (new DateTime('2016-03-8'))->format('Y-m-d H:i:s'),

			'user_id' => $user1->id,
			'category_id' => $category1->id
		]);

		$article4 = Article::create([
			'title' => 'Mi falcon',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.',
			'image' => 'falcon.png',
			'endDate' => (new DateTime('2015-12-24'))->format('Y-m-d H:i:s'),

			'user_id' => $user1->id,
			'category_id' => $category1->id
		]);


		$article5 = Article::create([
			'title' => 'Palo de amasar',
			'description' => 'Instrumento de represión de masas.',
			'image' => 'palo_de_amasar.png',
			'endDate' => (new DateTime('2016-1-1'))->format('Y-m-d H:i:s'),

			'user_id' => $user1->id,
			'category_id' => $category2->id
		]);

		$question1 = Question::create([
			'text' => 'Tiene aire acondicionado?',
			'user_id' => $user1->id,
			'article_id' => $article1->id
		]);

		$question2 = Question::create([
			'text' => 'Viene con caja de sexta?',
			'user_id' => $user1->id,
			'article_id' => $article2->id
		]);

		$question3 = Question::create([
			'text' => 'De que año es?',
			'user_id' => $user2->id,
			'article_id' => $article1->id
		]);
	}

}
