<?php

function contact_gallery_w_map($File, &$header, $width=1000, $height=800){
    $header.='<link href="'.absolute_path().'plugins/ext/contact_gallery/css/style.css" type="text/css" rel="stylesheet" />';
    
    $body='';
    $body.='
    <div style="width:'.$width.'px; height:'.$height.'px;" class="contact_container">';
        if (return_topic()!="WideMap"){
            $body.='<div class="gallery_component floatleft" style="height:'.$height.'px;">';
            if ((return_param()=="SendMessage"||return_param()=="SendMessageSent")&&(num_rows("contact_gallery_persoane","id=".return_topic())>0)){
                $body.='<div class="gallery_top">';
                $body.='<p class="titlu_mare">Scrieti lui: '.get_column("contact_gallery_persoane","id=".return_topic(),"nume");
                $body.='
                        <a href="'.link_1e("1").'" class="send_mare">Inapoi x</a>
                </p>';
                $body.='</div>';
                
                $body.='<hr/>';
                $body.=draw_contact_form($File,$header);
            }else{
                 $body.=contact_gallery($File,$header,700);
            } 
                
            $body.='
            </div>
            <div class="address_component floatleft" style="height:'.$height.'px;">
                '.base_Article_link($File,$header,295,400).'
            </div>';
        }
        else{
             if (return_topic()=="WideMap"){
                $body.='<div class="gallery_top">';
                $body.='<p class="titlu_mare">Harta locatiei ';
                $body.='
                        <a href="'.link_1e("1").'" class="send_mare">Inapoi x</a>
                </p>';
                $body.='</div>';
                $body.='<div class="widemap">';
                $body.=read_content($File,"[<widemap>]","[</widemap>]");
                $body.='</div>';
            }  
        }
        $body.='
    </div>
    ';
    return $body;
}

?>