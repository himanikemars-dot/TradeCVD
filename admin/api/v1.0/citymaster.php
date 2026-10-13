<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/city.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertcity')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$city=$IISMethods->sanitize($_POST['city'],'OUT');
		$stateid=$IISMethods->sanitize($_POST['stateid']);
		$countryid=$IISMethods->sanitize($_POST['countryid']);
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($city && $stateid && $countryid)
		{			
			$insqry=array(					
				'city'=>$city,
				'stateid'=>$stateid,
				'countryid'=>$countryid,								
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT city from tblcitymaster where city=:city AND stateid=:stateid AND countryid=:countryid";
				$parms = array(
					':city'=>$city,
					':stateid'=>$stateid,
					':countryid'=>$countryid,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$unqid = $IISMethods->generateuuid();
					$insqry['id']=$unqid;	
					$insqry['timestamp']=$IISMethods->getdatetime();
					$insqry['entry_uid']=$uid;	
					$insqry['entry_date']=$datetime;

					$DB->executedata('i','tblcitymaster',$insqry,'');

					$status=1;
					$message=$errmsg['insert'];
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT city from tblcitymaster where city=:city AND stateid=:stateid AND countryid=:countryid and id<>:id";
				$parms = array(
					':city'=>$city,
					':id'=>$id,
					':stateid'=>$stateid,
					':countryid'=>$countryid,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$insqry['update_uid']=$uid;	
					$insqry['update_date']=$datetime;

					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('u','tblcitymaster',$insqry,$extraparams);

					$status=1;
					$message=$errmsg['update'];
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletecitymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT case when(pm.id !='') then 1 else 0 end as tem
			from tblcitymaster cm
			left join tblpersonmaster pm on pm.cityid = cm.id AND IFNULL(pm.isdelete,0) = 0 
			where cm.id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			$row=$result_ary[0];


			if($row['tem'] > 0)
			{
				$status=0;
				$message=$errmsg['inuse'];
			}
			else
			{
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblcitymaster','',$extraparams);
				$status=1;
				$message=$errmsg['delete'];
			}
			
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];

				$qrychk="SELECT case when(pm.id !='') then 1 else 0 end as tem,cm.city
				from tblcitymaster cm
				left join tblpersonmaster pm on pm.cityid = cm.id AND IFNULL(pm.isdelete,0) = 0 
				where cm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					$usemenu.=$row['city'].",";
				}
				else
				{
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblcitymaster','',$extraparams);
				}
			
			}
			$status=1;
			$message=$errmsg['delete'].' '.$usemenu;
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='editcitymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,city,stateid,countryid from tblcitymaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['city']=$IISMethods->sanitize($row['city'],'OUT');
				$response['stateid']=$IISMethods->sanitize($row['stateid']);
				$response['countryid']=$IISMethods->sanitize($row['countryid']);

			}
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listcitymaster')   
	{
		$citys=new city();
		$qry="select cm.timestamp as primary_date,cm.id,cm.city,cm.stateid,sm.state,tcm.country from tblcitymaster cm 
		inner join tblstatemaster sm on sm.id=cm.stateid 
		inner join tblcountrymaster tcm on tcm.id=cm.countryid 
		where cm.city like :filter OR sm.state like :filter OR tcm.country like :filter  order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$citys=$DB->getmenual($qry,$parms,'city');
		
		if($responsetype=='HTML')
		{
			if($citys)
			{
				$i=0;
				foreach($citys as $city)
				{
					$id="'".$city->id."'";
					$htmldata.='<tr data-index="'.$city->id.'">';

					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if((($rightstotalcount>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if((($rightstotalcount>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}

					// $htmldata.='<td class="tbl-grid">';
					// $htmldata.='<div class="dropdown table-dropdown">';
					// $htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
					// $htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';
					// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
					// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
					// $htmldata.='</div>';
					// $htmldata.='</div>';
					// $htmldata.='</td>';
					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$city->id.'" value="'.$IISMethods->sanitize($city->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$city->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($city->city).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($city->state).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($city->country).'</td>';
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				$htmldata.=file_get_contents($config-> getNoDataFound());
				$message=$errmsg['nodatafound'];
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($citys);
		}

		$common_listdata=$citys;
	}    
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  