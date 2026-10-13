<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();
	if($action=='listfaqs')   
	{
		$qry="SELECT id,name,descr,isactive FROM `tblfaqgroupmaster` WHERE isactive = :isactive  ORDER BY displayorder ASC";
		$parms = array(
			':isactive'=>1,
		);
		$faqs=$DB->getmenual($qry,$parms);

		if(sizeof($faqs)>0)
		{
			$i=0;
			foreach($faqs AS $row)
			{
				$id=$row['id'];
				$response['result'][$i]['id']=$row['id'];
				$response['result'][$i]['groupname']=$row['name'];
				$response['result'][$i]['descr']=$row['descr'];
				$subqry="SELECT question,answer,faqgroupname,id FROM tblfaqmaster WHERE faqgroupid=:id AND isactive = :isactive ORDER BY displayorder ASC";
				$subparams=array(
					':id'=>$id,
					':isactive'=>1,
				);
				$subres=$DB->getmenual($subqry,$subparams);
				$response['result'][$i]['faqs']=$subres;
				$i++;
			}
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}


	}else if($action=='listfaqgroup')   
	{
		$qry="SELECT DISTINCT fg.id,fg.name,CONCAT(:imgpath,fg.icon) AS image
			FROM `tblfaqgroupmaster` fg
			INNER JOIN tblfaqmaster f ON f.faqgroupid=fg.id AND f.isactive=1
			WHERE fg.isactive=:isactive GROUP BY fg.id ORDER BY fg.displayorder";
		$parms = array(':isactive'=>1,':imgpath'=>$imgpath);
		$result_ary=$DB->getmenual($qry,$parms);

		if(sizeof($result_ary)>0)
		{
			$response['result'] = $result_ary;
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

  