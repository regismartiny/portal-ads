<?php
    $db_host = getenv('MYSQL_HOST') !== false ? getenv('MYSQL_HOST') : 'localhost';
    $db_user = getenv('MYSQL_USER') !== false ? getenv('MYSQL_USER') : 'root';
    $db_pass = getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : '';
    $db_database = getenv('MYSQL_DATABASE') !== false ? getenv('MYSQL_DATABASE') : 'portal-ads';
    $db_port = getenv('MYSQL_PORT') !== false ? getenv('MYSQL_PORT') : 3306;
    define("HOST", $db_host);
    define("USUARIO", $db_user);
    define("SENHA", $db_pass);
    define("BANCO", $db_database);
    define("PORTA", $db_port);
?>
