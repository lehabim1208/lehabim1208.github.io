<?php 
include '../config/conexion.php';

// Obtener el valor de idEspacio y fecha de la solicitud AJAX
$idEspacio = $_POST['idEspacio'];
$fecha = $_POST['fecha'];

// Consulta SQL para obtener los horarios de la tabla "horarios" donde "idCatalogo" sea igual a $idEspacio
$sql = "SELECT horario FROM horarios WHERE idCatalogo = $idEspacio";
$result = $conn->query($sql);

// Consulta SQL para obtener los horarios ocupados en la tabla "reserva" para la fecha dada
$sqlreservas = "SELECT horario FROM reserva WHERE DATE(fecha) = DATE('$fecha') AND idCatalogo = '$idEspacio'";
$resultreservas = $conn->query($sqlreservas);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    $horarios = array();

    // Obtener los horarios de la base de datos
    while ($row = $result->fetch_assoc()) {
        $horarios[] = $row['horario'];
    }

    // Obtener los horarios ocupados de la tabla "reserva"
    $horariosOcupados = array();
    while ($row = $resultreservas->fetch_assoc()) {
        $horariosOcupados[] = $row['horario'];
    }

    // Calcular la diferencia entre los horarios disponibles y los horarios ocupados
    $horariosDisponibles = array_diff($horarios, $horariosOcupados);

    // Obtener la hora actual en formato "HH:MM"
    date_default_timezone_set('America/Mexico_City');
    $horaActual = date('H:i');

    $hoy = new DateTime(); // Obtiene la fecha actual
    $hoy = $hoy->format('Y-m-d'); // Formatea la fecha actual

    $horariosMostrados = [];

    foreach ($horariosDisponibles as $horario) {
        // Obtener la hora del horario y convertirla al formato "H:i"
        $horarioPartes = explode('-', $horario);
        $horaInicio = trim(explode(' ', $horarioPartes[0])[0]);
        $horaInicio = date('H:i', strtotime($horaInicio));

        // Si la fecha es hoy y la hora del horario es mayor a la hora actual, se agrega a los horarios mostrados
        if ($fecha == $hoy && $horaInicio > $horaActual) {
            $horariosMostrados[] = $horario;
        } elseif ($fecha != $hoy) {
            // Si la fecha no es hoy, se agregan todos los horarios disponibles
            $horariosMostrados[] = $horario;
        }
    }

    // Devolver los horarios mostrados en formato JSON
    echo json_encode($horariosMostrados);
} else {
    echo "No se encontraron horarios para el espacio con ID: $idEspacio";
}

// Cierra la conexión a la base de datos
$conn->close();
?>