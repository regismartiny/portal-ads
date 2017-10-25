<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleInformacaoDoCurso.class.php";

    $cInfoCurso = new ControleInformacaoDoCurso();

    $informacaoCurso = $cInfoCurso->listarPorChave('DISCENTES_E_EGRESSOS');

    if (!empty($informacaoCurso)) {
        $titulo = $informacaoCurso->getTitulo();
        $conteudo = $informacaoCurso->getConteudo();
?>
    <div>
        <h2 class="titulo"><?php echo $titulo ?></h2>
        <p><?php echo $conteudo ?></p>
    </div>
<?php 
    } else {
        echo 'Não foram encontradas informações.';
    } 
?>