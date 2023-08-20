<?php 
        //************************************
        //*Prelucreaza informatia din headere
        //************************************
        if (return_param()=="") {
            if (return_topic()!="") $topic="/".return_topic();
            else $topic="/".get_column($dba->table_name(),"ordine=1","tag");
            $p1=absolute_path().return_language().$topic.'/menuArticleEdit/'.get_file();
            $p2=absolute_path().return_language().$topic.'/menuArticleMenuEdit/'.get_file();
            
            $body .= '<div style="display:block; width:'.($width-20).'px; height:24px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.absolute_path().'plugins/images/edit.png" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_edit>]","[</menu_article_edit>]").'</a>&nbsp;&nbsp;&nbsp;
                <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/menu-icon.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_submenu>]","[</menu_article_submenu>]").'</a>
                
            </div>';
        }
        if (return_param()=="menuArticleEdit"){
            if (return_topic()!="") $topic="/".return_topic();
            else $topic="/".get_column($dba->table_name(),"ordine=1","tag");
            $p1="javascript:document.getElementById('articleEdit').submit()"; 
            $p2=absolute_path().return_language().$topic.'/'.get_file();
            
            $body .= '<div style="display:block; width:'.($width-20).'px; height:24px; text-align:right; padding-right:20px;">
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                    <img src="'.absolute_path().'plugins/images/ok-icon.png" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_save>]","[</menu_article_save>]").'</a>&nbsp;&nbsp;&nbsp;
                <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/delete-icon.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_cancel>]","[</menu_article_cancel>]").'</a>
                
            </div>';
        }
        if (return_param()=="menuArticleMenuEdit"||return_param()=="menuArticleMenuAdd"||return_param()=="menuArticleMenuDel"){
            if (return_topic()!="") $topic="/".return_topic();
            else $topic="".get_column($dba->table_name(),"ordine=1","tag");
            $p1=absolute_path().return_language().$topic.'/menuArticleMenuAdd/'.get_file();
            $p3=absolute_path().return_language().$topic.'/menuArticleMenuDel/'.get_file();
            $p2=absolute_path().return_language().$topic.'/'.get_file();
            
            $body .= '<div style="display:block; width:'.($width-20).'px; height:24px; text-align:right; padding-right:20px;">
                <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/arrow-left.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_bk>]","[</menu_article_bk>]").'</a>&nbsp;
            
                <a href="'.$p1.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/add-icon.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_adauga>]","[</menu_article_adauga>]").'</a>&nbsp;
                <a href="'.$p3.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                    <img src="'.absolute_path().'plugins/images/delete-icon.png" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                </a>
                <a href="'.$p3.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;'.read_content($File,"[<menu_article_sterge>]","[</menu_article_sterge>]").'</a>
                
            </div>';
        }
        //************************************
        //*Aplica modificari
        //************************************
        if (allow_edit()==true&&return_param()=="menuArticleMenuDel"){
            $dba->delete_page(get_column($dba->table_name(),"ordine=".num_rows($dba->table_name(),"1=1"),"id"));
        }
        if (allow_edit()==true&&isset($_POST["add_new_page"])&&$_POST["add_new_page"]!=""&&isset($_POST["add_new_page_tag"])&&$_POST["add_new_page_tag"]!=""&&StartsWith(return_param(),"AddSubmit")==false){
            $dba->add_page($_POST["add_new_page"],"","",$_POST["add_new_page_tag"]);
        }
        if (allow_edit()==true&&isset($_POST["add_new_page"])&&$_POST["add_new_page"]!=""&&isset($_POST["add_new_page_tag"])&&$_POST["add_new_page_tag"]!=""&&StartsWith(return_param(),"AddSubmit")==true){
            $dba->add_page($_POST["add_new_page"],"",substr(return_param(),9),$_POST["add_new_page_tag"]);
        }
        if (allow_edit()==true&&return_param()=="menuArticleMenuEdit"){
            for ($i=1; $i<=num_rows($dba->table_name(),"1=1"); $i++){
                if (isset($_POST['d'.$i]))$dba->update_page_name(get_column($dba->table_name(),"ordine=".$i,"id"),$_POST['d'.$i]);
            }
        }
        if (allow_edit()==true&&isset($_POST["base_Article_text"])){
            $dba->add_content($_POST["base_Article_text"], return_topic());
        }
?>