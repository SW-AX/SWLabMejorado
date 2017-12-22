<?php
	session_start();

	if(!isset($_SESSION["racha"])) {
		$_SESSION["racha"] = 1;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Jugar</title>
	<link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' type='text/css' media='only screen and (min-width: 530px) and (min-device-width: 481px)' href='estilos/wide.css'/>
	<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='estilos/smartphone.css'/>
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
<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a id="lg" href="login.php">Login</a></span>
				<span class="left"><a id="re" href="register.php">Registrarse</a></span>
				<h2>Quiz: el juego de las preguntas</h2>
			</header>
			<nav class='main' id='n1' role='navigation'>
				<span><a id="in" href='inicio.php'>Inicio</a></span>
				<span><a id="cr" href='creditos.php'>Creditos</a></span>	
				<span><a id="jugar" href='jugar.php'>¿Cuánto sabes? Pruébame</a></span>
			</nav>
			<section class="main" id="s1">
				<div id="main">
				<?php
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

	
	
	echo "<td>";
	echo ('<img width="60" height="60" src="data:image/jpeg;base64,'.base64_encode( $pregunta['imagen'] ).'"/>');
	echo "</td>";
	echo "<td> Tema: ";
	echo($pregunta["tema"]);
	echo "</td>";
	echo "<td> Complejidad: ";
	echo($pregunta["complejidad"]);
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	

?>
				</div>
			</section>
			
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>







				<a href='https://github.com'>Link GITHUB</a>
			</footer>
</div>
	
<script type="text/javascript">
$('#jugar').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});

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
