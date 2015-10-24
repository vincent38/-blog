					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if ($form == true)
					{
						if (!empty($status))
						{
							echo "<div class='".$box."'role='alert'>".$status."</div>";
						}
						?>
							<h2 style="text-align: center;">Connexion :</h2>
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
								<button type="submit" class="btn btn-default">
					                <i class="fa fa-sign-in"></i> Connexion
					            </button>
							</form>
						<?php
					}
					else
					{
						echo "<div class='".$box."'role='alert'>".$status;
						?>
						<script type="text/javascript">
					        window.onload = Init;
					        var waitTime = 5; // Temps d'attente en seconde
					        var url = 'index.php';     // Lien de destination
					        var x;
					        function Init() {
					                window.document.getElementById('compteur').innerHTML = waitTime;
					                x = window.setInterval('Decompte()', 1000);
					        }
					        function Decompte() {
					                ((waitTime > 0)) ? (window.document.getElementById('compteur').innerHTML = --waitTime) : (window.clearInterval(x));
					                if (waitTime == 0) {
					                        window.location = url;
					                }
					                if (waitTime == 1) {
					                        window.document.getElementById('sec').innerHTML = "seconde";
					                }
					        }
					    </script>
					    <p>Vous allez être redirigé automatiquement dans <span id='compteur'>5</span> <span id='sec'>secondes</span> :)</p></div>
					<?php
					}
					?>
				<?php
				include_once("includes/footer.php");
				?>