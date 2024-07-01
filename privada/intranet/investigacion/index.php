<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "investigacion", "es", "Investigaci&oacute;n");

session_start();

$user=$_SESSION['user'];
$link=Conectarse();
$sql_puesto="Select * from personal where usuario='$user'";
$result_puesto = mysql_query($sql_puesto, $link);
if($row=mysql_fetch_array($result_puesto))
{
    $puesto=$row['puesto'];
    $nif=$row["nif"];
    $nombre=$row['nombre'];
    $apellidos=$row['apellidos'];
}
?>
<!--
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
-->
<?
if($puesto=='PAS' || $user=='eduardo.molinos' || $user=='jorge.pozuelo' || $user=='sonia' || $user=='mocana' || $user=='secretario' || $user=='director')
{
?>
<table width='100%' border='0'>
<tr>
<td width='55%'><div align='right'><span class='generalbluebold'>Documentos</span>
<a href='./formularios2/adddocumento.php'><span class='generalbluebold'>[ A&ntilde;adir </span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='./formularios2/documentoseditable.php'><span class='generalbluebold'>Editar</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='./formularios2/documentosdelete.php'><span class='generalbluebold'>Borrar ]</span></a> </div></td>
</tr>
</table>
<?}?>

<table  width="100%" border="0">

<tr valign="top">
<td>

<p><a name='art83' style="text-decoration:none"><font color="#B9AFA5" size="4" face="Arial"><b>Art&iacute;culo 83</b></a></font></p>

<table border='0' width='100%'>
<?php
$link=Conectarse();


$sql="select * from documentos_investigacion where tipo='art83'";
$result = mysql_query($sql, $link);

while($row = mysql_fetch_array($result))
 {
  $tipo=$row["tipo"];
  $nombre=$row["nombre"];
  $descripcion=$row['descripcion'];

  $archivo=$row["archivo"];
  if ($archivo!=""){
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font class='fuenteceldas'><a style='text-decoration:none' href='../../../privada/".$row["archivo"]."'>".$nombre."</a></font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }else{
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font size='2' face='Arial' color='#CC0000'>".$nombre."</font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }
} 
echo "</table>";

echo "<p><a name='congresos' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Congresos</b></a></font></p>";
echo "<table border='0' width='100%'>";

$sql="select * from documentos_investigacion where tipo='congresos'";
$result = mysql_query($sql, $link);

while($row = mysql_fetch_array($result))
 {
  $tipo=$row["tipo"];
  $nombre=$row["nombre"];
  $descripcion=$row['descripcion'];

  $archivo=$row["archivo"];
  if ($archivo!=""){
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font class='fuenteceldas'><a style='text-decoration:none' href='../../../privada/".$row["archivo"]."'>".$nombre."</a></font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }else{
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font size='2' face='Arial' color='#CC0000'>".$nombre."</font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }
} 
echo "<tr><td><a style='text-decoration:none' href='http://www.rediris.es/list/diseven/'><img src='./diseven.gif'></a></td></tr>";
echo "</table>";


echo "<p><a name='doctorado' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Doctorado</b></a></font></p>";
echo "<table border='0' width='100%'>";

$sql="select * from documentos_investigacion where tipo='doctorado'";
$result = mysql_query($sql, $link);

while($row = mysql_fetch_array($result))
 {
  $tipo=$row["tipo"];
  $nombre=$row["nombre"];
  $descripcion=$row['descripcion'];
   $archivo=$row["archivo"];
  if ($archivo!=""){
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font class='fuenteceldas'><a style='text-decoration:none' href='../../../privada/".$row["archivo"]."'>".$nombre."</a></font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }else{
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font size='2' face='Arial' color='#CC0000'>".$nombre."</font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }  
} 
echo "</table>";




echo "<p><a name='id' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>I+D</b></a></font></p>";
echo "<table border='0' width='100%'>";

$sql="select * from documentos_investigacion where tipo='id'";
$result = mysql_query($sql, $link);

while($row = mysql_fetch_array($result))
 {
  $tipo=$row["tipo"];
  $nombre=$row["nombre"];
  $descripcion=$row['descripcion'];
   $archivo=$row["archivo"];
  if ($archivo!=""){
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font class='fuenteceldas'><a style='text-decoration:none' href='../../../privada/".$row["archivo"]."'>".$nombre."</a></font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }else{
      echo "<tr>";
      echo "<td class='contenido'>&nbsp;&nbsp;&nbsp;<b><font size='2' face='Arial' color='#CC0000'>".$nombre."</font></b> &nbsp;&nbsp; ".$descripcion."</td> </tr>";
  }  
} 
echo "</table>";

?>

</table>


<?php
abajo();
?>
