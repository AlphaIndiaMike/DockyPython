<?php
   define("numar_de_randuri",10); 
   define("timp",200); 
    
    
   if (return_topic()=="recrutare-personal"){
    if (is_secure()){
        $header.=insert_css("ui-lightness/jquery-ui-1.8.21.custom.css");
         $header.='
          
        <script type="text/javascript" language="javascript" src="'.get_js("jquery-ui-1.8.21.custom.min.js").'"></script>
        <script type="text/javascript" language="javascript">
            //<![CDATA[
            //SCRIPTUL E BUN VERIFICAT
            $(document).ready(function() {
                
                $( "#datepicker" ).datepicker();
            
            });
            //]]>
        </script> 
    ';
    }
   
   }//If header
    
   function news_table(&$header){
        $w1='140'; $w2='200'; $w3='180'; $body='';
        //include("jobs_db_model.php");
        $dba=new news_model();
        
        
        
        function row($i,$w1,$w2,$w3,$c1,$c2,$c3,$id,$alb){
            $b='';
            //AICI SUNT PROBLEME
            if ($i>10)
            $i=$i-(10*(return_param(3)-1));
            
            if ($alb==true){
                if ($i%2==0) $b.='<div class="avg2 row'.$i.'">';
                else $b.='<div class="avg1 row'.$i.'">';         
            }
            else {
                if ($i%2==0) $b.='<div class="avg1 row'.$i.'">';
                else $b.='<div class="avg2 row'.$i.'">';  
            }
            
            $p2=self_href(false,return_topic(),return_param(1),"delrow",return_param(3),$id);
            $p1=self_href(false,return_topic(),return_param(1),"editrow",return_param(3),$id);
            $b.='   
                    <div class="stanga"></div>
                    <div class="avg" style="width:'.$w1.'px;"><div style="padding:5px; text-align:left;">'.$c1.'</div></div>
                    <div class="sep"></div>
                    <div class="avg" style="width:'.$w2.'px;"><div style="padding:5px; text-align:left;">'.$c2.'</div></div>
                    <div class="sep"></div>
                    <div class="avg" style="width:'.$w3.'px;"><div style="padding:5px; text-align:left;">'.$c3.'</div></div>
                    <div class="dreapta">';
                    if (is_secure())
                        $b.='<div style="position:absolute; display:block; width:80px; height:40px;">
                            <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                                <img src="'.get_image("planif.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                            </a>
                            <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                                <img src="'.get_image("delete-icon.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                            </a>
                        </div>';
                    $b.='</div>
                 </div>';
            return $b;
        }
        
        
        $data_row='';
        $c0ndition="1=1 ORDER BY _date DESC";
        $q=opentb($dba->selected_table(),$c0ndition);
        
        $p=0;
        if ($q!=null)
        while($rows=mysql_fetch_assoc($q)){
            $p+=1;
            
            //echo $p;
            $start_interval=1;
            $i=(Int)(num_rows($dba->selected_table(),$c0ndition)/numar_de_randuri);$i++;
            $numrows=num_rows($dba->selected_table(),$c0ndition);
            $end_interval=10;
            if (return_param(3)==""||return_param(3)=="1"){
                if ($numrows<numar_de_randuri)$end_interval=$numrows;            
            }
            else {    
                //Senzatie pref creste doar cand trebuie
                $start_interval=((return_param(3)-1)*10)+1;
                if (($numrows-$start_interval)>numar_de_randuri) $end_interval=$start_interval+10;
                else $end_interval=$start_interval+($numrows-$start_interval);
            }
            //echo $p;
            
            if ($p>=$start_interval&&$p<=$end_interval)
            if ($p==$end_interval&&return_param(2)!="addRow"&&return_param(2)!="editrow") {
                
                $p2=self_href(false,return_topic(),return_param(1),"delrow",return_param(3),$rows["id"]);
                $p1=self_href(false,return_topic(),return_param(1),"editrow",return_param(3),$rows["id"]);
                $last_row=
                '   
                <div class="bottom">
                        <div class="stanga">
                            <div style="background-color:#DEDEDE; height:0px;" class="delayed_start"></div>
                        </div>
                        <div class="avg" style="width:'.($w1+1).'px;"><div style="padding:5px; text-align:left;">
                        '.$rows["data"].'
                        </div></div>
                        <div class="sep"></div>
                        <div class="avg" style="width:'.$w2.'px;"><div style="padding:5px; text-align:left;">
                        '.$rows["titlu"].'
                        </div></div>
                        <div class="sep"></div>
                        <div class="avg" style="width:'.$w3.'px;"><div style="padding:5px; text-align:left;">
                        '.$rows["oras"].'
                        </div></div>
                        <div class="sep"></div>
                        <div class="avg" style="width:'.($w4-17).'px; overflow:hidden;">
                        <div style="padding:5px; text-align:left;">
                        '.$rows["continut"].'
                        </div></div>
                        <div class="avg accordionButton" id="bottom" style="width:12px; padding-left:5px;">
                            <br/>
                            <img src="'.get_image("drop.png").'" alt="#" />
                        </div>
                        <div class="dreapta">';
                            if (is_secure())
                            $last_row.='<div style="position:absolute; display:block; width:80px; height:40px;">
                                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                                    <img src="'.get_image("planif.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                                </a>
                                <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                                    <img src="'.get_image("delete-icon.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                                </a>
                            </div>';
                            $last_row.='<div style="background-color:#DEDEDE; height:0px;" class="delayed_start"></div>
                        </div>
                    </div>      
                ';
            }else{
                if ($end_interval%2==0) $alb=true;
                else $alb=false;
                
                $data_row.=row($p,$w1,$w2,$w3,$w4,$rows["data"],$rows["titlu"],$rows["oras"],$rows["continut"],$rows["id"],$alb);
            }//Se incheie verificarea daca sa afiseze sau nu randul editat
        }  //Se incheie while parcurge lista
      
        
        
        if (is_secure()){
            $p1=self_href(false,"recrutare-personal",return_page_id(),"addRow");
            $p2=self_href(false,"recrutare-personal",return_page_id());
            $s1="javascript:document.getElementById('addRow').submit()"; 
            
            $body.='<div style="display:block; width:940px; height:40px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.get_image("add.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Adauga rand</a>&nbsp;&nbsp;&nbsp; 
                </div>';
                
            if (return_param(2)=="addRow"){
                $last_row='<div class="bottom" style="height:200px;">
                <form id="addRow" method="post" action="'.$p2.'">
                <div class="stanga" style="height:200px;">
                    <div style="background-color:#DEDEDE; height:169px;"></div>
                </div>
                <div class="avg" style="width:'.($w1+1).'px; height:200px;">
                    <input class="avgtext" style="width:'.($w1-25).'px;" type="text" name="data" id="datepicker" value="'.date("j.n.Y").'"/>
                </div>
                <div class="sep" style="height:200px;"></div>
                <div class="avg" style="width:'.$w2.'px; height:200px;">
                    <input class="avgtext" style="width:'.($w2-25).'px" type="text" name="post" value=""/><br/><br/><br/>
                    &nbsp;&nbsp;Categorie: <br/>
                    <input class="avgtext" style="width:'.($w2-25).'px" type="text" name="cat" id="cat" value=""/>
                </div>
                <div class="sep" style="height:200px;"></div>
                <div class="avg" style="width:'.$w3.'px; height:200px;">
                    <input class="avgtext" style="width:'.($w3-25).'px" type="text" id="oras" name="oras" value=""/>
                </div>
                <div class="sep" style="height:200px;"></div>
                <div class="avg" style="width:'.($w4).'px; height:200px;">
                    <textarea name="desc" style="width:'.($w4).'px; height:50px;">
                    </textarea>
                    <div style="display:block; width:'.($w4).'px; height:40px; text-align:right;">
                        <a href="'.$s1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                            <img src="'.get_image("Add-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                        </a>
                        <a href="'.$s1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Salveaza</a>&nbsp;&nbsp;&nbsp; 
                        <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                            <img src="'.get_image("delete-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                        </a>
                        <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Revocare</a>&nbsp;&nbsp;&nbsp; 
                    
                    </div>
                </div>
                <div class="dreapta" style="height:200px;">
                    <div style="background-color:#DEDEDE; height:169px;"></div>
                </div>
                </form>
                </div>';
            }
            
            if (return_param(2)=="editrow"){
                $p2_=self_href(false,"recrutare-personal",return_page_id(),"","",return_param(4));
                $last_row='<div class="bottom" style="height:200px;">
                <form id="addRow" method="post" action="'.$p2_.'">
                <div class="stanga" style="height:200px;">
                    <div style="background-color:#DEDEDE; height:169px;"></div>
                </div>
                <div class="avg" style="width:'.($w1+1).'px; height:200px;">
                    <input class="avgtext" style="width:'.($w1-25).'px;" type="text" name="data2" id="datepicker" value="'.get_column("jobs_","id=".return_param(4),"data").'"/>
                </div>
                <div class="sep" style="height:200px;"></div>
                <div class="avg" style="width:'.$w2.'px; height:200px;">
                    <input class="avgtext" style="width:'.($w2-25).'px" type="text" name="post2" value="'.get_column("jobs_","id=".return_param(4),"titlu").'"/>
                </div>
                <div class="sep" style="height:200px;"></div>
                <div class="avg" style="width:'.$w3.'px; height:200px;">
                    <input class="avgtext" style="width:'.($w3-25).'px" type="text" id="oras" name="oras2" value="'.get_column("jobs_","id=".return_param(4),"oras").'"/>
                    &nbsp;&nbsp;Categorie: <br/>
                    <input class="avgtext" style="width:'.($w2-25).'px" type="text" name="cat2" id="cat" value="'.get_column("jobs_","id=".return_param(4),"categorie").'"/>
                </div>
                <div class="sep" style="height:200px;"></div>
                <div class="avg" style="width:'.($w4).'px; height:200px;">
                    <textarea name="desc2" style="width:'.($w4).'px; height:50px;">
                    '.get_column("jobs","id=".return_param(4),"continut").'
                    </textarea>
                    <div style="display:block; width:'.($w4).'px; height:40px; text-align:right;">
                        <a href="'.$s1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                            <img src="'.get_image("Add-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                        </a>
                        <a href="'.$s1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Salveaza</a>&nbsp;&nbsp;&nbsp; 
                        <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                            <img src="'.get_image("delete-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                        </a>
                        <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Revocare</a>&nbsp;&nbsp;&nbsp; 
                    
                    </div>
                </div>
                <div class="dreapta" style="height:200px;">
                    <div style="background-color:#DEDEDE; height:169px;"></div>
                </div>
                </form>
                </div>';
            }
            
            
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
            function findValue(li) {
                if( li == null ) return alert("No match!");
                if( !!li.extra ) var sValue = li.extra[0];
                else var sValue = li.selectValue;
                alert("The value you selected was: " + sValue);
            }

            
            function selectItem(li) {
                findValue(li);
            }

            
            $(document).ready(function() {
	           $("#oras").autocompleteArray([';
                $q=opentb("orase","1=1");
                if ($q!=null)
                while($rows=mysql_fetch_assoc($q)){
                    $header.='"'.$rows["nume"].'",';
                }
                $header.='   
               "Nespecificat"],{delay:10,minChars:1,matchSubset:1,/*onItemSelect:selectItem,onFindValue:findValue,*/
                    autoFill:true,maxItemsToShow:10}

	           );
               
               $("#cat").autocompleteArray([';
                $q=opentb("jobs","1=1");
                if ($q!=null)
                while($rows=mysql_fetch_assoc($q)){
                    $header.='"'.$rows["categorie"].'",';
                }
                $header.='   
               "Nespecificat"],{delay:10,minChars:1,matchSubset:1,/*onItemSelect:selectItem,onFindValue:findValue,*/
                    autoFill:true,maxItemsToShow:10}

	           );
            });
            </script>';
        }
        
        if (!isset($last_row)) $last_row='Ne pare rau, momentan nu sunt locuri disponibile. Va rugam reveniti mai tarziu.';
        $body.='
            <div style="height:20px; width:940px; display:block;"></div>
            <div class="top">
                <div class="stanga"></div>
                <div class="avg" style="width:'.($w1+1).'px;"><div class="avgtext">DATA</div></div>
                <div class="sep"></div>
                <div class="avg" style="width:'.$w2.'px;"><div class="avgtext">DENUMIRE POST</div></div>
                <div class="sep"></div>
                <div class="avg" style="width:'.$w3.'px;"><div class="avgtext">ORAS</div></div>
                <div class="sep"></div>
                <div class="avg" style="width:'.($w4).'px;"><div class="avgtext">DESCRIERE POST</div></div>
                <div class="dreapta"></div>
            </div>
                '.$data_row.'
                '.$last_row.'
                <div style="height:10px; width:940px; display:table;"></div>';
                
                if (num_rows("jobs_",$c0ndition)>numar_de_randuri){
                    $body.='
                    <div style="cursor:pointer; height:20px; width:940px; display:block; text-align:right; padding-top:10px; padding-bottom:10px;">
                    <div style="display:inline; float:right; height:20px; width:22px; text-align:center; margin-left:2px; margin-right:10px; padding-top:2px;">
                        <img src="'.get_image("right.gif").'" alt="left" />
                    </div>';
                    for ($i=(Int)(num_rows("jobs_",$c0ndition)/numar_de_randuri); $i>=0; $i--){
                        $body.='<div style="';
                        if ($i==(return_param(3)-1)) $body.='background-color:#555; font-weight:900; color:#eee;';
                        else
                        if (return_param(3)=="") if ($i==0)$body.='background-color:#555; font-weight:900; color:#eee;';
                        else $body.='color:gray; ';
                        $body.='display:inline; float:right; border:solid 1px gray; height:20px; width:22px; text-align:center; font-size:12pt; margin-left:2px; margin-right:2px;">';
                        if (($i==(return_param(3)-1))||(return_param(3)==""&&$i==0)){
                            $body.='<a style="color:white" href="'.self_href(false,return_topic(),return_param(1),return_param(2),($i+1)).'">'.($i+1).
                            '</a></div>';
                        }
                        else{
                             $body.='<a href="'.self_href(false,return_topic(),return_param(1),return_param(2),($i+1)).'">'.($i+1).
                            '</a></div>';
                        }
                    }
                    $body.='<div style="display:inline; float:right; height:20px; width:22px; text-align:center; font-size:12pt; margin-left:10px; margin-right:2px; padding-top:2px;">
                        <img src="'.get_image("left.gif").'" alt="left" />
                    </div></div>';
                }
                
            $body.='
            <div style="height:20px; width:940px; display:block;"></div>';
        return $body;
   }//Se incheie functia de tabel

?>