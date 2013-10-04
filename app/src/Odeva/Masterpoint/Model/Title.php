<?php namespace Odeva\Masterpoint\Model;

class Title extends Model {

	public $incrementing = false;
	
	protected $table = 'titles';

	protected $fillable = array('id', 'name');
	
}