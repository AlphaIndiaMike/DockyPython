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
            	$('."'".'.item'."'".').hover(function() {
            		
            		//Set the width and height according to the zoom percentage
            		width = $('."'".'.item'."'".').width() * zoom;
            		height = $('."'".'.item'."'".').height() * zoom;
            		
            		//Move and zoom the image
            		$(this).find('."'".'div.box'."'".').stop(false,true).animate({'."'".'width'."'".':width, '."'".'height'."'".':height, '."'".'top'."'".':move, '."'".'left'."'".':move}, {duration:200});
            		
            		//Display the caption
            		$(this).find('."'".'div.caption'."'".').stop(false,true).fadeIn(200);
            	},
            	function() {
            		//Reset the image
            		$(this).find('."'".'div.box'."'".').stop(false,true).animate({'."'".'width'."'".':$('."'".'.item'."'".').width(), '."'".'height'."'".':$('."'".'.item'."'".').height(), '."'".'top'."'".':'."'".'0'."'".', '."'".'left'."'".':'."'".'0'."'".'}, {duration:100});	
            
            		//Hide the caption
            		$(this).find('."'".'div.caption'."'".').stop(false,true).fadeOut(200);
            	});
            
            });
            //]]>
 </script>
        ';
        
        $body.='
        <div class="menu_insider">
            <div class="shadowing">
            
            <div class="item">
               <div class="box blu">
                    <div class="boxtitle">
                        <div class="title_number">01</div>
                        <div class="title_text">TIPURI DE SERVICII</div> 
                    </div>
                    <div class="boxcontent">
                        <img src="'.get_image("puzzle_text.png").'" alt="servicii" style="padding-left:2px; padding-top:10px;"/>
                    </div>
                </div>
                
                <div class="caption cap_blu">
            		'.caption_insider(self_href(false,get_file(false),"1")).'
                </div>
            </div>
            <div class="item">
                <div class="box grn">
                    <div class="boxtitle">
                        <div class="title_number">02</div>
                        <div class="title_text">POSTURI DESCHISE</div> 
                    </div><br/>
                    <div class="boxcontent" style="padding:10px; position:relative; top:10px;">
                        ';
                    $q=mysql_query("SELECT titlu,oras FROM jobs_ ORDER BY data LIMIT 4;");
                    if ($q!=null){
                        while($r=mysql_fetch_assoc($q)){
                            $body.='
                            
                            <div style="display:block; width:280px; height:55px; text-align:left;">
                                <img src="'.get_image("grn_tick.png").'" alt="#" style="float:left; margin-bottom:40px; margin-right:5px;margin-top:5px;"/>
                                <a style="color:white; font-size:12pt; font-weight:bold;">'.$r["titlu"].'</a><br/>
                                <a style="position:relative; color:yellow; font-size:10pt;">'.$r["oras"].'</a>
                            </div>
                            <div style="display:block; width:280px; height:1px; background-color:#A9AE4C;">&nbsp;</div>
                            <div style="display:block; width:280px; height:1px; background-color:#D6DA5C;">&nbsp;</div>
                            ';
                        }
                    }       
                $body.='    
                    </div>
                </div>
                
                <div class="caption cap_grn">
            		'.caption_insider(self_href(false,"recrutare-personal","1")).'	
                </div>
            </div>
            <div class="item">
                <div class="box org">
                    <div class="boxtitle">
                        <div class="title_number">03</div>
                        <div class="title_text">NOUTATI</div> 
                        <br/><br/> 
                        <div class="boxcontent" style="padding:10px; position:relative; top:10px;">
                             ';
                           
                        $q=mysql_query("SELECT data,titlu,durata,lectori FROM "."news_".return_language()." ORDER BY id DESC LIMIT 2;");
                        if ($q!=null){
                            while($r=mysql_fetch_assoc($q)){
                                $body.='
                                <br/>
                                <div style="display:block; width:280px; height:90px; font-size:10pt; text-align:left; color:white;">
                                    <a style="color:yellow; font-size:10pt; font-weight:bold;">'.$r["data"].':</a> 
                                    '.$r["titlu"].'
                                    <br/>
                                    <a style="position:relative; color:yellow; font-size:10pt;">Durata:</a> '.$r["durata"].'
                                    <br/>
                                    <a style="position:relative; color:yellow; font-size:10pt;">Lectori:</a> '.$r["lectori"].'
                                </div>
                                <div style="display:block; width:280px; height:1px; background-color:#D18541;">&nbsp;</div>
                                <div style="display:block; width:280px; height:1px; background-color:#ECBA4A;">&nbsp;</div>
                                ';
                            }
                        }  
                      $body.='  
                        </div>   
                    </div>
                </div>
                
                <div class="caption cap_org">
                	'.caption_insider(self_href(false,"news")).'
                </div>
            </div>
            </div>
        </div>
        ';

?>