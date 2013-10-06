<?php namespace Odeva\Masterpoint\Controller\Site;

class Home extends Site {

	public function getIndex()
	{
		$this->nest('home');
	}
	
	public function missingMethod($parameters)
	{
		$this->withError('Missing Method at '.__METHOD__.'<br>Parameters:'.print_r($parameters, true));
		$this->nest('result');
	}
	
}