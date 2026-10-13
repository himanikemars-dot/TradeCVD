<?php 

require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

$emailto='pinkal.lad@instanceit.com';
$subject='test by iis';
$data='test by iis';


$DB->getemailbody($emailto,$subject,$data,'','','','','');
//$DB->sendemail($emailto,$subject,$data,'','','','','');
exit;
$emailstatus = 0;
$errormsg = '';
//$emailto='amit.nanda@instanceit.com';
$qrysett = "SELECT * FROM tblsmtpconfig ";
$settparams = array();
$ressett =$DB->getmenual($qrysett, $settparams);
$numsett=sizeof($ressett);
if($numsett > 0)
{
    //echo '123';
	$rowsett=$ressett[0];

	$mailhost=$rowsett['hostname'];
	$mailPort=$rowsett['port'];
	$mailusername=$rowsett['emailid'];
	$mailpassword=$rowsett['password'];
	$mailemail=$rowsett['replyemailid'];
	$mailsendername=$rowsett['name'];
	if($sendername){
		$mailsendername=$sendername;
	}
	// echo $data;
	if($data)
	{
	    
		$email_body = $data;
		

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = $mailhost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $mailusername;
        $mail->Password   = $mailpassword;
        $mail->SMTPSecure = 'ssl'; // or 'tls'
        $mail->Port       = $mailPort; // or 587 for tls
    
        $mail->setFrom($mailusername, $mailsendername);
        $addresses = explode(',',$emailto);
		foreach ($addresses as $address) {
			$mail->AddAddress(trim($address));
		}
    
        $mail->Subject = $subject;
        $mail->Body    = $email_body;
    
        $sent=$mail->send();
        
        if(!$sent) {
		    //echo '123';
			$emailstatus = 0;
			$errormsg = $mail->ErrorInfo;
		}else {
			$emailstatus = 1;
			$errormsg = "Success";
		}
 
	}	
}

?>