<?php
//require_once("../../../../core/bibliotecap.inc.php");
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexi�n con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");


$abreviatura=($_POST['abreviatura']);
$nombre=($_POST['nombre']);
$nombre_en=($_POST['nombre_en']);
$codigo=($_POST['codigo']);
$titulacion=($_POST['titulacion']);
$semestre=($_POST['semestre']);
$nivel=($_POST['nivel']);
$anio=($_POST['anio']);
$unidad_docente=($_POST['unidad_docente']);
$creditos=($_POST['creditos']);
$cuatrimestre=($_POST['cuatrimestre']);
$caracter=($_POST['caracter']);


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
if($caracter=='COMPLEMENTO'){
     $caracter_en="COMPLEMENT";
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
$link=Conectarse();
$mes_actual=date('m');
$anio_actual=date('Y');
if($mes_actual>='1' && $mes_actual<=6)
   $curso_academico=($anio_actual-1)."/".$anio_actual;
else
   $curso_academico=$anio_actual."/".($anio_actual+1);


$es_clon=($_POST['es_clon']);
$clon_padre=($_POST['clon_padre']);
$erro='0';
//process form
if ($abreviatura=="")
{
    $erro='1';
    $error=$error."No ha introducido abreviatura <br>";
}
if ($nombre=="")
{
    $erro='1';
    $error=$error."No ha introducido nombre de asignatura <br>";
}
if ($codigo=="")
{
    $erro='1';
    $error=$error."No ha introducido c&oacute;digo de asignatura <br>";
}
if ($codigo!="")
{
$sql = "SELECT codigo FROM asignaturas WHERE codigo='$codigo'";
 $resul=mysql_query($sql,$link);
 $row=mysql_fetch_array($resul);
 //echo count($row);
 if (count($row)!='1')
 {
    $erro='1';
    $error=$error."El codigo de asignatura introducido ya existe <br>";
 }
}
if ($titulacion==".")
{
    $erro='1';
    $error=$error."No ha introducido titulaci&oacute;n de la asignatura <br>";
}
if ($unidad_docente==".")
{
    $erro='1';
    $error=$error."No ha introducido la unidad docente de la asignatura <br>";
}
if ($semestre=="")
{
    $erro='1';
    $error=$error."No ha introducido semestre de asignatura <br>";
}
if ($semestre!="")
{
    if (is_numeric($semestre)=='0')
    {
    $erro='1';
    $error=$error."Semestre introducido incorrecto <br>";
    }

}
if ($anio=="")
{
    $erro='1';
    $error=$error."No ha introducido a�o de la asignatura <br>";
}
if ($creditos=="")
{
    $erro='1';
    $error=$error."No ha introducido creditos de la asignatura <br>";
}
if ($creditos!="")
{
   if (is_numeric($semestre)=='0')
    {
    $erro='1';
    $error=$error."No ha introducido n&uacute;mero de creditos validos para la asignatura <br>";
    }

}

if ($erro=='0')
{

$link = Conectarse();

$sqlconsulta="SELECT * FROM carreras WHERE nombre='$titulacion'";

$resultconsulta=mysql_query($sqlconsulta,$link);

$rowconsulta=mysql_fetch_array($resultconsulta);

$codigo_titulacion=$rowconsulta['codigo'];

$sql = "INSERT INTO asignaturas (abreviatura, codigo, nombre, nombre_en, codigo_titulacion, semestre, nivel, anio, titulacion, unidad_docente, creditos, cuatrimestre, caracter, caracter_en,curso_academico,cod_dpto)";

$sql .= " VALUES ('$abreviatura', '$codigo', '$nombre', '$nombre_en', '$codigo_titulacion', '$semestre', '$nivel', '$anio', '$titulacion', '$unidad_docente', '$creditos', '$cuatrimestre', '$caracter','$caracter_en', '$curso_academico','$codigo_titulacion$codigo')";
    
//echo($sql);    

$resultado=mysql_query($sql, $link);


if($es_clon=="No"){ //No es clon

// mkdir("/srv/www/htdocs/depeca/repositorio/asignaturas/$codigo",0777);
// system("chmod 777 /srv/www/htdocs/depeca/repositorio/asignaturas/$codigo");
// mkdir("/srv/www/htdocs/depeca/repositorio/documentos_profesores/$codigo",0777);
// system("chmod 777 /srv/www/htdocs/depeca/repositorio/documentos_profesores/$codigo");
}else{ //Es clon

    $sql = "select * from clones where codigo=$clon_padre";

    $resultado=mysql_query($sql,$link);

    if ($row = mysql_fetch_array($resultado)){ //Ya ten�a algun clon

	insertarClon($codigo,$row["codigo_clon"]);

    }else{ //Es el primer clon



	$sql = "select MAX(codigo_clon) as maximo from clones";

	$resultado = mysql_query($sql,$link);

        if ($row=mysql_fetch_array($resultado)){

	    $codigo_clon=$row["maximo"]+1;

	}

	cambiarCodigo($clon_padre,$codigo_clon,"enlaces_pagina_web");

	cambiarCodigo($clon_padre,$codigo_clon,"pagina_asignatura");

	cambiarCodigo($clon_padre,$codigo_clon,"novedades_asignatura");

	cambiarCodigo($clon_padre,$codigo_clon,"documentos_pagina_asignatura");



	insertarClon($codigo,$codigo_clon);
	
	insertarClon($clon_padre,$codigo_clon);


	system("mv /srv/www/htdocs/depeca/repositorio/asignaturas/$clon_padre /srv/www/htdocs/depeca/repositorio/asignaturas/$codigo_clon");
	system("chmod 777 /srv/www/htdocs/depeca/repositorio/asignaturas/$codigo_clon");
	

	$sql2="select * from seguridad_docencia where codigo_asignatura=$clon_padre";
	
	$resultado2 = mysql_query($sql2,$link);

        if ($row=mysql_fetch_array($resultado2)){

	    if(generarHtaccessHtpasswd($codigo_clon,$row["usuario"],$row["password"]) == 0){ 

		$sql3 = "UPDATE seguridad_docencia set codigo_asignatura=".$codigo_clon." where codigo_asignatura=".$clon_padre.";";

		$result3 = mysql_query($sql3,$link);

	    }

	}

	$sql5 = "SELECT * FROM documentos_pagina_asignatura WHERE codigo_asignatura=".$codigo_clon.";";
	$result5 = mysql_query($sql5, $link);

	while ($row = mysql_fetch_array($result5)){
	    $ruta=$row["archivo"];
	    $trozos = explode("/", $ruta);
	    $ruta2="/srv/www/htdocs/depeca/repositorio/asignaturas/".$codigo_clon."/".$trozos[4];
	    $sql4="UPDATE documentos_pagina_asignatura SET archivo='$ruta2' WHERE archivo='$ruta';";
	    $result4=mysql_query($sql4,$link);
	}

	$sql6 = "SELECT * FROM novedades_asignatura WHERE codigo_asignatura=".$codigo_clon.";";
	$result6 = mysql_query($sql6, $link);

	while ($row = mysql_fetch_array($result6)){
	    if($row["archivo"]!=""){
		$ruta=$row["archivo"];
		$trozos = explode("/", $ruta);
		$ruta2="/srv/www/htdocs/depeca/repositorio/asignaturas/".$codigo_clon."/".$trozos[4];
		$sql7="UPDATE novedades_asignatura SET archivo='$ruta2' WHERE archivo='$ruta';";
		$result7=mysql_query($sql7,$link);
	    }
	}

    }

}



echo "<div align='center'>\n";
   echo " <h3>Asignatura A&ntilde;adida</font></h3>\n";
   echo "<br><br> \n";
 echo " <span class='generalbluebold'>&lt;&lt;</span> <a href='../../index.php' class='generalbluebold'>Volver</a> \n";
}
else
{
echo "<form name='formpersonal' method='post' enctype='multipart/form-data' action='./addasignatura.php'>";

//echo"<hidden name='numero' value='".$numero."'>";
echo"<input name='abreviatura' type='hidden' value='".$abreviatura."'>";
echo"<input name='nombre' type='hidden' value='".$nombre."'>";
echo"<input name='nombre_en' type='hidden' value='".$nombre_en."'>";
echo"<input name='codigo' type='hidden' value='".$codigo."'>";
echo"<input name='titulacion' type='hidden' value='".$titulacion."'>";
echo"<input name='unidad_docente' type='hidden' value='".$unidad_docente."'>";
echo"<input name='semestre' type='hidden' value='".$semestre."'>";
echo"<input name='nivel' type='hidden' value='".$nivel."'>";
echo"<input name='anio' type='hidden' value='".$anio."'>";
echo"<input name='creditos' type='hidden' value='".$creditos."'>";
echo"<input name='cuatrimestre' type='hidden' value='".$cuatrimestre."'>";
echo"<input name='caracter' type='hidden' value='".$caracter."'>";
echo"<input name='es_clon' type='hidden' value='".$es_clon."'>";
echo"<input name='clon_padre' type='hidden' value='".$clon_padre."'>";
echo "<div align='center'>\n";
 echo $error; 
//   echo " <h3>Asignatura no a&ntilde;adida por no rellenar todos los datos en el formulario, revise los datos y vuelva a introducirla.</font></h3>\n";
   echo "<br><br> \n";
   echo" <input type='submit' name='Submit' value='Volver'> \n";
   echo "</form>";
}

echo "</div>\n";




?>


<?php
abajo();
?>
