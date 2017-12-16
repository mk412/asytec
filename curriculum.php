<?php
	// curriculum.php
	
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$telefono = $_POST['tel'];
	$file = $_POST['file'];
	
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
	
	
	
	if($nombre == "" || $email == "" || $telefono == ""){
		echo "Error: faltan campos por completar";
	} else {
		$destino = "macagomez412@gmail.com";
		$asunto  = "$nombre desde asytec.com";
		$cuerpo  = "Currículum Vitae de $nombre";
		
		$cabeceras = "De: $nombre" . " <" . $email . ">" . "\r\n";
		
		//boundary 
		$semi_rand = md5(time()); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

		//headers for attachment 
		$cabeceras .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

		//multipart boundary 
		$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
		"Content-Transfer-Encoding: 7bit\n\n" . $cuerpo . "\n\n"; 
		
		if(!empty($file) > 0){
			if(is_file($file)){
				$message .= "--{$mime_boundary}\n";
				$fp =    @fopen($file,"rb");
				$data =  @fread($fp,filesize($file));

				@fclose($fp);
				$data = chunk_split(base64_encode($data));
				$message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
				"Content-Description: ".basename($files[$i])."\n" .
				"Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
				"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
			}
		}
		
		$message .= "--{$mime_boundary}--";
		$returnpath = "-f" . $email;
		
		mail($destino, $asunto, $cuerpo, $cabeceras);
						
		$cabeceras .= 'De: ASYTEC Sistemas SRL <contacto@dominio.com.ar>'."\r\n";
		
		mail($email, "ASYTEC Sistemas SRL.", "Gracias por comunicarte con nosotros. Recibimos tus datos y te responderemos a la brevedad.", $cabeceras);
		
		echo "Mail enviado, verifica tu casilla de correo no deseado.";
	} // cierra else
		
?>