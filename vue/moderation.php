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
								echo "<tr><th>".$post["id"]."</th><th>Post publié par ".$post["auteur"]." ".$post["datecomment"]." avec le titre : ".$post["titre"]." - ".$texte."</th><th><a href=edit_post.php?id=".$post["id"].">Editer</a> - <a href=suppressionbillet.php?id=".$post["id"].">Supprimer</a></th>";
							}
						}
						?>
						<thead>
							<tr><th>ID</th><th>Commentaires</th><th>Actions</th></tr>
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