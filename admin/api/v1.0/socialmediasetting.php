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
		$qry="SELECT * from tblsocialsetting ORDER BY id LIMIT 1";
			
			$result_ary=$DB->getmenual($qry);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['facebook']=$IISMethods->sanitize($row['facebook']);
				$response['instagram']=$IISMethods->sanitize($row['instagram']);
				$response['twitter']=$IISMethods->sanitize($row['twitter']);
				$response['skype']=$IISMethods->sanitize($row['skype']);
				$response['youtube']=$IISMethods->sanitize($row['youtube']);
				$status=1;
				$message=$errmsg['datafound'];

			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
			
		
	}
	
	else if($action=='insertsessting')   
	{
		$facebook=$IISMethods->sanitize($_POST['facebook']);
		$instagram =$IISMethods->sanitize($_POST['instagram']);
		$twitter=$IISMethods->sanitize($_POST['twitter']);
		$skype=$IISMethods->sanitize($_POST['skype']);
		$youtube=$IISMethods->sanitize($_POST['youtube']);
		
		// if($contactno && $wpcontact && $meetingduration && $buffermint && $onlinefrommint && $onlinetomint && $offlinefrom && $offlineto && $lunchfrom && $lunchto)
		// {
			$qry="SELECT id FROM tblsocialsetting ORDER BY id LIMIT 1";
			
			$result_ary=$DB->getmenual($qry);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				$insdata = array(
					'facebook'=>$facebook,
					'instagram'=>$instagram,
					'twitter'=>$twitter,
					'skype'=>$skype,
					'youtube'=>$youtube,
					'update_uid'=>$uid,
					'update_date'=>$IISMethods->getdatetime(),
				);

				$extraparams=array(
					'id'=>$row['id'],
				);
				$DB->executedata('u','tblsocialsetting',$insdata,$extraparams);

				$status=1;
				$message=$errmsg['update'];	
			}
			else
			{
				$unqid = $IISMethods->generateuuid();
				$insdata = array(
					'id'=>$unqid,
					'facebook'=>$facebook,
					'instagram'=>$instagram,
					'twitter'=>$twitter,
					'skype'=>$skype,
					'youtube'=>$youtube,
					'timestamp'=>$IISMethods->getdatetime(),
					'entry_uid'=>$uid,
					'entry_date'=>$IISMethods->getdatetime(),
				);
				// print_r($insdata);
				$DB->executedata('i','tblsocialsetting',$insdata,'');

				$status=1;
				$message=$errmsg['insert'];
			}
		// }
		// else 
		// {
		// 	$status=0;
		// 	$message=$errmsg['reqired'];
		// }
	} 
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  