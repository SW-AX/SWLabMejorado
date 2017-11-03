<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Añadir Preguntas</title>
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
					<form id="fpreguntas" name="fpreguntas" method="post" action=<?php echo("'insertarPregunta.php?e=" .$_GET['e']. "'"); ?> style="float:left" enctype="multipart/form-data">
						Email:*<input type="text" id="var1" name="email" style="width:225px" autocomplete="true"> <br>
						Enunciado de la pregunta:*<input type="text" name="enunciado" id="var2" style="width:225px"> <br>
						Respuesta Correcta:*<input type="text" id="var3" name="rCorrecta" style="width:225px"> <br>
						Respuesta Incorrecta:*<input type="text" id="var4" name="rIncorrecta1" style="width:225px"> <br>
						Respuesta Incorrecta:*<input type="text" id="var5" name="rIncorrecta2" style="width:225px"> <br>
						Respuesta Incorrecta:*<input type="text" id="var6" name="rIncorrecta3" style="width:225px"> <br>
						Complejidad (1..5)* <input type="text" id="var7" name="complejidad" style="width:225px"> <br>
						Tema:*<input type="text" id="var8" name="tema" style="width:225px"> <br>
						Imagen: <input type="file" id="var9" name="imagen" accept="image/*" onChange="changeImg(this)"> <br>
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
			


			echo ("
				<script type='text/javascript'>
					$('#var1').val('" . $_GET['e'] . "');
					$('#var1').attr('readonly', true);
				</script>
			");

			if(isset($_POST['submit'])) {

				$link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
				$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

				if ($_POST['email'] == "" || $_POST['enunciado'] == "" || $_POST['rCorrecta'] == "" || $_POST['rIncorrecta1'] == "" || $_POST['rIncorrecta2'] == "" || $_POST['rIncorrecta3'] == "" || $_POST['complejidad'] == "" || $_POST['tema'] == "")
					die("Error campos vacios");
				if (!preg_match("/^([1-5])$/","$_POST[complejidad]"))
					die("Error complejidad");
				if (!preg_match("/^([a-zA-Z])+([0-9]{3})+(@ikasle.ehu.)+(es|eus)$/","$_POST[email]"))
					die("Error email");
				if (strlen($_POST['enunciado']) < 10)
					die("Error enunciado");
				

				$sql = "INSERT INTO preguntas(email, enunciado, rCorrecta, rIncorrecta1, rIncorrecta2, rIncorrecta3, complejidad, tema, imagen) VALUES ('$_POST[email]', '$_POST[enunciado]', '$_POST[rCorrecta]', '$_POST[rIncorrecta1]', '$_POST[rIncorrecta2]', '$_POST[rIncorrecta3]', '$_POST[complejidad]', '$_POST[tema]', '$imagen')";

				$xml = simplexml_load_file('preguntas.xml')

				$registro = $xml->addChild('assessmentItem');
				$registro->addAttribute('complexity', $_POST['complejidad']);
				$registro->addAttribute('subject', $_POST['tema']);
				$registro->addAttribute('author', $_POST['email']);
				$registro->addChild('itemBody', $_POST['enunciado'].'\n');
				$registro->addChild('correctResponse', $_POST['rCorrecta'].'\n');
				$incorrecta1-> $registro->addChild('value', $_POST['rIncorrecta1'].'\n' );
				$incorrecta2-> $registro->addChild('value', $_POST['rIncorrecta2'].'\n' );
				$incorrecta3-> $registro->addChild('value', $_POST['rIncorrecta3'].'\n' );

				echo $xml->asXML();
				$xml->asXML('preguntas.xml');



				if(!mysqli_query($link, $sql)) {
					die("Error: " . mysqli_error($link));
				}
				echo ("
					<script type='text/javascript'>
						alert('pregunta introducida correctamente!');
						//location.reload();
					</script>
				");

				mysqli_close($link);
			}		
		?>
		<script type='text/javascript'>
			$('#ip').attr('href', '').css({'cursor': 'pointer', 'pointer-events' : 'none'});
			$('#lg').click( function (){
				alert('Adios! Vuelve pronto');		
			});

			function changeImg(input){
				if (!$('#newImg').length) {
				$("#sp1").append('<img id="newImg" src="" style="float:right;width:180px;height:180px">');
				}
				var reader= new FileReader();
				reader.onload= function(e){
					$('#newImg').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}

			$("#del").click(function(){
				$("#var1").val("");
				$("#var2").val("");
				$("#var3").val("");
				$("#var4").val("");
				$("#var5").val("");
				$("#var6").val("");
				$("#var7").val("");
				$('#newImg').remove();
			});
		</script>	
	</body>
</html>