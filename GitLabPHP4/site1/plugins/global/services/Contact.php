<?php

function draw_we_call($ok){
    if ($ok==1){
    $date_now = date('l jS \of F Y h:i:s A'); 
    $subiect = 'Cerere de contact de la '.$_POST["nume"].' '; 
	$continut = '<html><body><h3>Date expeditor: </h3><p>Nume, Prenume: '.$_POST["nume"].'</p><p>Telefon: '.
    $_POST["tel1"].'</p><p>Telefon2: '; if(isset($_POST["tel2"])) $continut.=$_POST["tel2"]; else $continut.='nespecificat'; $continut.='</p>';
    $continut.='<p>Companie: '; if(isset($_POST["company"])) $continut.=$_POST["company"]; else $continut.='nespecificat'; $continut.='</p>';
    $continut.='<p>Data interogarii: '.$date_now.'</p></body></html>';
    //END CONTENT
	mail_it($continut,$subiect,"site@g-tws.ro");
    $body='
        <script type="text/javascript" language="javascript">alert("Cerere trimisa cu succes!");
        location.href="index.html";
        </script>
    ';
    }
    else 
    $body='<script type="text/javascript" language="javascript">alert("Formular incomplet!");</script>';
    return $body;
}

function draw_contact_form(){
    $body='';
if (isset($_GET["base_Article"])) return '';
$err_msg='';
//Testare
if (isset($_GET["function"])&&$_GET["function"]=="send"){
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
if (isset($_GET["function"])&&$_GET["function"]=="send"&&$err_msg==''){
    $_SESSION["message_sent"]='ok';
    $date_now = date('l jS \of F Y h:i:s A'); 
    $subiect = 'Mesaj trimis in pagina de contact de la '.$nume.' '; 
	$continut = '<html><body><h2>Continut mesaj: </h2><p>'.$ctn.'</p><br/><h3>Date expeditor: </h3><p>Nume, Prenume: '.$nume.'</p><p>E-mail: '.
                $mail.'</p><p>Telefon: '.$companie.'</p><p>Data interogarii: '.$date_now.'</p></body></html>';
			    //END CONTENT
	mail_it($continut,$subiect);
    $body.='<script type="text/javascript">location.href="index.html";</script>';
}
if (isset($_SESSION["message_sent"])){
$body.='<div class="featurebox_center" style="width:490px; border:solid 1px gray; padding:10px; float:left; display:inline;">
        <img src="'.absolute_path().'plugins/global/images/active.png" alt="ok" style="padding:2px;"/><a style="position:relative; cursor:default; top:-4px;">Mesajul a fost trimis cu succes!<br/>
        Echipa noastra va va raspunde in cel mai scurt timp.
        </a>
    </div>';
}
else{
$body.='
<style type="text/css">
/*Contact*/
#contact_spc{width:500px; float:left; display:inline; height:200px;}
.contact_component{width:480px; height:50px; padding:5px; display:block;}
.contact_textbox{width:476px; padding:2px;}
.contact_label{width:400px; color:Black; font-weight:bold; height:20px; float:left; font-size:11pt; padding-top:10px; text-align:left;}
.contact_btn{color:#de0d0d; font-weight:bold; border:none; background-color:Transparent; cursor:pointer; text-decoration:none; font-size:12pt;}
/*Contact*/
</style>

<div id="contact_spc" style="margin-left:10px;">';
//$body.='<a style="color:red">'.$err_msg.'</a>';
$body.='
				<form action="?function=send" method="post">
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
                    <div style="display:table; float:right; width:100px; padding:20px; height:30px;">
                    <input type="submit" class="contact_btn" 
                        onmouseover="this.style.color='."'".'Green'."'".';" onmouseout="this.style.color='."'".'#de0d0d'."'".';" 
                    value="Trimite mesajul" />
                    </div>
			   </form>		
</div>';
}
return $body;
}


?>
