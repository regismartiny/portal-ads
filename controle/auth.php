<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";

    
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];
    
    $usuario = new Usuario(null,$matricula,null,null,$senha,null,null);

    $cadastrado = $usuario->isCadastrado();

    $resultado = $cadastrado;

    if ($cadastrado) {
        session_start();
        $cUsuario = new ControleUsuario();
        $usuario = $cUsuario->listarUm($matricula);
                        
        $_SESSION["nomeUsuario"] = $usuario->getNome();
        $_SESSION['matricula'] = $usuario->getSiapeMatricula();
        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();

        $resultado = '{ "tipoUsuario": ' . $usuario->getTipoUsuario_id() . ' }';
    }

    echo json_encode($resultado);
?>