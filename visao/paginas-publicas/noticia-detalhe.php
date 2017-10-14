<div class="row">
    <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
        <div class="card">
            <div class="card-block">
                <?php 
                    include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
                    include_once $_SERVER['DOCUMENT_ROOT']."/modelo/CategoriaNoticia.class.php";
                    include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

                    $cNoticia = new ControleNoticia();
                    $dados = clearArray($_GET);
                    if (!isset($dados['id']) || empty($dados['id'])) {
                        echo 'Parâmetros incorretos.';
                        return;
                    }

                    $noticia = $cNoticia->listarUm($dados['id']);
                    if ($noticia == false) {
                        echo 'Notícia não encontrada.';
                        return;
                    }

                    $categoria = new CategoriaNoticia($noticia->__get('categoriaNoticia_id'));
                    $categoria = $categoria->listarUm();
                    if ($categoria == false) {
                        echo 'Categoria de Notícia não encontrada.';
                        return;
                    }
                    $categoria = $categoria->getDescricao();
                ?>
                <h4 class="noticia-detalhe card-title"><?php echo $noticia->__get('titulo') ?></h4>
                <p class="card-text"><?php echo $noticia->__get('conteudo') ?></p>
            </div>
            <img class="noticia-detalhe card-img-bottom" src="<?php echo $noticia->__get('imagem') ?>" alt="Imagem da notícia">
            <div class="card-footer">
                <small class="text-muted">Fonte: <?php echo $noticia->__get('fonte') ?></small>
                <div><small class="text-muted">Categoria: <?php echo $categoria ?></small></div>
                <div><small class="text-muted">Data de publicação: <?php echo date("d/m/Y", strtotime($noticia->__get('dataPublicacao'))) ?></small></div>
            </div>
        </div>
    </div>
</div>