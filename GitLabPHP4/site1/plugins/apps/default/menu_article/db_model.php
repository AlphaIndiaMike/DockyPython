<?php 
class menu_article_model{
    static $selected_table="";
    
    function __construct($page_title,$lang) {
         if (check_table('menu_article_'.$page_title.'_'.$lang) ==false){
         run_query("CREATE TABLE ".'menu_article_'.$page_title.'_'.$lang." (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, titlu VARCHAR(255) NOT NULL, continut TEXT, link INT, sub_number INT, ordine INT, tag VARCHAR(255));");
         run_query("ALTER TABLE ".'menu_article_'.$page_title.'_'.$lang." ENGINE = MYISAM;");
         run_query("ALTER TABLE ".'menu_article_'.$page_title.'_'.$lang." ADD FULLTEXT (titlu, tag);");
         }
         $this::$selected_table='menu_article_'.$page_title.'_'.$lang;
    
    /*mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function add_page($titlu, $continut, $link='', $tag=''){
        if ($link!='')
        {
            run_query("INSERT INTO ".$this::$selected_table." (id,titlu,continut,link,sub_number,ordine,tag) 
            VALUES (NULL,'".$titlu."','".$continut."',".$link.",NULL,NULL,'".$tag."');");
            $sub=get_column($this::$selected_table,"id=".$link,"sub_number");
            run_query("UPDATE ".$this::$selected_table." SET sub_number=".($sub+1)." WHERE id=".$link." ;");
        }
        else{
            run_query("INSERT INTO ".$this::$selected_table." (id,titlu,continut,link,sub_number,ordine,tag) 
            VALUES (NULL,'".$titlu."','".$continut."',NULL,0,NULL,'".$tag."');");
        } 
        run_query("UPDATE ".$this::$selected_table." SET ordine=".(num_rows($this::$selected_table,"1=1"))." WHERE titlu='".$titlu."';");
    }
    
    public function add_content($content, $tag=""){
        if ($tag!="")
        run_query("UPDATE ".$this::$selected_table." SET continut='".$content."' WHERE tag='".$tag."';");
        else
        run_query("UPDATE ".$this::$selected_table." SET continut='".$content."' WHERE ordine=1;");
    }
    
    public function update_page_name($id, $name_new){
        run_query("UPDATE ".$this::$selected_table." SET titlu='".$name_new."' WHERE id=".$id.";");
    }
    
    public function update_page_number($id, $name_new){
        run_query("UPDATE ".$this::$selected_table." SET ordine=".$name_new." WHERE id=".$id.";");
    }
    
    public function update_page_rank($id, $link=-1){
        if ($link==(-1)) {
            if (get_column($this::$selected_table,"id=".$id,"link")!=NULL){
            run_query("UPDATE ".$this::$selected_table." SET sub_number=".(get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".$id,"link"),"id"),"sub_number")-1).
            " WHERE id=".get_column($this::$selected_table,"id=".$link,"id").";");}
            
            run_query("UPDATE ".$this::$selected_table." SET link=NULL WHERE id=".$id.";");
        }
        else{
            run_query("UPDATE ".$this::$selected_table." SET sub_number=".(get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".$id,"link"),"id"),"sub_number")-1).
            " WHERE id=".get_column($this::$selected_table,"id=".$link,"id").";");
            run_query("UPDATE ".$this::$selected_table." SET link='".$link."' WHERE id=".$id.";");
            run_query("UPDATE ".$this::$selected_table." SET sub_number=".(get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".$id,"link"),"id"),"sub_number")+1).
            " WHERE id=".get_column($this::$selected_table,"id=".$link,"id").";");
        }  
    }
    public function update_page_tag($id, $tag){
        run_query("UPDATE ".$this::$selected_table." SET tag='".$tag."' WHERE id=".$id.";");
    }
    public function delete_page($id){
       if (get_column($this::$selected_table,"id=".$id,"link")!=NULL){
        run_query("UPDATE ".$this::$selected_table." SET sub_number=".(get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".$id,"link"),"id"),"sub_number")-1).
            " WHERE id=".get_column($this::$selected_table,"id=".get_column($this::$selected_table,"id=".$id,"link"),"id").";");
        }
        run_query("DELETE from ".$this::$selected_table." WHERE id=".$id." ;");
    }
    
    public function show_page($tag=""){
        if ($tag=="")
            return get_column($this::$selected_table,"ordine=1", "continut");
        else return get_column($this::$selected_table,"tag='".$tag."'", "continut");
    }
    
    public function table_name(){
        return $this::$selected_table;
    }
}
?>