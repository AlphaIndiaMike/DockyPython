<?php 
include('db_model.php');

function article_menu_right($File, &$header, $width=1000, $height=1000, $div1class='content_art', $div2class='submenu_list')
{
$header.='<link href="'.absolute_path().'plugins/ext/menu_article/css/style.css" type="text/css" rel="stylesheet" />';    
    
$dba=new menu_article_model(substr(return_filename($File), 0, -4),return_language()); 
$quad=-1;
//Index is selected start displaying views
$body='';
if (allow_edit()=="true"){
    $body.='
    <div style="width:'.($width).'px; margin-top:10px; margin-bottom:10px; position:relative; height:40px;">';
        include('editing_options.php');
    $body.='</div>';//Inchide div-ul de setari
}
$body.='
<div style="width:'.($width).'px; margin-top:20px; position:relative; height:'.($height).'px;">
    <div class="floatleft '.$div1class.'">
';
include('add_content.php');
$body.='
    </div>
    <div class="floatleft '.$div2class.'">
';
include('add_menu.php');    
$body.='    
    </div>
</div>
';
//read_content <- simple functions 
return $body;        
}
?>