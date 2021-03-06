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
				<span><a id="cr" href='creditos.php'>Creditos</a></spam>
				
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
						Email:*<input type="text" id="var1" name="email" style="width:225px" autocomplete="true"><span id="esVip"></span><br>
						Nombre y Apellidos:*<input type="text" id="var2" name="identificador"  style="width:225px" autocomplete="true"><br>
						Nick:*<input type="text" id="var3" name="nick" style="width:225px"> <br>
						Password:*<input type="password" id="var4" name="password1" style="width:225px">
						<span id="esValida"></span> <br>
						Repetir Password:*<input type="password" id="var5" name="password2" style="width:225px"> <br>
						Foto (opcional): <input type="file" id="var6" name="imagen" accept="image/*" onChange="changeImg(this)"> <br>
						<input type="submit" name="submit" value="Enviar" id="send">
						<input type="reset" id="del">
					</form>
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a> <br>
				<span id="showlog"></span>
			</footer>
		</div>
		<?php
		if(isset($_POST['submit'])) {

			$link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
			if ($_FILES['imagen']['size'] > 0) {
				$file = file_get_contents($_FILES['imagen']['tmp_name']);
			} else {
				$file = file_get_contents("./default.jpg");
			}
			$imagen = addslashes($file);

			if ($_POST['email'] == "" || $_POST['identificador'] == "" || $_POST['nick'] == "" || $_POST['password1'] == "" || $_POST['password2'] == "")
				die("Error campos vacios");
			if (!preg_match("/^([a-zA-Z])+([0-9]{3})+(@ikasle.ehu.)+(es|eus)$/","$_POST[email]"))
				die("Error email");
			if (!preg_match("/^([a-zA-Z])+((([ ])+([a-zA-Z]{1,})){1,})$/","$_POST[identificador]"))
				die("Error identificador");
			if ($_POST['password1'] != $_POST['password2'])
				die("Error contraseñas");

			$emailsql = "SELECT * FROM usuarios WHERE email='$_POST[email]'";
			$usuarios = mysqli_query($link, $emailsql);

			$cont = mysqli_num_rows($usuarios);
			if ($cont != 0) {
				die("Error, email ya registrado");
			}

			
			$rol = 'alumno';

			$cpass = crypt($_POST['password1'], '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors');

			$sql = "INSERT INTO usuarios(email, nombre, nick, rol, password, foto) VALUES ('$_POST[email]', '$_POST[identificador]', '$_POST[nick]', '$rol', '$cpass', '$imagen')";

			if(!mysqli_query($link, $sql)) {
				die("Error: " . mysqli_error($link));
			}
			echo ("
				<script type='text/javascript'>
					alert('Registrado correctamente!');
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
			var emailCorrecto;
			var contraseñaCorrecta;

			$(document).ready(function() {
				emailCorrecto = false;
				contraseñaCorrecta = false;
			});

			$('#fregistro').submit(function(){
				if (!emailCorrecto || !contraseñaCorrecta) {
					return false;
				}
				return true;
			});

			$('#re').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});

			$('#var1').change(function() {
				$.ajax({
		            data:  {email : $('#var1').val()},
		            url:   'ComprobarVIP.php',
		            type:  'post',
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

		    $('#var4').change(function() {
				$.ajax({
		            data:  {contraseña : $('#var4').val()},
		            url:   'ComprobarContrasena.php',
		            type:  'post',
		            beforeSend: function () {
		                $("#esValida").html("Comprobando...");
		                contraseñaCorrecta = false;
		            },
		            success:  function (response) {
		            	if (response == "VALIDA") {
		                	$("#esValida").html("Valida");
		                	contraseñaCorrecta = true;
		                }
		                else {
		                	$("#esValida").html("No valida");
		                	contraseñaCorrecta = false;
		                }    
		            }
		        });
		    });	
		</script>	
	</body>
</html>