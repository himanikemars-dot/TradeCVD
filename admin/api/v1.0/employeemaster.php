<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/employee.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertemployeemaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$id=$IISMethods->sanitize($_POST['id']);

		$companyid=$IISMethods->sanitize($_POST['companyid']);
		$utypeid=$_POST['utypeid'];
		$departmentid=$_POST['departmentid'];
		$designationid=$IISMethods->sanitize($_POST['designationid']);
		$firstname=$IISMethods->sanitize(trim($_POST['firstname']));
		$middlename=$IISMethods->sanitize(trim($_POST['middlename']));
		$lastname=$IISMethods->sanitize(trim($_POST['lastname']));
		$gender=$IISMethods->sanitize($_POST['gender']);
		$mobilenumber1=$IISMethods->sanitize(trim($_POST['mobilenumber1']));
		$mobilenumber2=$IISMethods->sanitize(trim($_POST['mobilenumber2']));
		$email=$IISMethods->sanitize(trim($_POST['email']));
		$dob=$IISMethods->sanitize($_POST['dob']);

		$profileimg=$_FILES['profileimg']['name'];

		$joiningdate=$IISMethods->sanitize($_POST['joiningdate']);
		$address=$IISMethods->sanitize(trim($_POST['address']));
		$stateid=$IISMethods->sanitize($_POST['stateid']);
		$countryid=$IISMethods->sanitize($_POST['countryid']);
		$cityid=$IISMethods->sanitize($_POST['cityid']);
		$pincode=$IISMethods->sanitize(trim($_POST['pincode']));
		$p_address=$IISMethods->sanitize($_POST['p_address']);
		$p_stateid=$IISMethods->sanitize($_POST['p_stateid']);
		$p_countryid=$IISMethods->sanitize($_POST['p_countryid']);
		$p_cityid=$IISMethods->sanitize($_POST['p_cityid']);
		$p_pincode=$IISMethods->sanitize(trim($_POST['p_pincode']));
		$emergencypersonname=$IISMethods->sanitize(trim($_POST['emergencypersonname']));
		$emergencypersoncontact=$IISMethods->sanitize(trim($_POST['emergencypersoncontact']));
		$username=$IISMethods->sanitize(trim($_POST['username']));
		$password=$IISMethods->sanitize(trim($_POST['password']));
		$cpassword=$IISMethods->sanitize(trim($_POST['cpassword']));

		$datetime=$IISMethods->getdatetime();

		if($companyid && sizeof($utypeid) > 0 && sizeof($departmentid) > 0  && $firstname && $lastname && $gender && $mobilenumber1 && $email && $dob && $joiningdate && $address && $stateid && $cityid && $pincode && $p_address && $p_stateid && $p_cityid && $p_pincode && $emergencypersonname && $emergencypersoncontact )//&& $designationid
		{	
			$qtyname="SELECT 
			IFNULL((select companyname from tblcompanymaster where id=:companyid),'') as companyname,
			-- IFNULL((select name from tbldesignationmaster where id=:designationid),'') as designationname,
			IFNULL((select country from tblcountrymaster where id=:countryid),'') as countryname,
			IFNULL((select state from tblstatemaster where id=:stateid),'') as statename,
			IFNULL((select city from tblcitymaster where id=:cityid),'') as cityname,
			IFNULL((select country from tblcountrymaster where id=:p_countryid),'') as p_countryname,
			IFNULL((select state from tblstatemaster where id=:p_stateid),'') as p_statename,
			IFNULL((select city from tblcitymaster where id=:p_cityid),'') as p_cityname";
			$parms = array(
				':companyid'=>$companyid,
				// ':designationid'=>$designationid,
				':countryid'=>$countryid,
				':stateid'=>$stateid,
				':cityid'=>$cityid,
				':p_countryid'=>$p_countryid,
				':p_stateid'=>$p_stateid,
				':p_cityid'=>$p_cityid,
			);
			// print_r($parms); exit;
			$result_name=$DB->getmenual($qtyname,$parms);
			
			$personname = '';
			$personname .= $firstname;
			if($middlename)
				$personname .= ' '.$middlename;
			$personname .= ' '.$lastname;
			
			$insqry=array(	
				'companyid'=>$companyid,
				'companyname'=>$result_name[0]['companyname'],
				// 'designationid'=>$designationid,
				// 'designationname'=>$result_name[0]['designationname'],
				'designationid'=>'',
				'designationname'=>'',
				'firstname'=>$firstname,
				'middlename'=>$middlename,
				'lastname'=>$lastname,
				'personname'=>$personname,
				'gender'=>$gender,
				'contact'=>$mobilenumber1,
				'mobilenumber2'=>$mobilenumber2,
				'email'=>$email,
				'dob'=>$dob,
				'joiningdate'=>$joiningdate,
				'address'=>$address,
				'countryid'=>$countryid,
				'countryname'=>$result_name[0]['countryname'],
				'stateid'=>$stateid,
				'statename'=>$result_name[0]['statename'],
				'cityid'=>$cityid,
				'cityname'=>$result_name[0]['cityname'],
				'pincode'=>$pincode,
				'p_address'=>$p_address,
				'p_countryid'=>$p_countryid,
				'p_countryname'=>$result_name[0]['p_countryname'],
				'p_stateid'=>$p_stateid,
				'p_statename'=>$result_name[0]['p_statename'],
				'p_cityid'=>$p_cityid,
				'p_cityname'=>$result_name[0]['p_cityname'],
				'p_pincode'=>$p_pincode,
				'username'=>$username,
				'emergencypersonname'=>$emergencypersonname,
				'emergencypersoncontact'=>$emergencypersoncontact,
			);

			if($formevent=='addright')
			{
				$unqid = $IISMethods->generateuuid();
				if($profileimg)
				{
					if(($_FILES['profileimg']['type'] == 'image/jpg'  || $_FILES['profileimg']['type'] == 'image/jpeg' || $_FILES['profileimg']['type'] == 'image/png'))
					{
						$workoutsourcePath = $_FILES['profileimg']['tmp_name'];
						$workouttargetPath = $IISMethods->uploadallfiles(1,'personmaster',$profileimg,$workoutsourcePath,$unqid);
						$insqry['profileimg']=$workouttargetPath;
					}
				}

				$insqry['password']=md5($password);
				$insqry['strpassword']=$password;

				$qrychk="SELECT personname from tblpersonmaster where contact=:mobilenumber1 AND IFNULL(isdelete,0)=0";
				$parms = array(
					':mobilenumber1'=>$mobilenumber1,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexistmobile'];
				}
				else
				{	
					$qrychkuname="SELECT id from tblpersonmaster where username=:username AND IFNULL(isdelete,0)=0";
					$parmsuname = array(
						':username'=>$username,
					);
					$resultuname=$DB->getmenual($qrychkuname,$parmsuname);
					if(sizeof($resultuname) > 0)
					{
						$status=0;
						$message=$errmsg['isexistusername'];
					}else{

						// $qrychk="SELECT personname from tblpersonmaster where email=:email AND IFNULL(isdelete,0)=0";
						// $parms = array(
						// 	':email'=>$email,
						// );
						// $result_ary=$DB->getmenual($qrychk,$parms);
						// if(sizeof($result_ary) > 0)
						// {
						// 	$status=0;
						// 	$message=$errmsg['isexistemail'];
						// }
						// else
						// {
							$unqid = $IISMethods->generateuuid();
							$insqry['id']=$unqid;	
							$insqry['timestamp']=$datetime;	
							$insqry['entry_uid']=$uid;	
							$insqry['entry_date']=$datetime;

							$DB->executedata('i','tblpersonmaster',$insqry,'');

							//Insert Person Utype
							for($i=0;$i<sizeof($utypeid);$i++)
							{
								$qrychk="SELECT usertype from tblusertypemaster where id=:id";
								$parms = array(
									':id'=>$utypeid[$i],
								);
								$result_utype=$DB->getmenual($qrychk,$parms);
								$utid = $IISMethods->generateuuid();
								$insperutype=array(	
									'id'=>$utid,				
									'pid'=>$unqid,
									'utypeid'=>$utypeid[$i],
									'userrole'=>$result_utype[0]['usertype'],
									'entry_date'=>$datetime,
								);
								$DB->executedata('i','tblpersonutype',$insperutype,'');
							}
							for($i=0;$i<sizeof($departmentid);$i++)
							{
								$qrychk="SELECT name from tbldepartmentmaster where id=:id";
								$parms = array(
									':id'=>$departmentid[$i],
								);
								$result_department=$DB->getmenual($qrychk,$parms);
								$utid = $IISMethods->generateuuid();
								$insperdepartment=array(	
									'id'=>$utid,				
									'pid'=>$unqid,
									'departmentid'=>$departmentid[$i],
									'department'=>$result_department[0]['department'],
									'timestamp'=>$datetime,
									'entry_uid'=>$uid,
									'entry_date'=>$datetime,
								);
								$DB->executedata('i','tblpersondepartment',$insperdepartment,'');
							}

							$status=1;
							$message=$errmsg['insert'];
						// }
					}
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT personname from tblpersonmaster where contact=:mobilenumber1 AND IFNULL(isdelete,0)=0 and id <> :id";
				$parms = array(
					':mobilenumber1'=>$mobilenumber1,
					':id'=>$id,
				);
				//echo $qrychk;
				//print_r($parms);
				$result_ary=$DB->getmenual($qrychk,$parms);
				
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexistmobile'];
				}
				else
				{
					$qrychkuname="SELECT id from tblpersonmaster where username=:username AND IFNULL(isdelete,0)=0  and id <> :id";
					$parmsuname = array(
						':username'=>$username,
						':id'=>$id,
					);
					$resultuname=$DB->getmenual($qrychkuname,$parmsuname);
					if(sizeof($resultuname) > 0)
					{
						$status=0;
						$message=$errmsg['isexistusername'];
					}else{
						try 
						{
							$DB->begintransaction();
							$unqid = $id;
							if($profileimg)
							{
								if(($_FILES['profileimg']['type'] == 'image/jpg'  || $_FILES['profileimg']['type'] == 'image/jpeg' || $_FILES['profileimg']['type'] == 'image/png'))
								{
									
									$qryimg="SELECT pm.profileimg 
										FROM tblpersonmaster pm 
										WHERE pm.id=:id";
									$parms = array(
										':id'=>$id,
									);
									$resimg=$DB->getmenual($qryimg,$parms);
									$row=$resimg[0];

									unlink('../../../assets/'.$row['profileimg']);
							
									$workoutsourcePath = $_FILES['profileimg']['tmp_name'];
									$workouttargetPath = $IISMethods->uploadallfiles(1,'personmaster',$profileimg,$workoutsourcePath,$unqid);
									$insqry['profileimg']=$workouttargetPath;
								}
							}

							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;
							
							$extraparams=array(
								'id'=>$id
							);
							// print_r($insqry); print_r($extraparams); exit;
							$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);

							
							//Delete & Insert Person Utype
							$delparams=array(
								'pid'=>$id
							);
							$DB->executedata('d','tblpersonutype','',$delparams);

							for($i=0;$i<sizeof($utypeid);$i++)
							{
								$qrychk="SELECT usertype from tblusertypemaster where id=:id";
								$parms = array(
									':id'=>$utypeid[$i],
								);
								$result_utype=$DB->getmenual($qrychk,$parms);
								$utid = $IISMethods->generateuuid();
								$insperutype=array(	
									'id'=>$utid,				
									'pid'=>$id,
									'utypeid'=>$utypeid[$i],
									'userrole'=>$result_utype[0]['usertype'],
									'entry_date'=>$datetime,
								);
								$DB->executedata('i','tblpersonutype',$insperutype,'');
							}

							//Delete & Insert Person Utype
							$delparams=array(
								'pid'=>$id
							);
							$DB->executedata('d','tblpersondepartment','',$delparams);

							for($i=0;$i<sizeof($departmentid);$i++)
							{
								$qrychk="SELECT name from tbldepartmentmaster where id=:id";
								$parms = array(
									':id'=>$departmentid[$i],
								);
								$result_department=$DB->getmenual($qrychk,$parms);
								$utid = $IISMethods->generateuuid();
								$insperdepartment=array(	
									'id'=>$utid,				
									'pid'=>$id,
									'departmentid'=>$departmentid[$i],
									'department'=>$result_department[0]['department'],
									'timestamp'=>$datetime,
									'entry_uid'=>$uid,
									'entry_date'=>$datetime,
								);
								$DB->executedata('i','tblpersondepartment',$insperdepartment,'');
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
				}	
				
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
		
	}
	else if($action=='deleteemployeemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		$datetime=$IISMethods->getdatetime();

		$insqry=array(					
			'isdelete'=>1,
			'delete_uid'=>$uid,	
			'delete_date'=>$datetime,					
		);

		if($id)
		{
			// $qrychk="SELECT case when(IFNULL(p.id,'') != '') then 1 else 0 end as tem
			// from tblpersonmaster pm
			// left join tblorders p on p.employeeid = pm.id
			// where pm.id=:id";
			// $parms = array(
			// 	':id'=>$id,
			// );
			// $result_ary=$DB->getmenual($qrychk,$parms);
			// if(sizeof($result_ary) > 0)
			// {
			// 	$status=0;
			// 	$message=$errmsg['inuse'];
			// }
			// else
			// {
				$extraparams1=array(
					'pid'=>$id
				);
				$DB->executedata('d','tblpersonutype',$insperutype,$extraparams1);

				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);
				
				$status=1;
				$message=$errmsg['delete'];
			//}
		}
		else if(sizeof($bulk)>0)
		{
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];

				// $qrychk="SELECT case when(IFNULL(p.id,'') != '') then 1 else 0 end as tem
				// from tblpersonmaster pm
				// left join tblorders p on p.employeeid = pm.id
				// where pm.id=:id";
				// $parms = array(
				// 	':id'=>$id,
				// );
				// $result_ary=$DB->getmenual($qrychk,$parms);
				// if(sizeof($result_ary) > 0)
				// {
				// 	$usemenu.="";
				// }
				// else
				// {
					$extraparams1=array(
						'pid'=>$id
					);
					$DB->executedata('d','tblpersonutype',$insperutype,$extraparams1);
					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);
				//}

			}
			$status=1;
			$message=$errmsg['delete'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='editemployeemaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT pm.*,IFNULL(GROUP_CONCAT(DISTINCT pu.utypeid),'') AS utypeid,
				IFNULL(GROUP_CONCAT(DISTINCT pd.departmentid),'') AS departmentid 
				FROM tblpersonmaster pm 
				INNER JOIN tblpersonutype pu ON pu.pid=pm.`id`
				INNER JOIN tblpersondepartment pd ON pd.pid=pm.`id`
				WHERE pm.id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);

				$response['companyid']=$IISMethods->sanitize($row['companyid']);
				$response['designationid']=$IISMethods->sanitize($row['designationid']);
				$response['firstname']=$IISMethods->sanitize($row['firstname']);
				$response['middlename']=$IISMethods->sanitize($row['middlename']);
				$response['lastname']=$IISMethods->sanitize($row['lastname']);
				$response['personname']=$IISMethods->sanitize($row['personname']);
				$response['gender']=$IISMethods->sanitize($row['gender']);
				$response['mobilenumber1']=$IISMethods->sanitize($row['contact']);
				$response['mobilenumber2']=$IISMethods->sanitize($row['mobilenumber2']);
				$response['email']=$IISMethods->sanitize($row['email']);
				$response['dob']=$IISMethods->sanitize($row['dob']);
				$response['profileimg']=$IISMethods->sanitize($row['profileimg']);
				$response['joiningdate']=$IISMethods->sanitize($row['joiningdate']);
				$response['address']=$IISMethods->sanitize($row['address']);
				$response['countryid']=$IISMethods->sanitize($row['countryid']);
				$response['stateid']=$IISMethods->sanitize($row['stateid']);
				$response['cityid']=$IISMethods->sanitize($row['cityid']);
				$response['pincode']=$IISMethods->sanitize($row['pincode']);
				$response['p_address']=$IISMethods->sanitize($row['p_address']);
				$response['p_countryid']=$IISMethods->sanitize($row['p_countryid']);
				$response['p_stateid']=$IISMethods->sanitize($row['p_stateid']);
				$response['p_cityid']=$IISMethods->sanitize($row['p_cityid']);
				$response['p_pincode']=$IISMethods->sanitize($row['p_pincode']);
				$response['emergencypersonname']=$IISMethods->sanitize($row['emergencypersonname']);
				$response['emergencypersoncontact']=$IISMethods->sanitize($row['emergencypersoncontact']);
				$response['username']=$IISMethods->sanitize($row['username']);
				$response['password']=$IISMethods->sanitize($row['strpassword']);

				$response['utypeid']=$IISMethods->sanitize($row['utypeid']);
				$response['departmentid']=$IISMethods->sanitize($row['departmentid']);

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
	else if($action=='listemployeemaster')   
	{
		$issidebarflt=$IISMethods->sanitize($_POST['issidebarflt']);
		$fltlocid=$IISMethods->sanitize($_POST['fltlocid']);
		// ini_set('display_errors', 1);
		// error_reporting(E_ALL);


		$employees=new employee();
		$qry="SELECT distinct pm.timestamp as primary_date,pm.id,pm.personname,pm.contact,pm.email,tcm.country as countryname,sm.state as statename,cm.city as cityname,pm.isactive,pm.username,pm.strpassword,pm.entry_uid,
		IFNULL(GROUP_CONCAT(DISTINCT um.usertype),'') AS usertype,GROUP_CONCAT(DISTINCT pu.utypeid) AS usertypeid,MAX(um.hasweblogin) AS hasweblogin
		from tblpersonmaster pm 
		inner join tblcountrymaster tcm on tcm.id=pm.countryid
		inner join tblstatemaster sm on sm.id=pm.stateid
		inner join tblcitymaster cm on cm.id=pm.cityid
		inner join tblpersonutype pu on pu.pid = pm.id
		inner join tblusertypemaster um  on um.id = pu.utypeid 
		where IFNULL(pm.isdelete,0)=0 and pm.id <> :adminuid  and (um.usertype like :filter OR pm.personname like :filter OR pm.contact like :filter OR pm.email like :filter OR tcm.country like :filter OR pm.statename like :filter OR pm.cityname like :filter)  
			";	
		$parms = array(
			':filter'=>'%'.$filter.'%',
			':adminuid'=>$config->getAdminUserId(),
		);

		$qry.=" group by pm.id order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		// echo $qry;
		$employees=$DB->getmenual($qry,$parms,'employee');

		if($responsetype=='HTML')
		{
			if($employees)
			{
				$i=0;
				foreach($employees as $employee)
				{
					$id="'".$employee->id."'";
					$username="'".$employee->username."'";
					$password="'".$employee->strpassword."'";

					$htmldata.='<tr data-index="'.$employee->id.'">';
					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if(((($rightstotalcount)>0 ? $Pagerights->getAlleditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 
						|| ((($rightstotalcount)>0 ? $Pagerights->getSelfeditright():0)==1 && $uid==$IISMethods->sanitize($employee->entry_uid) )) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if(((($rightstotalcount)>0 ? $Pagerights->getAlldelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 
						|| ((($rightstotalcount)>0 ? $Pagerights->getSelfdelright():0)==1 && $uid==$IISMethods->sanitize($employee->entry_uid) )) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					if((($rightstotalcount)>0 ? $Pagerights->getAlldelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1
					|| ((($rightstotalcount)>0 ? $Pagerights->getSelfdelright():0)==1 && $uid==$IISMethods->sanitize($employee->entry_uid) )) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-check d-none">';
						$htmldata.='<div class="text-center">';
						$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
						$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$employee->id.'" value="'.$IISMethods->sanitize($employee->id).'" name="bulkdelete[]">';
						$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$employee->id.'"></label>';
						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}

					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($employee->usertype).'</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Details" onclick="viewemployeedetaildata('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($employee->personname).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($employee->contact).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($employee->email).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($employee->countryname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($employee->statename).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($employee->cityname).'</td>';

					if((($rightstotalcount)>0 ? $Pagerights->getAlleditright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1
					|| ((($rightstotalcount)>0 ? $Pagerights->getSelfeditright():0)==1 && $uid==$IISMethods->sanitize($employee->entry_uid) )) //rights check admin and right person
					{

						$htmldata.='<td class="tbl-name">';
						if( $employee->hasweblogin==1)
						{
							
							$htmldata.='<a href="javascript:void(0)" onclick="resetpassword('.$id.','.$IISMethods->sanitize($username).','.$IISMethods->sanitize($password).')" data-toggle="tooltip" data-title="Reset Password"><i class="bi bi-arrow-repeat" style="font-size: 20px;"></i></a>';
						}
						$htmldata.='</td>';

						if($employee->isactive==1)
						{
							$htmldata.='<td class="tbl-w100"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changepersonstatus('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-w100"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changepersonstatus('.$id.')">';
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
				if($page<=0 && sizeof($employees)<=0)
				{
					$htmldata.=file_get_contents($config->getNoDataFound());
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($employees);
		}

		$common_listdata=$employees;
	} 
	else if($action=='changepersonstatus')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			
			$qrychk="select isactive from tblpersonmaster where id=:id";
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
			$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);
		
		
			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	} 
	else if($action=='viewemployeedata')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT DISTINCT pm.personname,pm.contact,pm.mobilenumber2,pm.email,pm.address,pm.statename,pm.countryname,pm.cityname,pm.username,pm.dob,pm.companyname,GROUP_CONCAT(DISTINCT dm.name) AS department,pm.gender,pm.joiningdate,
				GROUP_CONCAT(DISTINCT ut.usertype) as usertype,max(ut.hasweblogin) as isweblogin,max(ut.hasapplogin) as isapplogin,pm.p_address,pm.p_statename,pm.p_countryname,pm.p_cityname,pm.pincode,pm.p_pincode,pm.profileimg,pm.emergencypersoncontact,pm.emergencypersonname
			from tblpersonmaster pm 
			inner join tblpersonutype pu on pu.pid=pm.id 
			inner join tblusertypemaster ut on ut.id=pu.utypeid 
			INNER JOIN tblpersondepartment pd ON pd.pid=pm.id
			INNER JOIN tbldepartmentmaster dm ON dm.id=pd.departmentid
			where pm.id=:id";
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
					$tbldata.='<label>Company <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['companyname'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>User Type <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['usertype'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Department <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['department'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Employee Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['personname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Mobile Number <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['contact'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Alternate Mobile Number <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['mobilenumber2'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Email <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['email'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Date Of Birth <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['dob'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Gender <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>';
						if($row['gender']==1)
						{
							$tbldata.='Male';
						}else if($row['gender']==2)
						{
							$tbldata.='Female';
						}
					$tbldata.='</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Joining date <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['joiningdate'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Username <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['username'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Country <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['countryname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>State <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['statename'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>City <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['cityname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Pincode <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['pincode'].'</b></label>';
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
					$tbldata.='<label>Parmanent Country <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['p_countryname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Parmanent State <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['p_statename'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Parmanent City <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['p_cityname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Parmanent Pincode <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['p_pincode'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Parmanent Address <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['p_address'].'</b></label>';
					$tbldata.='</div></div></div>';
					
					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Emergency Person Name <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['emergencypersonname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Emergency Person Contact Number <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['emergencypersoncontact'].'</b></label>';
					$tbldata.='</div></div></div>';

					if($row['profileimg'])
					{
						$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
						$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
						$tbldata.='<label>Profile Image <span>:</span></label>';
						$tbldata.='</div>';
						$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
						$tbldata.='<img src="'.$config->getImageurl().$row['profileimg'].'" height="100" width="100" />';
						$tbldata.='</div></div></div>';
					}

					

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
	else if($action=='uploademployeemaster')   
	{
		
		$filename=$_FILES['empcsvfile']['tmp_name'];	
		$locationid=$IISMethods->sanitize($_POST['csvlocationid']);

		
		if($_FILES["empcsvfile"]["size"] > 0 && $locationid)
		{
			$file = fopen($filename, "r");
			$i=0;
     		while (($empData = fgetcsv($file, 10000, ",")) !== FALSE)
     		{
				if($i>0)
				{
					$usertype=trim($empData[0]);
					$name=trim($empData[1]);
					$mobileno1=trim($empData[2]);
					$mobileno2=trim($empData[3]);
					$email=trim($empData[4]);
					$address=trim($empData[5]);
					$state=trim($empData[6]);
					$city=trim($empData[7]);

					$username=$mobileno1;
					$password=$mobileno1;
					

					$datetime=$IISMethods->getdatetime();

					$utype=explode(',',$usertype);

					$qtyname="SELECT 
					IFNULL((select id from tblstatemaster where state=:state),'') as stateid,
					IFNULL((select id from tblcitymaster where city=:city),'') as cityid";
					$parms = array(
						':state'=>$state,
						':city'=>$city,
					);
					$result_name=$DB->getmenual($qtyname,$parms);

					$stateid=$result_name[0]['stateid'];
					$cityid=$result_name[0]['cityid'];

					// echo '123';
					if($locationid && sizeof($utype)>0 && $name && $mobileno1 && $address && $stateid && $cityid)
					{
						// echo '456';
						$insqry=array(	
							'personname'=>$name,
							'contact'=>$mobileno1,
							'mobilenumber2'=>$mobileno2,
							'email'=>$email,
							'address'=>$address,
							'stateid'=>$stateid,
							'statename'=>$state,
							'cityid'=>$cityid,
							'cityname'=>$city,
							'username'=>$username,		
							'password'=>md5($password),		
							'strpassword'=>$password,
						);

						$qrychk="SELECT id from tblpersonmaster where contact=:mobilenumber1 AND IFNULL(isdelete,0)=0";
						$parms = array(
							':mobilenumber1'=>$mobileno1,
						);
						$result_ary=$DB->getmenual($qrychk,$parms);
						if(sizeof($result_ary) > 0)
						{
							$id=$result_ary[0]['id'];
							$insqry['update_uid']=$uid;	
							$insqry['update_date']=$datetime;
							$extraparams=array(
								'id'=>$id
							);
							$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);

							//Delete & Insert Person Utype
							$delparams=array(
								'pid'=>$id
							);
							$DB->executedata('d','tblpersonutype','',$delparams);

							//Insert Person Utype
							for($i=0;$i<sizeof($utype);$i++)
							{
								$qrychk="SELECT id from tblusertypemaster where usertype=:usertype";
								$parms = array(
									':usertype'=>$utype[$i],
								);
								$result_utype=$DB->getmenual($qrychk,$parms);
								if(sizeof($result_utype)>0)
								{
									$utid = $IISMethods->generateuuid();
									$insperutype=array(	
										'id'=>$utid,				
										'pid'=>$id,
										'utypeid'=>$result_utype[0]['id'],
										'userrole'=>$utype[$i],
										'entry_date'=>$datetime,
									);
									$DB->executedata('i','tblpersonutype',$insperutype,'');
								}
									
							}

							//Delete & Insert Person Location
							$delparams=array(
								'pid'=>$id
							);
							$DB->executedata('d','tblpersonlocation','',$delparams);

							$lpid = $IISMethods->generateuuid();
							$insperloc=array(	
								'id'=>$lpid,				
								'pid'=>$id,
								'locid'=>$locationid,
								'entry_date'=>$datetime,
							);
							$DB->executedata('i','tblpersonlocation',$insperloc,'');

						}
						else
						{
							$unqid = $IISMethods->generateuuid();
							
							$insqry['id']=$unqid;	
							$insqry['timestamp']=$datetime;	
							$insqry['entry_uid']=$uid;	
							$insqry['entry_date']=$datetime;
							$DB->executedata('i','tblpersonmaster',$insqry,'');

							//Insert Person Utype
							for($i=0;$i<sizeof($utype);$i++)
							{
								$qrychk="SELECT id from tblusertypemaster where usertype=:usertype";
								$parms = array(
									':usertype'=>$utype[$i],
								);
								$result_utype=$DB->getmenual($qrychk,$parms);
								if(sizeof($result_utype)>0)
								{
									$utid = $IISMethods->generateuuid();
									$insperutype=array(	
										'id'=>$utid,				
										'pid'=>$unqid,
										'utypeid'=>$result_utype[0]['id'],
										'userrole'=>$utype[$i],
										'entry_date'=>$datetime,
									);
									$DB->executedata('i','tblpersonutype',$insperutype,'');
								}
									
							}

							//Insert Person Location
							$lpid = $IISMethods->generateuuid();
							$insperloc=array(	
								'id'=>$lpid,				
								'pid'=>$unqid,
								'locid'=>$locationid,
								'entry_date'=>$datetime,
							);
							$DB->executedata('i','tblpersonlocation',$insperloc,'');

						}
					}
				}
				$i++;
		 	}
			$status=1;
			$message=$errmsg['insert'];		
	 	}
	}
	else if($action=='changepassword')   
	{
		$userid=$IISMethods->sanitize($_POST['userid']);
		$npass=$IISMethods->sanitize($_POST['npass']);
		if($userid && $npass)
		{
			$insqry=array(	
				'password'=>md5($npass),				
				'strpassword'=>$npass,
			);

			$extraparams=array(
				'id'=>$userid
			);
			$DB->executedata('u','tblpersonmaster',$insqry,$extraparams);
		
			$status=1;
			$message=$errmsg['passreset'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';  
?>

  