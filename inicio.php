<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Inicio</title>
		<link rel='stylesheet' type='text/css' href='estilos/style.css' />
		<link rel='stylesheet' type='text/css' media='only screen and (min-width: 530px) and (min-device-width: 481px)' href='estilos/wide.css'/>
		<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='estilos/smartphone.css'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
				<span ><a id="vp" href=<?php if(isset($_GET['e'])) echo("'verPreguntas.php?op=logged&e=" .$_GET['e']. "'"); ?>>Preguntas</a></span>
				<span><a id="cr" href='creditos.php'>Creditos</a></spam>
				<span ><a id="ip" href=<?php if(isset($_GET['e'])) echo("'insertarPregunta.php?op=logged&e=" .$_GET['e']. "'"); ?>>Añadir Pregunta</a></span>
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
					Inicia sesión para poder hacer cosas. Si no tienes cuenta registrate!
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>







				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>
		<?php
		if(isset($_GET['op'])) {
			$op = $_GET['op'];
			if ($op == 'logged') {
				if(isset($_SESSION['email'])){
					echo("
						<script type='text/javascript'>
							alert('".$_SESSION['email']."');
							alert('".$_SESSION['rol']."');
						</script>
					");	
				}

				echo("
				<script type='text/javascript'>
					$('#re').attr('href', 'register.php?op=logged&e=" .$_GET['e']. "')
					$('#cr').attr('href', 'creditos.php?op=logged&e=" .$_GET['e']. "')
					$('#lg').html('Logout');
					$('#lg').attr('href', 'inicio.php');
					$('#main').html('Bienvenido!');
					$('#main').append('<br><a>Gestionar Preguntas</a>');
					$('#main a').attr('href', 'GestionarPreguntas.php?op=logged&e=" .$_GET['e']. "');

					$('#lg').click( function (){
						alert('Adios! Vuelve pronto');					
					});
				</script>
				");
			}
		} else {
			if (isset($_SESSION['autentificado'])) {
				session_unset();
				session_destroy();
				if (isset($_SESSION['autentificado'])) {
					echo("
						<script type='text/javascript'>
							alert('". $_SESSION['autentificado'] ."');
						</script>
					");
				} else {
					echo("
						<script type='text/javascript'>
							alert('La sesion se ha borrado bien');
						</script>
					");
				}
			}
			echo("
				<script type='text/javascript'>
					$('#vp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
					$('#ip').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
				</script>
			");
		}
		?>
		<script type='text/javascript'>
			$('#in').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
		</script>	
	</body>
</html>