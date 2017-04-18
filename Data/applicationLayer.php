<?php

header('Content-type: application/json');
require_once __DIR__ . '/dataLayer.php';

$action = $_POST["action"];

switch($action){

	case "LOADQAUSOS" : loadQAFunction();
					break;
	case "UPLOADUSERUSOS" : uploadUserUsos();
					break;
}

function loadQAFunction(){

	$result = attemptloadQA();

	if($result["status"] == "ERROR"){
		echo json_encode(array("message" => "Error getting information from DB!"));
	}
}

function uploadUserUsos(){
	$user = $_POST["user"];
	$punt = $_POST["punt"];
	$result = attempUploadUsersUsos($user,$punt);

	if($result["status"] == "ERROR"){
		echo json_encode(array("message" => "Error getting information from DB!"));
	}
}


?>