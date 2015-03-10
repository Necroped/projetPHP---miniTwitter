<?php

	// Récupération de l'utilisateur dont on voit actuellement le profil
	$idCourant = (isset($_GET['user']) && $_GET['user']!="") ? $_GET['user'] : $_SESSION['utilisateurCourant'];
	$utilisateurCourant = new Utilisateurs($idCourant);

	// Récupération de l'utilisateur actuellement connecté
	$idConnecte = $_SESSION['utilisateurCourant'];
	$utilisateurConnecte = new Utilisateurs($idConnecte);

	// Récupération de tous les messages de l'utilisateur dont on voit actuellement le profil
	$messagesUtilisateur = $utilisateurCourant->getAllMessagesFromUser();

	// L'utilisateur connecté a t il le droit de voir les messages de l'utilisateur dont on voit actuellement le profil
	$droitDeVoirLesMessages = Suivre::utilisateurSuivantUtilisateur($utilisateurConnecte->getIdUtilisateur(), $utilisateurCourant->getIdUtilisateur());

	// Récupération de tous les utilisateur suivants l'utilisateur dont on voit le profil
	$utilisateursSuivants = Suivre::getUtilisateursSuivant($idCourant);
	$nbUtilisateursSuivant = sizeof($utilisateursSuivants);

	// Récupération de tous les utilisateur suivis par l'utilisateur dont on voit le profil
	$utilisateursSuivis = Suivre::getUtilisateursSuivi($idCourant);
	$nbUtilisateursSuivi = sizeof($utilisateursSuivis);

	/**
	 * Appel de la vue profil
	 **/
	include_once "views/profil.html";

