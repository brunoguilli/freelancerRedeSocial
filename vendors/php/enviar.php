<?php   
// E-mail da fazendinha
$mailFazendinha = 'fazendinha.lombagrande@gmail.com';

 date_default_timezone_set('Etc/UTC');
 require 'PHPMailer-master/PHPMailerAutoload.php';
 //Create a new PHPMailer instance
 $mail = new PHPMailer;
 //Tell PHPMailer to use SMTP
 $mail->isSMTP();
 //Enable SMTP debugging
 // 0 = off (for production use)
 // 1 = client messages
 // 2 = client and server messages
 $mail->SMTPDebug = 2;
 //Ask for HTML-friendly debug output
 $mail->Debugoutput = 'html';
 //Set the hostname of the mail server
 $mail->Host = 'smtp.gmail.com';
 // use
 // $mail->Host = gethostbyname('smtp.gmail.com');
 // if your network does not support SMTP over IPv6
 //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
 $mail->Port = 587;
 //Set the encryption system to use - ssl (deprecated) or tls
 $mail->SMTPSecure = 'tls';
 //Whether to use SMTP authentication
 $mail->SMTPAuth = true;
 //Username to use for SMTP authentication - use full email address for gmail
 $mail->Username = $mailFazendinha;
 //Password to use for SMTP authentication
 $mail->Password = "Fazendadalomba@2019";
 //Set who the message is to be sent from
 $mail->setFrom($_REQUEST['email'], utf8_decode($_REQUEST['nome']));
 //Set an alternative reply-to address
 $mail->addReplyTo($_REQUEST['email'], utf8_decode($_REQUEST['nome']) );
 //Set who the message is to be sent to
$mail->addAddress($mailFazendinha, utf8_decode($_REQUEST['nome'])); 
//Set the subject line
 $mail->Subject = "FAZENDINHA - ".utf8_decode($_REQUEST['assunto']);
 //Read an HTML message body from an external file, convert referenced images to embedded,
 //convert HTML into a basic plain-text alternative body
 $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
 //
 $mail->Body    = $_REQUEST['mensagem']; 
 //Replace the plain text body with one created manually
//  $mail->AltBody = $_REQUEST['mensagem']." - E-MAIL: ".$_REQUEST['email'];
 //Attach an image file

 $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//  $mail->addAttachment('PHPMailer-master/examples/images/logoFazendinha2.png');
 //send the message, check for errors
 if (!$mail->send()) {
     echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
     echo "Message sent!";
 }
 
?>