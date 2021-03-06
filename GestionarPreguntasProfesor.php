<?php
	session_start();

	if (isset($_SESSION['rol']) == false) {
		echo ("
			<script type='text/javascript'>
			alert('Fuera tramposo!');
			window.location.href = 'inicio.php';
			</script>
		");
	}

	if ($_SESSION['rol'] == 'alumno') {
		echo ("
			<script type='text/javascript'>
			alert('Bienvenido alumno');
			window.location.href = 'GestionarPreguntas.php';
			</script>
		");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Gestionar Preguntas</title>
		<link rel='stylesheet' type='text/css' href='estilos/style.css' />
		<link rel='stylesheet' type='text/css' media='only screen and (min-width: 530px) and (min-device-width: 481px)' href='estilos/wide.css'/>
		<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='estilos/smartphone.css'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<h2>Quiz: el juego de las preguntas</h2>
			</header>
		<nav class='main' id='n1' role='navigation'>
				
				<span><a href=<?php if(isset($_SESSION['email'])) echo("'inicio.php?op=logged&e=" .$_SESSION['email']. "'");?>>Inicio</a></span>
				<span><a id="cr" href=<?php if(isset($_SESSION['email'])) echo("'creditos.php?op=logged&e=" .$_SESSION['email']. "'");?>>Creditos</a></span>	
				<span><a id="gp" href=''>Gestionar Preguntas</a></span>
				<span><a id="mp" href=<?php if(isset($_SESSION['email'])) echo("'modificarPerfil.php?op=logged&e=" .$_SESSION['email']. "'");?>>Modificar Perfil</a></span>
				
				<span>
					<?php
						if(isset($_GET['e'])) {
							$link= mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
							$usuario = mysqli_query($link, "SELECT * FROM usuarios WHERE email = '" . $_GET['e'] . "'");
							
							$row = mysqli_fetch_array( $usuario );
							echo ('<img width="60" height="60" src="data:image/jpeg;base64,'.base64_encode( $row['foto'] ).'"/>');
							echo ("<br/>");
							echo ($row['email']);
						}
					?>	
				</span>
			</nav>
	<section class="main" id="s1">
				<div id="main">
					<?php
						
						
						$link= mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
						$preguntas = mysqli_query($link, "SELECT * FROM preguntas" );
						echo ' <div style="overflow: scroll;"><table border = 1 > <tr> <th>email</th> <th> enunciado </th> <th>rCorrecta</th> <th>rIncorrecta1</th> <th>rIncorrecta2</th>
						<th>rIncorrecta3</th><th> complejidad </th> <th> tema </th></tr>';
						while ($row = mysqli_fetch_array( $preguntas )) {
							echo '<tr>';
							echo '<form id = ' . $row["id"] . ' >';
							
								echo '<td> <input type="text" value="' . $row["email"] . '" name="email" readonly="readonly" /> </td>';
								echo '<td> <input type="text" value="' . $row["enunciado"] . '" name="enunciado" /> </td>';
								echo '<td> <input type="text" value="' . $row["rCorrecta"] . '" name="rCorrecta" /> </td>';
								echo '<td> <input type="text" value="' . $row["rIncorrecta1"] . '" name="rIncorrecta1" /> </td>';
								echo '<td> <input type="text" value="' . $row["rIncorrecta2"] . '" name="rIncorrecta2" /> </td>';
								echo '<td> <input type="text" value="' . $row["rIncorrecta3"] . '" name="rIncorrecta3" /> </td>';
								echo '<td> <input type="text" value="' . $row["complejidad"] . '" name="complejidad" /> </td>';
								echo '<td> <input type="text" value="' . $row["tema"] . '" name="tema" /> </td>';
								echo '<td> <input type="button" value="Editar" onclick="actualizarFila(' . $row["id"] . ')" /> </td>';
								echo '<td> <input type="button" value="Borrar" onclick="borrarFila(' . $row["id"] . ')" /> </td>';
								echo '<input type="hidden" value="' . $row["id"] . '" name="id" />';
							
							echo '</form>';
							echo '</tr>';
						}
						echo '</table>';
						echo '</div>';
						$preguntas->close();
						mysqli_close($link);
					?>
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
			</div>
			<script>
			$('#gp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
				function actualizarFila(row) {
					$.ajax({
		            data:  $("#" + row).serialize(),
		            url:   'actualizarFila.php',
		            type:  'post',
		            beforeSend: function () {
		                alert('Editando fila: ' + row);
		            },
		            success:  function (response) {
		            	alert(response);
		            }
		        });
				}

				function borrarFila(row) {
					$.ajax({
		            data:  {id : row},
		            url:   'borrarFila.php',
		            type:  'post',
		            success:  function (response) {
		            	alert(response);
		            	location.reload();
		            }
		        });
				}
			</script>
	</body>
	</html>