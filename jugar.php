<?php
	session_start();

	if(!isset($_SESSION["racha"])) {
		$_SESSION["racha"] = 1;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jugar</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<style type="text/css">
		table {
			border: solid;
		}
		td {
			border: solid;
		}
	</style>
</head>
<body>
	<?php

	/*
	if(!isset($_SESSION["email"])) {
		header("Location: inicio.php");
	} else if($_SESSION["rol"] == "profesor") {
		echo ("
			<script type='text/javascript'>
			alert('Los profesores no pueden acceder a esta funcionalidad');
			</script>
		");

		header("Location: inicio.php");
	}
	*/

	$link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
	$preguntas = mysqli_query($link, "SELECT * FROM preguntas");

	$numPreguntas = mysqli_num_rows($preguntas);

	$randomNum = rand(1, $numPreguntas);

	$counter = 0;
	while ($counter < $randomNum) {
		$pregunta = mysqli_fetch_array($preguntas);
		$counter++;
	}

	echo "<table>";
	echo "<tr>";

	echo "<td>";
	echo $pregunta["enunciado"];
	echo "</td>";

	$randomPatter = rand(1, 4);

	switch ($randomPatter) {
		case 1:
			echo "<td>";
			echo "<input type='button' id='correcta' value='" . $pregunta["rCorrecta"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta1"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta2"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta3"] . "' />";
			echo "</td>";

			break;

		case 2:

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta1"] . "' />";

			echo "<td>";
			echo "<input type='button' id='correcta' value='" . $pregunta["rCorrecta"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta2"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta3"] . "' />";
			echo "</td>";

			break;

		case 3:

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta1"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta2"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' id='correcta' value='" . $pregunta["rCorrecta"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta3"] . "' />";
			echo "</td>";

			break;

		case 4:

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta1"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta2"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' class='incorrecta' value='" . $pregunta["rIncorrecta3"] . "' />";
			echo "</td>";

			echo "<td>";
			echo "<input type='button' id='correcta' value='" . $pregunta["rCorrecta"] . "' />";
			echo "</td>";

			break;
	}

	echo "</tr>";
	echo "</table>";

?>
<script type="text/javascript">

	$("#correcta").click(function(){ 
		$.ajax({
			method: "POST",
			url: "obtenerRacha.php",
			success: function(respuesta) {
				alert(respuesta);
				location.reload();
			}
		});
	});

	$(".incorrecta").click(function(){
		$.ajax({
			method: "POST",
			url: "resetearRacha.php",
			success: function() {
				alert("Respuesta incorrecta, inténtalo de nuevo");
			}
		});
	});

</script>
</body>
</html>
