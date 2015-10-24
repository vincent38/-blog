<!--
	vue/deconnexion.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Déconnexion
	
	Inclus dans : controleur/deconnexion.php
-->
				<?php  
				include_once("includes/header.php");

				if($deco == true)
				{
					?>
					<div class="alert alert-success" role='alert'><i class="fa fa-check"></i> Vous avez été déconnecté !<br />
					Les cookies de connexion ont été supprimés.
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
				else
				{
					?>
					<p>Vous n'avez pas accès à cette page !</p>
					<?php
					header("Location: index.php");
				}
				include_once("includes/footer.php");
				?>