<?php
session_start();
$mysql = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz")
				or die(mysqli_error());
				$usuarios = mysqli_query( $mysql,"select * from preguntas WHERE email='$_SESSION[email]'");

				$cont = mysqli_num_rows($usuarios); //Se verifica el total de filas devueltas
				echo $cont;
?>