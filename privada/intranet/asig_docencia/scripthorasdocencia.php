<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");

$link=Conectarse();
$curso="2012/2013";
$sql="select * from horas_docencia where curso='$curso'";
$result=mysql_query($sql,$link);
while($row=mysql_fetch_array($result))
    {

	$nif=$row['nif'];
        $cod_asig=$row['cod_asig'];
        $HT1C=$row['HT1C'];
        $HT1C_totales=$row['HT1C_totales'];
        $HL1C=$row['HL1C'];
        $HL1C_totales=$row['HL1C_totales'];
	$HT2C=$row['HT2C'];
        $HT2C_totales= $row['HT2C_totales'];
        $HL2C=$row['HL2C'];
        $HL2C_totales=$row['HL2C_totales'];
        $HEJ1C=$row['HEJ1C'];
        $HEJ1C_totales=$row['HEJ1C_totales'];
        $HEJ2C=$row['HEJ2C'];
        $HEJ2C_totales=$row['HEJ2C_totales'];
        $HT1EC=$row['HT1EC'];
        $HT1EC_totales=$row['HT1EC_totales'];
        $HL1EC=$row['HL1EC'];
        $HL1EC_totales=$row['HL1EC_totales'];
        $HT2EC=$row['HT2EC'];
        $HT2EC_totales=$row['HT2EC_totales'];
        $HL2EC=$row['HL2EC'];
        $HL1EC_totales=$row['HL2EC_totales'];
        $HEJ1EC=$row['HEJ1EC'];
        $HEJ1EC_totales=$row['HEJ1EC_totales'];   
        $HEJ2EC=$row['HEJ2EC'];
        $HEJ2EC_totales=$row['HEJ2EC_totales'];
	
	
	$sqlinsert="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C,HT1C_totales,HL1C,HL1C_totales,HT2C,HT2C_totales,HL2C,HL2C_totales,HEJ1C,HEJ1C_totales,HEJ2C,HEJ2C_totales,HT1EC,HT1EC_totales,HL1EC,HL1EC_totales,HT2EC,HT2EC_totales,HL2EC,HL2EC_totales,HEJ1EC,HEJ1EC_totales,HEJ2EC,HEJ2EC_totales)
VALUES ('$nif','$cod_asig','2013/2014','$HT1C','$HT1C_totales','$HL1C','$HL1C_totales','$HT2C','$HT2C_totales','$HL2C','$HL2C_totales','$HEJ1C','$HEJ1C_totales','$HEJ2C','$HEJ2C_totales','$HT1EC','$HT1EC_totales','$HL1EC','$HL1EC_totales','$HT2EC','$HT2EC_totales','$HL2EC','$HL2EC_totales','$HEJ1EC','$HEJ1EC_totales','$HEJ2EC','$HEJ2EC_totales')";

$result2=mysql_query($sqlinsert,$link);
echo mysql_errno().": ".mysql_error();	    
}


$curso="2012/2013";
$sql="select * from horas_asignatura where curso='$curso'";
$result3=mysql_query($sql,$link);
while($row=mysql_fetch_array($result3))
    {

	
        $cod_asig=$row['cod_asig'];
        $HT1C=$row['ht1c'];
        $HT1C_totales=$row['ht1c_totales'];
        $HL1C=$row['hl1c'];
        $HL1C_totales=$row['hl1c_totales'];
	$HT2C=$row['ht2c'];
        $HT2C_totales= $row['ht2c_totales'];
        $HL2C=$row['hl2c'];
        $HL2C_totales=$row['hl2c_totales'];
        $HEJ1C=$row['hej1c'];
        $HEJ1C_totales=$row['hej1c_totales'];
        $HEJ2C=$row['hej2c'];
        $HEJ2C_totales=$row['hej2c_totales'];
        $HT1EC=$row['ht1ec'];
        $HT1EC_totales=$row['ht1ec_totales'];
        $HL1EC=$row['hl1ec'];
        $HL1EC_totales=$row['hl1ec_totales'];
        $HT2EC=$row['ht2ec'];
        $HT2EC_totales=$row['ht2ec_totales'];
        $HL2EC=$row['hl2ec'];
        $HL1EC_totales=$row['hl2ec_totales'];
        $HEJ1EC=$row['hej1ec'];
        $HEJ1EC_totales=$row['hej1ec_totales'];   
        $HEJ2EC=$row['hej2ec'];
        $HEJ2EC_totales=$row['hej2ec_totales'];
	
	
	$sqlinsert="INSERT INTO horas_asignatura (cod_asig,curso,ht1c,ht1c_totales,hl1c,hl1c_totales,ht2c,ht2c_totales,hl2c,hl2c_totales,hej1c,hej1c_totales,hej2c,hej2c_totales,ht1ec,ht1ec_totales,hl1ec,hl1ec_totales,ht2ec,ht2ec_totales,hl2ec,hl2ec_totales,hej1ec,hej1ec_totales,hej2ec,hej2ec_totales)
VALUES ('$cod_asig','2013/2014','$HT1C','$HT1C_totales','$HL1C','$HL1C_totales','$HT2C','$HT2C_totales','$HL2C','$HL2C_totales','$HEJ1C','$HEJ1C_totales','$HEJ2C','$HEJ2C_totales','$HT1EC','$HT1EC_totales','$HL1EC','$HL1EC_totales','$HT2EC','$HT2EC_totales','$HL2EC','$HL2EC_totales','$HEJ1EC','$HEJ1EC_totales','$HEJ2EC','$HEJ2EC_totales')";

$result4=mysql_query($sqlinsert,$link);
echo mysql_errno().": ".mysql_error();	    
}

$sql="select * from cargas_max where curso='$curso'";
$result5=mysql_query($sql,$link);
while($row=mysql_fetch_array($result5))
    {

	$nif=$row['nif'];
        $cargamax=$row['cargamax'];
        $cargamax_total=$row['cargamax_total'];
        $situacion_academica=$row['situacion_academica'];
        
	
	$sqlinsert="INSERT INTO cargas_max (nif,cargamax,cargamax_total,curso,situacion_academica) VALUES ('$nif','$cargamax','$cargamax_total','2013/2014','$situacion_academica')";

$result6=mysql_query($sqlinsert,$link);
echo mysql_errno().": ".mysql_error();	    
}


abajo();
?>
