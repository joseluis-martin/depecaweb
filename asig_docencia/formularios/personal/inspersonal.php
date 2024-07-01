<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>

<html>
<head>
<title>Docencia Privada</title>
</head>


<BODY>

<?php
$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$iniciales=$_POST['iniciales'];
$puesto=$_POST['puesto'];
$email=$_POST['email'];
$usuario=strtok($email,'@');
$centro=$_POST['centro'];
$departamento=$_POST['departamento'];
$cargo=$_POST['cargo'];


$direccion=$_POST['direccion'];
$domicilio=$_POST['domicilio'];
$telefono_universidad=$_POST['telefono_universidad'];
if($telefono_universidad =="")
{
    $telefono_universidad="6540";
}
$telefono_particular=$_POST['telefono_particular'];
$fax=$_POST['fax'];
if($fax =="")
{
    $fax="+34 918856591";
}
$despacho=$_POST['despacho'];
$nrp=$_POST['nrp'];
$nif=$_POST['nif'];
$codigo_plaza=$_POST['codigo_plaza'];
$numero=$_POST['numero'];

$falta_cuerpo=$_POST['falta_cuerpo'];
$falta_univ=$_POST['falta_univ'];
$sexo=$_POST['sexo'];
$fecha_nacimiento=$_POST['fecha_nacimiento'];


$namefoto = $_FILES['userfile']['name'];
$foto = "/fotos/personal/".$namefoto."";
$uploaddir = '/srv/www/htdocs/depeca/fotos/personal/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile) ) {   
    echo "<div align='center'> \n";
	echo "<h2>Informaci&oacute;n y Foto introducidas</h2> \n";
	echo "<br><br> \n"; 
    echo "</div> \n"; 
    $foto="/fotos/personal/".$namefoto;
 } else {
    
    echo "<div align='center'> \n";
	echo "<h2>Informaci&oacute;n Introducida.<BR> Foto NO Introducida</h2> \n";
	echo "<br><br> \n"; 
	echo "</div> \n"; 
	$foto = "../../../../fotos/personal/default.jpg";
	
 
 print "</pre>";
	
 }

//process form

$link = Conectarse();

$sql = "INSERT INTO personal (nombre, apellidos, iniciales, puesto, email, usuario,centro, departamento, cargo, foto, direccion, domicilio, telefono_universidad, telefono_particular, fax, despacho, nrp, nif,codigo_plaza,falta_cuerpo, falta_univ, sexo, fecha_nacimiento)";

$sql .= "VALUES ('$nombre', '$apellidos', '$iniciales', '$puesto', '$email', '$usuario', '$centro', '$departamento', '$cargo', '$foto', '$direccion', '$domicilio', '$telefono_universidad', '$telefono_particular', '$fax', '$despacho', '$nrp', '$nif', '$codigo_plaza', '$falta_cuerpo', '$falta_univ', '$sexo', '$fecha_nacimiento')";
echo $sql;

$result = mysql_query($sql);


echo "<div align='center'>\n";
   echo " <h3>Informaci&oacute;n A&ntilde;adida</font></h3>\n";
   echo "<br><br> \n";
 echo " <span class='generalbluebold'>&lt;&lt;</span> <a href='../../index.php' class='generalbluebold'>Volver</a> \n";
echo "</div>\n";



?>


</body>
</html>


<?php
abajo();
?>
