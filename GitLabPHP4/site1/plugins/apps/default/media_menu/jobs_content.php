<?php
    
    //Function required
    include('job_table.php');
    $header.=insert_js("jquery.watermark.min.js");
    $header.=insert_js("jquery.autocomplete.js");

    if (is_secure()&&return_param(2)=="edit"){
            $titlu_pagina='Titlul paginii: <input type="text" maxlength="100" name="title" id="title_in" value="'.get_column($dba->selected_table(),"id=".return_param(1),"titlu").'"/>';
            $continut_pagina='<textarea style="width:'.($width).'px; height:'.($height+200).'px;" id="content" name="content">'.get_column($dba->selected_table(),"id=".return_param(1),"continut").'</textarea>';
    }
    
    
    if (return_topic()!=""&&return_param(2)!="edit"){
        if (return_param(1)!=""){
           $titlu_pagina=get_column("media_menu_recrutarepersonal_".return_language(),"id=".$set_id,"titlu");
           $p1="javascript:document.getElementById('sortForm').submit()"; 
           $te='<div style="text-align:center; font-weight:bold; position:relative;">
                    <form id="sortForm" method="post" action="'.self_href(false,return_topic(),return_param(1)).'">
                        <div class="avgtext">
                        Categorie: 
                        <div style="display:inline-block; position:relative; top:4px; width:240px; height: 19px; overflow: hidden; background: url('.get_image("arrow_down.gif").') no-repeat right #fff;">
                        <select name="_categorie" onchange="'.$p1.'" style="width:260px; border:none; padding:0px; background-color:transparent;">';
                        $q=mysql_query("SELECT DISTINCT categorie FROM jobs;");
                        $te.='<option value="auf">Oricare</option>'."\n";
                        if ($q!=null)
                        while($rows=mysql_fetch_assoc($q)){
                            $te.='<option value="'.$rows["categorie"].'" ';
                            if (return_post("_categorie")==$rows["categorie"]) $te.='selected="true"';
                            $te.='>'.$rows["categorie"].'</option>';
                        }
           $te.='       </select>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Oras: 
                        <div style="display:inline-block; position:relative; top:4px; width:240px; height: 19px; overflow: hidden; background: url('.get_image("arrow_down.gif").') no-repeat right #fff;">
                        <select name="_oras" onchange="'.$p1.'" style="width:260px; border:none; padding:0px; background-color:transparent;">';
                        $q=opentb("orase","1=1");
                        $te.='<option value="auf">Oricare</option>'."\n";
                        if ($q!=null)
                        while($rows=mysql_fetch_assoc($q)){
                            $te.='<option value="'.$rows["id"].'" ';
                            if (return_post("_oras")==$rows["id"]) $te.='selected="true"';
                            $te.='>'.$rows["nume"].'</option>';
                        }
           $te.='       </select>
                        </div>
                        </div>
                    </form>
                </div>
           ';         
           if (is_secure()==false)
           $continut_pagina=tray_bar($te);
           
            //Adauga date in tabel, n-am gasit o varianta mai buna inca
            include("jobs_db_model.php");
            if (is_secure()){
                
                $dba2=new jobs_model();
                
                    if (return_post("data2")!=""&&return_post("post2")!=""&&return_post("oras2")!=""&&return_post("desc2")!=""&&return_post("cat2")!=""){
                        $dba2->add_content(return_post("post2"),return_post("oras2"),return_post("data2"),return_post("desc2"),return_post("cat2"),return_param(4));
                    }
               
                    if (return_post("data")!=""&&return_post("post")!=""&&return_post("oras")!=""&&return_post("desc")!=""&&return_post("cat")!=""){
                        $dba2->add_content(return_post("post"),return_post("oras"),return_post("data"),return_post("desc"),return_post("cat"));
                    }
                
            }
            if (is_secure()){
                
                $dba2=new jobs_model();
                if (return_param(2)=="delrow"){
                    $dba2->delete_job(return_param(4));
                }
            }
           
           //if (is_secure()){$continut_pagina.='<form id="articleEdit" action="'.self_href(false,return_topic(),return_param(1)).'" method="post">';}
           
           $continut_pagina.=job_table($header);
           
           //if (is_secure()){$continut_pagina.='</form>';}
           //CV UPLOAD APP
           include('cv_upload.php');
        }
    }
    
    
    
    if ($continut_pagina==""){
        $continut_pagina.='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000DBE
        </div>';
    }
?>