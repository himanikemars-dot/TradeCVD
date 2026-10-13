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
		$qry="select id,type from tblcontenttypemaster WHERE isactive =:isactive";
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
				$htmldata.='<option value="'.$row['id'].'">'.$row['type'].'</option>';
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
			$qry="SELECT id,contenttypeid,title,description,shortdescr,IFNULL(img,'') as img,IFNULL(img2,'') as img2,iconclass FROM tblcontentsetting WHERE contenttypeid = :contenttypeid";
			$parms = array(
				':contenttypeid'=>$contenttypeid,
			);
			$result_ary=$DB->getmenual($qry,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];

				$response['id']=$IISMethods->sanitize($row['id']);
				$response['contenttypeid']=$IISMethods->sanitize($row['contenttypeid']);
				$response['title'] = $IISMethods->sanitize($row['title'],'OUT');
				$response['description'] = $IISMethods->sanitize($row['description'],'OUT');
				$response['chkimg'] = $IISMethods->sanitize($row['img'],'OUT');
				$response['chkimg2'] = $IISMethods->sanitize($row['img2'],'OUT');
				$response['img'] = $IISMethods->sanitize($config->getImageurl().$row['img'],'OUT');
				$response['img2'] = $IISMethods->sanitize($config->getImageurl().$row['img2'],'OUT');
				$response['shortdescr'] =$row['shortdescr'];
				$response['iconclass'] =$row['iconclass'];

				$qrysub="SELECT * FROM tblcontentsettingdetail WHERE contenttypeid=:contenttypeid ORDER BY (case when (displayorder>0) then displayorder else 99999 end)";
				$parms = array(
					':contenttypeid'=>$contenttypeid,
				);
				$result_subary=$DB->getmenual($qrysub,$parms);
				if(sizeof($result_subary)>0)
				{	
					for($i=0;$i<sizeof($result_subary);$i++)
					{
						$subrow=$result_subary[$i];
						$response['result'][$i]['id']=$IISMethods->sanitize($subrow['id']);
						$response['result'][$i]['contenttypeid']=$IISMethods->sanitize($subrow['contenttypeid']);
						$response['result'][$i]['title']=$IISMethods->sanitize($subrow['title']);
						$response['result'][$i]['displayorder']=$IISMethods->sanitize($subrow['displayorder']);
						$response['result'][$i]['descr']=$IISMethods->sanitize($subrow['descr']);
						$response['result'][$i]['imgpath']=$IISMethods->sanitize($config->getImageurl().$subrow['img']);
						$response['result'][$i]['imgpath1']=$IISMethods->sanitize($subrow['img']);
						$response['result'][$i]['persontage']=$IISMethods->sanitize($subrow['persontage']);
						$response['result'][$i]['colorcode']=$IISMethods->sanitize($subrow['colorcode']);
						$response['result'][$i]['iconname']=$IISMethods->sanitize($subrow['iconname']);
					}
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
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='insertcontentsetting')   
	{
		$contenttypeid=$IISMethods->sanitize($_POST['contenttypeid']);
		$description=$_POST['contentdescr'];
		$shortdescr=$_POST['shortdescr'];
		$description=$_POST['descr'];
		$title =$IISMethods->sanitize($_POST['title']);
		$maintitle =$IISMethods->sanitize($_POST['maintitle']);
		$title2 =$IISMethods->sanitize($_POST['title2']);
		$img=$_FILES['img']['name'];
		$img2=$_FILES['img2']['name'];

		$ostitle = $_POST['tblostitle'];
		$osdescr = $_POST['tblosdescr'];
		$osdisplayorder = $_POST['tblosdisplayorder'];
		$osicon = $_POST['tblosicon'];

		$abttitle = $_POST['tblabttitle'];
		$waetitle = $_POST['tblwaetitle'];
		$waedisplayorder = $_POST['tblwaedisplayorder'];
		
		$sbtitle = $_POST['tblsbtitle'];
		$sbpersontage = $_POST['tblsbpersontage'];
		$sbcolor = $_POST['tblsbcolor'];
		$sbdisplayorder = $_POST['tblsbdisplayorder'];
		
		$tblaboutimg=$_POST['tblaboutimg'];
		$tblaboutdisplayorder=$_POST['tblaboutdisplayorder'];
		$iconclass=$_POST['iconclass'];
		if($contenttypeid)
		{
			$qry="select * from tblcontentsetting where contenttypeid=:contenttypeid";
			$parms = array(
				':contenttypeid'=>$contenttypeid,
			);
			$result_ary=$DB->getmenual($qry,$parms);
			if(sizeof($result_ary) > 0)
			{
				$row = $result_ary[0];


				if($contenttypeid == $config->getTermsConditionId() || $contenttypeid == $config->getPrivacyPolicyId()  || $contenttypeid == $config->getDealerTrustid()  || $contenttypeid == $config->getContactusId()  || $contenttypeid == $config->getCookiesid()) // for Terms & Conditions && Privacy
				{
					if($contenttypeid && $description)
					{
						try 
						{
							$DB->begintransaction();
							$insdata = array(
								'contenttypeid'=>$contenttypeid,
								'description'=>$description,
								'update_uid'=>$uid,
								'update_date'=>$IISMethods->getdatetime(),
							);
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
						$status=0;
						$message=$errmsg['reqired'];
					}
					
				}
				else if($contenttypeid == $config->getInsurancePolicyid() || $contenttypeid == $config->getEconomicAnalysisid()  || $contenttypeid == $config->getOrganizationalBehaviourid()  ) // for echonomic analysis,Organizational behaviour,Insurance policy
				{
					if($contenttypeid && $description && $iconclass)
					{
						try 
						{
							$DB->begintransaction();
							$insdata = array(
								'contenttypeid'=>$contenttypeid,
								'description'=>$description,
								'iconclass'=>$iconclass,
								'update_uid'=>$uid,
								'update_date'=>$IISMethods->getdatetime(),
							);
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
						$status=0;
						$message=$errmsg['reqired'];
					}
					
				}
				else if($contenttypeid == $config->getAboutUsReliableMotorId() || $contenttypeid == $config->getAboutsavanigemsid()) // For About us
				{
					if($contenttypeid  && $description && $shortdescr && sizeof($tblaboutimg))
					{
						
						try 
						{
							$DB->begintransaction();
							$insdata = array(
								'contenttypeid'=>$contenttypeid,
								'title'=>$maintitle,
								'description'=>$description,
								'shortdescr'=>$shortdescr,
								'update_uid'=>$uid,
								'update_date'=>$IISMethods->getdatetime(),
							);

							$extraparams=array(
								'id'=>$row['id'],
							);
							$DB->executedata('u','tblcontentsetting',$insdata,$extraparams);

							$delextraparams=array(
								'contenttypeid'=>$contenttypeid,
							);
							$DB->executedata('d','tblcontentsettingdetail','',$delextraparams);
							if(sizeof($tblaboutimg)>0)
							{
								for ($j=0; $j<sizeof($tblaboutimg); $j++) 
								{
									$subunqid = $IISMethods->generateuuid();
									$srcfile=$config->getImageurl().$tblaboutimg[$j]; 
									
									$targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$tblaboutimg[$j],$srcfile,$subunqid);
									copy($srcfile, '../../../assets/'.$targetPath);
								
									$datains=array(
										'id'=>$subunqid,
										'contenttypeid'=>$contenttypeid,
										'contentsettingid'=>$row['id'],
										'title'=>'About us Reliable Motor',
										'descr'=>'-',
										'displayorder'=>$tblaboutdisplayorder[$j],
										'img'=>$targetPath,
										'type'=>4
									);
							
									$DB->executedata('i','tblcontentsettingdetail',$datains,'');
									unlink('../../../assets/'.$tblaboutimg[$j]);
								}
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
						$status=0;
						$message=$errmsg['reqired'];
					}
				}
				else if($contenttypeid == $config->getMissionId() || $contenttypeid == $config->getVissionId() || $contenttypeid == $config->getQualityPolicyId()) // For Mission
				{
					if($contenttypeid && $maintitle && $description )
					{
						if($img)
						{
							if($_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png")
							{
									try 
									{
										$DB->begintransaction();
										unlink('../../../assets/'.$row['img']);
										$sourcePath = $_FILES['img']['tmp_name'];
										$targetPath = $IISMethods->uploadallfiles(1,'mission',$img,$sourcePath,$row['id']);
				
										$insdata = array(
											'contenttypeid'=>$contenttypeid,
											'title'=>$maintitle,
											'img'=>$targetPath,
											'description'=>$description,
											'update_uid'=>$uid,
											'update_date'=>$IISMethods->getdatetime(),
										);
										// print_r($insdata);
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
								$status=0;
								$message=$errmsg['filetype'];
							}
						}
						else
						{
							try 
							{
								$DB->begintransaction();
								$insdata = array(
									'contenttypeid'=>$contenttypeid,
									'title'=>$maintitle,
									'description'=>$description,
									'update_uid'=>$uid,
									'update_date'=>$IISMethods->getdatetime(),
								);

								$extraparams=array(
									'id'=>$row['id'],
								);
								$DB->executedata('u','tblcontentsetting',$insdata,$extraparams);

								$delextraparams=array(
									'contenttypeid'=>$contenttypeid,
								);
								$DB->executedata('d','tblcontentsettingdetail','',$delextraparams);
								if(sizeof($obstitle)>0)
								{
									for ($j=0; $j<sizeof($obstitle); $j++) 
									{
										$subunqid = $IISMethods->generateuuid();
										$srcfile=$config->getImageurl().$obsimg[$j]; 
										
										$targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$obsimg[$j],$srcfile,$subunqid);
										copy($srcfile, '../../../assets/'.$targetPath);
									
										$datains=array(
											'id'=>$subunqid,
											'contenttypeid'=>$contenttypeid,
											'title'=>$obstitle[$j],
											'descr'=>$obsdescr[$j],
											'displayorder'=>$obsdisplayorder[$j],
											'img'=>$targetPath,
											'type'=>1,
										);
								
										$DB->executedata('i','tblcontentsettingdetail',$datains,'');
										unlink('../../../assets/'.$obsimg[$j]);
										// unlink('../'.$tblsectoimage[$i]);	
									}
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
						
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
				}
				else if($contenttypeid == $config->getBusinextProcessCmpid()) // For Business Process Company
				{
					if($contenttypeid  && $description )
					{
						if($img)
						{
							if($_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png")
							{
									try 
									{
										$DB->begintransaction();
										unlink('../../../assets/'.$row['img']);
										$sourcePath = $_FILES['img']['tmp_name'];
										$targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$img,$sourcePath,$row['id']);
				
										$insdata = array(
											'contenttypeid'=>$contenttypeid,
											'img'=>$targetPath,
											'description'=>$description,
											'update_uid'=>$uid,
											'update_date'=>$IISMethods->getdatetime(),
										);
										// print_r($insdata);
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
								$status=0;
								$message=$errmsg['filetype'];
							}
						}
						else
						{
							try 
							{
								$DB->begintransaction();
								$insdata = array(
									'contenttypeid'=>$contenttypeid,
									'description'=>$description,
									'update_uid'=>$uid,
									'update_date'=>$IISMethods->getdatetime(),
								);

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
						
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
				}
				
				else if($contenttypeid == $config->getOurSevicesid()) // For Our Services
				{
					if($contenttypeid && $maintitle && $shortdescr && sizeof($ostitle)>0 )
					{
						try 
						{
							
							$DB->begintransaction();
							$insdata = array(
								'contenttypeid'=>$contenttypeid,
								'title'=>$maintitle,
								'shortdescr'=>$shortdescr,
								'update_uid'=>$uid,
								'update_date'=>$IISMethods->getdatetime(),
							);

							$extraparams=array(
								'id'=>$row['id'],
							);
							$DB->executedata('u','tblcontentsetting',$insdata,$extraparams);

							$delextraparams=array(
								'contenttypeid'=>$contenttypeid,
							);
							$DB->executedata('d','tblcontentsettingdetail','',$delextraparams);
							if(sizeof($ostitle)>0)
							{
								for ($j=0; $j<sizeof($ostitle); $j++) 
								{
									$subunqid = $IISMethods->generateuuid();
									// $srcfile=$config->getImageurl().$obsimg[$j]; 
									
									// $targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$obsimg[$j],$srcfile,$subunqid);
									// copy($srcfile, '../../../assets/'.$targetPath);
								
									$datains=array(
										'id'=>$subunqid,
										'contenttypeid'=>$contenttypeid,
										'title'=>$ostitle[$j],
										'descr'=>$osdescr[$j],
										'displayorder'=>$osdisplayorder[$j],
										'iconname'=>$osicon[$j],
										'contentsettingid'=>$row['id']
									);
							
									$DB->executedata('i','tblcontentsettingdetail',$datains,'');
									// unlink('../../../assets/'.$obsimg[$j]);
									// unlink('../'.$tblsectoimage[$i]);	
								}
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
						$status=0;
						$message=$errmsg['reqired'];
					}
				}
				
				
			}
			else
			{
				if($contenttypeid == $config->getTermsConditionId() || $contenttypeid == $config->getPrivacyPolicyId()  || $contenttypeid == $config->getDealerTrustid()  || $contenttypeid == $config->getContactusId() || $contenttypeid == $config->getCookiesid()) // for Terms & Conditions && Privacy
				{
					if($contenttypeid && $description)
					{
						$unqid = $IISMethods->generateuuid();
						try 
						{
							$DB->begintransaction();
							$insdata = array(
								'id'=>$unqid,
								'contenttypeid'=>$contenttypeid,
								'description'=>$description,
								'entry_uid'=>$uid,
								'entry_date'=>$IISMethods->getdatetime(),
							);
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
					
				}else if($contenttypeid == $config->getInsurancePolicyid() || $contenttypeid == $config->getEconomicAnalysisid()  || $contenttypeid == $config->getOrganizationalBehaviourid()  ) // for echonomic analysis,Organizational behaviour,Insurance policy
				{
					if($contenttypeid && $description && $iconclass)
					{
						$unqid = $IISMethods->generateuuid();
						try 
						{
							$DB->begintransaction();
							$insdata = array(
								'id'=>$unqid,
								'contenttypeid'=>$contenttypeid,
								'description'=>$description,
								'iconclass'=>$iconclass,
								'entry_uid'=>$uid,
								'entry_date'=>$IISMethods->getdatetime(),
							);
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
				else if($contenttypeid == $config->getAboutUsReliableMotorId() || $contenttypeid == $config->getAboutsavanigemsid()) // For About us reliable motor (about us)
				{
					if($contenttypeid  && $description && $shortdescr && sizeof($tblaboutimg))
					{
						
							try 
								{
									$DB->begintransaction();
									$unqid = $IISMethods->generateuuid();
								
									
			
									$insdata = array(
										'id'=>$unqid,
										'contenttypeid'=>$contenttypeid,
										// 'title'=>$maintitle,
										'description'=>$description,
										'shortdescr'=>$shortdescr,
										'entry_uid'=>$uid,
										'entry_date'=>$IISMethods->getdatetime(),
									);
									$DB->executedata('i','tblcontentsetting',$insdata,'');
			
									if(sizeof($tblaboutimg)>0)
									{
										for ($j=0; $j<sizeof($tblaboutimg); $j++) 
										{
											$subunqid = $IISMethods->generateuuid();
											$srcfile=$config->getImageurl().$tblaboutimg[$j]; 
											
											$targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$tblaboutimg[$j],$srcfile,$subunqid);
											copy($srcfile, '../../../assets/'.$targetPath);
										
											$datains=array(
												'id'=>$subunqid,
												'contenttypeid'=>$contenttypeid,
												'contentsettingid'=>$unqid,
												'title'=>'About us Reliable Motor',
												'descr'=>'-',
												'displayorder'=>$tblaboutdisplayorder[$j],
												'img'=>$targetPath,
												'type'=>4
											);
									
											$DB->executedata('i','tblcontentsettingdetail',$datains,'');
											unlink('../../../assets/'.$tblaboutimg[$j]);
										}
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
				else if($contenttypeid == $config->getMissionId() || $contenttypeid == $config->getVissionId() || $contenttypeid == $config->getQualityPolicyId()) // For Mission
				{
					if($contenttypeid && $maintitle && $description)
					{
						if($_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png")
						{
								try 
								{
									$DB->begintransaction();
									$unqid = $IISMethods->generateuuid();
								
									$sourcePath = $_FILES['img']['tmp_name'];
									$targetPath = $IISMethods->uploadallfiles(1,'mission',$img,$sourcePath,$unqid);
			
									$insdata = array(
										'id'=>$unqid,
										'contenttypeid'=>$contenttypeid,
										'title'=>$maintitle,
										'img'=>$targetPath,
										'description'=>$description,
										'entry_uid'=>$uid,
										'entry_date'=>$IISMethods->getdatetime(),
									);
									$DB->executedata('i','tblcontentsetting',$insdata,'');
			
									$delextraparams=array(
										'contenttypeid'=>$contenttypeid,
									);
									$DB->executedata('d','tblcontentsettingdetail','',$delextraparams);
									if(sizeof($obstitle)>0)
									{
										for ($j=0; $j<sizeof($obstitle); $j++) 
										{
											$subunqid = $IISMethods->generateuuid();
											$srcfile=$config->getImageurl().$obsimg[$j]; 
											
											$targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$obsimg[$j],$srcfile,$subunqid);
											copy($srcfile, '../../../assets/'.$targetPath);
										
											$datains=array(
												'id'=>$subunqid,
												'contenttypeid'=>$contenttypeid,
												'title'=>$obstitle[$j],
												'descr'=>$obsdescr[$j],
												'displayorder'=>$obsdisplayorder[$j],
												'img'=>$targetPath,
												'type'=>1,
											);
									
											$DB->executedata('i','tblcontentsettingdetail',$datains,'');
											unlink('../../../assets/'.$obsimg[$j]);
											// unlink('../'.$tblsectoimage[$i]);	
										}
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
							$message=$errmsg['filetype'];
						}
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
				}
				else if($contenttypeid == $config->getBusinextProcessCmpid()) // For Business Process Company
				{
					if($contenttypeid && $description && $img)
					{
						if($_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png")
						{
								try 
								{
									$DB->begintransaction();
									$unqid = $IISMethods->generateuuid();
								
									$sourcePath = $_FILES['img']['tmp_name'];
									$targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$img,$sourcePath,$unqid);
			
									$insdata = array(
										'id'=>$unqid,
										'contenttypeid'=>$contenttypeid,
										// 'title'=>$maintitle,
										'img'=>$targetPath,
										'description'=>$description,
										'entry_uid'=>$uid,
										'entry_date'=>$IISMethods->getdatetime(),
									);
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
							$message=$errmsg['filetype'];
						}
					}
					else
					{
						$status=0;
						$message=$errmsg['reqired'];
					}
				}
				
				else if($contenttypeid == $config->getOurSevicesid()) // For Our Service
				{
					if($contenttypeid && $maintitle && $shortdescr && sizeof($ostitle)>0)
					{
						try 
						{
							$DB->begintransaction();
							$unqid = $IISMethods->generateuuid();
	
							$insdata = array(
								'id'=>$unqid,
								'contenttypeid'=>$contenttypeid,
								'title'=>$maintitle,
								'shortdescr'=>$shortdescr,
								'entry_uid'=>$uid,
								'entry_date'=>$IISMethods->getdatetime(),
							);
							$response['arrya'] = $insdata;
							$DB->executedata('i','tblcontentsetting',$insdata,'');
	
							$delextraparams=array(
								'contenttypeid'=>$contenttypeid,
							);
							$DB->executedata('d','tblcontentsettingdetail','',$delextraparams);
							if(sizeof($ostitle)>0)
							{
								for ($j=0; $j<sizeof($ostitle); $j++) 
								{
									$subunqid = $IISMethods->generateuuid();
									// $srcfile=$config->getImageurl().$obsimg[$j]; 
									
									// $targetPath = $IISMethods->uploadallfiles(1,'aboutusdetail',$obsimg[$j],$srcfile,$subunqid);
									// copy($srcfile, '../../../assets/'.$targetPath);
								
									$datains=array(
										'id'=>$subunqid,
										'contenttypeid'=>$contenttypeid,
										'title'=>$ostitle[$j],
										'descr'=>$osdescr[$j],
										'displayorder'=>$osdisplayorder[$j],
										'iconname'=>$osicon[$j],
										'contentsettingid'=>$unqid
										
									);
							
									$DB->executedata('i','tblcontentsettingdetail',$datains,'');
									// unlink('../../../assets/'.$obsimg[$j]);
									// unlink('../'.$tblsectoimage[$i]);	
								}
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
		}
		else 
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	} 
	else if($action == 'uploadtempfile')
	{
		$title=$IISMethods->sanitize($_POST['title']);
		$description=$IISMethods->sanitize($_POST['description']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$count = $IISMethods->sanitize($_POST['count']);
		$iconimg = $_FILES['iconimg']['tmp_name'];

		$updimg=$_FILES['imgfile']['tmp_name'];
		if($updimg)
		{
			if($_FILES['imgfile']['type'] == "image/jpg" || $_FILES['imgfile']['type'] == "image/jpeg" || $_FILES['imgfile']['type'] == "image/png")
			{
					$unqid = $IISMethods->generateuuid();
					$targetPath = $IISMethods->uploadallfiles(1,'tempimg',$_FILES['imgfile']['name'],$updimg,$unqid);
					$response['imgurl1']=$targetPath;
					$response['imgurl']=$config->getImageurl().$targetPath;
					$response['title']=$title;
					$response['description']=$description;
					$response['displayorder']=$displayorder;
		

					$status=1;
					$message=$errmsg['success'];
				
			}
			else
			{
				$status=0;
				$message=$errmsg['filetype'];
			}
		}
		else if($iconimg)
		{
			if($_FILES['iconimg']['type'] == "image/jpg" || $_FILES['iconimg']['type'] == "image/jpeg" || $_FILES['iconimg']['type'] == "image/png")
			{
					$unqid = $IISMethods->generateuuid();
					$targetPath = $IISMethods->uploadallfiles(1,'tempimg',$_FILES['iconimg']['name'],$iconimg,$unqid);
					$response['imgurl1']=$targetPath;
					$response['imgurl']=$config->getImageurl().$targetPath;
					$response['title']=$title;
					$response['count']=$count;

					$status=1;
					$message=$errmsg['success'];
			}
			else
			{
				$status=0;
				$message=$errmsg['filetype'];
			}
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	} 

	else if($action == 'uploadabouttempfile')
	{
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		
		$updimg=$_FILES['imgfile']['tmp_name'];
		if($updimg)
		{
			if($_FILES['imgfile']['type'] == "image/jpg" || $_FILES['imgfile']['type'] == "image/jpeg" || $_FILES['imgfile']['type'] == "image/png")
			{
					$unqid = $IISMethods->generateuuid();
					$targetPath = $IISMethods->uploadallfiles(1,'tempimg',$_FILES['imgfile']['name'],$updimg,$unqid);
					$response['imgurl1']=$targetPath;
					$response['imgurl']=$config->getImageurl().$targetPath;
					$response['displayorder']=$displayorder;
					$status=1;
					$message=$errmsg['success'];
				
			}
			else
			{
				$status=0;
				$message=$errmsg['filetype'];
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

  