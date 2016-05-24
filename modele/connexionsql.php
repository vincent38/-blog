<?php
/*
	Connexion à la DB via PDO - version à compléter
	/!\ PENSER A CHANGER LES ID /!\
*/

$base = new PDO("mysql:host=localhost;dbname=test2;charset=utf8","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
