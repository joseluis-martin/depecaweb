<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "doctorado", "es", "Doctorado");

$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$tipo="doctorado";


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
echo "<br>". $namedoc." \n";

     $doc = "/repositorio/intranet/doctorado/$namedoc";

echo "<br>". $doc." \n";
     $uploaddir = '/srv/www/htdocs/depeca/privada/repositorio/intranet/doctorado/';
     $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

     echo "<br>". $uploadfile." \n";
     echo $_FILES['userfile']['tmp_name'];
     
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

     $sql = "INSERT INTO documentos_doctorado (nombre, descripcion, tipo, archivo)";
     $sql .= "VALUES ('$nombre', '$descripcion', '$tipo', '$doc')";
     $result = mysql_query($sql);

}else {

     echo "<div align='center'> \n";
     echo "<h2>No ha introducido ning&uacute;n documento.</h2> \n";  
     echo "</div> \n"; 
     echo "<br /><br /> \n";

     
     $sql = "INSERT INTO documentos_doctorado (nombre, descripcion, tipo)";

     $sql .= "VALUES ('$nombre', '$descripcion', '$tipo')";

     $result = mysql_query($sql);
}
     echo "<br /><br />\n";

 
 echo "<div align='center'> <span class='generalbluebold'>&lt;&lt;</span> <a href='../index.php' class='generalbluebold'>Volver</a></div> \n";


}
abajo();
?>
