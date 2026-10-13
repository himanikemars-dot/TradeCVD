<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/report.php';

if($isvalidUser['status'] == 1) 
{
	
	$status=0;
	$message='Invalid request';

	if($action == 'filldaytime')
	{
		$id=$IISMethods->sanitize($_POST['id']);

		$qry="select dm.*,'' as ischecked,'' as fromtime,'' as totime
			from tbldaymaster dm order by timestamp asc";
		$parms = array();
		$result_ary=$DB->getmenual($qry,$parms);

		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];

				$disabled = "disabled";
				$checked = "";
				if($row['ischecked'] != '')
				{
					$checked = "checked";
					$disabled = "";
				}

				$fromtime = "";
				if($row['fromtime'] != '')
				{
					$fromtime = $row['fromtime'];
				}

				$totime = "";
				if($row['totime'] != '')
				{
					$totime = $row['totime'];
				}

				
				$htmldata.='<tr data-index="'.$IISMethods->sanitize($i).'">';
				$htmldata.='<td class="tbl-w100">';
				$htmldata.='<div class="text-center">';
				$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
				$htmldata.='<input type="checkbox" class="custom-control-input d-none tbldaychk" value="'.$IISMethods->sanitize($i).'"  id="tbldaychk'.$IISMethods->sanitize($i).'" name="tbldaychk[]" data-chktmp="'.$IISMethods->sanitize($i).'" '.$IISMethods->sanitize($checked).'>';
				$htmldata.='<label class="custom-control-label mb-0" for="tbldaychk'.$IISMethods->sanitize($i).'"></label>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</td>';
				$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row['dayname']).'';
					$htmldata.='<input type="hidden" id="tbldayid'.$IISMethods->sanitize($i).'" name="tbldayid'.$IISMethods->sanitize($i).'" value="'.$IISMethods->sanitize($row['id']).'" />';
				$htmldata.='</td>';
				$htmldata.='<td>';
				$htmldata.='<input type="text" class="form-control providerstarttime tblfromtime" id="tblfromtime'.$IISMethods->sanitize($i).'" name="tblfromtime'.$IISMethods->sanitize($i).'" value="'.$IISMethods->sanitize($fromtime).'" '.$IISMethods->sanitize($disabled).' placeholder="Enter From time" data-tblindex = "'.$IISMethods->sanitize($i).'" />';
				$htmldata.='</td>';
				$htmldata.='<td>';
				$htmldata.='<input type="text" class="form-control providertotime tbltotime" id="tbltotime'.$IISMethods->sanitize($i).'" name="tbltotime'.$IISMethods->sanitize($i).'" value="'.$IISMethods->sanitize($totime).'" '.$IISMethods->sanitize($disabled).' placeholder="Enter To time" data-tblindex = "'.$IISMethods->sanitize($i).'" />';
				$htmldata.='</td>';
				$htmldata.='</tr>';
				
			}
		}
		$response['data']=$htmldata;
		$status=1;
		$message=$errmsg['success'];
	}
	
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';  


?>

  