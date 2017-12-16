<?php
	// consulta.php
	
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$consulta = $_POST['consulta'];
	
	include("conexion.php");
	
	$insertar = "INSERT INTO consultas
				VALUES(
					NULL,
					'$nombre',
					'$email',
					'$consulta'
				)";
	
	$insertar_ej = mysqli_query(
					$conexion, $insertar
					);
	
	if($insertar_ej == true){
		header("location: index.html");		
	} else {
		echo "error";
	}
	
?>