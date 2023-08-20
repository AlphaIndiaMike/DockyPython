<?php

function read_footer($edit=false)
{
     if (check_table("footer_".return_language())==false){ 
             run_query("CREATE TABLE footer_".return_language()." (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, ctn TEXT);");
     }
    
	$q=opentb("footer_".return_language(),"1=1");
    if ($q!=null){
        $r=mysql_fetch_assoc($q);
        return $r["ctn"];
    }
    
    if ($edit==true) return '';
	return '<div class="std" style="display:inline-block; width:800px; padding:10px; color:yellow;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000EDB
        </div>';
}

function drop_footer(){
	run_query("TRUNCATE "."footer_".return_language().";");
}

function write_footer($text){
    $text=mysql_real_escape_string($text);
	$q=opentb("footer_".return_language(),"1=1");
    if ($q!=null){
        $r=mysql_fetch_assoc($q);
    }
    if ($q!=null&$r!=null){
        run_query("UPDATE "."footer_".return_language()." SET ctn='".$text."' WHERE 1=1;");
    }
    else run_query("INSERT INTO "."footer_".return_language()." (id,ctn) VALUES(1,'".$text."');");
    
}

 function footer(&$header,$edit,$width,$height){
        $r='';
        
        if ($edit==true&&is_secure()==true){
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
                        theme_advanced_default_background_color : "#3f3f3f",
                        content_css : "'.absolute_path().'plugins/global/css/footer.css",
                        // Skin options
                        skin : "o2k7",
                        skin_variant : "silver",
                }); 
            //]]>        
            </script>';
            
            $r.='
            <div style="margin:0 auto; width:'.$width.'px;">
                <form action="'.self_href(false,"footerSave").'" method="post" style="position:relative;">
                    <textarea style="width:'.($width+20).'px; height:'.($height+100).'px;" id="ctn" name="ctn">'.read_footer(true).'</textarea>
                    <input type="submit" value="Save"/>
                    <input type="reset" onclick="location.href='."'".self_href(false)."'".'" value="Cancel"/>
                </form> 
            </div>
            ';
        }
        else {
            if (is_secure()==true)
            {
                $r .= '<div style="display:block; width:'.$width.' height:24px; text-align:right; padding-right:20px;">
                    <a href="'.self_href(false,"footerEdit").'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                        <img src="'.get_image('edit.png').'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                    </a>
                    <a href="'.self_href(false,"footerEdit").'" class="edit_comment" style="text-decoration:none; font-size:11pt; color:Yellow;">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
                    <a href="'.self_href(false,"footerDelete").'" style="text-decoration:none; font-size:10pt; color:transparent;">
                        <img src="'.get_image('trash.png').'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                    </a>
                    <a href="'.self_href(false,"footerDelete").'" class="edit_comment" style="text-decoration:none; font-size:11pt; color:Yellow;">&nbsp;Delete</a>
                    
                </div>';
            }
            $r.=read_footer();
        }  
        return $r;
    }//Aici se incheie functia footer
    
    //function base_Article_write($File,$text){write_article($File,$text); }
    
 function footer_edit(&$header,$width=960,$height=300){
    $razor='';
    /*base_Article service setup*/
    if (return_topic()=="footerEdit") $razor='edit';
    if (return_topic()=="footerSave") if (return_post("ctn")!="") $razor="save";
    if (return_topic()=="footerDelete") $razor='delete';
     //Base Article
     //echo 'aici: '.$razor;
    if ($razor=='save') {write_footer($_POST["ctn"]);  return footer($header,false,$width,$height);}
    else if ($razor=='edit') { return footer($header,true,($width-40),$height);}
    else if ($razor=='delete') {drop_footer(); return footer($header,false,$width,$height);}
    else {return footer($header,false,$width,$height);}
 }


?>