<?php
include 'conexion_be.php';

// Realizar la consulta SQL
$query = "SELECT e.entrada_id, u.nombre, u.apellido_1, u.apellido_2, e.fecha, e.hora, tu.tipo_usuario
          FROM entradas e
          JOIN usuarios u ON e.usuario_id = u.usuario_id
          JOIN tipo_usuaro tu ON u.tipo_usuario = tu.tipo_usuario_id
          ORDER BY e.fecha DESC, e.hora DESC";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    // Mostrar la tabla con los resultados
    echo '<table border="1">';
    echo '<tr><th>Entrada ID</th><th>Nombre</th><th>Fecha</th><th>Hora</th><th>Tipo de Usuario</th></tr>';

    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr>';
        echo '<td>' . $fila['entrada_id'] . '</td>';
        echo '<td>' . $fila['nombre'] . ' ' . $fila['apellido_1'] . ' ' . $fila['apellido_2'] . '</td>';
        echo '<td>' . $fila['fecha'] . '</td>';
        echo '<td>' . $fila['hora'] . '</td>';
        echo '<td>' . $fila['tipo_usuario'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    // Manejar el error si la consulta no fue exitosa
    echo 'Error al ejecutar la consulta: ' . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
