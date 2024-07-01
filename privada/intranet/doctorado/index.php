<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "doctorado", "es", "Doctorado");

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



<?
if($user=='mocana' || $user=='director' || $user=='subdirector' || $user=='secretario')
{
?>
<table width='100%' border='0'>
<tr>
<td width='55%'><div align='right'><span class='generalbluebold'>Documentos</span>
<a href='./formularios/adddocumento.php'><span class='generalbluebold'>[ A&ntilde;adir </span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='./formularios/documentoseditable.php'><span class='generalbluebold'>Editar</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='./formularios/documentosdelete.php'><span class='generalbluebold'>Borrar ]</span></a> </div></td>
</tr>
</table>
<?}?>

<table  width="100%" border="0">

<tr valign="top">
<td>

<p><a name='docinteres' style="text-decoration:none"><font color="#B9AFA5" size="4" face="Arial"><b>Documentos de inter&eacute;s</b></a></font></p>

<table border='0' width='100%'>
<?php
$link=Conectarse();

$sql="select * from documentos_doctorado order by nombre";
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
    
<p><a name='consultas' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Enlaces de inter&eacute;s</b></a></font></p>

<table  width="100%" border="0">

<tr valign="top">
<td>

<font color="#B9AFA5" size="2" face="Arial"><a href='http://escuela-doctorado.uah.es'><b>Enlace a la p&aacute;gina web de la Escuela de Doctorado de la UAH</b></a></font>
    </br>
    </br>

<font color="#B9AFA5" size="2" face="Arial"><a href='http://escuela-doctorado.uah.es/oferta_academica/oferta_un_estudio.asp?p_curso_academico=2018-2019&p_cod_estudio=D441&p_cod_rama=IA&capa=ing '><b>Electr&oacute;nica: Sistemas Electr&oacute;nicos Avanzados. Sistemas Inteligentes</b></a></font>
    </br>
    </br>

<font color="#B9AFA5" size="2" face="Arial"><a href=' http://escuela-doctorado.uah.es/tramites_academicos/impresos.asp'><b>Formularios de la Escuela de Doctorado</b></a></font>
    
</td>
</tr>
</table>



<!-- Formularios de la página de investigación antigua. Desaparecerán todos después de comprobarlos Sira. -->

<!--
<table width='100%' border='0'>
<tr>
<td width='55%'><div align='right'><span class='generalbluebold'>Documentos no actualizados</span>
<a href='./formularios2/adddocumento.php'><span class='generalbluebold'>[ A&ntilde;adir </span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='./formularios2/documentoseditable.php'><span class='generalbluebold'>Editar</span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='./formularios2/documentosdelete.php'><span class='generalbluebold'>[ Borrar ]</span></a> </div></td>
</tr>
</table>
-->
    
<?php    
/*    
echo "<p><a name='doctorado' style='text-decoration:none'><font color='#B9AFA5' size='4' face='Arial'><b>Doctorado (documentos no actualizados)</b></a></font></p>";
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
*/
?>

<?php
abajo();
?>
