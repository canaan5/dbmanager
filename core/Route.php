<?php

/**
* 
*/
class Route
{
	
	private $_uri = [];
	private $_method = [];


	public function add($uri, $method = null)
	{
		$this->_uri[] = '/' . trim($uri, '/');

		if ( $method != null )
			$this->_method[] = $method;
	}

	public function submit()
	{
		$uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';

		foreach ($this->_uri as $key => $value) {
			
			if ( preg_match("#^$value$#", $uriGetParam) )
			{
				if ( is_string($this->_method[$key]) )
				{
					$useMethod = ucfirst($this->_method[$key]);

					$useMethod = explode('@', $useMethod);

					if ( isset($useMethod[0]) && isset($useMethod[1]))
					{
						$cls = new $useMethod[0]();

						return $cls->$useMethod[1]();

					} else {
						
						$cls = new $useMethod[0]();
						return $cls->index();
					}

				} else {

					call_user_func($this->_method[$key]);
				}
				
			}
		}
	}
}