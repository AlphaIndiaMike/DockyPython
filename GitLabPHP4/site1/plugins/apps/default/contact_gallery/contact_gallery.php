<?php
include('db_model.php');
include('editing_object.php');

function contact_gallery($File,&$header,$width=700)
{
    
    
    $body='';
    $dba=new contact_gallery_model(return_language());
    
    /***************TOPIC***************************************/
    $default_dept=get_column($dba->table_name(true),"ordine=1","id");
    if (return_topic()!="")$default_dept=return_topic();
    /*****************************************************************/
    
    if (allow_edit()=="true"){
        $body.='
        <div style="width:'.($width).'px; margin-top:10px; margin-bottom:10px; position:relative; height:40px;">';
            include('editing_options.php');
        $body.='</div>';//Inchide div-ul de setari
    }
    $body.='<div class="gallery_top">';
    $body.='<p class="titlu_mare">'.read_content($File,"[<contact_gallery_title>]","[</contact_gallery_title>]").'</p>';
    /*******************************************************/
    $SQL = "SELECT id,nume,ordine FROM ".$dba->table_name(true)." WHERE 1=1 ORDER BY ordine ASC;";
    $result = mysql_query($SQL);
    $body.='<ul class="dept_list">';
    if ($result!=null)
    while ($db_field = mysql_fetch_assoc($result)) {
         $body.='<li class="floatleft dept_name"><img src="'.absolute_path().'/plugins/images/icon_tel.png" width="16" height="16" alt="#" />
            ';
            if (allow_edit()==true){
                $body.='
                <a href="'.link_1e("DeleteDept".$db_field["id"]).'" class="image_link">
                    <img src="'.absolute_path().'/plugins/images/delete-icon.png" width="16" height="16" alt="#" />
                </a>';
            }
         $body.='
            <a href="'.link_1e($db_field["id"]).'" '; 
            if ($default_dept==$db_field["id"]) $body.='class="selected_dept"';
            else $body.='class="dept_name"';
            $body.='>'.$db_field["nume"].'</a>&nbsp;
         </li>'; 
    } 
    $body.='</ul>'; 
    //ADAUGA DEPARTAMENT*//
    if (return_param()=="contactGalleryAddDept"){
         if (return_topic()!="") $topic="/".return_topic();
            else {if (num_rows($dba->table_name(true),"1=1")>0) $topic="/".get_column($dba->table_name(true),"ordine=1","id");
            else $topic='/notopic';}
         $p2=absolute_path().return_language().$topic.'/'.get_file();
         if (allow_edit()==true){
               $body.='<br/>
                <form action="'.$p2.'" method="post">
                    <input type="text" value="" class="menu_edit_textbox" id="add_dept" name="add_dept" maxlength="100"/> 
                    <input type="submit" class="menu_edit_submitbtn" value=" " style="position:relative;"/>
                </form>';
            }
    }

    /********************************************************/
    $body.='</div>';
    $body.='<br/><br/><hr/>';
    $body.='<div class="gallery_content">';
    /*******************************************************/
     /***************COMENZI SQL***************************************/
    if (return_topic()=="") $SQL = "SELECT id,nume,img,functie,tel1,tel2,mail1,mail2,depart_id FROM ".$dba->table_name()." WHERE depart_id=".$default_dept." order by ordine asc;";
    else $SQL = "SELECT id,nume,img,functie,tel1,tel2,mail1,mail2,depart_id FROM ".$dba->table_name()." WHERE depart_id=".return_topic()." order by ordine asc;";
    $result = mysql_query($SQL);
    /*****************************************************************/
    /**************SCRIE TITLU*************************************/
    $body.='<p class="titlu_mare">'.read_content($File,"[<contact_gallery_intro>]","[</contact_gallery_intro>]").
        get_column($dba->table_name(true),"id=".$default_dept, "nume").
    '</p>';
    /**************************************************************/
    if ($result!=null)
    while ($db_field = mysql_fetch_assoc($result)) {
        if (allow_edit()==true&&isset($_GET["topic"])&&isset($_GET["param"])&&(StartsWith($_GET["param"],"editPerson")==true)&&substr($_GET["param"],10)==$db_field["id"]){
            $body.=editing_object(substr($_GET["param"],10));//EDITING OPTION
        }
        else{
        $img='<img src="'.absolute_path().$db_field["img"].'" alt="'.$db_field["nume"].'" width="120" height="120"/>';
        if ($db_field["img"]=="") $img='<div style="width:120px; height:120px; border:solid 1px #999;">&nbsp;</div>';
        
        $body.='<div class="floatleft gallery_item">';
        
            if (allow_edit()==true){
                $body.='
            <div class="featurebox_white" style="text-align:right;">
                <a href="'.link_2e($db_field["depart_id"],"editPerson".$db_field["id"]).'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.absolute_path().'plugins/images/edit.png" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.link_2e($db_field["depart_id"],"editPerson".$db_field["id"]).'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
                <a href="'.link_2e($db_field["depart_id"],"delPerson".$db_field["id"]).'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/trash.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.link_2e($db_field["depart_id"],"delPerson".$db_field["id"]).'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Delete</a>   
            </div>';
            }
            
            $body.='<div style="position:relative; margin:10px; width:120px; height:120px;" class="floatleft">
                '.$img.'
            </div>
            
                <p class="titlu_mijlociu">'.$db_field["nume"].'<br/>
                    <a class="text_italic">'.$db_field["functie"].'</a>
                </p>
                <p class="text_simplu">
                    Tel: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'.$db_field["tel1"].'</b> <br/>';
                    if ($db_field["tel2"]!="") $body.='Tel(2):&nbsp; <b>'.$db_field["tel2"].'</b> <br/>';
                    else $body.='<br/>';
            $body.='
                </p>
                <a href="'.link_2e($db_field["id"],"SendMessage").'" class="send">Scrieti mesaj</a><br/><br/>
                <p class="text_simplu">
                    Mail : <b>'.$db_field["mail1"].'</b> <br/>';
                    if ($db_field["mail2"]!="") $body.='Mail(2): <b>'.$db_field["mail2"].'</b> <br/>';
            $body.='
                </p>
            
        </div>'; 
        }
    }
    
    //ADAUGA PERSOANA*//
    if (return_param()=="contactGalleryAddPers"&&(num_rows($dba->table_name(true),"1=1")>0)){
         if (return_topic()!="") $topic="/".return_topic();
         else if (num_rows($dba->table_name(true),"1=1")>0) $topic="/".get_column($dba->table_name(true),"ordine=1","id");
         
         $p2=absolute_path().return_language().$topic.'/'.get_file();
         if (allow_edit()==true){ $body.=editing_object(); }
    }
    /********************************************************/
    $body.='</div>';
    return $body;
}
?>