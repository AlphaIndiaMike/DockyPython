<?php


function draw_contact_form($File, &$header, $width=700, $height=600){
    $body='';
if (isset($_GET["base_Article"])) return '';
$err_msg='';
//Testare
if (return_param()=="SendMessageSent"){
    $ok = array(0,0,0,0); $captcha=0;
//run tests
$nume="";$mail="";$companie="";$ctn="";
	if ((isset($_POST["nume_"]))&&($_POST["nume_"])!="") $nume=mysql_escape_string($_POST["nume_"]);
	else $ok[0]=1;
	if ((isset($_POST["mail__"])&&($_POST["mail__"])!="")&&(check_email_address($_POST["mail__"])==true)) $mail=mysql_escape_string($_POST["mail__"]);
	else $ok[1]=1;
	if ((isset($_POST["companie"]))&&($_POST["companie"])!="") $companie=mysql_escape_string($_POST["companie"]);
	else $companie="nespecificat";
	if ((isset($_POST["content_"]))&&($_POST["content_"]!="")) $ctn=mysql_real_escape_string($_POST["content_"]);
	else $ok[2]=1;
	if ((isset($_POST["code"]))&&($_POST["code"]!="")&&(($_POST["code"])==$_SESSION["security_code"])) $captcha=0;
	else {$ok[3]=1; $captcha=1;}
	//after tests

for ($i=0; $i<4; $i++)
    {
        if ($i==0&&$ok[$i]==1) $err_msg.="Nu ati introdus numele!<br/>";
        if ($i==1&&$ok[$i]==1) $err_msg.="Nu ati introdus adresa de email!<br/>";
        if ($i==2&&$ok[$i]==1) $err_msg.="Nu ati introdus nici un mesaj!<br/>";
        if ($i==3&&$ok[$i]==1) $err_msg.="Nu ati introdus codul corect din imagine!<br/>";
    }
}
if (return_param()=="SendMessageSent"&&$err_msg==''){
    $_SESSION["message_sent"]='ok';
    $date_now = date('l jS \of F Y h:i:s A'); 
    $subiect = 'Mesaj trimis in pagina de contact de la '.$nume.' '; 
	$continut = '<html><body><h2>Continut mesaj: </h2><p>'.$ctn.'</p><br/><h3>Date expeditor: </h3><p>Nume, Prenume: '.$nume.'</p><p>E-mail: '.
                $mail.'</p><p>Telefon: '.$companie.'</p><p>Data interogarii: '.$date_now.'</p></body></html>';
			    //END CONTENT
	mail_it($continut,$subiect);
    $body.='<div class="featurebox_center" style="width:450px; border:solid 1px gray; padding:10px; float:left; display:inline;">
            <img src="'.absolute_path().'plugins/images/active.png" alt="ok" style="padding:2px;"/><a style="position:relative; cursor:default; top:-4px;">Mesajul a fost trimis cu succes!<br/>
            Echipa noastra va va raspunde in cel mai scurt timp.
            </a>
        </div>';
}
else{
$header.='
<script type="text/javascript" language="javascript" src="plugins/mce/tinymce/jscripts/tiny_mce/tiny_mce.js">
</script>
<script type="text/javascript" language="javascript">
  tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "simple"
});

</script>';
$body.='
<div id="contact_spc" style="margin-left:10px;">';
$body.='<a style="color:red">'.$err_msg.'</a>';
$body.='
				<form action="'.link_2e(return_topic(),"SendMessageSent").'" method="post">
					<div class="contact_component">
			            <div class="contact_label"> 
			             Nume, Prenume:
			           </div>
                        <div style="color:Black; height:40px; float:left; font-size:11pt;">
			                <input type="text" class="contact_textbox" name="nume_" id="nume_" 
                                maxlength="255"'; if (isset($_POST["nume_"])) $body.= 'value="'.$_POST["nume_"].'"'; else $body.= 'value=""'; $body.='/>
			                <div class="content1" style="font-size:8pt;"> 
                            Camp obligatoriu, text simplu, maxim 255 de caractere
						</div>
			            </div>
			        </div>
			        <div class="contact_component">
			            <div class="contact_label"> 
			            Telefon:
						</div>
			            <div style="color:Black; height:40px; float:left; font-size:11pt;">
			                <input type="text"  class="contact_textbox" name="companie" id="companie" 
                                maxlength="255"';  if (isset($_POST["companie"])) $body.= 'value="'.$_POST["companie"].'"'; else $body.= 'value=""'; $body.='/>
			                <div class="content1" style="font-size:8pt;">
                            Camp optional, text simplu, maxim 255 de caractere.
                            </div>
			            </div>
			        </div>
					<div class="contact_component">
			            <div class="contact_label">
                            Adresa de e-mail: 
                        </div>
			            <div style="color:Black; height:40px; float:left; font-size:11pt;">
			                <input type="text"  class="contact_textbox" name="mail__" id="mail__" 
                                maxlength="255"';  if (isset($_POST["mail__"])) $body.= 'value="'.$_POST["mail__"].'"'; else $body.= 'value=""'; $body.='/>
			                <div class="content1" style="font-size:8pt;"> 
                                Camp obligatoriu, text simplu, maxim 255 de caractere.
                            </div>
			            </div>
			        </div>
			        <div class="contact_component" style="height:240px;">
			        	<div class="contact_label"> 
			             Continut mesaj:  
                        </div>
                        <div style="display:table">
                        <textarea name="content_" id="content_" style="width:482px; height:180px;">';
						 		 if (isset($_POST["content_"])) $body.= $_POST["content_"];
						    $body.='</textarea></div>
			            <div class="content1" style="font-size:8pt; height:20px; text-align:center;">
			               	Maxim 4096 caractere, text/html
			            </div>
					</div>
					<div class="contact_component" style="height:50px;">
					    <div style="margin:15px 15px 15px 0px; border:solid 1px Gray; width: 480px; height:90px;">
					        <div style="margin:5px 5px 5px 5px">
			                    <div class="contact_label" style="width:200px;">
                                Verificare imagine:
                                </div>
			                    <div style="color:Black; height:40px; float:left; font-size:11pt;">
			                        <div style="float:left; width:120px; padding:10px;">
			                            <img src="'.absolute_path().'plugins/ext/captcha/secureim.php?width=100&amp;height=30&amp;characters=6" alt="check"/>
			                        </div>
			                        <div style="float:left; padding-top:15px; width:120px;">
			                            <input type="text" maxlength="50" name="code" id="code" VALUE="" style="width:100px; color:Black;" class="content1"/>
			                        </div>
			                        <div style="width:200px; padding-top:5px; font-size:8pt; float: left;">
			                            Introduceti codul din imaginea alaturata in campul aflat in dreapta ei. 
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
                    <div style="display:table; float:right; width:100px; padding:20px; height:30px;">
                    <input type="submit" class="contact_btn" 
                        onmouseover="this.style.color='."'".'#2c649c'."'".';" onmouseout="this.style.color='."'".'#de0d0d'."'".';" 
                    value="Trimite mesajul" />
                    </div>
			   </form>		
</div>';
}
return $body;
}


?>