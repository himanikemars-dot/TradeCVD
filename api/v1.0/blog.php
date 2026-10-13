<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();
	//list vision data
	if($action == 'listblog')
	{
		$blogid = $_POST['blogid'];
		
			$qrychk="SELECT b.id,b.title,b.date,DATE_FORMAT(STR_TO_DATE(b.date,'%d/%m/%Y'),'%d %b, %a') AS bdate,b.tags,b.authorname,b.description ,b.shortdescription,
					 IFNULL((SELECT CONCAT(:imgpath, bi.image) AS img FROM `tblblogimage` bi WHERE bi.blogid = b.id ORDER BY bi.displayorder,bi.timestamp LIMIT 1),CONCAT(:imgpath, 'images/blog/d_blog.jpg')) AS img,b.shortlink
					 FROM `tblblogmaster` b 
					 WHERE b.isactive = :isactive";
		
			$parms = array(
				':isactive'=>1,
				':imgpath'=>$imgpath
			);
		if($blogid)
		{
			$qrychk.=" AND b.shortlink = :blogid ";
			$parms[':blogid']=$blogid; 
		}
		
		
		
		$result_ary=$DB->getmenual($qrychk,$parms);

		

		if(sizeof($result_ary)>0)
		{
			$response['result'] = $result_ary;
			if($blogid)
			{
				$bid=$result_ary[0]['id'];

				$subqry1 ="SELECT id,blogid, CONCAT('$imgpath', image) as image FROM `tblblogimage` WHERE blogid = :id";
				$subparms1  = array(
					':id'=>$bid,
				);
				$blogimg = $DB->getmenual($subqry1 ,$subparms1);
				if($blogimg)
				{
					$response['blogimg'] = $blogimg;
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
	}/* else if($action == 'listrelatedblog')
	{
		$id=$_POST['id'];
		$qry="SELECT id,categoryid FROM tblblog WHERE shortlink=:id";
		$prms=array(':id'=>$id);
		$result=$DB->getmenual($qry,$prms);
		if(sizeof($result)>0)
		{
			$qrychk="SELECT b.id,b.tagname,b.blogdate,b.title,b.description ,b.shortdescr,category,categoryid,DATE_FORMAT(STR_TO_DATE(b.blogdate,'%d/%m/%Y'),'%d %b, %a') AS bdate,b.ishighlight,b.isslide,
						IFNULL((SELECT CONCAT(:imgpath, bi.image) AS img FROM `tblblogimage` bi WHERE bi.blogid = b.id ORDER BY bi.displayorder LIMIT 1),CONCAT(:imgpath, 'images/blog/d_blog.png')) AS img,b.bloguniqueid,b.shortlink
						FROM `tblblog` b 
						WHERE b.isactive = :isactive AND b.categoryid = :categoryid AND b.id!=:id";
			$categoryid=$result[0]['categoryid'];
			$parms = array(
				':isactive'=>1,
				':imgpath'=>$imgpath,
				':categoryid'=>$categoryid,
				':id'=>$result[0]['id']
			);

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
	} */
}	

require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  