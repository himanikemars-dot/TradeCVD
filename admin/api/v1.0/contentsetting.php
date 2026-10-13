<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='fillcontenttype')   
	{
		$qry="select id,type,typeid from tblcontenttypemaster WHERE isactive =:isactive AND typeid IN (1,2,3,4,5,6,7,8,13,14,18,19,20,21,22,23,24,26,27,28) ORDER BY typeid ASC";
		$parms = array(
			':isactive'=>1
		);
		$result_ary=$DB->getmenual($qry,$parms);
		$htmldata='';
		if(sizeof($result_ary)>0)
		{
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];
				$htmldata.='<option value="'.$row['id'].'" data-typeid="'.$row['typeid'].'">'.$row['type'].'</option>';
			}
		}
		$response['data']=$htmldata;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='fillcontent')   
	{
		$contenttypeid=$IISMethods->sanitize($_POST['contenttypeid']);
		if($contenttypeid)
		{
			$qry="SELECT id,title,contenttypeid,description,ifnull(img,'') AS img  FROM tblcontentsetting WHERE contenttypeid = :contenttypeid";
			$parms = array(
				':contenttypeid'=>$contenttypeid,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$IISMethods->sanitize($row['title'],'OUT');
				$response['contenttypeid']=$IISMethods->sanitize($row['contenttypeid']);
				$response['description'] = $IISMethods->sanitize($row['description'],'OUT');
				$response['img']=$IISMethods->sanitize($row['img']);
				$response['imgurl']=$config->getImageurl().$IISMethods->sanitize($row['img']);
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
			$qry="select * from tblcontentsetting where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0) 
			{
				$row=$result_ary[0];
				unlink('../../../assets/'.$row['img']);

				$insdata = array(
					'img'=>'',
				);
				$extraparams=array(
					'id'=>$row['id'],
				);
				$DB->executedata('u','tblcontentsetting',$insdata,$extraparams);

				$status=1;
				$message=$errmsg['imgremoved'];
			}

		}
	}
	else if($action=='insertcontentsetting')   
	{
		$contenttypeid=$IISMethods->sanitize($_POST['contenttypeid']);
		$title=$_POST['title'];
		$description=$_POST['descr'];
		if($_POST['contentdescr'])
		{
			$description=$_POST['contentdescr'];
		}
		
		$img=$_FILES['img']['name'];
		
		if($contenttypeid)
		{
			$qry="select * from tblcontentsetting where contenttypeid=:contenttypeid";
			$parms = array(
				':contenttypeid'=>$contenttypeid,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			$qrytype="select typeid from tblcontenttypemaster where id=:contenttypeid";
			$parmstype = array(
				':contenttypeid'=>$contenttypeid,
			);
			$result_arytype=$DB->getmenual($qrytype,$parmstype);

			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];
				try 
				{
					$DB->begintransaction();

					$insdata = array(
						'contenttypeid'=>$contenttypeid,
						'typeid'=>$result_arytype[0]['typeid'],
						'title'=>$title,
						'description'=>$description,
						'update_uid'=>$uid,
						'update_date'=>$IISMethods->getdatetime(),
					);

					if($img)
					{
						$contentsettingssourcePath = $_FILES['img']['tmp_name'];
						$contentsettingstargetPath = $IISMethods->uploadallfiles(1,'contentsetting',$img,$contentsettingssourcePath,$row['id']);
						$insdata['img']=$contentsettingstargetPath;
					}
					else
					{
						$insdata['img']=$row['img'];
					}

					
					$extraparams=array(
						'id'=>$row['id'],
					);
					$DB->executedata('u','tblcontentsetting',$insdata,$extraparams);

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
				if($contenttypeid && $description)
				{
					$unqid = $IISMethods->generateuuid();
					try 
					{
						$DB->begintransaction();
						$insdata = array(
							'id'=>$unqid,
							'title'=>$title,
							'typeid'=>$result_arytype[0]['typeid'],
							'contenttypeid'=>$contenttypeid,
							'description'=>$description,
							'entry_uid'=>$uid,
							'entry_date'=>$IISMethods->getdatetime(),
						);
						if($img)
						{
							$contentsettingssourcePath = $_FILES['img']['tmp_name'];
							$contentsettingstargetPath = $IISMethods->uploadallfiles(1,'contentsetting',$img,$contentsettingssourcePath,$row['id']);
							$insdata['img']=$contentsettingstargetPath;
						}
						$DB->executedata('i','tblcontentsetting',$insdata,'');
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

  