<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "investigacion", "es", "Investigaci&oacute;n");
?>

<table  width="100%" border="0">

<tr valign="top">
<td>
<ul>
<li><font color="#B9AFA5" size="2" face="Arial"><a href='#art83'><b>Art&iacute;culo 83</b></a></font>
<li><font color="#B9AFA5" size="2" face="Arial"><a href='#congresos'><b>Congresos</b></a></font>
<li><font color="#B9AFA5" size="2" face="Arial"><a href='#doctorado'><b>Doctorado</b></a></font>
<li><font color="#B9AFA5" size="2" face="Arial"><a href='#id'><b>I+D</b></a></font>
</ul>
</td>
</tr>
</table>


<?php
echo "<b><font color='#0066CC' size='2' face='Arial'>DOCUMENTACI&Oacute;N: </font>CLICK SOBRE EL DOCUMENTO A EDITAR</b> \n";
echo "<br /> \n";
echo "<br /> \n";



echo "<table  width='100%' border='0'>";
echo "<tr valign='top'>";
echo "<td>";
echo "<p><a name='art83' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Art&iacute;culo 83</b></a></font></p>";

echo "<table border='0' width='100%'>";


//Conexión con la base de datos
$link = Conectarse();


$sql="select * from documentos_investigacion where tipo='art83'";
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


echo "<p><a name='congresos' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Congresos</b></a></font></p>";
echo "<table border='0' width='100%'>";

$sql="select * from documentos_investigacion where tipo='congresos'";
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



echo "<p><a name='doctorado' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Doctorado</b></a></font></p>";
echo "<table border='0' width='100%'>";

$sql="select * from documentos_investigacion where tipo='doctorado'";
$result = mysql_query($sql, $link);


while($row = mysql_fetch_array($result))
 {
     $id=$row["id"];
     $nombre=$row["nombre"];
     $descripcion=$row['descripcion'];
     echo "<tr>";
     echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font class='fuenteceldas'><a style='text-decoration:none' href='./editdocumento.php?id=$id'>".$nombre."</a></font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
}



echo "<p><a name='id' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>I+D</b></a></font></p>";
echo "<table border='0' width='100%'>";

$sql="select * from documentos_investigacion where tipo='id'";
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

