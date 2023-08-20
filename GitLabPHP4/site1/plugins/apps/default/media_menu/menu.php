<?php
if (trim(read_content(get_title(),"[<media_menu>]","[</media_menu>]"))=="media"){
         function caption_insider($url,$edit=false){return '
        	<div class="caption_insider" style=" text-align:left;">
                    <a href="'.$url.'">Mai multe informații >> </a>
            </div>
         ';}
        include("media.php");
    }
    if (trim(read_content(get_title(),"[<media_menu>]","[</media_menu>]"))=="media_blu"){
         function caption_insider($url,$edit=false){
            if ($edit==true){
                  return '
                	<div class="caption_insider2" style="height:70px;  text-align:left;">
                            <a href="'.$url.'&amp;param2=edit_menu">Click to edit >> </a>
                            <a href="'.$url.'">Mai multe informații >> </a>
                    </div>
                 ';  
            }
            else
            return '
        	<div class="caption_insider2" style=" text-align:left;">
                    <a href="'.$url.'">Click to read more >> </a>
            </div>
            ';
         }
        include("media_blu.php");
    }
    if (trim(read_content(get_title(),"[<media_menu>]","[</media_menu>]"))=="simple"){
         function caption_insider($url,$edit=false){
            if ($edit==true){
                  return '
                	<div class="caption_insider3" style="height:70px;  text-align:left;">
                            <a href="'.$url.'&amp;param2=edit_menu">Click to edit >> </a>
                            <a href="'.$url.'">Mai multe informații >> </a>
                    </div>
                 ';  
            }
            else
            return '
        	<div class="caption_insider3" style=" text-align:left;">
                    <a href="'.$url.'">Mai multe informații >> </a>
            </div>
            ';
            }
        include("simple.php");
    }
    if (trim(read_content(get_title(),"[<media_menu>]","[</media_menu>]"))=="simple5"){
         function caption_insider($url,$edit=false){
            if ($edit==true){
                  return '
                	<div class="caption_insider5" style="height:50px; width:240px; text-align:left;">
                            <a href="'.$url.'&amp;param2=edit_menu">Edit >> </a>
                            <a href="'.$url.'">Aflați mai multe >> </a>
                    </div>
                 ';  
            }
            else
            return '
        	<div class="caption_insider5" style="text-align:left;">
                    <a href="'.$url.'">Aflați<br/> mai multe  >> </a>
            </div>
            ';
            }
        include("simple5.php");
    }
?>