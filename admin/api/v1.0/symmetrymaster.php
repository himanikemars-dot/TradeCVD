<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/symmetry.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertsymmetry')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$_POST['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$issubsymmetry=(int)$IISMethods->sanitize($_POST['issubsymmetry']);
		$mainsymmetryid=$IISMethods->sanitize($_POST['mainsymmetryid']);
		$mainsymmetry=$IISMethods->sanitize($_POST['mainsymmetry']);


		$datetime=$IISMethods->getdatetime();
		if($name)
		{			
			$insqry=array(
				'name'=>$name,		
				'displayorder'=>$displayorder,	
				'issubsymmetry'=>$issubsymmetry,					
				'mainsymmetryid'=>$mainsymmetryid,					
				'mainsymmetry'=>$mainsymmetry,						

			);

			if($formevent=='addright')
			{
				$dupchkqry="SELECT id FROM tblsymmetrymaster WHERE displayorder=:displayorder";
				$dupparams=array(
					':displayorder'=>$displayorder
				);
				$dupres=$DB->getmenual($dupchkqry,$dupparams);
				if(sizeof($dupres)>0)
				{
					$status=0;
					$message=$errmsg['disordexist'];
				}else{
					$qrychk="SELECT name from tblsymmetrymaster where name=:name";
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

							$DB->executedata('i','tblsymmetrymaster',$insqry,'');

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
				$dupchkqry="SELECT id FROM tblsymmetrymaster WHERE displayorder=:displayorder AND id<>:id";
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
					$qrychk="SELECT name from tblsymmetrymaster where name=:name AND id<>:id";
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
							$DB->executedata('u','tblsymmetrymaster',$insqry,$extraparams);

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
	else if($action=='deletesymmetrymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT DISTINCT CASE WHEN(d.id<>'') THEN 1 ELSE 0 END AS tem,tm.name
			FROM tblsymmetrymaster tm
			LEFT JOIN tbldiamond d ON d.symmetryid = tm.id
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
				$DB->executedata('d','tblsymmetrymaster','',$extraparams);
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
				$qrychk="SELECT DISTINCT CASE WHEN(d.id<>'') THEN 1 ELSE 0 END AS tem,tm.name
				FROM tblsymmetrymaster tm
				LEFT JOIN tbldiamond d ON d.symmetryid = tm.id
				where tm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					// $status=0;
					$usemenu.=$row['name'].",";
					// $message=$errmsg['inuse'];
				}
				else
				{
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblsymmetrymaster','',$extraparams);
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
	else if($action=='editsymmetrymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,displayorder,issubsymmetry,mainsymmetryid,mainsymmetry from tblsymmetrymaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name']);
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				$response['issubsymmetry']=$IISMethods->sanitize($row['issubsymmetry']);
				$response['mainsymmetryid']=$IISMethods->sanitize($row['mainsymmetryid']);
				$response['mainsymmetry']=$IISMethods->sanitize($row['mainsymmetry']);


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
	else if($action=='listsymmetrymaster')   
	{
		$symmetrys=new symmetry();
		$qry="select timestamp as primary_date,id,name,displayorder,isactive,CASE WHEN(issubsymmetry=1) THEN 'YES' ELSE 'NO' END AS issubsymmetry,mainsymmetry from tblsymmetrymaster
		 where name like :filter or displayorder like :filter OR CASE WHEN(issubsymmetry=1) THEN 'YES' ELSE 'NO' END like :filter OR mainsymmetry like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$symmetrys=$DB->getmenual($qry,$parms,'symmetry');
		
		if($responsetype=='HTML')
		{
			if($symmetrys)
			{
				$i=0;
				foreach($symmetrys as $symmetry)
				{
					$id="'".$symmetry->id."'";
					$htmldata.='<tr data-index="'.$i.'">';
			
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($symmetry->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($symmetry->name).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($symmetry->issubsymmetry).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($symmetry->mainsymmetry).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($symmetry->displayorder).'</td>';

					if($symmetry->isactive == 1)
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
				if($page<=0 && sizeof($symmetrys)<=0)
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
			$response['data']= json_encode($symmetrys);
		}

		$common_listdata=$symmetrys;
	}
	
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblsymmetrymaster where id=:id";
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
			$DB->executedata('u','tblsymmetrymaster',$insqry,$extraparams);

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

  