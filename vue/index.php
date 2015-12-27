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
					?>
					<!-- Tag cloud -->
					<style>
					#tagsphere{
						background: url('http://www.kicoe.net/images/background.png') top center no-repeat;
						height: 230px; width: 380px;
						padding: 10px;
						margin: 10px;
						margin: 0 auto;
					}
					</style>
					<?php
					if ($tagShow == "true") {
					?>
					<div id="tagsphere">
					 	<ul>
					 		<?php
					 		$latest = "set";
							foreach ($cats as $cat)
							{
								if ($latest != $cat["nom"])
								{
									echo "<li><a href='search.php?cat=".$cat["id"]."'>".$cat["nom"]."</a></li>";
									$latest = $cat["nom"];
								}
							}
					 		?>
						</ul>
					</div>
						<?php
					}
						if ($carrouselShow == "true") {
							?>
							<!-- http://www.bkosborne.com/jquery-waterwheel-carousel -->
							<style type="text/css">
								#carousel {
								  width:auto;
								  height: 300px;
								  display: relative;
								}
								#carousel img {
								  display: hidden; /* hide images until carousel prepares them */
								  cursor: pointer; /* not needed if you wrap carousel items in links */
								}
							</style>
							<div id="carousel">
								<a href="commentaires.php?id=<?php echo $link1; ?>"><img src="images_static/<?php echo $img1; ?>" alt="Image 1 - carrousel" /></a>
								<a href="commentaires.php?id=<?php echo $link2; ?>"><img src="images_static/<?php echo $img2; ?>" alt="Image 2 - carrousel" /></a>
								<a href="commentaires.php?id=<?php echo $link3; ?>"><img src="images_static/<?php echo $img3; ?>" alt="Image 3 - carrousel" /></a>
							</div>
							<!--End of waterwheel carousel-->
							<?php
						}
							//Affichage des 10 derniers billets
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
												//BBCODE-like + fix
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
												//Fin du BBCODE-like + fix
											?>
											<div class="caption">
												<h2><?php echo $billet["titre"]; ?></h2>
												<h3>Ecrit par <?php echo $billet["auteur"]; ?> <?php echo $billet["datewrote"]; ?></h3>
												<?php echo nl2br($billet["contenu"]); ?><br />
												<a href="commentaires.php?id=<?php echo $billet['id']; ?>">Voir les commentaires --></a>
											</div>
										</div>
										<!-- http://www.bkosborne.com/jquery-waterwheel-carousel -->
										<script type="text/javascript" src="vue/js/jquery.waterwheelCarousel.min.js"></script>
										<script type="text/javascript">
										  $(document).ready(function() {
										    $("#carousel").waterwheelCarousel({
												speed : 1000,
												forcedImageWidth : 400,
												forcedImageHeight : 280,  
												separation: 400,
												autoPlay: 10000
										    });
										  });
										</script>
										<!--End of waterwheel carousel-->
										<!-- http://www.jqueryscript.net/text/3D-Sphere-Tag-Cloud-Plugin-with-jQuery-CSS3-TagSphere.html -->
										<script src="vue/js/jquery.tagsphere.js"></script> 
										<script type="text/javascript">
										$(document).ready(function(){
										    $('#tagsphere').tagSphere({
										        height: 230,
										        width: 380,
										        slower: 0.01,
										        radius: 80,
										        timer: 95,
										        fontMultiplier: 20
										    });
										});
										</script>
										<!-- End of Sphere Tag -->
									<?php
								}
							}
							?>
								<nav>
									<ul class="pager">
										<li class="previous <?php if ($precedent == false) {echo "disabled";} ?>"><a href="<?php if ($precedent == true) {echo "index.php?page=".$pagePrecedent;} ?>"><span aria-hidden="true">&larr;</span> Plus récent</a></li>
										<li class="next <?php if ($suivant == false) {echo "disabled";} ?>"><a href="<?php if ($suivant == true) {echo "index.php?page=".$pageSuivant;} ?>">Plus vieux <span aria-hidden="true">&rarr;</span></a></li>
									</ul>
								</nav>
							<?php
					include_once("includes/footer.php");
				?>
