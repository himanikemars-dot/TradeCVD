<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	
	if($action=='insertproductenquirydata')   
	{
		
		$enqproductid=$IISMethods->sanitize($_POST['enqproductid']);
		$enqcategoryid=$IISMethods->sanitize($_POST['enqcategoryid']);
		$enquiry_name=$IISMethods->sanitize($_POST['enquiry_name']);
		$enquiry_lastname = $IISMethods->sanitize($_POST['enquiry_lastname']);

		$enquiry_email = $IISMethods->sanitize($_POST['enquiry_email']);
		$enquiry_phone = $IISMethods->sanitize($_POST['enquiry_phone']);
		$enquiry_message = $IISMethods->sanitize($_POST['enquiry_message']);
		$productname = $IISMethods->sanitize($_POST['productname']);
		$companyname= $IISMethods->sanitize($_POST['enquiry_companyname']);
		$datetime=$IISMethods->getdatetime();
		if($enqproductid && $enquiry_name && $enquiry_lastname && $enquiry_email && $enquiry_phone && $enquiry_message)
		{			
			$insqry=array(	
				'categoryid'=>$enqcategoryid,
				'productid'=>$enqproductid,				
				'productname'=>$productname,
				'firstname'=>$enquiry_name,	
				'lastname'=>$enquiry_lastname,
				'email'=>$enquiry_email,
				'contact'=>$enquiry_phone,
				'message'=>$enquiry_message,
				'companyname'=>$companyname	
			);
			
			
				
			$unqid = $IISMethods->generateuuid();
				
			$insqry['id']=$unqid;	
			$insqry['timestamp']=$IISMethods->getdatetime();
			$insqry['entry_uid']=$uid;	
			$insqry['entry_date']=$datetime;

			$DB->executedata('i','tblenquiry',$insqry,'');

			$compqry="SELECT * FROM tblcompanymaster ORDER BY id ASC LIMIT 1";
			$rescomp=$DB->getmenual($compqry);
			$rowcomp=$rescomp[0];
			
			$compname=$rowcomp['companyname'];
			$complogo=$rowcomp['logoimg'];
			$emailsub=$compname." - Enquiry";
			$emailtext='';
			$emailtext.='<div align="center" bgcolor="#f9f9fb" style="padding-bottom:50px;font-family:Verdana,Geneva,Arial,Helvetica,sans-serif" width="">
							<table align="center" width="580">
								<tbody><tr><td>
									<table cellpadding="15" style="width: 100%; border-color: #1D478C; border-radius: 5px; box-shadow: 0 0px 15px 1px rgba(6, 85, 144, 0.4); padding: 10px;">
										<tbody><tr><td>
											<table width="100%">
												<tbody>
													<tr><td>
														<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0; border-bottom: solid 1px #EEE;">
															<tbody><tr>
																<td width="500" style="text-align: center;">
																	<a target="_blank" href="'.$config->getWeburl().'" title="'.$compname.'">
																		<img height="100" class="CToWUd" src="'.$config->getCdnurl().'assets/images/logo.png" alt="'.$compname.'">
																	</a>
																</td>
															</tr></tbody>
														</table>
													</td></tr>
													<tr style="height: 10px;"></tr>
													<tr><td>
														<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0">
															<tbody>
																<tr>
																	<td align="center" valign="top" colspan="4" >
																		<h2 style="padding: 4px 5px; margin: 0px 0px 15px; text-align: center; color: #666"> '.$compname.' - Enquiry </h2>
																	</td>
															</tr></tbody>
														</table>
													</td></tr>
													<tr>
														<td align="center" style="margin: 0px; clear: both; font-size: 13px; padding: 10px 20px 0px;">
															<table width="100%" cellspacing="0" cellpadding="0" style="border:solid 1px #065590;margin-bottom: 10px; padding: 15px; background-color: #F7F7F7; border-radius: 10px">
																<tbody>
																	<tr>
																		<td align="right" valign="top" style="color:#065590;font-weight:600 ;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%">Name :</td>
																		<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$enquiry_name.' '.$enquiry_lastname.'</font></td>
																	</tr>
																	<tr>
																		<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Email :</td>
																		<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$enquiry_email.'</font></td>
																	</tr>
																	<tr>
																		<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Contact :</td>
																		<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$enquiry_phone.'</font></td>
																	</tr>
																	<tr>
																		<td align="right" valign="top" style="color:#065590;font-weight:600 ;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%">Product :</td>
																		<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$productname.'</font></td>
																	</tr>
																	<tr>
																		<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Message :</td>
																		<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.$enquiry_message.'</font></td>
																	</tr>
																	<tr>
																		<td align="right" valign="top" style="color:#065590; font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:30%"> Date :</td>
																		<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;color:#565656">'.date('d/m/Y').'</font></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td></tr></tbody>
									</table>		
								</td></tr></tbody>
							</table>
						</div>';
			
			$emailto=$CompanyInfo->getMainEmail();	
			// $emailto="hemant.lad@instanceit.com";	
			$email_subject =$compname." - Enquiry";
			$email_body = $emailtext;
			
			$DB->sendemail($emailto,$email_subject,$email_body,'','','',$compname,'');

			$status=1;
			// $message=$errmsg['insert'];
			// $message="Message Send successfully";
			$message="Your message has been successfully sent, We will contact you soon.";
				
				
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}

}	

require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  