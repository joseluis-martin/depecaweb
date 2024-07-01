<?php
require_once("../core/biblioteca.inc.new.php");
include("../core/conexion.inc.new.php"); // Conexión con la base de datos

session_start();

$usuario = $_SESSION["usuario"];
$nivel = $_SESSION["nivel"];

arriba("privada", "", "es", "Selección");

// Obtener detalles del usuario
$link = Conectarse();
$user = $_SESSION['usuario'];
$sql_puesto = "SELECT * FROM personal WHERE usuario=?";
$stmt_puesto = mysqli_prepare($link, $sql_puesto);
mysqli_stmt_bind_param($stmt_puesto, 's', $user);
mysqli_stmt_execute($stmt_puesto);
$result_puesto = mysqli_stmt_get_result($stmt_puesto);

if ($row = mysqli_fetch_array($result_puesto)) {
    $puesto = $row['puesto'];
    $nif = $row["nif"];
    $nombre = $row['nombre'];
    $apellidos = $row['apellidos'];
}

// Obtener año académico y cuatrimestre
$anio2 = date("Y");
$mes = date("m");
$dia = date("d");
$cuat = ($mes > 2 && $mes < 9) ? 2 : 1;
$anio3 = ($mes >= 9) ? $anio2 . "/" . ($anio2 + 1) : ($anio2 - 1) . "/" . $anio2;

$sql_fecha = "SELECT * FROM curso_academico WHERE curso=?";
$stmt_fecha = mysqli_prepare($link, $sql_fecha);
mysqli_stmt_bind_param($stmt_fecha, 's', $anio3);
mysqli_stmt_execute($stmt_fecha);
$resul_fecha = mysqli_stmt_get_result($stmt_fecha);
$row_fecha = mysqli_fetch_array($resul_fecha);
$fecha_cambio = explode("-", $row_fecha['inicio']);

$aniop = ($mes > $fecha_cambio[1] || ($mes == $fecha_cambio[1] && $dia >= $fecha_cambio[0])) ? $anio2 . "/" . ($anio2 + 1) : ($anio2 - 1) . "/" . $anio2;

// Obtener detalles del personal
$sql_personal = "SELECT * FROM personal WHERE usuario=?";
$stmt_personal = mysqli_prepare($link, $sql_personal);
mysqli_stmt_bind_param($stmt_personal, 's', $user);
mysqli_stmt_execute($stmt_personal);
$resul_personal = mysqli_stmt_get_result($stmt_personal);
$row_personal = mysqli_fetch_array($resul_personal);
$nif = $row_personal['nif'];

$control = '0';
$sql_profesorado = "SELECT * FROM profesorado WHERE nif=? AND coordinador='1'";
$stmt_profesorado = mysqli_prepare($link, $sql_profesorado);
mysqli_stmt_bind_param($stmt_profesorado, 's', $nif);
mysqli_stmt_execute($stmt_profesorado);
$resul_profesorado = mysqli_stmt_get_result($stmt_profesorado);

while ($row_profesorado = mysqli_fetch_array($resul_profesorado)) {
    $cod_asig = $row_profesorado['codigo_asignatura'];
    $sql_asig2 = "SELECT * FROM asignaturas WHERE codigo=?";
    $stmt_asig2 = mysqli_prepare($link, $sql_asig2);
    mysqli_stmt_bind_param($stmt_asig2, 's', $cod_asig);
    mysqli_stmt_execute($stmt_asig2);
    $resul_asig2 = mysqli_stmt_get_result($stmt_asig2);
    $row_asig2 = mysqli_fetch_array($resul_asig2);

    if (($row_asig2['cuatrimestre'] == $cuat || $row_asig2['cuatrimestre'] == '0') && $row_asig2['estado'] == 'ordinario') {
        $sql_profesorado2 = "SELECT * FROM profesorado WHERE nif!=? AND codigo_asignatura=?";
        $stmt_profesorado2 = mysqli_prepare($link, $sql_profesorado2);
        mysqli_stmt_bind_param($stmt_profesorado2, 'ss', $nif, $cod_asig);
        mysqli_stmt_execute($stmt_profesorado2);
        $resul_profesorado2 = mysqli_stmt_get_result($stmt_profesorado2);

        while ($row_profesorado2 = mysqli_fetch_array($resul_profesorado2)) {
            $prof = $row_profesorado2['id'];
            $nombre = $row_profesorado2['nombre'];
            $apellido = $row_profesorado2['apellidos'];

            $sql_profesoradohorario = "SELECT * FROM profesorado_horario WHERE profesor=? AND anio_academico=?";
            $stmt_profesoradohorario = mysqli_prepare($link, $sql_profesoradohorario);
            mysqli_stmt_bind_param($stmt_profesoradohorario, 'ss', $prof, $aniop);
            mysqli_stmt_execute($stmt_profesoradohorario);
            $resul_profesoradohorario = mysqli_stmt_get_result($stmt_profesoradohorario);

            if (!mysqli_fetch_array($resul_profesoradohorario)) {
                if ($control == '0') {
                    $control = '1';
                    echo "<table border='0'>\n";
                    echo "<tr>\n";
                    echo "<td class='celdaazul'><b><span class='fuenteblanco'>Aviso: Los siguientes profesores no tienen asignado horario y debe asignarlo en la página de la asignatura correspondiente</span></b></td>\n";
                    echo "</tr>\n";
                    echo "</table>\n";
                }
                echo "<table border='0'>\n";
                echo "<tr>\n";
                echo "<td class='celdaazul'><b><span class='fuenteblanco'>Asignatura: " . $row_asig2['nombre'] . "</span></b></td>\n";
                echo "<td bgcolor='#F8F3E4'><b><span class='fuenteazul'>Profesor sin horario asignado: " . $nombre . " " . $apellido . "</span></b></td>\n";
                echo "</tr>\n";
                echo "</table>\n";
            }
        }
    }
}

echo "<br />";
echo "<br />";
echo "<br />";

echo "<table width='75%' border='3' align='center'>";
echo "<tr>";
echo "<td>";
echo "<table width='75%' border='0' align='center'>";
echo "<tr>";
echo "<td colspan='2' height='41'>";
echo "<p align='center'><span class='fuenteroja'><b>ACCESO A LA INTRANET</b></span></p>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><p align='middle'><a href='../../depeca/privada/intranet/inicio/index.php'><img src='../img/logointranet.gif' align='center'></a></p></td>";
echo "</tr>";
echo "<tr>";
echo "<td height='37'><p align='middle'><a href='../../depeca/privada/intranet/inicio/index.php'><span class='fuenteazul'>Intranet</span></a></p></td>";
echo "</tr>";
echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<table>";
echo "<tr><td></td>";
echo "</tr>";
echo "</table>";

abajo();
