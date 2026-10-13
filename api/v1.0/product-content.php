<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();
	//list vision data
	if($action == 'listproduct')
	{
		$qrychk="select id,name as title,displayorder,CONCAT('$imgpath',img) as img from `tblproduct` WHERE isactive = :isactive ORDER BY displayorder ASC";
		
		$parms = array(
			':isactive'=>1,
		);
		
		$result_ary=$DB->getmenual($qrychk,$parms);

		if(sizeof($result_ary)>0)
		{
			$response['result'] = $result_ary;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

	}
	if($action == 'listproductservice')
	{
		$qrychk="select id,name as title,subtitle,displayorder,description,CONCAT('$imgpath',img) as img from `tblproductservice` WHERE isactive = :isactive ORDER BY displayorder ASC";
		
		$parms = array(
			':isactive'=>1,
		);
		
		$result_ary=$DB->getmenual($qrychk,$parms);

		if(sizeof($result_ary)>0)
		{
			$response['result'] = $result_ary;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

	}

	
}
require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  