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
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		if($typeid)
		{
			$qry="SELECT id,typeid,ifnull(fileurl,'') AS fileurl  FROM tbldocumentupload WHERE typeid = :typeid";
			$parms = array(
				':typeid'=>$typeid,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['typeid']=$IISMethods->sanitize($row['typeid']);
				$response['fileurl']=$IISMethods->sanitize($row['fileurl']);
				$response['fileurlpath']=$config->getImageurl().$IISMethods->sanitize($row['fileurl']);
				$status=1;
				$message=$errmsg['datafound'];

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
	else if($action=='removeimage')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qry="select id,fileurl from tbldocumentupload where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0) 
			{
				$row=$result_ary[0];
				unlink('../../../assets/'.$row['fileurl']);

				$insdata = array(
					'fileurl'=>'',
				);
				$extraparams=array(
					'id'=>$row['id'],
				);
				$DB->executedata('u','tbldocumentupload',$insdata,$extraparams);

				$status=1;
				$message=$errmsg['delete'];
			}

		}
	}
	else if($action=='insertdocumentupload')   
	{
		$typeid=$IISMethods->sanitize($_POST['typeid']);
		$docfile=$_FILES['docfile']['name'];
		
		if($typeid)
		{
			$qry="select * from tbldocumentupload where typeid=:typeid";
			$parms = array(
				':typeid'=>$typeid,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			

			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				try 
				{
					$DB->begintransaction();

					$insdata = array(
						'typeid'=>$typeid,
						'update_uid'=>$uid,
						'update_date'=>$IISMethods->getdatetime(),
						'timestamp'=>$IISMethods->getdatetime(),
					);

					if($docfile)
					{
						$documentuploadssourcePath = $_FILES['docfile']['tmp_name'];
                        $documentuploadstargetPath = $IISMethods->uploadallfiles(1,'documentupload',$docfile,$documentuploadssourcePath,$row['id']);
                        $insdata['fileurl']=$documentuploadstargetPath;
                        
                        $extraparams=array(
                            'id'=>$row['id'],
                        );
                        $DB->executedata('u','tbldocumentupload',$insdata,$extraparams);

                        $status=1;
                        $message=$errmsg['update'];
						
					}
					else
					{
						$insdata['fileurl']=$row['fileurl'];
						
						$extraparams=array(
							'id'=>$row['id'],
						);
						$DB->executedata('u','tbldocumentupload',$insdata,$extraparams);

						$status=1;
						$message=$errmsg['update'];
					}

					
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
				try 
				{
					$DB->begintransaction();

					$insdata = array(
						'typeid'=>$typeid,
						'entry_uid'=>$uid,
						'entry_date'=>$IISMethods->getdatetime(),
						'timestamp'=>$IISMethods->getdatetime(),
					);
					if($docfile)
					{
                        $unqid = $IISMethods->generateuuid();
						$documentuploadssourcePath = $_FILES['docfile']['tmp_name'];
                        $documentuploadstargetPath = $IISMethods->uploadallfiles(1,'documentupload',$docfile,$documentuploadssourcePath,$unqid);
                        $insdata['id']=$unqid;
                        $insdata['fileurl']=$documentuploadstargetPath;
                        $DB->executedata('i','tbldocumentupload',$insdata,'');
                        $status=1;
                        $message=$errmsg['insert'];
						
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}

					
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
			$message=$errmsg['reqired'];
		}
	} 
	
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  