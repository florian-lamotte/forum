<?php
class Sujet {
	private $_id;
	private $_titre;
	private $_date_creation;
	private $_id_utilisateur;

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
	public function titre(){ return $this->_titre; }
	public function date_creation(){ return $this->_date_creation; }
	public function id_utilisateur(){ return $this->_id_utilisateur; }

	public function setId($id){
		$this->_id = (int) $id;
	}

	public function setTitre($titre){
		if(is_string($titre) && strlen($titre) <= 255){
			$this->_titre = $titre;
		}
	}

	public function setDate_creation($date_creation){
		$this->_date_creation = $date_creation;
	}

	public function setId_utilisateur($id_utilisateur){
		$this->_id_utilisateur = (int) $id_utilisateur;
	}
}