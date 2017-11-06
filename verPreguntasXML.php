<!DOCTYPE html>
<?php

$preguntas = simplexml_load_file('preguntas.xml');



echo '<table border=1>
		<tr>			
			<th>ENUNCIADO</th>
			<th>COMPLEJIDAD</th>
			<th>TEMA</th>
		</tr>';
		
	foreach($preguntas->children() as $pregunta){
		echo'<tr>';
		echo '<td>'.$pregunta->itemBody->p.'</td>';
        echo '<td>'.$pregunta->attributes()->complexity.'</td>';
        echo '<td>'.$pregunta->attributes()->subject.'</td>';
        echo '</tr>';
	}
echo '</table>';	
?>
