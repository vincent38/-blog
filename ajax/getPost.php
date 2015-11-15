<?php

//Inclusion des ID SQL
include_once("../modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("../modele/fonctionsdb.php");

if (isset($_GET["id"]))
{
	$billets = AffichageBillet($_GET["id"]);
	$billets["contenu"] = htmlspecialchars($billets["contenu"]);
	$billets["contenu"] = preg_replace("#\[alert=(success|info|warning|danger)\](.+)\[/alert\]#isU","<div class=\"alert alert-$1\" role=\"alert\">$2</div>",$billets["contenu"]); //bold
	$billets["contenu"] = preg_replace("#\[b\](.+)\[/b\]#isU","<strong>$1</strong>",$billets["contenu"]); //bold
	$billets["contenu"] = preg_replace("#\[i\](.+)\[/i\]#isU","<em>$1</em>",$billets["contenu"]); //italic
	$billets["contenu"] = preg_replace("#\[color=(blue|red|green|\#[a-z0-9]{6})\](.+)\[/color\]#isU","<span style=\"color: $1\">$2</span>",$billets["contenu"]); //color
	$billets["contenu"] = preg_replace("#url!(https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)#i", "<a href='$1'>$1</a>", $billets["contenu"]); // url (with url!)
	$billets["contenu"] = preg_replace("#\[img=(.+)\](https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)\[/img\]#isU", "<img src='$2' alt='$1'/>", $billets["contenu"]); //images
	$billets["contenu"] = preg_replace("#(\\\')#i","'", $billets["contenu"]); //'
	$billets["contenu"] = preg_replace('#(\\\")#i','"', $billets["contenu"]); //'
	echo nl2br($billets["contenu"]);
}