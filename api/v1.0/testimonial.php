<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/testimonial.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listtestimonial')
	{
		
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$testimonial=new testimonial();
		$qrychk="SELECT id,company,name,displayorder,description,isactive,CASE WHEN(image!='') THEN CONCAT(:imgpath,image) ELSE :defaultimageurl END as image,designation FROM `tbltestimonial` WHERE isactive = :isactive AND typeid=:typeid ORDER BY `displayorder` ASC";
		$parms = array(
			':typeid'=>$typeid,
			':isactive'=>1,
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

  