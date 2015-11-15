<!--
	vue/add_post.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Ajouter un billet (Modérateur/rédacteur et/ou administrateur)
	
	Inclus dans : controleur/add_post.php
-->
					<?php
					include_once("includes/header.php");
					if ($post)
					{
						echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> Le billet a été publié :)<br /><br /><a href=\"moderation.php\"><-- Revenir au menu de modération !</a></div>";
					}
					?>
					<form method="post" action="add_post.php">
						<h2 style="text-align: center;">Poster un nouvel article</h2>
						<p>
							Balises BBCODE acceptées :<br />
							[b][/b] -> Gras<br />
							[i][/i] -> Italique<br />
							[color=(blue|red|green|#123456)][/color] -> Couleur<br />
							url!http(s)://www.test.fr -> url cliquable<br />
							[img=Description]Lien vers l'image (http://)[/img] -> Image<br />
							[alert=(success|info|warning|danger)][/alert] -> Alertes visuelles<br />
						</p>
						<div class="form-group">
							<label for="auteur">Auteur : </label><input class="form-control" type="text" name="auteur" id="auteur" readonly='readonly' value="<?php echo $author;?>">
						</div>
						<div class="form-group">
							<label for="titre">Titre de la news : </label><input type="text" class="form-control" name="titre" id="titre"><br />
						</div>
						<div class="form-group">
							<label for="contenu">Contenu de la news : </label><textarea name="contenu" class="form-control" id="contenu" rows="30" ></textarea><br />
						</div>
						<div class="form-group">
							<label for="pic">Image à associer : </label>
							<select class="form-control" name="pic" id="pic">
								<option value="">Aucune image</option>
								<?php
								$latest = "set";
								foreach ($listepics as $pic)
								{
									if ($latest != $pic["name"])
									{
										echo "<option value='".$pic["name"]."'>".$pic["name"]."</option>";
										$latest = $pic["name"];
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="cat">Tag </label>
							<select class="form-control" name="cat" id="cat">
								<?php
								$latest = "set";
								foreach ($listeCats as $cat)
								{
									if ($latest != $cat["nom"])
									{
										echo "<option value='".$cat["id"]."'>".$cat["nom"]."</option>";
										$latest = $cat["nom"];
									}
								}
								?>
							</select>
						</div>
						<div class="checkbox">
						  <label>
						    <input type="checkbox" name="available" value="set :D">
						    Ne pas publier l'article : celui-ci n'apparaîtra pas sur la page d'accueil et ne sera pas accessible publiquement.
						  </label>
						</div>
						<input type="submit" class="btn btn-default"/>
					</form>
				<?php
				include_once("includes/footer.php");
				?>
