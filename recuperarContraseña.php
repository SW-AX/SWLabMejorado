<?php

    $link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");

    $usuarios = mysqli_query( $link,"SELECT * FROM usuarios WHERE email='$_POST[email]'");

    $cont = mysqli_num_rows($usuarios); //Se verifica el total de filas devueltas

    //mysqli_close( $mysql); //cierra la conexion

    if($cont != 1){
    	echo("erroremail");

    } else {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 10; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

	    $cpass = crypt($randomString, '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors');

	    $sql = "UPDATE usuarios SET password = '$cpass' WHERE email = '$_POST[email]'";

	    if(!mysqli_query($link, $sql)) {
	    	die("Error: " . mysqli_error($link));
	    }

		if (mail($_POST["email"], "Nueva contraseña", "Tu nueva contrasena es " . $randomString . ", cambiala en tuas ajustes de perfil")) {
			echo($randomString);
		} else {
			echo("error");
		}		
	}
?>