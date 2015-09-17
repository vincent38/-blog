<!--
	vue/commentaires.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Affichage d'un billet en particulier et de ses commentaires,
	formulaire pour poster un commentaire (membres authentifiés/anonymes)
	
	Inclus dans : controleur/index.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
						if (!empty($billets["id"])) //Anti-lignes fantômes
						{
							?>
								<div class="thumbnail">
									<?php 
										if (!empty($billets["image"]))
										{
											$ShowImg = AffichageImage($billets["image"]);
											echo $ShowImg;
										}
										//BBCODE-like
										$billets["contenu"] = preg_replace("#\[alert=(success|info|warning|danger)\](.+)\[/alert\]#isU","<div class=\"alert alert-$1\" role=\"alert\">$2</div>",$billets["contenu"]); //bold
										$billets["contenu"] = preg_replace("#\[b\](.+)\[/b\]#isU","<strong>$1</strong>",$billets["contenu"]); //bold
										$billets["contenu"] = preg_replace("#\[i\](.+)\[/i\]#isU","<em>$1</em>",$billets["contenu"]); //italic
										$billets["contenu"] = preg_replace("#\[color=(blue|red|green|\#[a-z0-9]{6})\](.+)\[/color\]#isU","<span style=\"color: $1\">$2</strong>",$billets["contenu"]); //color
										$billets["contenu"] = preg_replace("#url!(https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)#i", "<a href='$1'>$1</a>", $billets["contenu"]); // url (with url!)
										$billets["contenu"] = preg_replace("#\[img=(.+)\](https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)\[/img\]#isU", "<img src='$2' alt='$1'/>", $billets["contenu"]); //images
										$billets["contenu"] = preg_replace("#(\\\')#i","'", $billets["contenu"]); //'
										//Fin du BBCODE-like
									?>
									<div class="caption">
										<h2><?php echo $billets["titre"]; ?></h2>
										<h3>Ecrit par <?php echo $billets["auteur"]; ?> <?php echo $billets["datewrote"]; ?></h3>
										<?php echo $billets["contenu"]; ?><br />
									</div>
								</div>
							<?php
						}
						else
						{
							echo "[ERREUR] Aucun post ne porte l'ID renseignée. Celui-ci n'existe pas (ou plus). Sorry :/"; 
							die;
						}
					?>
					<!--Partie commentaires + post-->
					<h2>Commentaires</h2>
					<?php
					{
						foreach ($comments as $comment)
						{
							if (!empty($comment["id"]))
							{
								echo "<div class='well well-sm'>";
								echo "<h4>".$comment["auteur"]." a écrit ".$comment["datewrote"]." :</h4>";
								echo "<p>".$comment["commentaire"]."</p></div>";
							}
						}
					}
					?>
					<!--Formulaire pour poster un commentaire-->
					<?php
						if ($form == true)
						{
							?>
							<form method="post" action="commentaires.php?id=<?php if (isset($_POST["id"])) {echo $_POST["id"];} else {echo $_GET["id"];} ?>">
								<h4>Poster un commentaire :</h4>
								<div class="form-group">
									<label for="auteur">Pseudonyme : </label>
									<input disabled type="text" name="auteur" id="auteur" class="form-control" value="<?php echo $_SESSION["pseudo"]; ?>">
								</div>				
								<div class="form-group">
									<label for="commentaire">Commentaire : </label>
									<input type="text" class="form-control" name="commentaire" id="commentaire" />
								</div>
								<input type="hidden" name="id_billet" id="titre" value="<?php echo $_GET["id"]; ?>">
								<div class="form-group">
									<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_key; ?>"></div>
								</div>
								<input type="submit" class="btn btn-default"/>
							</form>
							<?php
						}
						else
						{
							echo $error;
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>