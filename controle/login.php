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
    $cadastrado = $cUsuario->verificaUser($_POST);
    if($cadastrado == 2) {
        //Usuário e senha Certos
        session_start();
        $usuario = new Usuario();
        $usuario = $cUsuario->listarUm($_POST);
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['nomeUsuario'] = $usuario->getNome();
        $_SESSION['matricula'] = $usuario->getSiapeMatricula();
        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();
        setcookie('702741445', $usuario->getSiapeMatricula(), (time() + (1 * 3600)));//define o cookie pra sessão em n horas
        $status = array('sucesso' => true, 'mensagem' => 'Usuário autenticado com sucesso.', 'tipoUsuario' => $_SESSION['tipoUsuario']);
    } elseif ($cadastrado == 0) {
        //Erro no processo
        $status = array('sucesso' => false, 'mensagem' => 'Erro desconhecido.');
    } elseif ($cadastrado == 1) {
        //Usuário Certo, Senha Errada
        $status = array('sucesso' => false, 'mensagem' => 'Senha inválida!');
    } elseif ($cadastrado == 3) {
        $status = array('sucesso' => false, 'mensagem' => 'Usuário inexistente!');
    }
    $resultado = json_encode($status, JSON_FORCE_OBJECT);
    echo json_encode($resultado);
}
