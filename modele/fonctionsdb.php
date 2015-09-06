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

function AffichageCommentaires($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès aux 10 derniers billets
	$askForComments = $base->prepare("SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, 'le %d/%m/%Y à %H:%i') AS datewrote FROM commentaires WHERE id_billet = :id");

	//exec
	$askForComments->execute(array("id"=>$id));
	//Fetch all
	$returnedComments = $askForComments->fetchAll(PDO::FETCH_ASSOC);

	//return
	return $returnedComments;
}

function PostComment($id, $author, $comment){

	//Accès à la BDD
	global $base;

	//Préparer insertion
	$writenewarticle = $base->prepare("INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet,:auteur,:commentaire,NOW())");
	
	//Insertion
	$writenewarticle->execute(array("id_billet"=>htmlspecialchars($id),
											"auteur"=>htmlspecialchars($author),
											"commentaire"=>htmlspecialchars($comment)));
}

function AffichageBillet($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès au billet demandé
	$askForPosts = $base->prepare("SELECT titre, auteur, contenu, id, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %H:%i') AS datewrote, image FROM billets WHERE id = :id");

	//Query
	$askForPosts->execute(array("id"=>$id));

	//Fetch all
	$returnedData = $askForPosts->fetch();

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