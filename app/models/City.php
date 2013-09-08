<?php namespace Tbfmp;

/**
 * An Eloquent Model: 'City'
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 * @property-read \Region $region
 */
class City extends BaseModel {

	protected $table = 'cities';

	public $timestamps = false;

	public function region()
	{
		return $this->belongsTo('Region');
	}

}