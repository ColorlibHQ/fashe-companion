(function ($) {
    'use strict';

    // page template change option

    var $template = $( '#page_template' ),
        $pagesettingsmeta = $('#pagesettings-meta-box');

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


})(jQuery);