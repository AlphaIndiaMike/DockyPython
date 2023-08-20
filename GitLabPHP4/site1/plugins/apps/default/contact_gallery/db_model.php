<?php 
class contact_gallery_model{
    static $selected_table="";
    static $dept_table="";
    
    function __construct($lang) {
         if (check_table("contact_gallery_persoane")==false){
             run_query("CREATE TABLE contact_gallery_persoane (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, nume VARCHAR(255) NOT NULL, img VARCHAR(255), functie VARCHAR(255) NOT NULL, 
             tel1 VARCHAR(25),tel2 VARCHAR(25),mail1 VARCHAR(255),mail2 VARCHAR(255), ordine INT, depart_id INT);");
             run_query("ALTER TABLE  contact_gallery_persoane ENGINE = MYISAM;");
             run_query("ALTER TABLE  contact_gallery_persoane ADD FULLTEXT (nume, functie);");
         }
         if (check_table("contact_gallery_departamente_".$lang)==false){
             run_query("CREATE TABLE contact_gallery_departamente_".$lang." (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, nume VARCHAR(255) NOT NULL,ordine INT);");
             run_query("ALTER TABLE contact_gallery_departamente_".$lang." ENGINE = MYISAM;");
             run_query("ALTER TABLE contact_gallery_departamente_".$lang." ADD FULLTEXT (nume);");
         }
         $this::$selected_table="contact_gallery_persoane";
         $this::$dept_table="contact_gallery_departamente_".$lang;
    
    /*mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function add_dept($titlu){
        run_query("INSERT INTO ".$this::$dept_table." (id,nume,ordine) 
            VALUES (NULL,'".$titlu."',".(num_rows($this::$dept_table,"1=1")+1).");");
    }
    
    public function add_person($nume,$img, $func, $tel1, $mail1, $dept_id, $tel2="", $mail2=""){
        run_query("INSERT INTO ".$this::$selected_table." (id,nume,img,functie,tel1,tel2,mail1,mail2,ordine,depart_id) 
            VALUES (NULL,'".$nume."','".$img."','".$func."','".$tel1."','".$tel2."','".$mail1."','".$mail2."',
            ".(num_rows($this::$selected_table,"1=1")+1).",".$dept_id.");");
    }
    
    public function update_dept($id, $name_new){
        run_query("UPDATE ".$this::$dept_table." SET nume='".$name_new."' WHERE id=".$id.";");
    }
    
    public function update_person($id, $nume,$img, $func, $tel1, $mail1, $tel2, $mail2){
        run_query("UPDATE ".$this::$selected_table." SET nume='".$nume."',img='".$img."',functie='".$func."',tel1='".$tel1."',
        tel2='".$tel2."',mail1='".$mail1."',mail2='".$mail2."' WHERE id=".$id.";");
    }
    
    public function delete_dept($id){
       run_query("DELETE FROM ".$this::$dept_table." WHERE id=".$id.";");
       run_query("DELETE FROM ".$this::$selected_table." WHERE depart_id=".$id.";");
    }
    
     public function delete_person($id){
       run_query("DELETE FROM ".$this::$selected_table." WHERE id=".$id.";");
    }
    
    public function table_name($dept=false){
        if ($dept==true) return $this::$dept_table;
        return $this::$selected_table;
    }
}
?>