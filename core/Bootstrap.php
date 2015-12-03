<?php 
// namespace vng\core;

/**
 *
 */
class Bootstrap {

	function __construct($routes) {

		$this->routes = $routes;

		$this->db = new Database();

		$this->map();
	}

	public function map() {
		if ($this->routes[0] === "" && empty($this->routes[1])) {

			$home = new Home();
			return $home->index();

		} elseif ("" !== $this->routes[0] && !isset($this->routes[1])) {

			$className = ucfirst($this->routes[0]);

			$c = new $className( $this->db );
			return $c->index();

		} elseif ("" !== $this->routes[0] && $this->routes[1] !== "" && !isset($this->routes[2])) {

			$className = ucfirst($this->routes[0]);
			$method = strtolower($this->routes[1]);

			$c = new $className($this->db);
			return $c->$method($con = null);

		} elseif ("" !== $this->routes[0] && $this->routes[1] !== "" && $this->routes[2] !== "") {

			$className = ucfirst($this->routes[0]);
			$method = strtolower($this->routes[1]);

			$c = new $className();
			return $c->$method($this->routes[2]);

		}
	}

}