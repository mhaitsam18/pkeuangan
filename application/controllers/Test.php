<?php 

class Test extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index($params = 0)
	{
		self::_jumlah(4);
	}

	function _loop($params = 0)
	{
		for ($i=1; $i <= $params; $i++) { 
			echo $i.'<br>';
		}
	}

	function _jumlah($params = 0){
		$jumlah = 0;
		for ($i=1; $i <= $params; $i++) { 
			$jumlah += $i;
		}
		echo $jumlah;
	}

	function _kuadrat($params = 0){
		$mod = 0; $kuadrat = 0;

		for ($i=1; $i <= $params; $i++) { 
			$mod = $i%2;
			if($mod == 0){
				
			}
		}
	}
}