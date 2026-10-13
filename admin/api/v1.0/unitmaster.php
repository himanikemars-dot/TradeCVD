<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/unit.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertunit')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$_POST['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($name)
		{			
			$insqry=array(
				'name'=>$name,		
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT name from tblunitmaster where name=:name";
				$parms = array(
					':name'=>$name,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					try 
					{
						$unqid = $IISMethods->generateuuid();
						$insqry['id']=$unqid;	
						$insqry['isactive']=1;
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblunitmaster',$insqry,'');

						$status=1;
						$message=$errmsg['insert'];
					}
					catch (Exception $e) 
					{
						$DB->rollbacktransaction($e);
						$status=0;
						$message=$errmsg['dbtransactionerror'];
					}
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT name from tblunitmaster where name=:name AND id<>:id";
				$parms = array(
					':name'=>$name,
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					try 
					{
						$unqid = $id;
						$insqry['update_uid']=$uid;	
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblunitmaster',$insqry,$extraparams);

						$status=1;
						$message=$errmsg['update'];
					}
					catch (Exception $e) 
					{
						$DB->rollbacktransaction($e);
						$status=0;
						$message=$errmsg['dbtransactionerror'];
					}
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deleteunitmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="SELECT case when(am.id<>'') then 1 else 0 end as tem,agm.name
				from tblunitmaster agm
				left join tblattributemaster am on am.unitid = agm.id
				where agm.id=:id";
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
				$DB->executedata('d','tblunitmaster','',$extraparams);
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
				$qrychk="SELECT case when(am.id<>'') then 1 else 0 end as tem,agm.name
					from tblunitmaster agm
					left join tblattributemaster am on am.unitid = agm.id
					where agm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					// $usemenu.=$row['name'].",";
					$status=0;
				}
				else
				{
					$usemenu.=$row['name'].",";
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblunitmaster','',$extraparams);
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
	else if($action=='editunitmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name from tblunitmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name']);

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
	else if($action=='listunitmaster')   
	{
		$units=new unit();
		$qry="select timestamp as primary_date,id,name,isactive from tblunitmaster where name like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$units=$DB->getmenual($qry,$parms,'unit');
		
		if($responsetype=='HTML')
		{
			if($units)
			{
				$i=0;
				foreach($units as $unit)
				{
					$id="'".$unit->id."'";
					$htmldata.='<tr data-index="'.$i.'">';
			
					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if(((sizeof($Pagerights)>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if(((sizeof($Pagerights)>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($unit->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($unit->name).'</td>';
					if($unit->isactive == 1)
					{
						$htmldata.='<td class="tbl-name text-center"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="isactive('.$id.')" checked>';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}
					else
					{
						$htmldata.='<td class="tbl-name text-center"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="isactive('.$id.')">';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($units)<=0)
				{
					if($filter!='%%')
					{
						$htmldata.=file_get_contents($config->getNoDataFound());
					}else{
						$htmldata.=file_get_contents($config->getNoDataFoundwoReset());
					}
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($units);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($units)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($units); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($units);
		$response['showentries']=$showentries;
	}
	
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblunitmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			$row=$result_ary[0];
			if($row['isactive']==1)
			{
				$isactive=0;
			}
			else
			{
				$isactive=1;
			}
			$insqry['isactive']=$isactive;	
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('u','tblunitmaster',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';    

?>

  