<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/benefits.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertbenefits')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$_POST['title'];
		$shortdescr=$IISMethods->sanitize($_POST['shortdescr']);
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);
		$typeid = $IISMethods->sanitize($_POST['typeid']);
		$img=$_FILES['img']['name'];
		// print_r($_FILES); exit;
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($typeid && $title && $shortdescr && $displayorder && ($img || $formevent=='editright'))
		{			
			$insqry=array(		
				'typeid'=>$typeid,			
				'title'=>$title,
				'shortdescr'=>$shortdescr,
				'displayorder'=>$displayorder,		
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT title from tblbenefits where title=:title AND typeid=:typeid";
				$parms = array(
					':title'=>$title,
					':typeid'=>$typeid
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png' || $_FILES['img']['type'] == 'image/svg+xml'))
					{
						$unqid = $IISMethods->generateuuid();
						if($img)
						{
							$benefitssourcePath = $_FILES['img']['tmp_name'];
							$benefitstargetPath = $IISMethods->uploadallfiles(1,'benefits',$img,$benefitssourcePath,$unqid);
							$insqry['img']=$benefitstargetPath;
						}
						$insqry['id']=$unqid;	
						$insqry['isactive']=1;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblbenefits',$insqry,'');

						$status=1;
						$message=$errmsg['insert'];
							
					}
					else
					{
						$status=0;
						$message=$errmsg['filetype'];
					}
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT title from tblbenefits where title=:title  AND typeid=:typeid AND id<>:id";
				$parms = array(
					':title'=>$title,
					':typeid'=>$typeid,
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
					if($img)
					{
						if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png' || $_FILES['img']['type'] == 'image/svg+xml'))
						{
							$unqid = $id;
							if($img)
							{
								$qrychk1="SELECT * from tblbenefits where id = :id";
								$parms1 = array(
									':id'=>$id,
								);
								$result_ary1=$DB->getmenual($qrychk1,$parms1);
								if(sizeof($result_ary1) > 0)
								{
									$row1 = $result_ary1[0];
									
									unlink('../../../assets/'.$row1['img']);
								}
								$benefitssourcePath = $_FILES['img']['tmp_name'];
								$benefitstargetPath = $IISMethods->uploadallfiles(1,'benefits',$img,$benefitssourcePath,$unqid);
								$insqry['img']=$benefitstargetPath;
							}

							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblbenefits',$insqry,$extraparams);

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
						$DB->executedata('u','tblbenefits',$insqry,$extraparams);

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
	else if($action=='deletebenefits')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT * from tblbenefits where id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				
				unlink('../../../assets/'.$row['img']);

				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblbenefits','',$extraparams);
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
				$qrychk="SELECT * from tblbenefits where id = :id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$row = $result_ary[0];
					unlink('../../../assets/'.$row['img']);

					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblbenefits','',$extraparams);
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
	else if($action=='editbenefits')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,typeid,title,shortdescr,displayorder from tblbenefits where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['typeid']=$IISMethods->sanitize($row['typeid']);
				$response['title']=$row['title'];
				$response['shortdescr']=$IISMethods->sanitize($row['shortdescr']);
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
	else if($action=='listbenefits')   
	{
		$benefitss=new benefits();
		$qry="SELECT ts.timestamp as primary_date,ts.id,ts.title,ts.shortdescr,ts.isactive,ts.img,ts.displayorder,CASE WHEN(ts.typeid=1) THEN 'Buyer' WHEN(ts.typeid=2) THEN 'Seller' ELSE '' END AS type 
			  FROM tblbenefits ts 
			  WHERE ts.title like :filter OR ts.shortdescr LIKE :filter  OR ts.displayorder LIKE :filter OR (CASE WHEN(ts.typeid=1) THEN 'Buyer' WHEN(ts.typeid=2) THEN 'Seller' ELSE '' END)  LIKE :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		
		$benefitss=$DB->getmenual($qry,$parms,'benefits');
		if($responsetype=='HTML')
		{
			if($benefitss)
			{
				$i=0;
				foreach($benefitss as $benefits)
				{
					$id="'".$benefits->id."'";
					$htmldata.='<tr data-index="'.$benefits->id.'">';

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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$benefits->id.'" value="'.$IISMethods->sanitize($benefits->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$benefits->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($benefits->type).'</td>';
					$htmldata.='<td class=""><a href="javascript:void(0)" onclick="showmessage('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($benefits->title).'</a></td>';
					$htmldata.='<td class="">';
					if($benefits->displayorder)
					{
						$htmldata.=$IISMethods->sanitize($benefits->displayorder);
					}
					$htmldata.='</td>';
					if($benefits->isactive == 1)
					{
						$htmldata.='<td class="tbl-name"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="isactive('.$id.')" checked>';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}
					else
					{
						$htmldata.='<td class="tbl-name"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="isactive('.$id.')">';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}

					$htmldata.='<td class="tbl-img">';
					if($IISMethods->sanitize($benefits->img))
					{
						$htmldata.='<div class="dropdown img-dropdown dropleft">';
						$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$benefits->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$benefits->img).'" class="img-thumbnail bg-web-dark"></a>';
						$htmldata.='<div class="dropdown-menu img-popover-content bg-web-dark" aria-labelledby="tableDropdown3">';
						$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$benefits->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$benefits->img).'"></a>';
						$htmldata.='</div>';
						$htmldata.='</div>';
					}
					else
					{
						$htmldata.='-';
					}
					$htmldata.='</td>';

					/* $htmldata.='<td class="tbl-img">';
					if($IISMethods->sanitize($benefits->benefitsvideo))
					{
						$htmldata.='<video width="70" height="50" controls>';
						$htmldata.='<source src="'.$IISMethods->sanitize($config->getImageurl().$benefits->benefitsvideo).'">';
						// $htmldata.='<source src="'.$IISMethods->sanitize($config->getImageurl().$benefits->benefitsvideo).'">';
						$htmldata.='</video>';
					}
					else
					{
						$htmldata.='-';
					}
					$htmldata.='</td>'; */
					
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($benefitss)<=0)
				{
					// $htmldata.=file_get_contents($config-> getNoDataFound());
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
			$response['data']= json_encode($benefitss);
		}

		$common_listdata=$benefitss;
	}    
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qry = "SELECT isactive FROM tblbenefits WHERE id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qry,$parms);
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
			$DB->executedata('u','tblbenefits',$insqry,$extraparams);

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
			$qrychk="SELECT ta.shortdescr from tblbenefits ta where ta.id = :id";
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
					$tbldata.='<label class="label-view">'.$row['shortdescr'].'</label>';
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

  