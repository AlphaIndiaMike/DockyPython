<?php
include("db_model.php");
function media_menu($File, &$header, $width=940, $height=300){
    $set_id=return_page_id();
     
    $dba=new media_menu_model();
    if (is_secure()&&return_post("title")!=""&&return_post("content")!=""){
            if ($set_id==0) $set_id=100;
            $dba->add_content($set_id,return_post("title"),return_post("content"),get_column($dba->selected_table(),"id=".$set_id,"preview"));
    }
    if (is_secure()&&return_post("titlu_meniu")!=""&&return_post("continut_meniu")!=""){
            $dba->add_content(return_param(1),return_post("titlu_meniu"),get_column($dba->selected_table(),"id=".$set_id,"continut"),return_post("continut_meniu"));
    }
    if (is_secure()&&return_post("titlu_meniu_mini")!=""){
            $dba->add_content(return_param(1),return_post("titlu_meniu_mini"),get_column($dba->selected_table(),"id=".$set_id,"continut"));
    }
    
    if (is_secure()){
        if (return_param(2)=="edit_menu"||return_param(2)=="addRow"||return_param(2)=="editrow"){
            $header.='
            <script type="text/javascript" src="'.absolute_path().'plugins/global/mce/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script>
            <script type="text/javascript">
            //<![CDATA[ 
                   tinyMCE.init({
                        // General options
                        mode : "textareas",
                        theme : "simple",
                        forced_root_block : ""
                });   
            //]]>        
            </script>
            ';
        }else
        if (return_topic()!="baseArticleEdit"&&return_topic()!="footerEdit")
        $header.='
            <script type="text/javascript" src="'.absolute_path().'plugins/global/mce/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script>
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
            </script>
            ';
    }
    
    $body='';
    include("menu.php");
   
    if (return_param(1)=="") $set_id="0";
    else $set_id=return_param(1);
    
    function uberprufe_alles(){
    
        //if ((get_file(false)=="recrutare-personal"&&return_param(1)!="1")) echo '1';
        
        if ((get_file(false)=="recrutare-personal"&&return_param(1)=="1") ||
        (get_file(false)=="training"&&return_param(1)=="1") ||
        (get_file(false)=="default"&&return_topic()=="recrutare-personal") ||
        (get_file(false)=="default"&&return_topic()=="news")) return false; 
        return true;
    }
   
       
    if (is_secure()&&uberprufe_alles()){
        
          if (return_param(2)=="edit"){
            $p1="javascript:document.getElementById('articleEdit').submit()"; 
            $p2=self_href(false,return_topic(),return_param(1));
            
            $body .= '<div style="display:block; width:'.($width-20).'px; height:40px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image("ok-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Salvare</a>&nbsp;&nbsp;&nbsp;
                <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.get_image("delete-icon.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Revocare</a>
                
            </div>';
          } else{
              
             $p1=self_href(false,get_file(false),return_page_id(),"edit");
            //$p2=absolute_path().return_language().$topic.'/menuArticleMenuEdit/'.get_file();
            
            $body .= '<div style="display:block; width:'.($width-20).'px; height:40px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image("edit.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Editeaza pagina</a>&nbsp;&nbsp;&nbsp;
               
            </div>';
            
            /*
             <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/menu-icon.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_submenu>]","[</menu_article_submenu>]").'</a>
             */
          }  
    }
    /*
        
          */
   $titlu_pagina=get_column($dba->selected_table(),"id=100","titlu");
   $continut_pagina=get_column($dba->selected_table(),"id=100","continut");;
   
   function tray_bar($content=""){
        return '<div class="tray_bar">
                    <div class="tray_left"></div>
                    <div class="tray_cnt">'.$content.'</div>
                    <div class="tray_right"></div>
               </div>';
   }
   
   function title($titlu_pagina){
        return '<div class="page_title">
                '.$titlu_pagina.'
            </div>
            <div class="separator_line">
                <div class="u_line">&nbsp;
                </div>
                <div class="u_sep">&nbsp;
                </div>
            </div>';
   }
   
    function back_btn(){
        $continut_pagina='<br/><br/><div class="separator_line"><div class="u_line">&nbsp;</div></div>';
        $continut_pagina.='<div class="separator_line"><div style="float:right; padding-right:0px;">
                <a href="'.self_href(false).'" style="color:transparent; border:none;">
                    <img src="'.get_image("backbtn.png").'" alt="inapoi" />
                </a>
                </div></div><br/><br/>';
        return $continut_pagina;
    }

   
   if ((return_topic()=="news")||((return_topic()=="training")&&return_param(1)=="1")) include("news_content.php");
    else
   if (return_topic()=="recrutare-personal"&&return_param(1)=="1") include("jobs_content.php");
    else include("std_content.php");
   
    if ($titlu_pagina!="")
    $body.='
            <div class="specific">
            <div class="page_title">
                '.$titlu_pagina.'
            </div>
            <div class="separator_line">
                <div class="u_line">&nbsp;
                </div>
                <div class="u_sep">&nbsp;
                </div>
            </div>
            '.$continut_pagina.'</div>';
    return $body;
}
 


?>