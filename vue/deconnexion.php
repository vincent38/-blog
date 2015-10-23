				<?php  
				include_once("includes/header.php");

				if($deco == true)
				{
					?>
					<div class="alert alert-success" role='alert'>Vous avez été déconnecté !<br />
					Les cookies de connexion ont été supprimés.</div>
					<?php
				}
				else
				{
					?>
					<p>Vous n'avez pas accès à cette page !</p>
					<?php
					header("Location: index.php");
				}
				?>
				</div>
			</div>
		</div>
	</body>
</html>