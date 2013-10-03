<?php namespace Odeva\Masterpoint\Support;

use Illuminate\Support\Str as BaseStr;

class Str extends BaseStr {
	// ğüşiöçı ĞÜŞİÖÇI şĞüİöÇı ŞğÜiÖÇI ıxx ixx Ixx İxx xıx xix xIx xİx
	public static function ucfirst_tr($string)
	{
		return mb_convert_case(str_replace(array('i', 'I'),	array('İ', 'ı'), $string), MB_CASE_TITLE, 'UTF-8');
	}
}