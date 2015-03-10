<?php

/**
 * @author    Antoine Mady
 *  Cette page est appelée par le navigateur en premier.
 * 	La navigation du site se fait par modification ou ajout de paramètres à index.php.      
 */

/**
 * Fichier de config gérant diverses actions
 **/
require_once "global/config/config.inc";

/**
 * Singleton PDO gérant la base de données.  
 **/
require_once "global/lib/spdo.class.php";

/**
 * Fichier gérant les processus de l'application 
 **/
require_once "global/process/process.php";

/**
 * Fichier stockant les alertes utiles à l'application 
 **/
require_once "global/process/alertes.php";

/*
 * Récupération de la page courante si l'utilisateur est connecté
 */
if( isset($_GET['page'])
	&& isset($_SESSION['utilisateurCourant']) 
	&& !empty($_SESSION['utilisateurCourant']))
{
	$page = $_GET['page'];
}
else
{
	/*
	 * La page de base est la page de connexion
	 */
	$page = "connexion";
}

?>


<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- c'est moi qui a tout fait! -->
	<meta author="Antoine Mady">
	<!-- c'est nul comme nom, je vous l'accorde -->
	<title>Projet PHP</title>
	<?php
		/** 
		 * Fichier appelant toutes les ressources css nécessaires
		 **/
		require_once "global/ressources/css.php";
	?>
</head>
<body>

<?php
	/** 
	 * Si la page courante n'est pas la page de connexion
	 */
	if($page!="connexion")
	{
		/**
		 * Barre de navigation
		 **/
		require_once "controllers/navigation.php";
	}

	/*
	 * Si la page est autorisée
	 */ 
	if(in_array($page, $authorized_pages))
	{
		/**
		 * Page appelée en paramètres
		 **/
		require_once "controllers/$page.php";
	}
	else
	{
		/** 
		 * Fichier de config gérant diverses actions
		 **/
		require_once "controllers/404.php";	
	}
	/** 
	 * Fichier appelant toutes les ressources javascript nécessaires
	 **/
	require_once "global/ressources/js.php";
?>

</body>
</html>