<?php
class Connexion {
	private $_db;

	public function connexion(){
		$options = array(
	   		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	   		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	   		PDO::ATTR_PERSISTENT => true
		);

	    $this->_db = new PDO('mysql:host=localhost;dbname=forum;charset=utf8', 'root', '', $options);
	    
	    return $this->_db;
	}
}