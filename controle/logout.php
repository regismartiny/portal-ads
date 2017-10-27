<?php
    session_start();

    $_SESSION = array();

    // Se é preciso matar a sessão, então os cookies de sessão também devem ser apagados.
    // Nota: Isto destruirá a sessão, e não apenas os dados!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    // Fazendo redirecionamento por Javascript, por php não limpa o cache
    echo "<script>window.location = '/visao/index.php'</script>";
    //header( 'Location: /visao/index.php' );
?>