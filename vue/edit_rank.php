<!--
	vue/edit_rank.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Modification des permissions.
	Inclus dans : controleur/edit_rank.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
						<h2 style="text-align: center">Espace d'administration</h2>
						<h3 style="text-align: center">Editer le rang d'un utilisateur :</h3>
						<form method="post" action="edit_rank.php?id=<?php echo $_GET["id"]; ?>">
							<table class="table">
								<thead>
									<tr>
										<th>Pseudonyme :</th>
										<th>Rang :</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $user["pseudo"]; ?></td>
										<td>
											<select name='rank' id='rankedit'>
												<option value='<?php echo $user["rank"]; ?>'>Rang actuel : <?php echo Ranking($user["pseudo"]); ?></option>
												<option value='1'>Banni</option>
												<option value='2'>Utilisateur standard / pas de permission</option>
												<option value='3'>Membre</option>
												<option value='4'>Rédacteur/Modérateur</option>
												<option value='5'>Administrateur</option>
											</select>
										</td>
										<td><button type="submit">Valider</button></td>
									</tr>
								</tbody>
							</table>
							<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
						</form>
				<?php
				include_once("includes/footer.php");
				?>