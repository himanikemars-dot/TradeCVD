<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/slider.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertslider')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$_POST['title'];
		$subtitle=$IISMethods->sanitize($_POST['subtitle']);
		$btntext = $IISMethods->sanitize($_POST['btntext']);
		$btnurl = $IISMethods->sanitize($_POST['btnurl']);
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);
		$img=$_FILES['img']['name'];
		// $slidervideo=$_FILES['slidervideo']['name'];

		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($title && $subtitle && $displayorder && ($img || $formevent=='editright'))
		{			
			$insqry=array(					
				'title'=>$title,
				'subtitle'=>$subtitle,	
				// 'btnurl'=>$btnurl,
				// 'btntext'=>$btntext,
				'displayorder'=>$displayorder,		
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT title from tblslider where title=:title";
				$parms = array(
					':title'=>$title,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
					{
						$unqid = $IISMethods->generateuuid();
						if($img)
						{
							$slidersourcePath = $_FILES['img']['tmp_name'];
							$slidertargetPath = $IISMethods->uploadallfiles(1,'slider',$img,$slidersourcePath,$unqid);
							$insqry['sliderimg']=$slidertargetPath;
						}

						/* if($slidervideo)
						{
							if($_FILES["slidervideo"]["type"] == "video/mp4")
							{
								$videosourcePath = $_FILES['slidervideo']['tmp_name'];
								$videotargetPath = $IISMethods->uploadallfiles(1,'package',$slidervideo,$videosourcePath,$unqid);
								$insqry['slidervideo']=$videotargetPath;
							}
							else
							{
								$status=0;
								$message=$errmsg['videofiletype'];
							}
						} */
						$insqry['id']=$unqid;	
						$insqry['isactive']=1;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblslider',$insqry,'');

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
				$qrychk="SELECT title from tblslider where title=:title AND id<>:id";
				$parms = array(
					':title'=>$title,
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
						if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
						{
							$unqid = $id;
							if($img)
							{
								$qrychk1="SELECT * from tblslider where id = :id";
								$parms1 = array(
									':id'=>$id,
								);
								$result_ary1=$DB->getmenual($qrychk1,$parms1);
								if(sizeof($result_ary1) > 0)
								{
									$row1 = $result_ary1[0];
									
									unlink('../../../assets/'.$row1['sliderimg']);
								}
								$slidersourcePath = $_FILES['img']['tmp_name'];
								$slidertargetPath = $IISMethods->uploadallfiles(1,'slider',$img,$slidersourcePath,$unqid);
								$insqry['sliderimg']=$slidertargetPath;
							}

							/* if($slidervideo)
							{
								// for video upload
								if ((($_FILES["slidervideo"]["type"] == "video/mp4") || ($_FILES["slidervideo"]["type"] == "image/pjpeg") || ($_FILES["slidervideo"]["type"] == "image/gif")))
								{
									$videosourcePath = $_FILES['slidervideo']['tmp_name'];
									$videotargetPath = $IISMethods->uploadallfiles(1,'package',$slidervideo,$videosourcePath,$id);
									$insqry['slidervideo']=$videotargetPath;
								}
							} */

							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblslider',$insqry,$extraparams);

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
						/* if($slidervideo)
						{
							// for video upload
							if ((($_FILES["slidervideo"]["type"] == "video/mp4") || ($_FILES["slidervideo"]["type"] == "image/pjpeg") || ($_FILES["slidervideo"]["type"] == "image/gif")))
							{
								$videosourcePath = $_FILES['slidervideo']['tmp_name'];
								$videotargetPath = $IISMethods->uploadallfiles(1,'package',$slidervideo,$videosourcePath,$id);
								$insqry['slidervideo']=$videotargetPath;
							}
						} */

						$insqry['update_uid']=$uid;	
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblslider',$insqry,$extraparams);

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
	else if($action=='deleteslider')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT * from tblslider where id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				
				unlink('../../../assets/'.$row['sliderimg']);

				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblslider','',$extraparams);
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
				$qrychk="SELECT * from tblslider where id = :id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$row = $result_ary[0];
					unlink('../../../assets/'.$row['sliderimg']);

					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblslider','',$extraparams);
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
	else if($action=='editslider')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,title,subtitle,displayorder from tblslider where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$row['title'];
				$response['subtitle']=$IISMethods->sanitize($row['subtitle'],'OUT');
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				// $response['btnurl']=$IISMethods->sanitize($row['btnurl']);
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
	else if($action=='listslider')   
	{
		$sliders=new slider();
		$qry="SELECT ts.timestamp as primary_date,ts.id,ts.title,ts.subtitle,ts.isactive,ts.sliderimg,ts.slidervideo,ts.btnurl,ts.displayorder 
			  FROM tblslider ts 
			  WHERE ts.title like :filter OR ts.subtitle LIKE :filter  OR ts.displayorder LIKE :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		
		$sliders=$DB->getmenual($qry,$parms,'slider');
		if($responsetype=='HTML')
		{
			if($sliders)
			{
				$i=0;
				foreach($sliders as $slider)
				{
					$id="'".$slider->id."'";
					$htmldata.='<tr data-index="'.$slider->id.'">';

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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$slider->id.'" value="'.$IISMethods->sanitize($slider->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$slider->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class=""><a href="javascript:void(0)" onclick="showmessage('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($slider->title).'</a></td>';
					$htmldata.='<td class="">';
					if($slider->displayorder)
					{
						$htmldata.=$IISMethods->sanitize($slider->displayorder);
					}
					$htmldata.='</td>';
					if($slider->isactive == 1)
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
					if($IISMethods->sanitize($slider->sliderimg))
					{
						$htmldata.='<div class="dropdown img-dropdown dropleft">';
						$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$slider->sliderimg).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$slider->sliderimg).'" class="img-thumbnail "></a>';
						$htmldata.='<div class="dropdown-menu img-popover-content " aria-labelledby="tableDropdown3">';
						$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$slider->sliderimg).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$slider->sliderimg).'"></a>';
						$htmldata.='</div>';
						$htmldata.='</div>';
					}
					else
					{
						$htmldata.='-';
					}
					$htmldata.='</td>';

					/* $htmldata.='<td class="tbl-img">';
					if($IISMethods->sanitize($slider->slidervideo))
					{
						$htmldata.='<video width="70" height="50" controls>';
						$htmldata.='<source src="'.$IISMethods->sanitize($config->getImageurl().$slider->slidervideo).'">';
						// $htmldata.='<source src="'.$IISMethods->sanitize($config->getImageurl().$slider->slidervideo).'">';
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
				if($page<=0 && sizeof($sliders)<=0)
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
			$response['data']= json_encode($sliders);
		}

		$common_listdata=$sliders;

		
	}    
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qry = "SELECT isactive FROM tblslider WHERE id = :id";
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
			$DB->executedata('u','tblslider',$insqry,$extraparams);

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
			$qrychk="SELECT ta.subtitle from tblslider ta where ta.id = :id";
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
					$tbldata.='<label class="label-view">'.$row['subtitle'].'</label>';
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

  