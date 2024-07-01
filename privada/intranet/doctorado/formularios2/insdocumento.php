<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "investigacion", "es", "Investigaci&oacute;n");

$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$tipo=$_POST['tipo'];


if(empty($nombre)){   
    
    echo "<div align='center'> \n";
	echo "<h2>No ha introducido un nombre para el documento</h2> \n";
    echo "</div> \n"; 
    echo "<br /><br /> \n";

   
    echo " <div align='center'><span class='generalbluebold'>&lt;&lt;</span> <a href='adddocumento.php' class='generalbluebold'>Volver</a></div> \n";
 
    
}else{
    


//process form

$link = Conectarse();


$namedoc = $_FILES['userfile']['name'];

 if (!empty($namedoc)){



     $doc = "/repositorio/intranet/investigacion/$tipo/$namedoc";
     $uploaddir = '/srv/www/htdocs/depeca/privada/repositorio/intranet/investigacion/'.$tipo.'/';
     $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);


     if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    
	 echo "<div align='center'> \n";
	 echo "<h2>Documento Introducido Correctamente</h2> \n";
	 echo "</div> \n"; 
	 echo "<br /><br /> \n"; 
    
     } else {
	 echo "<div align='center'> \n";
	 echo "<h2>Error al Introducir el Documento</h2> \n";  
	 echo "</div> \n"; 
	 echo "<br /><br /> \n"; 
	
     }

     $sql = "INSERT INTO documentos_investigacion (nombre, descripcion, tipo, archivo)";
     $sql .= "VALUES ('$nombre', '$descripcion', '$tipo', '$doc')";
     $result = mysql_query($sql);

}else {

     echo "<div align='center'> \n";
     echo "<h2>No ha introducido ning&uacute;n documento.</h2> \n";  
     echo "</div> \n"; 
     echo "<br /><br /> \n";

     

     $sql = "INSERT INTO documentos_investigacion (nombre, descripcion, tipo)";

     $sql .= "VALUES ('$nombre', '$descripcion', '$tipo')";

     $result = mysql_query($sql);
 }

echo "<br /><br />\n";

 
 echo "<div align='center'> <span class='generalbluebold'>&lt;&lt;</span> <a href='../../investigacion/index.php' class='generalbluebold'>Volver</a></div> \n";


}
abajo();
?>
