<?php
function content_slider($File, &$header, $width=920, $height=300){
    $header.='
    <link rel="stylesheet" href="'.absolute_path().'plugins/ext/home_gallery/css/slider2.css" type="text/css" media="screen" />
    <script type="text/javascript" src="'.absolute_path().'plugins/ext/home_gallery/js/jquery.slider2.js"></script>
    <script type="text/javascript">
    //<![CDATA[ 
    			$().ready(function() {
    				$('."'".'#slider-1'."'".').codaSlider();
    			});
    //]]>
    </script>
';
    
    $body='';
    $body.='
    <div style="height:'.$height.'px; overflow:hidden;" class="coda-slider-wrapper">
	<div style="width:'.$width.'px; height:'.$height.'px; overflow:hidden;" class="coda-slider preload" id="slider-1">
		'.str_replace('src="','src="'.absolute_path(),read_content($File,"[<content_slider>]","[</content_slider>]")).'
	</div>
    </div>
    ';//read_content <- simple functions 
    return $body;
}
 
function default_gallery($width=940,$height=400,$uri,$count){
    
    /*    //Home Gallery
    /*if ($opt=='home_Gallery') {
        $uri=array(0=>array("title_txt"=>"Transport aerian: all over the world","image"=>"../../articole/1.jpg","url"=>"#","fl_title"=>"Transport","sl_title"=>"Aerian"),
                    1=>array("title_txt"=>"Transport maritim: all over the world","image"=>"../../articole/2.jpg","url"=>"#","fl_title"=>"Transport","sl_title"=>"Maritim"),
                    2=>array("title_txt"=>"Transport rutier: extern/intern","image"=>"../../articole/3.jpg","url"=>"#","fl_title"=>"Transport","sl_title"=>"Rutier"),
                    3=>array("title_txt"=>"Transport feroviar: extern/intern","image"=>"../../articole/4.jpg","url"=>"#","fl_title"=>"Transport","sl_title"=>"Feroviar")
        );
        $ctn.=default_gallery(940,400,$uri,4);
    }*/
        $body ='
        <script type="text/javascript">
        //<![CDATA[
        
         var photos = [';
            for ($i=0;$i<$count;$i++){
                $db_field=$uri[$i];        
                $body.= '{
                            "title": "'.$db_field['title_txt'].'",
                            "image": "'.$db_field['image'].'",
                            "url": "'.$db_field['url'].'",
                            "firstline": "'.$db_field['fl_title'].'",
                            "secondline": "'.$db_field['sl_title'].'"
                        },
                '; 
            }
        $body.=']
            //]]>
        </script>
        
        <script type="text/javascript" src="plugins/js/script_gallery.js" ></script>
        <div id="header_">
            	<!-- jQuery handles to place the header background images -->
            	<div id="headerimgs">
            		<div id="headerimg1" class="headerimg"></div>
            		<div id="headerimg2" class="headerimg"></div>
            	</div>
            	<div id="headernav-outer">
            		<div id="headernav">
            			<div id="back" class="btn"></div>
            			<div id="control" class="btn"></div>
            			<div id="next" class="btn"></div>
            		</div>
            	</div>
            	<!-- jQuery handles for the text displayed on top of the images -->
            	<div id="headertxt">
            		<p class="caption">
            			<span id="firstline"></span>
            			<a href="#" id="secondline"></a>
            		</p>
            		<p class="pictured">
            			<a href="#" id="pictureduri"></a>
            		</p>
            	</div>
        </div>';
        
        
        return $body;
}

?>