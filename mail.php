 <?php 
/*mail code starts here*/

//$email_from = 'mohammad.sajid@netcreativemind.co.in'; // Who the email is from 
$email_subject = "Password Notification"; // The Subject of the email
$email_to='dwivedianil007@gmail.com';
$subject = $email_subject;
$email_message="<table width='100%'  border='0' cellspacing='0' cellpadding='0' align='left'>
<tr><td colspan='3' align='left' class='text_mail' >Dear Test  ,</td></tr>
<tr><td colspan='3' class='text_mail'>&nbsp;</td></tr>
<tr> <td colspan='3' align='left' class='text_mail'>Your admin panel login details are as follows:</td></tr>
<tr><td  colspan='3' class='text_mail'>&nbsp;</td></tr>
<tr><td width='40%'><table width='50%'  border='0' cellspacing='0' cellpadding='0' align='left'>
<tr><td class='text_mail' colspan='3'>&nbsp;</td></tr> </table></td></tr>
<tr><td class='text_mail' colspan='3'align='left'>Test</td></tr>
</table>";	
$headers = 'MIME-Version: 1.0' . "\n\n" . 
$headers = "From:<dwivedianil007@gmail.com>\n";
$headers .= "Content-type: text/html\n";
$ok=@mail($email_to, $email_subject, $email_message,$headers);







/*$mail = new PHPMailer();

$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "100.100.7.3"; // SMTP server

$mail->From     = "dwivedianil007@gmail.com";
$mail->AddAddress("dwivedianil43@yahoo.com");

$mail->Subject  = "First PHPMailer Message";
$mail->Body     = "Hi! \n\n This is my first e-mail sent through PHPMailer.";
$mail->WordWrap = 50;

if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}



*/













?>
 </body>
</html>
