<?php

if (has_access())
{ 
 if (isset($_GET["delete_req"])&&$_GET["delete_req"]!=""){
    if (isset($_SESSION["S_ID"]))
    $razor="delete_req";
 }
 
 $dba = new query_manager_model();
 if (isset($_GET["addnew"])&&$_GET["addnew"]=="1")
 {

     if ((return_post("c")!="")&&(return_post("d")!="")&&(return_post("ns")!="")
     &&(return_post("car")!="")&&(return_post("merc")!="")&&(return_post("vol")!="")
     &&(return_post("tt")!="")&&(return_post("sn")!="")&&(return_post("sd")!="")
     &&(return_post("se")!="")&&(return_post("doc")!="")){
        $dba->add_content($dba->next(),return_post("c"),return_post("d"),return_post("ns"),return_post("car"),return_post("merc")
        ,return_post("vol"),return_post("tt"),return_post("sn"),return_post("sd"),return_post("se"),return_post("doc"),return_post("ins")
        ,0,0);
     }
     else
     echo 'Something went wrong, query failed!';
     /*echo (return_post("c")!="");echo (return_post("d")!="");echo (return_post("ns")!="")
     ;echo (return_post("car")!="");echo (return_post("merc")!="");echo (return_post("vol")!="")
     ;echo (return_post("tt")!="");echo (return_post("sn")!="");echo (return_post("sd")!="")
     ;echo (return_post("se")!="");echo (return_post("doc")!="");*/
 }
 
 if (return_random_tag("editnow")&&num_rows($dba->selected_table(),"id=".return_random_tag("editnow"))!=0)
 {
     if ((return_post("c")!="")&&(return_post("d")!="")&&(return_post("ns")!="")
     &&(return_post("car")!="")&&(return_post("merc")!="")&&(return_post("vol")!="")
     &&(return_post("tt")!="")&&(return_post("sn")!="")&&(return_post("sd")!="")
     &&(return_post("se")!="")&&(return_post("doc")!="")){
        $dba->add_content(return_random_tag("editnow"),return_post("c"),return_post("d"),return_post("ns"),return_post("car"),return_post("merc")
        ,return_post("vol"),return_post("tt"),return_post("sn"),return_post("sd"),return_post("se"),return_post("doc"),return_post("ins")
        ,0,0);
     }
      else
     echo 'Something went wrong, query failed!';
 }
 
 if (return_random_tag("send")&&num_rows($dba->selected_table(),"id=".return_random_tag("send"))!=0){
    $dba->send_touch(return_random_tag("send"));
 }
 if (return_random_tag("alles_gut")&&num_rows($dba->selected_table(),"id=".return_random_tag("alles_gut"))!=0){
    $dba->ok_touch(return_random_tag("alles_gut"));
 }
 if (return_random_tag("delnow")&&num_rows($dba->selected_table(),"id=".return_random_tag("delnow"))!=0){
    $dba->delete(return_random_tag("delnow"));
 }
    
}


?>