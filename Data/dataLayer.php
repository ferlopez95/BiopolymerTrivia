<?php

	function connectionToDataBase(){
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "apis";

		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error){
			return null;
		}
		else{
			return $conn;
		}
	}

	function attemptloadQA(){

		$conn = connectionToDataBase();

		$QA = array();

		$sql = "SELECT * FROM Usos";
		$result = $conn->query($sql);

		if($result->num_rows > 0){

			while($row = $result->fetch_assoc())
			{
				$response = array('id' => $row['id'], 'pregunta' => utf8_encode($row['pregunta']), 'correcta' => utf8_encode($row['correcta']), 'd1' => utf8_encode($row['d1']), 'd2' => utf8_encode($row['d2']), 'd3' => utf8_encode($row['d3']));

				array_push($QA,$response);
			}

			echo json_encode($QA);
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		}
	}

	function attemptLogin($userName, $save){
	
		$conn = connectionToDataBase();
        
        if ($conn != null){
        	$sql = "SELECT * FROM Users WHERE username = '$userName'";
            
			$result = $conn->query($sql);
			
			# The current user exists
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc()) 
		    	{
                    $firstname = $row["fName"];
                    $lastName = $row["lName"];
                    $email = $row["email"];
                    $psswrd = $row['passwrd'];
				}
                
                setcookie("save", $save, time()+2000, "/","", 0);
            
                if($save == "true"){
                    setcookie("user", $userName, time()+2000, "/","", 0);
                }
                
                session_start();
                session_destroy();
                session_start();

                $_SESSION['username'] = $userName;	
                $_SESSION['fName'] = $firstname;
                $_SESSION['lName'] =  $lastName;
                $_SESSION['email'] = $email;	

                $conn -> close();
				return array("status" => "COMPLETE" , "password" => $psswrd);
			}
			else
			{
				$conn->close();
				return array("status" => "ERROR");
			}
        }
        else
        {
        	$conn->close();
        	return array("status" => "ERROR");
        }
	}

	function attemptRegistration($userName, $userPassword, $userFirstName, $userLastName, $userCountry, $userEmail, $userGender, $save){
		$conn = connectionToDataBase();

		$sql = "SELECT username FROM Users WHERE username = '$userName'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
		    $conn -> close();
		    return array("status" => "NAMEINUSE");
		}
		else
		{
			
			$sql = "INSERT INTO Users (fName, lName, username, passwrd, email, country, gender) VALUES ('$userFirstName', '$userLastName', '$userName', '$userPassword', '$userEmail', '$userCountry', '$userGender')";

	    	
	    	if (mysqli_query($conn, $sql)) 
	    	{

	    		setcookie("save",$save, time()+86400*30,"/","",0);

	    		if($save == "true"){
	    			setcookie("username", $userName, time()+86400*30, "/", "", 0);
	    		}

			    $conn -> close();
			    session_start();
			    session_destroy();
			    session_start();

				$row = $result->fetch_assoc();

				$_SESSION["username"] = $userName;
				$_SESSION["email"] = $userEmail;
				$_SESSION["fName"] = $userFirstName;
				$_SESSION["lName"] = $userLastName;
			  return array("status" => "SUCCESS");
			} 
			else 
			{
			    $conn -> close();
			    return array("status" => "BADCONN");
			}
		}

	}

	function attemptProfile($userName){

		$conn = connectionToDataBase();

		$sql = "SELECT username, fName, lName, email, country, gender FROM Users WHERE username = '$userName'";
		$result = $conn->query($sql);

		if($result->num_rows > 0){

			while($row = $result->fetch_assoc()){
				$response = array('username' => $row['username'], 'fName' => $row['fName'], 'lName' => $row['lName'], 'email' => $row['email'], 'gender' => $row['gender'], 'country' => $row['country']);
			}

			echo json_encode($response);
		}
		else{

			$conn -> close();
			return array("status" => "BADCRED");
		}

		return array("status" => "SESSIONEXP");
	}




?>