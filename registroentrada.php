<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo'
            <script>
                alert("Por favor debes iniciar sesion");
                window.location ="iniciar_usuario.php";
            </script>
        ';
        //header("location: iniciar_usuario.php");
        session_destroy();
        die();
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Historial de entradas</title>
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilovehiculo.css">
    <style>
        /* Agrega estilos personalizados aquí */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 0;
        }

        th, td {
            border: 0; /* Elimina el borde */
            padding: 10px;
            text-align: left;
            color: white; /* Hace que el texto sea blanco */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
    <main>
        <section>
            <div class="form-box">
                <div class="contenedor__todo">
                    <div class="container__box">
                        <div class="box" onclick="redirigirApanelPHP()">
                            <i class="lni lni-exit"></i>
                        </div>
                        <script>
                            function redirigirApanelPHP() {
                                window.location.href = 'bienvenida.php';
                            }
                        </script>
                    </div>
                    <br><br><br>
                    <div class="form-value">
                        <div class="contenedor__login-register">
                            <form action="php/registro_entrada_be.php">
                                <h2>Historial de entradas</h2>
                                <!-- Pega aquí el código PHP de registro_entrada_be.php -->
                                <?php
                                    
                                    // Incluir el archivo de conexión solo si está disponible
                                    if (file_exists('php/conexion_be.php')) {
                                        include 'php/conexion_be.php';
                                    
                                        // Realizar la consulta SQL
                                        $sql = "SELECT  e.usuaro_id, e.funcionario_id, e.fecha, e.hora, u.nombre, u.apellido_1, u.apellido_2, u.celular, u.documento, u.email, u.tipo_usuario
                                            FROM entradas e
                                            JOIN usuarios u ON e.usuaro_id = u.usuario_id
                                            ORDER BY e.fecha DESC, e.hora DESC";
                                    
                                        // Verificar si la conexión se estableció correctamente
                                        if ($conexion) {
                                            $resultado = mysqli_query($conexion, $sql);
                                    
                                            if ($resultado) {
                                                // Mostrar la tabla con los resultados
                                                echo '<table border="1" > ';
                                                
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    if ($fila['tipo_usuario'] == 1) {
                                                    echo $fila['tipo_usuario']="residente";
                                                } elseif ($fila['tipo_usuario'] == 2) {
                                                    echo $fila['tipo_usuario']="visitante";
                                                } elseif ($fila['tipo_usuario'] == 3) {
                                                    echo $fila['tipo_usuario']="funcionario";
                                                } else {
                                                    // Puedes manejar un caso por defecto o lanzar un error si es necesario
                                                    echo "Tipo de usuario desconocido";
                                                }
                                                    echo '<tr>';
                                                    
                                                    echo '<td>' . $fila['nombre'] . ' ' . $fila['apellido_1'] . ' ' . $fila['apellido_2'] . ' <center> ' . $fila['fecha'] . '</center></td>';
                                                    echo '<tr>';
                                                    echo '<td> ' . $fila['tipo_usuario'] . ' <center>  ' . $fila['hora'] . '</center></td>'; 
                                                    echo '<tr>';
                                                    echo '<td>__________________________________________________________</td>';
                                                    echo '</tr>';
                                                    
                                                }
                                    
                                                echo '</table>';
                                            } else {
                                                // Manejar el error si la consulta no fue exitosa
                                                echo 'Error al ejecutar la consulta: ' . mysqli_error($conexion);
                                            }
                                    
                                            mysqli_close($conexion);
                                        } else {
                                            // Manejar el error si la conexión no se estableció correctamente
                                            echo 'Error en la conexión a la base de datos.';
                                        }
                                    } else {
                                        // Manejar el error si el archivo de conexión no existe
                                        echo 'Error: El archivo de conexión no existe.';
                                    }
                                    ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </main>
    <script src="js/script.js"></script>
</body>
</html>
