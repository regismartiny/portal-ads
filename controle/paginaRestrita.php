<?php
        session_start();
        if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=1 || !isset($_COOKIE["702741445"])){
                header( 'Location: /controle/logout.php' );
        }
?>
