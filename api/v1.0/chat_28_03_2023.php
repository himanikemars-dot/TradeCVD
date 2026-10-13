<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/chat.php';

// 4 - Member to Member Chat
$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(),4)['attributeval'];
$candevicelogin=$DB->getDeviceInLogin($LoginInfo->getUid(),$_SERVER['HTTP_USER_AGENT']);
if($isvalidUser['status'] == 1) 
{	
	if($candevicelogin==1)
    {
		$status=0;
		$message=$errmsg['invalidrequest'];
		$imgpath=$config->getImageurl();
		$currdatetime=date('Y-m-d H:i:s');
		$datetime=$IISMethods->getdatetime();

		$CheckUserRights=$DB->checkpackagewiseuserright($uid);
		$response['IsPackageExpire']=$CheckUserRights['IsPackageExpire'];
		if($CheckUserRights['IsPackageExpire']==1){
			$message = $config->getPackageExpiredMessage();
			$ExpiryTitle = $config->getPackageExpiredTitle();
			$ExpiryURL = $config->getPackageExpiredURL();
			$response['ExpiryTitle']=$ExpiryTitle;
			$response['ExpiryURL']=$ExpiryURL;
		}else{ 
			if($CanMemberToMemberChat==1)
			{
				if($action == 'listchatperson')
				{
					$type=trim($IISMethods->sanitize($_POST['type']));  //1=Buyer,2=Seller
					$nextpage=trim($IISMethods->sanitize($_POST['nextpage']));
					$page=trim($IISMethods->sanitize($_POST['page']));
					$filter=trim($IISMethods->sanitize($_POST['filter'],'OUT'));
					$page -= 1;
					$per_page = trim($IISMethods->sanitize($_POST['per_page']));
					$start = (int)$page * (int)$per_page;
					// print_r($_POST); exit;
					$chatperson=new chatperson();
					
					if($type==1)
					{
						$qry="SELECT tmp.*,DATE_FORMAT(tmp.lastseen,'%d/%m/%Y %h:%i %p') as lseen,IFNULL((
									SELECT COUNT(DISTINCT id) AS unreadmsg FROM `tblchatmessage` 
									WHERE groupid = tmp.`groupid` AND entry_date > tmp.lastseen AND (uid=personid)
								),0) AS unreadmsg  
								FROM (SELECT DISTINCT pm.id as personid,pm.personname,IFNULL(CONCAT(pm.phonecode,' ',pm.businessphoneno),'') AS contactno,CASE WHEN(profileimg!='') THEN CONCAT(:imgpath,profileimg) ELSE :defaultimageurl END as image,IFNULL(DATE_FORMAT(MAX(cm.entry_date),'%d/%m/%Y %h:%i %p'),'') AS lastchatdate,
										IFNULL((SELECT MAX(entry_date) FROM `tblchathistory` WHERE `groupid`= cg.`id` AND uid=:uid),:currdatetime) AS lastseen,IFNULL(cg.id,'') AS groupid,
										IFNULL((SELECT message FROM tblchatmessage WHERE ((uid=pm.id AND sendpersonid=:uid) OR (uid=:uid AND sendpersonid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS lastchatmsg,
										IFNULL((SELECT filetype FROM tblchatmessage WHERE ((uid=pm.id AND sendpersonid=:uid) OR (uid=:uid AND sendpersonid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS msgfiletype,
										IFNULL((SELECT isdelete FROM tblchatmessage WHERE ((uid=pm.id AND sendpersonid=:uid) OR (uid=:uid AND sendpersonid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS isdelete,
										IFNULL((SELECT DATE_FORMAT(timestamp,'%d/%m/%Y %h:%i %p') FROM tblchatmessage WHERE ((uid=pm.id AND sendpersonid=:uid) OR (uid=:uid AND sendpersonid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS lastmsgtime
										FROM tblpersonmaster pm
										INNER JOIN tblchatgroup cg ON pm.id=cg.uid AND cg.personid=:uid
										INNER JOIN tblchatmessage cm ON cm.`groupid`=cg.id AND cm.uid=pm.id AND cm.sendpersonid=:uid
										WHERE  pm.isactive=1  AND pm.id!=:uid  GROUP BY pm.id ) AS tmp ";
							$parms = array(
								':uid'=>$uid,
								':imgpath'=>$imgpath,
								':defaultimageurl'=>$config->getDefaultProfileImageurl(),
								':currdatetime'=>$currdatetime,
								
							);
						if($filter !='')
						{
							$qry.=" WHERE tmp.personname LIKE :personname ";
							$parms[':personname']='%'.$filter.'%';
						}
						$qryextra="	ORDER BY tmp.lastchatdate DESC LIMIT $start, $per_page";
					}else{
						$qry="SELECT tmp.*,DATE_FORMAT(tmp.lastseen,'%d/%m/%Y %h:%i %p') as lseen,IFNULL((
							SELECT COUNT(DISTINCT id) AS unreadmsg FROM `tblchatmessage` 
							WHERE groupid = tmp.`groupid` AND entry_date > tmp.lastseen AND (uid=personid)
						),0) AS unreadmsg  
						FROM (SELECT DISTINCT pm.id as personid,pm.personname,IFNULL(CONCAT(pm.phonecode,' ',pm.businessphoneno),'') AS contactno,CASE WHEN(profileimg!='') THEN CONCAT(:imgpath,profileimg) ELSE :defaultimageurl END as image,IFNULL(DATE_FORMAT(MAX(cm.entry_date),'%d/%m/%Y %h:%i %p'),'') AS lastchatdate,
								IFNULL((SELECT MAX(entry_date) FROM `tblchathistory` WHERE `groupid`= cg.`id` AND uid=:uid),:currdatetime) AS lastseen,IFNULL(cg.id,'') AS groupid,
								IFNULL((SELECT message FROM tblchatmessage WHERE ((sendpersonid=pm.id AND uid=:uid) OR (sendpersonid=:uid AND uid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS lastchatmsg,
								IFNULL((SELECT filetype FROM tblchatmessage WHERE ((sendpersonid=pm.id AND uid=:uid) OR (sendpersonid=:uid AND uid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS msgfiletype,
								IFNULL((SELECT isdelete FROM tblchatmessage WHERE ((sendpersonid=pm.id AND uid=:uid) OR (sendpersonid=:uid AND uid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS isdelete,
								IFNULL((SELECT DATE_FORMAT(timestamp,'%d/%m/%Y %h:%i %p') FROM tblchatmessage WHERE ((uid=pm.id AND sendpersonid=:uid) OR (uid=:uid AND sendpersonid=pm.id)) AND groupid=cg.id ORDER by timestamp DESC limit 1),'') AS lastmsgtime
								FROM tblpersonmaster pm
								INNER JOIN tblchatgroup cg ON pm.id=cg.personid AND cg.uid=:uid
								INNER JOIN tblchatmessage cm ON cm.`groupid`=cg.id AND cm.uid=:uid AND cm.sendpersonid=pm.id
								WHERE pm.isactive=1 AND pm.id!=:uid GROUP BY pm.id) AS tmp";
						$parms = array(
							':uid'=>$uid,
							':imgpath'=>$imgpath,
							':defaultimageurl'=>$config->getDefaultProfileImageurl(),
							':currdatetime'=>$currdatetime,
							
						);
						if($filter !='')
						{
							$qry.=" WHERE tmp.personname LIKE :personname ";
							$parms[':personname']='%'.$filter.'%';
						}
						$qryextra=" ORDER BY tmp.lastchatdate DESC  LIMIT $start, $per_page";
					}
					$query_main=$qry.$qryextra;
					
					// print_r($parms);
					// echo $query_main;
					// print_r($parms);
					$chatperson=$DB->getmenual($query_main,$parms,'chatperson');
					$num_pag_data=sizeof($chatperson);
					if(sizeof($chatperson)>0)
					{
						$response['result'] = $chatperson;
						$status=1;
						$message=$errmsg['success'];
					}
					else
					{
						$status=0;
						$message=$errmsg['nodatafound'];
					}
					$response['nextpage']=$nextpage;
					if($num_pag_data==$per_page)
					{
						$showdata=1; 
						$showentries=($nextpage*$per_page);
					}else{
						$showdata=0; 
						$showentries=(($nextpage-1)*($per_page))+ $num_pag_data;
					}
					$response['loadmore']=$showdata;
					$response['datasize']=$num_pag_data;
					$response['showentries']=$showentries;
				}
				else if($action == 'listbuyerperson')
				{
					$chatperson=new chatperson();
					
					$qry="SELECT tmp.*,IFNULL((
								SELECT COUNT(DISTINCT id) AS unreadmsg FROM `tblchatmessage` 
								WHERE groupid = tmp.`groupid` AND entry_date > tmp.lastseen AND (sendpersonid=:uid)
							),0) AS unreadmsg  
							FROM (SELECT DISTINCT pm.id as personid,pm.personname,IFNULL(CONCAT(pm.phonecode,' ',pm.businessphoneno),'') AS contactno,CASE WHEN(profileimg!='') THEN CONCAT(:imgpath,profileimg) ELSE :defaultimageurl END as image,IFNULL(MAX(cm.entry_date),'') AS lastchatdate,
									IFNULL((SELECT MAX(entry_date) FROM `tblchathistory` WHERE `groupid`= cg.`id` AND uid=:uid),:currdatetime) AS lastseen,IFNULL(cg.id,'') AS groupid,
									IFNULL((SELECT message FROM tblchatmessage WHERE uid=:uid OR sendpersonid=pm.id ORDER by timestamp DESC limit 1),'') AS lastchatmsg,
									IFNULL((SELECT filetype FROM tblchatmessage WHERE uid=:uid OR sendpersonid=pm.id ORDER by timestamp DESC limit 1),'') AS msgfiletype,
									IFNULL((SELECT DATE_FORMAT(timestamp,'%h:%m %p') FROM tblchatmessage WHERE uid=:uid OR sendpersonid=pm.id ORDER by timestamp DESC limit 1),'') AS lastmsgtime
									FROM tblpersonmaster pm
									INNER JOIN tblchatgroup cg ON pm.id=cg.uid 
									INNER JOIN tblchatmessage cm ON cm.`groupid`=cg.id
									WHERE  pm.isactive=1  AND pm.id!=:uid  GROUP BY pm.id ) AS tmp
							ORDER BY tmp.lastchatdate DESC ";
					$parms = array(
						':uid'=>$uid,
						':imgpath'=>$imgpath,
						':defaultimageurl'=>$config->getDefaultProfileImageurl(),
						':currdatetime'=>$currdatetime
					);
					// print_r($parms);
					$chatperson=$DB->getmenual($qry,$parms,'chatperson');

					if(sizeof($chatperson)>0)
					{
						$response['result'] = $chatperson;
						$status=1;
						$message=$errmsg['success'];
					}
					else
					{
						$status=0;
						$message=$errmsg['nodatafound'];
					}
				}
				else if($action == 'listsellerperson')
				{
					$chatperson=new chatperson();
					$qry="SELECT tmp.*,IFNULL((
						SELECT COUNT(DISTINCT id) AS unreadmsg FROM `tblchatmessage` 
						WHERE groupid = tmp.`groupid` AND entry_date > tmp.lastseen AND (sendpersonid=:uid)
					),0) AS unreadmsg  
					FROM (SELECT DISTINCT pm.id as personid,pm.personname,IFNULL(CONCAT(pm.phonecode,' ',pm.businessphoneno),'') AS contactno,CASE WHEN(profileimg!='') THEN CONCAT(:imgpath,profileimg) ELSE :defaultimageurl END as image,IFNULL(MAX(cm.entry_date),'') AS lastchatdate,
							IFNULL((SELECT MAX(entry_date) FROM `tblchathistory` WHERE `groupid`= cg.`id` AND uid=:uid),:currdatetime) AS lastseen,IFNULL(cg.id,'') AS groupid,
							IFNULL((SELECT message FROM tblchatmessage WHERE sendpersonid=:uid OR uid=pm.id ORDER by timestamp DESC limit 1),'') AS lastchatmsg,
							IFNULL((SELECT filetype FROM tblchatmessage WHERE sendpersonid=:uid OR uid=pm.id ORDER by timestamp DESC limit 1),'') AS msgfiletype,
							IFNULL((SELECT DATE_FORMAT(timestamp,'%h:%m %p') FROM tblchatmessage WHERE uid=:uid OR sendpersonid=pm.id ORDER by timestamp DESC limit 1),'') AS lastmsgtime
							FROM tblpersonmaster pm
							INNER JOIN tblchatgroup cg ON pm.id=cg.personid 
							INNER JOIN tblchatmessage cm ON cm.`groupid`=cg.id
							WHERE pm.isactive=1 AND pm.id!=:uid GROUP BY pm.id) AS tmp
					ORDER BY tmp.lastchatdate DESC ";
					$parms = array(
						':uid'=>$uid,
						':imgpath'=>$imgpath,
						':defaultimageurl'=>$config->getDefaultProfileImageurl(),
						':currdatetime'=>$currdatetime
					);
					// print_r($parms);
					$chatperson=$DB->getmenual($qry,$parms,'chatperson');

					if(sizeof($chatperson)>0)
					{
						$response['result'] = $chatperson;
						$status=1;
						$message=$errmsg['success'];
					}
					else
					{
						$status=0;
						$message=$errmsg['nodatafound'];
					}
				}
				else if($action=='listchatmessage') 
				{
					$type=trim($IISMethods->sanitize($_POST['type']));  //1=Buyer,2=Seller
					
					
					$groupid = trim($IISMethods->sanitize($_POST['groupid']));
					$personid = trim($IISMethods->sanitize($_POST['personid']));
					// $page = trim($IISMethods->sanitize($_POST['page']));
					// $per_page = 20;
					// $nper_page = 20;
					
					// For Replay Message List
					$rplymsgid = trim($_POST['rplymsgid']);
					$rmsglist = trim($_POST['rmsglist']);
					
					$platform=trim($_POST['platform']);
					$currdatetime=date('Y-m-d H:i:s');
					
					$nextpage=trim($IISMethods->sanitize($_POST['nextpage']));
					$page=trim($IISMethods->sanitize($_POST['page']));
					$filter=trim($IISMethods->sanitize($_POST['filter'],'OUT'));
					$page -= 1;
					$per_page = trim($IISMethods->sanitize($_POST['per_page']));
					$start = (int)$page * (int)$per_page;
					
					
					
					if($groupid!='')
					{
						$qrybt="SELECT * FROM `tbllastseen` WHERE uid=:uid AND groupid=:groupid";
						$btparams=array(
							':uid'=>$uid,
							':groupid'=>$groupid
						);
						$resbt=$DB->getmenual($qrybt,$btparams);
						$numbt=sizeof($resbt);
						$row=$resbt[0];
						if($numbt > 0)
						{
							$extraparams=array(
								'uid'=>$uid,
								'groupid'=>$groupid
							);
							$upddata = array(
								'entry_date'=>$datetime
							);
							$DB->executedata('u','tbllastseen',$upddata,$extraparams);
						}
						else
						{
							$lsid=$IISMethods->generateuuid();
							$insdata = array(
								'id'=>$lsid,
								'uid'=>$uid,
								'groupid'=>$groupid,
								'entry_uid'=>$uid,
								'entry_date'=>$datetime,
								'timestamp'=>$datetime,
							);
							$DB->executedata('i','tbllastseen',$insdata,'');
						}
						
						$qrychk="SELECT * FROM `tblchathistory` WHERE uid=:uid AND groupid=:groupid AND entry_date =:edate";
						$chkparams=array(
							':uid'=>$uid,
							':groupid'=>$groupid,
							':edate'=>date('Y-m-d H:i:s')
						);
						$reschk = $DB->getmenual($qrychk,$chkparams);
						$numchk = sizeof($reschk);
						
						if($numchk > 0)
						{
							
						}
						else
						{
							$chid=$IISMethods->generateuuid();
							$insmemdata= array(
								'id'=>$chid,
								'uid'=>$uid,
								'groupid'=>$groupid,
								'entry_uid'=>$uid,
								'entry_date'=>$datetime,
								'timestamp'=>$datetime,
							);
							$DB->executedata('i','tblchathistory',$insmemdata,'');
						}
						
						
							
							
							//$qrychatmsg="SELECT cm.* FROM tblchatmessage cm where cm.groupid='$groupid'"; 
							$qrychatmsg = "SELECT cm.id,cm.uniqname,cm.groupid,cm.message,cm.uid,cm.type,cm.fmsgid,cm.rplymsgid,cm.filetype,cm.issupport,cm.isdelete,cm.sendpersonid,cm.entry_uid,cm.entry_date,cm.timestamp,cm.ismainmsg,cm.diamondid,cm.diamondname,cm.buyrequestid,cm.buyrequestname,cm.chattype,cm.persontype,cm.responsetype, DATE_FORMAT(cm.`entry_date`,'%d/%m/%Y') as entrydate,DATE_FORMAT(cm.`entry_date`,'%h:%i %p') as entrytime,pm.`personname`,
								CASE WHEN (IFNULL(pm.profileimg,'')<>'') THEN IFNULL(CONCAT(:imgpath,pm.profileimg),'') ELSE :defaultimageurl END AS profilepic,
								CASE WHEN (cm.`uid` = :uid) THEN 1 ELSE 0 END AS mymessage, 
								rcm.message AS rplymessage, rcm.filetype AS rtype , IFNULL(rpm.personname,'') AS rplyperson,rcm.uid AS rplypersonid, DATE_FORMAT(rcm.`entry_date`,'%d/%m/%Y %h:%i %p') AS rplydate, rcm.isdelete AS rplydelete,cm.ismainmsg,cm.diamondname,
								case when(cm.responsetype=1) THEN CONCAT('Diamond # ',cm.diamondname) WHEN(cm.responsetype=2) THEN CONCAT('Buy Request # ',cm.buyrequestname) ELSE CONCAT('Jewellery # ',cm.jewelleryname) END AS name
								FROM `tblchatmessage` cm 
								INNER JOIN `tblpersonmaster` pm ON pm.id = cm.uid 
								LEFT JOIN `tblchatmessage` rcm ON rcm.id = cm.rplymsgid
								LEFT JOIN `tblpersonmaster` rpm ON rpm.id = rcm.uid
								WHERE cm.groupid =:groupid AND ((cm.uid=:uid AND cm.sendpersonid=:personid) OR (cm.sendpersonid=:uid AND cm.uid=:personid))"; //AND ((cm.uid=:uid AND cm.sendpersonid=:personid) OR (cm.sendpersonid=:uid AND cm.uid=:personid))
							$chatparams=array(
								':groupid'=>$groupid,
								':uid'=>$uid,
								':imgpath'=>$imgpath,
								':defaultimageurl'=>$config->getDefaultProfileImageurl(),
								':personid'=>$personid
							);

							if($filter!='' && $filter!='undefined')
							{
								$qrychatmsg.= " AND (cm.message LIKE :filter OR rcm.message LIKE :filter)";
								$chatparams[':filter']='%'.$filter.'%';
							}
								//$qrychatmsg.= "  AND cm.groupid = $groupid ";
							/* if($issupport==1)
							{
								$qrychatmsg.= "  ";
							}
							else
							{
								$qrychatmsg.= "  AND cm.groupid = $groupid ";
							} */
							$qrychatmsg.= " ORDER BY DATE_FORMAT(cm.entry_date,'%Y-%m-%d %H:%i:%s') DESC LIMIT $start, $per_page";
							// echo $qrychatmsg;
							// print_r($chatparams);
							$reschatmsg=$DB->getmenual($qrychatmsg,$chatparams);
							
							$numchatmsg=sizeof($reschatmsg);
							if($numchatmsg > 0)
							{	
								$x=0;
								foreach($reschatmsg AS $rowchatmsg)
								{
									$response['chatmsg'][$x]['id']=(string)$rowchatmsg['id'];
									$response['chatmsg'][$x]['ismainmsg']=(string)$rowchatmsg['ismainmsg'];
									$response['chatmsg'][$x]['diamondname']=(string)$rowchatmsg['name'];
									$response['chatmsg'][$x]['mymessage']=(string)$rowchatmsg['mymessage'];
									$response['chatmsg'][$x]['profilepic']=(string)$rowchatmsg['profilepic'];
									$response['chatmsg'][$x]['rplymsgid']=(string)$rowchatmsg['rplymsgid'];
									$response['chatmsg'][$x]['rplymessage']=(string)$rowchatmsg['rplymessage'];
									$response['chatmsg'][$x]['rplyperson']=(string)$rowchatmsg['rplyperson'];
									$response['chatmsg'][$x]['rplypersonid']=(string)$rowchatmsg['rplypersonid'];
									$response['chatmsg'][$x]['rplyfiletype']=(int)$rowchatmsg['rtype'];
									$response['chatmsg'][$x]['rplydelete']=(int)$rowchatmsg['rplydelete'];
									$response['chatmsg'][$x]['rplydate']=(string)$rowchatmsg['rplydate'];
									// if($rowchatmsg['rtype']>0)
									{
										if($rowchatmsg['rtype']==5)
										{
											$attachqry="SELECT * FROM `tblchatcontactshare` WHERE chatid=:rplymsgid";
											$attachparams=array(
												':rplymsgid'=>$rowchatmsg['rplymsgid']
											);
											$resattach=$DB->getmenual($attachqry,$attachparams);
											if(sizeof($resattach)>0)
											{
												$y=0;
												foreach($resattach AS $rowattach)
												{
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['filetype']=(int)$rowchatmsg['rtype'];
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['id']=(string)$rowattach['id'];
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['name']=(string)$rowattach['name'];
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['contact']=(string)$rowattach['contact'];
													$y++;
												}
											}
										}else{
											$attachqry="SELECT * FROM `tblchatfile` WHERE chatid=:rplymsgid";
											$attachparams=array(
												':rplymsgid'=>$rowchatmsg['rplymsgid']
											);
											// print_r($attachparams);
											$resattach=$DB->getmenual($attachqry,$attachparams);
											if(sizeof($resattach)>0)
											{
												$y=0;
												foreach($resattach AS $rowattach)
												{
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['filetype']=(int)$rowchatmsg['rtype'];
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['id']=(string)$rowattach['id'];
													$response['chatmsg'][$x]['rplyattachmentdoc'][$y]['image']=(string)$imgpath.$rowattach['image'];
													$y++;
												}
											}
										}
									}

									if($rowchatmsg['filetype'] > 0)
									{
										if($rowchatmsg['filetype']== 5)
										{
											$attachqry="SELECT * FROM `tblchatcontactshare` WHERE chatid=:id";
											$attachparams=array(
												':id'=>$rowchatmsg['id']
											);
											$resattach=$DB->getmenual($attachqry,$attachparams);
											if(sizeof($resattach)>0)
											{
												$y=0;
												foreach($resattach AS $rowattach)
												{
													$response['chatmsg'][$x]['attachmentdoc'][$y]['filetype']=(int)$rowchatmsg['rtype'];
													$response['chatmsg'][$x]['attachmentdoc'][$y]['id']=(string)$rowattach['id'];
													$response['chatmsg'][$x]['attachmentdoc'][$y]['name']=(string)$rowattach['name'];
													$response['chatmsg'][$x]['attachmentdoc'][$y]['contact']=(string)$rowattach['contact'];
													$y++;
												}
											}
										}else{
											$attachqry="SELECT * FROM `tblchatfile` WHERE chatid=:id";
											$attachparams=array(
												':id'=>$rowchatmsg['id']
											);
											$resattach=$DB->getmenual($attachqry,$attachparams);
											if(sizeof($resattach)>0)
											{
												$y=0;
												foreach($resattach AS $rowattach)
												{
													$response['chatmsg'][$x]['attachmentdoc'][$y]['filetype']=(int)$rowchatmsg['rtype'];
													$response['chatmsg'][$x]['attachmentdoc'][$y]['id']=(string)$rowattach['id'];
													$response['chatmsg'][$x]['attachmentdoc'][$y]['image']=(string)$imgpath.$rowattach['image'];
													$y++;
												}
											}
										}
									}
									$response['chatmsg'][$x]['personmessage']=(string)$rowchatmsg['message'];
									$response['chatmsg'][$x]['isdelete']=(int)$rowchatmsg['isdelete'];
									$response['chatmsg'][$x]['entrydate']=(string)$rowchatmsg['entrydate'];
									$response['chatmsg'][$x]['entrytime']=(string)$rowchatmsg['entrytime'];
									$response['chatmsg'][$x]['personname']=(string)$rowchatmsg['personname'];
									$response['chatmsg'][$x]['filetype']=(int)$rowchatmsg['filetype'];
									$response['chatmsg'][$x]['groupid']=(string)$groupid;
								
									$x++;
								}
							}
							
						$status=1;
						$message=$errmsg['success'];
						
					}
					else 
					{
						$status = 0;
						$message = "No Message yet!";	
					}
					$response['nextpage']=$nextpage;
					if($numchatmsg==$per_page)
					{
						$showdata=1; 
						$showentries=($nextpage*$per_page);
					}else{
						$showdata=0; 
						$showentries=(($nextpage-1)*($per_page))+ $numchatmsg;
					}
					$response['loadmore']=$showdata;
					$response['datasize']=$numchatmsg;
					$response['showentries']=$showentries;
				}
				else if($action == 'insertchatmessage')
				{
					$type=trim($IISMethods->sanitize($_POST['type']));  //1=Buyer,2=Seller
					$groupid=trim($IISMethods->sanitize($_POST['groupid'])); 
					$description=trim($IISMethods->sanitize($_POST['message'])); 

					$mainpersonname=trim($IISMethods->sanitize($_POST['personname'])); 
					$mainprofileimg=trim($IISMethods->sanitize($_POST['profileimg'])); 
					$description=trim($IISMethods->sanitize($_POST['message'])); 
					$rplymsgid=trim($IISMethods->sanitize($_POST['rplymsgid'])); 
					$personid=trim($IISMethods->sanitize($_POST['sendpersonid'])); 
					$lastseen=trim($IISMethods->sanitize($_POST['lastseen'])); 
					
					if($type==1)
					{
						$persontype=1;
						$chattype=2;
					}else{
						$persontype=2;
						$chattype=1;
					}

					if($description || $_FILES['attachment']['name'][0] || $_FILES['videoattachment']['name'][0] || $_FILES['docattachment']['name'][0])   //Description Or File Required
					{
						
						if($_FILES['attachment']['name'][0])   //Image
						{
							if(is_array($_FILES))  //When Upload Files
							{
								$x=1;
								$img_type=0;
								$aud_type=0;
								$vid_type=0;
								$doc_type=0;
								foreach ($_FILES['attachment']['name'] as $name => $value)
								{
									$img=$_FILES['attachment']['name'][$name];
									$imageFileType = pathinfo($img,PATHINFO_EXTENSION);
									
									//echo $imageFileType;
									if(is_uploaded_file($_FILES['attachment']['tmp_name'][$name])) 
									{
										$iid = $IISMethods->generateuuid();
										$time=time();
										
										$qrychatmsg="SELECT diamondid,diamondname,diamondofferprice,uniqname,responsetype,buyrequestid,buyrequestname,jewelleryid,jewelleryname,jewelleryofferprice FROM tblchatmessage WHERE ismainmsg=1 ORDER BY timestamp DESC LIMIT 1";
										$chtmsgparams=array();
										$reschatmsg=$DB->getmenual($qrychatmsg,$chtmsgparams);
										$rowchatmsg=$reschatmsg[0];
										
										if($imageFileType=="jpg" || $imageFileType=="jpeg" || $imageFileType=="png" || $imageFileType=="gif" || $imageFileType=="tiff" || $imageFileType=="bmp" || $imageFileType=="svg")	
										{
											$filetype=1;
											
											$response['img'.$x]=$_FILES['attachment']['tmp_name'][$name];
											if($img_type == 0)
											{
												$imgchat_id =$IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$imgchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],

												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												//Send Chat Notifications
												// sendchatnotification($groupid,$imgchat_id);
												// $description='';
												
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['attachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['attachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$imgchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	

											$persondata=array(
												'chatmsgid'=>$imgchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$img_type++;
										}
										else if($imageFileType=="mp3" || $imageFileType=="amr" || $imageFileType=="wav")	
										{
											$filetype=3;
											
											if($aud_type == 0)
											{
												$audchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$audchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$audchat_id);
												
												// $description='';
											}
											
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['attachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['attachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$audchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$audchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											
											$aud_type++;
										}
										else if($imageFileType=="mp4" || $imageFileType=="mov" || $imageFileType=="wmv" || $imageFileType=="avi" || $imageFileType=="flv")	
										{
											$filetype=4;
											
											if($vid_type == 0)
											{
												$vidchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$vidchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$vidchat_id);
												
												// $description='';
											}

											$chatfile_id =$IISMethods->generateuuid();
											
											$sourcePath =$_FILES['attachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['attachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$vidchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$vidchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$vid_type++;
										}
										else
										{
											$filetype=2;
											
											if($doc_type == 0)
											{
												$docchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$docchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$docchat_id);
												
												// $description='';
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['attachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['attachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$docchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$docchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$doc_type++;
										}	
									} 
									$x++;
								}
							}
						}
						else if($_FILES['videoattachment']['name'][0])   //Video
						{
							if(is_array($_FILES))  //When Upload Files
							{
								$x=1;
								$img_type=0;
								$aud_type=0;
								$vid_type=0;
								$doc_type=0;
								foreach ($_FILES['videoattachment']['name'] as $name => $value)
								{
									$img=$_FILES['videoattachment']['name'][$name];
									$imageFileType = pathinfo($img,PATHINFO_EXTENSION);
									
									//echo $imageFileType;
									if(is_uploaded_file($_FILES['videoattachment']['tmp_name'][$name])) 
									{
										$iid = $IISMethods->generateuuid();
										$time=time();
										
										$qrychatmsg="SELECT diamondid,diamondname,diamondofferprice,uniqname,responsetype,buyrequestid,buyrequestname,jewelleryid,jewelleryname,jewelleryofferprice FROM tblchatmessage WHERE ismainmsg=1 ORDER BY timestamp DESC LIMIT 1";
										$chtmsgparams=array();
										$reschatmsg=$DB->getmenual($qrychatmsg,$chtmsgparams);
										$rowchatmsg=$reschatmsg[0];
										
										if($imageFileType=="mp4" || $imageFileType=="mov" || $imageFileType=="wmv" || $imageFileType=="avi" || $imageFileType=="flv")	
										{
											$filetype=4;
											
											if($vid_type == 0)
											{
												$vidchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$vidchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$vidchat_id);
												
												// $description='';
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['videoattachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['videoattachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$vidchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$vidchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$vid_type++;
										}
										
									} 
									$x++;
								}
							}
						}
						else if($_FILES['docattachment']['name'][0])   //Video
						{
							if(is_array($_FILES))  //When Upload Files
							{
								$x=1;
								$img_type=0;
								$aud_type=0;
								$vid_type=0;
								$doc_type=0;
								foreach ($_FILES['docattachment']['name'] as $name => $value)
								{
									$img=$_FILES['docattachment']['name'][$name];
									$imageFileType = pathinfo($img,PATHINFO_EXTENSION);
									
									//echo $imageFileType;
									if(is_uploaded_file($_FILES['docattachment']['tmp_name'][$name])) 
									{
										/* $iid = $IISMethods->generateuuid();
										$time=time();
										
										$qrychatmsg="SELECT diamondid,diamondname,uniqname FROM tblchatmessage WHERE ismainmsg=1 ORDER BY timestamp DESC LIMIT 1";
										$chtmsgparams=array();
										$reschatmsg=$DB->getmenual($qrychatmsg,$chtmsgparams);
										$rowchatmsg=$reschatmsg[0];
										
										$filetype=2;
											
										if($doc_type == 0)
										{
											$docchat_id = $IISMethods->generateuuid();
											
											//Insert Chat Message
											$inschatmsgdata= array(
												'id'=>$docchat_id,
												'uniqname'=>$rowchatmsg['uniqname'],
												'groupid'=>$groupid,
												'message'=>$description,
												'uid' => $uid,
												'type'=>1,
												'filetype'=>$filetype,
												'fmsgid'=>0,
												'rplymsgid'=>$rplymsgid,
												'sendpersonid'=>$personid,
												'issupport'=>1,
												'ismainmsg'=>0,
												'entry_uid' => $uid,
												'entry_date' => $datetime,
												'timestamp' => $datetime,
												'diamondid' => $rowchatmsg['diamondid'],
												'diamondname' => $rowchatmsg['diamondname'],
												'persontype' => $persontype,
												'chattype' => $chattype,
												'isdelete'=>0,
											);
											$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
											
											//Send Chat Notifications
											// sendchatnotification($groupid,$docchat_id);
											
											// $description='';
										}
										
										$sourcePath =$_FILES['docattachment']['tmp_name'][$name];
										$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['docattachment']['name'][$name],$sourcePath,$docchat_id);
										
										
										//Insert Chat File Data
										$chatfile_id =$IISMethods->generateuuid();
										$insmsgdata= array(
											'id'=>$chatfile_id,
											'chatid'=>$docchat_id,
											'image'=>$image_name,
											'duration'=>'',
											'filetype'=>$filetype
										);
										$DB->executedata('i','tblchatfile',$insmsgdata,'');	
										$persondata=array(
											'chatmsgid'=>$docchat_id,
											'lastchatmsg'=>$description,
											'msgfiletype'=>$filetype,
											'lastchat_date'=>$datetime
										);
										$extraparams=array(
											'id'=>$personid
										);
										$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
										$doc_type++; */

										$iid = $IISMethods->generateuuid();
										$time=time();
										
										$qrychatmsg="SELECT diamondid,diamondname,diamondofferprice,uniqname,responsetype,buyrequestid,buyrequestname,jewelleryid,jewelleryname,jewelleryofferprice FROM tblchatmessage WHERE ismainmsg=1 ORDER BY timestamp DESC LIMIT 1";
										$chtmsgparams=array();
										$reschatmsg=$DB->getmenual($qrychatmsg,$chtmsgparams);
										$rowchatmsg=$reschatmsg[0];
										
										if($imageFileType=="jpg" || $imageFileType=="jpeg" || $imageFileType=="png" || $imageFileType=="gif" || $imageFileType=="tiff" || $imageFileType=="bmp" || $imageFileType=="svg")	
										{
											$filetype=1;
											
											if($img_type == 0)
											{
												$imgchat_id =$IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$imgchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],

												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												//Send Chat Notifications
												// sendchatnotification($groupid,$imgchat_id);
												// $description='';
												
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['docattachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['docattachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$imgchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	

											$persondata=array(
												'chatmsgid'=>$imgchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$img_type++;
										}
										else if($imageFileType=="mp3" || $imageFileType=="amr" || $imageFileType=="wav")	
										{
											$filetype=3;
											
											if($aud_type == 0)
											{
												$audchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$audchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$audchat_id);
												
												// $description='';
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['docattachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['docattachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$audchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$audchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											
											$aud_type++;
										}
										else if($imageFileType=="mp4" || $imageFileType=="mov" || $imageFileType=="wmv" || $imageFileType=="avi" || $imageFileType=="flv")	
										{
											$filetype=4;
											
											if($vid_type == 0)
											{
												$vidchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$vidchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$vidchat_id);
												
												// $description='';
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['docattachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['docattachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$vidchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$vidchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$vid_type++;
										}
										else
										{
											$filetype=2;
											
											if($doc_type == 0)
											{
												$docchat_id = $IISMethods->generateuuid();
												
												//Insert Chat Message
												$inschatmsgdata= array(
													'id'=>$docchat_id,
													'uniqname'=>$rowchatmsg['uniqname'],
													'groupid'=>$groupid,
													'message'=>$description,
													'uid' => $uid,
													'type'=>1,
													'filetype'=>$filetype,
													'fmsgid'=>0,
													'rplymsgid'=>$rplymsgid,
													'sendpersonid'=>$personid,
													'issupport'=>1,
													'ismainmsg'=>0,
													'entry_uid' => $uid,
													'entry_date' => $datetime,
													'timestamp' => $datetime,
													'diamondid' => $rowchatmsg['diamondid'],
													'diamondname' => $rowchatmsg['diamondname'],
													'buyrequestid' => $rowchatmsg['buyrequestid'],
													'buyrequestname' => $rowchatmsg['buyrequestname'],
													'jewelleryid' => $rowchatmsg['jewelleryid'],
													'jewelleryname' => $rowchatmsg['jewelleryname'],
													'diamondofferprice' => $rowchatmsg['diamondofferprice'],
													'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
													'persontype' => $persontype,
													'chattype' => $chattype,
													'isdelete'=>0,
													'responsetype'=>$rowchatmsg['responsetype'],
												);
												$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
												
												//Send Chat Notifications
												// sendchatnotification($groupid,$docchat_id);
												
												// $description='';
											}
											$chatfile_id =$IISMethods->generateuuid();
											$sourcePath =$_FILES['docattachment']['tmp_name'][$name];
											$image_name = $IISMethods->uploadallfiles(0,'chatmessage',$_FILES['docattachment']['name'][$name],$sourcePath,$chatfile_id.time());
											
											
											//Insert Chat File Data
											
											$insmsgdata= array(
												'id'=>$chatfile_id,
												'chatid'=>$docchat_id,
												'image'=>$image_name,
												'duration'=>'',
												'filetype'=>$filetype
											);
											$DB->executedata('i','tblchatfile',$insmsgdata,'');	
											$persondata=array(
												'chatmsgid'=>$docchat_id,
												'lastchatmsg'=>$description,
												'msgfiletype'=>$filetype,
												'lastchat_date'=>$datetime
											);
											$extraparams=array(
												'id'=>$personid
											);
											$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
											$doc_type++;
										}	
										
									} 
									$x++;
								}
							}
						}
						else  //Only Message Required 
						{
							$qrychatmsg="SELECT diamondid,diamondname,diamondofferprice,uniqname,responsetype,buyrequestid,buyrequestname,jewelleryid,jewelleryname,jewelleryofferprice FROM tblchatmessage WHERE ismainmsg=1 ORDER BY timestamp DESC LIMIT 1";
							$chtmsgparams=array();
							$reschatmsg=$DB->getmenual($qrychatmsg,$chtmsgparams);
							$rowchatmsg=$reschatmsg[0];
							$chatid = $IISMethods->generateuuid();
							
							//Insert Chat Message
							$inschatmsgdata= array(
								'id'=>$chatid,
								'uniqname'=>$rowchatmsg['uniqname'],
								'groupid'=>$groupid,
								'message'=>$description,
								'uid' => $uid,
								'type'=>1,
								'filetype'=>0,
								'fmsgid'=>0,
								'rplymsgid'=>$rplymsgid,
								'sendpersonid'=>$personid,
								'issupport'=>1,
								'ismainmsg'=>0,
								'entry_uid' => $uid,
								'entry_date' => $datetime,
								'timestamp' => $datetime,
								'diamondid' => $rowchatmsg['diamondid'],
								'diamondname' => $rowchatmsg['diamondname'],
								'buyrequestid' => $rowchatmsg['buyrequestid'],
								'buyrequestname' => $rowchatmsg['buyrequestname'],
								'jewelleryid' => $rowchatmsg['jewelleryid'],
								'jewelleryname' => $rowchatmsg['jewelleryname'],
								'diamondofferprice' => $rowchatmsg['diamondofferprice'],
								'jewelleryofferprice' => $rowchatmsg['jewelleryofferprice'],
								'persontype' => $persontype,
								'chattype' => $chattype,
								'isdelete'=>0,
								'responsetype'=>$rowchatmsg['responsetype'],
							);
							$DB->executedata('i','tblchatmessage',$inschatmsgdata,'');
							$persondata=array(
								'chatmsgid'=>$chatid,
								'lastchatmsg'=>$description,
								'msgfiletype'=>0,
								'lastchat_date'=>$datetime
							);
							$extraparams=array(
								'id'=>$personid
							);
							$DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
							//Send Chat Notifications
							// sendchatnotification($groupid,$chatid);
						}
						

						$status = 1;		
						$message="Success";	
							
					}
					else
					{
						$status = 0;
						$message = "Message is required'";
					}

					$response['type']=$type;
					$response['groupid']=$groupid;
					$response['personname']=$mainpersonname;
					$response['profileimg']=$mainprofileimg;
					$response['personid']=$personid;
					$response['lastseen']=$lastseen;
				}
				else if($action == 'deletesinglechat')
				{
					$chatid=trim($IISMethods->sanitize($_POST['chatid'])); 

					if($chatid)
					{
						$qrychk="SELECT id FROM tblchatmessage WHERE id=:chatid AND uid=:uid";	
						$params=array(
							':chatid'=>$chatid,
							':uid'=>$uid
						);
						$reschk = $DB->getmenual($qrychk,$params);
						
						if(sizeof($reschk) > 0)
						{
							$upddata1= array(
								'isdelete'=>1,
							);
							$extraparams=array(
								'id'=>$chatid
							);
							$DB->executedata('u','tblchatmessage',$upddata1,$extraparams);
							
							$status=1;
							$message = "Message deleted successfully";
						}
						else 
						{
							$status=0;
							$message = "You have not permission to delete this message!";		
						}
					}

				}
			}
			else
			{
				$message = $errmsg['permissionrequired'];
			}
		}		
	}else{
        $status=-1;
        $message="Device Logout";
    }
}	

require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  