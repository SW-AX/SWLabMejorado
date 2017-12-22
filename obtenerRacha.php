<?php
	session_start();

	if ($_SESSION["racha"] == 0) {
		echo ("Respuesta correcta! Vamos con otra.");
		++$_SESSION["racha"];
	} else {
		echo ("Respuesta correcta! Llevas una racha de " . ++$_SESSION["racha"] . " aciertos. Vamos con otra.");
	}
?>