					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
						<h2 style="text-align: center;">Bienvenue sur l'espace de modération !</h2>
						<div class="well">
							<a class="btn btn-default" href="add_post.php" role="button"><i class="fa fa-plus"></i> Créer un nouvel article</a>
							<a class="btn btn-default" href="upload.php" role="button"><i class="fa fa-cloud-upload"></i> Importer une nouvelle image</a>
						</div>
						<h2 style="text-align: center;">Liste des commentaires postés</h2>
						<p style="text-align: center;">Cliquez sur un commentaire trop long pour l'afficher en entier</p>
						<table class="table">
						<?php
						foreach ($comments as $comment)
						{
							if(!empty($comment["id"]))
							{
								$backup = $comment["commentaire"];
								if (strlen($comment["commentaire"])>50)
										{
											$comment["commentaire"] = substr($comment["commentaire"], 0, 50);
											$comment["commentaire"].="...";
										}
								echo "<tr><th>".$comment['id']."</th><th>Commentaire publié par ".$comment["auteur"]." ".$comment["datewrote"]." : <span onclick='alert(\"".$backup."\");'>".$comment["commentaire"]."</span></th><th><a href='moderation.php#' onclick='if (confirm(\"Etes-vous sûr de vouloir supprimer ce commentaire ? Cette action est irréversible !\")) {document.location.href=\"delete_comment.php?id=".$comment["id"]."\";}' return false;>Supprimer le commentaire</a></th></tr>";
							}
						}
						?>
						<thead>
							<tr><th>ID</th><th>Commentaires</th><th>Actions</th></tr>
						</thead>
						</table>
						<br />
						<h2 style="text-align: center;">Liste des billets postés</h2>
						<table class="table">
						<?php
						foreach ($posts as $post)
						{
							if(!empty($post["id"]))
							{
								$texte = $post["contenu"];
								if (strlen($texte)>50)
										{
											$texte = substr($texte, 0, 50);
											$lastword = strrpos($texte, " ");
											$texte=substr($texte,0,$lastword);
											$texte.="...";
										}
								if ($post["available"] == 0)
								{
									$state = '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>';
								}
								else
								{
									$state = '<span class="glyphicon glyphicon-globe" aria-hidden="true"></span>';
								}
								echo "<tr><th>".$post["id"]."</th><th>".$state."</th><th>Post publié par ".$post["auteur"]." ".$post["datecomment"]." avec le titre : ".$post["titre"]." - ".$texte."</th><th><a href='edit_post.php?id=".$post["id"]."''>Editer</a> - <a href='moderation.php#' onclick='if (confirm(\"Etes-vous sûr de vouloir supprimer ce post ? Cette action est irréversible !\")) {document.location.href=\"delete_post.php?id=".$post["id"]."\";}' return false;>Supprimer</a></th>";
							}
						}
						?>
						<thead>
							<tr><th>ID</th><th>Disponibilité</th><th>Billets</th><th>Actions</th></tr>
						</thead>
						</table>
				<?php
				include_once("includes/footer.php");
				?>