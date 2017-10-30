<div class="row">
    <div class="col-12 mx-auto">
        <h2 class="titulo">Projetos</h2>
        <div class="row row-grid">
            <?php 
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleProjeto.class.php";
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

                $cProjeto = new ControleProjeto();
                $pagina = 1;
                //
                //falta implementar paginador no front
                //
                $projetos = $cProjeto->listarPaginado($pagina, 10);
                
                if ($projetos == false) {
                    echo "Nenhum projeto encontrado.";
                    return;
                }
                
                foreach($projetos as $projeto) {
                    $resumo = resumir($projeto->conteudo, 230);
            ?>
                    <div class="col-sm-12 <?php echo (count($projetos) > 1 ? 'col-md-6' : 'col-md-8 mx-auto') ?>">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $projeto->imagem ?>" alt="Imagem">
                            <div class="card-block">
                                <h4 class="card-title"><?php echo $projeto->titulo ?></h4>
                                <p class="card-text"><?php echo $resumo ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Data de publicação: <?php echo date("d/m/Y", strtotime($projeto->dataPublicacao)) ?></small>
                                <span class="see-more"><a href="/visao/paginas-publicas/projeto-detalhe.php?id=<?php echo $projeto->id ?>" title="Ver mais">+</a></span>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>