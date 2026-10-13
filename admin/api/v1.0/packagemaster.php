<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/packagemaster.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	if($action=='fillpackagefeatures')
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$id=$IISMethods->sanitize($_POST['id']);

		
		$query="SELECT pf.id,pf.pfid,pf.name,pf.printname,pf.displayorder,pf.isactive,pf.haslimit,pf.withinputbox,pf.inputboxlabel,
				ifnull((SELECT pd.attributeval FROM tblpackagedetails pd WHERE pd.pfid=pf.pfid AND pd.packageid=:packageid1),0) AS  attributeval,
				ifnull((SELECT pd.isnolimit FROM tblpackagedetails pd WHERE pd.pfid=pf.pfid AND pd.packageid=:packageid2),0) AS  isnolimit,
				ifnull((SELECT pd.limitvalue FROM tblpackagedetails pd WHERE pd.pfid=pf.pfid AND pd.packageid=:packageid3),0) AS  limitvalue
				FROM tblpackagefeatures pf 
				WHERE pf.isactive=1 
				ORDER BY pf.displayorder";
		$params=array(':packageid1'=>$id,':packageid2'=>$id,':packageid3'=>$id);
		$result=$DB->getmenual($query,$params);
		if($responsetype=='HTML')
		{
			if(sizeof($result)>0) 
			{
				$htmldata.='<div class="widget">';
				$htmldata.='<div class="widget-content row mt-3">';

				
				
				for($i=0;$i<sizeof($result);$i++)
				{
					$row=$result[$i];

					
					$canchkno='checked';
					$canchkyes='';


					$isnolimitDiv='d-none';
					$isnolimit="";
					$limitvalueDiv='d-none';
					$limitvalue=0;

					
					if($formevent=='editright')
					{
						
						if($row['attributeval']==1)
						{
							$canchkno='';
							$canchkyes='checked';
						}
						if($row['attributeval']==1)
						{
						//  echo 2;
							// $canchkno='checked';
							
							$isnolimitDiv='';
							if($row['isnolimit']==1)
							{
								//  echo 3;
								$isnolimit="checked";
								$limitvalueDiv='d-none';
								$limitvalue=0;
							}
							else
							{
								//  echo 4;
								$limitvalueDiv='';
								$limitvalue=$row['limitvalue'];
							}
							
							
						}
						// if($row['pfid'] == '9')
						// {
						// 	if($row['attributeval']==1)
						// 	{
						// 		$canchkno='checked';
								
						// 		$isnolimitDiv='';
						// 		$limitvalue='';
						// 		// echo $row['isnolimit'];
						// 		if($row['isnolimit']==1)
						// 		{
									
						// 			$isnolimit="checked";
						// 			$limitvalueDiv='d-none';
						// 			$limitvalue=0;
						// 		}
						// 		else
						// 		{
						// 			$limitvalueDiv='';
						// 			$limitvalue=$row['limitvalue'];
						// 		}
						// 	}
						// }
							
					

					}
				
					

					$htmldata.='<input type="hidden" name="pfid[]" id="pfid'.$row['pfid'].'" value="'.$row['pfid'].'">';
					$htmldata.='<input type="hidden" name="haslimit[]" id="haslimit'.$row['pfid'].'" value="'.$row['haslimit'].'">';
					$htmldata.='<input type="hidden" name="withinputbox[]" id="withinputbox'.$row['pfid'].'" value="'.$row['withinputbox'].'">';

					$htmldata.='<div class="col-12 col-sm-6 col-md-6 col-lg-3">';
					$htmldata.='<div class="input-group mb-0">';
					$htmldata.='<label class="mb-1">'.$row['name'].'</label>';
					$htmldata.='</div>';
					$htmldata.='<div class="input-group mt-2">';

					if($row['pfid'] == '9' && $formevent=='addright')
					{
					
					$htmldata.='<div class="radio radio-success radio-inline mr-5">';
					$htmldata.='<input type="radio" id="yes'.$row['pfid'].'" value="1" class="loginlimit" '.$canchkno.' data-pfid="'.$row['pfid'].'" data-haslimit="'.$row['haslimit'].'" data-withinputbox="'.$row['withinputbox'].'" name="can'.$row['pfid'].'">';
					$htmldata.='&nbsp;<label for="yes'.$row['pfid'].'">Yes</label>';
					$htmldata.='</div>';

					}
					else{
						$htmldata.='<div class="radio radio-success radio-inline mr-5">';
						$htmldata.='<input type="radio" id="yes'.$row['pfid'].'" value="1" class="clsynradiobtn" '.$canchkyes.' data-pfid="'.$row['pfid'].'" data-haslimit="'.$row['haslimit'].'" data-withinputbox="'.$row['withinputbox'].'" name="can'.$row['pfid'].'">';
						$htmldata.='&nbsp;<label for="yes'.$row['pfid'].'">Yes</label>';
						$htmldata.='</div>';
					}

					if($row['pfid'] != '9')
					{
					$htmldata.='<div class="radio radio-success radio-inline">';
					$htmldata.='<input type="radio" id="no'.$row['pfid'].'" value="0" class="clsynradiobtn" '.$canchkno.' data-pfid="'.$row['pfid'].'" data-haslimit="'.$row['haslimit'].'" data-withinputbox="'.$row['withinputbox'].'" name="can'.$row['pfid'].'">';
					$htmldata.='&nbsp;<label for="no'.$row['pfid'].'">No</label>';
					$htmldata.='</div>';
					}
					
					if($row['haslimit']==1)
					{
						$htmldata.='&nbsp;&nbsp;';
						$htmldata.='<div class="custom-control custom-checkbox m-0 isnolimitDiv'.$row['pfid'].' '.$isnolimitDiv.'">';
						$htmldata.='<input type="checkbox" class="custom-control-input d-none clsisnolimitchkbox" '.$isnolimit.' data-withinputbox="'.$row['withinputbox'].'" data-haslimit="'.$row['haslimit'].'" data-pfid="'.$row['pfid'].'" id="isnolimit'.$row['pfid'].'" name="isnolimit'.$row['pfid'].'" value="1">';
						$htmldata.='<label class="custom-control-label mb-0" for="isnolimit'.$row['pfid'].'">No Limit</label>';
						$htmldata.='</div>';
					}
					
					$htmldata.='</div>';
					$htmldata.='</div>';
					if($row['withinputbox']==1)
					{
						$htmldata.='<div class="col-3 limitvalueDiv'.$row['pfid'].' '.$limitvalueDiv.'">';
						$htmldata.='<div class="input-group">';
						$htmldata.='<label class="mb-1">'.$row['inputboxlabel'].' <span class="text-danger">*</span></label>';
						$htmldata.='<label class="ml-auto "></label>';
						$htmldata.='</div>';
						$htmldata.='<div class="input-group mb-3">';
						$htmldata.='<input type="text" id="limitvalue'.$row['pfid'].'" value="'.$limitvalue.'" onkeypress="numbonly(event)" onpaste="numbonly(event)" autocomplete="off" name="limitvalue'.$row['pfid'].'" class="form-control" placeholder="Enter '.$row['inputboxlabel'].' Value" />';
						$htmldata.='</div>';
						$htmldata.='</div>';
					}	

				}
				$htmldata.='</div>';
				$htmldata.='</div>';

				$status=1;
				$message=$errmsg['success'];
			}
			$response['data']=$htmldata;
		}	
		

	}
	else if($action=='insertpackagemaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);


		$packagename=$IISMethods->sanitize($_POST['packagename']);
		$monthlyprice=$IISMethods->sanitize($_POST['monthlyprice']);
		$yearlyprice=$IISMethods->sanitize($_POST['yearlyprice']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);

		// Features Array
		$pfid=$_POST['pfid'];
		$haslimit=$_POST['haslimit'];
		$withinputbox=$_POST['withinputbox'];

		

		$colorcode=$IISMethods->sanitize($_POST['colorcode']);
		$termsconditionid=$IISMethods->sanitize($_POST['termsconditionid']);
		$termscondition=$_POST['termscondition'];
		$shortdescr=$_POST['shortdescr'];
		$descr=$_POST['descr'];


		$id=$IISMethods->sanitize($_POST['id']);

		if($packagename && $monthlyprice && $yearlyprice && $displayorder && $colorcode && $termsconditionid && $termscondition && $shortdescr && $descr && sizeof($pfid)>0)
		{
			$annualysaveprice=($monthlyprice*12)-$yearlyprice;

			$insqry=array(
				'packagename'=>$packagename,
				'monthlyprice'=>$monthlyprice,
				'annualyprice'=>$yearlyprice,
				'annualysaveprice'=>$annualysaveprice,
				'colorcode'=>$colorcode,
				'termsconditionid'=>$termsconditionid,
				'termscondition'=>$termscondition,
				'shortdescr'=>$shortdescr,
				'descr'=>$descr,
				'displayorder'=>$displayorder
				
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT packagename from tblpackagemaster where packagename=:packagename";
				$parms = array(
					':packagename'=>$packagename,
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
					$insqry['isactive']=1;
					$insqry['timestamp']=$IISMethods->getdatetime();		
					$insqry['entry_uid']=$uid;	
					$insqry['entry_date']=$IISMethods->getdatetime();

					$DB->executedata('i','tblpackagemaster',$insqry,'');

					if(sizeof($pfid)>0)
					{
						for($i=0;$i<sizeof($pfid);$i++)
						{
							$ins_id=$pfid[$i];
							$can=$_POST['can'.$ins_id];
							
							$canadd=0;
							$canlimit=0;
							$limitvalue=0;
							
							if($can==1)
							{
								$canadd=1;
							}
							if($canadd==1)
							{
								$isnolimit=$_POST['isnolimit'.$ins_id];
								if($isnolimit==1)
								{
									$canlimit=1;
								}
								
								if($canlimit==0)
								{
									if($_POST['limitvalue'.$ins_id]>0) 
									{
										$limitvalue=$_POST['limitvalue'.$ins_id];
									}
									
								}
							}	
							

							
							$unqdetailid = $IISMethods->generateuuid();
							$insdetail=array(
								'id'=>$unqdetailid,
								'packageid'=>$unqid,
								'pfid'=>$ins_id,
								'attributeval'=>$canadd,
								'isnolimit'=>$canlimit,
								'limitvalue'=>$limitvalue,
								'entry_uid'=>$uid,
								'entry_date'=>$IISMethods->getdatetime(),
								'timestamp'=>$IISMethods->getdatetime(),
							);
							$DB->executedata('i','tblpackagedetails',$insdetail,'');
						}
					}

					
					$status=1;
					$message=$errmsg['insert'];
					
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT packagename from tblpackagemaster where packagename=:packagename AND id<>:id";
				$parms = array(
					':packagename'=>$packagename,
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
					$insqry['update_date']=$IISMethods->getdatetime();

					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('u','tblpackagemaster',$insqry,$extraparams);

					$extraparamsdel=array(
						'packageid'=>$id
					);
					$DB->executedata('d','tblpackagedetails','',$extraparamsdel);

					if(sizeof($pfid)>0)
					{
						for($i=0;$i<sizeof($pfid);$i++)
						{
							$ins_id=$pfid[$i];
							$can=$_POST['can'.$ins_id];
							
							$canadd=0;
							$canlimit=0;
							$limitvalue=0;
							
							if($can==1)
							{
								$canadd=1;
							}
							if($canadd==1)
							{
								$isnolimit=$_POST['isnolimit'.$ins_id];
								if($isnolimit==1)
								{
									$canlimit=1;
								}
								
								if($canlimit==0)
								{
									if($_POST['limitvalue'.$ins_id]>0) 
									{
										$limitvalue=$_POST['limitvalue'.$ins_id];
									}
								}
							}
							

							
							$unqdetailid = $IISMethods->generateuuid();
							$insdetail=array(
								'id'=>$unqdetailid,
								'packageid'=>$id,
								'pfid'=>$ins_id,
								'attributeval'=>$canadd,
								'isnolimit'=>$canlimit,
								'limitvalue'=>$limitvalue,
								'entry_uid'=>$uid,
								'entry_date'=>$IISMethods->getdatetime(),
								'timestamp'=>$IISMethods->getdatetime(),
							);
							$DB->executedata('i','tblpackagedetails',$insdetail,'');
						}
					}
				
					$status=1;
					$message=$errmsg['update'];
					
					
				}
			}
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletepackagemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="SELECT p.id,CASE WHEN (pa.id !='') THEN 1 ELSE 0 END AS tem 
			from tblpackagemaster p
			left join tblpackageassign pa on pa.packageid=p.id
			where p.id=:id";
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
				$extraparamsdel=array(
					'packageid'=>$id
				);
				$DB->executedata('d','tblpackagedetails','',$extraparamsdel);
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblpackagemaster','',$extraparams);

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

				$qrychk="SELECT p.id,CASE WHEN (pa.id !='') THEN 1 ELSE 0 END AS tem 
				from tblpackagemaster p
				left join tblpackageassign pa on pa.packageid=p.id
				where p.id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];

				if($row['tem'] > 0)
				{
					$usemenu.="";
				}
				else
				{
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblpackagemaster','',$extraparams);

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
	else if($action=='editpackagemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select * from tblpackagemaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);


			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['packagename']=$IISMethods->sanitize($row['packagename']);
				$response['monthlyprice']=$IISMethods->sanitize($row['monthlyprice']);
				$response['annualyprice']=$IISMethods->sanitize($row['annualyprice']);
				$response['annualysaveprice']=$IISMethods->sanitize($row['annualysaveprice']);
				$response['colorcode']=$IISMethods->sanitize($row['colorcode']);
				$response['termsconditionid']=$IISMethods->sanitize($row['termsconditionid']);
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				$response['termscondition']=$IISMethods->sanitize($row['termscondition'],'OUT');
				$response['shortdescr']=$IISMethods->sanitize($row['shortdescr'],'OUT');
				$response['descr']=$IISMethods->sanitize($row['descr'],'OUT');

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
	else if($action=='listpackagemaster')   
	{
		//error_reporting(1);
		$packagemasters=new packagemaster();
		$qry="select cm.timestamp as primary_date,cm.id,cm.packagename,cm.isactive,cm.ispopular,cm.monthlyprice,cm.annualyprice,cm.colorcode,cm.displayorder
			 from tblpackagemaster cm
			 where (cm.packagename like :packagenamefilter or cm.monthlyprice like :monthlypricefilter or cm.annualyprice like :annualypricefilter or cm.colorcode like :colorcodefilter or cm.displayorder like :displayorderfilter) ";
		$parms = array(
			':packagenamefilter'=>$filter,
			':monthlypricefilter'=>$filter,
			':annualypricefilter'=>$filter,
			':colorcodefilter'=>$filter,
			':displayorderfilter'=>$filter,
		);

		$qry.=" order by $ordbycolumnname $ordby LIMIT $start, $per_page ";
		
		$packagemasters=$DB->getmenual($qry,$parms,'packagemaster');
		
		if($responsetype=='HTML')
		{
			if($packagemasters)
			{
				$i=0;
				foreach($packagemasters as $packagemaster)
				{
					$id="'".$packagemaster->id."'";
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
					if((($rightstotalcount)>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-check d-none">';
						$htmldata.='<div class="text-center">';
						$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
						$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($packagemaster->id).'" name="bulkdelete[]">';
						$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Package Details" onclick="viewpackagedata('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($packagemaster->packagename).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($packagemaster->monthlyprice).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($packagemaster->annualyprice).'</td>';
					$htmldata.='<td class="tbl-name"><div style="background-color:'.$IISMethods->sanitize($packagemaster->colorcode).';height: 20px;width: 20px;"></div></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($packagemaster->displayorder).'</td>';
					if($packagemaster->isactive == 1)
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
					if($packagemaster->ispopular == 1)
					{
						$htmldata.='<td class="tbl-name text-center"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="ispopular('.$id.')" checked>';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}
					else
					{
						$htmldata.='<td class="tbl-name text-center"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="ispopular('.$id.')">';
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
				$htmldata.=file_get_contents($config-> getNoDataFound());
				$message=$errmsg['nodatafound'];
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($packagemasters);
		}

		$common_listdata=$packagemasters;
	} 
	else if($action=='filltermsandconditions')   
	{
		$qry="select id,termname,description from tbltermscondition";
		$parms = array();
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			$htmldata.='<option value="">Select Terms & Condition</option>';
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];
				$htmldata.='<option value="'.$row['id'].'">'.$row['termname'].'</option>';
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='filltermsdata')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$qry="select id,termname,description from tbltermscondition WHERE id=:id";
		$parms = array(':id'=>$id);
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			$htmldata=$result_ary[0]['description'];
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='viewpackagedata')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select`id`,`packagename`,`monthlyprice`,`annualyprice`,`annualysaveprice`,`colorcode`,`termsconditionid`,
			`termscondition`,`shortdescr`,`descr`,`displayorder`,`isactive`,`ispopular`,`entry_uid`,
			`entry_date`,`update_uid`,`update_date`,`TIMESTAMP`
		  	from `tblpackagemaster` cm
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

				$tbldata.='<div class="row">';
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Package Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['packagename'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Monthly Price <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['monthlyprice'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Yearly Price <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['annualyprice'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Display Order <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['displayorder'].'</b></label>';
					$tbldata.='</div></div></div>';
				$tbldata.='</div>';	

				$tbldata.='<div class="row">';
					$tbldata.='<div class="col-12 col-lg-12 col-xl-12">';
						$tbldata.='<div class="row">';

						$querypd="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.haslimit,pf.withinputbox
						FROM `tblpackagedetails` pd
						inner join tblpackagefeatures pf on pf.pfid=pd.pfid
						WHERE pd.packageid=:packageid";
						$paramspd=array(':packageid'=>$id);
						$respd=$DB->getmenual($querypd,$paramspd);
						if(sizeof($respd)>0) 
						{
							$tbldata.='<table class="table table-bordered">
								<thead>
									<tr>
										
									</tr>
									
								</thead>
								<tbody>';
									for($i=0;$i<sizeof($respd);$i++)
									{
										$rowpd=$respd[$i];
									
										$tbldata.='<tr>
											<th class="tbl-name">'.$rowpd['pfname'].'</th>
											<td class="tbl-name">';
											if($rowpd['attributeval']==1)
											{
												$tbldata.='Yes';
											}else {$tbldata.='No';}
											if($rowpd['attributeval']==1)
											{
												if($rowpd['haslimit']==1)
												{
													if($rowpd['isnolimit']==1)
													{
														$tbldata.=' (Unlimited)';
													}	
													else
													{
														$tbldata.=' (Limited | '.$rowpd['limitvalue'].')';
													}
												}	
											}	
											$tbldata.='</td>
										</tr>';
									}	
								
								$tbldata.='</tbody>
							</table>';
						}	
				
					$tbldata.='</div></div></div>';

				$tbldata.='<div class="row">';
					$tbldata.='<div class="col-12 col-lg-12 col-xl-12 " style="border-top:1px solid #e0e6ed;"><div class="row">';
					$tbldata.='<div class="col-12 col-sm-12 col-lg-12 text-dot-right pr-sm-0">';
					$tbldata.='<label><b>Terms And Conditions </b></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-12 col-lg-12">';
					$tbldata.='<label class="label-view"><b>'.$row['termscondition'].'</b></label>';
					$tbldata.='</div></div></div>';


					$tbldata.='<div class="col-12 col-lg-12 col-xl-12 " style="border-top:1px solid #e0e6ed;"><div class="row">';
					$tbldata.='<div class="col-12 col-sm-12 col-lg-12 text-dot-right pr-sm-0">';
					$tbldata.='<label><b>Short Description</b></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-12 col-lg-12">';
					$tbldata.='<label class="label-view"><b>'.$row['shortdescr'].'</b></label>';
					$tbldata.='</div></div></div>';


					$tbldata.='<div class="col-12 col-lg-12 col-xl-12 " style="border-top:1px solid #e0e6ed;"><div class="row">';
					$tbldata.='<div class="col-12 col-sm-12 col-lg-12 text-dot-right pr-sm-0">';
					$tbldata.='<label><b>Description</b></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-12 col-lg-12">';
					$tbldata.='<label class="label-view"><b>'.$row['descr'].'</b></label>';
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
	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblpackagemaster where id=:id";
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
			$DB->executedata('u','tblpackagemaster',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='ispopular')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{		
			try 
			{
				$DB->begintransaction();

				$qry = "SELECT ispopular FROM tblpackagemaster WHERE id = :id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qry,$parms);
				$row=$result_ary[0];

				$ispopular=1;
			
				$insqry['ispopular']=$ispopular;	
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblpackagemaster',$insqry,$extraparams);


				$subqry = "SELECT id FROM tblpackagemaster WHERE id <> :id";
				$subparms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($subqry,$subparms);

				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$subrow=$result_ary[$i];
					$id= $IISMethods->sanitize($subrow['id']);
					$insqry['ispopular']=0;	
					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('u','tblpackagemaster',$insqry,$extraparams);
				}



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
	 
}



require_once dirname(__DIR__, 3).'/config/apifoot.php';

?>

  