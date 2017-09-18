<?php
include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleInformacaoCurso.class.php";

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];

    $cInfoCurso = new ControleInformacaoCurso();

    $titulo = '';
    $conteudo = '';

    //mock
    if ($q == 'infoGerais') {
        $titulo = 'Informações Gerais';
        $conteudo = '<p>O Curso Superior de Tecnologia em Análise e Desenvolvimento de Sistemas tem como objetivo a formação de um profissional capaz de analisar, projetar, documentar, especificar, testar, implantar e manter sistemas computacionais de informação. Através dessas atividades busca-se desenvolver habilidades suficientes para que o profissional aplique a informática na solução de problemas organizacionais ou administrativos de diversos tipos de empresas.</p>
            <p>Ao concluir o curso, o tecnólogo terá competência para:</p>
            <ul>
                <li>Compreender os conceitos básicos da computação;</li>
                <li>Conhecer metodologias e técnicas de engenharia de software para identificação de requisitos, análise, projeto, implementação, testes, implantação e manutenção de software;</li>
                <li>Projetar e administrar banco de dados;</li>
                <li>Desenvolver sistemas computacionais para web ou desktop utilizando preceitos de qualidade de software; e
                Analisar, desenvolver e avaliar interfaces computacionais com usabilidade e acessibilidade.</li>
            </ul>
            <strong>Duração:</strong> 7 semestres</br>
            <strong>Turno:</strong> Noite';
    } elseif ($q == 'coordenacao') {
        $titulo = 'Coordenação do Curso';
        $conteudo = '<ul><li><strong>Coordenador Tiago Cinto</strong>
        <p>Área de concentração: Engenharia de Software</p>
        <p><a href="#">Currículo Lattes</a></p>
        <p>Horário de atendimento presencial: terças, das 17h às 18h</p>
        <p>Contato: <a href="mailto:coordenacao.ads@feliz.ifrs.edu.br">coordenacao.ads@feliz.ifrs.edu.br</a></p>
        </li></ul>';
    } elseif ($q == 'docentes') {
        $titulo = 'Docentes';
        $conteudo = '<ul><li><strong>Ana Paula Lemke</strong>
        <p>Área de concentração: Engenharia de Software</p>
        <p><a href="http://lattes.cnpq.br/0604467042234952">Currículo Lattes</a></p>
        <p>Contato: <a href="mailto:ana.lemke@feliz.ifrs.edu.br">ana.lemke@feliz.ifrs.edu.br</a></p>
        </li>
        <li><strong>Cecília Brasil Biguelini</strong>
        <p>Área de concentração: Estatística</p>
        <p><a href="http://lattes.cnpq.br/0295662079875789">Currículo Lattes</a></p>
        <p>Contato: <a href="mailto:cecilia.biguelini@feliz.ifrs.edu.br">cecilia.biguelini@feliz.ifrs.edu.br</a></p></li>
        <li><strong>Vinicius Hartmann Ferreira</strong>
        <p>Área de concentração: Programação</p>
        <p><a href="http://lattes.cnpq.br/8839352605511604">Currículo Lattes</a></p>
        <p>Contato: <a href="mailto:vinicius.ferreira@feliz.ifrs.edu.br">vinicius.ferreira@feliz.ifrs.edu.br</a></p></li';
    } elseif ($q == 'gruposPesquisa') {
        $titulo = 'Grupos de Pesquisa';
        $conteudo = '<p>Os professores que ministram componentes curriculares no curso ADS participam de diversos grupos de pesquisa, entre eles:</p>
        <ul><li><a href="http://dgp.cnpq.br/dgp/espelhogrupo/6324317869152542">Práticas de Ensino e Análises Educacionais</a></li>
        <li><a href="http://dgp.cnpq.br/dgp/espelhogrupo/8793964384755538">Engenharia de Software e Sistemas Autônomos</a></li></ul>';
    } elseif ($q == 'horariosAula') {
        $titulo = 'Horários de Aula';
        $conteudo = '<p>Os horários de aula estão disponíveis no site do IFRS-Campus Feliz, menu Ensino, submenu Horários de Aula.</p>
        Clique <a href="http://moodle.feliz.ifrs.edu.br/horarios/arquivos/turmas.html">aqui</a> para acessar.';
    } elseif ($q == 'FAQ') {
        $titulo = 'Perguntas Frequentes';
        $conteudo = '<p><ol><li><strong>Como faço para ingressar no curso?</strong>
        <p>Resposta: é necessário participar de um processo seletivo ou o ingresso pode ser via ENEM. O processo seletivo geralmente é divulgado em meados de setembro.</p>
        </li></ol>';
    }
    //

?>
    <div>
        <h4 class="noticia-detalhe card-title text-center"><?php echo $titulo ?></h4>
        <p class="card-text"><?php echo $conteudo ?></p>
    </div>

<?php } ?>
