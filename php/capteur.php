<?php

function getDb(){
	try{
		return new PDO('mysql:host=localhost;dbname=wis3', 'root', 'root');
	}catch(Exception $e){
		http_response_code(500);
		echo json_encode('Il y a eu des problèmes: '. $e->getMessage());
		die();
		// echo "Échec : " . $e->getMessage();
	}
}

function getCapteurs(){
	$db = getDb();
	$sql = "SELECT id, ip FROM capteurs;";
	$select = $db->prepare($sql);
	$select->execute();
	$capteurs = $select->fetchAll();
	for ($i=0; $i < sizeof($capteurs); $i++) {
		unset($capteurs[$i]['0']);
		unset($capteurs[$i]['1']);
	}
	return $capteurs;
}

function getCapteurById($id){
	$db = getDb();
	$sql = "SELECT id, ip FROM capteurs WHERE id=:id;";
	$select = $db->prepare($sql);
	$select->execute([ "id" => $id]);
	$capteur = $select->fetchAll();
	if(sizeof($capteur) == 0){
		return FALSE;
	}
	unset($capteur[0]['0']);
	unset($capteur[0]['1']);
	return $capteur[0];
}
