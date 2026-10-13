<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/package.php';

if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action=='listpackagetype')
	{
		$packagetype= new packagetype();
		$qry="SELECT id,typeid,name FROM tblpackagetype ORDER BY displayorder";
		$parms = array();
		$result=$DB->getmenual($qry,$parms,'packagetype');

		if(sizeof($result)>0) 
		{

			$response['data']=$result;
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

  