<?php
session_start();

$_SESSION = array();
session_destroy();

setcookie("username","",time()-3600,null,null,false,true);
setcookie("passwd","",time()-3600,null,null,false,true);

include_once("vue/deconnexion.php")
?>