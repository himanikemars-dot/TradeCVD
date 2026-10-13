<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/aboutus.php';

if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listbelievething')
	{
		$aboutus=new aboutus();
		$qry="SELECT id,title,shortdescr,concat(:imageurl,img) AS image 
				FROM tblbelievethings WHERE isactive=:isactive ORDER BY displayorder,timestamp";
		$parms = array(
			':isactive'=>1,
			':imageurl'=>$imgpath
		);
		$result=$DB->getmenual($qry,$parms,'aboutus');
		if($result)
		{
			$response['result']=$result;
			$response['numrows']=$DB->numberTowords(sizeof($result));
			$status=1;
			$message=$errmsg['success'];
		}else{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

	}
	else if($action == 'listmissionvisiondetail')
	{
		$aboutus=new aboutus();
		
		//Mission Detail Data
		$mqry="SELECT id,title,description FROM tblcontentsetting WHERE typeid=:typeid";
		$mparms = array(
			':typeid'=>6,
		);
		$missionresult=$DB->getmenual($mqry,$mparms,'aboutus');
		$response['missiondata']=$missionresult;

		//Values Detail Data
		$valqry="SELECT id,title,description FROM tblcontentsetting WHERE typeid=:typeid";
		$valparms = array(
			':typeid'=>8,
		);
		$missionresult=$DB->getmenual($valqry,$valparms,'aboutus');
		$response['valuesdata']=$missionresult;

		//Vision Detail Data
		$vqry="SELECT id,title,description FROM tblcontentsetting WHERE typeid=:typeid";
		$vparms = array(
			':typeid'=>7,
		);
		$visionresult=$DB->getmenual($vqry,$vparms,'aboutus');
		$response['visiondata']=$visionresult;
		$status=1;
		$message=$errmsg['success'];
		
	}

	
}
require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  