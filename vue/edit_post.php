		<?php
		include_once("includes/header.php");
		if ($post)
		{
			echo "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> Le billet a été édité :)<br /><br /><a href=\"moderation.php\"><-- Revenir au menu de modération !</a></div>";
			die;
		}
		if ($alarmNoPostDetected)
		{
			echo "<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fa fa-times\"></i> Le billet demandé n'existe pas !<br />L'éditeur a été automatiquement fermé. :/<br /><a href=\"moderation.php\"><-- Revenir au menu de modération !</a></div>";
			die;
		}
		?>
		<form method="post" action="edit_post.php">
			<h2 style="text-align: center;">Edition en cours de : <?php echo htmlspecialchars($postToEdit["titre"]); ?></h2>
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
				<label for="auteur">Auteur : </label><input class="form-control" type="text" name="auteur" id="auteur" readonly value="<?php echo htmlspecialchars($postToEdit["auteur"]);?>">
			</div>
			<div class="form-group">
				<label for="titre">Titre de la news : </label><input type="text" class="form-control" name="titre" id="titre" value="<?php echo htmlspecialchars($postToEdit["titre"]);?>"><br />
			</div>
			<div class="form-group">
				<label for="contenu">Contenu de la news : </label><textarea name="contenu" class="form-control" id="contenu" rows="30" ><?php $postToEdit["contenu"] = preg_replace("#(\\\')#i","'", $postToEdit["contenu"]); echo htmlspecialchars($postToEdit["contenu"]);?></textarea><br />
			</div>
			<div class="form-group">
				<label for="picture">Image à associer : </label>
				<select class="form-control" name="pic" id="picture">
					<?php
					echo "<option value='".$postToEdit["image"]."'>Image par défaut (aucune si vide) : ".$postToEdit["image"]."</option>";
					echo "<option value=''>Aucune image</option>";
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
			<div class="checkbox">
			  <label>
			    <input type="checkbox" <?php if ($postToEdit["available"] == 0) {echo " checked ";}?> name="available" value="set :D">
			    Ne pas publier l'article : celui-ci n'apparaîtra pas sur la page d'accueil et ne sera pas accessible publiquement.
			  </label>
			</div>
			<input name="id" id="id" hidden value="<?php echo $_GET["id"];?>">
			<input type="submit" class="btn btn-default"/>
		</form>
	<?php
	include_once("includes/footer.php");
	?>
