<?php

require 'php/capteur.php';

function getUrl(){
	if(isset($_GET['url'])){
		if(!empty($_GET['url'])){
			return $_GET['url'];
		}
	}
	return FALSE;
}

$url = trim(getUrl(), '/');

if($url == FALSE){
	include('html/site.html');
	die();
}

$url = explode('/', $url);
header('Content-Type: application/json');


if($url[0] == 'capteur'){
	if(sizeof($url) == 1){
		$capteurs = getCapteurs();
		echo json_encode($capteurs);
	}else{
		$id = $url[1];
		$capteur = getCapteurById($id);
		if($capteur == FALSE){
			http_response_code(404);
			die();
		}
		echo json_encode($capteur);
	}
	http_response_code(200);
	die();
}else if ($url[0] == 'temp') {
	require 'php/meteo.php';
	if(sizeof($url) == 2){
		$id = $url[1];
		$meteo = getMeteo($id);
		if ($meteo == false) {
			echo json_encode('Le capteur ne répond pas');
			die();
		}
		if (!empty($meteo)){
			$json = json_decode($meteo);
			echo json_encode($json->temp);
			die();
		}
	}
}else if ($url[0] == 'humi') {
	require 'php/meteo.php';
	if(sizeof($url) == 2){
		$id = $url[1];
		$meteo = getMeteo($id);
		if ($meteo == false) {
			echo json_encode('Le capteur ne répond pas');
			die();
		}
		if (!empty($meteo)){
			$json = json_decode($meteo);
			echo json_encode($json->humi);
			die();
		}
	}
}

http_response_code(400);
