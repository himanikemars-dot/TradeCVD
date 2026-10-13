<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/subcategory.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertsubcategory')
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$categoryid=$IISMethods->sanitize($_POST['categoryid']);
		$name=$IISMethods->sanitize($_POST['name'],'OUT');
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$img=$_FILES['img']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($categoryid && $name)
		{			
			$insqry=array(					
				'categoryid'=>$categoryid,					
				'name'=>$name,					
				'displayorder'=>$displayorder,					
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT name from tblsubcategorymaster where name=:name AND categoryid=:categoryid";
				$parms = array(
					':name'=>$name,
					':categoryid'=>$categoryid
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
                            if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
                            {
                                $workoutsourcePath = $_FILES['img']['tmp_name'];
                                $workouttargetPath = $IISMethods->uploadallfiles(1,'subcategorymaster',$img,$workoutsourcePath,$unqid);
                                $insqry['img']=$workouttargetPath;
								$insqry['id']=$unqid;	
								$insqry['isactive']=1;
								$insqry['timestamp']=$IISMethods->getdatetime();
								$insqry['entry_uid']=$uid;	
								$insqry['entry_date']=$datetime;

								$DB->executedata('i','tblsubcategorymaster',$insqry,'');

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

							$DB->executedata('i','tblsubcategorymaster',$insqry,'');

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
			else if($formevent=='editright')
			{
				$qrychk="SELECT name from tblsubcategorymaster where name=:name AND categoryid=:categoryid AND id<>:id";
				$parms = array(
					':name'=>$name,
					':id'=>$id,
					':categoryid'=>$categoryid
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
                        if($img)
                        {
                            if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
                            {
                                
                                $qryimg="SELECT scm.img 
                                    FROM tblsubcategorymaster scm 
                                    WHERE scm.id=:id";
                                $parms = array(
                                    ':id'=>$id,
                                );
                                $resimg=$DB->getmenual($qryimg,$parms);
                                $row=$resimg[0];

                                unlink('../../../assets/'.$row['img']);
                        
                                $workoutsourcePath = $_FILES['img']['tmp_name'];
                                $workouttargetPath = $IISMethods->uploadallfiles(1,'subcategorymaster',$img,$workoutsourcePath,$unqid);
                                $insqry['img']=$workouttargetPath;
								$insqry['update_uid']=$uid;	
								$insqry['update_date']=$datetime;

								$extraparams=array(
									'id'=>$id
								);
								$DB->executedata('u','tblsubcategorymaster',$insqry,$extraparams);

								$status=1;
								$message=$errmsg['update'];
                            }else{
								$status=0;
								$message=$errmsg['filetype'];
							}
                        }else{
							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblsubcategorymaster',$insqry,$extraparams);

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
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletesubcategorymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qryimg="SELECT scm.img 
				FROM tblsubcategorymaster scm 
				WHERE scm.id=:id";
			$parms = array(
				':id'=>$id,
			);
			$resimg=$DB->getmenual($qryimg,$parms);
			$row=$resimg[0];

			unlink('../../../assets/'.$row['img']);
            $extraparams=array(
                'id'=>$id
            );
            $DB->executedata('d','tblsubcategorymaster','',$extraparams);
            $status=1;
            $message=$errmsg['delete'];
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];
				$qryimg="SELECT scm.img 
					FROM tblsubcategorymaster scm 
					WHERE scm.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				$row=$resimg[0];

				unlink('../../../assets/'.$row['img']);
                $extraparams=array(
                    'id'=>$IISMethods->sanitize($id)
                );
                $DB->executedata('d','tblsubcategorymaster','',$extraparams);
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
	else if($action=='editsubcategorymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT id,categoryid,name,displayorder from tblsubcategorymaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['categoryid']=$IISMethods->sanitize($row['categoryid']);
				$response['name']=$IISMethods->sanitize($row['name'],'OUT');
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);

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
	else if($action=='listsubcategorymaster')   
	{
		$subcategorys=new subcategory();
		$qry="SELECT scm.timestamp as primary_date,scm.id,cm.name as categoryname,scm.name,scm.displayorder,scm.img,scm.isactive 
			from tblsubcategorymaster scm 
			left join tblcategorymaster cm on cm.id=scm.categoryid 
			where cm.name like :filter or scm.name like :filter or scm.displayorder like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$subcategorys=$DB->getmenual($qry,$parms,'subcategory');
		$response['subcategorys']=$subcategorys;
		
		if($responsetype=='HTML')
		{
			if($subcategorys)
			{
				$i=0;
				foreach($subcategorys as $subcategory)
				{
					$id="'".$subcategory->id."'";
					$htmldata.='<tr data-index="'.$subcategory->id.'">';
			
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$subcategory->id.'" value="'.$IISMethods->sanitize($subcategory->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$subcategory->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($subcategory->categoryname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($subcategory->name).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($subcategory->displayorder).'</td>';
					$htmldata.='<td class="tbl-img">';
						if($IISMethods->sanitize($subcategory->img))
						{
							$htmldata.='<div class="dropdown img-dropdown dropleft">';
							$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >';// onclick=viewworkouticonimage("'.$IISMethods->sanitize($config->getImageurl().$subcategory->img).'")>';
								$htmldata.='<img src="'.$IISMethods->sanitize($config->getImageurl().$subcategory->img).'" class="img-thumbnail">';
							$htmldata.='</a>';
							$htmldata.='<div class="dropdown-menu img-popover-content" aria-labelledby="tableDropdown3">';
							$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$subcategory->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$subcategory->img).'"></a>';
							$htmldata.='</div>';
							$htmldata.='</div>';
						}
						else
						{
							$htmldata.='-';
						}
					$htmldata.='</td>';
					if($subcategory->isactive == 1)
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
				if($page<=0 && sizeof($subcategorys)<=0)
				{
					$htmldata.=file_get_contents($config-> getNoDataFound());
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($subcategorys);
		}

		$common_listdata=$subcategorys;
	}
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblsubcategorymaster where id=:id";
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
			$DB->executedata('u','tblsubcategorymaster',$insqry,$extraparams);

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

  