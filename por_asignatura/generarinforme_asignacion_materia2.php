<?php

require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos

function begintable()
{
echo "<table border='1'>\n";
}

function endtable()
{
echo "</table>\n";
}

function beginrow()
{
echo "<tr>\n";
}

function endrow()
{
echo "</tr>\n";
}

function begincolumn()
{
echo "<td>\n";

}

function endcolumn()
{
echo "</td>\n";
}

function beginmulticolumn($cols)
{
echo "<td colspan='$cols'>\n";

}


function columna($cols,$texto)
{
beginmulticolumn($cols);echo $texto;endcolumn();
}

function columnaxls($cols,$texto)
{
  begincolumn();echo $texto;endcolumn();
  for($a=1;$a<$cols;$a++)
	beginmulticolumn(1);echo "";endcolumn();
}

function cabeceracolumnas($Acols,$Atexto)
{
$i=0;
foreach( $Atexto as $texto )
    {
     columna($Acols[$i],$Atexto[$i]);
     $i++;
     }     
}

function escribecolumnas()
{
$numargs=func_num_args();
$argumentos=func_get_args();
for ($i=0;$i<$numargs;$i=$i+2)
  columna($argumentos[$i],$argumentos[$i+1]);
}

function escribefilascolumnas()
{
beginrow();
$numargs=func_num_args();
$argumentos=func_get_args();

for ($i=0;$i<$numargs;$i=$i+2)
{
  if (isset($_GET['ver']))  {
    columna($argumentos[$i],$argumentos[$i+1]);
    
  }
    else {
      columnaxls($argumentos[$i],$argumentos[$i+1]);
      
    }
  
}
  endrow();
}

function calcular_carga_real($nif,&$carga,&$cargamax,$curso,$link)
{
//Calculamos carga real
$sql_cod_asig = "select * from profesorado where nif='$nif'";	    
$resul_cod_asig = mysql_query($sql_cod_asig, $link);
$sql="SELECT sum( HT1C_totales ) + sum( HL1C_totales ) + sum( HT2C_totales ) + sum( HL2C_totales ) + sum( HEJ1C_totales ) + sum( HEJ2C_totales ) + sum( HT1EC_totales ) + sum( HL1EC_totales ) + sum( HT2EC_totales ) + sum( HL2EC_totales ) + sum( HEJ1EC_totales ) + sum( HEJ2EC_totales ) as suma 
FROM horas_docencia where nif='$nif' and curso='$curso'";
$result=mysql_query($sql, $link);
$row=mysql_fetch_array($result);
$suma2=$row['suma'];

$sql2="select * from cargas_max where nif ='$nif' and curso ='$curso'";
$result=mysql_query($sql2, $link);
$row_carga=mysql_fetch_array($result);
$cargamax2=$row_carga['cargamax_total'];
$carga_real=round(($suma2/$cargamax2)*100,2);
$carga.=$suma2;
$cargamax.=$cargamax2;
 return $carga_real;
}


function get_curso($anio,$link)
{
if (isset ($_GET['anio'])){
      $anio=($_GET['anio']);
      return $anio;
      }
else{
$sqlX="SELECT curso FROM curso_academico order by curso desc;";
$resultX=mysql_query($sqlX,$link);
$rowX=mysql_fetch_array($resultX);
return $rowX['curso'];
}  

}
function cabecera()
{
//arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");

// echo "<html><head>
// <meta http-equiv="content-type" content="text/html; charset=iso-8859-15"></head><body>";

echo "Leyenda:<br>
Mat:Materia<br>
GGE, GGI:Horas de grupo grande de esa asignatura en español y en inglés<br>
GPE, GPI:Horas de grupo pequeño de esa asignatura en español y en inglés<br>
TE, TI, TT:Horas totales de esa asignatura en español (GGE+GPE), horas totales en inglés (GGI+GPI), horas totales (TE+TI)<br><br>";
}


$link=Conectarse();
cabecera();
$anio="2015/2016";
$anio=get_curso($anio,$link);
echo "CURSO ".$anio."<br>";  


//peticiones sql iniciales con campos del tipo #campo# para luego sustituir

$sqli[1]="SELECT * FROM materia2 order by materia2;";

$sqli[2]="select * from asignaturas where materia2='#materia2#' order by codigo";

$sqli[3]="SELECT 
h.nif,materia2,p.nif,p.nombre,p.apellidos,p.cargo,
c.cargamax_total,h.curso,
sum(ht1c_totales+ht2c_totales) GGE, 
sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE,
sum(ht1ec_totales+ht2ec_totales) GGI, 
sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI,
sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales+ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TT
FROM `horas_docencia` h 
inner join asignaturas a on h.cod_dpto=a.cod_dpto
inner join personal p on h.nif=p.nif 
inner join cargas_max c on h.nif=c.nif and h.curso=c.curso and c.situacion_academica='ACTIVO'
WHERE h.curso='#anio#' and a.materia2='#materia2#' 
GROUP BY h.nif,a.materia2
ORDER BY TT DESC";

$sqli[4]=$sqli[3];

$sqli[5]="SELECT cod_asig,
sum(ht1c_totales+ht2c_totales) GGE, 
sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE,
sum(ht1ec_totales+ht2ec_totales) GGI, 
sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI,
sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales+ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TT,
codigo,materia2  FROM `horas_asignatura` h inner join asignaturas a on h.cod_dpto=a.cod_dpto WHERE curso='#anio#' and materia2='#materia2#' group by materia2";

$sqli[6]="SELECT cod_asig,a.codigo,a.nombre,a.codigo_titulacion,
sum(ht1c_totales+ht2c_totales) GGE, 
sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE,
sum(ht1ec_totales+ht2ec_totales) GGI, 
sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI,
sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales+ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TT,
codigo,materia2  FROM `horas_asignatura` h INNER JOIN asignaturas a 
ON h.cod_dpto=a.cod_dpto WHERE curso='#anio#' and materia2='#materia2#' 
GROUP BY h.cod_asig 
ORDER BY materia2,TT DESC
";


$sqli[7]="SELECT nif,
sum(ht1c_totales+ht2c_totales) GGE, 
sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE,
sum(ht1ec_totales+ht2ec_totales) GGI, 
sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI,
sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI,
materia2  FROM `horas_docencia` h inner join asignaturas a on h.cod_dpto=a.cod_dpto 
WHERE curso='#anio#' and materia2='#materia2#' and nif='#nif#' group by nif";

$sqli[8]="SELECT 
sum(ht1c_totales+ht2c_totales) GGE, 
sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE,
sum(ht1ec_totales+ht2ec_totales) GGI, 
sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI,
sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI,
materia2  FROM `horas_docencia` h inner join asignaturas a on h.cod_dpto=a.cod_dpto 
WHERE curso='#anio#' and materia2='#materia2#'  group by materia2";
//comienzo del informe MAIN main

$sql[1]=$sqli[1];
$result[1]=mysql_query($sql[1],$link);

while($row[1]=mysql_fetch_array($result[1]))
    {
    begintable();
        
    $sql[5]=str_replace("#materia2#",$row[1]['materia2'],$sqli[5]);
      $sql[5]=str_replace("#anio#",$anio,$sql[5]);
      $result[5]=mysql_query($sql[5],$link);
      $row[5]=mysql_fetch_array($result[5]);
    
    $sql[4]=str_replace("#materia2#",$row[1]['materia2'],$sqli[4]);
	  $sql[4]=str_replace("#anio#",$anio,$sql[4]);
	  $sql[4]=str_replace("h.nif,","",$sql[4]);
	  $result[4]=mysql_query($sql[4],$link);
	  $row[4]=mysql_fetch_array($result[4]);
	  
    escribefilascolumnas(1,$row[1]['materia2'],4,$row[1]['nombre_materia2'],1,"GGE",1,"GPE",1,"TE",1,"GGI",1,"GPI",1,"TI",1,"TT",1,"CSM%",1,"CT h",1,"CT%");
    escribefilascolumnas(1,$row[1]['materia2'],4,"Materia Total",1,$row[5]['GGE'],1,$row[5]['GPE'],1,$row[5]['TE'],1,$row[5]['GGI'],1,$row[5]['GPI'],1,$row[5]['TI'],1,$row[5]['TI']+$row[5]['TE'],
	      1,"",
	      1,"",
	      1,"");
     
     escribefilascolumnas(1,$row[1]['materia2'],
			      4,"Diferencia entre Materia y Profesores",
			      1,$row[5]['GGE']-$row[4]['GGE'],
			      1,$row[5]['GPE']-$row[4]['GPE'],
			      1,$row[5]['TE']-$row[4]['TE'],
			      1,$row[5]['GGI']-$row[4]['GGI'],
			      1,$row[5]['GPI']-$row[4]['GPI'],
			      1,$row[5]['TI']-$row[4]['TI'],
			      1,$row[5]['TT']-$row[4]['TT'],
			      1,"",
			      1,"",
			      1,"");  
	
    $sql[2]=str_replace("#materia2#",$row[1]['materia2'],$sqli[2]);
    $result[2]=mysql_query($sql[2],$link);
        
    escribefilascolumnas(1,$row[1]['materia2'],4,"Asignaturas",1,"GGE",1,"GPE",1,"TE",1,"GGI",1,"GPI",1,"TI",1,"TT",1,"CSM%",1,"CT h",1,"CT%");
    
    $sql[6]=str_replace("#materia2#",$row[1]['materia2'],$sqli[6]);
    $sql[6]=str_replace("#anio#",$anio,$sql[6]);
    $sql[6]=str_replace("#cod_dpto#",$row[2]['cod_dpto'],$sql[6]);
    $result[6]=mysql_query($sql[6],$link);
    //bucle ASIGNATURAS    
    while($row[6]=mysql_fetch_array($result[6])){  
    
	  $sql[3]=str_replace("#materia2#",$row[1]['materia2'],$sqli[3]);
	  $sql[3]=str_replace("#anio#",$anio,$sql[3]);
	  $result[3]=mysql_query($sql[3],$link);

	  escribefilascolumnas(1,$row[1]['materia2'],1,"ASIG",
			      1,$row[6]['codigo'],
			      1,$row[6]['codigo_titulacion'],1,$row[6]['nombre'],
			      1,$row[6]['GGE'],1,$row[6]['GPE'],1,$row[6]['TE'],
			      1,$row[6]['GGI'],1,$row[6]['GPI'],1,$row[6]['TI'],
			      1,$row[6]['TT'],
			      1,"",
			      1,"",
			      1,"");
    }//Fin Bucle asignaturas
if (!isset($_GET['noprof']))
	{
	  escribefilascolumnas(1,$row[1]['materia2'],4,"Profesores.",1,"GGE",1,"GPE",1,"TE",1,"GGI",1,"GPI",1,"TI",1,"TT",1,"CSM%",1,"CT h",1,"CT%"); 
	    
	  escribefilascolumnas(1,$row[1]['materia2'],
			      4,"Profesores Total",
			      1,$row[4]['GGE'],1,$row[4]['GPE'],1,$row[4]['TE'],1,$row[4]['GGI'],
			      1,$row[4]['GPI'],1,$row[4]['TI'],
			      1,$row[4]['TT'],
			      1,"",
			      1,"",
			      1,""
				);  
//Bucle Profesores
	  while($row[3]=mysql_fetch_array($result[3]))
	      {
		  $nif=$row[3]['nif'];
		    $cargav=0;$cargamax=0;
		    $carga_real=round(calcular_carga_real($nif,$cargav,$cargamax,$anio,$link),2);
		    $cargav=round($cargav,2);
		    $TT=$row[3]['TT'];
		    $carga_sobre_materia2=round($TT/$cargav*100,2);
		    $carga_sobre_maxima=round($TT/$cargamax*100,2);
		    escribefilascolumnas(1,$row[1]['materia2'],1,"PROF",
					1,$nif,1,$row[3]['cargo'],1,$row[3]['nombre']." ".$row[3]['apellidos'],
					1,$row[3]['GGE'],1,$row[3]['GPE'],1,$row[3]['TE'],1,$row[3]['GGI'],
					1,$row[3]['GPI'],1,$row[3]['TI'],
					1,$TT,
					1,$carga_sobre_materia2,
					1,$cargav,
					1,$carga_real
					);  
		    }//Fin Bucle Profesores
	 } 
	  
	  
	  endtable();
    }

?>
