<?php
$link = mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");

		if ($_POST['email'] == "" || $_POST['enunciado'] == "" || $_POST['rCorrecta'] == "" || $_POST['rIncorrecta1'] == "" || $_POST['rIncorrecta2'] == "" || $_POST['rIncorrecta3'] == "" || $_POST['complejidad'] == "" || $_POST['tema'] == "")
			die("Error campos vacios");
		if (!preg_match("/^([1-5])$/","$_POST[complejidad]"))
			die("Error complejidad");
		if (!preg_match("/^([a-zA-Z])+([0-9]{3})+(@ikasle.ehu.)+(es|eus)$/","$_POST[email]"))
			die("Error email");
		if (strlen($_POST['enunciado']) < 10)
			die("Error enunciado");
		

		$sql = "UPDATE  preguntas SET enunciado ='$_POST[enunciado]', rCorrecta = '$_POST[rCorrecta]', rIncorrecta1='$_POST[rIncorrecta1]', 
		rIncorrecta2='$_POST[rIncorrecta2]', rIncorrecta3= '$_POST[rIncorrecta3]', complejidad= '$_POST[complejidad]', tema='$_POST[tema]'
		WHERE id='$_POST[id]'";

		if(!mysqli_query($link, $sql)) {
			die("Error: " . mysqli_error($link));
		}
		mysqli_close($link);
		
		echo $_POST['email'];
?>