<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/brandmaster.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertbranddetail')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$IISMethods->sanitize($_POST['title'],'OUT');
		$type=$IISMethods->sanitize($_POST['typeid']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		// $img=$_FILES['img']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($title && $type && $displayorder )
		{			
			$insqry=array(					
				'title'=>$title,
				'displayorder'=>$displayorder,	
				'type'=>$type,	
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT type,title from tblbrandmaster where title=:title AND type=:type";
				$parms = array(
					':title'=>$title,
					':type'=>$type,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					// if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
					// {
						$unqid = $IISMethods->generateuuid();
					// 	if($img)
					// 	{
					// 		$workoutsourcePath = $_FILES['img']['tmp_name'];
					// 		$workouttargetPath = $IISMethods->uploadallfiles(1,'brand',$img,$workoutsourcePath,$unqid);
					// 		$insqry['img']=$workouttargetPath;
					// 	}
						
						$insqry['id']=$unqid;	
						$insqry['isactive']=1;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblbrandmaster',$insqry,'');

						$status=1;
						$message=$errmsg['insert'];
					// }
					// else
					// {
					// 	$status=0;
					// 	$message=$errmsg['filetype'];
					// }
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT title from tblbrandmaster where title=:title AND type=:type and id<>:id";
				$parms = array(
					':title'=>$title,
					':type'=>$type,
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
					// if($img)
					// {
					// 	if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
					// 	{
					// 		$unqid = $id;
					// 		if($img)
					// 		{
					// 			$qryimg="SELECT img
					// 				from tblbrandmaster 
					// 				where id=:id";
					// 			$imgparms = array(
					// 				':id'=>$id,
					// 			);
					// 			$resimg=$DB->getmenual($qryimg,$imgparms);
					// 			$rowimg=$resimg[0];
					// 			unlink('../../../assets/'.$rowimg['img']);
					// 			$workoutsourcePath = $_FILES['img']['tmp_name'];
					// 			$workouttargetPath = $IISMethods->uploadallfiles(1,'brand',$img,$workoutsourcePath,$unqid);
					// 			$insqry['img']=$workouttargetPath;
					// 		}
					// 		$insqry['update_uid']=$uid;	
					// 		$insqry['update_date']=$datetime;

					// 		$extraparams=array(
					// 			'id'=>$id
					// 		);
					// 		$DB->executedata('u','tblbrandmaster',$insqry,$extraparams);

					// 		$status=1;
					// 		$message=$errmsg['update'];
					// 	}
					// 	else
					// 	{
					// 		$status=0;
					// 		$message=$errmsg['filetype'];
					// 	}
					// }
					// else
					// {
						$insqry['update_uid']=$uid;	
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblbrandmaster',$insqry,$extraparams);

						$status=1;
						$message=$errmsg['update'];
					// }
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletebrandmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT case when(d.id<>'') then 1 else 0 end as tem
			from tblbrandmaster bm
			left join tbldiamond d on d.brandid = bm.id
			where bm.id=:id";
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
				$qryimg="SELECT img
					from tblbrandmaster 
					where id=:id";
				$imgparms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$imgparms);
				$rowimg=$resimg[0];
				unlink('../../../assets/'.$rowimg['img']);
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblbrandmaster','',$extraparams);
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

				$qrychk="SELECT case when(d.id<>'') then 1 else 0 end as tem,bm.title
				from tblbrandmaster bm
				left join tbldiamond d on d.brandid = bm.id
				where bm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					$status=0;
					// $message=$errmsg['inuse'];
				}
				else
				{
					$usemenu.=$row['title'].",";
					$qryimg="SELECT img
						from tblbrandmaster 
						where id=:id";
					$imgparms = array(
						':id'=>$id,
					);
					$resimg=$DB->getmenual($qryimg,$imgparms);
					$rowimg=$resimg[0];
					unlink('../../../assets/'.$rowimg['img']);
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblbrandmaster','',$extraparams);
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
	else if($action=='editbranddetail')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,title,type,displayorder from tblbrandmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$IISMethods->sanitize($row['title'], 'OUT');
				$response['type']=$IISMethods->sanitize($row['type']);
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
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
	else if($action=='listbrandmaster')   
	{
		$branddetail=new brand();
		$qry="SELECT b.timestamp AS primary_date,b.id,b.type,b.title,b.displayorder,b.isactive ,
			CASE 
				WHEN (`type`='1') THEN 'Diamond'
				WHEN (`type`='2') THEN 'Jewellery'
			ELSE ''
			END AS typename
			FROM tblbrandmaster b 
		where b.title like :filter OR b.displayorder like :filter or
		CASE 
				WHEN (`type`='1') THEN 'Diamond'
				WHEN (`type`='2') THEN 'Jewellery'
			ELSE ''
			END like :filter
		 order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$branddetail=$DB->getmenual($qry,$parms,'brand');
		
		if($responsetype=='HTML')
		{
			if($branddetail)
			{
				$i=0;
				foreach($branddetail as $rowbrand)
				{
					$id="'".$rowbrand->id."'";
					$htmldata.='<tr data-index="'.$rowbrand->id.'">';

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

					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$rowbrand->id.'" value="'.$IISMethods->sanitize($rowbrand->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$rowbrand->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					// <a href="javascript:void(0)" onclick=viewdescription('.$IISMethods->sanitize($id).')></a>
					$htmldata.='<td class="tbl-info">'.$IISMethods->sanitize($rowbrand->typename).'</td>';
					$htmldata.='<td class="tbl-info">'.$IISMethods->sanitize($rowbrand->title, 'OUT').'</td>';
					$htmldata.='<td class="tbl-info text-center">'.$IISMethods->sanitize($rowbrand->displayorder).'</td>';
					if($rowbrand->isactive == 1)
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
					// $htmldata.='<td class="tbl-img">';
					// if($IISMethods->sanitize($rowbrand->img))
					// {
					// 	$htmldata.='<div class="dropdown img-dropdown dropleft">';
					// 	$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewworkouticonimage("'.$IISMethods->sanitize($config->getImageurl().$rowbrand->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$rowbrand->img).'" class="img-thumbnail"></a>';
					// 	$htmldata.='<div class="dropdown-menu img-popover-content" aria-labelledby="tableDropdown3">';
					// 	$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$rowbrand->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$rowbrand->img).'"></a>';
					// 	$htmldata.='</div>';
					// 	$htmldata.='</div>';
					// }
					// else
					// {
					// 	$htmldata.='-';
					// }
					// $htmldata.='</td>';
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($branddetail)<=0)
				{
					$htmldata.=file_get_contents($config-> getNoDataFound());
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($branddetail);
		}

		$common_listdata=$branddetail;
	}    

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblbrandmaster where id=:id";
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
			$DB->executedata('u','tblbrandmaster',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='showaboutdescription')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT ta.description from tblbrandmaster ta where ta.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$tbldata='';
				$tbldata.='<div class="col-12">';
				$tbldata.='<div class="table-responsive">';
				$tbldata.='<div class="col-12 view-data-details">';
				$tbldata.='<div class="row my-3">';
				$tbldata.='<div class="col-12 col-md-8 col-lg">';
				$tbldata.='<div class="row">';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-12">';
					$tbldata.='<label class="label-view">'.$row['description'].'</label>';
					$tbldata.='</div></div></div>';
					

				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';										
				$tbldata.='</div>';

			}

			$response['data']=$tbldata;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  