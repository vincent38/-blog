<!--
	vue/delete_comment.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Système de suppression des commentaires.

	Inclus dans : controleur/delete_comment.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if ($deleted)
					{
						echo "<div class=\"alert alert-info\" role=\"alert\"><i class=\"fa fa-check\"></i> Le commentaire a été supprimé. Vous pouvez être fier de vous. Monstre :'(<br /><br /><a href=\"moderation.php\"><-- Revenir au menu de modération !</a></div>";
					}
					else
					{
						echo "<div class=\"alert alert-info\" role=\"alert\"><i class=\"fa fa-times\"></i> Le système de suppression n'a pas été chargé.<br />Cause : Commentaire non défini, ou inexistant.<br /><a href=\"moderation.php\"><-- Revenir au menu de modération !</a></div>";
					}
					?>
				<?php
				include_once("includes/footer.php");
				?>
