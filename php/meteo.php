<?php

function getMeteo($id){
	$capteur = getCapteurById($id);
	if($capteur == false){
		return false;
	}
	$url = $capteur['ip']."/sensor";
	$content = @file_get_contents($url);
	return $content;
}


 ?>
