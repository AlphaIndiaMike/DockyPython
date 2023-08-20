<?php
//mail_it('<html><body>'.$cmd.'</body></html>',"Inquiry sent from misiaspare.ro","site@misiaspare.ro");  
function mail_it($content, $subject, $recipient = default_recipient, $email=site_mail_address) {
   
   $ob = "----=_OuterBoundary_000";
   $ib = "----=_InnerBoundery_001";
   
   $headers  = "MIME-Version: 1.0\r\n"; 
   $headers .= "From: ".$email."\n";
   $headers .= "To: ".$recipient."\n";
   $headers .= "Reply-To: ".$email."\n";
   $headers .= "X-Priority: 1\n";
   $headers .= "X-Mailer: POM MailDaemon \n";
   $headers .= "Content-Type: multipart/mixed;\n\tboundary=\"".$ob."\"\n";
             
   $message  = "This is a multi-part message in MIME format.\n";
   $message .= "\n--".$ob."\n";
   $message .= "Content-Type: multipart/alternative;\n\tboundary=\"".$ib."\"\n\n";
   $message .= "\n--".$ib."\n";
   $message .= "Content-Type: text/html;\n\tcharset=\"utf-8\"\n";
   $message .= "Content-Transfer-Encoding: quoted-printable\n\n";
   $message .= $content."\n\n";
   $message .= "\n--".$ib."--\n";
   $message .= "\n--".$ob."--\n";
   
   if (defined('admin_recipient')) $recipient=default_recipient.", ".admin_recipient;
   
   mail($recipient, $subject, $message, $headers);
}

//Se pune in content_body DOAR CONTINUTUL DIN BODY FARA BODY, NIMIC ALTCEVA
function mail_html($content_body,$subject,$content_txt="", $recipient = default_recipient, $email=site_mail_address){
    if (defined('admin_recipient')) $recipient=default_recipient.", ".admin_recipient;
    
    $mesaj=to_utf8('<html xmlns="http://www.w3.org/1999/xhtml">
                        <head >
                                <title>Inregistrare</title>
                                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                        </head>
                        <body style="color:#000;">
                        '.$content_body.'
                        </body>
                    </html>');
    mail_it($mesaj,$subject,$recipient,$email);
}

?>