<?php namespace Odeva\Masterpoint\Model;

class City extends Model {

	public $incrementing = false;
	
	protected $table = 'cities';

	protected $fillable = array('region_id', 'name');

	public function region()
	{
		return $this->belongsTo(__NAMESPACE__.'\Region');
	}
	

}