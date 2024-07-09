<?php


require_once("../../../core/bibliotecaint.inc.php");
include("../../../core/conexion.inc.php"); //Conexión con la base de datos
arriba("", "asig_docencia", "es", "Asignaci&oacute;n de Docencia");
session_start();

// Función para calcular el tiempo transcurrido en microsegundos
function get_microtime() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

// Al inicio del script
$start_time = get_microtime();

$user=$_SESSION['user'];

$nivel="asignacion_docencia";

if (isset($_GET['valor2']))
{
    $curso_recibido = $_GET['valor2'];   
    $anio1=substr($curso_recibido,0,4);
    $curso_recibido_ant=($anio1-1)."/".$anio1;
    $curso_recibido_2ant=($anio1-2)."/".($anio1-1);
}
else
{
    $curso_recibido=$_POST['curso'];
    $anio1=substr($curso_recibido,0,4);
    $curso_recibido_ant=($anio1-1)."/".$anio1;
    $curso_recibido_2ant=($anio1-2)."/".($anio1-1);
}

function calcular_capacidad_maxima($curso){

    $link=Conectarse();

    $sql_cargas = "select SUM(h.cargamax_total) AS total_cantidad FROM personal p JOIN cargas_max h ON p.nif = h.nif WHERE h.situacion_academica = 'ACTIVO' AND h.curso = '$curso'";
	$resul_cargas = mysql_query($sql_cargas, $link);
	$row_cargas = mysql_fetch_array($resul_cargas);
	$suma_cargas = $row_cargas['total_cantidad'];

    return $suma_cargas;

}

function calcular_horas_grado_teleco($curso)
{

    $link=Conectarse();


    $sql_horas = "
    SELECT 
        SUM(HT1C_totales) AS suma_HT1C_totales,
        SUM(HL1C_totales) AS suma_HL1C_totales,
        SUM(HT2C_totales) AS suma_HT2C_totales,
        SUM(HL2C_totales) AS suma_HL2C_totales,
        SUM(HEJ1C_totales) AS suma_HEJ1C_totales,
        SUM(HEJ2C_totales) AS suma_HEJ2C_totales,
        SUM(HT1EC_totales) AS suma_HT1EC_totales,
        SUM(HL1EC_totales) AS suma_HL1EC_totales,
        SUM(HT2EC_totales) AS suma_HT2EC_totales,
        SUM(HL2EC_totales) AS suma_HL2EC_totales,
        SUM(HEJ1EC_totales) AS suma_HEJ1EC_totales,
        SUM(HEJ2EC_totales) AS suma_HEJ2EC_totales
    FROM horas_docencia 
    WHERE cod_asig IN (
        SELECT codigo 
        FROM asignaturas 
        WHERE 
            (semestre < 5 AND codigo_titulacion = 'G37') OR 
            (semestre > 4 AND codigo_titulacion IN ('G35', 'G37', 'G38', 'G39'))) AND curso = '$curso'";

    $resul_horas = mysql_query($sql_horas, $link);
    $suma_horas = 0;

    if ($row_horas = mysql_fetch_assoc($resul_horas)) {
        $suma_horas = 
            $row_horas['suma_HT1C_totales'] + $row_horas['suma_HL1C_totales'] + 
            $row_horas['suma_HT2C_totales'] + $row_horas['suma_HL2C_totales'] + 
            $row_horas['suma_HEJ1C_totales'] + $row_horas['suma_HEJ2C_totales'] + 
            $row_horas['suma_HT1EC_totales'] + $row_horas['suma_HL1EC_totales'] + 
            $row_horas['suma_HT2EC_totales'] + $row_horas['suma_HL2EC_totales'] + 
            $row_horas['suma_HEJ1EC_totales'] + $row_horas['suma_HEJ2EC_totales'];
    }

    return $suma_horas;
}


function calcular_horas_grado($curso, $codigos_titulacion) {
    
    $link = Conectarse();

    // Construir la lista de códigos de titulación para la consulta
    $codigos_titulacion_list = implode("','", array_map('mysql_real_escape_string', $codigos_titulacion));
    
    // Consulta de horas de docencia con SUM
    $sql_horas = "
    SELECT 
        SUM(HT1C_totales) AS suma_HT1C_totales,
        SUM(HL1C_totales) AS suma_HL1C_totales,
        SUM(HT2C_totales) AS suma_HT2C_totales,
        SUM(HL2C_totales) AS suma_HL2C_totales,
        SUM(HEJ1C_totales) AS suma_HEJ1C_totales,
        SUM(HEJ2C_totales) AS suma_HEJ2C_totales,
        SUM(HT1EC_totales) AS suma_HT1EC_totales,
        SUM(HL1EC_totales) AS suma_HL1EC_totales,
        SUM(HT2EC_totales) AS suma_HT2EC_totales,
        SUM(HL2EC_totales) AS suma_HL2EC_totales,
        SUM(HEJ1EC_totales) AS suma_HEJ1EC_totales,
        SUM(HEJ2EC_totales) AS suma_HEJ2EC_totales
    FROM horas_docencia 
    WHERE cod_asig IN (
        SELECT codigo 
        FROM asignaturas 
        WHERE codigo_titulacion IN ('$codigos_titulacion_list')
    ) AND curso = '$curso'";

    $resul_horas = mysql_query($sql_horas, $link);
    $suma_horas = 0;

    if ($row_horas = mysql_fetch_assoc($resul_horas)) {
        $suma_horas = 
            $row_horas['suma_HT1C_totales'] + $row_horas['suma_HL1C_totales'] + 
            $row_horas['suma_HT2C_totales'] + $row_horas['suma_HL2C_totales'] + 
            $row_horas['suma_HEJ1C_totales'] + $row_horas['suma_HEJ2C_totales'] + 
            $row_horas['suma_HT1EC_totales'] + $row_horas['suma_HL1EC_totales'] + 
            $row_horas['suma_HT2EC_totales'] + $row_horas['suma_HL2EC_totales'] + 
            $row_horas['suma_HEJ1EC_totales'] + $row_horas['suma_HEJ2EC_totales'];
    }

    return $suma_horas;
}

$horas_totales = 0;
$res_horas = 0;
echo ('Capacidad m&aacute;xima Dpto: ');
echo calcular_capacidad_maxima($curso_recibido);
echo ('<br>');

echo ('Horas GIEC / GIST / GIT: ');
$res_horas = calcular_horas_grado_teleco($curso_recibido);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo('Horas GIEAI / GITI: ');
$codigos_titulacion = array('G60', 'G610');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo('Horas GII / GIC / GISI: ');
$codigos_titulacion = array('G781', 'G591');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo('Horas GFIE: ');
$codigos_titulacion = array('G653');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo('Horas GMEP: ');
$codigos_titulacion = array('G430');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo('Horas GCCTF: ');
$codigos_titulacion = array('G652');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo ('Horas MUIT: ');
$codigos_titulacion = array('M125_1');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo ('Horas MUII: ');
$codigos_titulacion = array('M141');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo ('Horas MUIE: ');
$codigos_titulacion = array('M180');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo ('Horas RD / RO: ');
$codigos_titulacion = array('00', '01');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo ('Horas Transversales: ');
$codigos_titulacion = array('02');
$res_horas =  calcular_horas_grado($curso_recibido, $codigos_titulacion);
echo $res_horas;
$horas_totales += $res_horas; 
echo('<br>');

echo ('Horas Totales: ');
echo $horas_totales;