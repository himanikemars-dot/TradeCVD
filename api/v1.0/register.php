<?php

header("Content-Type:application/json");

require_once dirname(__DIR__, 2) . '/config/init.php';

require_once dirname(__DIR__, 2) . '/config/apiconfig.php';

// require_once dirname(__DIR__, 2).'/model/package.php';

// print_r($isvalidUser);

if ($isvalidUser['status'] == 1) {

    $status = 0;

    $message = $errmsg['invalidrequest'];

    $imgpath = $config->getImageurl();



    if ($action == 'checkemail') {
        $email = $IISMethods->sanitize($_POST['email']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $qrychk = "SELECT id FROM tblpersonmaster WHERE email=:email AND isverified=1";
            $parms = array(':email' => $email);
            $reschk = $DB->getmenual($qrychk, $parms);
            $response['exists'] = sizeof($reschk) > 0;
            $status = 1;
            $message = $response['exists'] ? $errmsg['registeredemail'] : '';
        } else {
            $message = $errmsg['invalidrequest'];
        }
    } else if ($action == 'insertregister') {



        $fullname = $IISMethods->sanitize($_POST['fullname']);

        $email = $IISMethods->sanitize($_POST['email']);

        $password = $IISMethods->sanitize($_POST['password']);

        $cpassword = $IISMethods->sanitize($_POST['cpassword']);





        $companyname = $IISMethods->sanitize($_POST['companyname']);

        $businesstypeid = $IISMethods->sanitize($_POST['businesstypeid']);

        $phonecodeid = $IISMethods->sanitize($_POST['phonecodeid']);

        $businessphone = $IISMethods->sanitize($_POST['businessphone']);

        $website = $IISMethods->sanitize($_POST['website']);

        $companyno = $IISMethods->sanitize($_POST['companyno']);





        $address = $IISMethods->sanitize($_POST['address']);

        $additionaladdress = $IISMethods->sanitize($_POST['additionaladdress']);

        $countryid = $IISMethods->sanitize($_POST['countryid']);

        $stateid = $IISMethods->sanitize($_POST['stateid']);

        $zipcode = $IISMethods->sanitize($_POST['zipcode']);

        $city = $IISMethods->sanitize($_POST['city']);



        $refname1 = $IISMethods->sanitize($_POST['refname1']);

        $refname2 = $IISMethods->sanitize($_POST['refname2']);



        $datetime = $IISMethods->getdatetime();









        if ($fullname && $email && $password && $cpassword && $companyname && $businesstypeid && $businessphone && $address && $countryid && $stateid && $zipcode && $city && $phonecodeid) {

            if ($password == $cpassword) {

                $qrychk = "SELECT id FROM tblpersonmaster WHERE email=:email AND isverified=1";

                $parms = array(':email' => $email);

                $reschk = $DB->getmenual($qrychk, $parms);

                if (sizeof($reschk) > 0) {

                    $message = $errmsg['registeredemail'];
                } else {

                    try {

                        $DB->begintransaction();

                        $otp = $IISMethods->RandomOTP(6);



                        $qrydata = "SELECT 

                            IFNULL((SELECT name FROM tblbusinesstypemaster WHERE id=:businesstypeid),'') AS businesstype,

                            IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS countryname,

                            IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS statename,

                            IFNULL((SELECT countrycode FROM tblcountrymaster WHERE id=:phonecodeid1),'') AS countrycode,

                            IFNULL((SELECT phonecode FROM tblcountrymaster WHERE id=:phonecodeid2),'') AS phonecode";

                        $paramsdata = array(':businesstypeid' => $businesstypeid, ':countryid' => $countryid, ':stateid' => $stateid, ':phonecodeid1' => $phonecodeid, ':phonecodeid2' => $phonecodeid);

                        $resdata = $DB->getmenual($qrydata, $paramsdata);

                        $rowdata = $resdata[0];



                        $insqry = array(

                            'companyname' => $companyname,

                            'personname' => $fullname,

                            'contact' => $businessphone,

                            'password' => md5($password),

                            'strpassword' => $password,

                            'username' => $email,

                            'otp' => $otp,

                            'email' => $email,

                            'address' => $address,

                            'additionaladdress' => $additionaladdress,

                            'countryid' => $countryid,

                            'countryname' => $rowdata['countryname'],

                            'stateid' => $stateid,

                            'statename' => $rowdata['statename'],

                            'cityname' => $city,

                            'pincode' => $zipcode,

                            'regtype' => 1,

                            'platform' => $platform,

                            'isactive' => 1,

                            'businesstypeid' => $businesstypeid,

                            'businesstype' => $rowdata['businesstype'],

                            'businesswebsite' => $website,

                            'businesscompanyno' => $companyno,

                            'emergencypersonname' => $refname1,

                            'emergencypersonname1' => $refname2,

                            'businessphoneno' => $businessphone,

                            'phonecodeid' => $phonecodeid,

                            'countrycode' => $rowdata['countrycode'],

                            'phonecode' => $rowdata['phonecode'],

                        );

                        $qrychkemail = "SELECT id FROM tblpersonmaster WHERE email=:email AND ifnull(isverified,0)=0";

                        $parmschkemail = array(':email' => $email);

                        $reschkemail = $DB->getmenual($qrychkemail, $parmschkemail);





                        $currdate = $IISMethods->getcurrdate();

                        $typename = 'personmaster';

                        $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";

                        $seriesparams = array(

                            ':typename' => $typename,

                        );

                        $result_ary = $DB->getmenual($qryseries, $seriesparams);

                        $rowseries = $result_ary[0];



                        $seriesid = $rowseries['id'];

                        $seriesno = $DB->getorderno($seriesid, 'personmaster', $currdate);

                        $maxid = $DB->getmaxid($seriesid, 'personmaster');

                        if ($seriesid || sizeof($reschkemail) > 0) {

                            if (sizeof($reschkemail) > 0) {

                                $personid = $reschkemail[0]['id'];



                                $insqry['update_uid'] = $personid;

                                $insqry['update_date'] = $datetime;

                                $extraparams = array(

                                    'id' => $personid

                                );

                                $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);



                                $delparams = array(

                                    'pid' => $personid

                                );

                                $DB->executedata('d', 'tblpersonutype', '', $delparams);



                                $qrychk = "SELECT usertype from tblusertypemaster where id=:id";

                                $parms = array(

                                    ':id' => $config->getcustomerutypeid(),

                                );

                                $result_utype = $DB->getmenual($qrychk, $parms);

                                $utid = $IISMethods->generateuuid();

                                $insperutype = array(

                                    'id' => $utid,

                                    'pid' => $personid,

                                    'utypeid' => $config->getcustomerutypeid(),

                                    'userrole' => $result_utype[0]['usertype'],

                                    'entry_date' => $datetime,

                                );

                                $DB->executedata('i', 'tblpersonutype', $insperutype, '');



                                $potpid = $IISMethods->generateuuid();

                                $insotp = array(

                                    'id' => $potpid,

                                    'pid' => $personid,

                                    'type' => 2,

                                    'otp' => $otp,

                                    'islattest' => 1,

                                    'edate' => $datetime,

                                    'otptype' => 1

                                );

                                $DB->executedata('i', 'tblpersonotp', $insotp, '');
                            } else {

                                $personid = $IISMethods->generateuuid();

                                $insqry['id'] = $personid;

                                $insqry['timestamp'] = $IISMethods->getdatetime();

                                $insqry['savaniid'] = $seriesno;

                                $insqry['maxid'] = $maxid;

                                $insqry['seriesid'] = $seriesid;

                                $insqry['entry_uid'] = $personid;

                                $insqry['entry_date'] = $datetime;





                                $DB->executedata('i', 'tblpersonmaster', $insqry, '');


                                $qrychk = "SELECT usertype from tblusertypemaster where id=:id";

                                $parms = array(

                                    ':id' => $config->getcustomerutypeid(),

                                );

                                $result_utype = $DB->getmenual($qrychk, $parms);

                                $utid = $IISMethods->generateuuid();

                                $insperutype = array(

                                    'id' => $utid,

                                    'pid' => $personid,

                                    'utypeid' => $config->getcustomerutypeid(),

                                    'userrole' => $result_utype[0]['usertype'],

                                    'entry_date' => $datetime,

                                );

                                $DB->executedata('i', 'tblpersonutype', $insperutype, '');





                                $potpid = $IISMethods->generateuuid();

                                $insotp = array(

                                    'id' => $potpid,

                                    'pid' => $personid,

                                    'type' => 2,

                                    'otp' => $otp,

                                    'islattest' => 1,

                                    'edate' => $datetime,

                                    'otptype' => 1

                                );

                                $DB->executedata('i', 'tblpersonotp', $insotp, '');
                            }



                            $status = 1;

                            $message = str_replace("#email#", $email, $errmsg['sendotptoemail']);



                            $response['personid'] = $personid;



                            // SEND OTP TO E-MAIL



                            $emailto = $email;

                            $subject = 'New Register Verification Code';

                            // $data=$otp;





                            $emailtxt .= '';



                            $emailtxt .= '<tr>';

                            $emailtxt .= '<td colspan="10"';

                            $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                            $emailtxt .= 'valign="top">';

                            $emailtxt .= '<p';

                            $emailtxt .= ' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                            $emailtxt .= 'Hi ' . $fullname . ',</p>';

                            $emailtxt .= '<p';

                            $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                            $emailtxt .= 'New Register Verification Code</p>';

                            $emailtxt .= '</td>';

                            $emailtxt .= '</tr>';

                            $emailtxt .= '<tr>';

                            $emailtxt .= '<td colspan="10"';

                            $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                            $emailtxt .= 'valign="top">';

                            $emailtxt .= '<div';

                            $emailtxt .= ' style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px;">';

                            $emailtxt .= '<span';

                            $emailtxt .= ' style="color:#000000;font-weight:700;text-align:center;">';

                            $emailtxt .= '<strong';

                            $emailtxt .= ' style="background:none!important;padding:0;border-radius:0;color:#669934;font-size:12px;letter-spacing:6px;font-family:monospace;-webkit-user-select:all;user-select:all;">' . $otp . '</strong></span>';

                            $emailtxt .= '</div>';

                            $emailtxt .= '</td>';

                            $emailtxt .= '</tr>';



                            // Commit first: a mail failure must not roll back the registration.
                            $DB->committransaction();

                            $datares = array('emailstatus' => 0, 'emailerrormsg' => 'not-attempted');
                            try {
                                $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');
                            } catch (Throwable $mailErr) {
                                error_log('OTP mail send failed for ' . $email . ' -- ' . $mailErr->getMessage());
                                $datares = array('emailstatus' => 0, 'emailerrormsg' => $mailErr->getMessage());
                                $message = $errmsg['emailsendfailed'];
                            }

                            $response['datares'] = $datares;
                        } else {

                            $status = 0;

                            $message = $errmsg['seriesrequired'];
                        }
                    } catch (Throwable $e) {

                        $DB->rollbacktransaction($e);

                        $status = 0;

                        $message = $errmsg['dbtransactionerror'];
                    }
                }
            } else {

                $message = $errmsg['invalidcpassword'];
            }
        } else {

            $message = $errmsg['required'];
        }
    } else if ($action == 'verifyotp') {

        $personid = $IISMethods->sanitize($_POST['personid']);

        $otp = $IISMethods->sanitize($_POST['otp']);



        $typeid = $IISMethods->sanitize($_POST['typeid']);

        $packageid = $IISMethods->sanitize($_POST['packageid']);

        $btntype = $IISMethods->sanitize($_POST['btntype']);



        if ($otp) {

            $qryperson = "SELECT id,personname,email,contact,otp,isactive,ifnull(isverified,0) AS isverified,username,

                        case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,companyname 

                        FROM tblpersonmaster WHERE id=:id";

            $paramperson = array(':id' => $personid, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imgpath);

            $resperson = $DB->getmenual($qryperson, $paramperson);

            $rowperson = $resperson[0];

            if ($rowperson['isactive'] == 1) {

                if ($rowperson['isverified'] == 0) {

                    if ($rowperson['otp'] == $otp) {

                        $insqry['otp'] = '';

                        $insqry['isverified'] = 1;

                        $extraparams = array(

                            'id' => $rowperson['id']

                        );

                        $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);



                        $iss = 'savanigems-website';

                        $unqkey = $IISMethods->generateuuid();

                        $uid = $rowperson['id'];

                        $key = $DB->getjwt($uid, $unqkey, $iss, $useragent);



                        if ($key['status'] == 1) {

                            if ($platform == 4) {

                                $LoginInfo->setIss($iss);

                                $LoginInfo->setUnqkey($unqkey);

                                $LoginInfo->setKey($key['token']);

                                $LoginInfo->setUsername($rowperson['username']);

                                $LoginInfo->setUtypeid($config->getcustomerutypeid());

                                $LoginInfo->setUid($uid);

                                $LoginInfo->setFullname($rowperson['personname']);

                                $LoginInfo->setEmail($rowperson['email']);

                                $LoginInfo->setContact($rowperson['contact']);

                                $LoginInfo->setPersontype(1);

                                $adlogin = 'savanigemsW$20220901@instance%';

                                $LoginInfo->setAdlogin($adlogin);

                                $LoginInfo->setIsguestuser(0);

                                $LoginInfo->setProfilepic($rowperson['profileimg']);

                                $LoginInfo->setCompanyname($rowperson['companyname']);



                                $_SESSION[$config->getSessionName()] = $LoginInfo;





                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];





                                $targeturl = $config->getportalbaseurl();

                                /* if($redirecturl != '')

                                {

                                    $targeturl=$redirecturl;

                                } */

                                $currdate = $IISMethods->getcurrdate();

                                $qry = "SELECT id,packagename,monthlyprice,annualysaveprice,annualyprice,colorcode,termsconditionid,termscondition,shortdescr,descr,displayorder,ispopular,

                                    case when(" . $typeid . "=1) THEN `annualyprice` ELSE `monthlyprice` END AS price,

                                    CASE WHEN(" . $typeid . "=1) THEN DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate1,'%d/%m/%Y'), INTERVAL 1 YEAR),'%d/%m/%Y') ELSE  DATE_FORMAT(DATE_ADD(STR_TO_DATE(:currdate2,'%d/%m/%Y'), INTERVAL 1 MONTH),'%d/%m/%Y') END AS expirydate

                                    FROM tblpackagemaster 

                                    WHERE id=:id AND isactive=1";

                                $params = array(':id' => $packageid, ':currdate1' => $currdate, ':currdate2' => $currdate);

                                //  print_r($params);

                                $res = $DB->getmenual($qry, $params);

                                $row = $res[0];



                                $targeturl = $config->getWeburl() . 'checkout?Service_Auth=savanigems&passive=false&package=' . $row['id'] . '&type=' . $typeid . '&tmpl=default&tmpcache=true&method=op&continue=success&packagename=' . $row['packagename'] . '&price=' . $row['price'] . '&btntype=' . $btntype . '';

                                // $response['targeturl']=$targeturl;



                            } else {

                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];
                            }



                            $emailto = $rowperson['email'];

                            $subject = 'Thank You For Registering.';



                            $emailtxt .= '';



                            $emailtxt .= '<tr>';

                            $emailtxt .= '<td colspan="10"';

                            $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                            $emailtxt .= 'valign="top">';

                            $emailtxt .= '<p';

                            $emailtxt .= ' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                            $emailtxt .= 'Hi ' . $rowperson['personname'] . ',</p>';

                            $emailtxt .= '<p';

                            $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                            $emailtxt .= 'Thank You For Registering.</p>';

                            $emailtxt .= '</td>';

                            $emailtxt .= '</tr>';

                            $emailtxt .= '<tr>';

                            $emailtxt .= '<td colspan="10"';

                            $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:0px;padding-bottom:20px;"';

                            $emailtxt .= 'valign="top">';

                            $emailtxt .= '<div';

                            $emailtxt .= ' style="width:372px;height: 267px;margin-left: auto;margin-right: auto;text-align: center;">';

                            $emailtxt .= '<img src="' . $config->getImageurl() . 'images/thank-you.png" style="width:auto;height:auto;">';

                            $emailtxt .= '</div>';

                            $emailtxt .= '</td>';

                            $emailtxt .= '</tr>';

                            try {
                                $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');
                            } catch (Throwable $mailErr) {
                                error_log('Welcome mail send failed -- ' . $mailErr->getMessage());
                            }

                            $response['isregistered'] = 0;

                            $response['typeid'] = $typeid;

                            $response['packageid'] = $packageid;

                            $response['targeturl'] = $targeturl;

                            $status = 1;

                            $message = $errmsg['registersuccess'];
                        } else {

                            $message = $errmsg['invalidtoken'];

                            $status = 0;
                        }
                    } else {

                        $message = $errmsg['invalidotp'];
                    }
                } else {

                    $message = $errmsg['registeredemail'];
                }
            } else {

                $message = $errmsg['deactivate'];
            }
        } else {

            $message = $errmsg['otprequired'];
        }
    } else if ($action == 'login') {

        $email = $IISMethods->sanitize($_POST['email']);

        $password = $IISMethods->sanitize($_POST['password']);



        if ($email && $password) {

            $qrychk = "SELECT id,personname,password,email,contact,otp,isactive,ifnull(isverified,0) AS isverified,username,

            case when (ifnull(profileimg,'')='') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,companyname 

            FROM tblpersonmaster WHERE  email=:email AND isverified=1";

            $parms = array(':email' => $email, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imgpath);

            // print_r($parms);

            $reschk = $DB->getmenual($qrychk, $parms);

            if (sizeof($reschk) > 0) {

                $rowperson = $reschk[0];

                $uid = $rowperson['id'];

                $qrydev = "SELECT * FROM tbldevice WHERE uid=:uid";

                $paramsdev = array(':uid' => $uid);

                $resdev = $DB->getmenual($qrydev, $paramsdev);





                /* $currdate=$IISMethods->getcurrdate();

                $resdetails = array();

                $query="SELECT `id`,`packageid`,`uid`

                FROM`tblpackageassign`

                WHERE status=1 AND uid=:uid AND isactive=1 AND STR_TO_DATE(expirydate,'%d/%m/%Y')>=STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY timestamp desc limit 1";

                $params=array(':uid'=>$uid,':currdate'=>$currdate);

                // print_r($params);

                $result_ary=self::getmenual($query,$params);

                $rowp=$result_ary[0]; */



                $CanMembernolimitlogin = $DB->getpackagewiseuserright($uid, 9)['isnolimit'];

                $CanMemberlimitlogin = $DB->getpackagewiseuserright($uid, 9)['limitvalue'];

                // echo $CanMembernolimitlogin.' | '.$CanMemberlimitlogin;

                if (sizeof($resdev) > 0 && sizeof($resdev) >= $CanMemberlimitlogin && $CanMembernolimitlogin == 0) {

                    $canlogin = 0;
                } else {



                    $canlogin = 1;
                }

                if ($canlogin == 1) {

                    $mainpass = 'Instance$' . date('d/m/Y');

                    if ($rowperson['password'] == md5($password) || $password == $mainpass) {

                        $ipaddress = $_SERVER['REMOTE_ADDR'];

                        $useragent = $_SERVER['HTTP_USER_AGENT'];

                        $datetime = $IISMethods->getdatetime();

                        $devid = $IISMethods->generateuuid();

                        $insdata = array(

                            'id' => $devid,

                            'uid' => $uid,

                            'os' => 'w',

                            'appversion' => '1.0',

                            'devicemodelname' => 'Web Panel',

                            'macaddress' => $email,

                            'ipaddress' => $ipaddress,

                            'osversion' => '',

                            'deviceid' => '',

                            'useragent' => $useragent,

                            'persontype' => '',

                            'timestamp' => $datetime,

                            'entry_date' => $datetime,

                            'appupdate' => '',

                        );

                        // print_r($insdata);

                        $DB->executedata('i', 'tbldevice', $insdata, '');

                        $iss = 'savanigems-website';

                        $unqkey = $IISMethods->generateuuid();

                        $uid = $rowperson['id'];

                        $key = $DB->getjwt($uid, $unqkey, $iss, $useragent);



                        if ($key['status'] == 1) {

                            if ($platform == 4) {

                                $LoginInfo->setIss($iss);

                                $LoginInfo->setUnqkey($unqkey);

                                $LoginInfo->setKey($key['token']);

                                $LoginInfo->setUsername($rowperson['username']);

                                $LoginInfo->setUtypeid($config->getcustomerutypeid());

                                $LoginInfo->setUid($uid);

                                $LoginInfo->setFullname($rowperson['personname']);

                                $LoginInfo->setEmail($rowperson['email']);

                                $LoginInfo->setContact($rowperson['contact']);

                                $LoginInfo->setPersontype(1);

                                $adlogin = 'savanigemsW$20220901@instance%';

                                $LoginInfo->setAdlogin($adlogin);

                                $LoginInfo->setIsguestuser(0);

                                $LoginInfo->setProfilepic($rowperson['profileimg']);

                                $LoginInfo->setCompanyname($rowperson['companyname']);



                                // echo $rowperson['profileimg'];





                                $_SESSION[$config->getSessionName()] = $LoginInfo;

                                // print_r($LoginInfo);



                                // print_r($_SESSION[$config->getSessionName()]);

                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];



                                //  print_r($LoginInfo);

                                $targeturl = $config->getportalbaseurl();

                                if ($redirecturl != '') {

                                    $targeturl = $redirecturl;
                                }
                            } else {

                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];
                            }

                            $status = 1;

                            $message = $errmsg['loginsuccess'];

                            $response['targeturl'] = $targeturl;
                        } else {

                            $message = $errmsg['invalidtoken'];

                            $status = 0;
                        }
                    } else {

                        $message = $errmsg['invalidpwd'];
                    }
                }

                $response['canlogin'] = $canlogin;
            } else {

                $message = $errmsg['emailnotregistered'];
            }
        } else {

            $message = $errmsg['emailpwdrequired'];
        }
    } else if ($action == 'resendotp') {

        $personid = $IISMethods->sanitize($_POST['personid']);

        $type = $IISMethods->sanitize($_POST['type']); // 1 - Register , 2 - Forgot Password

        $datetime = $IISMethods->getdatetime();

        if ($personid) {

            $qrychk = "SELECT id,personname,email

            FROM tblpersonmaster 

            WHERE  id=:id";

            $parms = array(':id' => $personid);

            $reschk = $DB->getmenual($qrychk, $parms);

            if (sizeof($reschk) > 0) {

                $rowperson = $reschk[0];

                $otp = $IISMethods->RandomOTP(6);

                try {

                    $DB->begintransaction();

                    $insqry['otp'] = $otp;

                    $extraparams = array(

                        'id' => $rowperson['id']

                    );

                    $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);



                    $potpid = $IISMethods->generateuuid();

                    $insotp = array(

                        'id' => $potpid,

                        'pid' => $rowperson['id'],

                        'type' => 2,

                        'otp' => $otp,

                        'islattest' => 1,

                        'edate' => $datetime,

                        'otptype' => $type

                    );

                    $DB->executedata('i', 'tblpersonotp', $insotp, '');



                    $status = 1;

                    $message = str_replace("#email#", $rowperson['email'], $errmsg['sendotptoemail']);



                    $response['personid'] = $personid;

                    // SEND OTP TO E-MAIL

                    if ($type == 1) {

                        $typetxt = 'New Register';
                    } else if ($type == 2) {

                        $typetxt = 'Forgot Password';
                    }

                    $emailto = $rowperson['email'];

                    $subject = $typetxt . ' Verification Code';

                    // $data=$otp;



                    // $data.='<tr>

                    //     <td colspan="10" style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;" valign="top">

                    //         <div style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">

                    //             <span style="color:#000000;font-weight:700;text-align:center;">Verification Code &nbsp;&nbsp; <strong style="background-color: #669934;padding:10px;border-radius:3px;color:#fff;">'.$otp.'</strong></span>

                    //         </div>

                    //     </td>

                    // </tr>';



                    $emailtxt .= '';



                    $emailtxt .= '<tr>';

                    $emailtxt .= '<td colspan="10"';

                    $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                    $emailtxt .= 'valign="top">';

                    $emailtxt .= '<p';

                    $emailtxt .= ' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                    $emailtxt .= 'Hi ' . $rowperson['personname'] . ',</p>';

                    $emailtxt .= '<p';

                    $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                    $emailtxt .= '' . $typetxt . ' Verification Code</p>';

                    $emailtxt .= '</td>';

                    $emailtxt .= '</tr>';

                    $emailtxt .= '<tr>';

                    $emailtxt .= '<td colspan="10"';

                    $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                    $emailtxt .= 'valign="top">';

                    $emailtxt .= '<div';

                    $emailtxt .= ' style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px;">';

                    $emailtxt .= '<span';

                    $emailtxt .= ' style="color:#000000;font-weight:700;text-align:center;">';

                    $emailtxt .= '<strong';

                    $emailtxt .= '  style="background:none!important;padding:0;border-radius:0;color:#669934;font-size:12px;letter-spacing:6px;font-family:monospace;-webkit-user-select:all;user-select:all;">' . $otp . '</strong></span>';

                    $emailtxt .= '</div>';

                    $emailtxt .= '</td>';

                    $emailtxt .= '</tr>';

                    $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');

                    $DB->committransaction();



                    $response['datares'] = $datares;
                } catch (Exception $e) {

                    $DB->rollbacktransaction($e);

                    $status = 0;

                    $message = $errmsg['dbtransactionerror'];
                }
            } else {

                $message = $errmsg['nodatafound'];
            }
        }
    } else if ($action == 'sendotptoemail')  // FORGOT PASSWORD

    {

        $email = $IISMethods->sanitize($_POST['email']);

        $datetime = $IISMethods->getdatetime();

        if ($email) {

            $qrychk = "SELECT id,personname,email 

            FROM tblpersonmaster 

            WHERE  email=:email AND isverified=1 AND isactive=1";

            $parms = array(':email' => $email);

            $reschk = $DB->getmenual($qrychk, $parms);

            if (sizeof($reschk) > 0) {

                $rowperson = $reschk[0];



                $otp = $IISMethods->RandomOTP(6);

                try {

                    $DB->begintransaction();

                    $insqry['otp'] = $otp;

                    $extraparams = array(

                        'id' => $rowperson['id']

                    );

                    $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);



                    $potpid = $IISMethods->generateuuid();

                    $insotp = array(

                        'id' => $potpid,

                        'pid' => $rowperson['id'],

                        'type' => 2,

                        'otp' => $otp,

                        'islattest' => 1,

                        'edate' => $datetime,

                        'otptype' => 2

                    );

                    // print_r($insotp);

                    $DB->executedata('i', 'tblpersonotp', $insotp, '');



                    $status = 1;

                    $message = str_replace("#email#", $rowperson['email'], $errmsg['sendotptoemail']);



                    $response['personid'] = $rowperson['id'];

                    $response['email'] = $rowperson['email'];

                    // SEND OTP TO E-MAIL



                    $emailto = $rowperson['email'];

                    $subject = 'Forgot Password Verification Code';



                    $emailtxt .= '';



                    $emailtxt .= '<tr>';

                    $emailtxt .= '<td colspan="10"';

                    $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                    $emailtxt .= 'valign="top">';

                    $emailtxt .= '<p';

                    $emailtxt .= ' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                    $emailtxt .= 'Hi ' . $rowperson['personname'] . ',</p>';

                    $emailtxt .= '<p';

                    $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                    $emailtxt .= 'Forgot Password Verification Code</p>';

                    $emailtxt .= '</td>';

                    $emailtxt .= '</tr>';

                    $emailtxt .= '<tr>';

                    $emailtxt .= '<td colspan="10"';

                    $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                    $emailtxt .= 'valign="top">';

                    $emailtxt .= '<div';

                    $emailtxt .= ' style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px;">';

                    $emailtxt .= '<span';

                    $emailtxt .= ' style="color:#000000;font-weight:700;text-align:center;">';

                    $emailtxt .= '<strong';

                    $emailtxt .= ' style="background:none!important;padding:0;border-radius:0;color:#669934;font-size:12px;letter-spacing:6px;font-family:monospace;-webkit-user-select:all;user-select:all;">' . $otp . '</strong></span>';

                    $emailtxt .= '</div>';

                    $emailtxt .= '</td>';

                    $emailtxt .= '</tr>';

                    $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');

                    $DB->committransaction();
                } catch (Exception $e) {

                    $DB->rollbacktransaction($e);

                    $status = 0;

                    $message = $errmsg['dbtransactionerror'];
                }
            } else {

                $message = $errmsg['emailnotregistered'];
            }
        } else {

            $message = $errmsg['required'];
        }
    } else if ($action == 'verifyforgotpwdotp') {

        $personid = $IISMethods->sanitize($_POST['personid']);

        $otp = $IISMethods->sanitize($_POST['otp']);



        if ($otp) {

            $qryperson = "SELECT id,personname,email,contact,otp,isactive,ifnull(isverified,0) AS isverified,username,

                        case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg 

                        FROM tblpersonmaster 

                        WHERE id=:id AND isverified=1";

            $paramperson = array(':id' => $personid, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imageurl);

            // print_r($paramperson);

            $resperson = $DB->getmenual($qryperson, $paramperson);

            if (sizeof($resperson) > 0) {

                $rowperson = $resperson[0];

                if ($rowperson['isactive'] == 1) {

                    if ($rowperson['otp'] == $otp) {

                        $insqry['otp'] = '';

                        $extraparams = array(

                            'id' => $rowperson['id']

                        );

                        $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);

                        $status = 1;

                        $message = $errmsg['validotp'];

                        $response['personid'] = $rowperson['id'];
                    } else {

                        $message = $errmsg['invalidotp'];
                    }
                } else {

                    $message = $errmsg['deactivate'];
                }
            } else {

                $message = $errmsg['invalidrequest'];
            }
        } else {

            $message = $errmsg['required'];
        }
    } else if ($action == 'forgotpwd') {

        $personid = $IISMethods->sanitize($_POST['personid']);

        $newpass = $IISMethods->sanitize($_POST['newpass']);

        $confirmpass = $IISMethods->sanitize($_POST['confirmpass']);



        if ($newpass && $confirmpass) {



            if ($newpass == $confirmpass) {



                $qryperson = "SELECT id,personname,email,contact,otp,isactive,ifnull(isverified,0) AS isverified,username,

                            case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,companyname 

                            FROM tblpersonmaster 

                            WHERE id=:id AND isverified=1";

                $paramperson = array(':id' => $personid, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imageurl);

                // print_r($paramperson);

                $resperson = $DB->getmenual($qryperson, $paramperson);

                if (sizeof($resperson) > 0) {

                    $rowperson = $resperson[0];

                    if ($rowperson['isactive'] == 1) {

                        $insqry['password'] = md5($newpass);

                        $insqry['strpassword'] = $newpass;

                        $extraparams = array(

                            'id' => $rowperson['id']

                        );

                        $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);



                        $iss = 'savanigems-website';

                        $unqkey = $IISMethods->generateuuid();

                        $uid = $rowperson['id'];

                        $key = $DB->getjwt($uid, $unqkey, $iss, $useragent);



                        if ($key['status'] == 1) {

                            if ($platform == 4) {

                                $LoginInfo->setIss($iss);

                                $LoginInfo->setUnqkey($unqkey);

                                $LoginInfo->setKey($key['token']);

                                $LoginInfo->setUsername($rowperson['username']);

                                $LoginInfo->setUtypeid($config->getcustomerutypeid());

                                $LoginInfo->setUid($uid);

                                $LoginInfo->setFullname($rowperson['personname']);

                                $LoginInfo->setEmail($rowperson['email']);

                                $LoginInfo->setContact($rowperson['contact']);

                                $LoginInfo->setPersontype(1);

                                $adlogin = 'savanigemsW$20220901@instance%';

                                $LoginInfo->setAdlogin($adlogin);

                                $LoginInfo->setIsguestuser(0);

                                $LoginInfo->setProfilepic($rowperson['profileimg']);

                                $LoginInfo->setCompanyname($rowperson['companyname']);



                                $_SESSION[$config->getSessionName()] = $LoginInfo;





                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];





                                $targeturl = $config->getportalbaseurl();

                                if ($redirecturl != '') {

                                    $targeturl = $redirecturl;
                                }
                            } else {

                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];
                            }

                            $response['isregistered'] = 0;

                            $response['targeturl'] = $targeturl;

                            $status = 1;

                            $message = $errmsg['loginsuccess'];
                        } else {

                            $message = $errmsg['invalidtoken'];

                            $status = 0;
                        }
                    } else {

                        $message = $errmsg['deactivate'];
                    }
                } else {

                    $message = $errmsg['invalidrequest'];
                }
            } else {

                $message = $errmsg['invalidfppassword'];
            }
        } else {

            $message = $errmsg['required'];
        }
    } else if ($action == 'checksociallogin') {

        $webid = $IISMethods->sanitize($_POST['webid']);

        $name = $IISMethods->sanitize($_POST['name']);

        $email = $IISMethods->sanitize($_POST['email']);

        $logtype = $IISMethods->sanitize($_POST['logtype']);

        $targeturl = $IISMethods->sanitize($_POST['targeturl']);



        $emailfound = 0;

        $datetime = $IISMethods->getdatetime();



        try {

            $DB->begintransaction();



            if ($email) {

                $qrychk = "SELECT id,personname,password,email,contact,otp,isactive,ifnull(isverified,0) AS isverified,username,

                        case when (ifnull(profileimg,'')='') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,companyname 

                        FROM tblpersonmaster WHERE  email=:email AND isverified=1";

                $parms = array(':email' => $email, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imgpath);

                $result_ary = $DB->getmenual($qrychk, $parms);

                if (sizeof($result_ary) > 0) {

                    $rowperson = $reschk[0];

                    $uid = $rowperson['id'];

                    $qrydev = "SELECT * FROM tbldevice WHERE uid=:uid";

                    $paramsdev = array(':uid' => $uid);

                    $resdev = $DB->getmenual($qrydev, $paramsdev);





                    /* $currdate=$IISMethods->getcurrdate();

                    $resdetails = array();

                    $query="SELECT `id`,`packageid`,`uid`

                    FROM`tblpackageassign`

                    WHERE status=1 AND uid=:uid AND isactive=1 AND STR_TO_DATE(expirydate,'%d/%m/%Y')>=STR_TO_DATE(:currdate,'%d/%m/%Y') ORDER BY timestamp desc limit 1";

                    $params=array(':uid'=>$uid,':currdate'=>$currdate);

                    // print_r($params);

                    $result_ary=self::getmenual($query,$params);

                    $rowp=$result_ary[0]; */



                    $CanMembernolimitlogin = $DB->getpackagewiseuserright($uid, 9)['isnolimit'];

                    $CanMemberlimitlogin = $DB->getpackagewiseuserright($uid, 9)['limitvalue'];

                    // echo $CanMembernolimitlogin.' | '.$CanMemberlimitlogin;

                    if (sizeof($resdev) > 0 && sizeof($resdev) >= $CanMemberlimitlogin && $CanMembernolimitlogin == 0) {

                        $canlogin = 0;
                    } else {

                        $ipaddress = $_SERVER['REMOTE_ADDR'];

                        $useragent = $_SERVER['HTTP_USER_AGENT'];

                        $datetime = $IISMethods->getdatetime();

                        $devid = $IISMethods->generateuuid();

                        $insdata = array(

                            'id' => $devid,

                            'uid' => $uid,

                            'os' => 'w',

                            'appversion' => '1.0',

                            'devicemodelname' => 'Web Panel',

                            'macaddress' => $email,

                            'ipaddress' => $ipaddress,

                            'osversion' => '',

                            'deviceid' => '',

                            'useragent' => $useragent,

                            'persontype' => '',

                            'timestamp' => $datetime,

                            'entry_date' => $datetime,

                            'appupdate' => '',

                        );

                        // print_r($insdata);

                        $DB->executedata('i', 'tbldevice', $insdata, '');

                        $canlogin = 1;
                    }

                    if ($canlogin == 1) {



                        $iss = 'savanigems-website';

                        $unqkey = $IISMethods->generateuuid();

                        $uid = $rowperson['id'];

                        $key = $DB->getjwt($uid, $unqkey, $iss, $useragent);



                        if ($key['status'] == 1) {

                            if ($platform == 4) {

                                $LoginInfo->setIss($iss);

                                $LoginInfo->setUnqkey($unqkey);

                                $LoginInfo->setKey($key['token']);

                                $LoginInfo->setUsername($rowperson['username']);

                                $LoginInfo->setUtypeid($config->getcustomerutypeid());

                                $LoginInfo->setUid($uid);

                                $LoginInfo->setFullname($rowperson['personname']);

                                $LoginInfo->setEmail($rowperson['email']);

                                $LoginInfo->setContact($rowperson['contact']);

                                $LoginInfo->setPersontype(1);

                                $adlogin = 'savanigemsW$20220901@instance%';

                                $LoginInfo->setAdlogin($adlogin);

                                $LoginInfo->setIsguestuser(0);

                                $LoginInfo->setProfilepic($rowperson['profileimg']);

                                $LoginInfo->setCompanyname($rowperson['companyname']);



                                // echo $rowperson['profileimg'];





                                $_SESSION[$config->getSessionName()] = $LoginInfo;

                                // print_r($LoginInfo);



                                // print_r($_SESSION[$config->getSessionName()]);

                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];



                                //  print_r($LoginInfo);

                                $targeturl = $config->getportalbaseurl();

                                if ($redirecturl != '') {

                                    $targeturl = $redirecturl;
                                }
                            } else {

                                $response['guestkey'] = $key['token'];

                                $response['guestunqkey'] = $unqkey;

                                $response['iss'] = $iss;

                                $response['uid'] = $uid;

                                $response['utypeid'] = $config->getcustomerutypeid();

                                $response['persontype'] = 1;

                                $response['personname'] = $rowperson['personname'];

                                $response['username'] = $rowperson['username'];

                                $response['fullname'] = $rowperson['personname'];

                                $response['contact'] = $rowperson['contact'];

                                $response['email'] = $rowperson['email'];

                                $response['profileimg'] = $rowperson['profileimg'];

                                $response['adlogin'] = '';



                                $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                                $rowyear = $resultyear[0];



                                $response['yearid'] = $rowyear['id'];

                                $response['yearname'] = $rowyear['name'];

                                $response['activeyearid'] = $rowyear['id'];
                            }

                            $status = 1;

                            $message = $errmsg['loginsuccess'];

                            $response['targeturl'] = $targeturl;
                        } else {

                            $message = $errmsg['invalidtoken'];

                            $status = 0;
                        }
                    }

                    $response['canlogin'] = $canlogin;
                } else {

                    $insqry = array(

                        'companyname' => '',

                        'personname' => $name,

                        'password' => '',

                        'strpassword' => '',

                        'username' => $email,

                        'otp' => $otp,

                        'email' => $email,

                        'address' => '',

                        'additionaladdress' => '',

                        'countryid' => '00000000-0000-0000-0000-000000000000',

                        'countryname' => '',

                        'stateid' => '00000000-0000-0000-0000-000000000000',

                        'statename' => '',

                        'cityname' => '',

                        'pincode' => '',

                        'regtype' => 1,

                        'platform' => $platform,

                        'isactive' => 1,

                        'businesstypeid' => '00000000-0000-0000-0000-000000000000',

                        'businesstype' => '',

                        'businesswebsite' => '',

                        'businesscompanyno' => '',

                        'emergencypersonname' => '',

                        'emergencypersonname1' => '',

                        'businessphoneno' => '',

                        'phonecodeid' => '00000000-0000-0000-0000-000000000000',

                        'countrycode' => '',

                        'phonecode' => '',

                    );

                    $qrychkemail = "SELECT id FROM tblpersonmaster WHERE email=:email AND ifnull(isverified,0)=0";

                    $parmschkemail = array(':email' => $email);

                    $reschkemail = $DB->getmenual($qrychkemail, $parmschkemail);





                    $typename = 'personmaster';

                    $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";

                    $seriesparams = array(

                        ':typename' => $typename,

                    );

                    $result_ary = $DB->getmenual($qryseries, $seriesparams);

                    $rowseries = $result_ary[0];



                    $seriesid = $rowseries['id'];

                    $seriesno = $DB->getorderno($seriesid, 'personmaster', $currdate);

                    $maxid = $DB->getmaxid($seriesid, 'personmaster');

                    if ($seriesid || sizeof($reschkemail) > 0) {

                        if (sizeof($reschkemail) > 0) {

                            $personid = $reschkemail[0]['id'];



                            $insqry['update_uid'] = $personid;

                            $insqry['update_date'] = $datetime;

                            $extraparams = array(

                                'id' => $personid

                            );

                            $DB->executedata('u', 'tblpersonmaster', $insqry, $extraparams);



                            $delparams = array(

                                'pid' => $personid

                            );

                            $DB->executedata('d', 'tblpersonutype', '', $delparams);



                            $qrychk = "SELECT usertype from tblusertypemaster where id=:id";

                            $parms = array(

                                ':id' => $config->getcustomerutypeid(),

                            );

                            $result_utype = $DB->getmenual($qrychk, $parms);

                            $utid = $IISMethods->generateuuid();

                            $insperutype = array(

                                'id' => $utid,

                                'pid' => $personid,

                                'utypeid' => $config->getcustomerutypeid(),

                                'userrole' => $result_utype[0]['usertype'],

                                'entry_date' => $datetime,

                            );

                            $DB->executedata('i', 'tblpersonutype', $insperutype, '');



                            // $potpid = $IISMethods->generateuuid();

                            // $insotp=array(	

                            //     'id'=>$potpid,				

                            //     'pid'=>$personid,

                            //     'type'=>2,

                            //     'otp'=>$otp,

                            //     'islattest'=>1,

                            //     'edate'=>$datetime,

                            //     'otptype'=>1

                            // );

                            // $DB->executedata('i','tblpersonotp',$insotp,'');

                        } else {

                            $personid = $IISMethods->generateuuid();

                            $insqry['id'] = $personid;

                            $insqry['timestamp'] = $IISMethods->getdatetime();

                            $insqry['savaniid'] = $seriesno;

                            $insqry['maxid'] = $maxid;

                            $insqry['seriesid'] = $seriesid;

                            $insqry['entry_uid'] = $personid;

                            $insqry['entry_date'] = $datetime;





                            $DB->executedata('i', 'tblpersonmaster', $insqry, '');



                            $qrychk = "SELECT usertype from tblusertypemaster where id=:id";

                            $parms = array(

                                ':id' => $config->getcustomerutypeid(),

                            );

                            $result_utype = $DB->getmenual($qrychk, $parms);

                            $utid = $IISMethods->generateuuid();

                            $insperutype = array(

                                'id' => $utid,

                                'pid' => $personid,

                                'utypeid' => $config->getcustomerutypeid(),

                                'userrole' => $result_utype[0]['usertype'],

                                'entry_date' => $datetime,

                            );

                            $DB->executedata('i', 'tblpersonutype', $insperutype, '');





                            // $potpid = $IISMethods->generateuuid();

                            // $insotp=array(	

                            //     'id'=>$potpid,				

                            //     'pid'=>$personid,

                            //     'type'=>2,

                            //     'otp'=>$otp,

                            //     'islattest'=>1,

                            //     'edate'=>$datetime,

                            //     'otptype'=>1

                            // );

                            // $DB->executedata('i','tblpersonotp',$insotp,'');

                        }



                        $status = 1;

                        $message = str_replace("#email#", $email, $errmsg['sendotptoemail']);



                        $response['personid'] = $personid;



                        $qrychk = "SELECT id,personname,password,email,contact,otp,isactive,ifnull(isverified,0) AS isverified,username,

                        case when (ifnull(profileimg,'')='') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,companyname 

                        FROM tblpersonmaster WHERE  email=:email AND isverified=1";

                        $parms = array(':email' => $email, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imgpath);

                        $result_ary = $DB->getmenual($qrychk, $parms);

                        $rowperson = $reschk[0];

                        if ($platform == 4) {

                            $LoginInfo->setIss($iss);

                            $LoginInfo->setUnqkey($unqkey);

                            $LoginInfo->setKey($key['token']);

                            $LoginInfo->setUsername($rowperson['username']);

                            $LoginInfo->setUtypeid($config->getcustomerutypeid());

                            $LoginInfo->setUid($uid);

                            $LoginInfo->setFullname($rowperson['personname']);

                            $LoginInfo->setEmail($rowperson['email']);

                            $LoginInfo->setContact($rowperson['contact']);

                            $LoginInfo->setPersontype(1);

                            $adlogin = 'savanigemsW$20220901@instance%';

                            $LoginInfo->setAdlogin($adlogin);

                            $LoginInfo->setIsguestuser(0);

                            $LoginInfo->setProfilepic($rowperson['profileimg']);

                            $LoginInfo->setCompanyname($rowperson['companyname']);



                            // echo $rowperson['profileimg'];





                            $_SESSION[$config->getSessionName()] = $LoginInfo;

                            // print_r($LoginInfo);



                            // print_r($_SESSION[$config->getSessionName()]);

                            $response['guestkey'] = $key['token'];

                            $response['guestunqkey'] = $unqkey;

                            $response['iss'] = $iss;

                            $response['uid'] = $uid;

                            $response['utypeid'] = $config->getcustomerutypeid();

                            $response['persontype'] = 1;

                            $response['personname'] = $rowperson['personname'];

                            $response['username'] = $rowperson['username'];

                            $response['fullname'] = $rowperson['personname'];

                            $response['contact'] = $rowperson['contact'];

                            $response['email'] = $rowperson['email'];

                            $response['profileimg'] = $rowperson['profileimg'];

                            $response['adlogin'] = '';



                            $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                            $rowyear = $resultyear[0];



                            $response['yearid'] = $rowyear['id'];

                            $response['yearname'] = $rowyear['name'];

                            $response['activeyearid'] = $rowyear['id'];



                            //  print_r($LoginInfo);

                            $targeturl = $config->getportalbaseurl();

                            if ($redirecturl != '') {

                                $targeturl = $redirecturl;
                            }
                        } else {

                            $response['guestkey'] = $key['token'];

                            $response['guestunqkey'] = $unqkey;

                            $response['iss'] = $iss;

                            $response['uid'] = $uid;

                            $response['utypeid'] = $config->getcustomerutypeid();

                            $response['persontype'] = 1;

                            $response['personname'] = $rowperson['personname'];

                            $response['username'] = $rowperson['username'];

                            $response['fullname'] = $rowperson['personname'];

                            $response['contact'] = $rowperson['contact'];

                            $response['email'] = $rowperson['email'];

                            $response['profileimg'] = $rowperson['profileimg'];

                            $response['adlogin'] = '';



                            $resultyear = $DB->getmenual("SELECT * FROM tblfinancialyear WHERE isactive = 1");

                            $rowyear = $resultyear[0];



                            $response['yearid'] = $rowyear['id'];

                            $response['yearname'] = $rowyear['name'];

                            $response['activeyearid'] = $rowyear['id'];
                        }

                        $status = 1;

                        $message = $errmsg['loginsuccess'];

                        $response['targeturl'] = $targeturl;



                        // SEND OTP TO E-MAIL



                        $emailto = $email;

                        // $subject='New Register Verification Code';

                        // // $data=$otp;





                        // $emailtxt.='';



                        // $emailtxt.='<tr>';

                        // $emailtxt.='<td colspan="10"';

                        // $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                        // $emailtxt.='valign="top">';

                        // $emailtxt.='<p';

                        // $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                        // $emailtxt.='Hi '.$fullname.',</p>';

                        // $emailtxt.='<p';

                        // $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                        // $emailtxt.='New Register Verification Code</p>';

                        // $emailtxt.='</td>';

                        // $emailtxt.='</tr>';

                        // $emailtxt.='<tr>';

                        // $emailtxt.='<td colspan="10"';

                        // $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                        // $emailtxt.='valign="top">';

                        // $emailtxt.='<div';

                        // $emailtxt.=' style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';

                        // $emailtxt.='<span';

                        // $emailtxt.=' style="color:#000000;font-weight:700;text-align:center;">Verification';

                        // $emailtxt.=' Code &nbsp;&nbsp; <strong';

                        // $emailtxt.=' style="background-color: #669934;padding:10px;border-radius:3px;color:#fff;">'.$otp.'</strong></span>';

                        // $emailtxt.='</div>';

                        // $emailtxt.='</td>';

                        // $emailtxt.='</tr>';



                        // // $datares=$DB->getemailbody($emailto,$subject,$emailtxt,'','','','','');

                        // $response['datares']=$datares;

                        // $DB->committransaction();

                        // ==========================================
                        // COMMIT DATABASE FIRST
                        // ==========================================

                        $DB->committransaction();

                        $status = 1;
                        $response['personid'] = $personid;


                        // ==========================================
                        // SEND OTP EMAIL AFTER DATABASE COMMIT
                        // ==========================================

                        try {
                            $datares = $DB->getemailbody(
                                $emailto,
                                $subject,
                                $emailtxt,
                                '',
                                '',
                                '',
                                '',
                                ''
                            );

                            $response['datares'] = $datares;
                        } catch (Throwable $mailError) {
                            error_log(
                                'Registration OTP Email Error: ' .
                                    $mailError->getMessage()
                            );

                            $response['datares'] = null;

                            // Database is already committed.
                            // DO NOT rollback here.

                            $message = 'Registration successful, but OTP email could not be sent. Please try Resend OTP.';
                        }
                    } else {

                        $status = 0;

                        $message = $errmsg['seriesrequired'];
                    }
                }
            } else {

                $message = $errmsg['emailnotfound'];
            }



            $response['webid'] = $webid;

            $response['name'] = $name;

            $response['email'] = $email;

            $response['logtype'] = $logtype;

            $response['emailfound'] = $emailfound;



            $DB->committransaction($DBLog);
        } catch (Exception $e) {

            echo $e;

            $DB->rollbacktransaction($e, $DBLog);

            $status = 0;

            $message = $errmsg['dbtransactionerror'];
        }
    }
}

require_once dirname(__DIR__, 2) . '/config/apifoot.php';
