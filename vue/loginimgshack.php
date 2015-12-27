<!--
	vue/connexion.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Formulaire de connexion + traitement
	
	Inclus dans : controleur/connexion.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if (!isset($outParsed)) {
					?>
						<h2 style="text-align: center;">Connexion à Imageshack :</h2>
						<form method="post" action="loginimgshack.php">
							<div class="form-group">
								<label for="user">Pseudonyme : </label><input class="form-control" type="text" name="user" id="user" />
							</div>
							<div class="form-group">
								<label for="password">Mot de passe : </label><input class="form-control" type="password" name="password" id="password" />
							</div>
							<button type="submit" class="btn btn-default">
					      	        <i class="fa fa-sign-in"></i> Connexion
					      	    </button>
						</form>
						<?php
					} else {
						if ($outParsed["success"] == 0) {
							echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] Imageshack a renvoyé une erreur.<br />
							Code : ".$outParsed['error']['error_code']."<br />
							Message : ".$outParsed['error']['error_message']."<br />
							Revenez sur le menu de modération puis réessayez.</div>";
							include_once("includes/footer.php");
							die;
						} else {
							echo "<h2 style='text-align: center'>Bienvenue, ".$outParsed['result']['username']." !</h2>";
							echo "<p style='text-align: center'>Votre User ID : ".$outParsed['result']['userid']."<br />
							Statut du compte : ".$outParsed['result']['membership']."<br /></p>";
							?>
							<a class="btn btn-default" href="sendimgshack.php" role="button"><i class="fa fa-plus"></i> Envoyer des images sur le serveur</a>
							<?php
						}
					}
				include_once("includes/footer.php");
				?>