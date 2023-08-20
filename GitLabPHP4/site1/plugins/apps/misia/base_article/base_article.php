<?php


function read_article($File,$edit=false)
{
	$handle = fopen($File, 'r');  
    $body='';
	//START
	if ($handle) {
	    while (($data = fgets($handle, 4096)) !== false) {  
		   if(StartsWith($data,"[<base_Article>]")){ 
			  	 while (($subdata = fgets($handle, 4096)) !== false) { 
	                 if (StartsWith($subdata,"[</base_Article>]")==true) {fclose($handle); return $body;}
	  		 	     $body.=$subdata; 	
   				}
			}
   	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	}
    if ($edit==true) return '';
	return '<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x0000FS
        </div>';
}

function drop_article($File){
	$File2 = $File.'.tmp';
	$handle = fopen($File, 'r');  
	$handle2= fopen($File2, 'w');
	if ($handle) { $ok=0;
	    while (($data = fgets($handle, 4096)) !== false) { 
	    	if (StartsWith(trim($data),"[<base_Article>]")==true) 
			{
                fwrite($handle2,'[<base_Article>]'."\n");
                fwrite($handle2,"\n".'[</base_Article>]'."\n");
                fwrite($handle2,'*/'."\n".'?>'."\n"); $ok=1;
                break;
            }
            else fwrite($handle2,$data);
	    }
	    if (!feof($handle)&&$ok==0) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	  	fclose($handle2);
	} 
 unlink($File);
 rename($File2,$File);
 chmod($File, 0755);
}

function write_article($File,$text){
	$File2 = $File.'.tmp';
	$handle = fopen($File, 'r');  
	$handle2= fopen($File2, 'w');
	if ($handle) { $ok=0;
	    while (($data = fgets($handle, 4096)) !== false) { 
            if ((StartsWith(trim($data),"*/")==true) && $ok==0) {
                fwrite($handle2,'[<base_Article>]'."\n");
                fwrite($handle2,$text);
                fwrite($handle2,"\n".'[</base_Article>]'."\n");
                fwrite($handle2,'*/'."\n".'?>'."\n"); $ok=1;
                break;
            }
	    	if (StartsWith(trim($data),"[<base_Article>]")==false) 
			{
               fwrite($handle2,$data);
            }
            else {$ok=1;
                fwrite($handle2,'[<base_Article>]'."\n");
                fwrite($handle2,$text);
                fwrite($handle2,"\n".'[</base_Article>]'."\n");
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
 chmod($File, 0755);
}

 function base_Article($File,&$header,$edit,$width,$height){
        $r='';
        
        if ($edit==true&&has_access()==true){
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
            
            $r.='
            <div style="margin:0 auto; width:'.$width.'px;">
                <form action="'.self_href(false,"baseArticleSave").'" method="post">
                    <textarea style="width:'.$width.'px; height:'.$height.'px;" id="base_Article_text" name="base_Article_text">'.read_article($File,true).'</textarea>
                    <input type="Submit" value="Save"/>
                    <input type="reset" onclick="location.href='."'".self_href(false)."'".'" value="Cancel"/>
                </form> 
            </div>
            ';
        }
        else {
        if (has_access()==true)
        {
            $r .= '<div style="display:block; width:'.$width.' height:24px; text-align:right; padding-right:20px; position:relative; top:-50px; z-index:99;">
                <a href="'.self_href(false,"baseArticleEdit").'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image("edit.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.self_href(false,"baseArticleEdit").'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
                <a href="'.self_href(false,"baseArticleDelete").'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.get_image("trash.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.self_href(false,"baseArticleDelete").'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Delete</a>
                
            </div>';
        }
        $r .=read_article($File);
        }
            
        return $r;
    }
    function base_Article_write($File,$text){write_article($File,$text); }
    
 function base_Article_link($File,&$header,$width=1000,$height=400){
    $razor='';
    /*base_Article service setup*/
    if (return_topic()=="baseArticleEdit") $razor='edit';
    if (return_topic()=="baseArticleSave") if (isset($_POST["base_Article_text"])&&$_POST["base_Article_text"]!="") $razor="save";
    if (return_topic()=="baseArticleDelete") $razor='delete';
     //Base Article
    if ($razor=='save') {base_Article_write($File,$_POST["base_Article_text"]); return base_Article($File,$header,false,$width,$height);}
    else if ($razor=='edit') { return base_Article($File,$header,true,($width-40),$height);}
    else if ($razor=='delete') {drop_article($File); return base_Article($File,$header,false,$width,$height);}
    else {return base_Article($File,$header,false,$width,$height);}
 }


?>