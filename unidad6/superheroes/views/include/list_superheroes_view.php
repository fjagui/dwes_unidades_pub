<?php
/**
 * Forma parte de la vista, generada con php
 */
echo "<table class=\"table text-center\">
<tr>
<th class=\"active text-center\">NOMBRE</th>
<th class=\"active text-center\">VELOCIDAD</th>
<th class=\"active text-center\">ACTIONS</th>

</tr>";
foreach ($data['sh'] as $clave=>$row) {
  echo "<tr>";
  echo "<td>" . $row['nombre'] . "</td>";
  echo "<td>" . $row['velocidad'] . "</td>";
  echo "<td>";
  echo "<ul class =\"list-inline\">";

  echo "<li>" ;
  echo '<a class="btn btn-default" href="' . DIRPUBLIC . '/superheroes/edit/' . (int)$row['id'] . '"> Edit</a>'; // Redirige a la ruta de edición del superhéroe  echo "</li>";
  echo "<li>" ;
  echo '<a class="btn btn-danger" href="' . DIRPUBLIC . '/superheroes/del/' . (int)$row['id'] . '" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este superhéroe?\');"> Del</a>'; // Redirige a la ruta de eliminación, con confirmación previa  echo "</li>";

  echo "</ul>";
  echo "</tr>";
}
echo "</table>";