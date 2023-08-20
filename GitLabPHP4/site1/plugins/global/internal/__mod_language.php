<?php 	
function return_language_file(){
    $current_file_name = explode("/",$_SERVER['REQUEST_URI']); /* supposing filetype .php*/
    //echo $current_file_name;
    $var=trim(strval($current_file_name[count($current_file_name)-1]));
    //Afiseaza titlul paginii conform intrarii din array           
    //If language selected -> load options in that language
    if (isset($_GET["lang"])) return $_GET["lang"]."/"."language.nfo";
    //else load default language file
    return "language.nfo";
}

function language_write($tag1,$tag1end){
    echo read_content(return_language_file(),$tag1,$tag1end);
}
	  		
?>