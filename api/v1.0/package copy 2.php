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
	else if($action=='listpackagedetail')
	{
		$package=new package();

		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$id=$IISMethods->sanitize($_POST['id']);
		$currdate=$IISMethods->getcurrdate();
     
		
		if($responsetype=='JSON')
		{
			// echo '123';
			$qry="SELECT p.`id`,p.`packagename`,p.`colorcode`,case when(".$typeid."=1) THEN p.`annualyprice` ELSE p.`monthlyprice` END AS price,p.`monthlyprice`,p.`annualyprice`,p.`annualysaveprice`,p.`shortdescr`,p.`ispopular`,p.termscondition,descr,CASE WHEN (p.`ispopular`=1) THEN 'MOST POPULAR' ELSE '' END AS populartext 
				  FROM `tblpackagemaster` p 
				  WHERE p.isactive=1 ";
			$parms = array();
			if($id)
			{
				$qry.=" AND p.id=:id";
				$parms[':id']=$id;
			}
			$qry.=" ORDER BY p.`displayorder`";
			//  print_r($parms);
			$result=$DB->getmenual($qry,$parms,'package');
			if(sizeof($result)>0)
			{
				
				$response['package']=$result;

				for($k=0;$k<sizeof($result);$k++)
				{
					$ins_packageid=$result[$k]->getId();

					$packagedetails = new packagedetails();
					$querypd="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,ifnull(pf.inputboxlabel,'') AS inputboxlabel,
					case when(pd.`attributeval`=1) THEN :PackageYesImgurl ELSE :PackageNoImgurl END AS packageYNImgurl
					FROM `tblpackagedetails` pd
					inner join tblpackagefeatures pf on pf.pfid=pd.pfid
					WHERE pd.packageid=:packageid";
					$paramspd=array(':packageid'=>$ins_packageid,':PackageYesImgurl'=>$config->getPackageYesImgurl(),':PackageNoImgurl'=>$config->getPackageNoImgurl());
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
			$qry="SELECT p.`id`,p.`packagename`,p.`colorcode`,case when(".$typeid."=1) THEN p.`annualyprice` ELSE p.`monthlyprice` END AS price,p.`monthlyprice`,p.`annualyprice`,
			p.`annualysaveprice`,p.`shortdescr`,p.`ispopular`,
			CASE WHEN (p.`ispopular`=1) THEN 'MOST POPULAR' ELSE '' END AS populartext,
			CASE WHEN (p.`ispopular`=1) THEN 'color-dark-green' ELSE 'color-green' END AS popularcolor,
			CASE WHEN (p.`ispopular`=1) THEN 'text-white' ELSE '' END AS popularheadertext,
			IFNULL((SELECT count(id) FROM tblpackageassign WHERE uid=:uid AND packageid=p.id AND status=1 AND isactive=1 AND (STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(packactivatedate,'%d/%m/%Y') AND STR_TO_DATE(expirydate,'%d/%m/%Y'))),0) AS packageactive,
			IFNULL((SELECT expirydate FROM tblpackageassign WHERE uid=:uid AND packageid=p.id AND status=1 AND isactive=1 AND (STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(packactivatedate,'%d/%m/%Y') AND STR_TO_DATE(expirydate,'%d/%m/%Y'))),'') AS packageexpiry,
			IFNULL((SELECT packactivatedate FROM tblpackageassign WHERE uid=:uid AND packageid=p.id AND status=1 AND isactive=0 AND (STR_TO_DATE(:currdate,'%d/%m/%Y')<STR_TO_DATE(packactivatedate,'%d/%m/%Y'))),'') AS packactivatedate,
			IFNULL((SELECT count(id) FROM tblpackageassign WHERE uid=:uid AND packageid=p.id AND status=1 AND isactive=0 AND (STR_TO_DATE(:currdate,'%d/%m/%Y')<STR_TO_DATE(packactivatedate,'%d/%m/%Y'))),0) AS nextpackactivate
			FROM `tblpackagemaster` p 
			WHERE p.isactive=1 ORDER BY p.`displayorder`";
			$parms = array(':currdate'=>$currdate,':uid'=>$uid);
			$result=$DB->getmenual($qry,$parms);
			$htmldata='';

			if(sizeof($result)>0) 
			{
				$qrypf="SELECT pf.`id`,pf.`pfid`,pf.`name`,pf.`printname` FROM `tblpackagefeatures` pf WHERE pf.`isactive`=1 ORDER BY pf.`displayorder`";
				$parmspf = array();
				$packagefeatures=$DB->getmenual($qrypf,$parmspf);
				if(sizeof($packagefeatures)>0) 
				{
					$htmldata.='<div>';
						$htmldata.='<div class="row">';
							$htmldata.='<div class="col-md-6 col-lg-4 col-xl-3 col-sm-6 col-6 d-sm-block d-none p-set-all">';
								$htmldata.='<div class="panel-set">';
									$htmldata.='<div class="owl-carousel palnpenal owl-theme">';
										$htmldata.='<div class="item">';
											$htmldata.='<div class="image-set-plan">';
												$htmldata.='<img id="PackagePricingImgurl" src="'.$config->getPackagePricingImgurl().'" alt="Package List">';
											$htmldata.='</div>';
											$htmldata.='<div class="des-plan">';
												for($pf=0;$pf<sizeof($packagefeatures);$pf++)
												{
													$rowpf=$packagefeatures[$pf];

													$htmldata.='<p>'.$rowpf['printname'].'</p>';
												}		
											$htmldata.='</div>';
										$htmldata.='</div>';
									$htmldata.='</div>';
								$htmldata.='</div>';
							$htmldata.='</div>';
							$htmldata.='<div class="col-md-6 col-lg-8 col-xl-9 col-sm-6 col-12">';
								$htmldata.='<div class="panel-set-multi">';
									$htmldata.='<div class="owl-carousel palnpenal-multi owl-theme">';
										for($p=0;$p<sizeof($result);$p++)
										{		
											$row=$result[$p];
											$htmldata.='<div class="item">';
												$htmldata.='<header class="plan-heading '.$row['popularcolor'].' popular"><h2 class="'.$row['popularheadertext'].'">'.$row['packagename'].'</h2></header>';
												$htmldata.='<div class="middle-part">';
													$htmldata.='<div class="price-middle-part">';
														$htmldata.='<p class="price years" data-price="annually">$'.$row['price'].'</p>';
														if($typeid==1 && $row['annualysaveprice']>0)
														{	
															$htmldata.='<span class="button-save">';
																$htmldata.='<p class="label-save">';
																	$htmldata.='<span>Save $'.$row['annualysaveprice'].'</span>';
																$htmldata.='</p>';
															$htmldata.='</span>';
														}	
													$htmldata.='</div>';
													$htmldata.='<div class="plans-text">';
														$htmldata.='<div class="wrapper-title">';
															$htmldata.='<p>'.$row['packagename'].'</p>';
														$htmldata.='</div>';
														$htmldata.='<div class="sec-desc plan-desc">';
															$htmldata.='<p>'.$row['shortdescr'].'</p>';
														$htmldata.='</div>';
														$htmldata.='<div class="view-package-details text-center">';
															$htmldata.= '<a class="view-package-details-tag" data-packageid="'.$row['id'].'" href="javascript:void(0);">View Details</a>';
														$htmldata.='</div>';
														
													$htmldata.='</div>';

													if($row['packageactive']>0) 
													{
														$htmldata.= '<h4 class="text-center"><b class="text-success">Currently Active Package</b></h4>';
														$htmldata.= '<p class="text-center"><b class="text-danger">Expire on '.$row['packageexpiry'].'</b></p>';
													}
													else if($row['nextpackactivate']>0){
														$htmldata.= '<h4 class="text-center"><b class="text-success">This Package will be active after current active package expired.</b></h4>';
														$htmldata.= '<p class="text-center"><b class="text-danger">Active on '.$row['packactivatedate'].'</b></p>';
													}
													else
													{
														$htmldata.= '<a class="btn btn-black btn-plans btnapplychooseplan"  data-package="'.$row['id'].'" data-type="'.$typeid.'" href="javascript:void(0);">Apply Now</a>';
													}

												$htmldata.='</div>';
												$htmldata.='<div class="des-plan-multi">';
													for($pfd=0;$pfd<sizeof($packagefeatures);$pfd++)
													{
														$rowpf_data=$packagefeatures[$pfd];

														$querypdetails="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,ifnull(pf.inputboxlabel,'') AS inputboxlabel,
														case when(pd.`attributeval`=1) THEN :PackageYesImgurl ELSE :PackageNoImgurl END AS packageYNImgurl,
														case when(pd.isnolimit=1) THEN 'Unlimited' ELSE CONCAT('Limited','(',pd.`limitvalue`,')') END AS limittext
														FROM `tblpackagedetails` pd
														inner join tblpackagefeatures pf on pf.pfid=pd.pfid
														WHERE pd.packageid=:packageid AND pd.pfid=:pfid";
														$paramspdetails=array(':packageid'=>$row['id'],':pfid'=>$rowpf_data['pfid'],':PackageYesImgurl'=>$config->getPackageYesImgurl(),':PackageNoImgurl'=>$config->getPackageNoImgurl());
														$pdetails=$DB->getmenual($querypdetails,$paramspdetails);
														$rowattrval=$pdetails[0];

														$htmldata.='<div class="d-block d-sm-none d-xl-none d-lg-none d-md-none set-plan-se text-center" >';
															$htmldata.='<p>'.$rowpf_data['printname'].'</p>';
														$htmldata.='</div>';
														if($rowattrval['haslimit']==1 && $rowattrval['attributeval']==1)
														{
															$htmldata.='<div class="p-img text-center">';
																$htmldata.=''.$rowattrval['limittext'].'';
															$htmldata.='</div>';
														}	
														else
														{
															$htmldata.='<div class="p-img">';
																$htmldata.='<img src="'.$rowattrval['packageYNImgurl'].'" alt="'.$rowattrval['attributeval'].' '.$rowpf_data['printname'].'">';
															$htmldata.='</div>';
														}
													}	

													

												$htmldata.='</div>';
											$htmldata.='</div>';

										}	
									$htmldata.='</div>';
								$htmldata.='</div>';
							$htmldata.='</div>';
						$htmldata.='</div>';
					$htmldata.='</div>';


				}	









				// $htmldata.= '<ul class="plans-list row">';
                // $htmldata.= '<li class="box-plan sm-size-box plan-img col-md-3 col-12" style="background-image: url('.$config->getPackagePricingImgurl().')";>';
                // $htmldata.= '</li>';

				// for($p=0;$p<sizeof($result);$p++)
				// {
				// 	$row=$result[$p];

				// 	$htmldata.= '<li class="box-plan sm-size-box '.$row['popularcolor'].' popular col-md-3 col-12 p-0">';
				// 	$htmldata.= '<header class="plan-heading">';
				// 	$htmldata.= '<h2 class="'.$row['popularheadertext'].'">'.$row['packagename'].'</h2>';
				// 	$htmldata.= '</header>';
				// 	$htmldata.= '<div class="middle-part">';

				// 	$htmldata.= '<div class="price-middle-part"><p class="price years" data-price="annually">$'.$row['price'].'</p>';
				// 	// $htmldata.= '<p class="price month hidden" data-price="monthly">$150</p>';
				// 	if($typeid==1)
				// 	{
				// 		$htmldata.= '<span class="button-save">';
				// 		$htmldata.= '<p class="label-save"><span>Save $'.$row['annualysaveprice'].'</span></p>';
				// 		$htmldata.= '</span>';
				// 	}
						

				// 	// $htmldata.= '<p class="label-year hidden"><span>$1,500 /year</span></p>';
				// 	$htmldata.= '</div>';
				// 	$htmldata.= '<div class="plans-text">';
				// 	$htmldata.= '<div class="wrapper-title">';
				// 	$htmldata.= '<p>'.$row['packagename'].'</p>';
				// 	$htmldata.= '</div>';
				// 	$htmldata.= '<div class="sec-desc">';
				// 	$htmldata.= '<p>'.$row['shortdescr'].'</p>';
				// 	$htmldata.= '</div>';
				// 	$htmldata.= '</div>';
				// 	$htmldata.= '<div class="mobile-link d-lg-none" data-toggle="collapse" data-target="#footerCollapse'.$row['id'].'" aria-label="collapse" aria-expanded="false">';
				// 	$htmldata.= '<a>Core Features</a>';
				// 	$htmldata.= '</div>';

				// 	$htmldata.= '<div class="box-plan table-box-plan inform-plan desktop-downblock collapse" id="footerCollapse'.$row['id'].'">';
				// 	$htmldata.= '<div class="table-information">';
				// 	$htmldata.= '<table class="table table-striped">';
				// 	$htmldata.= '<tbody>';

				// 	$querypd="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,ifnull(pf.inputboxlabel,'') AS inputboxlabel,
				// 	case when(pd.`attributeval`=1) THEN :PackageYesImgurl ELSE :PackageNoImgurl END AS packageYNImgurl
				// 	FROM `tblpackagedetails` pd
				// 	inner join tblpackagefeatures pf on pf.pfid=pd.pfid
				// 	WHERE pd.packageid=:packageid";
				// 	$paramspd=array(':packageid'=>$ins_packageid,':PackageYesImgurl'=>$config->getPackageYesImgurl(),':PackageNoImgurl'=>$config->getPackageNoImgurl());
				// 	$packagedetails=$DB->getmenual($querypd,$paramspd);
				// 	if(sizeof($packagedetails)>0) 
				// 	{
				// 		for($pd=0;$pd<sizeof($packagedetails);$pd++)
				// 		{
				// 			$rowpd=$packagedetails[$pd];

				// 			$htmldata.= '<tr>';
				// 			$htmldata.= '<td>';
				// 			$htmldata.= ''.$rowpd['printname'].'';
				// 			$htmldata.= '</td>';

				// 			$htmldata.= '<td class="checked-v" style="background-image: url('.$rowpd['packageYNImgurl'].');"></td>';

				// 			$htmldata.= '</td>';
				// 			$htmldata.= '</tr>';
				// 		}
						
				// 	}	


				// 	$htmldata.= '</tbody>';
				// 	$htmldata.= '</table>';
				// 	$htmldata.= '</div>';
				// 	$htmldata.= '</div>';
				// 	if($row['packageactive']>0) 
				// 	{
				// 		$htmldata.= '<h4><b class="text-success">Currently Active Package</b></h4>';
				// 		$htmldata.= '<p><b class="text-danger">Expire on '.$row['packageexpiry'].'</b></p>';
				// 	}
				// 	else
				// 	{
				// 		$htmldata.= '<a class="btn btn-black btn-plans btnapplychooseplan"  data-package="'.$row['id'].'" data-type="'.$typeid.'" href="javascript:void(0);">Apply Now</a>';
				// 	}
						

				// 	$htmldata.= '</div>';
				// 	$htmldata.= '</li>';

				// }

				//  // Package Features Part

				//  $htmldata.= '<li class="box-plan inform-plan desktop-downblock col-12 d-md-block d-none">';
				//  $htmldata.= '<div class="table-information">';
				//  $htmldata.= '<table class="table table-striped">';
				//  $htmldata.= '<tbody>';

				//  $qrypf="SELECT pf.`id`,pf.`pfid`,pf.`name`,pf.`printname` FROM `tblpackagefeatures` pf WHERE pf.`isactive`=1 ORDER BY pf.`displayorder`";
				//  $parmspf = array();
				//  $packagefeatures=$DB->getmenual($qrypf,$parmspf);

				//  if(sizeof($packagefeatures)>0) 
				//  {
				// 	for($pf=0;$pf<sizeof($packagefeatures);$pf++)
				// 	{
				// 		$rowpf=$packagefeatures[$pf];

				// 		$htmldata.= '<tr>';
				// 		$htmldata.= '<td>'.$rowpf['printname'].'</td>';

				// 		for($pg=0;$pg<sizeof($result);$pg++)
				// 		{
				// 			$rowpg=$result[$pg];

				// 			$querypdetails="SELECT pd.`id`,pd.`packageid`,pd.`pfid`,pd.`attributeval`,pd.`isnolimit`,pd.`limitvalue`,pd.`entry_uid`,pd.`entry_date`,pd.`timestamp`,pf.name AS pfname,pf.printname,pf.displayorder,pf.haslimit,pf.withinputbox,ifnull(pf.inputboxlabel,'') AS inputboxlabel,
				// 			case when(pd.`attributeval`=1) THEN :PackageYesImgurl ELSE :PackageNoImgurl END AS packageYNImgurl,
				// 			case when(pd.isnolimit=1) THEN 'Unlimited' ELSE CONCAT('Limited','(',pd.`limitvalue`,')') END AS limittext
				// 			FROM `tblpackagedetails` pd
				// 			inner join tblpackagefeatures pf on pf.pfid=pd.pfid
				// 			WHERE pd.packageid=:packageid AND pd.pfid=:pfid";
				// 			$paramspdetails=array(':packageid'=>$rowpg['id'],':pfid'=>$rowpf['pfid'],':PackageYesImgurl'=>$config->getPackageYesImgurl(),':PackageNoImgurl'=>$config->getPackageNoImgurl());
				// 			$pdetails=$DB->getmenual($querypdetails,$paramspdetails);
				// 			$rowattrval=$pdetails[0];
				// 			if($rowattrval['haslimit']==1 && $rowattrval['attributeval']==1)
				// 			{
				// 				$htmldata.= '<td>'.$rowattrval['limittext'].'</td>';
				// 			}
				// 			else
				// 			{
				// 				$htmldata.= '<td class="checked-v" style="background-image: url('.$rowattrval['packageYNImgurl'].');"></td>';
				// 			}
				// 		}	
						
				// 		$htmldata.= '</tr>';
				// 	}
				//  }	
					 
								 
				//  $htmldata.= '</tbody>';
				//  $htmldata.= '</table>';
				//  $htmldata.= '</div>';
				//  $htmldata.= '</li>';

				// $htmldata.= '</ul>';

				$status=1;
				$message=$errmsg['success'];
			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
			$response['data']=$htmldata;
		}	

		 $response['typeid']=$typeid;
		 $response['PackagePricingImgurl']=$config->getPackagePricingImgurl();	

		// print_r($response);

	}
	else if($action=='checkuserlogin')
	{
		$packageid=$IISMethods->sanitize($_POST['packageid']);
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$datetime=$IISMethods->getdatetime();
		$currdate=$IISMethods->getcurrdate();

		$redirecturl='';
		$loginsuccess=0;

		$targeturl=$config->getWeburl();
		$qry="SELECT id,packagename,monthlyprice,annualysaveprice,annualyprice,colorcode,termsconditionid,termscondition,shortdescr,descr,displayorder,ispopular,
			  case when(".$typeid."=1) THEN `annualyprice` ELSE `monthlyprice` END AS price,
			  CASE WHEN(".$typeid."=1) THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') END AS expirydate
			  FROM tblpackagemaster 
			  WHERE id=:id AND isactive=1";
		$params=array(':id'=>$packageid,':currdate1'=>$currdate,':currdate2'=>$currdate);
		//  print_r($params);
		$res=$DB->getmenual($qry,$params);
		if(sizeof($res)>0) 
		{
			$row=$res[0];
			if($LoginInfo->getIsguestuser()==1)
			{
				$status=1;
				$message=$errmsg['sessiontimeout'];
				$redirecturl=$config->getWeburl().'register-account?Service_Auth=savanigems&passive=false&package='.$row['id'].'&type='.$typeid.'&tmpl=default&tmpcache=true&method=op&continue=success&packagename='.$row['packagename'].'&price='.$row['price'].'';
			}	
			else
			{
				$loginsuccess=1;
				$status=1;
				$message=$errmsg['success'];
				$redirecturl=$config->getWeburl().'checkout?Service_Auth=savanigems&passive=false&package='.$row['id'].'&type='.$typeid.'&tmpl=default&tmpcache=true&method=op&continue=success&packagename='.$row['packagename'].'&price='.$row['price'].'';
			}
			$response['redirecturl']=$redirecturl;
			$response['loginsuccess']=$loginsuccess;
		}
		else
		{
			$status=0;
			$message=$errmsg['packageunavailable'];
		}
		$response['packageid']=$packageid;
		$response['targeturl']=$targeturl;
	}
	else if($action=='packageassign')
	{
		$packageid=$IISMethods->sanitize($_POST['packageid']);
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$datetime=$IISMethods->getdatetime();
		$currdate=$IISMethods->getcurrdate();

		$couponapply=$LoginInfo->getcouponapply();
		$couponid=$LoginInfo->getcouponid();
		$couponcode=$LoginInfo->getcouponcode();
		$coupontype=$LoginInfo->getcoupontype();
		$couponamount=$LoginInfo->getcouponamount();
		$couponpercent=$LoginInfo->getcouponpercent();

		$redirecturl='';
		$loginsuccess=0;

		$targeturl=$config->getWeburl();
		$qry="SELECT id,packagename,monthlyprice,annualysaveprice,annualyprice,colorcode,termsconditionid,termscondition,shortdescr,descr,displayorder,ispopular,
			  case when(".$typeid."=1) THEN `annualyprice` ELSE `monthlyprice` END AS price,
			  CASE WHEN(".$typeid."=1) THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') END AS expirydate
			  FROM tblpackagemaster 
			  WHERE id=:id AND isactive=1";
		$params=array(':id'=>$packageid,':currdate1'=>$currdate,':currdate2'=>$currdate);
		//  print_r($params);
		$res=$DB->getmenual($qry,$params);
		if(sizeof($res)>0) 
		{
			$row=$res[0];
			if($LoginInfo->getIsguestuser()==1)
			{
				$status=1;
				$message=$errmsg['sessiontimeout'];
				$redirecturl=$config->getWeburl().'register-account?Service_Auth=savanigems&passive=false&package='.$row['id'].'&type='.$typeid.'&tmpl=default&tmpcache=true&method=op&continue=success&packagename='.$row['packagename'].'&price='.$row['price'].'';
			}	
			else
			{

				$qrycheck="SELECT id FROM tblpackageassign WHERE uid=:uid AND status=1 AND isactive=1 AND packageid=:packageid AND (STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(packactivatedate,'%d/%m/%Y') AND STR_TO_DATE(expirydate,'%d/%m/%Y'))";
				$paramcheck=array(':uid'=>$uid,':packageid'=>$packageid,':currdate'=>$currdate);
				// print_r($paramcheck);
				$rescheck=$DB->getmenual($qrycheck,$paramcheck);
				if(sizeof($rescheck)>0) 
				{
					$status=0;
					$message=$errmsg['packageactive'];
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

						$packageactivedate=date('d/m/Y');
						$expirydate=$row['expirydate'];
						$isactive=1;
						$qrycheckall="SELECT id,DATEDIFF(STR_TO_DATE(expirydate,'%d/%m/%Y'), STR_TO_DATE(:currdate,'%d/%m/%Y')) AS pendingdays FROM tblpackageassign WHERE uid=:uid AND status=1 AND isactive=1 AND (STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(packactivatedate,'%d/%m/%Y') AND STR_TO_DATE(expirydate,'%d/%m/%Y'))";
						$paramcheckall=array(':uid'=>$uid,':currdate'=>$currdate);
						$rescheckall=$DB->getmenual($qrycheckall,$paramcheckall);
						if(sizeof($rescheckall)>0) 
						{
							$rowcheckall=$rescheckall[0];
							$pendingdays=$rowcheckall['pendingdays']+1;
							$qrydt="SELECT DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate,'%d/%m/%Y'),INTERVAL ".$pendingdays." DAY),'%d/%m/%Y') AS packageactivedate";
							$parms = array(
								':currdate'=>$currdate,
							);
							$result_dt=$DB->getmenual($qrydt,$parms);
							$rowdt=$result_dt[0];
							$packageactivedate=$rowdt['packageactivedate'];

							$qryexpiry="SELECT CASE WHEN(".$typeid."=1) 
													THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:packageactivedate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') 
													ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:packageactivedate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') 
												END AS expirydate";
							$paramexpdt=array(':packageactivedate1'=>$packageactivedate,':packageactivedate2'=>$packageactivedate);
							$result_expdt=$DB->getmenual($qryexpiry,$paramexpdt);
							$expirydate=$result_expdt[0]['expirydate'];

							$qrychecksingle="SELECT DATEDIFF(STR_TO_DATE(expirydate,'%d/%m/%Y'),STR_TO_DATE(:currdate,'%d/%m/%Y')) AS pendingdays,packactivatedate FROM tblpackageassign WHERE uid=:uid AND status=1 AND isactive=0 ORDER BY entry_date DESC LIMIT 1";
							$paramchecksingle=array(':uid'=>$uid,':currdate'=>$currdate);
							$reschecksingle=$DB->getmenual($qrychecksingle,$paramchecksingle);
							if(sizeof($reschecksingle)>0) 
							{
								$rowchecksingle=$reschecksingle[0];
								$pendingdays=$rowchecksingle['pendingdays']+1;
								$qrydt="SELECT DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate,'%d/%m/%Y'),INTERVAL ".$pendingdays." DAY),'%d/%m/%Y') AS packageactivedate";
								$parms = array(
									':currdate'=>$currdate,
								);
								$result_dt=$DB->getmenual($qrydt,$parms);
								$rowdt=$result_dt[0];
								$packageactivedate=$rowdt['packageactivedate'];
								$qryexpiry="SELECT CASE WHEN(".$typeid."=1) 
														THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:packageactivedate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') 
														ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:packageactivedate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') 
													END AS expirydate";
								$paramexpdt=array(':packageactivedate1'=>$packageactivedate,':packageactivedate2'=>$packageactivedate);
								$result_expdt=$DB->getmenual($qryexpiry,$paramexpdt);
								$expirydate=$result_expdt[0]['expirydate'];

							}	
							$isactive=0;
						}	

						$subtotal=$row['price'];
						$coupondiscamt=$couponamount;
						$finalamount=$row['price']-$couponamount;

						$insqry=array(
							'id'=>$unqid,
							'type'=>1,
							'transactionid'=>$transactionid,
							'packageid'=>$packageid,
							'uid'=>$uid,
							'personname'=>$rowperson['personname'],
							'packagetypeid'=>$typeid,
							'amount'=>$subtotal,
							'couponapply'=>$couponapply,
							'codeid'=>$couponid,
							'code'=>$couponcode,
							'disctype'=>$coupontype,
							'discper'=>$couponpercent,
							'discamt'=>$couponamount,
							'totalamt'=>$subtotal,
							'finalamount'=>$finalamount,
							'ind_amount'=>$finalamount,
							'abd_amount'=>$finalamount,
							'packactivatedate'=>$packageactivedate,
							'expirydate'=>$expirydate,
							'description'=>'',
							'status'=>0,
							'platform'=>$platform,
							'entry_uid'=>$uid,
							'entry_date'=>$datetime,
							'update_uid'=>$uid,
							'update_date'=>$datetime,
							'sessionarr'=>json_encode($LoginInfo,true),
							'mainexpirydate'=>$expirydate,
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
							'ispopular'=>$row['ispopular'],
							'isactive'=>$isactive,
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
						$unit_amount = $finalamount * 100;
						$checkout_session = \Stripe\Checkout\Session::create([
							'client_reference_id'=>$transactionid,
							'customer_email'=>$LoginInfo->getEmail(),
							'line_items' => [[
								'price_data' => [
								'currency' => 'usd',
								'tax_behavior' => 'exclusive',
								'product_data' => [
									'name' =>$row['packagename'],
								],
								'unit_amount' => $unit_amount,
								],
								'quantity' => 1,
							]],
							'mode' => 'payment',
							'success_url' => $config->getEndpointurl() . 'gettransaction.php?session_id={CHECKOUT_SESSION_ID}',
							'cancel_url' => $config->getEndpointurl() . 'gettransaction.php?session_id={CHECKOUT_SESSION_ID}',
							'automatic_tax' => [
								'enabled' => true,
							],
						]);
						// header("HTTP/1.1 303 See Other");


						$response['checkout_sessionurl']=$checkout_session->url;
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
				$loginsuccess=1;
			}
			$response['redirecturl']=$redirecturl;
			$response['loginsuccess']=$loginsuccess;
		}
		else
		{
			$status=0;
			$message=$errmsg['packageunavailable'];
		}

			
		$response['packageid']=$packageid;
		$response['targeturl']=$targeturl;
	}
	else if($action=='listtransactiondetail'){
		$tid=$IISMethods->sanitize($_POST['tid']);
		$continuetext=$IISMethods->sanitize($_POST['continuetext']);
		$htmldata='';

		if($tid){
			$qrycheck_order="SELECT id,packagename,packagetypeid,amount,discamt,paid_amount,finalamount,code,disctype,discper,discamt,ifnull(couponapply,0) AS couponapply,checkout_status,payment_status FROM tblpackageassign WHERE uid=:uid AND transactionid=:transactionid AND IFNULL(payment_status,'')<>'' AND IFNULL(checkout_status,'')<>''";
			$paramchk_order=array(':uid'=>$LoginInfo->getUid(),':transactionid'=>$tid);
			$reschk_order=$DB->getmenual($qrycheck_order,$paramchk_order);
			if(sizeof($reschk_order)>0) {
				$roworder=$reschk_order[0];

				$packagetypetext='';
				if($roworder['packagetypeid']==1){
					$packagetypetext='Annually';
				}
				else if($roworder['packagetypeid']==2){
					$packagetypetext='Monthly';
				}

				$htmldata='';
				$htmldata.='<div class="checkout-field">';
					$htmldata.='<div class="your-order-product">';
						$htmldata.='<h3>Transaction Summary</h3>';
					$htmldata.='</div>';
					$htmldata.='<div class="checkout-product-list">';
						$htmldata.='<div class="checkout-product-list-items">';
							$htmldata.='<div class="cpli-list">';
								$htmldata.='<div class="checkout-product-details">';
									$htmldata.='<h3>'.$roworder['packagename'].'</h3> <span class="d-block product-sub-title-name ">Package Type : '.$packagetypetext.'</span>';
								$htmldata.='</div>';
							$htmldata.='</div>';
							$htmldata.='<div class="checkout-product-price">$ '.$roworder['amount'].'</div>';
						$htmldata.='</div>';
					$htmldata.='</div>';
					if($roworder['couponapply']==1){

						$htmldata.='<div class="coupen-sucess">';
							$htmldata.='<div class="couponscode-content">';
								$htmldata.='<div class="couponscode-block"> ';
									$htmldata.='<i class="couponscode-icon fa fa-check"></i>';
									$htmldata.='<div class="couponscode-code"><b>'.$roworder['code'].'</b> ';
									$htmldata.='<span>applied</span>';
								$htmldata.='</div>';
								if($roworder['disctype']==1)
								{
									$htmldata.='<span class="couponscode-amount">- $ '.$roworder['discamt'].'</span>';
								}
								else if($roworder['disctype']==2){
									$htmldata.='<span class="couponscode-amount">- $ '.$roworder['discamt'].'('.$roworder['discper'].'% Off)</span>';
								}	
								$htmldata.='</div>';
							$htmldata.='</div>';
						$htmldata.='</div>';

					}
					$htmldata.='<div class="checkout-product-main-total subtotal">';
						$htmldata.='<span>Sub Total</span>';
						$htmldata.='<span>$ '.$roworder['amount'].'</span>';
					$htmldata.='</div>';
					if($roworder['couponapply']==1){
						$htmldata.='<div class="checkout-product-main-total subtotal">';
							$htmldata.='<span>Coupon Discount</span>';
							$htmldata.='<span>$ '.$roworder['discamt'].'</span>';
						$htmldata.='</div>';
					}	
					$htmldata.='<div class="checkout-product-main-total">';
						$htmldata.='<span>Total Amount</span>';
						$htmldata.='<span>$ '.$roworder['finalamount'].'</span>';
					$htmldata.='</div>';

					$htmldata.='<div class="checkout-product-main-total">';
						$htmldata.='<span class="text-success">Total Paid Amount</span>';
						$htmldata.='<span class="text-success">$ '.$roworder['paid_amount'].'</span>';
					$htmldata.='</div>';
				$htmldata.='</div>';
				if($roworder['checkout_status']=='complete' && $roworder['payment_status']=='paid')	
				{
					$htmldata.='<div class="payment-sucess">';
						$htmldata.='<div class="payment-img">';
							$htmldata.='<img src="'.$config->getPaymentSuccessImg().'" alt="'.$errmsg['transactionsuccess'].'">';
						$htmldata.='</div>';
						$htmldata.='<p class="text-success">'.$errmsg['transactionsuccess'].'</p>';
							$htmldata.='<a href="'.$config->getportalbaseurl().'home">Go To Dashboard</a>';
					$htmldata.='</div>';
				}
				else if($roworder['checkout_status']=='complete' && $roworder['payment_status']=='unpaid'){
					$htmldata.='<div class="payment-sucess">';
						$htmldata.='<div class="payment-img">';
							$htmldata.='<img src="'.$config->getPaymentSuccessImg().'" alt="'.$errmsg['transactionincomplete'].'">';
						$htmldata.='</div>';
						$htmldata.='<p class="text-success">'.$errmsg['transactionincomplete'].'</p>';
							$htmldata.='<a href="'.$config->getWeburl().'home">Go To Home</a>';
					$htmldata.='</div>';
				}	
				else if($roworder['checkout_status']=='open' && $roworder['payment_status']=='unpaid'){
					$htmldata.='<div class="payment-sucess">';
						$htmldata.='<div class="payment-img">';
							$htmldata.='<img src="'.$config->getPaymentSuccessImg().'" alt="'.$errmsg['transactionincomplete'].'">';
						$htmldata.='</div>';
						$htmldata.='<p class="text-success">'.$errmsg['transactionincomplete'].'</p>';
							$htmldata.='<a href="'.$config->getWeburl().'home">Go To Dashboard</a>';
					$htmldata.='</div>';
				}
				else {
					$htmldata.='<div class="payment-sucess">';
						$htmldata.='<div class="payment-img">';
							$htmldata.='<img src="'.$config->getPaymentFailedImg().'" alt="'.$errmsg['transactionfailed'].'">';
						$htmldata.='</div>';
						$htmldata.='<p class="text-danger">'.$errmsg['transactionfailed'].'</p>';
						$htmldata.='<a href="'.$config->getWeburl().'home">Go Back Home</a>';
					$htmldata.='</div>';
				}	
			}
			else{
				$status=0;
				$htmldata='';
				$htmldata.='<div class="checkout-field">';
					$htmldata.='<div class="your-order-product">';
						$htmldata.='<h3>Transaction</h3>';
					$htmldata.='</div>';
					$htmldata.='<div class="payment-sucess">';
						$htmldata.='<div class="payment-img">';
							$htmldata.='<img src="'.$config->getPaymentFailedImg().'" alt="'.$errmsg['invalidtransaction'].'">';
						$htmldata.='</div>';
						$htmldata.='<p class="text-danger">'.$errmsg['invalidtransaction'].'</p>';
						$htmldata.='<a href="'.$config->getWeburl().'home">Go Back Home</a>';
					$htmldata.='</div>';
				$htmldata.='</div>';
			}	
		}
		else{
			$htmldata='';
			$htmldata.='<div class="checkout-field">';
				$htmldata.='<div class="your-order-product">';
					$htmldata.='<h3>Transaction</h3>';
				$htmldata.='</div>';
				$htmldata.='<div class="payment-sucess">';
					$htmldata.='<div class="payment-img">';
						$htmldata.='<img src="'.$config->getPaymentFailedImg().'" alt="'.$errmsg['invalidtransaction'].'">';
					$htmldata.='</div>';
					$htmldata.='<p class="text-danger">'.$errmsg['invalidtransaction'].'</p>';
					$htmldata.='<a href="'.$config->getWeburl().'home">Go Back Home</a>';
				$htmldata.='</div>';
			$htmldata.='</div>';	
			$status=0;
		}
		$response['data']=$htmldata;
	}
	else if($action=='listsummarydetail'){

		$typeid=$_POST['type'];
		$packageid=$_POST['packageid'];
		$datetime=$IISMethods->getdatetime();
		$currdate=$IISMethods->getcurrdate();
		if($typeid && $packageid)
		{
			$qry="SELECT id,packagename,monthlyprice,annualysaveprice,annualyprice,colorcode,termsconditionid,termscondition,shortdescr,descr,displayorder,ispopular,
				case when(".$typeid."=1) THEN `annualyprice` ELSE `monthlyprice` END AS price,
				case when(".$typeid."=1) THEN 'Annually' ELSE 'Monthly' END AS packagetype,
				CASE WHEN(".$typeid."=1) THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') END AS expirydate
				FROM tblpackagemaster 
				WHERE id=:id AND isactive=1";
			$params=array(':id'=>$packageid,':currdate1'=>$currdate,':currdate2'=>$currdate);
			//  print_r($params);
			$res=$DB->getmenual($qry,$params);
			if(sizeof($res)>0) 
			{
				$row=$res[0];
				$htmldata='';
				$htmldata.='<input type="hidden" name="packageid" id="packageid" value="'.$row['id'].'">';
				$htmldata.='<input type="hidden" name="typeid" id="typeid" value="'.$typeid.'">';

				$htmldata.='<div class="checkout-container">';
                    $htmldata.='<div class="card-letsconnect">';
                        $htmldata.='<div class="checkout-field">';
                            $htmldata.='<div class="your-order-product">';
                                $htmldata.='<h3>Summary</h3>';
                            $htmldata.='</div>';
                            $htmldata.='<div class="checkout-product-list">';
                                $htmldata.='<div class="checkout-product-list-items">';
                                    $htmldata.='<div class="cpli-list">';
                                        $htmldata.='<div class="checkout-product-details">';
                                            $htmldata.='<h3>'.$row['packagename'].'</h3> <span class="d-block product-sub-title-name ">Package Type : '.$row['packagetype'].'</span>';
                                            
                                        $htmldata.='</div>';
                                    $htmldata.='</div>';
                                    $htmldata.='<div class="checkout-product-price">$ '.$row['price'].'</div>';
                                $htmldata.='</div>';
                            $htmldata.='</div>';

							$couponapply=$LoginInfo->getcouponapply();
							$couponid=$LoginInfo->getcouponid();
							$couponcode=$LoginInfo->getcouponcode();
							$coupontype=$LoginInfo->getcoupontype();
							$couponamount=$LoginInfo->getcouponamount();
							$couponpercent=$LoginInfo->getcouponpercent();

							if($couponapply==1){
								$htmldata.='<div class="coupen-sucess">';
									$htmldata.='<div class="couponscode-content">';
										$htmldata.='<div class="couponscode-block"> ';
											$htmldata.='<i class="couponscode-icon fa fa-check"></i>';
											$htmldata.='<div class="couponscode-code"><b>'.$couponcode.'</b> ';
											$htmldata.='<span>applied</span>';
										$htmldata.='</div>';
										if($coupontype==1){
											$htmldata.='<span class="couponscode-amount">- $ '.$couponamount.'</span>';
										} else if($coupontype==2){
											$htmldata.='<span class="couponscode-amount">- $ '.$couponamount.'('.$couponpercent.'% Off)</span>';
										}
										$htmldata.='</div>';
										$htmldata.='<a class="couponscode-remove" id="couponscode-remove" data-logtype="3" href="javascript:void(0);" data-toggle="tooltip" title="Remove" data-type="3">';
											$htmldata.='<i class="fa fa-trash" aria-hidden="true"></i>';
										$htmldata.='</a>';
									$htmldata.='</div>';
								$htmldata.='</div>';
							}
							else{
								$htmldata.='<div class="coupen-code">';
									$htmldata.='<h2 class="">Coupon Code</h2>';
									$htmldata.='<label class="text-uppercase d-none">Enter Coupon code:</label>';
									$htmldata.='<div class="input-group">';
										$htmldata.='<div class="apply-field">';
											$htmldata.='<input class="input-group__field" type="text" placeholder="Enter Coupon Code" name="couponcode" id="couponcode">';
											$htmldata.='<span class="input-group__btn">';
												$htmldata.='<input type="button" class="btn rounded-end text-nowrap" id="btnapplycoupon" value="Apply">';
											$htmldata.='</span>';
										$htmldata.='</div>';
										$htmldata.='<label for="" class="apply-coupen text-danger couponcodeerror"></label>';
									$htmldata.='</div>';
								$htmldata.='</div>';
							}	
								
							$subtotal=$row['price'];
							$coupondiscamt=$couponamount;
							$finalamount=$row['price']-$couponamount;
                            
							$htmldata.='<div class="checkout-product-main-total subtotal">';
                                $htmldata.='<span>Sub Total</span>';
                                $htmldata.='<span>$ '.$subtotal.'</span>';
                            $htmldata.='</div>';
							if($couponapply==1){	
								$htmldata.='<div class="checkout-product-main-total">';
									$htmldata.='<span>Coupon Discount</span>';
									$htmldata.='<span>$ '.$coupondiscamt.'</span>';
								$htmldata.='</div>';
							}	
                            $htmldata.='<div class="checkout-product-main-total">';
                                $htmldata.='<span>Final Total</span>';
                                $htmldata.='<span>$ '.$finalamount.'</span>';
                            $htmldata.='</div>';
                            $htmldata.='<div class="checkpay-btn">';
                                $htmldata.='<button type="submit" class="pay-now-btn" id="btnpaynow">Pay Now</button>';
                            $htmldata.='</div>';
                        $htmldata.='</div>';
                    $htmldata.='</div>';
                $htmldata.='</div>';
		
				
				
				/* $htmldata.='<div class="your-order-product">';
				$htmldata.='	<h3>Summary</h3>';
				$htmldata.='</div>';
				$htmldata.='<div class="checkout-product-list">';
				$htmldata.='	<div class="checkout-product-list-items">';
				$htmldata.='		<div class="cpli-list">';
				$htmldata.='			<div class="checkout-product-details">';
				$htmldata.='				<h3>'.$row['packagename'].'</h3>';
				$htmldata.='				<span class="d-block product-sub-title-name ">Package Type : '.$row['packagetype'].'</span>';
				// $htmldata.='				<span class="d-block product-sub-title-name ">Case Color: Black</span>';
				$htmldata.='			</div>';
				$htmldata.='		</div>';
				$htmldata.='		<div class="checkout-product-price">$ '.$row['price'].'</div>';
				$htmldata.='	</div>';
				$htmldata.='</div>';

				$couponapply=$LoginInfo->getcouponapply();
				$couponid=$LoginInfo->getcouponid();
				$couponcode=$LoginInfo->getcouponcode();
				$coupontype=$LoginInfo->getcoupontype();
				$couponamount=$LoginInfo->getcouponamount();
				$couponpercent=$LoginInfo->getcouponpercent();

				$htmldata.='<div class="coupen-code">';
				if($couponapply==1){
				$htmldata.='	<div class="couponscode-content">';
				$htmldata.='		<div class="couponscode-block"> <i class="couponscode-icon fa fa-check"></i>';
				$htmldata.='			<div class="couponscode-code"><b>'.$LoginInfo->getcouponcode().'</b> <span>applied</span></div><span class="couponscode-amount">- $';
				$htmldata.='				'.$couponamount.'</span>';
				$htmldata.='		</div><a class="couponscode-remove" id="couponscode-remove" data-logtype="3" href="javascript:void(0);" data-toggle="tooltip" title="Remove"';
				$htmldata.='			data-type="3"><i class="fa fa-trash" aria-hidden="true"></i></a>';
				$htmldata.='	</div>';
				}
				else{
					$htmldata.='<h2 class="">Coupon Code</h2><label class="text-uppercase d-none">Enter Coupon code:</label>';
					$htmldata.='<div class="input-group flex-nowrap">';
					$htmldata.='<input class="input-group__field" type="text" placeholder="Enter Coupon Code" name="couponcode" id="couponcode">';
					$htmldata.='<span class="input-group__btn">';
					$htmldata.='<input type="button" class="btn rounded-end text-nowrap" id="btnapplycoupon" value="Apply">';
					$htmldata.='</span></div><p class="text-danger couponcodeerror"></p>';
				}
				$htmldata.='</div>';
				$subtotal=$row['price'];
				$coupondiscamt=$couponamount;
				$finalamount=$row['price']-$couponamount;

				$htmldata.='<div class="checkout-product-main-total">';
				$htmldata.='	<span>Sub Total</span><span>$ '.$subtotal.'</span>';
				$htmldata.='</div>';
				if($couponapply==1){
					$htmldata.='<div class="checkout-product-main-total">';
					$htmldata.='	<span>Coupon Discount</span><span>$ '.$coupondiscamt.'</span>';
					$htmldata.='</div>';
				}
				$htmldata.='<div class="checkout-product-main-total">';
				$htmldata.='	<span>Final Total</span><span>$ '.$finalamount.'</span>';
				$htmldata.='</div>';
				$htmldata.='<div class="checkout-product-main-total">';
				$htmldata.='<button type="submit" class="ht-btn ht-btn--dark bg-primary"  id="btnpaynow">Pay Now</button>';
				$htmldata.='</div>'; */

				$status=1;
				$message=$errmsg['success'];

			}
			else
			{
				$status=0;
				$message=$errmsg['packageunavailable'];
			}	
		}	
		
		
		$response['summarydata']=$htmldata;
	}
	else if($action=='applycoupon'){

		$typeid=$_POST['type'];
		$packageid=$_POST['packageid'];
		$couponcode=$_POST['couponcode'];
		$datetime=$IISMethods->getdatetime();
		$currdate=$IISMethods->getcurrdate();
		if($typeid && $packageid)
		{	
			if($couponcode)
			{
				$qry="SELECT id,packagename,monthlyprice,annualysaveprice,annualyprice,colorcode,termsconditionid,termscondition,shortdescr,descr,displayorder,ispopular,
					case when(".$typeid."=1) THEN `annualyprice` ELSE `monthlyprice` END AS price,
					case when(".$typeid."=1) THEN 'Annually' ELSE 'Monthly' END AS packagetype,
					CASE WHEN(".$typeid."=1) THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') END AS expirydate
					FROM tblpackagemaster 
					WHERE id=:id AND isactive=1";
				$params=array(':id'=>$packageid,':currdate1'=>$currdate,':currdate2'=>$currdate);
				//  print_r($params);
				$res=$DB->getmenual($qry,$params);
				if(sizeof($res)>0) 
				{
					$row=$res[0];

					$type=1;
					if($typeid==1){
						$type=2;
					}
					$qrycoupon="SELECT c.id,c.packageid,c.type,c.packagename,c.discounttype,c.couponcode,c.couponamt,c.startdate,c.expirydate,c.minispend,c.maxspend,c.limitpercoupon,c.limitperuser,c.statusid,
						ifnull((select count(id) from tblpackageassign pa where pa.status=1 and pa.codeid=c.id),0) as totaluse,
						ifnull((select count(id) from tblpackageassign pa where pa.status=1 and pa.codeid=c.id and pa.uid=:uid),0) as userwisecoupon 
						FROM tblcouponmaster c
						WHERE c.packageid=:packageid AND c.type=:type AND c.couponcode=:couponcode  AND c.statusid=1 AND STR_TO_DATE(:currdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(c.startdate,'%d/%m/%Y') AND STR_TO_DATE(c.expirydate,'%d/%m/%Y')";
					$paramscoupon=array(':packageid'=>$row['id'],':type'=>$type,':currdate'=>$currdate,':couponcode'=>$couponcode,':uid'=>$uid);
					//   print_r($paramscoupon);
					$rescoupon=$DB->getmenual($qrycoupon,$paramscoupon);
					// print_r($rescoupon);
					if(sizeof($rescoupon)>0) {

						$rowcode=$rescoupon[0];
						$chkexpdate=date('Y-m-d', strtotime(str_replace('/', '-', $rowcode['expirydate'])));
						$chktodaydate = date('Y-m-d');
						
						if(strtotime($chkexpdate) >= strtotime($chktodaydate))
						{	
							$disamt=0;
							$isapply=1;
							$distype=$rowcode['discounttype'];
							$totalfinalprice=$row['price'];
							if($rowcode['minispend']>0 && $totalfinalprice<$rowcode['minispend'])
							{
								$isapply=0;
								$status=0;
								$message=str_replace("#minispendamt#",$rowcode['minispend'],$errmsg['minispendcoupon']);
								// echo 'ABC';			
							}
							if($rowcode['maxspend']>0 && $totalfinalprice>$rowcode['maxspend'])
							{
								$isapply=0;
								$status=0;
								$message=str_replace("#maxspendamt#",$rowcode['maxspend'],$errmsg['maxspendcoupon']);
								// echo 'DEF';			
							}	
							
							if($rowcode['limitpercoupon']>0 && $rowcode['limitpercoupon']<=$rowcode['totaluse'])
							{
								$isapply=0;
								$status=0;
								$message=$errmsg['couponlimitreach'];
								// echo 'GHI';		
							}				
							if($rowcode['limitperuser']>0 && $rowcode['limitperuser']<=$rowcode['userwisecoupon'])
							{
								$isapply=0;
								$status=0;
								$message=$errmsg['couponlimitreach'];
								// echo 'KLM';	
							}
							// echo $isapply;
							if($isapply==1)
							{
								
								if($totalfinalprice > 0)
								{
									
									$IISMethods->removecoupon($LoginInfo); 
									
									if($distype==1)  //QAR
									{
										$disamt=$rowcode['couponamt'];
										if($disamt>=$totalfinalprice)
										{										
											$status=0;
											$message=$errmsg['couponnotapplied'];
										}
										else
										{				
											$disamt=round($rowcode['couponamt']);	
											
											$LoginInfo->setcouponapply(1);
											$LoginInfo->setcouponid($rowcode['id']);
											$LoginInfo->setcouponcode($couponcode);
											$LoginInfo->setcoupontype($distype);
											$LoginInfo->setcouponamount($disamt);
											$LoginInfo->setcouponpercent(0);
											$status=1;
											$message=$errmsg['couponapplied'];										
										}
									}
									else if($distype==2)  //Percentage
									{
										$per=$rowcode['couponamt'];
										if($per<100)
										{	
											$disamt=($totalfinalprice*$per)/100;	
											$LoginInfo->setcouponapply(1);
											$LoginInfo->setcouponid($rowcode['id']);
											$LoginInfo->setcouponcode($couponcode);
											$LoginInfo->setcoupontype($distype);
											$LoginInfo->setcouponamount($disamt);
											$LoginInfo->setcouponpercent($per);

											$status=1;
											$message=$errmsg['couponapplied'];	
										}
										else
										{
											$status=0;
											$message=$errmsg['couponnotapplied'];						
										}			
									}
								}
								else
								{
									
									$status=0;
									$message=$errmsg['couponnotapplied'];	
								}
								$status=1;
								$message=$errmsg['couponapplied'];					
							}
							else
							{
								$status=0;
								$message=$message;
							}
							
						}	
						else
						{
							$status=0;
							$message=$errmsg['couponcodeexpired'];
						}
					}
					else{
						$status=0;
						$message=$errmsg['invalidcoupon'];
					}
						
				}
				else
				{
					$status=0;
					$message=$errmsg['packageunavailable'];
				}	
			}
			else{
				$status=0;
				$message=$errmsg['couponcoderequired'];
			}
			$response['typeid']=$typeid;
			$response['packageid']=$packageid;	
		}	
		
	}
	else if($action=='removecoupon'){
		$couponapply=$LoginInfo->getcouponapply();
		if($couponapply==1){
			$IISMethods->removecoupon($LoginInfo);
			$status=1;
			$message=$errmsg['couponremoved'];
		}
		else{
			$message=$errmsg['couponalreadyremoved'];
		}
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

						$response['redirecturl']=$config->getportalbaseurl();
						
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

  