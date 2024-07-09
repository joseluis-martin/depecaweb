<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexi�n con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");

$link = Conectarse();
$codigo2=($_GET['codigo']);
$abreviatura=($_POST['abreviatura']);
$codigo=($_POST['codigo']);
$nombre=($_POST['nombre']);
$nombre_en=($_POST['nombre_en']);
$titulacion=($_POST['titulacion']);
$contador=($_POST['contador']);
$unidad_docente = $_POST['unidad_docente'];
$semestre=($_POST['semestre']);
$caracter=($_POST['caracter']);
$creditos=($_POST['creditos']);
$nivel=($_POST['nivel']);
$anio=($_POST['anio']);
$cuatrimestre=($_POST['cuatrimestre']);
$estado=($_POST['estado']);

if($caracter=='OBLIGATORIA')
{
    $caracter_en="MANDATORY";
}
else if($caracter=='OPTATIVA'){
     $caracter_en="ELECTIVE";
}
if($caracter=='LIBRE'){
     $caracter_en="FREE";
}
if($caracter=='TRONCAL'){
     $caracter_en="CORE";
}
if($caracter=='TRANSVERSAL'){
     $caracter_en="TRANSVERSAL";
}
if($caracter=='FUNDAMENTAL'){
     $caracter_en="FUNDAMENTAL";
}
if($caracter=='METODOLOGICO'){
     $caracter_en="METHODOLOGY";
}
if($caracter=='AFIN'){
     $caracter_en="RELATED";
}
if($caracter=='TIT'){
     $caracter_en="TIT";
}
if($caracter=='BASICA'){
     $caracter_en="BASIC";
}


$sql="SELECT * FROM asignaturas WHERE codigo='$codigo2'";
$result=mysql_query($sql,$link);
$row=mysql_fetch_array($result);
$asignatura=$row['nombre'];

 $mes_actual=date('m');
 $anio_actual=date('Y');
if($mes_actual>='1' && $mes_actual<=6)
    $curso=($anio_actual-1)."/".$anio_actual;
else
    $curso=$anio_actual."/".($anio_actual+1);$mes_actual=date('m');

$anio_actual=date('Y');
if($mes_actual>='1' && $mes_actual<=6)
    $curso=($anio_actual-1)."/".$anio_actual;
else
    $curso=$anio_actual."/".($anio_actual+1);
//Conexion con la base



//consutar codigo titulacion


for ($i=1;$i<=$contador;$i++)
{

$titulacion=$_POST['titulacion'.$i.''];

$titulacionor=$_POST['titulacionor'.$i.''];

$sqlconsulta="SELECT * FROM carreras WHERE nombre='$titulacion'";

$resultconsulta=mysql_query($sqlconsulta,$link);

$rowconsulta=mysql_fetch_array($resultconsulta);

$codigo_titulacion=$rowconsulta['codigo'];

$sqlconsulta="SELECT * FROM carreras WHERE nombre='$titulacionor'";

$resultconsulta=mysql_query($sqlconsulta,$link);

$rowconsulta=mysql_fetch_array($resultconsulta);

$codigo_titulacionor=$rowconsulta['codigo'];



//Ejecuci�n de la sentencia sql;

$sql = "UPDATE asignaturas SET abreviatura='$abreviatura', codigo='$codigo', nombre='$nombre', nombre_en='$nombre_en', codigo_titulacion='$codigo_titulacion', unidad_docente = '$unidad_docente',semestre='$semestre', caracter='$caracter', caracter_en='$caracter_en',creditos='$creditos', nivel='$nivel', anio='$anio', titulacion='$titulacion', cuatrimestre='$cuatrimestre', curso_academico='$curso', estado='$estado' WHERE codigo='$codigo2' AND codigo_titulacion='$codigo_titulacionor' ";
 $result=mysql_query($sql);

// $sql = "UPDATE horas_asignatura2 SET carrera='titulacion' WHERE carrera='titulacionor' AND asignatura='asignatura'";
//$result = mysql_query($sql);

}
//mysql_close ();

$sqlprof="UPDATE profesorado SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlprof);

$sqlasig="UPDATE horas_asignatura SET cod_asig='$codigo' WHERE cod_asig='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE horas_docencia SET cod_asig='$codigo' WHERE cod_asig='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE novedades_asignatura SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE novedades_asignaturae SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE profesorado_horario SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE pagina_asignatura SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE pagina_asignaturae SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE documentos_pagina_asignatura SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

$sqlasig="UPDATE documentos_pagina_asignaturae SET codigo_asignatura='$codigo' WHERE codigo_asignatura='$codigo2'";
$result = mysql_query($sqlasig);

echo "<div align='center'>\n";
   echo " <h3>Asignatura Editada</font></h3>\n";
   echo "<br><br> \n";
 echo " <span class='generalbluebold'>&lt;&lt;</span> <a href='../../index.php' class='generalbluebold'>Volver</a> \n";
echo "</div>\n";
//}

?>

<?php
abajo();
?>