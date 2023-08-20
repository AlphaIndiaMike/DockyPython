<?php
class security_model{
    
    function __construct() {
         if (check_table('firme')==false){
             run_query("CREATE TABLE firme (id INT AUTO_INCREMENT PRIMARY KEY,numelogin VARCHAR(100),numef VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin, cui VARCHAR(15), j VARCHAR(15), adr1 VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin, adr2 VARCHAR(100)  CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL, banca VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin, cont CHAR(24), isreg CHAR(1) DEFAULT NULL);");
             run_query("ALTER TABLE firme ENGINE = MYISAM;");
             run_query("ALTER TABLE firme ADD FULLTEXT (nume);");
         }
         if (check_table('utilizatori')==false){
             run_query("CREATE TABLE utilizatori (id INT AUTO_INCREMENT PRIMARY KEY,nume VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin, pass VARCHAR(100), descriere TEXT CHARACTER SET utf8 COLLATE utf8_bin, CI VARCHAR(15), telef VARCHAR(20), mail VARCHAR(255), cnp CHAR(13), vehicul VARCHAR(100), firma INT, drept INT);");
         }
         if (check_table('drepturi')==false){
            run_query("CREATE TABLE drepturi (id INT AUTO_INCREMENT PRIMARY KEY,numed VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin,descriered TEXT CHARACTER SET utf8 COLLATE utf8_bin,grad INT);");
            run_query("INSERT INTO drepturi VALUES(1,'Root','Application  administrator', 0);");
            run_query("INSERT INTO drepturi VALUES(2,'Administrator','Administratorul firmei, are drepturi depline legate de activitatea firmei: Facturare, Anulare facturi, Consultare statistici.', 1000);");
            run_query("INSERT INTO drepturi VALUES(3,'Contabil','Contabilitate, are drepturi: Anulare facturi, Consultare statistici. ', 1001);");
            run_query("INSERT INTO drepturi VALUES(4,'Consultant','Consultant are dreptul de a vizualiza statistici si facturi inregistrare in program.', 1002);");
         }
         if (check_table('view_utilizatori')==false){
            run_query("CREATE VIEW view_utilizatori AS SELECT nume,numelogin,utilizatori.descriere,pass,CI,telef,mail,cnp,vehicul,numef,cui,j,adr1,adr2,cont,banca,numed,descriered,grad FROM utilizatori,firme,drepturi WHERE utilizatori.firma=firme.id AND utilizatori.drept=drepturi.id AND isreg IS NOT NULL;");      
         }
         
    
    /*mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function check_password($firma, $user){
        get_column("view_utilizatori","numed='".$user."' AND numef='".$firma."'","pass");
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