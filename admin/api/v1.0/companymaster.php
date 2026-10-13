<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/companymaster.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertcompanymaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$companytypeid=$IISMethods->sanitize($_POST['companytypeid']);
		$companyname=$IISMethods->sanitize($_POST['companyname']);
		$shortname=$IISMethods->sanitize($_POST['shortname']);
		$prefix=$IISMethods->sanitize($_POST['prefix']);
		$contact1=$IISMethods->sanitize($_POST['contact1']);
		$contact2=$IISMethods->sanitize($_POST['contact2']);
		$contact3=$IISMethods->sanitize($_POST['contact3']);
		$contact4=$IISMethods->sanitize($_POST['contact4']);
		
		$email1=$IISMethods->sanitize($_POST['email1']);
		$email2=$IISMethods->sanitize($_POST['email2']);
		$gstno=$IISMethods->sanitize($_POST['gstno']);
		$tdsno=$IISMethods->sanitize($_POST['tdsno']);
		$ebondno=$IISMethods->sanitize($_POST['ebondno']);
		$website=$IISMethods->sanitize($_POST['website']);
		$address=$IISMethods->sanitize($_POST['address']);
		$stateid=$IISMethods->sanitize($_POST['stateid']);
		$cityid=$IISMethods->sanitize($_POST['cityid']);
		$pincode=$IISMethods->sanitize($_POST['pincode']);

		$pname=$IISMethods->sanitize($_POST['pname']);
		$pemail=$IISMethods->sanitize($_POST['pemail']);
		$pcontact=$IISMethods->sanitize($_POST['pcontact']);
		$pdesignation=$IISMethods->sanitize($_POST['pdesignation']);



		$logoimg=$_FILES['logoimg']['name'];
		$stampimg=$_FILES['stampimg']['name'];
		$signimg=$_FILES['signimg']['name'];
		$iconimg=$_FILES['iconimg']['name'];

		$id=$IISMethods->sanitize($_POST['id']);

		if($companytypeid && $companyname && $shortname && $prefix && $contact1 && $email1 && $address && $stateid && $cityid)
		{
			$insqry=array(
				'companytypeid'=>$companytypeid,
				'companyname'=>$companyname,
				'shortname'=>$shortname,
				'prefix'=>$prefix,
				'contact1'=>$contact1,
				'contact2'=>$contact2,
				'contact3'=>$contact3,
				'contact4'=>$contact4,
				'email1'=>$email1,
				'email2'=>$email2,
				'gstno'=>$gstno,
				'tdsno'=>$tdsno,
				'ebondno'=>$ebondno,
				'website'=>$website,
				'address'=>$address,
				'stateid'=>$stateid,
				'cityid'=>$cityid,
				'pincode'=>$pincode,
				'pname'=>$pname,
				'pemail'=>$pemail,
				'pcontact'=>$pcontact,
				'pdesignation'=>$pdesignation,
				
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT companyname from tblcompanymaster where companytypeid=:companytypeid and  companyname=:companyname ";
				$parms = array(
					':companytypeid'=>$companytypeid,
					':companyname'=>$companyname,
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
					if($logoimg || $stampimg || $signimg || $iconimg)
					{
						if(($_FILES['logoimg']['type'] == 'image/jpg'  || $_FILES['logoimg']['type'] == 'image/jpeg' || $_FILES['logoimg']['type'] == 'image/png') || ($_FILES['stampimg']['type'] == 'image/jpg'  || $_FILES['stampimg']['type'] == 'image/jpeg' || $_FILES['stampimg']['type'] == 'image/png') || 
						($_FILES['signimg']['type'] == 'image/jpg'  || $_FILES['signimg']['type'] == 'image/jpeg' || $_FILES['signimg']['type']== 'image/png') || ($_FILES['iconimg']['type'] == 'image/jpg'  || $_FILES['iconimg']['type'] == 'image/jpeg' || $_FILES['iconimg']['type'] == 'image/png'))
						{
							if($logoimg)
							{
								$logosourcePath = $_FILES['logoimg']['tmp_name'];
								$logotargetPath = $IISMethods->uploadallfiles(1,'logo',$logoimg,$logosourcePath,$unqid);
								$insqry['logoimg']=$logotargetPath;
							}
							if($stampimg)
							{
								$stampsourcePath = $_FILES['stampimg']['tmp_name'];
								$stamptargetPath = $IISMethods->uploadallfiles(1,'stamp',$stampimg,$stampsourcePath,$unqid);
								$insqry['stampimg']=$stamptargetPath;
							}
							if($signimg)
							{
								$signsourcePath = $_FILES['signimg']['tmp_name'];
								$signtargetPath = $IISMethods->uploadallfiles(1,'sign',$signimg,$signsourcePath,$unqid);
								$insqry['signimg']=$signtargetPath;
							}
							if($iconimg)
							{
								$iconsourcePath = $_FILES['iconimg']['tmp_name'];
								$icontargetPath = $IISMethods->uploadallfiles(1,'icon',$iconimg,$iconsourcePath,$unqid);
								$insqry['iconimg']=$icontargetPath;
							}

							$insqry['id']=$unqid;	
							$insqry['isdefault']=1;	
							$insqry['timestamp']=$IISMethods->getdatetime();
							$insqry['entry_uid']=$uid;	
							$insqry['entry_date']=$IISMethods->getdatetime();
	
							$DB->executedata('i','tblcompanymaster',$insqry,'');

							//Insert Admin Company Data
							$ucmpid = $IISMethods->generateuuid();
							$insucqry=array(
								'id'=>$ucmpid,
								'pid'=>$config->getAdminUserId(),
								'cmpid'=>$unqid,
								'entry_date'=>$IISMethods->getdatetime()
							);
							$DB->executedata('i','tblpersoncmp',$insucqry,'');


							//Insert User Type Herarchy Data
							$utoid = $IISMethods->generateuuid();
							$insutoqry=array(
								'id'=>$utoid,
								'cmpid'=>$unqid,
								'utypeid'=>$config->getAdminutype(),
								'utypename'=>'Super Admin',
								'parentid'=>'',
								'restrictdelete'=>1,
								'timestamp'=>$IISMethods->getdatetime()
							);
							$DB->executedata('i','tblusertypeorder',$insutoqry,'');

							
							$status=1;
							$message=$errmsg['insert'];
						}
						else
						{
							$status=0;
							$message=$errmsg['filetype'];
						}
					}
					else
					{
						$insqry['id']=$unqid;
						$insqry['isdefault']=1;
						$insqry['timestamp']=$IISMethods->getdatetime();		
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$IISMethods->getdatetime();

						$DB->executedata('i','tblcompanymaster',$insqry,'');


						//Insert Admin Company Data
						$ucmpid = $IISMethods->generateuuid();
						$insucqry=array(
							'id'=>$ucmpid,
							'pid'=>$config->getAdminUserId(),
							'cmpid'=>$unqid,
							'entry_date'=>$IISMethods->getdatetime()
						);
						$DB->executedata('i','tblpersoncmp',$insucqry,'');


						//Insert User Type Herarchy Data
						$utoid = $IISMethods->generateuuid();
						$insutoqry=array(
							'id'=>$utoid,
							'cmpid'=>$unqid,
							'utypeid'=>$config->getAdminutype(),
							'utypename'=>'Super Admin',
							'parentid'=>'',
							'restrictdelete'=>1,
							'timestamp'=>$IISMethods->getdatetime()
						);
						$DB->executedata('i','tblusertypeorder',$insutoqry,'');
						
						$status=1;
						$message=$errmsg['insert'];
					}
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT companyname from tblcompanymaster where companytypeid=:companytypeid and  companyname=:companyname AND id<>:id";
				$parms = array(
					':companytypeid'=>$companytypeid,
					':companyname'=>$companyname,
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

					$unqid = $IISMethods->generateuuid();
					if($logoimg || $stampimg || $signimg || $iconimg)
					{
						if(($_FILES['logoimg']['type'] == 'image/jpg'  || $_FILES['logoimg']['type'] == 'image/jpeg' || $_FILES['logoimg']['type'] == 'image/png') || ($_FILES['stampimg']['type'] == 'image/jpg'  || $_FILES['stampimg']['type'] == 'image/jpeg' || $_FILES['stampimg']['type'] == 'image/png') || 
						($_FILES['signimg']['type'] == 'image/jpg'  || $_FILES['signimg']['type'] == 'image/jpeg' || $_FILES['signimg']['type']== 'image/png') || ($_FILES['iconimg']['type'] == 'image/jpg'  || $_FILES['iconimg']['type'] == 'image/jpeg' || $_FILES['iconimg']['type'] == 'image/png'))
						{
							$qryimg="select id,logoimg,stampimg,signimg,iconimg from tblcompanymaster where id=:id";
							$parms = array(
								':id'=>$id,
							);
							$resimg=$DB->getmenual($qryimg,$parms);
							$row=$resimg[0];

							if($logoimg)
							{
								unlink($config->getImageurl().$row['logoimg']);
								$logosourcePath = $_FILES['logoimg']['tmp_name'];
								$logotargetPath = $IISMethods->uploadallfiles(1,'logo',$logoimg,$logosourcePath,$id);
								$insqry['logoimg']=$logotargetPath;
							}
							if($stampimg)
							{
								unlink($config->getImageurl().$row['stampimg']);
								$stampsourcePath = $_FILES['stampimg']['tmp_name'];
								$stamptargetPath = $IISMethods->uploadallfiles(1,'stamp',$stampimg,$stampsourcePath,$id);
								$insqry['stampimg']=$stamptargetPath;
							}
							if($signimg)
							{
								unlink($config->getImageurl().$row['signimg']);
								$signsourcePath = $_FILES['signimg']['tmp_name'];
								$signtargetPath = $IISMethods->uploadallfiles(1,'sign',$signimg,$signsourcePath,$id);
								$insqry['signimg']=$signtargetPath;
							}
							if($iconimg)
							{
								unlink($config->getImageurl().$row['iconimg']);
								$iconsourcePath = $_FILES['iconimg']['tmp_name'];
								$icontargetPath = $IISMethods->uploadallfiles(1,'icon',$iconimg,$iconsourcePath,$id);
								$insqry['iconimg']=$icontargetPath;
							}

							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$IISMethods->getdatetime();
		
							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblcompanymaster',$insqry,$extraparams);

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
						$insqry['update_date']=$IISMethods->getdatetime();
	
						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblcompanymaster',$insqry,$extraparams);
					
						$status=1;
						$message=$errmsg['update'];
					}
					
				}
			}
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletecompanymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{

			$qrychk="SELECT case when(IFNULL(lm.id,'') !='') then 1 else 0 end as tem
			from tblcompanymaster c
			left join tbllocationmaster lm on lm.cmpid = c.id
			where c.id=:id";

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
				
				$qryimg="select id,logoimg,stampimg,signimg,iconimg from tblcompanymaster where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				$row=$resimg[0];
			
				unlink($config->getImageurl().$row['logoimg']);
				unlink($config->getImageurl().$row['stampimg']);
				unlink($config->getImageurl().$row['signimg']);
				unlink($config->getImageurl().$row['iconimg']);
			
				
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblcompanymaster','',$extraparams);

				$utoextraparams=array(
					'cmpid'=>$id,
					'utypeid'=>$config->getAdminutype(),
				);
				$DB->executedata('d','tblusertypeorder','',$utoextraparams);

				$ucextraparams=array(
					'cmpid'=>$id,
					'pid'=>$config->getAdminUserId(),
				);
				$DB->executedata('d','tblpersoncmp','',$ucextraparams);

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

				$qrychk="SELECT case when(IFNULL(lm.id,'') !='') then 1 else 0 end as tem
				from tblcompanymaster c
				left join tbllocationmaster lm on lm.cmpid = c.id
				where c.id=:id";
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
					$qryimg="select id,logoimg,stampimg,signimg,iconimg from tblcompanymaster where id=:id";
					$parms = array(
						':id'=>$id,
					);
					$resimg=$DB->getmenual($qryimg,$parms);
					$row=$resimg[0];
			
					unlink($config->getImageurl().$row['logoimg']);
					unlink($config->getImageurl().$row['stampimg']);
					unlink($config->getImageurl().$row['signimg']);
					unlink($config->getImageurl().$row['iconimg']);

					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblcompanymaster','',$extraparams);


					$utoextraparams=array(
						'cmpid'=>$id,
						'utypeid'=>$config->getAdminutype(),
					);
					$DB->executedata('d','tblusertypeorder','',$utoextraparams);
	
					$ucextraparams=array(
						'cmpid'=>$id,
						'pid'=>$config->getAdminUserId(),
					);
					$DB->executedata('d','tblpersoncmp','',$ucextraparams);
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
	else if($action=='editcompanymaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select * from tblcompanymaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);


			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['companytypeid']=$IISMethods->sanitize($row['companytypeid']);
				$response['companyname']=$IISMethods->sanitize($row['companyname']);
				$response['shortname']=$IISMethods->sanitize($row['shortname']);
				$response['prefix']=$IISMethods->sanitize($row['prefix']);
				$response['contact1']=$IISMethods->sanitize($row['contact1']);
				$response['contact2']=$IISMethods->sanitize($row['contact2']);
				$response['contact3']=$IISMethods->sanitize($row['contact3']);
				$response['contact4']=$IISMethods->sanitize($row['contact4']);
				$response['email1']=$IISMethods->sanitize($row['email1']);
				$response['email2']=$IISMethods->sanitize($row['email2']);
				$response['gstno']=$IISMethods->sanitize($row['gstno']);
				$response['tdsno']=$IISMethods->sanitize($row['tdsno']);
				$response['ebondno']=$IISMethods->sanitize($row['ebondno']);
				$response['website']=$IISMethods->sanitize($row['website']);
				$response['address']=$IISMethods->sanitize($row['address']);
				$response['stateid']=$IISMethods->sanitize($row['stateid']);
				$response['cityid']=$IISMethods->sanitize($row['cityid']);
				$response['pincode']=$IISMethods->sanitize($row['pincode']);
				$response['pname']=$IISMethods->sanitize($row['pname']);
				$response['pemail']=$IISMethods->sanitize($row['pemail']);
				$response['pcontact']=$IISMethods->sanitize($row['pcontact']);
				$response['pdesignation']=$IISMethods->sanitize($row['pdesignation']);


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
	else if($action=='listcompanymaster')   
	{
		//error_reporting(1);
		$companymasters=new companymaster();
		$qry="select cm.timestamp as primary_date,cm.id,cm.companyname,cm.contact1,cm.email1,ct.regtype
			from tblcompanymaster cm
			inner join tblcompanyregtype ct on ct.id = cm.companytypeid
			where cm.isdefault=1 AND (cm.companyname like :cmpfilter or ct.regtype like :regtypefilter or cm.email1 like :email1filter or cm.contact1 like :contact1filter) ";
		$parms = array(
			':cmpfilter'=>$filter,
			':regtypefilter'=>$filter,
			':email1filter'=>$filter,
			':contact1filter'=>$filter,
		);

		$qry.=" order by $ordbycolumnname $ordby LIMIT $start, $per_page ";
		
		$companymasters=$DB->getmenual($qry,$parms,'companymaster');
		
		if($responsetype=='HTML')
		{
			if($companymasters)
			{
				$i=0;
				foreach($companymasters as $companymaster)
				{
					$id="'".$companymaster->id."'";
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
					if(($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-check d-none">';
						$htmldata.='<div class="text-center">';
						$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
						$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($companymaster->id).'" name="bulkdelete[]">';
						$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Company Details" onclick="viewcompanydata('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($companymaster->regtype).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($companymaster->companyname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($companymaster->contact1).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($companymaster->email1).'</td>';
					
			
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
			$response['data']= json_encode($companymasters);
		}

		$common_listdata=$companymasters;
	} 
	else if($action=='fillcompanytype')   
	{
		$qry="select id,regtype from tblcompanyregtype";
		$parms = array();
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];
				$htmldata.='<option value="'.$row['id'].'">'.$row['regtype'].'</option>';
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='viewcompanydata')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT cm.id,cm.companyname,cm.shortname,cm.prefix,cm.contact1,cm.contact2,cm.contact3,cm.contact4,cm.email1,cm.email2,ct.regtype,
			cm.address,cm.gstno,cm.tdsno,cm.ebondno,cm.website,sm.state,c.city,cm.pincode,cm.logoimg,cm.stampimg,cm.signimg,cm.iconimg,cm.pname,cm.pemail,cm.pcontact,cm.pdesignation
			from tblcompanymaster cm
			inner join tblcompanyregtype ct on ct.id = cm.companytypeid
			inner join tblstatemaster sm on sm.id=cm.stateid
			inner join tblcitymaster c on c.id=cm.cityid
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
					$tbldata.='<label>Company Type <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['regtype'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Company Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['companyname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Short Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['shortname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Prefix <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['prefix'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Contact 1 <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['contact1'].'</b></label>';
					$tbldata.='</div></div></div>';

					// $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					// $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					// $tbldata.='<label>Contact 1 Is Whatsapp Number <span>:</span></label>';
					// $tbldata.='</div>';
					// $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					// $tbldata.='<label class="label-view"><b>'.$row['striswhatsappnumcontact1'].'</b></label>';
					// $tbldata.='</div></div></div>';
					
					

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Contact 2 <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['contact2'].'</b></label>';
					$tbldata.='</div></div></div>';

					// $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					// $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					// $tbldata.='<label>Contact 2 Is Whatsapp Number <span>:</span></label>';
					// $tbldata.='</div>';
					// $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					// $tbldata.='<label class="label-view"><b>'.$row['striswhatsappnumcontact2'].'</b></label>';
					// $tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Contact 3 <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['contact3'].'</b></label>';
					$tbldata.='</div></div></div>';

					// $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					// $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					// $tbldata.='<label>Contact 3 Is Whatsapp Number <span>:</span></label>';
					// $tbldata.='</div>';
					// $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					// $tbldata.='<label class="label-view"><b>'.$row['striswhatsappnumcontact3'].'</b></label>';
					// $tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Contact 4 <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['contact4'].'</b></label>';
					$tbldata.='</div></div></div>';

					// $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					// $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					// $tbldata.='<label>Contact 4 Is Whatsapp Number <span>:</span></label>';
					// $tbldata.='</div>';
					// $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					// $tbldata.='<label class="label-view"><b>'.$row['striswhatsappnumcontact4'].'</b></label>';
					// $tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Email Id 1  <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['email1'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Email Id 2  <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['email2'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>GST No <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['gstno'].'</b></label>';
					$tbldata.='</div></div></div>';	
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>TDS No <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['tdsno'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Export Bond No <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['ebondno'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Website <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['website'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Address <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['address'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>State <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['state'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>City <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['city'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Pincode <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['pincode'].'</b></label>';
					$tbldata.='</div></div></div>';

					// $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					// $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					// $tbldata.='<label>Inquiry From Time <span>:</span></label>';
					// $tbldata.='</div>';
					// $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					// $tbldata.='<label class="label-view"><b>'.$row['inquiryfromtime'].'</b></label>';
					// $tbldata.='</div></div></div>';

					// $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					// $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					// $tbldata.='<label>Inquiry To Time <span>:</span></label>';
					// $tbldata.='</div>';
					// $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					// $tbldata.='<label class="label-view"><b>'.$row['inquirytotime'].'</b></label>';
					// $tbldata.='</div></div>';
					// $tbldata.='</div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Company Logo <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					if($row['logoimg'])
					{
						$tbldata.='<label class="label-view"><a href="'.$config->getImageurl().$row['logoimg'].'" target="_blank"><img src="'.$config->getImageurl().$row['logoimg'].'" width="120" height="70" /></a></label>';
					}
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Company Stamp <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					if($row['stampimg'])
					{
						$tbldata.='<label class="label-view"><a href="'.$config->getImageurl().$row['stampimg'].'" target="_blank"><img src="'.$config->getImageurl().$row['stampimg'].'" width="120" height="70" /></a></label>';
					}
					$tbldata.='</div></div></div>';
				
				
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Company Sign <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					if($row['signimg'])
					{
						$tbldata.='<label class="label-view"><a href="'.$config->getImageurl().$row['signimg'].'" target="_blank"><img src="'.$config->getImageurl().$row['signimg'].'" width="120" height="70" /></a></label>';
					}
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Company Icon <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					if($row['iconimg'])
					{
						$tbldata.='<label class="label-view"><a href="'.$config->getImageurl().$row['iconimg'].'" target="_blank"><img src="'.$config->getImageurl().$row['iconimg'].'" width="120" height="70" /></a></label>';
					}
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Person Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['pname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Person Email <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['pemail'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Person Contact <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['pcontact'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Person Designtion <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['pdesignation'].'</b></label>';
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

  