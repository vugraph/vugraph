<?php namespace Odeva\Masterpoint\Model;

class Player extends Model {

	protected $table = 'players';
	
	protected $fillable = array('licence_no', 'name', 'first_name', 'last_name', 'father', 'mother', 'city_id', 'birth_date', 'birth_place',
		'education_status', 'club_id', 'gender', 'email', 'ssn', 'address', 'postal_code', 'phone');

	protected $rules = array(
		'licence_no'		=> 'required|regex:/^[0-9]{6}$/',
		'name'				=> 'required',
		'first_name'		=> 'required',
		'last_name'			=> 'required',
		'father'			=> 'required',
		'mother'			=> 'required',
		'city_id'			=> 'required|integer|min:1',
		'birth_date'		=> 'required|date_format:Y-m-d',
		'birth_place'		=> 'required',
		'education_status'	=> 'required|integer|min:1',
		'club_id'			=> 'integer|min:1',
		'gender'			=> 'required|in:F,M',
		'email'				=> 'email',
		'ssn'				=> 'required|integer',
		'address'			=> '',
		'postal_code'		=> 'regex:/^[0-9]{5}$/',
		'phone'				=> ''
	);
	
	public function club()
	{
		return $this->belongsTo(__NAMESPACE__.'\Club');
	}
	
	public function title()
	{
		return $this->belongsTo(__NAMESPACE__.'\Title');
	}
	
	public function checkSSN($ssn = null)
	{
		if (is_null($ssn)) $ssn = $this->ssn;
		$ssn = (string) $ssn;
		if (!preg_match('/^[1-9][0-9]{10}$/', $ssn)) return false;
		$sum1 = $ssn[0]+$ssn[2]+$ssn[4]+$ssn[6]+$ssn[8];
		$sum2 = $ssn[1]+$ssn[3]+$ssn[5]+$ssn[7];
		if ((7*$sum1+9*$sum2) % 10 !== (int)$ssn[9]) return false;
		if (8*$sum1 % 10 !== (int)$ssn[10]) return false;
		return true;
	}
		
}