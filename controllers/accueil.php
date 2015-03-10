<?php
	// Récupération de l'utilisateur actuellement connecté
	$idConnecte = $_SESSION['utilisateurCourant'];
	$utilisateurConnecte = new Utilisateurs($idConnecte);

	// Récupération de tous les messages visibles de l'utilisateur connecté
	$messagesUtilisateur = $utilisateurConnecte->getAllMessagesVisibles();
	
	/**
	 * Appel de la vue accueil
	 **/
	include_once "views/accueil.html";