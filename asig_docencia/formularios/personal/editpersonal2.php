<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
$link=Conectarse();
?>

<html>
<head>
<title>Editar Personal- Web Depeca</title>
<LINK  REL="stylesheet" TYPE="text/css" HREF="../../../public-en/Estilos.css">
</head>
<body>
<?

$id2=($_GET['id']);

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$iniciales=$_POST['iniciales'];
$puesto=$_POST['puesto'];
$email=$_POST['email'];
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
$dedicacion=$_POST['dedicacion'];
$falta_cuerpo=$_POST['falta_cuerpo'];
$falta_univ=$_POST['falta_univ'];
$sexo=$_POST['sexo'];
$fecha_nacimiento=$_POST['fecha_nacimiento'];

$namefoto = $_FILES['userfile']['name'];
if ($namefoto!="")
{
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
$sql = "UPDATE personal SET nombre='$nombre', apellidos='$apellidos', iniciales='$iniciales', puesto='$puesto', email='$email', centro='$centro', departamento='$departamento', cargo='$cargo', foto='$foto', direccion='$direccion', domicilio='$domicilio', telefono_universidad='$telefono_universidad', telefono_particular='$telefono_particular', fax='$fax', despacho='$despacho', dedicacion='$dedicacion', nrp='$nrp', nif='$nif', codigo_plaza='$codigo_plaza', numero='$numero', falta_cuerpo='$falta_cuerpo', falta_univ='$falta_univ', sexo='$sexo', fecha_nacimiento='$fecha_nacimiento' WHERE id='$id2'";
$result = mysql_query($sql,$link);
}
else
{
$sql = "UPDATE personal SET nombre='$nombre', apellidos='$apellidos', iniciales='$iniciales', puesto='$puesto', email='$email', centro='$centro', departamento='$departamento', cargo='$cargo', direccion='$direccion', domicilio='$domicilio', telefono_universidad='$telefono_universidad', telefono_particular='$telefono_particular', fax='$fax', despacho='$despacho', dedicacion='$dedicacion', nrp='$nrp', nif='$nif', codigo_plaza='$codigo_plaza', numero='$numero', falta_cuerpo='$falta_cuerpo', falta_univ='$falta_univ', sexo='$sexo', fecha_nacimiento='$fecha_nacimiento' WHERE id='$id2'";
$result = mysql_query($sql,$link);
}

//ACTUALIZAMOS FOTO  
/*$namefoto = $_FILES['userfile1']['name'];
$foto="/fotos/personal/$namefoto";
$uploaddir1 = '/srv/www/htdocs/depeca/fotos/personal/';
$uploadfile1 = $uploaddir1 . basename($_FILES['userfile1']['name']);
$link = Conectarse();
$sql="SELECT * FROM personal WHERE id=$id2";
$result = mysql_query($sql, $link);
$row = mysql_fetch_array($result);

echo $uploadfile1;
echo $foto;

//Subimos el nuevo
if (move_uploaded_file($_FILES['userfile1']['tmp_name'], $uploadfile1)) {
    
    echo "<div align='center'> \n";
	echo "<h2>Foto Introducida Correctamente</h2> \n";
    echo "</div> \n"; 
    echo "<br /><br /> \n";  
    unlink("/srv/www/htdocs/depeca".$row["foto"].""); 
    $foto="/fotos/personal/".$namefoto;
    
} else {
    echo "<div align='center'> \n";
    echo "<br><br> \n"; 
    echo "</div> \n"; 
    echo "Foto no actualizada \n";
    $result=mysql_query("SELECT * FROM personal WHERE id=$id2");
    $row=mysql_fetch_array($result);
    $foto = $row["foto"];	 
	
}*/

/*$namefoto = $_FILES['userfile']['name'];
$foto = "/fotos/personal/".$namefoto."";
$uploaddir = '/srv/www/htdocs/depeca/fotos/personal/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo $namefoto;
echo $uploadfile;
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
	$namefoto = "/default.jpg";
	
 
 print "</pre>";
	
 }*/

/*$namefoto = $_FILES['userfile']['name'];
echo $namefoto;
$foto = "/fotos/personal/".$namefoto."";
//echo $namefoto;
$uploaddir = '/srv/www/htdocs/depeca/fotos/personal/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//echo $uploadfile;
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile) ) {   
    echo "<div align='center'> \n";
	echo "<h2>Informaci&oacute;n y Foto introducidas</h2> \n";
	echo "<br><br> \n"; 
    echo "</div> \n"; 
    $foto="/fotos/personal/".$namefoto;
 } else {
    
    echo $_FILES['userfile']['error'];
switch ($_FILES['userfile'] ['error'])
 {  case 1:
           print '<p> The file is bigger than this PHP installation allows</p>';
           break;
    case 2:
           print '<p> The file is bigger than this form allows</p>';
           break;
    case 3:
           print '<p> Only part of the file was uploaded</p>';
           break;
    case 4:
           print '<p> No file was uploaded</p>';
           break;
 }
    echo "<div align='center'> \n";
	echo "<h2>Informaci&oacute;n Introducida.<BR> Foto NO Introducida</h2> \n";
	echo "<br><br> \n"; 
	echo "</div> \n"; 
	$foto = "/fotos/personal/default.jpg";
 
 print "</pre>";
	
 }*/

//echo $namefoto;

//$foto="/fotos/personal/".$namefoto;



		
?>
<h1><div align="center"><font color="#0066CC">Registro Modificado</font></div></h1>
<br><br>
<div align="center"><span class="generalbluebold"><<</span> <a href="../../index.php"><span class="generalbluebold">Volver</span></a></div>
</body>
</html>

<?php
abajo();
?>
