<?php 
class browse_catalog_model{
    
    static $value_;
    public function selected_table($set=false,$value=""){
        if ($set==true) media_menu_model::$value_=$value;
        return media_menu_model::$value_;
    }
    
    function __construct() {
    /*
         if (check_table("media_menu_".str_replace("-","",get_file(false))."_".return_language())==false){ 
             run_query("CREATE TABLE media_menu_".str_replace("-","",get_file(false))."_".return_language()." (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, titlu VARCHAR(255) NOT NULL,preview TEXT, continut TEXT);");
             run_query("ALTER TABLE media_menu_".str_replace("-","",get_file(false))."_".return_language()." ENGINE = MYISAM;");
             run_query("ALTER TABLE media_menu_".str_replace("-","",get_file(false))."_".return_language()." ADD FULLTEXT (titlu, continut);");
         }
         
         $this->selected_table(true,"media_menu_".str_replace("-","",get_file(false))."_".return_language());
    
    mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function add_content($id,$titlu,$continut,$continut_mic=""){
        if (num_rows($this->selected_table(),"id=".$id)==0) {
            run_query("INSERT INTO ".$this->selected_table()." (id,titlu,preview,continut) 
            VALUES (".$id.",'".$titlu."','".$continut_mic."','".$continut."');");}
        else{ 
            run_query("UPDATE ".$this->selected_table()." SET titlu='".$titlu."',preview='".$continut_mic."',
            continut='".$continut."' WHERE id=".$id.";");
        }
    }
}
?>