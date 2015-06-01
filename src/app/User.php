<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable {

	use AuthenticableTrait;

	public function articles() {
		return $this->hasMany('App\Article');
	}

	public function getFullName() {
		return $this->firstName . ' ' . $this->lastName;
	}
}
