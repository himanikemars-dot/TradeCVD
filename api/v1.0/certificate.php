<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/certificate.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listcertificate')
	{
		$certificate=new certificate();
		$qrychk="SELECT id,title,name,displayorder,title,isactive,CONCAT(:imgpath,img) as image FROM `tblcertificatemaster` WHERE isactive = :isactive ORDER BY `displayorder` ASC";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);
		
		$certificate=$DB->getmenual($qrychk,$parms,'certificate');

		if(sizeof($certificate)>0)
		{
			$response['result'] = $certificate;
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

  