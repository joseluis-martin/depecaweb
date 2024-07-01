<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");

echo "<table width='100%' border='0' align='center'><tr><td class='encabezado'><font color='#FFFFFF' size='4' face='Arial'>";
echo "Tipo de carrera";
echo "</td></tr><tr><td class='celdagris'><font class='fuentenegra'>";
echo "<a href='./addcarrera.php'>Titulaciones de grado, posgrado y doctorado</a>";
echo "</td></tr><tr><td class='celdagris'><font class='fuentenegra'>";
echo "<a href='./addcarreraprue.php'>Titulaciones de nuevos grados</a> (Deprecated)";
echo "</td></tr></table>";
abajo();
?>