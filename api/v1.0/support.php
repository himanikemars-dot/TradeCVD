<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/support.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listsupport')
	{
		$support=new support();
		$qrychk="SELECT id,title,displayorder,description,CONCAT(:imgpath,img) as image FROM `tblsupportmaster`  ORDER BY `displayorder` ASC";
		$parms = array(
			':imgpath'=>$imgpath,
		);
		
		$support=$DB->getmenual($qrychk,$parms,'support');

		if(sizeof($support)>0)
		{
			$response['result'] = $support;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action == 'viewsupport')
	{
		$id = $IISMethods->sanitize($_POST['id']);
		$support=new support();
		$qrychk="SELECT id,title,displayorder,description,CONCAT(:imgpath,img) as image FROM `tblsupportmaster` WHERE id = :id ORDER BY `displayorder` ASC";
		$parms = array(
			':id'=>$id,
			':imgpath'=>$imgpath,
		);
		$support=$DB->getmenual($qrychk,$parms,'support');

		if(sizeof($support)>0)
		{
			$response['result'] = $support;
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

  