<!--
	vue/index.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Page d'accueil du blog, affichage des 10 derniers
	billets, pagination (AFFICHAGE UNIQUEMENT)

	Inclus dans : controleur/index.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
						//Affichage des 10 derniers billets
						?>
						<h1 style="text-align: center">Recherche d'articles par tag</h1>
						<form id="f1" method="get" action="search.php">
							<div class="form-group">
								<label for="cat">Tag </label>
								<select onchange="document.forms['f1'].submit();" class="form-control" name="cat" id="cat">
									<optgroup label="Sélectionné">
										<option value="<?php echo $_GET["cat"]; ?>"><?php echo $catName; ?></option>
									</optgroup>
									<optgroup label="Tous les tags">
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
									</optgroup>
								</select>
							</div>
						</form>
						<h2 style="text-align: center">Résultats pour : <?php echo $catName; ?></h2>
						<?php
						foreach ($billets as $billet)
						{
							if (!empty($billet["id"])) //Anti-lignes fantômes
							{
								?>
									<div class="thumbnail">
										<?php 
											if (!empty($billet["image"]))
											{
												$ShowImg = AffichageImage($billet["image"]);
												echo $ShowImg;
											}
											//BBCODE-like
											$billet["contenu"] = preg_replace("#\[alert=(success|info|warning|danger)\](.+)\[/alert\]#isU","<div class=\"alert alert-$1\" role=\"alert\">$2</div>",$billet["contenu"]); //alert boxes
											$billet["contenu"] = preg_replace("#\[b\](.+)\[/b\]#isU","<strong>$1</strong>",$billet["contenu"]); //bold
											$billet["contenu"] = preg_replace("#\[i\](.+)\[/i\]#isU","<em>$1</em>",$billet["contenu"]); //italic
											$billet["contenu"] = preg_replace("#\[color=(blue|red|green|\#[a-z0-9]{6})\](.+)\[/color\]#isU","<span style=\"color: $1\">$2</span>",$billet["contenu"]); //color
											$billet["contenu"] = preg_replace("#url!(https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)#i", "<a href='$1'>$1</a>", $billet["contenu"]); // url (with url!)
											$billet["contenu"] = preg_replace("#\[img=(.+)\](https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)\[/img\]#isU", "<img src='$2' alt='$1'/>", $billet["contenu"]); //images
											$billet["contenu"] = preg_replace("#(\\\')#i","'", $billet["contenu"]); //'
											$billet["contenu"] = preg_replace('#(\\\")#i','"', $billet["contenu"]); //'
											$billet["titre"] = preg_replace("#(\\\')#i","'", $billet["titre"]); //'
											$billet["titre"] = preg_replace('#(\\\")#i','"', $billet["titre"]); //'
											//Fin du BBCODE-like
										?>
										<div class="caption">
											<h2><?php echo $billet["titre"]; ?></h2>
											<h3>Ecrit par <?php echo $billet["auteur"]; ?> <?php echo $billet["datewrote"]; ?></h3>
											<?php echo nl2br($billet["contenu"]); ?><br />
											<a href="commentaires.php?id=<?php echo $billet['id']; ?>">Voir les commentaires --></a>
										</div>
									</div>
								<?php
							}
						}
				include_once("includes/footer.php");
				?>
