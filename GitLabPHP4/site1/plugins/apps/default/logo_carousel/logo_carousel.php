<?php 
function logo_carousel($File, &$header, $width=1000, $height=120){
//Header section of page
    $header.='
    <style type="text/css">	
			#ui-carousel-next, #ui-carousel-prev {
				width: 60px;
				height: 100px;
				background: url('.absolute_path().'plugins/ext/logo_carousel/images/control_right.png) #fff left center no-repeat;
				display: block;
                cursor:pointer;
			}

			#ui-carousel-next {
				background-image: url('.absolute_path().'plugins/ext/logo_carousel/images/control_left.png);
                
			}

			#ui-carousel-prev {
                background-position:right;
			}
			
			#ui-carousel-next > span, #ui-carousel-prev > span {
				display: none;
			}	
    </style>
    <link rel="stylesheet" href="'.absolute_path().'plugins/ext/logo_carousel/css/rcarousel.css" type="text/css" media="screen" />
    <script type="text/javascript" src="'.absolute_path().'plugins/ext/logo_carousel/lib/jquery.ui.core.js"></script>
    <script type="text/javascript" src="'.absolute_path().'plugins/ext/logo_carousel/lib/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="'.absolute_path().'plugins/ext/logo_carousel/lib/jquery.ui.rcarousel.js"></script>
    <script type="text/javascript">
    //<![CDATA[ 
    		jQuery(function($){
				$("#logo_carousel").rcarousel({
					visible: 7,
					step: 1,
                    margin: 30,
					auto: {
						enabled: true,
						interval: 2000,
						direction: "prev"
					}
				});
				
				$("#ui-carousel-next")
					.add("#ui-carousel-prev" )
					.hover(
						function(){
							$(this).css("opacity", 0.7 );
						},
						function(){
							$( this ).css("opacity", 1.0 );
						}
					);				
			});
    //]]>
    </script>
';
//Body of the page
$body='';
    $body.='
    <div style="width:'.$width.'px; padding-left:60px; margin-top:20px;">
        <p class="carousel_title">'.read_content($File,"[<logo_carousel_title>]","[</logo_carousel_title>]").'</p>
    </div>
    <div style="width:'.$width.'px; height:'.$height.'px; margin-top:20px;" id="container-carousel">
                <div style="float:left; display:inline; width:60px;"> 
                    <a id="ui-carousel-next"><span>next</span></a>
                </div>
				<div style="float:left; display:inline; width:'.($width-60).'px;" id="logo_carousel">
                    '.str_replace('src="','src="'.absolute_path(),read_content($File,"[<logo_carousel>]","[</logo_carousel>]")).'
				</div>
                <div style="float:left; display:inline; width:60px;"> 
				    <a id="ui-carousel-prev"><span>prev</span></a>
                </div>
    </div>
    ';//read_content <- simple functions 
return $body;

}
?>