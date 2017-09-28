document.addEventListener("DOMContentLoaded", function(event) {
    console.log('pagina principal carregada');
    //////////////////////////////Controle de navegação de páginas//////////////////////////

    //Quando clicado em algum link, guarda na barra de endereços o caminho e carrega a página dentro da div conteudo
    $('body').delegate('a', 'click', function() {
        let attr = $(this).attr('href')
        if (attr.startsWith('/')) {
            window.location.hash = attr;
            return false;
        }
        return true;
    });

    window.onhashchange = function() {
        carregaPagina();
    };
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
    //////////////////////////////////////////////////////////////////////////////////////
    //carrega página indicada na barra de endereços dentro da div conteudo
    carregaPagina();
});

function carregaPagina() {
    let newHash = window.location.hash.substr(1);
    //carrega a página inicial, se não houver página definida na barra de endereços
    newHash = newHash === '' ? '/visao/paginas-publicas/home.php' : newHash;
    $('.loader').fadeIn(100);
    $('#conteudo').load(newHash, function() {
        $('.loader').fadeOut(100);
        console.log('Página carregada: ' + newHash);
    });
}

function isMenuExpandido() {
    return $('#navbar-toggler').attr('aria-expanded') === 'true';
}

function toggleMenu() {
    return $('.collapse').collapse('toggle');
}