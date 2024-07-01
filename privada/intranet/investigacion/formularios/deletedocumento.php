<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "investigacion", "es", "Investigaci&oacute;n");
?>
<table width="100%" border="0">
  <tr> 
<?php

$id2=($_GET['id']);

  
  echo"<td width='45%' height='46' align='center'> <h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='#DCC891' size='2' face='Arial'>Borrar Documento</font></h3> \n";
  echo"<div align='center'><span class = generalbluebold><br><br><b><font color='#06C' size='2' face='Arial'>¿Est&aacute; seguro de eliminar este documento?</font></b><br><br></span> \n";
  echo"<a href='./documentosdelete.php?borrardoc=1&selec=$id2'><span class = generalbluebold>Si</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> \n";
  echo"<a href='./documentosdelete.php?borrardoc=0'><span class = generalbluebold>No</span></a></div> \n";
  echo"</td> \n";
  echo"</tr> \n";
  echo"</table> \n";  
  echo"<br> \n";
  echo"<table width='95%' height='68' border='0' align='right'> \n";
  echo"<tr> \n";
  echo"<td valign='top'> \n";
 
 
//Conexion con la base
$link = Conectarse();

$sql = "SELECT * FROM documentos_investigacion WHERE id=$id2";

$result = mysql_query($sql, $link);


echo "<br>\r";

if ($row = mysql_fetch_array($result)){

echo "<br>\r";

echo "<br>\r";


echo "<table border='1' align='center'> \n";

echo "<tr> \n";

echo "<td bgcolor='#B9AFA5'><b>Documento: </b></td> \n";

echo "<td bgcolor='#DCC891'>".$row["nombre"]."</td> \n";

echo "</tr> \n";

echo "</table> \n";

}


mysql_free_result($result);
mysql_close ($link);   
  
?>	  
	</td>
  </tr>
</table>


<?php
abajo();
?>