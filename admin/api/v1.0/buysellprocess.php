<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/buysellprocess.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertbuysellprocess')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$_POST['title'];
		$typeid=$IISMethods->sanitize($_POST['typeid']);
        $displayorder=$IISMethods->sanitize($_POST['displayorder']);
        $description=$_POST['descr'];
		$img=$_FILES['img']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($title && $displayorder && $description && $typeid &&  ($img || $formevent=='editright'))
		{			
            if($typeid==1)
            {
                $typetext='Buyer';
            }
            else if($typeid==2)
            {
                $typetext='Seller';
            }

            $qrychktype="SELECT name from tblbuysellprocesstype where id=:id";
            $parmstype = array(
                ':id'=>$typeid,
            );
            $result_arytype=$DB->getmenual($qrychktype,$parmstype);


			$insqry=array(	
                'typeid'=>$typeid,				
                'typetext'=>$result_arytype[0]['name'],
				'title'=>$title,
				'displayorder'=>$displayorder,		
                'description'=>$description,	
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT title from tblbuysellprocess where title=:title and typeid=:typeid";
				$parms = array(
					':title'=>$title,
                    ':typeid'=>$typeid,
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
							$buysellprocesssourcePath = $_FILES['img']['tmp_name'];
							$buysellprocesstargetPath = $IISMethods->uploadallfiles(1,'buysellprocess',$img,$buysellprocesssourcePath,$unqid);
							$insqry['buysellprocessimg']=$buysellprocesstargetPath;
						}

						$insqry['id']=$unqid;	
						$insqry['isactive']=1;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblbuysellprocess',$insqry,'');

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
				$qrychk="SELECT title from tblbuysellprocess where title=:title and typeid=:typeid AND id<>:id";
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
						if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
						{
                            $qryimg="SELECT buysellprocessimg from tblbuysellprocess where id=:id";
                            $parmsimg = array(
                                ':id'=>$id,
                            );
                            $result_aryimg=$DB->getmenual($qryimg,$parmsimg);
                            
							$unqid = $id;
							if($img)
							{
                                unlink('../../../assets/'.$result_aryimg[0]['buysellprocessimg']);
								$buysellprocesssourcePath = $_FILES['img']['tmp_name'];
								$buysellprocesstargetPath = $IISMethods->uploadallfiles(1,'buysellprocess',$img,$buysellprocesssourcePath,$unqid);
								$insqry['buysellprocessimg']=$buysellprocesstargetPath;
							}

							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblbuysellprocess',$insqry,$extraparams);

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
						$DB->executedata('u','tblbuysellprocess',$insqry,$extraparams);

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
	else if($action=='deletebuysellprocess')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT * from tblbuysellprocess where id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
                unlink('../../../assets/'.$row['buysellprocessimg']);
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblbuysellprocess','',$extraparams);
				$status=1;
				$message=$errmsg['delete'];
			}

		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			$isactive = 0;
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];
				$qrychk="SELECT * from tblbuysellprocess where id = :id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$row = $result_ary[0];
                    unlink('../../../assets/'.$row['buysellprocessimg']);
					
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblbuysellprocess','',$extraparams);
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
	else if($action=='editbuysellprocess')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,title,displayorder,description,typeid from tblbuysellprocess where id=:id";
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
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				$response['description']=$row['description'];
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
	else if($action=='listbuysellprocess')   
	{
		$buysellprocesss=new buysellprocess();
		$qry="SELECT ts.timestamp as primary_date,ts.typetext,ts.typeid,ts.id,ts.title,ts.displayorder,ts.isactive,ts.buysellprocessimg
			  FROM tblbuysellprocess ts 
			  WHERE ts.title like :filter OR ts.displayorder LIKE :filter OR ts.typetext LIKE :filter OR ts.typeid LIKE :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		
		$buysellprocesss=$DB->getmenual($qry,$parms,'buysellprocess');
		if($responsetype=='HTML')
		{
			if($buysellprocesss)
			{
				$i=0;
				foreach($buysellprocesss as $buysellprocess)
				{
					$id="'".$buysellprocess->id."'";
					$htmldata.='<tr data-index="'.$buysellprocess->id.'">';

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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$buysellprocess->id.'" value="'.$IISMethods->sanitize($buysellprocess->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$buysellprocess->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
                    $htmldata.='<td class="">'.$IISMethods->sanitize($buysellprocess->typetext).'</td>';
					$htmldata.='<td class=""><a href="javascript:void(0)" onclick="showmessage('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($buysellprocess->title).'</a></td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($buysellprocess->displayorder).'';
					$htmldata.='</td>';
					if($buysellprocess->isactive == 1)
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
					if($IISMethods->sanitize($buysellprocess->buysellprocessimg))
					{
						$htmldata.='<div class="dropdown img-dropdown dropleft">';
						$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$buysellprocess->buysellprocessimg).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$buysellprocess->buysellprocessimg).'" class="img-thumbnail bg-web-dark"></a>';
						$htmldata.='<div class="dropdown-menu img-popover-content bg-web-dark" aria-labelledby="tableDropdown3">';
						$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$buysellprocess->buysellprocessimg).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$buysellprocess->buysellprocessimg).'"></a>';
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
				if($page<=0 && sizeof($buysellprocesss)<=0)
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
			$response['data']= json_encode($buysellprocesss);
		}

		$common_listdata=$buysellprocesss;
	}    
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qry = "SELECT isactive FROM tblbuysellprocess WHERE id = :id";
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
			$DB->executedata('u','tblbuysellprocess',$insqry,$extraparams);

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
			$qrychk="SELECT ta.description from tblbuysellprocess ta where ta.id = :id";
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

  