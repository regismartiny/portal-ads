<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
    $uControle = new ControleUsuario();
    $id=$_POST['id'];
    $uControle->modificarStatusUsuario($id);
?>