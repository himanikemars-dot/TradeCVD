<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/blogmaster.php';

$Pagerights = $IISMethods->getpageaccess($LoginInfo->getUserrights(),$userpagename);

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertblogmaster')
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$title=$IISMethods->sanitize($_POST['title'],'OUT');
		$date=$IISMethods->sanitize($_POST['date']);
		$tags=implode(',',str_replace(',','',$_POST['tags']));
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$authorname=$IISMethods->sanitize($_POST['authorname'],'OUT');
		$shortlink=$IISMethods->sanitize($_POST['shortlink']);
		$shortdescription=$IISMethods->sanitize($_POST['shortdescription'],'OUT');
		$description=$_POST['description'];
		$titletag=$IISMethods->sanitize($_POST['titletag'],'OUT');
		$metakeyword=$IISMethods->sanitize($_POST['metakeyword'],'OUT');
		$metadescription=$IISMethods->sanitize($_POST['metadescription'],'OUT');

		$id = $IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();

		if($title && $displayorder && $date && $shortdescription && $description && $titletag && $metakeyword && $metadescription)
		{			
			$insqry=array(					
				'title'=>$title,
				'date'=>$date,
				'tags'=>$tags,
				'authorname'=>$authorname,
				'shortlink'=>$shortlink,
				'displayorder'=>$displayorder,
				'shortdescription'=>$shortdescription,
				'description'=>$description,
				'titletag'=>$titletag,
				'metakeyword'=>$metakeyword,
				'metadescription'=>$metadescription,
			);

			if($formevent=='addright')
			{
				$qrychk="SELECT shortlink from tblblogmaster where shortlink=:shortlink";
				$parms = array(
					':shortlink'=>$shortlink,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					try
					{
						$DB->begintransaction();

						$unqid = $IISMethods->generateuuid();

						$insqry['id']=$unqid;
						$insqry['isactive']=1;
						$insqry['timestamp']=$datetime;
						$insqry['entry_uid']=$uid;
						$insqry['entry_date']=$datetime;
						$DB->executedata('i','tblblogmaster',$insqry,'');

						$status=1;
						$message=$errmsg['insert'];

						$DB->committransaction();
					}
					catch (Exception $e)
					{
						$DB->rollbacktransaction($e);
						$status=0;
						$message=$errmsg['dbtransactionerror'].$e;
					}
				}
			}
			else if($formevent=='editright')
			{
				$qrychk="SELECT shortlink from tblblogmaster where shortlink=:shortlink AND id<>:id";
				$parms = array(
					':shortlink'=>$shortlink,
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
					try
					{
						$DB->begintransaction();

						$insqry['update_uid']=$uid;
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblblogmaster',$insqry,$extraparams);

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
			try
			{
				$DB->begintransaction();
				$qryimg="select id,image,thumbimage from tblblogimage where blogid=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				foreach($resimg AS $row)
				{
				
					unlink('../../../assets/'.$row['image']);
					unlink('../../../assets/'.$row['thumbimage']);
					$extraparams1=array(
						'id'=>$row['id']
					);
					$DB->executedata('d','tblblogimage','',$extraparams1);
				}
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('d','tblblogmaster','',$extraparams);
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
		else if(sizeof($bulk)>0)
		{
			try 
			{
				$DB->begintransaction();

				$usemenu='';
				for($i=0;$i<sizeof($bulk);$i++)
				{
					$id=$bulk[$i];
					$qryimg="select id,image,thumbimage from tblblogimage where blogid=:id";
					$parms = array(
						':id'=>$id,
					);
					$resimg=$DB->getmenual($qryimg,$parms);
					foreach($resimg AS $row)
					{
					
						unlink('../../../assets/'.$row['image']);
						unlink('../../../assets/'.$row['thumbimage']);
						$extraparams1=array(
							'id'=>$row['id']
						);
						$DB->executedata('d','tblblogimage','',$extraparams1);
					}

					$extraparams=array(
						'id'=>$IISMethods->sanitize($id)
					);
					$DB->executedata('d','tblblogmaster','',$extraparams);
				}
				$status=1;
				$message=$errmsg['delete'];//.' '.$usemenu;

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
	else if($action=='editblogmaster')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,title,date,tags,displayorder,authorname,shortlink,shortdescription,description,shortdescription,titletag,metakeyword,metadescription from tblblogmaster where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['title']=$IISMethods->sanitize($row['title'],'OUT');
				$response['date']=$IISMethods->sanitize($row['date']);
				$response['tags']=$IISMethods->sanitize($row['tags'],'OUT');
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				$response['authorname']=$IISMethods->sanitize($row['authorname'],'OUT');
				$response['shortlink']=$IISMethods->sanitize($row['shortlink']);
				$response['shortdescription']=$IISMethods->sanitize($row['shortdescription'],'OUT');
				$response['description']=$IISMethods->sanitize($row['description'],'OUT');
				$response['titletag']=$IISMethods->sanitize($row['titletag'],'OUT');
				$response['metakeyword']=$IISMethods->sanitize($row['metakeyword'],'OUT');
				$response['metadescription']=$IISMethods->sanitize($row['metadescription'],'OUT');
			}
			$status=1;
			$message=$errmsg['datafound'];
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
		$qry="select timestamp as primary_date,id,title,date,displayorder,isactive
		from tblblogmaster 
		where (title like :titlefilter or date like :datefilter or displayorder like :displayorderfilter) 
		order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':titlefilter'=>$filter,
			':datefilter'=>$filter,
			':displayorderfilter'=>$filter
		);
		$blogs=$DB->getmenual($qry,$parms,'blog');
		// echo $qry;
		// print_r($parms);
		
		if($responsetype=='HTML')
		{
			if($blogs)
			{
				$i=0;
				foreach($blogs as $blog)
				{
					$id="'".$blog->id."'";
					$htmldata.='<tr data-index="'.$blog->id.'">';
			
					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if(((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if(((($rightstotalcount)>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright  - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					// $htmldata.='<a class="dropdown-blog" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
					// $htmldata.='<a class="dropdown-blog" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
					
					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$blog->id.'" value="'.$IISMethods->sanitize($blog->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$blog->id.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-original-title="View Blog Details" onclick="viewblogdetaildata('.$IISMethods->sanitize($id).')">'.$IISMethods->sanitize($blog->title,'OUT').'</a></td>';

					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($blog->date).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($blog->displayorder).'</td>';
					if((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-name">';
						$htmldata.='<a href="javascript:void(0)" onclick="uploadblogimage('.$id.')" data-toggle="tooltip" data-title="Add Image"><i class="bi bi-plus-circle" style="font-size: 20px;"></i></a>';
						$htmldata.='</td>';

						if($blog->isactive==1)
						{
							$htmldata.='<td class="tbl-name"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="changeisactiveblogmaster('.$id.')" checked>';
							$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="changeisactiveblogmaster('.$id.')">';
							$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
					}

					$htmldata.='</tr>';
					
					$i++;
				}
				
				// echo $htmldata;
				
				$status=1;
				$message=$errmsg['success'];
				
			}
			else
			{	
				if($page<=0 && sizeof($blogs)<=0)
                {
					$htmldata.=file_get_contents($config->getNoDataFound());
					$message=$errmsg['nodatafound'];

                }
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			
			$response['data']= json_encode($blogs);
		}

		
		$common_listdata=$blogs;

		

		// print_r($response);
	}
	else if($action=='viewblogdata')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select * from tblblogmaster where id=:id";
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
				$tbldata.='<div class="col-12 col-md-8 col-lg">';
				$tbldata.='<div class="row">';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Title <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['title'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Date <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['date'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Tags <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['tags'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Author Name <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['authorname'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Short Link <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['shortlink'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Display Order <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['displayorder'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-12 col-xl-12 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-3 text-dot-right pr-sm-0">';
				$tbldata.='<label>Short Description <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-9">';
				$tbldata.='<label class="label-view"><b>'.$row['shortdescription'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-12 col-xl-12 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-3 text-dot-right pr-sm-0">';
				$tbldata.='<label>Description <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-9">';
				$tbldata.='<label class="label-view"><b>'.$IISMethods->sanitize($row['description'],'OUT').'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Title Tag <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['titletag'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Meta Keyword <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['metakeyword'].'</b></label>';
				$tbldata.='</div></div></div>';

				$tbldata.='<div class="col-12 col-lg-6 col-xl-6 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-6 text-dot-right pr-sm-0">';
				$tbldata.='<label>Meta Description <span>:</span></label>';
				$tbldata.='</div>';
				$tbldata.='<div class="col-12 col-sm-8 col-lg-6">';
				$tbldata.='<label class="label-view"><b>'.$row['metadescription'].'</b></label>';
				$tbldata.='</div></div></div>';

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
	else if($action=='changeisactiveblogmaster')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			try 
			{
				$DB->begintransaction();

				$qrychk="select isactive from tblblogmaster where id=:id";
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
				$DB->executedata('u','tblblogmaster',$insqry,$extraparams);

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
	//Insert Blog Images
	else if($action=='insertblogimages')
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$blogimg=$_FILES['blogimg']['name'];
		$svideo=$_FILES['videofile']['name'];
		$youtubeurl=$_POST['youtubeurl'];
		$blogid=$IISMethods->sanitize($_POST['blogid']);
		$mediatype=$IISMethods->sanitize($_POST['media']);

		if($blogid && $mediatype)
		{

			try
			{
				$DB->begintransaction();

				if($mediatype==1)
				{
					if(is_array($_FILES))
					{
						$isupdimg = 0;
						foreach ($_FILES['blogimg']['name'] as $name => $value)
						{
							if($_FILES['blogimg']['type'][$name] == 'image/jpg'  || $_FILES['blogimg']['type'][$name] == 'image/jpeg' || $_FILES['blogimg']['type'][$name] == 'image/png')
							{

								$unqid = $IISMethods->generateuuid();
								$sourcePath = $_FILES['blogimg']['tmp_name'][$name];
								$targetPath = $IISMethods->uploadallfiles(1,'blog',$_FILES['blogimg']['name'][$name],$sourcePath,$_FILES['blogimg']['name'][$name],$unqid);
								$expath=explode('|',$targetPath);
								$insdata = array(
									'id'=>$unqid,
									'blogid'=>$blogid,
									'image'=>trim($expath[0]),
									'displayorder'=>999,
									'timestamp'=>$IISMethods->getdatetime(),
									'mediatype'=>1,
									'thumbimage'=>trim($expath[1]),
								);
								$DB->executedata('i','tblblogimage',$insdata,'');
								$isupdimg=1;

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
							$message=$errmsg['reqired'];
						}

					}

				}
				else if($mediatype==2)
				{
					if($svideo)
					{
						$isupdimg = 0;
						
							$unqid = $IISMethods->generateuuid();
							$sourcePath = $_FILES['videofile']['tmp_name'];
							$targetPath = $IISMethods->uploadallfiles(1,'blog',$_FILES['videofile']['name'],$sourcePath,$_FILES['videofile']['name'],$unqid);

							$insdata = array(
								'id'=>$unqid,
								'blogid'=>$blogid,
								'image'=>$targetPath,
								'displayorder'=>999,
								'timestamp'=>$IISMethods->getdatetime(),
								'mediatype'=>2
							);
							$DB->executedata('i','tblblogimage',$insdata,'');
							$isupdimg=1;

					}

				}
				else if($mediatype==3)
				{
					if($youtubeurl)
					{
						$isupdimg = 0;
						$qry="SELECT * FROM tblblogimage WHERE blogid=:blogid AND mediatype=3 AND image=:image";
						$params=array(
							':blogid'=>$blogid,
							':image'=>$youtubeurl,
						);
						$res=$DB->getmenual($qry,$params) ;

						if(sizeof($res)>0)
						{
							$status=0;
							$message=$errmsg['isexist'];
						}
						else{
							$unqid = $IISMethods->generateuuid();

							$insdata = array(
								'id'=>$unqid,
								'blogid'=>$blogid,
								'image'=>$youtubeurl,
								'displayorder'=>999,
								'timestamp'=>$IISMethods->getdatetime(),
								'mediatype'=>3
							);
							$DB->executedata('i','tblblogimage',$insdata,'');
							$status=1;
							$message=$errmsg['insert'];
							$response['blogid']= $blogid;
						}	
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
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
			$message=$errmsg['reqired'];
		}
	}
	//Get Uploaded Blog Image Details
	else if($action == 'getblogimages')
	{
		$blogid=$IISMethods->sanitize($_POST['blogid']);
		if($blogid)
		{
			$qrysub="select id,blogid,image,ifnull(displayorder,0) as displayorder ,mediatype from tblblogimage where blogid=:blogid order by displayorder";
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
					$response['result'][$i]['mediatype']=$IISMethods->sanitize($subrow['mediatype']);
					$response['result'][$i]['youtubeimg']='';
					if($subrow['mediatype']!=3)
					{
						$response['result'][$i]['imgpath']=$IISMethods->sanitize($config->getImageurl().$subrow['image']);
					}else if($subrow['mediatype']==3){

						$response['result'][$i]['imgpath']=$IISMethods->sanitize($subrow['image']);
						// $response['result'][$i]['youtubeimg']=$IISMethods->getyoutubeimage($IISMethods->sanitize($subrow['image']));
					}else{
						$response['result'][$i]['imgpath']='';
					}
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
	//Remove Blog Image
	else if($action == 'removeblogimage')
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$blogid=$IISMethods->sanitize($_POST['blogid']);
		if($id)
		{
			try
			{
				$DB->begintransaction();

				$qryimg="select id,image,thumbimage from tblblogimage where id=:id";
				$parms = array(
					':id'=>$id,
				);
				$resimg=$DB->getmenual($qryimg,$parms);
				$row=$resimg[0];
				// if($row['image'])
				// {
				// echo '../assets/'.$row['image']; exit;
				unlink('../../../assets/'.$row['image']);
				unlink('../../../assets/'.$row['thumbimage']);
				// }

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
	//Change Blog Image Display Order
	else if($action == 'changeblogimgdiplayorder')
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
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  