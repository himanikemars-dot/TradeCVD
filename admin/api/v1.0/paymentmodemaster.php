<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/paymentmodemaster.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertpaymentmodemaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$_POST['title'];
		$displayorder = $IISMethods->sanitize($_POST['displayorder']);
		$img=$_FILES['img']['name'];

		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($title && $displayorder && ($img || $formevent=='editright'))
		{			
			$insqry=array(					
				'title'=>$title,
				'displayorder'=>$displayorder,		
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT title from tblpaymentmodemaster where title=:title";
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
					if($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png' || $_FILES['img']['type'] == 'image/svg+xml')
					{
						$unqid = $IISMethods->generateuuid();
						if($img)
						{
							$paymentmodemastersourcePath = $_FILES['img']['tmp_name'];
							$paymentmodemastertargetPath = $IISMethods->uploadallfiles(1,'paymentmode',$img,$paymentmodemastersourcePath,$unqid);
							$insqry['img']=$paymentmodemastertargetPath;
						}

						$insqry['id']=$unqid;	
						$insqry['isactive']=1;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblpaymentmodemaster',$insqry,'');

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
				$qrychk="SELECT title from tblpaymentmodemaster where title=:title AND id<>:id";
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
						if($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png' || $_FILES['img']['type'] == 'image/svg+xml')
						{
							$unqid = $id;
							if($img)
							{
								$qrychk1="SELECT * from tblpaymentmodemaster where id = :id";
								$parms1 = array(
									':id'=>$id,
								);
								$result_ary1=$DB->getmenual($qrychk1,$parms1);
								if(sizeof($result_ary1) > 0)
								{
									$row1 = $result_ary1[0];
									
									unlink('../../../assets/'.$row1['img']);
								}
								$paymentmodemastersourcePath = $_FILES['img']['tmp_name'];
								$paymentmodemastertargetPath = $IISMethods->uploadallfiles(1,'paymentmode',$img,$paymentmodemastersourcePath,$unqid);
								$insqry['img']=$paymentmodemastertargetPath;
							}

							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblpaymentmodemaster',$insqry,$extraparams);

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
						$DB->executedata('u','tblpaymentmodemaster',$insqry,$extraparams);

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
	else if($action=='deletepaymentmodemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT * from tblpaymentmodemaster where id = :id";
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
				$DB->executedata('d','tblpaymentmodemaster','',$extraparams);
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
				$qrychk="SELECT * from tblpaymentmodemaster where id = :id";
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
					$DB->executedata('d','tblpaymentmodemaster','',$extraparams);
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
	else if($action=='editpaymentmodemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,title,displayorder from tblpaymentmodemaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$row['title'];
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
	else if($action=='listpaymentmodemaster')   
	{
		$paymentmodemasters=new paymentmodemaster();
		$qry="SELECT ts.timestamp as primary_date,ts.id,ts.title,ts.isactive,ts.img,ts.displayorder 
			  FROM tblpaymentmodemaster ts 
			  WHERE ts.title like :filter   OR ts.displayorder LIKE :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		
		$paymentmodemasters=$DB->getmenual($qry,$parms,'paymentmodemaster');
		if($responsetype=='HTML')
		{
			if($paymentmodemasters)
			{
				$i=0;
				foreach($paymentmodemasters as $paymentmodemaster)
				{
					$id="'".$paymentmodemaster->id."'";
					$htmldata.='<tr data-index="'.$paymentmodemaster->id.'">';

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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$paymentmodemaster->id.'" value="'.$IISMethods->sanitize($paymentmodemaster->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$paymentmodemaster->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($paymentmodemaster->title).'</td>';
					$htmldata.='<td class="">';
						$htmldata.=$IISMethods->sanitize($paymentmodemaster->displayorder);
					$htmldata.='</td>';
					if($paymentmodemaster->isactive == 1)
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
					if($IISMethods->sanitize($paymentmodemaster->img))
					{
						$htmldata.='<div class="dropdown img-dropdown dropleft">';
						$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="viewimage("'.$IISMethods->sanitize($config->getImageurl().$paymentmodemaster->img).'") "><img src="'.$IISMethods->sanitize($config->getImageurl().$paymentmodemaster->img).'" class="img-thumbnail"></a>';
						$htmldata.='<div class="dropdown-menu img-popover-content " aria-labelledby="tableDropdown3">';
						$htmldata.='<a href="javascript:void(0)" onclick=viewimage("'.$IISMethods->sanitize($config->getImageurl().$paymentmodemaster->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$paymentmodemaster->img).'"></a>';
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
				if($page<=0 && sizeof($paymentmodemasters)<=0)
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
			$response['data']= json_encode($paymentmodemasters);
		}

		$common_listdata=$paymentmodemasters;
	}    
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qry = "SELECT isactive FROM tblpaymentmodemaster WHERE id = :id";
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
			$DB->executedata('u','tblpaymentmodemaster',$insqry,$extraparams);

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

  