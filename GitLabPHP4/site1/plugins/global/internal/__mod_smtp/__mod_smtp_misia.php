<?php

include_once("lib/swift_required.php");

function mail_it($content, $subject, $recipient = default_recipient, $email=site_mail_address) {
    mail_html($content,$subject,"",$recipient,$email);    
}
//Se pune in content_body DOAR CONTINUTUL DIN BODY FARA BODY, NIMIC ALTCEVA
//function mail_html($content_body,$content_txt="",$att_name="",$att_path="",$subject,$recipient = default_recipient,$recipient_name="",$email=site_mail_address){
function mail_html($content_body,$subject,$content_txt="", $recipient = default_recipient, $email=site_mail_address,$att_name="",$att_path="",$recipient_name=""){
    
    $html=to_utf8('<html xmlns="http://www.w3.org/1999/xhtml">
                        <head >
                                <title>Inregistrare</title>
                                <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                        </head>
                        <body style="color:#000;">
                        '.$content_body.'
                        </body>
                    </html>');
                    
     include_once "lib/swift_required.php";

     // This is your From email address
     $from = array($email => site_mail_name);

     // Email recipients
     $to = array(
          $recipient=>$recipient_name,
     );
     if (defined('admin_recipient')) $to[admin_recipient]="Administrator";
     
     // Email subject
     //$subject = 'Example PHP Email'; From Call

     // Setup Swift mailer parameters
     $transport = Swift_SmtpTransport::newInstance(smtp_server, smtp_port, "ssl");
     $transport->setUsername(smtp_user);
     $transport->setPassword(smtp_password);
     $swift = Swift_Mailer::newInstance($transport);

     // Create a message (subject)
     $message = new Swift_Message($subject);

     // attach the body of the email
     $message->setFrom($from);
     $message->setBody($html, 'text/html');
     $message->setTo($to);
     $message->addPart($content_txt, 'text/plain');
     if ($att_name!=""&&$att_path!="")
     $message->attach(Swift_Attachment::fromPath($att_path)->setFileName($att_name));

     // send message 
     if ($recipients = $swift->send($message, $failures))
     {
          // This will let us know how many users received this message
          return 'Message sent out to '.$recipients.' users';
     }
     // something went wrong =(
     else
     {
          return "Something went wrong - ".$failures;
     }
}

?>