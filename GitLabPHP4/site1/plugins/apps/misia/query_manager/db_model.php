<?php 
class query_manager_model{
    
    static $value_;
    public function selected_table($set=false,$value=""){
        if ($set==true) query_manager_model::$value_=$value;
        return query_manager_model::$value_;
    }
    
    function __construct() {
         if (check_table("query_manager")==false){ 
             run_query("CREATE TABLE query_manager (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, client VARCHAR(255) NOT NULL,
             dest TEXT NOT NULL,ns_rif VARCHAR(255) NOT NULL,misia_disp VARCHAR(255),merc TEXT,vol VARCHAR(255),tr_type VARCHAR(255),
             ship_name VARCHAR(255),ship_dept VARCHAR(255),ship_est VARCHAR(255),documents TEXT,insurance VARCHAR(1), arrived VARCHAR(1),
             sent VARCHAR(1)) collate utf8_general_ci ;");
             run_query("ALTER TABLE query_manager ENGINE = MYISAM;");
             run_query("ALTER TABLE query_manager ADD FULLTEXT (client, dest, merc, ship_name, tr_type);");
             run_query("INSERT INTO query_manager (id, client, dest, ns_rif, misia_disp, merc, vol, tr_type, ship_name, ship_dept, ship_est, documents, insurance, arrived, sent) VALUES (1, 'CLIENTE', 'DESTINAZIONE', 'NS RIF', 'GIORNO CARICO IN MISIA', 'MERCE ( inserire descrizione che permetta di ricordare invio)', 'VOLUME E PESO MERCE', 'TIPO TRASPORTO', 'NOME NAVE', 'NAVE PARTITA', 'PARTENZA STIMATA', 'INVIO A VOI DOCUMENTI ORIGINALI', NULL, NULL, NULL);");
         }
         
         $this->selected_table(true,"query_manager");
    
    /*mysql> select * from stuff
     > where match (secret_string) against ('+"car rental"'
     > in boolean mode) ordine by freq asc;
    */
    }
    
    public function add_content($id,$c,$d,$ns,$car,$merc,$vol,$tt,$sn,$sd,$se,$doc,$ins,$arr=0,$snt=0){
        if (num_rows($this->selected_table(),"id=".$id)==0) {
            run_query("INSERT INTO ".$this->selected_table()." (id,client,dest,ns_rif,misia_disp,merc,vol,tr_type,
             ship_name,ship_dept,ship_est,documents,insurance,arrived,sent)  
             VALUES (".$id.",'".$c."','".$d."','".$ns."','".$car."','".$merc."','".$vol."','".$tt."','".$sn."','".$sd."','".$se.
             "','".$doc."','".$ins."','".$arr."','".$snt."');");}
        else{ 
            run_query("UPDATE ".$this->selected_table()." SET client='".$c."',dest='".$d."',ns_rif='".$ns."',misia_disp='".$car."',merc='".$merc."',vol='".$vol."',tr_type='".$tt."',
            ship_name='".$sn."',ship_dept='".$sd."',ship_est='".$se."',documents='".$doc."',insurance='".$ins."',arrived='".$arr."',sent='".$snt."'
            WHERE id=".$id.";");
        }
    }
    
    public function send_touch($id){
        run_query("UPDATE ".$this->selected_table()." SET sent='1' WHERE id=".$id.";");
    }
    
    public function ok_touch($id){
        run_query("UPDATE ".$this->selected_table()." SET arrived='1' WHERE id=".$id.";");
    }
    
    public function delete($id){
        run_query("DELETE FROM ".$this->selected_table().' WHERE id='.$id.';');
    }
    
    public function next(){
        return num_rows($this->selected_table(),"1=1")+1;
    }
}
?>
