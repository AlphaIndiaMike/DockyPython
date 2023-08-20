<?php
if (is_secure()&&return_param(2)=="edit"){
            $id_p=return_param(1);
            if ($id_p==0) $id_p=100;
            $body.='<form id="articleEdit" action="'.self_href(false,return_topic(),return_param(1)).'" method="post">';
            $titlu_pagina='Titlul paginii: <input type="text" maxlength="100" name="title" id="title_in" value="'.get_column($dba->selected_table(),"id=".$id_p,"titlu").'"/>';
            $continut_pagina='<textarea style="width:'.($width).'px; height:'.($height+200).'px;" id="content" name="content">'.get_column($dba->selected_table(),"id=".$id_p,"continut").'</textarea>';
            $continut_pagina.='</form>';
    }
    if (return_topic()!=""&&return_param(2)!="edit"){
        if (return_param(1)!=""&&($set_id!=0)){
           $titlu_pagina=get_column($dba->selected_table(),"id=".$set_id,"titlu");
           $continut_pagina=get_column($dba->selected_table(),"id=".$set_id,"continut");
        }
    }
    
    /*if (is_secure()){
        $body.='
        
    }*/
    
    if ($continut_pagina==""){
        $continut_pagina.='<div class="std" style="display:inline-block; width:400px; padding:10px; color:#004083;">
            Application under development.<br />
            We are sorry for the inconvinience but this page`s content cannot be displayed. Our development team is making all efforts to display the content soonest possible. 
            <br/>Please come back later and thank you for your patience. x000DBE
        </div>';
    }
    
    if (!return_param(2)=="edit"&&$set_id!=0&&return_param(1)!=""){
        if (get_column($dba->selected_table(),"id=100","titlu")!="") $continut_pagina.=back_btn();
    }
?>