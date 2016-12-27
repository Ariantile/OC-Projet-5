$(function () {
  
/**********************************************************************************************
*********************** FORMULAIRE POSTER ANNONCE *********************************************
**********************************************************************************************/
    
    $(document).ready(function () {
         
        /**********************************************************************************************
        ***************************************** VARIABLES  ******************************************
        **********************************************************************************************/
        
        var $containerImage = $('div#doninfobundle_annonce_images'),
            indexImage = $containerImage.find(':input.inp-file').length,
            $container = $('div#doninfobundle_annonce_objets'),
            index = $container.find('input[type="number"]').length,
            $objload = $container.find('div').length;
        
        /**********************************************************************************************
        ***************************************** FONCTIONS  ******************************************
        **********************************************************************************************/
        
        /*********************************** AJOUT D'UN BLOC IMAGE  **********************************/
        
        function addImage($containerImage) {
            
            var template = $containerImage.attr('data-prototype')
                    .replace(/__name__label__/g, 'Photo')
                    .replace(/__name__/g,        indexImage),
                $prototype = $(template);
            
            $containerImage.append($prototype);
            
            indexImage++;
            
        }
        
        /***************************************** SUPRESSION D'UN OBJET  ******************************************/
        
        function addDeleteLink($prototype) {
            
            var $deleteLink = $('<div class="button-container-del"><button id="delObjet" class="button-del"><i class="glyphicon glyphicon-remove"></i></button></div>');
            
            $prototype.append($deleteLink);
            
            $deleteLink.click(function (e) {
                
                if (index > 1 && $objload === 0) {
                    
                    $prototype.remove();
                    index--;
                    
                } else if ($objload > 0) {
                    $prototype.remove();
                    index--;
                }
                
                e.preventDefault();
                return false;
            });
        }
        
        /***************************************** AJOUT D'UN OBJET  ******************************************/
        
        function addObjet($container) {
                        
            var template = $container.attr('data-prototype')
                    .replace(/__name__label__/g, 'Type de matériel')
                    .replace(/__name__/g,        index),
                $prototype = $(template).addClass('blocObjet' + index + '');
            
            addDeleteLink($prototype);
            
            $container.append($prototype);
            index++;
            
        }
        
        /***************************************** SPLIT NOM FICHIER  ******************************************/
        
        function splitName($fichier) {
        
            var $fileNameSplit = $fichier.val().split('\\'),
                $fileName = $fileNameSplit[$fileNameSplit.length - 1];
        
            return $fileName;
        }
        
        /**********************************************************************************************
        ****************************************** EVENTS  ********************************************
        **********************************************************************************************/
        
        /********************************** AJOUT DES 3 BLOCS IMAGE  *****************************************/
        
        if ((indexImage === 0) && ($('div#doninfobundle_annonce_images').length)) 
        {
            for (var i = 0; i <= 2; i++)
            {
                addImage($containerImage);
            }
        } else if ( indexImage > 0 ) {
            
            
            for (var i = indexImage; i <= 2; i++)
            {
                addImage($containerImage);
            }
            
        }
        
        /********************************** AJOUT DE CLASS SUR CHECKBOX  *****************************************/
        
        $('div.sous-bloc-objet').each(function() {
            if ( $(this).find('div').length > 4 ) {
                $(this).children('div').last().addClass('del-item');
            }
        })
        
        $('div.sous-container-img').each(function() {
            console.log($(this).length);
            if ( $(this).find('div').length > 1 ) {
                $(this).children('div').last().addClass('del-img');
            }
        })
        
        $('.checkbox-item').change(function() {
            if ($(this).is(":checked")) {
                $(this).parent().parent().parent().addClass('del-item-on');
            } else if (!$(this).is(":checked") && $(this).parent().parent().parent().hasClass('del-item-on')) {
                $(this).parent().parent().parent().removeClass('del-item-on');
            }
        })
        
        $('.checkbox-img').change(function() {
            if ($(this).is(":checked")) {
                $(this).parent().parent().parent().addClass('del-item-on');
            } else if (!$(this).is(":checked") && $(this).parent().parent().parent().hasClass('del-item-on')) {
                $(this).parent().parent().parent().removeClass('del-item-on');
            }
        })
        
        /***************************************** AJOUT D'UN OBJET  ******************************************/
        
        $('#addObjet').click(function (e) {
            
            if (index >= 0 && index < 9) {
                addObjet($container);
            }
            
            e.preventDefault();
            return false;
        });
        
        if (index == 0 && $('#addObjet').length && $objload == 0) {
            addObjet($container);
        }
        
        /******************************************** AJOUT/SUPP IMAGES  *******************************************/
        
        $('input[type="file"]').change(function() {
        
            var $idPhoto = $(this).attr('id');
        
            if ($(this).get(0).files.length === 1 && !$(this).prev().hasClass('loaded')){
            
                var $nomFichier = splitName($(this));
            
                $('div.liste-fichier > p.' + $idPhoto).text($nomFichier).addClass('loaded-text');
                
                $('label[for=' + $(this).attr('id') + ']').addClass('loaded');
                        
            } else if ($(this).get(0).files.length === 1 && $(this).prev().hasClass('loaded')){
            
                var $replaceNomFichier = splitName($(this));
            
                $('div.liste-fichier > p.' + $idPhoto).text($replaceNomFichier);
            
            }
        
            if ($(this).get(0).files.length === 0 && $(this).prev().hasClass('loaded')){
            
                $('label[for=' + $(this).attr('id') + ']').removeClass('loaded');
                
                $('div.liste-fichier > p.' + $idPhoto).text('Aucune image selectionnée').removeClass('loaded-text');
            
            }
            
        });
        
        /******************************************** TYPE D'ADRESSE  *******************************************/
        
        $('#doninfobundle_annonce_choixadresse').change(function() {
            
            if ( $(this).val() === '1') {
                
                $('.adresse-input').text($('.adresse-val').text());
                $('.ville-input').text($('.ville-val').text());
                $('.codepostal-input').val($('.codepostal-val').text());
                
                $('div.bloc-adresse > div > input').attr('readonly', true);
            } 
            
                
            if ( $(this).val() === '0') {
                
                $('div.bloc-adresse > div > input').attr('readonly', false);
                
            }   
        });
        
    /**********************************************************************************************
    ***************************************** DATEPICKER  *****************************************
    **********************************************************************************************/
        
        $.datepicker.regional['fr'] = {
		  closeText: 'Fermer',
		  prevText: '&#x3c;Préc',
		  nextText: 'Suiv&#x3e;',
		  monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
		  'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
            monthNamesShort: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
		  'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
		  dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		  dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		  dayNamesMin: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		  weekHeader: 'Sm',
		  dateFormat: 'dd-mm-yy',
		  firstDay: 1,
		  isRTL: false,
		  showMonthAfterYear: false,
		  yearSuffix: '',
        };
    
        $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
    
        $('.datelimite').datepicker({
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            minDate: 0,
            changeYear: true,
            changeMonth: true,
            yearRange: ':+10'
        });
    });
});
