(function ($) {
    'use strict';

    // page template change option

    var $template           = $( '#page_template' ),
        $pagesettingsmeta   = $('#pagesettings-meta-box'),
        $headerlayout       = $('#page_header_layout'),
        $pageopt            = $( '.page-opt' );

    // Page Template Event
    $template.on( 'change', function(){
        var $this = $(this);
        if( $this.val() == 'template-builder.php' ){
            $pagesettingsmeta.show();
        }else{
            $pagesettingsmeta.hide();
        }

    });
    // if page template builder selected
    if( $template.val() == 'template-builder.php' ){
        $pagesettingsmeta.show();
    }

    // Page header layout Event
    $headerlayout.on( 'change', function(){
        var $this = $(this);
        if( $this.val() == 'pagemeta' ){
            $pageopt.show();
        }else{
            $pageopt.hide();
        }

    });
    // if page layout selected



    if( $headerlayout.val() != 'pagemeta' ){
        $pageopt.hide();
    }


})(jQuery);