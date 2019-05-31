<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=0, maximum-scale=1, initial-scale=1.0, maximum-scale=1">

		<link rel="icon" type="image/png" href="assets/picture/logoCastellane.png">
		<title>Auto-école Castellane</title>

		<!-- CSS Styles -->
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
		<link rel="stylesheet" href="<?= site_url('assets/styles/css/style.css') ?>"/>

		<!-- W3school Link -->
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Boostrap  -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">

		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="assets/fonts/ionicons.min.css">
		<link rel="stylesheet" href="assets/css/Article-List.css">
		<link rel="stylesheet" href="assets/css/Features-Boxed-1.css">
		<link rel="stylesheet" href="assets/css/Features-Boxed.css">
		<link rel="stylesheet" href="assets/css/Footer-Basic-1.css">
		<link rel="stylesheet" href="assets/css/Footer-Basic.css">
		<link rel="stylesheet" href="assets/css/Footer-Dark.css">
		<link rel="stylesheet" href="assets/css/Highlight-Phone.css">
		<link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
		<link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
		<link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/Team-Boxed.css">
		<link rel="stylesheet" href="assets/css/Team-Clean.css">
		
		<link href="<?= site_url('assets/calendar/packages/core/main.css')?>" rel='stylesheet' />
		<link href="<?= site_url('assets/calendar/packages/daygrid/main.css')?>" rel='stylesheet' />
		
		<script src="<?= site_url('assets/calendar/packages/core/main.js')?>"></script>
		<script src="<?= site_url('assets/calendar/packages/daygrid/main.js')?>"></script>
		<script src="<?= site_url('assets/calendar/packages/core/locales/fr.js')?>"></script>
		<script>
		  document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
				locale: 'fr',
				titleFormat: { // will produce something like "Tuesday, September 18, 2018"
					month: 'long',
					year: 'numeric',
					day: 'numeric'
				  },
				header: {
					left: 'prevYear,prev,next,nextYear today',
					center: 'title',
					right: 'dayGridDay,dayGridWeek,dayGridMonth'
				},
				allDayText: 'Toute la journée',
				buttonText: {
					today: 'aujourd\'hui',
					month: 'mois',
					week: 'semaine',
					day: 'jour',
					list: 'liste'
				},
				editable: true,
				events: 'https://ae-castellane.com/event/all'
				});
				calendar.render();
		 	});
			</script>
    </head>
<body>
	<header class="sticky-top">
	<div class="sticky-top py-1 d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
		<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
			<div class="container">
				<a class="navbar-brand" href="<?= site_url("accueil"); ?>">Castellane-Auto</a>
				<button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navcol-1">
					<ul class="nav navbar-nav mr-auto">
						<li class="nav-item nav-link" role="presentation"><b><i>Projet BTS SIO SLAM</i></b></li>
						<li class="nav-item" role="presentation"><a class="nav-link" href="<?= site_url('presente'); ?>">Présentation</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link" href="<?= site_url('boutique'); ?>">Boutique</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link" href="<?= site_url('forum'); ?>">Forum</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link" onclick="document.getElementById('contact').style.display='block'">Contact</a></li>
					</ul>
					<span class="navbar-text actions"></span>
				</div>
				<?php
					if(!empty($_SESSION['connect']))
					{
						echo'
						<div class="form-inline mt-2 mt-md-0 ">
							<a class="btn btn-info action-button m-2" href="'.site_url('user/profil').'">Profil</a>
							<a class="btn btn-danger action-button m-2" href="'.site_url('user/logout').'">Déconnexion</a>
						</div>
						';
					}
					else if(!empty($_SESSION['connect_admin']))
					{
						echo'
						<div class="form-inline mt-2 mt-md-0 ">
							<a class="btn btn-danger action-button m-2 ml-5" href="'.site_url('admin/accueil').'">Administrations</a>
							<a class="btn btn-danger action-button m-2" href="'.site_url('user/logout').'">Déconnexion</a>
						</div>
						';
					}
					elseif(!empty($_SESSION['connect_monitor']))
					{
						echo'
						<div class="form-inline mt-2 mt-md-0 ">
							<a class="btn btn-danger action-button m-2 ml-5" href="'.site_url('monitor/accueil').'">Gestions Moniteur</a>
							<a class="btn btn-danger action-button m-2" href="'.site_url('user/logout').'">Déconnexion</a>
						</div>
						';
					}
					else
					{
						echo'
						<div class="form-inline mt-2 mt-md-0 ">
							<a class="btn btn-success action-button m-2 ml-5" href="'.site_url('user/signin').'">Connexion</a>
							<a class="btn btn-danger action-button m-2" role="button" href="'.site_url('user/signup').'">Inscription</a>
						</div>
			   			';
					}
				?>
			</div>
		</nav>
	</div>
 </header>
 <?php
  $message_envoye = "<div class='container center' style='color: green;'>Votre message nous est bien parvenu ! Vous allez en recevoir une copie !</div>";
  $message_non_envoye = "<div class='container center' style='color: orange;'>L'envoi du mail a échoué, veuillez réessayer SVP.</div>";
  $message_formulaire_invalide = "<div class='container center' style='color: red;'>Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.</div>";
 ?>
<!-- Contact -->
<div id="contact" class="w3-modal mt-5">
  <div class="w3-modal-content w3-animate-zoom">
	<div class="w3-container bg-danger">
	  <span onclick="document.getElementById('contact').style.display='none'" class="w3-button bg-danger w3-display-topright w3-large text-white">x</span>
	  <h1 class="text-white">Contact</h1>
	</div>
	<div class="w3-container">
	  <?php
		$destinataire = 'drapalamathieu95@gmail.com';
		$copie = 'oui';
		$form_action = '';

		function Rec($text)
		{
			$text = htmlspecialchars(trim($text), ENT_QUOTES);
			if (1 === get_magic_quotes_gpc())
			{
				$text = stripslashes($text);
			}

			$text = nl2br($text);
			return $text;
		};

		function IsEmail($email)
		{
			$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
			return (($value === 0) || ($value === false)) ? false : true;
		}

		$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
		$prenom  = (isset($_POST['prenom']))  ? Rec($_POST['prenom'])  : '';
		$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
		$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';


		$email = (IsEmail($email)) ? $email : '';
		$err_formulaire = false;

		if (isset($_POST['envoi']))
		{
			if (($nom != '') && ($prenom != '') && ($email != '') && ($message != ''))
			{
				$headers  = 'From: '.$nom.' <'.$email.'>' . "\r\n";
				if ($copie == 'oui')
				{
					$cible = $destinataire.';'.$email;
				}
				else
				{
					$cible = $destinataire;
				};

				$message = str_replace("&#039;","'",$message);
				$message = str_replace("&#8217;","'",$message);
				$message = str_replace("&quot;",'"',$message);
				$message = str_replace('&lt;br&gt;','',$message);
				$message = str_replace('&lt;br /&gt;','',$message);
				$message = str_replace("&lt;","&lt;",$message);
				$message = str_replace("&gt;","&gt;",$message);
				$message = str_replace("&amp;","&",$message);

				$num_emails = 0;
				$tmp = explode(';', $cible);
				foreach($tmp as $email_destinataire)
				{
					if (mail($email_destinataire, $message, $headers))
						$num_emails++;
				}

				if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
				{
					echo '<p>'.$message_envoye.'</p>';
				}
				else
				{
					echo '<p>'.$message_non_envoye.'</p>';
				};
			}
			else
			{
				echo '<p>'.$message_formulaire_invalide.'</p>';
				$err_formulaire = true;
			};
		};

		if (($err_formulaire) || (!isset($_POST['envoi'])))
		{
			echo '
			<div class="mt-2 col-md-12 order-md-1">

			<form class="needs-validation" method="post">
				<div class="row">

					<div class="col-md-6 mb-3">
						<label for="nom">Nom</label>
						<input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir votre nom" value="'.stripslashes($nom).'" required>
						<div class="invalid-feedback">
						Saisir un nom valide
						</div>
					</div>

					<div class="col-md-6 mb-3">
						<label for="prenom">Prénom</label>
						<input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir votre prénom" value="'.stripslashes($prenom).'" required>
						<div class="invalid-feedback">
						Saisir une prénom valide
						</div>
					</div>

				</div>

				<div class="mb-3">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email@email.com" value="' . stripslashes($email) . '" required>
					<div class="invalid-feedback">
						Entrer une adresse mail valide.
					</div>
				</div>

				<div class="form-group">
					<label for="commentaire">Commentaire:</label>
					<textarea class="form-control" rows="5" id="commentaire" name="message" placeholder="Saisir votre demande ">' . stripslashes($message) . '</textarea>
				</div>

				<hr class="mb-4">

				<button class="btn btn-success btn-lg btn-block" name="envoi" type="submit">Envoyer</button><br>
			</form>
		</div>
		';}
	  ?>
	</div>
  </div>
</div>