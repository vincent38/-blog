<?php
/*
	modele/fonctionsdb.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Fonctions relatives à la BDD

	Inclus dans : TOUT
*/

function AffichageIndex(){

	//Accès à la BDD
	global $base;

	//Requête d'accès aux 10 derniers billets
	$askForPosts = $base->query("SELECT titre, auteur, contenu, id, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %H:%i') AS datewrote, image FROM billets WHERE id >= 1 ORDER BY id DESC LIMIT 0,10");

	//Fetch all
	$returnedData = $askForPosts->fetchAll(PDO::FETCH_ASSOC);

	//return
	return $returnedData;
}

function AffichageImage($inputImg){

	//Accès à la BDD
	global $base;

	//Requête d'accès à la photo
	$querydesc = $base->prepare("SELECT description FROM pics WHERE name=:name");
	$querydesc->execute(array("name"=>$inputImg));

	//Fetch
	$description = $querydesc->fetch();

	//return
	return "<img src=\"uploads/".$inputImg."\" alt='".$description["description"]."' \>";
}