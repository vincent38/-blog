					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if ($form == true)
					{
						if (!empty($status))
						{
							echo $status;
						}
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
					else
					{
						echo $status;
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>