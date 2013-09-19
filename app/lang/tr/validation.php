<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "Devam etmek istiyorsanız <strong>':attribute'</strong> alanını kabul etmelisiniz.",
	"active_url"       => "<strong>':attribute'</strong> geçerli bir web adresi değil.",
	"after"            => "<strong>':attribute'</strong> :date sonrası bir tarih olmalıdır.",
	"alpha"            => "<strong>':attribute'</strong> sadece harflerden oluşabilir.",
	"alpha_dash"       => "<strong>':attribute'</strong> sadece harfler rakamlar ve çizgilerden oluşabilir.",
	"alpha_num"        => "<strong>':attribute'</strong> sadece harf ve rakamlardan oluşabilir.",
	"array"            => "<strong>':attribute'</strong> bir dizi olmalıdır.",
	"before"           => "<strong>':attribute'</strong> :date öncesi bir tarih olmalıdır.",
	"between"          => array(
		"numeric" => "<strong>':attribute'</strong> :min ila :max arasında bir sayı olmalıdır.",
		"file"    => "<strong>':attribute'</strong> dosyasının boyutu :min ila :max kilobayt arasında olmalıdır.",
		"string"  => "<strong>':attribute'</strong> :min ila :max arasında karakterden oluşmalıdır.",
		"array"   => "<strong>':attribute'</strong> :min ila :max arasında öğeden oluşmalıdır.",
	),
	"confirmed"        => "<strong>':attribute'</strong> tekrarı ile uyuşmuyor.",
	"date"             => "<strong>':attribute'</strong> değeri geçerli bir tarih değil.",
	"date_format"      => "<strong>':attribute'</strong> değeri :format formatına uymuyor.",
	"different"        => "<strong>':attribute'</strong> ile :other birbirinden farklı olmalıdır.",
	"digits"           => "<strong>':attribute'</strong> :digits basamak olmalıdır.",
	"digits_between"   => "<strong>':attribute'</strong> :min ila :max arasında basamaktan oluşmalıdır.",
	"email"            => "<strong>':attribute'</strong> için geçersiz değer.",
	"exists"           => "<strong>':attribute'</strong> zaten mevcut.",
	"image"            => "<strong>':attribute'</strong> resim türünde olmalıdır.",
	"in"               => "<strong>':attribute'</strong> için geçersiz değer.",
	"integer"          => "<strong>':attribute'</strong> tamsayı olmalıdır.",
	"ip"               => "<strong>':attribute'</strong> geçerli bir IP adresi olmalıdır.",
	"max"              => array(
		"numeric" => "<strong>':attribute'</strong> :max değerinden büyük olamaz.",
		"file"    => "<strong>':attribute'</strong> :max kilobayttan fazla olamaz.",
		"string"  => "<strong>':attribute'</strong> :max karakterden uzun olamaz.",
		"array"   => "<strong>':attribute'</strong> :max öğeden fazla olamaz.",
	),
	"mimes"            => "<strong>':attribute'</strong> dosyası :values tipinde olmalıdır.",
	"min"              => array(
		"numeric" => "<strong>':attribute'</strong> :min değerinden küçük olamaz.",
		"file"    => "<strong>':attribute'</strong> :min kilobayttan az olamaz.",
		"string"  => "<strong>':attribute'</strong> :min karakterden kısa olamaz.",
		"array"   => "<strong>':attribute'</strong> :min öğeden az olamaz.",
	),
	"not_in"           => "<strong>':attribute'</strong> için geçersiz değer.",
	"numeric"          => "<strong>':attribute'</strong> numerik bir değer olmalıdır.",
	"regex"            => "<strong>':attribute'</strong> için geçersiz format.",
	"required"         => "<strong>':attribute'</strong> gerekli bir alandır.",
	"required_if"      => "<strong>':attribute'</strong>, :other olarak :value seçildiğinde gereklidir.",
	"required_with"    => "<strong>':attribute'</strong>, :values bulunduğunda gereklidir.",
	"required_without" => "<strong>':attribute'</strong>, :values olmadığında gereklidir.",
	"same"             => "<strong>':attribute'</strong> ile :other alanı aynı olmalıdır.",
	"size"             => array(
		"numeric" => "<strong>':attribute'</strong> :size olmalıdır.",
		"file"    => "<strong>':attribute'</strong> :size kilobayt olmalıdır.",
		"string"  => "<strong>':attribute'</strong> :size karakter olmalıdır.",
		"array"   => "<strong>':attribute'</strong> :size adet öğeden oluşmalıdır.",
	),
	"unique"           => "<strong>':attribute'</strong> zaten kayıtlı.",
	"url"              => "<strong>':attribute'</strong> geçersiz bir web adresi.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
	),

);
