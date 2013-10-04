<?php

use Odeva\Masterpoint\Model\Title;

class TitlesTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('titles')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		Title::create(array('id' => 1, 'name' => 'Kulüp Ustası'));
		Title::create(array('id' => 2, 'name' => 'Bölge Ustası'));
		Title::create(array('id' => 3, 'name' => 'Bronz Usta'));
		Title::create(array('id' => 4, 'name' => 'Gümüş Usta'));
		Title::create(array('id' => 5, 'name' => 'Altın Usta'));
		Title::create(array('id' => 6, 'name' => 'Bronz Büyük Usta'));
		Title::create(array('id' => 7, 'name' => 'Gümüş Büyük Usta'));
		Title::create(array('id' => 8, 'name' => 'Altın Büyük Usta'));
	}

}
