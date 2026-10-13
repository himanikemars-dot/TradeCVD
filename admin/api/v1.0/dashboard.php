<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';

if($isvalidUser['status'] == 1)
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listdashboard')   
	{
		$qry="SELECT ts.timestamp AS primary_date,ts.id,ts.firstname,ts.lastname,ts.email,ts.phone,DATE_FORMAT(ts.entry_date,'%d/%m/%Y %h:%i %p') AS entrydate
			  FROM tblcontactus ts 
			  ORDER BY $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array();
		$contactus=$DB->getmenual($qry,$parms);
		
		if($responsetype=='HTML')
		{
			if($contactus)
			{
				$i=0;
				foreach($contactus as $result)
				{
					$id="'".$result->id."'";
					$htmldata.='<tr data-index="'.$i.'">';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewdescription('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($result->fistname).'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($result->lastname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($result->email).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($result->phone).'</td>';
					$htmldata.='<td class="tbl-name text-center">'.$IISMethods->sanitize($result->entrydate).'</td>';
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
			$response['data']= json_encode($contactus);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($contactus)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($contactus); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($contactus);
		$response['showentries']=$showentries;
	}
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  