<?php

function clearArray($array) {
  foreach($array as $chave => $valor) {
    $valor = trim($valor);  //remove espaços em branco
    $valor = stripslashes($valor); //remove barras
    $valor = htmlspecialchars($valor); //remove caracteres especiais html
    $data[$chave] = $valor;
  }
  return $array;
}

?>