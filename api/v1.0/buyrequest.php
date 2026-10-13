<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2) . '/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';
require_once dirname(__DIR__, 2) . '/model/buyrequest.php';

$CanBuyRequest = $DB->getpackagewiseuserright($LoginInfo->getUid(),5)['attributeval'];
$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(),4)['attributeval'];

$candevicelogin=$DB->getDeviceInLogin($LoginInfo->getUid(),$_SERVER['HTTP_USER_AGENT']);

if ($isvalidUser['status'] == 1) {
    if($candevicelogin==1)
    {
        $status = 0;
        $message = $errmsg['invalidrequest'];
        $imageurl = $config->getImageurl();

        $CheckUserRights=$DB->checkpackagewiseuserright($uid);
        $response['IsPackageExpire']=$CheckUserRights['IsPackageExpire'];
        if($CheckUserRights['IsPackageExpire']==1){
            $message = $config->getPackageExpiredMessage();
            $ExpiryTitle = $config->getPackageExpiredTitle();
            $ExpiryURL = $config->getPackageExpiredURL();
            $response['ExpiryTitle']=$ExpiryTitle;
            $response['ExpiryURL']=$ExpiryURL;
        }else{   
            
            if($CanBuyRequest==1)
            {
                if ($action == 'addbuyrequest') {

                    $type = $IISMethods->sanitize($_POST['type']); // 1 - Public , 2 - Annonymous , 3 - Private
                    $isgetnotification = $IISMethods->sanitize($_POST['isgetnotification']); // Get Notification

                    $expirydate = $IISMethods->sanitize($_POST['expirydate']); // Expiry Date
                    $comment = $IISMethods->sanitize($_POST['comment'],'OUT'); // Comment

                    $shapeid = $_POST['shapeid']; // Shape Multiple

                    // Size
                    $fromsize = $IISMethods->sanitize($_POST['fromsize']);
                    $tosize = $IISMethods->sanitize($_POST['tosize']);

                    // Color
                    $fromcolorid = $IISMethods->sanitize($_POST['fromcolorid']);
                    $tocolorid = $IISMethods->sanitize($_POST['tocolorid']);
                    $isfancy = $IISMethods->sanitize($_POST['isfancy']);
                    if($isfancy==1)
                    {
                        $fromintensityid = $IISMethods->sanitize($_POST['fromintensityid']);
                        $tointensityid = $IISMethods->sanitize($_POST['tointensityid']);
                        $overtoneid = $_POST['overtoneid']; // Multiple
                        $fluorescenecolorid = $_POST['fluorescenecolorid']; // Multiple
                    }

                    // Clarity
                    $fromclarityid = $IISMethods->sanitize($_POST['fromclarityid']);
                    $toclarityid = $IISMethods->sanitize($_POST['toclarityid']);

                    // Cut
                    $fromcutid = $IISMethods->sanitize($_POST['fromcutid']);
                    $tocutid = $IISMethods->sanitize($_POST['tocutid']);

                    // Polish
                    $frompolishid = $IISMethods->sanitize($_POST['frompolishid']);
                    $topolishid = $IISMethods->sanitize($_POST['topolishid']);

                    // Symmetry
                    $fromsymmetryid = $IISMethods->sanitize($_POST['fromsymmetryid']);
                    $tosymmetryid = $IISMethods->sanitize($_POST['tosymmetryid']);

                    

                    // Fluorescene
                    $intensityid = $_POST['intensityid']; // Intensity Multiple
                    $colorid = $_POST['colorid']; // Color Multiple

                    // Measurement

                    $fromlength = $IISMethods->sanitize($_POST['fromlength']); // Length
                    $tolength = $IISMethods->sanitize($_POST['tolength']);   // Length

                    $fromwidth = $IISMethods->sanitize($_POST['fromwidth']); // Width
                    $towidth = $IISMethods->sanitize($_POST['towidth']); // Width

                    $fromdepth = $IISMethods->sanitize($_POST['fromdepth']); // depth
                    $todepth = $IISMethods->sanitize($_POST['todepth']); // depth

                    $fromtable = $IISMethods->sanitize($_POST['fromtable']); // table
                    $totable = $IISMethods->sanitize($_POST['totable']); // table

                    $fromdepthper = $IISMethods->sanitize($_POST['fromdepthper']); // depthper
                    $todepthper = $IISMethods->sanitize($_POST['todepthper']); // depthper

                    $fromratio = $IISMethods->sanitize($_POST['fromratio']); // ratio
                    $toratio = $IISMethods->sanitize($_POST['toratio']); // ratio


                    //  Inclusions
                    $eyecleanid = $_POST['eyecleanid']; // eyeclean Multiple


                    $frommilkyid = $IISMethods->sanitize($_POST['frommilkyid']);     // milky
                    $tomilkyid = $IISMethods->sanitize($_POST['tomilkyid']);     // milky


                    $blackinclusionsid = $_POST['blackinclusionid']; // blackinclusion Multiple
                    $whiteinclusionsid = $_POST['whiteinclusionid']; // whiteinclusion Multiple
                    $openinclusionsid = $_POST['openinclusionid']; // blackinclusion Multiple

                    // Price
                    $price = $IISMethods->sanitize($_POST['price']);

                    //Location
                    $countryid = $_POST['countryid']; // country Multiple

                    //Greading Report
                    $labid = $_POST['labid']; // lab Multiple



                    $formevent = $IISMethods->sanitize($_POST['formevent']);
                    $id = $IISMethods->sanitize($_POST['id']);
                    $currdate = $IISMethods->getcurrdate();

                    $datetime = $IISMethods->getdatetime();

                    // echo 'REST';
                    // exit;  
                   
                    // echo $isfancy;
                    // exit;
                    if ($type && $expirydate && sizeof($shapeid) > 0 && $fromsize && $tosize && (($fromcolorid && $tocolorid && $isfancy==0) || $isfancy==1) && sizeof($countryid) > 0) {
                        // print_r(implode(",",$treatmentid));

                         
                      
                        if(is_array($shapeid))
                        {
                            $fltshapeid = implode("','", $shapeid);
                        }
                        if(is_array($intensityid))
                        {
                            $fltintensityid = implode("','", $intensityid);
                        }
                        if(is_array($colorid))
                        {
                            $fltcolorid = implode("','", $colorid);
                        }
                        if(is_array($eyecleanid))
                        {
                            $flteyecleanid = implode("','", $eyecleanid);
                        }
                        if(is_array($openinclusionsid))
                        {
                            $fltopeninclusionsid = implode("','", $openinclusionsid);
                        }
                        if(is_array($blackinclusionsid))
                        {
                            $fltblackinclusionsid = implode("','", $blackinclusionsid);
                        }
                        if(is_array($whiteinclusionsid))
                        {
                            $fltwhiteinclusionsid = implode("','", $whiteinclusionsid);
                        }
                        if(is_array($countryid))
                        {
                            $fltcountryid = implode("','", $countryid);
                        }
                        if(is_array($labid))
                        {
                            $fltlabid = implode("','", $labid);
                        }
                        if(is_array($overtoneid))
                        {
                            $fltovertoneid = implode("','", $overtoneid);
                        }
                        if(is_array($fluorescenecolorid))
                        {
                            $fltfluorescenecolorid = implode("','", $fluorescenecolorid);
                        }

                        // print_r($flttreatmentid);
                        // exit;


                    

                        
                        $qrydata = "SELECT
                                IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:fromcolorid),'') AS fromcolor,
                                IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:tocolorid),'') AS tocolor,
                                IFNULL((SELECT name FROM tblclaritymaster WHERE id=:fromclarityid),'') AS fromclarity,
                                IFNULL((SELECT name FROM tblclaritymaster WHERE id=:toclarityid),'') AS toclarity,
                                IFNULL((SELECT name FROM tblcutmaster WHERE id=:fromcutid),'') AS fromcut,
                                IFNULL((SELECT name FROM tblcutmaster WHERE id=:tocutid),'') AS tocut,
                                IFNULL((SELECT name FROM tblpolishmaster WHERE id=:frompolishid),'') AS frompolish,
                                IFNULL((SELECT name FROM tblpolishmaster WHERE id=:topolishid),'') AS topolish,
                                IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:fromsymmetryid),'') AS fromsymmetry,
                                IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:tosymmetryid),'') AS tosymmetry,
                                IFNULL((SELECT name FROM tblmilkymaster WHERE id=:frommilkyid),'') AS frommilky,
                                IFNULL((SELECT name FROM tblmilkymaster WHERE id=:tomilkyid),'') AS tomilky,
                                IFNULL((SELECT name FROM tblintensitymaster WHERE id=:fromintensityid),'') AS fromintensity,
                                IFNULL((SELECT name FROM tblintensitymaster WHERE id=:tointensityid),'') AS tointensity,
                                IFNULL((SELECT group_concat(name) FROM tblovertonemaster WHERE id  IN ('" . $fltovertoneid . "')),'') AS overtone,
                                IFNULL((SELECT group_concat(name) FROM tblcolormaster WHERE id  IN ('" . $fltfluorescenecolorid . "')),'') AS fluorescenecolor,
                                IFNULL((SELECT group_concat(colorcode) FROM tblcolormaster WHERE id  IN ('" . $fltfluorescenecolorid . "')),'') AS fluorescenecolorcode,
                                IFNULL((SELECT group_concat(name) FROM tbldiamondshapemaster WHERE id  IN ('" . $fltshapeid . "')),'') AS shape,
                                IFNULL((SELECT group_concat(name) FROM tblintensitymaster WHERE id IN ('" . $fltintensityid . "')),'') AS intensity,  
                                IFNULL((SELECT group_concat(name) FROM tblcolormaster WHERE id IN ('" . $fltcolorid . "')),'') AS color,
                                IFNULL((SELECT group_concat(colorcode) FROM tblcolormaster WHERE id IN ('" . $fltcolorid . "')),'') AS colorcode,
                                IFNULL((SELECT group_concat(name) FROM tbleyecleanmaster WHERE id IN ('" . $flteyecleanid . "')),'') AS eyeclean,
                                IFNULL((SELECT group_concat(name) FROM tblopeninclusionmaster WHERE id IN ('" . $fltopeninclusionsid . "')),'') AS openinclusions,
                                IFNULL((SELECT group_concat(name) FROM tblblackinclusionmaster WHERE id IN ('" . $fltblackinclusionsid . "')),'') AS blackinclusions,
                                IFNULL((SELECT group_concat(name) FROM tblwhiteinclusionmaster WHERE id IN ('" . $fltwhiteinclusionsid . "')),'') AS whiteinclusions,
                                IFNULL((SELECT group_concat(country) FROM tblcountrymaster WHERE id IN ('" . $fltcountryid . "')),'') AS country,
                                IFNULL((SELECT group_concat(name) FROM tbllabmaster WHERE id IN ('" . $fltlabid . "')),'') AS lab,
                                IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname";
                        $paramdata = array(
                            ':fromcolorid' => $fromcolorid,
                            ':tocolorid' => $tocolorid,
                            ':fromclarityid' => $fromclarityid,
                            ':toclarityid' => $toclarityid,
                            ':fromcutid' => $fromcutid,
                            ':tocutid' => $tocutid,
                            ':frompolishid' => $frompolishid,
                            ':topolishid' => $topolishid,
                            ':fromsymmetryid' => $fromsymmetryid,
                            ':tosymmetryid' => $tosymmetryid,
                            ':frommilkyid' => $frommilkyid,
                            ':tomilkyid' => $tomilkyid,
                            ':fromintensityid' => $fromintensityid,
                            ':tointensityid' => $tointensityid,
                            ':personid' => $uid
                        );
                        //    print_r($paramdata);

                        $resdata = $DB->getmenual($qrydata, $paramdata);
                        $rowdata = $resdata[0];

                        if ($type == 1) {
                            $typetext = 'Public';
                        } else if ($type == 2) {
                            $typetext = 'Annonymous';
                        } else if ($type == 3) {
                            $typetext = 'Private';
                        }
                     
                     // extra code 
                        if(is_array($shapeid))
                        {
                            $shapeid1 = implode(',', $shapeid);
                        }  
                        if(is_array($intensityid))
                        {
                            $intensityid1 = implode(',', $intensityid);
                        }   
                        if(is_array($colorid))
                        {
                            $colorid1 = implode(',', $colorid);
                        }  
                        if(is_array($eyecleanid))
                        {
                            $eyecleanid1 = implode(',', $eyecleanid);
                        } 
                        if(is_array($blackinclusionsid))
                        {
                            $blackinclusionsid1 = implode(',', $blackinclusionsid);
                        } 
                        if(is_array($whiteinclusionsid))
                        {
                            $whiteinclusionsid1 = implode(',', $whiteinclusionsid);
                        } 
                        if(is_array($openinclusionsid))
                        {
                            $openinclusionsid1 = implode(',', $openinclusionsid);
                        } 
                        if(is_array($countryid))
                        {
                            $countryid1 = implode(',', $countryid);
                        } 
                        if(is_array($labid))
                        {
                            $labid1 = implode(',', $labid);
                        } 
                        if(is_array($overtoneid))
                        {
                            $overtoneid1 = implode(',', $overtoneid);
                        }
                        if(is_array($fluorescenecolorid))
                        {
                            $fluorescenecolorid1 = implode(',', $fluorescenecolorid);
                        }
                        $insqry = array(
                            'personid' => $uid,
                            'personname' => $rowdata['personname'],
                            'type' => $type,
                            'isgetnotification' => $isgetnotification,
                            'typetext' => $typetext,
                            'createdate' => $currdate,
                            'expirydate' => $expirydate,
                            'comment' => $comment,
                            // 'shapeid' => implode(',', $shapeid),
                            'shapeid' => $shapeid1,
                            'shape' => $rowdata['shape'],
                            'fromsize' => $fromsize,
                            'tosize' => $tosize,
                            'fromcolorid' => $fromcolorid,
                            'fromcolor' => $rowdata['fromcolor'],
                            'tocolorid' => $tocolorid,
                            'tocolor' => $rowdata['tocolor'],
                            'fromclarityid' => $fromclarityid,
                            'fromclarity' => $rowdata['fromclarity'],
                            'toclarityid' => $toclarityid,
                            'toclarity' => $rowdata['toclarity'],
                            'fromcutid' => $fromcutid,
                            'fromcut' => $rowdata['fromcut'],
                            'tocutid' => $tocutid,
                            'tocut' => $rowdata['tocut'],
                            'frompolishid' => $frompolishid,
                            'frompolish' => $rowdata['frompolish'],
                            'topolishid' => $topolishid,
                            'topolish' => $rowdata['topolish'],
                            'fromsymmetryid' => $fromsymmetryid,
                            'fromsymmetry' => $rowdata['fromsymmetry'],
                            'tosymmetryid' => $tosymmetryid,
                            'tosymmetry' => $rowdata['tosymmetry'],
                            // 'intensityid' => implode(',', $intensityid),
                            'intensityid' => $intensityid1,
                            'intensity' => $rowdata['intensity'],
                            // 'colorid' => implode(',', $colorid),
                            'colorid' => $colorid1,
                            'color' => $rowdata['color'],
                            'colorcode' => $rowdata['colorcode'],
                            'fromlength' => $fromlength,
                            'tolength' => $tolength,
                            'fromwidth' => $fromwidth,
                            'towidth' => $towidth,
                            'fromdepth' => $fromdepth,
                            'todepth' => $todepth,
                            'fromtable' => $fromtable,
                            'totable' => $totable,
                            'fromdepthper' => $fromdepthper,
                            'todepthper' => $todepthper,
                            'fromratio' => $fromratio,
                            'toratio' => $toratio,
                            // 'eyecleanid' => implode(',', $eyecleanid),
                            'eyecleanid' => $eyecleanid1,
                            'eyeclean' => $rowdata['eyeclean'],
                            'frommilkyid' => $frommilkyid,
                            'frommilky' => $rowdata['frommilky'],
                            'tomilkyid' => $tomilkyid,
                            'tomilky' => $rowdata['tomilky'],
                            // 'blackinclusionid' => implode(',', $blackinclusionsid),
                            'blackinclusionid' => $blackinclusionsid1,
                            'blackinclusion' => $rowdata['openinclusions'],
                            // 'whiteinclusionid' => implode(',', $whiteinclusionsid),
                            'whiteinclusionid' => $whiteinclusionsid1,
                            'whiteinclusion' => $rowdata['blackinclusions'],
                            // 'openinclusionid' => implode(',', $openinclusionsid),
                            'openinclusionid' => $openinclusionsid1,
                            'openinclusion' => $rowdata['whiteinclusions'],
                            'price' => $price,
                            // 'countryid' => implode(',', $countryid),
                            'countryid' => $countryid1,
                            'country' => $rowdata['country'],
                            // 'labid' => implode(',', $labid),
                            'labid' => $labid1,
                            'lab' => $rowdata['lab'],
                            'isfancy' => $isfancy,
                            'fromintensityid' => $fromintensityid,
                            'fromintensity' => $rowdata['fromintensity'],
                            'tointensityid' => $tointensityid,
                            'tointensity' => $rowdata['tointensity'],
                            // 'overtoneid' => implode(',',$overtoneid),
                            'overtoneid' => $overtoneid1,
                            'overtone' => $rowdata['overtone'],
                            // 'fluorescenecolorid' => implode(',',$fluorescenecolorid),
                            'fluorescenecolorid' => $fluorescenecolorid1,
                            'fluorescenecolor' => $rowdata['fluorescenecolor'],
                            'fluorescenecolorcode' =>$rowdata['fluorescenecolorcode'],

                        );

                      

                        if ($formevent == 'submit') 
                        {
                            $typename = 'buyrequest';
                            $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";
                            $seriesparams = array(
                                ':typename' => $typename,
                            );
                            $result_ary = $DB->getmenual($qryseries, $seriesparams);
                            $rowseries = $result_ary[0];

                            $seriesid = $rowseries['id'];
                            $seriesno = $DB->getorderno($seriesid, 'buyrequest', $currdate);
                            $maxid = $DB->getmaxid($seriesid, 'buyrequest');

                            if ($seriesid) 
                            {
                                try {
                                    $DB->begintransaction();

                                    $buyrequestid = $IISMethods->generateuuid();

                                    $insqry['id'] = $buyrequestid;
                                    $insqry['buyrequestno'] = $seriesno;
                                    $insqry['isactive'] = 1;
                                    $insqry['status'] = 0;
                                    $insqry['maxid'] = $maxid;
                                    $insqry['seriesid'] = $seriesid;
                                    $insqry['timestamp'] = $datetime;
                                    $insqry['entry_uid'] = $uid;
                                    $insqry['entry_date'] = $datetime;
                                    $DB->executedata('i', 'tblbuyrequest', $insqry, '');

                                    if (($shapeid)) 
                                    {
                                        for ($t = 0; $t < sizeof($shapeid); $t++) 
                                        {
                                            $qryshape = "SELECT name from tbldiamondshapemaster where id=:id";
                                            $parmsshape = array(
                                                ':id' => $shapeid[$t],
                                            );
                                            $result_shape = $DB->getmenual($qryshape, $parmsshape);
                                            $mshapeid = $IISMethods->generateuuid();
                                            $inspershape = array(
                                                'id' => $mshapeid,
                                                'buyrequestid' => $buyrequestid,
                                                'shapeid' => $shapeid[$t],
                                                'shape' => $result_shape[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestshape', $inspershape, '');
                                        }

                                      
                                    }

                                    if($isfancy==1)
                                    {
                                        
                                        if ($overtoneid)
                                        {
                                            
                                            for ($ot = 0; $ot < sizeof($overtoneid); $ot++) 
                                            {
                                                $qryovertone = "SELECT name from tblovertonemaster where id=:id";
                                                $parmsovertone = array(
                                                    ':id' => $overtoneid[$ot],
                                                );
                                                $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                                $movertoneid = $IISMethods->generateuuid();
                                                $otsperovertone = array(
                                                    'id' => $movertoneid,
                                                    'buyrequestid' => $buyrequestid,
                                                    'overtoneid' => $overtoneid[$ot],
                                                    'overtone' => $result_overtone[0]['name'],
                                                    'entry_uid' => $uid,
                                                    'entry_date' => $datetime,
                                                    'timestamp' => $datetime,
                                                );
                                                $DB->executedata('i', 'tblbuyrequestovertone', $otsperovertone, '');
                                            }
                                        }
                                       
                                        if (($fluorescenecolorid)) 
                                        {
                                            for ($fc = 0; $fc < sizeof($fluorescenecolorid); $fc++) 
                                            {
                                                $qryfluorescenecolor = "SELECT CONCAT(name,',',colorcode) AS clrname from tblcolormaster where id=:id";
                                                $parmsfluorescenecolor = array(
                                                    ':id' => $fluorescenecolorid[$fc],
                                                );
                                                $result_fluorescenecolor = $DB->getmenual($qryfluorescenecolor, $parmsfluorescenecolor);

                                                $clrname = explode(',', $result_fluorescenecolor[0]['clrname']);

                                                $mfluorescenecolorid = $IISMethods->generateuuid();
                                                $fcsperfluorescenecolor = array(
                                                    'id' => $mfluorescenecolorid,
                                                    'buyrequestid' => $buyrequestid,
                                                    'colorid' => $fluorescenecolorid[$fc],
                                                    'color' => $clrname[0],
                                                    'colorcode' => $clrname[1],
                                                    'entry_uid' => $uid,
                                                    'entry_date' => $datetime,
                                                    'timestamp' => $datetime,
                                                );
                                                $DB->executedata('i', 'tblbuyrequestfluorescenecolor', $fcsperfluorescenecolor, '');
                                            }

                                            
                                        }
                                        
                                    }
                                    else
                                    {
                                        if (($intensityid)) 
                                        {
                                            for ($in = 0; $in < sizeof($intensityid); $in++) 
                                            {
                                                $qryintensity = "SELECT name from tblintensitymaster where id=:id";
                                                $parmsintensity = array(
                                                    ':id' => $intensityid[$in],
                                                );
                                                $result_intensity = $DB->getmenual($qryintensity, $parmsintensity);
                                                $mintensityid = $IISMethods->generateuuid();
                                                $insperintensity = array(
                                                    'id' => $mintensityid,
                                                    'buyrequestid' => $buyrequestid,
                                                    'intensityid' => $intensityid[$in],
                                                    'intensity' => $result_intensity[0]['name'],
                                                    'entry_uid' => $uid,
                                                    'entry_date' => $datetime,
                                                    'timestamp' => $datetime,
                                                );
                                                $DB->executedata('i', 'tblbuyrequestintensity', $insperintensity, '');
                                            }
                                        }
                                    }    
                                    if (($colorid)) 
                                    {
                                        for ($c = 0; $c < sizeof($colorid); $c++) 
                                        {
                                            $qrycolor = "SELECT CONCAT(name,',',colorcode) AS clrname from tblcolormaster where id=:id";
                                            $parmscolor = array(
                                                ':id' => $colorid[$c],
                                            );
                                            $result_color = $DB->getmenual($qrycolor, $parmscolor);
                                            $mcolorid = $IISMethods->generateuuid();
                                            $clrname = explode(',', $result_color[0]['clrname']);

                                            $cspercolor = array(
                                                'id' => $mcolorid,
                                                'buyrequestid' => $buyrequestid,
                                                'colorid' => $colorid[$c],
                                                'color' => $clrname[0],
                                                'colorcode' => $clrname[1],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestcolor', $cspercolor, '');
                                        }
                                    }

                                    if (($eyecleanid)) 
                                    {
                                        for ($ec = 0; $ec < sizeof($eyecleanid); $ec++) {
                                            $qryeyeclean = "SELECT name from tbleyecleanmaster where id=:id";
                                            $parmseyeclean = array(
                                                ':id' => $eyecleanid[$ec],
                                            );
                                            $result_eyeclean = $DB->getmenual($qryeyeclean, $parmseyeclean);
                                            $meyecleanid = $IISMethods->generateuuid();
                                            $ecspereyeclean = array(
                                                'id' => $meyecleanid,
                                                'buyrequestid' => $buyrequestid,
                                                'eyecleanid' => $eyecleanid[$ec],
                                                'eyeclean' => $result_eyeclean[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequesteyeclean', $ecspereyeclean, '');
                                        }
                                    }

                                    if (($openinclusionsid)) 
                                    {
                                        for ($op = 0; $op < sizeof($openinclusionsid); $op++) {
                                            $qryopeninclusion = "SELECT name from tblopeninclusionmaster where id=:id";
                                            $parmsopeninclusion = array(
                                                ':id' => $openinclusionsid[$op],
                                            );
                                            $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                            $mopeninclusionsid = $IISMethods->generateuuid();
                                            $insperopeninclusion = array(
                                                'id' => $mopeninclusionsid,
                                                'buyrequestid' => $buyrequestid,
                                                'openinclusionsid' => $openinclusionsid[$op],
                                                'openinclusions' => $result_openinclusion[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestopeninclusions', $insperopeninclusion, '');
                                        }
                                    }

                                    if (($blackinclusionsid)) 
                                    {
                                        for ($bi = 0; $bi < sizeof($blackinclusionsid); $bi++) {
                                            $qryblackinclusion = "SELECT name from tblblackinclusionmaster where id=:id";
                                            $parmsblackinclusion = array(
                                                ':id' => $blackinclusionsid[$bi],
                                            );
                                            $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                            $mblackinclusionsid = $IISMethods->generateuuid();
                                            $insperblackinclusion = array(
                                                'id' => $mblackinclusionsid,
                                                'buyrequestid' => $buyrequestid,
                                                'blackinclusionsid' => $blackinclusionsid[$bi],
                                                'blackinclusions' => $result_blackinclusion[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestblackinclusions', $insperblackinclusion, '');
                                        }
                                    }

                                    if (($whiteinclusionsid)) 
                                    {
                                        for ($wi = 0; $wi < sizeof($whiteinclusionsid); $wi++) {
                                            $qrywhiteinclusion = "SELECT name from tblwhiteinclusionmaster where id=:id";
                                            $parmswhiteinclusion = array(
                                                ':id' => $whiteinclusionsid[$wi],
                                            );
                                            $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                            $mwhiteinclusionsid = $IISMethods->generateuuid();
                                            $insperwhiteinclusion = array(
                                                'id' => $mwhiteinclusionsid,
                                                'buyrequestid' => $buyrequestid,
                                                'whiteinclusionsid' => $whiteinclusionsid[$wi],
                                                'whiteinclusions' => $result_whiteinclusion[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestwhiteinclusions', $insperwhiteinclusion, '');
                                        }
                                    }

                                    if (($countryid)) 
                                    {
                                        for ($cm = 0; $cm < sizeof($countryid); $cm++) {
                                            $qrycountry = "SELECT country from tblcountrymaster where id=:id";
                                            $parmscountry = array(
                                                ':id' => $countryid[$cm],
                                            );
                                            $result_country = $DB->getmenual($qrycountry, $parmscountry);

                                            $mcountryid = $IISMethods->generateuuid();
                                            $inspercountry = array(
                                                'id' => $mcountryid,
                                                'buyrequestid' => $buyrequestid,
                                                'countryid' => $countryid[$cm],
                                                'country' => $result_country[0]['country'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestcountry', $inspercountry, '');
                                        }
                                    }

                                    if (($labid)) 
                                    {
                                        for ($l = 0; $l < sizeof($labid); $l++) {
                                            $qrylab = "SELECT name from tbllabmaster where id=:id";
                                            $parmslab = array(
                                                ':id' => $labid[$l],
                                            );
                                            $result_lab = $DB->getmenual($qrylab, $parmslab);

                                            $mlabid = $IISMethods->generateuuid();
                                            $insperlab = array(
                                                'id' => $mlabid,
                                                'buyrequestid' => $buyrequestid,
                                                'labid' => $labid[$l],
                                                'lab' => $result_lab[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestlab', $insperlab, '');
                                        }
                                    }

                                    $status = 1;
                                    $message = $errmsg['buyrequestinsert'];
                                    $DB->committransaction();
                                } catch (Exception $e) {
                                    $DB->rollbacktransaction($e);
                                    $status = 0;
                                    $message = $errmsg['dbtransactionerror'];
                                }
                            } else {
                                $status = 0;
                                $message = $errmsg['seriesrequired'];
                            }
                        } else if ($formevent == 'update') 
                        {
                            try 
                            {
                                $DB->begintransaction();


                                $buyrequestid = $id;

                                $insqry['timestamp'] = $datetime;
                                $insqry['update_uid'] = $uid;
                                $insqry['update_date'] = $datetime;
                                $ary = array(
                                    'id' => $buyrequestid,
                                );
                                $DB->executedata('u', 'tblbuyrequest', $insqry, $ary);


                                $shapeparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestshape', '', $shapeparams);

                                if (($shapeid)) 
                                {
                                    for ($t = 0; $t < sizeof($shapeid); $t++) {
                                        $qryshape = "SELECT name from tbldiamondshapemaster where id=:id";
                                        $parmsshape = array(
                                            ':id' => $shapeid[$t],
                                        );
                                        $result_shape = $DB->getmenual($qryshape, $parmsshape);
                                        $mshapeid = $IISMethods->generateuuid();
                                        $inspershape = array(
                                            'id' => $mshapeid,
                                            'buyrequestid' => $buyrequestid,
                                            'shapeid' => $shapeid[$t],
                                            'shape' => $result_shape[0]['name'],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequestshape', $inspershape, '');
                                    }
                                }

                                $intensityparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestintensity', '', $intensityparams);

                                $fluorescenecolorparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestfluorescenecolor', '', $fluorescenecolorparams);

                                $overtoneparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestovertone', '', $overtoneparams);

                                if($isfancy==1)
                                {
                                    if (($overtoneid)) 
                                    {
                                        for ($ot = 0; $ot < sizeof($overtoneid); $ot++) {
                                            $qryovertone = "SELECT name from tblovertonemaster where id=:id";
                                            $parmsovertone = array(
                                                ':id' => $overtoneid[$ot],
                                            );
                                            $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                            $movertoneid = $IISMethods->generateuuid();
                                            $otsperovertone = array(
                                                'id' => $movertoneid,
                                                'buyrequestid' => $buyrequestid,
                                                'overtoneid' => $overtoneid[$ot],
                                                'overtone' => $result_overtone[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestovertone', $otsperovertone, '');
                                        }
                                    }

                                    if (($fluorescenecolorid)) 
                                    {
                                        for ($fc = 0; $fc < sizeof($fluorescenecolorid); $fc++) {
                                            $qryfluorescenecolor = "SELECT CONCAT(name,',',colorcode) AS clrname from tblcolormaster where id=:id";
                                            $parmsfluorescenecolor = array(
                                                ':id' => $fluorescenecolorid[$fc],
                                            );
                                            $result_fluorescenecolor = $DB->getmenual($qryfluorescenecolor, $parmsfluorescenecolor);

                                            $clrname = explode(',', $result_fluorescenecolor[0]['clrname']);

                                            $mfluorescenecolorid = $IISMethods->generateuuid();
                                            $fcsperfluorescenecolor = array(
                                                'id' => $mfluorescenecolorid,
                                                'buyrequestid' => $buyrequestid,
                                                'colorid' => $fluorescenecolorid[$fc],
                                                'color' => $clrname[0],
                                                'colorcode' => $clrname[1],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestfluorescenecolor', $fcsperfluorescenecolor, '');
                                        }
                                    }
                                }
                                else
                                {
                                    if (($intensityid)) 
                                    {
                                        for ($in = 0; $in < sizeof($intensityid); $in++) {
                                            $qryintensity = "SELECT name from tblintensitymaster where id=:id";
                                            $parmsintensity = array(
                                                ':id' => $intensityid[$in],
                                            );
                                            $result_intensity = $DB->getmenual($qryintensity, $parmsintensity);
                                            $mintensityid = $IISMethods->generateuuid();
                                            $insperintensity = array(
                                                'id' => $mintensityid,
                                                'buyrequestid' => $buyrequestid,
                                                'intensityid' => $intensityid[$in],
                                                'intensity' => $result_intensity[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tblbuyrequestintensity', $insperintensity, '');
                                        }
                                    }
                                }

                                $colorparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestcolor', '', $colorparams);

                                if (($colorid)) 
                                {
                                    for ($c = 0; $c < sizeof($colorid); $c++) 
                                    {
                                        $qrycolor = "SELECT CONCAT(name,',',colorcode) AS clrname from tblcolormaster where id=:id";
                                        $parmscolor = array(
                                            ':id' => $colorid[$c],
                                        );
                                        $result_color = $DB->getmenual($qrycolor, $parmscolor);
                                        $mcolorid = $IISMethods->generateuuid();
                                        $clrname = explode(',', $result_color[0]['clrname']);

                                        $cspercolor = array(
                                            'id' => $mcolorid,
                                            'buyrequestid' => $buyrequestid,
                                            'colorid' => $colorid[$c],
                                            'color' => $clrname[0],
                                            'colorcode' => $clrname[1],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequestcolor', $cspercolor, '');
                                        // print_r($cspercolor);
                                        // exit;
                                    }
                                }

                               
                                $eyecleanparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequesteyeclean', '', $eyecleanparams);

                                if (($eyecleanid)) 
                                {
                                    for ($ec = 0; $ec < sizeof($eyecleanid); $ec++) {
                                        $qryeyeclean = "SELECT name from tbleyecleanmaster where id=:id";
                                        $parmseyeclean = array(
                                            ':id' => $eyecleanid[$ec],
                                        );
                                        $result_eyeclean = $DB->getmenual($qryeyeclean, $parmseyeclean);
                                        $meyecleanid = $IISMethods->generateuuid();
                                        $ecspereyeclean = array(
                                            'id' => $meyecleanid,
                                            'buyrequestid' => $buyrequestid,
                                            'eyecleanid' => $eyecleanid[$ec],
                                            'eyeclean' => $result_eyeclean[0]['name'],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequesteyeclean', $ecspereyeclean, '');
                                    }
                                }


                                $openinclusionsparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestopeninclusions', '', $openinclusionsparams);

                                if (($openinclusionsid)) 
                                {
                                    for ($op = 0; $op < sizeof($openinclusionsid); $op++) {
                                        $qryopeninclusion = "SELECT name from tblopeninclusionmaster where id=:id";
                                        $parmsopeninclusion = array(
                                            ':id' => $openinclusionsid[$op],
                                        );
                                        $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                        $mopeninclusionsid = $IISMethods->generateuuid();
                                        $insperopeninclusion = array(
                                            'id' => $mopeninclusionsid,
                                            'buyrequestid' => $buyrequestid,
                                            'openinclusionsid' => $openinclusionsid[$op],
                                            'openinclusions' => $result_openinclusion[0]['name'],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequestopeninclusions', $insperopeninclusion, '');
                                    }
                                }

                                $blackinclusionsparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestblackinclusions', '', $blackinclusionsparams);

                                if (($blackinclusionsid)) 
                                {
                                    for ($bi = 0; $bi < sizeof($blackinclusionsid); $bi++) {
                                        $qryblackinclusion = "SELECT name from tblblackinclusionmaster where id=:id";
                                        $parmsblackinclusion = array(
                                            ':id' => $blackinclusionsid[$bi],
                                        );
                                        $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                        $mblackinclusionsid = $IISMethods->generateuuid();
                                        $insperblackinclusion = array(
                                            'id' => $mblackinclusionsid,
                                            'buyrequestid' => $buyrequestid,
                                            'blackinclusionsid' => $blackinclusionsid[$bi],
                                            'blackinclusions' => $result_blackinclusion[0]['name'],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequestblackinclusions', $insperblackinclusion, '');
                                    }
                                }

                                $whiteinclusionsparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestwhiteinclusions', '', $whiteinclusionsparams);

                                if (($whiteinclusionsid)) 
                                {
                                    for ($wi = 0; $wi < sizeof($whiteinclusionsid); $wi++) {
                                        $qrywhiteinclusion = "SELECT name from tblwhiteinclusionmaster where id=:id";
                                        $parmswhiteinclusion = array(
                                            ':id' => $whiteinclusionsid[$wi],
                                        );
                                        $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                        $mwhiteinclusionsid = $IISMethods->generateuuid();
                                        $insperwhiteinclusion = array(
                                            'id' => $mwhiteinclusionsid,
                                            'buyrequestid' => $buyrequestid,
                                            'whiteinclusionsid' => $whiteinclusionsid[$wi],
                                            'whiteinclusions' => $result_whiteinclusion[0]['name'],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequestwhiteinclusions', $insperwhiteinclusion, '');
                                    }
                                }


                                $labparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestlab', '', $labparams);

                                if (($labid)) 
                                {
                                    for ($l = 0; $l < sizeof($labid); $l++) 
                                    {
                                        $qrylab = "SELECT name from tbllabmaster where id=:id";
                                        $parmslab = array(
                                            ':id' => $labid[$l],
                                        );
                                        $result_lab = $DB->getmenual($qrylab, $parmslab);

                                        $mlabid = $IISMethods->generateuuid();
                                        $insperlab = array(
                                            'id' => $mlabid,
                                            'buyrequestid' => $buyrequestid,
                                            'labid' => $labid[$l],
                                            'lab' => $result_lab[0]['name'],
                                            'entry_uid' => $uid,
                                            'entry_date' => $datetime,
                                            'timestamp' => $datetime,
                                        );
                                        $DB->executedata('i', 'tblbuyrequestlab', $insperlab, '');
                                    }
                                }

                                $status = 1;
                                $message = $errmsg['buyrequestupdate'];
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
                } else if ($action == 'listbuyrequest') // List buyrequests
                {
                    $id = $IISMethods->sanitize($_POST['id']); // Use When Update data


                    $fltmanagemybuyrequest = $IISMethods->sanitize($_POST['fltmanagemybuyrequest']); // Manage My Buy Request

                    $fltseeonly = $_POST['fltseeonly']; // See Only | 1 - Active Buy Requests, 2 - Expired Buy Requests, 3 - With Seller Responses, 4 - Without Seller Responses

                    $fltfromprice = $IISMethods->sanitize($_POST['fltfromprice']); // From Price
                    $flttoprice = $IISMethods->sanitize($_POST['flttoprice']); // To Price

                  

                    $fltshapeid = $_POST['fltshapeid']; //Multple Shape
                    if(is_array($fltshapeid))
                    {
                        $fltshapeid = implode("','", $fltshapeid);
                    }

                    $fltfromsize = $IISMethods->sanitize($_POST['fltfromsize']); // From size
                    $flttosize = $IISMethods->sanitize($_POST['flttosize']); // To size

                    $fltfromcolorid = $IISMethods->sanitize($_POST['fltfromcolorid']); // From color
                    $flttocolorid = $IISMethods->sanitize($_POST['flttocolorid']); // To color

                    $fltfromclarityid = $IISMethods->sanitize($_POST['fltfromclarityid']); // From clarity
                    $flttoclarityid = $IISMethods->sanitize($_POST['flttoclarityid']); // To clarity

                    $fltfromcutid = $IISMethods->sanitize($_POST['fltfromcutid']); // From cut
                    $flttocutid = $IISMethods->sanitize($_POST['flttocutid']); // To cut

                    $fltfrompolishid = $IISMethods->sanitize($_POST['fltfrompolishid']); // From polish
                    $flttopolishid = $IISMethods->sanitize($_POST['flttopolishid']); // To polish

                    $fltfromsymmetryid = $IISMethods->sanitize($_POST['fltfromsymmetryid']); // From symmetry
                    $flttosymmetryid = $IISMethods->sanitize($_POST['flttosymmetryid']); // To symmetry


                   

                    $fltlabid = $_POST['fltlabid']; //Multple lab.
                    if(is_array($fltlabid))
                    {

                        $fltlabid = implode("','", $fltlabid);
                    }

                    $fltintensityid = $_POST['fltintensityid']; //Multple intensity
                    if(is_array($fltintensityid))
                    {

                        $fltintensityid = implode("','", $fltintensityid);
                    }

                    $fltcountryid = $_POST['fltcountryid']; //Multple location
                    if(is_array($fltcountryid))
                    {

                        $fltcountryid = implode("','", $fltcountryid);
                    }

                    $flteyecleanid = $_POST['flteyecleanid']; //Multple eye clean
                    if(is_array($flteyecleanid))
                    {

                        $flteyecleanid = implode("','", $flteyecleanid);
                    }

                    $fltfrommilkyid = $IISMethods->sanitize($_POST['fltfrommilkyid']); // From milky
                    $flttomilkyid = $IISMethods->sanitize($_POST['flttomilkyid']); // To milky

                    $fltblackinclusionid = $_POST['fltblackinclusionid']; //Multple black inclusion
                    if(is_array($fltblackinclusionid))
                    {

                        $fltblackinclusionid = implode("','", $fltblackinclusionid);
                    }

                    $fltwhiteinclusionid = $_POST['fltwhiteinclusionid']; //Multple white inclusion
                    if(is_array($fltwhiteinclusionid))
                    {

                        $fltwhiteinclusionid = implode("','", $fltwhiteinclusionid);
                    }

                    $fltopeninclusionid = $_POST['fltopeninclusionid']; //Multple open inclusion
                    if(is_array($fltopeninclusionid))
                    {

                        $fltopeninclusionid = implode("','", $fltopeninclusionid);
                    }

                    $fltfromdate = $IISMethods->sanitize($_POST['fltfromdate']); // From date
                    $flttodate = $IISMethods->sanitize($_POST['flttodate']); // To date

                    $fltfromexpirydate = $IISMethods->sanitize($_POST['fltfromexpirydate']); // From expiry date
                    $flttoexpirydate = $IISMethods->sanitize($_POST['flttoexpirydate']); // To expiry date


                    $sortbyid = $IISMethods->sanitize($_POST['sortbyid']); // Sort By



                    $currdate = $IISMethods->getcurrdate();

                    $listbuyrequest = new listbuyrequest();
                    $params = array();

                    $query_main = "SELECT `b`.`id`,`b`.`buyrequestno`,`b`.`isgetnotification`,`b`.`personid`,`b`.`personname`,`b`.`type`,`b`.`typetext`,`b`.`createdate`,`b`.`expirydate`,`b`.`comment`,`b`.`shapeid`,`b`.`shape`,`b`.`fromsize`,`b`.`tosize`,
                                `b`.`fromcolorid`,`b`.`fromcolor`,`b`.`tocolorid`,`b`.`tocolor`,`b`.`fromclarityid`,`b`.`fromclarity`,`b`.`toclarityid`,`b`.`toclarity`,`b`.`fromcutid`,`b`.`fromcut`,
                                `b`.`tocutid`,`b`.`tocut`,`b`.`frompolishid`,`b`.`frompolish`,`b`.`topolishid`,`b`.`topolish`,`b`.`fromsymmetryid`,`b`.`fromsymmetry`,`b`.`tosymmetryid`,`b`.`tosymmetry`,
                                `b`.`intensityid`,`b`.`intensity`,`b`.`colorid`,`b`.`color`,`b`.`colorcode`,`b`.`fromlength`,`b`.`tolength`,`b`.`fromwidth`,`b`.`towidth`,`b`.`fromdepth`,`b`.`todepth`,
                                `b`.`fromtable`,`b`.`totable`,`b`.`fromdepthper`,`b`.`todepthper`,`b`.`fromratio`,`b`.`toratio`,`b`.`eyecleanid`,`b`.`eyeclean`,`b`.`frommilkyid`,`b`.`frommilky`,`b`.`tomilkyid`,
                                `b`.`tomilky`,`b`.`blackinclusionid`,`b`.`blackinclusion`,`b`.`whiteinclusionid`,`b`.`whiteinclusion`,`b`.`openinclusionid`,`b`.`openinclusion`,`b`.`price`,`b`.`countryid`,
                                `b`.`country`,`b`.`labid`,`b`.`lab`,`b`.`isactive`,`b`.`status`,`b`.`maxid`,`b`.`seriesid`,`b`.`entry_uid`,`b`.`entry_date`,`b`.`update_uid`,`b`.`update_date`,`b`.`timestamp`,
                                `isfancy`,`fromintensityid`,`fromintensity`,`tointensityid`,`tointensity`,`overtoneid`,`overtone`,`fluorescenecolorid`,`fluorescenecolor`,`fluorescenecolorcode`,
                                ifnull((SELECT companyname FROM tblcompanymaster WHERE isactive=1 and isdefault=1 ORDER BY timestamp desc limit 1),'') AS cmpname,
                                CASE WHEN (b.personid<>'".$uid."') THEN 1 ELSE 0 END AS canresponse
                                FROM `buyrequestlist` `b`
                                WHERE 1=1";

                    if ($id) {
                        $query_main .= " AND b.id=:id";
                        $params[':id'] = $id;
                    }

                    if ($fltmanagemybuyrequest) // Manage my buy request
                    {
                        $query_main .= " AND b.personid=:personid";
                        $params[':personid'] = $uid;
                    } else {
                        $query_main .= " AND b.isactive=1 ";
                        if (!$id) {
                            $query_main .= "  AND STR_TO_DATE(b.expirydate,'%d/%m/%Y')>=STR_TO_DATE(:curredate1,'%d/%m/%Y')";
                            $params[':curredate1'] = $currdate;    
                        }
                    }

                   
                    if($fltseeonly)
                    {
                        for($f=0;$f<sizeof($fltseeonly);$f++)
                        {
                            $fltseeonly = $fltseeonly[$f];
    
                            if ($fltseeonly == 1) // Active Buy Requests
                            {
                                $query_main .= " AND b.isactive=1";
                            } else if ($fltseeonly == 2) // Expired Buy Requests
                            {
                                $query_main .= " AND STR_TO_DATE(`b`.`expirydate`,'%d/%m/%Y')<STR_TO_DATE(:expirydate,'%d/%m/%Y')";
                                $params[':expirydate'] = $currdate;
                            } else if ($fltseeonly == 3) // With Seller Responses
                            {
                                $query_main .= " AND b.personid=:personid";
                            } else if ($fltseeonly == 4) // Without Seller Responses
                            {
                                $query_main .= " AND b.personid=:personid";
                            }
                        }    
                    }
                   

                   
                    if ($fltfromprice && $flttoprice) // Price
                    {
                        $query_main .= " AND b.price BETWEEN :fromprice AND :toprice";
                        $params[':fromprice'] = $fltfromprice;
                        $params[':toprice'] = $flttoprice;
                    }

                    if ($fltshapeid) // Shape
                    {
                        $query_main .= " AND (IFNULL((SELECT COUNT(bs.`id`) FROM `tblbuyrequestshape` bs WHERE b.`id`=bs.`buyrequestid` AND bs.`shapeid` IN ('" . $fltshapeid . "')),0)>0)";
                    }

                    if ($fltfromsize && $flttosize) // Size
                    {
                        // ((((:fromsize>=`b`.`fromsize` AND :fromsize<=`b`.`tosize`)) 
                        // OR (`b`.`fromsize`>=:fromsize AND `b`.`fromsize`<=:tosize)))
                        $query_main .= " AND (`b`.`fromsize`>=:fromsize AND `b`.`tosize`<=:tosize)";
                        $params[':fromsize'] = $fltfromsize;
                        $params[':tosize'] = $flttosize;
                    }

                    if ($fltfromcolorid) // From Color
                    {
                        $query_main .= " AND b.fromcolorid=:fromcolorid";
                        $params[':fromcolorid'] = $fltfromcolorid;
                    }

                    if ($flttocolorid) // To Color
                    {
                        $query_main .= " AND b.tocolorid=:tocolorid";
                        $params[':tocolorid'] = $flttocolorid;
                    }

                    if ($fltfromclarityid) // From clarity
                    {
                        $query_main .= " AND b.fromclarityid=:fromclarityid";
                        $params[':fromclarityid'] = $fltfromclarityid;
                    }

                    if ($flttoclarityid) // To clarity
                    {
                        $query_main .= " AND b.toclarityid=:toclarityid";
                        $params[':toclarityid'] = $flttoclarityid;
                    }

                    if ($fltfromcutid) // From cut
                    {
                        $query_main .= " AND b.fromcutid=:fromcutid";
                        $params[':fromcutid'] = $fltfromcutid;
                    }

                    if ($flttocutid) // To cut
                    {
                        $query_main .= " AND b.tocutid=:tocutid";
                        $params[':tocutid'] = $flttocutid;
                    }

                    if ($fltfrompolishid) // From polish
                    {
                        $query_main .= " AND b.frompolishid=:frompolishid";
                        $params[':frompolishid'] = $fltfrompolishid;
                    }

                    if ($flttopolishid) // To polish
                    {
                        $query_main .= " AND b.topolishid=:topolishid";
                        $params[':topolishid'] = $flttopolishid;
                    }

                    if ($fltfromsymmetryid) // From symmetry
                    {
                        $query_main .= " AND b.fromsymmetryid=:fromsymmetryid";
                        $params[':fromsymmetryid'] = $fltfromsymmetryid;
                    }

                    if ($flttosymmetryid) // To symmetry
                    {
                        $query_main .= " AND b.tosymmetryid=:tosymmetryid";
                        $params[':tosymmetryid'] = $flttosymmetryid;
                    }

                  
                    if ($fltlabid) // Lab
                    {
                        $query_main .= " AND (IFNULL((SELECT COUNT(bl.`id`) FROM `tblbuyrequestlab` bl WHERE b.`id`=bl.`buyrequestid` AND bl.`labid` IN ('" . $fltlabid . "')),0)>0)";
                    }

                    if ($fltintensityid) // Intensity
                    {
                        $query_main .= " AND (IFNULL((SELECT COUNT(bi.`id`) FROM `tblbuyrequestintensity` bi WHERE b.`id`=bi.`buyrequestid` AND bi.`intensityid` IN ('" . $fltintensityid . "')),0)>0)";
                    }

                    if ($fltcountryid) // Country
                    {
                        $query_main .= " AND (IFNULL((SELECT COUNT(bc.`id`) FROM `tblbuyrequestcountry` bc WHERE b.`id`=bc.`buyrequestid` AND bc.`countryid` IN ('" . $fltcountryid . "')),0)>0)";
                    }

                    if ($flteyecleanid) // Eye Clean
                    {
                        $query_main .= " AND (IFNULL((SELECT COUNT(be.`id`) FROM `tblbuyrequesteyeclean` be WHERE b.`id`=be.`buyrequestid` AND be.`eyecleanid` IN ('" . $flteyecleanid . "')),0)>0)";
                    }

                    if ($fltfrommilkyid) // From milky
                    {
                        $query_main .= " AND b.frommilkyid=:frommilkyid";
                        $params[':frommilkyid'] = $fltfrommilkyid;
                    }

                    if ($flttomilkyid) // To milky
                    {
                        $query_main .= " AND b.tomilkyid=:tomilkyid";
                        $params[':tomilkyid'] = $flttomilkyid;
                    }

                    if ($fltblackinclusionid) {
                        $query_main .= " AND (IFNULL((SELECT COUNT(bi.`id`) FROM `tblbuyrequestblackinclusions` bi WHERE b.`id`=bi.`buyrequestid` AND bi.`blackinclusionsid` IN ('" . $fltblackinclusionid . "')),0)>0)";
                    }
                    if ($fltwhiteinclusionid) {
                        $query_main .= " AND (IFNULL((SELECT COUNT(wi.`id`) FROM `tblbuyrequestwhiteinclusions` wi WHERE b.`id`=wi.`buyrequestid` AND wi.`whiteinclusionsid` IN ('" . $fltwhiteinclusionid . "')),0)>0)";
                    }
                    if ($fltopeninclusionid) {
                        $query_main .= " AND (IFNULL((SELECT COUNT(oi.`id`) FROM `tblbuyrequestopeninclusions` oi WHERE b.`id`=oi.`buyrequestid` AND oi.`openinclusionsid` IN ('" . $fltopeninclusionid . "')),0)>0)";
                    }
                    if ($fltfromdate && $flttodate) {
                        $query_main .= " AND STR_TO_DATE(b.createdate,'%d/%m/%Y') BETWEEN STR_TO_DATE(:fromdate,'%d/%m/%Y') AND STR_TO_DATE(:todate,'%d/%m/%Y')";
                        $params[':fromdate'] = $fltfromdate;
                        $params[':todate'] = $flttodate;
                    }
                    if ($fltfromexpirydate && $flttoexpirydate) {
                        $query_main .= " AND STR_TO_DATE(b.expirydate,'%d/%m/%Y') BETWEEN STR_TO_DATE(:fromexpdate,'%d/%m/%Y') AND STR_TO_DATE(:toexpdate,'%d/%m/%Y')";
                        $params[':fromexpdate'] = $fltfromexpirydate;
                        $params[':toexpdate'] = $flttoexpirydate;
                    }

                   

                    $query_extra .= " GROUP BY b.id";
                    if($sortbyid>0) 
                    {
                        if($sortbyid==1)
                        {
                            $query_extra .= " ORDER BY b.buyrequestno asc";
                        }
                        else if($sortbyid==2)
                        {
                            $query_extra .= " ORDER BY b.typetext asc";
                        }
                        else if($sortbyid==3)
                        {
                            $query_extra .= " ORDER BY str_to_date(`b`.`createdate`,'%d/%m/%Y') asc";
                        }
                        else if($sortbyid==4)
                        {
                            $query_extra .= " ORDER BY str_to_date(`b`.`expirydate`,'%d/%m/%Y') asc";
                        }
                        else if($sortbyid==5)
                        {
                            $query_extra .= " ORDER BY b.personname asc";
                        }
                    }
                    else
                    {
                        $query_extra .= " ORDER BY b.timestamp desc";
                    }
                        
                    
                    
                    $query_extra .= " LIMIT $start, $per_page";
                    $query = $query_main . $query_extra;
                    // echo $query;
                    //  print_r($params);
                    $result_ary = $DB->getmenual($query, $params, 'listbuyrequest');
                    if (sizeof($result_ary) > 0) {

                        $response['data'] = $result_ary;
                        // print_r($result_ary);

                        for ($i = 0; $i < sizeof($result_ary); $i++) {
                            $ins_id = $result_ary[$i]->getId();
                            $ins_personid = $result_ary[$i]->getpersonid();





                            //buyrequest black inclusions
                            $listblackinclusions = new listblackinclusions();
                            $qryblackinclusions = "SELECT bb.`id`,bb.`buyrequestid`,bb.`blackinclusionsid`,bb.`blackinclusions`,bb.`entry_uid`,bb.`entry_date`,bb.`timestamp` 
                                                FROM `tblbuyrequestblackinclusions` bb
                                                WHERE bb.`buyrequestid`=:buyrequestid";
                            $paramblackinclusions = array(':buyrequestid' => $ins_id);
                            $result_blackinclusions = $DB->getmenual($qryblackinclusions, $paramblackinclusions, 'listblackinclusions');

                            $result_ary[$i]->sethasblackinclusions(0);
                            if (sizeof($result_blackinclusions) > 0) {
                                $result_ary[$i]->sethasblackinclusions(1);
                                $result_ary[$i]->setblackinclusionsdetail($result_blackinclusions);
                            }


                            //buyrequest white inclusions
                            $listwhiteinclusions = new listwhiteinclusions();
                            $qrywhiteinclusions = "SELECT wi.`id`,wi.`buyrequestid`,wi.`whiteinclusionsid`,wi.`whiteinclusions`,wi.`entry_uid`,wi.`entry_date`,wi.`timestamp` 
                                                FROM `tblbuyrequestwhiteinclusions` wi
                                                WHERE wi.`buyrequestid`=:buyrequestid";
                            $paramwhiteinclusions = array(':buyrequestid' => $ins_id);
                            $result_whiteinclusions = $DB->getmenual($qrywhiteinclusions, $paramwhiteinclusions, 'listwhiteinclusions');

                            $result_ary[$i]->sethaswhiteinclusions(0);
                            if (sizeof($result_whiteinclusions) > 0) {
                                $result_ary[$i]->sethaswhiteinclusions(1);
                                $result_ary[$i]->setwhiteinclusionsdetail($result_whiteinclusions);
                            }

                            //buyrequest open inclusions
                            $listopeninclusions = new listopeninclusions();
                            $qryopeninclusions = "SELECT bo.`id`,bo.`buyrequestid`,bo.`openinclusionsid`,bo.`openinclusions`,bo.`entry_uid`,bo.`entry_date`,bo.`timestamp` 
                                                FROM `tblbuyrequestopeninclusions` bo
                                                WHERE bo.`buyrequestid`=:buyrequestid";
                            $paramopeninclusions = array(':buyrequestid' => $ins_id);
                            $result_openinclusions = $DB->getmenual($qryopeninclusions, $paramopeninclusions, 'listopeninclusions');

                            $result_ary[$i]->sethasopeninclusions(0);
                            if (sizeof($result_openinclusions) > 0) {
                                $result_ary[$i]->sethasopeninclusions(1);
                                $result_ary[$i]->setopeninclusionsdetail($result_openinclusions);
                            }


                            //buyrequest color
                            $listbuyrequestcolor = new listbuyrequestcolor();
                            $qrybuyrequestcolor = "SELECT bc.`id`,bc.`buyrequestid`,bc.`colorid`,bc.`color`,bc.`colorcode`,bc.`entry_uid`,bc.`entry_date`,bc.`timestamp` 
                                                FROM `tblbuyrequestcolor` bc
                                                WHERE bc.`buyrequestid`=:buyrequestid";
                            $parambuyrequestcolor = array(':buyrequestid' => $ins_id);
                            $result_buyrequestcolor = $DB->getmenual($qrybuyrequestcolor, $parambuyrequestcolor, 'listbuyrequestcolor');

                            $result_ary[$i]->sethasbuyrequestcolor(0);
                            if (sizeof($result_buyrequestcolor) > 0) {
                                $result_ary[$i]->sethasbuyrequestcolor(1);
                                $result_ary[$i]->setbuyrequestcolordetail($result_buyrequestcolor);
                            }

                            //buyrequest country
                            $listbuyrequestcountry = new listbuyrequestcountry();
                            $qrybuyrequestcountry = "SELECT bc.`id`,bc.`buyrequestid`,bc.`countryid`,bc.`country`,bc.`entry_uid`,bc.`entry_date`,bc.`timestamp` 
                                                FROM `tblbuyrequestcountry` bc
                                                WHERE bc.`buyrequestid`=:buyrequestid";
                            $parambuyrequestcountry = array(':buyrequestid' => $ins_id);
                            $result_buyrequestcountry = $DB->getmenual($qrybuyrequestcountry, $parambuyrequestcountry, 'listbuyrequestcountry');

                            $result_ary[$i]->sethasbuyrequestcountry(0);
                            if (sizeof($result_buyrequestcountry) > 0) {
                                $result_ary[$i]->sethasbuyrequestcountry(1);
                                $result_ary[$i]->setbuyrequestcountrydetail($result_buyrequestcountry);
                            }


                            //buyrequest eye clean
                            $listbuyrequesteyeclean = new listbuyrequesteyeclean();
                            $qrybuyrequesteyeclean = "SELECT ec.`id`,ec.`buyrequestid`,ec.`eyecleanid`,ec.`eyeclean`,ec.`entry_uid`,ec.`entry_date`,ec.`timestamp` 
                                                FROM `tblbuyrequesteyeclean` ec
                                                WHERE ec.`buyrequestid`=:buyrequestid";
                            $parambuyrequesteyeclean = array(':buyrequestid' => $ins_id);
                            $result_buyrequesteyeclean = $DB->getmenual($qrybuyrequesteyeclean, $parambuyrequesteyeclean, 'listbuyrequesteyeclean');

                            $result_ary[$i]->sethasbuyrequesteyeclean(0);
                            if (sizeof($result_buyrequesteyeclean) > 0) {
                                $result_ary[$i]->sethasbuyrequesteyeclean(1);
                                $result_ary[$i]->setbuyrequesteyecleandetail($result_buyrequesteyeclean);
                            }

                            //buyrequest intensity
                            $listbuyrequestintensity = new listbuyrequestintensity();
                            $qrybuyrequestintensity = "SELECT bi.`id`,bi.`buyrequestid`,bi.`intensityid`,bi.`intensity`,bi.`entry_uid`,bi.`entry_date`,bi.`timestamp` 
                                                FROM `tblbuyrequestintensity` bi
                                                WHERE bi.`buyrequestid`=:buyrequestid";
                            $parambuyrequestintensity = array(':buyrequestid' => $ins_id);
                            $result_buyrequestintensity = $DB->getmenual($qrybuyrequestintensity, $parambuyrequestintensity, 'listbuyrequestintensity');

                            $result_ary[$i]->sethasbuyrequestintensity(0);
                            if (sizeof($result_buyrequestintensity) > 0) {
                                $result_ary[$i]->sethasbuyrequestintensity(1);
                                $result_ary[$i]->setbuyrequestintensitydetail($result_buyrequestintensity);
                            }

                            //buyrequest lab
                            $listbuyrequestlab = new listbuyrequestlab();
                            $qrybuyrequestlab = "SELECT bl.`id`,bl.`buyrequestid`,bl.`labid`,bl.`lab`,bl.`entry_uid`,bl.`entry_date`,bl.`timestamp` 
                                                FROM `tblbuyrequestlab` bl
                                                WHERE bl.`buyrequestid`=:buyrequestid";
                            $parambuyrequestlab = array(':buyrequestid' => $ins_id);
                            $result_buyrequestlab = $DB->getmenual($qrybuyrequestlab, $parambuyrequestlab, 'listbuyrequestlab');

                            $result_ary[$i]->sethasbuyrequestlab(0);
                            if (sizeof($result_buyrequestlab) > 0) {
                                $result_ary[$i]->sethasbuyrequestlab(1);
                                $result_ary[$i]->setbuyrequestlabdetail($result_buyrequestlab);
                            }

                            //buyrequest shape
                            $listbuyrequestshape = new listbuyrequestshape();
                            $qrybuyrequestshape = "SELECT bs.`id`,bs.`buyrequestid`,bs.`shapeid`,bs.`shape`,bs.`entry_uid`,bs.`entry_date`,bs.`timestamp` 
                                                FROM `tblbuyrequestshape` bs
                                                WHERE bs.`buyrequestid`=:buyrequestid";
                            $parambuyrequestshape = array(':buyrequestid' => $ins_id);
                            $result_buyrequestshape = $DB->getmenual($qrybuyrequestshape, $parambuyrequestshape, 'listbuyrequestshape');

                            $result_ary[$i]->sethasbuyrequestshape(0);
                            if (sizeof($result_buyrequestshape) > 0) {
                                $result_ary[$i]->sethasbuyrequestshape(1);
                                $result_ary[$i]->setbuyrequestshapedetail($result_buyrequestshape);
                            }

                            //buyrequest over tone
                            $listbuyrequestovertone = new listbuyrequestovertone();
                            $qrybuyrequestovertone = "SELECT bs.`id`,bs.`buyrequestid`,bs.`overtoneid`,bs.`overtone`,bs.`entry_uid`,bs.`entry_date`,bs.`timestamp` 
                                                    FROM `tblbuyrequestovertone` bs
                                                    WHERE bs.`buyrequestid`=:buyrequestid";
                            $parambuyrequestovertone = array(':buyrequestid' => $ins_id);
                            $result_buyrequestovertone = $DB->getmenual($qrybuyrequestovertone, $parambuyrequestovertone, 'listbuyrequestovertone');
            
                            $result_ary[$i]->sethasbuyrequestovertone(0);
                            if (sizeof($result_buyrequestovertone) > 0) {
                                $result_ary[$i]->sethasbuyrequestovertone(1);
                                $result_ary[$i]->setbuyrequestovertonedetail($result_buyrequestovertone);
                            }

                            //buyrequest over tone
                            $listbuyrequestfluorescenecolor = new listbuyrequestfluorescenecolor();
                            $qrybuyrequestfluorescenecolor = "SELECT bs.`id`,bs.`buyrequestid`,bs.`colorid`,bs.`color`,bs.`entry_uid`,bs.`entry_date`,bs.`timestamp` 
                                                    FROM `tblbuyrequestfluorescenecolor` bs
                                                    WHERE bs.`buyrequestid`=:buyrequestid";
                            $parambuyrequestfluorescenecolor = array(':buyrequestid' => $ins_id);
                            $result_buyrequestfluorescenecolor = $DB->getmenual($qrybuyrequestfluorescenecolor, $parambuyrequestfluorescenecolor, 'listbuyrequestfluorescenecolor');
            
                            $result_ary[$i]->sethasbuyrequestfluorescenecolor(0);
                            if (sizeof($result_buyrequestfluorescenecolor) > 0) {
                                $result_ary[$i]->sethasbuyrequestfluorescenecolor(1);
                                $result_ary[$i]->setbuyrequestfluorescenecolordetail($result_buyrequestfluorescenecolor);
                            }


                            // // person Details

                            $persondetails = new persondetails();
                            $qryperson = "SELECT id,personname,email,companyname,address,additionaladdress,statename,cityname,pincode,emergencypersonname as refname1,emergencypersonname1 as refname2,countryname,businesstype,ifnull(businessphoneno,'') AS businessphoneno,ifnull(businesswebsite,'') AS businesswebsite,businesscompanyno,
                                        case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg,phonecodeid,countrycode,phonecode  
                                        FROM tblpersonmaster 
                                        WHERE id=:id";
                            $paramperson = array(':id' => $ins_personid, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imageurl);
                            $resperson = $DB->getmenual($qryperson, $paramperson, 'persondetails');
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
                        $totalbuyrequest = sizeof($res);
                        $response['totalbuyrequest'] = $totalbuyrequest;

                        // print_r($response);
                        $status = 1;
                        $message = $errmsg['success'];
                    } else {
                        if($page<=0 && sizeof($result_ary)<=0)
                        {
                            $message = $errmsg['nobuyrequestfound'];
                        }   
                        else
                        {
                            $status = 1;
                            $message = $errmsg['success'];
                        }
                    }
                } else if ($action == 'deletebuyrequest') {
                    $id = $IISMethods->sanitize($_POST['id']);
                    if ($id && $uid) {
                        $qrybuyrequest = "SELECT id FROM tblbuyrequest WHERE personid=:personid AND id=:id AND status=0";
                        $parambuyrequest = array(':personid' => $uid, ':id' => $id);
                        $resbuyrequest = $DB->getmenual($qrybuyrequest, $parambuyrequest);

                        if (sizeof($resbuyrequest) > 0) {
                            try {
                                $DB->begintransaction();
                                $rowdm = $resbuyrequest[0];
                                $buyrequestid = $rowdm['id'];

                                $params = array(
                                    'id' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequest', '', $params);

                                $fluorescenecolorparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestfluorescenecolor', '', $fluorescenecolorparams);

                                $overtoneparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestovertone', '', $overtoneparams);

                                $openinclusionsparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestopeninclusions', '', $openinclusionsparams);

                                $blackinclusionsparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestblackinclusions', '', $blackinclusionsparams);

                                $whiteinclusionsparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestwhiteinclusions', '', $whiteinclusionsparams);

                                $colorparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestcolor', '', $colorparams);

                                $countryparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestcountry', '', $countryparams);

                                $eyecleanparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequesteyeclean', '', $eyecleanparams);

                                $intensityparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestintensity', '', $intensityparams);

                                $labparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestlab', '', $labparams);

                                $shapeparams = array(
                                    'buyrequestid' => $buyrequestid
                                );
                                $DB->executedata('d', 'tblbuyrequestshape', '', $shapeparams);

                                $status = 1;
                                $message = $errmsg['buyrequestdelete'];
                                $DB->committransaction();
                            } catch (Exception $e) {
                                $DB->rollbacktransaction($e);
                                $status = 0;
                                $message = $errmsg['dbtransactionerror'];
                            }
                        }
                    }
                }
                else if ($action == 'buyrequestrespond') {
                    $buyrequestrespondid = $IISMethods->sanitize($_POST['buyrequestrespondid']);
                    $buyrequestrespondname = $IISMethods->sanitize($_POST['buyrequestrespondname']);
                    $messagetext = $IISMethods->sanitize($_POST['respondtext']);


                    $datetime = $IISMethods->getdatetime();
                    if($CanMemberToMemberChat==1)
                    {
                        if ($buyrequestrespondid && $uid) {
                            if ($messagetext) {
                                $qrychk = "SELECT d.id,d.personid,d.personname,pm.email,pm.businessphoneno AS contact,pm.phonecode
                                        FROM buyrequestlist d
                                        inner join tblpersonmaster pm on pm.id=d.personid
                                        WHERE d.id=:id";
                                $paramchk = array(':id' => $buyrequestrespondid);
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
                                            'name' => $buyrequestrespondname,
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
                                        $qryuname = "SELECT uniqname FROM tblchatmessage WHERE groupid=:groupid AND buyrequestid=:buyrequestid AND issupport=1  AND chattype=2";
                                        $paramuname = array(':groupid' => $groupid, ':buyrequestid' => $buyrequestrespondid);
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
                                            'diamondid' => '',
                                            'diamondname' => '',
                                            'buyrequestid' => $buyrequestrespondid,
                                            'buyrequestname' => $buyrequestrespondname,
                                            'persontype' => 1,
                                            'chattype' => 2,
                                            'responsetype' => 2,
                                        );
                                        $DB->executedata('i', 'tblchatmessage', $inschatmsgdata, '');
                                        $persondata=array(
                                            'chatmsgid'=>$audchat_id,
                                            'lastchatmsg'=>$messagetext,
                                            'msgfiletype'=>0,
                                            'lastchat_date'=>$datetime
                                        );
                                        $extraparams=array(
                                            'id'=>$personid
                                        );
                                        $DB->executedata('u','tblpersonmaster',$persondata,$extraparams);	
                                    }
                                    $status = 1;
                                    $message = $errmsg['messagesend'];

                                    $emailto = $row['email'];
                                    // $subject = 'Message from ' . $rowperson['personname'] . '(' . $rowperson['contact'] . ') On Buy Request('.$buyrequestrespondname.')!!';
                                    
                                    // $emailtxt.='';

                                    // $emailtxt.='<tr>';
                                    // $emailtxt.='<td colspan="10"';
                                    // $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
                                    // $emailtxt.='valign="top">';
                                    // $emailtxt.='<p';
                                    // $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
                                    // $emailtxt.='Hello,' . $row['personname'] . '(' . $row['phonecode'] . ' ' . $row['contact'] . ')</p>';
                                    // $emailtxt.='<p';
                                    // $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
                                    // $emailtxt.='Message from ' . $rowperson['personname'] . '(<a href="tel:' . $rowperson['phonecode'] . '' . $rowperson['contact'] . '">' . $rowperson['phonecode'] . ' ' . $rowperson['contact'] . '</a>) On Buy Request('.$buyrequestrespondname.')!!</p>';
                                    // $emailtxt.='</td>';
                                    // $emailtxt.='</tr>';
                                    // $emailtxt.='<tr>';
                                    // $emailtxt.='<td colspan="10"';
                                    // $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';
                                    // $emailtxt.='valign="top">';
                                    // $emailtxt.='<div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';
                                    // $emailtxt.='<p style="padding:10px;"><b>Buy Request :</b> ' . $buyrequestrespondname . '</p>
                                    //             <p style="padding:10px;"><b>Message :</b> ' . $messagetext . '</p>
                                    //             <p style="padding:10px;"><b>Send By :</b> ' . $rowperson['personname'] . '(<a href="tel:' . $rowperson['phonecode'] . '' . $rowperson['contact'] . '">' . $rowperson['phonecode'] . ' ' . $rowperson['contact'] . '</a>)</p>
                                    //             <p style="padding:10px;"><b>Date Time :</b> ' . $datetime . '</p>
                                    //             <p style="padding:10px;"><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>';
                                    // $emailtxt.='</div>';
                                    // $emailtxt.='</td>';
                                    // $emailtxt.='</tr>';

                                    $subject = 'Message from ' . $rowperson['personname'] . ' On Buy Request('.$buyrequestrespondname.')!!';
                                    
                                    $emailtxt.='';

                                    $emailtxt.='<tr>';
                                    $emailtxt.='<td colspan="10"';
                                    $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
                                    $emailtxt.='valign="top">';
                                    $emailtxt.='<p';
                                    $emailtxt.=' style="font-size: 30px;color: #669934;font-weight: 600;margin: 0;text-align: center;">';
                                    $emailtxt.='Hello,' . $row['personname'] . '</p>';
                                    $emailtxt.='<p';
                                    $emailtxt.=' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
                                    $emailtxt.='Message from ' . $rowperson['personname'] . ' On Buy Request('.$buyrequestrespondname.')!!</p>';
                                    $emailtxt.='</td>';
                                    $emailtxt.='</tr>';
                                    $emailtxt.='<tr>';
                                    $emailtxt.='<td colspan="10"';
                                    $emailtxt.=' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';
                                    $emailtxt.='valign="top">';
                                    $emailtxt.='<div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';
                                    $emailtxt.='<p style="padding:10px;"><b>Buy Request :</b> ' . $buyrequestrespondname . '</p>
                                                <p style="padding:10px;"><b>Message :</b> ' . $messagetext . '</p>
                                                <p style="padding:10px;"><b>Send By :</b> ' . $rowperson['personname'] . '</p>
                                                <p style="padding:10px;"><b>Date Time :</b> ' . $datetime . '</p>
                                                <p style="padding:10px;"><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>';
                                    $emailtxt.='</div>';
                                    $emailtxt.='</td>';
                                    $emailtxt.='</tr>';

                                    $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');
                                } else {
                                    $message = $errmsg['nobuyrequestfound'];
                                }
                            } else {
                                $message = $errmsg['required'];
                            }
                        }
                    }
                    else
                    {
                        $message = $errmsg['permissionrequired'];
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
require_once dirname(__DIR__, 2) . '/config/apifoot.php';
