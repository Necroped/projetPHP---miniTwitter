// Si on modifie les input, on appelle la fonction (effacement également)
$('.input-group input[required], .input-group textarea[required], .input-group select[required]').keyup(function() {
	checkForm(this);
});

$('.input-group input[required], .input-group textarea[required], .input-group select[required]').change(function() {
	checkForm(this);
});

$('.input-group input[required], .input-group textarea[required], .input-group select[required]').trigger('change');


$(function()
{
	// Pour le selecteur d'utilisateurs
	$('.selectpicker').selectpicker();



	// override de datepicker pour le sélecteur de date
	$.fn.datepicker.dates['en'] = {
	    days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
	    daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
	    daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di"],
	    months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
	    monthsShort: ["Jan", "Fev", "Mars", "Avril", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Dec"],
	    today: "Aujourd'hui",
	    clear: "Effacer"
	};


	// Configuration de base du sélecteur de dates
     $('.datepicker').datepicker({ 
     	dateFormat: "dd/mm/yyyy", 
     	changeMonth: true,
        changeYear: true, 
        weekStart: 1,
        yearRange: '1900:2020'
    }).val('');

	// Lorsque l'on accepte de supprimer son message
	$('#submitModalSupprimer').click(function(){
	    $('#formSupprimerMessage').submit();
	});

	// Lorsque l'on accepte de supprimer son compte
	$('#submitModalSupprimerCompte').click(function(){
	    $('#formSupprimerCompte').submit();
	});

	// Lorsque l'on refuse de supprimer son compte
	$('#submitModalNonSupprimerCompte').click(function(){
		$("#confirmationSupprimerCompte").modal("hide");	
	});

});

	// Indique à l'utilisateur, combien de caractères il peut encore écrire lors de l'envoie d'un message
	// supprime des caractères si nécessaires
	$("#messageInput").keyup(function()
	{
		nbMax = 140;
		restant = nbMax - $(this).val().length;
		$('#nbCharRestants').text("Il vous reste " + restant + " caractères à écrire au maximum.");
		if(restant<0)
		{
			$(this).val($(this).val().substr(0, nbMax));
		}
		else if(restant == 0)
		{
			$('#nbCharRestants').text("Vous ne pouvez plus écrire, la limite de caractères a été atteinte.");
			$('#nbCharRestants').addClass('label-danger');	
			$('#nbCharRestants').removeClass('label-default');
		}
		else
		{
			$('#nbCharRestants').removeClass('label-danger');			    	
			$('#nbCharRestants').addClass('label-default');
		}
	});

	// Lorsque l'on choisit un utilisateur dans la recherche
	$('#rechercheUtilisateur').on('change', function()
	{
		window.location.replace("index.php?page=profil&user=" + $("#rechercheUtilisateur").val());
	});

// Vérifie que tous les champs du formulaires sont correctement remplis
function checkForm(that)
{
	// Découpage des éléments
	var $form = $(that).closest('form'),
	$group = $(that).closest('.input-group'),
	$addon = $group.find('.input-group-addon'),
	$icon = $addon.find('span'),
	state = false;

	// Vérifie le type de la chaine
	if (!$group.data('validate')) {
		state = $(that).val() ? true : false;
		//Vérifie la concordance des deux mot de passe
		if(typeof($("#motDePasse").val())!="undefined" && typeof($("#motDePasse2").val())!="undefined" && $("#motDePasse").val()!==null && $("#motDePasse2").val()!==null)
		{
			input1 = $("#motDePasse").val();
			input2 = $("#motDePasse2").val();
			state=checkMotDePasse(input1, input2);
		}
	}else if ($group.data('validate') == "email") {
		state = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($(that).val())
	}else if($group.data('validate') == 'phone') {
		state = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/.test($(that).val())
	}else if ($group.data('validate') == "length") {
		state = $(that).val().length >= $group.data('length') ? true : false;
	}else if ($group.data('validate') == "number") {
		state = !isNaN(parseFloat($(that).val())) && isFinite($(that).val());
	}

	// vérifie la longueur de la chaine
	if($group.data('length')){
		state = $(that).val().length >= $group.data('length') ? true : false;
	}

	// Affichage des glyphicon et des bordures en fonction de l'état
	if (state) {
		$addon.removeClass('danger');
		$addon.addClass('success');
		if (typeof $icon.attr('class', 'glyphicon glyphicon-remove') !== typeof undefined && $icon.attr('class', 'glyphicon glyphicon-remove') !== false) {
			$icon.addClass('glyphicon-ok');
			$icon.removeClass('glyphicon-remove');
				// $icon.attr('class', 'glyphicon glyphicon-remove');
			}
		}else{
			$addon.removeClass('success');
			$addon.addClass('danger');
			if (typeof $icon.attr('class', 'glyphicon glyphicon-ok') !== typeof undefined && $icon.attr('class', 'glyphicon glyphicon-ok') !== false) {
				$icon.addClass('glyphicon-remove');
				$icon.removeClass('glyphicon-ok');
				// $icon.attr('class', 'glyphicon glyphicon-remove');
			}
		}

	// Permet de gérer le bouton du formulaire
	// /!\ il faut que le bouton soit configuré en "button type submit" et non en "a type button"
	// === nécessaire
	if ($form.find('.input-group-addon.danger').length === 0) {
		$form.find('[type="submit"]').prop('disabled', false);
	}else{
		$form.find('[type="submit"]').prop('disabled', true);
	}
}




// fonction appelée sur la page de connexion/inscription
// permet de passer du mode connexion au mode inscription
function toggleConnexionInscription()
{
	if($("#connexionInscription").text() == "Se connecter")
	{
		$("#connexionInscription").text("S'inscrire");
		$('<div class="input-group col-sm-12 col-md-12 col-lg-12" id="input-group-motDePasse2">'+
			'<input type="password" class="form-control" name="motDePasse2" id="motDePasse2" placeholder="Mot de passe (vérification)" required>'+
			'<span class="input-group-addon danger">'+
			'<span class="glyphicon glyphicon-remove">'+
			'</span>'+
			'</span>'+
			'</div>'+
			'<div class="input-group col-sm-12 col-md-12 col-lg-12" data-validate="email" id="input-group-email">'+
			'<input type="text" class="form-control" name="email" id="email" placeholder="Email" required>'+
			'<span class="input-group-addon danger">'+
			'<span class="glyphicon glyphicon-remove">'+
			'</span>'+
			'</span>'+
			'</div>').insertAfter($("#input-group-motDePasse"));
		$("#inscription").text("Déjà un compte? Se connecter");

		// On rappelle checkForm pour les nouveaux input créés
		$('.input-group input[required], .input-group textarea[required], .input-group select[required]').keyup(function() {
			checkForm(this);
		});
		$('.input-group input[required], .input-group textarea[required], .input-group select[required]').change(function() {
			checkForm(this);

		});
		$('.input-group input[required], .input-group textarea[required], .input-group select[required]').trigger('change');

		// Vérifie que les deux mots de passe soit équivalents
		$('#motDePasse, #motDePasse2').change(function() {
			checkMotDePasse($('#motDePasse').val(), $('#motDePasse2').val());
		});
		// Vérifie que les deux mots de passe soit équivalents
		$('#motDePasse, #motDePasse2').keyup(function() {
			checkMotDePasse($('#motDePasse').val(), $('#motDePasse2').val());
		});
		$('#motDePasse, #motDePasse2').trigger('change');
	}
	else
	{
		//On doit également enlevé l'événement des éléments lorsqu'on les supprime
		// A priori, ca fonctionne...
		$('#motDePasse, #motDePasse2').off();

		$("#connexionInscription").text("Se connecter");
		$("#input-group-motDePasse2").remove();
		$("#input-group-email").remove();
		$("#inscription").text("Pas de compte? S'inscrire");


		// On remet quand meme les événements sur les input, dans le doute...
		$('.input-group input[required], .input-group textarea[required], .input-group select[required]').keyup(function() {
			checkForm(this);
		});
		$('.input-group input[required], .input-group textarea[required], .input-group select[required]').change(function() {
			checkForm(this);
		});
		$('.input-group input[required], .input-group textarea[required], .input-group select[required]').trigger('change');
	}
}

// Gère les deux champs mot de passe sur la pge d'inscription
function checkMotDePasse(MDP1, MDP2)
{

	// Si ils sont différents
	if(MDP1 !== MDP2 || MDP1 == "" && MDP2 == "")
	{
		$('#input-group-motDePasse').children().removeClass('success');
		$('#input-group-motDePasse').children().addClass('danger');
		$('#input-group-motDePasse').children().children().attr('class', 'glyphicon glyphicon-remove');
		$('#input-group-motDePasse2').children().removeClass('success');
		$('#input-group-motDePasse2').children().addClass('danger');
		$('#input-group-motDePasse2').children().children().attr('class', 'glyphicon glyphicon-remove');

		return true;
	}
	else
	{
		$('#input-group-motDePasse').children().addClass('success');
		$('#input-group-motDePasse').children().removeClass('danger');
		$('#input-group-motDePasse').children().children().attr('class', 'glyphicon glyphicon-ok');
		$('#input-group-motDePasse2').children().addClass('success');
		$('#input-group-motDePasse2').children().removeClass('danger');
		$('#input-group-motDePasse2').children().children().attr('class', 'glyphicon glyphicon-ok');

		return false;
	}
}