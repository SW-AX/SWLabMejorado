<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Registrarse</title>
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
					<form id="fregistro" name="fregistro"  method="post" 
					<?php 
					if(isset($_GET['op'])) {
							$op = $_GET['op'];
							if ($op == 'logged') {
								echo("
									action='register.php?op=logged'
								");
							}
						} else {
							echo("
								action='register.php'
							");
						}
					?>
					 style="float:left" enctype="multipart/form-data">
						Email:*<input type="text" id="var1" name="email" style="width:225px" autocomplete="true"> <br>
						Nombre y Apellidos:*<input type="text" id="var2" name="identificador"  style="width:225px" autocomplete="true"> <span id="esVip"></span><br>
						Nick:*<input type="text" id="var3" name="nick" style="width:225px"> <br>
						Password:*<input type="password" id="var4" name="password1" style="width:225px"> <br>
						Repetir Password:*<input type="password" id="var5" name="password2" style="width:225px"> <br>
						Foto (opcional): <input type="file" id="var6" name="imagen" accept="image/*" onChange="changeImg(this)"> <br>
						<input type="submit" name="submit" value="Enviar" id="send">
						<input type="reset" id="del">
					</form>
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>
		<?php
		if(isset($_POST['submit'])) {

			$link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
			$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

			if ($_POST['email'] == "" || $_POST['identificador'] == "" || $_POST['nick'] == "" || $_POST['password1'] == "" || $_POST['password2'] == "")
				die("Error campos vacios");
			if (!preg_match("/^([a-zA-Z])+([0-9]{3})+(@ikasle.ehu.)+(es|eus)$/","$_POST[email]"))
				die("Error email");
			if (!preg_match("/^([a-zA-Z])+((([ ])+([a-zA-Z]{1,})){1,})$/","$_POST[identificador]"))
				die("Error identificador");
			if ($_POST['password1'] != $_POST['password2'])
				die("Error contraseñas");
			

			$sql = "INSERT INTO usuarios(email, nombre, nick, password, foto) VALUES ('$_POST[email]', '$_POST[identificador]', '$_POST[nick]', '$_POST[password1]', '$imagen')";

			if(!mysqli_query($link, $sql)) {
				die("Error: " . mysqli_error($link));
			}
			echo ("
				<script type='text/javascript'>
					alert('registrado correctamente!');
					//location.reload();
				</script>
			");

			mysqli_close($link);
		}	

		if(isset($_GET['op'])) {
			$op = $_GET['op'];
			if ($op == 'logged') {
				echo("
				<script type='text/javascript'>
					$('#cr').attr('href', 'creditos.php?op=logged&e=" .$_GET['e']. "')
					$('#in').attr('href', 'inicio.php?op=logged&e=" .$_GET['e']. "')
					$('#lg').html('Logout')
					$('#lg').attr('href', 'register.php')
					$('#lg').click( function (){
						alert('Adios! Vuelve pronto');		
					});
				</script>
				");
			}
		} else {
			echo("
				<script type='text/javascript'>
					$('#re').attr('href', 'register.php')
					$('#vp').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
					$('#ip').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
				</script>
			");
		}
			
		?>

		<script type='text/javascript'>
			var emailCorrecto = false;

			$('#re').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});

			$('var1').change(function() {
				$.ajax({
		            data:  {email : $('#var1').value()},
		            url:   'comprobarVIP.php',
		            type:  'get',
		            beforeSend: function () {
		                $("#esVip").html("Comprobando...");
		                emailCorrecto = false;
		            },
		            success:  function (response) {
		            	if (response == "SI") {
		                	$("#esVip").html("Valido");
		                	emailCorrecto = true;
		                }
		                else {
		                	$("#esVip").html("No valido");
		                	emailCorrecto = false;
		                }
		            }
		        });
		    });	
		</script>	
	</body>
</html>