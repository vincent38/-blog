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
										echo "<tr><td>".$user["pseudo"]."</td><td>".$user["date_inscription"]."</td><td><select name='rank' id='".$user["pseudo"]."'><option value='".$user["rank"]."'>Rang actuel : ".Ranking($user["pseudo"])."</option><option value='1'>Banni</option><option value='2'>Utilisateur standard / pas de permission</option><option value='3'>Membre</option><option value='4'>Rédacteur/Modérateur</option><option value='5'>Administrateur</option></select></td></tr>";
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
