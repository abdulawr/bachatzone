<?php

function sendMail($email,$subject,$message){
  
    include("src/PHPMailer.php");
    include("src/POP3.php");
    include("src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    try {
        $mail->isSMTP();                                           
        $mail->Host       = 'mail.bachatzone.com';                   
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'support@bachatzone.com';          
        $mail->Password   = 'Basit123#$G';                        
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;          
        $mail->Port       = 465; 
    
        //Recipients
        $mail->setFrom('support@bachatzone.com', 'Bachat Zone');
        $mail->addAddress($email);  
        $mail->addReplyTo('support@bachatzone.com', 'Bachat Zone');
    
        //Attachments
       // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
       // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);  
        $mail->Subject = $subject;
        $mail->Body    = $message;
       // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        return true;
    } catch (Exception $e) {
       return false;
    }
}


//sendMail("tcomprog@gmail.com","Subject here","Message here");

?>