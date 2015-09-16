				<?php  
				include_once("includes/header.php");
				if($deco == true)
				{
					?>
					<p>Vous avez été déconnecté !<br />
					Les cookies de connexion ont été supprimés.</p>
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