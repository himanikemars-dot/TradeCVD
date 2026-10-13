<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/advantage.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listadvantagedetail')
	{
		$advantage=new advantage();
		$qrychk="SELECT id,title,heading1,description,heading2 FROM tbladvantage ORDER BY timestamp limit 1";
		$parms = array(
		);
		
		$advantage=$DB->getmenual($qrychk,$parms,'advantage');

		if(sizeof($advantage)>0)
		{
			$response['result'] = $advantage;
			$row=$advantage[0];
			$subqry="SELECT id,title,description1,description2,displayorder FROM tbladvantagedetail WHERE advantageid=:id ORDER BY displayorder,timestamp";
			$subparams=array(
				'id'=>$row->id
			);
			$subres=$DB->getmenual($subqry,$subparams);
			if(sizeof($subres)>0)
			{
				$response['subresult']=$subres;
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

require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  