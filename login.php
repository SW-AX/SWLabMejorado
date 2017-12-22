<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Login</title>
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
				<h4 id="emailReg">Usted no esta registrado</h4>
				<h2>Quiz: el juego de las preguntas</h2>
			</header>
			<nav class='main' id='n1' role='navigation'>
				<span><a id="in" href='inicio.php'>Inicio</a></span>
				<span ><a id="vp" href='verPreguntas.php'>Preguntas</a></span>
				<span><a id="cr" href='creditos.php'>Creditos</a></spam>
				<span ><a id="ip" href='insertarPregunta.php'>Añadir Pregunta</a></span>
				<span ><a id="mp" href='modificarPerfil.php'>Modificar Perfil</a></span>
			</nav>
			<section class="main" id="s1">
				<div id="main">
					<form enctype="multipart/form-data" id="flogin" name="flogin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						Email*: <input type="text" id="email" name="email" style="width:225px"> <br>
						Password*: <input type="password" id="pass" name="pass" style="width:225px"> <br>
						<input type="submit" name = "submit" value="Enviar" id="send">
						<input type="reset" id="del">
					</form><br/>
					<span><a id="co" href='contrasenaOlvidada.php'>Has olvidado tu contraseña?</a></span>
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>
		<?php
			if(isset($_POST['submit'])) {

				$mysql = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz")
				or die(mysqli_error());

				$email = $_POST['email'];
				$pass = crypt($_POST['pass'], '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors');

				$usuarios = mysqli_query( $mysql,"select * from usuarios where email='$email' and password='$pass'");

				$cont = mysqli_num_rows($usuarios); //Se verifica el total de filas devueltas

				//mysqli_close( $mysql); //cierra la conexion

				if($cont == 1){

					$_SESSION["autentificado"]= "SI";
					$_SESSION["email"]= $email;

					$row = mysqli_fetch_array($usuarios);
					$_SESSION["rol"] = $row["rol"];

					echo ("
						<script type='text/javascript'>
						alert('login correcto!');
						window.location.href = 'inicio.php?op=logged&e=" . $email . "';
						alert('".$_SESSION["rol"]."');
						</script>
					");
				}
				else {
					echo ("
						<script type='text/javascript'>
							alert('login incorrecto!');
						</script>
					");
				}
			}
			else {
 				if (isset($_SESSION["autentificado"]) && $_SESSION["autentificado"] == true) {
 					echo ("
						<script type='text/javascript'>
						alert('ya te habias logeado!');
						window.location.href = 'inicio.php?op=logged&e=" . $_SESSION['email'] . "';
						</script>
					");
 				}

			}
		?>
		<script type='text/javascript'>
			$('#lg').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
			$('#vp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
			$('#ip').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
		</script>	
	</body>
</html>