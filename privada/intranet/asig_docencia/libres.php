<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

$curso=$_GET['valor2'];

echo "<table width='100%' border='0' bordercolor='#FFFFCC'>";
echo "<tr><td class='encabezado'><font  class='fuenteblanco'><strong>Titulaci&oacute;n</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Asignatura</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Teoria 1C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Teoria Ingl&eacute;s 1C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Lab 1C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Lab Ingl&eacute;s 1C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Eje. 1C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Eje. Ingl&eacute;s 1C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Teoria 2C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Teoria Ingl&eacute;s 2C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Lab 2C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Lab Ingl&eacute;s 2C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Eje. 2C</strong></td><td class='encabezado'><font  class='fuenteblanco'><strong>Horas Libres Eje. Ingl&eacute;s 2C</strong></td></tr>";
$link=Conectarse();

$cont=0;

$sql_asig = "select DISTINCT codigo,nombre,titulacion from asignaturas where codigo>13 group by codigo order by titulacion";
//$sql_asig = "select DISTINCT codigo,id,abreviatura,nombre,codigo_titulacion,semestre,caracter,creditos,creditos_teoria,creditos_practica,nivel,anio,titulacion,cuatrimestre,curso_academico,estado from asignaturas order by titulacion";
$result_asig = mysql_query($sql_asig, $link);
while ($row_asig = mysql_fetch_array($result_asig)){
   $cod_asig=$row_asig['codigo'];
   $sql = "SELECT DISTINCT cod_asig,curso,ht1c_totales,ht2c_totales,hl1c_totales,hl2c_totales,hej1c_totales,hej2c_totales,ht1ec_totales,ht2ec_totales,hl1ec_totales,hl2ec_totales,hej1ec_totales,hej2ec_totales FROM horas_asignatura WHERE curso='$curso'and cod_asig='$cod_asig'";		
   $result = mysql_query($sql, $link);
   while($row = mysql_fetch_array($result))
   {
       /*$ht1c=$row['ht1c'];
	$hl1c=$row['hl1c'];
	$ht2c=$row['ht2c'];
	$hl2c=$row['hl2c'];
	$hej1c=$row['hej1c'];
	$hej2c=$row['hej2c'];

	$sumht1c=0;
	$sumhl1c=0;
	$sumht2c=0;
	$sumhl2c=0;
	$sumhej1c=0;
	$sumhej2c=0;
	$resht1c=0;
	$reshl1c=0;
	$resht2c=0;
	$reshl2c=0;
	$reshej1c=0;
	$reshej2c=0;*/

        $ht1c=$row['ht1c_totales'];
	$hl1c=$row['hl1c_totales'];
	$ht2c=$row['ht2c_totales'];
	$hl2c=$row['hl2c_totales'];
	$hej1c=$row['hej1c_totales'];
	$hej2c=$row['hej2c_totales'];
	$ht1ec=$row['ht1ec_totales'];
	$hl1ec=$row['hl1ec_totales'];
	$ht2ec=$row['ht2ec_totales'];
	$hl2ec=$row['hl2ec_totales'];
	$hej1ec=$row['hej1ec_totales'];
	$hej2ec=$row['hej2ec_totales'];

	$sumht1c=0;
	$sumhl1c=0;
	$sumht2c=0;
	$sumhl2c=0;
	$sumhej1c=0;
	$sumhej2c=0;
	$sumht1ec=0;
	$sumhl1ec=0;
	$sumht2ec=0;
	$sumhl2ec=0;
	$sumhej1ec=0;
	$sumhej2ec=0;
	


	$resht1c=0;
	$reshl1c=0;
	$resht2c=0;
	$reshl2c=0;
	$reshej1c=0;
	$reshej2c=0;
	$resht1ec=0;
	$reshl1ec=0;
	$resht2ec=0;
	$reshl2ec=0;
	$reshej1ec=0;
	$reshej2ec=0;
	

	$sql2 = "select * from horas_docencia where cod_asig='$cod_asig' and curso='$curso'";		
	$result2 = mysql_query($sql2, $link);
	while($row2 = mysql_fetch_array($result2))
	{
	   	$sumht1c=$sumht1c+$row2['HT1C_totales'];
		$sumhl1c=$sumhl1c+$row2['HL1C_totales'];
		$sumht2c=$sumht2c+$row2['HT2C_totales'];
		$sumhl2c=$sumhl2c+$row2['HL2C_totales']; 		
		$sumhej1c=$sumhej1c+$row2['HEJ1C_totales'];
		$sumhej2c=$sumhej2c+$row2['HEJ2C_totales'];
		$sumht1ec=$sumht1ec+$row2['HT1EC_totales'];
		$sumhl1ec=$sumhl1ec+$row2['HL1EC_totales'];
		$sumht2ec=$sumht2ec+$row2['HT2EC_totales'];
		$sumhl2ec=$sumhl2ec+$row2['HL2EC_totales']; 		
		$sumhej1ec=$sumhej1ec+$row2['HEJ1EC_totales'];
		$sumhej2ec=$sumhej2ec+$row2['HEJ2EC_totales'];
	}
	
	$resht1c=$ht1c-$sumht1c;
	$reshl1c=$hl1c-$sumhl1c;
	$resht2c=$ht2c-$sumht2c;
	$reshl2c=$hl2c-$sumhl2c;
	$reshej1c=$hej1c-$sumhej1c;
	$reshej2c=$hej2c-$sumhej2c;
	$resht1ec=$ht1ec-$sumht1ec;
	$reshl1ec=$hl1ec-$sumhl1ec;
	$resht2ec=$ht2ec-$sumht2ec;
	$reshl2ec=$hl2ec-$sumhl2ec;
	$reshej1ec=$hej1ec-$sumhej1ec;
	$reshej2ec=$hej2ec-$sumhej2ec;
	
    if (abs($resht1c)<0.01)
	{
	    $resht1c=0;
	}
	if (abs($resht2c)<0.01)
	{
	    $resht2c=0;
	}
	if (abs($reshl1c)<0.01)
	{
	    $reshl1c=0;
	}
	if (abs($reshl2c)<0.01)
	{
	    $reshl2c=0;
	}
	if (abs($reshej1c)<0.01)
	{
	    $reshej1c=0;
	}
	if (abs($reshej2c)<0.01)
	{
	    $reshej2c=0;
	}
	if (abs($resht1ec)<0.01)
	{
	    $resht1ec=0;
	}
	if (abs($resht2ec)<0.01)
	{
	    $resht2ec=0;
	}
	if (abs($reshl1ec)<0.01)
	{
	    $reshl1ec=0;
	}
	if (abs($reshl2ec)<0.01)
	{
	    $reshl2ec=0;
	}
	if (abs($reshej1ec)<0.01)
	{
	    $reshej1ec=0;
	}
	if (abs($reshej2ec)<0.01)
	{
	    $reshej2ec=0;
	}


	if($resht1c > 0 || $reshl1c > 0 || $resht2c > 0 || $reshl2c > 0 || $reshej1c > 0 || $reshej2c > 0 || $resht1ec > 0 || $reshl1ec > 0 || $resht2ec > 0 || $reshl2ec > 0 || $reshej1ec > 0 || $reshej2ec > 0){
    	
	    $cont++;
	    
	    echo"<tr><td class='celdagris'><font class='fuenteblanco'><strong>".$row_asig['titulacion']."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$row_asig['nombre']." (".$row_asig['codigo'].")</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht1c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht1ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl1c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl1ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej1c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej1ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht2c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht2ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl2c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl2ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej2c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej2ec."</strong></td>";
	}
       
    	if($resht1c < 0 || $reshl1c < 0 || $resht2c < 0 || $reshl2c < 0 || $reshej1c < 0 || $reshej2c < 0 || $resht1ec < 0 || $reshl1ec < 0 || $resht2ec < 0 || $reshl2ec < 0 || $reshej1ec < 0 || $reshej2ec < 0){
    	
	    $cont++;
	    
	    echo"<tr><td class='celdagris'><font class='fuenteblanco'><strong>".$row_asig['titulacion']."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$row_asig['nombre']." (".$row_asig['codigo'].")</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht1c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht1ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl1c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl1ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej1c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej1ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht2c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$resht2ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl2c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshl2ec."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej2c."</strong></td><td class='celdagris'><font class='fuenteblanco'><strong>".$reshej2ec."</strong></td>";
	}   
    }
}
if($cont=='0')
{
    echo "<br><br><br><br>";
    echo "<div align='center'><font class='fuenteazul'><strong>No exiten asignaturas libres.</strong></font></div>";
}

echo "</table>";

?>
<br><br><br><br>
<div align="right"><a href="./index.php" class="generalbluebold"><< Volver</a> </div>


<?php
abajo();
?>
