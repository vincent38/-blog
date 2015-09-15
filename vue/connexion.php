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
		<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
		<script type="text/javascript">
		    window.cookieconsent_options = {"message":"Ce blog utilise des cookies afin d'améliorer l'expérience utilisateur","dismiss":"D'accord","learnMore":"Plus d'informations","link":null,"theme":"light-bottom"};
		</script>
		<script type="text/javascript" src="//s3.amazonaws.com/cc.silktide.com/cookieconsent.latest.min.js"></script>
		<!-- End Cookie Consent plugin -->
		<!--Balise de titre-->
		<title>Connexion</title>
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
								</ul>
							</div>
						</div>
					</nav>
					<?php
					if ($form == true)
					{
						?>
							<form method="post" action="connexion.php">
								<div class="form-group">
									<label for="pseudo">Pseudonyme : </label><input class="form-control" type="text" name="pseudo" id="pseudo" />
								</div>
								<div class="form-group">
									<label for="pass">Mot de passe : </label><input class="form-control" type="password" name="pass" id="pass" />
								</div>
								<div class="checkbox">
									<label for="autoco"><input type="checkbox" name="autoco" id="autoco" /> Connexion automatique ? (Laissez décoché sur un ordinateur partagé) </label>
								</div>
								<input type="submit" class="btn btn-default"/>
							</form>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>