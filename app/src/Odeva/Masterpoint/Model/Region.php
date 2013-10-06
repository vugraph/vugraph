<?php namespace Odeva\Masterpoint\Model;

class Region extends Model {

	protected $table = 'regions';

	public $incrementing = false;
	
	protected $fillable = array('name');
	
}