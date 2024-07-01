<?php
require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");


function existeProfesor($prof,$asig)
{
    $link = Conectarse();
    $sql="Select * from profesorado where nif='$prof' AND codigo_asignatura='$asig'";
    $resultado=mysql_query($sql,$link);
    if($row= mysql_fetch_array($resultado))
	 return true;
    else
	 return false;
}



$link=Conectarse();


$cod_asig=$_POST['asignatura'];
$responsable=$_POST['responsable'];
$curso=$_POST['curso'];



$indice=$_POST['indice'];
//Coger todos los campos de horas




$ht1casig=$_POST['ht1casig'];
$hl1casig=$_POST['hl1casig'];
$ht2casig=$_POST['ht2casig'];
$hl2casig=$_POST['hl2casig'];
$hej1casig=$_POST['hej1casig'];
$hej2casig=$_POST['hej2casig'];
$ht1casige=$_POST['ht1casige'];
$hl1casige=$_POST['hl1casige'];
$ht2casige=$_POST['ht2casige'];
$hl2casige=$_POST['hl2casige'];
$hej1casige=$_POST['hej1casige'];
$hej2casige=$_POST['hej2casige'];


$sqlasig = "select * from horas_asignatura where curso='$curso' and cod_asig='$cod_asig'";	    
$resulasig=mysql_query($sqlasig,$link);
$rowasig=mysql_fetch_array($resulasig);
$cuenta=count($rowasig);

//if($rowasig = mysql_fetch_array($resulasig))
if ($cuenta>1)
{
    $sqlactualizar="UPDATE horas_asignatura SET ht1c_totales='$ht1casig', hl1c_totales='$hl1casig', ht2c_totales='$ht2casig',hl2c_totales='$hl2casig', hej1c_totales='$hej1casig', hej2c_totales='$hej2casig',ht1ec_totales='$ht1casige', hl1ec_totales='$hl1casige', ht2ec_totales='$ht2casige',hl2ec_totales='$hl2casige', hej1ec_totales='$hej1casige', hej2ec_totales='$hej2casige' WHERE cod_asig='$cod_asig' and curso='$curso'";
    $resulactualizar=mysql_query($sqlactualizar,$link);
echo $sqlactualizar;
}
else
{
    $sqlinsert="INSERT INTO horas_asignatura (cod_asig,curso,ht1c_totales,hl1c_totales,ht2c_totales,hl2c_totales,hej1c_totales,hej2c_totales,ht1ec_totales,hl1ec_totales,ht2ec_totales,hl2ec_totales,hej1ec_totales,hej2ec_totales) VALUES ('$cod_asig','$curso','$ht1casig','$hl1casig','$ht2casig','$hl2casig','$hej1casig','$hej2casig','$ht1casige','$hl1casige','$ht2casige','$hl2casige','$hej1casige','$hej2casige')";
    $resul=mysql_query($sqlinsert,$link);
    $err=mysql_error($link);
    echo $err;
}


//insertar
$profesor1=$_POST['profesor1'];
$ht1cprof1=$_POST['ht1cprof1'];
$hl1cprof1=$_POST['hl1cprof1'];
$ht2cprof1=$_POST['ht2cprof1'];
$hej1cprof1=$_POST['hej1cprof1'];
$hej2cprof1=$_POST['hej2cprof1'];
$hl2cprof1=$_POST['hl2cprof1'];
$ht1cprofe1=$_POST['ht1cprofe1'];
$hl1cprofe1=$_POST['hl1cprofe1'];
$ht2cprofe1=$_POST['ht2cprofe1'];
$hej1cprofe1=$_POST['hej1cprofe1'];
$hej2cprofe1=$_POST['hej2cprofe1'];
$hl2cprofe1=$_POST['hl2cprofe1'];
$profesor2=$_POST['profesor2'];
$ht1cprof2=$_POST['ht1cprof2'];
$hl1cprof2=$_POST['hl1cprof2'];
$ht2cprof2=$_POST['ht2cprof2'];
$hl2cprof2=$_POST['hl2cprof2'];
$hej1cprof2=$_POST['hej1cprof2'];
$hej2cprof2=$_POST['hej2cprof2'];
$ht1cprofe2=$_POST['ht1cprofe2'];
$hl1cprofe2=$_POST['hl1cprofe2'];
$ht2cprofe2=$_POST['ht2cprofe2'];
$hej1cprofe2=$_POST['hej1cprofe2'];
$hej2cprofe2=$_POST['hej2cprofe2'];
$hl2cprofe2=$_POST['hl2cprofe2'];
$profesor3=$_POST['profesor3'];
$ht1cprof3=$_POST['ht1cprof3'];
$hl1cprof3=$_POST['hl1cprof3'];
$ht2cprof3=$_POST['ht2cprof3'];
$hl2cprof3=$_POST['hl2cprof3'];
$hej1cprof3=$_POST['hej1cprof3'];
$hej2cprof3=$_POST['hej2cprof3'];
$ht1cprofe3=$_POST['ht1cprofe3'];
$hl1cprofe3=$_POST['hl1cprofe3'];
$ht2cprofe3=$_POST['ht2cprofe3'];
$hej1cprofe3=$_POST['hej1cprofe3'];
$hej2cprofe3=$_POST['hej2cprofe3'];
$hl2cprofe3=$_POST['hl2cprofe3'];
$profesor4=$_POST['profesor4'];
$ht1cprof4=$_POST['ht1cprof4'];
$hl1cprof4=$_POST['hl1cprof4'];
$ht2cprof4=$_POST['ht2cprof4'];
$hl2cprof4=$_POST['hl2cprof4'];
$hej1cprof4=$_POST['hej1cprof4'];
$hej2cprof4=$_POST['hej2cprof4'];
$ht1cprofe4=$_POST['ht1cprofe4'];
$hl1cprofe4=$_POST['hl1cprofe4'];
$ht2cprofe4=$_POST['ht2cprofe4'];
$hej1cprofe4=$_POST['hej1cprofe4'];
$hej2cprofe4=$_POST['hej2cprofe4'];
$hl2cprofe4=$_POST['hl2cprofe4'];

echo($profesor1);

if(!existeProfesor($responsable,$cod_asig)){// && $profesor1=="nada" && $profesor2=="nada" && $profesor3=="nada" && $profesor4=="nada" ){
        $sqlresponsable="UPDATE profesorado SET coordinador='0' WHERE codigo_asignatura='$cod_asig' AND coordinador='1'";
	$resulreponsable=mysql_query($sqlresponsable,$link);

	  $sql_profesores= "select * from personal where nif='$responsable'";	    
	  $resul_profesores = mysql_query($sql_profesores, $link);
	  $row_profesores=mysql_fetch_array($resul_profesores);
	  $nombre=$row_profesores['nombre'];
	  $apellidos=$row_profesores['apellidos'];

	$sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$responsable','$nombre','$apellidos','1','$cod_asig','1')";
	$resul=mysql_query($sql,$link);
}

if(existeProfesor($responsable,$cod_asig) ){//&& $profesor1=="nada" && $profesor2=="nada" && $profesor3=="nada" && $profesor4=="nada" ){
        $sqlresponsable="UPDATE profesorado SET coordinador='0' WHERE codigo_asignatura='$cod_asig' AND coordinador='1'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
        $sqlresponsable="UPDATE profesorado SET coordinador='1' WHERE codigo_asignatura='$cod_asig' AND nif='$responsable'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
}


if($profesor1!="nada")
{
    $sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$profesor1','$cod_asig','$curso','$ht1cprof1','$hl1cprof1','$ht2cprof1','$hl2cprof1','$hej1cprof1','$hej2cprof1','$ht1cprofe1','$hl1cprofe1','$ht2cprofe1','$hl2cprofe1','$hej1cprofe1','$hej2cprofe1')";
    $resul=mysql_query($sql,$link);
    
        echo $sql;
        echo "<br>\n";

    $sql_profesores= "select * from personal where nif='$profesor1'";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    $row_profesores=mysql_fetch_array($resul_profesores);
    $nombre=$row_profesores['nombre'];
    $apellidos=$row_profesores['apellidos'];

    if($profesor1==$responsable){
	$coordinador=1;
        $sqlresponsable="UPDATE profesorado SET coordinador='0' WHERE codigo_asignatura='$cod_asig' AND coordinador='1'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
        $sqlresponsable="UPDATE profesorado SET coordinador='1' WHERE codigo_asignatura='$cod_asig' AND nif='$responsable'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
    }
    else
	$coordinador=0;

    if(!existeProfesor($profesor1,$cod_asig)){
	$sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$profesor1','$nombre','$apellidos','$coordinador','$cod_asig','1')";
	$resul=mysql_query($sql,$link);

    }
}
	
if($profesor2!="nada")
{
    $sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$profesor2','$cod_asig','$curso','$ht1cprof2','$hl1cprof2','$ht2cprof2','$hl2cprof2','$hej1cprof2','$hej2cprof2','$ht1cprofe2','$hl1cprofe2','$ht2cprofe2','$hl2cprofe2','$hej1cprofe2','$hej2cprofe2')";
    $resul=mysql_query($sql,$link);

    $sql_profesores= "select * from personal where nif='$profesor2'";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    $row_profesores=mysql_fetch_array($resul_profesores);
    $nombre=$row_profesores['nombre'];
    $apellidos=$row_profesores['apellidos'];

    if($profesor2==$responsable){
	$coordinador=1;
        $sqlresponsable="UPDATE profesorado SET coordinador='0' WHERE codigo_asignatura='$cod_asig' AND coordinador='1'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
        $sqlresponsable="UPDATE profesorado SET coordinador='1' WHERE codigo_asignatura='$cod_asig' AND nif='$responsable'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
    }
    else
	$coordinador=0;

    if(!existeProfesor($profesor2,$cod_asig)){
	$sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$profesor2','$nombre','$apellidos','$coordinador','$cod_asig','1')";
	$resul=mysql_query($sql,$link);
    }
}
if($profesor3!="nada")
{
    $sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$profesor3','$cod_asig','$curso','$ht1cprof3','$hl1cprof3','$ht2cprof3','$hl2cprof3','$hej1cprof3','$hej2cprof3','$ht1cprofe3','$hl1cprofe3','$ht2cprofe3','$hl2cprofe3','$hej1cprofe3','$hej2cprofe3')";
    $resul=mysql_query($sql,$link);

    $sql_profesores= "select * from personal where nif='$profesor3'";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    $row_profesores=mysql_fetch_array($resul_profesores);
    $nombre=$row_profesores['nombre'];
    $apellidos=$row_profesores['apellidos'];

    if($profesor3==$responsable){
	$coordinador=1;
        $sqlresponsable="UPDATE profesorado SET coordinador='0' WHERE codigo_asignatura='$cod_asig' AND coordinador='1'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
        $sqlresponsable="UPDATE profesorado SET coordinador='1' WHERE codigo_asignatura='$cod_asig' AND nif='$responsable'";
	$resulreponsable=mysql_query($sqlresponsable,$link);

    }
    else
	$coordinador=0;

    
    if(!existeProfesor($profesor3,$cod_asig)){
	$sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$profesor3','$nombre','$apellidos','$coordinador','$cod_asig','1')";
	$resul=mysql_query($sql,$link);
    }
}
if($profesor4!="nada")
{
    $sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$profesor4','$cod_asig','$curso','$ht1cprof4','$hl1cprof4','$ht2cprof4','$hl2cprof4','$hej1cprof4','$hej2cprof4','$ht1cprofe4','$hl1cprofe4','$ht2cprofe4','$hl2cprofe4','$hej1cprofe4','$hej2cprofe4')";
    $resul=mysql_query($sql,$link);

    $sql_profesores= "select * from personal where nif='$profesor4'";	    
    $resul_profesores = mysql_query($sql_profesores, $link);
    $row_profesores=mysql_fetch_array($resul_profesores);
    $nombre=$row_profesores['nombre'];
    $apellidos=$row_profesores['apellidos'];

    if($profesor4==$responsable){
	$coordinador=1;
        $sqlresponsable="UPDATE profesorado SET coordinador='0' WHERE codigo_asignatura='$cod_asig' AND coordinador='1'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
        $sqlresponsable="UPDATE profesorado SET coordinador='1' WHERE codigo_asignatura='$cod_asig' AND nif='$responsable'";
	$resulreponsable=mysql_query($sqlresponsable,$link);
    }
    else
	$coordinador=0;

    
    if(!existeProfesor($profesor4,$cod_asig)){
	$sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$profesor4','$nombre','$apellidos','$coordinador','$cod_asig','1')";
	$resul=mysql_query($sql,$link);
    }
}		    

$sql_titulacion= "select * from asignaturas where codigo='$cod_asig'";	    
$resul_titulacion = mysql_query($sql_titulacion, $link);
$row2=mysql_fetch_array($resul_titulacion);



for($k=1; $k<$indice ; $k++)
{
    $i1="ht1c".$k;
    $i2="hl1c".$k;
    $i3="ht2c".$k;
    $i4="hl2c".$k;
    $i6="hej1c".$k;
    $i7="hej2c".$k;
    $i5="nif_profesor".$k;
    $i1e="ht1ec".$k;
    $i2e="hl1ec".$k;
    $i3e="ht2ec".$k;
    $i4e="hl2ec".$k;
    $i6e="hej1ec".$k;
    $i7e="hej2ec".$k;

       
    $ht1c=$_POST[$i1];
    $hl1c=$_POST[$i2];
    $ht2c=$_POST[$i3];
    $hl2c=$_POST[$i4];
    $hej1c=$_POST[$i6];
    $hej2c=$_POST[$i7];
    $ht1ec=$_POST[$i1e];
    $hl1ec=$_POST[$i2e];
    $ht2ec=$_POST[$i3e];
    $hl2ec=$_POST[$i4e];
    $hej1ec=$_POST[$i6e];
    $hej2ec=$_POST[$i7e];


    

    $nif=$_POST[$i5];

    $sql_horas= "select * from horas_docencia where curso='$curso' and nif='$nif' and cod_asig='$cod_asig'";	    
    $resul_horas = mysql_query($sql_horas, $link);
    if($row_horas=mysql_fetch_array($resul_horas))
    {
	//actualizamos
	$sqlhoras="UPDATE horas_docencia SET HT1C_totales='$ht1c', HL1C_totales='$hl1c', HT2C_totales='$ht2c', HL2C_totales='$hl2c',HEJ1C_totales='$hej1c',HEJ2C_totales='$hej2c',HT1EC_totales='$ht1ec', HL1EC_totales='$hl1ec', HT2EC_totales='$ht2ec', HL2EC_totales='$hl2ec',HEJ1EC_totales='$hej1ec',HEJ2EC_totales='$hej2ec' where curso='$curso' and nif='$nif' and cod_asig='$cod_asig'";
	$resulhoras=mysql_query($sqlhoras,$link);
echo "<br>\n";
echo $sqlhoras;
    }
    else
    {

//	if($responsable==$profesor1 || $responsable==$profesor2 || $responsable==$profesor3 || $responsable==$profesor4)
	//      {

	    //insertamos
	    $sqlhoras="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$nif','$cod_asig','$curso','$ht1c','$hl1c','$ht2c','$hl2c','$hej1c','hej2c','$ht1ec','$hl1ec','$ht2ec','$hl2ec','$hej1ec','hej2ec')";
	    $resulhoras=mysql_query($sqlhoras,$link);
//	}

    }
}




echo "<br/><br/><br/>";

echo "<div align='center'><font class='fuenteazul'><strong>Se ha guardado con &eacute;xito la asignaci&oacute;n en la asignatura ".$cod_asig." para el curso ".$curso.".</strong></font></div>";

?>


<form name='form1' method='post' action='index.php' enctype='multipart/form-data'>
<table width='100%' height='80' border='0' bordercolor='#FFFFCC'>
<tr>
<td><input type='hidden' name='titulacion' value='<? echo $row2['codigo_titulacion']?>'></td>
</tr>
<tr>
<td><input type='hidden' name='asignatura' value='<? echo $cod_asig?> '></td>
</tr>
<tr>
<td><input  type='hidden' name='valor2' value='<? echo $curso?>'></td>
</tr>
<tr>
<td align='center' colspan='2'><input type='submit' name='Submit' value='VOLVER'></td>
</tr>
</table>
</form>


<?php
abajo();
?>
