<?php 
        //************************************
        //*Prelucreaza informatia din headere
        //************************************
        if (return_param()=="") {
            if (return_topic()!="") $topic="/".return_topic();
            else {if (num_rows($dba->table_name(true),"1=1")>0) $topic="/".get_column($dba->table_name(true),"ordine=1","id");
            else $topic='/notopic';}
            $p1=absolute_path().return_language().$topic.'/contactGalleryAddDept/'.get_file();
            $p2=absolute_path().return_language().$topic.'/contactGalleryAddPers/'.get_file();
            
            $body .= '<div style="display:block; width:'.($width-20).'px; height:24px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.absolute_path().'plugins/images/edit.png" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<contact_gallery_adauga_dept>]","[</contact_gallery_adauga_dept>]").'</a>&nbsp;&nbsp;&nbsp;
                ';
            if (num_rows($dba->table_name(true),"1=1")>0)
            $body.='
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.absolute_path().'plugins/images/edit.png" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<contact_gallery_adauga_pers>]","[</contact_gallery_adauga_pers>]").'</a>&nbsp;&nbsp;&nbsp;
            ';
            $body.='
            </div>';
        }
        if (return_param()=="contactGalleryAddDept"||return_param()=="contactGalleryAddPers"){
            if (return_topic()!="") $topic="/".return_topic();
            else {if (num_rows($dba->table_name(true),"1=1")>0) $topic="/".get_column($dba->table_name(true),"ordine=1","id");
            else $topic='/notopic';}
            $p2=absolute_path().return_language().$topic.'/'.get_file();
            $body.='<a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/arrow-left.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<contact_gallery_bk>]","[</contact_gallery_bk>]").'</a>&nbsp;
            ';
        }
        
        //************************************
        //*Aplica modificari
        //************************************
        if (allow_edit()==true&&return_param()=="menuArticleMenuDel"){
            $dba->delete_page(get_column($dba->table_name(),"ordine=".num_rows($dba->table_name(),"1=1"),"id"));
            $body.='<script type="text/javascript">location.href="'.link_1e($_GET["topic"]).'"</script>';
        }
        if (allow_edit()==true&&isset($_POST["add_dept"])&&$_POST["add_dept"]!=""){
            $dba->add_dept($_POST["add_dept"]);
            $body.='<script type="text/javascript">location.href="'.link_1e($_GET["topic"]).'"</script>';
        }
        if (allow_edit()==true&&isset($_POST["nume"])&&$_POST["nume"]!=""&&(StartsWith($_GET["param"],"savePerson")==false)&&
        isset($_POST["fct"])&&$_POST["fct"]!=""&&
        isset($_POST["tel1"])&&$_POST["tel1"]!=""&&
        isset($_POST["mail1"])&&$_POST["mail1"]!=""){
             if (return_topic()!="") $topic_=return_topic();
            else if (num_rows($dba->table_name(true),"1=1")>0) $topic_="1";
            $a=''; $b=''; $img='';
            if (isset($_POST["tel2"])&&$_POST["tel2"]!="") $a=$_POST["tel2"];
            if (isset($_POST["mail2"])&&$_POST["mail2"]!="") $b=$_POST["mail2"];
            $dba->add_person($_POST["nume"],$img,$_POST["fct"],$_POST["tel1"],$_POST["mail1"],$topic_,$a,$b);
            $body.='<script type="text/javascript">location.href="'.link_1e($_GET["topic"]).'"</script>';
        }
        //STERGE O PERSOANA
        if (allow_edit()==true&&isset($_GET["topic"])&&isset($_GET["param"])){
            if (StartsWith($_GET["param"],"delPerson")==true) {
                $dba->delete_person(substr($_GET["param"],9));
                $body.='<script type="text/javascript">location.href="'.link_1e($_GET["topic"]).'"</script>';
            }
            if (StartsWith($_GET["param"],"savePerson")==true) {
                if (isset($_POST["nume"])&&isset($_POST["fct"])&&isset($_POST["tel1"])&&isset($_POST["tel2"])&&isset($_POST["mail1"])
                &&isset($_POST["mail2"])) {
                    $dba->update_person(substr($_GET["param"],10),$_POST["nume"],"",
                    $_POST["fct"],$_POST["tel1"],$_POST["mail1"],$_POST["tel2"],$_POST["mail2"]);
                    $body.='<script type="text/javascript">location.href="'.link_1e($_GET["topic"]).'"</script>';
                }
            };
        }
        if (allow_edit()==true&&isset($_GET["topic"])&&StartsWith($_GET["topic"],"DeleteDept")==true){
            $dba->delete_dept(substr($_GET["topic"],10));
            $body.='<script type="text/javascript">location.href="'.link_1e("1").'"</script>';
        }
?>