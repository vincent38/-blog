<!--
	vue/commentaires.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Affichage d'un billet en particulier et de ses commentaires,
	formulaire pour poster un commentaire (membres authentifiés/anonymes)
	
	Inclus dans : controleur/commentaires.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
					<?php
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
										$billets["contenu"] = preg_replace("#\[color=(blue|red|green|\#[a-z0-9]{6})\](.+)\[/color\]#isU","<span style=\"color: $1\">$2</span>",$billets["contenu"]); //color
										$billets["contenu"] = preg_replace("#url!(https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)#i", "<a href='$1'>$1</a>", $billets["contenu"]); // url (with url!)
										$billets["contenu"] = preg_replace("#\[img=(.+)\](https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)\[/img\]#isU", "<img src='$2' alt='$1'/>", $billets["contenu"]); //images
										$billets["contenu"] = preg_replace("#(\\\')#i","'", $billets["contenu"]); //'
										$billets["contenu"] = preg_replace('#(\\\")#i','"', $billets["contenu"]); //'
										$billets["titre"] = preg_replace("#(\\\')#i","'", $billets["titre"]); //'
										$billets["titre"] = preg_replace('#(\\\")#i','"', $billets["titre"]); //'
										//Fin du BBCODE-like
									?>
									<div class="caption">
										<h2><?php echo $billets["titre"]; ?></h2>
										<h3>Ecrit par <?php echo $billets["auteur"]; ?> <?php echo $billets["datewrote"]; ?></h3>
										<h4>Tag : <?php echo Categorie($_GET["id"]); ?></h4>
										<?php echo nl2br($billets["contenu"]); ?><br /><br />
										<p>
											<!--Twitter JS - Modifiez le compte twitter via apivariables.php-->
											<a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $twitter_account; ?>" data-size="large">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
										</p>
									</div>
								</div>
							<?php
						}
						else
						{
							echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] Aucun post ne porte l'ID renseignée. Celui-ci n'existe pas (ou plus). Sorry :/</div>"; 
							include_once("includes/footer.php");
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
								$comment["commentaire"] = preg_replace("#(\\\')#i","'", $comment["commentaire"]); //'
								$comment["commentaire"] = preg_replace('#(\\\")#i','"', $comment["commentaire"]); //'
								echo "<div class='well well-sm'>";
								echo "<img style=\"width: 80px; height: 80px; margin-right: 15px;  float: left\" src='".get_gravatar(gatherMail($comment["auteur"]))."' alt='".$comment["auteur"]."' class=\"img-circle\"/>";
								echo "<h4>".$comment["auteur"]." a écrit ".$comment["datewrote"]." :</h4>";
								echo "<p>".$comment["commentaire"]."</p><br /></div>";
							}
						}
					}
					?>
					<br />
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
									<label for="commentaire">Commentaire (130 caractères maximum) : </label>
									<input type="text" class="form-control" name="commentaire" id="commentaire" maxlength="130" />
								</div>
								<input type="hidden" name="id_billet" id="titre" value="<?php echo $_GET["id"]; ?>">
								<button type="submit" class="btn btn-success">
					                <i class="fa fa-commenting"></i> Envoyer le commentaire
					            </button>
							</form>
							<?php
						}
						else
						{
							echo $error;
						}
						?>
						<script>
						function getPost(){
							var xhr = new XMLHttpRequest();

							var id = encodeURIComponent(<?php echo $_GET["id"]; ?>);

							xhr.open('GET', "ajax/getPost.php?id="+id);

							xhr.addEventListener("readystatechange", function(){
								if (xhr.readyState === 4 && xhr.status === 200){
									document.getElementById("post").innerHTML = xhr.responseText;
								}
							},false)

							xhr.send(null);

							setTimeout(getPost,10000);
						}
						getPost();

						</script>
						<?php
						include_once("includes/footer.php");
					?>