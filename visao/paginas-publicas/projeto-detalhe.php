<div class="row">
    <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
        <div class="card">
            <div class="card-block">
                <?php 
                    include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleProjeto.class.php";
                    include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

                    $cProjeto = new ControleProjeto();
                    $dados = clearArray($_GET);
                    if (!isset($dados['id']) || empty($dados['id'])) {
                        echo 'Parâmetros incorretos.';
                        return;
                    }

                    $projeto = $cProjeto->listarUm($dados['id']);
                    if ($projeto == false) {
                        echo 'Projeto não encontrado.';
                        return;
                    }

           
                ?>
                <h4 class="projeto-detalhe card-title"><?php echo $projeto->__get('titulo') ?></h4>
                <p class="card-text"><?php echo $projeto->__get('conteudo') ?></p>
            </div>
            <img class="projeto-detalhe card-img-bottom" src="<?php echo $projeto->__get('imagem') ?>" alt="Imagem da notícia">
            <div class="card-footer">
                <small class="text-muted">Fonte: <?php echo $projeto->__get('fonte') ?></small>
                
				
            </div>
        </div>
    </div>
</div>