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
			<input type="submit" class="btn btn-primary"/>   <input type="reset" class="btn btn-warning"/>
		</form> 
				</div>
			</div>
		</div>
	</body>
</html>