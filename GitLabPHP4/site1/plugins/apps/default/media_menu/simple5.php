<?php 

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
            	$('."'".'.item5'."'".').hover(function() {
            		
            		//Set the width and height according to the zoom percentage
            		width = $('."'".'.item5'."'".').width() * zoom;
            		height = $('."'".'.item5'."'".').height() * zoom;
            		
            		//Move and zoom the image
            		$(this).find('."'".'div.minibox5'."'".').stop(false,true).animate({'."'".'width'."'".':width, '."'".'height'."'".':height, '."'".'top'."'".':move, '."'".'left'."'".':move}, {duration:200});
            		
            		//Display the caption
            		$(this).find('."'".'div.caption_mini'."'".').stop(false,true).fadeIn(200);
            	},
            	function() {
            		//Reset the image
            		$(this).find('."'".'div.minibox5'."'".').stop(false,true).animate({'."'".'width'."'".':$('."'".'.item5'."'".').width(), '."'".'height'."'".':$('."'".'.item5'."'".').height(), '."'".'top'."'".':'."'".'0'."'".', '."'".'left'."'".':'."'".'0'."'".'}, {duration:100});	
            
            		//Hide the caption
            		$(this).find('."'".'div.caption_mini'."'".').stop(false,true).fadeOut(200);
            	});
            
            });
            //]]>
            </script>
        ';
        
      function menu_option($selected_option,$opt){
            
            $dba=new media_menu_model();
            
            /**/
            
            if (return_param(2)=="edit_menu"&&is_secure()&&$opt==$selected_option){
                $p1="javascript:document.getElementById('menuEdit').submit()"; 
                $p2=self_href(false,return_topic(),return_param(1));
                $b= '
                
                   <div class="minibox5 miniblu5">
                        <form method="post" id="menuEdit" action="'.self_href(false,return_topic(),return_param(1)).'">
                        <div class="boxytitle">
                            <div class="box_title_number number_light">0'.$opt.'</div>
                            <div class="box_title_text">
                            <input type="text" class="boxy_menu_title" style="width:160px;" name="titlu_meniu_mini" value="'.get_column($dba->selected_table(),"id=".$opt,"titlu").'"/></div> 
                        </div>
                       <div style="display:block; width:160px; height:40px;position:relative; text-align:right; margin-top:0px margin-left:10px; color:white;">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="'.$p1.'" class="edit_comment" style="text-decoration:none; font-size:10pt;  color:transparent;">
                                <img src="'.get_image("ok-icon.png").'" alt="edit_img" height="32" width="32" style=" position:relative; top:10px;"/>
                            </a>
                            
                            <a href="'.$p2.'" style="text-decoration:none; font-size:10pt; color:transparent;">
                                <img src="'.get_image("delete-icon.png").'" alt="trash_img" height="28" width="28" style=" position:relative; top:10px;"/>
                            </a>
                            
                            
                        </div>
                        </form>
                    </div>';
                
            }
            else{
            $b= '
            <div class="item5">
               <div class="minibox5 miniblu5">
                    <div class="minibox_title">';
                        if ($selected_option==$opt){
                             $b.='<div class="box_title_number number_dark">0'.$opt.'</div>
                                    <div class="box_title_text" style="font-size:12pt; color:#000; text-align:left; width:160px;">'. strtoupper(get_column($dba->selected_table(),"id=".$opt,"titlu")).'</div> ';
                        }    else{
                             $b.=' <div class="box_title_number number_light">0'.$opt.'</div>
                                    <div class="box_title_text" style="font-size:12pt; color:#FFF; text-align:left; width:160px;">'.strtoupper(get_column($dba->selected_table(),"id=".$opt,"titlu")).'</div>';  
                        }
                   
                    $b.='
                    </div>
                </div>
                
                <div class="caption_mini minicap5">
            		';
            		if (is_secure())$b.=caption_insider(self_href(false,get_file(false),$opt),true);
                    else $b.=caption_insider(self_href(false,get_file(false),$opt));
                    $b.='
                </div>
            </div>';
            }
            return $b;
        }
        
        $body.='
        <div class="menu_insider3">
            <div class="shadowing3">';
            
         for ($i=1; $i<=5; $i++) $body.=menu_option($set_id,$i);  
            
        $body.='
            </div>
        </div>
        ';

?>