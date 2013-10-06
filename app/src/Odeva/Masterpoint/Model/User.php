<?php namespace Odeva\Masterpoint\Model;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser {

	protected $rules = array(
		'first_name'			=> 'required|between:2,30',
		'last_name'				=> 'required|between:2,30',
		'email'					=> 'required|email',
		'password'				=> 'between:6,30',
	);

//	protected function processQueryString()
//	{
//		parent::processQueryString();
//		if (!is_null($city = intval(Request::query('city', '0'))) && $city > 0) $this->filters['clubs.city_id'] = $city;
//	}
	
	public function autoPaginate()
	{
		$this->fields = array(
			'id' => 'clubs.id',
			'city_name' => 'cities.name',
			'shortname' => 'clubs.shortname',
			'name' => 'clubs.name'
		);
		$this->processQueryString();
		return $this->getPagination($this->joinCities());
	}

}