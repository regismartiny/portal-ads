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

    $status = array();
    $validacao = $cUsuario->validarLogin($_POST['matricula'], $_POST['senha']);
    if($validacao == 2) {
        //tudo ok
        session_start();
        $usuario = new Usuario();
        $usuario = $cUsuario->listarUm($_POST);
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['nomeUsuario'] = $usuario->getNome();
        $_SESSION['matricula'] = $usuario->getSiapeMatricula();
        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();
        definirCookie($usuario->getSiapeMatricula(), 1); //define o cookie pra sessão em 1 hora
        $status = array('sucesso' => true, 'mensagem' => 'Usuário autenticado com sucesso.', 'tipoUsuario' => $_SESSION['tipoUsuario']);
    } elseif ($validacao == 0) {
        $status = array('sucesso' => false, 'mensagem' => 'Erro desconhecido.');
    } elseif ($validacao == 1) {
        //Usuário Certo, Senha Errada
        $status = array('sucesso' => false, 'mensagem' => 'Senha inválida.');
    } elseif ($validacao == 3) {
        $status = array('sucesso' => false, 'mensagem' => 'O usuário não existe.');
    } elseif ($validacao == 4){
        //usuario bloqueado
        $status = array('sucesso' => false, 'mensagem' => 'O usuário está bloqueado.');
    }
    $resultado = json_encode($status, JSON_FORCE_OBJECT);
    echo json_encode($resultado);
}

function definirCookie($identificacao, $nHoras) {
    setcookie('702741445', $identificacao, (time() + ($nHoras * 3600)));
}
