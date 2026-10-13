<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	if($action=='filladvantagedetail')   
	{
		
			$qry="SELECT id,title,heading1,description,heading2 FROM tbladvantage ORDER BY timestamp limit 1";
			$parms = array(
				
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$IISMethods->sanitize($row['title'],'OUT');
				$response['description'] = $IISMethods->sanitize($row['description'],'OUT');
				$response['heading2']=$IISMethods->sanitize($row['heading2'],'OUT');
				$response['heading1']=$IISMethods->sanitize($row['heading1'],'OUT');

				$subqry="SELECT id,title,description1,description2,displayorder FROM tbladvantagedetail WHERE advantageid=:id ORDER BY displayorder,timestamp";
				$subparams=array(
					':id'=>$row['id']
				);
				$subres=$DB->getmenual($subqry,$subparams);
				if(sizeof($subres)>0)
				{
					$response['result']=$subres;
				}
				$status=1;
				$message=$errmsg['datafound'];

			}
			else
			{
				$status=0;
				$message=$errmsg['nodatafound'];
			}
			
		
	}
	else if($action=='insertadvantage')   
	{
		$title=$IISMethods->sanitize($_POST['title'],'OUT');
		$descr=$IISMethods->sanitize($_POST['descr'],'OUT');
		$heading1=$IISMethods->sanitize($_POST['heading1'],'OUT');
		$heading2=$IISMethods->sanitize($_POST['heading2'],'OUT');
		$tbltitle=$_POST['tbltitle'];
		$tbldisplayorder=$_POST['tbldisplayorder'];
		$tbldescription1=$_POST['tbldescription1'];
		$tbldescription2=$_POST['tbldescription2'];
		
		
		if($title && $descr && $heading1 && $heading2 && sizeof($tbltitle)>0)
		{
			$qry="select DISTINCT id from tbladvantage ORDER BY timestamp LIMIT 1";
			$parms = array(
				
			);
			$result_ary=$DB->getmenual($qry,$parms);

			
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				try 
				{
					$DB->begintransaction();

					$insdata = array(
						'title'=>$title,
						'description'=>$descr,
						'heading1'=>$heading1,
						'heading2'=>$heading2,
						'update_uid'=>$uid,
						'update_date'=>$IISMethods->getdatetime(),
					);
					$extraparams=array(
						'id'=>$row['id'],
					);
					$DB->executedata('u','tbladvantage',$insdata,$extraparams);
					$extraparams1=array(
						'advantageid'=>$row['id'],
					);
					$DB->executedata('d','tbladvantagedetail','',$extraparams1);
					for($i=0;$i<sizeof($tbltitle);$i++)
					{	
						$subunqid = $IISMethods->generateuuid();
						$subdata=array(
							'id'=>$subunqid,
							'advantageid'=>$row['id'],
							'title'=>$tbltitle[$i],
							'description1'=>$tbldescription1[$i],
							'description2'=>$tbldescription2[$i],
							'displayorder'=>$tbldisplayorder[$i],
							'timestamp'=>$IISMethods->getdatetime(),
						);
						$DB->executedata('i','tbladvantagedetail',$subdata,'');
					}

					$status=1;
					$message=$errmsg['update'];
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
				if($title && $descr && $heading1 && $heading2 && sizeof($tbltitle)>0)
				{
					
					try 
					{
						$DB->begintransaction();
						$unqid = $IISMethods->generateuuid();
						$insdata = array(
							'id'=>$unqid,
							'title'=>$title,
							'description'=>$descr,
							'heading1'=>$heading1,
							'heading2'=>$heading2,
							'entry_uid'=>$uid,
							'entry_date'=>$IISMethods->getdatetime(),
							'timestamp'=>$IISMethods->getdatetime(),
						);
						$DB->executedata('i','tbladvantage',$insdata,'');

						for($i=0;$i<sizeof($tbltitle);$i++)
						{	
							$subunqid = $IISMethods->generateuuid();
							$subdata=array(
								'id'=>$subunqid,
								'advantageid'=>$unqid,
								'title'=>$tbltitle[$i],
								'description1'=>$tbldescription1[$i],
								'description2'=>$tbldescription2[$i],
								'displayorder'=>$tbldisplayorder[$i],
								'timestamp'=>$IISMethods->getdatetime(),
							);
							$DB->executedata('i','tbladvantagedetail',$subdata,'');
						}
						$status=1;
						$message=$errmsg['insert'];
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

  