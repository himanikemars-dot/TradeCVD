<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/state.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertstate')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$countryid=$IISMethods->sanitize($_POST['countryid']);
		$state=$IISMethods->sanitize($_POST['state'],'OUT');
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($countryid && $state)
		{			
			$insqry=array(					
				'countryid'=>$countryid,					
				'state'=>$state,					
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT state from tblstatemaster where state=:state AND countryid=:countryid";
				$parms = array(
					':state'=>$state,
					':countryid'=>$countryid
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

					$DB->executedata('i','tblstatemaster',$insqry,'');

					$status=1;
					$message=$errmsg['insert'];
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT state from tblstatemaster where state=:state AND countryid=:countryid AND id<>:id";
				$parms = array(
					':state'=>$state,
					':id'=>$id,
					':countryid'=>$countryid
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
					$DB->executedata('u','tblstatemaster',$insqry,$extraparams);

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
	else if($action=='deletestatemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="SELECT case when(pm.contact !='' or cm.city != '') then 1 else 0 end as tem
			from tblstatemaster sm
			left join tblcitymaster cm on cm.stateid = sm.id
			left join tblpersonmaster pm on (pm.stateid = sm.id OR pm.p_stateid = sm.id) and pm.isdelete = 0 
			where sm.id=:id";
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
				$DB->executedata('d','tblstatemaster','',$extraparams);
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
				$qrychk="SELECT case when(pm.contact !='' or cm.city != '') then 1 else 0 end as tem,sm.state
				from tblstatemaster sm
				left join tblcitymaster cm on cm.stateid = sm.id
				left join tblpersonmaster pm on (pm.stateid = sm.id OR pm.p_stateid = sm.id) and pm.isdelete = 0 
				where sm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					$usemenu.=$row['state'].",";
				}
				else
				{
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblstatemaster','',$extraparams);
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
	else if($action=='editstatemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT id,countryid,state from tblstatemaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['countryid']=$IISMethods->sanitize($row['countryid']);
				$response['state']=$IISMethods->sanitize($row['state'],'OUT');

			}
			$status=1;
			$message=$errmsg['datafound'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='liststatemaster')   
	{
		$states=new state();
		$qry="SELECT sm.timestamp as primary_date,sm.id,sm.state,cm.country 
			from tblstatemaster sm 
			left join tblcountrymaster cm on cm.id=sm.countryid 
			where cm.country like :filter or sm.state like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$states=$DB->getmenual($qry,$parms,'state');
		$response['states']=$states;
		
		if($responsetype=='HTML')
		{
			if($states)
			{
				$i=0;
				foreach($states as $state)
				{
					$id="'".$state->id."'";
					$htmldata.='<tr data-index="'.$state->id.'">';
			
					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if(((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if(((($rightstotalcount)>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
					// $htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
					
					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$state->id.'" value="'.$IISMethods->sanitize($state->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$state->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($state->country).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($state->state).'</td>';
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($states)<=0)
				{
					$htmldata.=file_get_contents($config-> getNoDataFound());
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($states);
		}

		$common_listdata=$states;
	}    
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';    

?>

  