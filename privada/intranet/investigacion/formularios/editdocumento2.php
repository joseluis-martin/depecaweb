<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "investigacion", "es", "Investigaci&oacute;n");


$id2=($_GET['id']);
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$tipo=$_POST['tipo'];

$link = Conectarse();
$namedoc = $_FILES['userfile']['name'];
$doc = "/repositorio/intranet/investigacion/$tipo/$namedoc";
$uploaddir = '/srv/www/htdocs/depeca/privada/repositorio/intranet/investigacion/'.$tipo.'/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

//Borramos el archivo antiguo para poder subir el nuevo
$sql="SELECT * FROM documentos_investigacion WHERE id=$id2";
$result = mysql_query($sql, $link);
$row = mysql_fetch_array($result);
if(!empty($namedoc))
{
    unlink("/srv/www/htdocs/depeca/privada/".$row["archivo"]."");
}
//Subimos el nuevo
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    
    echo "<div align='center'> \n";
	echo "<h2>Documento Introducido Correctamente</h2> \n";
    echo "</div> \n"; 
    echo "<br /><br /> \n"; 
    
} else {
    echo "<div align='center'> \n";
    echo "<br><br> \n"; 
    echo "</div> \n"; 
    $result=mysql_query("SELECT * FROM documentos_investigacion WHERE id=$id2");
    $row=mysql_fetch_array($result);
    $doc=$row["archivo"]; 
	
}


$sql = "UPDATE documentos_investigacion  SET nombre='$nombre', descripcion='$descripcion', tipo='$tipo', archivo='$doc' WHERE id=$id2";
$result = mysql_query($sql);


echo "<div align='center'>\n";
   echo " <h3>Documento Actualizado</font></h3>\n";
   echo "<br><br> \n";
 echo " <span class='generalbluebold'>&lt;&lt;</span> <a href='../index.php' class='generalbluebold'>Volver</a> \n";
echo "</div>\n";

?>



<?php
abajo();
?>