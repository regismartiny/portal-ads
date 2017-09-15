<?php
    //mock
    $titulo = 'Discentes e Egressos';
    $conteudo = '<p>Alunos matriculados no curso ADS (em setembro de 2017):</p>
        <ul>
            <li><strong>Jackson Müller dos Santos</strong></li>
            <li><strong>Maicon Dewes</strong></li>
            <li><strong>Régis Martiny</strong></li>
            <li><strong>Ricardo Luiz Gomes</strong></li>
        </ul>
        <p>Formados no curso ADS:</p>
        <ul>
            <li><strong>Não há formandos até o momento. Previsão de primeira formatura em 2018/1.</strong></li>
        </ul>';
    //
?>
<div>
    <h4 class="noticia-detalhe card-title text-center"><?php echo $titulo ?></h4>
    <p class="card-text"><?php echo $conteudo ?></p>
</div>
