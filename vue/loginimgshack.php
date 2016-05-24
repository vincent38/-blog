<!--
	vue/connexion.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Formulaire de connexion + traitement
	
	Inclus dans : controleur/connexion.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");

					//Test si curl présent
					if (!extension_loaded('curl')) {
    					echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] cURL n'est pas activé sur ce serveur. Vous ne pouvez donc pas bénéficier de cette fonctionnalité :/</div>";
					}

					if (!isset($imgshack)) {
					?>
						<div class="well">Bienvenue sur le client Imageshack du Stendhal Déchaîné.<br /> Vous pouvez l'utiliser pour importer vos images et obtenir des liens directs sans quitter le site.<br />Pour commencer, connectez-vous avec vos identifiants Imageshack.</div>
						<h2 style="text-align: center;">Connexion à Imageshack :</h2>
						<form method="post" action="loginimgshack.php">
							<div class="form-group">
								<label for="user">Pseudonyme : </label><input class="form-control" type="text" name="user" id="user" />
							</div>
							<div class="form-group">
								<label for="password">Mot de passe : </label><input class="form-control" type="password" name="password" id="password" />
							</div>
							<button type="submit" class="btn btn-default">
					      	        <i class="fa fa-sign-in"></i> Connexion via l'API
					      	    </button>
						</form>
						<?php
					} else {
						if (isset($imgshack)){
							echo "<h2 style='text-align: center'>Bienvenue, ".$_SESSION["username_is"]." !</h2>";
							echo "<p style='text-align: center'>Votre User ID : ".$_SESSION["userid_is"]."<br />
							Statut du compte : ".$_SESSION["membership_is"]."<br />
							Vous pouvez maintenant envoyer directement vos images depuis le système de création et de modification de billets.<br />
							<a href=\"moderation.php\">Retourner au menu de modération</a></p>";
						} else if ($outParsed["success"] == 0) {
							echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] Imageshack a renvoyé une erreur.<br />
							Code : ".$outParsed['error']['error_code']."<br />
							Message : ".$outParsed['error']['error_message']."<br />
							Revenez sur le menu de modération puis réessayez.</div>";
							include_once("includes/footer.php");
							die;
						} else {
							echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] Erreur inconnue. Merci de réessayer.</div>";
						}
					}
				include_once("includes/footer.php");
				?>