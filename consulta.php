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
	
	
	if($nombre == "" || $email == "" || $consulta == ""){
		echo "Error: faltan campos por completar";
	} else {
		$destino = "macagomez412@gmail.com";
		$asunto  = "$nombre desde asytec.com";
		$cuerpo  = "$consulta";
		
		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		
		$cabeceras .= "De:" $nombre " <" . $email . ">" . "\r\n";
		
		mail($destino, $asunto, $cuerpo, $cabeceras);
			
				
		$cabeceras .= 'De: ASYTEC Sistemas <info@asytec.com>'. "\r\n";
		
		mail($email, "ASYTEC - Contacto", "Muchas gracias por ponerse en contacto con nosotros. ASYTEC Sistemas.", $cabeceras);
		
		// echo "Mail enviado, verifica tu casilla de correo no deseado.";
	} // cierra else
	
?>