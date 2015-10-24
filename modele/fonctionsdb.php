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
	$askForPosts = $base->query("SELECT titre, auteur, contenu, id, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %H:%i') AS datewrote, image, available FROM billets WHERE available = 1 AND id >= 1 ORDER BY id DESC LIMIT 0,10");

	//Fetch all
	$returnedData = $askForPosts->fetchAll(PDO::FETCH_ASSOC);

	//return
	return $returnedData;
}

function AffichageCommentaires($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès aux commentaires selon billet
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

function PostBillet($title, $author, $content, $image, $available){

	//Accès à la BDD
	global $base;

	//Préparer insertion
	$writenewarticle = $base->prepare("INSERT INTO billets(titre, auteur, contenu, date_creation, image, available) VALUES(:titre,:auteur,:contenu,NOW(),:image, :available)");
	
	//Insertion
	$writenewarticle->execute(array("titre"=>htmlspecialchars($title),
									"auteur"=>htmlspecialchars($author),
									"contenu"=>htmlspecialchars($content),
									"image"=>htmlspecialchars($image),
									"available"=>$available));
}

function EditBillet($title, $author, $content, $image, $id, $available){

	//Accès à la BDD
	global $base;

	//Préparer insertion
	$writenewarticle = $base->prepare("UPDATE billets SET titre=:titre, auteur=:auteur, contenu=:contenu, image=:image, available=:available WHERE id=:id ");
	
	//Insertion
	$writenewarticle->execute(array("titre"=>htmlspecialchars($title),
									"auteur"=>htmlspecialchars($author),
									"contenu"=>htmlspecialchars($content),
									"image"=>htmlspecialchars($image),
									"id"=>$id,
									"available"=>$available));
}

function AffichageBillet($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès au billet demandé
	$askForPosts = $base->prepare("SELECT titre, auteur, contenu, id, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %H:%i') AS datewrote, image, available FROM billets WHERE id = :id");

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

function inscriptionMembre($pseudo, $pass, $mail)
{
	//Insertion du membre dans la BDD

	global $base;
	$insertmember = $base->prepare("INSERT INTO membres(pseudo, pass, mail, date_inscription, rank) VALUES (:pseudo, :pass, :mail, NOW(), 3)");
	$insertmember->execute(array("pseudo"=>$pseudo,
								 "pass"=>$pass,
								 "mail"=>$mail));
}

function pseudoAlreadyExists($pseudo)
{
	//Vérifie si le pseudo existe déjà dans la BDD

	global $base;
	$pseudoexists = $base->prepare("SELECT pseudo FROM membres WHERE pseudo=:pseudo ");
	$pseudoexists->execute(array("pseudo"=>$pseudo));

	$returnedPseudo = $pseudoexists->fetch();

	//On renvoie une réponse : true si le pseudo existe déjà, false sinon

	if (empty($returnedPseudo))
	{
		return false;
	}
	else
	{
		return true;
	}
}

function gatherMail($pseudo)
{
	//Vérifie si le pseudo existe déjà dans la BDD

	global $base;
	$gatherMail = $base->prepare("SELECT mail FROM membres WHERE pseudo=:pseudo ");
	$gatherMail->execute(array("pseudo"=>$pseudo));

	$Mail = $gatherMail->fetch();

	//On renvoie une réponse : true si le pseudo existe déjà, false sinon

	return $Mail["mail"];
}

function connexionMembre($pseudo, $pass)
{
	//Vérifie si l'utilisateur existe, et si le mot de passe est bon : true si tout est ok, false sinon
	global $base;
	$userExists = $base->prepare("SELECT pseudo FROM membres WHERE pseudo=:pseudo AND pass=:pass");
	$userExists->execute(array("pseudo"=>htmlspecialchars($pseudo),"pass"=>htmlspecialchars($pass)));

	$returnedUser = $userExists->fetch();

	if (!empty($returnedUser))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function setSessionUser($pseudo)
{
	//Définit les variables de session
	global $base;
	$userData = $base->prepare("SELECT pseudo, id, mail, pass, DATE_FORMAT(date_inscription, 'le %d/%m/%Y') AS date_i, rank FROM membres WHERE pseudo=:pseudo");
	$userData->execute(array("pseudo"=>$pseudo));

	$returnedData = $userData->fetch();

	$_SESSION["pseudo"] = $returnedData["pseudo"];
	$_SESSION["id"] = $returnedData["id"];
	$_SESSION["mail"] = $returnedData["mail"];
	$_SESSION["date"] = $returnedData["date_i"];
	$_SESSION["rank"] = $returnedData["rank"];
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function selectComms($auth){

	global $base;
	$comms = $base->prepare("SELECT COUNT(*) AS compteurcomms FROM commentaires WHERE auteur = :author");
	$comms->execute(array("author"=>$auth));

	$sendcomms = $comms->fetch();

	return $sendcomms["compteurcomms"];
}

function selectPosts($auth){

	global $base;
	$comms = $base->prepare("SELECT COUNT(*) AS compteurbillets FROM billets WHERE auteur = :author");
	$comms->execute(array("author"=>$auth));

	$sendcomms = $comms->fetch();

	return $sendcomms["compteurbillets"];
}

function Ranking($pseudo){

	global $base;
	$rank = $base->prepare("SELECT permissions.name AS perm FROM permissions, membres WHERE permissions.id = membres.rank AND pseudo = :pseudo");
	$rank->execute(array("pseudo"=>$pseudo));

	$sendrank = $rank->fetch();

	return $sendrank["perm"];
	
}

function RankingComment($pseudo){

	global $base;
	$rank = $base->prepare("SELECT * FROM permissions, membres WHERE permissions.id = membres.rank AND pseudo = :pseudo");
	$rank->execute(array("pseudo"=>$pseudo));

	$sendrank = $rank->fetch();

	return $sendrank;
	
}

function selectCommsGlobal(){

	global $base;
	$comms = $base->query("SELECT COUNT(*) AS compteurcomms FROM commentaires");

	$sendcomms = $comms->fetch();

	return $sendcomms["compteurcomms"];
}

function selectPostsGlobal(){

	global $base;
	$comms = $base->query("SELECT COUNT(*) AS compteurbillets FROM billets");

	$sendcomms = $comms->fetch();

	return $sendcomms["compteurbillets"];
}

function AffichageCommentairesGeneral(){

	//Accès à la BDD
	global $base;

	//Requête d'accès aux commentaires selon billet
	$askForComments = $base->query("SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, 'le %d/%m/%Y à %H:%i') AS datewrote FROM commentaires ORDER BY id DESC");

	//Fetch all
	$returnedComments = $askForComments->fetchAll(PDO::FETCH_ASSOC);

	//return
	return $returnedComments;
}

function AffichagePostsGeneral(){

	//Accès à la BDD
	global $base;

	//Requête d'accès aux commentaires selon billet
	$askForPosts = $base->query("SELECT auteur, id, titre, contenu, DATE_FORMAT(date_creation, 'le %d/%m/%Y à %H:%i') AS datecomment, available FROM billets ORDER BY id DESC");

	//Fetch all
	$returnedPosts = $askForPosts->fetchAll(PDO::FETCH_ASSOC);

	//return
	return $returnedPosts;
}

function AffichageNomsImages(){
	//Accès à la BDD
	global $base;

	//Requête d'accès aux commentaires selon billet
	$askForImgNames = $base->query("SELECT id, name FROM pics ORDER BY id");

	//Fetch all
	$returnedImgNames = $askForImgNames->fetchAll(PDO::FETCH_ASSOC);

	//return
	return $returnedImgNames;
}

function deleteBillet($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès au billet demandé
	$delete = $base->prepare("DELETE FROM billets WHERE id = :id");

	//Query
	$delete->execute(array("id"=>$id));

}

function deleteComment($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès au billet demandé
	$delete = $base->prepare("DELETE FROM commentaires WHERE id = :id");

	//Query
	$delete->execute(array("id"=>$id));

}

function AffichageComment($id){

	//Accès à la BDD
	global $base;

	//Requête d'accès au billet demandé
	$askForComments = $base->prepare("SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, 'le %d/%m/%Y à %H:%i') AS datewrote FROM commentaires WHERE id = :id");

	//Query
	$askForComments->execute(array("id"=>$id));

	//Fetch all
	$returnedData = $askForComments->fetch();

	//return
	return $returnedData;
}

function getUsers()
{
	//Vérifie si le pseudo existe déjà dans la BDD

	global $base;
	$list = $base->query("SELECT * FROM membres");

	$returnList = $list->fetchAll(PDO::FETCH_ASSOC);

	return $returnList;
}

function getUser($id)
{
	//Vérifie si le pseudo existe déjà dans la BDD

	global $base;
	$list = $base->prepare("SELECT * FROM membres WHERE id = :id");
	$list->execute(array("id"=>$id));

	$returnData = $list->fetch();

	return $returnData;
}

function setRank($id, $rank)
{
	global $base;

	$userToSet = $base->prepare("UPDATE membres SET rank = :rank WHERE id = :id");
	$userToSet->execute(array("rank"=>$rank,
							  "id"=>$id));
}

function checkPosNumberImg()
{
	global $base;
	$checkposnumber = $base->query("SELECT COUNT(*) AS totalimg FROM pics");
	$posnumber = $checkposnumber->fetch();

	return $posnumber;
}

function insertImg($finalName, $desc)
{
	global $base;
	$insertfile = $base->prepare("INSERT INTO pics(name,description) VALUES (:name,:description)");
	$insertfile->execute(array('name'=>htmlspecialchars($finalName),
							   'description'=>htmlspecialchars($desc)));
}