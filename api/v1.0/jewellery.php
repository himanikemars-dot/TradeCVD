<?php

header("Content-Type:application/json");

require_once dirname(__DIR__, 2) . '/config/init.php';

require_once dirname(__DIR__, 2) . '/config/apiconfig.php';

require_once dirname(__DIR__, 2) . '/model/jewellery.php';



use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Validation\Rule;

use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;



// 2 - Jewelry Search , 7 - List Jewelry for Sale, 3 - Share Diamonds and Jewelry, 8 - SavaniGems XL for Excel



$CanJewellerySearch = $DB->getpackagewiseuserright($LoginInfo->getUid(), 2)['attributeval'];

$CanListJewelleryForList = $DB->getpackagewiseuserright($LoginInfo->getUid(), 7)['attributeval'];

$CanShareJewellery = $DB->getpackagewiseuserright($LoginInfo->getUid(), 3)['attributeval'];

$CanListJewelleryXL = $DB->getpackagewiseuserright($LoginInfo->getUid(), 8)['attributeval'];

$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'];



$candevicelogin=$DB->getDeviceInLogin($LoginInfo->getUid(),$_SERVER['HTTP_USER_AGENT']);

if ($isvalidUser['status'] == 1) {

    if($candevicelogin==1)

    {

        $status = 0;

        $message = $errmsg['invalidrequest'];

        $imageurl = $config->getImageurl();

        $CheckUserRights = $DB->checkpackagewiseuserright($uid);

        $response['IsPackageExpire'] = $CheckUserRights['IsPackageExpire'];

        if ($CheckUserRights['IsPackageExpire'] == 1) {



            $message = $config->getPackageExpiredMessage();

            $ExpiryTitle = $config->getPackageExpiredTitle();

            $ExpiryURL = $config->getPackageExpiredURL();

            $response['ExpiryTitle'] = $ExpiryTitle;

            $response['ExpiryURL'] = $ExpiryURL;

        } 

        else 

        {

            if ($action == 'uploadjewellery') 

            {

                /**********Product Description**************/

                $itemtitle = $IISMethods->sanitize($_POST['itemtitle']);

                $stock = $IISMethods->sanitize($_POST['stock'],'OUT');



                $isavailable = $IISMethods->sanitize($_POST['isavailable']);

                $isavailableformemo = $IISMethods->sanitize($_POST['isavailableformemo']);

                $description = $IISMethods->sanitize($_POST['description'],'OUT');





                /*************Price & Location - Multiple Block For Each*************/



                $shippingfromid = $_POST['shippingfromid'];

                $price = $_POST['price'];

                // $termsid = $_POST['termsid']; // multiple select

                $msrp = $_POST['msrp'];

                $deliverytimeindays = $_POST['deliverytimeindays']; // Days



                /* ****************************************************** */

                $iteminstock = $IISMethods->sanitize($_POST['iteminstock']);

                $minimumorder = $IISMethods->sanitize($_POST['minimumorder']);



                /***********Product Information**************/



                $jewellerytypeid = $IISMethods->sanitize($_POST['jewellerytypeid']);

                $typestyleid = $_POST['typestyleid'];  // Multiple

                $jewellerycategoryid = $_POST['jewellerycategoryid']; // Multiple

                $conditionid = $IISMethods->sanitize($_POST['conditionid']);

                $brandid = $IISMethods->sanitize($_POST['brandid']);

                $jewelleryqualityid = $_POST['jewelleryqualityid']; // Multiple

                $designername = $IISMethods->sanitize($_POST['designername']);

                $keyworddescription = $IISMethods->sanitize($_POST['keyworddescription']); // Comma Seprated





                /***********Metal**************/



                $metaltypeid = $_POST['metaltypeid']; // Multiple

                $metalkaratid = $_POST['metalkaratid']; // Multiple

                $jewellerytotalweight = $IISMethods->sanitize($_POST['jewellerytotalweight']);





                /* ***************** Gemstones - Multiple Block For Each******************** */



                $gemstonetypeid = $_POST['gemstonetypeid'];

                $shapeid = $_POST['shapeid'];

                $caratweight = $_POST['caratweight'];

                $labid = $_POST['labid'];

                $labtext = $_POST['labtext'];

                $hastreatment = $_POST['hastreatment'];

                $treatmentid = $_POST['treatmentid']; // Multiple

                $stone = $_POST['stone'];

                // $savanilot = $_POST['savanilot'];

               

                

                /************************************************* */

                $suppliercomment = $IISMethods->sanitize($_POST['suppliercomment']);

                /***********Measurements**************/



                $size = $IISMethods->sanitize($_POST['size']);

                $ringsize = $IISMethods->sanitize($_POST['ringsize']);



                /***********Visibility**************/

                $unpublished = 0;

                if ($_POST['unpublished'] == 1) {

                    $unpublished = 1;

                }

                $shareable = 0;

                if ($_POST['shareable'] == 1) {

                    $shareable = 1;

                }



                $ownstockinventory = 0;

                if ($_POST['ownstockinventory'] == 1) {

                    $ownstockinventory = 1;

                }





                // Images

                $jewelleryimg = $_FILES['jewelleryimg']['name'];

                $jewelleryvideo = $_FILES['jewelleryvideo']['name'];



                $jewelleryimglink = $IISMethods->sanitize($_POST['jewelleryimglink']);

                $jewelleryvideolink = $IISMethods->sanitize($_POST['jewelleryvideolink']);



                $formevent = $IISMethods->sanitize($_POST['formevent']);

                $id = $IISMethods->sanitize($_POST['id']);

                $currdate = $IISMethods->getcurrdate();



                $datetime = $IISMethods->getdatetime();

                // echo sizeof($shippingfromid);

                if ($CanListJewelleryForList == 1) 

                {

                    if ($stock && $itemtitle && $description && sizeof($shippingfromid) > 0 && $jewellerytypeid) {





                        // print_r(implode(",",$treatmentid));



                        if(is_array($typestyleid))

                        {

                            $flttypestyleid = implode("','", $typestyleid);

                        }

                        if(is_array($jewellerycategoryid))

                        {

                            $fltjewellerycategoryid = implode("','", $jewellerycategoryid);

                        }

                        if(is_array($jewelleryqualityid))

                        {

                            $fltjewelleryqualityid = implode("','", $jewelleryqualityid);

                        }

                        if(is_array($metaltypeid))

                        {

                            $fltmetaltypeid = implode("','", $metaltypeid);

                        }

                        if(is_array($metalkaratid))

                        {

                            $fltmetalkaratid = implode("','", $metalkaratid);

                        }



                        // echo '123';



                        // exit;



                        $qrydata = "SELECT

                                IFNULL((SELECT name FROM tbljewelrytypemaster WHERE id=:jewellerytypeid),'') AS jewellerytype,

                                IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,

                                IFNULL((SELECT group_concat(name) FROM tbltypestylemaster WHERE id IN ('" . $flttypestyleid . "')),'') AS typestyle,

                                IFNULL((SELECT group_concat(name) FROM tbljewelrycategorymaster WHERE id IN ('" . $fltjewellerycategoryid . "')),'') AS jewelrycategory,

                                IFNULL((SELECT name FROM tblconditionmaster WHERE id=:conditionid),'') AS conditionname,

                                IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,

                                IFNULL((SELECT group_concat(name) FROM tbljewelryqualitymaster WHERE id IN ('" . $fltjewelleryqualityid . "')),'') AS jewelleryquality,

                                IFNULL((SELECT group_concat(name) FROM tblmetaltypemaster WHERE id IN ('" . $fltmetaltypeid . "')),'') AS metaltype,

                                IFNULL((SELECT group_concat(name) FROM tblmetalcaratmaster WHERE id IN ('" . $fltmetalkaratid . "')),'') AS metalkarat";

                        $paramdata = array(

                            ':jewellerytypeid' => $jewellerytypeid,

                            ':personid' => $uid,

                            ':conditionid' => $conditionid,

                            ':brandid' => $brandid,

                        );

                        //    print_r($paramdata);



                        $resdata = $DB->getmenual($qrydata, $paramdata);

                        $rowdata = $resdata[0];



                        if(is_array($typestyleid))

                        {

                            $typestyleid1 = implode(',', $typestyleid);

                        }

                        if(is_array($jewellerycategoryid))

                        {

                            $jewellerycategoryid1 = implode(',', $jewellerycategoryid);

                        }

                        if(is_array($jewelleryqualityid))

                        {

                            $jewelleryqualityid1 = implode(',', $jewelleryqualityid);

                        }

                        if(is_array($metaltypeid))

                        {

                            $metaltypeid1 = implode(',', $metaltypeid);

                        }

                        if(is_array($metalkaratid))

                        {

                            $metalkaratid1 = implode(',', $metalkaratid);

                        }



                        $insqry = array(

                            'personid' => $uid,

                            'personname' => $rowdata['personname'],

                            'itemtitle' => $itemtitle,

                            'stock' => $stock,

                            'isavailable' => $isavailable,

                            'isavailableformemo' => $isavailableformemo,

                            'description' => $description,

                            'iteminstock' => $iteminstock,

                            'minimumorder' => $minimumorder,

                            'jewellerytypeid' => $jewellerytypeid,

                            'jewellerytype' => $rowdata['jewellerytype'],

                            // 'typestyleid' => implode(',', $typestyleid),

                            '   ' => $typestyleid1,

                            'typestyle' => $rowdata['typestyle'],

                            // 'jewellerycategoryid' => implode(',', $jewellerycategoryid),

                            'jewellerycategoryid' => $jewellerycategoryid1,

                            'jewellerycategory' => $rowdata['jewelrycategory'],

                            'conditionid' => $conditionid,

                            'conditionname' => $rowdata['conditionname'],

                            'brandid' => $brandid,

                            'brand' => $rowdata['brand'],

                            // 'jewelleryqualityid' => implode(',', $jewelleryqualityid),

                            'jewelleryqualityid' => $jewelleryqualityid1,

                            'jewelleryquality' => $rowdata['jewelleryquality'],

                            'designername' => $designername,

                            'keyworddescription' => $keyworddescription,

                            // 'metaltypeid' => implode(',', $metaltypeid),

                            'metaltypeid' => $metaltypeid1,

                            'metaltype' => $rowdata['metaltype'],

                            // 'metalkaratid' => implode(',', $metalkaratid),

                            'metalkaratid' => $metalkaratid1,

                            'metalkarat' => $rowdata['metalkarat'],

                            'jewellerytotalweight' => $jewellerytotalweight,

                            'suppliercomment' => $suppliercomment,

                            'size' => $size,

                            'ringsize' => $ringsize,

                            'unpublished' => $unpublished,

                            'sharable' => $shareable,

                            'ownstockinventory' => $ownstockinventory,

                            'jewelleryimglink' => $jewelleryimglink,

                            'jewelleryvideolink' => $jewelleryvideolink,



                        );



                     



                        if ($formevent == 'submit') {

                            $typename = 'jewellery';

                            $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";

                            $seriesparams = array(

                                ':typename' => $typename,

                            );

                            $result_ary = $DB->getmenual($qryseries, $seriesparams);

                            $rowseries = $result_ary[0];



                            $seriesid = $rowseries['id'];

                            $seriesno = $DB->getorderno($seriesid, 'jewellery', $currdate);

                            $maxid = $DB->getmaxid($seriesid, 'jewellery');



                            if ($seriesid) 

                            {

                                try 

                                {

                                    $DB->begintransaction();

                                    $jewelleryid = $IISMethods->generateuuid();



                                    $insqry['id'] = $jewelleryid;

                                    $insqry['jewelleryno'] = $seriesno;

                                    $insqry['isactive'] = 1;

                                    $insqry['maxid'] = $maxid;

                                    $insqry['seriesid'] = $seriesid;

                                    $insqry['timestamp'] = $datetime;

                                    $insqry['entry_uid'] = $uid;

                                    $insqry['entry_date'] = $datetime;

                                    // print_r($insqry);



                                   

                                    $DB->executedata('i', 'tbljewellery', $insqry, '');

                                    //exit;

                                    $DB->userwisediamonjewelrylog(2, $uid);

                                    if (($jewelleryimg)) 

                                    {

                                        if (is_array($_FILES)) 

                                        {

                                            $isupdimg = 0;

                                            foreach ($_FILES['jewelleryimg']['name'] as $name => $value) 

                                            {

                                                if ($_FILES['jewelleryimg']['type'][$name] == 'image/jpg'  || $_FILES['jewelleryimg']['type'][$name] == 'image/jpeg' || $_FILES['jewelleryimg']['type'][$name] == 'image/png') {



                                                    $unqimgid = $IISMethods->generateuuid();

                                                    $sourcePath = $_FILES['jewelleryimg']['tmp_name'][$name];

                                                    $targetPath = $IISMethods->uploadallfiles(0, 'jewelleryimg', $_FILES['jewelleryimg']['name'][$name], $sourcePath, $unqimgid);



                                                    $insdata = array(

                                                        'id' => $unqimgid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'image' => $targetPath,

                                                        'imgtype' => $_FILES['jewelleryimg']['type'][$name],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime

                                                    );

                                                    $DB->executedata('i', 'tbljewelleryimages', $insdata, '');



                                                    $isupdimg = 1;

                                                }

                                            }

                                        }

                                    }



                                    if (($jewelleryvideo)) 

                                    {

                                        if (is_array($_FILES)) 

                                        {

                                            $isupdvideo = 0;

                                            foreach ($_FILES['jewelleryvideo']['name'] as $name => $value) 

                                            {

                                                if ($_FILES['jewelleryvideo']['type'][$name] == 'video/mp3'  || $_FILES['jewelleryvideo']['type'][$name] == 'video/mp4' || $_FILES['jewelleryvideo']['type'][$name] == 'video/x-m4v') {



                                                    $unqvideoid = $IISMethods->generateuuid();

                                                    $sourcePath = $_FILES['jewelleryvideo']['tmp_name'][$name];

                                                    $targetPath = $IISMethods->uploadallfiles(0, 'jewelleryvideo', $_FILES['jewelleryvideo']['name'][$name], $sourcePath, $unqvideoid);



                                                    $insdata = array(

                                                        'id' => $unqvideoid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'video' => $targetPath,

                                                        // 'videotype' => $_FILES['jewelleryvideo']['type'][$name],

                                                        'entry_uid' => $uid,

                                                        'type' => 2,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime

                                                    );

                                                    $DB->executedata('i', 'tbljewelleryimages', $insdata, '');



                                                    $isupdvideo = 1;

                                                }

                                            }

                                        }

                                    }

                                   

                                    /*************Price & Location - Multiple Block For Each*************/

                                    if (($shippingfromid)) 

                                    {

                                        // ini_set('display_errors', 1);

		                                // error_reporting(E_ALL);

                                        for ($sf = 0; $sf < sizeof($shippingfromid); $sf++) 

                                        {

                                            if(is_array($_POST['termsid' . $sf]))

                                            {



                                                $flttermsid = implode("','", $_POST['termsid' . $sf]);

                                            }



                                            $qrysf = "SELECT

                                                    IFNULL((SELECT country from tblcountrymaster where id=:countryid),'') AS country,

                                                    IFNULL((SELECT group_concat(name) from tbltermsmaster where id IN ('" . $flttermsid . "')),'') AS terms";

                                            $parmssf = array(

                                                ':countryid' => $shippingfromid[$sf],

                                            );

                                            $result_sf = $DB->getmenual($qrysf, $parmssf);

                                            $msfid = $IISMethods->generateuuid();



                                            if(is_array($_POST['termsid' . $sf]))

                                            {

                                                $termsid1 = implode(',', $_POST['termsid' . $sf]);

                                            }

                                            $inspersf = array(

                                                'id' => $msfid,

                                                'jewelleryid' => $jewelleryid,

                                                'shippingfromid' => $shippingfromid[$sf],

                                                'shippingfrom' => $result_sf[0]['country'],

                                                'price' => $price[$sf],

                                                // 'termsid' => implode(',', $_POST['termsid' . $sf]),

                                                'termsid' => $termsid1,

                                                'terms' => $result_sf[0]['terms'],

                                                'msrp' => $msrp[$sf],

                                                'deliverytimeindays' => $deliverytimeindays[$sf],

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerypricelocation', $inspersf, '');



                                            if (($_POST['termsid' . $sf])) 

                                            {

                                                for ($tm = 0; $tm < sizeof($_POST['termsid' . $sf]); $tm++) {

                                                    $qrytm = "SELECT

                                                            IFNULL((SELECT name from tbltermsmaster where id=:termsid),'') AS terms";

                                                    $parmstm = array(

                                                        ':termsid' => $_POST['termsid' . $sf][$tm],

                                                    );

                                                    $result_tm = $DB->getmenual($qrytm, $parmstm);



                                                    $tmid = $IISMethods->generateuuid();

                                                    $insterms = array(

                                                        'id' => $tmid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'jewellerypricelocid' => $msfid,

                                                        'termsid' => $_POST['termsid' . $sf][$tm],

                                                        'terms' => $result_tm[0]['terms'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    // echo '<pre>';

                                                    // print_r($insterms);

                                                    // echo '</pre>';

                                                    $DB->executedata('i', 'tbljewelleryterms', $insterms, '');

                                                }

                                            }

                                        }



                                        $qryminmaxprice = "SELECT

                                                IFNULL((SELECT MIN(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid1 LIMIT 1),'') AS minprice,

                                                IFNULL((SELECT MAX(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid2 LIMIT 1),'') AS maxprice";

                                        $parmsminmaxprice = array(

                                            ':jewelleryid1' => $jewelleryid,

                                            ':jewelleryid2' => $jewelleryid,

                                        );

                                        $result_minmaxprice = $DB->getmenual($qryminmaxprice, $parmsminmaxprice);



                                        $updqry['minprice'] = $result_minmaxprice[0]['minprice'];

                                        $updqry['maxprice'] = $result_minmaxprice[0]['maxprice'];

                                        $aryupd = array(

                                            'id' => $jewelleryid,

                                        );

                                        $DB->executedata('u', 'tbljewellery', $updqry, $aryupd);

                                        $DB->userwisediamonjewelrylog(2, $uid);

                                    }



                                    

                                    /***********Product Information**************/

                                    if (($typestyleid)) 

                                    {

                                        for ($t = 0; $t < sizeof($typestyleid); $t++) 

                                        {

                                            $qrytypestyle = "SELECT name from tbltypestylemaster where id=:id";

                                            $parmstypestyle = array(

                                                ':id' => $typestyleid[$t],

                                            );

                                            $result_typestyle = $DB->getmenual($qrytypestyle, $parmstypestyle);

                                            $mtypestyleid = $IISMethods->generateuuid();

                                            $inspertypestyle = array(

                                                'id' => $mtypestyleid,

                                                'jewelleryid' => $jewelleryid,

                                                'typestyleid' => $typestyleid[$t],

                                                'typestyle' => $result_typestyle[0]['name'],

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerytypestyle', $inspertypestyle, '');

                                        }

                                    }

                                    

                                    if (($jewellerycategoryid)) 

                                    {

                                        for ($jc = 0; $jc < sizeof($jewellerycategoryid); $jc++) {

                                            $qryjewellerycategory = "SELECT name from tbljewelrycategorymaster where id=:id";

                                            $parmsjewellerycategory = array(

                                                ':id' => $jewellerycategoryid[$jc],

                                            );

                                            $result_jewellerycategory = $DB->getmenual($qryjewellerycategory, $parmsjewellerycategory);

                                            $mjewellerycategoryid = $IISMethods->generateuuid();

                                            $insperjewellerycategory = array(

                                                'id' => $mjewellerycategoryid,

                                                'jewelleryid' => $jewelleryid,

                                                'categoryid' => $jewellerycategoryid[$jc],

                                                'category' => $result_jewellerycategory[0]['name'],

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerycategory', $insperjewellerycategory, '');

                                        }

                                    }



                                    if (($jewelleryqualityid)) 

                                    {

                                        for ($jq = 0; $jq < sizeof($jewelleryqualityid); $jq++) 

                                        {

                                            $qryjewelleryquality = "SELECT name from tbljewelryqualitymaster where id=:id";

                                            $parmsjewelleryquality = array(

                                                ':id' => $jewelleryqualityid[$jq],

                                            );

                                            $result_jewelleryquality = $DB->getmenual($qryjewelleryquality, $parmsjewelleryquality);

                                            $mjewelleryqualityid = $IISMethods->generateuuid();

                                            $insperjewelleryquality = array(

                                                'id' => $mjewelleryqualityid,

                                                'jewelleryid' => $jewelleryid,

                                                'qualityid' => $jewelleryqualityid[$jq],

                                                'quality' => $result_jewelleryquality[0]['name'],

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewelleryquality', $insperjewelleryquality, '');

                                        }

                                    }

                                    

                                    /***********Metal**************/



                                    if (($metaltypeid)) 

                                    {

                                        for ($mt = 0; $mt < sizeof($metaltypeid); $mt++) {

                                            $qrymetaltype = "SELECT name from tblmetaltypemaster where id=:id";

                                            $parmsmetaltype = array(

                                                ':id' => $metaltypeid[$mt],

                                            );

                                            $result_metaltype = $DB->getmenual($qrymetaltype, $parmsmetaltype);

                                            $mmetaltypeid = $IISMethods->generateuuid();

                                            $inspermetaltype = array(

                                                'id' => $mmetaltypeid,

                                                'jewelleryid' => $jewelleryid,

                                                'metaltypeid' => $metaltypeid[$mt],

                                                'metaltype' => $result_metaltype[0]['name'],

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerymetaltype', $inspermetaltype, '');

                                        }

                                    }



                                    if (($metalkaratid)) 

                                    {

                                        for ($mk = 0; $mk < sizeof($metalkaratid); $mk++) {

                                            $qrymetalkarat = "SELECT name from tblmetalcaratmaster where id=:id";

                                            $parmsmetalkarat = array(

                                                ':id' => $metalkaratid[$mk],

                                            );

                                            $result_metalkarat = $DB->getmenual($qrymetalkarat, $parmsmetalkarat);

                                            $mmetalkaratid = $IISMethods->generateuuid();

                                            $inspermetalkarat = array(

                                                'id' => $mmetalkaratid,

                                                'jewelleryid' => $jewelleryid,

                                                'metalkaratid' => $metalkaratid[$mk],

                                                'metalkarat' => $result_metalkarat[0]['name'],

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerymetalkarat', $inspermetalkarat, '');

                                        }

                                    }



                                   

                                    /* ***************** Gemstones - Multiple Block For Each******************** */

                                    if (($gemstonetypeid)) 

                                    {

                                        // ini_set('display_errors', 1);

		                                //     error_reporting(E_ALL);

                                        for ($gs = 0; $gs < sizeof($gemstonetypeid); $gs++) 

                                        {



                                            if(is_array($_POST['treatmentid' . $gs]))

                                            {

                                                $flttreatmentid = implode("','", $_POST['treatmentid' . $gs]);

                                            }



                                            $savanilot = "SG".str_pad(rand(),6,'0',STR_PAD_LEFT);



                                            $qrygemstonetype = "SELECT

                                                            IFNULL((SELECT name from tblgemstonetypemaster where id=:gemstonetypeid),'') AS gemstonetype,

                                                            IFNULL((SELECT name from tbldiamondshapemaster where id=:shapeid),'') AS shape,

                                                            IFNULL((SELECT name from tbllabmaster where id=:labid),'') AS lab,

                                                            IFNULL((SELECT group_concat(name) from tbltreatmentmaster where id IN ('" . $flttreatmentid . "')),'') AS treatment";

                                            $parmsgemstonetype = array(

                                                ':gemstonetypeid' => $gemstonetypeid[$gs],

                                                ':shapeid' => $shapeid[$gs],

                                                ':labid' => $labid[$gs],

                                            );

                                            // print_r($parmsgemstonetype);

                                            $result_gemstonetype = $DB->getmenual($qrygemstonetype, $parmsgemstonetype);

                                            $mgemstonetypeid = $IISMethods->generateuuid();



                                            $htreatment = 0;

                                            if (($_POST['treatmentid' . $gs])) 

                                            {

                                                $htreatment = 1;

                                            }



                                            if(is_array($_POST['treatmentid' . $gs]))

                                            {

                                                $treatmentid1 = implode("','", $_POST['treatmentid' . $gs]);

                                            }

                                            $inspergemstonetype = array(

                                                'id' => $mgemstonetypeid,

                                                'jewelleryid' => $jewelleryid,

                                                'gemstonetypeid' => $gemstonetypeid[$gs],

                                                'gemstonetype' => $result_gemstonetype[0]['gemstonetype'],

                                                'shapeid' => $shapeid[$gs],

                                                'shape' => $result_gemstonetype[0]['shape'],

                                                'caratweight' => $caratweight[$gs],

                                                'labid' => $labid[$gs],

                                                'lab' => $result_gemstonetype[0]['lab'],

                                                'labtext' => $labtext[$gs],

                                                'hastreatment' => $htreatment,

                                                // 'treatmentid' => implode(",", $_POST['treatmentid' . $gs]),

                                                'treatmentid' => $treatmentid1,

                                                'treatment' => $result_gemstonetype[0]['treatment'],

                                                'stones' => $stone[$gs],

                                                // 'savanilot' => $savanilot[$gs],

                                                'savanilot' => $savanilot,



                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerygemstones', $inspergemstonetype, '');



                                            if ($htreatment == 1) 

                                            {

                                                if (sizeof($_POST['treatmentid' . $gs]) > 0) 

                                                {

                                                    for ($tr = 0; $tr < sizeof($_POST['treatmentid' . $gs]); $tr++) 

                                                    {

                                                        $qrytreatment = "SELECT name from tbltreatmentmaster where id=:id";

                                                        $parmstreatment = array(

                                                            ':id' => $_POST['treatmentid' . $gs][$tr],

                                                        );

                                                        $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);

                                                        $mtreatmentid = $IISMethods->generateuuid();

                                                        $inspertreatment = array(

                                                            'id' => $mtreatmentid,

                                                            'jewelleryid' => $jewelleryid,

                                                            'jewellerygemstoneid' => $mgemstonetypeid,

                                                            'treatmentid' => $_POST['treatmentid' . $gs][$tr],

                                                            'treatment' => $result_treatment[0]['name'],

                                                            'entry_uid' => $uid,

                                                            'entry_date' => $datetime,

                                                            'timestamp' => $datetime,

                                                        );

                                                        // echo '<pre>';

                                                        // print_r($inspertreatment);

                                                        // echo '</pre>';

                                                        $DB->executedata('i', 'tbljewellerytreatment', $inspertreatment, '');

                                                    }

                                                }

                                            }

                                        }

                                    }



                                    // echo 'TEST';

                                    // exit;

                                    // echo 'TEST';

                                    $status = 1;

                                    $message = $errmsg['jewelleryinsert'];

                                    $DB->committransaction();

                                } catch (Exception $e) {

                                    echo $e;

                                    $DB->rollbacktransaction($e);

                                    $status = 0;

                                    $message = $errmsg['dbtransactionerror'];

                                }

                            } else {

                                $status = 0;

                                $message = $errmsg['seriesrequired'];

                            }

                        } else if ($formevent == 'update') {

                            try {

                                $DB->begintransaction();





                                $jewelleryid = $id;







                                $insqry['timestamp'] = $datetime;

                                $insqry['update_uid'] = $uid;

                                $insqry['update_date'] = $datetime;

                                $ary = array(

                                    'id' => $jewelleryid,

                                );

                                $DB->executedata('u', 'tbljewellery', $insqry, $ary);

                                $DB->userwisediamonjewelrylog(2, $uid);



                                if (($jewelleryimg)) 

                                {

                                    if (is_array($_FILES)) 

                                    {

                                        $isupdimg = 0;

                                        foreach ($_FILES['jewelleryimg']['name'] as $name => $value) {

                                            if ($_FILES['jewelleryimg']['type'][$name] == 'image/jpg'  || $_FILES['jewelleryimg']['type'][$name] == 'image/jpeg' || $_FILES['jewelleryimg']['type'][$name] == 'image/png') {



                                                $unqimgid = $IISMethods->generateuuid();

                                                $sourcePath = $_FILES['jewelleryimg']['tmp_name'][$name];

                                                $targetPath = $IISMethods->uploadallfiles(0, 'jewelleryimg', $_FILES['jewelleryimg']['name'][$name], $sourcePath, $unqimgid);



                                                $insdata = array(

                                                    'id' => $unqimgid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'image' => $targetPath,

                                                    'imgtype' => $_FILES['jewelleryimg']['type'][$name],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime

                                                );

                                                $DB->executedata('i', 'tbljewelleryimages', $insdata, '');



                                                $isupdimg = 1;

                                            }

                                        }

                                    }

                                }

                               



                                if (($jewelleryvideo)) 

                                {

                                    if (is_array($_FILES)) 

                                    {

                                        $isupdvideo = 0;

                                        foreach ($_FILES['jewelleryvideo']['name'] as $name => $value) 

                                        {

                                            if ($_FILES['jewelleryvideo']['type'][$name] == 'video/mp3'  || $_FILES['jewelleryvideo']['type'][$name] == 'video/mp4' || $_FILES['jewelleryvideo']['type'][$name] == 'video/x-m4v') {



                                                $unqvideoid = $IISMethods->generateuuid();

                                                $sourcePath = $_FILES['jewelleryvideo']['tmp_name'][$name];

                                                $targetPath = $IISMethods->uploadallfiles(0, 'jewelleryvideo', $_FILES['jewelleryvideo']['name'][$name], $sourcePath, $unqvideoid);



                                                $insdata = array(

                                                    'id' => $unqvideoid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'video' => $targetPath,

                                                    // 'videotype' => $_FILES['jewelleryvideo']['type'][$name],

                                                    'entry_uid' => $uid,

                                                    'type' => 2,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime

                                                );

                                                $DB->executedata('i', 'tbljewelleryimages', $insdata, '');



                                                $isupdvideo = 1;

                                            }

                                        }

                                    }

                                }

                               

                                /*************Price & Location - Multiple Block For Each*************/

                                $pricelocationparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerypricelocation', '', $pricelocationparams);

                                $termsparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);



                                

                                if (($shippingfromid)) 

                                {

                                    for ($sf = 0; $sf < sizeof($shippingfromid); $sf++) 

                                    {

                                        if(is_array($_POST['termsid' . $sf]))

                                        {

                                            $flttermsid = implode("','", $_POST['termsid' . $sf]);

                                        }



                                        $qrysf = "SELECT

                                                IFNULL((SELECT country from tblcountrymaster where id=:countryid),'') AS country,

                                                IFNULL((SELECT group_concat(name) from tbltermsmaster where id IN ('" . $flttermsid . "')),'') AS terms";

                                        $parmssf = array(

                                            ':countryid' => $shippingfromid[$sf],

                                        );

                                        $result_sf = $DB->getmenual($qrysf, $parmssf);

                                        $msfid = $IISMethods->generateuuid();

                                       

                                       

                                        if(is_array($_POST['termsid' . $sf]))

                                        {

                                            $termsid1 = implode(',', $_POST['termsid' . $sf]);

                                        }

                                        $inspersf = array(

                                            'id' => $msfid,

                                            'jewelleryid' => $jewelleryid,

                                            'shippingfromid' => $shippingfromid[$sf],

                                            'shippingfrom' => $result_sf[0]['country'],

                                            'price' => $price[$sf],

                                            // 'termsid' => implode(',', $_POST['termsid' . $sf]),

                                            'termsid' => $termsid1,

                                            'terms' => $result_sf[0]['terms'],

                                            'msrp' => $msrp[$sf],

                                            'deliverytimeindays' => $deliverytimeindays[$sf],

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerypricelocation', $inspersf, '');



                                        if (($_POST['termsid' . $sf]) > 0) 

                                        {

                                            for ($tm = 0; $tm < sizeof($_POST['termsid' . $sf]); $tm++) {

                                                $qrytm = "SELECT

                                                        IFNULL((SELECT name from tbltermsmaster where id=:termsid),'') AS terms";

                                                $parmstm = array(

                                                    ':termsid' => $_POST['termsid' . $sf][$tm],

                                                );

                                                $result_tm = $DB->getmenual($qrytm, $parmstm);



                                                $tmid = $IISMethods->generateuuid();

                                                $insterms = array(

                                                    'id' => $tmid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'jewellerypricelocid' => $msfid,

                                                    'termsid' => $_POST['termsid' . $sf][$tm],

                                                    'terms' => $result_tm[0]['terms'],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                // echo '<pre>';

                                                // print_r($insterms);

                                                // echo '</pre>';

                                                $DB->executedata('i', 'tbljewelleryterms', $insterms, '');

                                            }

                                        }

                                    }

                                    

                                  

                                    $qryminmaxprice = "SELECT

                                            IFNULL((SELECT MIN(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid1 LIMIT 1),'') AS minprice,

                                            IFNULL((SELECT MAX(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid2 LIMIT 1),'') AS maxprice";

                                    $parmsminmaxprice = array(

                                        ':jewelleryid1' => $jewelleryid,

                                        ':jewelleryid2' => $jewelleryid,

                                    );

                                    $result_minmaxprice = $DB->getmenual($qryminmaxprice, $parmsminmaxprice);



                                    $updqry['minprice'] = $result_minmaxprice[0]['minprice'];

                                    $updqry['maxprice'] = $result_minmaxprice[0]['maxprice'];

                                    $aryupd = array(

                                        'id' => $jewelleryid,

                                    );

                                    $DB->executedata('u', 'tbljewellery', $updqry, $aryupd);

                                    $DB->userwisediamonjewelrylog(2, $uid);

                                }





                                /***********Product Information**************/

                                $typestyleparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                



                                $DB->executedata('d', 'tbljewellerytypestyle', '', $typestyleparams);

                                if (($typestyleid)) 

                                {

                                    for ($t = 0; $t < sizeof($typestyleid); $t++) {

                                        $qrytypestyle = "SELECT name from tbltypestylemaster where id=:id";

                                        $parmstypestyle = array(

                                            ':id' => $typestyleid[$t],

                                        );

                                        $result_typestyle = $DB->getmenual($qrytypestyle, $parmstypestyle);

                                        $mtypestyleid = $IISMethods->generateuuid();

                                        $inspertypestyle = array(

                                            'id' => $mtypestyleid,

                                            'jewelleryid' => $jewelleryid,

                                            'typestyleid' => $typestyleid[$t],

                                            'typestyle' => $result_typestyle[0]['name'],

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerytypestyle', $inspertypestyle, '');

                                    }

                                }



                                $categoryparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerycategory', '', $categoryparams);

                                if (($jewellerycategoryid)) 

                                {

                                    for ($jc = 0; $jc < sizeof($jewellerycategoryid); $jc++) {

                                        $qryjewellerycategory = "SELECT name from tbljewelrycategorymaster where id=:id";

                                        $parmsjewellerycategory = array(

                                            ':id' => $jewellerycategoryid[$jc],

                                        );

                                        $result_jewellerycategory = $DB->getmenual($qryjewellerycategory, $parmsjewellerycategory);

                                        $mjewellerycategoryid = $IISMethods->generateuuid();

                                        $insperjewellerycategory = array(

                                            'id' => $mjewellerycategoryid,

                                            'jewelleryid' => $jewelleryid,

                                            'categoryid' => $jewellerycategoryid[$jc],

                                            'category' => $result_jewellerycategory[0]['name'],

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerycategory', $insperjewellerycategory, '');

                                    }

                                }

                             

                                $qualityparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryquality', '', $qualityparams);

                                if (($jewelleryqualityid)) 

                                {

                                    for ($jq = 0; $jq < sizeof($jewelleryqualityid); $jq++) {

                                        $qryjewelleryquality = "SELECT name from tbljewelryqualitymaster where id=:id";

                                        $parmsjewelleryquality = array(

                                            ':id' => $jewelleryqualityid[$jq],

                                        );

                                        $result_jewelleryquality = $DB->getmenual($qryjewelleryquality, $parmsjewelleryquality);

                                        $mjewelleryqualityid = $IISMethods->generateuuid();

                                        $insperjewelleryquality = array(

                                            'id' => $mjewelleryqualityid,

                                            'jewelleryid' => $jewelleryid,

                                            'qualityid' => $jewelleryqualityid[$jq],

                                            'quality' => $result_jewelleryquality[0]['name'],

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewelleryquality', $insperjewelleryquality, '');

                                    }

                                }



                                /***********Metal**************/

                                $metaltypeparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerymetaltype', '', $metaltypeparams);

                                if (($metaltypeid)) 

                                {

                                    for ($mt = 0; $mt < sizeof($metaltypeid); $mt++) {

                                        $qrymetaltype = "SELECT name from tblmetaltypemaster where id=:id";

                                        $parmsmetaltype = array(

                                            ':id' => $metaltypeid[$mt],

                                        );

                                        $result_metaltype = $DB->getmenual($qrymetaltype, $parmsmetaltype);

                                        $mmetaltypeid = $IISMethods->generateuuid();

                                        $inspermetaltype = array(

                                            'id' => $mmetaltypeid,

                                            'jewelleryid' => $jewelleryid,

                                            'metaltypeid' => $metaltypeid[$mt],

                                            'metaltype' => $result_metaltype[0]['name'],

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerymetaltype', $inspermetaltype, '');

                                    }

                                }



                               

                                $metalkaratparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerymetalkarat', '', $metalkaratparams);

                                if (($metalkaratid)) 

                                {

                                    for ($mk = 0; $mk < sizeof($metalkaratid); $mk++) {

                                        $qrymetalkarat = "SELECT name from tblmetalcaratmaster where id=:id";

                                        $parmsmetalkarat = array(

                                            ':id' => $metalkaratid[$mk],

                                        );

                                        $result_metalkarat = $DB->getmenual($qrymetalkarat, $parmsmetalkarat);

                                        $mmetalkaratid = $IISMethods->generateuuid();

                                        $inspermetalkarat = array(

                                            'id' => $mmetalkaratid,

                                            'jewelleryid' => $jewelleryid,

                                            'metalkaratid' => $metalkaratid[$mk],

                                            'metalkarat' => $result_metalkarat[0]['name'],

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerymetalkarat', $inspermetalkarat, '');

                                    }

                                }



                               

                                /* ***************** Gemstones - Multiple Block For Each******************** */

                                $gemstonesparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);

                                $treatmentparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);

                                if (($gemstonetypeid)) 

                                {

                                    for ($gs = 0; $gs < sizeof($gemstonetypeid); $gs++) 

                                    {

                                        if(is_array($_POST['treatmentid' . $gs]))

                                        {

                                            $flttreatmentid = implode("','", $_POST['treatmentid' . $gs]);

                                        }

                                        $savanilot = "SG".str_pad(rand(),6,'0',STR_PAD_LEFT);



                                        $qrygemstonetype = "SELECT

                                                        IFNULL((SELECT name from tblgemstonetypemaster where id=:gemstonetypeid),'') AS gemstonetype,

                                                        IFNULL((SELECT name from tbldiamondshapemaster where id=:shapeid),'') AS shape,

                                                        IFNULL((SELECT name from tbllabmaster where id=:labid),'') AS lab,

                                                        IFNULL((SELECT group_concat(name) from tbltreatmentmaster where id IN ('" . $flttreatmentid . "')),'') AS treatment";

                                        $parmsgemstonetype = array(

                                            ':gemstonetypeid' => $gemstonetypeid[$gs],

                                            ':shapeid' => $shapeid[$gs],

                                            ':labid' => $labid[$gs],

                                        );

                                        // print_r($parmsgemstonetype);

                                        $result_gemstonetype = $DB->getmenual($qrygemstonetype, $parmsgemstonetype);

                                        $mgemstonetypeid = $IISMethods->generateuuid();



                                        $htreatment = 0;

                                        if (($_POST['treatmentid' . $gs]) > 0) {

                                            $htreatment = 1;

                                        }



                                        if(is_array($_POST['treatmentid' . $gs]))

                                        {

                                            $treatmentid1 = implode(",", $_POST['treatmentid' . $gs]);

                                        }

                                        $inspergemstonetype = array(

                                            'id' => $mgemstonetypeid,

                                            'jewelleryid' => $jewelleryid,

                                            'gemstonetypeid' => $gemstonetypeid[$gs],

                                            'gemstonetype' => $result_gemstonetype[0]['gemstonetype'],

                                            'shapeid' => $shapeid[$gs],

                                            'shape' => $result_gemstonetype[0]['shape'],

                                            'caratweight' => $caratweight[$gs],

                                            'labid' => $labid[$gs],

                                            'lab' => $result_gemstonetype[0]['lab'],

                                            'labtext' => $labtext[$gs],

                                            'hastreatment' => $htreatment,

                                            'treatmentid' => $treatmentid1,

                                            'treatment' => $result_gemstonetype[0]['treatment'],

                                            'stones' => $stone[$gs],

                                            // 'savanilot' => $savanilot[$gs],

                                            'savanilot' => $savanilot,

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerygemstones', $inspergemstonetype, '');



                                       

                                        if ($htreatment == 1) {

                                            if (($_POST['treatmentid' . $gs]) > 0) {

                                                for ($tr = 0; $tr < sizeof($_POST['treatmentid' . $gs]); $tr++) {

                                                    $qrytreatment = "SELECT name from tbltreatmentmaster where id=:id";

                                                    $parmstreatment = array(

                                                        ':id' => $_POST['treatmentid' . $gs][$tr],

                                                    );

                                                    $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);

                                                    $mtreatmentid = $IISMethods->generateuuid();

                                                    $inspertreatment = array(

                                                        'id' => $mtreatmentid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'jewellerygemstoneid' => $mgemstonetypeid,

                                                        'treatmentid' => $_POST['treatmentid' . $gs][$tr],

                                                        'treatment' => $result_treatment[0]['name'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    // echo '<pre>';

                                                    // print_r($inspertreatment);

                                                    // echo '</pre>';

                                                    $DB->executedata('i', 'tbljewellerytreatment', $inspertreatment, '');

                                                }

                                            }

                                        }

                                    }

                                }



                                $status = 1;

                                $message = $errmsg['jewelleryupdate'];

                                $DB->committransaction();

                            } catch (Exception $e) {

                                $DB->rollbacktransaction($e);

                                $status = 0;

                                $message = $errmsg['dbtransactionerror'];

                            }

                        }

                    } else {

                        $message = $errmsg['required'];

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            } else if ($action == 'deletejewellery') {

                $id = $IISMethods->sanitize($_POST['id']);

                if ($CanListJewelleryForList == 1) {

                    if ($id && $uid) {

                        $qryjewellery = "SELECT id FROM tbljewellery WHERE personid=:personid AND id=:id";

                        $paramjewellery = array(':personid' => $uid, ':id' => $id);

                        $resjewellery = $DB->getmenual($qryjewellery, $paramjewellery);



                        if (sizeof($resjewellery) > 0) {

                            try {

                                $DB->begintransaction();

                                $rowdm = $resjewellery[0];

                                $jewelleryid = $rowdm['id'];



                                $params = array(

                                    'id' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellery', '', $params);

                                $DB->userwisediamonjewelrylog(2, $uid);



                                $categoryparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerycategory', '', $categoryparams);



                                $favoriteparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryfavorite', '', $favoriteparams);



                                $gemstonesparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);



                                $imagesparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryimages', '', $imagesparams);



                                $metalkaratparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerymetalkarat', '', $metalkaratparams);



                                $metaltypeparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerymetaltype', '', $metaltypeparams);



                                $pricelocationparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerypricelocation', '', $pricelocationparams);



                                $qualityparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryquality', '', $qualityparams);



                                $termsparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);



                                $treatmentparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);



                                $typestyleparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerytypestyle', '', $typestyleparams);



                                $status = 1;

                                $message = $errmsg['jewellerydelete'];

                                $DB->committransaction();

                            } catch (Exception $e) {

                                $DB->rollbacktransaction($e);

                                $status = 0;

                                $message = $errmsg['dbtransactionerror'];

                            }

                        }

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            }

            else if ($action == 'deletemyjewellerydata') {

                $bulkid = $_POST['bulkid'];

                

                $bulk = explode(",", $bulkid);

                if (sizeof($bulk) > 0) {

                    $usemenu = '';

                    for ($i = 0; $i < sizeof($bulk); $i++) {

                        $jewelleryid = $bulk[$i];

                                $params = array(

                                    'id' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellery', '', $params);

                                $DB->userwisediamonjewelrylog(2, $uid);



                                $categoryparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerycategory', '', $categoryparams);



                                $favoriteparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryfavorite', '', $favoriteparams);



                                $gemstonesparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);



                                $imagesparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryimages', '', $imagesparams);



                                $metalkaratparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerymetalkarat', '', $metalkaratparams);



                                $metaltypeparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerymetaltype', '', $metaltypeparams);



                                $pricelocationparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerypricelocation', '', $pricelocationparams);



                                $qualityparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryquality', '', $qualityparams);



                                $termsparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);



                                $treatmentparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);



                                $typestyleparams = array(

                                    'jewelleryid' => $jewelleryid

                                );

                                $DB->executedata('d', 'tbljewellerytypestyle', '', $typestyleparams);



                            }

                            $status = 1;

                            $message = $errmsg['delete'];

                } else {

                    $status = 0;

                    $message = $errmsg['reqired'];

                }

                           

                       

            }

            else if ($action == 'deletejewellerymediaimage') {

                $jewelleryid = trim($IISMethods->sanitize($_POST['jewelleryid']));

                $id = trim($IISMethods->sanitize($_POST['id']));

                $type = trim($IISMethods->sanitize($_POST['type']));

                if ($CanListJewelleryForList == 1) {

                    if ($jewelleryid && $id) {

                        $qrychk = "SELECT id,image,video FROM tbljewelleryimages WHERE id=:id AND jewelleryid=:jewelleryid";

                        $params = array(

                            ':jewelleryid' => $jewelleryid,

                            ':id' => $id,

                        );

                        $reschk = $DB->getmenual($qrychk, $params);



                        if (sizeof($reschk) > 0) {

                            $row = $reschk[0];

                            if($type = 1){

                                unlink('../../assets/' . $row['image']);



                            }

                            else if($type = 2)

                            {

                                unlink('../../assets/' . $row['video']);



                            }



                            $extraparams = array(

                                'id' => $id

                            );

                            $DB->executedata('d', 'tbljewelleryimages', '', $extraparams);



                            $qry = "SELECT id,jewelleryid,image,type FROM tbljewelleryimages WHERE jewelleryid=:jewelleryid";

                            $params = array(':jewelleryid' => $jewelleryid);

                            $res = $DB->getmenual($qry, $params);

                            $response['result'] = $res;

                            $status = 1;

                            $message = "File deleted successfully";

                        } else {

                            $status = 0;

                            $message = "You have not permission to delete this message!";

                        }

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            } else if ($action == 'listjewellery') // List jewellery

            {

                $id = $IISMethods->sanitize($_POST['id']); // Use When Update data



                $fltmanagemyjewellery = $IISMethods->sanitize($_POST['fltmanagemyjewellery']); // Manage my jewellery



                $fltsearch = $IISMethods->sanitize($_POST['fltsearch']);    // Search



                $sortbyid = $IISMethods->sanitize($_POST['sortbyid']);    // Sort By 



                $fromprice = $IISMethods->sanitize($_POST['fromprice']);    // From Price

                $toprice = $IISMethods->sanitize($_POST['toprice']);    // To Price





                $fltjewllerytypeid = $_POST['fltjewllerytypeid'];    // Jewellery Type

               

                $fltjewllerytypeid = implode("','", explode(',', $fltjewllerytypeid));

                $flttypestyleid = $_POST['flttypestyleid'];  //Multiple Type Style

                

                if(is_array($flttypestyleid))

                {

                    $flttypestyleid = implode("','", $flttypestyleid);

                }





                $fltmetaltypeid = $_POST['fltmetaltypeid'];  //Multiple Metal Type

                $fltmetaltypeid = implode("','", explode(',', $fltmetaltypeid));

                // $fltmetaltypeid = implode("','", $fltmetaltypeid);



                // $fltgemstoneid = $_POST['fltgemstoneid'];  //Multiple Gemstone

                // $fltgemstoneid = implode("','", $fltgemstoneid);



                $fltconditionid = $_POST['fltconditionid'];  //Multiple condition

                // $fltconditionid = implode("','", $fltconditionid);

                $fltconditionid = implode("','", explode(',', $fltconditionid));



                $fltmetalktid = $_POST['fltmetalktid'];  //Multiple metal kt

                // $fltmetalktid = implode("','", $fltmetalktid);

                $fltmetalktid = implode("','", explode(',', $fltmetalktid));



                $fltjewlleryqualityid = $_POST['fltjewlleryqualityid'];  //Multiple jewllery quality

                // $fltjewlleryqualityid = implode("','", $fltjewlleryqualityid);

                $fltjewlleryqualityid = implode("','", explode(',', $fltjewlleryqualityid));



                $fltjewllerycategoryid = $_POST['fltjewllerycategoryid'];  //Multiple jewllery category

                // $fltjewllerycategoryid = implode("','", $fltjewllerycategoryid);

                $fltjewllerycategoryid = implode("','", explode(',', $fltjewllerycategoryid));



                $fltjewlleryshapeid = $_POST['fltjewlleryshapeid'];  //Multiple Gemstone shape

                // $fltjewlleryshapeid = implode("','", $fltjewlleryshapeid);

                $fltjewlleryshapeid = implode("','", explode(',', $fltjewlleryshapeid));



                $fltgemstonetypeid = $_POST['fltgemstonetypeid'];  //Multiple Gemstone type

                $fltgemstonetypeid = implode("','", explode(',', $fltgemstonetypeid));



                $fltgemstonetreatmentid = $_POST['fltgemstonetreatmentid'];  //Multiple Gemstone Treatment

                $fltgemstonetreatmentid = implode("','", explode(',', $fltgemstonetreatmentid));





                $fromgemsstonesize = $IISMethods->sanitize($_POST['fromgemsstonesize']);    // From Gemstone size

                $togemsstonesize = $IISMethods->sanitize($_POST['togemsstonesize']);    // To Gemstone size





                $fltlabid = $_POST['fltlabid'];  //Multiple Lab

                // $fltlabid = implode("','", $fltlabid);

                $fltlabid = implode("','", explode(',', $fltlabid));



                $fltavailable = $IISMethods->sanitize($_POST['fltavailable']);  //Availability

                $fltavailableformemo = $IISMethods->sanitize($_POST['fltavailableformemo']);  //Availability Memo





                $fltshippingfromid = $_POST['fltshippingfromid'];  //Multiple shippingfrom

                // $fltshippingfromid = implode("','", $fltshippingfromid);

                $fltshippingfromid = implode("','", explode(',', $fltshippingfromid));



                $fltbrandid = $_POST['fltbrandid'];  //Multiple brand

                // $fltbrandid = implode("','", $fltbrandid);

                $fltbrandid = implode("','", explode(',', $fltbrandid));



                $flttermsid = $_POST['flttermsid'];  //Multiple terms

                if(is_array($flttermsid))

                {

                    $flttermsid = implode("','", $flttermsid);

                }



                $showmyfavorite = $IISMethods->sanitize($_POST['showmyfavorite']); // 1 - show favorite





                $sortbycolname = '';

                if ($sortbyid && $fltmanagemyjewellery == 1) {

                    $sortbycolname = $DB->getsortbyjewcolname($sortbyid);

                }



                $listjewellery = new listjewellery();

                $params = array(':imgurl' => $imageurl, ':defaultjewelleryimgurl' => $config->getDefualtJewelleryImageurl(), ':personid' => $uid);



                $query_main = "SELECT `j`.`id`,`j`.`jewelleryno`,`j`.`personid`,`j`.`personname`,`j`.`itemtitle`,`j`.`stock`,`j`.`isavailable`,

                            `j`.`isavailableformemo`,`j`.`description`,`j`.`iteminstock`,`j`.`minimumorder`,`j`.`jewellerytypeid`,`j`.`jewellerytype`,`j`.`typestyleid`,

                            `j`.`typestyle`,`j`.`jewellerycategoryid`,`j`.`jewellerycategory`,`j`.`conditionid`,`j`.`conditionname`,`j`.`brandid`,`j`.`brand`,`j`.`jewelleryqualityid`,

                            `j`.`jewelleryquality`,`j`.`designername`,`j`.`keyworddescription`,`j`.`metaltypeid`,`j`.`metaltype`,`j`.`metalkaratid`,`j`.`metalkarat`,

                            `j`.`jewellerytotalweight`,`j`.`suppliercomment`,`j`.`size`,`j`.`ringsize`,`j`.`unpublished`,`j`.`sharable`,`j`.`ownstockinventory`,

                            `j`.`entry_uid`,`j`.`entry_date`,`j`.`update_uid`,`j`.`update_date`,`j`.`timestamp`,`j`.`maxid`,`j`.`seriesid`,`j`.`isactive`,`j`.`minprice`,`j`.`maxprice`,ifnull(`j`.`jewelleryimglink`,'') AS jewelleryimglink,ifnull(`j`.`jewelleryvideolink`,'') AS jewelleryvideolink,

                            pm.cityname,pm.statename,pm.countryname,jtm.isringsize,

                            IFNULL((SELECT CONCAT(:imgurl,image) FROM tbljewelleryimages ji WHERE ji.jewelleryid=j.id ORDER BY ji.timestamp DESC LIMIT 1),case when(ifnull(`j`.`jewelleryimglink`,'')<>'') THEN `j`.`jewelleryimglink` ELSE :defaultjewelleryimgurl END) AS imgurl,

                            IFNULL((SELECT CONCAT(:imgurl,video) FROM tbljewelleryimages ji WHERE ji.jewelleryid=j.id ORDER BY ji.timestamp DESC LIMIT 1),case when(ifnull(`j`.`jewelleryvideolink`,'')<>'') THEN `j`.`jewelleryvideolink` ELSE :defaultjewelleryimgurl END) AS videourl,

                            

                            IFNULL((SELECT COUNT(jf.id) FROM tbljewelleryfavorite jf WHERE jf.jewelleryid=j.id AND jf.personid=:personid),0) AS ismyfavoriteitem,

                            CASE WHEN(j.personid<>'" . $uid . "') THEN 1 ELSE 0 END AS canresponse

                            FROM `tbljewellery` `j`

                            inner join tblpersonmaster pm on pm.id=j.personid

                            inner join tbljewelrytypemaster jtm on jtm.id = j.jewellerytypeid



                            WHERE 1=1";



                if ($id) {

                    $query_main .= " AND j.id=:id";

                    $params[':id'] = $id;

                }



                if ($fltmanagemyjewellery) // Manage my jewellery

                {

                    $query_main .= " AND j.personid=:personid";

                    $params[':personid'] = $uid;

                } else {

                    // $query_main .= " AND j.isactive=1 ";

                    if (!$id) {

                        $query_main .= " AND j.isactive=1 AND ifnull(j.unpublished,0)=1";

                    }

                }



                if ($showmyfavorite == 1)  // show favorite

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewelleryfavorite WHERE jewelleryid=j.id AND personid=:personid1),0)>0)";

                    $params[':personid1'] = $uid;

                }



                if ($fltsearch)   // Search

                {

                    $query_main .= " AND (j.jewelleryno like :jewellerynofilter 

                                    OR j.personname like :personnamefilter 

                                    OR j.itemtitle like :itemtitlefilter 

                                    OR j.stock like :stockfilter 

                                    OR j.jewellerytype like :jewellerytypefilter 

                                    OR j.typestyle like :typestylefilter 

                                    OR j.jewellerycategory like :jewellerycategoryfilter 

                                    OR j.conditionname like :conditionnamefilter 

                                    OR j.brand like :brandfilter 

                                    OR j.jewelleryquality like :jewelleryqualityfilter 

                                    OR j.jewellerytotalweight like :jewellerytotalweightfilter

                                    OR j.size like :sizefilter

                                    OR j.ringsize like :ringsizefilter

                                    )";

                    $params[':jewellerynofilter'] = '%' . $fltsearch . '%';

                    $params[':personnamefilter'] = '%' . $fltsearch . '%';

                    $params[':itemtitlefilter'] = '%' . $fltsearch . '%';

                    $params[':stockfilter'] = '%' . $fltsearch . '%';

                    $params[':jewellerytypefilter'] = '%' . $fltsearch . '%';

                    $params[':typestylefilter'] = '%' . $fltsearch . '%';

                    $params[':jewellerycategoryfilter'] = '%' . $fltsearch . '%';

                    $params[':conditionnamefilter'] = '%' . $fltsearch . '%';

                    $params[':brandfilter'] = '%' . $fltsearch . '%';

                    $params[':jewelleryqualityfilter'] = '%' . $fltsearch . '%';

                    $params[':jewellerytotalweightfilter'] = '%' . $fltsearch . '%';

                    $params[':sizefilter'] = '%' . $fltsearch . '%';

                    $params[':ringsizefilter'] = '%' . $fltsearch . '%';

                }



                if ($fltjewllerytypeid)  // Jewellery Type

                {

                    $query_main .= " AND `j`.`jewellerytypeid` IN ('" . $fltjewllerytypeid . "')";

                    // $params[':jewellerytypeid'] = $fltjewllerytypeid;

                }



                if ($flttypestyleid)  // Type Style

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerytypestyle WHERE jewelleryid=j.id AND typestyleid IN ('" . $flttypestyleid . "')),0)>0)";

                }



                if ($fltmetaltypeid)  // Metal Type

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerymetaltype WHERE jewelleryid=j.id AND metaltypeid IN ('" . $fltmetaltypeid . "')),0)>0)";

                }





                if ($fltgemstoneid)  // Gemstone

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerygemstones WHERE jewelleryid=j.id AND gemstonetypeid IN ('" . $fltgemstoneid . "')),0)>0)";

                }



                if ($fromprice && $toprice) // Price - From/To

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerypricelocation WHERE jewelleryid=j.id AND price BETWEEN :fromprice AND :toprice),0)>0)";

                    $params[':fromprice'] = $fromprice;

                    $params[':toprice'] = $toprice;

                }



                if ($fltconditionid) // Condition

                {

                    $query_main .= " AND `j`.`conditionid` IN ('" . $fltconditionid . "')";

                }



                if ($fltmetalktid) // Metal Kt

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerymetalkarat WHERE jewelleryid=j.id AND metalkaratid IN ('" . $fltmetalktid . "')),0)>0)";

                }



                if ($fltjewlleryqualityid)   //jewllery quality

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewelleryquality WHERE jewelleryid=j.id AND qualityid IN ('" . $fltjewlleryqualityid . "')),0)>0)";

                }



                if ($fltjewllerycategoryid)   //jewllery quality

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerycategory WHERE jewelleryid=j.id AND categoryid IN ('" . $fltjewllerycategoryid . "')),0)>0)";

                }



                if ($fltjewlleryshapeid)   //jewllery shape

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerygemstones WHERE jewelleryid=j.id AND shapeid IN ('" . $fltjewlleryshapeid . "')),0)>0)";

                }



                if ($fltgemstonetypeid)   //gemstone type

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerygemstones WHERE jewelleryid=j.id AND gemstonetypeid IN ('" . $fltgemstonetypeid . "')),0)>0)";

                }



                if ($fltgemstonetreatmentid)   //gemstone treatment

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerytreatment WHERE jewelleryid=j.id AND treatmentid IN ('" . $fltgemstonetreatmentid . "')),0)>0)";

                }



                if ($fromgemsstonesize && $togemsstonesize) // Gemstone size From/To

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerygemstones WHERE jewelleryid=j.id AND caratweight BETWEEN :fromgemsstonesize AND :togemsstonesize),0)>0)";

                    $params[':fromgemsstonesize'] = $fromgemsstonesize;

                    $params[':togemsstonesize'] = $togemsstonesize;

                }



                if ($fltlabid) {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerygemstones WHERE jewelleryid=j.id AND labid IN ('" . $fltlabid . "')),0)>0)";

                }



                if ($fltavailable == 1) // availability

                {

                    $query_main .= " AND `j`.`isavailable`=1";

                }

                if ($fltavailableformemo == 1) // availability memo

                {

                    $query_main .= " AND `j`.`isavailableformemo`=1";

                }



                if ($fltshippingfromid) // shippingfrom

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewellerypricelocation WHERE jewelleryid=j.id AND shippingfromid IN ('" . $fltshippingfromid . "')),0)>0)";

                }



                if ($fltbrandid) // Brand

                {

                    $query_main .= " AND `j`.`brandid` IN ('" . $fltbrandid . "')";

                }



                if ($flttermsid) // terms

                {

                    $query_main .= " AND (IFNULL((SELECT COUNT(id) FROM tbljewelleryterms WHERE jewelleryid=j.id AND termsid IN ('" . $flttermsid . "')),0)>0)";

                }



                $query_extra .= " GROUP BY j.id";



                if ($fltmanagemyjewellery == 1) {

                    if ($sortbycolname != '') {

                        $query_extra .= " ORDER BY $sortbycolname asc";

                    } else {

                        $query_extra .= " ORDER BY j.timestamp desc";

                    }

                } else {

                    if ($sortbyid == 1) { // Newest to Oldest

                        $query_extra .= " ORDER BY j.timestamp desc";

                    } else if ($sortbyid == 2) {  // Oldest to Newest

                        $query_extra .= " ORDER BY j.timestamp asc";

                    } else if ($sortbyid == 3) {  //Price : High to low

                        $query_extra .= " ORDER BY j.minprice desc";

                    } else if ($sortbyid == 4) {  //Price : Low to high

                        $query_extra .= " ORDER BY j.minprice asc";

                    } else {

                        $query_extra .= " ORDER BY j.timestamp desc";

                    }

                }

                $query_extra .= " LIMIT $start, $per_page";

                $query = $query_main . $query_extra;



                // echo $query;

                // print_r($params);

                if ($CanListJewelleryForList == 1 || $CanJewellerySearch == 1) {

                    $result_ary = $DB->getmenual($query, $params, 'listjewellery');

                    if (sizeof($result_ary) > 0) {



                        $response['data'] = $result_ary;

                        // print_r($result_ary);



                        for ($i = 0; $i < sizeof($result_ary); $i++) {

                            $ins_id = $result_ary[$i]->getId();

                            $ins_personid = $result_ary[$i]->getpersonid();



                            // jewellery category

                            $listjewellerycategory = new listjewellerycategory();

                            $qryjewellerycategory = "SELECT jc.`id`,jc.`jewelleryid`,jc.`categoryid`,jc.`category`,jc.`entry_uid`,jc.`entry_date`,jc.`timestamp` 

                                                FROM `tbljewellerycategory` jc

                                                WHERE jc.`jewelleryid`=:jewelleryid";

                            $paramjewellerycategory = array(':jewelleryid' => $ins_id);

                            $result_jewellerycategory = $DB->getmenual($qryjewellerycategory, $paramjewellerycategory, 'listjewellerycategory');



                            $result_ary[$i]->sethasjewellerycategory(0);

                            if (sizeof($result_jewellerycategory) > 0) {

                                $result_ary[$i]->sethasjewellerycategory(1);

                                $result_ary[$i]->setjewellerycategorydetail($result_jewellerycategory);

                            }



                            // // jewellery gemstones

                            $listjewellerygemstones = new listjewellerygemstones();

                            $qryjewellerygemstones = "SELECT jg.`id`,jg.`jewelleryid`,jg.`gemstonetypeid`,jg.`gemstonetype`,jg.shapeid,jg.shape,jg.caratweight,jg.labid,jg.lab,jg.labtext,jg.hastreatment,jg.treatmentid,jg.treatment,jg.stones,jg.savanilot,jg.savanilot,jg.`entry_uid`,jg.`entry_date`,jg.`timestamp` 

                                                FROM `tbljewellerygemstones` jg

                                                WHERE jg.`jewelleryid`=:jewelleryid";

                            $paramjewellerygemstones = array(':jewelleryid' => $ins_id);

                            $result_jewellerygemstones = $DB->getmenual($qryjewellerygemstones, $paramjewellerygemstones, 'listjewellerygemstones');



                            $result_ary[$i]->sethasjewellerygemstones(0);

                            if (sizeof($result_jewellerygemstones) > 0) {

                                $result_ary[$i]->sethasjewellerygemstones(1);

                                $result_ary[$i]->setjewellerygemstonesdetail($result_jewellerygemstones);



                                for ($jg = 0; $jg < sizeof($result_jewellerygemstones); $jg++) {

                                    $jg_id = $result_jewellerygemstones[$jg]->getId();

                                    $jg_hastreatment = $result_jewellerygemstones[$jg]->gethastreatment();



                                    if ($jg_hastreatment == 1) {

                                        $listjewellerytreatment = new listjewellerytreatment();

                                        $qryjewellerytreatment = "SELECT jg.`id`,jg.`jewelleryid`,jg.`treatmentid`,jg.`treatment`,jg.`entry_uid`,jg.`entry_date`,jg.`timestamp` 

                                                            FROM `tbljewellerytreatment` jg

                                                            WHERE jg.`jewelleryid`=:jewelleryid AND jg.jewellerygemstoneid=:jewellerygemstoneid";

                                        $paramjewellerytreatment = array(':jewelleryid' => $ins_id, ':jewellerygemstoneid' => $jg_id);

                                        $result_jewellerytreatment = $DB->getmenual($qryjewellerytreatment, $paramjewellerytreatment, 'listjewellerytreatment');

                                        $result_jewellerygemstones[$jg]->setjewellerytreatmentdetail($result_jewellerytreatment);

                                    }

                                }

                            }



                            // jewellery images

                            $listjewelleryimages = new listjewelleryimages();

                            $qryjewelleryimages = "SELECT ji.`id`,ji.`jewelleryid`,CONCAT(:imageurl,ji.`image`) AS image,ji.`imgtype`,ji.type,ji.`entry_uid`,ji.`entry_date`,ji.`timestamp`

                                                FROM `tbljewelleryimages` ji

                                                WHERE ji.`jewelleryid`=:jewelleryid AND ji.type = 1";

                                                // echo $qryjewelleryimages;

                            $paramjewelleryimages = array(':jewelleryid' => $ins_id, ':imageurl' => $imageurl);

                            $result_jewelleryimages = $DB->getmenual($qryjewelleryimages, $paramjewelleryimages, 'listjewelleryimages');



                            $result_ary[$i]->sethasjewelleryimages(0);

                            if (sizeof($result_jewelleryimages) > 0) {

                                $result_ary[$i]->sethasjewelleryimages(1);

                                $result_ary[$i]->setjewelleryimagesdetail($result_jewelleryimages);

                            }





                            // jewellery Video

                            $listjewelleryvideos = new listjewelleryvideos();

                            $qryjewelleryvideos = "SELECT ji.`id`,ji.`jewelleryid`,ji.type,ji.`entry_uid`,ji.`entry_date`,ji.`timestamp`,CONCAT(:imageurl,ji.video) AS video 

                                                FROM `tbljewelleryimages` ji

                                                WHERE ji.`jewelleryid`=:jewelleryid AND ji.type = 2";

                                                // echo $qryjewelleryvideos;

                            $paramjewelleryvideos = array(':jewelleryid' => $ins_id, ':imageurl' => $imageurl);

                            $result_jewelleryvideos = $DB->getmenual($qryjewelleryvideos, $paramjewelleryvideos, 'listjewelleryimages');



                            $result_ary[$i]->sethasjewelleryvideos(0);

                            if (sizeof($result_jewelleryvideos) > 0) {

                                $result_ary[$i]->sethasjewelleryvideos(1);

                                $result_ary[$i]->setjewelleryvideosdetail($result_jewelleryvideos);

                            }







                            // $result_ary[$i]->sethasjewelleryvideos(0);

                            // if (sizeof($result_jewelleryimages) > 0) {

                            //     $result_ary[$i]->sethasjewelleryvideos(1);

                            //     $result_ary[$i]->setjewelleryvideosdetail($result_jewelleryvideos);

                            // }

                            // print_r($result_ary[$i]);





                            // jewellery metal karat

                            $listjewellerymetalkarat = new listjewellerymetalkarat();

                            $qryjewellerymetalkarat = "SELECT jk.`id`,jk.`jewelleryid`,jk.`metalkaratid`,jk.`metalkarat`,jk.`entry_uid`,jk.`entry_date`,jk.`timestamp`

                                                FROM `tbljewellerymetalkarat` jk

                                                WHERE jk.`jewelleryid`=:jewelleryid";

                            $paramjewellerymetalkarat = array(':jewelleryid' => $ins_id);

                            $result_jewellerymetalkarat = $DB->getmenual($qryjewellerymetalkarat, $paramjewellerymetalkarat, 'listjewellerymetalkarat');



                            $result_ary[$i]->sethasjewellerymetalkarat(0);

                            if (sizeof($result_jewellerymetalkarat) > 0) {

                                $result_ary[$i]->sethasjewellerymetalkarat(1);

                                $result_ary[$i]->setjewellerymetalkaratdetail($result_jewellerymetalkarat);

                            }









                            // // jewellery metal type

                            $listjewellerymetaltype = new listjewellerymetaltype();

                            $qryjewellerymetaltype = "SELECT jm.`id`,jm.`jewelleryid`,jm.`metaltypeid`,jm.`metaltype`,jm.`entry_uid`,jm.`entry_date`,jm.`timestamp`

                                                FROM `tbljewellerymetaltype` jm

                                                WHERE jm.`jewelleryid`=:jewelleryid";

                            $paramjewellerymetaltype = array(':jewelleryid' => $ins_id);

                            $result_jewellerymetaltype = $DB->getmenual($qryjewellerymetaltype, $paramjewellerymetaltype, 'listjewellerymetaltype');



                            $result_ary[$i]->sethasjewellerymetaltype(0);

                            if (sizeof($result_jewellerymetaltype) > 0) {

                                $result_ary[$i]->sethasjewellerymetaltype(1);

                                $result_ary[$i]->setjewellerymetaltypedetail($result_jewellerymetaltype);

                            }







                            // // jewellery price location

                            $listjewellerypricelocation = new listjewellerypricelocation();

                            $qryjewellerypricelocation = "SELECT jpl.`id`,jpl.`jewelleryid`,jpl.`shippingfromid`,jpl.`shippingfrom`,jpl.`price`,jpl.`termsid`,jpl.`terms`,jpl.`msrp`,jpl.`deliverytimeindays`,jpl.`entry_uid`,jpl.`entry_date`,jpl.`timestamp` 

                                                FROM `tbljewellerypricelocation` jpl

                                                WHERE jpl.`jewelleryid`=:jewelleryid";

                            $paramjewellerypricelocation = array(':jewelleryid' => $ins_id);

                            $result_jewellerypricelocation = $DB->getmenual($qryjewellerypricelocation, $paramjewellerypricelocation, 'listjewellerypricelocation');



                            $result_ary[$i]->sethasjewellerypricelocation(0);

                            if (sizeof($result_jewellerypricelocation) > 0) {

                                $result_ary[$i]->sethasjewellerypricelocation(1);

                                $result_ary[$i]->setjewellerypricelocationdetail($result_jewellerypricelocation);



                                for ($jpl = 0; $jpl < sizeof($result_jewellerypricelocation); $jpl++) {

                                    $jpl_id = $result_jewellerypricelocation[$jpl]->getId();





                                    $listjewelleryterms = new listjewelleryterms();

                                    $qryjewelleryterms = "SELECT jpl.`id`,jpl.`jewelleryid`,jpl.jewellerypricelocid,jpl.`termsid`,jpl.`terms`,jpl.`entry_uid`,jpl.`entry_date`,jpl.`timestamp` 

                                                        FROM `tbljewelleryterms` jpl

                                                        WHERE jpl.`jewelleryid`=:jewelleryid AND jpl.jewellerypricelocid=:jewellerypricelocid";

                                    $paramjewelleryterms = array(':jewelleryid' => $ins_id, ':jewellerypricelocid' => $jpl_id);

                                    $result_jewelleryterms = $DB->getmenual($qryjewelleryterms, $paramjewelleryterms, 'listjewelleryterms');



                                    $result_jewellerypricelocation[$jpl]->sethasjewelleryterms(0);

                                    if (sizeof($result_jewelleryterms) > 0) {

                                        $result_jewellerypricelocation[$jpl]->sethasjewelleryterms(1);

                                        $result_jewellerypricelocation[$jpl]->setjewellerytermsdetail($result_jewelleryterms);

                                    }

                                }

                            }





                            // //jewellery quality

                            $listjewelleryquality = new listjewelleryquality();

                            $qryjewelleryquality = "SELECT jq.`id`,jq.`jewelleryid`,jq.`qualityid`,jq.`quality`,jq.`entry_uid`,jq.`entry_date`,jq.`timestamp`

                                                FROM `tbljewelleryquality` jq

                                                WHERE jq.`jewelleryid`=:jewelleryid";

                            $paramjewelleryquality = array(':jewelleryid' => $ins_id);

                            $result_jewelleryquality = $DB->getmenual($qryjewelleryquality, $paramjewelleryquality, 'listjewelleryquality');



                            $result_ary[$i]->sethasjewelleryquality(0);

                            if (sizeof($result_jewelleryquality) > 0) {

                                $result_ary[$i]->sethasjewelleryquality(1);

                                $result_ary[$i]->setjewelleryqualitydetail($result_jewelleryquality);

                            }



                            // jewellery type style

                            $listjewellerytypestyle = new listjewellerytypestyle();

                            $qryjewellerytypestyle = "SELECT jts.`id`,jts.`jewelleryid`,jts.`typestyleid`,jts.`typestyle`,jts.`entry_uid`,jts.`entry_date`,jts.`timestamp`

                                                FROM `tbljewellerytypestyle` jts

                                                WHERE jts.`jewelleryid`=:jewelleryid";

                            $paramjewellerytypestyle = array(':jewelleryid' => $ins_id);

                            $result_jewellerytypestyle = $DB->getmenual($qryjewellerytypestyle, $paramjewellerytypestyle, 'listjewellerytypestyle');



                            $result_ary[$i]->sethasjewellerytypestyle(0);

                            if (sizeof($result_jewellerytypestyle) > 0) {

                                $result_ary[$i]->sethasjewellerytypestyle(1);

                                $result_ary[$i]->setjewellerytypestyledetail($result_jewellerytypestyle);

                            }



                            // // Seller Details



                            $sellerdetails = new sellerdetails();

                            $qryperson = "SELECT id,personname,email,companyname,address,additionaladdress,statename,cityname,pincode,emergencypersonname as refname1,emergencypersonname1 as refname2,countryname,businesstype,ifnull(businessphoneno,'') AS businessphoneno,ifnull(businesswebsite,'') AS businesswebsite,businesscompanyno,

                                        case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,phonecodeid,countrycode,phonecode,savaniid 

                                        FROM tblpersonmaster 

                                        WHERE id=:id";

                            $paramperson = array(':id' => $ins_personid, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imageurl);

                            $resperson = $DB->getmenual($qryperson, $paramperson, 'sellerdetails');

                            $result_ary[$i]->sethasperson(0);

                            if (sizeof($resperson) > 0) {

                                $result_ary[$i]->sethasperson(1);

                                $result_ary[$i]->setpersondetail($resperson);

                            }

                        }

                        // $response['nextpage'] = $nextpage;

                        // if (sizeof($result_ary) == $per_page) {

                        //     $showdata = 1;

                        //     $showentries = ($nextpage * $per_page);

                        // } else {

                        //     $showdata = 0;

                        //     $showentries = (($nextpage - 1) * ($per_page)) + sizeof($result_ary);

                        // }

                        // $response['loadmore'] = $showdata;

                        // $response['datasize'] = sizeof($result_ary);

                        // $response['showentries'] = $showentries;

                        $common_listdata=$result_ary;

                        $res = $DB->getmenual($query_main, $params);

                        $totaljewellery = sizeof($res);

                        $response['totaljewellery'] = $totaljewellery;

                        // print_r($response);

                        $status = 1;

                        $message = $errmsg['success'];

                    } else {

                        if ($page <= 0 && sizeof($result_ary) <= 0) {

                            $message = $errmsg['nojewelleryfound'];

                        } else {

                            $status = 1;

                            $message = $errmsg['success'];

                        }

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }



                $qrydt = "SELECT DATE_FORMAT(entry_date,'%d/%m/%Y %h:%i %p') AS entry_date,uid,id FROM tbluserwisediamonjewelrylog WHERE typeid=:typeid AND uid=:uid ORDER BY entry_date DESC LIMIT 1";

                $paramsdt = array(':typeid' => 2, ':uid' => $uid);

                $resdt = $DB->getmenual($qrydt, $paramsdt);

                $rowdt = $resdt[0];

                $response['lastupdateddate'] = (string)$rowdt['entry_date'];

                $response['lastupdateddateid'] = $rowdt['id'];





            }  else if ($action == 'jewellerylastupdateddatechange') {

                $id = trim($IISMethods->sanitize($_POST['id']));



                if ($id) {

                    $qrychk = "SELECT id FROM tbljewellery WHERE isactive=1 AND entry_uid=:uid order by entry_date desc LIMIT 1 ";

                    $params = array(

                        ':uid' => $uid,

                    );

                    $reschk = $DB->getmenual($qrychk, $params);



                    if (sizeof($reschk) > 0) {

                        $DB->userwisediamonjewelrylog(2, $uid);

                        $row = $reschk[0];

                        $data = array(

                            'update_date' => $IISMethods->getdatetime()

                        );

                        $extraparams = array(

                            'id' => $row['id']

                        );

                        $DB->executedata('u', 'tbljewellery', $data, $extraparams);

                        $status = 1;

                        $message = "Last Updated Date Update Successfully";

                    } else {

                        $qrychk = "SELECT id FROM tbljewellery WHERE entry_uid=:uid  ";

                        $params = array(

                            ':uid' => $uid,

                        );

                        $reschk = $DB->getmenual($qrychk, $params);

                        if (sizeof($reschk) > 0) {

                            $DB->userwisediamonjewelrylog(2, $uid);

                            $data = array(

                                'update_date' => $IISMethods->getdatetime(),

                                'update_uid' => $uid,

                                'isactive' => 1,

                            );

                            $extraparams = array(

                                'entry_uid' => $uid

                            );

                            $DB->executedata('u', 'tbljewellery', $data, $extraparams);

                            $status = 1;

                            $message = "Last Updated Date Update Successfully";

                        } else {

                            $status = 0;

                            $message = "No Diamond Found!";

                        }

                    }

                }

            } else if ($action == 'getitenminmaxprice') {

                $qryminmaxprice = "SELECT 

                IFNULL((SELECT MIN(j.minprice) FROM `jewellerylist` j WHERE j.isactive=1),0) AS minprice,

                IFNULL((SELECT MAX(j.minprice) FROM `jewellerylist` j WHERE j.isactive=1),0) AS maxprice";

                $param = array();

                $resminmaxprice = $DB->getmenual($qryminmaxprice, $param);

                $rowminmaxprice = $resminmaxprice[0];

                $response['minprice'] = (float)$rowminmaxprice['minprice'];

                $response['maxprice'] = (float)$rowminmaxprice['maxprice'];

                $status = 1;

                $message = $errmsg['success'];

            } else if ($action == 'addjewellerytofavorite') {

                $isselect = $IISMethods->sanitize($_POST['isselect']);

                $jewelleryid = explode(",", $_POST['jewelleryid']);

                if ($isselect == 1) {

                    $jewelleryid = $_POST['jewelleryidarr'];

                }

                $datetime = $IISMethods->getdatetime();

                if ($CanJewellerySearch == 1) {

                    if (sizeof($jewelleryid) > 0) {

                        if ($isselect == 1) {



                            $itemtitle = '';

                            for ($j = 0; $j < sizeof($jewelleryid); $j++) {

                                $jid = $jewelleryid[$j];



                                $qryjewl = "SELECT itemtitle FROM tbljewellery WHERE id=:jewelleryid";

                                $paramjewl = array(':jewelleryid' => $jid);

                                $resjewl = $DB->getmenual($qryjewl, $paramjewl);



                                $qryjewllery = "SELECT id FROM tbljewelleryfavorite WHERE jewelleryid=:jewelleryid AND personid=:personid";

                                $paramjewllery = array(':jewelleryid' => $jid, ':personid' => $uid);

                                $resjewllery = $DB->getmenual($qryjewllery, $paramjewllery);

                                if (sizeof($resjewllery) > 0) {

                                } else {

                                    $unqid = $IISMethods->generateuuid();

                                    $insqry['id'] = $unqid;

                                    $insqry['jewelleryid'] = $jid;

                                    $insqry['personid'] = $uid;

                                    $insqry['timestamp'] = $datetime;

                                    $insqry['entry_uid'] = $uid;

                                    $insqry['entry_date'] = $datetime;





                                    $DB->executedata('i', 'tbljewelleryfavorite', $insqry, '');



                                    $itemtitle .= $resjewl[0]['itemtitle'];

                                    if (sizeof($jewelleryid) != $j) {

                                        $itemtitle .= ',';

                                    }

                                }

                            }

                            if ($itemtitle != '') {

                                $status = 1;

                                $message = str_replace("#jewelleryname#", $itemtitle, $errmsg['jewelleryaddfavorite']);

                            }

                        } else {



                            $qryjewl = "SELECT itemtitle FROM tbljewellery WHERE id=:jewelleryid";

                            $paramjewl = array(':jewelleryid' => $_POST['jewelleryid']);

                            $resjewl = $DB->getmenual($qryjewl, $paramjewl);





                            $qryjewllery = "SELECT id FROM tbljewelleryfavorite WHERE jewelleryid=:jewelleryid AND personid=:personid";

                            $paramjewllery = array(':jewelleryid' => $_POST['jewelleryid'], ':personid' => $uid);

                            $resjewllery = $DB->getmenual($qryjewllery, $paramjewllery);

                            if (sizeof($resjewllery) > 0) {

                                $paramsfavorite = array(

                                    'jewelleryid' => $_POST['jewelleryid'],

                                    'personid' => $uid,

                                );

                                $DB->executedata('d', 'tbljewelleryfavorite', '', $paramsfavorite);

                                $status = 1;

                                $message = str_replace("#jewelleryname#", $resjewl[0]['itemtitle'], $errmsg['jewelleryremovefavorite']);

                                $isaddtofavorite = 0;

                            } else {

                                $unqid = $IISMethods->generateuuid();

                                $insqry['id'] = $unqid;

                                $insqry['jewelleryid'] = $_POST['jewelleryid'];

                                $insqry['personid'] = $uid;

                                $insqry['timestamp'] = $datetime;

                                $insqry['entry_uid'] = $uid;

                                $insqry['entry_date'] = $datetime;

                                $DB->executedata('i', 'tbljewelleryfavorite', $insqry, '');

                                $status = 1;

                                $message = str_replace("#jewelleryname#", $resjewl[0]['itemtitle'], $errmsg['jewelleryaddfavorite']);

                                $isaddtofavorite = 1;

                            }

                            $response['isaddtofavorite'] = (int)$isaddtofavorite;

                        }

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            } else if ($action == 'uploadjewellerycsv_old') {

                $filename = $_FILES['csvfile']['tmp_name'];

                if ($CanListJewelleryXL == 1) {

                    if ($_FILES["csvfile"]["size"] > 0) {

                        $file = fopen($filename, "r");

                        $i = 0;

                        $j = 0;

                        $cnt_ins = 0;

                        $cnt_upd = 0;

                        $cnt_err = 0;

                        while (($itemData = fgetcsv($file, 10000, ",")) !== FALSE) {

                            if ($i > 0) {



                                /**********Product Description**************/

                                $itemtitle = trim($itemData[0]);

                                $stock = trim($itemData[1]);

                                $isavailable = trim($itemData[2]);

                                $isavailableformemo = trim($itemData[3]);

                                $description = trim($itemData[4]);



                                /*************Price & Location - Multiple Block For Each*************/



                                $shippingfrom = trim($itemData[5]);

                                $price = trim($itemData[6]);

                                $terms = trim($itemData[7]);  // multiple select

                                $msrp = trim($itemData[8]);

                                $deliverytimeindays = trim($itemData[9]); // Days



                                /* ****************************************************** */



                                $iteminstock = trim($itemData[10]);

                                $minimumorder = trim($itemData[11]);



                                /***********Product Information**************/

                                $jewellerytype = trim($itemData[12]);

                                $typestyle = trim($itemData[13]); // Multiple

                                $jewellerycategory = trim($itemData[14]); // Multiple

                                $condition = trim($itemData[15]);

                                $brand = trim($itemData[16]);

                                $jewelleryquality = trim($itemData[17]); // Multiple

                                $designername = trim($itemData[18]);

                                $keyworddescription = trim($itemData[19]); // Comma Seprated



                                /***********Metal**************/

                                $metaltype = trim($itemData[20]);   // Multiple

                                $metalkarat = trim($itemData[21]);  // Multiple

                                $jewellerytotalweight = trim($itemData[22]);



                                /* ***************** Gemstones - Multiple Block For Each******************** */



                                $gemstonetype = trim($itemData[23]);

                                $shape = trim($itemData[24]);

                                $caratweight = trim($itemData[25]);

                                $lab = trim($itemData[26]);

                                $labtext = trim($itemData[27]);

                                $hastreatment = trim($itemData[28]);

                                $treatment = trim($itemData[29]); // Multiple

                                $stone = trim($itemData[30]);

                                $savanilot = trim($itemData[31]);



                                $suppliercomment = trim($itemData[32]);

                                $size = trim($itemData[33]);

                                $ringsize = trim($itemData[34]);



                                /***********Visibility**************/

                                $unpublished = trim($itemData[35]);

                                $shareable = trim($itemData[36]);

                                $ownstockinventory = trim($itemData[37]);





                                $datetime = date('Y-m-d H:i:s');



                                if ($i == 1) {

                                    $qryjewellery = "SELECT id FROM tbljewellery WHERE personid=:personid";

                                    $paramjewellery = array(':personid' => $uid);

                                    $resjewellery = $DB->getmenual($qryjewellery, $paramjewellery);

                                    if (sizeof($resjewellery) > 0) {

                                        for ($dm = 0; $dm < sizeof($resjewellery); $dm++) {

                                            $rowdm = $resjewellery[$dm];

                                            $jewelleryid = $rowdm['id'];



                                            $params = array(

                                                'id' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellery', '', $params);

                                            $DB->userwisediamonjewelrylog(2, $uid);

                                            $categoryparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerycategory', '', $categoryparams);



                                            $gemstonesparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);



                                            $metalkaratparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerymetalkarat', '', $metalkaratparams);



                                            $metaltypeparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerymetaltype', '', $metaltypeparams);



                                            $pricelocationparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerypricelocation', '', $pricelocationparams);



                                            $qualityparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewelleryquality', '', $qualityparams);



                                            $termsparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);



                                            $treatmentparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);



                                            $typestyleparams = array(

                                                'jewelleryid' => $jewelleryid

                                            );

                                            $DB->executedata('d', 'tbljewellerytypestyle', '', $typestyleparams);

                                        }

                                    }

                                }



                                $shippingfromid = '';

                                if ($shippingfrom) {

                                    $qryshippingfrom = "SELECT id FROM tblcountrymaster WHERE country=:shippingfrom";

                                    $paramshippingfrom = array(':shippingfrom' => $shippingfrom);

                                    $resshippingfrom = $DB->getmenual($qryshippingfrom, $paramshippingfrom);

                                    if (sizeof($resshippingfrom) > 0) {

                                        $rowshippingfrom = $resshippingfrom[0];

                                        $shippingfromid = $rowshippingfrom['id'];

                                    } else {

                                        $shippingfromid = $IISMethods->generateuuid();



                                        $insqryshippingfrom['id'] = $shippingfromid;

                                        $insqryshippingfrom['country'] = $shippingfrom;

                                        $insqryshippingfrom['timestamp'] = $datetime;

                                        $insqryshippingfrom['entry_uid'] = $uid;

                                        $insqryshippingfrom['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tblcountrymaster', $insqryshippingfrom, '');

                                    }

                                }



                                $strtermsid = '';

                                if ($terms) {

                                    $exterms = explode(',', $terms);

                                    if (sizeof($exterms) > 0) {

                                        for ($tr = 0; $tr < sizeof($exterms); $tr++) {

                                            $termsname = $exterms[$tr];



                                            $qryterms = "SELECT id FROM tbltermsmaster WHERE name=:terms";

                                            $paramterms = array(':terms' => $termsname);

                                            $resterms = $DB->getmenual($qryterms, $paramterms);

                                            if (sizeof($resterms) > 0) {

                                                $rowterms = $resterms[0];

                                                $termsid = $rowterms['id'];

                                            } else {

                                                $termsid = $IISMethods->generateuuid();



                                                $insqryterms['id'] = $termsid;

                                                $insqryterms['name'] = $termsname;

                                                $insqryterms['isactive'] = 1;

                                                $insqryterms['timestamp'] = $datetime;

                                                $insqryterms['entry_uid'] = $uid;

                                                $insqryterms['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tbltermsmaster', $insqryterms, '');

                                            }

                                            $strtermsid .= $termsid;

                                            if (sizeof($exterms) != $tr) {

                                                $strtermsid .= ',';

                                            }

                                        }

                                    }

                                }



                                $jewellerytypeid = '';

                                if ($jewellerytype) {

                                    $qryjewellerytype = "SELECT id FROM tbljewelrytypemaster WHERE name=:jewellerytype";

                                    $paramjewellerytype = array(':jewellerytype' => $jewellerytype);

                                    $resjewellerytype = $DB->getmenual($qryjewellerytype, $paramjewellerytype);

                                    if (sizeof($resjewellerytype) > 0) {

                                        $rowjewellerytype = $resjewellerytype[0];

                                        $jewellerytypeid = $rowjewellerytype['id'];

                                    } else {

                                        $jewellerytypeid = $IISMethods->generateuuid();



                                        $insqryjewellerytype['id'] = $jewellerytypeid;

                                        $insqryjewellerytype['name'] = $jewellerytype;

                                        $insqryjewellerytype['isactive'] = 1;

                                        $insqryjewellerytype['timestamp'] = $datetime;

                                        $insqryjewellerytype['entry_uid'] = $uid;

                                        $insqryjewellerytype['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tbljewelrytypemaster', $insqryjewellerytype, '');

                                    }

                                }





                                $strtypestyleid = '';

                                if ($typestyle) {

                                    $extypestyle = explode(',', $typestyle);

                                    if (sizeof($extypestyle) > 0) {

                                        for ($ts = 0; $ts < sizeof($extypestyle); $ts++) {

                                            $typestylename = $extypestyle[$ts];



                                            $qrytypestyle = "SELECT id FROM tbltypestylemaster WHERE name=:typestyle";

                                            $paramtypestyle = array(':typestyle' => $typestylename);

                                            $restypestyle = $DB->getmenual($qrytypestyle, $paramtypestyle);

                                            if (sizeof($restypestyle) > 0) {

                                                $rowtypestyle = $restypestyle[0];

                                                $typestyleid = $rowtypestyle['id'];

                                            } else {

                                                $typestyleid = $IISMethods->generateuuid();



                                                $insqrytypestyle['id'] = $typestyleid;

                                                $insqrytypestyle['jewelrytypeid'] = $jewellerytypeid;

                                                $insqrytypestyle['name'] = $typestylename;

                                                $insqrytypestyle['isactive'] = 1;

                                                $insqrytypestyle['timestamp'] = $datetime;

                                                $insqrytypestyle['entry_uid'] = $uid;

                                                $insqrytypestyle['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tbltypestylemaster', $insqrytypestyle, '');

                                            }

                                            $strtypestyleid .= $typestyleid;

                                            if (sizeof($extypestyle) != $ts) {

                                                $strtypestyleid .= ',';

                                            }

                                        }

                                    }

                                }



                                $strjewellerycategoryid = '';

                                if ($jewellerycategory) {

                                    $exjewellerycategory = explode(',', $jewellerycategory);

                                    if (sizeof($exjewellerycategory) > 0) {

                                        for ($jc = 0; $jc < sizeof($exjewellerycategory); $jc++) {

                                            $jewellerycategoryname = $exjewellerycategory[$jc];



                                            $qryjewellerycategory = "SELECT id FROM tbljewelrycategorymaster WHERE name=:jewellerycategory";

                                            $paramjewellerycategory = array(':jewellerycategory' => $jewellerycategoryname);

                                            $resjewellerycategory = $DB->getmenual($qryjewellerycategory, $paramjewellerycategory);

                                            if (sizeof($resjewellerycategory) > 0) {

                                                $rowjewellerycategory = $resjewellerycategory[0];

                                                $jewellerycategoryid = $rowjewellerycategory['id'];

                                            } else {

                                                $jewellerycategoryid = $IISMethods->generateuuid();



                                                $insqryjewellerycategory['id'] = $jewellerycategoryid;

                                                $insqryjewellerycategory['name'] = $jewellerycategoryname;

                                                $insqryjewellerycategory['isactive'] = 1;

                                                $insqryjewellerycategory['timestamp'] = $datetime;

                                                $insqryjewellerycategory['entry_uid'] = $uid;

                                                $insqryjewellerycategory['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tbljewelrycategorymaster', $insqryjewellerycategory, '');

                                            }

                                            $strjewellerycategoryid .= $jewellerycategoryid;

                                            if (sizeof($exjewellerycategory) != $jc) {

                                                $strjewellerycategoryid .= ',';

                                            }

                                        }

                                    }

                                }



                                $conditionid = '';

                                if ($condition) {

                                    $qrycondition = "SELECT id FROM tblconditionmaster WHERE name=:condition";

                                    $paramcondition = array(':condition' => $condition);

                                    $rescondition = $DB->getmenual($qrycondition, $paramcondition);

                                    if (sizeof($rescondition) > 0) {

                                        $rowcondition = $rescondition[0];

                                        $conditionid = $rowcondition['id'];

                                    } else {

                                        $conditionid = $IISMethods->generateuuid();



                                        $insqrycondition['id'] = $conditionid;

                                        $insqrycondition['name'] = $condition;

                                        $insqrycondition['isactive'] = 1;

                                        $insqrycondition['timestamp'] = $datetime;

                                        $insqrycondition['entry_uid'] = $uid;

                                        $insqrycondition['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tblconditionmaster', $insqrycondition, '');

                                    }

                                }



                                $brandid = '';

                                if ($brand) {

                                    $qrybrand = "SELECT id FROM tblbrandmaster WHERE title=:brand";

                                    $parambrand = array(':brand' => $brand);

                                    $resbrand = $DB->getmenual($qrybrand, $parambrand);

                                    if (sizeof($resbrand) > 0) {

                                        $rowbrand = $resbrand[0];

                                        $brandid = $rowbrand['id'];

                                    } else {

                                        $brandid = $IISMethods->generateuuid();



                                        $insqrybrand['id'] = $brandid;

                                        $insqrybrand['title'] = $brand;

                                        $insqrybrand['isactive'] = 1;

                                        $insqrybrand['timestamp'] = $datetime;

                                        $insqrybrand['entry_uid'] = $uid;

                                        $insqrybrand['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tblbrandmaster', $insqrybrand, '');

                                    }

                                }



                                $strjewelleryqualityid = '';

                                if ($jewelleryquality) {

                                    $exjewelleryquality = explode(',', $jewelleryquality);

                                    if (sizeof($exjewelleryquality) > 0) {

                                        for ($jq = 0; $jq < sizeof($exjewelleryquality); $jq++) {

                                            $jewelleryqualityname = $exjewelleryquality[$jq];



                                            $qryjewelleryquality = "SELECT id FROM tbljewelryqualitymaster WHERE name=:jewelleryquality";

                                            $paramjewelleryquality = array(':jewelleryquality' => $jewelleryqualityname);

                                            $resjewelleryquality = $DB->getmenual($qryjewelleryquality, $paramjewelleryquality);

                                            if (sizeof($resjewelleryquality) > 0) {

                                                $rowjewelleryquality = $resjewelleryquality[0];

                                                $jewelleryqualityid = $rowjewelleryquality['id'];

                                            } else {

                                                $jewelleryqualityid = $IISMethods->generateuuid();



                                                $insqryjewelleryquality['id'] = $jewelleryqualityid;

                                                $insqryjewelleryquality['name'] = $jewelleryqualityname;

                                                $insqryjewelleryquality['isactive'] = 1;

                                                $insqryjewelleryquality['timestamp'] = $datetime;

                                                $insqryjewelleryquality['entry_uid'] = $uid;

                                                $insqryjewelleryquality['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tbljewelryqualitymaster', $insqryjewelleryquality, '');

                                            }

                                            $strjewelleryqualityid .= $jewelleryqualityid;

                                            if (sizeof($exjewelleryquality) != $jq) {

                                                $strjewelleryqualityid .= ',';

                                            }

                                        }

                                    }

                                }



                                $strmetaltypeid = '';

                                if ($metaltype) {

                                    $exmetaltype = explode(',', $metaltype);

                                    if (sizeof($exmetaltype) > 0) {

                                        for ($mt = 0; $mt < sizeof($exmetaltype); $mt++) {

                                            $metaltypename = $exmetaltype[$mt];



                                            $qrymetaltype = "SELECT id FROM tblmetaltypemaster WHERE name=:metaltype";

                                            $parammetaltype = array(':metaltype' => $metaltypename);

                                            $resmetaltype = $DB->getmenual($qrymetaltype, $parammetaltype);

                                            if (sizeof($resmetaltype) > 0) {

                                                $rowmetaltype = $resmetaltype[0];

                                                $metaltypeid = $rowmetaltype['id'];

                                            } else {

                                                $metaltypeid = $IISMethods->generateuuid();



                                                $insqrymetaltype['id'] = $metaltypeid;

                                                $insqrymetaltype['name'] = $metaltypename;

                                                $insqrymetaltype['isactive'] = 1;

                                                $insqrymetaltype['timestamp'] = $datetime;

                                                $insqrymetaltype['entry_uid'] = $uid;

                                                $insqrymetaltype['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tblmetaltypemaster', $insqrymetaltype, '');

                                            }

                                            $strmetaltypeid .= $metaltypeid;

                                            if (sizeof($exmetaltype) != $mt) {

                                                $strmetaltypeid .= ',';

                                            }

                                        }

                                    }

                                }







                                $strmetalkaratid = '';

                                if ($metalkarat) {

                                    $exmetalkarat = explode(',', $metalkarat);

                                    if (sizeof($exmetalkarat) > 0) {

                                        for ($mk = 0; $mk < sizeof($exmetalkarat); $mk++) {

                                            $metalkaratname = $exmetalkarat[$mk];



                                            $qrymetalkarat = "SELECT id FROM tblmetalcaratmaster WHERE name=:metalkarat";

                                            $parammetalkarat = array(':metalkarat' => $metalkaratname);

                                            $resmetalkarat = $DB->getmenual($qrymetalkarat, $parammetalkarat);

                                            if (sizeof($resmetalkarat) > 0) {

                                                $rowmetalkarat = $resmetalkarat[0];

                                                $metalkaratid = $rowmetalkarat['id'];

                                            } else {

                                                $metalkaratid = $IISMethods->generateuuid();



                                                $insqrymetalkarat['id'] = $metalkaratid;

                                                $insqrymetalkarat['name'] = $metalkaratname;

                                                $insqrymetalkarat['isactive'] = 1;

                                                $insqrymetalkarat['timestamp'] = $datetime;

                                                $insqrymetalkarat['entry_uid'] = $uid;

                                                $insqrymetalkarat['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tblmetalcaratmaster', $insqrymetalkarat, '');

                                            }

                                            $strmetalkaratid .= $metalkaratid;

                                            if (sizeof($exmetalkarat) != $mk) {

                                                $strmetalkaratid .= ',';

                                            }

                                        }

                                    }

                                }



                                $gemstonetypeid = '';

                                if ($gemstonetype) {

                                    $qrygemstonetype = "SELECT id FROM tblgemstonetypemaster WHERE name=:gemstonetype";

                                    $paramgemstonetype = array(':gemstonetype' => $gemstonetype);

                                    $resgemstonetype = $DB->getmenual($qrygemstonetype, $paramgemstonetype);

                                    if (sizeof($resgemstonetype) > 0) {

                                        $rowgemstonetype = $resgemstonetype[0];

                                        $gemstonetypeid = $rowgemstonetype['id'];

                                    } else {

                                        $gemstonetypeid = $IISMethods->generateuuid();



                                        $insqrygemstonetype['id'] = $gemstonetypeid;

                                        $insqrygemstonetype['name'] = $gemstonetype;

                                        $insqrygemstonetype['isactive'] = 1;

                                        $insqrygemstonetype['timestamp'] = $datetime;

                                        $insqrygemstonetype['entry_uid'] = $uid;

                                        $insqrygemstonetype['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tblgemstonetypemaster', $insqrygemstonetype, '');

                                    }

                                }



                                $shapeid = '';

                                if ($shape) {

                                    $qryshape = "SELECT id FROM tbldiamondshapemaster WHERE name=:shape";

                                    $paramshape = array(':shape' => $shape);

                                    $resshape = $DB->getmenual($qryshape, $paramshape);

                                    if (sizeof($resshape) > 0) {

                                        $rowshape = $resshape[0];

                                        $shapeid = $rowshape['id'];

                                    } else {

                                        $shapeid = $IISMethods->generateuuid();



                                        $insqryshape['id'] = $shapeid;

                                        $insqryshape['name'] = $shape;

                                        $insqryshape['isactive'] = 1;

                                        $insqryshape['timestamp'] = $datetime;

                                        $insqryshape['entry_uid'] = $uid;

                                        $insqryshape['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tbldiamondshapemaster', $insqryshape, '');

                                    }

                                }



                                $labid = '';

                                if ($lab) {

                                    $qrylab = "SELECT id FROM tbllabmaster WHERE name=:lab";

                                    $paramlab = array(':lab' => $lab);

                                    $reslab = $DB->getmenual($qrylab, $paramlab);

                                    if (sizeof($reslab) > 0) {

                                        $rowlab = $reslab[0];

                                        $labid = $rowlab['id'];

                                    } else {

                                        $labid = $IISMethods->generateuuid();



                                        $insqrylab['id'] = $labid;

                                        $insqrylab['name'] = $lab;

                                        $insqrylab['isactive'] = 1;

                                        $insqrylab['timestamp'] = $datetime;

                                        $insqrylab['entry_uid'] = $uid;

                                        $insqrylab['entry_date'] = $datetime;

                                        $DB->executedata('i', 'tbllabmaster', $insqrylab, '');

                                    }

                                }



                                $strtreatmentid = '';

                                if ($treatment) {

                                    $extreatment = explode(',', $treatment);

                                    if (sizeof($extreatment) > 0) {

                                        for ($tm = 0; $tm < sizeof($extreatment); $tm++) {

                                            $treatmentname = $extreatment[$tm];



                                            $qrytreatment = "SELECT id FROM tbltreatmentmaster WHERE name=:treatment";

                                            $paramtreatment = array(':treatment' => $treatmentname);

                                            $restreatment = $DB->getmenual($qrytreatment, $paramtreatment);

                                            if (sizeof($restreatment) > 0) {

                                                $rowtreatment = $restreatment[0];

                                                $treatmentid = $rowtreatment['id'];

                                            } else {

                                                $treatmentid = $IISMethods->generateuuid();



                                                $insqrytreatment['id'] = $treatmentid;

                                                $insqrytreatment['name'] = $treatmentname;

                                                $insqrytreatment['isactive'] = 1;

                                                $insqrytreatment['timestamp'] = $datetime;

                                                $insqrytreatment['entry_uid'] = $uid;

                                                $insqrytreatment['entry_date'] = $datetime;

                                                $DB->executedata('i', 'tbltreatmentmaster', $insqrytreatment, '');

                                            }

                                            $strtreatmentid .= $treatmentid;

                                            if (sizeof($extreatment) != $tm) {

                                                $strtreatmentid .= ',';

                                            }

                                        }

                                    }

                                }





                                $flttypestyleid = implode("','", explode(",", $strtypestyleid));

                                $fltjewellerycategoryid = implode("','", explode(",", $strjewellerycategoryid));

                                $fltjewelleryqualityid = implode("','", explode(",", $strjewelleryqualityid));

                                $fltmetaltypeid = implode("','", explode(",", $strmetaltypeid));

                                $fltmetalkaratid = implode("','", explode(",", $strmetalkaratid));



                                $jewelleryid = $IISMethods->generateuuid();

                                if ($itemtitle != '') {

                                    try {

                                        $DB->begintransaction();

                                        $query = "SELECT id FROM tbljewellery WHERE itemtitle=:itemtitle AND personid=:personid";

                                        $param = array(':itemtitle' => $itemtitle, ':personid' => $uid);

                                        $res = $DB->getmenual($query, $param);

                                        if (sizeof($res) > 0) {

                                            $jewelleryid = $res[0]['id'];

                                        } else {

                                            $qrydata = "SELECT

                                        IFNULL((SELECT name FROM tbljewelrytypemaster WHERE id=:jewellerytypeid),'') AS jewellerytype,

                                        IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,

                                        IFNULL((SELECT group_concat(name) FROM tbltypestylemaster WHERE id IN ('" . $flttypestyleid . "')),'') AS typestyle,

                                        IFNULL((SELECT group_concat(name) FROM tbljewelrycategorymaster WHERE id IN ('" . $fltjewellerycategoryid . "')),'') AS jewelrycategory,

                                        IFNULL((SELECT name FROM tblconditionmaster WHERE id=:conditionid),'') AS conditionname,

                                        IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,

                                        IFNULL((SELECT group_concat(name) FROM tbljewelryqualitymaster WHERE id IN ('" . $fltjewelleryqualityid . "')),'') AS jewelleryquality,

                                        IFNULL((SELECT group_concat(name) FROM tblmetaltypemaster WHERE id IN ('" . $fltmetaltypeid . "')),'') AS metaltype,

                                        IFNULL((SELECT group_concat(name) FROM tblmetalcaratmaster WHERE id IN ('" . $fltmetalkaratid . "')),'') AS metalkarat";

                                            $paramdata = array(

                                                ':jewellerytypeid' => $jewellerytypeid,

                                                ':personid' => $uid,

                                                ':conditionid' => $conditionid,

                                                ':brandid' => $brandid,

                                            );

                                            //    print_r($paramdata);



                                            $resdata = $DB->getmenual($qrydata, $paramdata);

                                            $rowdata = $resdata[0];



                                            $typename = 'jewellery';

                                            $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";

                                            $seriesparams = array(

                                                ':typename' => $typename,

                                            );

                                            $result_ary = $DB->getmenual($qryseries, $seriesparams);

                                            $rowseries = $result_ary[0];



                                            $seriesid = $rowseries['id'];

                                            $seriesno = $DB->getorderno($seriesid, 'jewellery', $currdate);

                                            $maxid = $DB->getmaxid($seriesid, 'jewellery');



                                            $insqry = array(

                                                'id' => $jewelleryid,

                                                'jewelleryno' => $seriesno,

                                                'personid' => $uid,

                                                'personname' => $rowdata['personname'],

                                                'itemtitle' => $itemtitle,

                                                'stock' => $stock,

                                                'isavailable' => $isavailable,

                                                'isavailableformemo' => $isavailableformemo,

                                                'description' => $description,

                                                'iteminstock' => $iteminstock,

                                                'minimumorder' => $minimumorder,

                                                'jewellerytypeid' => $jewellerytypeid,

                                                'jewellerytype' => $rowdata['jewellerytype'],

                                                'typestyleid' => $strtypestyleid,

                                                'typestyle' => $rowdata['typestyle'],

                                                'jewellerycategoryid' => $strjewellerycategoryid,

                                                'jewellerycategory' => $rowdata['jewelrycategory'],

                                                'conditionid' => $conditionid,

                                                'conditionname' => $rowdata['conditionname'],

                                                'brandid' => $brandid,

                                                'brand' => $rowdata['brand'],

                                                'jewelleryqualityid' => $strjewelleryqualityid,

                                                'jewelleryquality' => $rowdata['jewelleryquality'],

                                                'designername' => $designername,

                                                'keyworddescription' => $keyworddescription,

                                                'metaltypeid' => $strmetaltypeid,

                                                'metaltype' => $rowdata['metaltype'],

                                                'metalkaratid' => $strmetalkaratid,

                                                'metalkarat' => $rowdata['metalkarat'],

                                                'jewellerytotalweight' => $jewellerytotalweight,

                                                'suppliercomment' => $suppliercomment,

                                                'size' => $size,

                                                'ringsize' => $ringsize,

                                                'unpublished' => $unpublished,

                                                'sharable' => $shareable,

                                                'ownstockinventory' => $ownstockinventory,

                                                'isactive' => 1,

                                                'maxid' => $maxid,

                                                'seriesid' => $seriesid,

                                                'timestamp' => $datetime,

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'iscsvupload' => 1

                                            );

                                            $DB->executedata('i', 'tbljewellery', $insqry, '');

                                            $DB->userwisediamonjewelrylog(2, $uid);

                                        }



                                        if ($shippingfromid && $price && $strtermsid && $msrp && $deliverytimeindays) {

                                            $qryshippingfromcheck = "SELECT id FROM tbljewellerypricelocation WHERE jewelleryid=:jewelleryid AND shippingfromid=:shippingfromid";

                                            $paramshippingfrom = array(':jewelleryid' => $jewelleryid, ':shippingfromid' => $shippingfromid);

                                            $resshippingfrom = $DB->getmenual($qryshippingfromcheck, $paramshippingfrom);

                                            if (sizeof($resshippingfrom) > 0) {

                                                $jplid = $resshippingfrom[0]['id'];



                                                $shippingfromparams = array(

                                                    'jewelleryid' => $jewelleryid,

                                                    'shippingfromid' => $shippingfromid,

                                                );

                                                $DB->executedata('d', 'tbljewellerypricelocation', '', $shippingfromparams);



                                                $termsparams = array(

                                                    'jewelleryid' => $jewelleryid,

                                                    'jewellerypricelocid' => $jplid,

                                                );

                                                $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);

                                            }



                                            $flttermsid = implode("','", explode(',', $strtermsid));



                                            $qrysf = "SELECT

                                                IFNULL((SELECT country from tblcountrymaster where id=:countryid),'') AS country,

                                                IFNULL((SELECT group_concat(name) from tbltermsmaster where id IN ('" . $flttermsid . "')),'') AS terms";

                                            $parmssf = array(

                                                ':countryid' => $shippingfromid,

                                            );

                                            $result_sf = $DB->getmenual($qrysf, $parmssf);

                                            $msfid = $IISMethods->generateuuid();



                                            $inspersf = array(

                                                'id' => $msfid,

                                                'jewelleryid' => $jewelleryid,

                                                'shippingfromid' => $shippingfromid,

                                                'shippingfrom' => $result_sf[0]['country'],

                                                'price' => $price,

                                                'termsid' => $strtermsid,

                                                'terms' => $result_sf[0]['terms'],

                                                'msrp' => $msrp,

                                                'deliverytimeindays' => $deliverytimeindays,

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerypricelocation', $inspersf, '');



                                            $termsid = explode(',', $strtermsid);

                                            if (sizeof($termsid) > 0) {

                                                for ($tm = 0; $tm < sizeof($termsid); $tm++) {

                                                    $qrytm = "SELECT

                                                        IFNULL((SELECT name from tbltermsmaster where id=:termsid),'') AS terms";

                                                    $parmstm = array(

                                                        ':termsid' => $termsid[$tm],

                                                    );

                                                    $result_tm = $DB->getmenual($qrytm, $parmstm);



                                                    $tmid = $IISMethods->generateuuid();

                                                    if ($result_tm[0]['terms'] != '') {

                                                        $insterms = array(

                                                            'id' => $tmid,

                                                            'jewelleryid' => $jewelleryid,

                                                            'jewellerypricelocid' => $msfid,

                                                            'termsid' => $termsid[$tm],

                                                            'terms' => $result_tm[0]['terms'],

                                                            'entry_uid' => $uid,

                                                            'entry_date' => $datetime,

                                                            'timestamp' => $datetime,

                                                        );

                                                        $DB->executedata('i', 'tbljewelleryterms', $insterms, '');

                                                    }

                                                }

                                            }



                                            $qryminmaxprice = "SELECT

                                                IFNULL((SELECT MIN(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid1 LIMIT 1),'') AS minprice,

                                                IFNULL((SELECT MAX(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid2 LIMIT 1),'') AS maxprice";

                                            $parmsminmaxprice = array(

                                                ':jewelleryid1' => $jewelleryid,

                                                ':jewelleryid2' => $jewelleryid,

                                            );

                                            $result_minmaxprice = $DB->getmenual($qryminmaxprice, $parmsminmaxprice);



                                            $updqry['minprice'] = $result_minmaxprice[0]['minprice'];

                                            $updqry['maxprice'] = $result_minmaxprice[0]['maxprice'];

                                            $aryupd = array(

                                                'id' => $jewelleryid,

                                            );

                                            $DB->executedata('u', 'tbljewellery', $updqry, $aryupd);

                                            $DB->userwisediamonjewelrylog(2, $uid);

                                        }

                                        /***********Product Information**************/

                                        $typestyleid = explode(",", $strtypestyleid);

                                        if (sizeof($typestyleid) > 0) {

                                            for ($t = 0; $t < sizeof($typestyleid); $t++) {

                                                $qrytypestyle = "SELECT name from tbltypestylemaster where id=:id";

                                                $parmstypestyle = array(

                                                    ':id' => $typestyleid[$t],

                                                );

                                                $result_typestyle = $DB->getmenual($qrytypestyle, $parmstypestyle);

                                                $mtypestyleid = $IISMethods->generateuuid();

                                                if ($result_typestyle[0]['name'] != '') {

                                                    $inspertypestyle = array(

                                                        'id' => $mtypestyleid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'typestyleid' => $typestyleid[$t],

                                                        'typestyle' => $result_typestyle[0]['name'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    $DB->executedata('i', 'tbljewellerytypestyle', $inspertypestyle, '');

                                                }

                                            }

                                        }

                                        $jewellerycategoryid = explode(',', $strjewellerycategoryid);

                                        if (sizeof($jewellerycategoryid) > 0) {

                                            for ($jc = 0; $jc < sizeof($jewellerycategoryid); $jc++) {

                                                $qryjewellerycategory = "SELECT name from tbljewelrycategorymaster where id=:id";

                                                $parmsjewellerycategory = array(

                                                    ':id' => $jewellerycategoryid[$jc],

                                                );

                                                $result_jewellerycategory = $DB->getmenual($qryjewellerycategory, $parmsjewellerycategory);

                                                $mjewellerycategoryid = $IISMethods->generateuuid();

                                                if ($result_jewellerycategory[0]['name'] != '') {

                                                    $insperjewellerycategory = array(

                                                        'id' => $mjewellerycategoryid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'categoryid' => $jewellerycategoryid[$jc],

                                                        'category' => $result_jewellerycategory[0]['name'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    $DB->executedata('i', 'tbljewellerycategory', $insperjewellerycategory, '');

                                                }

                                            }

                                        }

                                        $jewelleryqualityid = explode(',', $strjewelleryqualityid);

                                        if (sizeof($jewelleryqualityid) > 0) {

                                            for ($jq = 0; $jq < sizeof($jewelleryqualityid); $jq++) {

                                                $qryjewelleryquality = "SELECT name from tbljewelryqualitymaster where id=:id";

                                                $parmsjewelleryquality = array(

                                                    ':id' => $jewelleryqualityid[$jq],

                                                );

                                                $result_jewelleryquality = $DB->getmenual($qryjewelleryquality, $parmsjewelleryquality);

                                                $mjewelleryqualityid = $IISMethods->generateuuid();

                                                if ($result_jewelleryquality[0]['name'] != '') {

                                                    $insperjewelleryquality = array(

                                                        'id' => $mjewelleryqualityid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'qualityid' => $jewelleryqualityid[$jq],

                                                        'quality' => $result_jewelleryquality[0]['name'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    $DB->executedata('i', 'tbljewelleryquality', $insperjewelleryquality, '');

                                                }

                                            }

                                        }

                                        /***********Metal**************/

                                        $metaltypeid = explode(',', $strmetaltypeid);

                                        if (sizeof($metaltypeid) > 0) {

                                            for ($mt = 0; $mt < sizeof($metaltypeid); $mt++) {

                                                $qrymetaltype = "SELECT name from tblmetaltypemaster where id=:id";

                                                $parmsmetaltype = array(

                                                    ':id' => $metaltypeid[$mt],

                                                );

                                                $result_metaltype = $DB->getmenual($qrymetaltype, $parmsmetaltype);

                                                $mmetaltypeid = $IISMethods->generateuuid();

                                                if ($result_metaltype[0]['name'] != '') {

                                                    $inspermetaltype = array(

                                                        'id' => $mmetaltypeid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'metaltypeid' => $metaltypeid[$mt],

                                                        'metaltype' => $result_metaltype[0]['name'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    $DB->executedata('i', 'tbljewellerymetaltype', $inspermetaltype, '');

                                                }

                                            }

                                        }

                                        $metalkaratid = explode(',', $strmetalkaratid);

                                        if (sizeof($metalkaratid) > 0) {

                                            for ($mk = 0; $mk < sizeof($metalkaratid); $mk++) {

                                                $qrymetalkarat = "SELECT name from tblmetalcaratmaster where id=:id";

                                                $parmsmetalkarat = array(

                                                    ':id' => $metalkaratid[$mk],

                                                );

                                                $result_metalkarat = $DB->getmenual($qrymetalkarat, $parmsmetalkarat);

                                                $mmetalkaratid = $IISMethods->generateuuid();

                                                if ($result_metalkarat[0]['name'] != '') {

                                                    $inspermetalkarat = array(

                                                        'id' => $mmetalkaratid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'metalkaratid' => $metalkaratid[$mk],

                                                        'metalkarat' => $result_metalkarat[0]['name'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    $DB->executedata('i', 'tbljewellerymetalkarat', $inspermetalkarat, '');

                                                }

                                            }

                                        }



                                        if ($gemstonetypeid && $shapeid && $caratweight && $labid && $labtext && $stone && $savanilot) {



                                            $qrychkgems = "SELECT id FROM tbljewellerygemstones WHERE jewelleryid=:jewelleryid AND gemstonetypeid=:gemstonetypeid";

                                            $paramgems = array(':jewelleryid' => $jewelleryid, ':gemstonetypeid' => $gemstonetypeid);

                                            $reschkgems = $DB->getmenual($qrychkgems, $paramgems);

                                            if (sizeof($reschkgems) > 0) {

                                                $jgsid = $reschkgems[0]['id'];

                                                $gemstonesparams = array(

                                                    'jewelleryid' => $jewelleryid,

                                                    'gemstonetypeid' => $gemstonetypeid,

                                                );

                                                $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);



                                                $treatmentparams = array(

                                                    'jewelleryid' => $jewelleryid,

                                                    'jewellerygemstoneid' => $jgsid,

                                                );

                                                $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);

                                            }







                                            $flttreatmentid = implode("','", explode(',', $strtreatmentid));



                                            $qrygemstonetype = "SELECT

                                                        IFNULL((SELECT name from tblgemstonetypemaster where id=:gemstonetypeid),'') AS gemstonetype,

                                                        IFNULL((SELECT name from tbldiamondshapemaster where id=:shapeid),'') AS shape,

                                                        IFNULL((SELECT name from tbllabmaster where id=:labid),'') AS lab,

                                                        IFNULL((SELECT group_concat(name) from tbltreatmentmaster where id IN ('" . $flttreatmentid . "')),'') AS treatment";

                                            $parmsgemstonetype = array(

                                                ':gemstonetypeid' => $gemstonetypeid,

                                                ':shapeid' => $shapeid,

                                                ':labid' => $labid,

                                            );

                                            // print_r($parmsgemstonetype);

                                            $result_gemstonetype = $DB->getmenual($qrygemstonetype, $parmsgemstonetype);

                                            $mgemstonetypeid = $IISMethods->generateuuid();



                                            $htreatment = 0;

                                            if ($hastreatment == 1) {

                                                $htreatment = 1;

                                            }

                                            if ($result_gemstonetype[0]['gemstonetype'] != '') {

                                                $inspergemstonetype = array(

                                                    'id' => $mgemstonetypeid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'gemstonetypeid' => $gemstonetypeid,

                                                    'gemstonetype' => $result_gemstonetype[0]['gemstonetype'],

                                                    'shapeid' => $shapeid,

                                                    'shape' => $result_gemstonetype[0]['shape'],

                                                    'caratweight' => $caratweight,

                                                    'labid' => $labid,

                                                    'lab' => $result_gemstonetype[0]['lab'],

                                                    'labtext' => $labtext,

                                                    'hastreatment' => $htreatment,

                                                    'treatmentid' => $strtreatmentid,

                                                    'treatment' => $result_gemstonetype[0]['treatment'],

                                                    'stones' => $stone,

                                                    'savanilot' => $savanilot,

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                $DB->executedata('i', 'tbljewellerygemstones', $inspergemstonetype, '');



                                                if ($htreatment == 1) {

                                                    $treatmentid = explode(',', $strtreatmentid);

                                                    if (sizeof($treatmentid) > 0) {

                                                        for ($tr = 0; $tr < sizeof($treatmentid); $tr++) {

                                                            $qrytreatment = "SELECT name from tbltreatmentmaster where id=:id";

                                                            $parmstreatment = array(

                                                                ':id' => $treatmentid[$tr],

                                                            );

                                                            $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);

                                                            $mtreatmentid = $IISMethods->generateuuid();

                                                            if ($result_treatment[0]['name'] != '') {

                                                                $inspertreatment = array(

                                                                    'id' => $mtreatmentid,

                                                                    'jewelleryid' => $jewelleryid,

                                                                    'jewellerygemstoneid' => $mgemstonetypeid,

                                                                    'treatmentid' => $treatmentid[$tr],

                                                                    'treatment' => $result_treatment[0]['name'],

                                                                    'entry_uid' => $uid,

                                                                    'entry_date' => $datetime,

                                                                    'timestamp' => $datetime,

                                                                );

                                                                $DB->executedata('i', 'tbljewellerytreatment', $inspertreatment, '');

                                                            }

                                                        }

                                                    }

                                                }

                                            }

                                        }

                                        $DB->committransaction();

                                    } catch (Exception $e) {

                                        echo $e;

                                        $DB->rollbacktransaction($e);

                                        $status = 0;

                                        $message = $errmsg['dbtransactionerror'];

                                    }

                                }

                            }

                            $i++;

                        }



                        // $response['cnt_upddata']=(int)$cnt_upd;

                        $response['cnt_insdata'] = (int)$cnt_ins;

                        $response['cnt_errordata'] = (int)$cnt_err;



                        $status = 1;

                        $message = $errmsg['jewelleryinsert'];

                    } else {

                        $status = 0;

                        $message = $errmsg['filesel'];

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            } else if ($action == 'uploadjewellerycsv') 

            {

                if ($CanListJewelleryXL == 1) 

                {

                    $datetime = $IISMethods->getdatetime();

                    $filename = $_FILES['csvfile']['tmp_name'];

                    $ext = pathinfo($_FILES["csvfile"]["name"], PATHINFO_EXTENSION);

                    $unqid = $IISMethods->generateuuid();

                    $uimagePath1 = $IISMethods->uploadallfiles(0, 'jewellerycsv', $_FILES['csvfile']['name'], $_FILES['csvfile']['tmp_name'], $unqid);



                    $logunqid = $IISMethods->generateuuid();

                    $inslog = array(

                        'id' => $logunqid,

                        'typeid' => 2,

                        'fileurl' => $uimagePath1,

                        'entry_uid' => $uid,

                        'entry_date' => $datetime,

                        'timestamp' => $datetime,

                    );

                    $DB->executedata('i', 'tblexcelfileslog', $inslog, '');



                    $inputFileName = dirname(__DIR__, 2) . '/assets/' . $uimagePath1;

                    //$inputFileName = 'taskexcel1587204348.xlsx';



                    // $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

                    // $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                    // $objPHPExcel = $objReader->load($inputFileName);

                    $inputFileType = IOFactory::identify($inputFileName);

                    $objReader = IOFactory::createReader($inputFileType);

                    $objPHPExcel = IOFactory :: load($inputFileName);

                    if ($objPHPExcel) {

                        $objWorksheet = $objPHPExcel->getActiveSheet();

                        $sheet = $objPHPExcel->getSheet(0);

                        $highestRow = $sheet->getHighestRow();

                        $highestColumn = $sheet->getHighestColumn();

                        $j = 0;

                        $i = 1;

                        $cnt_ins = 0;

                        $cnt_upd = 0;

                        $cnt_err = 0;

                        for ($row = 2; $row <= $highestRow; $row++) 

                        {

                            $itemData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);



                            /**********Product Description**************/

                            $itemtitle = trim($itemData[0][0]);

                            $stock = trim($itemData[0][1]);

                            $isavailable = trim($itemData[0][2]);

                            $isavailableformemo = trim($itemData[0][3]);

                            $description = trim($itemData[0][4]);



                            /*************Price & Location - Multiple Block For Each*************/



                            $shippingfrom = trim($itemData[0][5]);

                            $price = trim($itemData[0][6]);

                            $terms = trim($itemData[0][7]);  // multiple select

                            $msrp = trim($itemData[0][8]);

                            $deliverytimeindays = trim($itemData[0][9]); // Days



                            /* ****************************************************** */



                            $iteminstock = trim($itemData[0][10]);

                            $minimumorder = trim($itemData[0][11]);



                            /***********Product Information**************/

                            $jewellerytype = trim($itemData[0][12]);

                            $typestyle = trim($itemData[0][13]); // Multiple

                            $jewellerycategory = trim($itemData[0][14]); // Multiple

                            $condition = trim($itemData[0][15]);

                            $brand = trim($itemData[0][16]);

                            $jewelleryquality = trim($itemData[0][17]); // Multiple

                            $designername = trim($itemData[0][18]);

                            $keyworddescription = trim($itemData[0][19]); // Comma Seprated



                            /***********Metal**************/

                            $metaltype = trim($itemData[0][20]);   // Multiple

                            $metalkarat = trim($itemData[0][21]);  // Multiple

                            $jewellerytotalweight = trim($itemData[0][22]);



                            /* ***************** Gemstones - Multiple Block For Each******************** */



                            $gemstonetype = trim($itemData[0][23]);

                            $shape = trim($itemData[0][24]);

                            $caratweight = trim($itemData[0][25]);

                            $lab = trim($itemData[0][26]);

                            $labtext = trim($itemData[0][27]);

                            $hastreatment = trim($itemData[0][28]);

                            $treatment = trim($itemData[0][29]); // Multiple

                            $stone = trim($itemData[0][30]);

                            // $savanilot = trim($itemData[0][31]);



                            $suppliercomment = trim($itemData[0][31]);

                            $size = trim($itemData[0][32]);

                            $ringsize = trim($itemData[0][33]);



                            /***********Visibility**************/

                            $unpublished = trim($itemData[0][34]);

                            $shareable = trim($itemData[0][35]);

                            $ownstockinventory = trim($itemData[0][36]);



                            $jewelleryvideolink = trim($itemData[0][37]);

                        //     echo $jewelleryvideolink;

                        //   exit;

                            if ($i == 1) 

                            {

                                $qryjewellery = "SELECT id FROM tbljewellery WHERE personid=:personid";

                                $paramjewellery = array(':personid' => $uid);

                                $resjewellery = $DB->getmenual($qryjewellery, $paramjewellery);

                                if (sizeof($resjewellery) > 0) {

                                    for ($dm = 0; $dm < sizeof($resjewellery); $dm++) {

                                        $rowdm = $resjewellery[$dm];

                                        $jewelleryid = $rowdm['id'];



                                        $params = array(

                                            'id' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellery', '', $params);

                                        $DB->userwisediamonjewelrylog(2, $uid);

                                        $categoryparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerycategory', '', $categoryparams);



                                        $gemstonesparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);



                                        $metalkaratparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerymetalkarat', '', $metalkaratparams);



                                        $metaltypeparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerymetaltype', '', $metaltypeparams);



                                        $pricelocationparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerypricelocation', '', $pricelocationparams);



                                        $qualityparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewelleryquality', '', $qualityparams);



                                        $termsparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);



                                        $treatmentparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);



                                        $typestyleparams = array(

                                            'jewelleryid' => $jewelleryid

                                        );

                                        $DB->executedata('d', 'tbljewellerytypestyle', '', $typestyleparams);

                                    }

                                }

                            }

                            $shippingfromid = '';

                            if ($shippingfrom) {

                                $qryshippingfrom = "SELECT id FROM tblcountrymaster WHERE country=:shippingfrom";

                                $paramshippingfrom = array(':shippingfrom' => $shippingfrom);

                                $resshippingfrom = $DB->getmenual($qryshippingfrom, $paramshippingfrom);

                                if (sizeof($resshippingfrom) > 0) {

                                    $rowshippingfrom = $resshippingfrom[0];

                                    $shippingfromid = $rowshippingfrom['id'];

                                } else {

                                    $shippingfromid = $IISMethods->generateuuid();



                                    $insqryshippingfrom['id'] = $shippingfromid;

                                    $insqryshippingfrom['country'] = $shippingfrom;

                                    $insqryshippingfrom['timestamp'] = $datetime;

                                    $insqryshippingfrom['entry_uid'] = $uid;

                                    $insqryshippingfrom['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tblcountrymaster', $insqryshippingfrom, '');

                                }

                            }



                            $strtermsid = '';

                            if ($terms) {

                                $exterms = explode(',', $terms);

                                if (sizeof($exterms) > 0) {

                                    for ($tr = 0; $tr < sizeof($exterms); $tr++) {

                                        $termsname = $exterms[$tr];



                                        $qryterms = "SELECT id FROM tbltermsmaster WHERE name=:terms";

                                        $paramterms = array(':terms' => $termsname);

                                        $resterms = $DB->getmenual($qryterms, $paramterms);

                                        if (sizeof($resterms) > 0) {

                                            $rowterms = $resterms[0];

                                            $termsid = $rowterms['id'];

                                        } else {

                                            $termsid = $IISMethods->generateuuid();



                                            $insqryterms['id'] = $termsid;

                                            $insqryterms['name'] = $termsname;

                                            $insqryterms['isactive'] = 1;

                                            $insqryterms['timestamp'] = $datetime;

                                            $insqryterms['entry_uid'] = $uid;

                                            $insqryterms['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tbltermsmaster', $insqryterms, '');

                                        }

                                        $strtermsid .= $termsid;

                                        if (sizeof($exterms) != $tr) {

                                            $strtermsid .= ',';

                                        }

                                    }

                                }

                            }



                            $jewellerytypeid = '';

                            if ($jewellerytype) {

                                $qryjewellerytype = "SELECT id FROM tbljewelrytypemaster WHERE name=:jewellerytype";

                                $paramjewellerytype = array(':jewellerytype' => $jewellerytype);

                                $resjewellerytype = $DB->getmenual($qryjewellerytype, $paramjewellerytype);

                                if (sizeof($resjewellerytype) > 0) {

                                    $rowjewellerytype = $resjewellerytype[0];

                                    $jewellerytypeid = $rowjewellerytype['id'];

                                } else {

                                    $jewellerytypeid = $IISMethods->generateuuid();



                                    $insqryjewellerytype['id'] = $jewellerytypeid;

                                    $insqryjewellerytype['name'] = $jewellerytype;

                                    $insqryjewellerytype['isactive'] = 1;

                                    $insqryjewellerytype['timestamp'] = $datetime;

                                    $insqryjewellerytype['entry_uid'] = $uid;

                                    $insqryjewellerytype['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tbljewelrytypemaster', $insqryjewellerytype, '');

                                }

                            }





                            $strtypestyleid = '';

                            if ($typestyle) {

                                $extypestyle = explode(',', $typestyle);

                                if (sizeof($extypestyle) > 0) {

                                    for ($ts = 0; $ts < sizeof($extypestyle); $ts++) {

                                        $typestylename = $extypestyle[$ts];



                                        $qrytypestyle = "SELECT id FROM tbltypestylemaster WHERE name=:typestyle";

                                        $paramtypestyle = array(':typestyle' => $typestylename);

                                        $restypestyle = $DB->getmenual($qrytypestyle, $paramtypestyle);

                                        if (sizeof($restypestyle) > 0) {

                                            $rowtypestyle = $restypestyle[0];

                                            $typestyleid = $rowtypestyle['id'];

                                        } else {

                                            $typestyleid = $IISMethods->generateuuid();



                                            $insqrytypestyle['id'] = $typestyleid;

                                            $insqrytypestyle['jewelrytypeid'] = $jewellerytypeid;

                                            $insqrytypestyle['name'] = $typestylename;

                                            $insqrytypestyle['isactive'] = 1;

                                            $insqrytypestyle['timestamp'] = $datetime;

                                            $insqrytypestyle['entry_uid'] = $uid;

                                            $insqrytypestyle['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tbltypestylemaster', $insqrytypestyle, '');

                                        }

                                        $strtypestyleid .= $typestyleid;

                                        if (sizeof($extypestyle) != $ts) {

                                            $strtypestyleid .= ',';

                                        }

                                    }

                                }

                            }



                            $strjewellerycategoryid = '';

                            if ($jewellerycategory) {

                                $exjewellerycategory = explode(',', $jewellerycategory);

                                if (sizeof($exjewellerycategory) > 0) {

                                    for ($jc = 0; $jc < sizeof($exjewellerycategory); $jc++) {

                                        $jewellerycategoryname = $exjewellerycategory[$jc];



                                        $qryjewellerycategory = "SELECT id FROM tbljewelrycategorymaster WHERE name=:jewellerycategory";

                                        $paramjewellerycategory = array(':jewellerycategory' => $jewellerycategoryname);

                                        $resjewellerycategory = $DB->getmenual($qryjewellerycategory, $paramjewellerycategory);

                                        if (sizeof($resjewellerycategory) > 0) {

                                            $rowjewellerycategory = $resjewellerycategory[0];

                                            $jewellerycategoryid = $rowjewellerycategory['id'];

                                        } else {

                                            $jewellerycategoryid = $IISMethods->generateuuid();



                                            $insqryjewellerycategory['id'] = $jewellerycategoryid;

                                            $insqryjewellerycategory['name'] = $jewellerycategoryname;

                                            $insqryjewellerycategory['isactive'] = 1;

                                            $insqryjewellerycategory['timestamp'] = $datetime;

                                            $insqryjewellerycategory['entry_uid'] = $uid;

                                            $insqryjewellerycategory['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tbljewelrycategorymaster', $insqryjewellerycategory, '');

                                        }

                                        $strjewellerycategoryid .= $jewellerycategoryid;

                                        if (sizeof($exjewellerycategory) != $jc) {

                                            $strjewellerycategoryid .= ',';

                                        }

                                    }

                                }

                            }



                            $conditionid = '';

                            if ($condition) {

                                $qrycondition = "SELECT id FROM tblconditionmaster WHERE name=:condition";

                                $paramcondition = array(':condition' => $condition);

                                $rescondition = $DB->getmenual($qrycondition, $paramcondition);

                                if (sizeof($rescondition) > 0) {

                                    $rowcondition = $rescondition[0];

                                    $conditionid = $rowcondition['id'];

                                } else {

                                    $conditionid = $IISMethods->generateuuid();



                                    $insqrycondition['id'] = $conditionid;

                                    $insqrycondition['name'] = $condition;

                                    $insqrycondition['isactive'] = 1;

                                    $insqrycondition['timestamp'] = $datetime;

                                    $insqrycondition['entry_uid'] = $uid;

                                    $insqrycondition['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tblconditionmaster', $insqrycondition, '');

                                }

                            }



                            $brandid = '';

                            if ($brand) {

                                $qrybrand = "SELECT id FROM tblbrandmaster WHERE title=:brand";

                                $parambrand = array(':brand' => $brand);

                                $resbrand = $DB->getmenual($qrybrand, $parambrand);

                                if (sizeof($resbrand) > 0) {

                                    $rowbrand = $resbrand[0];

                                    $brandid = $rowbrand['id'];

                                } else {

                                    $brandid = $IISMethods->generateuuid();



                                    $insqrybrand['id'] = $brandid;

                                    $insqrybrand['title'] = $brand;

                                    $insqrybrand['isactive'] = 1;

                                    $insqrybrand['timestamp'] = $datetime;

                                    $insqrybrand['entry_uid'] = $uid;

                                    $insqrybrand['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tblbrandmaster', $insqrybrand, '');

                                }

                            }



                            $strjewelleryqualityid = '';

                            if ($jewelleryquality) {

                                $exjewelleryquality = explode(',', $jewelleryquality);

                                if (sizeof($exjewelleryquality) > 0) {

                                    for ($jq = 0; $jq < sizeof($exjewelleryquality); $jq++) {

                                        $jewelleryqualityname = $exjewelleryquality[$jq];



                                        $qryjewelleryquality = "SELECT id FROM tbljewelryqualitymaster WHERE name=:jewelleryquality";

                                        $paramjewelleryquality = array(':jewelleryquality' => $jewelleryqualityname);

                                        $resjewelleryquality = $DB->getmenual($qryjewelleryquality, $paramjewelleryquality);

                                        if (sizeof($resjewelleryquality) > 0) {

                                            $rowjewelleryquality = $resjewelleryquality[0];

                                            $jewelleryqualityid = $rowjewelleryquality['id'];

                                        } else {

                                            $jewelleryqualityid = $IISMethods->generateuuid();



                                            $insqryjewelleryquality['id'] = $jewelleryqualityid;

                                            $insqryjewelleryquality['name'] = $jewelleryqualityname;

                                            $insqryjewelleryquality['isactive'] = 1;

                                            $insqryjewelleryquality['timestamp'] = $datetime;

                                            $insqryjewelleryquality['entry_uid'] = $uid;

                                            $insqryjewelleryquality['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tbljewelryqualitymaster', $insqryjewelleryquality, '');

                                        }

                                        $strjewelleryqualityid .= $jewelleryqualityid;

                                        if (sizeof($exjewelleryquality) != $jq) {

                                            $strjewelleryqualityid .= ',';

                                        }

                                    }

                                }

                            }



                            $strmetaltypeid = '';

                            if ($metaltype) {

                                $exmetaltype = explode(',', $metaltype);

                                if (sizeof($exmetaltype) > 0) {

                                    for ($mt = 0; $mt < sizeof($exmetaltype); $mt++) {

                                        $metaltypename = $exmetaltype[$mt];



                                        $qrymetaltype = "SELECT id FROM tblmetaltypemaster WHERE name=:metaltype";

                                        $parammetaltype = array(':metaltype' => $metaltypename);

                                        $resmetaltype = $DB->getmenual($qrymetaltype, $parammetaltype);

                                        if (sizeof($resmetaltype) > 0) {

                                            $rowmetaltype = $resmetaltype[0];

                                            $metaltypeid = $rowmetaltype['id'];

                                        } else {

                                            $metaltypeid = $IISMethods->generateuuid();



                                            $insqrymetaltype['id'] = $metaltypeid;

                                            $insqrymetaltype['name'] = $metaltypename;

                                            $insqrymetaltype['isactive'] = 1;

                                            $insqrymetaltype['timestamp'] = $datetime;

                                            $insqrymetaltype['entry_uid'] = $uid;

                                            $insqrymetaltype['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tblmetaltypemaster', $insqrymetaltype, '');

                                        }

                                        $strmetaltypeid .= $metaltypeid;

                                        if (sizeof($exmetaltype) != $mt) {

                                            $strmetaltypeid .= ',';

                                        }

                                    }

                                }

                            }







                            $strmetalkaratid = '';

                            if ($metalkarat) {

                                $exmetalkarat = explode(',', $metalkarat);

                                if (sizeof($exmetalkarat) > 0) {

                                    for ($mk = 0; $mk < sizeof($exmetalkarat); $mk++) {

                                        $metalkaratname = $exmetalkarat[$mk];



                                        $qrymetalkarat = "SELECT id FROM tblmetalcaratmaster WHERE name=:metalkarat";

                                        $parammetalkarat = array(':metalkarat' => $metalkaratname);

                                        $resmetalkarat = $DB->getmenual($qrymetalkarat, $parammetalkarat);

                                        if (sizeof($resmetalkarat) > 0) {

                                            $rowmetalkarat = $resmetalkarat[0];

                                            $metalkaratid = $rowmetalkarat['id'];

                                        } else {

                                            $metalkaratid = $IISMethods->generateuuid();



                                            $insqrymetalkarat['id'] = $metalkaratid;

                                            $insqrymetalkarat['name'] = $metalkaratname;

                                            $insqrymetalkarat['isactive'] = 1;

                                            $insqrymetalkarat['timestamp'] = $datetime;

                                            $insqrymetalkarat['entry_uid'] = $uid;

                                            $insqrymetalkarat['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tblmetalcaratmaster', $insqrymetalkarat, '');

                                        }

                                        $strmetalkaratid .= $metalkaratid;

                                        if (sizeof($exmetalkarat) != $mk) {

                                            $strmetalkaratid .= ',';

                                        }

                                    }

                                }

                            }



                            $gemstonetypeid = '';

                            if ($gemstonetype) {

                                $qrygemstonetype = "SELECT id FROM tblgemstonetypemaster WHERE name=:gemstonetype";

                                $paramgemstonetype = array(':gemstonetype' => $gemstonetype);

                                $resgemstonetype = $DB->getmenual($qrygemstonetype, $paramgemstonetype);

                                if (sizeof($resgemstonetype) > 0) {

                                    $rowgemstonetype = $resgemstonetype[0];

                                    $gemstonetypeid = $rowgemstonetype['id'];

                                } else {

                                    $gemstonetypeid = $IISMethods->generateuuid();



                                    $insqrygemstonetype['id'] = $gemstonetypeid;

                                    $insqrygemstonetype['name'] = $gemstonetype;

                                    $insqrygemstonetype['isactive'] = 1;

                                    $insqrygemstonetype['timestamp'] = $datetime;

                                    $insqrygemstonetype['entry_uid'] = $uid;

                                    $insqrygemstonetype['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tblgemstonetypemaster', $insqrygemstonetype, '');

                                }

                            }



                            $shapeid = '';

                            if ($shape) {

                                $qryshape = "SELECT id FROM tbldiamondshapemaster WHERE name=:shape";

                                $paramshape = array(':shape' => $shape);

                                $resshape = $DB->getmenual($qryshape, $paramshape);

                                if (sizeof($resshape) > 0) {

                                    $rowshape = $resshape[0];

                                    $shapeid = $rowshape['id'];

                                } else {

                                    $shapeid = $IISMethods->generateuuid();



                                    $insqryshape['id'] = $shapeid;

                                    $insqryshape['name'] = $shape;

                                    $insqryshape['isactive'] = 1;

                                    $insqryshape['timestamp'] = $datetime;

                                    $insqryshape['entry_uid'] = $uid;

                                    $insqryshape['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tbldiamondshapemaster', $insqryshape, '');

                                }

                            }



                            $labid = '';

                            if ($lab) {

                                $qrylab = "SELECT id FROM tbllabmaster WHERE name=:lab";

                                $paramlab = array(':lab' => $lab);

                                $reslab = $DB->getmenual($qrylab, $paramlab);

                                if (sizeof($reslab) > 0) {

                                    $rowlab = $reslab[0];

                                    $labid = $rowlab['id'];

                                } else {

                                    $labid = $IISMethods->generateuuid();



                                    $insqrylab['id'] = $labid;

                                    $insqrylab['name'] = $lab;

                                    $insqrylab['isactive'] = 1;

                                    $insqrylab['timestamp'] = $datetime;

                                    $insqrylab['entry_uid'] = $uid;

                                    $insqrylab['entry_date'] = $datetime;

                                    $DB->executedata('i', 'tbllabmaster', $insqrylab, '');

                                }

                            }



                            $strtreatmentid = '';

                            if ($treatment) {

                                $extreatment = explode(',', $treatment);

                                if (sizeof($extreatment) > 0) {

                                    for ($tm = 0; $tm < sizeof($extreatment); $tm++) {

                                        $treatmentname = $extreatment[$tm];



                                        $qrytreatment = "SELECT id FROM tbltreatmentmaster WHERE name=:treatment";

                                        $paramtreatment = array(':treatment' => $treatmentname);

                                        $restreatment = $DB->getmenual($qrytreatment, $paramtreatment);

                                        if (sizeof($restreatment) > 0) {

                                            $rowtreatment = $restreatment[0];

                                            $treatmentid = $rowtreatment['id'];

                                        } else {

                                            $treatmentid = $IISMethods->generateuuid();



                                            $insqrytreatment['id'] = $treatmentid;

                                            $insqrytreatment['name'] = $treatmentname;

                                            $insqrytreatment['isactive'] = 1;

                                            $insqrytreatment['timestamp'] = $datetime;

                                            $insqrytreatment['entry_uid'] = $uid;

                                            $insqrytreatment['entry_date'] = $datetime;

                                            $DB->executedata('i', 'tbltreatmentmaster', $insqrytreatment, '');

                                        }

                                        $strtreatmentid .= $treatmentid;

                                        if (sizeof($extreatment) != $tm) {

                                            $strtreatmentid .= ',';

                                        }

                                    }

                                }

                            }





                            $flttypestyleid = implode("','", explode(",", $strtypestyleid));

                            $fltjewellerycategoryid = implode("','", explode(",", $strjewellerycategoryid));

                            $fltjewelleryqualityid = implode("','", explode(",", $strjewelleryqualityid));

                            $fltmetaltypeid = implode("','", explode(",", $strmetaltypeid));

                            $fltmetalkaratid = implode("','", explode(",", $strmetalkaratid));



                            $jewelleryid = $IISMethods->generateuuid();

                            if ($itemtitle != '') {

                                try {

                                    $DB->begintransaction();

                                    $query = "SELECT id FROM tbljewellery WHERE itemtitle=:itemtitle AND personid=:personid";

                                    $param = array(':itemtitle' => $itemtitle, ':personid' => $uid);

                                    $res = $DB->getmenual($query, $param);

                                    if (sizeof($res) > 0) {

                                        $jewelleryid = $res[0]['id'];

                                    } else {

                                        $qrydata = "SELECT

                                        IFNULL((SELECT name FROM tbljewelrytypemaster WHERE id=:jewellerytypeid),'') AS jewellerytype,

                                        IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,

                                        IFNULL((SELECT group_concat(name) FROM tbltypestylemaster WHERE id IN ('" . $flttypestyleid . "')),'') AS typestyle,

                                        IFNULL((SELECT group_concat(name) FROM tbljewelrycategorymaster WHERE id IN ('" . $fltjewellerycategoryid . "')),'') AS jewelrycategory,

                                        IFNULL((SELECT name FROM tblconditionmaster WHERE id=:conditionid),'') AS conditionname,

                                        IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,

                                        IFNULL((SELECT group_concat(name) FROM tbljewelryqualitymaster WHERE id IN ('" . $fltjewelleryqualityid . "')),'') AS jewelleryquality,

                                        IFNULL((SELECT group_concat(name) FROM tblmetaltypemaster WHERE id IN ('" . $fltmetaltypeid . "')),'') AS metaltype,

                                        IFNULL((SELECT group_concat(name) FROM tblmetalcaratmaster WHERE id IN ('" . $fltmetalkaratid . "')),'') AS metalkarat";

                                        $paramdata = array(

                                            ':jewellerytypeid' => $jewellerytypeid,

                                            ':personid' => $uid,

                                            ':conditionid' => $conditionid,

                                            ':brandid' => $brandid,

                                        );

                                        //    print_r($paramdata);



                                        $resdata = $DB->getmenual($qrydata, $paramdata);

                                        $rowdata = $resdata[0];



                                        $typename = 'jewellery';

                                        $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";

                                        $seriesparams = array(

                                            ':typename' => $typename,

                                        );

                                        $result_ary = $DB->getmenual($qryseries, $seriesparams);

                                        $rowseries = $result_ary[0];



                                        $seriesid = $rowseries['id'];

                                        $seriesno = $DB->getorderno($seriesid, 'jewellery', $currdate);

                                        $maxid = $DB->getmaxid($seriesid, 'jewellery');



                                        $insqry = array(

                                            'id' => $jewelleryid,

                                            'jewelleryno' => $seriesno,

                                            'personid' => $uid,

                                            'personname' => $rowdata['personname'],

                                            'itemtitle' => $itemtitle,

                                            'stock' => $stock,

                                            'isavailable' => $isavailable,

                                            'isavailableformemo' => $isavailableformemo,

                                            'description' => $description,

                                            'iteminstock' => $iteminstock,

                                            'minimumorder' => $minimumorder,

                                            'jewellerytypeid' => $jewellerytypeid,

                                            'jewellerytype' => $rowdata['jewellerytype'],

                                            'typestyleid' => $strtypestyleid,

                                            'typestyle' => $rowdata['typestyle'],

                                            'jewellerycategoryid' => $strjewellerycategoryid,

                                            'jewellerycategory' => $rowdata['jewelrycategory'],

                                            'conditionid' => $conditionid,

                                            'conditionname' => $rowdata['conditionname'],

                                            'brandid' => $brandid,

                                            'brand' => $rowdata['brand'],

                                            'jewelleryqualityid' => $strjewelleryqualityid,

                                            'jewelleryquality' => $rowdata['jewelleryquality'],

                                            'designername' => $designername,

                                            'keyworddescription' => $keyworddescription,

                                            'metaltypeid' => $strmetaltypeid,

                                            'metaltype' => $rowdata['metaltype'],

                                            'metalkaratid' => $strmetalkaratid,

                                            'metalkarat' => $rowdata['metalkarat'],

                                            'jewellerytotalweight' => $jewellerytotalweight,

                                            'suppliercomment' => $suppliercomment,

                                            'size' => $size,

                                            'ringsize' => $ringsize,

                                            'unpublished' => $unpublished,

                                            'sharable' => $shareable,

                                            'ownstockinventory' => $ownstockinventory,

                                            'jewelleryvideolink' => $jewelleryvideolink,

                                            'isactive' => 1,

                                            'maxid' => $maxid,

                                            'seriesid' => $seriesid,

                                            'timestamp' => $datetime,

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'iscsvupload' => 1

                                        );

                                        $DB->executedata('i', 'tbljewellery', $insqry, '');

                                        $DB->userwisediamonjewelrylog(2, $uid);

                                    }



                                    if ($shippingfromid && $price && $strtermsid && $msrp && $deliverytimeindays) {

                                        $qryshippingfromcheck = "SELECT id FROM tbljewellerypricelocation WHERE jewelleryid=:jewelleryid AND shippingfromid=:shippingfromid";

                                        $paramshippingfrom = array(':jewelleryid' => $jewelleryid, ':shippingfromid' => $shippingfromid);

                                        $resshippingfrom = $DB->getmenual($qryshippingfromcheck, $paramshippingfrom);

                                        if (sizeof($resshippingfrom) > 0) {

                                            $jplid = $resshippingfrom[0]['id'];



                                            $shippingfromparams = array(

                                                'jewelleryid' => $jewelleryid,

                                                'shippingfromid' => $shippingfromid,

                                            );

                                            $DB->executedata('d', 'tbljewellerypricelocation', '', $shippingfromparams);



                                            $termsparams = array(

                                                'jewelleryid' => $jewelleryid,

                                                'jewellerypricelocid' => $jplid,

                                            );

                                            $DB->executedata('d', 'tbljewelleryterms', '', $termsparams);

                                        }



                                        $flttermsid = implode("','", explode(',', $strtermsid));



                                        $qrysf = "SELECT

                                                IFNULL((SELECT country from tblcountrymaster where id=:countryid),'') AS country,

                                                IFNULL((SELECT group_concat(name) from tbltermsmaster where id IN ('" . $flttermsid . "')),'') AS terms";

                                        $parmssf = array(

                                            ':countryid' => $shippingfromid,

                                        );

                                        $result_sf = $DB->getmenual($qrysf, $parmssf);

                                        $msfid = $IISMethods->generateuuid();



                                        $inspersf = array(

                                            'id' => $msfid,

                                            'jewelleryid' => $jewelleryid,

                                            'shippingfromid' => $shippingfromid,

                                            'shippingfrom' => $result_sf[0]['country'],

                                            'price' => $price,

                                            'termsid' => $strtermsid,

                                            'terms' => $result_sf[0]['terms'],

                                            'msrp' => $msrp,

                                            'deliverytimeindays' => $deliverytimeindays,

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbljewellerypricelocation', $inspersf, '');



                                        $termsid = explode(',', $strtermsid);

                                        if (sizeof($termsid) > 0) {

                                            for ($tm = 0; $tm < sizeof($termsid); $tm++) {

                                                $qrytm = "SELECT

                                                        IFNULL((SELECT name from tbltermsmaster where id=:termsid),'') AS terms";

                                                $parmstm = array(

                                                    ':termsid' => $termsid[$tm],

                                                );

                                                $result_tm = $DB->getmenual($qrytm, $parmstm);



                                                $tmid = $IISMethods->generateuuid();

                                                if ($result_tm[0]['terms'] != '') {

                                                    $insterms = array(

                                                        'id' => $tmid,

                                                        'jewelleryid' => $jewelleryid,

                                                        'jewellerypricelocid' => $msfid,

                                                        'termsid' => $termsid[$tm],

                                                        'terms' => $result_tm[0]['terms'],

                                                        'entry_uid' => $uid,

                                                        'entry_date' => $datetime,

                                                        'timestamp' => $datetime,

                                                    );

                                                    $DB->executedata('i', 'tbljewelleryterms', $insterms, '');

                                                }

                                            }

                                        }



                                        $qryminmaxprice = "SELECT

                                                IFNULL((SELECT MIN(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid1 LIMIT 1),'') AS minprice,

                                                IFNULL((SELECT MAX(price) from tbljewellerypricelocation where jewelleryid=:jewelleryid2 LIMIT 1),'') AS maxprice";

                                        $parmsminmaxprice = array(

                                            ':jewelleryid1' => $jewelleryid,

                                            ':jewelleryid2' => $jewelleryid,

                                        );

                                        $result_minmaxprice = $DB->getmenual($qryminmaxprice, $parmsminmaxprice);



                                        $updqry['minprice'] = $result_minmaxprice[0]['minprice'];

                                        $updqry['maxprice'] = $result_minmaxprice[0]['maxprice'];

                                        $aryupd = array(

                                            'id' => $jewelleryid,

                                        );

                                        $DB->executedata('u', 'tbljewellery', $updqry, $aryupd);

                                        $DB->userwisediamonjewelrylog(2, $uid);

                                    }

                                    /***********Product Information**************/

                                    $typestyleid = explode(",", $strtypestyleid);

                                    if (sizeof($typestyleid) > 0) {

                                        for ($t = 0; $t < sizeof($typestyleid); $t++) {

                                            $qrytypestyle = "SELECT name from tbltypestylemaster where id=:id";

                                            $parmstypestyle = array(

                                                ':id' => $typestyleid[$t],

                                            );

                                            $result_typestyle = $DB->getmenual($qrytypestyle, $parmstypestyle);

                                            $mtypestyleid = $IISMethods->generateuuid();

                                            if ($result_typestyle[0]['name'] != '') {

                                                $inspertypestyle = array(

                                                    'id' => $mtypestyleid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'typestyleid' => $typestyleid[$t],

                                                    'typestyle' => $result_typestyle[0]['name'],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                $DB->executedata('i', 'tbljewellerytypestyle', $inspertypestyle, '');

                                            }

                                        }

                                    }

                                    $jewellerycategoryid = explode(',', $strjewellerycategoryid);

                                    if (sizeof($jewellerycategoryid) > 0) {

                                        for ($jc = 0; $jc < sizeof($jewellerycategoryid); $jc++) {

                                            $qryjewellerycategory = "SELECT name from tbljewelrycategorymaster where id=:id";

                                            $parmsjewellerycategory = array(

                                                ':id' => $jewellerycategoryid[$jc],

                                            );

                                            $result_jewellerycategory = $DB->getmenual($qryjewellerycategory, $parmsjewellerycategory);

                                            $mjewellerycategoryid = $IISMethods->generateuuid();

                                            if ($result_jewellerycategory[0]['name'] != '') {

                                                $insperjewellerycategory = array(

                                                    'id' => $mjewellerycategoryid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'categoryid' => $jewellerycategoryid[$jc],

                                                    'category' => $result_jewellerycategory[0]['name'],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                $DB->executedata('i', 'tbljewellerycategory', $insperjewellerycategory, '');

                                            }

                                        }

                                    }

                                    $jewelleryqualityid = explode(',', $strjewelleryqualityid);

                                    if (sizeof($jewelleryqualityid) > 0) {

                                        for ($jq = 0; $jq < sizeof($jewelleryqualityid); $jq++) {

                                            $qryjewelleryquality = "SELECT name from tbljewelryqualitymaster where id=:id";

                                            $parmsjewelleryquality = array(

                                                ':id' => $jewelleryqualityid[$jq],

                                            );

                                            $result_jewelleryquality = $DB->getmenual($qryjewelleryquality, $parmsjewelleryquality);

                                            $mjewelleryqualityid = $IISMethods->generateuuid();

                                            if ($result_jewelleryquality[0]['name'] != '') {

                                                $insperjewelleryquality = array(

                                                    'id' => $mjewelleryqualityid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'qualityid' => $jewelleryqualityid[$jq],

                                                    'quality' => $result_jewelleryquality[0]['name'],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                $DB->executedata('i', 'tbljewelleryquality', $insperjewelleryquality, '');

                                            }

                                        }

                                    }

                                    /***********Metal**************/

                                    $metaltypeid = explode(',', $strmetaltypeid);

                                    if (sizeof($metaltypeid) > 0) {

                                        for ($mt = 0; $mt < sizeof($metaltypeid); $mt++) {

                                            $qrymetaltype = "SELECT name from tblmetaltypemaster where id=:id";

                                            $parmsmetaltype = array(

                                                ':id' => $metaltypeid[$mt],

                                            );

                                            $result_metaltype = $DB->getmenual($qrymetaltype, $parmsmetaltype);

                                            $mmetaltypeid = $IISMethods->generateuuid();

                                            if ($result_metaltype[0]['name'] != '') {

                                                $inspermetaltype = array(

                                                    'id' => $mmetaltypeid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'metaltypeid' => $metaltypeid[$mt],

                                                    'metaltype' => $result_metaltype[0]['name'],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                $DB->executedata('i', 'tbljewellerymetaltype', $inspermetaltype, '');

                                            }

                                        }

                                    }

                                    $metalkaratid = explode(',', $strmetalkaratid);

                                    if (sizeof($metalkaratid) > 0) {

                                        for ($mk = 0; $mk < sizeof($metalkaratid); $mk++) {

                                            $qrymetalkarat = "SELECT name from tblmetalcaratmaster where id=:id";

                                            $parmsmetalkarat = array(

                                                ':id' => $metalkaratid[$mk],

                                            );

                                            $result_metalkarat = $DB->getmenual($qrymetalkarat, $parmsmetalkarat);

                                            $mmetalkaratid = $IISMethods->generateuuid();

                                            if ($result_metalkarat[0]['name'] != '') {

                                                $inspermetalkarat = array(

                                                    'id' => $mmetalkaratid,

                                                    'jewelleryid' => $jewelleryid,

                                                    'metalkaratid' => $metalkaratid[$mk],

                                                    'metalkarat' => $result_metalkarat[0]['name'],

                                                    'entry_uid' => $uid,

                                                    'entry_date' => $datetime,

                                                    'timestamp' => $datetime,

                                                );

                                                $DB->executedata('i', 'tbljewellerymetalkarat', $inspermetalkarat, '');

                                            }

                                        }

                                    }



                                    if ($gemstonetypeid && $shapeid && $caratweight && $labid && $labtext && $stone) {



                                        $qrychkgems = "SELECT id FROM tbljewellerygemstones WHERE jewelleryid=:jewelleryid AND gemstonetypeid=:gemstonetypeid";

                                        $paramgems = array(':jewelleryid' => $jewelleryid, ':gemstonetypeid' => $gemstonetypeid);

                                        $reschkgems = $DB->getmenual($qrychkgems, $paramgems);

                                        if (sizeof($reschkgems) > 0) {

                                            $jgsid = $reschkgems[0]['id'];

                                            $gemstonesparams = array(

                                                'jewelleryid' => $jewelleryid,

                                                'gemstonetypeid' => $gemstonetypeid,

                                            );

                                            $DB->executedata('d', 'tbljewellerygemstones', '', $gemstonesparams);



                                            $treatmentparams = array(

                                                'jewelleryid' => $jewelleryid,

                                                'jewellerygemstoneid' => $jgsid,

                                            );

                                            $DB->executedata('d', 'tbljewellerytreatment', '', $treatmentparams);

                                        }







                                        $flttreatmentid = implode("','", explode(',', $strtreatmentid));

                                        $savanilot = "SG".str_pad(rand(),6,'0',STR_PAD_LEFT);



                                        $qrygemstonetype = "SELECT

                                                        IFNULL((SELECT name from tblgemstonetypemaster where id=:gemstonetypeid),'') AS gemstonetype,

                                                        IFNULL((SELECT name from tbldiamondshapemaster where id=:shapeid),'') AS shape,

                                                        IFNULL((SELECT name from tbllabmaster where id=:labid),'') AS lab,

                                                        IFNULL((SELECT group_concat(name) from tbltreatmentmaster where id IN ('" . $flttreatmentid . "')),'') AS treatment";

                                        $parmsgemstonetype = array(

                                            ':gemstonetypeid' => $gemstonetypeid,

                                            ':shapeid' => $shapeid,

                                            ':labid' => $labid,

                                        );

                                        // print_r($parmsgemstonetype);

                                        $result_gemstonetype = $DB->getmenual($qrygemstonetype, $parmsgemstonetype);

                                        $mgemstonetypeid = $IISMethods->generateuuid();



                                        $htreatment = 0;

                                        if ($hastreatment == 1) {

                                            $htreatment = 1;

                                        }

                                        if ($result_gemstonetype[0]['gemstonetype'] != '') {

                                            $inspergemstonetype = array(

                                                'id' => $mgemstonetypeid,

                                                'jewelleryid' => $jewelleryid,

                                                'gemstonetypeid' => $gemstonetypeid,

                                                'gemstonetype' => $result_gemstonetype[0]['gemstonetype'],

                                                'shapeid' => $shapeid,

                                                'shape' => $result_gemstonetype[0]['shape'],

                                                'caratweight' => $caratweight,

                                                'labid' => $labid,

                                                'lab' => $result_gemstonetype[0]['lab'],

                                                'labtext' => $labtext,

                                                'hastreatment' => $htreatment,

                                                'treatmentid' => $strtreatmentid,

                                                'treatment' => $result_gemstonetype[0]['treatment'],

                                                'stones' => $stone,

                                                // 'savanilot' => $savanilot,

                                                'savanilot' => $savanilot,

                                                'entry_uid' => $uid,

                                                'entry_date' => $datetime,

                                                'timestamp' => $datetime,

                                            );

                                            $DB->executedata('i', 'tbljewellerygemstones', $inspergemstonetype, '');



                                            if ($htreatment == 1) {

                                                $treatmentid = explode(',', $strtreatmentid);

                                                if (sizeof($treatmentid) > 0) {

                                                    for ($tr = 0; $tr < sizeof($treatmentid); $tr++) {

                                                        $qrytreatment = "SELECT name from tbltreatmentmaster where id=:id";

                                                        $parmstreatment = array(

                                                            ':id' => $treatmentid[$tr],

                                                        );

                                                        $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);

                                                        $mtreatmentid = $IISMethods->generateuuid();

                                                        if ($result_treatment[0]['name'] != '') {

                                                            $inspertreatment = array(

                                                                'id' => $mtreatmentid,

                                                                'jewelleryid' => $jewelleryid,

                                                                'jewellerygemstoneid' => $mgemstonetypeid,

                                                                'treatmentid' => $treatmentid[$tr],

                                                                'treatment' => $result_treatment[0]['name'],

                                                                'entry_uid' => $uid,

                                                                'entry_date' => $datetime,

                                                                'timestamp' => $datetime,

                                                            );

                                                            $DB->executedata('i', 'tbljewellerytreatment', $inspertreatment, '');

                                                        }

                                                    }

                                                }

                                            }

                                        }

                                    }

                                    $i++;

                                    $cnt_ins++;

                                    $DB->committransaction();

                                } catch (Exception $e) {

                                    // echo $e;

                                    $DB->rollbacktransaction($e);

                                    $status = 0;

                                    $message = $errmsg['dbtransactionerror'];

                                }

                            } else {

                                $response['errordata'][$j]['no'] = $IISMethods->sanitize($row);

                                $response['errordata'][$j]['itemtitle'] = $IISMethods->sanitize($itemtitle);

                                $cnt_err++;

                                $j++;

                            }

                        }

                        // $response['cnt_upddata']=(int)$cnt_upd;

                        $response['cnt_insdata'] = (int)$cnt_ins;

                        $response['cnt_errordata'] = (int)$cnt_err;

                        if ($cnt_ins > 0) {

                            $updqry = array(

                                'isuploaded' => 1,

                                'update_date' => $datetime,

                            );

                            $params = array(

                                'id' => $logunqid

                            );

                            $DB->executedata('u', 'tblexcelfileslog', $updqry, $params);

                        }

                        $status = 1;

                        $message = $errmsg['jewelleryinsert'];

                    } else {

                        $status = 0;

                        $message = $errmsg['filesel'];

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            } else if ($action == 'sharejewellery') {

                $jewelleryid = $IISMethods->sanitize($_POST['sharejewelleryid']);

                $sharewithemail = $IISMethods->sanitize($_POST['jsharewithemail']);

                $datetime = $IISMethods->getdatetime();

                if ($CanShareJewellery == 1) {

                    if ($jewelleryid && $uid) {

                        if ($sharewithemail) {

                            $qrychk = "SELECT id FROM jewellerylist WHERE id=:id AND isactive=1";

                            $paramchk = array(':id' => $jewelleryid);

                            $reschk = $DB->getmenual($qrychk, $paramchk);

                            if (sizeof($reschk) > 0) {

                                $row = $reschk[0];



                                $unqid = $IISMethods->generateuuid();

                                $insjewelleryshare = array(

                                    'id' => $unqid,

                                    'jewelleryid' => $row['id'],

                                    'personid' => $uid,

                                    'shareemail' => $sharewithemail,

                                    'entry_uid' => $uid,

                                    'entry_date' => $datetime,

                                    'timestamp' => $datetime,

                                );

                                $DB->executedata('i', 'tbljewelleryshare', $insjewelleryshare, '');

                                $status = 1;

                                $message = $errmsg['jewelleryshared'];

                                $emailto = $sharewithemail;

                                $subject = 'Share Jewellery';



                                // $data .= '<tr>

                                //     <td colspan="10" style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;" valign="top">

                                //         <div style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">

                                //             <span style="color:#000000;font-weight:700;text-align:center;">Jewellery Link &nbsp;&nbsp; <strong style="background-color: #15233b;padding:10px;border-radius:3px;color:#fff;"><a href="' . $config->getportalbaseurl() . 'jewellery/' . $row['id'] . '" target="_blank">Link</a></strong></span>

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

                                $emailtxt .= 'Hello,</p>';

                                $emailtxt .= '<p';

                                $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                                $emailtxt .= 'Jewellery Link</p>';

                                $emailtxt .= '</td>';

                                $emailtxt .= '</tr>';

                                $emailtxt .= '<tr>';

                                $emailtxt .= '<td colspan="10"';

                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                                $emailtxt .= 'valign="top">';

                                $emailtxt .= '<div';

                                $emailtxt .= ' style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';

                                $emailtxt .= '<span';

                                $emailtxt .= ' style="color:#000000;font-weight:700;text-align:center;">Jewellery Link';

                                $emailtxt .= ' &nbsp;&nbsp; <strong';

                                $emailtxt .= ' style="background-color: #669934;padding:10px;border-radius:3px;color:#fff;"><a href="' . $config->getportalbaseurl() . 'jewellery/' . $row['id'] . '" target="_blank">Click Here</a></strong></span>';

                                $emailtxt .= '</div>';

                                $emailtxt .= '</td>';

                                $emailtxt .= '</tr>';



                                $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');

                            } else {

                                $message = $errmsg['nojewelleryfound'];

                            }

                        } else {

                            $message = $errmsg['required'];

                        }

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            } else if ($action == 'contactjewelleryseller') {

                $contactsellerjewelleryid = $IISMethods->sanitize($_POST['contactsellerjewelleryid']);

                $contactsellerjewelleryname = $IISMethods->sanitize($_POST['contactsellerjewelleryname']);

                $messagetext = $IISMethods->sanitize($_POST['jewellerymessagetext']);

                $offerprice = $IISMethods->sanitize($_POST['jewelleryofferprice']);





                $datetime = $IISMethods->getdatetime();

                if ($CanMemberToMemberChat == 1) {

                    if ($contactsellerjewelleryid && $uid) {

                        if ($messagetext && $offerprice) {

                            $qrychk = "SELECT  d.id,d.personid,d.personname,pm.email,pm.businessphoneno AS contact,pm.phonecode

                                    FROM jewellerylist d

                                    inner join tblpersonmaster pm on pm.id=d.personid

                                    WHERE d.id=:id AND d.isactive=1";

                            $paramchk = array(':id' => $contactsellerjewelleryid);

                            $reschk = $DB->getmenual($qrychk, $paramchk);

                            if (sizeof($reschk) > 0) {

                                $row = $reschk[0];



                                $qryperson = "SELECT pm.personname,pm.email,pm.businessphoneno AS contact,pm.phonecode FROM tblpersonmaster pm WHERE pm.id=:id";

                                $paramperson = array(':id' => $uid);

                                $resperson = $DB->getmenual($qryperson, $paramperson);

                                $rowperson = $resperson[0];



                                $unqid = $IISMethods->generateuuid();

                                $personid = $row['personid'];



                                $qryper1 = "SELECT id FROM tblchatgroup WHERE personid=:personid AND uid=:uid AND chattype=:chattype AND issupport=1";

                                $paramper = array(':personid' => $personid, ':uid' => $uid, ':chattype' => 2);

                                $chkper1 = $DB->getmenual($qryper1, $paramper);

                                if (sizeof($chkper1) > 0) {



                                    $groupid = $chkper1[0]['id'];

                                } else {

                                    $groupid = $IISMethods->generateuuid();



                                    $insdata = array(

                                        'id' => $groupid,

                                        'personid' => $personid,

                                        'uid' => $uid,

                                        'name' => $contactsellerjewelleryname,

                                        'persontype' => 1,

                                        'entry_uid' => $uid,

                                        'entry_date' => $datetime,

                                        'timestamp' => $datetime,

                                        'issupport' => 1,

                                        'chattype' => 2,

                                    );

                                    $DB->executedata('i', 'tblchatgroup', $insdata, '');



                                    $groupmemberid = $IISMethods->generateuuid();

                                    //Default Customer

                                    $insmemdata = array(

                                        'id' => $groupmemberid,

                                        'groupid' => $groupid,

                                        'personid' => $personid,

                                        'iscustomer' => 1,

                                        'entry_uid' => $uid,

                                        'entry_date' => $datetime,

                                        'timestamp' => $datetime,

                                    );

                                    $DB->executedata('i', 'tblchatmembers', $insmemdata, '');

                                }

                                if ($groupid) {

                                    $qrybt = "SELECT * FROM `tbllastseen` WHERE uid=:uid AND groupid=:groupid";

                                    $parambt = array(':uid' => $uid, ':groupid' => $groupid);

                                    $resbt = $DB->getmenual($qrybt, $parambt);



                                    if (sizeof($resbt) > 0) {

                                        $upddata = array(

                                            'entry_date' => $datetime

                                        );

                                        $extraparams = array(

                                            'groupid' => $groupid,

                                            'uid' => $uid,

                                        );

                                        $DB->executedata('u', 'tbllastseen', $upddata, $extraparams);

                                    } else {

                                        $lastseenid = $IISMethods->generateuuid();

                                        $insdata = array(

                                            'id' => $lastseenid,

                                            'uid' => $uid,

                                            'groupid' => $groupid,

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tbllastseen', $insdata, '');

                                    }



                                    $qrychk = "SELECT id FROM `tblchathistory` WHERE uid=:uid AND groupid=:groupid AND entry_date =:entry_date";

                                    $paramchk = array(':uid' => $uid, ':groupid' => $groupid, ':entry_date' => $datetime);

                                    $reschk = $DB->getmenual($qrychk, $paramchk);



                                    if (sizeof($reschk) > 0) {

                                    } else {

                                        $historyseenid = $IISMethods->generateuuid();

                                        $insmemdata = array(

                                            'id' => $historyseenid,

                                            'uid' => $uid,

                                            'groupid' => $groupid,

                                            'entry_uid' => $uid,

                                            'entry_date' => $datetime,

                                            'timestamp' => $datetime,

                                        );

                                        $DB->executedata('i', 'tblchathistory', $insmemdata, '');

                                    }



                                    $audchat_id =  $IISMethods->generateuuid();

                                    $uniqname = uniqid();

                                    $ismainmsg = 1;

                                    $qryuname = "SELECT uniqname FROM tblchatmessage WHERE groupid=:groupid AND jewelleryid=:jewelleryid AND issupport=1  AND chattype=2";

                                    $paramuname = array(':groupid' => $groupid, ':jewelleryid' => $contactsellerjewelleryid);

                                    $chkuname = $DB->getmenual($qryuname, $paramuname);

                                    if (sizeof($chkuname) > 0) {

                                        $uniqname = $chkuname[0]['uniqname'];

                                        $ismainmsg = 0;

                                    }

                                    //Insert Chat Message

                                    $inschatmsgdata = array(

                                        'id' => $audchat_id,

                                        'uniqname' => $uniqname,

                                        'groupid' => $groupid,

                                        'message' => $messagetext,

                                        'uid' => $uid,

                                        'type' => 1,

                                        'filetype' => 0,

                                        'fmsgid' => '',

                                        'rplymsgid' => '',

                                        'sendpersonid' => $personid,

                                        'issupport' => 1,

                                        'ismainmsg' => $ismainmsg,

                                        'entry_uid' => $uid,

                                        'entry_date' => $datetime,

                                        'timestamp' => $datetime,

                                        'jewelleryid' => $contactsellerjewelleryid,

                                        'jewelleryname' => $contactsellerjewelleryname,

                                        'jewelleryofferprice' => $offerprice,

                                        'persontype' => 1,

                                        'chattype' => 2,

                                        'responsetype' => 3

                                    );

                                    $DB->executedata('i', 'tblchatmessage', $inschatmsgdata, '');

                                    $persondata = array(

                                        'chatmsgid' => $audchat_id,

                                        'lastchatmsg' => $messagetext,

                                        'msgfiletype' => 0,

                                        'lastchat_date' => $datetime

                                    );

                                    $extraparams = array(

                                        'id' => $personid

                                    );

                                    $DB->executedata('u', 'tblpersonmaster', $persondata, $extraparams);

                                }

                                $status = 1;

                                $message = $errmsg['messagesend'];



                                $emailto = $row['email'];

                                // $subject = 'Message from ' . $rowperson['personname'] . '(' . $rowperson['contact'] . ') For Buy Jewellery!!';

                                $subject = 'Message from ' . $rowperson['personname'] . ' For Buy Jewellery!!';



                                // $data .= '<tr>

                                //     <td colspan="10" style="word-break: break-word; vertical-align: top;text-align: left;width:100%;padding-top:10px;padding-bottom:20px;" valign="top">

                                //         <div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">

                                //             <p>Hello,' . $row['personname'] . '(' . $row['contact'] . ')</p>

                                //             <p><b>Diamond :</b> ' . $contactsellerjewelleryname . '</p>

                                //             <p><b>Message :</b> ' . $messagetext . '</p>

                                //             <p><b>Offer Price :</b> $' . $offerprice . '</p>

                                //             <p><b>Send By :</b> ' . $rowperson['personname'] . '(' . $rowperson['contact'] . ')</p>

                                //             <p><b>Date Time :</b> ' . $datetime . '</p>

                                //             <p><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>

                                //         </div>

                                //     </td>

                                // </tr>';



                                // $emailtxt .= '';



                                // $emailtxt .= '<tr>';

                                // $emailtxt .= '<td colspan="10"';

                                // $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                                // $emailtxt .= 'valign="top">';

                                // $emailtxt .= '<p';

                                // $emailtxt .= ' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                                // $emailtxt .= 'Hello,' . $row['personname'] . '(' . $row['phonecode'] . ' ' . $row['contact'] . ')</p>';

                                // $emailtxt .= '<p';

                                // $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                                // $emailtxt .= 'Message from ' . $rowperson['personname'] . '(<a href="tel:' . $rowperson['phonecode'] . '' . $rowperson['contact'] . '">' . $rowperson['phonecode'] . ' ' . $rowperson['contact'] . '</a>) For Buy Jewellery!!</p>';

                                // $emailtxt .= '</td>';

                                // $emailtxt .= '</tr>';

                                // $emailtxt .= '<tr>';

                                // $emailtxt .= '<td colspan="10"';

                                // $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                                // $emailtxt .= 'valign="top">';

                                // $emailtxt .= '<div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';

                                // $emailtxt .= '<p style="padding:10px;"><b>Jewellery :</b> ' . $contactsellerjewelleryname . '</p>

                                //             <p style="padding:10px;"><b>Message :</b> ' . $messagetext . '</p>

                                //             <p style="padding:10px;"><b>Offer Price :</b> $' . $offerprice . '</p>

                                //             <p style="padding:10px;"><b>Send By :</b> ' . $rowperson['personname'] . '(<a href="tel:' . $rowperson['phonecode'] . '' . $rowperson['contact'] . '">' . $rowperson['phonecode'] . ' ' . $rowperson['contact'] . '</a>)</p>

                                //             <p style="padding:10px;"><b>Date Time :</b> ' . $datetime . '</p>

                                //             <p style="padding:10px;"><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>';

                                // $emailtxt .= '</div>';

                                // $emailtxt .= '</td>';

                                // $emailtxt .= '</tr>';



                                $emailtxt .= '';



                                $emailtxt .= '<tr>';

                                $emailtxt .= '<td colspan="10"';

                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';

                                $emailtxt .= 'valign="top">';

                                $emailtxt .= '<p';

                                $emailtxt .= ' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';

                                $emailtxt .= 'Hello,' . $row['personname'] . '</p>';

                                $emailtxt .= '<p';

                                $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';

                                $emailtxt .= 'Message from ' . $rowperson['personname'] . ' For Buy Jewellery!!</p>';

                                $emailtxt .= '</td>';

                                $emailtxt .= '</tr>';

                                $emailtxt .= '<tr>';

                                $emailtxt .= '<td colspan="10"';

                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';

                                $emailtxt .= 'valign="top">';

                                $emailtxt .= '<div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';

                                $emailtxt .= '<p style="padding:10px;"><b>Jewellery :</b> ' . $contactsellerjewelleryname . '</p>

                                            <p style="padding:10px;"><b>Message :</b> ' . $messagetext . '</p>

                                            <p style="padding:10px;"><b>Offer Price :</b> $' . $offerprice . '</p>

                                            <p style="padding:10px;"><b>Send By :</b> ' . $rowperson['personname'] . '</p>

                                            <p style="padding:10px;"><b>Date Time :</b> ' . $datetime . '</p>

                                            <p style="padding:10px;"><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>';

                                $emailtxt .= '</div>';

                                $emailtxt .= '</td>';

                                $emailtxt .= '</tr>';



                                $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');

                            } else {

                                $message = $errmsg['nojewelleryfound'];

                            }

                        } else {

                            $message = $errmsg['required'];

                        }

                    }

                } else {

                    $message = $errmsg['permissionrequired'];

                }

            }

        }

    }else{

        $status=-1;

        $message="Device Logout";

    }

}

require_once dirname(__DIR__, 2) . '/config/apifoot.php';

