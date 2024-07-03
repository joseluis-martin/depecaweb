<?php

/* Genera la columna cod_dpto de la tabla horas_docencia para el curso que se configure */
/* Si no se rellena esa columna, no funcionar� la generaci�n de informes por materias */

require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexi�n con la base de datos


$link=Conectarse();


//peticiones sql iniciales con campos del tipo #campo# para luego sustituir



/*$sqli[1]="SELECT a.cod_asig, b.codigo_titulacion, CONCAT(b.codigo_titulacion,a.cod_asig) as name FROM horas_asignatura as a inner join asignaturas as b on a.cod_asig=b.codigo where a.curso='2017/2018' and 
(b.codigo_titulacion = 'G35' OR b.codigo_titulacion = 'G37' OR b.codigo_titulacion = 'G38' OR b.codigo_titulacion = 'G39' OR b.codigo_titulacion = 'G430' OR b.codigo_titulacion ='G59' OR b.codigo_titulacion = 'G60' OR b.codigo_titulacion = 'G652' OR b.codigo_titulacion = 'M076' OR b.codigo_titulacion = 'M125' OR b.codigo_titulacion = 'M141' OR b.codigo_titulacion = 'M888' OR b.codigo_titulacion = '02')";*/

$sqli[1]="SELECT hd.cod_asig, a.codigo_titulacion, CONCAT(a.codigo_titulacion,hd.cod_asig) as name FROM horas_docencia as hd inner join asignaturas as a on hd.cod_asig=a.codigo where hd.curso='2023/2024' and 
(a.codigo_titulacion = 'G35' OR a.codigo_titulacion = 'G37' OR a.codigo_titulacion = 'G38' OR a.codigo_titulacion = 'G39' OR a.codigo_titulacion = 'G430' 
OR a.codigo_titulacion ='G59' OR a.codigo_titulacion = 'G60' OR a.codigo_titulacion = 'G652' OR a.codigo_titulacion = 'M076' OR a.codigo_titulacion = 'M125' 
OR a.codigo_titulacion = 'M141' OR a.codigo_titulacion = 'M888' OR a.codigo_titulacion = '00' OR a.codigo_titulacion = '02' OR a.codigo_titulacion = 'M180' 
OR a.codigo_titulacion = 'G591' OR a.codigo_titulacion = 'G781' OR a.codigo_titulacion ='G610' OR a.codigo_titulacion ='G653' OR a.codigo_titulacion ='M203' 
OR a.codigo_titulacion = 'M125_1' OR a.codigo_titulacion = '10')";

$sqli[2]="UPDATE horas_docencia SET cod_dpto='#cod_dpto#' WHERE cod_asig=#codigo# AND curso='2023/2024'";    

$sql[1]=$sqli[1];

$result[1]=mysql_query($sql[1],$link); 

while($row[1]=mysql_fetch_array($result[1])) //Para cada materia...
    {
    $sql[2]=str_replace("#codigo#",$row[1]['cod_asig'],$sqli[2]); 
    $sql[2]=str_replace("#cod_dpto#",$row[1]['name'],$sql[2]); 
    echo $sql[2];
    echo '<br><br>';
    echo $row[1]['cod_asig'];
    echo '<br><br>';
    echo $row[1]['name'];
    echo '<br><br>';
    $result[2]=mysql_query($sql[2],$link); 
}

?>
