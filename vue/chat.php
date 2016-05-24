<!--
	vue/chat.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Chat interne
	
	Inclus dans : controleur/chat.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					foreach ($messages as $message)
					{
						$membre = getUser($message["user_id"]);
						echo "[".$message["date"]."] ".$membre["pseudo"]." : ".$message["message"]." <br />";
					}
					?>
					<br />
					<form action="chat.php" method="post" >
						<div class="input-group">
						   	<input type="text" name="message" class="form-control" placeholder="Votre message..." />
						  	<span class="input-group-btn">
								<button type="submit" class="btn btn-default">Envoyer</button>
						   	</span>
						</div>
					</form>
					<?php
					include_once("includes/footer.php");
					?>