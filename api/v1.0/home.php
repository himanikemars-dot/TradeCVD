<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'fillsliderdetail')
	{
		$isdatafound=0;

		$qrychk="select id,title,subtitle,btntext,sellbtn, CONCAT(:imgpath, sliderimg) AS image, CONCAT(:imgpath, tabletimg) AS tabletimage, CONCAT(:imgpath, btnimage) AS btnimg, CONCAT(:imgpath, sellbtnimg) AS sellimg, CONCAT(:imgpath, certifiedimg) AS certifiedimge, CONCAT(:imgpath, phoneimg) AS phoneimge,  CONCAT(:imgpath, toprightimge) AS toprightimg,  CONCAT(:imgpath, networkimg) AS networkimage,  CONCAT(:imgpath, priceimg) AS priceimage, CONCAT(:imgpath, secureimg) AS secureimage  from tblslider where isactive=:isactive ORDER BY displayorder";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);

		$slider=$DB->getmenual($qrychk,$parms);
		
		$response['isdata']=0;
		if($slider)
		{
			$response['isdata']=1;
			$response['data']=$slider;
			$isdatafound=1;
		}

		if($isdatafound == 1)
		{
			$status = 1;
			$message = $errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action == 'fillcustomerdetail')
	{
		$isdatafound=0;

		$qrychk="select id,title,CONCAT(:imgpath,img) AS image from tblourclient where isactive=:isactive ORDER BY displayorder";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);

		$res=$DB->getmenual($qrychk,$parms);
		
		$response['isdata']=0;
		if($res)
		{
			$response['isdata']=1;
			$response['data']=$res;
			$isdatafound=1;
		}

		if($isdatafound == 1)
		{
			$status = 1;
			$message = $errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action == 'listsavanigemsquality')
	{
		$isdatafound=0;
		$qrychk="select id,title,description,CONCAT(:imgpath,img) AS image from tblsavanigemsquality where isactive=:isactive ORDER BY displayorder";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);

		$res=$DB->getmenual($qrychk,$parms);
		
		$response['isdata']=0;
		if($res)
		{
			$response['isdata']=1;
			$response['result']=$res;
			$isdatafound=1;
		}

		if($isdatafound == 1)
		{
			$status = 1;
			$message = $errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	//Accept Cookies
	else if($action == 'insertacceptcookie')
	{
		$ipaddress=$_SERVER['REMOTE_ADDR'];
		$expiretime = $_POST['expiretime'];
		$unqid = $IISMethods->generateuuid();

		if($expiretime && $ipaddress)
		{
			$insqry=array(
				'id'=>$unqid,					
				'expiretime'=>$expiretime,	
				'ipaddress'=>$ipaddress,
				'entry_date'=>date('Y-m-d H:i:s')							
			);
			// print_r($insqry);
			$DB->executedata('i','tblusercookie',$insqry,'');
			$status=1;
			$message=$errmsg['success'];
		}
		
	}
	else if($action == 'listbannerdetail')
	{
		$bannertypeid=$IISMethods->sanitize($_POST['bannertypeid']);
		$bannerqry="SELECT id,contenttypeid,typeid,title,description,CASE WHEN(img!='') THEN CONCAT(:imgpath,img) ELSE CONCAT(:imgpath,'images/d-banner.jpg') END as image FROM `tblbannersetting` WHERE typeid=:bannertypeid";
		$bannerparams=array(
			':bannertypeid'=>$bannertypeid,
			':imgpath'=>$imgpath,
		);
		$bannerres=$DB->getmenual($bannerqry,$bannerparams);
		if($bannerres)
		{
			$response['banner']=$bannerres;
		}else{
			$response['banner'][0]['image']=$config->getImageurl().'images/d-banner.jpg';
		}
		$status=1;
		$message=$errmsg['success'];

	}
	else if($action == 'listjewelrysuitsdetail')
	{
		$isdatafound=0;
		$qrychk="select id,title,CONCAT(:imgpath,img) AS image from tbljewelrysuits where isactive=:isactive ORDER BY displayorder";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);

		$res=$DB->getmenual($qrychk,$parms);
		
		$response['isdata']=0;
		if($res)
		{
			$response['isdata']=1;
			$response['result']=$res;
			$isdatafound=1;
		}

		if($isdatafound == 1)
		{
			$status = 1;
			$message = $errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action == 'listpaymentmodedetail')
	{
		$isdatafound=0;
		$qrychk="select id,title,CONCAT(:imgpath,img) AS image from tblpaymentmodemaster where isactive=:isactive ORDER BY displayorder";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);

		$res=$DB->getmenual($qrychk,$parms);
		
		$response['isdata']=0;
		if($res)
		{
			$response['isdata']=1;
			$response['result']=$res;

			$cqry="SELECT IFNULL(description,'') AS descr FROM tblcontentsetting WHERE typeid=:typeid";
			$cparams=array(':typeid'=>22);
			$cres=$DB->getmenual($cqry,$cparams);
			$crow=$cres[0];
			$response['descr']=$crow['descr'];
			$isdatafound=1;
		}

		if($isdatafound == 1)
		{
			$status = 1;
			$message = $errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	else if($action=='listdashboardcountdata')
	{
		$CheckUserRights=$DB->checkpackagewiseuserright($uid);
		$response['IsPackageExpire']=$CheckUserRights['IsPackageExpire'];
		if($CheckUserRights['IsPackageExpire']==1){
			$message = $config->getPackageExpiredMessage();
			$ExpiryTitle = $config->getPackageExpiredTitle();
			$ExpiryURL = $config->getPackageExpiredURL();
			$response['ExpiryTitle']=$ExpiryTitle;
			$response['ExpiryURL']=$ExpiryURL;
		}else{ 
			$datetime = $IISMethods->getdatetime();
			$isdatafound=0;
			$qrychk="SELECT
			IFNULL((SELECT COUNT(dl.id) FROM `diamondlist` dl WHERE dl.personid=:personid1 AND dl.isactive=1),0) AS totaldiamond,
			IFNULL((SELECT COUNT(jl.id) FROM `jewellerylist` jl WHERE jl.personid=:personid2 AND jl.isactive=1),0) AS totaljewellery,
			IFNULL((SELECT COUNT(bl.id) FROM `buyrequestlist` bl WHERE bl.personid=:personid3 AND bl.isactive=1),0) AS totalbuyrequestlist";
			$parms = array(
				':personid1'=>$uid,
				':personid2'=>$uid,
				':personid3'=>$uid,
			);

			$res=$DB->getmenual($qrychk,$parms);
			$row=$res[0];

			$response['totaldiamond']=$row['totaldiamond'];
			$response['totaljewellery']=$row['totaljewellery'];
			$response['totalbuyrequestlist']=$row['totalbuyrequestlist'];


			$qry_chat="SELECT IFNULL(SUM(tmp1.unreadmsg),0) AS unreadmsg FROM (SELECT tmp.*,DATE_FORMAT(tmp.lastseen,'%d/%m/%Y %h:%i %p') as lseen,IFNULL((
				SELECT COUNT(DISTINCT id) AS unreadmsg FROM `tblchatmessage` 
				WHERE groupid = tmp.`groupid` AND entry_date > tmp.lastseen AND (uid=personid)
			),0) AS unreadmsg  
					FROM (SELECT DISTINCT pm.id as personid,
					IFNULL((SELECT MAX(entry_date) FROM `tblchathistory` WHERE `groupid`= cg.`id` AND uid=:uid),:currdatetime) AS lastseen,IFNULL(cg.id,'') AS groupid
					FROM tblpersonmaster pm
					INNER JOIN tblchatgroup cg ON pm.id=cg.uid AND cg.personid=:uid
					INNER JOIN tblchatmessage cm ON cm.`groupid`=cg.id AND cm.uid=pm.id AND cm.sendpersonid=:uid
					WHERE  pm.isactive=1  AND pm.id!=:uid  GROUP BY pm.id ) AS tmp) AS tmp1";
			$parms_chat = array(
				':uid'=>$uid,
				':currdatetime'=>$datetime,
				
			);
			$res_chat=$DB->getmenual($qry_chat,$parms_chat);
			$rowchat=$res_chat[0];
			$response['totalunreadchatlist']=$rowchat['unreadmsg'];

			$typeid=$IISMethods->sanitize($_POST['typeid']);
			
			$bannerqry="SELECT id,typeid,CASE WHEN(img!='') THEN CONCAT(:imgpath,img) ELSE CONCAT(:imgpath,'images/d-banner.jpg') END AS image FROM `tblbannersetting` where typeid=:typeid";
			$bannerparams=array(
				':typeid'=>$typeid,
				':imgpath'=>$imgpath,
			);

			// echo $bannerqry;
			// print_r($bannerparams);
			$bannerres=$DB->getmenual($bannerqry,$bannerparams);
			$rowchat=$bannerres[0];
			$response['image']=$rowchat['image'];
			// if($bannerres)
			// {
			// 	$response['isdata']=1;
			// 	$response['result']=$bannerres;
			// 	$isdatafound=1;
			// }
			// $response['image']=$bannerres;
			// $response['banner'][0]['image']=$bannerres;
			

			// print_r($bannerres);
			// if($bannerres)
			// {
			// 	$response['banner']=$bannerres;
			// }else{
			// 	$response['banner'][0]['image']=$config->getImageurl().'images/d-banner.jpg';
			// }
			
			// if($bannerres)
			// {
			// 	$response['banner']=$bannerres;
			// }else{
			// 	$response['banner'][0]['image']=$config->getImageurl().'images/d-banner.jpg';
			// }

			// print_r($parms);
			$status = 1;
			$message = $errmsg['success'];
		}	
	}
	else if($action=='checkuserpackageexpiry'){

		
		if($LoginInfo->getAdlogin()!='' && $LoginInfo->getIsguestuser()==0)
		{
			$CheckUserRights=$DB->checkpackagewiseuserright($uid);
			$response['IsSessionExpire']=0;
			$response['IsPackageExpire']=$CheckUserRights['IsPackageExpire'];
			if($CheckUserRights['IsPackageExpire']==1){
				$message = $config->getPackageExpiredMessage();
				$ExpiryTitle = $config->getPackageExpiredTitle();
				$ExpiryURL = $config->getPackageExpiredURL();
				$response['ExpiryTitle']=$ExpiryTitle;
				$response['ExpiryURL']=$ExpiryURL;
			}
			else{
				$message = $errmsg['success'];
			}
			
		}
		else
		{
			$message = $errmsg['sessiontimeout'];
			$ExpiryTitle = $errmsg['sessiontimeout'];
			$ExpiryURL = $config->getWeburl().'login';
			$response['ExpiryTitle']=$ExpiryTitle;
			$response['ExpiryURL']=$ExpiryURL;
			$response['IsPackageExpire']=0;	
			$response['IsSessionExpire']=1;	
		}	
		$status = 1;
		// $message = $errmsg['success'];
	}
}

require_once dirname(__DIR__, 2).'/config/apifoot.php';   

?>

  