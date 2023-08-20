<?php 
class jobs_model{
    static $selected_table="";
    static $real_table="";
    
    public function selected_table($set=false,$value=""){
        if ($set==true) jobs_model::$selected_table=$value;
        return jobs_model::$selected_table;
    }
    public function real_table($set=false,$value=""){
        if ($set==true) jobs_model::$real_table=$value;
        return jobs_model::$real_table;
    }
    
    function __construct() {
         if (check_table("jobs")==false){ 
             run_query("CREATE TABLE jobs (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, titlu VARCHAR(255) NOT NULL, data VARCHAR(20), oras INT NOT NULL, categorie VARCHAR(255), continut TEXT);");
             run_query("ALTER TABLE jobs ENGINE = MYISAM;");
             run_query("ALTER TABLE jobs ADD FULLTEXT (titlu, continut);");
             run_query("CREATE TABLE orase (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, nume VARCHAR(200));");
             run_query("CREATE VIEW jobs_ AS SELECT jobs.id as id,jobs.titlu as titlu, jobs.data as data,orase.nume as oras,jobs.continut as continut,jobs.categorie as categorie FROM jobs,orase WHERE jobs.oras=orase.id;");
         }
         
         $this->selected_table(true,"jobs_");
         $this->real_table(true,"jobs");
    
    /*mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function add_content($titlu,$oras,$data,$continut,$cat,$id=0){
        if (num_rows($this->real_table(),"id=".$id)==0) {
            if (get_column("orase","nume='".$oras."'","id")=="") run_query("INSERT INTO orase (id,nume) VALUES (NULL,'".$oras."');");
            run_query("INSERT INTO ".$this->real_table()." (id,titlu,data,oras,continut,categorie) 
            VALUES (NULL,'".$titlu."','".$data."','".get_column("orase","nume='".$oras."'","id")."','".$continut."','".$cat."');");}
        else{ 
            if (get_column("orase","nume='".$oras."'","id")=="") run_query("INSERT INTO orase (id,nume) VALUES (NULL,'".$oras."');");
            
            run_query("UPDATE ".$this->real_table()." SET titlu='".$titlu."',data='".$data."',oras='".get_column("orase","nume='".$oras."'","id")."',
            continut='".$continut."',categorie='".$cat."' WHERE id=".$id.";");
        }
    }
    
    public function delete_job($id){
       run_query("DELETE FROM ".$this->real_table()." WHERE id=".$id.";");
    }
    
    public function delete_oras($id){
       run_query("DELETE FROM orase WHERE id=".$id.";");
    }
    
}
?>