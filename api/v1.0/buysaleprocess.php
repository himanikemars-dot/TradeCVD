<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/buysaleprocess.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listbuysaleprocess')
	{
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$bannertypeid=$IISMethods->sanitize($_POST['bannertypeid']);
		$buysaleprocess=new buysaleprocess();
		$qrychk="SELECT id,typeid,typetext,title,description,CONCAT(:imgpath,buysellprocessimg) as image FROM `tblbuysellprocess` WHERE typeid = :typeid AND isactive=1 ORDER BY displayorder";
		$parms = array(
			':typeid'=>$typeid,
			':imgpath'=>$imgpath,
		);
		// print_r($parms);
		$buysaleprocess=$DB->getmenual($qrychk,$parms,'buysaleprocess');

		if(sizeof($buysaleprocess)>0)
		{
			$response['result'] = $buysaleprocess;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

		$bannerqry="SELECT id,contenttypeid,typeid,title,description,CASE WHEN(img!='') THEN CONCAT(:imgpath,img) ELSE CONCAT(:imgpath,'images/d-banner.jpg') END as image FROM `tblbannersetting` WHERE typeid=:bannertypeid";
		$bannerparams=array(
			':bannertypeid'=>$bannertypeid,
			':imgpath'=>$imgpath,
		);
		$bannerres=$DB->getmenual($bannerqry,$bannerparams);
		$response['banner']=$bannerres;

	}
	
}	

require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  