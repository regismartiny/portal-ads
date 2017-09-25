$(document).ready(function() {
    //////////////////////////////Controle de navegação de páginas//////////////////////////
    var newHash = '';

	//Quando clicado em algum link, guarda na barra de endereços o caminho para onde ir
    $('body').delegate('a', 'click', function() {
        let attr = $(this).attr('href')
        if (attr.startsWith('/')) {
            window.location.hash = attr;
            return false;
        }
        return true;
    });

    //Quando o caminho na barra de endereços muda, carrega o arquivo dentro da div container-conteudo
    $(window).on('hashchange', function() {
        newHash = window.location.hash.substr(1);
        $('.loader').fadeIn(100);
        $('#conteudo').load(newHash, function() {
            $('.loader').fadeOut(100);
            console.log('Página carregada: ' + newHash);
        });
    });
    ///////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////Controle do menu/////////////////////////////////////////
    $('.dropdown-item').click(function() {
        if (isMenuExpandido()) {
            toggleMenu();
        }
        $('.dropdown-item').removeClass('active');
        $(this).addClass('active');
    });
    $('.nav-item').click(function() {
        let isDropDown = $(this).hasClass('dropdown');
        if (isMenuExpandido() && !isDropDown) {
            toggleMenu();
        }
        $('.nav-item').removeClass('active');
        $(this).addClass('active');
    });
});

function isMenuExpandido() {
    return $('#navbar-toggler').attr('aria-expanded') === 'true';
}

function toggleMenu() {
    return $('.collapse').collapse('toggle');
}