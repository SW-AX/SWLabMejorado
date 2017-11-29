<?php
	session_start();
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
	<section class="main" id="s1">
				<div id="main">
					<?php
						
						
						$link= mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
						$preguntas = mysqli_query($link, "SELECT * FROM preguntas" );
						echo '<table border = 1> <tr> <th>email</th> <th> enunciado </th> <th>rCorrecta</th> <th>rIncorrecta1</th> <th>rIncorrecta2</th>
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
								echo '<td> <input type="button" value="Enviar" onclick="actualizarFila(' . $row["id"] . ')" /> </td>';
								echo '<input type="hidden" value="' . $row["id"] . '" name="id" />';
							
							echo '</form>';
							echo '</tr>';
						}
						echo '</table>';
						$preguntas->close();
						mysqli_close($link);
					?>
				</div>
			</section>
			<script>
				function actualizarFila(row) {
					$.ajax({
		            data:  $("#" + row).serialize(),
		            url:   'actualizarFila.php',
		            type:  'post',
		            beforeSend: function () {
		                alert(row);
		            },
		            success:  function (response) {
		            	alert(response);
		            }
		        });
				}
			</script>
	</body>
	</html>