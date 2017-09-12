<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if (!empty($_POST) && isset($_POST['matricula']) && isset($_POST['senha'])
        && !empty($_POST['matricula']) && !empty($_POST['senha'])) {

    include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";

    $cUsuario = new ControleUsuario();

    $cadastrado = $cUsuario->verificaLogin($_POST);
    $resultado = $cadastrado;

    if ($cadastrado) {
        session_start();
        
        $usuario = $cUsuario->listarUm($_POST['matricula']);
                        
        $_SESSION["nomeUsuario"] = $usuario->getNome();
        $_SESSION['matricula'] = $usuario->getSiapeMatricula();
        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();

        $tipoUsuario = array('tipoUsuario' => $_SESSION['tipoUsuario']);
        $resultado = json_encode($tipoUsuario, JSON_FORCE_OBJECT);
    }
    echo json_encode($resultado);
}