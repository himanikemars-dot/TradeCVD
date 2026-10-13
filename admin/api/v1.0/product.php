<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/product.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertproduct')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$IISMethods->sanitize($_POST['name']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);

		$img=$_FILES['img']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($name && $displayorder && ($img || $formevent=='editright'))
		{			
			$insqry=array(					
				'name'=>$name,
				'displayorder'=>$displayorder,				
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT name from tblproduct where name=:name";
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
					if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
					{
						$unqid = $IISMethods->generateuuid();
						if($img)
						{
							$workoutsourcePath = $_FILES['img']['tmp_name'];
							$workouttargetPath = $IISMethods->uploadallfiles(1,'product',$img,$workoutsourcePath,$unqid);
							$insqry['img']=$workouttargetPath;
						}
						
						$insqry['id']=$unqid;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblproduct',$insqry,'');

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
				$qrychk="SELECT name from tblproduct where name=:name and id<>:id";
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
					if($img)
					{
						if(($_FILES['img']['type'] == 'image/jpg'  || $_FILES['img']['type'] == 'image/jpeg' || $_FILES['img']['type'] == 'image/png'))
						{
							$unqid = $id;
							if($img)
							{
								$workoutsourcePath = $_FILES['img']['tmp_name'];
								$workouttargetPath = $IISMethods->uploadallfiles(1,'product',$img,$workoutsourcePath,$unqid);
								$insqry['img']=$workouttargetPath;
							}
							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;

							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblproduct',$insqry,$extraparams);

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
						$DB->executedata('u','tblproduct',$insqry,$extraparams);

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
	else if($action=='deleteproduct')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('d','tblproduct','',$extraparams);
			$status=1;
			$message=$errmsg['delete'];
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];

				$extraparams=array(
					'id'=>$IISMethods->sanitize($id)
				);
				$DB->executedata('d','tblproduct','',$extraparams);
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
	else if($action=='editproduct')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,displayorder from tblproduct where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name'], 'OUT');
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
	else if($action=='listproduct')   
	{
		$products=new product();
		$qry="select cm.timestamp as primary_date,cm.id,cm.name,cm.displayorder,cm.isactive,cm.img from tblproduct cm 
		where cm.name like :filter  order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$products=$DB->getmenual($qry,$parms,'product');
		
		if($responsetype=='HTML')
		{
			if($products)
			{
				$i=0;
				foreach($products as $product)
				{
					$id="'".$product->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($product->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($product->name, 'OUT').'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($product->displayorder).'</td>';
					if($product->isactive == 1)
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
					if($IISMethods->sanitize($product->img))
					{
						$htmldata.='<div class="dropdown img-dropdown dropleft">';
						$htmldata.='<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick=viewworkouticonimage("'.$IISMethods->sanitize($config->getImageurl().$product->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$product->img).'" class="img-thumbnail bg-web-dark"></a>';
						$htmldata.='<div class="dropdown-menu img-popover-content bg-web-dark" aria-labelledby="tableDropdown3">';
						$htmldata.='<a href="javascript:void(0)" onclick=viewimgimage("'.$IISMethods->sanitize($config->getImageurl().$product->img).'")><img src="'.$IISMethods->sanitize($config->getImageurl().$product->img).'"></a>';
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
				$htmldata.=file_get_contents($config-> getNoDataFound());
				$message=$errmsg['nodatafound'];
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($products);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($products)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($products); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($products);
		$response['showentries']=$showentries;
	}    

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblproduct where id=:id";
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
			$DB->executedata('u','tblproduct',$insqry,$extraparams);

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

  