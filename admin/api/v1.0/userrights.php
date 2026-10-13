<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='fillusertype')   
	{
		$aminutype=$config->getAdminutype();
		$qry="select * from tblusertypemaster where id<>:id AND hasweblogin=1";
		$parms = array(
			':id'=>$aminutype,
		);
		
		$qry.=" order by timestamp asc ";
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];
				$htmldata.='<option value="'.$row['id'].'">'.$row['usertype'].'</option>';
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillperson')   
	{
		$usertypeid=$_POST['usertypeid'];

		$qry="SELECT DISTINCT pm.id,pm.personname
			FROM tblpersonmaster pm 
			INNER JOIN tblpersonutype pu ON pu.pid=pm.id 
			WHERE IFNULL(pm.isdelete,0)=0 AND pu.utypeid=:usertypeid AND pm.isactive=1";
		$parms = array(
			':usertypeid'=>$usertypeid,
		);
		$result_ary=$DB->getmenual($qry,$parms);
		
		$htmldata='';
		
		if($responsetype=='HTML')
		{
			if(sizeof($result_ary)>0)
			{
				$htmldata.='<option value="0">All </option>';
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					$htmldata.='<option value="'.$row['id'].'">'.$row['personname'].'</option>';
				}		
			}

			$response['data']=$htmldata;
		}

		$status=1;
		$message=$errmsg['success'];
	} 
	else if($action=='filluserrighttable')   
	{
		$personid = $_POST['personid'];
		$usertypeid =$_POST['usertypeid'];


		if($personid === '0')
		{
			$personid = '';
		}

		$subqry = "  AND usertypeid IN ('".$usertypeid."') AND personid ='".$personid."'";
		if($personid!='')
		{
			$subqry = " AND  personid IN ('".$personid."')";
			
		}

		$qry="select * from tblmenuassign where (isindividual = 1 OR isparent = 0 OR menuname like 'Reports') AND menutypeid = 1 AND containright=1 order by timestamp asc";
		$result_ary=$DB->getmenual($qry);

		if(sizeof($result_ary)>0)
		{
			$htmldata='';
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$rowcat=$result_ary[$i];

				$qry="select * from tbluserrights where formname='".$rowcat['alias']."'  $subqry";

				//echo ' ******* ';
				//echo $qry;
				//echo ' ******* ';
				$seluser=$DB->getmenual($qry);

				$rowuser = $seluser[0];

				//echo 'All : '.$rowuser['allviewright'];

				$allviewright="";
				$selfviewright="";
				$alladdright="";
				$selfaddright="";
				$alleditright="";
				$selfeditright="";
				$alldelright="";
				$selfdelright="";
				$allprintright="";
				$selfprintright="";
				$allreqright="";
				$allchangepriceright="";

				if($rowuser['allviewright']==1)
				{
					$allviewright="checked";
				}
				else if($rowuser['selfviewright']==1)
				{
					$selfviewright="checked";
				}
				if($rowuser['alladdright']==1)
				{
					$alladdright="checked";
				}
				else if($rowuser['selfaddright']==1)
				{
					$selfaddright="checked";
				}
				if($rowuser['alleditright']==1)
				{
					$alleditright="checked";
				}
				else if($rowuser['selfeditright']==1)
				{
					$selfeditright="checked";
				}
				if($rowuser['alldelright']==1)
				{
					$alldelright="checked";
				}
				else if($rowuser['selfdelright']==1)
				{
					$selfdelright="checked";
				}
				if($rowuser['allprintright']==1)
				{
					$allprintright="checked";
				}
				else if($rowuser['selfprintright']==1)
				{
					$selfprintright="checked";
				}
				if($rowuser['requestright']==1)
				{
					$allreqright="checked";
				}
				if($rowuser['changepriceright']==1){
					$allchangepriceright="checked";
				}


				$htmldata.='<tr>';
				$htmldata.='<td class="tbl-name tdpagename">'.$rowcat['textname'].'';
				$htmldata.='<input type="hidden" name="'.$i.'formtype" id="'.$i.'formtype" VALUE="'.$rowcat['textname'].'" />';
				$htmldata.='<input type="hidden" name="'.$i.'formurl" id="'.$i.'formurl" VALUE="'.$rowcat['alias'].'" />';
				$htmldata.='<input type="hidden" name="'.$i.'pageid" id="'.$i.'pageid" VALUE="'.$rowcat['id'].'" />';
				$htmldata.='</td>';


				$htmldata.='<td class="tbl-name tdview">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$allviewright.' type="checkbox" class="custom-control-input d-none tdallview viewrightcls vrcls'.$i.'" value="1" name="'.$i.'allviewright" id="allviewright'.$i.'" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="allviewright'.$i.'">All</label>';
				$htmldata.='</div>';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$selfviewright.' type="checkbox" class="custom-control-input d-none tdselfview viewrightcls vrcls'.$i.'" value="1"  name="'.$i.'selfviewright" id="selfviewright'.$i.'" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="selfviewright'.$i.'">Self</label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='<td class="tbl-name tdadd">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$alladdright.' type="checkbox" class="custom-control-input d-none tdalladd addrightcls arcls'.$i.'" value="1"  id="alladdright'.$i.'" name="'.$i.'alladdright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="alladdright'.$i.'">All</label>';
				$htmldata.='</div>';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$selfaddright.' type="checkbox" class="custom-control-input d-none tdselfadd addrightcls arcls'.$i.'" value="1"  id="selfaddright'.$i.'" name="'.$i.'selfaddright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="selfaddright'.$i.'">Self</label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='<td class="tbl-name">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$alleditright.' type="checkbox" class="custom-control-input d-none tdallupdate editrightcls ercls'.$i.'" value="1"  id="alleditright'.$i.'" name="'.$i.'alleditright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="alleditright'.$i.'">All</label>';
				$htmldata.='</div>';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$selfeditright.' type="checkbox" class="custom-control-input d-none tdselfupdate editrightcls ercls'.$i.'" value="1"  id="selfeditright'.$i.'" name="'.$i.'selfeditright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="selfeditright'.$i.'">Self</label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='<td class="tbl-name">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$alldelright.' type="checkbox" class="custom-control-input d-none tdalldelete deleterightcls drcls'.$i.'" value="1"  id="alldeleteright'.$i.'" name="'.$i.'alldeleteright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="alldeleteright'.$i.'">All</label>';
				$htmldata.='</div>';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$selfdelright.' type="checkbox" class="custom-control-input d-none tdselfdelete deleterightcls drcls'.$i.'" value="1"  id="selfdeleteright'.$i.'" name="'.$i.'selfdeleteright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="selfdeleteright'.$i.'">Self</label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='<td class="tbl-name">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$allprintright.' type="checkbox" class="custom-control-input d-none tdallprint printrightcls prcls'.$i.'" value="1"  id="allprintright'.$i.'" name="'.$i.'allprintright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="allprintright'.$i.'">All</label>';
				$htmldata.='</div>';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$selfprintright.' type="checkbox" class="custom-control-input d-none tdselfprint printrightcls prcls'.$i.'" value="1"  id="selfprintright'.$i.'" name="'.$i.'selfprintright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="selfprintright'.$i.'">Self</label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='<td class="tbl-name">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$allreqright.' type="checkbox" class="custom-control-input d-none tdallreq reqrightcls prcls'.$i.'" value="1"  id="allreqright'.$i.'" name="'.$i.'allreqright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="allreqright'.$i.'"></label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='<td class="tbl-name">';
				$htmldata.='<div class="d-flex text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input '.$allchangepriceright.' type="checkbox" class="custom-control-input d-none tdallprice pricerightcls prcls'.$i.'" value="1"  id="allpriceright'.$i.'" name="'.$i.'allpriceright" data-id="'.$i.'">';
				$htmldata.='<label class="custom-control-label mb-0" for="allpriceright'.$i.'"></label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';

				$htmldata.='</tr>';
			}
			$htmldata.='<input type="hidden" name="totalmenus" id="totalmenus" value="'.sizeof($result_ary).'" />	';
			
			
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}  
	else if($action=='insertuserright')   
	{
		$usertype=$_POST['usertypeid'];
		$personid=$_POST['personid'];

		if($_POST['personid'] === '0')
		{
			$extraparams=array(
				'usertypeid'=>$usertype,
				'personid'=>''
			);
			$DB->executedata('d','tbluserrights','',$extraparams);
		}
		else 
		{
			$extraparams=array(
				'personid'=>$personid
			);
			$DB->executedata('d','tbluserrights','',$extraparams);
		}


		if($_POST['personid'] === '0')
		{
			$personid = '';
		}

		$totalmenus=$_POST['totalmenus'];

		for ($i=0 ; $i<=$totalmenus ; $i++)
		{
			$allviewright = $_POST[$i."allviewright"];
			
			$selfviewright = $_POST[$i."selfviewright"];
			$alladdright = $_POST[$i."alladdright"];
			$selfaddright = $_POST[$i."selfaddright"];
			$alleditright = $_POST[$i."alleditright"];
			$selfeditright = $_POST[$i."selfeditright"];
			$alldeleteright = $_POST[$i."alldeleteright"];
			$selfdeleteright = $_POST[$i."selfdeleteright"];
			$allprintright = $_POST[$i."allprintright"];
			$selfprintright = $_POST[$i."selfprintright"];
			$allreqright = $_POST[$i."allreqright"];
			$allchangepriceright = $_POST[$i."allpriceright"];
			
			if ($allviewright || $selfviewright || $alladdright || $selfaddright ||$alleditright ||  $selfeditright || $alldeleteright || $selfdeleteright || $allprintright || $selfprintright || $allreqright || $allchangepriceright)
			{
				$viewright=0;
				$hallviewright=0;
				$hselfviewright=0;
				$addright=0;
				$halladdright=0;
				$hselfaddright=0;
				$editright=0;
				$halleditright=0;
				$hselfeditright=0;
				$deleteright=0;
				$halldeleteright=0;
				$hselfdeleteright=0;
				$printright=0;
				$hallprintright=0;
				$hselfprintright=0;
				
				if($allviewright || $selfviewright)
				{
					$viewright=1;
					if($allviewright==1)
						$hallviewright=1;
					
					if($selfviewright==1)
						$hselfviewright=1;
				}
				if($alladdright || $selfaddright)
				{
					$addright=1;
					
					if($alladdright==1)
						$halladdright=1;
					
					if($selfaddright==1)
						$hselfaddright=1;
				}
				if($alleditright || $selfeditright)
				{
					$editright=1;
					if($alleditright==1)
						$halleditright=1;
					
					if($selfeditright==1)
						$hselfeditright=1;
				}
				if($alldeleteright || $selfdeleteright)
				{
					$deleteright=1;
					if($alldeleteright==1)
						$halldeleteright=1;
					
					if($selfdeleteright==1)
						$hselfdeleteright=1;
				}
				if($allprintright || $selfprintright)
				{
					$printright=1;
					if($allprintright==1)
						$hallprintright=1;
					
					if($selfprintright==1)
						$hselfprintright=1;
				}
				
				$hallreqright=0;
				if($allreqright==1)
				{
					$hallreqright=1;
				}
				
				
				$changepriceright=0;
				if($allchangepriceright==1)
				{
					$changepriceright=1;
				}
				
				$formname = $_POST[$i."formtype"];
				$formurl = $_POST[$i."formurl"];
				$formname = trim($formname);
				$formurl = trim($formurl);
				
				$unqid = $IISMethods->generateuuid();
				$insdata=array(
					'id'=>$unqid,
					'formname'=>$formurl,
					'formnametext'=>$formname,
					'allow'=>1,
					'viewright'=>$viewright,
					'allviewright'=>$hallviewright,
					'selfviewright'=>$hselfviewright,
					'addright'=>$addright,
					'alladdright'=>$halladdright,
					'selfaddright'=>$hselfaddright,
					'editright'=>$editright,
					'alleditright'=>$halleditright,
					'selfeditright'=>$hselfeditright,
					'delright'=>$deleteright,
					'alldelright'=>$halldeleteright,
					'selfdelright'=>$hselfdeleteright,
					'printright'=>$printright,
					'allprintright'=>$hallprintright,
					'selfprintright'=>$hselfprintright,
					'requestright'=>$hallreqright,
					'changepriceright'=>$changepriceright,
					'usertypeid'=>$usertype,
					'personid'=>$personid,
					'entry_uid'=>$uid,
					'entry_date'=>$IISMethods->getdatetime(),
				);
				$DB->executedata('i','tbluserrights',$insdata,'');
				
			}
		}
		$status=1;
		$message=$errmsg['insert'];	
	}
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';    

?>

  