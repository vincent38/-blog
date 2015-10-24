					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
					<!--Initializing Google Charts - comments-->
					<script type="text/javascript" src="https://www.google.com/jsapi"></script>
				    <script type="text/javascript">
				      google.load("visualization", "1", {packages:["corechart"]});
				      google.setOnLoadCallback(drawChart);
				      function drawChart() {

				        var data = google.visualization.arrayToDataTable([
				          ['Commentaires', 'Proportion'],
				          ['Mes commentaires', <?php echo $nbcomms; ?>],
				          ['Autres commentaires',    <?php echo $nbcommsG; ?>]
				        ]);

				        var options = {
				          title: 'Mes commentaires par rapport au trafic total'
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
				          ['Mes posts', <?php echo $nbposts; ?>],
				          ['Autres posts',    <?php echo $nbpostsG; ?>]
				        ]);

				        var options = {
				          title: 'Mes posts par rapport au trafic total'
				        };

				        var chart = new google.visualization.PieChart(document.getElementById('post'));

				        chart.draw(data, options);
				      }
				    </script>
					<u><h1 style="text-align: center">A propos de :</h1></u>
					<h2 style="text-align: center"><?php echo $_SESSION["pseudo"]; ?></h2>
					<img style="display: block; margin-left: auto; margin-right: auto; width: 80px; height: 80px" src="<?php echo $url; ?>" alt="<?php echo $_SESSION["pseudo"]; ?>" class="img-circle"/><br />
					<p style="text-align: center">Inscrit depuis <?php echo $_SESSION["date"]; ?></p>
					<p style="text-align: center">Rang : <?php echo $rank; ?></p>
					<p style="text-align: center">Nombre de commentaires : <?php echo $nbcomms; ?></p>
					<p style="text-align: center">Nombre de posts : <?php echo $nbposts; ?></p>
					<?php if ($nbcommstempG != 0) { ?><div id="comment" style="width: 900px; height: 500px; display: block; margin-left: auto; margin-right: auto;"></div><?php } ?>
					<?php if ($nbpoststempG != 0) { ?><div id="post" style="width: 900px; height: 500px; display: block; margin-left: auto; margin-right: auto;"></div><?php } ?>
				<?php
				include_once("includes/footer.php");
				?>