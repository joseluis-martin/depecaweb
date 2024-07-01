<?php
require_once("../../core/bibliotecaint.inc.php");
include("../../core/conexion.inc.php");
$comision=$_GET['comision'];
$error=$_GET['error'];
$link=conectarse();
$sql="SELECT * FROM comision WHERE id=$comision";
$result=mysql_query($sql,$link);
$row=mysql_fetch_array($result);
$error=false;
arriba("","comision","es","Comisi&oacute;n De Departamento: ".$row['nombre']."");

$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$fecha=$_POST['fecha'];
$link=Conectarse();
if (empty($nombre)){
    echo "<div align='center'> \n";
    $error=true;
}
else
{
$hora=time();
$namedoc=$hora.$_FILES['userfile']['name'];
$doc="/depeca/privada/repositorio/actas/$namedoc";
$uploaddir='/srv/www/htdocs/depeca/privada/repositorio/actas/';
$uploadfile=$uploaddir.$namedoc;
 if ((move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile) and $error!=1))
{
    echo "<div align='center'> \n";
    echo "<h2>Acta introducida correctamente</h2> \n";
    echo "</div> \n";
    exec("chmod 775 $uploadfile");
    
}
else
 {
  $error=true;
 }
}
 
if($error!=1){
    if(($fecha=='aaaa-mm-dd')|| ($fecha=="")){$fecha=date('Y-m-d');
}

$sql="INSERT INTO acta_comision (nombre,descripcion,enlace,comision,fecha) VALUES ('$nombre','$descripcion','$doc','$comision','$fecha')";
$result=mysql_query($sql,$link);

}
else{
    
    echo"<h3><font color='red'>*Aviso:</font> </h3>"; 
echo"<h3><font color='black'>Revise los campos nombre y Documento.</font></h3>\n";

}
 echo "<div align='center'> <span class='generalbluebold'>&lt;&lt;</span> <a href='index.php' class='generalbluebold'>Volver</a></div> \n";
abajo();
?>