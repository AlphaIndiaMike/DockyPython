<?php
function write_slider($File,$text){
	$File2 = $File.'.tmp';
	$handle = fopen($File, 'r');  
	$handle2= fopen($File2, 'w');
	if ($handle) { $ok=0;
	    while (($data = fgets($handle, 4096)) !== false) { 
            if ((StartsWith(trim($data),"*/")==true) && $ok==0) {
                fwrite($handle2,'[<content_slider>]'."\n");
                fwrite($handle2,$text);
                fwrite($handle2,"\n".'[</content_slider>]'."\n");
                fwrite($handle2,'*/'."\n".'?>'."\n"); $ok=1;
                break;
            }
	    	if (StartsWith(trim($data),"[<content_slider>]")==false) 
			{
               fwrite($handle2,$data);
            }
            else {$ok=1;
                fwrite($handle2,'[<content_slider>]'."\n");
                fwrite($handle2,$text);
                fwrite($handle2,"\n".'[</content_slider>]'."\n");
                fwrite($handle2,'*/'."\n".'?>'."\n");
                break;
			}
	    }
	    if (!feof($handle)&&$ok==0) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	  	fclose($handle2);
	} 
 unlink($File);
 rename($File2,$File);
 chmod($File, 0666);
}

function content_slider($File, &$header, $width=860, $height=300){
    //insert_js('jquery.js').
    
    
    $body='';
    if (has_access()==true&&return_random_tag('edit_slider')!='1')
        {
		if (return_topic("baseArticleSave")){
			write_slider($File,$_POST["base_Article_text"]);
		}
            $body .= '<div style="display:block; width:'.$width.' height:24px; text-align:right; padding-right:20px; position:relative; z-index:99;">
                <a href="?edit_slider=1" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image("edit.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="?edit_slider=1" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
            </div>
	    ';
        }

    if (has_access()==true&&return_random_tag('edit_slider')=='1'){
	
			$header.='
            <script type="text/javascript" src="'.absolute_path().'plugins/global/internal/apps/mce/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script>
            <script type="text/javascript">
            //<![CDATA[ 
                   tinyMCE.init({
                        // General options
                        mode : "textareas",
                        theme : "advanced",
                        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        
                        // Theme options
                        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor,|,insertdate,inserttime,|,spellchecker,advhr,removeformat,|,sub,sup,|,charmap,emotions,|,media,print,|,link,unlink,anchor,image,cleanup,code",   
                        theme_advanced_buttons3 : "",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,
                        content_css : "'.get_css("mce.css").'",
                        // Skin options
                        skin : "o2k7",
                        skin_variant : "silver",
                });   
            //]]>        
            </script>';
            
            $body.='
            <div style="margin:0 auto; width:'.$width.'px;">
                <form action="'.self_href(false,"baseArticleSave").'" method="post">
                    <textarea style="width:'.$width.'px; height:'.$height.'px;" id="base_Article_text" name="base_Article_text">'.
			read_content($File,"[<content_slider>]","[</content_slider>]").'</textarea>
                    <input type="Submit" value="Save"/>
                    <input type="reset" onclick="location.href='."'".self_href(false)."'".'" value="Cancel"/>
                </form> 
            </div>
            ';
	
	}
	else{
	$header.=insert_js('jquery.easing.1.3.js').'
	    <link rel="stylesheet" href="'.absolute_path().'plugins/apps/default/content_slider/css/slider2.css" type="text/css" media="screen" />
	    <script type="text/javascript" src="'.absolute_path().'plugins/apps/default/content_slider/js/jquery.slider2.js"></script>
	    <script type="text/javascript">
	    //<![CDATA[ 
	    			$().ready(function() {
	    				$('."'".'#slider-1'."'".').codaSlider({
					    autoSlideInterval:2000
					  });
	    			});
	    //]]>
	    </script>
	    
	';
	
	$body.='
	    <div style="height:'.$height.'px; overflow:hidden;" class="coda-slider-wrapper">
		<div style="width:'.$width.'px; height:'.$height.'px; overflow:hidden;" class="coda-slider preload" id="slider-1">
			'.read_content($File,"[<content_slider>]","[</content_slider>]").'
		</div>
	    </div>
    	';//read_content <- simple functions 
	}
    	return $body;
	
}
 
function default_gallery($width=940,$height=400,$uri,$count){
    
    /*    //Home Gallery
    /*if ($opt=='home_gallery') {
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
