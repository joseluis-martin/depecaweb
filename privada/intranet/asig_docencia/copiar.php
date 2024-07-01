<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

$user=$_SESSION['user'];

$curso=$_GET['valor2'];

?>

<script>
var valor2;

function Redireccion(value) {
    valor2=value;
    location.href = "./index.php?valor2="+valor2;
}

</script>

<?
$link = Conectarse();
$sql_cargas = "select * from cargas_max where curso='$curso'";    
$resul_cargas = mysql_query($sql_cargas, $link);
if($row_cargas = mysql_fetch_array($resul_cargas))
  $cargas=1;
else
  $cargas=0;
$sql_horas_doc = "select * from horas_docencia where curso='$curso'";    
$resul_horas_doc = mysql_query($sql_horas_doc, $link);
if($row_horas_doc = mysql_fetch_array($resul_horas_doc))
  $horas_doc=1;
else
  $horas_doc=0;

$sql_horas_asig = "select * from horas_asignatura where curso='$curso'";    
$resul_horas_asig = mysql_query($sql_horas_asig, $link);
if($row_horas_asig = mysql_fetch_array($resul_horas_asig))
  $horas_asig=1;
else
  $horas_asig=0;

if($cargas=='1' && $horas_doc=='1' && $horas_asig=='1')
{
?>   
<script>Redireccion('<?echo $curso?>');</script>
<?
						 
}
else
{
    echo"<table width='100%' border='0'>";
    echo "<tr>";
    echo"<td width='45%' height='46'> <h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copiar docencia</h3> \n";
    echo"<div align='center'><span class = generalbluebold><br><br>No existen registros para el curso ".$curso.". ¿Desea copiar los registros del curso anterior?<br><br></span> \n";
    echo"<a href='./copiar_registros.php?curso=$curso'><span class = generalbluebold>Si</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> \n";
    echo"<a href='./index.php?valor2=$curso'><span class = generalbluebold>No</span></a></div> \n";
    echo"</td> \n";
    echo"</tr> \n";
    echo"</table> \n";    
}
?>



<?php
abajo();
?>