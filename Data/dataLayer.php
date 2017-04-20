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

			$sql = "INSERT INTO TablaUsos (usuario,puntos) VALUES ('$user','$punt')";

	    	
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
/*************************** MUESTRA LAS PUNTUACIONES ************************/
	function attemptLoadScores($user,$tipoExamen){
		$conn = connectionToDataBase();
		$ren = array();

		$sql="";

		switch($tipoExamen)
		{
			case "usos" : $sql = "SELECT usuario, puntos FROM TablaUsos ORDER BY puntos";
				break;
			case "estructuras" : $sql = "SELECT usuario, puntos FROM TablaEstructuras ORDER BY puntos";
				break;
			case "formaciones" : $sql = "SELECT usuario, puntos FROM TablaFormaciones ORDER BY puntos";
				break;
		}

		//$sql = "SELECT usuario, puntos FROM TablaUsos ORDER BY puntos DESC";
    	$result = $conn->query($sql);

		if($result->num_rows > 0){

			while($row = $result->fetch_assoc())
			{
				$response = array('usuario' => utf8_encode($row['usuario']),'puntos' => $row['puntos']);

				array_push($ren,$response);
			}

			echo json_encode($ren);
		}
		else{
			$conn -> close();
			return array("status" => "ERROR");
		} 
	}

?>