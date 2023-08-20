<?php
include("db_model.php");
load_internal_service("misia","query_manager","header");

function show_query_manager(&$header,$opt_path){
    $body='';
    
    $dba = new query_manager_model();
    
    $header.='
    <link rel="stylesheet" href="'.$opt_path.'/css/tabs.css'.'" type="text/css" media="screen" />'
    .insert_js('jquery-1.7.2.min.js').insert_js('jquery.bpopup.min.js')
    .insert_css('validationEngine.jquery.css').insert_js('jquery.validationEngine-it.js')
    .insert_js('jquery.validationEngine.js').insert_css('styles.css').insert_js('jquery.reveal.js');
    
    $header.='
    
    <script type="text/javascript">
    //<![CDATA[
    
    (function($) {
        $(function() {
            $('."'".'.add_element'."'".').bind('."'".'click'."'".', function(e) {
                e.preventDefault();
                $('."'".'#add_edit_form'."'".').bPopup({
                    closeClass:'."'".'close'."'".',
                });
            });
         });
     })(jQuery);
     
     jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();
		});
        
    //]]>
    </script>
    ';
    
    
    $body.='
<div id="query_app">
<div id="tabbed_menu">	
    <ul id="applist">
    ';
    $one="TABELLA SPEDIZIONI IN ESSERE"; $href_one=self_href(false,"");
    $two='ARCHIVIO SPEDIZIONI GIA` A DESTINO'; $href_two=self_href(false,"arrivato");;
    
    if(return_topic()=="")
		$body.='<li id="active"><span>'.$one.'</span></li>
		<li><a href="'.$href_two.'">'.$two.'</a></li>';
    else{
       $body.='<li><a href="'.$href_one.'">'.$one.'</a></li>
		<li id="active"><span>'.$two.'</span></li>';
    }
	$body.='
    </ul>
</div>

<div id="description">
	<div id="app_panel">
    
    
    ';
    
    /*******************************************************/
	$custom_color='color:black;';
    if (return_topic()==""){
        $SQL = "SELECT id,client,dest,ns_rif,misia_disp,merc,vol,tr_type,ship_name,ship_dept,ship_est,
        documents,insurance,arrived,sent FROM ".$dba->selected_table()." WHERE ID<>1 AND sent=0 ORDER BY id DESC;";
	$custom_color='color:#C11B17;';
    }
    else{
        $SQL = "SELECT id,client,dest,ns_rif,misia_disp,merc,vol,tr_type,ship_name,ship_dept,ship_est,
        documents,insurance,arrived,sent FROM ".$dba->selected_table()." WHERE ID<>1 AND sent=1 ORDER BY id DESC;";
	$custom_color='color:green;';
    }
    $result = mysql_query($SQL);
    $last_col='RICHIESTA ASSICURAZIONE si/no';
    
    if ($result!=null && num_rowsq($SQL)>0){
        $body.='<table class="mytable" cellspacing="0" cellpadding="2" style="'.$custom_color.'"><tr>';
        
        
        $header_row=get_row($dba->selected_table(),"id=1");
        $body.='<th>'.$header_row[1].'</th>';
        $body.='<th>'.$header_row[2].'</th>';
        $body.='<th>'.$header_row[3].'</th>';
        $body.='<th>'.$header_row[4].'</th>';
        $body.='<th>'.$header_row[5].'</th>';
        $body.='<th>'.$header_row[6].'</th>';
        $body.='<th style="width:30px;">...</th>';
        $body.='</tr>';
        
        
        
        while ($db_field = mysql_fetch_array($result)) {
             if ($db_field[13]==1)$body.='<tr style="color:red; background-color:yellow">';
             else $body.='<tr>';
             
             $info_link='onclick='."'".'location.href='.'"'.self_href(false,return_topic()).'&amp;info='.$db_field[0].'"'."'".'';
             
             $body.='<td '.$info_link.' style="cursor:pointer;">'.$db_field[1].'</td>';
             $body.='<td '.$info_link.' style="cursor:pointer;">'.$db_field[2].'</td>';
             $body.='<td '.$info_link.' style="cursor:pointer;">'.$db_field[3].'</td>';
             $body.='<td '.$info_link.' style="cursor:pointer;">'.$db_field[4].'</td>';
             $body.='<td '.$info_link.' style="width:150px; cursor:pointer;">'.$db_field[5].'</td>';
             $body.='<td '.$info_link.' style="cursor:pointer;">'.$db_field[6].'</td>';
             
             if (return_topic()=="") //In expedition
             $opt='<a href="'.self_href().'edit='.$db_field[0].'" style="color:White; cursor:pointer; width:30px;" >
                <img src="'.get_image('edit.png').'" alt="edit" width="28" height="28" />
             </a>'.
             '<a href="'.self_href().'del='.$db_field[0].'" style="color:White; cursor:pointer;" class="delete_btn">
                <img src="'.get_image('Delete.png').'" alt="delete" width="28" height="28" />
             </a>'.
             '<a href="'.self_href(false,"arrivato").'&amp;send='.$db_field[0].'" style="color:White; cursor:pointer;">
                <img src="'.get_image('fact_man.png').'" alt="Item sent" width="28" height="28" />
             </a>'.
             '<a href="'.self_href(false,"arrivato").'&amp;alles_gut='.$db_field[0].'" style="color:White; cursor:pointer;">
                <img src="'.get_image('ok-icon.png').'" alt="Arrived" width="28" height="28" />
             </a>'
             .'</td>';
             else //@ Destination
             $opt='<a href="'.self_href(false,"arrivato").'&amp;edit='.$db_field[0].'" style="color:White; cursor:pointer;">
                <img src="'.get_image('edit.png').'" alt="edit" width="28" height="28" />
             </a>'.
             '<a href="'.self_href(false,"arrivato").'&amp;del='.$db_field[0].'" style="color:White; cursor:pointer;" class="delete_btn">
                <img src="'.get_image('Delete.png').'" alt="delete" width="28" height="28" />
             </a>'
             .'</td>';
             
             $body.='<td style="width:90px;">'.$opt;
             
             $body.='</tr>';
        }
        
        $body.='</table>';  
    }
    else{
        $body.='<p>Nessuna voce nel database!</p>';
    }
    
    /*******************************************************/
    
    $body.='
    <div style="height:50px; width:900px;">
        <div style="width:160px; float:right;">
        <a class="add_element" style="cursor: pointer; text-decoration:none; font-size:10pt; color:#FFF;">
            <img src="'.get_image("Add.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
        </a>
        <a class="add_element" style="cursor: pointer; text-decoration:none; font-size:11pt; font-weight:bold; font-family:Arial;">&nbsp;Aggiungere</a>&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>            
    
    </div>
    </div>
    ';
    
    $header_row=get_row($dba->selected_table(),"id=1");
    $vals=array("","","","","","","","","","","","","");
    $cmdparam = "addnew=1";
    $checked="";
    if (return_random_tag("edit")!=""){
        $header.='
        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
            $('."'".'#add_edit_form'."'".').bPopup({
                        closeClass:'."'".'close'."'".',
            });
        });
        //]]>
        </script>
            ';
        $vals=get_row($dba->selected_table(),"id=".return_random_tag("edit"));
        $cmdparam="editnow=".return_random_tag("edit");
        if ($vals[12]=='o') $checked="checked=true";
    }
    if (return_random_tag("info")!=""){
        $header.='
        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
            $('."'".'#view_details'."'".').bPopup({
                        closeClass:'."'".'close'."'".',
            });
        });
        //]]>
        </script>
            ';
        $vals=get_row($dba->selected_table(),"id=".return_random_tag("info"));
        $cmdparam="info=".return_random_tag("info");
        if ($vals[12]=='o') $vals[12]='si';
        else $vals[12]='no';
        
          $body.='
        <div id="view_details" style="display:none; padding:20px; background-color:White; height:300px; overflow-y:scroll;">
        <form action="'.self_href(false,return_topic()).'" class="formular" style="text-align:left;" method="post" id="view_">
    			<div>
    				<span style="display:inline">'.$header_row[1].': </span>
    				<span style="display:inline; font-weight:bold;">'.$vals[1].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[2].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[2].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[3].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[3].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[4].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[4].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[5].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[5].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[6].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[6].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[7].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[7].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[8].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[8].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[9].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[9].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[10].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[10].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$header_row[11].': </span>
    				<span  style="display:inline; font-weight:bold;">'.$vals[11].'</span>
    			</div>
                <div>
    				<span style="display:inline">'.$last_col.': </span>
    				<span style="display:inline; font-weight:bold;">'.$vals[12].'</span>
    			</div>
                <input class="submit close" type="reset" value="Chiudere" id="solo_chiuso"/>
        </form>
    </div>
        ';
    }
    if (return_random_tag("del")!=""){
        $header.='
        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
            $('."'".'#modal'."'".').reveal({ // The item which will be opened with reveal
				  	animation: '."'".'fade'."'".',                   // fade, fadeAndPop, none
					animationspeed: 300,                       // how fast animtions are
					closeonbackgroundclick: true,              // if you click background will modal close?
					dismissmodalclass: '."'".'close'."'".'     // the class of a button or element that will close an open modal
				});
        });
        //]]>
        </script>
            ';
        $vals=get_row($dba->selected_table(),"id=".return_random_tag("del"));
        $cmdparam="del=".return_random_tag("del");
        if ($vals[12]=='o') $vals[12]='si';
        else $vals[12]='no';
        
      
    }
    $body.='
    <div id="add_edit_form" style="display:none; padding:20px; background-color:White; width:600px; height:500px; overflow-y:scroll;">
        <form action="'.self_href().$cmdparam.'" class="formular" method="post" id="formID">
    		<label>
    				<span>'.$header_row[1].'</span>
    				<input value="'.$vals[1].'" class="validate[required] text-input" type="text" name="c" id="c" />
    		</label>
                <label>
    				<span>'.$header_row[2].'</span>
    				<input value="'.$vals[2].'" class="validate[required] text-input" type="text" name="d" id="d" />
    		</label>
		<label>
    				<span>'.$header_row[7].'</span>
    				<input value="'.$vals[7].'" class="validate[required] text-input" type="text" name="tt" id="tt" />
    		</label>
                <label>
    				<span>'.$header_row[3].'</span>
    				<input value="'.$vals[3].'" class="text-input" type="text" name="ns" id="ns" />
    		</label>
                <label>
    				<span>'.$header_row[4].'</span>
    				<input value="'.$vals[4].'" class="text-input" type="text" name="car" id="car" />
    		</label>
                <label>
    				<span>'.$header_row[5].'</span>
    				<input value="'.$vals[5].'" class="text-input" type="text" name="merc" id="merc" />
    		</label>
                <label>
    			<span>'.$header_row[6].'</span>
    			<input value="'.$vals[6].'" class="text-input" type="text" name="vol" id="vol" />
    		</label>
                <label>
    				<span>'.$header_row[8].'</span>
    				<input value="'.$vals[8].'" class="text-input" type="text" name="sn" id="sn" />
    		</label>
                <label>
    				<span>'.$header_row[9].'</span>
    				<input value="'.$vals[9].'" class="text-input" type="text" name="sd" id="sd" />
    		</label>
                <label>
    				<span>'.$header_row[10].'</span>
    				<input value="'.$vals[10].'" class="text-input" type="text" name="se" id="se" />
    		</label>
                <label>
    				<span>'.$header_row[11].'</span>
    				<input value="'.$vals[11].'" class="text-input" type="text" name="doc" id="doc" />
    		</label>
                <fieldset style="text-align:left;">
			        	'.trim($last_col).':<input type="checkbox" style="display:inline;" 
                          '.$checked.' id="ins" name="ins"/>
                </fieldset>
                <input class="submit" type="submit" value="Aggiungere"/>
                <input class="submit close" type="reset" value="Annullare" id="cancel_btn"/>
        </form>
    </div>
    
    <div id="modal">
	<div id="heading2">
		Sei sicuro di voler eliminare l`elemento selezionato?
	</div>

	<div id="content2">
		<p>Cliente: '.$vals[1].',<br/>  Destinazione: '.$vals[2].'<br/> Merce: '.$vals[5].'</p>

		<a href="'.self_href(false,return_topic()).'&amp;delnow='.$vals[0].'" style="color:#fff; font-family:arial;" class="button green close"><img src="'.get_image('tick.png').'" alt="Si"/>Si</a>

		<a href="'.self_href(false,return_topic()).'"  style="color:#fff; font-family:arial;" class="button red close"><img src="'.get_image('cross.png').'" alt="No"/>No</a>
	</div>
    </div>
</div>';
    
    return $body;
}
 


?>
