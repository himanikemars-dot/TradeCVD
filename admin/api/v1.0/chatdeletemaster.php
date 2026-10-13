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
		$qry="SELECT * from tblchatdeletemaster ORDER BY id LIMIT 1";
			
			$result_ary=$DB->getmenual($qry);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['chatdeletedays']=$IISMethods->sanitize($row['chatdeletedays']);
				$status=1;
				$message=$errmsg['datafound'];

			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
			
		
	}
	else if($action=='insertchatdeletedays')   
	{
		$chatdeletedays=$IISMethods->sanitize($_POST['chatdeletedays']);
		
		if($chatdeletedays)
		{
			$qry="SELECT id FROM tblchatdeletemaster ORDER BY id LIMIT 1";
			
			$result_ary=$DB->getmenual($qry);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				$insdata = array(
					'chatdeletedays'=>$chatdeletedays,
					'update_uid'=>$uid,
					'update_date'=>$IISMethods->getdatetime(),
				);

				$extraparams=array(
					'id'=>$row['id'],
				);
				$DB->executedata('u','tblchatdeletemaster',$insdata,$extraparams);

				$status=1;
				$message=$errmsg['update'];	
			}
			else
			{
				$unqid = $IISMethods->generateuuid();
				$insdata = array(
					'id'=>$unqid,
					'chatdeletedays'=>$chatdeletedays,
					'timestamp'=>$IISMethods->getdatetime(),
					'entry_uid'=>$uid,
					'entry_date'=>$IISMethods->getdatetime(),
				);
				// print_r($insdata);
				$DB->executedata('i','tblchatdeletemaster',$insdata,'');

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

  