		<?php
		include_once("includes/header.php");
		if ($post)
		{
			echo "<div class=\"alert alert-success\" role=\"alert\">Le billet a été publié :)<br /><br /><a href=\"index.php\"><-- Revenir au menu de modération !</a></div>";
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
				<label for="auteur">Auteur : </label><input class="form-control" type="text" name="auteur" id="auteur" readonly value="<?php echo $author;?>">
			</div>
			<div class="form-group">
				<label for="titre">Titre de la news : </label><input type="text" class="form-control" name="titre" id="titre"><br />
			</div>
			<div class="form-group">
				<label for="contenu">Contenu de la news : </label><textarea name="contenu" class="form-control" id="contenu" rows="30" ></textarea><br />
			</div>
			<div class="form-group">
				<label for="pic">Image à associer : </label>
				<select class="form-control" name="picture" id="pic">
					<option value="">Aucune image</option>
					<?php
					$checker = 1;
					foreach ($listepics as $pic)
					{
						//Checker qui élimine les doublons de la liste via un raisonnement simpliste
						if ($pic["id"] == $checker)
						{
							echo "<option value='".$pic["name"]."'>".$pic["name"]."</option>";
						}
						$checker += 1;
					}
					?>
				</select>
			</div>
			<input type="submit" class="btn btn-default"/>
		</form>
				</div>
			</div>
		</div>
		<br />
	</body>
</html>
