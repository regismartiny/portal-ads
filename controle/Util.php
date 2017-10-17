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

function resumir($texto, $quantCaracteres) {
  $resumo = $texto;
  if (strlen($resumo) > $quantCaracteres) {
    $resumo = preg_replace('/\s+?(\S+)?$/', '', mb_substr($texto, 0, $quantCaracteres-1));
  }
  //adiciona 3 pontinhos se último caractere não for ponto
  $ultimoCaractere = substr($resumo, strlen($resumo)-1, strlen($resumo));
  if ($ultimoCaractere !== '.') {
      $resumo = $resumo . '...';
  }
  return $resumo;
}

?>