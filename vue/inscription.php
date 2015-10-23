<!--
	vue/index.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Page d'accueil du blog, affichage des 10 derniers
	billets, pagination (AFFICHAGE UNIQUEMENT)

	Inclus dans : controleur/index.php
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
							<h2 style="text-align: center;">Inscription :</h2>
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
								<input class="btn btn-default" type="submit" />
							</form>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>