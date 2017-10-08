<?php

include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleInformacaoDoCurso.class.php";

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $chave = $_GET['q'];

    $cInfoCurso = new ControleInformacaoDoCurso();

    $informacaoCurso = $cInfoCurso->listarPorChave($chave);

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
        echo 'Não foram incontradas informações.';
    } 
}
?>