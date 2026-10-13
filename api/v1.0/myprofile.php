<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/myprofile.php';
$candevicelogin=$DB->getDeviceInLogin($LoginInfo->getUid(),$_SERVER['HTTP_USER_AGENT']);
if($isvalidUser['status'] == 1) 
{	
    if($candevicelogin==1)
    {
        $status=0;
        $message=$errmsg['invalidrequest'];
        $imageurl=$config->getImageurl();
        $CheckUserRights=$DB->checkpackagewiseuserright($uid);
        $response['IsPackageExpire']=$CheckUserRights['IsPackageExpire'];
        if($CheckUserRights['IsPackageExpire']==1){
            $message = $config->getPackageExpiredMessage();
            $ExpiryTitle = $config->getPackageExpiredTitle();
            $ExpiryURL = $config->getPackageExpiredURL();
            $response['ExpiryTitle']=$ExpiryTitle;
            $response['ExpiryURL']=$ExpiryURL;
        }else{ 
            if($action=='listmyprofile')
            {
                $myprofile= new myprofile();

                $qryperson="SELECT id,personname,email,companyname,address,additionaladdress,statename,cityname,pincode,emergencypersonname as refname1,emergencypersonname1 as refname2,countryname,businesstype,ifnull(businessphoneno,'') AS businessphoneno,ifnull(businesswebsite,'') AS businesswebsite,businesscompanyno,
                            case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,phonecodeid,countrycode,phonecode,ifnull(savaniid,'') as savaniid,countryid ,stateid,businesstypeid,phonecodeid,
                            case when (ifnull(profileimg,'') != '') then 1 ELSE 0 END AS isprofileimg 
                            FROM tblpersonmaster 
                            WHERE id=:id";
                $paramperson=array(':id'=>$uid,':defualtuserimageurl'=>$config->getDefualtUserImageurl(),':imageurl'=>$imageurl);
                // print_r($paramperson);
                $resperson=$DB->getmenual($qryperson,$paramperson,'myprofile');
                if(sizeof($resperson)>0) 
                {
                    $response['data']=$resperson;
                    $status=1;
                    $message=$errmsg['success'];
                }
                else
                {
                    $status=0;
                    $message=$errmsg['nodatafound'];
                }

                
            }
        /*  else if($action=='updateprofile')
            {
                $fullname=$IISMethods->sanitize($_POST['fullname']);
                $companyname=$IISMethods->sanitize($_POST['companyname']);
                $businesstypeid=$IISMethods->sanitize($_POST['businesstypeid']);

                $phonecodeid=$IISMethods->sanitize($_POST['phonecodeid']);

                $businessphone=$IISMethods->sanitize($_POST['businessphone']);
                $website=$IISMethods->sanitize($_POST['website']);
                $companyno=$IISMethods->sanitize($_POST['companyno']);


                $address=$IISMethods->sanitize($_POST['address']);
                $additionaladdress=$IISMethods->sanitize($_POST['additionaladdress']);
                $countryid=$IISMethods->sanitize($_POST['countryid']);
                $stateid=$IISMethods->sanitize($_POST['stateid']);
                $zipcode=$IISMethods->sanitize($_POST['zipcode']);
                $city=$IISMethods->sanitize($_POST['city']);

                $refname1=$IISMethods->sanitize($_POST['refname1']);
                $refname2=$IISMethods->sanitize($_POST['refname2']);

                $formtype=$IISMethods->sanitize($_POST['formtype']);

                $profilepic=$_FILES['profilepic']['tmp_name'];

                $datetime=$IISMethods->getdatetime();

                $qrychk="SELECT personname from tblpersonmaster where ifnull(isdelete,0)=0 AND ifnull(isverified,0)=1 AND id=:uid";
                $parms = array(
                    ':uid'=>$uid,
                );
                $result_ary=$DB->getmenual($qrychk,$parms);
                if(sizeof($result_ary) > 0)
                {
                    try 
                    {
                        $DB->begintransaction();

                        $qrychk="select personname,profileimg from tblpersonmaster where id=:uid";
                        $chkparms = array(
                            ':uid'=>$uid,
                        );
                        $reschk=$DB->getmenual($qrychk,$chkparms);

                        if($profilepic)
                        {
                            $sourcePath = $_FILES['profilepic']['tmp_name'];
                            $uimagePath = $IISMethods->uploadallfiles(0,'profile',$profilepic,$sourcePath,$uid);
                        }
                        else
                        {
                            $uimagePath = $reschk[0]['profileimg'];
                        }
                        

                        $qrydata="SELECT 
                            IFNULL((SELECT name FROM tblbusinesstypemaster WHERE id=:businesstypeid),'') AS businesstype,
                            IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS countryname,
                            IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS statename,
                            IFNULL((SELECT countrycode FROM tblcountrymaster WHERE id=:phonecodeid1),'') AS countrycode,
                            IFNULL((SELECT phonecode FROM tblcountrymaster WHERE id=:phonecodeid2),'') AS phonecode";
                        $paramsdata=array(':businesstypeid'=>$businesstypeid,':countryid'=>$countryid,':stateid'=>$stateid,':phonecodeid1'=>$phonecodeid,':phonecodeid2'=>$phonecodeid);
                        $resdata=$DB->getmenual($qrydata,$paramsdata);
                        $rowdata=$resdata[0];
                        
                        if($formtype==1)
                        {
                            $insqry=array(					
                                'personname'=>$fullname,	
                                'address'=>$address,
                                'additionaladdress'=>$additionaladdress,
                                'countryid'=>$countryid,
                                'countryname'=>$rowdata['countryname'],
                                'stateid'=>$stateid,
                                'statename'=>$rowdata['statename'],
                                'cityname'=>$city,
                                'pincode'=>$zipcode,
                                'platform'=>$platform,
                                'emergencypersonname'=>$refname1,
                                'emergencypersonname1'=>$refname2,
                                'profileimg'=>$uimagePath,
                                'update_uid'=>$uid,
                                'update_date'=>$datetime,
                            );

                            
                        }
                        else if($formtype==2)
                        {
                            $insqry=array(					
                                'companyname'=>$companyname,
                                'platform'=>$platform,
                                'businesstypeid'=>$businesstypeid,
                                'businesstype'=>$rowdata['businesstype'],
                                'businesswebsite'=>$website,
                                'businesscompanyno'=>$companyno,
                                'businessphoneno'=>$businessphone,
                                'update_uid'=>$uid,
                                'update_date'=>$datetime,
                                'phonecodeid'=>$phonecodeid,
                                'countrycode'=>$rowdata['countrycode'],
                                'phonecode'=>$rowdata['phonecode'],
                                'profileimg'=>$uimagePath,
                            );
                        }
                        $ary=array(
                            'id'=>$uid,
                        );
                        $DB->executedata('u','tblpersonmaster',$insqry,$ary);

                        $status = 1;
                        $message = $errmsg['profile-update'];
                        
                        $DB->committransaction();
                    }
                    catch (Exception $e) 
                    {
                        $DB->rollbacktransaction($e);
                        $status=0;
                        $message=$errmsg['dbtransactionerror'];
                    }		
                }

            } */
            else if($action=='updateprofile')
            {
                $fullname=$IISMethods->sanitize($_POST['fullname']);
                $companyname=$IISMethods->sanitize($_POST['companyname']);
                $businesstypeid=$IISMethods->sanitize($_POST['businesstypeid']);

                $phonecodeid=$IISMethods->sanitize($_POST['phonecodeid']);

                $businessphone=$IISMethods->sanitize($_POST['businessphone']);
                $website=$IISMethods->sanitize($_POST['website']);
                $companyno=$IISMethods->sanitize($_POST['companyno']);


                $address=$IISMethods->sanitize($_POST['address']);
                $additionaladdress=$IISMethods->sanitize($_POST['additionaladdress']);
                $countryid=$IISMethods->sanitize($_POST['countryid']);
                $stateid=$IISMethods->sanitize($_POST['stateid']);
                $zipcode=$IISMethods->sanitize($_POST['zipcode']);
                $city=$IISMethods->sanitize($_POST['city']);

                $refname1=$IISMethods->sanitize($_POST['refname1']);
                $refname2=$IISMethods->sanitize($_POST['refname2']);

                $formtype=$IISMethods->sanitize($_POST['formtype']);

                // $profilepic=$_FILES['profilepic']['tmp_name'];
                // $profilepic=$_POST['profilepic']['tmp_name'];

                $datetime=$IISMethods->getdatetime();

                $qrychk="SELECT personname from tblpersonmaster where ifnull(isdelete,0)=0 AND ifnull(isverified,0)=1 AND id=:uid";
                $parms = array(
                    ':uid'=>$uid,
                );
                $result_ary=$DB->getmenual($qrychk,$parms);
                if(sizeof($result_ary) > 0)
                {
                    try 
                    {
                        $DB->begintransaction();

                        $qrychk="select personname,profileimg from tblpersonmaster where id=:uid";
                        $chkparms = array(
                            ':uid'=>$uid,
                        );
                        $reschk=$DB->getmenual($qrychk,$chkparms);

                        // if($profilepic)
                        // {
                        //     $sourcePath = $_FILES['profilepic']['tmp_name'];
                        //     $uimagePath = $IISMethods->uploadallfiles(0,'profile',$profilepic,$sourcePath,$uid);
                        // }
                        // else
                        // {
                        //     $uimagePath = $reschk[0]['profileimg'];
                        // }
                        

                        $qrydata="SELECT 
                            IFNULL((SELECT name FROM tblbusinesstypemaster WHERE id=:businesstypeid),'') AS businesstype,
                            IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS countryname,
                            IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS statename,
                            IFNULL((SELECT countrycode FROM tblcountrymaster WHERE id=:phonecodeid1),'') AS countrycode,
                            IFNULL((SELECT phonecode FROM tblcountrymaster WHERE id=:phonecodeid2),'') AS phonecode";
                        $paramsdata=array(':businesstypeid'=>$businesstypeid,':countryid'=>$countryid,':stateid'=>$stateid,':phonecodeid1'=>$phonecodeid,':phonecodeid2'=>$phonecodeid);
                        $resdata=$DB->getmenual($qrydata,$paramsdata);
                        $rowdata=$resdata[0];
                        
                        if($formtype==1)
                        {
                            $insqry=array(					
                                'personname'=>$fullname,	
                                'address'=>$address,
                                'additionaladdress'=>$additionaladdress,
                                'countryid'=>$countryid,
                                'countryname'=>$rowdata['countryname'],
                                'stateid'=>$stateid,
                                'statename'=>$rowdata['statename'],
                                'cityname'=>$city,
                                'pincode'=>$zipcode,
                                'platform'=>$platform,
                                'emergencypersonname'=>$refname1,
                                'emergencypersonname1'=>$refname2,
                                // 'profileimg'=>$uimagePath,
                                'update_uid'=>$uid,
                                'update_date'=>$datetime,
                            );

                            
                        }
                        else if($formtype==2)
                        {
                            $insqry=array(					
                                'companyname'=>$companyname,
                                'platform'=>$platform,
                                'businesstypeid'=>$businesstypeid,
                                'businesstype'=>$rowdata['businesstype'],
                                'businesswebsite'=>$website,
                                'businesscompanyno'=>$companyno,
                                'businessphoneno'=>$businessphone,
                                'update_uid'=>$uid,
                                'update_date'=>$datetime,
                                'phonecodeid'=>$phonecodeid,
                                'countrycode'=>$rowdata['countrycode'],
                                'phonecode'=>$rowdata['phonecode'],
                                // 'profileimg'=>$uimagePath,
                            );
                        }
                        $ary=array(
                            'id'=>$uid,
                        );
                        $DB->executedata('u','tblpersonmaster',$insqry,$ary);

                        $status = 1;
                        $message = $errmsg['profile-update'];
                        
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
            else if($action=='profilephotoudate')
            {
                
                // echo $uid;
                // print_r($_POST); exit;
                // print_r($_FILES); exit;
                $profilepic=$_POST['profilepic'];
                // $profilepic=$_POST['profilepic']['tmp_name'];

                $datetime=$IISMethods->getdatetime();

                $qrychk="SELECT personname from tblpersonmaster where ifnull(isdelete,0)=0 AND ifnull(isverified,0)=1 AND id=:uid";
                $parms = array(
                    ':uid'=>$uid,
                );
                $result_ary=$DB->getmenual($qrychk,$parms);
                if(sizeof($result_ary) > 0)
                {
                    try 
                    {
                        $DB->begintransaction();

                        $qrychk="select personname,profileimg from tblpersonmaster where id=:uid";
                        $chkparms = array(
                            ':uid'=>$uid,
                        );
                        $reschk=$DB->getmenual($qrychk,$chkparms);

                        $filenamearr = explode('.',$profilepic);
                        $extension = end($filenamearr);
                        if($extension == 'JPG' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'png' || $extension == 'PNG')
                        {
                            $time=time();
                            // $sourcePath =$profilepic;// $_FILES['profileimg']['tmp_name'];
                            
                            $ext= $extension;
                            $targetPath = 'images/profile/profile'.$time.$uid.'.'.$ext;
                            // echo $config->getImageurl().$targetPath;
                            $stdcopy=copy($profilepic, '../../assets/'.$targetPath);
                            // $img=explode('/',$profilepic);
                            // $sourcePath=$img[sizeof($img)-1];
                            // $IISMethods->uploadallfiles(0,'profile',$sourcePath,$sourcePath,$uid);

                            if($stdcopy)
                            {
                                unlink('../../client/'.$_POST['tempuserprofileimg']);
                                unlink('../../assets/'.$reschk[0]['profileimg']);
                            }
                            
                            $insqry=array(
                                'profileimg'=>$targetPath,
                            );
                            $ary=array(
                                'id'=>$uid,
                            );
                            $DB->executedata('u','tblpersonmaster',$insqry,$ary);

                            $status = 1;
                            $message = $errmsg['profile-update'];
                        }else{
                            $status = 0;
                            $message = $errmsg['filetype'];
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
            else if($action=='deleteprofilephoto')
            {
                $datetime=$IISMethods->getdatetime();

                $qrychk="SELECT profileimg from tblpersonmaster where ifnull(isdelete,0)=0 AND ifnull(isverified,0)=1 AND id=:uid";
                $parms = array(
                    ':uid'=>$uid,
                );
                $result_ary=$DB->getmenual($qrychk,$parms);
                if(sizeof($result_ary) > 0)
                {
                    try 
                    {
                        $DB->begintransaction();


                    
                            unlink('../../assets/'.$result_ary[0]['profileimg']);
                        
                            
                            $insqry=array(
                                'profileimg'=>'',
                            );
                            $ary=array(
                                'id'=>$uid,
                            );
                            $DB->executedata('u','tblpersonmaster',$insqry,$ary);

                            $status = 1;
                            $message = $errmsg['delete'];
                        
                        
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
            else if($action=='mypackages')
            {
                $currdate=$IISMethods->getcurrdate();
                $mypackages = new mypackages();

                $query="SELECT `id`,`type`,`transactionid`,`packageid`,`uid`,`personname`,`packagetypeid`,`packagename`,`amount`,`codeid`,`code`,`disctype`,
                    `discper`,`discamt`,`totalamt`,`finalamount`,`ind_amount`,`abd_amount`,`packactivatedate`,`expirydate`,`description`,`status`,`platform`,
                    `entry_uid`,`entry_date`,`update_uid`,`update_date`,`payment_id`,`sessionarr`,
                    CASE WHEN (packagetypeid=1) THEN ABS(TIMESTAMPDIFF(YEAR,STR_TO_DATE(`packactivatedate`,'%d/%m/%Y'),STR_TO_DATE(`expirydate`,'%d/%m/%Y'))) 
                    ELSE ABS(TIMESTAMPDIFF(MONTH,STR_TO_DATE(`packactivatedate`,'%d/%m/%Y'),STR_TO_DATE(`expirydate`,'%d/%m/%Y')))  END AS memberfor,
                    descr,shortdescr,termscondition,
                    CASE WHEN (packagetypeid=1) THEN IFNULL((SELECT annualyprice FROM `tblpackagemaster` ORDER BY annualyprice DESC LIMIT 1),0) ELSE 0 END AS maxprice,annualyprice,
                    IFNULL((SELECT CONCAT('This Package will Renew From ',pa.packactivatedate,' To ',pa.expirydate,' Date.') FROM `tblpackageassign` pa WHERE uid=:uid AND `status`=1 AND isactive=0 AND STR_TO_DATE(pa.packactivatedate,'%d/%m/%Y')>STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY STR_TO_DATE(pa.packactivatedate,'%d/%m/%Y') ASC LIMIT 1),'') AS renewpackage
                FROM`tblpackageassign`
                WHERE status=1 AND isactive=1 AND uid=:uid AND STR_TO_DATE(expirydate,'%d/%m/%Y')>=STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY timestamp desc limit 1";
                $params=array(':uid'=>$uid,':currdate'=>$currdate);
                // print_r($params);
                $result_ary=$DB->getmenual($query,$params,'mypackages');

                if(sizeof($result_ary)>0) 
                {
                    for($i=0;$i<sizeof($result_ary);$i++)
                    {
                        $ins_id=$result_ary[$i]->getid();

                        $mypackagedetail= new mypackagedetail();
                        $querydetail="SELECT `id`,`packassignid`,`qty`,`activateddate`,`expirydate`,`str_expirydate`,`isstatus`,`packagetypeid`,`uid`,`packageid`,`status`,`price`,`pfid`,`attributeval`,`isnolimit`,`limitvalue`,`pfname`,`pfprintname`,`displayorder`,`haslimit`,`withinputbox`,`inputboxlabel`,`isupgrade`,`isaddon`,`actualdate`,`deactivedate`,`deactivedatetime`,`reactivepack`,`mainexpirydate`,`entry_uid`,`entry_date`,`update_uid`,`update_date`,`timestamp`
                        ,case when(isnolimit=1) THEN 'Unlimited' ELSE CONCAT('Limited','(',`limitvalue`,')') END AS limittext
                        FROM `tblpackageassigndetail`
                        WHERE packassignid=:packassignid";
                        $paramsdetail=array(':packassignid'=>$ins_id);
                        $resdetails=$DB->getmenual($querydetail,$paramsdetail,'mypackagedetail');
                        if(sizeof($resdetails)>0) 
                        {
                            $result_ary[$i]->setmypackagedetail($resdetails);
                        }
                    }
                    $response['result']=$result_ary;
                    $status=1;
                    $message=$errmsg['success'];
                }
                else
                {
                    $message=$errmsg['noactiveplan'];
                }
            

            }
            else if($action=='changepassword')
            {
                $oldpassword=$IISMethods->sanitize($_POST['oldpassword']);
                $newpassword=$IISMethods->sanitize($_POST['newpassword']);
                $cpassword=$IISMethods->sanitize($_POST['cpassword']);
                $datetime=$IISMethods->getdatetime();
                if($oldpassword && $newpassword && $cpassword)
                {
                    $qrychk="select password from tblpersonmaster where id=:uid";
                    $chkparms = array(
                        ':uid'=>$uid,
                    );
                    $reschk=$DB->getmenual($qrychk,$chkparms);
                    $rowchk=$reschk[0];
                    if($rowchk['password']==md5($oldpassword))
                    {
                        if($newpassword==$cpassword)
                        {
                            try 
                            {
                                $DB->begintransaction();

                                $insqry=array(					
                                    'password'=>md5($newpassword),
                                    'strpassword'=>$newpassword,	
                                    'update_uid'=>$uid,
                                    'update_date'=>$datetime,
                                );
                                $ary=array(
                                    'id'=>$uid,
                                );
                                $DB->executedata('u','tblpersonmaster',$insqry,$ary);

                                $status = 1;
                                $message = $errmsg['passchanged'];
                                
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
                            $message=$errmsg['invalidcpassword'];
                        }
                    }
                    else
                    {
                        $message=$errmsg['invalidoldpwd'];
                    }    
                }
                else
                {
                    $message=$errmsg['required'];
                }
                
            }
        }
    }else{
        $status=-1;
        $message="Device Logout";
    }
	
}
require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  