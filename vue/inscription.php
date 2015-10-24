<!--
	vue/inscription.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Formulaire d'inscription + traitement

	Inclus dans : controleur/inscription.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if (!empty($status))
					{
						echo "<div class='".$box."'role='alert'>".$status."</div>";
					}
					if ($form == true)
					{
						?>
							<h2 style="text-align: center;">Inscription - tous les champs sont obligatoires:</h2>
							<form method="post" action="inscription.php">
								<div class="form-group">
									<label for="pseudo">Pseudonyme : </label><input class="form-control" type="text" name="pseudo" id="pseudo" />
								</div>
								<div class="form-group">
									<label for="mail">Email : </label><input class="form-control" type="text" name="mail" id="mail" />
								</div>
								<div class="form-group">
									<label for="pass1">Mot de passe : </label><input class="form-control" type="password" name="pass1" id="pass1" />
								</div>
								<div class="form-group">
									<label for="pass2">Confirmez mot de passe : </label><input class="form-control" type="password" name="pass2" id="pass2" />
								</div>
								<div class="form-group">
									<label>Captcha :</label><div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_key; ?>"></div>
								</div>
								<button type="submit" class="btn btn-default">
					                <i class="fa fa-user-plus"></i> Inscription
					            </button>
							</form>
						<?php
					}
				include_once("includes/footer.php");
				?>