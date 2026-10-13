<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/package.php';

if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action=='listpackagetype')
	{
		$packagetype= new packagetype();
		$qry="SELECT id,typeid,name FROM tblpackagetype ORDER BY displayorder";
		$parms = array();
		$result=$DB->getmenual($qry,$parms,'packagetype');

		if(sizeof($result)>0) 
		{

			$response['data']=$result;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}

		
	}
	else if($action == 'listpackagedetail')
	{
		$package=new package();

		$typeid=$IISMethods->sanitize($_POST['typeid']);

        
		$qry="SELECT p.`id`,p.`packagename`,p.`colorcode`,case when(".$typeid."=1) THEN p.`annualyprice` ELSE p.`monthlyprice` END AS price,p.`monthlyprice`,p.`annualyprice`,p.`annualysaveprice`,p.`shortdescr`,p.`ispopular`,CASE WHEN (p.`ispopular`=1) THEN 'MOST POPULAR' ELSE '' END AS populartext FROM `tblpackagemaster` p WHERE p.isactive=1 ORDER BY p.`displayorder`";
		$parms = array();
		$result=$DB->getmenual($qry,$parms,'package');
		if(sizeof($result)>0)
		{
				$response['package']=$result;

				for($k=0;$k<sizeof($result);$k++)
				{
					$ins_packageid=$result[$k]->getId();

					$packagedetails = new packagedetails();
					$querypd="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,ifnull(pf.inputboxlabel,'') AS inputboxlabel 
					FROM `tblpackagedetails` pd
					inner join tblpackagefeatures pf on pf.pfid=pd.pfid
					WHERE pd.packageid=:packageid";
					$paramspd=array(':packageid'=>$ins_packageid);
					$packagedetails=$DB->getmenual($querypd,$paramspd,'packagedetails');
					if(sizeof($packagedetails)>0) 
					{
						$result[$k]->setpackagedetail($packagedetails);
					}	
				}









			$packagefeatures= new packagefeatures();
			$qrypf="SELECT pf.`id`,pf.`pfid`,pf.`name`,pf.`printname` FROM `tblpackagefeatures` pf WHERE pf.`isactive`=1 ORDER BY pf.`displayorder`";
			$parmspf = array();
			$packagefeatures=$DB->getmenual($qrypf,$parmspf,'packagefeatures');

			if(sizeof($packagefeatures)>0) 
			{
				$response['packagefeatures']=$packagefeatures;
					
				// for($i=0;$i<sizeof($packagefeatures);$i++)
				// {
				// 	$ins_pfid=$packagefeatures[$i]->getpfid();
					

				// 	// $rowpf=$packagefeatures[$i];
				// 	// $response['packagefeatures'][$i]['id']=$rowpf['id'];
				// 	// $response['packagefeatures'][$i]['pfid']=$rowpf['pfid'];
				// 	// $response['packagefeatures'][$i]['name']=$rowpf['name'];
				// 	// $response['packagefeatures'][$i]['printname']=$rowpf['printname'];

				// 	$packagedata = new packagedata();
				// 	$qrypackage="SELECT p.`id` FROM `tblpackagemaster` p WHERE p.isactive=1 ORDER BY p.`displayorder`";
				// 	$parmspackage = array();
				// 	$result_ary=$DB->getmenual($qrypackage,$parmspackage,'packagedata');
				// 	if(sizeof($result_ary)>0) 
				// 	{
				// 		for($p=0;$p<sizeof($result_ary);$p++)
				// 		{
				// 			$ins_packageid=$result_ary[$p]->getId();

				// 			$packagedetails = new packagedetails();
				// 			$querypd="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,ifnull(pf.inputboxlabel,'') AS inputboxlabel 
				// 			FROM `tblpackagedetails` pd
				// 			inner join tblpackagefeatures pf on pf.pfid=pd.pfid
				// 			WHERE pd.pfid=:pfid AND pd.packageid=:packageid";
				// 			$paramspd=array(':pfid'=>$ins_pfid,':packageid'=>$ins_packageid);
				// 			$packagedetails=$DB->getmenual($querypd,$paramspd,'packagedetails');
				// 			if(sizeof($packagedetails)>0) 
				// 			{
				// 				$result_ary[$p]->setpackagedata($packagedetails);

								
				// 				// $rowpd=$packagedetails[0];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['id']=$rowpd['id'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['packageid']=$rowpd['packageid'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['pfid']=$rowpd['pfid'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['attributeval']=$rowpd['attributeval'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['isnolimit']=$rowpd['isnolimit'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['limitvalue']=$rowpd['limitvalue'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['pfname']=$rowpd['pfname'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['printname']=$rowpd['printname'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['haslimit']=$rowpd['haslimit'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['withinputbox']=$rowpd['withinputbox'];
				// 				// $response['packagefeatures'][$i]['packagedetails'][$p]['inputboxlabel']=$rowpd['inputboxlabel'];
				// 					// echo $pd.'---';
								
				// 			}
				// 		}
				// 	}
				// 	$packagefeatures[$i]->setpackagedetail($result_ary);	
					
					
				// }	
				// $response['packagefeatures']=$packagefeatures;
			}

			$status=1;
			$message=$errmsg['success'];
		}
        else
        {
			$status=0;
			$message=$errmsg['nodatafound'];
		}

		$response['typeid']=$typeid;

	}
	else if($action=='packageassign')
	{
		$packageid=$IISMethods->sanitize($_POST['packageid']);
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$datetime=$IISMethods->getdatetime();

		$targeturl='';
		$qry="SELECT id,packagename,monthlyprice,annualysaveprice,annualyprice,colorcode,termsconditionid,termscondition,shortdescr,descr,displayorder,ispopular,
			  case when(".$typeid."=1) THEN `annualyprice` ELSE `monthlyprice` END AS price,
			  CASE WHEN(".$typeid."=1) THEN DATE_FORMAT(DATE_ADD('".date('Y-m-d')."', INTERVAL 1 YEAR),'%d/%m/%Y') ELSE  DATE_FORMAT(DATE_ADD('".date('Y-m-d')."', INTERVAL 1 MONTH),'%d/%m/%Y') END AS expirydate
			  FROM tblpackagemaster 
			  WHERE id=:id AND isactive=1";
		$params=array(':id'=>$packageid);
		$res=$DB->getmenual($qry,$params);
		if(sizeof($res)>0) 
		{
			$row=$res[0];
			if($LoginInfo->getIsguestuser()==1)
			{
				$status=0;
				$message=$errmsg['sessiontimeout'];
			}	
			else
			{
				try 
				{
					$DB->begintransaction();
					$unqid = $IISMethods->generateuuid();
					$transactionid=uniqid('SG');

					$qrychk="SELECT personname from tblpersonmaster where ifnull(isdelete,0)=0 AND ifnull(isverified,0)=1 AND id=:uid";
					$parms = array(
						':uid'=>$uid,
					);
					$result_ary=$DB->getmenual($qrychk,$parms);
					$rowperson=$result_ary[0];

					$insqry=array(
						'id'=>$unqid,
						'type'=>1,
						'transactionid'=>$transactionid,
						'packageid'=>$packageid,
						'uid'=>$uid,
						'personname'=>$rowperson['personname'],
						'packagetypeid'=>$typeid,
						'amount'=>$row['price'],
						'codeid'=>'',
						'code'=>'',
						'disctype'=>'',
						'discper'=>'',
						'discamt'=>'',
						'totalamt'=>$row['price'],
						'finalamount'=>$row['price'],
						'ind_amount'=>$row['price'],
						'abd_amount'=>$row['price'],
						'packactivatedate'=>date('d/m/Y'),
						'expirydate'=>$row['expirydate'],
						'description'=>'',
						'status'=>0,
						'platform'=>$platform,
						'entry_uid'=>$uid,
						'entry_date'=>$datetime,
						'update_uid'=>$uid,
						'update_date'=>$datetime,
						'payment_id'=>'',
						'pg_id'=>'',
						'pg_status'=>'',
						'pg_currency'=>'',
						'pg_amount'=>'',
						'pg_fees'=>'',
						'pg_instrument_type'=>'',
						'pg_billing_instrument'=>'',
						'pg_failure'=>'',
						'pg_array'=>'',
						'sessionarr'=>json_encode($LoginInfo,true),
						'isupgrade'=>'',
						'upgradepackassignid'=>'',
						'upgradedate'=>'',
						'upgradetoid'=>'',
						'isaddon'=>'',
						'paytype'=>'',
						'referenceno'=>'',
						'packassigndescr'=>'',
						'montlysuggestdate'=>'',
						'discountper'=>'',
						'discountamount'=>'',
						'inactiveexpired'=>'',
						'actualdate'=>'',
						'pendingdays'=>'',
						'deactivedate'=>'',
						'deactivedatetime'=>'',
						'reactivepack'=>'',
						'mainexpirydate'=>$row['expirydate'],
						'timestamp'=>$datetime,
						'packagename'=>$row['packagename'],
						'monthlyprice'=>$row['monthlyprice'],
						'annualyprice'=>$row['annualyprice'],
						'annualysaveprice'=>$row['annualysaveprice'],
						'colorcode'=>$row['colorcode'],
						'termsconditionid'=>$row['termsconditionid'],
						'termscondition'=>$row['termscondition'],
						'shortdescr'=>$row['shortdescr'],
						'descr'=>$row['descr'],
						'displayorder'=>$row['displayorder'],
						'ispopular'=>$row['ispopular']
					);
					$DB->executedata('i','tblpackageassign',$insqry,'');

					$querypd="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,pf.inputboxlabel
					FROM `tblpackagedetails` pd
					inner join tblpackagefeatures pf on pf.pfid=pd.pfid
					WHERE pd.packageid=:packageid";
					$paramspd=array(':packageid'=>$row['id']);
					$respd=$DB->getmenual($querypd,$paramspd);
					if(sizeof($respd)>0) 
					{
						for($i=0;$i<sizeof($respd);$i++)
						{
							$rowpd=$respd[$i];
							$pdunqid = $IISMethods->generateuuid();
							$insdetail=array(
								'id'=>$pdunqid,
								'packassignid'=>$unqid,
								'qty'=>1,
								'activateddate'=>date('d/m/Y'),
								'expirydate'=>$row['expirydate'],
								'str_expirydate'=>$row['expirydate'],
								'isstatus'=>0,
								'packagetypeid'=>$typeid,
								'uid'=>$uid,
								'packageid'=>$row['id'],
								'status'=>0,
								'price'=>$row['price'],
								'pfid'=>$rowpd['pfid'],
								'attributeval'=>$rowpd['attributeval'],
								'isnolimit'=>$rowpd['isnolimit'],
								'limitvalue'=>$rowpd['limitvalue'],
								'pfname'=>$rowpd['pfname'],
								'pfprintname'=>$rowpd['printname'],
								'displayorder'=>$rowpd['displayorder'],
								'haslimit'=>$rowpd['haslimit'],
								'withinputbox'=>$rowpd['withinputbox'],
								'inputboxlabel'=>$rowpd['inputboxlabel'],
								'isupgrade'=>'',
								'isaddon'=>'',
								'actualdate'=>'',
								'deactivedate'=>'',
								'deactivedatetime'=>'',
								'reactivepack'=>'',
								'mainexpirydate'=>'',
								'entry_uid'=>$uid,
								'entry_date'=>$datetime,
								'update_uid'=>'',
								'update_date'=>'',
								'timestamp'=>$datetime,
							);
							$DB->executedata('i','tblpackageassigndetail',$insdetail,'');
						}	
					}	
					// GENERATE PAYMENT TOKEN

					

					$response['packageassignid']=(string)$unqid;

					$status = 1;
					$message = $errmsg['insert'];

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
		else
		{
			$status=0;
			$message=$errmsg['packageunavailable'];
		}

			
		$response['packageid']=$packageid;
		$response['targeturl']=$targeturl;
	}
	else if($action=='checkpackageassignstatus')
	{
		$packageassignid=$IISMethods->sanitize($_POST['packageassignid']);
		$datetime=$IISMethods->getdatetime();
		if($packageassignid)
		{
			if($LoginInfo->getIsguestuser()==1)
			{
				$status=0;
				$message=$errmsg['sessiontimeout'];
			}	
			else
			{
				$qrychk="SELECT id from tblpackageassign where id=:id AND status=0 AND uid=:uid";
				$parms = array(
					':id'=>$packageassignid,
					':uid'=>$uid,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary)>0) 
				{
					try 
					{
						$DB->begintransaction();
						$insqry=array(					
							'status'=>1,
							'update_uid'=>$uid,
							'update_date'=>$datetime,
							'pay_status'=>1,
							'pay_datetime'=>$datetime,
						);
						$ary=array(
							'id'=>$packageassignid,
						);
						$DB->executedata('u','tblpackageassign',$insqry,$ary);

						$insdetailqry=array(					
							'status'=>1,
							'isstatus'=>1,
							'update_uid'=>$uid,
							'update_date'=>$datetime,
						);
						$arydetail=array(
							'packassignid'=>$packageassignid,
						);
						$DB->executedata('u','tblpackageassigndetail',$insdetailqry,$arydetail);


						$status = 1;
						$message = $errmsg['packageassigned'];
						
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
					$message=$errmsg['nopackagefound'];
				}
			}	
		}


	}
	else if($action=='listpackagerights')
	{
		$userpackagefeatures= new userpackagefeatures();
		$query="SELECT `id`,`pfid`,`name`,`printname`,`displayorder`,`isactive` FROM `tblpackagefeatures` ORDER BY displayorder";
		$params=array();
		$result=$DB->getmenual($query,$params,'userpackagefeatures');
		if(sizeof($result)>0) 
		{

		}
	}
	

	
}
require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  