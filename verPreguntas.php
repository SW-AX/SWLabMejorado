<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Ver Preguntas</title>
		<link rel='stylesheet' type='text/css' href='estilos/style.css' />
		<link rel='stylesheet' type='text/css' media='only screen and (min-width: 530px) and (min-device-width: 481px)' href='estilos/wide.css'/>
		<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='estilos/smartphone.css'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	</head>
	
		<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a id="lg" href="inicio.php">Logout</a></span>
				<span class="left"><a id="re" href=<?php echo("'register.php?op=logged&e=" .$_GET['e']. "'"); ?>>Registrarse</a></span>
				<h2>Quiz: el juego de las preguntas</h2>
			</header>
			<nav class='main' id='n1' role='navigation'>
				<span><a id="in" href=<?php echo("'inicio.php?op=logged&e=" .$_GET['e']. "'"); ?>>Inicio</a></span>
				<span ><a id="vp" href=<?php echo("'verPreguntas.php?op=logged&e=" .$_GET['e']. "'"); ?>>Preguntas</a></span>
				<span><a id="cr" href=<?php echo("'creditos.php?op=logged&e=" .$_GET['e']. "'"); ?>>Creditos</a></spam>
				<span ><a id="ip" href=<?php echo("'insertarPregunta.php?op=logged&e=" .$_GET['e']. "'"); ?>>Añadir Pregunta</a></span>
				<br><br><br>
				<span>
					<?php
						if(isset($_GET['e'])) {
							$link= mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
							$usuario = mysqli_query($link, "SELECT * FROM usuarios WHERE email = '" . $_GET['e'] . "'");
							
							$row = mysqli_fetch_array( $usuario );
							echo ('<img src="data:image/jpeg;base64,'.base64_encode( $row['foto'] ).'"/>');
						}
					?>	
				</span>
			</nav>
			<section class="main" id="s1">
				<div id="main">
					<?php
						$link= mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
						$preguntas = mysqli_query($link, "SELECT * FROM preguntas" );
						echo '<table border = 1> <tr> <th> email </th> <th> enunciado </th> <th> rCorrecta </th> <th> rIncorrecta1 </th> <th> rIncorrecta2 </th> <th> rIncorrecta3 </th> <th> complejidad </th> <th> tema </th> <th> imagen 
						</th> </tr>';
						while ($row = mysqli_fetch_array( $preguntas )) {
							echo '<tr> <td>' . $row["email"] . '</td> <td>' . $row["enunciado"] . '</td> <td>' . $row["rCorrecta"] . '</td> <td>' . $row["rIncorrecta1"] . '</td> <td>' . $row["rIncorrecta2"] . '</td> <td>' . $row["rIncorrecta3"] . '</td> <td>' . $row["complejidad"] . '</td> <td>' . $row["tema"] . '</td> <td>' . '<img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'"/>' . '</td> </tr>';
						}
						echo '</table>';
						$preguntas->close();
						mysqli_close($link);
					?>	
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
				<a href="verPreguntasXML.php">verPreguntasXML</a>
				<a href="verPreguntasXSL.php">verPreguntasXSL</a>
			</footer>
		</div>
		<script type='text/javascript'>
			$('#vp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
			$('#lg').click( function (){
				alert('Adios! Vuelve pronto');		
			});
		</script>		
	</body>
</html>