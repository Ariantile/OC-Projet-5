$(function () {
 
/**********************************************************************************************
*********************** FORMULAIRE CONTACT MEMBRE *********************************************
**********************************************************************************************/
    
    $(document).ready(function () {
        
        if ($('#doninfobundle_contactmembre_sujet').length) {
            
            $('#doninfobundle_contactmembre_sujet').change(function () {
                
                if (($('#doninfobundle_contactmembre_sujet').val() === 'annonce') &&
                    ($('#input-annonce').hasClass('hide-contact'))) {
                    
                    $('#input-annonce').removeClass('hide-contact');
                    
                } else if (($('#doninfobundle_contactmembre_sujet').val() !== 'annonce')) {
                    
                    $('#input-annonce').addClass('hide-contact');
                    
                }
                
            });
        }
    });
});
