<!--
	vue/contact.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Formulaire de contact + traitement
	
	Inclus dans : controleur/contact.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if ($contactForm == "false") {
						?><h2 style="text-align: center">Formulaire de contact désactivé !</h2>
						<p>Suite à une décision de l'administrateur, le formulaire a été désactivé.<br />En attendant, vous pouvez nous contacter par mail à l'adresse suivante : <a href="mailto://<?php echo returnValueFromParam("emailContact");?>"><?php echo returnValueFromParam("emailContact");?></a></p>
						<br /><?php
						include_once("includes/footer.php");
						die;
					}
					if (isset($sendingMailStatus)) { echo "<div class='alert ".$niveauAlerte."'>".$sendingMailStatus."</div>"; } ?>
					<form method="post" action="contact.php">
						<h2 style="text-align: center;">Nous contacter</h2>
						<div class="form-group">
							<label for="mail">Votre mail : </label><input type="email" name="mail" id="mail" class="form-control"/>
						</div>
						<div class="form-group">
							<label for="message">Votre message : </label><textarea id="message" name="message" rows="10" class="form-control">Entrez ici votre message</textarea>
						</div>
						<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_key; ?>"></div><br />
						<input type="submit" value="Envoyer" class="btn btn-default">
					</form>
				<?php
				include_once("includes/footer.php");
				?>