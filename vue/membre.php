					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
					<u><h1 style="text-align: center">A propos de :</h1></u>
					<h2 style="text-align: center"><?php echo $_SESSION["pseudo"]; ?></h2>
					<img style="display: block; margin-left: auto; margin-right: auto; width: 80px; height: 80px" src="<?php echo $url; ?>" alt="<?php echo $_SESSION["pseudo"]; ?>" class="img-circle"/><br />
					<p style="text-align: center">Inscrit depuis <?php echo $_SESSION["date"]; ?></p>
					<p style="text-align: center">Rang : Administrateur</p>
					<p style="text-align: center">Nombre de commentaires : <?php echo $nbcomms; ?></p>
					<p style="text-align: center">Nombre de posts : <?php echo $nbposts; ?></p>
				</div>
			</div>
		</div>
	</body>
</html>