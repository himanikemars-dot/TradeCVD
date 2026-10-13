<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/brand.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listbrand')
	{
		$brand=new brand();
		$qrychk="SELECT id,title,displayorder,CONCAT(:imgpath,img) as image FROM `tblbrandmaster` WHERE isactive=1 ORDER BY `displayorder` ASC";
		$parms = array(
			':imgpath'=>$imgpath
		);
		
		$brand=$DB->getmenual($qrychk,$parms,'brand');

		if(sizeof($brand)>0)
		{
			$response['result'] = $brand;
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

  