<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/myaccount.php';

if($isvalidUser['status'] == 1)
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	

	//List Patient Information
	if($action == 'listpatientinformation')
	{
		

		$patientid=$uid;

		$isactivepackage=$IISMethods->sanitize($_POST['isactivepackage']);

		$listpatientinformation=new listpatientinformation();

		 $qry = "SELECT IFNULL(tpi.id,'') AS id,IFNULL(tpi.patientid,'') AS patientid,IFNULL(tpi.foodtype,'') AS foodtype,IFNULL(tpi.foodtype_comment,'') AS foodtype_comment,IFNULL(tpi.gymtime,'') AS gymtime,IFNULL(tpi.gymtime_comment,'') AS gymtime_comment,IFNULL(tpi.sleep,'') AS sleep,IFNULL(tpi.sleep_comment,'') AS sleep_comment,IFNULL(tpi.teacoffee,'') AS teacoffee,IFNULL(tpi.teacoffee_comment,'') AS teacoffee_comment,IFNULL(tpi.medication,'') AS medication,IFNULL(tpi.medication_comment,'') AS medication_comment,
			IFNULL(tpi.breakfast,'') AS breakfast,IFNULL(tpi.breakfast_comment,'') AS breakfast_comment,IFNULL(tpi.lunch,'') AS lunch,IFNULL(tpi.lunch_comment,'') AS lunch_comment,IFNULL(tpi.snacks,'') AS snacks,IFNULL(tpi.snacks_comment,'') AS snacks_comment,IFNULL(tpi.dinner,'') AS dinner,IFNULL(tpi.dinner_comment,'') AS dinner_comment,
			IFNULL(tpi.height,'') AS height,IFNULL(tpi.height_comment,'') AS height_comment,IFNULL(tpi.weight,'') AS `weight`,IFNULL(tpi.weight_comment,'') AS weight_comment,IFNULL(tpi.fat,'') AS fat,IFNULL(tpi.fat_comment,'') AS fat_comment,IFNULL(tpi.mmass,'') AS mmass,IFNULL(tpi.mmass_comment,'') AS mmass_comment,IFNULL(tpi.bage,'') AS bage,IFNULL(tpi.bage_comment,'') AS bage_comment,IFNULL(tpi.bmr,'') AS bmr,IFNULL(tpi.bmr_comment,'') AS bmr_comment,IFNULL(tpi.bmi,'') AS bmi,IFNULL(tpi.bmi_comment,'') AS bmi_comment,
			IFNULL(tpi.date,'') AS `date`, CONCAT('".$config->getWeburl()."generatepdf/dietplanprint?pid=', tpi.id) as pdfurl,
			IFNULL((SELECT CASE WHEN(id != '')THEN 1 ELSE 0 END chk FROM `tblpatientdietplan` WHERE `patientid` = tpi.patientid AND `patientdetailid` = tpi.id),
			IFNULL((SELECT CASE WHEN(id != '')THEN 1 ELSE 0 END chk  FROM `tblpatientwaterglass` WHERE `patientid` = tpi.patientid AND `patientdetailid` = tpi.id),
			IFNULL((SELECT CASE WHEN(id != '')THEN 1 ELSE 0 END chk FROM `tblpatientworkoutplan` WHERE `patientid` = tpi.patientid AND `patientdetailid` = tpi.id),0))) as ispdfdownload
			FROM `tblpatientinformation` tpi 
			WHERE tpi.patientid=:patientid ";
		$parms = array(
			':patientid'=>$patientid,
		);

		$qry.=" ORDER BY tpi.timestamp DESC LIMIT $start, $per_page";
		$listpatientinformation=$DB->getmenual($qry,$parms,'listpatientinformation');

		if(sizeof($listpatientinformation) > 0)
		{
			$response['data']=$listpatientinformation;

			$response['nextpage']=$nextpage;
			if(sizeof($result_ary)==$per_page){ 
				$showdata=1; 
			}else{ 
				$showdata=0;  
			}
			$response['loadmore']=$showdata;


			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	//List Package History
	else if($action == 'packagehistory')
	{
		if($platform == 1)
		{
			$patientid = $IISMethods->sanitize($_POST['patientid']);
		}
		else
		{
			$patientid=$uid;
		}
		
		$isactivepackage=$IISMethods->sanitize($_POST['isactivepackage']);

		$packagehistoryinfo=new packagehistoryinfo();

		$qry = "SELECT DISTINCT pa.id,pa.transactionid,pa.orderno,pa.patientid,pa.packageid,pa.packagename,pa.description AS packagedescr,
			CASE WHEN (IFNULL(p.packageimg,'')<>'') THEN CONCAT(:baseimgurl,p.packageimg) ELSE :defaultimgurl END AS packageimg,
			pa.sessiontype,CASE WHEN (IFNULL(pa.sessiontype,0)=2) THEN 'Unlimited Session' ELSE CONCAT(pa.noofsession,' Session') END AS strsessiontype,
			pa.noofsession,CASE WHEN (IFNULL(pa.duration,0)>0) THEN CONCAT(pa.duration,' Months Validity') ELSE '' END AS strduration,  
			pa.duration,pa.price,pa.discount,pa.finalprice,pa.taxid,pa.tax,pa.codeid,pa.code,pa.disctype,pa.discper,pa.discamt,pa.totalpaid,DATE_FORMAT(pa.orderdate,'%d/%m/%Y %h:%i %p') AS orderdate,
			CASE WHEN (STR_TO_DATE(pa.expirydate,'%d/%m/%Y') >= :cdate) THEN 'Active' ELSE 'Expired' END AS packagestatus,
			CASE WHEN (STR_TO_DATE(pa.expirydate,'%d/%m/%Y') >= :cdate) THEN CONCAT('Expires On ',DATE_FORMAT(STR_TO_DATE(pa.expirydate,'%d/%m/%Y'),'%d %M %Y')) ELSE CONCAT('Expired On ',DATE_FORMAT(STR_TO_DATE(pa.expirydate,'%d/%m/%Y'),'%d %M %Y')) END AS strpackagestatus,
			CASE WHEN (STR_TO_DATE(pa.expirydate,'%d/%m/%Y') >= :cdate) THEN '#26A65B' ELSE '#F15949' END AS packagestatuscolor 
			FROM `tblpackageassign` pa 
			INNER JOIN tblpackagemaster p ON p.id=pa.packageid
			WHERE pa.status=1 AND pa.iscancel=0 AND pa.patientid=:patientid ";
		$parms = array(
			':patientid'=>$patientid, 
			':baseimgurl'=>$config->getImageurl(),
			':defaultimgurl'=>$config->getDefaultPackageImageurl(),
			':cdate'=>$IISMethods->getformatcurrdate(), 
		);

		if($isactivepackage == 1)  //When Only Active Packages
		{
			$qry.=" AND :cdate BETWEEN DATE_FORMAT(pa.orderdate,'%Y-%m-%d') AND STR_TO_DATE(pa.expirydate,'%d/%m/%Y') ";
			//$parms[':cdate']=$IISMethods->getformatcurrdate();
		}

		if($platform == 1)
		{
			$qry.=" ORDER BY pa.timestamp DESC";
		}
		else
		{
			$qry.=" ORDER BY pa.timestamp DESC LIMIT $start, $per_page";
		}
		
		$packagehistoryinfo=$DB->getmenual($qry,$parms,'packagehistoryinfo');

		if(sizeof($packagehistoryinfo) > 0)
		{
			$response['data']=$packagehistoryinfo;

			$response['nextpage']=$nextpage;
			if(sizeof($result_ary)==$per_page){ 
				$showdata=1; 
			}else{ 
				$showdata=0;  
			}
			$response['loadmore']=$showdata;


			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nopackagefound'];
		}
	}
	// List My Profile Data
	else if($action == 'myprofiledata')
	{
		$qryuser = "SELECT DISTINCT IFNULL(pm.id,'') AS id,IFNULL(pm.personname,'') AS personname,IFNULL(pm.contact,'') AS mobilenumber1,IFNULL(pm.mobilenumber2,'') AS mobilenumber2,IFNULL(pm.email,'') AS email,
			IFNULL(pm.age,0) AS age,IFNULL(pm.address,'') AS `address`,IFNULL(pm.stateid,'') AS stateid,IFNULL(pm.statename,'') AS statename,IFNULL(pm.cityid,'') AS cityid,IFNULL(pm.cityname,'') AS cityname,IFNULL(pm.profileimg,'') AS profileimg
			FROM tblpersonmaster pm 
			WHERE pm.id=:uid AND IFNULL(pm.isdelete,0)=0";		 
		$parms = array(
			':uid'=>$uid,
		);
		$result_ary=$DB->getmenual($qryuser,$parms);

		if(sizeof($result_ary)>0)
		{
			$row=$result_ary[0];
			$response['id']=$IISMethods->sanitize($row['id']);
			$response['personname']=$IISMethods->sanitize($row['personname']);
			$response['mobilenumber1']=$IISMethods->sanitize($row['mobilenumber1']);
			$response['mobilenumber2']=$IISMethods->sanitize($row['mobilenumber2']);
			$response['email']=$IISMethods->sanitize($row['email']);
			$response['age']=$IISMethods->sanitize($row['age']);
			$response['address']=$IISMethods->sanitize($row['address']);
			$response['stateid']=$IISMethods->sanitize($row['stateid']);
			$response['statename']=$IISMethods->sanitize($row['statename']);
			$response['cityid']=$IISMethods->sanitize($row['cityid']);
			$response['cityname']=$IISMethods->sanitize($row['cityname']);

			$profileimgurl=$config->getDefaultProfileImageurl();
			if($row['profileimg'])
			{
				$profileimgurl=$config->getImageurl().$row['profileimg'];
			}
			$response['profileimg'] = $profileimgurl;

			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
		
	}
	//Update Profile Data
	else if($action == 'updateprofiledata')
	{
		$name = $IISMethods->sanitize($_POST['name']);
		$mobilenumber2 = $IISMethods->sanitize($_POST['mobilenumber2']);
		$age = $IISMethods->sanitize($_POST['age']);
		$address = $IISMethods->sanitize($_POST['address']);
		$stateid = $IISMethods->sanitize($_POST['stateid']);
		$cityid = $IISMethods->sanitize($_POST['cityid']);
		$profileimg =$_FILES['profileimg']['name'];

		$datetime=$IISMethods->getdatetime();
			
		if($name && $age && $address)
		{
			$qtyname="SELECT 
				IFNULL((select state from tblstatemaster where id=:stateid),'') as state,
				IFNULL((select city from tblcitymaster where id=:cityid),'') as city,
				IFNULL((SELECT IFNULL(profileimg,'') AS profileimg FROM `tblpersonmaster` WHERE id=:uid),'') as profileimg";
			$parms = array(
				':stateid'=>$stateid,
				':cityid'=>$cityid,
				':uid'=>$uid,
			);
			$result_name=$DB->getmenual($qtyname,$parms);
			$rowsci=$result_name[0];

			if($profileimg)
			{
				$sourcePath = $_FILES['profileimg']['tmp_name'];
				$targetPath = $IISMethods->uploadallfiles(1,'profile',$profileimg,$sourcePath,$uid);
			}
			else
			{
				$targetPath = $rowsci['profileimg'];
			}

			$updqry=array(					
				'personname'=>$name,
				'mobilenumber2'=>$mobilenumber2,
				'age'=>$age,
				'address'=>$address,
				'stateid'=>$stateid,
				'statename'=>$rowsci['state'],					
				'cityid'=>$cityid,
				'cityname'=>$rowsci['city'],
				'profileimg'=>$targetPath,
				'update_uid'=>$uid,
				'update_date'=>$datetime,
			);
			$extraparams=array(
				'id'=>$uid
			);
			$DB->executedata('u','tblpersonmaster',$updqry,$extraparams);


			$qryuser = "SELECT DISTINCT IFNULL(pm.id,'') AS id,IFNULL(pm.personname,'') AS personname,IFNULL(pm.contact,'') AS mobilenumber1,IFNULL(pm.mobilenumber2,'') AS mobilenumber2,IFNULL(pm.email,'') AS email,
				IFNULL(pm.age,0) AS age,IFNULL(pm.address,'') AS `address`,IFNULL(pm.stateid,'') AS stateid,IFNULL(pm.statename,'') AS statename,IFNULL(pm.cityid,'') AS cityid,IFNULL(pm.cityname,'') AS cityname,IFNULL(pm.profileimg,'') AS profileimg
				FROM tblpersonmaster pm 
				WHERE pm.id=:uid AND IFNULL(pm.isdelete,0)=0";		 
			$parms = array(
				':uid'=>$uid,
			);
			$result_ary=$DB->getmenual($qryuser,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['personname']=$IISMethods->sanitize($row['personname']);
				$response['mobilenumber1']=$IISMethods->sanitize($row['mobilenumber1']);
				$response['mobilenumber2']=$IISMethods->sanitize($row['mobilenumber2']);
				$response['email']=$IISMethods->sanitize($row['email']);
				$response['age']=$IISMethods->sanitize($row['age']);
				$response['address']=$IISMethods->sanitize($row['address']);
				$response['stateid']=$IISMethods->sanitize($row['stateid']);
				$response['statename']=$IISMethods->sanitize($row['statename']);
				$response['cityid']=$IISMethods->sanitize($row['cityid']);
				$response['cityname']=$IISMethods->sanitize($row['cityname']);

				$profileimgurl=$config->getDefaultProfileImageurl();
				if($row['profileimg'])
				{
					$profileimgurl=$config->getImageurl().$row['profileimg'];
				}
				$response['profileimg'] = $profileimgurl;

			}

			$status=1;
			$message=$errmsg['profile-update'];

		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	//List Home Calories Figures
	else if($action=='listcaloryfigures')   
	{
		$date=$IISMethods->sanitize($_POST['date']);


		//Insert Patient Daily Diet
		//$DB->insertpatientdailyplan(1,$uid,$date);

		//Insert Patient Daily Workout
		//$DB->insertpatientdailyplan(2,$uid,$date);

		//Insert Patient Daily Water Glass
		$DB->insertpatientdailyplan(3,$uid,$date);


		$qry="SELECT 
			ROUND(IFNULL((SELECT SUM(dp.calories) FROM tblpatientdailydietplan dp WHERE dp.patientid=:uid AND STR_TO_DATE(dp.date,'%d/%m/%Y')=STR_TO_DATE(:date,'%d/%m/%Y') AND IFNULL(dp.isextrafood,0)=0),0)) AS goal_calories,
			ROUND(IFNULL((SELECT SUM(dp.calories) FROM tblpatientdailydietplan dp WHERE dp.patientid=:uid AND STR_TO_DATE(dp.date,'%d/%m/%Y')=STR_TO_DATE(:date,'%d/%m/%Y') AND IFNULL(dp.isextrafood,0)=0 AND IFNULL(dp.iscomplete,0)=1),0)) AS consume_calories,
			IFNULL((SELECT SUM(dp.qty) FROM tblpatientdailywaterglass dp WHERE dp.patientid=:uid AND STR_TO_DATE(dp.date,'%d/%m/%Y')=STR_TO_DATE(:date,'%d/%m/%Y') AND IFNULL(dp.isextraglass,0)=0),0) AS goal_waterglass,
			IFNULL((SELECT SUM(dp.qty) FROM tblpatientdailywaterglass dp WHERE dp.patientid=:uid AND STR_TO_DATE(dp.date,'%d/%m/%Y')=STR_TO_DATE(:date,'%d/%m/%Y') AND IFNULL(dp.isextraglass,0)=0 AND IFNULL(dp.iscomplete,0)=1),0) AS consume_waterglass";
		$parms = array(
			':uid'=>$uid,
			':date'=>$date,
		);
		$result_ary=$DB->getmenual($qry,$parms);
		$row=$result_ary[0];

		$response['goal_calories'] = $row['goal_calories'];
		$response['consume_calories'] = $row['consume_calories'];
		$response['goal_waterglass'] = $row['goal_waterglass'];
		$response['consume_waterglass'] = $row['consume_waterglass'];

		$status=1;
		$message=$errmsg['success'];
	}



}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  