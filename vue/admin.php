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
				<?php
				include_once("includes/footer.php");
				?>
