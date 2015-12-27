<?php

$listeCats = AffichageNomsCat();

foreach ($listeCats as $cle => $cat)
{
	$listeCats["cle"]["id"] = $cat["id"];
	$listeCats["cle"]["nom"] = htmlspecialchars($cat["nom"]);
}