<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/blog.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertblogmaster')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$IISMethods->sanitize($_POST['title']);
		$authername=$IISMethods->sanitize($_POST['authername']);
		$blogdate = $IISMethods->sanitize($_POST['blogdate']);
		$decription = $_POST['contentdescr'];
		$shortdescr=$_POST['shortdescr'];
		$datetime = $IISMethods->getdatetime();
		$id=$IISMethods->sanitize($_POST['id']);
		if($title && $blogdate && $decription)
		{			
			$insqry=array(					
				'title'=>$title,
				'authername'=>$authername,	
				'description'=>$decription,
				'blogdate'=>$blogdate,
				'shortdescr'=>$shortdescr			
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT title from tblblog where title=:title";
				$parms = array(
					':title'=>$title,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$unqid = $IISMethods->generateuuid();
					$bloguniqid=$DB->RandomblogUnqId(6);
					$insqry['id']=$unqid;	
					$insqry['timestamp']=$IISMethods->getdatetime();
					$insqry['entry_uid']=$uid;	
					$insqry['entry_date']=$datetime;
					$insqry['bloguniqueid']=$bloguniqid;

					$DB->executedata('i','tblblog',$insqry,'');

					$status=1;
					$message=$errmsg['insert'];
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT title from tblblog where title=:title and id<>:id";
				$parms = array(
					':title'=>$title,
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					$insqry['update_uid']=$uid;	
					$insqry['update_date']=$datetime;

					$extraparams=array(
						'id'=>$id
					);
					
					$DB->executedata('u','tblblog',$insqry,$extraparams);

					$status=1;
					$message=$errmsg['update'];
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deleteblogmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('d','tblblog','',$extraparams);
			$status=1;
			$message=$errmsg['delete'];
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];

				$extraparams=array(
					'id'=>$IISMethods->sanitize($id)
				);
				$DB->executedata('d','tblblog','',$extraparams);
			}
			$status=1;
			$message=$errmsg['delete'].' '.$usemenu;
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='editblogmaster')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT cm.* FROM tblblog cm WHERE cm.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$IISMethods->sanitize($row['title'], 'OUT');
				$response['authername']=$IISMethods->sanitize($row['authername'], 'OUT');
				$response['blogdate']=$IISMethods->sanitize($row['blogdate']);
				$response['description']=$IISMethods->sanitize($row['description'], 'OUT');
				$response['shortdescr']=$IISMethods->sanitize($row['shortdescr'], 'OUT');
				
			}
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listblogmaster')   
	{
		$blogs=new blog();
		$qry="SELECT cm.timestamp AS primary_date,cm.id,cm.authername,cm.blogdate,cm.`title`,cm.isactive,cm.showonhome
		FROM tblblog cm 
		where cm.authername like :filter OR cm.title like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$blogs=$DB->getmenual($qry,$parms,'blog');
		
		if($responsetype=='HTML')
		{
			if($blogs)
			{
				$i=0;
				foreach($blogs as $blog)
				{
					$id="'".$blog->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if((($rightstotalcount>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if((($rightstotalcount>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}

					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($blog->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewdescription('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($blog->title, 'OUT').'</a></td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($blog->authername).'</td>';
					$htmldata.='<td class="">'.$IISMethods->sanitize($blog->blogdate).'</td>';
					$htmldata.='<td class="tbl-name" align="center"><a href="javascript:void(0);" class="btn-tbl '.$IISMethods->sanitize($itemmaster->imgclass).' rounded-circle" id="btnaddimages" data-toggle="tooltip" data-placement="top" title="Add Image" data-original-title="Add Image" onclick="uploaditemimage('.$IISMethods->sanitize($id).')"><i class="bi bi-plus"></i></a></td>';
					if((($rightstotalcount>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
					{
						if($blog->isactive == 1)
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="isactive('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="isactive('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}

						/* if($blog->showonhome==1)
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changeshowonhomestatus('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name text-center"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changeshowonhomestatus('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						} */
					}
					else
					{
						$htmldata.='<td class="tbl-name text-center"></td>';
						$htmldata.='<td class="tbl-name text-center"></td>';
					}
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				// $htmldata.=file_get_contents($config-> getNoDataFound());
				// $message=$errmsg['nodatafound'];
				if($page<=0 && sizeof($blogs)<=0)
				{
					// $htmldata.=file_get_contents($config-> getNoDataFound());
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
			$response['data']= json_encode($blogs);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($blogs)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($blogs); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($blogs);
		$response['showentries']=$showentries;
	}    

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblblog where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			$row=$result_ary[0];
			if($row['isactive']==1)
			{
				$isactive=0;
			}
			else
			{
				$isactive=1;
			}
			$insqry['isactive']=$isactive;	
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('u','tblblog',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	//Change Item Status  (Show On Home)
	else if($action=='changeshowonhomestatus')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qrychk="select showonhome from tblblog where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				$row=$result_ary[0];
				if($row['showonhome']==1)
				{
					$showonhome=0;
				}
				else
				{
					$showonhome=1;
				}
				$insqry['showonhome']=$showonhome;	
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblblog',$insqry,$extraparams);
			
			
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
			$message=$errmsg['reqired'];
		}
	}
	//Insert Item Images
	else if($action=='insertitemimages')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$itemimg=$_FILES['itemimg']['name'];
		$blogid=$IISMethods->sanitize($_POST['blogid']);

		if($blogid && sizeof($itemimg))
		{
			try 
			{
				$DB->begintransaction();

				if(is_array($_FILES)) 
				{
					$isupdimg = 0;
					foreach ($_FILES['itemimg']['name'] as $name => $value)
					{
						if($_FILES['itemimg']['type'][$name] == 'image/jpg'  || $_FILES['itemimg']['type'][$name] == 'image/jpeg' || $_FILES['itemimg']['type'][$name] == 'image/png')
						{
							
							$unqid = $IISMethods->generateuuid();
							$sourcePath = $_FILES['itemimg']['tmp_name'][$name];
							$targetPath = $IISMethods->uploadallfiles(1,'blog',$_FILES['itemimg']['name'][$name],$sourcePath,$unqid);

							$insdata = array(
								'id'=>$unqid,
								'blogid'=>$blogid,
								'image'=>$targetPath,
								'displayorder'=>0,
								'entry_date'=>$IISMethods->getdatetime(),
							);
							$DB->executedata('i','tblblogimage',$insdata,'');
							$isupdimg=1;

						}
					}
				}

				if($isupdimg==1)
				{
					$status=1;
					$message=$errmsg['insert'];
					$response['blogid']= $blogid;
				}
				else
				{
					$status=0;
					$message=$errmsg['imgrequired'];
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
			$status=0;
			$message=$errmsg['imgrequired'];
		}
	}
	//Get Uploaded Item Image Details
	else if($action == 'getitemimages')
	{
		$blogid=$IISMethods->sanitize($_POST['blogid']);
		if($blogid)
		{
			$qrysub="select id,blogid,image,ifnull(displayorder,0) as displayorder  from tblblogimage where blogid=:blogid";
			$parms = array(
				':blogid'=>$blogid,
			);
			$result_subary=$DB->getmenual($qrysub,$parms);
			if(sizeof($result_subary)>0)
			{	
				for($i=0;$i<sizeof($result_subary);$i++)
				{
					$subrow=$result_subary[$i];
					$response['result'][$i]['id']=$IISMethods->sanitize($subrow['id']);
					$response['result'][$i]['blogid']=$IISMethods->sanitize($subrow['blogid']);
					$response['result'][$i]['displayorder']=$IISMethods->sanitize($subrow['displayorder']);
					$response['result'][$i]['imgpath']=$IISMethods->sanitize($config->getImageurl().$subrow['image']);
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
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	//Remove Item Image
	else if($action == 'removeitemimage')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$blogid=$IISMethods->sanitize($_POST['blogid']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qryimg="select id,image from tblblogimage where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				$row=$resimg[0];
				if($row['image'])
				{
					unlink($config->getImageurl().$row['image']);
				}
				
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblblogimage','',$extraparams);


				$response['blogid']= $blogid;
				$status=1;
				$message=$errmsg['delete'];

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
	//Change Item Image Display Order
	else if($action == 'changeitemimgdiplayorder')
	{
		$id=$IISMethods->sanitize($_POST['imgid']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$blogid=$IISMethods->sanitize($_POST['blogid']);

		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$updqry=array(
					'displayorder'=>$displayorder,
				);
				
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblblogimage',$updqry,$extraparams);

				$response['blogid']= $blogid;

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
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='showaboutdescription')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT ta.description,ta.shortdescr
					FROM tblblog ta WHERE ta.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$tbldata='';
				$tbldata.='<div class="col-12">';
				$tbldata.='<div class="table-responsive">';
				$tbldata.='<div class="col-12 view-data-details">';
				$tbldata.='<div class="row my-3">';
				
				$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-">';
				$tbldata.='<p>Short Description</p>';
				$tbldata.='</div>';
				$tbldata.='</div></div>';
				$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-12 text-dot-right">';
					$tbldata.='<label class="label-view"><b>'.$row['shortdescr'].'</b></label>';
					$tbldata.='</div>';
					$tbldata.='</div></div>';

				$tbldata.='<div class="col-12 col-md-8 col-lg">';
				$tbldata.='<div class="row">';
					
					$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
					$tbldata.='<p>Description</p>';
					$tbldata.='</div></div></div>';
					$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
					$tbldata.='<div class="col-12 col-sm-4 col-lg-12 text-dot-right">';
					$tbldata.='<label class="label-view"><b>'.$row['description'].'</b></label>';
					$tbldata.='</div>';
					$tbldata.='</div></div>';

				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';
				$tbldata.='</div>';										
				$tbldata.='</div>';


			}

			$response['data']=$tbldata;
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

  