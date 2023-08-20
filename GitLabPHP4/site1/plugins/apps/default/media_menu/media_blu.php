<?php

if (return_param(1)=="") $set_id="0";
else $set_id=return_param(1);
             
            $header.='
            <link rel="stylesheet" href="'.absolute_path().'plugins/app/psihologic/media_menu/css/slider2.css" type="text/css" media="screen" />
            <script language="javascript" type="text/javascript">
        
            $(document).ready(function() {
            //<![CDATA[ 
            	//move the image in pixel
            	var move = -15;
            	
            	//zoom percentage, 1.2 =120%
            	var zoom = 1.2;
            
            	//On mouse over those thumbnail
            	$('."'".'.item2'."'".').hover(function() {
            		
            		//Set the width and height according to the zoom percentage
            		width = $('."'".'.item2'."'".').width() * zoom;
            		height = $('."'".'.item2'."'".').height() * zoom;
            		
            		//Move and zoom the image
            		$(this).find('."'".'div.boxy'."'".').stop(false,true).animate({'."'".'width'."'".':width, '."'".'height'."'".':height, '."'".'top'."'".':move, '."'".'left'."'".':move}, {duration:200});
            		
            		//Display the caption
            		$(this).find('."'".'div.caption_boxy'."'".').stop(false,true).fadeIn(200);
            	},
            	function() {
            		//Reset the image
            		$(this).find('."'".'div.boxy'."'".').stop(false,true).animate({'."'".'width'."'".':$('."'".'.item2'."'".').width(), '."'".'height'."'".':$('."'".'.item2'."'".').height(), '."'".'top'."'".':'."'".'0'."'".', '."'".'left'."'".':'."'".'0'."'".'}, {duration:100});	
            
            		//Hide the caption
            		$(this).find('."'".'div.caption_boxy'."'".').stop(false,true).fadeOut(200);
            	});
            
            });
            //]]>
            </script>
        ';
        
        function menu_option($selected_option,$opt){
            
            $dba=new media_menu_model();
            
            if (return_param(2)=="edit_menu"&&is_secure()&&$opt==$selected_option){
                $p1="javascript:document.getElementById('menuEdit').submit()"; 
                $p2=self_href(false,return_topic(),return_param(1));
                $b= '
                
                   <div class="boxy bluy">
                        <form method="post" id="menuEdit" action="'.self_href(false,return_topic(),return_param(1)).'">
                        <div class="boxytitle">
                            <div class="box_title_number number_light">0'.$opt.'</div>
                            <div class="box_title_text">
                            <input type="text" class="boxy_menu_title" name="titlu_meniu" value="'.get_column($dba->selected_table(),"id=".$opt,"titlu").'"/></div> 
                        </div>
                        <div class="boxycontent" style="position:relative; top:-10px; left:-15px;">
                            <textarea name="continut_meniu" class="boxy_menu_content">'.get_column($dba->selected_table(),"id=".$opt,"preview").'</textarea>
                        </div>
                       <div style="display:block; width:240px; height:40px;position:relative; margin-top:-10px;">
                            <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                                <img src="'.get_image("ok-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                            </a>
                            <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Salvare</a>&nbsp;&nbsp;&nbsp;
                            <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                                <img src="'.get_image("delete-icon.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                            </a>
                            <a href="'.$p2.'" class="edit_comment" style="text-decoration:none; font-size:11pt;">&nbsp;Revocare</a>
                            
                        </div>
                        </form>
                    </div>';
                
            }
            else{
            $b= '
            <div class="item2">
               <div class="boxy bluy">
                    <div class="boxytitle">';
                        if ($selected_option==$opt){
                             $b.='<div class="box_title_number number_dark">0'.$opt.'</div>
                                    <div class="box_title_text" style="color:#000;">'. strtoupper(get_column($dba->selected_table(),"id=".$opt,"titlu")).'</div> ';
                        }    else{
                             $b.=' <div class="box_title_number number_light">0'.$opt.'</div>
                                    <div class="box_title_text">'.strtoupper(get_column($dba->selected_table(),"id=".$opt,"titlu")).'</div>';  
                        }
                   
                    $b.='
                    </div>
                    <div class="boxycontent">
                        '.get_column($dba->selected_table(),"id=".$opt,"preview").'
                    </div>
                </div>
                ';
                if (is_secure()) $b.='<div class="caption_boxy capy">';
                else $b.='<div class="caption_boxy capy">';
            		if (is_secure())$b.=caption_insider(self_href(false,get_file(false),$opt),true);
                    else $b.=caption_insider(self_href(false,get_file(false),$opt));
                    $b.='
                </div>
            </div>';}
            return $b;
        }
        
        $body.='
        <div class="menu_insider2">
            <div class="shadowing2">';
            
         for ($i=1; $i<=4; $i++) $body.=menu_option($set_id,$i);  
            
        $body.='
            </div>
        </div>
        ';

?>