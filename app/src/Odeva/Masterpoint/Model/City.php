<?php namespace Odeva\Masterpoint\Model;

class City extends Model {

	protected $table = 'cities';

	public $incrementing = false;
	
	protected $fillable = array('region_id', 'name');

	public function region()
	{
		return $this->belongsTo(__NAMESPACE__.'\Region');
	}
	

}