<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/faqgroupmaster.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertfaqgroup')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$_POST['name'];
		$descr=$_POST['descr'];
		$displayorder=$_POST['displayorder'];
		$icon=$_FILES['icon']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($name && $displayorder && ($icon || $formevent=='editright'))
		{			
			$insqry=array(
				'name'=>$name,
				'descr'=>$descr,
				'displayorder'=>$displayorder,
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT name from tblfaqgroupmaster where name=:name";
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
					if(($_FILES['icon']['type'] == 'image/png' || $_FILES['icon']['type'] == 'image/svg+xml'))
					{
						$unqid = $IISMethods->generateuuid();
						if($icon)
						{
							$workoutsourcePath = $_FILES['icon']['tmp_name'];
							$workouttargetPath = $IISMethods->uploadallfiles(1,'faqgroup',$icon,$workoutsourcePath,$unqid);
							$insqry['icon']=$workouttargetPath;
						}
						$unqid = $IISMethods->generateuuid();
						$insqry['id']=$unqid;	
						$insqry['isactive']=1;
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblfaqgroupmaster',$insqry,'');

						$status=1;
						$message=$errmsg['insert'];
					}
					else{
						$status=0;
						$message=$errmsg['filetype'];
					}
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT name from tblfaqgroupmaster where name=:name AND id<>:id";
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
					if($icon)
					{
						if(($_FILES['icon']['type'] == 'image/png' || $_FILES['icon']['type'] == 'image/svg+xml'))
						{
							$unqid = $id;
							if($icon)
							{
								$qryicon="SELECT fgm.icon 
									FROM tblfaqgroupmaster fgm 
									WHERE fgm.id=:id";
								$parms = array(
									':id'=>$id,
								);
								$resicon=$DB->getmenual($qryicon,$parms);
								$row=$resicon[0];

								unlink('../../../assets/'.$row['icon']);
								
								$workoutsourcePath = $_FILES['icon']['tmp_name'];
								$workouttargetPath = $IISMethods->uploadallfiles(1,'faqgroup',$icon,$workoutsourcePath,$unqid);
								$insqry['icon']=$workouttargetPath;
							}
							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;
							// print_r($insqry);

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblfaqgroupmaster',$insqry,$extraparams);

							$status=1;
							$message=$errmsg['update'];
						}
						else
						{
							$status=0;
							$message=$errmsg['filetype'];
						}
					}
					else
					{
						$insqry['update_uid']=$uid;	
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblfaqgroupmaster',$insqry,$extraparams);

						$status=1;
						$message=$errmsg['update'];
					}
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletefaqgroupmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="SELECT case when(pm.id<>'') then 1 else 0 end as tem
			from tblfaqgroupmaster sm
			left join tblfaqmaster pm on pm.faqgroupid = sm.id
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
				$DB->executedata('d','tblfaqgroupmaster','',$extraparams);
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
				$qrychk="SELECT case when(pm.id<>'') then 1 else 0 end as tem,sm.
				from tblfaqgroupmaster sm
				left join tblfaqmaster pm on pm.faqgroupid = sm.id
				where sm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					// $usemenu.=$row['category'].",";
					$status=0;
				}
				else
				{
					$usemenu.=$row['name'].",";
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblfaqgroupmaster','',$extraparams);
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
	else if($action=='editfaqgroupmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,descr,displayorder from tblfaqgroupmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name'],'OUT');
				$response['descr']=$row['descr'];
				$response['displayorder']=$row['displayorder'];

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
	else if($action=='listfaqgroupmaster')   
	{
		$faqgroup=new faqgroup();
		$qry="select timestamp as primary_date,id,name,isactive,descr,displayorder,icon from tblfaqgroupmaster where name like :filter OR descr like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$faqgroup=$DB->getmenual($qry,$parms,'faqgroup');
		
		if($responsetype=='HTML')
		{
			if($faqgroup)
			{
				$i=0;
				foreach($faqgroup as $row)
				{
					$id="'".$row->id."'";
					$htmldata.='<tr data-index="'.$row->id.'">';
			
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$row->id.'" value="'.$IISMethods->sanitize($row->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$row->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->name).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->descr).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->displayorder).'</td>';
					if($row->isactive == 1)
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
					$htmldata.='<td class="tbl-img">';
					if($IISMethods->sanitize($row->icon))
					{
						$htmldata.='<div class="dropdown img-dropdown dropleft">';
						$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewworkouticonimage("'.$IISMethods->sanitize($config->getImageurl().$row->icon).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$row->icon).'" class="img-thumbnail"></a>';
						$htmldata.='<div class="dropdown-menu img-popover-content" aria-labelledby="tableDropdown3">';
						$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$row->icon).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$row->icon).'"></a>';
						$htmldata.='</div>';
						$htmldata.='</div>';
					}
					else
					{
						$htmldata.='-';
					}
					$htmldata.='</td>';
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($faqgroup)<=0)
				{
				// 	$htmldata.=file_get_contents($config-> getNoDataFound());
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
			$response['data']= json_encode($faqgroup);
		}

		$common_listdata=$faqgroup;
	}
	
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblfaqgroupmaster where id=:id";
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
			$DB->executedata('u','tblfaqgroupmaster',$insqry,$extraparams);

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

  