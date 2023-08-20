<?php
include("db_model.php");
class Misia_Catalog {
   static $page=1,$fn=''; 
    
   function __construct($page_num,$File) {
         $this::$page=$page_num;
         $this::$fn=$File;
   }
   
   private function get_tag($File,$count,$tag,$endtag)
    {
    	$handle = fopen($File, 'r');
        $c=1; $has='';
    	//START
    	if ($handle) {
    	    while (($data = fgets($handle, 4096)) !== false) {  
    		   if(StartsWith($data,"[<misia_catalog>]")){ 
    			  	 while (($subdata = fgets($handle, 4096)) !== false) { 
    	                 if (StartsWith($subdata,"[</misia_catalog>]")==true) {fclose($handle); return 'NULL';}
    	  		 	     if (StartsWith($subdata,$tag)==true){
                             if ($c==$count) {
                                 while (($subsub = fgets($handle, 4096)) !== false) { 
                                    if (StartsWith($subsub,$endtag)==true) break;
                                    else $has.=$subsub;
                                 }
                                 fclose($handle); 
                                 return $has;
                             }
                             else $c++;	
                         }
       				}
    			}
       	    }
    	    if (!feof($handle)) {
    	        echo "Error: unexpected fgets() fail\n";
    	    }
    	    fclose($handle);
    	}
        return '';
    }
    
    private function get_title($File,$tag="<title>",$endtag="</title>")
    {
    	$handle = fopen($File, 'r');
        $has=''; $c=1;
    	//START
    	if ($handle) {
    	    while (($data = fgets($handle, 4096)) !== false) {  
    		   if(StartsWith($data,"[<misia_catalog>]")){ 
    			  	 while (($subdata = fgets($handle, 4096)) !== false) { 
    	                 if (StartsWith($subdata,"[</misia_catalog>]")==true) {fclose($handle); return $has;}
    	  		 	     if (StartsWith($subdata,$tag)==true){
                                 while (($subsub = fgets($handle, 4096)) !== false) { 
                                    if (StartsWith($subsub,$endtag)==true) {$c++;break;}
                                    else $has.='"'."<a href='?page_catalog=".$c."'>".$c.". ".trim($subsub)."<\/a><br/>".'"+'."\n";
                                 }
                         }
       				}
    			}
       	    }
    	    if (!feof($handle)) {
    	        echo "Error: unexpected fgets() fail\n";
    	    }
    	    fclose($handle);
            return $has;
    	}
        return '';
    }
    
   private function num_pages(){
        $File=$this::$fn;
        $handle = fopen($File, 'r');
        $c=0;
    	//START
    	if ($handle) {
    	    while (($data = fgets($handle, 4096)) !== false) {  
    		   if(StartsWith($data,"[<misia_catalog>]")){ 
    			  	 while (($subdata = fgets($handle, 4096)) !== false) { 
    	                 if (StartsWith($subdata,"[</misia_catalog>]")==true) {fclose($handle); return $c;}
    	  		 	     if (StartsWith($subdata,"<page>")==true) $c++;	
                        }
       				}
       	    }
    	    if (!feof($handle)) {
    	        echo "Error: unexpected fgets() fail\n";
    	    }
    	    fclose($handle);
    	}
        return $c;
   } 
   
   private function display_image()
   {
        $url=$this->get_tag($this::$fn, $this::$page,"<page>");
        return trim($url);
   }
   private function display_title()
   {
        $url=get_tag($fn,$page,"<title>");
        return $url;
   }
   
   
   public function write_map($text,$page_){
    //chmod($File, 0755);
    $File=$this::$fn;
    $count=$page_;
    	$File2 = $File.'.tmp';
    	$handle = fopen($File, 'r');  
    	$handle2= fopen($File2, 'w');
    	if ($handle) { $ok=0;
    	    while (($data = fgets($handle, 4096)) !== false) { 
    	       if (StartsWith(trim($data),"<page>")==true) $ok++;
               if (StartsWith(trim($data),"<page>")==true) {
                    if ($ok==$count){
                        fwrite($handle2,'<page>'."\n");
                        fwrite($handle2,$text);
                        fwrite($handle2,"\n".'</page>'."\n");
                        //END page into source
                        while (($subdata = fgets($handle, 4096)) !== false) { 
                            if (StartsWith(trim($subdata),"</page>")==true)
                            break;}
                    }else fwrite($handle2,$data);
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
    }
   
   public function return_page()
   {
        $url='';
        $url.='
        <script type="text/javascript" language="javascript">
        //<![CDATA[
        function get_page_number(){
            return '.$this::$page.';
        }
        //]]>
        </script>
        <script type="text/javascript" src="'.get_js('jquery-1.10.2.js').'"></script>';
		//<script type="text/javascript" src="'.get_js('jquery-impromptu.3.2.min.js').'"></script>
		$url.='
        <link type="text/css" media="all" href="'.get_css('jquery-impromptu.css').'"/>
        <script type="text/javascript" src="'.get_js('jquery-impromptu.js').'"></script>
        <script type="text/javascript" src="'.get_js('common.js').'"></script>
        
        <script type="text/javascript" language="javascript">   
        //<![CDATA[               
            function table_of_contents(){
                var txt = "<h4>Table of contents</h4>"+
                '.$this->get_title($this::$fn).'"";
                return txt;
            }
        //]]>
        </script>
        '."\n";
        $url.='<div style="position:absolute; top:125px; left:20px; width:550px; font-style:italic; font-size:9pt;" class="blue_text std">
            Select the spare simply by clicking on the item number in the figure.
            You can select multiple items, by adding them to a list (see the <b>"Cart"</b> on the top of the page), before sending the inquiry.
            You can navigate moving catalog pages using controls from <b>"Navigation"</b>.
        </div>'; 
         if (has_access()==true)
        $url.='<div style="position:absolute; top:115px; left:570px; width:360px; text-align:right; color:white;">';
        else $url.='<div style="position:absolute; top:115px; left:750px; width:200px; text-align:right; color:white;">';
        if ($this->num_pages()>1){
        $url.='<div id="headernav-outer">
            <div class="headernav" id="navitext"><b>Navigation:</b></div>
    		<div class="headernav">';               
    		if ($this::$page>1) $url.='<div id="back" class="btn" onclick="location.href='."'".'?page_catalog='.($this::$page-1)."'".'" ></div>';
    		$url.='<div id="control" class="btn" onclick="$.prompt(table_of_contents());"></div>';
    		if ($this::$page<$this->num_pages()) $url.='<div id="next" class="btn" onclick="location.href='."'".'?page_catalog='.($this::$page+1)."'".'" ></div>';
    		$url.='</div> 
    	</div>';}
        if (has_access()==true) $url.='
        <a href="?map_catalog=1" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image('edit.png').'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
        </a>
        <a href="?map_catalog='.$this::$page.'" class="page_button">Create image map</a>'."\n";
        $url.= '</div>';
        //$url.='<div id="content" style="height:679px; width:960px;">';
        $url.=$this->get_tag($this::$fn,$this::$page,"<page>","</page>");
        //$url.='</div>';
        return $url;
   }
   public function map_page()
   {
        $url='';
        if (has_access()==true){
            $url.='<div id="content" style="height:679px; width:960px;">';
         $url.=import_mce().'
            <script type="text/javascript">
            //<![CDATA[ 
                   tinyMCE.init({
                        // General options
                        mode : "textareas",
                        theme : "advanced",
                        plugins : "imgmap,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        
                        // Theme options
                        theme_advanced_buttons1 : "imgmap,|,undo,redo,|,insertfile,insertimage,|,link,unlink,anchor,image,cleanup,help,code",
                        theme_advanced_buttons2 : null,
                        theme_advanced_buttons3 : null,
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,
                        forced_root_block : "",
                        // Skin options
                        skin : "o2k7",
                        skin_variant : "silver",
                });   
            //]]>        
            </script>

            <form action="?save_map='.$this::$page.'&page_catalog='.$this::$page.'" method="post">
                <textarea style="width:960px; height:690px;" id="map" name="map">'.$this->get_tag($this::$fn,$this::$page,"<page>","</page>").'</textarea>
                <input type="Submit" value="Save"/>
                <input type="reset" onclick="location.href='."'".$_SERVER['SCRIPT_NAME']."'".'" value="Cancel"/>
             </form>
            ';$url.='</div>';
        }
        return $url;
   }
   
}


?>