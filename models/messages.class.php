<?php
/**
 * @author    Antoine Mady
 * Cette classe gère la table "Messages" de la base de données et propose quelques méthodes utiles.
 */

class Messages 
{
	/** 
	 * identifiant du message
	 * @var [int] idMessage
	 */
	private $idMessage;
	/** 
	 * Correspond à la date du message, mis en place par la base de donnée
	 * @var [date] dateMessage
	 */
	private $dateMessage;
	/** 
	 * texte du message écrit par l'utilisateur
	 * @var [string] texteMessage
	 */
	private $texteMessage;
	/** 
	 * identifiant de l'auteur du message
	 * @var [int] idUtilisateur
	 */
	private $idUtilisateur;

	///////////////////////////////////////////////////////
	///  CONSTRUCTEUR
	///////////////////////////////////////////////////////

		/**
		 * constructeur
		 * @param int $idMessage
		 */
		function __construct($idMessage)
		{
			$dbh = SPDO::getInstance();
			$stmt = $dbh->prepare("select * from messages where idMessage = :idMessage;");
			$stmt->bindParam(":idMessage", $idMessage, PDO::PARAM_INT);
			$stmt->execute();
			$message = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			$this->idMessage = $idMessage;
			$this->dateMessage = $message['dateMessage'];
			$this->texteMessage = $message['texteMessage'];
			$this->idUtilisateur = $message['idUtilisateur'];
		}


	///////////////////////////////////////////////////////
	///  TOSTRING
	///////////////////////////////////////////////////////
	
		/**
		 * override de la méthode toString
		 * @return texte du message
		 */
		function __toString()
		{
			return $this->texteMessage;
		}



	///////////////////////////////////////////////////////
	///  GETTERS
	///////////////////////////////////////////////////////
	
	    /**
	     * Renvoie la valeur de idMessage.
	     * @return idMessage
	     */
	    public function getIdMessage()
	    {
	        return $this->idMessage;
	    }

	    /**
	     * Renvoie la valeur de date.
	     * @return dateMessage
	     */
	    public function getDateMessage()
	    {
	        return $this->dateMessage;
	    }

	    /**
	     * Renvoie la valeur de texte.
	     * @return texteMessage
	     */
	    public function getTexteMessage()
	    {
	        return $this->texteMessage;
	    }

	    /**
	     * Renvoie la valeur de idUtilisateur.
	     * @return idUtilisateur
	     */
	    public function getIdUtilisateur()
	    {
	        return $this->idUtilisateur;
	    }


	///////////////////////////////////////////////////////
	///  SETTERS
	///////////////////////////////////////////////////////

	    /**
	     * Change la valeur de idMessage.
	     * @param int idMessage
	     * @return message
	     */
	    private function setIdMessage($idMessage)
	    {
	        $this->idMessage = $idMessage;
	        return $this;
	    }

	    /**
	     * Change la valeur de date.
	     * @param string date
	     * @return message
	     */
	    private function setDateMessage($dateMessage)
	    {
	        $this->dateMessage = $dateMessage;
	        return $this;
	    }

	    /**
	     * Change la valeur de texte.
	     * @param string texte
	     * @return message
	     */
	    private function setTexteMessage($texteMessage)
	    {
	        $this->texteMessage = $texteMessage;
	        return $this;
	    }

	    /**
	     * Change la valeur de idUtilisateur.
	     * @param string idUtilisateur
	     * @return message
	     */
	    private function setIdUtilisateur($idUtilisateur)
	    {
	        $this->idUtilisateur = $idUtilisateur;
	        return $this;
	    }

	///////////////////////////////////////////////////////
	///  METHODES
	///////////////////////////////////////////////////////


	/**
	 * Créer un message, retourne l'id du message ansi créé
	 * @param string texteMessage 
	 * @param int idUtilisateur 
	 * @return int idMessage
	 */
	public static function createMessage($texteMessage, $idUtilisateur)
	{
		// Vérification du texte en non HTML et non SQL?

		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("insert into messages (texteMessage, idUtilisateur) values (:texteMessage, :idUtilisateur);");
		
		$stmt->bindParam("texteMessage", utf8_encode($texteMessage), PDO::PARAM_STR);
		$stmt->bindParam("idUtilisateur", $idUtilisateur, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->closeCursor();

		// A vérifier, dernière id inséré = id du message créé
		return $dbh->lastInsertId();
	}

	/**
	 * Supprime un message
	 * @param int idMessage 
	 */
	public static function supprimerMessage($idMessage)
	{
		// Vérification du texte en non HTML et non SQL?

		$dbh = SPDO::getInstance();
		$stmt = $dbh->prepare("delete from messages where idMessage = :idMessage;");
		
		$stmt->bindParam("idMessage", $idMessage, PDO::PARAM_INT);

		$stmt->execute();
		$stmt->closeCursor();
	}

	/**
	 * Affiche un message, en prenant en compte l'encodage, le html et les emoticones
	 * @param string message 
	 * @return string message
	 */
	public static function afficheMessage($message)
	{

		// on remplace le <3 pour éviter le htmlspecialchar
		$message = str_replace('<3', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx3', $message);

		$emoticone = Array(
			//content
			":)",
			"=)",
			//pas content
			":(",
			"=(",
			//très content! en rire!
			"=(",
			"=(",
			//confus
			":(",
			"=(",
			//en larmes
			";(",
			// étonné
			":o",
			":O",
			"=o",
			"=O",
			// ^^
			"^^",
			// coeur
			// le coeur est d'abord remplacé par 150 x car < est un htmlspecialchar
			// 150 caractères car l'utilisateur ne peut mettre que 140 caractères
			"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx3",
			// irrité
			"X|",
			"x|",
			// irrité 2
			"xD",
			"XD",
			"Xd",
			"xd",
			// euh quoi?
			"x/",
			"X/",
			//surpris
			"oO",
			"o_O",
			//supris mais dans l'autre sens, j'avoue, j'éxagère!
			"Oo",
			"O_o",
			//fatigué
			"-_-",
			//tire langue
			":p",
			"=p",
			":P",
			"=P",
			//tire langue, mort?
			"XP",
			"xP",
			"Xp",
			"xp",
			//ca craint
			":/", 
			"=/", 
			//clin d'oeil
			";)",
			//clin d'oeil sourire
			";D",
			";d",
			//clin d'oeil tire langue
			";p",
			";P"
		);

		$imageOfEmoticone = Array(
			//content
			"<img src='global/img/emoticone/smiling.png'>",
			"<img src='global/img/emoticone/smiling.png'>",
			//pas content
			"<img src='global/img/emoticone/frowning.png'>",
			"<img src='global/img/emoticone/frowning.png'>",
			//très content! en rire!
			"<img src='global/img/emoticone/grinning.png'>",
			"<img src='global/img/emoticone/grinning.png'>",
			//confus
			"<img src='global/img/emoticone/confused.png'>",
			"<img src='global/img/emoticone/confused.png'>",
			//en larme
			"<img src='global/img/emoticone/crying.png'>",
			// étonné 
			"<img src='global/img/emoticone/gasping.png'>",
			"<img src='global/img/emoticone/gasping.png'>",
			"<img src='global/img/emoticone/gasping.png'>",
			"<img src='global/img/emoticone/gasping.png'>",
			// ^^
			"<img src='global/img/emoticone/happy_smiling.png'>",
			//coeur
			"<img src='global/img/emoticone/heart.png'>",
			//irrité
			"<img src='global/img/emoticone/irritated.png'>",
			"<img src='global/img/emoticone/irritated.png'>",
			//irrité marrant
			"<img src='global/img/emoticone/laughing.png'>",
			"<img src='global/img/emoticone/laughing.png'>",
			"<img src='global/img/emoticone/laughing.png'>",
			"<img src='global/img/emoticone/laughing.png'>",
			//euh quoi?
			"<img src='global/img/emoticone/sick.png'>",
			"<img src='global/img/emoticone/sick.png'>",
			//surpris
			"<img src='global/img/emoticone/surprised.png'>",
			"<img src='global/img/emoticone/surprised.png'>",
			//supris mais dans l'autre sens, j'avoue, j'éxagère!
			"<img src='global/img/emoticone/surprised_2.png'>",
			"<img src='global/img/emoticone/surprised_2.png'>",
			//fatigué
			"<img src='global/img/emoticone/tired.png'>",
			//tire langue
			"<img src='global/img/emoticone/tongue_out.png'>",
			"<img src='global/img/emoticone/tongue_out.png'>",
			"<img src='global/img/emoticone/tongue_out.png'>",
			"<img src='global/img/emoticone/tongue_out.png'>",
			//tire langue, mort?
			"<img src='global/img/emoticone/tongue_out_laughing.png'>",
			"<img src='global/img/emoticone/tongue_out_laughing.png'>",
			"<img src='global/img/emoticone/tongue_out_laughing.png'>",
			"<img src='global/img/emoticone/tongue_out_laughing.png'>",
			//ca craint
			"<img src='global/img/emoticone/unsure.png'>",
			"<img src='global/img/emoticone/unsure.png'>",
			//clin d'oeil
			"<img src='global/img/emoticone/winking.png'>",
			//clin d'oeil sourire
			"<img src='global/img/emoticone/winking_grinning.png'>",
			"<img src='global/img/emoticone/winking_grinning.png'>",
			//clin d'oeil tire langue
			"<img src='global/img/emoticone/winking_tongue_out.png'>",
			"<img src='global/img/emoticone/winking_tongue_out.png'>"
		);


		$messageEncode = utf8_decode(htmlspecialchars($message));
		$resultat = str_replace($emoticone, $imageOfEmoticone, $messageEncode);
		return $resultat;
	}

}
