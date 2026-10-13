<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/couponmaster.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertcouponmaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$id=$IISMethods->sanitize($_POST['id']);
		$packageid = $IISMethods->sanitize($_POST['mainpackageid']);
		$type = $IISMethods->sanitize($_POST['type']);
		$packagename = $IISMethods->sanitize($_POST['packagename']);
		$discounttype = $IISMethods->sanitize($_POST['discounttype']);
		$couponcode = $IISMethods->sanitize($_POST['couponcode']);
		$couponamt = $IISMethods->sanitize($_POST['couponamt']);
		$startdate = $IISMethods->sanitize($_POST['startdate']);
		$expirydate = $IISMethods->sanitize($_POST['expirydate']);
		$minimumspend = $IISMethods->sanitize($_POST['minimumspend']);
		$maximumspend = $IISMethods->sanitize($_POST['maximumspend']);
		$limitpercoupon = $IISMethods->sanitize($_POST['limitpercoupon']);
		$limitperuser = $IISMethods->sanitize($_POST['limitperuser']);
		$statusid = $_POST['statusid'];

		$showonweb=0;
		if($_POST['showonweb']==1){
			$showonweb=1;
		}
		$datetime=$IISMethods->getdatetime();
		if( $discounttype && $couponcode && $couponamt && $startdate && $expirydate && $minimumspend && $maximumspend)
		{			
			$insqry=array(					
				'packageid'=>$packageid,
				'type'=>$type,
				'packagename'=>$packagename,
				'discounttype'=>$discounttype,					
				'couponcode'=>$couponcode,
				'couponamt'=>$couponamt,
				'startdate'=>$startdate,
				'expirydate'=>$expirydate,
				'minispend'=>$minimumspend,
				'maxspend'=>$maximumspend,
				'limitpercoupon'=>$limitpercoupon,
				'limitperuser'=>$limitperuser,
				'statusid'=>$statusid,
				'showonweb'=>$showonweb,

			);

			if($formevent=='addright')
			{
				$qrychk="SELECT couponcode from tblcouponmaster where couponcode=:couponcode";
				$parms = array(
					':couponcode'=>$couponcode,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$unqid = $IISMethods->generateuuid();
					$insqry['id']=$unqid;	
					$insqry['timestamp']=$IISMethods->getdatetime();
					$insqry['entry_uid']=$uid;	
					$insqry['entry_date']=$datetime;

					$DB->executedata('i','tblcouponmaster',$insqry,'');

					$status=1;
					$message=$errmsg['insert'];
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT couponcode from tblcouponmaster where couponcode=:couponcode AND id<>:id";
				$parms = array(
					':couponcode'=>$couponcode,
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
					$DB->executedata('u','tblcouponmaster',$insqry,$extraparams);

					$status=1;
					$message=$errmsg['update'];
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletecouponmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="select id from tblcouponmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			$row=$result_ary[0];

			// if($row['tem'] > 0)
			// {
			// 	$status=0;
			// 	$message=$errmsg['inuse'];
			// }
			// else
			// {
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblcouponmaster','',$extraparams);
				$status=1;
				$message=$errmsg['delete'];
			// }
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];
				$qrychk="select id from tblcouponmaster where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				// if($row['tem'] > 0)
				// {
				// 	$usemenu.=$row['name'].",";
				// }
				// else
				// {
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblcouponmaster','',$extraparams);
				// }
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
	else if($action=='editcouponmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT id,packageid,packagename,`type`,couponcode,couponamt,discounttype,startdate,expirydate,minispend,maxspend,limitpercoupon,limitperuser,statusid,showonweb from tblcouponmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['packageid']=$IISMethods->sanitize($row['packageid']);
				$response['packagename']=$IISMethods->sanitize($row['packagename']);
				$response['type']=$IISMethods->sanitize($row['type']);
				$response['couponcode']=$IISMethods->sanitize($row['couponcode'],'OUT');
				$response['couponamt']=$IISMethods->sanitize($row['couponamt']);
				$response['discounttype']=$IISMethods->sanitize($row['discounttype']);
				$response['startdate']=$IISMethods->sanitize($row['startdate']);
				$response['expirydate']=$IISMethods->sanitize($row['expirydate']);
				$response['minispend']=$IISMethods->sanitize($row['minispend']);
				$response['maxspend']=$IISMethods->sanitize($row['maxspend']);
				$response['limitpercoupon']=$IISMethods->sanitize($row['limitpercoupon']);
				$response['limitperuser']=$IISMethods->sanitize($row['limitperuser']);
				$response['statusid']=$IISMethods->sanitize($row['statusid']);
				$response['showonweb']=$IISMethods->sanitize($row['showonweb']);

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
	else if($action=='listcouponmaster')   
	{
		$couponmasters=new couponmaster();
		$qry="SELECT DISTINCT cm.timestamp AS primary_date,cm.id,cm.`packagename`,cm.`type`,cm.couponcode,cm.couponamt,cm.discounttype,cm.startdate,cm.expirydate,cm.minispend,cm.maxspend,cm.limitpercoupon,cm.limitperuser,cm.statusid,
		CASE 
			WHEN (cm.type = 1) THEN 'Monthly'
			WHEN (cm.type = 2) THEN 'Yearly'
			ELSE ''
			END AS typename,
		CASE 
			WHEN (cm.discounttype = 1) THEN 'Rupees'
			WHEN (cm.discounttype = 2) THEN 'Percentage'
			ELSE ''
			END AS discounttype,cm.showonweb	 
		FROM tblcouponmaster cm
		where couponcode like :filter or packagename like :filter  or  couponamt like :filter or startdate like :filter or expirydate like :filter or minispend like :filter or maxspend like :filter or
		CASE 
			WHEN (cm.discounttype = 1) THEN 'Rupees'
			WHEN (cm.discounttype = 2) THEN 'Percentage'
			ELSE ''
			END like :filter or
		CASE 
			WHEN (cm.type = 1) THEN 'Monthly'
			WHEN (cm.type = 2) THEN 'Yearly'
			ELSE ''
			END  like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$couponmasters=$DB->getmenual($qry,$parms,'couponmaster');
		// echo $qry;
		if($responsetype=='HTML')
		{
			if($couponmasters)
			{
				$i=0;
				foreach($couponmasters as $couponmaster)
				{
					$id="'".$couponmaster->id."'";
					$htmldata.='<tr data-index="'.$couponmaster->id.'">';
			
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
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$couponmaster->id.'" value="'.$IISMethods->sanitize($couponmaster->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$couponmaster->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($couponmaster->packagename).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($couponmaster->typename).'</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Coupon Details" onclick="viewcoupondata('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($couponmaster->couponcode).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($couponmaster->discounttype).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($couponmaster->couponamt).'</td>';
					$htmldata.='<td class="tbl-name">Start Date : <span>'.$IISMethods->sanitize($couponmaster->startdate).'</span><br/>Expiry Date : <span>'.$IISMethods->sanitize($couponmaster->expirydate).'</span></td>';
					$htmldata.='<td class="tbl-name">Maximum Spend : <span>'.$IISMethods->sanitize($couponmaster->maxspend).'</span><br/>Minimum Spend : <span>'.$IISMethods->sanitize($couponmaster->minispend).'</span></td>';
					$htmldata.='<td class="tbl-info">0';
						// if($couponmaster->couponusedcount>0){
						// 	$htmldata.='<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Coupon Used" onclick="viewcouponused('.$IISMethods->sanitize($id).')">';
						// 		$htmldata.=$IISMethods->sanitize($couponmaster->couponusedcount);
						// 	$htmldata.='</a>';
						// }
						// else{
						// 	$htmldata.=$IISMethods->sanitize($couponmaster->couponusedcount);
						// }
					$htmldata.='</td>';
					if(((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
					{
						if($couponmaster->statusid==1)
						{
							$htmldata.='<td class="tbl-info text-left"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changecouponstatus('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-info text-left"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changecouponstatus('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						if($couponmaster->showonweb==1)
						{
							$htmldata.='<td class="tbl-info text-left"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changecouponshowonweb('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-info text-left"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changecouponshowonweb('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
					
					}
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($couponmasters)<=0)
				{
					$htmldata.=file_get_contents($config-> getNoDataFound());
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($couponmasters);
		}

		$common_listdata=$couponmasters;
	}
	else if($action=='changecouponstatus')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qrychk="select statusid from tblcouponmaster where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];
				if($row['statusid']==1)
				{
					$statusid=0;
				}
				else
				{
					$statusid=1;
				}
				$insqry['statusid']=$statusid;
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblcouponmaster',$insqry,$extraparams);

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
	else if($action=='changecouponshowonweb')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qrychk="select showonweb from tblcouponmaster where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];
				if($row['showonweb']==1)
				{
					$showonweb=0;
				}
				else
				{
					$showonweb=1;
				}
				$insqry['showonweb']=$showonweb;
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblcouponmaster',$insqry,$extraparams);

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
	else if($action == 'grandom')
	{
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'),range('A', 'Z'));

		for ($i = 0; $i < 5; $i++) {
			$key .= $keys[array_rand($keys)];
		}


		$response['couponcode']=$IISMethods->sanitize($key);
		$status=1;
		$message=$errmsg['success'];
		
	} 
	else if($action=='viewcoupondata')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT DISTINCT cm.timestamp AS primary_date,cm.id,cm.`packagename`,cm.`type`,cm.couponcode,cm.couponamt,cm.discounttype,cm.startdate,cm.expirydate,cm.minispend,cm.maxspend,cm.limitpercoupon,cm.limitperuser,cm.statusid,
			CASE 
				WHEN (cm.type = 1) THEN 'Monthly'
				WHEN (cm.type = 2) THEN 'Yearly'
				ELSE ''
				END AS typename	 
			FROM tblcouponmaster cm
			where cm.id=:id";
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

				
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Package Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['packagename'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Type <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['typename'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Coupon Code <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['couponcode'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Discount type <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['discounttype'].'</b></label>';
					$tbldata.='</div></div></div>';
					

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Coupon Amount <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['couponamt'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Start Date <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['startdate'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Expiry Date <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['expirydate'].'</b></label>';
					$tbldata.='</div></div></div>';
					

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Maximum Spend <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['maxspend'].'</b></label>';
					$tbldata.='</div></div></div>';
				

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Minimum Spend <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['minispend'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Limit Per Coupon<span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['limitpercoupon'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Limit Per User <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['limitperuser'].'</b></label>';
					$tbldata.='</div></div></div>';
					


				

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

  