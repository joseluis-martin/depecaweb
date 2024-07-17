<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexi�n con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
?>

<html>
<head>
    <title>Docencia Privada</title>
</head>


<BODY>

<?php

$curso=$_POST['curso'];

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$iniciales=$_POST['iniciales'];
$email=$_POST['email'];
$usuario=strtok($email,'@');
$nif=$_POST['nif'];
$telefono_universidad=$_POST['telefono_universidad'];
if($telefono_universidad =="")
{
    $telefono_universidad="6540";
}
$despacho=$_POST['despacho'];
$cargo=$_POST['cargo'];
$puesto=$_POST['puesto'];

$falta_cuerpo=$_POST['falta_cuerpo'];
$falta_univ=$_POST['falta_univ'];

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

// Verificar si el NIF ya existe en la tabla personal
$sql_check_personal = "SELECT nif FROM personal WHERE nif = '$nif'";
$result_personal = mysql_query($sql_check_personal, $link);
if (mysql_num_rows($result_personal) > 0) {
    echo "Error: El NIF ya existe en la tabla personal.";
    mysql_close($link);
    exit;
}

// Verificar si el NIF ya existe en la tabla cargas_max
$sql_check_cargas_max = "SELECT nif FROM cargas_max WHERE nif = '$nif'";
$result_cargas_max = mysql_query($sql_check_cargas_max, $link);
if (mysql_num_rows($result_cargas_max) > 0) {
    echo "Error: El NIF ya existe en la tabla cargas_max.";
    mysql_close($link);
    exit;
}

$sql = "INSERT INTO personal (nombre, apellidos, iniciales, puesto, email, usuario, cargo, foto, telefono_universidad, despacho,  nif, falta_cuerpo, falta_univ)";
$sql .= "VALUES ('$nombre', '$apellidos', '$iniciales', '$puesto', '$email', '$usuario',  '$cargo', '$foto',  '$telefono_universidad', '$despacho',  '$nif',  '$falta_cuerpo', '$falta_univ')";


//$result = mysql_query($sql);

echo $sql;

// Si hay campos adicionales, insertarlos en la tabla cargas_max
if (isset($_POST['mostrar_campos_adicionales'])) {
    $cargamax = $_POST['cargamax'];
    $cargamax_rect = $_POST['cargamax_rect'];
    $situacion_academica = $_POST['situacion_academica'];
    $unidad_docente = $_POST['unidad_docente'];
    

    //$sql_adicional = "INSERT INTO cargas_max (nif, cargamax, cargamax_rect, situacion_academica, curso, unidad_docente_id) 
    //                    VALUES ('$nif', '$cargamax_total', '$carga_rectorado', '$situacion_academica', '$curso', '$unidad_docente')";

    $sql_adicional = "INSERT INTO cargas_max (nif, cargamax_total, carga_rectorado, situacion_academica, curso) 
                        VALUES ('$nif', '$cargamax', '$cargamax_rect', '$situacion_academica', '$curso')";

    // if (!mysql_query($sql_adicional, $link)) {
    //     echo "Error al insertar los datos adicionales: " . mysql_error($link);
    // }

    echo $sql_adicional;
}



    mysql_close($link);

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
