INSERT INTO TipoUsuario VALUES (1,'Coordenador');

INSERT INTO TipoUsuario VALUES (2,'Professor');

INSERT INTO TipoUsuario VALUES (3,'Aluno');


INSERT INTO CategoriaNoticia (descricao, cor)
VALUES ('Carreira', '#FFFF00');

INSERT INTO CategoriaNoticia (descricao, cor)
VALUES ('Tecnologia', '#FF0000');

INSERT INTO CategoriaNoticia (descricao, cor)
VALUES ('Hardware', '#8B4513');

INSERT INTO CategoriaNoticia (descricao, cor)
VALUES ('Software', '#0000FF');

INSERT INTO CategoriaNoticia (descricao, cor)
VALUES ('Tendência', '#00FF00');


INSERT INTO Usuario VALUES (1,1,'testeCoordenador','emailtesteportalads1@gmail.com','21232f297a57a5a743894a0e4a801fc3',1,1);

INSERT INTO Usuario VALUES (2,7777777,'testeProfessor','emailtesteportalads2@gmail.com','25f9e794323b453885f5181f1b624d0b',1,2);

INSERT INTO Usuario VALUES (3,121212121212,'testeAluno','emailtesteportalads3@gmail.com','25f9e794323b453885f5181f1b624d0b',1,3);

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('INFORMACOES_GERAIS', 'Informações Gerais', '<p>O Curso Superior de Tecnologia em Análise e Desenvolvimento de Sistemas tem como objetivo a formação de um profissional capaz de analisar, projetar, documentar, especificar, testar, implantar e manter sistemas computacionais de informação. Através dessas atividades busca-se desenvolver habilidades suficientes para que o profissional aplique a informática na solução de problemas organizacionais ou administrativos de diversos tipos de empresas.</p>
            <p>Ao concluir o curso, o tecnólogo terá competência para:</p>
            <ul>
                <li>Compreender os conceitos básicos da computação;</li>
                <li>Conhecer metodologias e técnicas de engenharia de software para identificação de requisitos, análise, projeto, implementação, testes, implantação e manutenção de software;</li>
                <li>Projetar e administrar banco de dados;</li>
                <li>Desenvolver sistemas computacionais para web ou desktop utilizando preceitos de qualidade de software; e
                Analisar, desenvolver e avaliar interfaces computacionais com usabilidade e acessibilidade.</li>
            </ul>
            <strong>Duração:</strong> 7 semestres</br>
            <strong>Turno:</strong> Noite');

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('COORDENACAO', 'Coordenação do Curso', '<ul><li><strong>Professor Tiago Cinto</strong>
            <p>Área de concentração: Engenharia de Software</p>
            <p><a href="http://lattes.cnpq.br/3206039376378317">Currículo Lattes</a></p>
            <p>Horário de atendimento presencial: terças, das 17h às 18h</p>
            <p>Contato: <a href="mailto:ads@feliz.ifrs.edu.br">coordenacao.ads@feliz.ifrs.edu.br</a></p>
            </li></ul>');

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('DOCENTES', 'Docentes', '<ul><li><strong>Ana Paula Lemke</strong>
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
            <p>Contato: <a href="mailto:vinicius.ferreira@feliz.ifrs.edu.br">vinicius.ferreira@feliz.ifrs.edu.br</a></p></li>');

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('GRUPOS_PESQUISA', 'Grupos de Pesquisa', '<p>Os professores que ministram componentes curriculares no curso ADS participam de diversos grupos de pesquisa, entre eles:</p>
        <ul><li><a href="http://dgp.cnpq.br/dgp/espelhogrupo/6324317869152542">Práticas de Ensino e Análises Educacionais</a></li>
        <li><a href="http://dgp.cnpq.br/dgp/espelhogrupo/8793964384755538">Engenharia de Software e Sistemas Autônomos</a></li></ul>');

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('HORARIOS_AULA', 'Horários de Aula', '<p>Os horários de aula estão disponíveis no site do IFRS-Campus Feliz, menu Ensino, submenu Horários de Aula.</p>
        Clique <a href="http://moodle.feliz.ifrs.edu.br/horarios/arquivos/turmas.html">aqui</a> para acessar.');

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('FAQ', 'Perguntas Frequentes', '<p><ol><li><strong>Como faço para ingressar no curso?</strong>
        <p>Resposta: é necessário participar de um processo seletivo ou o ingresso pode ser via ENEM. O processo seletivo geralmente é divulgado em meados de setembro.</p>
        </li></ol>');

INSERT INTO InformacaoDoCurso (chave, titulo, conteudo)
VALUES ('DISCENTES_E_EGRESSOS', 'Discentes e Egressos', '<p>Alunos matriculados no curso ADS (em setembro de 2017):</p>
        <ul>
            <li><strong>Jackson Müller dos Santos</strong></li>
            <li><strong>Maicon Dewes</strong></li>
            <li><strong>Régis Martiny</strong></li>
            <li><strong>Ricardo Luiz Gomes</strong></li>
        </ul>
        <p>Formados no curso ADS:</p>
        <ul>
            <li><strong>Não há formandos até o momento. Previsão de primeira formatura em 2018/1.</strong></li>
        </ul>');
