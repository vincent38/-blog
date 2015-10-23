					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
						<h2 style="text-align: center">Espace d'administration</h2>
						<h3 style="text-align: center">Liste des utilisateurs inscrits</h3>
						<form>
							<table class="table">
								<thead>
									<tr>
										<th>Pseudonyme :</th>
										<th>Inscrit depuis le :</th>
										<th>Rang :</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($users as $user)
									{
										echo "<tr><td>".$user["pseudo"]."</td><td>".$user["date_inscription"]."</td><td>Rang actuel : ".Ranking($user["pseudo"])." - <a href='edit_rank.php?id=".$user["id"]."'>Editer le rang</a></td></tr>";
									}
									?>
								</tbody>
							</table>
						</form>
				</div>
			</div>
		</div>
	</body>
</html>
