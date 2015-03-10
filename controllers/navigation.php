<?php
	// Récupération de l'utilisateur actuellement connecté
	$idConnecte = $_SESSION['utilisateurCourant'];
	$utilisateurConnecte = new Utilisateurs($idConnecte);
	// Récupération de l'utilisateur dont on voit actuellement le profil, utile pour le bouton 'mon profil' 
	$idCourant = $_GET['user'];
	//Récupération de la liste de tous les utilsiateurs, utile pour la recherche
	$listeUtilisateurs = Utilisateurs::getAllUtilisateurs();

	/**
	 * Appel de la vue navigation
	 **/
	include_once "views/navigation.html";

	// modal gérant la modification du profil
	include_once "views/modalModifierProfil.html";

	// modal gérant l'envoi du message
	include_once "views/modalEcrireMessage.html";
