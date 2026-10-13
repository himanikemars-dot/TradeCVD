<?php
/*
 * login service
 *
 *
 params : username,password
 *
 */
header("Content-Type:application/json");

require_once dirname(__DIR__, 2).'/config/init.php';
//require_once dirname(__DIR__, 3).'/config/apiconfig.php';

$action = $_REQUEST['action'];

$key=$IISMethods->sanitize($headerparams['key']);
$platform=$IISMethods->sanitize($headerparams['platform']);

$message = $errmsg['invalidrequest'];
$status = 0;
$forgotemail = $_POST['forgotuname'];
if ($key) 
{
	
   	$skey = md5('dietition_app11112021');  //5a53d008618deb57326f4f21beb8f63b
	if (trim($key) == trim($skey)) 
	{

		if($action == 'forgotpassword')
		{
			
			$qrychkusr ="SELECT * FROM tblpersonmaster pm WHERE IFNULL(pm.isdelete,0) = 0 AND (pm.contact=:contact OR pm.email=:email)";
			$personparams=array(
				':contact'=>$forgotemail,
				':email'=>$forgotemail
			);
			$reschkusr = $DB->getmenual($qrychkusr,$personparams); 
			if(sizeof($reschkusr) > 0) 
			{
				$row=$reschkusr[0];
				$id = $IISMethods->sanitize($row['id']);
				$otp = $IISMethods->RandomOTP(4);
				
				$uptdata = array(
					'otp'=>$otp
				);
				
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblpersonmaster',$uptdata,$extraparams);

				$smstext="Dear ".$row['personname'].",  ".$otp." is your verification code for Forgot Password. Thank You.";
				$IISMethods->SendSMS($row['contact'],$smstext);

				$response['username'] = $forgotemail;
				$status=1;
				$message=$errmsg['sendotp'];
			}
			else
			{
				$status=0;
				$message=$errmsg['invaliduser'];
			}
			
		}
		else if($action == 'verifiedchangepasscode')
		{
			$hiddenid = $_POST['hiddenid'];
			$verifiedotp = $_POST['verifiedotp'];
			$qrychkusr ="SELECT * FROM tblpersonmaster pm WHERE IFNULL(pm.isdelete,0) = 0 AND (pm.contact=:contact OR pm.email=:email)";
			$personparams=array(
				':contact'=>$hiddenid,
				':email'=>$hiddenid
			);
			$reschkusr = $DB->getmenual($qrychkusr,$personparams); 
			if(sizeof($reschkusr) > 0) 
			{
				$row=$reschkusr[0];
				$id = $IISMethods->sanitize($row['id']);
				$otp = $IISMethods->sanitize($row['otp']);
				 if($verifiedotp == $otp)
				 {
					$response['hiddenid'] = $id;
					$status=1;
					$message=$errmsg['success'];
				 }
				 else
				 {
					$status=0;
					$message=$errmsg['invalidotp'];
				 }
			}
			else
			{
				$status=0;
				$message=$errmsg['invaliduser'];
			}
			
		}	
		else if($action=='changeforgotpassword')   
		{
			$npass=$IISMethods->sanitize($_POST['newpassword']);
			$hiddenid = $_POST['hiddenid'];
			$insqry=array(
				'password'=>md5($npass),
				'strpassword'=>$npass,
			);

				$qrychk="SELECT id from tblpersonmaster where id=:id";
				$parms = array(
					':id'=>$hiddenid,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$insqry['otp']='';
					$insqry['update_uid']=$hiddenid;	
					$insqry['update_date']=$IISMethods->getdatetime();

					$extraparams=array(
						'id'=>$hiddenid
					);
					$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);

					

					$status=1;
					$message=$errmsg['passchanged'];
				}	
				else
				{
					$status=0;
					$message=$errmsg['correctpass'];
				}
			
			
		}
	} 
	else 
	{
		$message = $errmsg['invalidtoken'];
	}
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';  


?>