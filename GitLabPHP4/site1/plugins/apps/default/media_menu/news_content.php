<?php
    
    include('3cols_datatable.php');
    
    if (get_file(false)=="default") {
        $titlu_pagina="Noutati"; //NOTICE LACK OF LOCALISATION
        $p1=self_href(false,"news","","addrow");
        $p2=self_href(false,"news");
        $s1="javascript:document.getElementById('addRow').submit()"; 
    }
    else {
        $titlu_pagina=get_column($dba->selected_table(),"id=".$set_id,"titlu");
        $p1=self_href(false,"training","1","addrow");
        $p2=self_href(false,"training");
        $s1="javascript:document.getElementById('addRow').submit()"; 
    }
    //Adauga date in tabel, n-am gasit o varianta mai buna inca
    include("news_db_model.php");
    $dba2=new news_model();
    if (is_secure()){
        
        if (return_post("titlu")!=""&&return_post("data")!=""&&return_post("durata")!=""&&return_post("lectori")!=""&&return_post("continut")!=""
        &&return_post("page_edit")!=""){
            $dba2->add_content(return_post("titlu"),return_post("durata"),return_post("data"),return_post("continut"),return_post("lectori"),return_post("page_edit"));
        }else
        if (return_post("titlu")!=""&&return_post("data")!=""&&return_post("durata")!=""&&return_post("lectori")!=""&&return_post("continut")!=""){
            $dba2->add_content(return_post("titlu"),return_post("durata"),return_post("data"),return_post("continut"),return_post("lectori"));
        }
        
    }
    if (is_secure()){
        
            if (return_param(2)=="delrow"){
                    $dba2->delete_job(return_param(4));
            }
    }
    
    if (is_secure()){
            
            if (return_param(2)=="addrow"||return_param(2)=="editrowNews"){
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
            }
            else
            $body.='<div style="display:block; width:940px; height:40px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image("add.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Adauga</a>&nbsp;&nbsp;&nbsp; 
                </div>';
    }
    
    if ((return_param(2)=="addrow"||return_param(2)=="editrowNews")&&(is_secure())){
        
          
        $header.=insert_css("ui-lightness/jquery-ui-1.8.21.custom.css");
        $header.='
                <script type="text/javascript" language="javascript" src="'.get_js("jquery-ui-1.8.21.custom.min.js").'"></script>
                <script type="text/javascript" language="javascript">
                 //<![CDATA[
                //SCRIPTUL E BUN VERIFICAT
                $(document).ready(function() {
                    $( "#data" ).datepicker();
                });
                //]]>
                </script> 
            ';
        
        //AUTOCOMPLETE
        $header.=insert_js("jquery.autocomplete.js");
            $header.='
            <style type="text/css">
                .ac_results {
                	padding: 0px;
                	border: 1px solid WindowFrame;
                	background-color: Window;
                	overflow: hidden;
                }
                
                .ac_results ul {
                	width: 100%;
                	list-style-position: outside;
                	list-style: none;
                	padding: 0;
                	margin: 0;
                }
                
                .ac_results iframe {
                	display:none;/*sorry for IE5*/
                	display/**/:block;/*sorry for IE5*/
                	position:absolute;
                	top:0;
                	left:0;
                	z-index:-1;
                	filter:mask();
                	width:3000px;
                	height:3000px;
                }
                
                .ac_results li {
                	margin: 0px;
                	padding: 2px 5px;
                	cursor: pointer;
                	display: block;
                	width: 100%;
                	font: menu;
                	font-size: 12px;
                	overflow: hidden;
                }
                
                .ac_loading {
                	background : Window url('.get_image("indicator.gif").') right center no-repeat;
                }
                
                .ac_over {
                	background-color: Highlight;
                	color: HighlightText;
                }
            </style>
            
            <script type="text/javascript" language="javascript">
             //<![CDATA[
                $(document).ready(function() {
                   
                   $("#durata").autocompleteArray([';
                    $q=mysql_query("SELECT DISTINCT durata FROM ".$dba2->selected_table().";");
                    if ($q!=null)
                    while($rows=mysql_fetch_assoc($q)){
                        $header.='"'.$rows["durata"].'",';
                    }
                    $header.='   
                   "Nespecificat"],{delay:10,minChars:1,matchSubset:1,/*onItemSelect:selectItem,onFindValue:findValue,*/
                        autoFill:true,maxItemsToShow:10}
    
    	           );
                   
                   $("#lectori").autocompleteArray([';
                    $q=mysql_query("SELECT DISTINCT lectori FROM ".$dba2->selected_table().";");
                    if ($q!=null)
                    while($rows=mysql_fetch_assoc($q)){
                        $header.='"'.$rows["lectori"].'",';
                    }
                    $header.='   
                   "Nespecificat"],{delay:10,minChars:1,matchSubset:1,/*onItemSelect:selectItem,onFindValue:findValue,*/
                        autoFill:true,maxItemsToShow:10}
    
    	           );
                });
            //]]>
            </script>';
            
            $t="";$d=date('j.n.Y');$dur="";$l="";$ct="";
        if (return_param(2)=="editrowNews"){
            $t=get_column($dba2->selected_table(),"id=".return_param(4),"titlu");
            $t=str_replace('"',"&quot;",$t);
            $d=get_column($dba2->selected_table(),"id=".return_param(4),"data");
            $dur=get_column($dba2->selected_table(),"id=".return_param(4),"durata");
            $l=get_column($dba2->selected_table(),"id=".return_param(4),"lectori");
            $ct=get_column($dba2->selected_table(),"id=".return_param(4),"continut");
            $continut_pagina.='<input type="hidden" name="page_edit" value="'.return_param(4).'"/>';
        }    
        
        $continut_pagina.='
        <br/>
        Titlu: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="200" id="titlu" style="width:400px;" value="'.$t.'" name="titlu"/><br/>
        Durata: &nbsp;&nbsp;<input type="text" maxlength="200" style="width:400px;" value="'.$dur.'" id="durata" name="durata"/><br/>
        Lectori: &nbsp;&nbsp;<input type="text" maxlength="200" style="width:400px;" value="'.$l.'" id="lectori"  name="lectori"/><br/>
        Data: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="200" style="width:400px;" value="'.$d.'" name="data" id="data"/><br/>
        Detalii: <br/>
        <textarea name="continut" id="continut" style="width:940px; height:500px;">
        '.$ct.'
        </textarea>
        ';
        
    }else 
        if (return_param(4)!=""&&return_param(2)==""){
            $titlu_pagina=get_column($dba2->selected_table(),"id=".return_param(4),"titlu");
            $continut_pagina.="Data: ".get_column($dba2->selected_table(),"id=".return_param(4),"data")."<br/>";
            $continut_pagina.="Durata: ".get_column($dba2->selected_table(),"id=".return_param(4),"durata")."<br/>";
            $continut_pagina.="Lectori: ".get_column($dba2->selected_table(),"id=".return_param(4),"lectori")."<br/><br/>";
            $continut_pagina.=get_column($dba2->selected_table(),"id=".return_param(4),"continut");
            $continut_pagina.='<br/><br/><div class="separator_line"><div class="u_line">&nbsp;</div></div>';
            $continut_pagina.='<div class="separator_line"><div style="float:right;">
                <a href="'.self_href(false).'" style="color:transparent; border:none;">
                    <img src="'.get_image("backbtn.png").'" alt="inapoi" />
                </a>
                </div></div><br/><br/>';
        }
        else{//Afiseaza tabelul standard
            $q=opentb($dba2->selected_table(),"1=1 ORDER BY id DESC");
            
            $continut_pagina.=_3cols_table($header,"130","610","170",$q,"DATA","DESCRIERE","DETALII",'
            <div style="position:relative; top:18px;">
                <img src="'.get_image("click_details.png").'" alt="next" />
                <div style="color:gray; position:relative; top:-24px; left:7px; font-weight:bold; font-size:10pt; z-index:201;">
                    %%detalii%%
                </div>
            </div>'); // Maximum width is 910px
            
        }
  
    if (is_secure()){
        $body.='
        <form id="articleEdit" action="'.self_href(false,return_topic(),return_param(1)).'" method="post">';
    }//Se incheie in Media_menu.php form-ul
    
    if ($continut_pagina==""){
        $continut_pagina.='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000DBE
        </div>';
    }
?>