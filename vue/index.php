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
						<img src="images_static/1.jpg" alt="Image 1" />
						<img src="images_static/2.jpg" alt="Image 2" />
						<img src="images_static/3.jpg" alt="Image 3" />
					</div>
					<!--End of waterwheel carousel-->
					<?php
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
									<!-- http://www.bkosborne.com/jquery-waterwheel-carousel -->
									<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
									<script type="text/javascript" src="vue/js/jquery.waterwheelCarousel.min.js"></script>
									<script type="text/javascript">
									  $(document).ready(function() {
									    $("#carousel").waterwheelCarousel({
											flankingItems: 1,
											autoPlay : 10000,
											speed : 1000,
											forcedImageWidth : 400,
											forcedImageHeight : 280,
											movingToCenter: function ($item) {
												$('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
											},
											movedToCenter: function ($item) {
												$('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
											},
											movingFromCenter: function ($item) {
												$('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
											},
											movedFromCenter: function ($item) {
												$('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
											}   
									    });
									  });
									</script>
									<!--End of waterwheel carousel-->
								<?php
							}
						}
				include_once("includes/footer.php");
				?>
