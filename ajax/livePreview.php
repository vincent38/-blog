<?php

//Module de live preview

if (isset($_POST["text"]))
{
	$_POST["text"] = htmlspecialchars($_POST["text"]);
	$_POST["text"] = preg_replace("#\[alert=(success|info|warning|danger)\](.+)\[/alert\]#isU","<div class=\"alert alert-$1\" role=\"alert\">$2</div>",$_POST["text"]); //bold
	$_POST["text"] = preg_replace("#\[b\](.+)\[/b\]#isU","<strong>$1</strong>",$_POST["text"]); //bold
	$_POST["text"] = preg_replace("#\[i\](.+)\[/i\]#isU","<em>$1</em>",$_POST["text"]); //italic
	$_POST["text"] = preg_replace("#\[color=(blue|red|green|\#[a-z0-9]{6})\](.+)\[/color\]#isU","<span style=\"color: $1\">$2</span>",$_POST["text"]); //color
	$_POST["text"] = preg_replace("#url!(https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)#i", "<a href='$1'>$1</a>", $_POST["text"]); // url (with url!)
	$_POST["text"] = preg_replace("#\[img=(.+)\](https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)\[/img\]#isU", "<img src='$2' alt='$1'/>", $_POST["text"]); //images
	$_POST["text"] = preg_replace("#(\\\')#i","'", $_POST["text"]); //'
	$_POST["text"] = preg_replace('#(\\\")#i','"', $_POST["text"]); //'
	echo nl2br($_POST["text"]);
}