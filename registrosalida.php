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