<?php namespace Odeva\Masterpoint\Model;

/**
 * An Eloquent Model: 'Club'
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 * @property string $shortname
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $director1
 * @property string $director2
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $user_id
 * @property integer $old_id
 * @property-read \Region $region
 * @property-read \City $city
 */

use Request;

class Club extends Model {

	protected $table = 'clubs';
	
	protected $softDelete = true;

//	public function region()
//	{
//		return $this->belongsTo('Region');
//	}
//
	public function __construct()
	{
		parent::__construct();
	}
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