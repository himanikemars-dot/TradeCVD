<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/benefit.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listbenefit')
	{
		$type = $IISMethods->sanitize($_POST['type']);
		$benefit=new benefit();
		$qrychk="SELECT id,title,shortdescr,displayorder,CONCAT(:imgpath,img) as image FROM `tblbenefits` WHERE typeid=:type AND isactive = :isactive ORDER BY `displayorder` ASC";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath,
			':type'=>$type
		);
		
		$benefit=$DB->getmenual($qrychk,$parms,'benefit');

		if(sizeof($benefit)>0)
		{
			$response['result'] = $benefit;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action == 'viewtestimonial')
	{
		$id = $IISMethods->sanitize($_POST['id']);
		$testimonial=new testimonial();
		$qrychk="SELECT id,company,name,displayorder,description,isactive,CASE WHEN(image!='') THEN CONCAT(:imgpath,image) ELSE :defaultimageurl END as image,designation FROM `tbltestimonial` WHERE id = :id ORDER BY `displayorder` ASC";
		$parms = array(
			':id'=>$id,
			':imgpath'=>$imgpath,
			':defaultimageurl'=>$config->getDefaultProfileImageurl()
		);
		$testimonial=$DB->getmenual($qrychk,$parms,'testimonial');

		if(sizeof($testimonial)>0)
		{
			$response['result'] = $testimonial;
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

  