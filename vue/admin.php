<!--
	vue/admin.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Espace d'administration
	
	Inclus dans : controleur/admin.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
					<h2 style="text-align: center">Espace d'administration</h2>
					<p style="text-align: center" class="help-block">MàJ du 27/12/15 : Amélioration des menus, ajout de l'upload vers ImageShack, consultation des profils depuis les commentaires. Enjoy :3</p>
					<h3 style="text-align: center">Liste des utilisateurs inscrits</h3>
						<table class="table">
							<thead>
								<tr>
									<th>Pseudonyme :</th>
									<th>Inscrit depuis le :</th>
									<th>Rang :</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$latest = "set";
								foreach ($users as $user)
								{
									if ($latest != $user["pseudo"])
									{
										echo "<tr><td>".$user["pseudo"]."</td><td>".$user["date_inscription"]."</td><td>Rang actuel : ".Ranking($user["pseudo"])." - <a href='edit_rank.php?id=".$user["id"]."'>Editer le rang</a></td></tr>";
										$latest = $user["pseudo"];
									}
								}
								?>
							</tbody>
						</table>
					<br />
					<h3 style="text-align: center">Gestion du carrousel</h3>
					<p style="text-align: center" class="help-block">ATTENTION : cette option peut dégrader l'expérience de navigation sur certains périphériques.<br />A utiliser uniquement si elle s'avère utile.</p>
					<?php if (isset($outputCarrousel))
					{
						echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> ".$outputCarrousel."</div>";
					} ?>
					<form method="post" action="admin.php">
						<div class="checkbox">
						    <label>
						      <input id="carrousel" name="carrousel" type="checkbox" <?php if ($carrouselShow == "true") {echo "checked";} ?>> Activer le carrousel
						    </label>
						 </div>
						<p class="help-block">Insérez les noms sous la forme nom.extension (exemple : test.png) - Elles doivent se trouver dans le dossier images_static, et faire 400*280 px.</p>
						<div class="form-group">
							<label for="img1">Nom de l'image 1 :</label>
						    <input type="text" class="form-control" id="img1" name="img1" value="<?php echo $img1; ?>">
						</div>
						<div class="form-group">
							<label for="img2">Nom de l'image 2 :</label>
						    <input type="text" class="form-control" id="img2" name="img2" value="<?php echo $img2; ?>">
						</div>
						<div class="form-group">
							<label for="img3">Nom de l'image 3 :</label>
						    <input type="text" class="form-control" id="img3" name="img3" value="<?php echo $img3; ?>">
						</div>
						<p class="help-block">Insérez les ID des posts (exemple : 1 pour commentaires.php?id=1).</p>
						<div class="form-group">
							<label for="link1">ID du post - image 1 :</label>
						    <input type="text" class="form-control" id="link1" name="link1" value="<?php echo $link1; ?>">
						</div>
						<div class="form-group">
							<label for="link2">ID du post - image 2 :</label>
						    <input type="text" class="form-control" id="link2" name="link2" value="<?php echo $link2; ?>">
						</div>
						<div class="form-group">
							<label for="link3">ID du post - image 3 :</label>
						    <input type="text" class="form-control" id="link3" name="link3" value="<?php echo $link3; ?>">
						</div>
						<input type="submit" class="btn btn-default"/>
					</form>
					<h3 style="text-align: center">Gestion du nuage de mots</h3>
					<p style="text-align: center" class="help-block">ATTENTION : cette option peut dégrader l'expérience de navigation sur certains périphériques.<br />A utiliser uniquement si elle s'avère utile.</p>
					<?php if (isset($outputTagCloud))
					{
						echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> ".$outputTagCloud."</div>";
					} ?>
					<form id="tagcloud" method="post" action="admin.php">
						<div class="checkbox">
						    <label>
						    	<input id="tagcloud" name="tagcloud" type="checkbox" <?php if ($tagShow == "true") {echo "checked";} ?>> Activer le nuage de mots </input>
						    </label>
						 </div>
						 <div class="checkbox">
							<label>
							    <input id="confirmtag" name="confirmtag" type="checkbox"> Confirmer le choix (cocher pour enregistrer les options dans la BDD)</input>
							</label>
						</div>
						<p>Liste de liens utilisée : tags</p>
						 <input type="submit" class="btn btn-default"/>
					</form>
					<h3 style="text-align: center">Mode maintenance</h3>
					<p style="text-align: center" class="help-block">En mode maintenance, seul le menu d'administration reste accessible.<br /> Ne peuvent se connecter que les administrateurs et super-administrateurs afin de désactiver ce mode.</p>
					<?php if (isset($outputMaintenance))
					{
						echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> ".$outputMaintenance."</div>";
					} ?>
					<form method="post" action="admin.php">
						<div class="checkbox">
						    <label>
						    	<input id="mtceShow" name="mtceShow" type="checkbox" <?php if ($mtceShow == "true") {echo "checked";} ?>> Mode maintenance </input>
						    </label>
						 </div>
						 <div class="form-group">
							<label for="link3">Texte de maintenance :</label>
						    <input type="text" class="form-control" id="mtceTxt" name="mtceTxt" value="<?php echo $mtceTxt; ?>">
						</div>
						 <div class="checkbox">
							<label>
							    <input id="confirmmtce" name="confirmmtce" type="checkbox"> Cochez cette case pour confirmer l'activation/désactivation du mode et/ou la modification du message</input>
							</label>
						</div>
						 <input type="submit" class="btn btn-default"/>
					</form>
					<h3 style="text-align: center">Formulaire de contact</h3>
					<?php if (isset($outputContact))
					{
						echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> ".$outputContact."</div>";
					} ?>
					<form id="tagcloud" method="post" action="admin.php">
						<div class="checkbox">
						    <label>
						    	<input id="contactForm" name="contactForm" type="checkbox" <?php if ($contactForm == "true") {echo "checked";} ?>> Activer le formulaire de contact </input>
						    </label>
						 </div>
						 <div class="form-group">
							<label for="link3">Email de réception des messages :</label>
						    <input type="text" class="form-control" id="formEmail" name="formEmail" value="<?php echo $formEmail; ?>">
						</div>
						 <div class="checkbox">
							<label>
							    <input id="confirmcontact" name="confirmcontact" type="checkbox"> Confirmer le choix (cocher pour enregistrer les options dans la BDD)</input>
							</label>
						</div>
						 <input type="submit" class="btn btn-default"/>
					</form>

				<?php
				include_once("includes/footer.php");
				?>
