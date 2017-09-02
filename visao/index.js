$(document).ready(function() {
    var newHash = '',
        $mainContent = $('#container-conteudo');

    $('nav').delegate('a', 'click', function() {
        window.location.hash = $(this).attr('href');
        return false;
    });

    // Not all browsers support hashchange
    // For older browser support: http://benalman.com/projects/jquery-hashchange-plugin/
    $(window).on('hashchange', function() {
        newHash = window.location.hash.substr(1);
        $mainContent.load('/portal-ads/visao' + newHash, function() {
            $mainContent.trigger('create');
            console.log('content loaded');
        });
    });
});