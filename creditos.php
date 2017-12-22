<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Créditos</title>
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
				<span><a id="cr" href='creditos.php'>Creditos</a></span>
				<span><a id="gp" href=''>Gestionar Preguntas</a></span>
				<span><a id="mp" href=''>Modificar Perfil</a></span>
				
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
				<img style="float:right" src="https://upload.wikimedia.org/wikipedia/en/0/02/Homer_Simpson_2006.png" height="200">
				<div id="main">
					<p> <strong>Nombres:</strong> Álex López y Xabier Echezurieta</p>
					<p> <strong>Especialidad:</strong> Ingeniería de Software </p>
					<p> <strong>Otro:</strong> Sistemas Web Grupo Nº11</p>
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
				echo("
				<script type='text/javascript'>
					$('#re').hide()
					$('#in').attr('href', 'inicio.php?op=logged&e=" .$_GET['e']. "')
					$('#mp').attr('href', 'modificarPerfil.php?op=logged&e=" .$_GET['e']. "')
					$('#gp').attr('href', 'GestionarPreguntas.php?op=logged&e=" .$_GET['e']. "')
					$('#lg').html('Logout')
					$('#lg').attr('href', 'creditos.php')
					$('#lg').click( function (){
						alert('Adios! Vuelve pronto');		
					});
				</script>
				");
			}
		} else {
			echo("
				<script type='text/javascript'>
					$('#mp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
					$('#gp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
				</script>
			");
		}
		?>
		<script type='text/javascript'>
			$('#cr').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
			$('#gp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
		</script>	
	</body>
</html>