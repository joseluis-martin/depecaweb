<?php
require_once("../../../../core/bibliotecaint.inc.php");
include("../../../../core/conexion.inc.php"); //Conexion con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");


$codigo2=($_GET['codigo']);



//Conexion con la base

$link=Conectarse();


//Actualizar tabla asignaturas
$resultdelete=mysql_query("Delete From asignaturas Where codigo='$codigo2'",$link);


//Comprobar si tiene clones

$sql = "select * from clones where codigo=$codigo2";

$resultado=mysql_query($sql,$link);

if ($row = mysql_fetch_array($resultado)){ //Tiene clones
    
    $codigo_clon=$row["codigo_clon"];
    $sql3="select count(*) as num_clones from clones where codigo_clon=$codigo_clon";
    
    $resultado3=mysql_query($sql3,$link);
    
    if ($row = mysql_fetch_array($resultado3)){
	
	if($row["num_clones"] > 2){ //Quedan mas clones
	    
	    $resdel1=mysql_query("delete from clones where codigo=$codigo2",$link);
	    
	}else{ //Es el ultimo clon
	    
	    $sql4="select codigo from clones where codigo_clon=$codigo_clon AND codigo<>$codigo2";
	    
	    $resultado4=mysql_query($sql4,$link);
	    
	    if ($row = mysql_fetch_array($resultado4)){
		
		$codigo_padre=$row["codigo"];
		
	    }
	    
	    $resdel2=mysql_query("delete from clones where codigo_clon=$codigo_clon",$link);
	    
	    //actualizar codigo clon a codigo padre
	    
	    cambiarCodigo($codigo_clon,$codigo_padre,"enlaces_pagina_web");
	    
	    cambiarCodigo($codigo_clon,$codigo_padre,"pagina_asignatura");
	    
	    cambiarCodigo($codigo_clon,$codigo_padre,"novedades_asignatura");
	    
	    cambiarCodigo($codigo_clon,$codigo_padre,"documentos_pagina_asignatura");
	    
	    system("mv /srv/www/htdocs/depeca/repositorio/asignaturas/$codigo_clon /srv/www/htdocs/depeca/repositorio/asignaturas/$codigo_padre");
	    
	    system("chmod 777 /srv/www/htdocs/depeca/repositorio/asignaturas/$codigo_padre");
	    
	    $sql12="select * from seguridad_docencia where codigo_asignatura=$codigo_clon";
	    
	    $resultado12 = mysql_query($sql12,$link);
	    
	    if ($row=mysql_fetch_array($resultado12)){
		
		if(generarHtaccessHtpasswd($codigo_padre,$row["usuario"],$row["password"]) == 0){ 
		    
		    $sql3 = "UPDATE seguridad_docencia set codigo_asignatura=".$codigo_padre." where codigo_asignatura=".$codigo_clon.";";
		    
		    $result3 = mysql_query($sql3,$link);
		    
		}
		
	    }
	    
	    $sql5 = "SELECT * FROM documentos_pagina_asignatura WHERE codigo_asignatura=".$codigo_padre.";";
	    $result5 = mysql_query($sql5, $link);
	    
	    while ($row = mysql_fetch_array($result5)){
		$ruta=$row["archivo"];
		$trozos = explode("/", $ruta);
		$ruta2="/repositorio/asignaturas/".$codigo_padre."/".$trozos[4];
		$sql4="UPDATE documentos_pagina_asignatura SET archivo='$ruta2' WHERE archivo='$ruta';";
		$result4=mysql_query($sql4,$link);
	    }
	    
	    $sql6 = "SELECT * FROM novedades_asignatura WHERE codigo_asignatura=".$codigo_padre.";";
	    $result6 = mysql_query($sql6, $link);
	    
	    while ($row = mysql_fetch_array($result6)){
		if($row["archivo"]!=""){
		    $ruta=$row["archivo"];
		    $trozos = explode("/", $ruta);
		    $ruta2="/repositorio/asignaturas/".$codigo_padre."/".$trozos[4];
		    $sql7="UPDATE novedades_asignatura SET archivo='$ruta2' WHERE archivo='$ruta';";
		    $result7=mysql_query($sql7,$link);
		}
	    }
	    
	}
    }
    
}else{ //No tiene clones
    
    $consulta="SELECT * FROM asignaturas WHERE codigo='$codigo2'";
    $resultado=mysql_query($consulta,$link);
    $numAsignaturas=mysql_num_rows($resultado);
    
    if($numAsignaturas==0)//si solo hay un registro se borra toda la informacion, repositorio, etc.
    {
	//Primero borrar los archivos
	$sql2 = "SELECT * From documentos_pagina_asignatura Where codigo_asignatura='$codigo2'"; 
	$res2= mysql_query($sql2,$link);
	while($row=mysql_fetch_array($res2)){
	    unlink("/srv/www/htdocs/depeca".$row["archivo"]."");
	}
	
	//Borrar el directorio
	rmdir("/srv/www/htdocs/depeca/repositorio/asignaturas/$codigo2");
	
	
	//Borrar info de todas las tablas
	$resdel3=mysql_query("Delete From documentos_pagina_asignatura Where codigo_asignatura=$codigo2",$link);
	$resdel4=mysql_query("Delete From enlaces_pagina_web Where codigo_asignatura=$codigo2",$link);
	$resdel5=mysql_query("Delete From novedades_asignatura Where codigo_asignatura=$codigo2",$link);
	$resdel6=mysql_query("Delete From pagina_asignatura Where codigo_asignatura=$codigo2",$link);
    }
    
}

//Borramos horas asignacion tablas (mocana)
$resdel7=mysql_query("Delete From horas_asignatura Where cod_asig=$codigo2",$link);
$resdel8=mysql_query("Delete From profesorado Where codigo_asignatura=$codigo2",$link);
$resdel9=mysql_query("Delete From horas_docencia Where cod_asig=$codigo2",$link);

mysql_close ($link); 

?>
<h4><div align="center"><h3>Asignatura Borrada</h3></div></h4>
<br><br>
<div align="center"><span class="generalbluebold"></span> <a href="../../index.php"><span class="generalbluebold">Volver</span></a></div>


<?php
abajo();
?>


