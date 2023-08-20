<?php
           $continut_pagina.=title("Trimite CV");
           
           $header.=insert_css("upload.css");
           
           
            $continut_pagina.='
           <script type="text/javascript" language="javascript">
           //<![CDATA[
             $(document).ready(function() {
                $('."'".'#subiect'."'".').watermark('."'".'Denumirea postului'."'".');
             });
           //]]>
           </script>
           ';
           $header.='
            <script type="text/javascript" language="javascript">
             //<![CDATA[
                $(document).ready(function() {
    	           $("#subiect").autocompleteArray([';
                    $q=opentb("jobs","1=1");
                    if ($q!=null)
                    while($rows=mysql_fetch_assoc($q)){
                        $header.='"'.$rows["titlu"].'",';
                    }
                    $header.='   
                   "Nespecificat"],{delay:10,minChars:1,matchSubset:1,/*onItemSelect:selectItem,onFindValue:findValue,*/
                        autoFill:true,maxItemsToShow:10}
    
    	           );
                });
            //]]>
            </script>';
            if (return_session("cv_link")=="") {
           $header.=insert_js("upload/ajaxupload.3.6.js");
           $header.='
           <script type="text/javascript" >
           //<![CDATA[
                var file_ok=false;
            	$(function(){
            		var btnUpload=$('."'".'#upload_btn'."'".');
            		var status=$('."'".'#status'."'".');
            		new AjaxUpload(btnUpload, {
            			action: '."'".get_js('upload/upload-file.php')."'".',
            			name: '."'".'uploadfile'."'".',
            			onSubmit: function(file, ext){
     				      //Verific cate fisiere sunt incarcate
                            if (file_ok==true){ 
                                    // extension is not allowed 
                					status.html('."'".'Puteti incarca un singur fisier odata!<br/><br/>'."'".');
                					return false;
  				            }
                            //Veific extensia
                            if (! (ext && /^(pdf|doc|docx|odt)$/.test(ext))){ 
                                // extension is not allowed 
            					status.html('."'".'Doar documente pdf,doc,docx,odt sunt permise!<br/><br/>'."'".');
            					return false;
         				    }
            				status.text('."'".'Se incarca...'."'".');
            			},
            			onComplete: function(file, response){
            				//On completion clear the status
            				status.html('."'".'Fișiere încarcate:<br/><br/>'."'".');
            				//Add uploaded file to list
            				if(response==="success"){
            				    file_ok=true;
            					$('."'".'<li><\/li>'."'".').appendTo('."'".'#files'."'".').html('."'".'<img src="'.get_image("active.png").'" alt="" /><br />'."'".'+file).addClass('."'".'success'."'".');
                            } else{
            					$('."'".'<li><\/li>'."'".').appendTo('."'".'#files'."'".').html('."'".'<img src="'.get_image("delete-icon.png").'" alt="" /><br />'."'".'+file).addClass('."'".'error'."'".');
            				}
            			}
            		});
            		
            	});
             //]]>
            </script>
           ';
           }
            
           $snd_cv_app='
           <form action="'.self_href(false,return_topic(),return_param(1),"","","","cv_sent").'" method="post" style="font-weight:bold; text-align:left;" id="job_upload">
            <span style="position:relative; top:-3px;">
            Subiect: <input type="text" maxlength="200" name="subiect" id="subiect" style="width:200px; border:none; padding:2px;" value="'.return_post("subiect").'"/>&nbsp;&nbsp;
            Adresa e-mail: <input type="text" maxlength="200" name="mail" id="mail" style="width:200px; border:none; padding:2px;" value="'.return_post("mail").'"/>&nbsp;&nbsp;
            ';
            if (return_session("cv_link")=="")$snd_cv_app.='
                <img id="upload_btn" src="'.get_image("uploadcv.png").'" alt="upload_cv" style="position:relative; top:6px;"/>&nbsp;&nbsp;
            ';
            else {
                $snd_cv_app.='<img src="'.get_image("active.png").'" alt="ok" /> CV Încărcat &nbsp;&nbsp;&nbsp;&nbsp;';
            }
           $snd_cv_app.='
            <a href="'."javascript:document.getElementById('job_upload').submit()".'" style="color:transparent; border:none; cursor:pointer;">
                <img src="'.get_image("trimite.png").'" alt="upload_cv" style="position:relative; top:10px;" />
            </a>
            </span>
           </form>
           ';
           
           if (return_selector(1)=="cv_sent"&&(return_session("cv_sent")=="")){
                $erro='';
                if (return_post("subiect")=="") $erro.="Nu ați introdus postul pentru care candidați!<br/>";
                if (invalidEmail(return_post("mail"))==true) $erro.="Nu ați introdus o adresă validă de email!<br/>";
                else if (return_post("mail")=="") $erro.="Nu ați introdus adresa dvs. de email!<br/>";
                if (return_session("cv_link")=="") $erro.="Nu ați încarcat nici un CV!<br/>";
           }
           
           //AICI SE TRIMITE TREABA LA SEDIU
           if ((return_session("cv_link")!="")&&((return_session("cv_sent")!="")||(isset($erro)&&$erro==""))) {
                $snd_cv_app='<p><img src="'.get_image("active.png").'" alt="ok" />&nbsp;&nbsp;<b> Vă mulțumim pentru candidatura dvs., veți fi contactat imediat ce CV-ul dvs. a fost validat pentru postul optat.</b></p>';
                //AICI SE VALIDEAZA SI SE TRIMIT MAILURILE
                if (!isset($_SESSION["cv_sent"])) {
                    $_SESSION["cv_sent"]="true";
                    //Mesaj catre client
                    $mesaj=to_utf8('
                            <html xmlns="http://www.w3.org/1999/xhtml">
                                <head >
                                <title>Inregistrare</title>
                                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                                </head>
                                <body style="color:#000;">'.
                                '<h3>Va mulțumim ca ne-ați ales!</h3><br/>
                                <p>Prin acest e-mail confirmăm înregistrarea dvs. în baza noastră de date. <br/>
                                Reprezentanții noștrii vor lua legătura cu dvs. îndată ce CV-ul a fost validat pentru postul optat.
                                </p><br/><br/>
                                <p>Cu stimă,<br/>
                                Echipa Psihologic</p><br/><br/><br/><br/><p style="font-size:8pt;">'.
                                '</p></body>
                            </html>');
                            mail_it($mesaj,"Psihologic.ro : Confirmarea candidaturii dvs. ",return_post("mail"));
                    
                    //Mesaj catre server
                    $coda=$_SESSION["cv_link"];//CV LINK SE SETEAZA DIN FISIERUL: global/js/upload/upload-file.php
                    $mesaj=to_utf8('
                            <html xmlns="http://www.w3.org/1999/xhtml">
                                <head >
                                <title>Inregistrare</title>
                                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                                </head>
                                <body style="color:#000;">'.
                                '<h3>A aparut un candiadat nou pentru postul : '.return_post("subiect").'</h3><br/>
                                <p>
                                Candidatul cu adresa de e-mail:<b> '.return_post("mail").'</b> a incarcat CV-ul la data: <b>'.date("r").'</b>.<br/> 
                                CV-ul sau poate fi accesat prin urmatoarea legatura: 
                                 <A=20 
                                href=3D"'.domeniu.$coda.'">CV CANDIDAT</A>=20
                                </p><br/>
                                Daca nu este accesibila legatura de mai sus copiati urmatorul rand in campul de adresa al navigatorului dvs:
                                <br/>
                                '.domeniu.$coda.
                                '
                                <br/><br/><br/>
                                <p>
                                Site-ul Psihologic,</p><br/><br/><br/><br/><p style="font-size:8pt;">'.
                                '</p></body>
                            </html>');
                            mail_it($mesaj,"Psihologic.ro : Candidat nou pentru postul ".return_post("subiect"));
                            
                }
           }
           //
           //action: '."'".self_href(false,return_topic(),return_param(1))."'".'
           //Aici se pune traybarul cu applicatia
           //APLICATIA PROPRIUZISA
           //APP 
           $continut_pagina.=tray_bar($snd_cv_app);
           //APP
           //APP
           //Aici se afiseaza efectiv erorile
           if (isset($erro)&&$erro!="") $continut_pagina.='<p class="rederror">'.$erro.'</p>';
           
           //if (return_selector(1)!="cv_sent")
           $continut_pagina.='
           <div style="display:table;"><br/>
               <span id="status"></span>
               <ul id="files" ></ul>
           </div>';
?>