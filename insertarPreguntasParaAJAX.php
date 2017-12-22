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

		if ($_FILES['imagen']['size'] > 0) {
			$file = file_get_contents($_FILES['imagen']['tmp_name']);
		} else {
			$file = file_get_contents("./default.jpg");
		}
		$imagen = addslashes($file);
		

		$sql = "INSERT INTO preguntas(email, enunciado, rCorrecta, rIncorrecta1, rIncorrecta2, rIncorrecta3, complejidad, tema, imagen) VALUES ('$_POST[email]', '$_POST[enunciado]', '$_POST[rCorrecta]', '$_POST[rIncorrecta1]', '$_POST[rIncorrecta2]', '$_POST[rIncorrecta3]', '$_POST[complejidad]', '$_POST[tema]', '$imagen')";

		$xml = simplexml_load_file('preguntas.xml');

		$registro = $xml->addChild('assessmentItem');

		$registro->addAttribute('complexity', $_POST['complejidad']);
		$registro->addAttribute('subject', $_POST['tema']);
		$registro->addAttribute('author', $_POST['email']);
		
		$itembody = $registro->addChild('itemBody');

		$itembody->addChild('p', $_POST['enunciado']);

		$correcta = $registro->addChild('correctResponse');
		$correcta->addChild('value', $_POST['rCorrecta']);

		$incorrecta = $registro->addChild('incorrectResponses');

		$incorrecta->addChild('value', $_POST['rIncorrecta1']);
		$incorrecta->addChild('value', $_POST['rIncorrecta2']);
		$incorrecta->addChild('value', $_POST['rIncorrecta3']);

		$dom = dom_import_simplexml($xml)->ownerDocument;
		$dom->formatOutput = TRUE;

		$xml->asXML();
		$xml->asXML('preguntas.xml');



		if(!mysqli_query($link, $sql)) {
			die("Error: " . mysqli_error($link));
		}
		mysqli_close($link);		
?>