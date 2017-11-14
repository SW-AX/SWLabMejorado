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
				<span>Inicio</spam>
				<span><a href=<?php echo("'inicio.php?op=logged&e=" .$_GET['e']. "'"); ?>>Volver al inicio</a></spam>
			</nav>
			<section class="main" id="s1">

				<div>
					<input type="button" name="ver" value="Ver" id="ver" onclick="pedirDatos()">
				</div>
		    
				<div>
					<form id="fpreguntas" name="fpreguntas" method="post" action="" style="float:left" enctype="multipart/form-data">
						Email:*<input type="text" id="var1" name="email" style="width:225px" autocomplete="true"> <br>
						Enunciado de la pregunta:*<input type="text" name="enunciado" id="var2" style="width:225px"> <br>
						Respuesta Correcta:*<input type="text" id="var3" name="rCorrecta" style="width:225px"> <br>
						Respuesta Incorrecta:*<input type="text" id="var4" name="rIncorrecta1" style="width:225px"> <br>
						Respuesta Incorrecta:*<input type="text" id="var5" name="rIncorrecta2" style="width:225px"> <br>
						Respuesta Incorrecta:*<input type="text" id="var6" name="rIncorrecta3" style="width:225px"> <br>
						Complejidad (1..5)* <input type="text" id="var7" name="complejidad" style="width:225px"> <br>
						Tema:*<input type="text" id="var8" name="tema" style="width:225px"> <br>
						Imagen: <input type="file" id="var9" name="imagen" accept="image/*" onChange="changeImg(this)"> <br>
						<input type="button" name="submit" value="Enviar" id="send">
						<input type="reset" id="del">
					</form>
				</div>

				<div id="resultado">
					
				</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>
		<script>
			function changeImg(input){
				if (!$('#newImg').length) {
				$("#s1").append('<img id="newImg" src="" style="float:right;width:180px;height:180px">');
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

			XMLHttpRequestObject = new XMLHttpRequest();

			XMLHttpRequestObject.onreadystatechange = function() {
				alert (XMLHttpRequestObject.responseText);
				if (XMLHttpRequestObject.readyState == 4) {
					var obj = document.getElementById('resultado');

					var respuesta = XMLHttpRequestObject.responseText;

					var numeroPreguntas = respuesta.getElementsByTagName('assessmentItem').length();

					alert("numero preguntas es" + numeroPreguntas);

					for (var i = 0; i < numeroPreguntas; i++) {

						obj.innerHTML =  respuesta.getElementByTagName('assessmentItem')[i].getAttribute('complexity');
						alert("contador" + i);
					}
				}
			}

			function pedirDatos() {
				XMLHttpRequestObject.open("GET",'preguntas.xml');
 				XMLHttpRequestObject.send(null);
			}
		</script>
	</body>
</html>