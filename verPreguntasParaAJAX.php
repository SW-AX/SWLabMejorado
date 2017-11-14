<?php
	$link= mysqli_connect("localhost","id2956929_alexlop97","password","id2956929_quiz");
	$preguntas = mysqli_query($link, "SELECT * FROM preguntas" );
	echo '<table border = 1> <tr> <th> enunciado </th> <th> complejidad </th> <th> tema </th></tr>';
	while ($row = mysqli_fetch_array( $preguntas )) {
		echo '<tr> <td>' . $row["enunciado"] . '</td> <td>' . $row["complejidad"] . '</td> <td>' . $row["tema"] . '</td> <td>';
	}
	echo '</table>';
	$preguntas->close();
	mysqli_close($link);
?>