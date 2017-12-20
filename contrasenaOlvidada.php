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
		<section class="main" id="s1">
			<div id="main">
				<form id="fmailolvidado" name="fmailolvidado"  method="post" action="return false">
				Email de la cuenta con la contraseña olvidada:*<input type="text" id="var1" name="email" style="width:225px" autocomplete="true"><br>
				<input type="button" name="submit" value="Enviar" id="send">
				</form><br/>
				<span><a id="lg" href='login.php'>Volver al login</a></span>
			</div>
		</section>
	</body>
	<script type='text/javascript'>

	$('#send').click(function() {
				$.ajax({
		            data:  {email : $('#var1').val()},
		            url:   'recuperarContraseña.php',
		            type:  'post',
		            success:  function (response) {
		            	if (response == "erroremail") {
		                	alert('El email no existe en la base de datos');
		                }
		                else if(response == "error") {
		                	alert('El correo no se ha mandado correctamente. Intentelo de nuevo');
		                } 
						else {
							alert('Tu nueva contraseña se ha enviado a tu email!');
						}
		            }
		        });
		    });

	</script>
</html>