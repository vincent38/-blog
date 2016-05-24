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
		<form method="post" action="edit_post.php?id=<?php echo $_GET["id"];?>">
			<h2 style="text-align: center;">Edition en cours de : <?php echo htmlspecialchars($postToEdit["titre"]); ?></h2>
			<div class="form-group">
				<label for="auteur">Auteur : </label><input class="form-control" type="text" name="auteur" id="auteur" readonly='readonly' value="<?php echo htmlspecialchars($postToEdit["auteur"]);?>">
			</div>
			<div class="form-group">
				<label for="titre">Titre de la news : </label><input type="text" class="form-control" name="titre" id="titre" value="<?php echo htmlspecialchars($postToEdit["titre"]);?>"><br />
			</div>
			<div class="form-group">
				<label for="contenu">Contenu de la news : </label><br />
				<?php
							if ($imgshack == true)
							{
								?>
								<p>Uploadeur imageshack : Connecté. <a onclick="popup('sendimgshack.php', '', 'width=800, height=800, location=no, menubar=no, status=no, scrollbars=no, menubar=no')"><i class="fa fa-cloud-upload"></i> Envoyer une image</a></p>
								<?php
							} else {
								?>
								<p>Uploadeur imageshack : Déconnecté. <a href="loginimgshack.php">Se connecter !</a></p>
								<?php
							}
							?>
							<div class="well"><a class="btn btn-default" onclick="bold()" role="button"><i class="fa fa-bold"></i></a>
							<a class="btn btn-default" onclick="italic()" role="button"><i class="fa fa-italic"></i></a>
							<div class="btn-group">
								<button name="color" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Couleur du texte <span class="caret"></span></button>
							  	<ul class="dropdown-menu">
							    	<li><a onclick="colorB()" value="blue">Bleu</a></li>
							   	 	<li><a onclick="colorB()" value="blue">Rouge</a></li>
							   	 	<li><a onclick="colorB()" value="blue">Vert</a></li>
							  	</ul>
							</div>
							<a class="btn btn-default" onclick="link()" role="button"><i class="fa fa-link"></i></a>
							<a class="btn btn-default" onclick="img()" role="button"><i class="fa fa-picture-o"></i></a>
							<div class="btn-group">
								<button name="alert" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Information <span class="caret"></span></button>
							  	<ul class="dropdown-menu">
							   	 	<li><a onclick="alert('success')" value="success">Information positive</a></li>
									<li><a onclick="alert('info')" value="info">Information standard</a></li>
									<li><a onclick="alert('warning')" value="warning">Information importante</a></li>
									<li><a onclick="alert('danger')" value="danger">Information urgente</a></li>
							  	</ul>
							</div></div>
				<textarea name="contenu" class="form-control" id="contenu" rows="30" ><?php $postToEdit["contenu"] = preg_replace("#(\\\')#i","'", $postToEdit["contenu"]); echo htmlspecialchars($postToEdit["contenu"]);?></textarea><br />
				<button class="btn btn-default" type="button" onclick="reloadPreview()">Recharger la prévisualisation</button>
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
			<p>Tag : <?php echo Categorie($_GET["id"]); ?></p>
			<div class="checkbox">
			  <label>
			    <input type="checkbox" <?php if ($postToEdit["available"] == 0) {echo " checked ";}?> name="available" value="set :D">
			    Ne pas publier l'article : celui-ci n'apparaîtra pas sur la page d'accueil et ne sera pas accessible publiquement.
			  </label>
			</div>
			<input name="id" id="id" hidden value="<?php echo $_GET["id"];?>">
			<input type="submit" class="btn btn-default"/>
		</form>
		<br />
					<label>Prévisualisation :</label>
					<div id="livepreview" class="thumbnail">
						Pas de texte à afficher...
					</div>
					<!-- Live preview-->
					<script>
						function reloadPreview()
						{
							var preview = document.getElementById("livepreview");
							var text = document.getElementById("contenu").value;

							var xhr = new XMLHttpRequest();

							xhr.open("POST", "ajax/livePreview.php");

							xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

							xhr.addEventListener("readystatechange", function(){
								if (xhr.readyState === 4 && xhr.status === 200){
									if (xhr.responseText.length == 0)
									{
										preview.innerHTML = "Pas de texte à afficher...";
									} else {
										preview.innerHTML = xhr.responseText;
									}
								}
							},false)

							xhr.send("text="+text);
						}

						reloadPreview();
						function popup(page, nom, option)
						{
							window.open(page, nom, option);
						}
						function bold()
						{
							var text = document.getElementById("contenu");
							text.value += "[b]Texte...[/b]"
						}
						function italic()
						{
							var text = document.getElementById("contenu");
							text.value += "[i]Texte...[/i]"
						}
						function colorB()
						{
							var text = document.getElementById("contenu");
							text.value += "[color=blue][/color]"
						}
						function colorR()
						{
							var text = document.getElementById("contenu");
							text.value += "[color=red][/color]"
						}
						function colorV()
						{
							var text = document.getElementById("contenu");
							text.value += "[color=green][/color]"
						}
						function link()
						{
							var text = document.getElementById("contenu");
							text.value += "url!url!http://votrelienici.com"
						}
						function img()
						{
							var text = document.getElementById("contenu");
							text.value += "[img=Description]Lien vers l'image (http://)[/img]"
						}
						function alert(type)
						{
							var text = document.getElementById("contenu");
							text.value += "[alert="+type+"][/alert]"
						}
					</script>
	<?php
	include_once("includes/footer.php");
	?>
