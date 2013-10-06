<?php namespace Odeva\Masterpoint\Support;

use Illuminate\Support\Str as BaseStr;

class Str extends BaseStr {
	// ğüşiöçı ĞÜŞİÖÇI şĞüİöÇı ŞğÜiÖÇI ıxx ixx Ixx İxx xıx xix xIx xİx
	public static function ucfirstTr($string)
	{
		return mb_convert_case(str_replace(array('i', 'I'),	array('İ', 'ı'), $string), MB_CASE_TITLE, 'UTF-8');
	}
	
	public static function strtoupperTr($string)
	{
		return mb_convert_case(str_replace('i', 'İ', $string), MB_CASE_UPPER, 'UTF-8');
	}
	
	public static function replaceTr($string)
	{
		return str_replace(array('ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü'), array('c', 'g', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'O', 'S', 'U'), $string);
	}

	public static function sanitizeEmail($email)
	{
		$email = iconv("UTF-8", "ISO-8859-1//TRANSLIT", self::replaceTr($email));
		$pos = strpos($email, '@');
		if ($pos !== false) {
			$email = substr($email, 0, $pos).'@'.strtolower(substr($email, $pos+1));
		}
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email = '';
		return $email;
	}
	
	public static function sanitizeUrl($url)
	{
		$url = iconv("UTF-8", "ISO-8859-1//TRANSLIT", self::replaceTr(trim($url)));
		if (!empty($url)) {
			if (stripos($url, 'http://') !== 0 && stripos($url, 'https://') !== 0) $url = 'http://'.$url;
			if (strlen($url)>8) {
				$pos = strpos($url, '/', 8);
				if ($pos === false) $url = strtolower($url);
				else $url = strtolower(substr($url, 0, $pos)).'/'.substr($url, $pos+1);
			}
			$url = filter_var($url, FILTER_SANITIZE_URL);
			if (!filter_var($url, FILTER_VALIDATE_URL)) $url = '';
		}
		return $url;
	}

	public static function randomString($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen($chars);
		$str = '';
		for($i=0; $i<$length; $i++) {
			$str .= $chars[rand(0,$size-1)];
		}
		return $str;
	}
}