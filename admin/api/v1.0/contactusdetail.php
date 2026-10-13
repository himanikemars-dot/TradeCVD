<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/contactusdetail.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listcontactusdetail')   
	{
		$contactus=new contactus();
		$qry="select e.timestamp as primary_date,e.id,e.firstname,e.lastname ,e.cmpemail,CONCAT(e.phonecode,' ',e.phoneno) AS phone,e.companyname,e.entry_date,DATE_FORMAT(e.entry_date,'%d/%m/%Y %h:%i %p')  AS edate  
			FROM tblcontactus e 
		where e.firstname like :filter or e.lastname like :filter or e.cmpemail like :filter or CONCAT(e.phonecode,' ',e.phoneno) like :filter or e.companyname like :filter or DATE_FORMAT(e.entry_date,'%d/%m/%Y %h:%i %p') like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$contactus=$DB->getmenual($qry,$parms,'contactus');
		
		if($responsetype=='HTML')
		{
			if($contactus)
			{
				$i=0;
				foreach($contactus as $row)
				{
					$id="'".$row->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

					
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->firstname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->lastname).'</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewcontactusmessage('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($row->phone).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->cmpemail).'</td>';
					// $htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->companyname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->edate).'</td>';
					
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($contactus)<=0)
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
			$response['data']= json_encode($contactus);
		}

		$common_listdata=$contactus;
	}    

	else if($action=='viewcontactusmessage')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT e.companyname,e.primarycmptype,e.cmpwebsite,e.country,e.message
					FROM tblcontactus e
					WHERE e.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$htmldata='
				<table width="100%" cellspacing="0" cellpadding="0" style="">
					<tbody>';
						
						
							$htmldata.='<tr>
								<td align="right" valign="top" style=" font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:40%"> Company Name :</td>
								<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;">'.$row['companyname'].'</font></td>
							</tr>';
						
						
							$htmldata.='<tr>
								<td align="right" valign="top" style=" font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:40%"> Primary Company Type :</td>
								<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;">'.$row['primarycmptype'].'</font></td>
							</tr>';
						
						
							$htmldata.='<tr>
								<td align="right" valign="top" style=" font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:40%"> Company Website :</td>
								<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;">'.$row['cmpwebsite'].'</font></td>
							</tr>';
						
						
							$htmldata.='<tr>
								<td align="right" valign="top" style=" font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:40%"> Country :</td>
								<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;">'.$row['country'].'</font></td>
							</tr>';
							$htmldata.='<tr>
								<td align="right" valign="top" style=" font-weight:600; line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:14px;width:40%"> Message :</td>
								<td align="left" valign="top" style="color:#2c2c2c;line-height:20px;margin:0;clear:both;padding:5px 10px;font-size:13px"><font style="font-size:14px;">'.$row['message'].'</font></td>
							</tr>';
						
						$htmldata.='
					</tbody>
				</table>';
			}

			$response['data']=$htmldata;
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

  