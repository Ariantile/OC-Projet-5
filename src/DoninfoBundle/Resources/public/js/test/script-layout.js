$(function () {
    
    var $labelObjetAdd = 'Objet n° '
    
    /*
    $('#map').vectorMap({
        map: 'fr_mill',
        backgroundColor: '#F8F7FF',
        regionStyle:
            {
                initial:
                    {
                        fill: '#393A7A',
                        'fill-opacity': 1,
                        stroke: 'none',
                        'stroke-width': 0,
                        'stroke-opacity': 1
                    },

                hover:
                    {
                        fill: '#F0D887',
                        'fill-opacity': 0.8,
                        cursor: 'pointer'
                    },

                selected:
                    {
                        fill: 'yellow'
                    },
                selectedHover:
                    {
                    }
            }
    });
    */
    
/**********************************************************************************************
*********************** FORMULAIRE POSTER ANNONCE *********************************************
**********************************************************************************************/
    
    $(document).ready(function () {
        
        /**********************************************************************************************
        ***************************************** FONCTIONS  ******************************************
        **********************************************************************************************/
                
        
        /***************************************** SUPRESSION D'UN OBJET  ******************************************/
        
        function addDeleteLink($prototype) {
            // Création du lien
            var $deleteLink =$('<div class="form-group has-feedback button-container"><button id="addObjet" class="button-del form-control">Supprimer</button><i class="glyphicon glyphicon-minus form-control-feedback button-del-icon"></i></div>');

            // Ajout du lien
            $prototype.append($deleteLink);
            
            // Ajout du listener sur le clic du lien pour effectivement supprimer la catégorie
            $deleteLink.click(function(e) {
                
                if (index > 1)
                {
                    $prototype.remove();
                    index--;
                }
                
                e.preventDefault(); // évite qu'un # apparaisse dans l'URL
                return false;
            });
        }
        
        /***************************************** AJOUT D'UN OBJET  ******************************************/
        
        function addObjet($container) {
                        
            var template = $container.attr('data-prototype')
                    .replace(/__name__label__/g, $labelObjetAdd + (index + 1))
                    .replace(/__name__/g,        index),
                $prototype = $(template).addClass('blocObjet'+index+'form-post form-post-objet');
            
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
        
        var $container = $('div#doninfobundle_annonce_objetannonce'),
            index = $container.find(':input').length;
        
        /**********************************************************************************************
        ****************************************** EVENTS  ********************************************
        **********************************************************************************************/
        
        
        /***************************************** AJOUT D'UN OBJET  ******************************************/
        
        $('#addObjet').click(function (e) {
            
            if (index >= 0 && index < 9) {
                addObjet($container);
            }
            
            e.preventDefault();
            return false;
        });
        
        if (index == 0) {
            addObjet($container);
        } else {
            $container.children('div').each(function() {
                addDeleteLink($(this));
            });
        }
        
        /***************************************** SUPRESSION D'UN OBJET  ******************************************/
        
        $('#delObjet').click(function (e) {
            
            if (index > 0 && index < 10) {
                delObjet($container);
                
            }
            e.preventDefault();
            return false;
        });
        
        /******************************************** AJOUT/SUPP IMAGES  *******************************************/
        
        $('.bloc-photo').change(function() {
        
            var $idPhoto = $(this).attr('id');
        
            if ($(this).get(0).files.length === 1 && !$(this).prev().hasClass('loaded')){
            
                var $nomFichier = splitName($(this));
            
                $('div.liste-fichier > p.' + $idPhoto).text($nomFichier).addClass('loaded-text');
            
                $(this).prev().addClass('loaded');
        
            } else if ($(this).get(0).files.length === 1 && $(this).prev().hasClass('loaded')){
            
                var $replaceNomFichier = splitName($(this));
            
                $('div.liste-fichier > p.' + $idPhoto).text($replaceNomFichier);
            
            }
        
            if ($(this).get(0).files.length === 0 && $(this).prev().hasClass('loaded')){
            
                $(this).prev().removeClass('loaded');
            
                $('div.liste-fichier > p.' + $idPhoto).text('Aucune image selectionnée').removeClass('loaded-text');
            
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
