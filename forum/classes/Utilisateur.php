<?php
class Utilisateur {
	private $_id;
	private $_pseudo;
	private $_email;
	private $_pass;
	private $_avatar;
	private $_date_creation;
	private $_id_droit;

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
	public function pseudo(){ return $this->_pseudo; }
	public function email(){ return $this->_email; }
	public function pass(){ return $this->_pass; }
	public function avatar(){ return $this->_avatar; }
	public function date_creation(){ return $this->_date_creation; }
	public function id_droit(){ return $this->_id_droit; }

	public function setId($id){
		$this->_id = (int) $id;
	}

	public function setPseudo($pseudo){
		if(is_string($pseudo) && strlen($pseudo) <= 50){
			$this->_pseudo = $pseudo;
		}
	}

	public function setEmail($email){
		$this->_email = $email;
	}

	public function setPass($pass){
		$this->_pass = $pass;
	}

	public function setAvatar($avatar){
		$this->_avatar = $avatar;
	}

	public function setDate_creation($date_creation){
		$this->_date_creation = $date_creation;
	}

	public function setId_droit($id_droit){
		$this->_id_droit = (int) $id_droit;
	}
}