<!--Début du header-->
<!DOCTYPE html>
<html>
	<head>
		<!-- Balises meta -->
		<meta http-equiv="X-UA-Compatible" content="IE-edge"><!--IE use the latest version of render engine -->
		<meta name="viewport" content="width=device-width, initial-scale=1"><!--Anti-zoom sur smartphones-->
		<meta charset="utf-8">
		<!--[if lt IE 9]>
			<script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
		<![endif]-->
		<!--Balises link-->
		<link rel="stylesheet" href="vue/bootstrap/css/bootstrap.min.css" /><!--Bootstrap 3-->
		<link rel="stylesheet" href="vue/fontawesome/css/font-awesome.min.css" /><!--Font Awesome-->
		<!--Scripts externes-->
		<!--ReCAPTCHA-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
		<script type="text/javascript">
		    window.cookieconsent_options = {"message":"Ce blog utilise des cookies afin d'améliorer l'expérience utilisateur","dismiss":"D'accord","learnMore":"Plus d'informations","link":null,"theme":"light-bottom"};
		</script>
		<script type="text/javascript" src="//s3.amazonaws.com/cc.silktide.com/cookieconsent.latest.min.js"></script>
		<!-- End Cookie Consent plugin -->
		<!--Balise de titre-->
		<title>Bienvenue sur mon blog !</title>
	</head>
	
	<body>
		<!-- Corps de la page -->
		<!--Architecture bootstrap 3 -> 2cols 8cols 2cols -->
		<div class="container">
			<div class="row">
				<div class="col-2"></div>
				<div class="col-8">
					<!--Header du site-->
					<header class="page-header">
						<h1 style="text-align: center;">Bienvenue sur mon blog !</h1>
						<p style="text-align: center;">Blog en travaux</p>
					</header>
					<!--Menu-->
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="Collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li><a href="index.php">Index</a></li>
									<li><a href="connexion.php" onclick="alert('Lien désactivé :3'); return false;">Administration</a></li>
									<?php
									if ($menu == true)
									{
										?>
										<li><a href="membre.php" ><?php echo "Bonjour, ".$_SESSION["pseudo"]." !"; ?></a></li>
										<li><a href="deconnexion.php">Déconnexion</a></li></li>
										<?php
									}
									else
									{
										?>
										<li><a href="connexion.php">Connexion</a></li></li>
										<li><a href="inscription.php">Inscription</a></li></li>
										<?php
									}
									?>
								</ul>
							</div>
						</div>
					</nav>
					<!--Fin du header-->