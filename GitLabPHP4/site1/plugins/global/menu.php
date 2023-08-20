<?php
$menu_html='';
//HERE YOU'LL DEFINE THE MENU!!! SEE THE BOTTOM OF THE PAGE
function show_menu($file){
    $m_h=''; 
    $file2=absolute_path().return_language()."/".substr($file, 0, -4)."html";
    $file=absolute_path().return_language()."/".$file;
   
    /*Magic that finds out which is the active file to display as menu selected item*/
    $arr=explode("/",get_title());
    if (count($arr)==1) $arr=explode("\\",get_title());
    
    if ($arr[count($arr)-1]=="index.html") $arr[count($arr)-1]="default.html";
    $arr2=explode("/",strval($file));
    
    //if ($arr[count($arr)-1]==$arr2[count($arr2)-1]) $m_h.= '<li class="selected first"><a href="'.$file.'">'."\n";
    $m_h.= '<a href="'.$file.'" style="color:white; text-decoration:none;">'."\n"; 
    $m_h.= view_menu(strval($file));
    $m_h.= '</a>&nbsp;&nbsp;&nbsp;&nbsp;'."\n";
    return $m_h;
}

//PROGRAM
if (file_exists(absolute_path()."order.nfo"))
{//WRITE FROM ORDER.NFO
    $File =absolute_path()."order.nfo";
	$handle = fopen($File, 'r');  
	if ($handle) { 
	    while (($data = fgets($handle, 4096)) !== false) { 
		   $menu_html.=show_menu(trim($data));
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	} 
}
 else{
//WRITE ASYNC
    if ($handle = opendir("./".default_lang)) {
    	    /* This is the correct way to loop over the directory. */
    	    while (false !== ($file = readdir($handle))) {
    	        //echo "$file\n"; AICI SE INTAMPLA
                if (file_extension($file)=="php") $menu_html.=show_menu($file);
    	        
    	    }
    	    closedir($handle);
    	}
}
?>

<?php         
//HERE YOU'LL DEFINE THE MENU BORDERS $menu_html is the menu
function return_menu($menu_html_){
   return ''.$menu_html_.'';
}
?>
