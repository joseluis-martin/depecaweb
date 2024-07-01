<?php

// Genera las horas por asignatura organizadas por grado y ordenadas por semestre

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

function get_campomateria($campomateria,$link)
{

if (isset ($_GET['materia'])){
      $campomateria=($_GET['materia']);
      return $campomateria;
      }  
}  


$link=Conectarse();
cabecera();
$campomateria="materia3";
$campomateria=get_campomateria($campomateria,$link);
$anio="2018/2019";
$anio=get_curso($anio,$link);
echo "CURSO ".$anio."<br>";  
echo "Version ".$campomateria."<br>";

//peticiones sql iniciales con campos del tipo #campo# para luego sustituir

// $sqli[1]="SELECT * FROM materia3 order by materia3";

// $sqli[2]="select * from asignaturas where materia3='#materia3#' order by codigo";

/*$sqli[3]="SELECT 
h.nif,materia3,p.nif,p.nombre,p.apellidos,p.cargo,
c.cargamax_total,h.curso,
sum(ht1c_totales+ht2c_totales) GGE, 
sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE,
sum(ht1ec_totales+ht2ec_totales) GGI, 
sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI,
sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI,
sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales+ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TT
FROM `horas_docencia` h 
inner join asignaturas a on h.cod_asig=a.codigo
inner join personal p on h.nif=p.nif 
inner join cargas_max c on h.nif=c.nif and h.curso=c.curso and c.situacion_academica='ACTIVO'
WHERE h.curso='#anio#' and a.materia3='#materia3#' 
GROUP BY h.nif,a.materia3
ORDER BY TT DESC";

$sqli[4]=$sqli[3];*/

$sqli[1]="select * from carreras WHERE codigo = 'G35' OR codigo = 'G37' OR
codigo = 'G38' OR codigo = 'G39' OR codigo = 'G430' OR codigo =
'G59' OR codigo = 'G60' OR codigo = 'G652' OR codigo = 'M076' OR codigo = 'M125' 
OR codigo = 'M141' OR codigo = 'M888' OR codigo = '02'";

$sqli[2]="select * from asignaturas where codigo_titulacion='#codigo_titulacion#' order by semestre";


$sqli[3]="SELECT sum(ht1c_totales+ht2c_totales) GGE, sum(hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) GPE, sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales) TE, sum(ht1ec_totales+ht2ec_totales) GGI, sum(hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) GPI, sum(ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TI, sum(ht1c_totales+ht2c_totales+hl1c_totales+hl2c_totales+hej1c_totales+hej2c_totales+ht1ec_totales+ht2ec_totales+hl1ec_totales+hl2ec_totales+hej1ec_totales+hej2ec_totales) TT FROM horas_asignatura WHERE curso='#anio#' and cod_asig='#cod_asig#'";

//comienzo del informe MAIN main

$sql[1]=$sqli[1];

$result[1]=mysql_query($sql[1],$link);

while($row[1]=mysql_fetch_array($result[1])){
	
	begintable();

	escribefilascolumnas(1,$row[1]['codigo'],4,$row[1]['nombre'],1,"",1,"",1,"",1,"",1,"",1,"",1,"",1,"",1,"",1,"");
	
	// Obtiene las asignaturas de cada titulación
	$sql[2] = str_replace("#codigo_titulacion#",$row[1]['codigo'],$sqli[2]);
	//echo $sql[2]."<br>"."<br>";
	$result[2]=mysql_query($sql[2],$link);

  	escribefilascolumnas(1,"",4,"Asignatura",1,"GGE",1,"GPE",1,"TE",1,"GGI",1,"GPI",1,"TI",1,"TT",1,"",1,"",1,"");

	while($row[2]=mysql_fetch_array($result[2])){
	
		$sql[3]=str_replace("#anio#",$anio,$sqli[3]);
    	$sql[3]=str_replace("#cod_asig#",$row[2]['codigo'],$sql[3]);

		//echo $sql[3]."<br>"."<br>";

		$result[3]=mysql_query($sql[3],$link);
		$row[3]=mysql_fetch_array($result[3]);
		
	  	escribefilascolumnas(1,"",4,$row[2][nombre],
			      1,$row[3]['GGE'],1,$row[3]['GPE'],1,$row[3]['TE'],
			      1,$row[3]['GGI'],1,$row[3]['GPI'],1,$row[3]['TI'],
			      1,$row[3]['TT'],
			      1,"",
			      1,"",
			      1,"");
    }//Fin Bucle asignaturas
	  endtable();
}

?>
