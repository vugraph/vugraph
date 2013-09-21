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
class Club extends Model {

	protected $table = 'clubs';
	
	protected $softDelete = true;

//	public function region()
//	{
//		return $this->belongsTo('Region');
//	}
//
	public function city()
	{
		return $this->belongsTo('Tbfmp\City');
	}

}