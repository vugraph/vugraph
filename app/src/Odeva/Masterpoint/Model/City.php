<?php namespace Odeva\Masterpoint\Model;

/**
 * An Eloquent Model: 'City'
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $code
 * @property-read \Region $region
 */
class City extends Model {

	protected $table = 'cities';

	public $timestamps = false;

	public function region()
	{
		return $this->belongsTo('Region');
	}

}