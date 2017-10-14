<div class="row">
    <div class="col-12 mx-auto">
        <h2 class="titulo">Notícias</h2>
        <div class="row row-grid">
            <?php 
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";

                $cNoticia = new ControleNoticia();
                $pagina = 1;
                //
                //falta implementar paginador no front
                //
                $noticias = $cNoticia->listarPaginado($pagina, 10);
                
                if ($noticias == false) {
                    echo "Nenhum notícia encontrada.";
                    return;
                }
                
                foreach($noticias as $noticia) {
            ?>
                    <div class="col-sm-12 <?php echo (count($noticias) > 1 ? 'col-md-6' : 'col-md-8 mx-auto') ?>">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $noticia->__get('imagem') ?>" alt="Imagem">
                            <div class="card-block">
                                <h4 class="card-title"><?php echo $noticia->__get('titulo') ?></h4>
                                <p class="card-text"><?php echo $noticia->__get('conteudo') ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Data de publicação: <?php echo date("d/m/Y", strtotime($noticia->__get('dataPublicacao'))) ?></small>
                                <span class="see-more"><a href="/visao/paginas-publicas/noticia-detalhe.php?id=<?php echo $noticia->__get('id') ?>" title="Ver mais">+</a></span>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>