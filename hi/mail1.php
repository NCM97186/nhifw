<?php 
$email_from = "dwivedianil007@gmail.com"; // Who the email is from 
		$email_subject = "Password Notification"; // The Subject of the email
		$email_to= "dwivedianil007@gmail.com";
		$headers.= "From: ".$email_from."\r\n"; 
		$headers.= "Content-type: text/html; charset=iso-8859-1\n"; 
		$email_message.="<table width='100%'  border='0' cellspacing='0' cellpadding='0' align='left'>
		<tr><td colspan='3' align='left' class='text_mail' >Dear  jjj,</td></tr>
		<tr><td colspan='3' class='text_mail'>&nbsp;</td></tr>
		<tr> <td colspan='3' align='left' class='text_mail'>Your control panel login details are as follows:</td></tr>
		<tr><td  colspan='3' class='text_mail'>&nbsp;</td></tr>
		<tr><td width='40%' colspan='3' >
		<table width='50%'  border='0' cellspacing='0' cellpadding='0' align='left'>
              
		
		</td><td width='25%' align='left'> </td></tr>
		<tr><td class='text_mail'>&nbsp;</td></tr> </table>
		</td></tr>
                  <tr><td  colspan='3'>&nbsp;</td></tr>
                <tr><td class='text_mail' colspan='3'align='left'>Regards,</td></tr>
		<tr><td class='text_mail' colspan='3'align='left'>jjjj</td></tr>
		</table>";	
	if(mail($email_to, $email_subject, $email_message, $headers))
			{
				$status=1;
			
			}
			else
			{
			
				$status=0;
			}
?>