<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='fillcontent')   
	{
		$pageid=$IISMethods->sanitize($_POST['pageid']);
		if($pageid)
		{
			$qry="select * from tblwebpagemaster where id = :pageid";
			$parms = array(
				':pageid'=>$pageid,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title'] = $IISMethods->sanitize($row['title'],'OUT');
				$response['metakeywords'] = $IISMethods->sanitize($row['metakeywords'],'OUT');
				$response['metadescription'] = $IISMethods->sanitize($row['metadescription'],'OUT');

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
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='insertmetasetting')   
	{
		$pageid=$IISMethods->sanitize($_POST['pageid']);
		$title=$IISMethods->sanitize($_POST['pagetitle']);
		$metadescr=$_POST['metadescr'];
		$metakeywords = $_POST['metakeywords'];
		// $description=$_POST['descr'];

		if($pageid && $title && $metadescr && $metakeywords)
		{
			$qry="select id from tblwebpagemaster where id=:pageid";
			$parms = array(
				':pageid'=>$pageid,
			);
			$result_ary=$DB->getmenual($qry,$parms);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
					if($pageid && $metadescr && $metakeywords && $title)
					{
							$insdata = array(
								'metadescription'=>$metadescr,
								'metakeywords'=>$metakeywords,
								'title'=>$title,
								'update_uid'=>$uid,
								'update_date'=>$IISMethods->getdatetime(),
							);
							
							$extraparams=array(
								'id'=>$pageid,
							);
							$DB->executedata('u','tblwebpagemaster',$insdata,$extraparams);

							$status=1;
							$message=$errmsg['update'];	
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
			}
			else
			{
					if($metakeywords && $title && $metadescr)
					{
						$unqid = $IISMethods->generateuuid();
						$insdata = array(
							'id'=>$unqid,
							'metadescription'=>$metadescr,
							'metakeywords'=>$metakeywords,
							'title'=>$title,
							'timestamp'=>$IISMethods->getdatetime(),
							'entry_uid'=>$uid,
							'entry_date'=>$IISMethods->getdatetime(),
						);
						// print_r($insdata);
						$DB->executedata('i','tblwebpagemaster',$insdata,'');

						$status=1;
						$message=$errmsg['insert'];
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
			}
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

  