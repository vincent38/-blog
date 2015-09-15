<!DOCTYPE html>
<html>
	<head>
		<!-- En-tête de la page -->
		<meta charset="utf-8">
		<!--[if lt IE 9]>
			<script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
		<![endif]-->
		<title>Inscription</title>
	</head>
	
	<body>
		<!-- Corps de la page -->
		<?php
		if ($form == true)
		{
			?>
				<form method="post" action="inscription.php">
					<label for="pseudo">Pseudonyme : </label><input type="text" name="pseudo" id="pseudo" /><br />
					<label for="mail">Email : </label><input type="text" name="mail" id="mail" /><br />
					<label for="pass1">Mot de passe : </label><input type="password" name="pass1" id="pass1" /><br />
					<label for="pass2">Confirmez mot de passe : </label><input type="password" name="pass2" id="pass2" /><br />
					<input type="submit" />
				</form>
			<?php
		}
		?>
	</body>
</html>