<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/product.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertproductmaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$IISMethods->sanitize($_POST['name']);
		$categoryid=$IISMethods->sanitize($_POST['categoryid']);
		// $buyerfrom=$IISMethods->sanitize($_POST['buyerfrom']);
		$brandid=$IISMethods->sanitize($_POST['brandid']);
		$brandname=$IISMethods->sanitize($_POST['brandname']);
		$shortdescr = $IISMethods->sanitize($_POST['shortdescr']);
		$decription = $_POST['contentdescr'];
		$typeid = $_POST['typeid'];
		// $featureid = $_POST['featureid'];

		$attributeid = $_POST['tblattributeid'];
		$attribute = $_POST['tblattribute'];
		$values = $_POST['tblvalues'];

		$img=$_FILES['img']['name'];
		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($name && $shortdescr && $categoryid && $decription && $brandid )
		{		
			if(sizeof($attributeid)>0)
			{	
				$insqry=array(	
					'categoryid'=>$categoryid,				
					'name'=>$name,
					'shortdescr'=>$shortdescr,	
					'description'=>$decription,
					// 'preferbuyer'=>$buyerfrom,
					'brandid'=>$brandid,
					'brandname'=>$brandname			
				);
				
				if($formevent=='addright')
				{
					$qrychk="SELECT name from tblproductmaster where name=:name";
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
						$productuniqid=$DB->RandomproductUnqId(6);
						$unqid = $IISMethods->generateuuid();
							
						$insqry['id']=$unqid;	
						$insqry['timestamp']=$IISMethods->getdatetime();
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;
						$insqry['productuniqueid']=$productuniqid;

						$DB->executedata('i','tblproductmaster',$insqry,'');

						if(sizeof($typeid)>0)
						{
							for ($j=0; $j<sizeof($typeid); $j++) 
							{
								$subunqid = $IISMethods->generateuuid();
								$datains=array(
									'id'=>$subunqid,
									'productid'=>$unqid,
									'supplytypeid'=>$typeid[$j],
									'entry_date'=>$datetime
								);
								$DB->executedata('i','tblproductsupply',$datains,'');
							}
						}

						/* if(sizeof($featureid)>0)
						{
							for ($j=0; $j<sizeof($featureid); $j++) 
							{
								$subunqid = $IISMethods->generateuuid();
								$datains=array(
									'id'=>$subunqid,
									'productid'=>$unqid,
									'featureid'=>$featureid[$j],
									'entry_date'=>$datetime
								);
								$DB->executedata('i','tblproductfeature',$datains,'');
							}
						} */

						if(sizeof($attributeid)>0)
						{
							for ($j=0; $j<sizeof($attributeid); $j++) 
							{
								$subunqid = $IISMethods->generateuuid();
								$datains=array(
									'id'=>$subunqid,
									'productid'=>$unqid,
									'attributeid'=>$attributeid[$j],
									'attribute'=>$attribute[$j],
									'attributevalue'=>$values[$j],
									'entry_date'=>$datetime
								);
								$DB->executedata('i','tblproductmapping',$datains,'');
							}
						}


						$status=1;
						$message=$errmsg['insert'];
					}
				}
				else if($formevent=='editright')
				{
					$qrychk="SELECT name from tblproductmaster where name=:name and id<>:id";
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
						$insqry['update_uid']=$uid;	
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblproductmaster',$insqry,$extraparams);

						$delparams=array(
							'productid'=>$id
						);
						$DB->executedata('d','tblproductsupply','',$delparams);
						// $DB->executedata('d','tblproductfeature','',$delparams);
						$DB->executedata('d','tblproductmapping','',$delparams);

						if(sizeof($typeid)>0)
						{
							for ($j=0; $j<sizeof($typeid); $j++) 
							{
								$subunqid = $IISMethods->generateuuid();
								$datains=array(
									'id'=>$subunqid,
									'productid'=>$id,
									'supplytypeid'=>$typeid[$j],
									'entry_date'=>$datetime
								);
								$DB->executedata('i','tblproductsupply',$datains,'');
							}
						}

						/* if(sizeof($featureid)>0)
						{
							for ($j=0; $j<sizeof($featureid); $j++) 
							{
								$subunqid = $IISMethods->generateuuid();
								$datains=array(
									'id'=>$subunqid,
									'productid'=>$id,
									'featureid'=>$featureid[$j],
									'entry_date'=>$datetime
								);
								$DB->executedata('i','tblproductfeature',$datains,'');
							}
						} */

						if(sizeof($attributeid)>0)
						{
							for ($j=0; $j<sizeof($attributeid); $j++) 
							{
								$subunqid = $IISMethods->generateuuid();
								$datains=array(
									'id'=>$subunqid,
									'productid'=>$id,
									'attributeid'=>$attributeid[$j],
									'attribute'=>$attribute[$j],
									'attributevalue'=>$values[$j],
									'entry_date'=>$datetime
								);
								$DB->executedata('i','tblproductmapping',$datains,'');
							}
						}

						$status=1;
						$message=$errmsg['update'];
					}
				}		
			}else{
				$message="Please fill product detail";
			}
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deleteproductmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('d','tblproductmaster','',$extraparams);
			$extraparams1=array(
				'productid'=>$id
			);
			$DB->executedata('d','tblproductsupply','',$extraparams1);
			$DB->executedata('d','tblproductmapping','',$extraparams1);
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
				$DB->executedata('d','tblproductmaster','',$extraparams);
				$extraparams1=array(
					'productid'=>$id
				);
				$DB->executedata('d','tblproductsupply','',$extraparams1);
				$DB->executedata('d','tblproductmapping','',$extraparams1);
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
	else if($action=='editproductmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT cm.*,
			IFNULL((SELECT GROUP_CONCAT(DISTINCT ps.supplytypeid) AS typename FROM `tblproductsupply` ps WHERE ps.productid = cm.id),'') AS typeid
			FROM tblproductmaster cm WHERE cm.id = :id";
			$parms = array(
				':id'=>$id,
			);
			// ,IFNULL((SELECT GROUP_CONCAT(DISTINCT ps.featureid) AS typename FROM `tblproductfeature` ps WHERE ps.productid = cm.id),'') AS featureid
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['categoryid']=$IISMethods->sanitize($row['categoryid']);
				$response['name']=$IISMethods->sanitize($row['name'], 'OUT');
				$response['shortdescr']=$IISMethods->sanitize($row['shortdescr'], 'OUT');
				$response['preferbuyer']=$IISMethods->sanitize($row['preferbuyer']);
				$response['description']=$IISMethods->sanitize($row['description'], 'OUT');
				// $response['featureid']=$IISMethods->sanitize($row['featureid']);
				$response['brandid']=$IISMethods->sanitize($row['brandid']);
				$response['typeid']=$IISMethods->sanitize($row['typeid']);

				$wsubqry="SELECT * FROM `tblproductmapping` WHERE productid = :id";
				$wsubparms = array(
					':id'=>$id,
				);
				$wsubresult_ary=$DB->getmenual($wsubqry,$wsubparms);
				if(sizeof($wsubresult_ary)>0)
				{
					$response['datamapping'] = $wsubresult_ary;
				}
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
	else if($action=='listproductmaster')   
	{
		$productmasters=new product();
		$qry="SELECT cm.timestamp AS primary_date,cm.id,cm.name,cm.brandname,cm.isactive,cm.showonhome,cm.categoryid,c.category,
		IFNULL((SELECT GROUP_CONCAT(DISTINCT st.typename) AS typename FROM `tblproductsupply` ps INNER JOIN `tblsupplytypemaster` st ON st.id = ps.supplytypeid WHERE ps.productid = cm.id),'') AS typename
		FROM tblproductmaster cm 
		INNER JOIN tblcategorymaster c on c.id = cm.categoryid
		where cm.name like :filter  OR c.category  like :filter OR cm.brandname like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$productmasters=$DB->getmenual($qry,$parms,'product');
		// ,IFNULL((SELECT GROUP_CONCAT(DISTINCT st.name) AS typename FROM `tblproductfeature` ps INNER JOIN `tblfeaturesmaster` st ON st.id = ps.featureid WHERE ps.productid = cm.id),'') AS features
		if($responsetype=='HTML')
		{
			if($productmasters)
			{
				$i=0;
				foreach($productmasters as $productmaster)
				{
					$id="'".$productmaster->id."'";
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($productmaster->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($productmaster->category).'</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewdescription('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($productmaster->name, 'OUT').'</a></td>';
					// $htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($productmaster->preferbuyer).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($productmaster->brandname).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($productmaster->typename).'</td>';
					$htmldata.='<td class="tbl-name" align="center"><a href="javascript:void(0);" class="btn-tbl '.$IISMethods->sanitize($itemmaster->imgclass).' rounded-circle" id="btnaddimages" data-toggle="tooltip" data-placement="top" title="Add Image" data-original-title="Add Image" onclick="uploaditemimage('.$IISMethods->sanitize($id).')"><i class="bi bi-plus"></i></a></td>';
					if((($rightstotalcount>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
					{
						if($productmaster->isactive == 1)
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

						if($productmaster->showonhome==1)
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changeshowonhomestatus('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changeshowonhomestatus('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
					}
					else
					{
						$htmldata.='<td class="tbl-name text-center"></td>';
						$htmldata.='<td class="tbl-name text-center"></td>';
					}
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($productmasters)<=0)
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
			$response['data']= json_encode($productmasters);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($productmasters)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($productmasters); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($productmasters);
		$response['showentries']=$showentries;
	}    

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblproductmaster where id=:id";
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
			$DB->executedata('u','tblproductmaster',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	//Change Item Status  (Show On Home)
	else if($action=='changeshowonhomestatus')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qrychk="select showonhome from tblproductmaster where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];
				if($row['showonhome']==1)
				{
					$showonhome=0;
				}
				else
				{
					$showonhome=1;
				}
				$insqry['showonhome']=$showonhome;	
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblproductmaster',$insqry,$extraparams);
			
			
				$status=1;
				$message=$errmsg['update'];

				$DB->committransaction();
			}
			catch (Exception $e) 
			{
				$DB->rollbacktransaction($e);
				$status=0;
				$message=$errmsg['dbtransactionerror'];
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	//Insert Item Images
	else if($action=='insertitemimages')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$itemimg=$_FILES['itemimg']['name'];
		$productid=$IISMethods->sanitize($_POST['productid']);

		if($productid && sizeof($itemimg))
		{
			try 
			{
				$DB->begintransaction();

				if(is_array($_FILES)) 
				{
					$isupdimg = 0;
					foreach ($_FILES['itemimg']['name'] as $name => $value)
					{
						if($_FILES['itemimg']['type'][$name] == 'image/jpg'  || $_FILES['itemimg']['type'][$name] == 'image/jpeg' || $_FILES['itemimg']['type'][$name] == 'image/png')
						{
							
							$unqid = $IISMethods->generateuuid();
							$sourcePath = $_FILES['itemimg']['tmp_name'][$name];
							$targetPath = $IISMethods->uploadallfiles(1,'item',$_FILES['itemimg']['name'][$name],$sourcePath,$unqid);

							$insdata = array(
								'id'=>$unqid,
								'productid'=>$productid,
								'image'=>$targetPath,
								'displayorder'=>0,
								'entry_date'=>$IISMethods->getdatetime(),
							);
							$DB->executedata('i','tblproductimage',$insdata,'');
							$isupdimg=1;

						}
					}
				}

				if($isupdimg==1)
				{
					$status=1;
					$message=$errmsg['insert'];
					$response['productid']= $productid;
				}
				else
				{
					$status=0;
					$message=$errmsg['imgrequired'];
				}

				$DB->committransaction();
			}
			catch (Exception $e) 
			{
				$DB->rollbacktransaction($e);
				$status=0;
				$message=$errmsg['dbtransactionerror'];
			}		
		}
		else
		{
			$status=0;
			$message=$errmsg['imgrequired'];
		}
	}
	//Get Uploaded Item Image Details
	else if($action == 'getitemimages')
	{
		$productid=$IISMethods->sanitize($_POST['productid']);
		if($productid)
		{
			$qrysub="select id,productid,image,ifnull(displayorder,0) as displayorder  from tblproductimage where productid=:productid";
			$parms = array(
				':productid'=>$productid,
			);
			$result_subary=$DB->getmenual($qrysub,$parms);
			if(sizeof($result_subary)>0)
			{	
				for($i=0;$i<sizeof($result_subary);$i++)
				{
					$subrow=$result_subary[$i];
					$response['result'][$i]['id']=$IISMethods->sanitize($subrow['id']);
					$response['result'][$i]['productid']=$IISMethods->sanitize($subrow['productid']);
					$response['result'][$i]['displayorder']=$IISMethods->sanitize($subrow['displayorder']);
					$response['result'][$i]['imgpath']=$IISMethods->sanitize($config->getImageurl().$subrow['image']);
				}
				
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
				
			}
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	//Remove Item Image
	else if($action == 'removeitemimage')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$productid=$IISMethods->sanitize($_POST['productid']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qryimg="select id,image from tblproductimage where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				$row=$resimg[0];
				if($row['image'])
				{
					unlink($config->getImageurl().$row['image']);
				}
				
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblproductimage','',$extraparams);


				$response['productid']= $productid;
				$status=1;
				$message=$errmsg['delete'];

				$DB->committransaction();
			}
			catch (Exception $e) 
			{
				$DB->rollbacktransaction($e);
				$status=0;
				$message=$errmsg['dbtransactionerror'];
			}
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}

	}
	//Change Item Image Display Order
	else if($action == 'changeitemimgdiplayorder')
	{
		$id=$IISMethods->sanitize($_POST['imgid']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$productid=$IISMethods->sanitize($_POST['productid']);

		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$updqry=array(
					'displayorder'=>$displayorder,
				);
				
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblproductimage',$updqry,$extraparams);

				$response['productid']= $productid;

				$status=1;
				$message=$errmsg['update'];

				$DB->committransaction();
			}
			catch (Exception $e) 
			{
				$DB->rollbacktransaction($e);
				$status=0;
				$message=$errmsg['dbtransactionerror'];
			}
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='showaboutdescription')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			// ,IFNULL((SELECT GROUP_CONCAT(DISTINCT st.name) AS typename FROM `tblproductfeature` ps INNER JOIN `tblfeaturesmaster` st ON st.id = ps.featureid WHERE ps.productid = ta.id),'') AS features
			$qrychk="SELECT ta.*,c.category,
					IFNULL((SELECT GROUP_CONCAT(DISTINCT st.typename) AS typename FROM `tblproductsupply` ps INNER JOIN `tblsupplytypemaster` st ON st.id = ps.supplytypeid WHERE ps.productid = ta.id),'') AS typename
					FROM tblproductmaster ta 
					INNER JOIN tblcategorymaster c ON c.id = ta.categoryid
					WHERE ta.id = :id";
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

					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Product Title <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['name'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Brand <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['brandname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Category <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['category'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Supply Type <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['typename'].'</b></label>';
					$tbldata.='</div></div></div>';

					/* $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Features <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['features'].'</b></label>';
					$tbldata.='</div></div></div>'; */

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Short Description <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='</div></div></div>';
					$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-12 text-dot-right">';
					$tbldata.='<label class="label-view"><b>'.$row['shortdescr'].'</b></label>';
					$tbldata.='</div>';
					$tbldata.='</div></div>';

					$qry="SELECT * FROM `tblproductmapping` WHERE productid = :id";
					$parms = array(
						':id'=>$id,
					);
					$compitems=$DB->getmenual($qry,$parms);
					if($compitems)
					{
						$tbldata.='<div class="col-lg-12 col-md-12 col-12 layout-spacing">';
							$tbldata.='<div class="widget mt-10">';
								$tbldata.='<div class="widget-title  mb-2"><b>Product Detail</b></div>';
								$tbldata.='<div class="widget-content row">';

									$tbldata.='<div class="col-12 col-sm-6 col-md-12 col-lg-12">';
									$tbldata.='<div class="row1">';
									$tbldata.='<div class="table-responsive pt-2">';
									$tbldata.='<div class="col-12 p-0">';
									$tbldata.='<table id="tabviewlevesselmappricing" class="table table-bordered table-hover table-striped">';
									$tbldata.='<thead>';
									$tbldata.='<tr>';
									$tbldata.='<th>Attribute</th>';
									$tbldata.='<th>Attribute Value</th>';
									$tbldata.='</tr>';
									$tbldata.='</thead>';
									$tbldata.='<tbody id="tblviewdataprice">';
									
									$htmldata1='';
									for($i=0;$i<sizeof($compitems);$i++)
									{	
										$subrow=$compitems[$i];
										$tbldata.='<tr>';
										$tbldata.='<td>'.$IISMethods->sanitize($subrow['attribute']).'</td>';
										$tbldata.='<td>'.$IISMethods->sanitize($subrow['attributevalue']).'</td>';
										
										$tbldata.='</tr>';
									}
									$tbldata.='</tbody>';
									$tbldata.='</table>';
									$tbldata.='</div>';
									$tbldata.='</div>';
									$tbldata.='</div>';
									$tbldata.='</div>';


								$tbldata.='</div>';
							$tbldata.='</div>';
						$tbldata.='</div>';
						
						
						$status=1;
						$message=$errmsg['success'];
					}

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Description <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='</div></div></div>';
					$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-12 text-dot-right">';
					$tbldata.='<label class="label-view"><b>'.$row['description'].'</b></label>';
					$tbldata.='</div>';
					$tbldata.='</div></div>';
					

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

  