<!--
	vue/connexion.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Formulaire de connexion + traitement
	
	Inclus dans : controleur/connexion.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
							<form method="post" action="sendimgshack.php" enctype="multipart/form-data">
								<h2 style="text-align: center;">Importer une image sur Imageshack</h2>
								<div class="form-group">
									<label for="file">Image : </label><input type="file" name="file" id="file"/>
								</div>
								<div class="form-group">
									<label for="title">Titre : </label><input class="form-control" type="text" name="title" id="title"/>
								</div>
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-cloud-upload"></i> Uploader l'image
								</button>
							</form>
							<?php
						if (isset($outParsed) AND $outParsed["success"] == 1)
						{
							echo "<br /><div class=\"alert alert-info\" role=\"alert\"><i class=\"fa fa-check\"></i> Importation de l'image terminée !<br />
							Lien direct vers l'image : http://imageshack.com/a/img".$outParsed["result"]["images"][0]["server"]."/".$outParsed["result"]["images"][0]["bucket"]."/".$outParsed["result"]["images"][0]["filename"]."<br />
							Titre de l'image : ".$outParsed["result"]["images"][0]["title"]."<br />
							Espace restant sur votre compte : ".$outParsed["result"]["space_left"]."/".$outParsed["result"]["space_limit"]." octets<br />
							<br />
							Votre lien BBCODE : <input class=\"form-control\" type=\"text\" name=\"bbcode\" value='[img=".$outParsed["result"]["images"][0]["title"]."]http://imageshack.com/a/img".$outParsed["result"]["images"][0]["server"]."/".$outParsed["result"]["images"][0]["bucket"]."/".$outParsed["result"]["images"][0]["filename"]."[/img]'/><br />
							Copiez-collez ce lien dans votre article pour ajouter l'image.</div>";
						}
				include_once("includes/footer.php");
				?>