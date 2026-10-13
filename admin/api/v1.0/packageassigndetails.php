<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/packageassigndetails.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listpackageassigndetails')   
	{
		$packageassigndetails=new packageassigndetails();

		$fltpackagetypeid=$IISMethods->sanitize($_POST['fltpackagetypeid']);
		$fltpackageid=$IISMethods->sanitize($_POST['fltpackageid']);
		$fltpersonid=$IISMethods->sanitize($_POST['fltpersonid']);

		$fltfromdate=$IISMethods->sanitize($_POST['fltfromdate']);
		$flttodate=$IISMethods->sanitize($_POST['flttodate']);

		$qry="SELECT p.timestamp as primary_date,p.`id`,p.`type`,p.`transactionid`,p.`packageid`,p.`uid`,p.`personname` AS pname,p.`packagetypeid`,p.`amount`,p.`codeid`,p.`code`,p.`disctype`,p.`discper`,p.`discamt`,p.`totalamt`,
                p.`finalamount`,p.`ind_amount`,p.`abd_amount`,p.`packactivatedate`,p.`expirydate`,p.`description`,p.`status`,p.`platform`,p.`entry_uid`,p.`entry_date`,p.`update_uid`,p.`update_date`,
                p.`timestamp`,p.`packagename`,p.`monthlyprice`,p.`annualyprice`,p.`annualysaveprice`,p.`colorcode`,p.`termsconditionid`,p.`termscondition`,p.`shortdescr`,
                p.`descr`,p.`displayorder`,p.`ispopular`,pm.`personname`,pm.`email`,pm.`companyname`,pm.`businessphoneno`,pm.`businesscompanyno`,pm.`businesstype`,
                case when(p.packagetypeid=1) THEN 'Annually' ELSE 'Monthly' END AS packagetype
                FROM `tblpackageassign` p 
                INNER JOIN `tblpersonmaster`pm ON pm.`id`=p.`uid`
		     where p.status=1 AND  (p.`transactionid` like :transactionidfilter or case when(p.packagetypeid=1) THEN 'Annually' ELSE 'Monthly' END like :packagetypefilter  or p.`packagename` like :packagenamefilter or p.`totalamt` like :totalamtfilter or pm.`personname` like :personnamefilter or pm.`email` like :emailfilter 
             or pm.`companyname` like :companynamefilter or pm.`businessphoneno` like :businessphonenofilter or pm.`businesscompanyno` like :businesscompanynofilter or pm.`businesstype` like :businesstypefilter 
			 or p.`packactivatedate` like :packactivatedatefilter or p.`expirydate` like :expirydatefilter or p.entry_date like :entry_datefilter)";
		$parms = array(
			':transactionidfilter'=>$filter,
            ':totalamtfilter'=>$filter,
            ':personnamefilter'=>$filter,
            ':emailfilter'=>$filter,
            ':companynamefilter'=>$filter,
            ':businessphonenofilter'=>$filter,
            ':businesscompanynofilter'=>$filter,
            ':businesstypefilter'=>$filter,
			':packagenamefilter'=>$filter,
			':packagetypefilter'=>$filter,
			':packactivatedatefilter'=>$filter,
			':expirydatefilter'=>$filter,
			':entry_datefilter'=>$filter,
		);
		if($fltpackagetypeid)
		{
			$qry.=" AND p.packagetypeid like :packagetypeid";
			$parms[':packagetypeid']=$fltpackagetypeid;
		}
		if($fltpackageid)
		{
			$qry.=" AND p.packageid like :packageid";
			$parms[':packageid']=$fltpackageid;
		}
		if($fltpersonid)
		{
			$qry.=" AND p.uid like :uid";
			$parms[':uid']=$fltpersonid;
		}

		if($fltfromdate && $flttodate)
		{
			$qry.=" AND (STR_TO_DATE(p.`packactivatedate`,'%d/%m/%Y') BETWEEN STR_TO_DATE(:fltfromdate,'%d/%m/%Y') AND STR_TO_DATE(:flttodate,'%d/%m/%Y') 
			OR STR_TO_DATE(:fltfromdate1,'%d/%m/%Y') BETWEEN STR_TO_DATE(p.`packactivatedate`,'%d/%m/%Y') AND STR_TO_DATE(p.`expirydate`,'%d/%m/%Y'))";
			$parms[':fltfromdate']=$fltfromdate;
			$parms[':fltfromdate1']=$fltfromdate;
			$parms[':flttodate']=$flttodate;
		}


        $qry.=" order by $ordbycolumnname $ordby LIMIT $start, $per_page";
        // print_r($parms);
		$packageassigndetails=$DB->getmenual($qry,$parms,'packageassigndetails');
		
		if($responsetype=='HTML')
		{
			if($packageassigndetails)
			{
				$i=0;
				foreach($packageassigndetails as $row)
				{
					$id="'".$row->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

					
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewpackageassigndetails('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($row->transactionid).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->personname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->packagename).'</td>';
                    $htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->packagetype).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->packactivatedate).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->expirydate).'</td>';
					$htmldata.='<td class="tbl-name">$'.$IISMethods->sanitize($row->totalamt).'</td>';
                    $htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->entry_date).'</td>';
					
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($packageassigndetails)<=0)
				{
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
			$response['data']= json_encode($packageassigndetails);
		}

		$common_listdata=$packageassigndetails;
	}    

	else if($action=='viewpackageassigndetails')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT p.timestamp as primary_date,p.`id`,p.`type`,p.`transactionid`,p.`packageid`,p.`uid`,p.`personname`,p.`packagetypeid`,p.`amount`,p.`codeid`,p.`code`,p.`disctype`,p.`discper`
            ,p.`discamt`,p.`totalamt`,
            p.`finalamount`,p.`ind_amount`,p.`abd_amount`,p.`packactivatedate`,p.`expirydate`,p.`description`,p.`status`,p.`platform`,p.`entry_uid`,p.`entry_date`,p.`update_uid`,p.`update_date`,
            p.`timestamp`,p.`packagename`,p.`monthlyprice`,p.`annualyprice`,p.`annualysaveprice`,p.`colorcode`,p.`termsconditionid`,p.`termscondition`,p.`shortdescr`,
            p.`descr`,p.`displayorder`,p.`ispopular`,pm.`personname`,pm.`email`,pm.`companyname`,pm.`businessphoneno`,pm.`businesscompanyno`,pm.`businesstype`,
            case when(p.packagetypeid=1) THEN 'Annually' ELSE 'Monthly' END AS packagetype
            FROM `tblpackageassign` p 
            INNER JOIN `tblpersonmaster`pm ON pm.`id`=p.`uid`
            where p.status=1 AND p.id=:id";
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
					$tbldata.='<label>Transaction ID <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['transactionid'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Amount <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>$'.$row['totalamt'].'</b></label>';
					$tbldata.='</div></div></div>';

					

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Date <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['entry_date'].'</b></label>';
					$tbldata.='</div></div></div>';

				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';										
				$tbldata.='</div>';


				//User Details
				$tbldata.='<div class="col-lg-12 col-md-12 col-12 layout-spacing">';
					$tbldata.='<div class="widget mt-10">';
						$tbldata.='<div class="widget-title  mb-2"><b>User Details</b></div>';
						$tbldata.='<div class="widget-content row">';

                            $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                            $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                            $tbldata.='<label>User Name <span>:</span></label>';
                            $tbldata.='</div>';
                            $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                            $tbldata.='<label class="label-view"><b>'.$row['personname'].'</b></label>';
                            $tbldata.='</div></div></div>';

                            $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                            $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                            $tbldata.='<label>Email Address <span>:</span></label>';
                            $tbldata.='</div>';
                            $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                            $tbldata.='<label class="label-view"><b>'.$row['email'].'</b></label>';
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
                            $tbldata.='<label>Business Phone No. <span>:</span></label>';
                            $tbldata.='</div>';
                            $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                            $tbldata.='<label class="label-view"><b>'.$row['businessphoneno'].'</b></label>';
                            $tbldata.='</div></div></div>';

                            $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                            $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                            $tbldata.='<label>Business Company No. <span>:</span></label>';
                            $tbldata.='</div>';
                            $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                            $tbldata.='<label class="label-view"><b>'.$row['businesscompanyno'].'</b></label>';
                            $tbldata.='</div></div></div>';

                            $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                            $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                            $tbldata.='<label>Business Type <span>:</span></label>';
                            $tbldata.='</div>';
                            $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                            $tbldata.='<label class="label-view"><b>'.$row['businesstype'].'</b></label>';
                            $tbldata.='</div></div></div>';

						$tbldata.='</div>';
					$tbldata.='</div>';
				$tbldata.='</div>';

				//Package Details
				$tbldata.='<div class="col-lg-12 col-md-12 col-12 layout-spacing">';
					$tbldata.='<div class="widget mt-10">';
						$tbldata.='<div class="widget-title  mb-2"><b>Package Details</b></div>';
						$tbldata.='<div class="widget-content row">';

                                $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                                $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                $tbldata.='<label>Package Name <span>:</span></label>';
                                $tbldata.='</div>';
                                $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                                $tbldata.='<label class="label-view"><b>'.$row['packagename'].'</b></label>';
                                $tbldata.='</div></div></div>';
                           
                                $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                                $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                $tbldata.='<label>Package Type <span>:</span></label>';
                                $tbldata.='</div>';
                                $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                                $tbldata.='<label class="label-view"><b>'.$row['packagetype'].'</b></label>';
                                $tbldata.='</div></div></div>';

                                $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                                $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                $tbldata.='<label>Active Date <span>:</span></label>';
                                $tbldata.='</div>';
                                $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                                $tbldata.='<label class="label-view"><b>'.$row['packactivatedate'].'</b></label>';
                                $tbldata.='</div></div></div>';

                                $tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
                                $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                $tbldata.='<label>Expiry Date <span>:</span></label>';
                                $tbldata.='</div>';
                                $tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
                                $tbldata.='<label class="label-view"><b>'.$row['expirydate'].'</b></label>';
                                $tbldata.='</div></div></div>';
                         
                       $tbldata.='</div>';
					$tbldata.='</div>';
				$tbldata.='</div>';


				//Billing Details
				

				//Item Details
				$qry="SELECT `id`,`packassignid`,`qty`,`activateddate`,`expirydate`,`str_expirydate`,`isstatus`,`packagetypeid`,`uid`,`packageid`,`status`,`price`,`pfid`,`attributeval`,`isnolimit`,`limitvalue`,`pfname`,`pfprintname`,`displayorder`,`haslimit`,`withinputbox`,`inputboxlabel`,`isupgrade`,`isaddon`,`actualdate`,`deactivedate`,`deactivedatetime`,`reactivepack`,`mainexpirydate`,`entry_uid`,`entry_date`,`update_uid`,`update_date`,`timestamp`
                    FROM `tblpackageassigndetail` 
					where packassignid=:id";
				$parms = array(
					':id'=>$id,
				);
				$items=$DB->getmenual($qry,$parms);
				if($items)
				{
					$tbldata.='<div class="col-lg-12 col-md-12 col-12 layout-spacing">';
						$tbldata.='<div class="widget mt-10">';
							$tbldata.='<div class="widget-title  mb-2"><b>Package Features Details</b></div>';
							$tbldata.='<div class="widget-content row">';

								$tbldata.='<div class="col-12 col-sm-6 col-md-12 col-lg-12">';
								$tbldata.='<div class="row1">';
								$tbldata.='<div class="table-responsive pt-2">';
								$tbldata.='<div class="col-12 p-0">';
								$tbldata.='<table class="table table-bordered table-hover table-striped">';
								$tbldata.='<thead>';
								$tbldata.='</thead>';
								$tbldata.='<tbody id="tblviewsubdata">';
								
								$htmldata1='';
								for($i=0;$i<sizeof($items);$i++)
                                {
                                    $rowpd=$items[$i];
                                
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
								$tbldata.='</tbody>';
								$tbldata.='</table>';
								$tbldata.='</div>';
								$tbldata.='</div>';
								$tbldata.='</div>';
								$tbldata.='</div>';


							$tbldata.='</div>';
						$tbldata.='</div>';
					$tbldata.='</div>';
					
                    //Summary
                    $tbldata.='<div class="col-lg-12 col-md-12 col-12 layout-spacing">';
                        $tbldata.='<div class="widget mt-10">';
                            // $tbldata.='<div class="widget-title  mb-2"><b>Summary</b></div>';
                            $tbldata.='<div class="widget-content row">';

                                

                                if($row['termscondition'])
                                {
                                    $tbldata.='<div class="col-12 col-lg-12 col-xl-12 "><div class="row">';
                                    $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                    $tbldata.='<label><h4><b>Terms & Conditions</b></h4> <span>:</span></label>';
                                    $tbldata.='</div>';
                                    $tbldata.='<div class="col-12 col-sm-12 col-lg-12">';
                                    $tbldata.='<label class="label-view">'.$row['termscondition'].'</label>';
                                    $tbldata.='</div></div></div>';
                                }

                                if($row['shortdescr'])
                                {
                                    $tbldata.='<div class="col-12 col-lg-12 col-xl-12 "><div class="row">';
                                    $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                    $tbldata.='<label><h4><b>Short Description</b></h4> <span>:</span></label>';
                                    $tbldata.='</div>';
                                    $tbldata.='<div class="col-12 col-sm-12 col-lg-12">';
                                    $tbldata.='<label class="label-view">'.$row['shortdescr'].'</label>';
                                    $tbldata.='</div></div></div>';
                                }


                                if($row['descr'])
                                {
                                    $tbldata.='<div class="col-12 col-lg-12 col-xl-12 "><div class="row">';
                                    $tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
                                    $tbldata.='<label><h4><b>Description</b></h4> <span>:</span></label>';
                                    $tbldata.='</div>';
                                    $tbldata.='<div class="col-12 col-sm-12 col-lg-12">';
                                    $tbldata.='<label class="label-view"><b>'.$row['descr'].'</label>';
                                    $tbldata.='</div></div></div>';
                                }

                               

                            $tbldata.='</div>';
                        $tbldata.='</div>';
                    $tbldata.='</div>';

				}
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
	else if($action=='fillpackage')
	{
		$qry="select id,packagename AS name from tblpackagemaster WHERE isactive=:isactive ORDER BY packagename";
		$parms = array(':isactive'=>1);
		$package=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($package)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($package as $row)
				{
					$htmldata.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$package;
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
	else if($action=='fillperson')
	{
		$qry="select pm.id,pm.personname AS name,pm.email 
			 from tblpersonmaster pm 
			 inner join tblpackageassign pa on pa.uid=pm.id
			 WHERE pm.isactive=:isactive AND pm.isverified=:isverified
			 GROUP BY pm.id
			 ORDER BY pm.personname";
		$parms = array(':isactive'=>1,':isverified'=>1);
		$package=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($package)>0)
		{
			if($responsetype=='HTML')
			{
				foreach($package as $row)
				{
					$htmldata.='<option value="'.$row['id'].'">'.$row['name'].' ('.$row['email'].')</option>';
				}

				$response['data']=$htmldata;
			}
			else if($responsetype=='JSON')
			{
				$response['data']=$package;
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


}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  