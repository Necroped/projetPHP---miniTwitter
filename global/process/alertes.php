<?php 
/**
 * 
 *  ALERTES
 *  Ce fichier gère les différentes alertes possible sur le site, ces alertes sont forcément appelée par un get
 * 
**/
if(isset($_REQUEST['alert']) && !empty($_REQUEST['alert']))
{
	switch ($_REQUEST['alert']) 
	{
		case 'ConnexionReussie':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Connexion réussie!</strong> Félicitation pour votre connexion.'.
				'</div>';
				'</div>';
			break;
		case 'ConnexionEchec':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Connexion échouée</strong> Veuillez vérifier votre identifiant et votre mot de passe.'.
				'</div>';
			break;
		case 'InscriptionEchecEmail':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Inscription échouée</strong> Cet email est déja utilisé.'.
				'</div>';
			break;
		case 'InscriptionEchecIdentifiant':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Inscription échouée</strong> Ce nom d\'utilisateur est déja pris'.
				'</div>';
			break;
		case 'SuppressionUtilisateur':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Compte supprimé</strong> Votre compte a bien été supprimé'.
				'</div>';
			break;
		case 'InscriptionReussie':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Inscription réussie!</strong> Félicitation pour votre inscription'.
				'</div>';
			break;
		case 'Deconnexion':
			echo '<div class="alert alert-warning alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Déconnexion réussie!</strong>'.
				'</div>';
			break;
		case 'MsgEchecLong':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Envoi du message impossible</strong> Désolé, votre message est trop long.'.
				'</div>';
			break;
		case 'MsgEchecVide':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Envoi du message impossible</strong> Désolé, votre message est vide.'.
				'</div>';
			break;
		case 'MsgReussi':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Message envoyé!</strong> Votre message a bien été envoyé'.
				'</div>';
			break;
		case 'MsgSupReussi':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Message supprimé!</strong> Votre message a bien été supprimé'.
				'</div>';
			break;
		case 'MsgSupEchec':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Message non supprimé</strong> Votre message n\'a pas pu être supprimé'.
				'</div>';
			break;
		case 'SuiviReussie':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Nouveau suivi!</strong> Vous suivez un nouvel utilisateur'.
				'</div>';
			break;
		case 'SuiviEchec':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Erreur suivi!</strong> Vous ne suivez pas cet utilisateur'.
				'</div>';
			break;
		case 'FinSuiviReussi':
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Fin du suivi!</strong> Vous ne suivez plus cet utilisateur'.
				'</div>';
			break;
		case 'FinSuiviEchec':
			echo '<div class="alert alert-danger alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Erreur fin suivi</strong> Vous suivez toujours cet utilisateur'.
				'</div>';
			break;
		default:
			echo '<div class="alert alert-success alert-dismissible" role="alert">'.
  				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
  				'<span aria-hidden="true">&times;</span></button>'.
  				'<strong>Connexion réussie!</strong> Félicitation pour votre connexion'.
				'</div>';
			break;
	}
}