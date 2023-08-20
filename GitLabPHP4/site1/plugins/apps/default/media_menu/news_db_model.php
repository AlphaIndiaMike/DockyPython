<?php 
class news_model{
    static $selected_table="";
    
    public function selected_table($set=false,$value=""){
        if ($set==true) news_model::$selected_table=$value;
        return news_model::$selected_table;
    }
    
    function __construct() {
         if (check_table("news_".return_language())==false){ 
             run_query("CREATE TABLE news_".return_language()." (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, titlu VARCHAR(255) NOT NULL, data VARCHAR(20), durata VARCHAR(20), lectori VARCHAR(255), continut TEXT);");
             run_query("ALTER TABLE jobs ENGINE = MYISAM;");
             run_query("ALTER TABLE jobs ADD FULLTEXT (titlu, continut);");
         }
         
         $this->selected_table(true,"news_".return_language());
    
    /*mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function add_content($titlu,$durata,$data,$continut,$lectori,$id=0){
        if (num_rows($this->selected_table(),"id=".$id)==0) {
            run_query("INSERT INTO ".$this->selected_table()." (id,titlu,data,durata,lectori,continut) 
            VALUES (NULL,'".$titlu."','".$data."','".$durata."','".$lectori."','".$continut."');");}
        else{ 
            run_query("UPDATE ".$this->selected_table()." SET titlu='".$titlu."',data='".$data."',durata='".$durata."',
            continut='".$continut."',lectori='".$lectori."' WHERE id=".$id.";");
        }
    }
    
    public function delete_job($id){
       run_query("DELETE FROM ".$this->selected_table()." WHERE id=".$id.";");
    }
    
}
?>