<?php
class Message {
	private $_id;
	private $_message;
	private $_date_creation;
	private $_date_modification;
	private $_id_utilisateur;
	private $_id_sujet;

	public function __construct(array $donnees){
		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees){
		foreach($donnees as $key => $value){
	   		$method = 'set' . ucfirst($key);

	   		if(method_exists($this, $method)){
	    		$this->$method($value);
	   		}
	  	}
	}

	public function id(){ return $this->_id; }
	public function message(){ return $this->_message; }
	public function date_creation(){ return $this->_date_creation; }
	public function date_modification(){ return $this->_date_modification; }
	public function id_utilisateur(){ return $this->_id_utilisateur; }
	public function id_sujet(){ return $this->_id_sujet; }

	public function setId($id){
		$this->_id = (int) $id;
	}

	public function setMessage($message){
		if(is_string($message)){
			if(strlen($message) <= 1000){
				$this->_message = $message;
			} else {
				$this->_message = substr($message, 0, 1000);
			}
		}
	}

	public function setDate_creation($date_creation){
		$this->_date_creation = $date_creation;
	}

	public function setDate_modification($date_modification){
		$this->_date_modification = $date_modification;
	}

	public function setId_utilisateur($id_utilisateur){
		$this->_id_utilisateur = (int) $id_utilisateur;
	}

	public function setId_sujet($id_sujet){
		$this->_id_sujet = (int) $id_sujet;
	}
}