<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleInformacaoDoCurso.class.php";

    $cInfoCurso = new ControleInformacaoDoCurso();

    $informacaoCurso = $cInfoCurso->listarPorChave('DISCENTES_E_EGRESSOS');

    if (!empty($informacaoCurso)) {
        $titulo = $informacaoCurso->getTitulo();
        $conteudo = $informacaoCurso->getConteudo();
?>
    <div>
        <h4 class="noticia-detalhe card-title text-center"><?php echo $titulo ?></h4>
        <p class="card-text"><?php echo $conteudo ?></p>
    </div>
<?php 
    } else {
        echo 'Não foram incontradas informações.';
    } 
?>