<!--
	vue/membre.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Espace membre privé
	
	Inclus dans : controleur/membre.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					if (!isset($user))
					{
						echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] Merci de préciser le pseudo d'un membre dans l'URL.</div>";
						include_once("includes/footer.php");
						die;
					} else if (empty($user)) {
						echo "<div class=\"alert alert-danger\" role=\"alert\">[ERREUR] Ce pseudo n'existe pas dans notre base de données. Merci de vérifier l'orthographe du pseudo.</div>";
						include_once("includes/footer.php");
						die;
					}
					?>
					<!--Initializing Google Charts - comments-->
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
				    <script type="text/javascript">
				      google.load("visualization", "1", {packages:["corechart"]});
				      google.setOnLoadCallback(drawChart);
				      function drawChart() {

				        var data = google.visualization.arrayToDataTable([
				          ['Commentaires', 'Proportion'],
				          ['Ses commentaires', <?php echo $nbcomms; ?>],
				          ['Autres commentaires',    <?php echo $nbcommsG; ?>]
				        ]);

				        var options = {
				          title: 'Ses commentaires par rapport au trafic total'
				        };

				        var chart = new google.visualization.PieChart(document.getElementById('comment'));

				        chart.draw(data, options);
				      }
				    </script>
				    <script type="text/javascript">
				      google.load("visualization", "1", {packages:["corechart"]});
				      google.setOnLoadCallback(drawChart);
				      function drawChart() {

				        var data = google.visualization.arrayToDataTable([
				          ['Posts', 'Proportion'],
				          ['Ses posts', <?php echo $nbposts; ?>],
				          ['Autres posts',    <?php echo $nbpostsG; ?>]
				        ]);

				        var options = {
				          title: 'Ses posts par rapport au trafic total'
				        };

				        var chart = new google.visualization.PieChart(document.getElementById('post'));

				        chart.draw(data, options);
				      }
				    </script>
					<u><h1 style="text-align: center">A propos de :</h1></u>
					<h2 style="text-align: center"><?php echo $user["pseudo"]; ?></h2>
					<img style="display: block; margin-left: auto; margin-right: auto; width: 80px; height: 80px" src="<?php echo $url; ?>" alt="<?php echo $user["pseudo"]; ?>" class="img-circle"/><br />
					<p style="text-align: center">Inscrit depuis <?php echo $date; ?></p>
					<p style="text-align: center">Rang : <?php echo $rank; ?></p>
					<p style="text-align: center">Nombre de commentaires : <?php echo $nbcomms; ?></p>
					<p style="text-align: center">Nombre de posts : <?php echo $nbposts; ?></p>
					<?php if ($nbcommstempG != 0) { ?><div id="comment" style="width: 900px; height: 500px; display: block; margin-left: auto; margin-right: auto;"></div><?php } ?>
					<?php if ($nbpoststempG != 0) { ?><div id="post" style="width: 900px; height: 500px; display: block; margin-left: auto; margin-right: auto;"></div><?php } ?>
				<?php
				include_once("includes/footer.php");
				?>