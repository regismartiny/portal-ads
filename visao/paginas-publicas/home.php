<div class="row">
    <div class="col-12 mx-auto">
        <h2 class="titulo">Notícias</h2>
        <div class="row row-grid">
            <?php 
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

                $cNoticia = new ControleNoticia();
                $pagina = 1;
                //
                //falta implementar paginador no front
                //
                $noticias = $cNoticia->listarPaginado($pagina, 10);
                
                if ($noticias == false) {
                    echo "Nenhuma notícia encontrada.";
                    return;
                }
                
                foreach($noticias as $noticia) {
                    $resumo = resumir($noticia->conteudo, 230);
            ?>
                    <div class="col-sm-12 <?php echo (count($noticias) > 1 ? 'col-md-6' : 'col-md-8 mx-auto') ?>">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $noticia->imagem ?>" alt="Imagem">
                            <div class="card-block">
                                <h4 class="card-title"><?php echo $noticia->titulo ?></h4>
                                <p class="card-text"><?php echo $resumo ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Data de publicação: <?php echo date("d/m/Y", strtotime($noticia->dataPublicacao)) ?></small>
                                <span class="see-more"><a href="/visao/paginas-publicas/noticia-detalhe.php?id=<?php echo $noticia->id ?>" title="Ver mais">+</a></span>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
        <hr class="separador-h"/>
        <h2 class="titulo">Eventos</h2>
        <div class="row row-grid">
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="https://even3.azureedge.net/logos/logoseminario.bb84f621ea7447b48ba0.jpg" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title">I Seminário de Humanidades na Educação - GRE Metropolitana Sul</h4>
                        <p class="card-text">É uma proposta de diálogo interdisciplinar na Área das Ciências Humanas e suas Tecnologias. Os diversos componentes curriculares (História, Geografia, Filosofia, Sociologia).</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Data de publicação: 05/10/2017</small>
                        <span class="see-more"><a href="/visao/paginas-publicas/evento-detalhe.php?id=1" title="Ver mais">+</a></span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img class="card-img-top" src="https://even3.azureedge.net/logos/Logo_evento_3.c49d67def27b47d49a42.jpg" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title">IV SEMINÁRIO INSTITUCIONAL DO PIBID. III SEMANA ACADÊMICA DA LICENCIATURA EM QUÍMICA. II SEMANA ACADÊMICA DA LICENCIATURA EM PEDAGOGIA</h4>
                        <p class="card-text">-IV SEMINÁRIO INSTITUCIONAL DO PIBID -III SEMANA ACADÊMICA DA LICENCIATURA EM QUÍMICA	-II SEMANA ACADÊMICA DA LICENCIATURA EM PEDAGOGIA.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Data de publicação: 05/10/2017</small>
                        <span class="see-more"><a href="/visao/paginas-publicas/evento-detalhe.php?id=2" title="Ver mais">+</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>