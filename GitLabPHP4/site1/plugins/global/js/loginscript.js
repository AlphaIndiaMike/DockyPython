   $(document).ready(function() {
   $("#start_login").fancybox({
                'titlePosition'        : 'inside',
                'transitionIn'        : 'none',
                'transitionOut'        : 'none'
            });
            
   $("#schimba_parola").fancybox({
                'titlePosition'        : 'inside',
                'transitionIn'        : 'none',
                'transitionOut'        : 'none'
            });
            
   $("#editeaza").fancybox({
                    'width'                : 650,
                'height'            : 520,
                'autoScale'            : false,
                'transitionIn'        : 'none',
                'transitionOut'        : 'none',
                'type'                : 'iframe',
                'onClosed'            :  function() {window.location.reload();}
            });
   });   
   
  
