<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/packagemaster.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertpackagemaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);


		$packagename=$IISMethods->sanitize($_POST['packagename']);
		$monthlyprice=$IISMethods->sanitize($_POST['monthlyprice']);
		$yearlyprice=$IISMethods->sanitize($_POST['yearlyprice']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);

		$candiamondsearch=0;
		if($_POST['candiamondsearch']==1)
		{
			$candiamondsearch=1;
		}

		$canjewelrysearch=0;
		if($_POST['canjewelrysearch']==1)
		{
			$canjewelrysearch=1;
		}

		$cansharediamondjewelry=0;
		if($_POST['cansharediamondjewelry']==1)
		{
			$cansharediamondjewelry=1;
		}

		$canmembertomemberchat=0;
		if($_POST['canmembertomemberchat']==1)
		{
			$canmembertomemberchat=1;
		}

		$canbuyrequests=0;
		if($_POST['canbuyrequests']==1)
		{
			$canbuyrequests=1;
		}

		$canlistdiamondforsale=0;
		if($_POST['canlistdiamondforsale']==1)
		{
			$canlistdiamondforsale=1;
		}
		$isnolimitlistdiamondforsale=0;
		if($_POST['isnolimitlistdiamondforsale']==1)
		{
			$isnolimitlistdiamondforsale=1;
		}
		$listdiamondforsalelimitvalue=$_POST['listdiamondforsalelimitvalue'];
		if($isnolimitlistdiamondforsale==1)
		{
			$listdiamondforsalelimitvalue=0;
		}
		$canlistjewelryforsale=0;
		if($_POST['canlistjewelryforsale']==1)
		{
			$canlistjewelryforsale=1;
		}
		$cansavanigemsxlexcel=0;
		if($_POST['cansavanigemsxlexcel']==1)
		{
			$cansavanigemsxlexcel=1;
		}
		$canadditionaluseraddon=0;
		if($_POST['canadditionaluseraddon']==1)
		{
			$canadditionaluseraddon=1;
		}
		$isnolimitadditionaluseraddon=0;
		if($_POST['isnolimitadditionaluseraddon']==1)
		{
			$isnolimitadditionaluseraddon=1;
		}
		$additionaluseraddonlimitvalue=$_POST['additionaluseraddonlimitvalue'];
		if($isnolimitadditionaluseraddon==1)
		{
			$additionaluseraddonlimitvalue=0;
		}
		$canprioritycustomersupport=0;
		if($_POST['canprioritycustomersupport']==1)
		{
			$canprioritycustomersupport=1;
		}

		$colorcode=$IISMethods->sanitize($_POST['colorcode']);
		$termsconditionid=$IISMethods->sanitize($_POST['termsconditionid']);
		$termscondition=$_POST['termscondition'];
		$shortdescr=$_POST['shortdescr'];
		$descr=$_POST['descr'];


		$id=$IISMethods->sanitize($_POST['id']);

		if($packagename && $monthlyprice && $yearlyprice && $displayorder && $colorcode && $termsconditionid && $termscondition && $shortdescr && $descr)
		{
			$annualysaveprice=$yearlyprice-($monthlyprice*12);
			$insqry=array(
				'packagename'=>$packagename,
				'monthlyprice'=>$monthlyprice,
				'annualyprice'=>$yearlyprice,
				'annualysaveprice'=>$annualysaveprice,
				'candiamondsearch'=>$candiamondsearch,
				'diamondsearchpfid'=>1,
				'diamondsearchtext'=>$DB->getpackagefeaturesdata(1),
				'canjewelrysearch'=>$canjewelrysearch,
				'jewelrysearchpfid'=>2,
				'jewelrysearchtext'=>$DB->getpackagefeaturesdata(2),
				'cansharediamondjewelry'=>$cansharediamondjewelry,
				'sharediamondjewelrypfid'=>3,
				'sharediamondjewelrytext'=>$DB->getpackagefeaturesdata(3),
				'canmembertomemberchat'=>$canmembertomemberchat,
				'membertomemberchatpfid'=>4,
				'membertomemberchattext'=>$DB->getpackagefeaturesdata(4),
				'canbuyrequests'=>$canbuyrequests,
				'canbuyrequestspfid'=>5,
				'canbuyrequeststext'=>$DB->getpackagefeaturesdata(5),
				'canlistdiamondforsale'=>$canlistdiamondforsale,
				'listdiamondforsalepfid'=>6,
				'listdiamondforsaletext'=>$DB->getpackagefeaturesdata(6),
				'isnolimitlistdiamondforsale'=>$isnolimitlistdiamondforsale,
				'listdiamondforsalelimitvalue'=>$listdiamondforsalelimitvalue,
				'canlistjewelryforsale'=>$canlistjewelryforsale,
				'listjewelryforsalepfid'=>7,
				'listjewelryforsaletext'=>$DB->getpackagefeaturesdata(7),
				'cansavanigemsxlexcel'=>$cansavanigemsxlexcel,
				'savanigemsxlexcelpfid'=>8,
				'savanigemsxlexceltext'=>$DB->getpackagefeaturesdata(8),
				'canadditionaluseraddon'=>$canadditionaluseraddon,
				'additionaluseraddonpfid'=>9,
				'additionaluseraddontext'=>$DB->getpackagefeaturesdata(9),
				'isnolimitadditionaluseraddon'=>$isnolimitadditionaluseraddon,
				'additionaluseraddonlimitvalue'=>$additionaluseraddonlimitvalue,
				'canprioritycustomersupport'=>$canprioritycustomersupport,
				'prioritycustomersupportpfid'=>10,
				'prioritycustomersupporttext'=>$DB->getpackagefeaturesdata(10),
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

					$unqid = $IISMethods->generateuuid();
					
					$insqry['update_uid']=$uid;	
					$insqry['update_date']=$IISMethods->getdatetime();

					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('u','tblpackagemaster',$insqry,$extraparams);
				
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

			$qrychk="SELECT c.id
			from tblpackagemaster c
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

				$qrychk="SELECT c.id
				from tblpackagemaster c
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
				$response['candiamondsearch']=$IISMethods->sanitize($row['candiamondsearch']);
				$response['diamondsearchpfid']=$IISMethods->sanitize($row['diamondsearchpfid']);
				$response['diamondsearchtext']=$IISMethods->sanitize($row['diamondsearchtext']);
				$response['canjewelrysearch']=$IISMethods->sanitize($row['canjewelrysearch']);
				$response['jewelrysearchpfid']=$IISMethods->sanitize($row['jewelrysearchpfid']);
				$response['jewelrysearchtext']=$IISMethods->sanitize($row['jewelrysearchtext']);
				$response['cansharediamondjewelry']=$IISMethods->sanitize($row['cansharediamondjewelry']);
				$response['sharediamondjewelrypfid']=$IISMethods->sanitize($row['sharediamondjewelrypfid']);
				$response['sharediamondjewelrytext']=$IISMethods->sanitize($row['sharediamondjewelrytext']);
				$response['canmembertomemberchat']=$IISMethods->sanitize($row['canmembertomemberchat']);
				$response['membertomemberchatpfid']=$IISMethods->sanitize($row['membertomemberchatpfid']);
				$response['membertomemberchattext']=$IISMethods->sanitize($row['membertomemberchattext']);
				$response['canbuyrequests']=$IISMethods->sanitize($row['canbuyrequests']);
				$response['canbuyrequestspfid']=$IISMethods->sanitize($row['canbuyrequestspfid']);
				$response['canbuyrequeststext']=$IISMethods->sanitize($row['canbuyrequeststext']);
				$response['canlistdiamondforsale']=$IISMethods->sanitize($row['canlistdiamondforsale']);
				$response['listdiamondforsalepfid']=$IISMethods->sanitize($row['listdiamondforsalepfid']);
				$response['listdiamondforsaletext']=$IISMethods->sanitize($row['listdiamondforsaletext']);
				$response['isnolimitlistdiamondforsale']=$IISMethods->sanitize($row['isnolimitlistdiamondforsale']);
				$response['listdiamondforsalelimitvalue']=$IISMethods->sanitize($row['listdiamondforsalelimitvalue']);
				$response['canlistjewelryforsale']=$IISMethods->sanitize($row['canlistjewelryforsale']);
				$response['listjewelryforsalepfid']=$IISMethods->sanitize($row['listjewelryforsalepfid']);
				$response['listjewelryforsaletext']=$IISMethods->sanitize($row['listjewelryforsaletext']);
				$response['listdiamondforsalepfid']=$IISMethods->sanitize($row['listdiamondforsalepfid']);
				$response['cansavanigemsxlexcel']=$IISMethods->sanitize($row['cansavanigemsxlexcel']);
				$response['savanigemsxlexcelpfid']=$IISMethods->sanitize($row['savanigemsxlexcelpfid']);
				$response['savanigemsxlexceltext']=$IISMethods->sanitize($row['savanigemsxlexceltext']);
				$response['canadditionaluseraddon']=$IISMethods->sanitize($row['canadditionaluseraddon']);
				$response['additionaluseraddonpfid']=$IISMethods->sanitize($row['additionaluseraddonpfid']);
				$response['additionaluseraddontext']=$IISMethods->sanitize($row['additionaluseraddontext']);
				$response['isnolimitadditionaluseraddon']=$IISMethods->sanitize($row['isnolimitadditionaluseraddon']);
				$response['additionaluseraddonlimitvalue']=$IISMethods->sanitize($row['additionaluseraddonlimitvalue']);
				$response['canprioritycustomersupport']=$IISMethods->sanitize($row['canprioritycustomersupport']);
				$response['prioritycustomersupportpfid']=$IISMethods->sanitize($row['prioritycustomersupportpfid']);
				$response['prioritycustomersupporttext']=$IISMethods->sanitize($row['prioritycustomersupporttext']);
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
					if(($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
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

		$response['nextpage']=$nextpage;
		if(sizeof($packagemasters)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($packagemasters); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($packagemasters);
		$response['showentries']=$showentries;
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
			$qrychk="select`id`,`packagename`,`monthlyprice`,`annualyprice`,`annualysaveprice`,`candiamondsearch`,`diamondsearchpfid`,
			`diamondsearchtext`,`canjewelrysearch`,`jewelrysearchpfid`,`jewelrysearchtext`,`cansharediamondjewelry`,
			`sharediamondjewelrypfid`,`sharediamondjewelrytext`,`canmembertomemberchat`,`membertomemberchatpfid`,
			`membertomemberchattext`,`canbuyrequests`,`canbuyrequestspfid`,`canbuyrequeststext`,`canlistdiamondforsale`,
			`listdiamondforsalepfid`,`listdiamondforsaletext`,`isnolimitlistdiamondforsale`,`listdiamondforsalelimitvalue`,
			`canlistjewelryforsale`,`listjewelryforsalepfid`,`listjewelryforsaletext`,`cansavanigemsxlexcel`,
			`savanigemsxlexcelpfid`,`savanigemsxlexceltext`,`canadditionaluseraddon`,`additionaluseraddonpfid`,
			`additionaluseraddontext`,`isnolimitadditionaluseraddon`,`additionaluseraddonlimitvalue`,`canprioritycustomersupport`,
			`prioritycustomersupportpfid`,`prioritycustomersupporttext`,`colorcode`,`termsconditionid`,
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

						$tbldata.='<table class="table table-bordered">
							<thead>
								<tr>
									
								</tr>
								
							</thead>
							<tbody>
							<tr>
									<th class="tbl-name">Diamond Search</th>
									<td class="tbl-name">';
									if($row['candiamondsearch']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
									<th class="tbl-name">Jewelry Search</th>
									<td class="tbl-name">';
									if($row['canjewelrysearch']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
									
								</tr>
								<tr>
									<th class="tbl-name">Share Diamonds and Jewelry</th>
									<td class="tbl-name">';
									if($row['cansharediamondjewelry']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
									<th class="tbl-name">Member to Member Chat</th>
									<td class="tbl-name">';
									if($row['canmembertomemberchat']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
								</tr>
								<tr>
									<th class="tbl-name">Buy Requests</th>
									<td class="tbl-name">';
									if($row['canbuyrequests']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
									<th class="tbl-name">List Diamonds for Sale</th>
									<td class="tbl-name">';
									if($row['canlistdiamondforsale']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									if($row['canlistdiamondforsale']==1)
									{
										if($row['isnolimitlistdiamondforsale']==1)
										{
											$tbldata.=' (Unlimited)';
										}	
										else
										{
											$tbldata.=' (Limited | '.$row['listdiamondforsalelimitvalue'].')';
										}
									}	
									$tbldata.='</td>
								</tr>
								<tr>
									<th class="tbl-name">List Jewelry for Sale</th>
									<td class="tbl-name">';
									if($row['canlistjewelryforsale']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
									<th class="tbl-name">Trade CVD XL for Excel</th>
									<td class="tbl-name">';
									if($row['cansavanigemsxlexcel']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
								</tr>
								
								<tr>
									<th class="tbl-name">Additional Users Add-on</th>
									<td class="tbl-name">';
									if($row['canadditionaluseraddon']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									if($row['canadditionaluseraddon']==1)
									{
										if($row['isnolimitadditionaluseraddon']==1)
										{
											$tbldata.=' (Unlimited)';
										}	
										else
										{
											$tbldata.=' (Limited | '.$row['additionaluseraddonlimitvalue'].')';
										}
									}

									$tbldata.='</td>
									<th class="tbl-name">Priority Customer Support</th>
									<td class="tbl-name">';
									if($row['cansavanigemsxlexcel']==1)
									{
										$tbldata.='Yes';
									}else {$tbldata.='No';}
									$tbldata.='</td>
								</tr>
							</tbody>
						</table>';
				
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

  