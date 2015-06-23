<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Article;
use App\User;
use App\Category;
use App\Question;
use App\Offer;

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



		Auth::attempt(['username' => 'user', 'password' => '123']);


		$article1 = Article::forceCreate([
			'title' => 'Mercedes Benz',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.',
			'image' => 'http://clasife.com/oc-content/uploads/0/8_original.jpg',
			'endDate' => date('Y-m-d', strtotime('+20 days')),
			'user_id' => Auth::user()->id,
			'category_id' => $category1->id
		]);

		$article2 = Article::forceCreate([
			'title' => 'Audi R8',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.',
			'image' => 'http://fondosparawhatsapp.net/wp-content/uploads/2014/08/Fondos-de-Audi-R8-en-HD7.jpg',
			'endDate' => date('Y-m-d', strtotime('+20 days')),
			'user_id' => Auth::user()->id,
			'category_id' => $category1->id
		]);

		$article3 = Article::forceCreate([
			'title' => 'BMW nuevito',
			'description' => 'Casi 0km.',
			'image' => 'http://i.ytimg.com/vi/CiTYQ-Zp3AI/maxresdefault.jpg',
			'endDate' => date('Y-m-d', strtotime('+20 days')),
			'user_id' => Auth::user()->id,
			'category_id' => $category1->id
		]);

		$article4 = Article::forceCreate([
			'title' => 'Mi falcon',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.',
			'image' => 'http://sp5.fotolog.com/photo/5/60/9/ogum/1192585585_f.jpg',
			'endDate' => date('Y-m-d', strtotime('+20 days')),
			'user_id' => Auth::user()->id,
			'category_id' => $category1->id
		]);

		$article5 = Article::forceCreate([
			'title' => 'Palo de amasar',
			'description' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.',
			'image' => 'http://mla-s2-p.mlstatic.com/palo-de-amasar-de-madera-ultimo-disponible-4159-MLA2656233743_052012-F.jpg',
			'endDate' => date('Y-m-d', strtotime('+20 days')),
			'user_id' => Auth::user()->id,
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

		$offer1 = Offer::create([
			'text' => 'Me interesa el producto porque soy fanático de los gatos.',
			'card' => 1234567890123456,
			'amount' => 1.0,
			'contact' => '2215529657',
			'user_id' => $user2->id,
			'article_id' => $article1->id
		]);

	}

}
