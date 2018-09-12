(function ($) {
    'use strict';

    //  Portfolio load more button Ajax
    
    var $loadbutton = $( '.loadAjax' );
    if( $loadbutton.length ){
        
        // When default max pages 1 remove load more button 
        if( portfolioloadajax.max_pages == 1 ){
            $loadbutton.remove();
        }
        //
        $loadbutton.on( 'click', function(){
            
            var $button = $( this ),
                $data;
           
            $data =  {
                'action' : 'fashe_load_ajax',
                'query'  : portfolioloadajax.posts,
                'page'   : portfolioloadajax.current_page,
                'postNumber'   : portfolioloadajax.postNumber
            };
           
            $.ajax({
                
                url  : portfolioloadajax.action_url,
                data : $data,
                type : 'POST',
                beforeSend : function( xhr ){
                    
                    $button.text( portfolioloadajax.btnLodingLabel );
                    
                },
                success: function( data ){

                    var $dataload = $('.dataload'),
                        $portfolioItems = $dataload.parent('.fashe-portfolio');
                    if( data ) {
                        // insert new posts
                        $dataload.before(data);
                        // increment page
                        portfolioloadajax.current_page++;
                        
                        if ( $portfolioItems.length ) {
                            setTimeout(function () {
                                $portfolioItems.isotope('reloadItems').isotope({
                                    animationEngine: 'best-available',
                                    itemSelector: '.single_gallery_item'
                                });
                            }, 300);
                        }
                        
                        
                        // Change Button text From loading
                        $button.text( portfolioloadajax.btnLabel ); 
                        
                        // if last page, remove the button                          
                        if ( portfolioloadajax.current_page == portfolioloadajax.max_pages ){
                            $button.remove(); 
                        } 
                        
                    } else {
                        // if no data, remove the button as well
                        $button.remove(); 
                    }
                        
                }
                
            });
            
            return false;   
            
        } );
        
        
    }


})(jQuery);