<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/customer.php';

// echo '123';
if($isvalidUser['status'] == 1) 
{

	// echo '123';
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listcustomer')   
	{
		
		$customers=new customer();
		
		$qry="SELECT pm.timestamp as primary_date,pm.id,pm.savaniid,pm.personname,pm.email,pm.companyname,pm.businesstype,pm.businessphoneno,pm.phonecode,pm.countryname,pm.statename,
        pm.cityname,pm.pincode,pm.isactive,DATE_FORMAT(pm.entry_date, '%d/%m/%Y %h:%i %p') AS entry_date,DATE_FORMAT(pm.entry_date, '%d/%m/%Y %h:%i %p') AS entry_date,
		DATEDIFF(IFNULL((SELECT STR_TO_DATE(pa.expirydate, '%d/%m/%Y') FROM `tblpackageassign` pa WHERE pa.isactive=1 AND pa.uid=pm.id GROUP BY pa.uid),:curdate), :curdate) AS expirydays
        FROM `tblpersonmaster` pm INNER JOIN `tblpersonutype` ut ON ut.pid=pm.id 
        WHERE IFNULL(pm.isdelete,0)=0 AND ut.utypeid=:utypeid 
        AND (pm.savaniid like :filter or pm.personname like :filter or pm.email like :filter or pm.companyname like :filter or pm.businesstype like :filter 
        or pm.businessphoneno like :filter or pm.phonecode like :filter or pm.countryname like :filter or pm.statename like :filter or pm.cityname like :filter 
        or pm.pincode like :filter or pm.entry_date like :filter or DATEDIFF(IFNULL((SELECT STR_TO_DATE(pa.expirydate, '%d/%m/%Y') FROM `tblpackageassign` pa WHERE pa.isactive=1 AND pa.uid=pm.id GROUP BY pa.uid),:curdate), :curdate) LIKE :filter) GROUP BY pm.id order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		// echo $config->getcustomerutypeid();
        $parms = array(
            ':utypeid'=>$config->getcustomerutypeid(),
            ':curdate'=>$IISMethods->getformatcurrdate(),
			':filter'=>$filter,
		);
		// print_r($parms); 
		/* echo $qry;
		print_r($parms); */
		$customers=$DB->getmenual($qry,$parms,'customer');
		
		if($responsetype=='HTML')
		{
			if($customers)
			{
				$i=0;
				foreach($customers as $customer)
				{
					$id="'".$customer->id."'";
					$htmldata.='<tr data-index="'.$i.'">';
					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='</td>';
					}
					if($IISMethods->sanitize($customer->savaniid)){
						$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Customer Details" onclick="viewcustomerdata('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($customer->savaniid).'</a></td>';
					}
					else{
						$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Customer Details" onclick="viewcustomerdata('.$IISMethods->sanitize($id).')">-</a></td>';
					}
					$htmldata.='<td class="tbl-name text-break">'.$IISMethods->sanitize($customer->personname).'</td>';
                    $htmldata.='<td class="tbl-name text-break">'.$IISMethods->sanitize($customer->email).'</td>';
					$htmldata.='<td class="tbl-name text-break">'.$IISMethods->sanitize($customer->companyname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->businesstype).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->phonecode).' '.$IISMethods->sanitize($customer->businessphoneno).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->countryname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->statename).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->cityname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->pincode).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($customer->entry_date).'</td>';
					$htmldata.='<td class="tbl-name text-center">'.$IISMethods->sanitize($customer->expirydays).'</td>';
					$htmldata.='<td class="tbl-name text-center"><a href="javascript:void(0);" class="btn-tbl text-primary  tblinfo" data-toggle="tooltip" data-placement="top" title="Info" onclick="viewactivepackageassigndetails('.$IISMethods->sanitize($id).')"><i class="bi bi-info-lg"></i></a></a></td>';
					
                    if((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						if($customer->isactive==1)
						{
							$htmldata.='<td class="tbl-name"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="changeisactivecustomermaster('.$id.')" checked>';
							$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="changeisactivecustomermaster('.$id.')">';
							$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
					}
                    $htmldata.='<td class="tbl-name"><a href="javascript:void(0);" class="btn-tbl text-primary  tblinfo" data-toggle="tooltip" data-placement="top" title="Info" onclick="logoutfromalldevice('.$IISMethods->sanitize($id).')"><i class="bi bi-power"></i></a></a></td>';
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($customers)<=0)
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
			$response['data']= json_encode($customers);
		}

		$common_listdata=$customers;
	}
    else if($action=='changeisactivecustomermaster')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();
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
	else if($action=='viewcustomerdata')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT pm.id,pm.businesswebsite,pm.businesscompanyno,pm.address,pm.additionaladdress,pm.emergencypersonname,pm.emergencypersonname1
			FROM `tblpersonmaster` pm 
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
					$tbldata.='<label>Website <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['businesswebsite'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Company No. <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['businesscompanyno'].'</b></label>';
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
					$tbldata.='<label>Additional Address <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['additionaladdress'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Reference Person 1 <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['emergencypersonname'].'</b></label>';
					$tbldata.='</div></div></div>';

					$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-5 text-dot-right pr-sm-0">';
					$tbldata.='<label>Reference Person 2 <span>:</span></label>';
					$tbldata.='</div>';
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<label class="label-view"><b>'.$row['emergencypersonname1'].'</b></label>';
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
	
	else if($action=='viewactivepackageassigndetails')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT p.timestamp AS primary_date,p.`id`,p.`type`,p.`transactionid`,p.`packageid`,p.`uid`,p.`personname`,p.`packagetypeid`,p.`amount`,p.`codeid`,p.`code`,p.`disctype`,p.`discper`
            ,p.`discamt`,p.`totalamt`,
            p.`finalamount`,p.`ind_amount`,p.`abd_amount`,p.`packactivatedate`,p.`expirydate`,p.`description`,p.`status`,p.`platform`,p.`entry_uid`,p.`entry_date`,p.`update_uid`,p.`update_date`,
            p.`timestamp`,p.`packagename`,p.`monthlyprice`,p.`annualyprice`,p.`annualysaveprice`,p.`colorcode`,p.`termsconditionid`,p.`termscondition`,p.`shortdescr`,
            p.`descr`,p.`displayorder`,p.`ispopular`,pm.`personname`,pm.`email`,pm.`companyname`,pm.`businessphoneno`,pm.`businesscompanyno`,pm.`businesstype`,
            CASE WHEN(p.packagetypeid=1) THEN 'Annually' ELSE 'Monthly' END AS packagetype
            FROM `tblpersonmaster` pm 
            INNER JOIN `tblpackageassign` p ON p.`uid`=pm.`id`
            WHERE p.isactive=1 AND p.uid=:id";
			$parms = array(
				':id'=>$id,
			);
			// echo $qrychk;
			// print_r($parms);
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
					where uid=:id";
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
			else
			{
				$tbldata.='<div class="col-12">';
				$tbldata.='<div class="table-responsive">';
				$tbldata.='<div class="col-12 view-data-details">';
				$tbldata.='<div class="row my-3">';
				$tbldata.='<div class="col-12 col-md-8 col-lg">';
				$tbldata.='<div class="row">';

				$tbldata.='<div class="col-12 text-center"><div class="row">';
				$tbldata.='<h4>No Any Active Package Available!</h4>';
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
	else if($action=='logoutfromalldevice')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();
				$qrychk="select id from tbldevice where uid=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms); 
				if(sizeof($result_ary)>0)
				{
					$extraparams=array(
						'uid'=>$id
					);
					$DB->executedata('d','tbldevice','',$extraparams);
				}

				$status=1;
				$message=$errmsg['logoutalldevice'];

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

  