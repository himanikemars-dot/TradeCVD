<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	
	if($action=='insertcontactdata')   
	{
		
		$fname=$IISMethods->sanitize($_POST['cffname']);
		$lname = $IISMethods->sanitize($_POST['cflname']);

		$contact_email = $IISMethods->sanitize($_POST['cfcemail']);
		$phonecodeid = $IISMethods->sanitize($_POST['phonecodeid']);
		$phonecode = $IISMethods->sanitize($_POST['phonecode']);
		$contact_phone = $IISMethods->sanitize($_POST['cfphone']);
		$cfcompanyname = $IISMethods->sanitize($_POST['cfcompanyname']);
		$primarycmptypeid=$IISMethods->sanitize($_POST['primarycmptypeid']);
		$primarycmptype=$IISMethods->sanitize($_POST['primarycmptype']);
		$cfcmpwebsite=$IISMethods->sanitize($_POST['cfcmpwebsite']);
		$countryid=$IISMethods->sanitize($_POST['countryid']);
		$country=$IISMethods->sanitize($_POST['country']);
		$message=$IISMethods->sanitize($_POST['message']);

		$datetime=$IISMethods->getdatetime();
		if($fname && $lname && $contact_email && $contact_phone && $phonecodeid && $message)
		{			
			$insqry=array(	
				'firstname'=>$fname,	
				'lastname'=>$lname,
				'cmpemail'=>$contact_email,
				'phonecodeid'=>$phonecodeid,
				'phonecode'=>$phonecode,
				'phoneno'=>$contact_phone,
				'companyname'=>$cfcompanyname,		
				'primarycmptypeid'=>$primarycmptypeid,
				'primarycmptype'=>$primarycmptype,
				'cmpwebsite'=>$cfcmpwebsite,
				'countryid'=>$countryid,
				'country'=>$country,
				'message'=>$message,
			);
				
			$unqid = $IISMethods->generateuuid();
				
			$insqry['id']=$unqid;	
			$insqry['timestamp']=$IISMethods->getdatetime();
			$insqry['entry_date']=$datetime;

			$DB->executedata('i','tblcontactus',$insqry,'');

			$compqry="SELECT * FROM tblcompanymaster ORDER BY id ASC LIMIT 1";
			$rescomp=$DB->getmenual($compqry);
			$rowcomp=$rescomp[0];
			
			$compname=$rowcomp['companyname'];
			$emailsub=$compname." - Contact Us";
			$htmldata.='<tr>
							<td align="center" style="margin: 0px; clear: both; font-size: 13px; padding: 10px 20px 0px;">
								<table width="100%" cellspacing="0" align="center" cellpadding="0" style="border:solid 1px #065590;margin-bottom: 10px; padding: 15px; background-color: #F7F7F7; border-radius: 10px">
									<tbody>
										<tr>
											<td align="right" valign="top" style="color:#065590;font-weight:600 ;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%">Name :</td>
											<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$fname.' '.$lname.'</font></td>
										</tr>
										<tr>
											<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Email :</td>
											<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656"><a href="emailto:'.$contact_email.'">'.$contact_email.'</a></font></td>
										</tr>
										<tr>
											<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Phone No. :</td>
											<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656"><a href="tel:'.$phonecode.''.$contact_phone.'">'.$phonecode.' '.$contact_phone.'</a></font></td>
										</tr>
										';
										if($cfcompanyname)
										{
											$htmldata.='<tr>
												<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Company Name :</td>
												<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$cfcompanyname.'</font></td>
											</tr>';
										}
										if($primarycmptype)
										{
											$htmldata.='<tr>
												<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Primary Company Type :</td>
												<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$primarycmptype.'</font></td>
											</tr>';
										}
										if($cfcmpwebsite)
										{
											$htmldata.='<tr>
												<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Company Website :</td>
												<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$cfcmpwebsite.'</font></td>
											</tr>';
										}
										if($country)
										{
											$htmldata.='<tr>
												<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Country :</td>
												<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$country.'</font></td>
											</tr>';
										}
										$htmldata.='<tr>
												<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Message :</td>
												<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$message.'</font></td>
											</tr>';
										$htmldata.='<tr>
											<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Date :</td>
											<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$IISMethods->getdatetime().'</font></td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>';
			$emailto=$CompanyInfo->getMainEmail();	
			$files='';
			$bcc='';
			$cc='';
			$sendername='';
			$emailhostid='';
			$DB->getemailbody($emailto,$emailsub,$htmldata,$files,$bcc,$cc,$sendername,$emailhostid);
			
			

			$status=1;
			// $message="Message Send successfully";
			$message="Your message has been successfully sent, We will contact you soon.";
				
				
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action == 'fillcontactusdescription')
	{
		$isdatafound=0;

		$qrychk="SELECT id,description FROM `tblcontentsetting` WHERE contenttypeid = :contenttypeid";
		$parms = array(
			':contenttypeid'=>$config->getContactusId(),
		);
		
		$contact=$DB->getmenual($qrychk,$parms);
		// echo $qrychk;
		// print_r($contact);
		$response['isdata']=0;
		if($contact)
		{
			$response['isdata']=1;
			$response['data']=$contact[0]['description'];
			$isdatafound=1;
		}

		if($isdatafound == 1)
		{
			$status = 1;
			$message = $errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	
}
require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  