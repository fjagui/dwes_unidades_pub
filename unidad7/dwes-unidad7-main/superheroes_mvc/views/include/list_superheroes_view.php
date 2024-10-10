<?php
echo "<table class=\"table text-center\">
<tr>
<th class=\"active text-center\">NOMBRE</th>
<th class=\"active text-center\">VELOCIDAD</th>
<th class=\"active text-center\">ACTIONS</th>

</tr>";
foreach ($data as $clave=>$row) {
  echo "<tr>";
  echo "<td>" . $row['nombre'] . "</td>";
  echo "<td>" . $row['velocidad'] . "</td>";
  echo "<td>";
  echo "<ul class =\"list-inline\">";

  echo "<li>" ;
  echo '<a class="btn btn-default" href="'.DIRPUBLIC.'/index.php/superheroes/edit/'.$row['id'].'"> Edit</a>';
  echo "</li>";
  echo "<li>" ;
  echo '<a class="btn btn-danger" href="'.DIRPUBLIC.'/index.php/superheroes/del/'.$row['id'].'"> Del</a>';
  echo "</li>";

  echo "</ul>";
  echo "</tr>";
}
echo "</table>";