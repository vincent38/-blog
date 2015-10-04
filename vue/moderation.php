					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
						<h2 style="text-align: center;">Liste des commentaires postés</h2>
						<table class="table">
						<?php
						foreach ($comments as $comment)
						{
							if(!empty($comment["id"]))
							{
								echo "<tr><th>".$comment['id']."</th><th>Commentaire publié par ".$comment["auteur"]." ".$comment["datewrote"]." : ".$comment["commentaire"]."</th><th><a href=suppression.php?id=".$comment["id"].">Supprimer le commentaire</a></th></tr>";
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
								echo "<tr><th>".$post["id"]."</th><th>".$state."</th><th>Post publié par ".$post["auteur"]." ".$post["datecomment"]." avec le titre : ".$post["titre"]." - ".$texte."</th><th><a href=edit_post.php?id=".$post["id"].">Editer</a> - <a href='moderation.php#' onclick='if (confirm(\"Etes-vous sûr de vouloir supprimer ce post ? Cette action est irréversible !\")) {document.location.href=\"delete_post.php?id=".$post["id"]."\";}' return false;>Supprimer</a></th>";
							}
						}
						?>
						<thead>
							<tr><th>ID</th><th>Disponibilité</th><th>Billets</th><th>Actions</th></tr>
						</thead>
						</table>
						</div>
						</div>
						</div>
						<br />
				</div>
			</div>
		</div>
	</body>
</html>