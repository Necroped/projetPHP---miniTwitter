<?php

	/**
	 *  Charge les models automatiquement
	 **/
	function __autoload( $class_name ) {
		if (file_exists('models/' . strtolower( $class_name ) . '.class.php' )) 
		{
			require_once 'models/' . strtolower( $class_name ) . '.class.php';
		}
		else
		{
			throw new Exception("Impossible de charger la classe $class_name.");
		}
	};

	// Grain De Sel
	define("GDS", "ProjetPHP");

	// Pages autorisées
	$authorized_pages = array(
		"connexion",
		"accueil",
		"profil",
		"abonnements",
		"parametres"
	);