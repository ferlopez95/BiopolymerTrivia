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

	function attempUploadUsersUsos($user, $punt){

		$conn = connectionToDataBase();

		//$comment = $_POST['comment'];

			$sql = "INSERT INTO Usuario (usuario,puntUsos) VALUES ('$user','$punt')";

	    	
	    	if (mysqli_query($conn, $sql)) 
	    	{
	    		$conn -> close();
				return array("status" => "SUCCESS");
			  
			}
			else{

				$conn -> close();
				return array("status" => "BADCONN");

			} 
	}

?>