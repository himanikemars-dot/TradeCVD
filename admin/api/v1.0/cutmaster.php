<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/cut.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertcut')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$_POST['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$issubcut=(int)$IISMethods->sanitize($_POST['issubcut']);

		$maincutid=$IISMethods->sanitize($_POST['maincutid']);
		$maincut=$IISMethods->sanitize($_POST['maincut']);

		$datetime=$IISMethods->getdatetime();
		if($name)
		{			
			$insqry=array(
				'name'=>$name,	
				'displayorder'=>$displayorder,	
				'issubcut'=>$issubcut,					

				'maincutid'=>$maincutid,					
				'maincut'=>$maincut,				

			);

			if($formevent=='addright')
			{
				$dupchkqry="SELECT id FROM tblcutmaster WHERE displayorder=:displayorder";
				$dupparams=array(
					':displayorder'=>$displayorder
				);
				$dupres=$DB->getmenual($dupchkqry,$dupparams);
				if(sizeof($dupres)>0)
				{
					$status=0;
					$message=$errmsg['disordexist'];
				}
				else
				{
					$qrychk="SELECT name from tblcutmaster where name=:name";
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

							$DB->executedata('i','tblcutmaster',$insqry,'');

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
			}
			else if($formevent=='editright')
			{
				$dupchkqry="SELECT id FROM tblcutmaster WHERE displayorder=:displayorder AND id<>:id";
				$dupparams=array(
					':displayorder'=>$displayorder,
					':id'=>$id,
				);
				$dupres=$DB->getmenual($dupchkqry,$dupparams);
				if(sizeof($dupres)>0)
				{
					$status=0;
					$message=$errmsg['disordexist'];
				}else{
					$qrychk="SELECT name from tblcutmaster where name=:name AND id<>:id";
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
							$DB->executedata('u','tblcutmaster',$insqry,$extraparams);

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
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletecutmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="
			SELECT DISTINCT CASE WHEN(d.id<>'') THEN 1 ELSE 0 END AS tem,tm.name
			FROM tblcutmaster tm
			LEFT JOIN tbldiamond d ON d.cutid = tm.id
			where tm.id=:id";
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
				$DB->executedata('d','tblcutmaster','',$extraparams);
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
				$qrychk="
			SELECT DISTINCT CASE WHEN(d.id<>'') THEN 1 ELSE 0 END AS tem,tm.name
			FROM tblcutmaster tm
			LEFT JOIN tbldiamond d ON d.cutid = tm.id
				where tm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					$usemenu.=$row['name'].",";
				}
				else
				{
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblcutmaster','',$extraparams);
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
	else if($action=='editcutmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,displayorder,issubcut,maincutid,maincut from tblcutmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name'],'OUT');
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				$response['issubcut']=$IISMethods->sanitize($row['issubcut']);
				$response['maincutid']=$IISMethods->sanitize($row['maincutid']);
				$response['maincut']=$IISMethods->sanitize($row['maincut']);



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
	else if($action=='listcutmaster')   
	{
		$cuts=new cut();
		$qry="select timestamp as primary_date,id,name,displayorder,CASE WHEN(issubcut=1) THEN 'YES' ELSE 'NO' END AS issubcut,maincut,isactive from tblcutmaster 
		where name like :filter or displayorder like :filter OR CASE WHEN(issubcut=1) THEN 'YES' ELSE 'NO' END like :filter OR maincut like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$cuts=$DB->getmenual($qry,$parms,'cut');
		
		if($responsetype=='HTML')
		{
			if($cuts)
			{
				$i=0;
				foreach($cuts as $cut)
				{
					$id="'".$cut->id."'";
					$htmldata.='<tr data-index="'.$cut->id.'">';
			
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$cut->id.'" value="'.$IISMethods->sanitize($cut->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$cut->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($cut->name).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($cut->issubcut).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($cut->maincut).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($cut->displayorder).'</td>';

					if($cut->isactive == 1)
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
				if($page<=0 && sizeof($cuts)<=0)
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
			$response['data']= json_encode($cuts);
		}

		$common_listdata=$cuts;
	}
	
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblcutmaster where id=:id";
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
			$DB->executedata('u','tblcutmaster',$insqry,$extraparams);

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

  