<?php 
//Afiseaza editor sau afiseaza continutul
if (return_param()=="menuArticleEdit"&&allow_edit()==true){
    $header.='
            <script type="text/javascript" src="'.absolute_path().'plugins/mce/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script>
            <script type="text/javascript">
            //<![CDATA[ 
                   tinyMCE.init({
                        // General options
                        mode : "textareas",
                        theme : "advanced",
                        plugins : "imgmap,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        
                        // Theme options
                        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,link,unlink,anchor,image,cleanup,help,code",
                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,ltr,rtl,|,insertlayer,moveforward,movebackward,absolute,|,cite,abbr,acronym,del,ins,attribs,|,insertfile,insertimage,|,imgmap",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,
        
                        // Skin options
                        skin : "o2k7",
                        skin_variant : "silver",
                });   
            //]]>        
            </script>
            ';
            
            $body.='
            <form id="articleEdit" action="'.absolute_path().return_language().$topic.'/'.get_file().'" method="post" style="position:relative; left:15px;">
                <textarea style="width:'.($width-285).'px; height:'.($height-40).'px;" id="base_Article_text" name="base_Article_text">'.
                $dba->show_page(return_topic())
                .'</textarea>
            </form> 
            ';
}
else{//Afiseaza continutul doar
    $body.=str_replace('src="','src="'.absolute_path(),$dba->show_page(return_topic()));
    if ($dba->show_page(return_topic())=="") $body.='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000DBE
        </div>';
}
?>