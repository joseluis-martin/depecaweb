<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "doctorado", "es", "Doctorado");
?>



<?php
echo "<b><font color='#0066CC' size='2' face='Arial'>DOCUMENTACI&Oacute;N: </font>CLICK SOBRE EL DOCUMENTO A EDITAR</b> \n";
echo "<br /> \n";
echo "<br /> \n";

echo "<table  width='100%' border='0'>";
echo "<tr valign='top'>";
echo "<td>";
echo "<p><a name='departamento' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Formularios de Departamento</b></a></font></p>";

echo "<table border='0' width='100%'>";


//Conexión con la base de datos
$link = Conectarse();


$sql="select * from documentos_doctorado";
$result = mysql_query($sql, $link);


while($row = mysql_fetch_array($result))
 {
     $id=$row["id"];
     $nombre=$row["nombre"];
     $descripcion=$row['descripcion'];
     echo "<tr>";
     echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font class='fuenteceldas'><a style='text-decoration:none' href='./editdocumento.php?id=$id'>".$nombre."</a></font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
}
echo "</table>";





?>

</td>
</tr>

</table>


<?php

abajo();
?>