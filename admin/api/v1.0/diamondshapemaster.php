<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/diamondshape.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertdiamondshape')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$_POST['name'];
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$issubshape=(int)$IISMethods->sanitize($_POST['issubshape']);
		$mainshapeid=$IISMethods->sanitize($_POST['mainshapeid']);
		$mainshape=$IISMethods->sanitize($_POST['mainshape']);

		$img=$_FILES['img']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($name && ($img || $formevent=='editright'))
		{			
			$insqry=array(
				'name'=>$name,	
				'displayorder'=>$displayorder,					
				'issubshape'=>$issubshape,					
				'mainshapeid'=>$mainshapeid,					
				'mainshape'=>$mainshape,					

			);

			if($formevent=='addright')
			{
				$dupchkqry="SELECT id,displayorder FROM tbldiamondshapemaster WHERE displayorder=:displayorder";
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
					$qrychk="SELECT name from tbldiamondshapemaster where name=:name";
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
							if($img)
							{
								if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png' || $_FILES['img']['type'] == 'image/svg+xml'))
								{
									$workoutsourcePath = $_FILES['img']['tmp_name'];
									$workouttargetPath = $IISMethods->uploadallfiles(1,'diamondshapemaster',$img,$workoutsourcePath,$unqid);
									$insqry['img']=$workouttargetPath;
									$insqry['id']=$unqid;	
									$insqry['isactive']=1;
									$insqry['timestamp']=$IISMethods->getdatetime();
									$insqry['entry_uid']=$uid;	
									$insqry['entry_date']=$datetime;

									$DB->executedata('i','tbldiamondshapemaster',$insqry,'');

									$status=1;
									$message=$errmsg['insert'];
								}else{
									$status=0;
									$message=$errmsg['filetype'];
								}
							}else{
								$insqry['id']=$unqid;	
								$insqry['isactive']=1;
								$insqry['timestamp']=$IISMethods->getdatetime();
								$insqry['entry_uid']=$uid;	
								$insqry['entry_date']=$datetime;

								$DB->executedata('i','tbldiamondshapemaster',$insqry,'');

								$status=1;
								$message=$errmsg['insert'];
							}
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
				$dupchkqry="SELECT id FROM tbldiamondshapemaster WHERE displayorder=:displayorder AND id<>:id";
				$dupparams=array(
					':displayorder'=>$displayorder,
					':id'=>$id,
				);
				$dupres=$DB->getmenual($dupchkqry,$dupparams);
				if(sizeof($dupres)>0)
				{
					$status=0;
					$message=$errmsg['disordexist'];
				}
				else
				{
					$qrychk="SELECT name from tbldiamondshapemaster where name=:name AND id<>:id";
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
							// echo $img;
							if($img)
							{
								if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png' || $_FILES['img']['type'] == 'image/svg+xml'))
								{
									
									$qryimg="SELECT cm.img 
										FROM tbldiamondshapemaster cm 
										WHERE cm.id=:id";
									$parms = array(
										':id'=>$id,
									);
									$resimg=$DB->getmenual($qryimg,$parms);
									$row=$resimg[0];

									unlink('../../../assets/'.$row['img']);
							
									$workoutsourcePath = $_FILES['img']['tmp_name'];
									$workouttargetPath = $IISMethods->uploadallfiles(1,'diamondshapemaster',$img,$workoutsourcePath,$unqid);
									$insqry['img']=$workouttargetPath;
									$insqry['update_uid']=$uid;	
									$insqry['update_date']=$datetime;

									$extraparams=array(
										'id'=>$id
									);
									$DB->executedata('u','tbldiamondshapemaster',$insqry,$extraparams);

									$status=1;
									$message=$errmsg['update'];
								}
								else
								{
									$status=0;
									$message=$errmsg['filetype'];
								}
							}else{
								$insqry['update_uid']=$uid;	
								$insqry['update_date']=$datetime;

								$extraparams=array(
									'id'=>$id
								);
								$DB->executedata('u','tbldiamondshapemaster',$insqry,$extraparams);

								$status=1;
								$message=$errmsg['update'];
							}
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
	else if($action=='deletediamondshapemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="SELECT case when(d.id<>'' OR ds.id<>'') then 1 else 0 end as tem,sm.name
				from tbldiamondshapemaster sm
				left join tbldiamond d on d.shapeid = sm.id
				LEFT JOIN tbldiamondshapemaster ds ON ds.shapeid=sm.id
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
				$qryimg="SELECT cm.img 
					FROM tbldiamondshapemaster cm 
					WHERE cm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				$row1=$resimg[0];

				unlink('../../../assets/'.$row1['img']);
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tbldiamondshapemaster','',$extraparams);
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
				$qrychk="SELECT case when(d.id<>'' OR ds.id<>'') then 1 else 0 end as tem,sm.name
					from tbldiamondshapemaster sm
					left join tbldiamond d on d.shapeid = sm.id
					LEFT JOIN tbldiamondshapemaster ds ON ds.shapeid=sm.id
					where sm.id=:id";
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
					$qryimg="SELECT cm.img 
						FROM tbldiamondshapemaster cm 
						WHERE cm.id=:id";
					$parms = array(
						':id'=>$id,
					);
					$resimg=$DB->getmenual($qryimg,$parms);
					$row1=$resimg[0];

					unlink('../../../assets/'.$row1['img']);
					$usemenu.=$row['name'].",";
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tbldiamondshapemaster','',$extraparams);
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
	else if($action=='editdiamondshapemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,displayorder,issubshape,mainshapeid,mainshape from tbldiamondshapemaster where id=:id";
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
				$response['issubshape']=$IISMethods->sanitize($row['issubshape']);
				$response['mainshapeid']=$IISMethods->sanitize($row['mainshapeid']);
				$response['mainshape']=$IISMethods->sanitize($row['mainshape']);


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
	else if($action=='listdiamondshapemaster')   
	{
		$diamondshapes=new diamondshape();
		$qry="select timestamp as primary_date,id,name,displayorder,img,isactive,CASE WHEN(issubshape=1) THEN 'YES' ELSE 'NO' END AS issubshape,mainshape from tbldiamondshapemaster 
				where name like :filter or displayorder like :filter OR CASE WHEN(issubshape=1) THEN 'YES' ELSE 'NO' END like :filter OR mainshape like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$diamondshapes=$DB->getmenual($qry,$parms,'diamondshape');
		
		if($responsetype=='HTML')
		{
			if($diamondshapes)
			{
				$i=0;
				foreach($diamondshapes as $diamondshape)
				{
					$id="'".$diamondshape->id."'";
					$htmldata.='<tr data-index="'.$diamondshape->id.'">';
			
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$diamondshape->id.'" value="'.$IISMethods->sanitize($diamondshape->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$diamondshape->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($diamondshape->name).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($diamondshape->issubshape).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($diamondshape->mainshape).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($diamondshape->displayorder).'</td>';

					$htmldata.='<td class="tbl-img">';
						if($IISMethods->sanitize($diamondshape->img))
						{
							$htmldata.='<div class="dropdown img-dropdown dropleft">';
							$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >';// onclick=viewworkouticonimage("'.$IISMethods->sanitize($config->getImageurl().$diamondshape->img).'")>';
								$htmldata.='<img src="'.$IISMethods->sanitize($config->getImageurl().$diamondshape->img).'" class="img-thumbnail">';
							$htmldata.='</a>';
							$htmldata.='<div class="dropdown-menu img-popover-content" aria-labelledby="tableDropdown3">';
							$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$diamondshape->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$diamondshape->img).'"></a>';
							$htmldata.='</div>';
							$htmldata.='</div>';
						}
						else
						{
							$htmldata.='-';
						}
					$htmldata.='</td>';
					if($diamondshape->isactive == 1)
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
				if($page<=0 && sizeof($diamondshapes)<=0)
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
			$response['data']= json_encode($diamondshapes);
		}

		$common_listdata=$diamondshapes;
	}
	
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tbldiamondshapemaster where id=:id";
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
			$DB->executedata('u','tbldiamondshapemaster',$insqry,$extraparams);

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

  