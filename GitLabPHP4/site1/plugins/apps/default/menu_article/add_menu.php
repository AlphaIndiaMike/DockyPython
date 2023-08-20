<?php 
    function add_title_obj($arr, $File, $pi, $table){
    $body='';
    $str1='';$str01='';$str2='';$str02='';
    $t1='';$i1='';$tg1='';
    if (return_topic()!="") $topic="/".return_topic();
    else $topic="";
    $p2=absolute_path().return_language().$topic.'/menuArticleMenuEdit/'.get_file();
    $p1=absolute_path().return_language().$topic.'/AddSub'.$pi.'/'.get_file();
    /*CREAZA CONTINUT */
     if (return_param()=="menuArticleMenuEdit"&&allow_edit()==true){
        $str01='
        <form action="'.$p2.'" method="post">
            <input type="text" value="'.$arr["titlu"].'" class="menu_edit_textbox" id="d'.$pi.'" name="d'.$pi.'" maxlength="100"/>
            <input type="submit" class="menu_edit_submitbtn" value=" "/>
            <a style="text-decoration:none; font-size:10pt; top:6px; position:relative; color:transparent;" href="'.$p1.'">
                <img src="'.absolute_path().'plugins/images/add-icon24.png" alt="Add subitem" width="24" height="24"/>
            </a>
        </form>
        ';
        $str02=$str01;
     }
     else{ 
        $str01='<p class="selected_option"><a class="selected_option" href="'.link_1($File,trim($arr["tag"])).'">'.$arr["titlu"].'</a></p>';
        $str02='<p class="option"><a class="option" href="'.link_1($File,trim($arr["tag"])).'">'.$arr["titlu"].'</a></p>';
     }
    if (return_topic()!="") $pi=-1;
    //******************************************************
    if ($arr["link"]==""){
        if ($arr["tag"]==return_topic()||$pi==1) $body.=$str01;
        else $body.=$str02;
    }
    if ($arr["sub_number"]!=0&&$arr["sub_number"]!=""){
        if (return_param()!="menuArticleMenuEdit"||allow_edit()!=true)$body.="\n".'<ul class="menu_article_ul">'."\n";
        
        $SQL = "SELECT id,titlu,ordine,tag FROM ".$table." WHERE link=".$arr["id"]." ;";
        $result = mysql_query($SQL);
        
        while ($db_field = mysql_fetch_assoc($result)) {
            $i1=$db_field["ordine"];
            $t1=$db_field["titlu"];
            $tg1=$db_field["tag"];
            /**********************CREAZA CONTINUT **************************/
            if (return_param()=="menuArticleMenuEdit"&&allow_edit()==true){
                $str1='<div>
                <form action="'.$p2.'" method="post" style="float:right;">
                    <input type="text" value="'.$t1.'" class="menu_edit_textbox" id="d'.$i1.'" name="d'.$i1.'" maxlength="100"/>
                    <input type="submit" class="menu_edit_submitbtn" value=" " style="position:relative;"/>
                </form></div>';
                $str2=$str1;
            }
            else{
                 $str1='<li class="selected_option"><a class="selected_option" href="'.link_1($File,trim($tg1)).'">'.$t1.'</a></li>';
                 $str2='<li class="option"><a class="option" href="'.link_1($File,trim($tg1)).'">'.$t1.'</a></li>';
            }
            /**********************CREAZA CONTINUT **************************/
            //Afiseaza*******************************************************
            if ($db_field["tag"]==return_topic()||$pi==1) $body.=$str1;
            else $body.=$str2;
        }  
        if (return_param()!="menuArticleMenuEdit"||allow_edit()!=true) $body.="\n".'</ul>'."\n";
    } 
    return $body;
}

//*******************************
//* Submenu section
//*******************************
//Verific daca un subarticol e selectat
$subarticol=-1;
if (return_topic()!=""&&get_column($dba->table_name(),"tag='".return_topic()."'","link")!=""){
    $idt=get_column($dba->table_name(),"tag='".return_topic()."'","link");
    $subarticol=get_column($dba->table_name(),"id=".$idt,"ordine");
}
//

    for ($i=1; $i<=num_rows($dba->table_name(),"1=1"); $i++){
        $arr=opentb($dba->table_name(),"ordine=".$i);//Citeste informatia
        //Afiseaza
        if ($i==1) $body.='<div class="quad_0">'."\n";
        //Verific daca e principal
        if (($i==1&&return_topic()=="")||(return_topic()==$arr["tag"])||($subarticol!=-1&&$subarticol==$i)){
            //E principal
            $body.='</div>
            <div class="quad_1">'."\n";
            $body.=add_title_obj($arr,$File,$i,$dba->table_name())."\n";
            if ($arr["link"]=="") $quad=1;
        }
        else{
            //Nu e principal
            if ($quad==1) {
                if ($arr["link"]=="") {//A venit un nod principal nou care nu e selectat
                    $quad=2; $body.='</div>'."\n"; $body.='<div class="quad_2" style="height:'.(int)(($height)-(30*$i)-30).'px">'."\n";
                }
            }
            $body.=add_title_obj($arr,$File,$i,$dba->table_name())."\n";
        }
    }
    //Inchide totusi lista cu div-ul de footer
    if ($quad==1){
        $quad=2; $body.='</div>'."\n"; $body.='<div class="quad_2" style="height:'.(int)(($height)-(30*$i)-30).'px">'."\n";
    }
    //Formular adauga pagina noua
    if (return_topic()!="") $topic="/".return_topic();
    else $topic="/".get_column($dba->table_name(),"ordine=1","tag");
    $p2=absolute_path().return_language().$topic.'/menuArticleMenuEdit/'.get_file();
    if (allow_edit()==true&&return_param()=="menuArticleMenuAdd"){
        $body.='
        <form action="'.$p2.'" method="post" style="padding-top:10px;" class="small_text">
            '.read_content($File,"[<menu_article_add>]","[</menu_article_add>]").'<br/><input type="text" value="" class="menu_edit_textbox" id="add_new_page" name="add_new_page" maxlenght="100"/><br/>
            '.read_content($File,"[<menu_article_add_tag>]","[</menu_article_add_tag>]").'<br/><input type="text" value="" class="menu_edit_textbox" id="add_new_page_tag" name="add_new_page_tag" maxlenght="100"/>
            <input type="submit" class="menu_edit_submitbtn" style="position:relative; top:-6px;" value=""/>
        </form>
        ';
    }
    if (allow_edit()==true&&StartsWith(return_param(),"AddSub")==true){
        $body.='
        <form action="'.absolute_path().return_language().$topic.'/AddSubmit'.get_column($dba->table_name(),"ordine=".substr(return_param(),6),"id").'/'.get_file().'" method="post" style="padding-top:10px;" class="small_text">
            '.read_content($File,"[<menu_article_add>]","[</menu_article_add>]").'<br/><input type="text" value="" class="menu_edit_textbox" id="add_new_page" name="add_new_page" maxlenght="100"/><br/>
            '.read_content($File,"[<menu_article_add_tag>]","[</menu_article_add_tag>]").'<br/><input type="text" value="" class="menu_edit_textbox" id="add_new_page_tag" name="add_new_page_tag" maxlenght="100"/>
            <input type="submit" class="menu_edit_submitbtn" style="position:relative; top:-6px;" value=""/>
        </form>
        ';
    }
    if (num_rows($dba->table_name(),"1=1")>0) $body.="\n".'</div>';//Inchide ultimul div   
    else if (allow_edit()==true&&return_param()=="menuArticleMenuAdd") $body.="\n".'</div>';
?>