<?php
   define("numar_de_randuri",10); 
   define("timp",200); 
    
    
   function _3cols_table(&$header,$w1='140', $w2='200', $w3='180',$q, $t1,$t2,$t3, $c3="",$c2="",$c1=""){
        $body='';
        $height="70";
        //include("jobs_db_model.php");
        function row($i,$w1,$w2,$w3,$c1,$c2,$c3,$id,$alb){
            $b='';
            //AICI SUNT PROBLEME
            if ($i>10)
            $i=$i-(10*(return_param(3)-1));
            $height="70";
            
            if ($alb==true){
                if ($i%2==0) $b.='<div class="avg2 row'.$i.'" style="height:'.$height.'px">';
                else $b.='<div class="avg1 row'.$i.'" style="height:'.$height.'px">';         
            }
            else {
                if ($i%2==0) $b.='<div class="avg1 row'.$i.'" style="height:'.$height.'px">';
                else $b.='<div class="avg2 row'.$i.'" style="height:'.$height.'px">';  
            }
            
            $p2=self_href(false,return_topic(),return_param(1),"delrow",return_param(3),$id);
            $p1=self_href(false,return_topic(),return_param(1),"editrowNews",return_param(3),$id);
            $b.='   
                    <div class="stanga" style="height:'.$height.'px"></div>
                    <div class="avg" style="width:'.$w1.'px; height:'.$height.'px"><div style="padding:5px; text-align:left;">'.$c1.'</div></div>
                    <div class="sep" style="height:'.$height.'px"></div>
                    <div class="avg" style="width:'.$w2.'px; height:'.$height.'px"><div style="padding:5px; text-align:left;">'.$c2.'</div></div>
                    <div class="sep" style="height:'.$height.'px"></div>
                    <div class="avg" style="width:'.$w3.'px; height:'.$height.'px"><div style="padding:5px; text-align:left;">'.$c3.'</div></div>
                    <div class="dreapta" style="height:'.$height.'px">';
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
        
        $data_row="";
        
        $p=0;
        $c1_=$c2_=$c3_="";
        if ($q!=null)
        while($rows=mysql_fetch_assoc($q)){
            $p+=1;
            /* AICI SE STABILESTE CONTINUTUL */
            /* AICI SE STABILESTE CONTINUTUL */
            
            if ($c1=="") $c1_=$rows["data"];
            else $c1_=$c1;
            if ($c2=="") $c2_=$rows["titlu"].'<br/>Durata: '.$rows["durata"]."<br/>Lectori: ".$rows["lectori"];
            else $c2_=$c2;
            if ($c3=="") $c3_='';
            else {
                $c3_=$c3;
                $c3_=str_replace("%%detalii%%",'<a href="'.self_href(false,return_topic(),return_param(1),"",return_param(3),$rows["id"]).'" style="position:relative; top:4px;">Click pentru detalii</a>',$c3_);
            }
            
            /* AICI SE STABILESTE CONTINUTUL */
            /* AICI SE STABILESTE CONTINUTUL */
            
            $start_interval=1;
            $i=(Int)(mysql_num_rows($q)/numar_de_randuri);$i++;
            $numrows=mysql_num_rows($q);
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
                $p1=self_href(false,return_topic(),return_param(1),"editrowNews",return_param(3),$rows["id"]);
                $last_row=
                '   
                <div class="bottom">
                        <div class="stanga" style="height:'.$height.'px">
                            <div style="background-color:#DEDEDE; height:'.($height-41).'px;" class="delayed_start"></div>
                        </div>
                        <div class="avg" style="width:'.($w1+1).'px; height:'.$height.'px;"><div style="padding:5px; text-align:left;">
                        '.$c1_.'
                        </div></div>
                        <div class="sep" style="height:'.$height.'px"></div>
                        <div class="avg" style="width:'.$w2.'px; height:'.$height.'px;"><div style="padding:5px; text-align:left;">
                        '.$c2_.'
                        </div></div>
                        <div class="sep" style="height:'.$height.'px"></div>
                        <div class="avg" style="width:'.$w3.'px; height:'.$height.'px;"><div style="padding:5px; text-align:left;">
                        '.$c3_.'
                        </div></div>
                        <div class="dreapta" style="height:'.$height.'px">';
                            if (is_secure())
                            $last_row.='<div style="position:absolute; display:block; width:80px; height:40px;">
                                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                                    <img src="'.get_image("planif.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                                </a>
                                <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                                    <img src="'.get_image("delete-icon.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                                </a>
                            </div>';
                            $last_row.='<div style="background-color:#DEDEDE; height:'.($height-41).'px;" class="delayed_start"></div>
                        </div>
                    </div>      
                ';
            }else{
                if ($end_interval%2==0) $alb=true;
                else $alb=false;
                
                $data_row.=row($p,$w1,$w2,$w3,$c1_,$c2_,$c3_,$rows["id"],$alb);
            }//Se incheie verificarea daca sa afiseze sau nu randul editat
        }  //Se incheie while parcurge lista
      
        if (!isset($last_row)) $last_row='Ne pare rau, momentan nu sunt stiri disponibile. Va rugam reveniti mai tarziu.';
        $body.='
            <div style="height:20px; width:940px; display:block;"></div>
            <div class="top">
                <div class="stanga"></div>
                <div class="avg" style="width:'.($w1+1).'px;"><div class="avgtext">'.$t1.'</div></div>
                <div class="sep"></div>
                <div class="avg" style="width:'.$w2.'px;"><div class="avgtext">'.$t2.'</div></div>
                <div class="sep"></div>
                <div class="avg" style="width:'.$w3.'px;"><div class="avgtext">'.$t3.'</div></div>
                <div class="dreapta"></div>
            </div>
                '.$data_row.'
                '.$last_row.'
                <div style="height:10px; width:940px; display:table;"></div>';
                
                if (mysql_num_rows($q)>numar_de_randuri){
                    $body.='
                    <div style="cursor:pointer; height:20px; width:940px; display:block; text-align:right; padding-top:10px; padding-bottom:10px;">
                    <div style="display:inline; float:right; height:20px; width:22px; text-align:center; margin-left:2px; margin-right:10px; padding-top:2px;">
                        <img src="'.get_image("right.gif").'" alt="left" />
                    </div>';
                    for ($i=(Int)(mysql_num_rows($q)/numar_de_randuri); $i>=0; $i--){
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