<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Portal ADS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/visao/index.css">
</head>

<body>
    <div id="topo" class="contaner-fluid fixed-top">
        <div id="inf-topo" class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-7 col-xl-8">
                <img src="/visao/img/logo.jpg" id="logo">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-5 col-xl-4">
					<div class="form-group row">
                        <h1 class="col-sm-12 col-form-label">Home do Professor</h1>
                    </div>
		
			   <span class="curso">
						Curso de Análise e Desenvolvimento de Sistemas
						<br>
                        <?php 
                        if(!empty($_SESSION)){
                            echo $_SESSION["nomeUsuario"];
                        }
						?>
						<form method="post" action="/controle/logout.php">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="botao" value="LogOut">
                </form>
				</span>
				
            </div>
        </div>
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="toggle-button-menu">
                        <button id="navbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="inf-topo-menu mr-auto">
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-6 col-xl-7">
                            <img src="img/logo.jpg" id="logo">
                        </div>
                    </div>
                    <div class="inf-topo-menu col-12">
                        <small class="curso"> Curso de Análise e Desenvolvimento de Sistemas</small>
					</div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav nav-fill w-100 align-items-start">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                O Curso
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/paginas-publicas/oCurso.php?q=infoGerais">Informações gerais</a>
                                    <a class="dropdown-item" href="/paginas-publicas/oCurso.php?q=coordenacao">Coordenação do curso</a>
                                    <a class="dropdown-item" href="/paginas-publicas/oCurso.php?q=docentes">Docentes</a>
                                    <a class="dropdown-item" href="/paginas-publicas/oCurso.php?q=gruposPesquisa">Grupos de Pesquisa</a>
                                    <a class="dropdown-item" href="/paginas-publicas/oCurso.php?q=horariosAula">Horários de Aula</a>
                                    <a class="dropdown-item" href="/paginas-publicas/oCurso.php?q=FAQ">Perguntas Frequentes</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/paginas-publicas/portfolioDeProjetos.html">Portfólio de Projetos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="/paginas-publicas/discentesEEgressos.php">Discentes e Egressos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/paginas-publicas/noticias.php">Notícias</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="/paginas-publicas/eventos.html">Eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/paginas-publicas/contato.php">Contato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/paginas-publicas/mapa.html">Mapa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/paginas-publicas/restrito.php">Restrito</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="container" id="container-conteudo">

    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <p>Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul - Campus Feliz</p>
                    <p>Rua Princesa Isabel, 60 | Bairro Vila Rica | CEP: 95770-000 | Feliz - RS | Tel. 51 3637-4400</p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <p>Desenvolvido por ...</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
    <script src="/visao/index.js"></script>
</body>

</html>