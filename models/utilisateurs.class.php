<?php

class Utilisateurs 
{

	private $idUtilisateur;
	private $identifiant;
	private $motDePasse;
	private $email;
	private $numTel;
	private $description;
	private $photo;
	private $dateNaissance;

	///////////////////////////////////////////////////////
	///  CONSTRUCTEUR
	///////////////////////////////////////////////////////


		/**
		 * constructeur
		 * @param int $idUtilisateur
		 */
		function __construct($idUtilisateur)
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("select * from utilisateurs where idUtilisateur = :idUtilisateur;");
			$stmt->bindParam(":idUtilisateur", $idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();
			$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$this->idUtilisateur = $idUtilisateur;
			$this->identifiant = $utilisateur['identifiantUtilisateur'];
			//$this->motDePasse = $utilisateur['motDePasseUtilisateur'];
			$this->email = $utilisateur['emailUtilisateur'];
			$this->numTel = $utilisateur['numTelUtilisateur'];
			$this->description = $utilisateur['descriptionUtilisateur'];
			$this->photo = $utilisateur['photoUtilisateur'];
			$this->dateNaissance = $utilisateur['dateNaissanceUtilisateur'];
		}


	///////////////////////////////////////////////////////
	///  TOSTRING
	///////////////////////////////////////////////////////
		/**
		 * Renvoie l'identifiant d'un utilisateur
		 * @return identifiant
		 */
		function __toString()
		{
			return "".$this->identifiant;
		}


	///////////////////////////////////////////////////////
	///  GETTERS
	///////////////////////////////////////////////////////

	    /**
	     * Renvoie la valeur de idUtilisateur.
	     * @return idUtilisateur
	     */
	    public function getIdUtilisateur()
	    {
	        return $this->idUtilisateur;
	    }

	    /**
	     * Renvoie la valeur de identifiant.
	     * @return identifiant
	     */
	    public function getIdentifiant()
	    {
	        return $this->identifiant;
	    }

	    /**
	     * Renvoie la valeur de email.
	     * @return email
	     */
	    public function getEmail()
	    {
	        return $this->email;
	    }

	    /**
	     * Renvoie la valeur de numTel.
	     * @return numTel
	     */
	    public function getNumTel()
	    {
	        return $this->numTel;
	    }

	    /**
	     * Renvoie la valeur de description.
	     * @return description
	     */
	    public function getDescription()
	    {
	        return $this->description;
	    }

	    /**
	     * Renvoie la valeur de photo.
	     * @return photo
	     */
	    public function getPhoto()
	    {
	        return $this->photo;
	    }
	    /**
	     * Renvoie la valeur de la date de naissance.
	     * @return dateNaissance
	     */
	    public function getDateNaissance()
	    {
	        return $this->dateNaissance;
	    }


	///////////////////////////////////////////////////////
	///  SETTERS
	///////////////////////////////////////////////////////

	    /**
	     * Change la valeur de identifiant.
	     * @param string identifiant
	     * @return utilisateur
	     */
	    public function setIdentifiant($identifiant)
	    {
	        $this->identifiant = $identifiant;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set identifiantUtilisateur = :identifiant  where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    /**
	     * Change la valeur de motDePasse.
	     * @param string motdepasse
	     * @return utilisateur
	     */
	    public function setMotDePasse($motDePasse)
	    {
	        $this->motDePasse = sha1($motDePasse.GDS);
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set motDePasseUtilisateur = :motDePasse where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("motDePasse", $motDePasse, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    /**
	     * Change la valeur de email.
	     * @param string email
	     * @return utilisateur
	     */
	    public function setEmail($email)
	    {
	        $this->email = $email;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set emailUtilisateur = :emailUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("emailUtilisateur", $email, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    /**
	     * Change la valeur de numTel.
	     * @param string numtel
	     * @return utilisateur
	     */
	    public function setNumTel($numTel=null)
	    {
	        $this->numTel = $numTel;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set numTelUtilisateur = :numTelUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("numTelUtilisateur", $numTel, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);

			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    /**
	     * Change la valeur de description.
	     * @param string description
	     * @return utilisateur
	     */
	    public function setDescription($description=null)
	    {
	        $this->description = $description;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set descriptionUtilisateur = :descriptionUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("descriptionUtilisateur", $description, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    /**
	     * Change la valeur de photo.
	     * @param string photo
	     * @return utilisateur
	     */
	    public function setPhoto($photo)
	    {
	        $this->photo = $photo;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set photoUtilisateur = :photoUtilisateur  where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("photoUtilisateur", $photo, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }

	    /**
	     * Change la valeur de la date de naissance.
	     * @param date dateNaissance
	     * @return utilisateur
	     */
	    public function setDateNaissance($dateNaissance=null)
	    {
	        $this->dateNaissance = $dateNaissance;
	        $dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("update utilisateurs set dateNaissanceUtilisateur = :dateNaissanceUtilisateur where idUtilisateur = :idUtilisateur");
			
			$stmt->bindParam("dateNaissanceUtilisateur", $dateNaissance, PDO::PARAM_STR);
			$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_INT);
			$stmt->execute();

			$utilisateur = $stmt->fetch();
			$stmt->closeCursor();

	        return $this;
	    }


	///////////////////////////////////////////////////////
	///  METHODES
	///////////////////////////////////////////////////////

	/**
	 * Créé un utilisateur
	 * @param string identifiant 
	 * @param string motDePasse 
	 * @param string email 
	 * @param string numTel 
	 * @param string description 
	 * @param string photo 
	 * @return int idUtilisateur
	 */
	public static function createUtilisateur($identifiant, $motDePasse, $email, $numTel=null, $description=null, $photo="default.png", $dateNaissance=null)
	{
		// Vérification de l'email et du numéro de téléphone et sha1 du motdepasse?
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("insert into utilisateurs (identifiantUtilisateur, motDePasseUtilisateur, emailUtilisateur, numTelUtilisateur, descriptionUtilisateur, photoUtilisateur, dateNaissanceUtilisateur) values (:identifiant, :motDePasse, :email, :numTel, :description, :photo, :dateNaissance);");
		
		$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
		$stmt->bindParam("motDePasse", $motDePasse, PDO::PARAM_STR);
		$stmt->bindParam("email", $email, PDO::PARAM_STR);
		$stmt->bindParam("numTel", $numTel, PDO::PARAM_STR);
		$stmt->bindParam("description", $description, PDO::PARAM_STR);
		$stmt->bindParam("photo", $photo, PDO::PARAM_STR);
		$stmt->bindParam("dateNaissance", $dateNaissance, PDO::PARAM_STR);

		$stmt->execute();
		$stmt->closeCursor();
		// A vérifier, dernière id inséré = id de l'utilisateur créé
		return $dbh->lastInsertId();
	}

	/**
	 * suppression d'un compte utilisateur
	 * @param int idUtilisateur 
	 */
	public static function supprimerUtilisateur($idUtilisateur)
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("delete from utilisateurs where idUtilisateur = :idUtilisateur");
		
		$stmt->bindParam("idUtilisateur", $idUtilisateur, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->closeCursor();
	}

	/**
	 * Connexion d'un utilisateur
	 * @param string $identifiant 
	 * @param string $motDePasse 
	 * @return int 
	 */
	public static function connexion($identifiant, $motDePasse)
	{	
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idUtilisateur from utilisateurs where identifiantUtilisateur = :identifiant and motDePasseUtilisateur = :motDePasse");
		
		$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
		$stmt->bindParam("motDePasse", $motDePasse, PDO::PARAM_STR);
		$stmt->execute();

		$utilisateur = $stmt->fetch();
		$stmt->closeCursor();

		if(!empty($utilisateur))
		{
			// retourne l'identifiant de l'utilisateur connecté avec cet identifiant et ce mot de passe
			$idUtilisateur = $utilisateur['idUtilisateur'];
		} else {
			// retourne 0 si il n'y a pas d'utilisateur avec cet identifiant et ce mot de passe
			$idUtilisateur = 0;
		}
		return $idUtilisateur;
	}


	/**
	 * Renvoie true si l'email est déja utilsé
	 * @param string email 
	 * @return bool 
	 */
	public static function existeEmail($email)
	{	
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select * from utilisateurs where emailUtilisateur = :email");
		
		$stmt->bindParam("email", $email, PDO::PARAM_STR);
		$stmt->execute();

		$number = $stmt->fetch();
		$stmt->closeCursor();

		return !empty($number);
	}

	/**
	 * Renvoie true si l'identifiant est déja utilsé
	 * @param string identifiant 
	 * @return bool 
	 */
	public static function existeIdentifiant($identifiant)
	{	
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select * from utilisateurs where identifiantUtilisateur = :identifiant");
		
		$stmt->bindParam("identifiant", $identifiant, PDO::PARAM_STR);
		$stmt->execute();

		$number = $stmt->fetch();
		$stmt->closeCursor();

		return !empty($number);
	}

	/**
	 * Récupère tous les messages d'un utilisateur
	 * @return array[messages]
	 */
	public function getAllMessagesFromUser()
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idMessage from messages where idUtilisateur = :idUtilisateur order by dateMessage desc");
		
		$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_STR);
		$stmt->execute();

		$messages = array();

		$resultat = $stmt->fetchAll();
		foreach ($resultat as $row) {
		    array_push($messages, new Messages($row['idMessage']));
		}
		$stmt->closeCursor();

		return $messages;
	}

	/**
	 * Renvoie tous les messages que l'utlisateur peut voir
	 * @return array[messages]
	 */
	public function getAllMessagesVisibles()
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idMessage, dateMessage from messages where idUtilisateur = :idUtilisateur or idUtilisateur in (select idUtilisateurSuivi from suivre where idUtilisateurSuivant = :idUtilisateur) order by dateMessage desc");
		
		$stmt->bindParam("idUtilisateur", $this->idUtilisateur, PDO::PARAM_STR);
		$stmt->execute();

		$messages = array();

		$resultat = $stmt -> fetchAll();
		foreach ($resultat as $row) {
		    array_push($messages, new Messages($row['idMessage']));
		}
		$stmt->closeCursor();

		return $messages;
	}


	/**
	 * Renvoie tous les utilisateurs
	 * @return array[utilisateurs]
	 */
	public static function getAllUtilisateurs()
	{
		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("select idUtilisateur from utilisateurs order by identifiantUtilisateur");
		
		$stmt->execute();

		$utilisateurs = $stmt -> fetchAll(PDO::FETCH_ASSOC);

		$stmt->closeCursor();

		return $utilisateurs;
	}


}