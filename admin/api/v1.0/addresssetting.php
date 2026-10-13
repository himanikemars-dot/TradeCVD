<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='fillcontent')   
	{
		$qry="SELECT * from tbladdresssetting ORDER BY id LIMIT 1";
			
			$result_ary=$DB->getmenual($qry);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['address']=$IISMethods->sanitize($row['address'],'OUT');
				$response['contact1']=$IISMethods->sanitize($row['contact1']);
				$response['contact2']=$IISMethods->sanitize($row['contact2']);
				// $response['officetime'] = $IISMethods->sanitize($row['officetime']);
				$response['email']=$IISMethods->sanitize($row['email']);
				$response['email2']=$IISMethods->sanitize($row['email2']);
				$response['maplink']=$IISMethods->sanitize($row['maplink']);

				$response['supportcontact']=$IISMethods->sanitize($row['support_contact']);
				$response['supportemail']=$IISMethods->sanitize($row['support_email']);
				$response['supportwhatsappno']=$IISMethods->sanitize($row['support_whatsappno']);
				$status=1;
				$message=$errmsg['datafound'];

			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
			
		
	}
	
	else if($action=='insertaddresssetting')   
	{
		$address = $IISMethods->sanitize($_POST['address']);
		$contact1 = $IISMethods->sanitize($_POST['contact1']);
		$contact2 = $IISMethods->sanitize($_POST['contact2']);
		$email = $IISMethods->sanitize($_POST['email']);
		$email2 = $IISMethods->sanitize($_POST['email2']);
		// $officetime = $IISMethods->sanitize($_POST['officetime']);
		$maplink = $IISMethods->sanitize($_POST['maplink']);

		$supportcontact = $IISMethods->sanitize($_POST['supportcontact']);
		$supportemail = $IISMethods->sanitize($_POST['supportemail']);
		$supportwhatsappno = $IISMethods->sanitize($_POST['supportwhatsappno']);
		
		if($contact1 && $email)
		{
			$qry="SELECT id FROM tbladdresssetting ORDER BY id LIMIT 1";
			
			$result_ary=$DB->getmenual($qry);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				$insdata = array(
					'address'=>$address,
					'contact1'=>$contact1,
					'contact2'=>$contact2,
					'email'=>$email,
					// 'email2'=>$email2,
					'maplink'=>$maplink,
					'support_contact'=>$supportcontact,
					'support_email'=>$supportemail,
					'support_whatsappno'=>$supportwhatsappno,
					// 'officetime'=>$officetime,
					
					'update_uid'=>$uid,
					'update_date'=>$IISMethods->getdatetime(),
				);

				$extraparams=array(
					'id'=>$row['id'],
				);
				$DB->executedata('u','tbladdresssetting',$insdata,$extraparams);

				$status=1;
				$message=$errmsg['update'];	
					
			}
			else
			{
				$unqid = $IISMethods->generateuuid();
				$insdata = array(
					'id'=>$unqid,
					'address'=>$address,
					'contact1'=>$contact1,
					'contact2'=>$contact2,
					'email'=>$email,
					// 'email2'=>$email2,
					// 'officetime'=>$officetime,
					'maplink'=>$maplink,
					'timestamp'=>$IISMethods->getdatetime(),
					'entry_uid'=>$uid,
					'entry_date'=>$IISMethods->getdatetime(),
				);
				// print_r($insdata);
				$DB->executedata('i','tbladdresssetting',$insdata,'');

				$status=1;
				$message=$errmsg['insert'];
			}
		}
		else 
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	} 
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  