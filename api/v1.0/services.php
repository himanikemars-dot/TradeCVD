<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/services.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();
	$id=$IISMethods->sanitize($_POST['id']);

	if($action == 'listservices')
	{
		$services=new services();
		$qry = "SELECT sd.id,sd.title,sd.iconname,sd.shortdescr,sd.description,sd.isactive,sd.serviceuniqueid,
				IFNULL((SELECT CONCAT(:imgpath, ps.image) AS img FROM `tblserviceimage` ps WHERE ps.serviceid = sd.id ORDER BY ps.displayorder LIMIT 1),CONCAT(:imgpath,'images/services-d.png')) AS img
				FROM tblservicemaster sd WHERE sd.isactive=:isactive  ";
		$parms = array(
			':imgpath'=>$imgpath,
			':isactive'=>1
		);
		if($id)
		{
			$qry.=" AND sd.serviceuniqueid =:id";
			$parms[':id']=$id;
		}
		$qry.=" ORDER BY sd.displayorder ASC ";
		
		$services=$DB->getmenual($qry,$parms,'services');
		// print_r()
		if($services)
		{
			$response['result']=$services;

			if($id)
			{
				$serviceid=$services[0]->id;
				$subqry1 ="SELECT id,serviceid, CONCAT(:imgpath, image) as image FROM `tblserviceimage` WHERE serviceid = :id";
				$subparms1  = array(
					':id'=>$serviceid,
					':imgpath'=>$imgpath,
				);
				$serviceimg = $DB->getmenual($subqry1 ,$subparms1);
				// print_r($serviceimg);
				if(sizeof($serviceimg)>0)
				{
					$response['serviceimg'] = $serviceimg;
				}

				$subqry="SELECT id,serviceid,title,description FROM `tblservicetabdetail` WHERE serviceid = :id";
				$subparms = array(
					':id'=>$serviceid,
				);
				$servicetab=$DB->getmenual($subqry,$subparms);
				if(sizeof($servicetab)>0)
				{
					$response['servicetab'] = $servicetab;
				}
			}

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

  