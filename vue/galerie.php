<!--
	vue/charte.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Charte
	
	Inclus dans : controleur/charte.php
-->
					<?php
					//Ajout du header commun
					include_once("includes/header.php");
					?>
					<link rel="stylesheet" href="galstyle.css">
					<h1 style="text-align: center">Galerie</h1>
					<?php
					echo $final;
					?>
					<div id="myModal" class="modal">

					  	<!-- The Close Button -->
					  	<span class="close" onclick="document.getElementById('myModal').style.display='none'"><i class="fa fa-times fa-2x text-danger" aria-hidden="false"></i></span>

					 	<!-- Modal Content (The Image) -->
					 	<img class="modal-content" id="img01">

					</div>
					<script>
					var modal = document.getElementById('myModal');
					var modalImg = document.getElementById("img01");

					function fullPage(file)
					{
						modal.style.display = "block";
						modalImg.src = file;
						modalImg.alt = "Test";
					}

					// Get the <span> element that closes the modal
					var span = document.getElementsByClassName("close")[0];

					// When the user clicks on <span> (x), close the modal
					span.onclick = function() {
					  modal.style.display = "none";
					}

					</script>
					<?php
					include_once("includes/footer.php");
					?>