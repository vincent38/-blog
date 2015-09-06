<!--
	vue/commentaires.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Affichage d'un billet en particulier et de ses commentaires,
	formulaire pour poster un commentaire (membres authentifiés/anonymes)
	
	Inclus dans : controleur/index.php
-->
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
		<!-- reCAPTCHA par Google-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!--Balise de titre-->
		<title>Affichage du post</title>
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
						if (!empty($billets["id"])) //Anti-lignes fantômes
						{
							?>
								<div class="thumbnail">
									<?php 
										if (!empty($billets["image"]))
										{
											$ShowImg = AffichageImage($billets["image"]);
											echo $ShowImg;
										}
									?>
									<div class="caption">
										<h2><?php echo $billets["titre"]; ?></h2>
										<h3>Ecrit par <?php echo $billets["auteur"]; ?> <?php echo $billets["datewrote"]; ?></h3>
										<?php echo $billets["contenu"]; ?><br />
									</div>
								</div>
							<?php
						}
						else
						{
							echo "[ERREUR] Aucun post ne porte l'ID renseignée. Celui-ci n'existe pas (ou plus). Sorry :/"; 
							die;
						}
					?>
					<!--Partie commentaires + post-->
					<h2>Commentaires</h2>
					<?php
					{
						foreach ($comments as $comment)
						{
							if (!empty($comment["id"]))
							{
								echo "<div class='well well-sm'>";
								echo "<h4>".$comment["auteur"]." a écrit ".$comment["datewrote"]." :</h4>";
								echo "<p>".$comment["commentaire"]."</p></div>";
							}
						}
					}
					?>
					<!--Formulaire pour poster un commentaire-->
					<form method="post" action="commentaires.php?id=<?php if (isset($_POST["id"])) {echo $_POST["id"];} else {echo $_GET["id"];} ?>">
						<h4>Poster un commentaire :</h4>
						<div class="form-group">
							<label for="auteur">Pseudonyme : </label>
							<input type="text" name="auteur" id="auteur" class="form-control" value="<?php if (isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
						</div>				
						<div class="form-group">
							<label for="commentaire">Commentaire : </label>
							<input type="text" class="form-control" name="commentaire" id="commentaire" />
						</div>
						<input type="hidden" name="id_billet" id="titre" value="<?php echo $_GET["id"]; ?>">
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="6LfSaAsTAAAAAEfZ0Pm-Upmg_Qm00KCVu6VnVRLN"></div>
						</div>
						<input type="submit" class="btn btn-default"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>