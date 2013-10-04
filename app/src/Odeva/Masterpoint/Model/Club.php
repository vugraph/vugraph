<?php namespace Odeva\Masterpoint\Model;

use Request;

class Club extends Model {

	protected $table = 'clubs';
	
	protected $fillable = array('city_id', 'name', 'shortname', 'address', 'phone', 'fax', 'email', 'website');

	protected $rules = array(
		'city_id'	=> 'required',
		'name'		=> 'required',
		'shortname'	=> 'max:15',
		'email'		=> 'email',
		'website'	=> 'url'
	);
	
//	public function region()
//	{
//		return $this->belongsTo('Region');
//	}
//
	public function city()
	{
		return $this->belongsTo(__NAMESPACE__.'\City');
	}
	
	protected function joinCities($rset = null)
	{
		if (is_null($rset)) $rset = $this->newQuery();
		return $rset->join('cities', 'clubs.city_id', '=', 'cities.id');
	}
	
	protected function processQueryString()
	{
		parent::processQueryString();
		if (!is_null($city = intval(Request::query('city', '0'))) && $city > 0) $this->filters['clubs.city_id'] = $city;
	}
	
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