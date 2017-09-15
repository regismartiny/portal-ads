$(document).ready(function() {
    //////////////////////////////Controle de navegação de páginas//////////////////////////
    var newHash = '',
        $conteudoCentral = $('#container-conteudo');

    $('body').delegate('a', 'click', function() {
        let attr = $(this).attr('href')
        if (attr.startsWith('/')) {
            window.location.hash = attr;
            return false;
        }
        return true;
    });

    // Not all browsers support hashchange
    // For older browser support: http://benalman.com/projects/jquery-hashchange-plugin/
    $(window).on('hashchange', function() {
        newHash = window.location.hash.substr(1);
        $conteudoCentral.load('/visao' + newHash, function() {
            console.log('Página carregada: ' + newHash);
        });
    });
    ///////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////Controle do menu/////////////////////////////////////////
    $('.nav-item').click(function() {
        let menuExpandido = $('#navbar-toggler').attr('aria-expanded') === 'true';
        if (menuExpandido) {
            //fecha menu ao clicar
            $('.collapse').collapse('toggle');
        }
        $('.nav-item').removeClass('active');
        $(this).addClass('active');
    });
});