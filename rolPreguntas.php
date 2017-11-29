<?php
	session_start();

	if ($_SESSION['rol'] == 'profesor') {
		echo ("
			<script type='text/javascript'>
			alert('Bienvenido profesor');
			window.location.href = 'GestionarPreguntasProfesor.php';
			</script>
		");
	} else {
		echo ("
			<script type='text/javascript'>
			alert('Bienvenido alumno');
			window.location.href = 'GestionarPreguntas.php';
			</script>
		");
	}
?>