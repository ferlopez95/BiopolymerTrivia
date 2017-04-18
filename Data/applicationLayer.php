<?php

header('Content-type: application/json');
require_once __DIR__ . '/dataLayer.php';

$action = $_POST["action"];

switch($action){
	case "LOGIN" : loginFunction();
					break;
	case "REGISTER" : registerFunction();
					break;
	case "PROFILE" : profileFunction();
					break;
	case "LOADQAUSOS" : loadQAFunction();
					break;
	case "ADDCOMMENT" : addcommentFunction();
					break;
	case "LOGOUT" : logoutFunction();
					break;
}

function loadQAFunction(){

	$result = attemptloadQA();

	if($result["status"] == "ERROR"){
		echo json_encode(array("message" => "Error getting information from DB!"));
	}

}

function loginFunction(){

	$userName = $_POST["username"];
    $save = $_POST["save"];
    
    $result = attemptLogin($userName, $save);
    if ($result['status'] == 'COMPLETE'){
            
			$decryptedPassword = decryptionPass($result['password']);
			$password = $_POST['userPassword'];

		   	if ($decryptedPassword === $password)
		   	{	
		    	$response = array("status" => "COMPLETE");   

			    echo json_encode($response);
			}
			else
			{
				header('HTTP/1.1 306 Wrong credentials');
				die("Wrong credentials");
			}
		}

}

function registerFunction(){

			$userName = $_POST['username'];
			$userFirstName = $_POST['userFirstName'];
			$userLastName = $_POST['userLastName'];
			$userEmail = $_POST['userEmail'];
			$userCountry = $_POST['userCountry'];
			$userGender = $_POST['userGender'];
			$save = $_POST["save"];

			$userPassword = encryptionPass();

			$result = attemptRegistration($userName, $userPassword, $userFirstName, $userLastName, $userCountry, $userEmail, $userGender, $save);

			if($result["status"] == "NAMEINUSE"){

			header('HTTP/1.1 409 Conflict, Username already in use please select another one');
		    echo json_encode(array("message" => "Username already in use."));
			
			}
			else
				if($result["status"] == "BADCONN"){
				header('HTTP/1.1 500 Bad connection, something went wrong while saving your data, please try again later');
			    echo json_encode(array("message" => "Error something went wrong"));
				}
				else
					if($result["status"] == "SUCCESS"){
						echo json_encode(array("message" => "Your account: $userName has been created!"));
					}

}

function profileFunction(){
	session_start();
	$userName = $_SESSION['username'];

	$result = attemptProfile($userName);

	if($result["status"] == "BADCRED"){
		echo json_encode(array("message" => "Wrong credentials provided!"));
	}
}


?>