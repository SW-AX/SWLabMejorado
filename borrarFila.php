<?php
	$link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");

	$sql = "DELETE FROM preguntas WHERE id='$_POST[id]'";

	if(!mysqli_query($link, $sql)) {
		die("Error: " . mysqli_error($link));
	}
	mysqli_close($link);

	echo "Pregunta con id " . $_POST["id"] . " borrada correctamente";
?>