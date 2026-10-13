<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/contentsetting.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listcontentsetting')
	{
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		// echo $typeid;
		$contentsetting=new contentsetting();
		$qrychk="SELECT id,contenttypeid,typeid,title,description,CASE WHEN(img!='') THEN CONCAT(:imgpath,img) ELSE '' END as image FROM `tblcontentsetting` WHERE typeid = :typeid";
		$parms = array(
			':typeid'=>$typeid,
			':imgpath'=>$imgpath,
		);
		// echo $qrychk;
		//  print_r($parms);
		$contentsetting=$DB->getmenual($qrychk,$parms,'contentsetting');

		if(sizeof($contentsetting)>0)
		{
			
			$response['result'] = $contentsetting;
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

  