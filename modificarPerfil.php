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
				<h2>Quiz: el juego de las preguntas</h2>
			</header>
			<nav class='main' id='n1' role='navigation'>
				<span>Inicio</span>
				<span><a href=<?php if(isset($_SESSION['email'])) echo("'inicio.php?op=logged&e=" .$_SESSION['email']. "'");?>>Volver al inicio</a></span>
				<br><br><br>
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
				<div>
					<form id="fpreguntas" name="fpreguntas" method="post" action="" style="float:left" enctype="multipart/form-data">
						Nombre y Apellidos:*<input type="text" id="var2" name="identificador"  style="width:225px" autocomplete="true"><br>
						Nick:*<input type="text" id="var3" name="nick" style="width:225px"> <br>
						Password:*<input type="password" id="var4" name="password1" style="width:225px"> <br>
						Repetir Password:*<input type="password" id="var5" name="password2" style="width:225px"> <br>
						<span id="esValida"></span> <br>
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

			if ( $_POST['identificador'] == "" || $_POST['nick'] == "" || $_POST['password1'] == "" || $_POST['password2'] == "")
				die("Error campos vacios");
			if (!preg_match("/^([a-zA-Z])+((([ ])+([a-zA-Z]{1,})){1,})$/","$_POST[identificador]"))
				die("Error identificador");
			if ($_POST['password1'] != $_POST['password2'])
				die("Error contraseñas");

			$cpass = crypt($_POST['password1'], '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors');

			$sql = "UPDATE usuarios SET nombre='$_POST[identificador]', nick='$_POST[nick]', password='$cpass' WHERE email = '$_SESSION[email]'";

			if(!mysqli_query($link, $sql)) {
				die("Error: " . mysqli_error($link));
			}
			echo ("
				<script type='text/javascript'>
					alert('Modificado correctamente!');
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
					$('#mp').attr('href', 'modificarPerfil.php?op=logged&e=" .$_GET['e']. "')
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
			
			var contraseñaCorrecta;

			$(document).ready(function() {
				emailCorrecto = false;
				contraseñaCorrecta = false;
			});

			$('#fregistro').submit(function(){
				if (!contraseñaCorrecta) {
					return false;
				}
				return true;
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