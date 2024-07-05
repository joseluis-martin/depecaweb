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


//Datos de profesor
$id2=($_POST['id']);

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$iniciales=$_POST['iniciales'];
$email=$_POST['email'];
$cargo=$_POST['cargo'];
$situacion_academica=$_POST['situacion_academica'];

$domicilio=$_POST['domicilio'];
$telefono_universidad=$_POST['telefono_universidad'];
if($telefono_universidad =="")
{
    $telefono_universidad="6540";
}
$telefono_particular=$_POST['telefono_particular'];
$despacho=$_POST['despacho'];
$falta_cuerpo=$_POST['falta_cuerpo'];
$falta_univ=$_POST['falta_univ'];



$cod_prof=$_POST['nif'];
$curso=$_POST['curso'];


$indice=$_POST['indice'];
//Coger todos los campos de horas


//insertar
$asig1=$_POST['asig1'];
$ht1cprof1=$_POST['ht1cprof1'];
$hl1cprof1=$_POST['hl1cprof1'];
$ht2cprof1=$_POST['ht2cprof1'];
$hl2cprof1=$_POST['hl2cprof1'];
$hej1cprof1=$_POST['hej1cprof1'];
$hej2cprof1=$_POST['hej2cprof1'];
$ht1cprof1e=$_POST['ht1cprofe1'];
$hl1cprof1e=$_POST['hl1cprofe1'];
$ht2cprof1e=$_POST['ht2cprofe1'];
$hl2cprof1e=$_POST['hl2cprofe1'];
$hej1cprof1e=$_POST['hej1cprofe1'];
$hej2cprof1e=$_POST['hej2cprofe1'];
$asig2=$_POST['asig2'];
$ht1cprof2=$_POST['ht1cprof2'];
$hl1cprof2=$_POST['hl1cprof2'];
$ht2cprof2=$_POST['ht2cprof2'];
$hl2cprof2=$_POST['hl2cprof2'];
$hej1cprof2=$_POST['hej1cprof2'];
$hej2cprof2=$_POST['hej2cprof2'];
$ht1cprof2e=$_POST['ht1cprofe2'];
$hl1cprof2e=$_POST['hl1cprofe2'];
$ht2cprof2e=$_POST['ht2cprofe2'];
$hl2cprof2e=$_POST['hl2cprofe2'];
$hej1cprof2e=$_POST['hej1cprofe2'];
$hej2cprof2e=$_POST['hej2cprofe2'];
$asig3=$_POST['asig3'];
$ht1cprof3=$_POST['ht1cprof3'];
$hl1cprof3=$_POST['hl1cprof3'];
$ht2cprof3=$_POST['ht2cprof3'];
$hl2cprof3=$_POST['hl2cprof3'];
$hej1cprof3=$_POST['hej1cprof3'];
$hej2cprof3=$_POST['hej2cprof3'];
$ht1cprof3e=$_POST['ht1cprofe3'];
$hl1cprof3e=$_POST['hl1cprofe3'];
$ht2cprof3e=$_POST['ht2cprofe3'];
$hl2cprof3e=$_POST['hl2cprofe3'];
$hej1cprof3e=$_POST['hej1cprofe3'];
$hej2cprof3e=$_POST['hej2cprofe3'];
$asig4=$_POST['asig4'];
$ht1cprof4=$_POST['ht1cprof4'];
$hl1cprof4=$_POST['hl1cprof4'];
$ht2cprof4=$_POST['ht2cprof4'];
$hl2cprof4=$_POST['hl2cprof4'];
$hej1cprof4=$_POST['hej1cprof4'];
$hej2cprof4=$_POST['hej2cprof4'];
$ht1cprof4e=$_POST['ht1cprofe4'];
$hl1cprof4e=$_POST['hl1cprofe4'];
$ht2cprof4e=$_POST['ht2cprofe4'];
$hl2cprof4e=$_POST['hl2cprofe4'];
$hej1cprof4e=$_POST['hej1cprofe4'];
$hej2cprof4e=$_POST['hej2cprofe4'];
$cargamax=$_POST['cargamax'];

/* Modificación incluida por jlmartin para gestionar las horas bajo umbral 
y carga del rectorado 2/10/2018 */

 $cargarectorado=$_POST['cargarectorado'];
// $horasbajoumbral=$_POST['horasbajoumbral'];
// $horasbajoumbralmax=$_POST['horasbajoumbralmax'];

/* Fin de la modificación incluida por jlmartin para gestionar las horas bajo umbral 
y carga del rectorado 2/10/2018 */

$sql_carga="select * from cargas_max where nif='$cod_prof' and curso='$curso'";
$resul_carga = mysql_query($sql_carga, $link);
if($cargamax>0)
{
    if($row_carga=mysql_fetch_array($resul_carga))
    {
	//actualizamos
	$sqlcarga="UPDATE cargas_max SET cargamax_total='$cargamax',carga_rectorado='$cargarectorado', situacion_academica='$situacion_academica' where curso='$curso' and nif='$cod_prof'";
	$resulcarga=mysql_query($sqlcarga,$link);
    }
	
/* Fin de la modificación incluida por jlmartin para gestionar las horas bajo umbral 2/10/2018 */	
	
    else
    {
	//insertamos
	$sqlcarga="INSERT INTO cargas_max (nif,cargamax_total,curso,situacion_academica) VALUES ('$cod_prof','$cargamax','$curso','$situacion_academica')";
	$resulcarga=mysql_query($sqlcarga,$link);    
    }
}
else
{
   echo "<br><br>";
   echo "<div align='center'><font class='fuenteazul'><strong>No se ha insertado carga m&aacute;xima para este profesor. Por tanto, la carga real ser&aacute; 0.</strong></font></div>";
    echo "";
}




$sql_profesores= "select * from personal where nif='$cod_prof'";	    
$resul_profesores = mysql_query($sql_profesores, $link);
$row_profesores=mysql_fetch_array($resul_profesores);
$nombre=$row_profesores['nombre'];
$apellidos=$row_profesores['apellidos'];

if($asig1!="nada")
{
    $sql_horas= "select * from horas_docencia where curso='$curso' and nif='$cod_prof' and cod_asig='$asig1'";	    
    $resul_horas = mysql_query($sql_horas, $link);
    if($row_horas=mysql_fetch_array($resul_horas)){
	echo "<div align='center'><font class='fuenteazul'><strong>El profesor ".$nombre." ".$apellidos." tiene asignada la asignatura ".$asig1." para el curso ".$curso.".</strong></font></div>";

    }else{
	$sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$cod_prof','$asig1','$curso','$ht1cprof1','$hl1cprof1','$ht2cprof1','$hl2cprof1','$hej1cprof1','$hej2cprof1','$ht1cprof1e','$hl1cprof1e','$ht2cprof1e','$hl2cprof1e','$hej1cprof1e','$hej2cprof1e')";
	$resul=mysql_query($sql,$link);


	if(!existeProfesor($cod_prof,$asig1)){
	    $sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$cod_prof','$nombre','$apellidos','0','$asig1','1')";
	    $resul=mysql_query($sql,$link);
	}
    }
}
	
if($asig2!="nada")
{
    $sql_horas= "select * from horas_docencia where curso='$curso' and nif='$cod_prof' and cod_asig='$asig2'";	    
    $resul_horas = mysql_query($sql_horas, $link);
    if($row_horas=mysql_fetch_array($resul_horas)){
	echo "<div align='center'><font class='fuenteazul'><strong>El profesor ".$nombre." ".$apellidos." tiene asignada la asignatura ".$asig2." para el curso ".$curso.".</strong></font></div>";
    }else{
	$sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$cod_prof','$asig2','$curso','$ht1cprof2','$hl1cprof2','$ht2cprof2','$hl2cprof2','$hej1cprof2','$hej2cprof2','$ht1cprof2e','$hl1cprof2e','$ht2cprof2e','$hl2cprof2e','$hej1cprof2e','$hej2cprof2e')";
	$resul=mysql_query($sql,$link);

	if(!existeProfesor($cod_prof,$asig2)){
	    $sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$cod_prof','$nombre','$apellidos','0','$asig2','1')";
	    $resul=mysql_query($sql,$link);
	}
    }
}
if($asig3!="nada")
{
    $sql_horas= "select * from horas_docencia where curso='$curso' and nif='$cod_prof' and cod_asig='$asig3'";	    
    $resul_horas = mysql_query($sql_horas, $link);
    if($row_horas=mysql_fetch_array($resul_horas)){
	echo "<div align='center'><font class='fuenteazul'><strong>El profesor ".$nombre." ".$apellidos." tiene asignada la asignatura ".$asig3." para el curso ".$curso.".</strong></font></div>";

    }else{
    
	$sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$cod_prof','$asig3','$curso','$ht1cprof3','$hl1cprof3','$ht2cprof3','$hl2cprof3','$hej1cprof3','$hej2cprof3','$ht1cprof3e','$hl1cprof3e','$ht2cprof3e','$hl2cprof3e','$hej1cprof3e','$hej2cprof3e')";
	$resul=mysql_query($sql,$link);
    
	if(!existeProfesor($cod_prof,$asig3)){
	    $sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$cod_prof','$nombre','$apellidos','0','$asig3','1')";
	    $resul=mysql_query($sql,$link);
	}
    }
}
if($asig4!="nada")
{
    $sql_horas= "select * from horas_docencia where curso='$curso' and nif='$cod_prof' and cod_asig='$asig4'";	    
    $resul_horas = mysql_query($sql_horas, $link);
    if($row_horas=mysql_fetch_array($resul_horas)){
	echo "<div align='center'><font class='fuenteazul'><strong>El profesor ".$nombre." ".$apellidos." tiene asignada la asignatura ".$asig4." para el curso ".$curso.".</strong></font></div>";

    }else{
	$sql="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$cod_prof','$asig4','$curso','$ht1cprof4','$hl1cprof4','$ht2cprof4','$hl2cprof4','$hej1cprof4','$hej2cprof4','$ht1cprof4e','$hl1cprof4e','$ht2cprof4e','$hl2cprof4e','$hej1cprof4e','$hej2cprof4e')";
	$resul=mysql_query($sql,$link);

   
	if(!existeProfesor($cod_prof,$asig4)){
	    $sql="INSERT INTO profesorado (nif,nombre,apellidos,coordinador,codigo_asignatura,grupos) VALUES ('$cod_prof','$nombre','$apellidos','0','$asig4','1')";
	    $resul=mysql_query($sql,$link);
	}
    }
}		    


for($k=0; $k<$indice ; $k++)
{
    if ($k==0)
    {
$ht1c=$_POST["ht1c0"];
    $hl1c=$_POST["hl1c0"];
    $ht2c=$_POST["ht2c0"];
    $hl2c=$_POST["hl2c0"];
    $hej1c=$_POST["hej1c0"];
    $hej2c=$_POST["hej2c0"];
$ht1ec=$_POST["ht1ec0"];
    $hl1ec=$_POST["hl1ec0"];
    $ht2ec=$_POST["ht2ec0"];
    $hl2ec=$_POST["hl2ec0"];
    $hej1ec=$_POST["hej1ec0"];
    $hej2ec=$_POST["hej2ec0"];
    $cod_asig=$_POST["cod_asig0"];
    }
    else
    {
    $i1="ht1c".$k;
    $i2="hl1c".$k;
    $i3="ht2c".$k;
    $i4="hl2c".$k;
    $i6="hej1c".$k;
    $i7="hej2c".$k;
    $i1e="ht1ec".$k;
    $i2e="hl1ec".$k;
    $i3e="ht2ec".$k;
    $i4e="hl2ec".$k;
    $i6e="hej1ec".$k;
    $i7e="hej2ec".$k;
    $i5="cod_asig".$k;
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
    $cod_asig=$_POST[$i5];
    }
  
    $sql_horas= "select * from horas_docencia where curso='$curso' and nif='$cod_prof' and cod_asig='$cod_asig'";	    
    $resul_horas = mysql_query($sql_horas, $link);
    if($row_horas=mysql_fetch_array($resul_horas))
    {
	//actualizamos
	$sqlhoras="UPDATE horas_docencia SET HT1C_totales='$ht1c', HL1C_totales='$hl1c', HT2C_totales='$ht2c', HL2C_totales='$hl2c', HEJ1C_totales='$hej1c', HEJ2C_totales='$hej2c',HT1EC_totales='$ht1ec', HL1EC_totales='$hl1ec', HT2EC_totales='$ht2ec', HL2EC_totales='$hl2ec', HEJ1EC_totales='$hej1ec', HEJ2EC_totales='$hej2ec' where curso='$curso' and nif='$cod_prof' and cod_asig='$cod_asig'";
	$resulhoras=mysql_query($sqlhoras,$link);
    }
    else
    {
	//insertamos
	 $sqlhoras="INSERT INTO horas_docencia (nif,cod_asig,curso,HT1C_totales,HL1C_totales,HT2C_totales,HL2C_totales,HEJ1C_totales,HEJ2C_totales,HT1EC_totales,HL1EC_totales,HT2EC_totales,HL2EC_totales,HEJ1EC_totales,HEJ2EC_totales) VALUES ('$cod_prof','$cod_asig','$curso','$ht1c','$hl1c','$ht2c','$hl2c','$hej1c','$hej2c','$ht1ec','$hl1ec','$ht2ec','$hl2ec','$hej1ec','$hej2ec')";
	 $resulhoras=mysql_query($sqlhoras,$link);

    }

    //echo $sqlhoras;
}



//$sql_personal = "UPDATE personal SET nombre='$nombre', apellidos='$apellidos', iniciales='$iniciales',email='$email', cargo='$cargo', situacion_academica='$situacion_academica', domicilio='$domicilio', telefono_universidad='$telefono_universidad', telefono_particular='$telefono_particular', despacho='$despacho', falta_cuerpo='$falta_cuerpo', falta_univ='$falta_univ'  WHERE id='$id2'";
//$result = mysql_query($sql_personal,$link);


echo "<br/><br/><br/>";

echo "<div align='center'><font class='fuenteazul'><strong>Se ha guardado con &eacute;xito la asignaci&oacute;n para el profesor ".$nombre." ".$apellidos." para el curso ".$curso.".</strong></font></div>";

?>


<form name='form1' method='post' action='index.php' enctype='multipart/form-data'>
<table width='100%' height='80' border='0' bordercolor='#FFFFCC'>
<tr>
<td><input type='hidden' name='profesor' value='<? echo $cod_prof?> '></td>
<td><input type='hidden' name='curso' value='<? echo $curso?> '></td>
</tr>
<tr>
<td align='center' colspan='2'><input type='submit' name='Submit' value='VOLVER'></td>
</tr>
</table>
</form>


<?php
abajo();
?>
