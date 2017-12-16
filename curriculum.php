<?php
	// curriculum.php
	
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$telefono = $_POST['tel'];
	
	include("conexion.php");
	
	$insertar = "INSERT INTO curriculums
				VALUES(
					NULL,
					'$nombre',
					'$email',
					'$telefono'
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