<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>


<html>
<head>
<title>Borrar Personal- WebDepeca</title>
<LINK  REL="stylesheet" TYPE="text/css" HREF="../../../public-en/Estilos.css">
</head>
<body>

<table width="100%" border="0">
  <tr> 
<?php

$id2=($_GET['id']);

	echo"<div align='center'><span class = generalbluebold><br><br>¿Est&aacute; seguro de eliminar este registro?<br><br></span> \n";
	echo"<a href='../../personalpdelete.php?borrarper=1&selec=$id2'><span class = generalbluebold>Si</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> \n";
	echo"<a href='../../personalpdelete.php?borrarper=0'><span class = generalbluebold>No</span></a></div> \n";
	echo"</td> \n";
  echo"</tr> \n";
echo"</table> \n";  
echo"<br> \n";
echo"<table width='95%' height='68' border='0' align='right'> \n";
  echo"<tr> \n";
    echo"<td valign='top'> \n";
    
 
 
 
//Conexion con la base
$link = Conectarse();


$sql = "SELECT * FROM personal WHERE id=$id2";

$result = mysql_query($sql, $link);


echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<table border = '0' align='center'> \n";

echo "<tr> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Nombre</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Apellidos</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Telefono</font></b></td> \n";

echo "<td align='center' bgcolor='#DCC891'><b><font color='#FFFFFF' size='2' face='Arial'>Email</font></b></td> \n";

echo "</tr> \n";

do {

echo "<tr> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["nombre"]."</font></b></td> \n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>".$row["apellidos"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><b><font color='#FFFFFF' size='2' face='Arial'>+34 91884".$row["telefono_universidad"]."</font></b></td>\n";

echo "<td bgcolor='#B9AFA5'><font color='#FFFFFF' size='2' face='Arial'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></font></td> \n"; 

echo "</tr> \n";

} while ($row = mysql_fetch_array($result));

echo "</table> \n";

echo "<br>\r";

}

mysql_free_result($result);
mysql_close ($link);   
    
?>	  
	</td>
  </tr>
</table>
</body>
</html>

<?php
abajo();
?>