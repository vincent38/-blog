<!--
	vue/upload.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Ajouter un billet (Modérateur/rédacteur et/ou administrateur)
	
	Inclus dans : controleur/upload.php
-->
		<?php
		include_once("includes/header.php");
		if (!empty($error))
		{
			echo $error;
		}
		?>
		<form method="post" action="upload.php" enctype="multipart/form-data">
			<h2 style="text-align: center;">Importer une image (maximum 8 Mo)</h2>
			<div class="form-group">
				<label for="pic">Image : </label><input type="file" name="pic" id="pic"/>
			</div>
			<div class="form-group">
				<label for="desc">Description de l'image : </label><input type="text" class="form-control" name="desc" id="desc" />
			</div>
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-cloud-upload"></i> Uploader l'image
			</button>
			<button type="submit" class="btn btn-warning">
				<i class="fa fa-eraser"></i> Réinitialiser
			</button>
		</form> 
	<?php
	include_once("includes/footer.php");
	?>