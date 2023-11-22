<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bases";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Inicializar la variable de búsqueda
$search = '';

// Verificar si se envió un formulario de búsqueda
if (isset($_GET['buscar'])) {
    $search = $_GET['buscar'];
}

// Consulta SQL para obtener datos de la tabla con filtro de búsqueda
$sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%' OR apellido_1 LIKE '%$search%'  OR apellido_2 LIKE '%$search%'  OR usuario_id LIKE '%$search%'";
$result = $conn->query($sql);

echo "<style>
    body {
        background-image: url('background6.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        color: white; /* Color de texto blanco */
        animation: animatedBg 10s infinite; 
        overflow: hidden;
    }
    @keyframes animatedBg {
        100% {
            filter:huerotate(360deg);
        }
    }

    table {
        width: 50%;
        border-collapse: collapse;
        margin: 0 auto; /* Centrar la tabla */
        backdrop-filter: blur(15px);
        background-color: rgb(0, 0, 0, 0.);
    }

    table::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        filter: blur(5px); /* Ajusta el valor de blur según tus preferencias */
        z-index: -1;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        position: relative;
        z-index: 1;
    }

    th {
        background-color: rgba(0, 0, 0, 0.7); /* Fondo translúcido */
        
    }

    form {
        margin-bottom: 20px;
        background-color: rgba(0, 0, 0, 0.4); /* Fondo blanco translúcido */
        
        padding: 10px;
        border-radius: 10px; /* Bordes redondeados */
        text-align: center;
    }

    label {
        font-weight: bold;
        color: white; /* Color de texto blanco */
    }

    input[type=text] {
        
        padding: 5px;
        background: transparent;
        color: white;
        
    }

    input[type=submit] {
        padding: 5px 10px;
        background-color: rgb(13, 9, 62, 0.3);
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: rgb(49, 35, 141, 0.4);
    }
</style>";
echo "<div style='max-height: 1000px; overflow: auto;'>";
// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Imprimir formulario de búsqueda
    echo "<form method='get' action='listausuario.php' style='position: fixed; top: 0; left: 10%; transform: translateX(-50%); background-color: rgba(0, 0, 0, 0.4); padding: 10px; border-radius: 10px; text-align: center;'>";
    echo "<label>Buscar:</label>";
    echo "<input type='text' name='buscar' value='$search'>";
    echo "<input type='submit' value='Buscar'>";
    echo "</form>";
    // Contenedor para la tabla
    echo "<div style='margin-top: 50px;'>";
    // Imprimir encabezados de la tabla
    echo "<table border='1' style='width: 1000px;'>";
    echo "<tr style='position: sticky; top: 0; background-color: rgba(0, 0, 0, 0.7);'><th>ID</th><th>Columna1</th><th>Columna2</th><th>Columna3</th></tr>";

    // Imprimir datos de la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["usuario_id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["apellido_1"] . "</td><td>" . $row["apellido_2"] . "</td></tr>";
    }

    // Cerrar la etiqueta de la tabla
    echo "</table>";
    echo "</div>";
} else {
    echo "0 resultados encontrados";
}
echo "</div>";
echo "</div>";
// Cerrar la conexión a la base de datos
$conn->close();

?>