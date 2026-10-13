<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{
	$imgpath=$config->getImageurl();
	//list vision data
	if($action == 'listproduct')
	{
		$showonhome = $_POST['showonhome'];
		$productid = $_POST['productid'];
		
		$qrychk = "SELECT p.id,p.name AS title,p.shortdescr,c.category,p.description,p.categoryid,p.brandid,p.brandname,
		IFNULL((SELECT CONCAT('$imgpath', ps.image) AS img FROM `tblproductimage` ps WHERE ps.productid = p.id ORDER BY displayorder LIMIT 1),CONCAT('$imgpath','images/product/product_d.jpg')) AS img,
		IFNULL((SELECT GROUP_CONCAT(DISTINCT st.typename) AS typename FROM `tblproductsupply` ps INNER JOIN `tblsupplytypemaster` st ON st.id = ps.supplytypeid WHERE ps.productid = p.id),'') AS typename,p.productuniqueid
		FROM `tblproductmaster` p
		INNER JOIN tblcategorymaster c ON c.id = p.categoryid
		WHERE p.isactive = :isactive ";
		
		$parms = array(
			':isactive'=>1,
		);

		if($showonhome == 1)
		{
			$qrychk.=" AND p.showonhome = :showonhome ";
			$parms[':showonhome']=1; 
		}

		if($productid)
		{
			$qrychk.=" AND p.productuniqueid = :productid ";
			$parms[':productid']=$productid; 
		}

		$qrychk.=" ORDER BY p.categoryid";
		$result_ary=$DB->getmenual($qrychk,$parms);
		if(sizeof($result_ary)>0)
		{
			$response['result'] = $result_ary;
			// print_r($result_ary);
			if($productid)
			{
				$prodid=$result_ary[0]['id'];
				$subqry="SELECT * FROM `tblproductmapping` WHERE productid = :id";
				$subparms = array(
					':id'=>$prodid,
				);
				$productmapping=$DB->getmenual($subqry,$subparms);
				if($productmapping)
				{
					$response['productmapping'] = $productmapping;
				}

				$subqry1 ="SELECT id,productid, CONCAT('$imgpath', image) as image FROM `tblproductimage` WHERE productid = :id";
				$subparms1  = array(
					':id'=>$prodid,
				);
				$productimg = $DB->getmenual($subqry1 ,$subparms1);
				if($productmapping)
				{
					$response['productimg'] = $productimg;
				}

				$reviewqry="SELECT personname,email,message,DATE_FORMAT(STR_TO_DATE(entry_date,'%Y-%m-%d'),'%M %d, %Y') AS edate,rating FROM tblreview WHERE productid=:productid and isactive=1 ORDER BY STR_TO_DATE(entry_date,'%Y-%m-%d %H:%i:%s') DESC ";
				$reviewparams=array(':productid'=>$prodid);
				$reviewres=$DB->getmenual($reviewqry ,$reviewparams);
				if($reviewres)
				{
					$response['reviewdata']=$reviewres;
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
	else if($action == 'listrelatedproduct')
	{
		$productid = $_POST['productid'];
		$qry="SELECT categoryid,id FROM tblproductmaster WHERE productuniqueid = :id";
		$proparams=array(
			':id'=>$productid
		);
		$result=$DB->getmenual($qry,$proparams);
		if(sizeof($result)>0)
		{

			
			$qrychk="SELECT p.id,p.name AS title,p.shortdescr,c.category,p.description,p.preferbuyer,p.categoryid,
			IFNULL((SELECT CONCAT(:imgpath, ps.image) AS img FROM `tblproductimage` ps WHERE ps.productid = p.id ORDER BY displayorder LIMIT 1),CONCAT(:imgpath, 'images/product/product_d.jpg')) AS img,p.productuniqueid
			FROM `tblproductmaster` p
			INNER JOIN tblcategorymaster c ON c.id = p.categoryid
			WHERE p.isactive = 1 AND p.categoryid = :categoryid AND p.id!=:id";
			$categoryid=$result[0]['categoryid'];
			$parms = array(
				':imgpath'=>$imgpath,
				':categoryid'=>$categoryid,
				':id'=>$result[0]['id']
			);
			// print_r($parms);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$response['result'] = $result_ary;
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
		}else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

	}
	else if($action == 'reviewdatadetail')
	{
		$id = $_POST['id'];
		$qry="SELECT personname,email,message,DATE_FORMAT(STR_TO_DATE(entry_date,'%Y-%m-%d'),'%M %d, %Y') AS edate,rating FROM tblreview WHERE productid=:id and isactive=1 ORDER BY STR_TO_DATE(entry_date,'%Y-%m-%d %H:%i:%s') DESC";
		$proparams=array(
			':id'=>$id
		);
		$result=$DB->getmenual($qry,$proparams);
		if(sizeof($result)>0)
		{

			
			$response['reviewdata'] = $result;
			$status=1;
			$message=$errmsg['success'];
			
		}else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

	}
	else if($action=='insertreviewdata')   
	{
		
		$reviewmessage=$_POST['reviewmessage'];
		$personname=$IISMethods->sanitize($_POST['personname']);
		$reviewemail=$IISMethods->sanitize($_POST['reviewemail']);
		$itemid = $IISMethods->sanitize($_POST['itemid']);
		$rate = $IISMethods->sanitize($_POST['rate']);

		$datetime=$IISMethods->getdatetime();
		if($personname && $reviewemail && $reviewmessage && $rate)
		{	
			if($rate>0 || $rate<6)
			{		
				$insqry=array(	
					'productid'=>$itemid,				
					'personname'=>$personname,
					'email'=>$reviewemail,
					'message'=>$reviewmessage,
					'rating'=>$rate,
				);
				
				
					
				$unqid = $IISMethods->generateuuid();
				$insqry['id']=$unqid;	
				$insqry['timestamp']=$IISMethods->getdatetime();
				$insqry['entry_date']=$datetime;

				$DB->executedata('i','tblreview',$insqry,'');

				
				$status=1;
				// $message=$errmsg['insert'];
				$message="Review Saved Successfully";
			}else{
				$status=0;
				$message=$errmsg['invalidrate'];
			}
				
				
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listcategory')   
	{
		$typeid=$IISMethods->sanitize($_POST['typeid']);

		$qry="SELECT DISTINCT c.id,c.category,COUNT(pm.id) AS totproduct  
			FROM `tblcategorymaster` c
			INNER JOIN tblproductmaster pm ON pm.categoryid=c.id AND pm.isactive=1
			WHERE c.isactive=:isactive GROUP BY c.id";
		$parms = array(':isactive'=>1);
		$result_ary=$DB->getmenual($qry,$parms);

		if(sizeof($result_ary)>0)
		{
			$response['result'] = $result_ary;
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

  