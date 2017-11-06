<!DOCTYPE html>
<?php

$link = mysql_connect("localhost","id2956929_alexlop97","password","id2956929_quiz")

    or die('No se pudo conectar: ' . mysql_error());


$preguntas = mysql_query($link, 'SELECT * FROM preguntas') or die('Consulta fallida: ' . mysql_error());



echo '<table border=1>
		<tr>
			<th>EMAIL</th>
			<th>ENUNCIADO</th>
			<th>RESPUESTA CORRECTA</th>
			<th>RESPUESTAS INCORRECTAS</th>
			<th>COMPLEJIDAD</th>
			<th>TEMA</th>
		</tr>';
		
 while ($row = mysql_fetch_array($preguntas)){
	echo'<tr><td>' .$row['email']. '</td>
    <td>' .$row['enunciado']. '</td>
    <td>' .$row['rCorrecta']. '</td>
    <td>' .$row['rIncorrecta1']. , .$row['rIncorrecta2']. , .$row['rIncorrecta3'].'</td>
    <td>' .$row['complejidad'].'</td>
    <td>' .$row['tema']. '</td></tr>'
 }
 echo '</table>';
$usuarios->close();
mysqli_close($link);
	
?>
