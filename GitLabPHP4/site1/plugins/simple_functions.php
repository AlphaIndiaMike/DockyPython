<?php 
function invalidEmail($email){
		return (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email));          
}

function absolute_path(){
    $url="";
    $pth=explode("/",$_SERVER['REQUEST_URI']);
    for ($i=1; $i<count($pth)-number_of_directories; $i++) {$url.="../";}
    return $url;
}

//Afiseaza numele documentului curent CU EXTENSIE
function get_title(){
    if (url_rewriting==true){
        $current_file_name = explode("/",$_SERVER['REQUEST_URI']); /* supposing filetype .php*/
        //echo $current_file_name;
        $var=trim(strval($current_file_name[count($current_file_name)-1]));
        //Afiseaza titlul paginii conform intrarii din array           
        if ($var=="") return "default".php_extension;
        if (isset($_GET["lang"])) return $_GET["lang"]."/".substr($var,0,-5).php_extension;
        return substr($var,0,-5).php_extension;
    }else{
        return $_SERVER['SCRIPT_FILENAME'];
    }
}
//RETURNEAZA DOAR NUMELE FISIERULU HTML!!!!
function get_file($extension=true, $check_index=false){
    $current_file_name = explode("/",$_SERVER['REQUEST_URI']); /* supposing filetype .php*/
    //echo $current_file_name;
    $var=trim(strval($current_file_name[count($current_file_name)-1]));
    //Afiseaza titlul paginii conform intrarii din array  
    if ($check_index==true&&$var=="") return true;
    if ($check_index==true&&$var!="") return false;
             
    if ($extension==true){
        if ($var=="") return "default.php";
        return $var;
    }else{
        if ($var=="") return "default";
        $var2=explode(".",$var);
        return $var2[0];
    }
}

function file_extension($filename)
{
    return end(explode(".", $filename));
}

function to_utf8($string){
    $string=str_replace("Ă","&#258;",$string);
    $string=str_replace("ă","&#259;",$string);
    $string=str_replace("Â","&#194;",$string);
    $string=str_replace("â","&#226;",$string);
    $string=str_replace("Î","&#206;",$string);
    $string=str_replace("î","&#238;",$string);
    $string=str_replace("Ș","&#x218;",$string);
    $string=str_replace("ș","&#x219;",$string);
    $string=str_replace("Ț","&#x21A;",$string);
    $string=str_replace("ț","&#x21B;",$string);
    return $string;
}

function StartsWith($Haystack, $Needle){
	// Recommended version, using strpos
	return substr($Haystack, 0, strlen($Needle)) == $Needle;
}

function view_title()
{
	$File =get_title();
	$handle = fopen($File, 'r');  
	if ($handle) { 
	    while (($data = fgets($handle, 4096)) !== false) { 
		    if (StartsWith(trim($data),"<title>")==true) 
			{
			 
               $data = fgets($handle,4096); 
			   fclose($handle);
               return $data;
			}
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	} 
 return 'null';
}

function view_menu($File)
{
	$handle = fopen($File, 'r');  
	if ($handle) { 
	    while (($data = fgets($handle, 4096)) !== false) { 
		    if (StartsWith(trim($data),"<menu>")==true) 
			{
			 
               $data = fgets($handle,4096); 
			   fclose($handle);
               return $data;
			}
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	} 
 return 'null';
}

function view_submenu($File)
{
	$handle = fopen($File, 'r');  $body='';
	if ($handle) { 
	    while (($data = fgets($handle, 4096)) !== false) { 
		    if (StartsWith(trim($data),"<submenu>")==true) 
			{
                while (($subdata = fgets($handle, 4096)) !== false&&StartsWith(trim($subdata),"</submenu>")==false) { 
                    $body.=$subdata;
                }
			   fclose($handle);
               return $body;
			}
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	} 
    return '';
}

function view_meta(){
	$body=''; $ck=0;
    $File = get_title();
	$handle = fopen($File, 'r');  
	if ($handle) {
	    while (($data = fgets($handle, 4096)) !== false) { 
		    if (StartsWith($data,"<meta>")==true) 
			{
			   while (($subdata = fgets($handle, 4096)) !== false) { 
			  		 	if (StartsWith($subdata,"</meta>")) break;
			  		 	else $body.=$subdata;
			   }
			}
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	    return $body;
	} 
 return 'null';
}

function read_login($db_path,&$usr,&$pass)
{
	$File = $db_path;
	$handle = fopen($File, 'r');  
	$data = fgets($handle,4096); //protection
	$data = fgets($handle,4096); 
	if (StartsWith($data,"<usr>")==true) 
	{
		$data = fgets($handle,4096); 
		$usr=trim($data);
		$data = fgets($handle,4096); 
	}
   $data = fgets($handle,4096); 
   if (StartsWith($data,"<pass>")==true) 
   {
	$data = fgets($handle); 
	$pass=trim($data);
	$data = fgets($handle,4096); 
   }
 fclose($handle); 
}

function return_language(){
    if (url_rewriting==false){
        $current_file_name = explode("/",$_SERVER['REQUEST_URI']);
        if (!isset($current_file_name[number_of_directories])||$current_file_name[number_of_directories]==""||$current_file_name[number_of_directories]=="index.html") return default_lang;
        return $current_file_name[number_of_directories];
    }else{
        if (isset($_GET["lang"])) return $_GET["lang"];
    }
    return default_lang;
}

function return_topic(){
    if (isset($_GET["topic"])&&$_GET["topic"]!="") return mysql_real_escape_string($_GET["topic"]); 
    return "";
}

function return_param($i){
    if (isset($_GET["param".$i])&&$_GET["param".$i]!="") return mysql_real_escape_string($_GET["param".$i]); 
    return "";
}

function return_selector($i){
    if (isset($_GET["selector".$i])&&$_GET["selector".$i]!="") return mysql_real_escape_string($_GET["selector".$i]); 
    return "";
}
function return_random_tag($name){
    if (isset($_GET[$name])&&$_GET[$name]!="") return mysql_real_escape_string($_GET[$name]); 
    return "";
}
function path_to_file($relaive_file_path,$echo=true){
    /*if (url_rewriting==false){
        echo $relaive_file_path;
    }
    else echo*/
    if ($echo==true)
    echo absolute_path().$relaive_file_path;
    else return absolute_path().$relaive_file_path;
}

function return_path($relaive_file_path){
    return absolute_path().$relaive_file_path;
}

function return_page_id($param=1){
    if (return_param($param)=="") $set_id="0";
    else $set_id=return_param(1);
    return $set_id;
}

function return_filename($path){
    return end(explode("/", $path));
}

function link_1($absolute_path, $param1){
    return absolute_path().return_language()."/".$param1."/".substr(return_filename($absolute_path), 0, -4).'.html';
}

function link_1e($param1){
    return absolute_path().return_language()."/".$param1."/".substr(return_filename(get_file()), 0, -4).'html';
}

function link_2($numele_fisierului_php, $param1, $param2){
    return absolute_path().return_language()."/".$param1."/".$param2."/".substr(return_filename($absolute_path), 0, -4).'.html';
}

function link_2e($param1, $param2){
    return absolute_path().return_language()."/".$param1."/".$param2."/".substr(return_filename(get_file()), 0, -4).'html';
}

function href($file_path_and_name_within_lang_dir,$echo=false,$topic='',$param1='',$param2='',$param3='',$param4='',$selector1='',$selector2='',$uid=''){
    $href=absolute_path().return_language().'/'.$file_path_and_name_within_lang_dir;
    if ($topic!='') $href.='?topic='.$topic;
    if ($param1!='') $href.='&amp;param1='.$param1;
    if ($param2!='') $href.='&amp;param2='.$param2;
    if ($param3!='') $href.='&amp;param3='.$param3;
    if ($param4!='') $href.='&amp;param4='.$param4;
    if ($selector1!='') $href.='&amp;selector1='.$selector1;
    if ($selector2!='') $href.='&amp;selector2='.$selector2;
    if ($uid!='') $href.='&amp;uid='.$uid;
    if ($echo==true) echo $href;
    else return $href;
    return null;
}

function self_href($echo=false,$topic='',$param1='',$param2='',$param3='',$param4='',$selector1='',$selector2='',$uid='')
{
    $href="";
    if (get_file(false,true)==true) $href=absolute_path().return_language()."/default.html";
    $href.="?";
    if ($topic!='') $href.='topic='.$topic;
    if ($param1!='') $href.='&amp;param1='.$param1;
    if ($param2!='') $href.='&amp;param2='.$param2;
    if ($param3!='') $href.='&amp;param3='.$param3;
    if ($param4!='') $href.='&amp;param4='.$param4;
    if ($selector1!='') $href.='&amp;selector1='.$selector1;
    if ($selector2!='') $href.='&amp;selector2='.$selector2;
    if ($uid!='') $href.='&amp;uid='.$uid;
    if ($echo==true) echo $href;
    else return $href;
    return null;
}
function self_hrefr($echo=false,$tag1='',$value1='',$tag2='',$value2='',$tag3='',$value3='',$tag4='',$value4='')
{
    $href="";
    if (get_file(false,true)==true) $href=absolute_path().return_language()."/default.html";
    $href.="?";
    if ($tag1!='') $href.=$tag1.'='.$value1;
    if ($tag2!='') $href.=$tag2.'='.$value2;
    if ($tag3!='') $href.=$tag3.'='.$value3;
    if ($tag4!='') $href.=$tag4.'='.$value4;
    if ($echo==true) echo $href;
    else return $href;
    return null;
}

function show_files($dir)
{
	include_once('info.php');
	$body='';
	if ($handle = opendir($dir)) {
   
	    /* This is the correct way to loop over the directory. */
	    while (false !== ($file = readdir($handle))) {
	        //echo "$file\n"; AICI SE INTAMPLA
	        $body.=articol_fisier($file,$dir);
	    }
	    closedir($handle);
	}
	else return 'Nu sunt fisiere!';
	if ($body=='') return 'Nu sunt fisiere!';
	return $body;
}
function check_string($str){
    $str2=trim($str," ,'_;");
    if ($str2!="") return true;
    return false;
}
function check_email_address($email) { 
      // checks proper syntax
      if(!preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
      {
            return false;
      }
     return true;
}

function linking_info(&$c=0,$din="<include>",$dout="</include>")
{
	$File =get_title(); 
	$handle = fopen($File, 'r');   
	if ($handle) { 
	    while (($data = fgets($handle, 4096)) !== false) { 
		    if (StartsWith(trim($data),$din)==true) 
			{
                while (($subdata = fgets($handle, 4096)) !== false) { 
                    if (StartsWith(trim($subdata),$dout)==true) {
                        fclose($handle);
                        if (isset($opt))return $opt; 
                        return null;  
                    }
                    $opt[$c]=$subdata;
                    $c++;
                }
			}
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	} 
 return 'null';
}

function read_content($File,$tag1, $tag2, $edit=false)
{
	$handle = fopen($File, 'r');  
    $body='';
	//START
	if ($handle) {
	    while (($data = fgets($handle, 4096)) !== false) {  
		   if(StartsWith($data,$tag1)){ 
			  	 while (($subdata = fgets($handle, 4096)) !== false) { 
	                 if (StartsWith($subdata,$tag2)==true) {fclose($handle); return $body;}
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

function return_post($variable){
    if (isset($_POST[$variable])){
        if ($_POST[$variable]!="") return mysql_real_escape_string($_POST[$variable]);
        return "";
    }
    return "";
}

function return_session($variable){
    if (isset($_SESSION[$variable])){
        if ($_SESSION[$variable]!="") return mysql_real_escape_string($_SESSION[$variable]);
        return "";
    }
    return "";
}

function return_get($variable){
    if (isset($_GET[$variable])){
        if ($_GET[$variable]!="") return mysql_real_escape_string($_GET[$variable]);
        return "";
    }
    return "";
}

function check_session($variable){if(isset($_SESSION[$variable])&&$_SESSION[$variable]!="") return true; return false;}

function get_image($name,$app="global", $param=""){
    if ($app=="global")
        return path_to_file('plugins/global/images/'.$name,false);
    if ($param!="")
        return path_to_file('plugins/apps/'.$app."/".$param.'/images/'.$name,false);
    return path_to_file('plugins/apps/'.$app.'/images/'.$name,false);
}

function service_start($name,$app="global",$param=""){
    if ($app=="global")
        include(absolute_path().'plugins/global/services/'.$name.".php");
    else{
        if ($param!="")
            include(absolute_path().'plugins/apps/'.$app."/".$param.'/__services/'.$name.".php");
        else include(absolute_path().'plugins/apps/'.$app.'/__services/'.$name.".php");
    }
}
function home_page() {return absolute_path().return_language()."/default.html";}
function get_css($name){return path_to_file('plugins/global/css/'.$name,false);}
function insert_css($name,$media="all"){return "\n".'<link rel="stylesheet" type="text/css" href="'.get_css($name).'" media="'.$media.'"/>';}
function get_js($name){return path_to_file('plugins/global/js/'.$name,false);}
function insert_js($name){return "\n".'<script type="text/javascript" language="javascript" src="'.get_js($name).'"></script>';}
function get_masterpage($app){return absolute_path()."plugins/app/".$app."/masterpage/masterpage.php";}
function get_base_article(){return absolute_path()."plugins/app/site/base_article/base_article.php";}
function main_menu() {include(absolute_path()."plugins/global/menu.php"); return return_menu($menu_html);}
function global_dir() {return absolute_path()."plugins/global/";}
function security($service_file_name){return absolute_path()."plugins/global/services/security/".$service_file_name;}
function import_mce($with_opt=false) {
    return '<script type="text/javascript" src="'.absolute_path().'plugins/global/internal/apps/mce/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script>';
}
function load_internal_service($app,$param,$service_name){include(absolute_path()."plugins/apps/".$app."/".$param."/services/".$service_name.".php");}

?>
