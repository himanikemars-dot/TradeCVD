<?php
header("Content-Type:application/json");
require_once dirname(__DIR__, 2) . '/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';
require_once dirname(__DIR__, 2) . '/model/diamond.php';

// 1 - Diamond Search , 6 - List Diamonds for Sale, 3 - Share Diamonds and Jewelry, 8 - SavaniGems XL for Excel

$CanDiamondSearch = $DB->getpackagewiseuserright($LoginInfo->getUid(), 1)['attributeval'];
$CanListDiamondForList = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['attributeval'];
$CanShareDiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 3)['attributeval'];
$CanListDiamondXL = $DB->getpackagewiseuserright($LoginInfo->getUid(), 8)['attributeval'];
$CanMemberToMemberChat = $DB->getpackagewiseuserright($LoginInfo->getUid(), 4)['attributeval'];

$isfromwebsite = $IISMethods->sanitize($_POST['isfromwebsite']);


$CanMembernolimitdiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['isnolimit'];
$CanMemberlimitdiamond = $DB->getpackagewiseuserright($LoginInfo->getUid(), 6)['limitvalue'];
$totaldiamondupload=$DB->getTotalDiamond($LoginInfo->getUid());

$candevicelogin=$DB->getDeviceInLogin($LoginInfo->getUid(),$_SERVER['HTTP_USER_AGENT']);

if ($isvalidUser['status'] == 1) {
    if($candevicelogin==1)
    {
        $status = 0;
        $message = $errmsg['invalidrequest'];
        $imageurl = $config->getImageurl();
        $CheckUserRights = $DB->checkpackagewiseuserright($uid);
        $response['IsPackageExpire'] = $CheckUserRights['IsPackageExpire'];
        if ($CheckUserRights['IsPackageExpire'] == 1 && $isfromwebsite != 1) {
            $message = $config->getPackageExpiredMessage();
            $ExpiryTitle = $config->getPackageExpiredTitle();
            $ExpiryURL = $config->getPackageExpiredURL();
            $response['ExpiryTitle'] = $ExpiryTitle;
            $response['ExpiryURL'] = $ExpiryURL;
        } else {
            if ($action == 'uploaddiamond') {
                /**********General Information**************/
                
                $stock = $IISMethods->sanitize($_POST['stock']);
                $price = $IISMethods->sanitize($_POST['price']);
                $totalprice = $IISMethods->sanitize($_POST['totalprice']);
                $savanipercentage = $IISMethods->sanitize($_POST['savanipercentage']);
                $ispricectsavani = $IISMethods->sanitize($_POST['ispricectsavani']);
                $availabilityid = $IISMethods->sanitize($_POST['availabilityid']);
                $countryid = $IISMethods->sanitize($_POST['countryid']);
                $stateid = $IISMethods->sanitize($_POST['stateid']);
                $city = $IISMethods->sanitize($_POST['city']);

                /***********Report Information**************/

                $shapeid = $IISMethods->sanitize($_POST['shapeid']);
                // $sizeid=$IISMethods->sanitize($_POST['sizeid']);
                $size = $IISMethods->sanitize($_POST['size']);
                $colorid = $IISMethods->sanitize($_POST['colorid']);
                $clarityid = $IISMethods->sanitize($_POST['clarityid']);

                $sizeid = '';
                if ($size) // Size
                {
                    $qrysize = "SELECT id FROM tblsizemaster WHERE name=:size";
                    $paramsize = array(':size' => $size);
                    $ressize = $DB->getmenual($qrysize, $paramsize);
                    if (sizeof($ressize) > 0) {
                        $rowsize = $ressize[0];
                        $sizeid = $rowsize['id'];
                    } else {
                        $sizeid = $IISMethods->generateuuid();

                        $insqrysize['id'] = $sizeid;
                        $insqrysize['name'] = $size;
                        $insqrysize['timestamp'] = $datetime;
                        $insqrysize['entry_uid'] = $uid;
                        $insqrysize['entry_date'] = $datetime;
                        $DB->executedata('i', 'tblsizemaster', $insqrysize, '');
                    }
                }


                //Shape
                $cutid = $IISMethods->sanitize($_POST['cutid']);
                $polishid = $IISMethods->sanitize($_POST['polishid']);
                $symmetryid = $IISMethods->sanitize($_POST['symmetryid']);

                //Fluorescene
                $intensityid = $IISMethods->sanitize($_POST['intensityid']);
                $fluorescenecolorid = $IISMethods->sanitize($_POST['fluorescenecolorid']);

                //Measurement
                $length = $IISMethods->sanitize($_POST['length']);
                $width = $IISMethods->sanitize($_POST['width']);
                $depth = $IISMethods->sanitize($_POST['depth']);

                $depthper = $IISMethods->sanitize($_POST['depthper']);
                $tableper = $IISMethods->sanitize($_POST['tableper']);

                //Crown
                $crownangle = $IISMethods->sanitize($_POST['crownangle']);
                $crownheight = $IISMethods->sanitize($_POST['crownheight']);

                //Pavilion 
                $pavilionangle = $IISMethods->sanitize($_POST['pavilionangle']);
                $pavilionheight = $IISMethods->sanitize($_POST['pavilionheight']);

                //Gridle
                $gridleconditionid = $IISMethods->sanitize($_POST['gridleconditionid']);
                $gridleminid = $IISMethods->sanitize($_POST['gridleminid']);
                $gridlemaxid = $IISMethods->sanitize($_POST['gridlemaxid']);
                $gridleper = $IISMethods->sanitize($_POST['gridleper']);

                //Culet
                $culetconditionid = $IISMethods->sanitize($_POST['culetconditionid']);
                $culetsizeid = $IISMethods->sanitize($_POST['culetsizeid']);

                //Treatment
                $treatmentid = $_POST['treatmentid']; // Multiple

                $laserinscription = $IISMethods->sanitize($_POST['laserinscription']);

                $starlength = $IISMethods->sanitize($_POST['starlength']);

                //Lab
                $labid = $IISMethods->sanitize($_POST['labid']);

                $reportnumber = $IISMethods->sanitize($_POST['reportnumber']);
                $showonsavanigems = $IISMethods->sanitize($_POST['showonsavanigems']);

                $reportdate = $IISMethods->sanitize($_POST['reportdate']);

                $lablocation = $IISMethods->sanitize($_POST['lablocation']);

                $reportcomment = $IISMethods->sanitize($_POST['reportcomment']);

                $keytosymbolsid = $_POST['keytosymbolsid']; // Multiple

                //Fancy Color
                $withfancycolor = $IISMethods->sanitize($_POST['withfancycolor']);
                $fancyintensityid = $IISMethods->sanitize($_POST['fancyintensityid']);
                $overtoneid = $_POST['overtoneid'];    //Multiple
                $fancycolorid1 = $IISMethods->sanitize($_POST['fancycolorid1']);
                $fancycolorid2 = $IISMethods->sanitize($_POST['fancycolorid2']);


                /***********Other Information**************/

                $matchedpair = $IISMethods->sanitize($_POST['matchedpair']);
                $stocknumber = $IISMethods->sanitize($_POST['stocknumber']);
                $ispairseparable = $IISMethods->sanitize($_POST['ispairseparable']);

                $isdownload = $IISMethods->sanitize($_POST['isdownload']);

                $tradeshowid = $IISMethods->sanitize($_POST['tradeshowid']);

                $brandid = $IISMethods->sanitize($_POST['brandid']);

                $suppliercomment = $IISMethods->sanitize($_POST['suppliercomment']);

                $isparcel = $IISMethods->sanitize($_POST['isparcel']);
                $numofdiamond = $IISMethods->sanitize($_POST['numofdiamond']);
                if ($isparcel == 1) {
                    $size = $IISMethods->sanitize($_POST['numofdiamond']);
                }

                /***********Image & Report Scan**************/
                $reportfile = $_FILES['reportfile']['name'];
                $reportfilelink = $IISMethods->sanitize($_POST['reportfilelink']);

                $diamondimg = $_FILES['diamondimg']['name'];


                $diamondimglink = $IISMethods->sanitize($_POST['diamondimglink']);

                $videolink = $IISMethods->sanitize($_POST['videolink']);


                $sarineloupe = $IISMethods->sanitize($_POST['sarineloupe']);

                /***********Additional Information**************/


                $sellerspecification = $IISMethods->sanitize($_POST['sellerspecification']);
                $shadeid = $IISMethods->sanitize($_POST['shadeid']);
                $milkyid = $IISMethods->sanitize($_POST['milkyid']);
                $eyecleanid = $IISMethods->sanitize($_POST['eyecleanid']);
                $openinclusionsid = $_POST['openinclusionsid'];
                $blackinclusionsid = $_POST['blackinclusionsid'];
                $whiteinclusionsid = $_POST['whiteinclusionsid'];
                $roughdiamondsourceid = $IISMethods->sanitize($_POST['roughdiamondsourceid']);


                // $videolink = $IISMethods->sanitize($_POST['videolink']);

                $piecepercarat = $IISMethods->sanitize($_POST['piecepercarat']);


                $sieveid = $IISMethods->sanitize($_POST['sieveid']);
                $tosieveid = $IISMethods->sanitize($_POST['tosieveid']);

                $iscustomsieve=$IISMethods->sanitize($_POST['iscustomsieve']);
                if($iscustomsieve==1)
                {
                    $fromsievename=$IISMethods->sanitize($_POST['fromsievename'],'OUT');
                    $tosievename=$IISMethods->sanitize($_POST['tosievename'],'OUT');

                    if($fromsievename)
                    {
                        $qryfsieve="SELECT id,name FROM tblsievemaster WHERE name=:fromsievename";
                        $fsieveparams=array(':fromsievename'=>$fromsievename);
                        $fsieveres=$DB->getmenual($qryfsieve,$fsieveparams);
                        if(sizeof($fsieveres)>0)
                        {
                            $sieveid=$fsieveres[0]['id'];
                        }else{
                            $qrysieve="SELECT IFNULL(displayorder,0) AS displayorder FROM tblsievemaster order by displayorder desc limit 1";
                            $sieveparams=array();
                            $ressieve=$DB->getmenual($qrysieve,$sieveparams);
                            $rowsieve=$ressieve[0];
                            $sievedispalyorder=1;
                            if($rowsieve['displayorder']>0)
                            {
                                $sievedispalyorder=$rowsieve['displayorder']+1;
                            }
                            $sieveid = $IISMethods->generateuuid();

                            $sievedata['id'] = $sieveid;
                            $sievedata['name'] = $fromsievename;
                            $sievedata['isactive'] = 1;
                            $sievedata['displayorder'] = $sievedispalyorder;
                            $sievedata['timestamp'] = $datetime;
                            $sievedata['entry_uid'] = $uid;
                            $sievedata['entry_date'] = $datetime;
                            $DB->executedata('i', 'tblsievemaster', $sievedata, '');
                        }

                    }

                    if($tosievename)
                    {
                        $qrytsieve="SELECT id,name FROM tblsievemaster WHERE name=:tosievename";
                        $tsieveparams=array(':tosievename'=>$tosievename);
                        $tsieveres=$DB->getmenual($qrytsieve,$tsieveparams);
                        if(sizeof($tsieveres)>0)
                        {
                            $tosieveid=$tsieveres[0]['id'];
                        }else{
                            $qrysieve="SELECT IFNULL(displayorder,0) AS displayorder FROM tblsievemaster order by displayorder desc limit 1";
                            $sieveparams=array();
                            $ressieve=$DB->getmenual($qrysieve,$sieveparams);
                            $rowsieve=$ressieve[0];
                            $sievedispalyorder=1;
                            if($rowsieve['displayorder']>0)
                            {
                                $sievedispalyorder=$rowsieve['displayorder']+1;
                            }
                            $tosieveid = $IISMethods->generateuuid();

                            $tsievedata['id'] = $tosieveid;
                            $tsievedata['name'] = $tosievename;
                            $tsievedata['isactive'] = 1;
                            $tsievedata['displayorder'] = $sievedispalyorder;
                            $tsievedata['timestamp'] = $datetime;
                            $tsievedata['entry_uid'] = $uid;
                            $tsievedata['entry_date'] = $datetime;
                            $DB->executedata('i', 'tblsievemaster', $tsievedata, '');
                        }

                    }
                }


                $formevent = $IISMethods->sanitize($_POST['formevent']);
                $id = $IISMethods->sanitize($_POST['id']);
                $currdate = $IISMethods->getcurrdate();

                $datetime = $IISMethods->getdatetime();
                if ($CanListDiamondForList == 1) {
                    if ($stock && $price && $totalprice && $shapeid && ($sizeid || ($sieveid && $tosieveid)) && $colorid && $clarityid) {
                        // print_r(implode(",",$treatmentid));

                        $flttreatmentid = implode("','", explode(",", implode(",", $treatmentid)));
                        $fltkeytosymbolsid = implode("','", explode(",", implode(",", $keytosymbolsid)));
                        $fltovertoneid = implode("','", explode(",", implode(",", $overtoneid)));
                        $fltopeninclusionsid = implode("','", explode(",", implode(",", $openinclusionsid)));
                        $fltblackinclusionsid = implode("','", explode(",", implode(",", $blackinclusionsid)));
                        $fltwhiteinclusionsid = implode("','", explode(",", implode(",", $whiteinclusionsid)));

                        // print_r($flttreatmentid);
                        // exit;

                        //IFNULL((SELECT name FROM tblsizemaster WHERE id=:sizeid),'') AS size,
                        $qrydata = "SELECT
                                IFNULL((SELECT name FROM tblavailabilitymaster WHERE id=:availabilityid),'') AS availability,
                                IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS country,
                                IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS state,
                                IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shape,
                                IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:diamondcolorid),'') AS diamondcolor,
                                IFNULL((SELECT name FROM tblclaritymaster WHERE id=:clarityid),'') AS clarity,
                                IFNULL((SELECT name FROM tblcutmaster WHERE id=:cutid),'') AS cut,
                                IFNULL((SELECT name FROM tblpolishmaster WHERE id=:polishid),'') AS polish,
                                IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:symmetryid),'') AS symmetry,
                                IFNULL((SELECT name FROM tblintensitymaster WHERE id=:intensityid),'') AS intensity,
                                IFNULL((SELECT name FROM tblcolormaster WHERE id=:colorid),'') AS color,
                                IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:colorcodeid),'') AS colorcode,
                                IFNULL((SELECT name FROM tblgirdleconditionmaster WHERE id=:conditionid),'') AS conditions,
                                IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridleminid),'') AS gridlemin,
                                IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridlemaxid),'') AS gridlemax,
                                IFNULL((SELECT name FROM tblculetcondition WHERE id=:culetconditionid),'') AS culetcondition,
                                IFNULL((SELECT name FROM tblsizemaster WHERE id=:culetsizeid),'') AS culetsize,
                                IFNULL((SELECT group_concat(name) FROM tbltreatmentmaster WHERE id IN ('" . $flttreatmentid . "')),'') AS treatment,
                                IFNULL((SELECT name FROM tbllabmaster WHERE id=:labid),'') AS lab,
                                IFNULL((SELECT group_concat(name) FROM tblkeytosymbolmaster WHERE id IN ('" . $fltkeytosymbolsid . "')),'') AS keytosymbol,
                                IFNULL((SELECT name FROM tblfancyintensitymaster WHERE id=:fancyintensityid),'') AS fancyintensity,
                                IFNULL((SELECT group_concat(name) FROM tblovertonemaster WHERE id IN ('" . $fltovertoneid . "')),'') AS overtone,
                                IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid1),'') AS fancycolor1,
                                IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid1),'') AS fancycolorcode1,
                                IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid2),'') AS fancycolor2,
                                IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid2),'') AS fancycolorcode2,
                                IFNULL((SELECT name FROM tbltradeshowmaster WHERE id=:tradeshowid),'') AS tradeshow,
                                IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,
                                IFNULL((SELECT name FROM tblshademaster WHERE id=:shadeid),'') AS shade,
                                IFNULL((SELECT name FROM tbleyecleanmaster WHERE id=:eyecleanid),'') AS eyeclean,
                                IFNULL((SELECT name FROM tblmilkymaster WHERE id=:milkyid),'') AS milky,
                                IFNULL((SELECT group_concat(name) FROM tblopeninclusionmaster WHERE id IN ('" . $fltopeninclusionsid . "')),'') AS openinclusions,
                                IFNULL((SELECT group_concat(name) FROM tblblackinclusionmaster WHERE id IN ('" . $fltblackinclusionsid . "')),'') AS blackinclusions,
                                IFNULL((SELECT group_concat(name) FROM tblwhiteinclusionmaster WHERE id IN ('" . $fltwhiteinclusionsid . "')),'') AS whiteinclusions,
                                IFNULL((SELECT name FROM tblroughdiamondsourcemaster WHERE id=:roughdiamondsourceid),'') AS roughdiamondsource,
                                IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,
                                IFNULL((SELECT name FROM tblsievemaster WHERE id=:sieveid),'') AS sievename,
                                IFNULL((SELECT name FROM tblsievemaster WHERE id=:tosieveid),'') AS tosievename";

                        //   ':sizeid'=>$sizeid,
                        $paramdata = array(
                            ':availabilityid' => $availabilityid,
                            ':countryid' => $countryid,
                            ':stateid' => $stateid,
                            ':shapeid' => $shapeid,
                            ':diamondcolorid' => $colorid,
                            ':clarityid' => $clarityid,
                            ':cutid' => $cutid,
                            ':polishid' => $polishid,
                            ':symmetryid' => $symmetryid,
                            ':intensityid' => $intensityid,
                            ':colorid' => $fluorescenecolorid,
                            ':colorcodeid' => $fluorescenecolorid,
                            ':conditionid' => $gridleconditionid,
                            ':gridleminid' => $gridleminid,
                            ':gridlemaxid' => $gridlemaxid,
                            ':culetconditionid' => $culetconditionid,
                            ':culetsizeid' => $culetsizeid,
                            ':labid' => $labid,
                            ':fancyintensityid' => $fancyintensityid,
                            ':fancycolorid1' => $fancycolorid1,
                            ':fancycolorcodeid1' => $fancycolorid1,
                            ':fancycolorid2' => $fancycolorid2,
                            ':fancycolorcodeid2' => $fancycolorid2,
                            ':tradeshowid' => $tradeshowid,
                            ':brandid' => $brandid,
                            ':shadeid' => $shadeid,
                            ':eyecleanid' => $eyecleanid,
                            ':milkyid' => $milkyid,
                            ':roughdiamondsourceid' => $roughdiamondsourceid,
                            ':personid' => $uid,
                            ':sieveid' => $sieveid,
                            ':tosieveid' => $tosieveid
                        );
                        //    print_r($paramdata);

                        $resdata = $DB->getmenual($qrydata, $paramdata);
                        $rowdata = $resdata[0];



                        $insqry = array(
                            'personid' => $uid,
                            'personname' => $rowdata['personname'],
                            'stock' => $stock,
                            'price' => $price,
                            'totalprice' => $totalprice,
                            'ispricectsavani' => $ispricectsavani,
                            'availabilityid' => $availabilityid,
                            'availability' => $rowdata['availability'],
                            'countryid' => $countryid,
                            'country' => $rowdata['country'],
                            'stateid' => $stateid,
                            'state' => $rowdata['state'],
                            'city' => $city,
                            'shapeid' => $shapeid,
                            'shape' => $rowdata['shape'],
                            'sizeid' => $sizeid,
                            'size' => $size,
                            'colorid' => $colorid,
                            'color' => $rowdata['diamondcolor'],
                            'clarityid' => $clarityid,
                            'clarity' => $rowdata['clarity'],
                            'cutid' => $cutid,
                            'cut' => $rowdata['cut'],
                            'polishid' => $polishid,
                            'polish' => $rowdata['polish'],
                            'symmetryid' => $symmetryid,
                            'symmetry' => $rowdata['symmetry'],
                            'intensityid' => $intensityid,
                            'intensity' => $rowdata['intensity'],
                            'fluorescenecolorid' => $fluorescenecolorid,
                            'fluorescenecolor' => $rowdata['color'],
                            'fluorescenecolorcode' => $rowdata['colorcode'],
                            'length' => $length,
                            'width' => $width,
                            'depth' => $depth,
                            'depthper' => $depthper,
                            'tableper' => $tableper,
                            'crownangle' => $crownangle,
                            'crownheight' => $crownheight,
                            'pavilionangle' => $pavilionangle,
                            'pavilionheight' => $pavilionheight,
                            'gridleconditionid' => $gridleconditionid,
                            'gridlecondition' => $rowdata['conditions'],
                            'gridleminid' => $gridleminid,
                            'gridlemin' => $rowdata['gridlemin'],
                            'gridlemaxid' => $gridlemaxid,
                            'gridlemax' => $rowdata['gridlemax'],
                            'gridleper' => $gridleper,
                            'culetconditionid' => $culetconditionid,
                            'culetcondition' => $rowdata['culetcondition'],
                            'culetsizeid' => $culetsizeid,
                            'culetsize' => $rowdata['culetsize'],
                            'treatmentid' => implode(",", $treatmentid),
                            'treatment' => $rowdata['treatment'],
                            'laserinscription' => $laserinscription,
                            'starlength' => $starlength,
                            'labid' => $labid,
                            'lab' => $rowdata['lab'],
                            'reportnumber' => $reportnumber,
                            'showonsavanigems' => $showonsavanigems,
                            'reportdate' => $reportdate,
                            'lablocation' => $lablocation,
                            'reportcomment' => $reportcomment,
                            'keytosymbolsid' => implode(",", $keytosymbolsid),
                            'keytosymbols' => $rowdata['keytosymbol'],
                            'withfancycolor' => $withfancycolor,
                            'fancyintensityid' => $fancyintensityid,
                            'fancyintensity' => $rowdata['fancyintensity'],
                            'overtoneid' => implode(",", $overtoneid),
                            'overtone' => $rowdata['overtone'],
                            'fancycolorid1' => $fancycolorid1,
                            'fancycolor1' => $rowdata['fancycolor1'],
                            'fancycolorcode1' => $rowdata['fancycolorcode1'],
                            'fancycolorid2' => $fancycolorid2,
                            'fancycolor2' => $rowdata['fancycolor2'],
                            'fancycolorcode2' => $rowdata['fancycolorcode2'],
                            'matchedpair' => $matchedpair,
                            'stocknumber' => $stocknumber,
                            'ispairseparable' => $ispairseparable,
                            'isdownload' => $isdownload,
                            'tradeshowid' => $tradeshowid,
                            'tradeshow' => $rowdata['tradeshow'],
                            'brandid' => $brandid,
                            'brand' => $rowdata['brand'],
                            'suppliercomment' => $suppliercomment,
                            'isparcel' => $isparcel,
                            'numofdiamond' => $numofdiamond,
                            'sarineloupe' => $sarineloupe,
                            'sellerspecification' => $sellerspecification,
                            'shadeid' => $shadeid,
                            'shade' => $rowdata['shade'],
                            'eyecleanid' => $eyecleanid,
                            'eyeclean' => $rowdata['eyeclean'],
                            'milkyid' => $milkyid,
                            'milky' => $rowdata['milky'],
                            'openinclusionsid' => implode(",", $openinclusionsid),
                            'openinclusions' => $rowdata['openinclusions'],
                            'blackinclusionsid' => implode(",", $blackinclusionsid),
                            'blackinclusions' => $rowdata['blackinclusions'],
                            'whiteinclusionsid' => implode(",", $whiteinclusionsid),
                            'whiteinclusions' => $rowdata['whiteinclusions'],
                            'roughdiamondsourceid' => $roughdiamondsourceid,
                            'roughdiamondsource' => $rowdata['roughdiamondsource'],
                            'sieveid' => $sieveid,
                            'sievename' => $rowdata['sievename'],
                            'piecepercarat' => $piecepercarat,
                            'savanipercentage' => $savanipercentage,
                            'tosieveid' => $tosieveid,
                            'tosievename' => $rowdata['tosievename'],
                        );

                        $numstockrow = 0;
                        if ($matchedpair == 1 && $ispairseparable == 1) {
                            $qrystocknumber = "SELECT * FROM tbldiamond WHERE stocknumber=:stocknumber";
                            $stocknumberparams = array(
                                ':stocknumber' => $stocknumber,
                            );
                            if ($id && $formevent == 'update') {
                                $qrystocknumber .= " AND id<>:id";
                                $stocknumberparams[':id'] = $id;
                            }
                            // echo $qrystocknumber;
                            // print_r($stocknumberparams);
                            $result_arystocknumber = $DB->getmenual($qrystocknumber, $stocknumberparams);
                            $numstockrow = sizeof($result_arystocknumber);
                        }

                        if ($numstockrow > 0) {
                            $status = 0;
                            $message = $errmsg['stocknumberexist'];
                        } else {
                            if ($formevent == 'submit') {
                                $totaldiamondupload=$DB->getTotalDiamond($LoginInfo->getUid())+$totalprice;
                                if($CanMembernolimitdiamond==1 || $totaldiamondupload<=$CanMemberlimitdiamond)
                                {
                                    $typename = 'diamond';
                                    $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";
                                    $seriesparams = array(
                                        ':typename' => $typename,
                                    );
                                    $result_ary = $DB->getmenual($qryseries, $seriesparams);
                                    $rowseries = $result_ary[0];

                                    $seriesid = $rowseries['id'];
                                    $seriesno = $DB->getorderno($seriesid, 'diamond', $currdate);
                                    $maxid = $DB->getmaxid($seriesid, 'diamond');

                                    if ($seriesid) {
                                        try {
                                            $DB->begintransaction();


                                            $diamondid = $IISMethods->generateuuid();

                                            $containreportfileorlink = 0;
                                            if ($reportfile) {
                                                $containreportfileorlink = 1;
                                                $sourcePath1 = $_FILES['reportfile']['tmp_name'];
                                                $uimagePath1 = $IISMethods->uploadallfiles(0, 'diamondreportfile', $reportfile, $sourcePath1, $diamondid);
                                                $insqry['reportfile'] = $uimagePath1;
                                            } else if ($reportfilelink) {
                                                $containreportfileorlink = 2;
                                            }

                                            $containdiamondimgorlink = 0;
                                            if (sizeof($diamondimg) > 0) {
                                                $containdiamondimgorlink = 1;
                                            } else if ($diamondimglink) {
                                                $containdiamondimgorlink = 2;
                                            }



                                            $insqry['id'] = $diamondid;
                                            $insqry['savanilotnumber'] = $seriesno;
                                            $insqry['diamondimglink'] = $diamondimglink;
                                            $insqry['videolink'] = $videolink;
                                            $insqry['containdiamondimgorlink'] = $containdiamondimgorlink;
                                            $insqry['containreportfileorlink'] = $containreportfileorlink;
                                            $insqry['reportfilelink'] = $reportfilelink;
                                            $insqry['isactive'] = 1;
                                            $insqry['maxid'] = $maxid;
                                            $insqry['seriesid'] = $seriesid;
                                            $insqry['timestamp'] = $datetime;
                                            $insqry['entry_uid'] = $uid;
                                            $insqry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamond', $insqry, '');

                                            $DB->userwisediamonjewelrylog(1, $uid);


                                            if (sizeof($diamondimg) > 0) {
                                                if (is_array($_FILES)) {
                                                    $isupdimg = 0;
                                                    foreach ($_FILES['diamondimg']['name'] as $name => $value) {
                                                        if ($_FILES['diamondimg']['type'][$name] == 'image/jpg'  || $_FILES['diamondimg']['type'][$name] == 'image/jpeg' || $_FILES['diamondimg']['type'][$name] == 'image/png') {

                                                            $unqimgid = $IISMethods->generateuuid();
                                                            $sourcePath = $_FILES['diamondimg']['tmp_name'][$name];
                                                            $targetPath = $IISMethods->uploadallfiles(0, 'diamondimg', $_FILES['diamondimg']['name'][$name], $sourcePath, $unqimgid);

                                                            $insdata = array(
                                                                'id' => $unqimgid,
                                                                'diamondid' => $diamondid,
                                                                'image' => $targetPath,
                                                                'imgtype' => $_FILES['diamondimg']['type'][$name],
                                                                'entry_uid' => $uid,
                                                                'entry_date' => $datetime,
                                                                'timestamp' => $datetime
                                                            );
                                                            $DB->executedata('i', 'tbldiamondimages', $insdata, '');
                                                            $isupdimg = 1;
                                                        }
                                                    }
                                                }
                                            }
                                            // exit;
                                            if (sizeof($treatmentid) > 0) {
                                                for ($t = 0; $t < sizeof($treatmentid); $t++) {
                                                    $qrytreatment = "SELECT name from tbltreatmentmaster where id=:id";
                                                    $parmstreatment = array(
                                                        ':id' => $treatmentid[$t],
                                                    );
                                                    $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);
                                                    $mtreatmentid = $IISMethods->generateuuid();
                                                    $inspertreatment = array(
                                                        'id' => $mtreatmentid,
                                                        'diamondid' => $diamondid,
                                                        'treatmentid' => $treatmentid[$t],
                                                        'treatment' => $result_treatment[0]['name'],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondtreatment', $inspertreatment, '');
                                                }
                                            }
                                            if (sizeof($keytosymbolsid) > 0) {
                                                for ($k = 0; $k < sizeof($keytosymbolsid); $k++) {
                                                    $qrykeytosymbol = "SELECT name from tblkeytosymbolmaster where id=:id";
                                                    $parmskeytosymbol = array(
                                                        ':id' => $keytosymbolsid[$k],
                                                    );
                                                    $result_keytosymbol = $DB->getmenual($qrykeytosymbol, $parmskeytosymbol);
                                                    $mkeytosymbolsid = $IISMethods->generateuuid();
                                                    $insperkeytosymbol = array(
                                                        'id' => $mkeytosymbolsid,
                                                        'diamondid' => $diamondid,
                                                        'keytosymbolsid' => $keytosymbolsid[$k],
                                                        'keytosymbols' => $result_keytosymbol[0]['name'],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondkeytosymbol', $insperkeytosymbol, '');
                                                }
                                            }
                                            if (sizeof($overtoneid) > 0) {
                                                for ($o = 0; $o < sizeof($overtoneid); $o++) {
                                                    $qryovertone = "SELECT name from tblovertonemaster where id=:id";
                                                    $parmsovertone = array(
                                                        ':id' => $overtoneid[$o],
                                                    );
                                                    $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                                    $movertoneid = $IISMethods->generateuuid();
                                                    $insperovertone = array(
                                                        'id' => $movertoneid,
                                                        'diamondid' => $diamondid,
                                                        'overtoneid' => $overtoneid[$o],
                                                        'overtone' => $result_overtone[0]['name'],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondovertone', $insperovertone, '');
                                                }
                                            }

                                            if (sizeof($openinclusionsid) > 0) {
                                                for ($op = 0; $op < sizeof($openinclusionsid); $op++) {
                                                    $qryopeninclusion = "SELECT name from tblopeninclusionmaster where id=:id";
                                                    $parmsopeninclusion = array(
                                                        ':id' => $openinclusionsid[$op],
                                                    );
                                                    $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                                    $mopeninclusionsid = $IISMethods->generateuuid();
                                                    $insperopeninclusion = array(
                                                        'id' => $mopeninclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'openinclusionsid' => $openinclusionsid[$op],
                                                        'openinclusions' => $result_openinclusion[0]['name'],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondopeninclusions', $insperopeninclusion, '');
                                                }
                                            }

                                            if (sizeof($blackinclusionsid) > 0) {
                                                for ($bi = 0; $bi < sizeof($blackinclusionsid); $bi++) {
                                                    $qryblackinclusion = "SELECT name from tblblackinclusionmaster where id=:id";
                                                    $parmsblackinclusion = array(
                                                        ':id' => $blackinclusionsid[$bi],
                                                    );
                                                    $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                                    $mblackinclusionsid = $IISMethods->generateuuid();
                                                    $insperblackinclusion = array(
                                                        'id' => $mblackinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'blackinclusionsid' => $blackinclusionsid[$bi],
                                                        'blackinclusions' => $result_blackinclusion[0]['name'],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondblackinclusions', $insperblackinclusion, '');
                                                }
                                            }

                                            if (sizeof($whiteinclusionsid) > 0) {
                                                for ($wi = 0; $wi < sizeof($whiteinclusionsid); $wi++) {
                                                    $qrywhiteinclusion = "SELECT name from tblwhiteinclusionmaster where id=:id";
                                                    $parmswhiteinclusion = array(
                                                        ':id' => $whiteinclusionsid[$wi],
                                                    );
                                                    $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                                    $mwhiteinclusionsid = $IISMethods->generateuuid();
                                                    $insperwhiteinclusion = array(
                                                        'id' => $mwhiteinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'whiteinclusionsid' => $whiteinclusionsid[$wi],
                                                        'whiteinclusions' => $result_whiteinclusion[0]['name'],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondwhiteinclusions', $insperwhiteinclusion, '');
                                                }
                                            }

                                            $status = 1;
                                            $message = $errmsg['diamondinsert'];
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
                                }else{
                                    $status = 0;
                                    $message = $errmsg['diamondlimitover'];
                                }
                            } else if ($formevent == 'update') {
                                try {
                                    $DB->begintransaction();


                                    $diamondid = $id;
                                    $qry = "SELECT reportfile,diamondimg FROM tbldiamond WHERE id=:id";
                                    $param = array(':id' => $diamondid);
                                    $res = $DB->getmenual($qry, $param);
                                    $row = $res[0];

                                    $containreportfileorlink = 0;
                                    if ($reportfile) {
                                        $containreportfileorlink = 1;
                                        unlink($row['reportfile']);
                                        $sourcePath1 = $_FILES['reportfile']['tmp_name'];
                                        $uimagePath1 = $IISMethods->uploadallfiles(0, 'diamondreportfile', $reportfile, $sourcePath1, $diamondid);
                                    } else {
                                        $uimagePath1 = $row['reportfile'];
                                    }

                                    if ($reportfilelink) {
                                        $containreportfileorlink = 2;
                                    }

                                    // if($diamondimg)
                                    // {
                                    //     unlink($row['diamondimg']);
                                    //     $sourcePath2 = $_FILES['diamondimg']['tmp_name'];
                                    //     $uimagePath2 = $IISMethods->uploadallfiles(0,'diamondimg',$diamondimg,$sourcePath2,$diamondid);
                                    // }
                                    // else
                                    // {
                                    //     $uimagePath2 = $row['diamondimg'];
                                    // }

                                    $containdiamondimgorlink = 0;
                                    if (sizeof($diamondimg) > 0) {
                                        $containdiamondimgorlink = 1;
                                    } else if ($diamondimglink) {
                                        $containdiamondimgorlink = 2;
                                    }


                                    $insqry['timestamp'] = $datetime;
                                    $insqry['diamondimglink'] = $diamondimglink;
                                    $insqry['videolink'] = $videolink;
                                    $insqry['containdiamondimgorlink'] = $containdiamondimgorlink;
                                    $insqry['containreportfileorlink'] = $containreportfileorlink;
                                    $insqry['reportfilelink'] = $reportfilelink;
                                    $insqry['reportfile'] = $uimagePath1;
                                    $insqry['diamondimg'] = $uimagePath2;
                                    $insqry['update_uid'] = $uid;
                                    $insqry['update_date'] = $datetime;
                                    $ary = array(
                                        'id' => $diamondid,
                                    );
                                    $DB->executedata('u', 'tbldiamond', $insqry, $ary);
                                    $DB->userwisediamonjewelrylog(1, $uid);

                                    if (sizeof($diamondimg) > 0) {
                                        if (is_array($_FILES)) {
                                            $isupdimg = 0;
                                            foreach ($_FILES['diamondimg']['name'] as $name => $value) {
                                                if ($_FILES['diamondimg']['type'][$name] == 'image/jpg'  || $_FILES['diamondimg']['type'][$name] == 'image/jpeg' || $_FILES['diamondimg']['type'][$name] == 'image/png') {

                                                    $unqimgid = $IISMethods->generateuuid();
                                                    $sourcePath = $_FILES['diamondimg']['tmp_name'][$name];
                                                    $targetPath = $IISMethods->uploadallfiles(0, 'diamondimg', $_FILES['diamondimg']['name'][$name], $sourcePath, $unqimgid);

                                                    $insdata = array(
                                                        'id' => $unqimgid,
                                                        'diamondid' => $diamondid,
                                                        'image' => $targetPath,
                                                        'imgtype' => $_FILES['diamondimg']['type'][$name],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime
                                                    );
                                                    $DB->executedata('i', 'tbldiamondimages', $insdata, '');
                                                    $isupdimg = 1;
                                                }
                                            }
                                        }
                                    }


                                    $treatmentparams = array(
                                        'diamondid' => $diamondid
                                    );
                                    $DB->executedata('d', 'tbldiamondtreatment', '', $treatmentparams);

                                    if (sizeof($treatmentid) > 0) {
                                        for ($t = 0; $t < sizeof($treatmentid); $t++) {
                                            $qrytreatment = "SELECT name from tbltreatmentmaster where id=:id";
                                            $parmstreatment = array(
                                                ':id' => $treatmentid[$t],
                                            );
                                            $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);
                                            $mtreatmentid = $IISMethods->generateuuid();
                                            $inspertreatment = array(
                                                'id' => $mtreatmentid,
                                                'diamondid' => $diamondid,
                                                'treatmentid' => $treatmentid[$t],
                                                'treatment' => $result_treatment[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tbldiamondtreatment', $inspertreatment, '');
                                        }
                                    }

                                    $keytosymbolparams = array(
                                        'diamondid' => $diamondid
                                    );
                                    $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                                    if (sizeof($keytosymbolsid) > 0) {
                                        for ($k = 0; $k < sizeof($keytosymbolsid); $k++) {
                                            $qrykeytosymbol = "SELECT name from tblkeytosymbolmaster where id=:id";
                                            $parmskeytosymbol = array(
                                                ':id' => $keytosymbolsid[$k],
                                            );
                                            $result_keytosymbol = $DB->getmenual($qrykeytosymbol, $parmskeytosymbol);
                                            $mkeytosymbolsid = $IISMethods->generateuuid();
                                            $insperkeytosymbol = array(
                                                'id' => $mkeytosymbolsid,
                                                'diamondid' => $diamondid,
                                                'keytosymbolsid' => $keytosymbolsid[$k],
                                                'keytosymbols' => $result_keytosymbol[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tbldiamondkeytosymbol', $insperkeytosymbol, '');
                                        }
                                    }

                                    $overtoneparams = array(
                                        'diamondid' => $diamondid
                                    );
                                    $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                                    if (sizeof($overtoneid) > 0) {
                                        for ($o = 0; $o < sizeof($overtoneid); $o++) {
                                            $qryovertone = "SELECT name from tblovertonemaster where id=:id";
                                            $parmsovertone = array(
                                                ':id' => $overtoneid[$o],
                                            );
                                            $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                            $movertoneid = $IISMethods->generateuuid();
                                            $insperovertone = array(
                                                'id' => $movertoneid,
                                                'diamondid' => $diamondid,
                                                'overtoneid' => $overtoneid[$o],
                                                'overtone' => $result_overtone[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tbldiamondovertone', $insperovertone, '');
                                        }
                                    }

                                    $openinclusionsparams = array(
                                        'diamondid' => $diamondid
                                    );
                                    $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                                    if (sizeof($openinclusionsid) > 0) {
                                        for ($op = 0; $op < sizeof($openinclusionsid); $op++) {
                                            $qryopeninclusion = "SELECT name from tblopeninclusionmaster where id=:id";
                                            $parmsopeninclusion = array(
                                                ':id' => $openinclusionsid[$op],
                                            );
                                            $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                            $mopeninclusionsid = $IISMethods->generateuuid();
                                            $insperopeninclusion = array(
                                                'id' => $mopeninclusionsid,
                                                'diamondid' => $diamondid,
                                                'openinclusionsid' => $openinclusionsid[$op],
                                                'openinclusions' => $result_openinclusion[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tbldiamondopeninclusions', $insperopeninclusion, '');
                                        }
                                    }

                                    $blackinclusionsparams = array(
                                        'diamondid' => $diamondid
                                    );
                                    $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                                    if (sizeof($blackinclusionsid) > 0) {
                                        for ($bi = 0; $bi < sizeof($blackinclusionsid); $bi++) {
                                            $qryblackinclusion = "SELECT name from tblblackinclusionmaster where id=:id";
                                            $parmsblackinclusion = array(
                                                ':id' => $blackinclusionsid[$bi],
                                            );
                                            $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                            $mblackinclusionsid = $IISMethods->generateuuid();
                                            $insperblackinclusion = array(
                                                'id' => $mblackinclusionsid,
                                                'diamondid' => $diamondid,
                                                'blackinclusionsid' => $blackinclusionsid[$bi],
                                                'blackinclusions' => $result_blackinclusion[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tbldiamondblackinclusions', $insperblackinclusion, '');
                                        }
                                    }

                                    $whiteinclusionsparams = array(
                                        'diamondid' => $diamondid
                                    );
                                    $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);

                                    if (sizeof($whiteinclusionsid) > 0) {
                                        for ($wi = 0; $wi < sizeof($whiteinclusionsid); $wi++) {
                                            $qrywhiteinclusion = "SELECT name from tblwhiteinclusionmaster where id=:id";
                                            $parmswhiteinclusion = array(
                                                ':id' => $whiteinclusionsid[$wi],
                                            );
                                            $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                            $mwhiteinclusionsid = $IISMethods->generateuuid();
                                            $insperwhiteinclusion = array(
                                                'id' => $mwhiteinclusionsid,
                                                'diamondid' => $diamondid,
                                                'whiteinclusionsid' => $whiteinclusionsid[$wi],
                                                'whiteinclusions' => $result_whiteinclusion[0]['name'],
                                                'entry_uid' => $uid,
                                                'entry_date' => $datetime,
                                                'timestamp' => $datetime,
                                            );
                                            $DB->executedata('i', 'tbldiamondwhiteinclusions', $insperwhiteinclusion, '');
                                        }
                                    }

                                    $status = 1;
                                    $message = $errmsg['diamondupdate'];
                                    $DB->committransaction();
                                } catch (Exception $e) {
                                    $DB->rollbacktransaction($e);
                                    $status = 0;
                                    $message = $errmsg['dbtransactionerror'];
                                }
                            }
                        }
                    } else {
                        $message = $errmsg['reqired'];
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'listdiamond') // List Diamonds
            {
                $cur_page = $page + 1;
                $previous_btn = true;
                $next_btn = true;
                $first_btn = true;
                $last_btn = true;
                $id = $IISMethods->sanitize($_POST['id']); // Use When Update data

                $fltparcel = $IISMethods->sanitize($_POST['fltparcel']); // 1 - only parcel , 0 - all

                $fltshapeid = $_POST['fltshapeid']; //Multple Shape
                $fltfromsize = $IISMethods->sanitize($_POST['fltfromsize']); // From Size
                $flttosize = $IISMethods->sanitize($_POST['flttosize']); // To Size
                $fltclarityid = $_POST['fltclarityid']; //Multiple Clarity
                $fltcolorid = $_POST['fltcolorid'];   // Multiple Color
                $fltfromprice = $IISMethods->sanitize($_POST['fltfromprice']); // From Price
                $flttoprice = $IISMethods->sanitize($_POST['flttoprice']);    // To Price

                $fltfromsavanipercentage = $IISMethods->sanitize($_POST['fltfromsavanipercentage']); // From Percentage
                $flttosavanipercentage = $IISMethods->sanitize($_POST['flttosavanipercentage']);    // To Percentage

                if ($fltparcel == 1) {
                    $fltsieveid = $IISMethods->sanitize($_POST['fltsieveid']); // Sleve - Parcel
                    $fltfromprice = $IISMethods->sanitize($_POST['fltfrompriceparcel']); // From Price
                    $flttoprice = $IISMethods->sanitize($_POST['flttopriceparcel']);    // To Price

                    $fltfromsavanipercentage = $IISMethods->sanitize($_POST['fltfromsavanipercentageparcel']); // From Price
                    $flttosavanipercentage = $IISMethods->sanitize($_POST['flttosavanipercentageparcel']);    // To Price

                    $fltcolorid = $_POST['fltcolorparcelid'];   // Multiple Color
                    $fltclarityid = $_POST['fltclarityparcelid']; //Multiple Clarity
                    $fltshapeid = $_POST['fltshapeparcelid']; //Multple Shape
                    $fltfromsize = $IISMethods->sanitize($_POST['fltfromparcelsize']); // From Size
                    $flttosize = $IISMethods->sanitize($_POST['flttoparcelsize']); // To Size


                }

                $fltcolorid = implode("','", $fltcolorid);
                $fltclarityid = implode("','", $fltclarityid);
                $fltshapeid = implode("','", $fltshapeid);

                $getsub_fltshapeid = $DB->getsubshapeid($fltshapeid);
                $sub_fltshapeid = '';
                if ($getsub_fltshapeid != '') {
                    $sub_fltshapeid = implode("','", explode(',', $getsub_fltshapeid));
                }


                $fltfrompiecepercarat = $IISMethods->sanitize($_POST['fltfrompiecepercarat']); // From Piece Per Carat - Parcel
                $flttopiecepercarat = $IISMethods->sanitize($_POST['flttopiecepercarat']); // To Piece Per Carat - Parcel


                $fltopeninclusionid = $_POST['fltopeninclusionid']; // Multiple Open Inclusion
                $fltopeninclusionid = implode("','", $fltopeninclusionid);

                $fltwhiteinclusionid = $_POST['fltwhiteinclusionid']; //Multiple White Inclusion
                $fltwhiteinclusionid = implode("','", $fltwhiteinclusionid);

                $fltblackinclusionid = $_POST['fltblackinclusionid']; //Multiple Black Inclusion
                $fltblackinclusionid = implode("','", $fltblackinclusionid);

                $flteyecleanid = $_POST['flteyecleanid'];  //Multiple Eye Clean
                $flteyecleanid = implode("','", $flteyecleanid);

                $fltmilkyid = $_POST['fltmilkyid'];  //Multiple Milky
                $fltmilkyid = implode("','", $fltmilkyid);

                $fltshadeid = $_POST['fltshadeid'];  //Multiple Shade
                $fltshadeid = implode("','", $fltshadeid);






                $hascontains = $IISMethods->sanitize($_POST['hascontains']);  // 1 - Contains , 0 - Does Not Contain

                $nobgm = $IISMethods->sanitize($_POST['nobgm']);  // 1 - No BGM , 0 - BGM

                $fltcutid = $_POST['fltcutid'];  //Multiple Cut
                $fltcutid = implode("','", $fltcutid);

                $fltpolishid = $_POST['fltpolishid'];  //Multiple Polish
                $fltpolishid = implode("','", $fltpolishid);

                $fltsymmetryfromid = $IISMethods->sanitize($_POST['fltsymmetryfromid']);  // From Symmetry
                $fltsymmetrytoid = $IISMethods->sanitize($_POST['fltsymmetrytoid']);  // To Symmetry

                $fltsymmetryid = $_POST['fltsymmetryid'];  //Multiple Polish
                $fltsymmetryid = implode("','", $fltsymmetryid);

                $fltintensityid = $_POST['fltintensityid'];  //Multiple Fluorescence Intensity
                $fltintensityid = implode("','", $fltintensityid);

                $fltfluorescenecolorid = $_POST['fltfluorescencecolorid'];  //Multiple Fluorescence Color
                $fltfluorescenecolorid = implode("','", $fltfluorescenecolorid);

                $fltlabid = $_POST['fltlabid'];  //Multiple Grading Report
                $fltlabid = implode("','", $fltlabid);


                $fltlocationid = $_POST['fltlocationid'];  //Multiple Location
                $fltlocationid = implode("','", $fltlocationid);

                $fltflexibledelivery = $IISMethods->sanitize($_POST['fltflexibledelivery']);  // Flexibility Delivery


                $fltcompanycode = $IISMethods->sanitize($_POST['fltcompanycode']); //Company Code

                $fltrating = $IISMethods->sanitize($_POST['fltrating']);  // Rating

                $fltstocknumbers = $IISMethods->sanitize($_POST['fltstocknumbers']);    // Stock Numbers

                $fltsavanilotnumber = $IISMethods->sanitize($_POST['fltsavanilotnumber']); // Savani LOT Numbers


                $fltroughsourceid = $_POST['fltroughsourceid'];  //Multiple Rough Source
                $fltroughsourceid = implode("','", $fltroughsourceid);

                $fltsavani = $IISMethods->sanitize($_POST['fltsavani']); // Specification



                $fltshowonly = $IISMethods->sanitize($_POST['fltshowonly']); // Show Only

                $fltmynotes = $_POST['fltmynotes'];  //Multiple My Notes
                $fltmynotes = implode("','", $fltmynotes);

                $fltmedia = $_POST['fltmedia'];  //Multiple Media  // 1 - With Photo , 2 - With Video, 3 - With Lab Report 
                // $fltmedia=implode("','",$fltmedia);

                $fltfromdepthper = $IISMethods->sanitize($_POST['fltfromdepthper']);    // From Depth Per
                $flttodepthper = $IISMethods->sanitize($_POST['flttodepthper']);    // To Depth Per

                $fltfromtableper = $IISMethods->sanitize($_POST['fltfromtableper']); // From Table Per
                $flttotableper = $IISMethods->sanitize($_POST['flttotableper']);    // To Table Per

                $fltfromlength = $IISMethods->sanitize($_POST['fltfromlength']); // From Length
                $flttolength = $IISMethods->sanitize($_POST['flttolength']);    // To Length

                $fltfromwidth = $IISMethods->sanitize($_POST['fltfromwidth']); // From width
                $flttowidth = $IISMethods->sanitize($_POST['flttowidth']);    // To width

                $fltfromdepth = $IISMethods->sanitize($_POST['fltfromdepth']); // From Depth
                $flttodepth = $IISMethods->sanitize($_POST['flttodepth']);    // To Depth

                $fltfromratio = $IISMethods->sanitize($_POST['fltfromratio']);    // From Ratio
                $flttoratio = $IISMethods->sanitize($_POST['flttoratio']);    // To Ratio

                $fltpresetratio = $_POST['fltpresetratio'];   // Multiple Preset Ratio
                $fltpresetratio = implode("','", $fltpresetratio);

                $flthastreatment = $IISMethods->sanitize($_POST['flthastreatment']); // 1 - No Treatment , 2 - Show Only Treated , 3 - Include Treated Diamonds in result

                $flttreatment = $_POST['flttreatment'];   // Multiple Treatment
                $flttreatment = implode("','", $flttreatment);

                $flthaskeytosymblols = $IISMethods->sanitize($_POST['flthaskeytosymbols']); // 1 - Contain 2 - Do Not Contain

                $fltkeytosymblols = $_POST['fltkeytosymbols'];   // Multiple Key To Symbols
                $fltkeytosymblols = implode("','", $fltkeytosymblols);

                $fltbrand = $_POST['fltbrand'];   // Multiple Brand
                $fltbrand = implode("','", $fltbrand);

                $fltsavanicategorycode = $IISMethods->sanitize($_POST['fltsavanicategorycode']); // Savani Category Code
                $fltlabreportnumber = $IISMethods->sanitize($_POST['fltlabreportnumber']);    // Lab Report Number
                $fltaccesscode = $IISMethods->sanitize($_POST['fltaccesscode']);   // Access Code




                $fltmanagemydiamond = $IISMethods->sanitize($_POST['fltmanagemydiamond']);    // 1 - Manage my diamond ,0 - all diamond list


                $sortbyid = $IISMethods->sanitize($_POST['sortbyid']);    // Sort By 
                $sortbycolname = '';
                if ($sortbyid) {
                    $sortbycolname = $DB->getsortbycolname($sortbyid);
                }


                $fltintensity = $_POST['fltintensity'];  //Multiple Intensity
                $fltintensity = implode("','", $fltintensity);

                $fltovertone = $_POST['fltovertone'];  //Multiple Overtone
                $fltovertone = implode("','", $fltovertone);

                $fltcolor = $_POST['fltcolor'];  //Multiple Fancy Color
                $fltcolor = implode("','", $fltcolor);

                /* Intensity Filter Start */
                $fltfromintensity = $_POST['fltfromintensity'];  //From Intensity
                $flttointensity = $_POST['flttointensity'];  //To Intensity
                $ffromintensitydo = 0;
                $ftointensitydo = 0;
                if ($fltfromintensity && $flttointensity) {
                    $intensityqry = "SELECT IFNULL((SELECT displayorder FROM tblfancyintensitymaster WHERE id=:fltfromintensity),0) AS fltfromintensitydo,
                                IFNULL((SELECT displayorder FROM tblfancyintensitymaster WHERE id=:flttointensity),0) AS flttointensitydo ";
                    $intensityparams = array(
                        ':fltfromintensity' => $fltfromintensity,
                        ':flttointensity' => $flttointensity
                    );
                    $intensityres = $DB->getmenual($intensityqry, $intensityparams);
                    $intensityrow = $intensityres[0];
                    $ffromintensitydo = $intensityrow['fltfromintensitydo'];
                    $ftointensitydo = $intensityrow['flttointensitydo'];
                }
                /* Intensity Filter End */
                /* Milky Filter Start */
                $fltfrommilkyid = $_POST['fltfrommilkyid'];  //From Milky
                $flttomilkyid = $_POST['flttomilkyid'];  //To Milky
                $ffrommilkydo = 0;
                $ftomilkydo = 0;
                if ($fltfrommilkyid && $flttomilkyid) {
                    $milkyqry = "SELECT IFNULL((SELECT displayorder FROM tblmilkymaster WHERE id=:fltfrommilkyid),0) AS fltfrommilkyiddo,
                                IFNULL((SELECT displayorder FROM tblmilkymaster WHERE id=:flttomilkyid),0) AS flttomilkyiddo ";
                    $milkyparams = array(
                        ':fltfrommilkyid' => $fltfrommilkyid,
                        ':flttomilkyid' => $flttomilkyid
                    );
                    $milkyres = $DB->getmenual($milkyqry, $milkyparams);
                    $milkyrow = $milkyres[0];
                    $ffrommilkydo = $milkyrow['fltfrommilkyiddo'];
                    $ftomilkydo = $milkyrow['flttomilkyiddo'];
                }
                /* Milky Filter End */

                /* Sieve Filter Start */

                $fltfromsieveid = $_POST['fltfromsieveid']; // From Sieve
                $flttosieveid = $_POST['flttosieveid']; // To Sieve
                $ffromsievedo = 0;
                $ftosievedo = 0;
                if ($fltfromsieveid && $flttosieveid) {
                    $sieveqry = "SELECT IFNULL((SELECT displayorder FROM tblsievemaster WHERE id=:fltfromsieveid),0) AS fltfromsieveiddo,
                                IFNULL((SELECT displayorder FROM tblsievemaster WHERE id=:flttosieveid),0) AS flttosieveiddo ";
                    // echo $sieveqry;
                    $sieveparams = array(
                        ':fltfromsieveid' => $fltfromsieveid,
                        ':flttosieveid' => $flttosieveid
                    );
                    // print_r($sieveparams);
                    $sieveres = $DB->getmenual($sieveqry, $sieveparams);
                    $sieverow = $sieveres[0];
                    $ffromsievedo = $sieverow['fltfromsieveiddo'];
                    $ftosievedo = $sieverow['flttosieveiddo'];
                }
                /* Sieve Filter End */

                /* Cut Filter Start */
                $fltfromcutid = $_POST['fltfromcutid'];  //From Cut
                $flttocutid = $_POST['flttocutid'];  //To Cut
                $ffromcutdo = 0;
                $ftocutdo = 0;
                if ($fltfromcutid && $flttocutid) {
                    $cutqry = "SELECT IFNULL((SELECT displayorder FROM tblcutmaster WHERE id=:fltfromcutid),0) AS fltfromcutiddo,
                                IFNULL((SELECT displayorder FROM tblcutmaster WHERE id=:flttocutid),0) AS flttocutiddo ";
                    $cutparams = array(
                        ':fltfromcutid' => $fltfromcutid,
                        ':flttocutid' => $flttocutid
                    );
                    $cutres = $DB->getmenual($cutqry, $cutparams);
                    $cutrow = $cutres[0];
                    $ffromcutdo = $cutrow['fltfromcutiddo'];
                    $ftocutdo = $cutrow['flttocutiddo'];
                }
                /* Cut Filter End */

                /* Polish Filter Start */
                $fltfrompolishid = $_POST['fltfrompolishid'];  //From Polish
                $flttopolishid = $_POST['flttopolishid'];  //To Polish
                $ffrompolishdo = 0;
                $ftopolishdo = 0;
                if ($fltfrompolishid && $flttopolishid) {
                    $polishqry = "SELECT IFNULL((SELECT displayorder FROM tblpolishmaster WHERE id=:fltfrompolishid),0) AS fltfrompolishiddo,
                                IFNULL((SELECT displayorder FROM tblpolishmaster WHERE id=:flttopolishid),0) AS flttopolishiddo ";
                    $polishparams = array(
                        ':fltfrompolishid' => $fltfrompolishid,
                        ':flttopolishid' => $flttopolishid
                    );
                    $polishres = $DB->getmenual($polishqry, $polishparams);
                    $polishrow = $polishres[0];
                    $ffrompolishdo = $polishrow['fltfrompolishiddo'];
                    $ftopolishdo = $polishrow['flttopolishiddo'];
                }
                /* Polish Filter End */

                /* symmetry Filter Start */
                $fltfromsymmetryid = $_POST['fltfromsymmetryid'];  //From symmetry
                $flttosymmetryid = $_POST['flttosymmetryid'];  //To symmetry
                $ffromsymmetrydo = 0;
                $ftosymmetrydo = 0;
                if ($fltfromsymmetryid && $flttosymmetryid) {
                    $symmetryqry = "SELECT IFNULL((SELECT displayorder FROM tblsymmetrymaster WHERE id=:fltfromsymmetryid),0) AS fltfromsymmetryiddo,
                                IFNULL((SELECT displayorder FROM tblsymmetrymaster WHERE id=:flttosymmetryid),0) AS flttosymmetryiddo ";
                    $symmetryparams = array(
                        ':fltfromsymmetryid' => $fltfromsymmetryid,
                        ':flttosymmetryid' => $flttosymmetryid
                    );
                    $symmetryres = $DB->getmenual($symmetryqry, $symmetryparams);
                    $symmetryrow = $symmetryres[0];
                    $ffromsymmetrydo = $symmetryrow['fltfromsymmetryiddo'];
                    $ftosymmetrydo = $symmetryrow['flttosymmetryiddo'];
                }
                /* symmetry Filter End */

                $fltsizchk = $_POST['fltsizchk'];

                $fltcrownfromheightper = $IISMethods->sanitize($_POST['fltcrownfromheightper']);    // From Crown Height Per
                $fltcrowntoheightper = $IISMethods->sanitize($_POST['fltcrowntoheightper']);    // To Crown Height Per

                $fltcrownfromangel = $IISMethods->sanitize($_POST['fltcrownfromangel']);    // From Crown Angel 
                $fltcrowntoangel = $IISMethods->sanitize($_POST['fltcrowntoangel']);    // To Crown Angel 

                $fltpavilionfromdepthper = $IISMethods->sanitize($_POST['fltpavilionfromdepthper']);    // From Pavilion Depth
                $fltpaviliontodepthper = $IISMethods->sanitize($_POST['fltpaviliontodepthper']);    // To Pavilion Depth 

                $fltpavilionfromangle = $IISMethods->sanitize($_POST['fltpavilionfromangle']);    // From Pavilion Angel 
                $fltpaviliontoangle = $IISMethods->sanitize($_POST['fltpaviliontoangle']);    // To Pavilion Angel 

                $fltgridleid = $_POST['fltgridleid']; //Multple Gridle
                $fltgridleid = implode("','", $fltgridleid);

                $fltculetsizeid = $_POST['fltculetsizeid']; //Multple Culet Size
                $fltculetsizeid = implode("','", $fltculetsizeid);

                $fltculetconditionid = $_POST['fltculetconditionid']; //Multple Culet Condition
                $fltculetconditionid = implode("','", $fltculetconditionid);

                $fltfromratio = $IISMethods->sanitize($_POST['fltfromratio']); // From Ratio
                $flttoratio = $IISMethods->sanitize($_POST['flttoratio']);    // To Ratio

                $listdiamond = new listdiamond();
                //, ':defualtreportfileurl' => $config->getDefualtreportfileurl()
                // echo $config->getDefualtreportfileurl();
                $params = array(':imgurl' => $imageurl, ':defualtdiamondimageurl' => $config->getDefualtDiamondImageurl(), ':loginpersonid' => $uid);
                // print_r($config);
                $query_main = "SELECT d.`id`,d.savanilotnumber,d.personid,d.`stock`,d.`price`,d.`ispricectsavani`,d.`availabilityid`,d.`availability`,d.`countryid`,d.`country`,d.`stateid`,d.`state`,d.`city`,d.`shapeid`,d.`shape`,d.`sizeid`,d.`size`,d.`colorid`,d.`color`,d.`clarityid`,d.`clarity`,d.`cutid`,d.`cut`,d.`polishid`,d.`polish`,d.`symmetryid`,d.`symmetry`,d.`intensityid`,d.`intensity`,
                            d.`fluorescenecolorid`,d.`fluorescenecolor`,d.`fluorescenecolorcode`,d.`length`,d.`width`,d.`depth`,d.`depthper`,d.`tableper`,d.`crownangle`,d.`crownheight`,d.`pavilionangle`,d.`pavilionheight`,d.`gridleconditionid`,d.`gridlecondition`,d.`gridleminid`,d.`gridlemin`,d.`gridlemaxid`,d.`gridlemax`,d.`gridleper`,d.`culetconditionid`,d.`culetcondition`,d.`culetsizeid`,d.`culetsize`,
                            d.`treatmentid`,d.`treatment`,d.`laserinscription`,d.`starlength`,d.`labid`,d.`lab`,d.`reportnumber`,d.`showonsavanigems`,d.`reportdate`,d.`lablocation`,d.`reportcomment`,d.`keytosymbolsid`,d.`keytosymbols`,d.withfancycolor,d.`fancyintensityid`,d.`fancyintensity`,d.`overtoneid`,d.`overtone`,d.`fancycolorid1`,d.`fancycolor1`,d.`fancycolorcode1`,d.`fancycolorid2`,d.`fancycolorcode2`,d.`fancycolor2`,
                            d.`matchedpair`,d.`stocknumber`,d.`ispairseparable`,d.`isdownload`,d.`tradeshowid`,d.`tradeshow`,d.`brandid`,d.`brand`,d.`suppliercomment`,d.`isparcel`,d.`numofdiamond`,d.containreportfileorlink,d.`reportfile`,d.`reportfilelink`,d.`diamondimg`,d.containdiamondimgorlink,d.`diamondimglink`,d.`sarineloupe`,d.`sellerspecification`,d.`shadeid`,d.`shade`,d.`eyecleanid`,d.`eyeclean`,d.`milkyid`,d.`milky`,d.`openinclusionsid`,d.`openinclusions`,
                            d.`blackinclusionsid`,d.`blackinclusions`,d.`whiteinclusionsid`,d.`whiteinclusions`,d.`roughdiamondsourceid`,d.`roughdiamondsource`,
                            d.`entry_uid`,d.`entry_date`,d.`update_uid`,d.`update_date`,d.`timestamp`,ifnull(d.`videolink`,'') AS videolink,`d`.`sieveid`,`d`.`sievename`,`d`.`piecepercarat`,d.tosieveid,d.tosievename
                            ,case when(ifnull(d.reportfile,'')='') then '' ELSE concat(:imgurl,d.reportfile) END AS reportfileurl
                            ,:defualtdiamondimageurl AS diamondimgurl,d.maxid,d.seriesid,d.personname,
                            case when(d.personid!=:loginpersonid) THEN 1 ELSE 0 END AS ismydiamond,
                            ifnull((SELECT companyname FROM tblcompanymaster WHERE isactive=1 and isdefault=1 ORDER BY timestamp desc limit 1),'') AS cmpname,d.savanipercentage,d.isactive,DATE_FORMAT(d.`timestamp`,'%d/%m/%Y') AS dt,d.totalprice
                            FROM `diamondlist` d
                            inner join tblpersonmaster pm on pm.id=d.personid
                            WHERE 1=1";

                if ($id) {
                    $query_main .= " AND d.id=:id";
                    $params[':id'] = $id;
                }

                if ($fltmanagemydiamond) // Manage my diamond
                {
                    $query_main .= " AND d.personid=:personid";
                    $params[':personid'] = $uid;
                } else {
                    $query_main .= " AND d.isactive=1";

                    if (!$id) {
                        // $query_main .= "  AND d.personid!=:personid ";
                        // $params[':personid'] = $uid;
                    }
                }
                if($_POST['isdiamondsearch']==1)
                {
                    $query_main .= " AND ifnull(d.isparcel,0)=:isdiamondsearch";
                    $params[':isdiamondsearch'] = 0;
                }
                // Parcel or not
                if ($fltparcel)  // parcel
                {
                    $query_main .= " AND ifnull(d.isparcel,0)=:isparcel";
                    $params[':isparcel'] = $fltparcel;
                    if ($flttotalfromsize && $flttotaltosize) // Total Size
                    {
                        $query_main .= " AND d.`numofdiamond` BETWEEN :flttotalfromsize AND :flttotaltosize";
                        $params[':flttotalfromsize'] = $flttotalfromsize;
                        $params[':flttotaltosize'] = $flttotaltosize;
                    }

                    if ($fltfrompiecepercarat && $flttopiecepercarat) // Piece Per Carat
                    {
                        $query_main .= " AND d.`piecepercarat` BETWEEN :fltfrompiecepercarat AND :flttopiecepercarat";
                        $params[':fltfrompiecepercarat'] = $fltfrompiecepercarat;
                        $params[':flttopiecepercarat'] = $flttopiecepercarat;
                    }

                    // if ($fltfromsleve && $flttosleve) // Sleve
                    // {
                    //     $query_main .= " AND (d.`sieveid`=::fltfromsleve OR  d.`sieveid`=::flttosleve)";
                    //     $params[':fltfromsleve'] = $fltfromsleve;
                    //     $params[':flttosleve'] = $flttosleve;
                    // }

                    /* Sieve Filter start */
                    if ($fltfromsieveid && $flttosieveid) {
                        if ($ffromsievedo > 0 && $ftosievedo > 0) {
                            $query_main .= " AND IFNULL((SELECT displayorder FROM tblsievemaster WHERE id=d.sieveid),0)  BETWEEN :ffromsievedo AND :ftosievedo ";
                            $params[':ffromsievedo'] = $ffromsievedo;
                            $params[':ftosievedo'] = $ftosievedo;
                        }
                    }
                    /* Sieve Filter end */
                }

                if ($fltshapeid) // Shape
                {


                    if ($sub_fltshapeid != '') {
                        $query_main .= " AND (d.shapeid IN ('" . $sub_fltshapeid . "') OR d.shapeid IN ('" . $fltshapeid . "'))";
                    } else {
                        $query_main .= " AND d.shapeid IN ('" . $fltshapeid . "')";
                    }

                    // $params[':shapeid']=$fltshapeid;
                }
                if ($fltsizeid || ($fltfromsize || $fltfromsize != '' || $flttosize)) // Size
                {
                    // if($fltsizeid)
                    // {
                    //     $query_main.=" AND d.sizeid IN ('".$fltsizeid."')";
                    //     // $params[':sizeid']=$fltsizeid;
                    // }
                    // else
                    if (($fltfromsize > 0 || $fltfromsize == 0) && $flttosize) {
                        $query_main .= " AND d.size BETWEEN :fltfromsize AND :flttosize";
                        $params[':fltfromsize'] = $fltfromsize;
                        $params[':flttosize'] = $flttosize;
                    } else if ($fltfromsize && $flttosize == '') {
                        $query_main .= " AND d.size >= :fltfromsize ";
                        $params[':fltfromsize'] = $fltfromsize;
                    } else if ($fltfromsize == '' && $flttosize) {
                        $query_main .= " AND d.size <= :flttosize ";
                        $params[':flttosize'] = $flttosize;
                    }
                }
                if ($fltcolorid) // Color
                {
                    $query_main .= " AND d.colorid IN ('" . $fltcolorid . "')";
                }

                if ($fltclarityid) // Clarity
                {
                    $query_main .= " AND d.clarityid IN ('" . $fltclarityid . "')";
                }

                if ($fltlocationid)  // Location - country
                {
                    $query_main .= " AND d.countryid IN ('" . $fltlocationid . "')";
                }

                if ($fltopeninclusionid) // Open Inclusion
                {
                    $query_main .= " AND (IFNULL((SELECT COUNT(oi.`id`) FROM `tbldiamondopeninclusions` oi WHERE d.`id`=oi.`diamondid` AND oi.`openinclusionsid` IN ('" . $fltopeninclusionid . "')),0)>0)";
                }

                if ($fltwhiteinclusionid) // White Inclusion
                {
                    $query_main .= " AND (IFNULL((SELECT COUNT(wi.`id`) FROM `tbldiamondwhiteinclusions` wi WHERE d.`id`=wi.`diamondid` AND wi.`whiteinclusionsid` IN ('" . $fltwhiteinclusionid . "')),0)>0)";
                }

                if ($fltblackinclusionid) // Black Inclusion
                {
                    $query_main .= " AND (IFNULL((SELECT COUNT(bi.`id`) FROM `tbldiamondblackinclusions` bi WHERE d.`id`=bi.`diamondid` AND bi.`blackinclusionsid` IN ('" . $fltblackinclusionid . "')),0)>0)";
                }
                // if ($flthaskeytosymblols == 1) {
                if ($fltkeytosymblols) // Keys to symbols
                {
                    $query_main .= " AND (IFNULL((SELECT COUNT(kts.`id`) FROM `tbldiamondkeytosymbol` kts WHERE d.`id`=kts.`diamondid` AND kts.`keytosymbolsid` IN ('" . $fltkeytosymblols . "')),0)>0)";
                }
                // }


                if ($flteyecleanid) // Eye Clean
                {
                    $query_main .= " AND d.eyecleanid IN ('" . $flteyecleanid . "')";
                }
                /* if ($fltmilkyid) // Milky
                {
                    $query_main .= " AND d.milkyid IN ('" . $fltmilkyid . "')";
                } */
                /* Milky Filter Start */

                if ($fltfrommilkyid && $flttomilkyid) {
                    if ($ffrommilkydo > 0 && $ftomilkydo > 0) {
                        $query_main .= " AND IFNULL((SELECT displayorder FROM tblmilkymaster WHERE id=d.milkyid),0)  BETWEEN :ffrommilkydo AND :ftomilkydo ";
                        $params[':ffrommilkydo'] = $ffrommilkydo;
                        $params[':ftomilkydo'] = $ftomilkydo;
                    }
                }
                /* Milky Filter End */
                if ($fltshadeid) // Shade
                {
                    $query_main .= " AND d.shadeid IN ('" . $fltshadeid . "')";
                }
                /* if ($fltcutid) // Cut
                {
                    $query_main .= " AND d.cutid IN ('" . $fltcutid . "')";
                }
                if ($fltpolishid) // Polish
                {
                    $query_main .= " AND d.polishid IN ('" . $fltpolishid . "')";
                }
                if ($fltsymmetryid) // Symmetry
                {
                    $query_main .= " AND d.symmetryid IN ('" . $fltsymmetryid . "')";
                } */

                /* Cut Filter start */
                if ($fltfromcutid && $flttocutid) {
                    if ($ffromcutdo > 0 && $ftocutdo > 0) {
                        $query_main .= " AND IFNULL((SELECT displayorder FROM tblcutmaster WHERE id=d.cutid),0)  BETWEEN :ffromcutdo AND :ftocutdo ";
                        $params[':ffromcutdo'] = $ffromcutdo;
                        $params[':ftocutdo'] = $ftocutdo;
                    }
                }
                /* Cut Filter end */



                /* Polish Filter start */
                if ($fltfrompolishid && $flttopolishid) {
                    if ($ffrompolishdo > 0 && $ftopolishdo > 0) {
                        $query_main .= " AND IFNULL((SELECT displayorder FROM tblpolishmaster WHERE id=d.polishid),0)  BETWEEN :ffrompolishdo AND :ftopolishdo ";
                        $params[':ffrompolishdo'] = $ffrompolishdo;
                        $params[':ftopolishdo'] = $ftopolishdo;
                    }
                }
                /* Polish Filter end */

                /* symmetry Filter start */
                if ($fltfromsymmetryid && $flttosymmetryid) {
                    if ($ffromsymmetrydo > 0 && $ftosymmetrydo > 0) {
                        $query_main .= " AND IFNULL((SELECT displayorder FROM tblsymmetrymaster WHERE id=d.symmetryid),0)  BETWEEN :ffromsymmetrydo AND :ftosymmetrydo ";
                        $params[':ffromsymmetrydo'] = $ffromsymmetrydo;
                        $params[':ftosymmetrydo'] = $ftosymmetrydo;
                    }
                }
                /* symmetry Filter end */

                if ($fltintensityid) // Intensity
                {
                    $query_main .= " AND d.intensityid IN ('" . $fltintensityid . "')";
                }
                if ($fltfluorescenecolorid) // Fluorescene Color
                {
                    $query_main .= " AND d.fluorescenecolorid IN ('" . $fltfluorescenecolorid . "')";
                }
                if ($fltlabid) // Lab
                {
                    $query_main .= " AND d.labid IN ('" . $fltlabid . "')";
                }

                if ($fltflexibledelivery) // flexible delivery
                {
                }
                if ($fltcompanycode) // company code
                {
                    $query_main .= " AND pm.savaniid IN ('" . $fltcompanycode . "')";
                }
                if ($fltrating) // rating
                {
                }
                if ($fltstocknumbers) // stock numbers
                {
                    $query_main .= " AND d.stock IN ('" . $fltstocknumbers . "')";
                }
                if ($fltsavanilotnumber) // savani lot number
                {
                    $query_main .= " AND d.savanilotnumber IN ('" . $fltsavanilotnumber . "')";
                }
                if ($fltroughsourceid)  // Rough Source
                {
                    $query_main .= " AND d.roughdiamondsourceid IN ('" . $fltroughsourceid . "')";
                }

                /*  if ($fltintensity) // Fancy Color Intensity
                {
                    $query_main .= " AND d.fancyintensityid IN ('" . $fltintensity . "')";
                } */
                /* Intensity Filter Start */
                if ($fltfromintensity && $flttointensity) {
                    if ($ffromintensitydo > 0 && $ftointensitydo > 0) {
                        $query_main .= " AND IFNULL((SELECT displayorder FROM tblfancyintensitymaster WHERE id=d.fancyintensityid),0)  BETWEEN :ffromintensitydo AND :ftointensitydo ";
                        $params[':ffromintensitydo'] = $ffromintensitydo;
                        $params[':ftointensitydo'] = $ftointensitydo;
                    }
                }
                /* Intensity Filter End */

                if ($fltovertone) // Fancy Color Overtone
                {
                    $query_main .= " AND d.overtoneid IN ('" . $fltovertone . "')";
                }

                if ($fltcolor) // Fancy Color Overtone
                {
                    $query_main .= " AND d.colorid IN ('" . $fltcolor . "')";
                }

                if (sizeof($fltsizchk) > 0) {
                    $size1 = (sizeof($fltsizchk) - 1);
                    for ($x = 0; $x < sizeof($fltsizchk); $x++) {
                        $expsize = explode('-', $fltsizchk[$x]);
                        $orcond = '';
                        if ($size1 != $x) {
                            $orcond = "  OR ";
                        }
                        $andcond = '';
                        if ($x == 0) {
                            $andcond = " AND (";
                        }
                        $query_main .= " $andcond (d.size BETWEEN $expsize[0] AND $expsize[1]) $orcond ";
                    }

                    $query_main .= " ) ";
                }


                if ($fltsavani) // Savani
                {
                }

                if (($fltfromprice || $fltfromprice == 0) && $flttoprice) // From Price /To Price
                {
                    $query_main .= " AND d.price BETWEEN :fltfromprice AND :flttoprice";
                    $params[':fltfromprice'] = $fltfromprice;
                    $params[':flttoprice'] = $flttoprice;
                } else if ($fltfromprice && $flttoprice == '') // From Price /To Price
                {
                    $query_main .= " AND d.price >= :fltfromprice ";
                    $params[':fltfromprice'] = $fltfromprice;
                } else if ($fltfromprice == '' && $flttoprice) // From Price /To Price
                {
                    $query_main .= " AND d.price <= :flttoprice ";
                    $params[':flttoprice'] = $flttoprice;
                }

                if (($fltfromsavanipercentage || $fltfromsavanipercentage == 0) && $flttosavanipercentage) // From Price /To Price
                {
                    $query_main .= " AND d.savanipercentage BETWEEN :fltfromsavanipercentage AND :flttosavanipercentage";
                    $params[':fltfromsavanipercentage'] = $fltfromsavanipercentage;
                    $params[':flttosavanipercentage'] = $flttosavanipercentage;
                } else  if ($fltfromsavanipercentage > 0 && $flttosavanipercentage == '') // From Price /To Price
                {
                    $query_main .= " AND d.savanipercentage >= :fltfromsavanipercentage ";
                    $params[':fltfromsavanipercentage'] = $fltfromsavanipercentage;
                } else  if ($fltfromsavanipercentage == '' && $flttosavanipercentage > 0) // From Price /To Price
                {
                    $query_main .= " AND d.savanipercentage <= :flttosavanipercentage ";
                    $params[':flttosavanipercentage'] = $flttosavanipercentage;
                }

                if ($fltshowonly) // Show Only
                {
                }
                if ($fltmynotes) // My Notes
                {
                }
                if (sizeof($fltmedia) > 0 && $fltmedia[0] != '') // Media
                {
                    $query_main .= " AND (";
                    for ($m = 0; $m < sizeof($fltmedia); $m++) {
                        $fmedia = $fltmedia[$m];
                        /* if ($fmedia == 1) {
                            $query_main .= " d.containdiamondimgorlink=1";
                        } else if ($fmedia == 2) {
                            $query_main .= " d.containdiamondimgorlink=2";
                        } else if ($fmedia == 3) {
                            $query_main .= " (d.containreportfileorlink=1 OR d.containreportfileorlink=2)";
                        }
                        if ($m < (count($fltmedia) - 1)) {
                            $query_main .= " OR ";
                        } */

                        if ($fmedia == 1) {
                            $query_main .= " (d.containdiamondimgorlink=1 OR d.containdiamondimgorlink=2)";
                        } else if ($fmedia == 2) {
                            $query_main .= " d.videolink!='' ";
                        } else if ($fmedia == 3) {
                            $query_main .= " (d.containreportfileorlink=1 OR d.containreportfileorlink=2)";
                        }
                        if ($m < (count($fltmedia) - 1)) {
                            $query_main .= " OR ";
                        }
                    }
                    $query_main .= " )";
                }
                if (($fltfromdepthper || $fltfromdepthper == 0) && $flttodepthper) // Depth Per
                {
                    $query_main .= " AND d.depthper BETWEEN :fltfromdepthper AND :flttodepthper";
                    $params[':fltfromdepthper'] = (float)$fltfromdepthper;
                    $params[':flttodepthper'] = (float)$flttodepthper;
                } else if ($fltfromdepthper > 0 && $flttodepthper == '') // Depth Per
                {
                    $query_main .= " AND d.depthper >= :fltfromdepthper ";
                    $params[':fltfromdepthper'] = $fltfromdepthper;
                } else if ($fltfromdepthper == '' && $flttodepthper > 0) // Depth Per
                {
                    $query_main .= " AND d.depthper <= :flttodepthper";
                    $params[':flttodepthper'] = $flttodepthper;
                }


                if (($fltfromtableper || $fltfromtableper == 0) && $flttotableper) // Table Per
                {
                    $query_main .= " AND d.tableper BETWEEN :fltfromtableper AND :flttotableper";
                    $params[':fltfromtableper'] = $fltfromtableper;
                    $params[':flttotableper'] = $flttotableper;
                } else if ($fltfromtableper > 0  && $flttotableper == '') // Table Per
                {
                    $query_main .= " AND d.tableper >= :fltfromtableper";
                    $params[':fltfromtableper'] = $fltfromtableper;
                } else if ($fltfromtableper == ''  && $flttotableper > 0) // Table Per
                {
                    $query_main .= " AND d.tableper <= :flttotableper";
                    $params[':flttotableper'] = $flttotableper;
                }

                if (($fltfromlength || $fltfromlength == 0) && $flttolength) // Length
                {
                    $query_main .= " AND d.length BETWEEN :fltfromlength AND :flttolength";
                    $params[':fltfromlength'] = $fltfromlength;
                    $params[':flttolength'] = $flttolength;
                } else if ($fltfromlength > 0 && $flttolength == '') {
                    $query_main .= " AND d.length >= :fltfromlength ";
                    $params[':fltfromlength'] = $fltfromlength;
                } else if ($fltfromlength == '' && $flttolength > 0) {
                    $query_main .= " AND d.length <= :flttolength ";
                    $params[':flttolength'] = $flttolength;
                }

                if (($fltfromwidth || $fltfromwidth == 0) && $flttowidth) // Width
                {
                    $query_main .= " AND d.width BETWEEN :fltfromwidth AND :flttowidth";
                    $params[':fltfromwidth'] = $fltfromwidth;
                    $params[':flttowidth'] = $flttowidth;
                } else if ($fltfromwidth > 0 && $flttowidth == '') // Width
                {
                    $query_main .= " AND d.width >= :fltfromwidth ";
                    $params[':fltfromwidth'] = $fltfromwidth;
                } else if ($fltfromwidth == '' && $flttowidth > 0) // Width
                {
                    $query_main .= " AND d.width <= :flttowidth ";
                    $params[':flttowidth'] = $flttowidth;
                }

                if (($fltfromdepth || $fltfromdepth == 0) && $flttodepth) // Depth
                {
                    $query_main .= " AND d.depth BETWEEN :fltfromdepth AND :flttodepth";
                    $params[':fltfromdepth'] = $fltfromdepth;
                    $params[':flttodepth'] = $flttodepth;
                } else if ($fltfromdepth > 0 && $flttodepth == '') // Depth
                {
                    $query_main .= " AND d.depth >= :fltfromdepth ";
                    $params[':fltfromdepth'] = $fltfromdepth;
                } else if ($fltfromdepth == '' && $flttodepth > 0) // Depth
                {
                    $query_main .= " AND d.depth <= :flttodepth ";
                    $params[':flttodepth'] = $flttodepth;
                }

                if ($fltfromratio && $flttoratio) // Ratio
                {
                    // $query_main.=" AND d.depth BETWEEN :fltfromdepth AND :flttodepth";
                    // $params[':fltfromdepth']=$fltfromdepth;
                    // $params[':flttodepth']=$flttodepth; 
                }
                if ($fltpresetratio) //Preset Ratio
                {
                    // $query_main.=" AND d.depth BETWEEN :fltfromdepth AND :flttodepth";
                    // $params[':fltfromdepth']=$fltfromdepth;
                    // $params[':flttodepth']=$flttodepth; 
                }
                if ($flthastreatment) // Has Treatment
                {
                    if ($flthastreatment == 1) {
                        $query_main .= " AND IFNULL((SELECT COUNT(dt.`id`) FROM `tbldiamondtreatment` dt WHERE d.`id`=dt.`diamondid`),0)=0";
                    } else if ($flthastreatment == 2) {
                        $query_main .= " AND IFNULL((SELECT COUNT(dt.`id`) FROM `tbldiamondtreatment` dt WHERE d.`id`=dt.`diamondid`),0)>0";
                    } else if ($flthastreatment == 3) {
                        // $query_main.=" AND (IFNULL((SELECT COUNT(dt.`id`) FROM `tbldiamondtreatment` dt WHERE d.`id`=dt.`diamondid`),0)>0)";
                    }
                }
                // && $flthastreatment == 2 && $flthastreatment == 3
                if ($flttreatment) // Treatment
                {
                    $query_main .= " AND (IFNULL((SELECT COUNT(dt.`id`) FROM `tbldiamondtreatment` dt WHERE d.`id`=dt.`diamondid` AND dt.`treatmentid` IN ('" . $flttreatment . "')),0)>0)";
                }

                if ($fltbrand) // Brand
                {
                    $query_main .= " AND d.brandid IN ('" . $fltbrand . "')";
                }
                if ($fltsavanicategorycode) // savani category code
                {
                }
                if ($fltlabreportnumber) // lab report number
                {
                    $query_main .= " AND d.reportnumber IN ('" . $fltlabreportnumber . "')";
                }
                if ($fltaccesscode) // access code
                {
                }

                if (($fltcrownfromheightper || $fltcrownfromheightper == 0) && $fltcrowntoheightper) // Crown Height Per
                {
                    $query_main .= " AND d.crownheight BETWEEN :fltcrownfromheightper AND :fltcrowntoheightper";
                    $params[':fltcrownfromheightper'] = $fltcrownfromheightper;
                    $params[':fltcrowntoheightper'] = $fltcrowntoheightper;
                } else if ($fltcrownfromheightper > 0 && $fltcrowntoheightper == '') // Crown Height Per
                {
                    $query_main .= " AND d.crownheight >= :fltcrownfromheightper ";
                    $params[':fltcrownfromheightper'] = $fltcrownfromheightper;
                } else if ($fltcrownfromheightper == '' && $fltcrowntoheightper > 0) // Crown Height Per
                {
                    $query_main .= " AND d.crownheight <= :fltcrowntoheightper ";
                    $params[':fltcrowntoheightper'] = $fltcrowntoheightper;
                }

                if (($fltcrownfromangel > 0 || $fltcrownfromangel == 0) && $fltcrowntoangel) //  Crown Angel 
                {
                    $query_main .= " AND d.crownangle BETWEEN :fltcrownfromangel AND :fltcrowntoangel";
                    $params[':fltcrownfromangel'] = $fltcrownfromangel;
                    $params[':fltcrowntoangel'] = $fltcrowntoangel;
                } else if ($fltcrownfromangel > 0 && $fltcrowntoangel == '') //  Crown Angel 
                {
                    $query_main .= " AND d.crownangle >= :fltcrownfromangel ";
                    $params[':fltcrownfromangel'] = $fltcrownfromangel;
                } else if ($fltcrownfromangel == '' && $fltcrowntoangel > 0) //  Crown Angel 
                {
                    $query_main .= " AND d.crownangle <= :fltcrowntoangel ";
                    $params[':fltcrowntoangel'] = $fltcrowntoangel;
                }

                if (($fltpavilionfromdepthper > 0 || $fltpavilionfromdepthper == 0) && $fltpaviliontodepthper) //  Pavilion Depth 
                {
                    $query_main .= " AND d.pavilionheight BETWEEN :fltpavilionfromdepthper AND :fltpaviliontodepthper";
                    $params[':fltpavilionfromdepthper'] = $fltpavilionfromdepthper;
                    $params[':fltpaviliontodepthper'] = $fltpaviliontodepthper;
                } else if ($fltpavilionfromdepthper > 0 && $fltpaviliontodepthper == '') //  Pavilion Depth 
                {
                    $query_main .= " AND d.pavilionheight >= :fltpavilionfromdepthper ";
                    $params[':fltpavilionfromdepthper'] = $fltpavilionfromdepthper;
                } else if ($fltpavilionfromdepthper == '' && $fltpaviliontodepthper > 0) //  Pavilion Depth 
                {
                    $query_main .= " AND d.pavilionheight <= :fltpaviliontodepthper ";
                    $params[':fltpaviliontodepthper'] = $fltpaviliontodepthper;
                }

                if (($fltpavilionfromangle > 0 || $fltpavilionfromangle == 0) && $fltpaviliontoangle) //  Pavilion Angel 
                {
                    $query_main .= " AND d.pavilionangle BETWEEN :fltpavilionfromangle AND :fltpaviliontoangle";
                    $params[':fltpavilionfromangle'] = $fltpavilionfromangle;
                    $params[':fltpaviliontoangle'] = $fltpaviliontoangle;
                } else if ($fltpavilionfromangle > 0 && $fltpaviliontoangle == '') //  Pavilion Angel 
                {
                    $query_main .= " AND d.pavilionangle >= :fltpavilionfromangle ";
                    $params[':fltpavilionfromangle'] = $fltpavilionfromangle;
                } else if ($fltpavilionfromangle == '' && $fltpaviliontoangle > 0) //  Pavilion Angel 
                {
                    $query_main .= " AND d.pavilionangle <= :fltpaviliontoangle ";
                    $params[':fltpaviliontoangle'] = $fltpaviliontoangle;
                }

                if ($fltgridleid) // Gridle
                {
                    $query_main .= " AND (d.gridleminid IN ('" . $fltgridleid . "')  OR  d.gridlemaxid IN ('" . $fltgridleid . "'))";
                }

                if ($fltculetsizeid) //  Culet Size
                {
                    $query_main .= " AND d.culetsizeid IN ('" . $fltculetsizeid . "')";
                }

                if ($fltculetconditionid) //  Culet Condition
                {
                    $query_main .= " AND d.culetconditionid IN ('" . $fltculetconditionid . "')";
                }

                if (($fltfromratio || $fltfromratio == 0) && $flttoratio) // ratio
                {
                    $query_main .= " AND (d.length/d.width) BETWEEN :fltfromratio AND :flttoratio";
                    $params[':fltfromratio'] = $fltfromratio;
                    $params[':flttoratio'] = $flttoratio;
                } else if ($fltfromratio > 0 && $flttoratio == '') // ratio
                {
                    $query_main .= " AND (d.length/d.width) >= :fltfromratio ";
                    $params[':fltfromratio'] >= $fltfromratio;
                } else if ($fltfromratio == '' && $flttoratio > 0) // ratio
                {
                    $query_main .= " AND (d.length/d.width) <= :flttoratio ";
                    $params[':flttoratio'] = $flttoratio;
                }

                $query_main .= " GROUP BY d.id";
                if ($sortbyid && $sortbycolname) {
                    $query_main .= " ORDER BY $sortbycolname asc";
                } else {
                    $query_main .= " ORDER BY d.timestamp desc";
                }
                $query_extra .= " LIMIT $start, $per_page";
                $query = $query_main . $query_extra;
                //  echo $query;
                //  print_r($params);
                if ($CanListDiamondForList == 1 || $CanDiamondSearch == 1 || $isfromwebsite == 1) {
                    $result_ary = $DB->getmenual($query, $params, 'listdiamond');
                    if (sizeof($result_ary) > 0) {

                        $response['data'] = $result_ary;
                        // print_r($result_ary);

                        // $totalprice=0;
                        for ($i = 0; $i < sizeof($result_ary); $i++) {
                            $ins_id = $result_ary[$i]->getId();
                            $ins_personid = $result_ary[$i]->getpersonid();

                            // $price = $result_ary[$i]->getprice();
                            // $totalprice+=$price;
                            // Diamond Treatment
                            $listdiamondtreatment = new listdiamondtreatment();
                            $qrydiamondtreatment = "SELECT dt.`id`,dt.`diamondid`,dt.`treatmentid`,dt.`treatment`,dt.`entry_uid`,dt.`entry_date`,dt.`timestamp` 
                                                FROM `tbldiamondtreatment` dt
                                                WHERE dt.`diamondid`=:diamondid";
                            $paramdiamondtreatment = array(':diamondid' => $ins_id);
                            $result_diamondtreatment = $DB->getmenual($qrydiamondtreatment, $paramdiamondtreatment, 'listdiamondtreatment');

                            $result_ary[$i]->sethasdiamondtreatment(0);
                            if (sizeof($result_diamondtreatment) > 0) {
                                $result_ary[$i]->sethasdiamondtreatment(1);
                                $result_ary[$i]->setdiamondtreatmentdetail($result_diamondtreatment);
                            }

                            // // Diamond Overtone
                            $listdiamondovertone = new listdiamondovertone();
                            $qrydiamondovertone = "SELECT dot.`id`,dot.`diamondid`,dot.`overtoneid`,dot.`overtone`,dot.`entry_uid`,dot.`entry_date`,dot.`timestamp` 
                                                FROM `tbldiamondovertone` dot
                                                WHERE dot.`diamondid`=:diamondid";
                            $paramdiamondovertone = array(':diamondid' => $ins_id);
                            $result_diamondovertone = $DB->getmenual($qrydiamondovertone, $paramdiamondovertone, 'listdiamondovertone');

                            $result_ary[$i]->sethasdiamondovertone(0);
                            if (sizeof($result_diamondovertone) > 0) {
                                $result_ary[$i]->sethasdiamondovertone(1);
                                $result_ary[$i]->setdiamondovertonedetail($result_diamondovertone);
                            }

                            // // Diamond Keytosymbols
                            $listdiamondkeytosymbols = new listdiamondkeytosymbols();
                            $qrydiamondkeytosymbols = "SELECT dks.`id`,dks.`diamondid`,dks.`keytosymbolsid`,dks.`keytosymbols`,dks.`entry_uid`,dks.`entry_date`,dks.`timestamp` 
                                                FROM `tbldiamondkeytosymbol` dks
                                                WHERE dks.`diamondid`=:diamondid";
                            $paramdiamondkeytosymbols = array(':diamondid' => $ins_id);
                            $result_diamondkeytosymbols = $DB->getmenual($qrydiamondkeytosymbols, $paramdiamondkeytosymbols, 'listdiamondkeytosymbols');

                            $result_ary[$i]->sethasdiamondkeytosymbols(0);
                            if (sizeof($result_diamondkeytosymbols) > 0) {
                                $result_ary[$i]->sethasdiamondkeytosymbols(1);
                                $result_ary[$i]->setdiamondkeytosymbolsdetail($result_diamondkeytosymbols);
                            }



                            // Diamond open inclusion
                            $listopeninclusions = new listopeninclusions();
                            $qryopeninclusions = "SELECT doi.`id`,doi.`diamondid`,doi.`openinclusionsid`,doi.`openinclusions`,doi.`entry_uid`,doi.`entry_date`,doi.`timestamp`
                                                FROM `tbldiamondopeninclusions` doi
                                                WHERE doi.`diamondid`=:diamondid";
                            $paramopeninclusions = array(':diamondid' => $ins_id);
                            $result_openinclusions = $DB->getmenual($qryopeninclusions, $paramopeninclusions, 'listopeninclusions');

                            $result_ary[$i]->sethasopeninclusions(0);
                            if (sizeof($result_openinclusions) > 0) {
                                $result_ary[$i]->sethasopeninclusions(1);
                                $result_ary[$i]->setopeninclusionsdetail($result_openinclusions);
                            }

                            // // Diamond black inclusion
                            $listblackinclusions = new listblackinclusions();
                            $qryblackinclusions = "SELECT dbi.`id`,dbi.`diamondid`,dbi.`blackinclusionsid`,dbi.`blackinclusions`,dbi.`entry_uid`,dbi.`entry_date`,dbi.`timestamp`
                                                FROM `tbldiamondblackinclusions` dbi
                                                WHERE dbi.`diamondid`=:diamondid";
                            $paramblackinclusions = array(':diamondid' => $ins_id);
                            $result_blackinclusions = $DB->getmenual($qryblackinclusions, $paramblackinclusions, 'listblackinclusions');

                            $result_ary[$i]->sethasblackinclusions(0);
                            if (sizeof($result_blackinclusions) > 0) {
                                $result_ary[$i]->sethasblackinclusions(1);
                                $result_ary[$i]->setblackinclusionsdetail($result_blackinclusions);
                            }

                            // // Diamond white inclusion
                            $listwhiteinclusions = new listwhiteinclusions();
                            $qrywhiteinclusions = "SELECT dwi.`id`,dwi.`diamondid`,dwi.`whiteinclusionsid`,dwi.`whiteinclusions`,dwi.`entry_uid`,dwi.`entry_date`,dwi.`timestamp` 
                                                FROM `tbldiamondwhiteinclusions` dwi
                                                WHERE dwi.`diamondid`=:diamondid";
                            $paramwhiteinclusions = array(':diamondid' => $ins_id);
                            $result_whiteinclusions = $DB->getmenual($qrywhiteinclusions, $paramwhiteinclusions, 'listwhiteinclusions');

                            $result_ary[$i]->sethaswhiteinclusions(0);
                            if (sizeof($result_whiteinclusions) > 0) {
                                $result_ary[$i]->sethaswhiteinclusions(1);
                                $result_ary[$i]->setwhiteinclusionsdetail($result_whiteinclusions);
                            }


                            // // Diamond Images
                            $listdiamondimages = new listdiamondimages();
                            $qrydiamondimages = "SELECT dim.`id`,dim.`diamondid`,dim.`image`,dim.`imgtype`,dim.`entry_uid`,dim.`entry_date`,dim.`timestamp`
                                                FROM `tbldiamondimages` dim
                                                WHERE dim.`diamondid`=:diamondid";
                            $paramdiamondimages = array(':diamondid' => $ins_id);
                            $result_diamondimages = $DB->getmenual($qrydiamondimages, $paramdiamondimages, 'listdiamondimages');

                            $result_ary[$i]->sethasdiamondimage(0);
                            if (sizeof($result_diamondimages) > 0) {
                                $result_ary[$i]->sethasdiamondimage(1);
                                $result_ary[$i]->setdiamondimagedetail($result_diamondimages);
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
                        $response['nextpage'] = $nextpage;

                        // Next Page Count

                        // $np = $nextpage + 1;
                        // $startnp = $np * $per_page;
                        // echo $qry_cnt=$query_main." LIMIT $startnp, $per_page";
                        // $result_arycnt = $DB->getmenual($qry_cnt, $params);


                        if (sizeof($result_ary) == $per_page) {

                            $showdata = 1;
                            $showentries = ($nextpage * $per_page);
                        } else {
                            $showdata = 0;
                            $showentries = (($nextpage - 1) * ($per_page)) + sizeof($result_ary);
                        }
                        $response['loadmore'] = $showdata;
                        $response['datasize'] = sizeof($result_ary);
                        $response['showentries'] = $showentries;
                        $res = $DB->getmenual($query_main, $params);
                        $totaldiamond = sizeof($res);

                        $totalprice = 0;
                        if (sizeof($res) > 0) {
                            for ($d = 0; $d < sizeof($res); $d++) {
                                $rowd = $res[$d];
                                $totalprice += $rowd['totalprice'];
                            }
                        }



                        // print_r($response);
                        $status = 1;
                        $message = $errmsg['success'];
                    } else {
                        if ($page <= 0 && sizeof($result_ary) <= 0) {
                            $totalprice = 0;
                            $totaldiamond = 0;
                            $message = $errmsg['nodiamondfound'];
                        } else {
                            $status = 1;
                            $message = $errmsg['success'];
                        }
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }

                $qrydt = "SELECT DATE_FORMAT(entry_date,'%d/%m/%Y %h:%i %p') AS entry_date,uid,id FROM tbluserwisediamonjewelrylog WHERE typeid=:typeid AND uid=:uid ORDER BY entry_date DESC LIMIT 1";
                $paramsdt = array(':typeid' => 1, ':uid' => $uid);
                $resdt = $DB->getmenual($qrydt, $paramsdt);
                $rowdt = $resdt[0];
                $response['lastupdateddate'] = (string)$rowdt['entry_date'];
                $response['lastupdateddateid'] = $rowdt['id'];


                $response['totaldiamond'] = $totaldiamond;
                $response['totalprice'] = round($totalprice,3);


                $result_pag_num = $DB->getmenual($query_main, $params);
                $count = sizeof($result_pag_num);
                $no_of_paginations = ceil($count / $per_page);


                /* ====================Pagination Start============================= */
                $pagdata = '';
                if ($count) {
                    if ($cur_page >= 7) {
                        $start_loop = $cur_page - 3;
                        if ($no_of_paginations > $cur_page + 3)
                            $end_loop = $cur_page + 3;
                        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                            $start_loop = $no_of_paginations - 6;
                            $end_loop = $no_of_paginations;
                        } else {
                            $end_loop = $no_of_paginations;
                        }
                    } else {
                        $start_loop = 1;
                        if ($no_of_paginations > 7)
                            $end_loop = 7;
                        else
                            $end_loop = $no_of_paginations;
                    }
                    /* ----------------------------------------------------------------------------------------------------------- */
                    $total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
                    //Start Pagination Logic
                    $pagdata .= '<div class="set-pdata">'.$total_string.'<ul class="pagination" style="float:right;">';
                    // FOR ENABLING THE FIRST BUTTON
                    if ($first_btn && $cur_page > 1) {
                        $pagdata .= '<li p="1" class="paginate_button page-item active first" id="tableNature_previous">
                                <a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
                                <i class="far fa-angle-double-left"></i>
                                </a>
                            </li>';

                        //echo "<li p='1' class='active'>First</li>";
                    } else if ($first_btn) {
                        $pagdata .= '<li p="1" class="paginate_button page-item first disabled" id="tableNature_previous">
                                <a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
                                    <i class="far fa-angle-double-left"></i>
                                </a>
                            </li>';
                        //	echo "<li p='1' class='inactive'>First</li>";
                    }

                    // FOR ENABLING THE PREVIOUS BUTTON
                    if ($previous_btn && $cur_page > 1) {
                        $pre = $cur_page - 1;
                        $pagdata .= '<li p="' . $pre . '" class="paginate_button page-item active previous" id="tableNature_previous">
                                <a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
                                    <i class="far fa-angle-left"></i>
                                </a>
                            </li>';
                        //echo "<li p='$pre' class='active'>Previous</li>";
                    } else if ($previous_btn) {
                        $pagdata .= '<li p="' . $pre . '" class="paginate_button page-item previous disabled" id="tableNature_previous">
                            <a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
                                <i class="far fa-angle-left"></i>
                            </a>
                        </li>';
                        //echo "<li class='inactive'>Previous</li>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++) {

                        if ($cur_page == $i) {
                            $pagdata .= '<li p="' . $i . '" class="paginate_button page-item active iscurrent"><a href="javascript:void(0);" tabindex="0" class="page-link">' . $i . '</a></li>';
                        } else {
                            $pagdata .= '<li p="' . $i . '" class="paginate_button page-item active "><a href="javascript:void(0);" tabindex="0" class="page-link">' . $i . '</a></li>';
                        }
                        //echo '<li p="'.$i.'" class="active">'.$i.'</li>';
                    }

                    // TO ENABLE THE NEXT BUTTON
                    if ($next_btn && $cur_page < $no_of_paginations) {
                        $nex = $cur_page + 1;
                        $pagdata .= "<li p='$nex' class='active paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-right'></i></a></li>";
                    } else if ($next_btn) {
                        $pagdata .= "<li class='inactive disabled paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-right'></i></a></li>";
                    }

                    // TO ENABLE THE END BUTTON
                    if ($last_btn && $cur_page < $no_of_paginations) {
                        $pagdata .= "<li p='$no_of_paginations' class='active paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-double-right'></i></a></li>";
                    } else if ($last_btn) {
                        $pagdata .= "<li p='$no_of_paginations' class='inactive disabled paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-double-right'></i></a></li>";
                    }

                    $goto = "<input type='text' class='goto hidden' weight='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button hidden' value='Go'/>";
                    // $total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
                    // $pagdata .= "</ul>" . $goto . $time . $total_string . "</div>";  // Content for pagination
                    $pagdata .= "</ul>" . $goto . $time . "</div>";  // Content for pagination
                    //End Pagination Logic
                }
                $response['pagedata'] = $pagdata;
                /* ====================Pagination End============================= */
            } else if ($action == 'sharediamond') {
                $diamondid = $IISMethods->sanitize($_POST['sharediamondid']);
                $sharewithemail = $IISMethods->sanitize($_POST['sharewithemail']);
                $datetime = $IISMethods->getdatetime();
                if ($CanShareDiamond == 1) {
                    if ($diamondid && $uid) {
                        if ($sharewithemail) {
                            $qrychk = "SELECT id FROM diamondlist WHERE id=:id AND isactive=1";
                            $paramchk = array(':id' => $diamondid);
                            $reschk = $DB->getmenual($qrychk, $paramchk);
                            if (sizeof($reschk) > 0) {
                                $row = $reschk[0];

                                $unqid = $IISMethods->generateuuid();
                                $insdiamondshare = array(
                                    'id' => $unqid,
                                    'diamondid' => $row['id'],
                                    'personid' => $uid,
                                    'shareemail' => $sharewithemail,
                                    'entry_uid' => $uid,
                                    'entry_date' => $datetime,
                                    'timestamp' => $datetime,
                                );
                                $DB->executedata('i', 'tbldiamondshare', $insdiamondshare, '');
                                $status = 1;
                                $message = $errmsg['diamondshared'];
                                $emailto = $sharewithemail;
                                $subject = 'Share Diamond';

                                // $data .= '<tr>
                                //     <td colspan="10" style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;" valign="top">
                                //         <div style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">
                                //             <span style="color:#000000;font-weight:700;text-align:center;">Diamond Link &nbsp;&nbsp; <strong style="background-color: #15233b;padding:10px;border-radius:3px;color:#fff;"><a href="' . $config->getportalbaseurl() . 'diamond/' . $row['id'] . '" target="_blank">Link</a></strong></span>
                                //         </div>
                                //     </td>
                                // </tr>';

                                $emailtxt .= '';

                                $emailtxt .= '<tr>';
                                $emailtxt .= '<td colspan="10"';
                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
                                $emailtxt .= 'valign="top">';
                                $emailtxt .= '<p';
                                $emailtxt .= ' style="font-size: 30px;color: #3dacd9;font-weight: 600;margin: 0;text-align: center;">';
                                $emailtxt .= 'Hello,</p>';
                                $emailtxt .= '<p';
                                $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
                                $emailtxt .= 'Diamond Link</p>';
                                $emailtxt .= '</td>';
                                $emailtxt .= '</tr>';
                                $emailtxt .= '<tr>';
                                $emailtxt .= '<td colspan="10"';
                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';
                                $emailtxt .= 'valign="top">';
                                $emailtxt .= '<div';
                                $emailtxt .= ' style="display: block;text-align: center;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';
                                $emailtxt .= '<span';
                                $emailtxt .= ' style="color:#000000;font-weight:700;text-align:center;">Diamond Link';
                                $emailtxt .= ' &nbsp;&nbsp; <strong';
                                $emailtxt .= ' style="background-color: #3dacd9;padding:10px;border-radius:3px;color:#fff;"><a href="' . $config->getportalbaseurl() . 'diamond/' . $row['id'] . '" target="_blank">Click Here</a></strong></span>';
                                $emailtxt .= '</div>';
                                $emailtxt .= '</td>';
                                $emailtxt .= '</tr>';

                                $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');
                            } else {
                                $message = $errmsg['nodiamondfound'];
                            }
                        } else {
                            $message = $errmsg['required'];
                        }
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'contactdiamondseller') {
                $contactsellerdiamondid = $IISMethods->sanitize($_POST['contactsellerdiamondid']);
                $contactsellerdiamondname = $IISMethods->sanitize($_POST['contactsellerdiamondname']);
                $messagetext = $IISMethods->sanitize($_POST['messagetext']);
                $offerprice = $IISMethods->sanitize($_POST['offerprice']);
                $savaniper_m = $IISMethods->sanitize($_POST['savaniper_m']);
                $totalprice_m = $IISMethods->sanitize($_POST['totalprice_m']);


                $datetime = $IISMethods->getdatetime();
                if ($CanMemberToMemberChat == 1) {
                    if ($contactsellerdiamondid && $uid) {
                        if ($messagetext) {
                            $qrychk = "SELECT  d.id,d.personid,d.personname,pm.email,pm.businessphoneno AS contact,pm.phonecode
                                    FROM diamondlist d
                                    inner join tblpersonmaster pm on pm.id=d.personid
                                    WHERE d.id=:id AND d.isactive=1";
                            $paramchk = array(':id' => $contactsellerdiamondid);
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
                                        'name' => $contactsellerdiamondname,
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
                                    $qryuname = "SELECT uniqname FROM tblchatmessage WHERE groupid=:groupid AND diamondid=:diamondid AND issupport=1  AND chattype=2";
                                    $paramuname = array(':groupid' => $groupid, ':diamondid' => $contactsellerdiamondid);
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
                                        'diamondid' => $contactsellerdiamondid,
                                        'diamondname' => $contactsellerdiamondname,
                                        'diamondofferprice' => $offerprice,
                                        'diamondsavaniper' => $savaniper_m,
                                        'diamondtotalprice' => $totalprice_m,
                                        'persontype' => 1,
                                        'chattype' => 2,
                                        'responsetype' => 1
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
                                $subject = 'Message from ' . $rowperson['personname'] . '(' . $rowperson['contact'] . ') For Buy Diamond!!';

                                // $data .= '<tr>
                                //     <td colspan="10" style="word-break: break-word; vertical-align: top;text-align: left;width:100%;padding-top:10px;padding-bottom:20px;" valign="top">
                                //         <div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">
                                //             <p>Hello,' . $row['personname'] . '(' . $row['contact'] . ')</p>
                                //             <p><b>Diamond :</b> ' . $contactsellerdiamondname . '</p>
                                //             <p><b>Message :</b> ' . $messagetext . '</p>
                                //             <p><b>Offer Price :</b> $' . $offerprice . '</p>
                                //             <p><b>Send By :</b> ' . $rowperson['personname'] . '(' . $rowperson['contact'] . ')</p>
                                //             <p><b>Date Time :</b> ' . $datetime . '</p>
                                //             <p><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>
                                //         </div>
                                //     </td>
                                // </tr>';

                                $emailtxt .= '';

                                $emailtxt .= '<tr>';
                                $emailtxt .= '<td colspan="10"';
                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:20px;padding-bottom:20px;"';
                                $emailtxt .= 'valign="top">';
                                $emailtxt .= '<p';
                                $emailtxt .= ' style="font-size: 30px;color: #3dacd9;font-weight: 600;margin: 0;text-align: center;">';
                                $emailtxt .= 'Hello,' . $row['personname'] . '(' . $row['phonecode'] . ' ' . $row['contact'] . ')</p>';
                                $emailtxt .= '<p';
                                $emailtxt .= ' style="font-size: 18px;color: #000000;font-weight: 600;margin: 10px 0 0 0;text-align: center;">';
                                $emailtxt .= 'Message from ' . $rowperson['personname'] . '(<a href="tel:' . $rowperson['phonecode'] . '' . $rowperson['contact'] . '">' . $rowperson['phonecode'] . ' ' . $rowperson['contact'] . '</a>) For Buy Diamond!!</p>';
                                $emailtxt .= '</td>';
                                $emailtxt .= '</tr>';
                                $emailtxt .= '<tr>';
                                $emailtxt .= '<td colspan="10"';
                                $emailtxt .= ' style="word-break: break-word; vertical-align: top;text-align: center;width:100%;padding-top:10px;padding-bottom:20px;"';
                                $emailtxt .= 'valign="top">';
                                $emailtxt .= '<div style="display: block;text-align: left;padding: 16px;word-break: break-word;font-size: 16px; background:#f1f1f1;">';
                                $emailtxt .= '<p style="padding:10px;"><b>Diamond :</b> ' . $contactsellerdiamondname . '</p>
                                            <p style="padding:10px;"><b>Message :</b> ' . $messagetext . '</p>
                                            <p style="padding:10px;"><b>Price :</b> $' . $offerprice . '</p>
                                            <p style="padding:10px;"><b>Savani(%) :</b> ' . $savaniper_m . '%</p>
                                            <p style="padding:10px;"><b>Total Price :</b> $' . $totalprice_m . '</p>
                                            <p style="padding:10px;"><b>Send By :</b> ' . $rowperson['personname'] . '(<a href="tel:' . $rowperson['phonecode'] . '' . $rowperson['contact'] . '">' . $rowperson['phonecode'] . ' ' . $rowperson['contact'] . '</a>)</p>
                                            <p style="padding:10px;"><b>Date Time :</b> ' . $datetime . '</p>
                                            <p style="padding:10px;"><strong><a href="' . $config->getportalbaseurl() . 'chat">Click Here</a> To Start Conversation</strong>';
                                $emailtxt .= '</div>';
                                $emailtxt .= '</td>';
                                $emailtxt .= '</tr>';

                                $datares = $DB->getemailbody($emailto, $subject, $emailtxt, '', '', '', '', '');
                            } else {
                                $message = $errmsg['nodiamondfound'];
                            }
                        } else {
                            $message = $errmsg['required'];
                        }
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'uploaddiamondcsv_old') {
                $filename = $_FILES['csvfile']['tmp_name'];
                if ($CanListDiamondXL == 1) {
                    if ($_FILES["csvfile"]["size"] > 0) {
                        $file = fopen($filename, "r");
                        $i = 0;
                        $j = 0;
                        $cnt_ins = 0;
                        $cnt_upd = 0;
                        $cnt_err = 0;
                        while (($itemData = fgetcsv($file, 10000, ",")) !== FALSE) {
                            if ($i > 0) {

                                $stock = trim($itemData[0]);
                                $price = trim($itemData[1]);
                                $savanipercentage = trim($itemData[2]);
                                $ispricectsavani = trim($itemData[3]);
                                $availability = trim($itemData[4]);
                                $country = trim($itemData[5]);
                                $state = trim($itemData[6]);
                                $city = trim($itemData[7]);
                                $shape = trim($itemData[8]);
                                $size = trim($itemData[9]);
                                $color = trim($itemData[10]);
                                $clarity = trim($itemData[11]);
                                $cut = trim($itemData[12]);
                                $polish = trim($itemData[13]);
                                $symmetry = trim($itemData[14]);
                                $intensity = trim($itemData[15]);
                                $fluorescenecolor = trim($itemData[16]);
                                $length = trim($itemData[17]);
                                $width = trim($itemData[18]);
                                $depth = trim($itemData[19]);
                                $depthper = trim($itemData[20]);
                                $tableper = trim($itemData[21]);
                                $crownangle = trim($itemData[22]);
                                $crownheight = trim($itemData[23]);
                                $pavilionangle = trim($itemData[24]);
                                $pavilionheight = trim($itemData[25]);
                                $gridlecondition = trim($itemData[26]);
                                $gridlemin = trim($itemData[27]);
                                $gridlemax = trim($itemData[28]);
                                $gridleper = trim($itemData[29]);
                                $culetcondition = trim($itemData[30]);
                                $culetsize = trim($itemData[31]);
                                $treatment = trim($itemData[32]); //Multiple
                                $laserinscription = trim($itemData[33]);
                                $starlength = trim($itemData[34]);
                                $lab = trim($itemData[35]);
                                $reportnumber = trim($itemData[36]);
                                $showonsavanigems = trim($itemData[37]);
                                $reportdate = trim($itemData[38]);
                                $lablocation = trim($itemData[39]);
                                $reportcomment = trim($itemData[40]);
                                $keytosymbols = trim($itemData[41]);  //Multiple

                                $fancyintensity = trim($itemData[42]);
                                $overtone = trim($itemData[43]); // Multiple
                                $fancycolor1 = trim($itemData[44]);
                                $fancycolor2 = trim($itemData[45]);
                                $matchedpair = trim($itemData[46]);
                                $stocknumber = trim($itemData[47]);
                                $ispairseparable = trim($itemData[48]);
                                $isdownload = trim($itemData[49]);
                                $tradeshow = trim($itemData[50]);
                                $brand = trim($itemData[51]);
                                $suppliercomment = trim($itemData[52]);
                                $isparcel = trim($itemData[53]);
                                $numofdiamond = trim($itemData[54]);
                                $sarineloupe = trim($itemData[55]);
                                $sellerspecification = trim($itemData[56]);
                                $shade = trim($itemData[57]);
                                $eyeclean = trim($itemData[58]);
                                $milky = trim($itemData[59]);
                                $openinclusions = trim($itemData[60]);    // Multiple
                                $blackinclusions = trim($itemData[61]);  // Multiple
                                $whiteinclusions = trim($itemData[62]);  // Multiple
                                $roughdiamondsource = trim($itemData[63]);
                                $diamondimglink = trim($itemData[64]);
                                $reportfilelink = trim($itemData[65]);
                                $videolink = trim($itemData[66]);


                                $sieve = trim($itemData[67]);
                                $piecepercarat = trim($itemData[68]);


                                $datetime = $IISMethods->getdatetime();



                                $flttreatment = explode(',', $treatment);
                                $fltkeytosymbols = explode(',', $keytosymbols);
                                $fltovertone = explode(',', $overtone);
                                $fltopeninclusions = explode(',', $openinclusions);
                                $fltblackinclusions = explode(',', $blackinclusions);
                                $fltwhiteinclusions = explode(',', $whiteinclusions);


                                if ($stock && $price && $shape && $size && $color && $clarity) {

                                    $availabilityid = '';
                                    if ($availability) // Availability
                                    {
                                        $qryavailability = "SELECT id FROM tblavailabilitymaster WHERE name=:availability";
                                        $paramavailability = array(':availability' => $availability);
                                        $resavailability = $DB->getmenual($qryavailability, $paramavailability);
                                        if (sizeof($resavailability) > 0) {
                                            $rowavailability = $resavailability[0];
                                            $availabilityid = $rowavailability['id'];
                                        } else {
                                            $availabilityid = $IISMethods->generateuuid();

                                            $insqryavailability['id'] = $availabilityid;
                                            $insqryavailability['name'] = $availability;
                                            $insqryavailability['isactive'] = 1;
                                            $insqryavailability['timestamp'] = $datetime;
                                            $insqryavailability['entry_uid'] = $uid;
                                            $insqryavailability['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblavailabilitymaster', $insqryavailability, '');
                                        }
                                    }

                                    $countryid = '';
                                    if ($country) // Country
                                    {
                                        $qrycountry = "SELECT id FROM tblcountrymaster WHERE country=:country";
                                        $paramcountry = array(':country' => $country);
                                        $rescountry = $DB->getmenual($qrycountry, $paramcountry);
                                        if (sizeof($rescountry) > 0) {
                                            $rowcountry = $rescountry[0];
                                            $countryid = $rowcountry['id'];
                                        } else {
                                            $countryid = $IISMethods->generateuuid();

                                            $insqrycountry['id'] = $countryid;
                                            $insqrycountry['country'] = $country;
                                            $insqrycountry['timestamp'] = $datetime;
                                            $insqrycountry['entry_uid'] = $uid;
                                            $insqrycountry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcountrymaster', $insqrycountry, '');
                                        }
                                    }

                                    $stateid = '';
                                    if ($state) // State
                                    {
                                        $qrystate = "SELECT id FROM tblstatemaster WHERE state=:state";
                                        $paramstate = array(':state' => $state);
                                        $resstate = $DB->getmenual($qrystate, $paramstate);
                                        if (sizeof($resstate) > 0) {
                                            $rowstate = $resstate[0];
                                            $stateid = $rowstate['id'];
                                        } else {
                                            $stateid = $IISMethods->generateuuid();

                                            $insqrystate['id'] = $stateid;
                                            $insqrystate['countryid'] = $countryid;
                                            $insqrystate['state'] = $state;
                                            $insqrystate['timestamp'] = $datetime;
                                            $insqrystate['entry_uid'] = $uid;
                                            $insqrystate['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblstatemaster', $insqrystate, '');
                                        }
                                    }
                                    $shapeid = '';
                                    if ($shape) // Shape
                                    {
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
                                            $insqryshape['timestamp'] = $datetime;
                                            $insqryshape['entry_uid'] = $uid;
                                            $insqryshape['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamondshapemaster', $insqryshape, '');
                                        }
                                    }

                                    $sizeid = '';
                                    if ($size) // Size
                                    {
                                        $qrysize = "SELECT id FROM tblsizemaster WHERE name=:size";
                                        $paramsize = array(':size' => $size);
                                        $ressize = $DB->getmenual($qrysize, $paramsize);
                                        if (sizeof($ressize) > 0) {
                                            $rowsize = $ressize[0];
                                            $sizeid = $rowsize['id'];
                                        } else {
                                            $sizeid = $IISMethods->generateuuid();

                                            $insqrysize['id'] = $sizeid;
                                            $insqrysize['name'] = $size;
                                            $insqrysize['timestamp'] = $datetime;
                                            $insqrysize['isactive'] = 1;
                                            $insqrysize['entry_uid'] = $uid;
                                            $insqrysize['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsizemaster', $insqrysize, '');
                                        }
                                    }
                                    $colorid = '';
                                    if ($color) {
                                        $qrycolor = "SELECT id FROM tbldiamondcolormaster WHERE name=:color";
                                        $paramcolor = array(':color' => $color);
                                        $rescolor = $DB->getmenual($qrycolor, $paramcolor);
                                        if (sizeof($rescolor) > 0) {
                                            $rowcolor = $rescolor[0];
                                            $colorid = $rowcolor['id'];
                                        } else {
                                            $colorid = $IISMethods->generateuuid();

                                            $insqrycolor['id'] = $colorid;
                                            $insqrycolor['name'] = $color;
                                            $insqrycolor['isactive'] = 1;
                                            $insqrycolor['timestamp'] = $datetime;
                                            $insqrycolor['entry_uid'] = $uid;
                                            $insqrycolor['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamondcolormaster', $insqrycolor, '');
                                        }
                                    }

                                    $clarityid = '';
                                    if ($clarity) {
                                        $qryclarity = "SELECT id FROM tblclaritymaster WHERE name=:clarity";
                                        $paramclarity = array(':clarity' => $clarity);
                                        $resclarity = $DB->getmenual($qryclarity, $paramclarity);
                                        if (sizeof($resclarity) > 0) {
                                            $rowclarity = $resclarity[0];
                                            $clarityid = $rowclarity['id'];
                                        } else {
                                            $clarityid = $IISMethods->generateuuid();

                                            $insqryclarity['id'] = $clarityid;
                                            $insqryclarity['name'] = $clarity;
                                            $insqryclarity['isactive'] = 1;
                                            $insqryclarity['timestamp'] = $datetime;
                                            $insqryclarity['entry_uid'] = $uid;
                                            $insqryclarity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblclaritymaster', $insqryclarity, '');
                                        }
                                    }

                                    $cutid = '';
                                    if ($cut) {
                                        $qrycut = "SELECT id FROM tblcutmaster WHERE name=:cut";
                                        $paramcut = array(':cut' => $cut);
                                        $rescut = $DB->getmenual($qrycut, $paramcut);
                                        if (sizeof($rescut) > 0) {
                                            $rowcut = $rescut[0];
                                            $cutid = $rowcut['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblcutmaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $cutid = $IISMethods->generateuuid();

                                            $insqrycut['id'] = $cutid;
                                            $insqrycut['name'] = $cut;
                                            $insqrycut['isactive'] = 1;
                                            $insqrycut['displayorder'] = $maxdo;
                                            $insqrycut['timestamp'] = $datetime;
                                            $insqrycut['entry_uid'] = $uid;
                                            $insqrycut['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcutmaster', $insqrycut, '');
                                        }
                                    }

                                    $polishid = '';
                                    if ($polish) {
                                        $qrypolish = "SELECT id FROM tblpolishmaster WHERE name=:polish";
                                        $parampolish = array(':polish' => $polish);
                                        $respolish = $DB->getmenual($qrypolish, $parampolish);
                                        if (sizeof($respolish) > 0) {
                                            $rowpolish = $respolish[0];
                                            $polishid = $rowpolish['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblpolishmaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;

                                            $polishid = $IISMethods->generateuuid();

                                            $insqrypolish['id'] = $polishid;
                                            $insqrypolish['name'] = $polish;
                                            $insqrypolish['isactive'] = 1;
                                            $insqrypolish['displayorder'] = $maxdo;
                                            $insqrypolish['timestamp'] = $datetime;
                                            $insqrypolish['entry_uid'] = $uid;
                                            $insqrypolish['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblpolishmaster', $insqrypolish, '');
                                        }
                                    }

                                    $symmetryid = '';
                                    if ($symmetry) {
                                        $qrysymmetry = "SELECT id FROM tblsymmetrymaster WHERE name=:symmetry";
                                        $paramsymmetry = array(':symmetry' => $symmetry);
                                        $ressymmetry = $DB->getmenual($qrysymmetry, $paramsymmetry);
                                        if (sizeof($ressymmetry) > 0) {
                                            $rowsymmetry = $ressymmetry[0];
                                            $symmetryid = $rowsymmetry['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblsymmetrymaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $symmetryid = $IISMethods->generateuuid();

                                            $insqrysymmetry['id'] = $symmetryid;
                                            $insqrysymmetry['name'] = $symmetry;
                                            $insqrysymmetry['isactive'] = 1;
                                            $insqrysymmetry['displayorder'] = $maxdo;
                                            $insqrysymmetry['timestamp'] = $datetime;
                                            $insqrysymmetry['entry_uid'] = $uid;
                                            $insqrysymmetry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsymmetrymaster', $insqrysymmetry, '');
                                        }
                                    }

                                    $intensityid = '';
                                    if ($intensity) {
                                        $qryintensity = "SELECT id FROM tblintensitymaster WHERE name=:intensity";
                                        $paramintensity = array(':intensity' => $intensity);
                                        $resintensity = $DB->getmenual($qryintensity, $paramintensity);
                                        if (sizeof($resintensity) > 0) {
                                            $rowintensity = $resintensity[0];
                                            $intensityid = $rowintensity['id'];
                                        } else {
                                            $intensityid = $IISMethods->generateuuid();

                                            $insqryintensity['id'] = $intensityid;
                                            $insqryintensity['name'] = $intensity;
                                            $insqryintensity['isactive'] = 1;
                                            $insqryintensity['timestamp'] = $datetime;
                                            $insqryintensity['entry_uid'] = $uid;
                                            $insqryintensity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblintensitymaster', $insqryintensity, '');
                                        }
                                    }

                                    $fluorescenecolorid = '';
                                    if ($fluorescenecolor) {
                                        $qryfluorescenecolor = "SELECT id FROM tblcolormaster WHERE name=:fluorescenecolor";
                                        $paramfluorescenecolor = array(':fluorescenecolor' => $fluorescenecolor);
                                        $resfluorescenecolor = $DB->getmenual($qryfluorescenecolor, $paramfluorescenecolor);
                                        if (sizeof($resfluorescenecolor) > 0) {
                                            $rowfluorescenecolor = $resfluorescenecolor[0];
                                            $fluorescenecolorid = $rowfluorescenecolor['id'];
                                        } else {
                                            $fluorescenecolorid = $IISMethods->generateuuid();

                                            $insqryfluorescenecolor['id'] = $fluorescenecolorid;
                                            $insqryfluorescenecolor['name'] = $fluorescenecolor;
                                            $insqryfluorescenecolor['colorcode'] = $fluorescenecolor;
                                            $insqryfluorescenecolor['isactive'] = 1;
                                            $insqryfluorescenecolor['timestamp'] = $datetime;
                                            $insqryfluorescenecolor['entry_uid'] = $uid;
                                            $insqryfluorescenecolor['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfluorescenecolor, '');
                                        }
                                    }

                                    $gridleminid = '';
                                    if ($gridlemin) {
                                        $qrygridlemin = "SELECT id FROM tblgridlemaster WHERE name=:gridlemin";
                                        $paramgridlemin = array(':gridlemin' => $gridlemin);
                                        $resgridlemin = $DB->getmenual($qrygridlemin, $paramgridlemin);
                                        if (sizeof($resgridlemin) > 0) {
                                            $rowgridlemin = $resgridlemin[0];
                                            $gridleminid = $rowgridlemin['id'];
                                        } else {
                                            $gridleminid = $IISMethods->generateuuid();

                                            $insqrygridlemin['id'] = $gridleminid;
                                            $insqrygridlemin['name'] = $gridlemin;
                                            $insqrygridlemin['isactive'] = 1;
                                            $insqrygridlemin['timestamp'] = $datetime;
                                            $insqrygridlemin['entry_uid'] = $uid;
                                            $insqrygridlemin['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgridlemaster', $insqrygridlemin, '');
                                        }
                                    }
                                    $gridlemaxid = '';
                                    if ($gridlemax) {
                                        $qrygridlemax = "SELECT id FROM tblgridlemaster WHERE name=:gridlemax";
                                        $paramgridlemax = array(':gridlemax' => $gridlemax);
                                        $resgridlemax = $DB->getmenual($qrygridlemax, $paramgridlemax);
                                        if (sizeof($resgridlemax) > 0) {
                                            $rowgridlemax = $resgridlemax[0];
                                            $gridlemaxid = $rowgridlemax['id'];
                                        } else {
                                            $gridlemaxid = $IISMethods->generateuuid();

                                            $insqrygridlemax['id'] = $gridlemaxid;
                                            $insqrygridlemax['name'] = $gridlemax;
                                            $insqrygridlemax['isactive'] = 1;
                                            $insqrygridlemax['timestamp'] = $datetime;
                                            $insqrygridlemax['entry_uid'] = $uid;
                                            $insqrygridlemax['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgridlemaster', $insqrygridlemax, '');
                                        }
                                    }

                                    $culetconditionid = '';
                                    if ($culetcondition) {
                                        $qryculetcondition = "SELECT id FROM tblculetcondition WHERE name=:culetcondition";
                                        $paramculetcondition = array(':culetcondition' => $culetcondition);
                                        $resculetcondition = $DB->getmenual($qryculetcondition, $paramculetcondition);
                                        if (sizeof($resculetcondition) > 0) {
                                            $rowculetcondition = $resculetcondition[0];
                                            $culetconditionid = $rowculetcondition['id'];
                                        } else {
                                            $maxdoqry = "SELECt MAX(ifnull(displayorder,0)) AS maxdo FROM tblculetcondition";
                                            $maxdoparams = array();
                                            $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                            $maxdorow = $maxdores[0];
                                            $maxdo = $maxdorow['maxdo'] + 1;

                                            $culetconditionid = $IISMethods->generateuuid();

                                            $insqryculetcondition['id'] = $culetconditionid;
                                            $insqryculetcondition['name'] = $culetcondition;
                                            $insqryculetcondition['isactive'] = 1;
                                            $insqryculetcondition['displayorder'] = $maxdo;
                                            $insqryculetcondition['timestamp'] = $datetime;
                                            $insqryculetcondition['entry_uid'] = $uid;
                                            $insqryculetcondition['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblculetcondition', $insqryculetcondition, '');
                                        }
                                    }
                                    $culetsizeid = '';
                                    if ($culetsize) {
                                        $qryculetsize = "SELECT id FROM tblsizemaster WHERE name=:culetsize";
                                        $paramculetsize = array(':culetsize' => $culetsize);
                                        $resculetsize = $DB->getmenual($qryculetsize, $paramculetsize);
                                        if (sizeof($resculetsize) > 0) {
                                            $rowculetsize = $resculetsize[0];
                                            $culetsizeid = $rowculetsize['id'];
                                        } else {
                                            $culetsizeid = $IISMethods->generateuuid();

                                            $insqryculetsize['id'] = $culetsizeid;
                                            $insqryculetsize['name'] = $culetsize;
                                            $insqryculetsize['isactive'] = 1;
                                            $insqryculetsize['timestamp'] = $datetime;
                                            $insqryculetsize['entry_uid'] = $uid;
                                            $insqryculetsize['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsizemaster', $insqryculetsize, '');
                                        }
                                    }

                                    $strtreatmentid = '';
                                    if (sizeof($flttreatment) > 0) // Multiple
                                    {
                                        for ($tr = 0; $tr < sizeof($flttreatment); $tr++) {
                                            $treatmentarr = $flttreatment[$tr];

                                            $qrytreatment = "SELECT id FROM tbltreatmentmaster WHERE name=:treatment";
                                            $paramtreatment = array(':treatment' => $treatmentarr);
                                            $restreatment = $DB->getmenual($qrytreatment, $paramtreatment);
                                            if (sizeof($restreatment) > 0) {
                                                $rowtreatment = $restreatment[0];
                                                $treatmentid = $rowtreatment['id'];
                                            } else {
                                                $treatmentid = $IISMethods->generateuuid();

                                                $insqrytreatment['id'] = $treatmentid;
                                                $insqrytreatment['name'] = $treatmentarr;
                                                $insqrytreatment['isactive'] = 1;
                                                $insqrytreatment['timestamp'] = $datetime;
                                                $insqrytreatment['entry_uid'] = $uid;
                                                $insqrytreatment['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tbltreatmentmaster', $insqrytreatment, '');
                                            }

                                            $strtreatmentid .= $treatmentid;
                                            if (sizeof($flttreatment) != $tr) {
                                                $strtreatmentid .= ',';
                                            }
                                        }
                                    }

                                    $strfltkeytosymbolsid = '';
                                    if (sizeof($fltkeytosymbols) > 0) // Multiple
                                    {
                                        for ($ks = 0; $ks < sizeof($fltkeytosymbols); $ks++) {
                                            $fltkeytosymbolsarr = $fltkeytosymbols[$ks];

                                            $qryfltkeytosymbols = "SELECT id FROM tblkeytosymbolmaster WHERE name=:fltkeytosymbols";
                                            $paramfltkeytosymbols = array(':fltkeytosymbols' => $fltkeytosymbolsarr);
                                            $resfltkeytosymbols = $DB->getmenual($qryfltkeytosymbols, $paramfltkeytosymbols);
                                            if (sizeof($resfltkeytosymbols) > 0) {
                                                $rowfltkeytosymbols = $resfltkeytosymbols[0];
                                                $fltkeytosymbolsid = $rowfltkeytosymbols['id'];
                                            } else {
                                                $fltkeytosymbolsid = $IISMethods->generateuuid();

                                                $insqryfltkeytosymbols['id'] = $fltkeytosymbolsid;
                                                $insqryfltkeytosymbols['name'] = $fltkeytosymbolsarr;
                                                $insqryfltkeytosymbols['isactive'] = 1;
                                                $insqryfltkeytosymbols['displayorder'] = 1;
                                                $insqryfltkeytosymbols['timestamp'] = $datetime;
                                                $insqryfltkeytosymbols['entry_uid'] = $uid;
                                                $insqryfltkeytosymbols['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblkeytosymbolmaster', $insqryfltkeytosymbols, '');
                                            }

                                            $strfltkeytosymbolsid .= $fltkeytosymbolsid;
                                            if (sizeof($fltkeytosymbols) != $ks) {
                                                $strfltkeytosymbolsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltovertoneid = '';
                                    if (sizeof($fltovertone) > 0) // Multiple
                                    {
                                        for ($ot = 0; $ot < sizeof($fltovertone); $ot++) {
                                            $fltovertonearr = $fltovertone[$ot];

                                            $qryfltovertone = "SELECT id FROM tblovertonemaster WHERE name=:fltovertone";
                                            $paramfltovertone = array(':fltovertone' => $fltovertonearr);
                                            $resfltovertone = $DB->getmenual($qryfltovertone, $paramfltovertone);
                                            if (sizeof($resfltovertone) > 0) {
                                                $rowfltovertone = $resfltovertone[0];
                                                $fltovertoneid = $rowfltovertone['id'];
                                            } else {
                                                $fltovertoneid = $IISMethods->generateuuid();

                                                $insqryfltovertone['id'] = $fltovertoneid;
                                                $insqryfltovertone['name'] = $fltovertonearr;
                                                $insqryfltovertone['isactive'] = 1;
                                                $insqryfltovertone['timestamp'] = $datetime;
                                                $insqryfltovertone['entry_uid'] = $uid;
                                                $insqryfltovertone['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblovertonemaster', $insqryfltovertone, '');
                                            }

                                            $strfltovertoneid .= $fltovertoneid;
                                            if (sizeof($fltovertone) != $ot) {
                                                $strfltovertoneid .= ',';
                                            }
                                        }
                                    }

                                    $strfltopeninclusionsid = '';
                                    if (sizeof($fltopeninclusions) > 0) // Multiple
                                    {
                                        for ($oi = 0; $oi < sizeof($fltopeninclusions); $oi++) {
                                            $fltopeninclusionsarr = $fltopeninclusions[$oi];

                                            $qryfltopeninclusions = "SELECT id FROM tblopeninclusionmaster WHERE name=:fltopeninclusions";
                                            $paramfltopeninclusions = array(':fltopeninclusions' => $fltopeninclusionsarr);
                                            $resfltopeninclusions = $DB->getmenual($qryfltopeninclusions, $paramfltopeninclusions);
                                            if (sizeof($resfltopeninclusions) > 0) {
                                                $rowfltopeninclusions = $resfltopeninclusions[0];
                                                $fltopeninclusionsid = $rowfltopeninclusions['id'];
                                            } else {
                                                $fltopeninclusionsid = $IISMethods->generateuuid();

                                                $insqryfltopeninclusions['id'] = $fltopeninclusionsid;
                                                $insqryfltopeninclusions['name'] = $fltopeninclusionsarr;
                                                $insqryfltopeninclusions['isactive'] = 1;
                                                $insqryfltopeninclusions['timestamp'] = $datetime;
                                                $insqryfltopeninclusions['entry_uid'] = $uid;
                                                $insqryfltopeninclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblopeninclusionmaster', $insqryfltopeninclusions, '');
                                            }

                                            $strfltopeninclusionsid .= $fltopeninclusionsid;
                                            if (sizeof($fltopeninclusions) != $oi) {
                                                $strfltopeninclusionsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltblackinclusionsid = '';
                                    if (sizeof($fltblackinclusions) > 0) // Multiple
                                    {
                                        for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                            $fltblackinclusionsarr = $fltblackinclusions[$bi];

                                            $qryfltblackinclusions = "SELECT id FROM tblblackinclusionmaster WHERE name=:fltblackinclusions";
                                            $paramfltblackinclusions = array(':fltblackinclusions' => $fltblackinclusionsarr);
                                            $resfltblackinclusions = $DB->getmenual($qryfltblackinclusions, $paramfltblackinclusions);
                                            if (sizeof($resfltblackinclusions) > 0) {
                                                $rowfltblackinclusions = $resfltblackinclusions[0];
                                                $fltblackinclusionsid = $rowfltblackinclusions['id'];
                                            } else {
                                                $fltblackinclusionsid = $IISMethods->generateuuid();

                                                $insqryfltblackinclusions['id'] = $fltblackinclusionsid;
                                                $insqryfltblackinclusions['name'] = $fltblackinclusionsarr;
                                                $insqryfltblackinclusions['isactive'] = 1;
                                                $insqryfltblackinclusions['timestamp'] = $datetime;
                                                $insqryfltblackinclusions['entry_uid'] = $uid;
                                                $insqryfltblackinclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblblackinclusionmaster', $insqryfltblackinclusions, '');
                                            }

                                            $strfltblackinclusionsid .= $fltblackinclusionsid;
                                            if (sizeof($fltblackinclusions) != $bi) {
                                                $strfltblackinclusionsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltwhiteinclusionsid = '';
                                    if (sizeof($fltwhiteinclusions) > 0) // Multiple
                                    {
                                        for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                            $fltwhiteinclusionsarr = $fltwhiteinclusions[$wi];

                                            $qryfltwhiteinclusions = "SELECT id FROM tblwhiteinclusionmaster WHERE name=:fltwhiteinclusions";
                                            $paramfltwhiteinclusions = array(':fltwhiteinclusions' => $fltwhiteinclusionsarr);
                                            $resfltwhiteinclusions = $DB->getmenual($qryfltwhiteinclusions, $paramfltwhiteinclusions);
                                            if (sizeof($resfltwhiteinclusions) > 0) {
                                                $rowfltwhiteinclusions = $resfltwhiteinclusions[0];
                                                $fltwhiteinclusionsid = $rowfltwhiteinclusions['id'];
                                            } else {
                                                $fltwhiteinclusionsid = $IISMethods->generateuuid();

                                                $insqryfltwhiteinclusions['id'] = $fltwhiteinclusionsid;
                                                $insqryfltwhiteinclusions['name'] = $fltwhiteinclusionsarr;
                                                $insqryfltwhiteinclusions['isactive'] = 1;
                                                $insqryfltwhiteinclusions['timestamp'] = $datetime;
                                                $insqryfltwhiteinclusions['entry_uid'] = $uid;
                                                $insqryfltwhiteinclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblwhiteinclusionmaster', $insqryfltwhiteinclusions, '');
                                            }

                                            $strfltwhiteinclusionsid .= $fltwhiteinclusionsid;
                                            if (sizeof($fltwhiteinclusions) != $wi) {
                                                $strfltwhiteinclusionsid .= ',';
                                            }
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
                                            $insqrylab['displayorder'] = 1;
                                            $insqrylab['isactive'] = 1;
                                            $insqrylab['timestamp'] = $datetime;
                                            $insqrylab['entry_uid'] = $uid;
                                            $insqrylab['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbllabmaster', $insqrylab, '');
                                        }
                                    }

                                    $sieveid = '';
                                    if ($sieve) {
                                        $qrysieve = "SELECT id FROM tblsievemaster WHERE name=:sieve";
                                        $paramsieve = array(':sieve' => $sieve);
                                        $ressieve = $DB->getmenual($qrysieve, $paramsieve);
                                        if (sizeof($ressieve) > 0) {
                                            $rowsieve = $ressieve[0];
                                            $sieveid = $rowsieve['id'];
                                        } else {
                                            $sieveid = $IISMethods->generateuuid();

                                            $insqrysieve['id'] = $sieveid;
                                            $insqrysieve['name'] = $sieve;
                                            $insqrysieve['isactive'] = 1;
                                            $insqrysieve['timestamp'] = $datetime;
                                            $insqrysieve['entry_uid'] = $uid;
                                            $insqrysieve['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsievemaster', $insqrysieve, '');
                                        }
                                    }


                                    $fancyintensityid = '';
                                    if ($fancyintensity) {
                                        $qryfancyintensity = "SELECT id FROM tblfancyintensitymaster WHERE name=:fancyintensity";
                                        $paramfancyintensity = array(':fancyintensity' => $fancyintensity);
                                        $resfancyintensity = $DB->getmenual($qryfancyintensity, $paramfancyintensity);
                                        if (sizeof($resfancyintensity) > 0) {
                                            $rowfancyintensity = $resfancyintensity[0];
                                            $fancyintensityid = $rowfancyintensity['id'];
                                        } else {

                                            $maxdisplayordqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblfancyintensitymaster ";
                                            $maxparmas = array();
                                            $maxdores = $DB->getmenual($maxdisplayordqry, $maxparmas);
                                            $rowod = $maxdores[0];
                                            $maxdo = 1;
                                            if ($rowod['maxdo'] > 0) {
                                                $maxdo = $rowod['maxdo'] + 1;
                                            }
                                            $fancyintensityid = $IISMethods->generateuuid();

                                            $insqryfancyintensity['id'] = $fancyintensityid;
                                            $insqryfancyintensity['name'] = $fancyintensity;
                                            $insqryfancyintensity['isactive'] = 1;
                                            $insqryfancyintensity['displayorder'] = $maxdo;
                                            $insqryfancyintensity['timestamp'] = $datetime;
                                            $insqryfancyintensity['entry_uid'] = $uid;
                                            $insqryfancyintensity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblfancyintensitymaster', $insqryfancyintensity, '');
                                        }
                                    }

                                    $fancycolorid1 = '';
                                    if ($fancycolor1) {
                                        $qryfancycolor1 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor1";
                                        $paramfancycolor1 = array(':fancycolor1' => $fancycolor1);
                                        $resfancycolor1 = $DB->getmenual($qryfancycolor1, $paramfancycolor1);
                                        if (sizeof($resfancycolor1) > 0) {
                                            $rowfancycolor1 = $resfancycolor1[0];
                                            $fancycolorid1 = $rowfancycolor1['id'];
                                        } else {
                                            $fancycolorid1 = $IISMethods->generateuuid();

                                            $insqryfancycolor1['id'] = $fancycolorid1;
                                            $insqryfancycolor1['name'] = $fancycolor1;
                                            $insqryfancycolor1['colorcode'] = $fancycolor1;
                                            $insqryfancycolor1['isactive'] = 1;
                                            $insqryfancycolor1['timestamp'] = $datetime;
                                            $insqryfancycolor1['entry_uid'] = $uid;
                                            $insqryfancycolor1['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfancycolor1, '');
                                        }
                                    }

                                    $fancycolorid2 = '';
                                    if ($fancycolor2) {
                                        $qryfancycolor2 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor2";
                                        $paramfancycolor2 = array(':fancycolor2' => $fancycolor2);
                                        $resfancycolor2 = $DB->getmenual($qryfancycolor2, $paramfancycolor2);
                                        if (sizeof($resfancycolor2) > 0) {
                                            $rowfancycolor2 = $resfancycolor2[0];
                                            $fancycolorid2 = $rowfancycolor2['id'];
                                        } else {
                                            $fancycolorid2 = $IISMethods->generateuuid();

                                            $insqryfancycolor2['id'] = $fancycolorid2;
                                            $insqryfancycolor2['name'] = $fancycolor2;
                                            $insqryfancycolor2['colorcode'] = $fancycolor2;
                                            $insqryfancycolor2['isactive'] = 1;
                                            $insqryfancycolor2['timestamp'] = $datetime;
                                            $insqryfancycolor2['entry_uid'] = $uid;
                                            $insqryfancycolor2['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfancycolor2, '');
                                        }
                                    }

                                    $tradeshowid = '';
                                    if ($tradeshow) {
                                        $qrytradeshow = "SELECT id FROM tbltradeshowmaster WHERE name=:tradeshow";
                                        $paramtradeshow = array(':tradeshow' => $tradeshow);
                                        $restradeshow = $DB->getmenual($qrytradeshow, $paramtradeshow);
                                        if (sizeof($restradeshow) > 0) {
                                            $rowtradeshow = $restradeshow[0];
                                            $tradeshowid = $rowtradeshow['id'];
                                        } else {
                                            $tradeshowid = $IISMethods->generateuuid();

                                            $insqrytradeshow['id'] = $tradeshowid;
                                            $insqrytradeshow['name'] = $tradeshow;
                                            $insqrytradeshow['isactive'] = 1;
                                            $insqrytradeshow['timestamp'] = $datetime;
                                            $insqrytradeshow['entry_uid'] = $uid;
                                            $insqrytradeshow['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbltradeshowmaster', $insqrytradeshow, '');
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
                                            $insqrybrand['displayorder'] = 1;
                                            $insqrybrand['isactive'] = 1;
                                            $insqrybrand['timestamp'] = $datetime;
                                            $insqrybrand['entry_uid'] = $uid;
                                            $insqrybrand['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblbrandmaster', $insqrybrand, '');
                                        }
                                    }

                                    $shadeid = '';
                                    if ($shade) {
                                        $qryshade = "SELECT id FROM tblshademaster WHERE name=:shade";
                                        $paramshade = array(':shade' => $shade);
                                        $resshade = $DB->getmenual($qryshade, $paramshade);
                                        if (sizeof($resshade) > 0) {
                                            $rowshade = $resshade[0];
                                            $shadeid = $rowshade['id'];
                                        } else {
                                            $shadeid = $IISMethods->generateuuid();

                                            $insqryshade['id'] = $shadeid;
                                            $insqryshade['name'] = $shade;
                                            $insqryshade['isactive'] = 1;
                                            $insqryshade['timestamp'] = $datetime;
                                            $insqryshade['entry_uid'] = $uid;
                                            $insqryshade['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblshademaster', $insqryshade, '');
                                        }
                                    }
                                    $eyecleanid = '';
                                    if ($eyeclean) {
                                        $qryeyeclean = "SELECT id FROM tbleyecleanmaster WHERE name=:eyeclean";
                                        $parameyeclean = array(':eyeclean' => $eyeclean);
                                        $reseyeclean = $DB->getmenual($qryeyeclean, $parameyeclean);
                                        if (sizeof($reseyeclean) > 0) {
                                            $roweyeclean = $reseyeclean[0];
                                            $eyecleanid = $roweyeclean['id'];
                                        } else {
                                            $eyecleanid = $IISMethods->generateuuid();

                                            $insqryeyeclean['id'] = $eyecleanid;
                                            $insqryeyeclean['name'] = $eyeclean;
                                            $insqryeyeclean['isactive'] = 1;
                                            $insqryeyeclean['timestamp'] = $datetime;
                                            $insqryeyeclean['entry_uid'] = $uid;
                                            $insqryeyeclean['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbleyecleanmaster', $insqryeyeclean, '');
                                        }
                                    }
                                    $milkyid = '';
                                    if ($milky) {
                                        $qrymilky = "SELECT id FROM tblmilkymaster WHERE name=:milky";
                                        $parammilky = array(':milky' => $milky);
                                        $resmilky = $DB->getmenual($qrymilky, $parammilky);
                                        if (sizeof($resmilky) > 0) {
                                            $rowmilky = $resmilky[0];
                                            $milkyid = $rowmilky['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblmilkymaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $milkyid = $IISMethods->generateuuid();

                                            $insqrymilky['id'] = $milkyid;
                                            $insqrymilky['name'] = $milky;
                                            $insqrymilky['isactive'] = 1;
                                            $insqrymilky['displayorder'] = $maxdo;
                                            $insqrymilky['timestamp'] = $datetime;
                                            $insqrymilky['entry_uid'] = $uid;
                                            $insqrymilky['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblmilkymaster', $insqrymilky, '');
                                        }
                                    }

                                    $roughdiamondsourceid = '';
                                    if ($roughdiamondsource) {
                                        $qryroughdiamondsource = "SELECT id FROM tblroughdiamondsourcemaster WHERE name=:roughdiamondsource";
                                        $paramroughdiamondsource = array(':roughdiamondsource' => $roughdiamondsource);
                                        $resroughdiamondsource = $DB->getmenual($qryroughdiamondsource, $paramroughdiamondsource);
                                        if (sizeof($resroughdiamondsource) > 0) {
                                            $rowroughdiamondsource = $resroughdiamondsource[0];
                                            $roughdiamondsourceid = $rowroughdiamondsource['id'];
                                        } else {
                                            $roughdiamondsourceid = $IISMethods->generateuuid();

                                            $insqryroughdiamondsource['id'] = $roughdiamondsourceid;
                                            $insqryroughdiamondsource['name'] = $roughdiamondsource;
                                            $insqryroughdiamondsource['isactive'] = 1;
                                            $insqryroughdiamondsource['displayorder'] = 1;
                                            $insqryroughdiamondsource['timestamp'] = $datetime;
                                            $insqryroughdiamondsource['entry_uid'] = $uid;
                                            $insqryroughdiamondsource['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblroughdiamondsourcemaster', $insqryroughdiamondsource, '');
                                        }
                                    }
                                    $gridleconditionid = '';
                                    if ($gridlecondition) {
                                        $qrygridlecondition = "SELECT id FROM tblgirdleconditionmaster WHERE name=:gridlecondition";
                                        $paramgridlecondition = array(':gridlecondition' => $gridlecondition);
                                        $resgridlecondition = $DB->getmenual($qrygridlecondition, $paramgridlecondition);
                                        if (sizeof($resgridlecondition) > 0) {
                                            $rowgridlecondition = $resgridlecondition[0];
                                            $gridleconditionid = $rowgridlecondition['id'];
                                        } else {
                                            $maxdoqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblgirdleconditionmaster";
                                            $maxdoparams = array();
                                            $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                            $maxdorow = $maxdores[0];
                                            $maxdo = $maxdorow['maxdo'] + 1;
                                            $gridleconditionid = $IISMethods->generateuuid();

                                            $insqrygridlecondition['id'] = $gridleconditionid;
                                            $insqrygridlecondition['name'] = $gridlecondition;
                                            $insqrygridlecondition['isactive'] = 1;
                                            $insqrygridlecondition['displayorder'] = $maxdo;
                                            $insqrygridlecondition['timestamp'] = $datetime;
                                            $insqrygridlecondition['entry_uid'] = $uid;
                                            $insqrygridlecondition['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgirdleconditionmaster', $insqrygridlecondition, '');
                                        }
                                    }



                                    // print_r($treatment);
                                    $flttreatmentname = implode("','", explode(",", $treatment));
                                    $fltkeytosymbolsname = implode("','", explode(",", $keytosymbols));
                                    $fltovertonename = implode("','", explode(",", $overtone));
                                    $fltopeninclusionsname = implode("','", explode(",", $openinclusions));
                                    $fltblackinclusionsname = implode("','", explode(",", $blackinclusions));
                                    $fltwhiteinclusionsname = implode("','", explode(",", $whiteinclusions));
                                    if ($i == 1) {
                                        $qrydiamond = "SELECT id FROM tbldiamond WHERE personid=:personid";
                                        $paramdiamond = array(':personid' => $uid);
                                        $resdiamond = $DB->getmenual($qrydiamond, $paramdiamond);
                                        if (sizeof($resdiamond) > 0) {
                                            for ($dm = 0; $dm < sizeof($resdiamond); $dm++) {
                                                $rowdm = $resdiamond[$dm];
                                                $diamondid = $rowdm['id'];

                                                $params = array(
                                                    'id' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamond', '', $params);
                                                $DB->userwisediamonjewelrylog(1, $uid);

                                                $keytosymbolparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                                                $overtoneparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                                                $openinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                                                $blackinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                                                $whiteinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);
                                            }
                                        }
                                    }


                                    // QUERY GET DATA
                                    $qrydata = "SELECT
                                    IFNULL((SELECT name FROM tblavailabilitymaster WHERE id=:availabilityid),'') AS availability,
                                    IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS country,
                                    IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS state,
                                    IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shape,
                                    IFNULL((SELECT name FROM tblsizemaster WHERE id=:sizeid),'') AS size,
                                    IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:diamondcolorid),'') AS diamondcolor,
                                    IFNULL((SELECT name FROM tblclaritymaster WHERE id=:clarityid),'') AS clarity,
                                    IFNULL((SELECT name FROM tblcutmaster WHERE id=:cutid),'') AS cut,
                                    IFNULL((SELECT name FROM tblpolishmaster WHERE id=:polishid),'') AS polish,
                                    IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:symmetryid),'') AS symmetry,
                                    IFNULL((SELECT name FROM tblintensitymaster WHERE id=:intensityid),'') AS intensity,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:colorid),'') AS color,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:colorcodeid),'') AS colorcode,
                                    IFNULL((SELECT name FROM tblgirdleconditionmaster WHERE id=:conditionid),'') AS conditions,
                                    IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridleminid),'') AS gridlemin,
                                    IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridlemaxid),'') AS gridlemax,
                                    IFNULL((SELECT name FROM tblculetcondition WHERE id=:culetconditionid),'') AS culetcondition,
                                    IFNULL((SELECT name FROM tblsizemaster WHERE id=:culetsizeid),'') AS culetsize,
                                    IFNULL((SELECT group_concat(id) FROM tbltreatmentmaster WHERE name IN ('" . $flttreatmentname . "')),'') AS treatment,
                                    IFNULL((SELECT name FROM tbllabmaster WHERE id=:labid),'') AS lab,
                                    IFNULL((SELECT group_concat(id) FROM tblkeytosymbolmaster WHERE name IN ('" . $fltkeytosymbolsname . "')),'') AS keytosymbol,
                                    IFNULL((SELECT name FROM tblfancyintensitymaster WHERE id=:fancyintensityid),'') AS fancyintensity,
                                    IFNULL((SELECT group_concat(id) FROM tblovertonemaster WHERE name IN ('" . $fltovertonename . "')),'') AS overtone,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid1),'') AS fancycolor1,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid1),'') AS fancycolorcode1,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid2),'') AS fancycolor2,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid2),'') AS fancycolorcode2,
                                    IFNULL((SELECT name FROM tbltradeshowmaster WHERE id=:tradeshowid),'') AS tradeshow,
                                    IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,
                                    IFNULL((SELECT name FROM tblshademaster WHERE id=:shadeid),'') AS shade,
                                    IFNULL((SELECT name FROM tbleyecleanmaster WHERE id=:eyecleanid),'') AS eyeclean,
                                    IFNULL((SELECT name FROM tblmilkymaster WHERE id=:milkyid),'') AS milky,
                                    IFNULL((SELECT group_concat(id) FROM tblopeninclusionmaster WHERE name IN ('" . $fltopeninclusionsname . "')),'') AS openinclusions,
                                    IFNULL((SELECT group_concat(id) FROM tblblackinclusionmaster WHERE name IN ('" . $fltblackinclusionsname . "')),'') AS blackinclusions,
                                    IFNULL((SELECT group_concat(id) FROM tblwhiteinclusionmaster WHERE name IN ('" . $fltwhiteinclusionsname . "')),'') AS whiteinclusions,
                                    IFNULL((SELECT name FROM tblroughdiamondsourcemaster WHERE id=:roughdiamondsourceid),'') AS roughdiamondsource,
                                    IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,
                                    IFNULL((SELECT name FROM tblsievemaster WHERE id=:sieveid),'') AS sievename";
                                    $paramdata = array(
                                        ':availabilityid' => $availabilityid,
                                        ':countryid' => $countryid,
                                        ':stateid' => $stateid,
                                        ':shapeid' => $shapeid,
                                        ':sizeid' => $sizeid,
                                        ':diamondcolorid' => $colorid,
                                        ':clarityid' => $clarityid,
                                        ':cutid' => $cutid,
                                        ':polishid' => $polishid,
                                        ':symmetryid' => $symmetryid,
                                        ':intensityid' => $intensityid,
                                        ':colorid' => $fluorescenecolorid,
                                        ':colorcodeid' => $fluorescenecolorid,
                                        ':conditionid' => $gridleconditionid,
                                        ':gridleminid' => $gridleminid,
                                        ':gridlemaxid' => $gridlemaxid,
                                        ':culetconditionid' => $culetconditionid,
                                        ':culetsizeid' => $culetsizeid,
                                        ':labid' => $labid,
                                        ':fancyintensityid' => $fancyintensityid,
                                        ':fancycolorid1' => $fancycolorid1,
                                        ':fancycolorcodeid1' => $fancycolorid1,
                                        ':fancycolorid2' => $fancycolorid2,
                                        ':fancycolorcodeid2' => $fancycolorid2,
                                        ':tradeshowid' => $tradeshowid,
                                        ':brandid' => $brandid,
                                        ':shadeid' => $shadeid,
                                        ':eyecleanid' => $eyecleanid,
                                        ':milkyid' => $milkyid,
                                        ':roughdiamondsourceid' => $roughdiamondsourceid,
                                        ':personid' => $uid,
                                        ':sieveid' => $sieveid,
                                    );
                                    //  print_r($paramdata);

                                    $resdata = $DB->getmenual($qrydata, $paramdata);
                                    $rowdata = $resdata[0];
                                    //  print_r($rowdata);

                                    $insqry = array(
                                        'personid' => $uid,
                                        'personname' => $rowdata['personname'],
                                        'stock' => $stock,
                                        'price' => $price,
                                        'ispricectsavani' => $ispricectsavani,
                                        'availabilityid' => $availabilityid,
                                        'availability' => $rowdata['availability'],
                                        'countryid' => $countryid,
                                        'country' => $rowdata['country'],
                                        'stateid' => $stateid,
                                        'state' => $rowdata['state'],
                                        'city' => $city,
                                        'shapeid' => $shapeid,
                                        'shape' => $rowdata['shape'],
                                        'sizeid' => $sizeid,
                                        'size' => $rowdata['size'],
                                        'colorid' => $colorid,
                                        'color' => $rowdata['diamondcolor'],
                                        'clarityid' => $clarityid,
                                        'clarity' => $rowdata['clarity'],
                                        'cutid' => $cutid,
                                        'cut' => $rowdata['cut'],
                                        'polishid' => $polishid,
                                        'polish' => $rowdata['polish'],
                                        'symmetryid' => $symmetryid,
                                        'symmetry' => $rowdata['symmetry'],
                                        'intensityid' => $intensityid,
                                        'intensity' => $rowdata['intensity'],
                                        'fluorescenecolorid' => $fluorescenecolorid,
                                        'fluorescenecolor' => $rowdata['color'],
                                        'fluorescenecolorcode' => $rowdata['colorcode'],
                                        'length' => $length,
                                        'width' => $width,
                                        'depth' => $depth,
                                        'depthper' => $depthper,
                                        'tableper' => $tableper,
                                        'crownangle' => $crownangle,
                                        'crownheight' => $crownheight,
                                        'pavilionangle' => $pavilionangle,
                                        'pavilionheight' => $pavilionheight,
                                        'gridleconditionid' => $gridleconditionid,
                                        'gridlecondition' => $rowdata['conditions'],
                                        'gridleminid' => $gridleminid,
                                        'gridlemin' => $rowdata['gridlemin'],
                                        'gridlemaxid' => $gridlemaxid,
                                        'gridlemax' => $rowdata['gridlemax'],
                                        'gridleper' => $gridleper,
                                        'culetconditionid' => $culetconditionid,
                                        'culetcondition' => $rowdata['culetcondition'],
                                        'culetsizeid' => $culetsizeid,
                                        'culetsize' => $rowdata['culetsize'],
                                        'treatmentid' => $rowdata['treatment'],
                                        'treatment' => $treatment,
                                        'laserinscription' => $laserinscription,
                                        'starlength' => $starlength,
                                        'labid' => $labid,
                                        'lab' => $rowdata['lab'],
                                        'reportnumber' => $reportnumber,
                                        'showonsavanigems' => $showonsavanigems,
                                        'reportdate' => $reportdate,
                                        'lablocation' => $lablocation,
                                        'reportcomment' => $reportcomment,
                                        'keytosymbolsid' => $rowdata['keytosymbol'],
                                        'keytosymbols' => $keytosymbols,
                                        'fancyintensityid' => $fancyintensityid,
                                        'fancyintensity' => $rowdata['fancyintensity'],
                                        'overtoneid' => $rowdata['overtone'],
                                        'overtone' => $overtone,
                                        'fancycolorid1' => $fancycolorid1,
                                        'fancycolor1' => $rowdata['fancycolor1'],
                                        'fancycolorcode1' => $rowdata['fancycolorcode1'],
                                        'fancycolorid2' => $fancycolorid2,
                                        'fancycolor2' => $rowdata['fancycolor2'],
                                        'fancycolorcode2' => $rowdata['fancycolorcode2'],
                                        'matchedpair' => $matchedpair,
                                        'stocknumber' => $stocknumber,
                                        'ispairseparable' => $ispairseparable,
                                        'isdownload' => $isdownload,
                                        'tradeshowid' => $tradeshowid,
                                        'tradeshow' => $rowdata['tradeshow'],
                                        'brandid' => $brandid,
                                        'brand' => $rowdata['brand'],
                                        'suppliercomment' => $suppliercomment,
                                        'isparcel' => $isparcel,
                                        'numofdiamond' => $numofdiamond,
                                        'sarineloupe' => $sarineloupe,
                                        'sellerspecification' => $sellerspecification,
                                        'shadeid' => $shadeid,
                                        'shade' => $rowdata['shade'],
                                        'eyecleanid' => $eyecleanid,
                                        'eyeclean' => $rowdata['eyeclean'],
                                        'milkyid' => $milkyid,
                                        'milky' => $rowdata['milky'],
                                        'openinclusionsid' => $rowdata['openinclusions'],
                                        'openinclusions' => $openinclusions,
                                        'blackinclusionsid' => $rowdata['blackinclusions'],
                                        'blackinclusions' => $blackinclusions,
                                        'whiteinclusionsid' => $rowdata['whiteinclusions'],
                                        'whiteinclusions' => $whiteinclusions,
                                        'roughdiamondsourceid' => $roughdiamondsourceid,
                                        'roughdiamondsource' => $rowdata['roughdiamondsource'],
                                        'videolink' => $videolink,
                                        'sieveid' => $sieveid,
                                        'sievename' => $rowdata['sievename'],
                                        'piecepercarat' => $piecepercarat,
                                        'savanipercentage' => $savanipercentage,
                                        'iscsvupload' => 1
                                    );

                                    $typename = 'diamond';
                                    $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";
                                    $seriesparams = array(
                                        ':typename' => $typename,
                                    );
                                    $result_ary = $DB->getmenual($qryseries, $seriesparams);
                                    $rowseries = $result_ary[0];

                                    $seriesid = $rowseries['id'];
                                    $seriesno = $DB->getorderno($seriesid, 'diamond', $currdate);
                                    $maxid = $DB->getmaxid($seriesid, 'diamond');

                                    if ($seriesid) {
                                        try {
                                            $DB->begintransaction();


                                            $diamondid = $IISMethods->generateuuid();

                                            $containreportfileorlink = 0;
                                            if ($reportfilelink) {
                                                $containreportfileorlink = 2;
                                            }

                                            $containdiamondimgorlink = 0;
                                            if ($diamondimglink) {
                                                $containdiamondimgorlink = 2;
                                            }



                                            $insqry['id'] = $diamondid;
                                            $insqry['savanilotnumber'] = $seriesno;
                                            $insqry['diamondimglink'] = $diamondimglink;
                                            $insqry['containdiamondimgorlink'] = $containdiamondimgorlink;
                                            $insqry['containreportfileorlink'] = $containreportfileorlink;
                                            $insqry['reportfilelink'] = $reportfilelink;
                                            $insqry['isactive'] = 1;
                                            $insqry['maxid'] = $maxid;
                                            $insqry['seriesid'] = $seriesid;
                                            $insqry['timestamp'] = $datetime;
                                            $insqry['entry_uid'] = $uid;
                                            $insqry['entry_date'] = $datetime;

                                            // print_r($insqry);exit;
                                            $DB->executedata('i', 'tbldiamond', $insqry, '');

                                            $DB->userwisediamonjewelrylog(1, $uid);


                                            if (sizeof($flttreatment) > 0) {
                                                for ($t = 0; $t < sizeof($flttreatment); $t++) {
                                                    $qrytreatment = "SELECT id from tbltreatmentmaster where name=:id";
                                                    $parmstreatment = array(
                                                        ':id' => $flttreatment[$t],
                                                    );
                                                    $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);
                                                    $mtreatmentid = $IISMethods->generateuuid();
                                                    $inspertreatment = array(
                                                        'id' => $mtreatmentid,
                                                        'diamondid' => $diamondid,
                                                        'treatmentid' => $result_treatment[0]['id'],
                                                        'treatment' => $flttreatment[$t],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondtreatment', $inspertreatment, '');
                                                }
                                            }
                                            if (sizeof($fltkeytosymbols) > 0) {
                                                for ($k = 0; $k < sizeof($fltkeytosymbols); $k++) {
                                                    $qrykeytosymbol = "SELECT id from tblkeytosymbolmaster where name=:id";
                                                    $parmskeytosymbol = array(
                                                        ':id' => $fltkeytosymbols[$k],
                                                    );
                                                    $result_keytosymbol = $DB->getmenual($qrykeytosymbol, $parmskeytosymbol);
                                                    $mkeytosymbolsid = $IISMethods->generateuuid();
                                                    $insperkeytosymbol = array(
                                                        'id' => $mkeytosymbolsid,
                                                        'diamondid' => $diamondid,
                                                        'keytosymbolsid' => $result_keytosymbol[0]['id'],
                                                        'keytosymbols' => $fltkeytosymbols[$k],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondkeytosymbol', $insperkeytosymbol, '');
                                                }
                                            }
                                            if (sizeof($fltovertone) > 0) {
                                                for ($o = 0; $o < sizeof($fltovertone); $o++) {
                                                    $qryovertone = "SELECT id from tblovertonemaster where name=:id";
                                                    $parmsovertone = array(
                                                        ':id' => $fltovertone[$o],
                                                    );
                                                    $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                                    $movertoneid = $IISMethods->generateuuid();
                                                    $insperovertone = array(
                                                        'id' => $movertoneid,
                                                        'diamondid' => $diamondid,
                                                        'overtoneid' => $result_overtone[0]['id'],
                                                        'overtone' => $fltovertone[$o],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondovertone', $insperovertone, '');
                                                }
                                            }

                                            if (sizeof($fltopeninclusions) > 0) {
                                                for ($op = 0; $op < sizeof($fltopeninclusions); $op++) {
                                                    $qryopeninclusion = "SELECT id from tblopeninclusionmaster where name=:id";
                                                    $parmsopeninclusion = array(
                                                        ':id' => $fltopeninclusions[$op],
                                                    );
                                                    $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                                    $mopeninclusionsid = $IISMethods->generateuuid();
                                                    $insperopeninclusion = array(
                                                        'id' => $mopeninclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'openinclusionsid' => $result_openinclusion[0]['id'],
                                                        'openinclusions' => $fltopeninclusions[$op],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondopeninclusions', $insperopeninclusion, '');
                                                }
                                            }

                                            if (sizeof($fltblackinclusions) > 0) {
                                                for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                                    $qryblackinclusion = "SELECT id from tblblackinclusionmaster where name=:id";
                                                    $parmsblackinclusion = array(
                                                        ':id' => $fltblackinclusions[$bi],
                                                    );
                                                    $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                                    $mblackinclusionsid = $IISMethods->generateuuid();
                                                    $insperblackinclusion = array(
                                                        'id' => $mblackinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'blackinclusionsid' => $result_blackinclusion[0]['id'],
                                                        'blackinclusions' => $fltblackinclusions[$bi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondblackinclusions', $insperblackinclusion, '');
                                                }
                                            }

                                            if (sizeof($fltwhiteinclusions) > 0) {
                                                for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                                    $qrywhiteinclusion = "SELECT id from tblwhiteinclusionmaster where name=:id";
                                                    $parmswhiteinclusion = array(
                                                        ':id' => $fltwhiteinclusions[$wi],
                                                    );
                                                    $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                                    $mwhiteinclusionsid = $IISMethods->generateuuid();
                                                    $insperwhiteinclusion = array(
                                                        'id' => $mwhiteinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'whiteinclusionsid' => $result_whiteinclusion[0]['id'],
                                                        'whiteinclusions' => $fltwhiteinclusions[$wi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondwhiteinclusions', $insperwhiteinclusion, '');
                                                }
                                            }

                                            $cnt_ins++;
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
                                } else {
                                    $response['errordata'][$j]['no'] = $IISMethods->sanitize($i + 1);
                                    $response['errordata'][$j]['stock'] = $IISMethods->sanitize($stock);
                                    $response['errordata'][$j]['price'] = $IISMethods->sanitize($price);
                                    $response['errordata'][$j]['shape'] = $IISMethods->sanitize($shape);
                                    $response['errordata'][$j]['size'] = $IISMethods->sanitize($size);
                                    $response['errordata'][$j]['color'] = $IISMethods->sanitize($color);
                                    $response['errordata'][$j]['clarity'] = $IISMethods->sanitize($clarity);
                                    $cnt_err++;

                                    $j++;
                                }
                            }
                            $i++;
                        }

                        // $response['cnt_upddata']=(int)$cnt_upd;
                        $response['cnt_insdata'] = (int)$cnt_ins;
                        $response['cnt_errordata'] = (int)$cnt_err;

                        $status = 1;
                        $message = $errmsg['diamondinsert'];
                    } else {
                        $status = 0;
                        $message = $errmsg['filesel'];
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'uploaddiamondcsv_old1') {
                $filename = $_FILES['csvfile']['tmp_name'];
                if ($CanListDiamondXL == 1) {
                    if ($_FILES["csvfile"]["size"] > 0) {
                        $file = fopen($filename, "r");
                        $i = 0;
                        $j = 0;
                        $cnt_ins = 0;
                        $cnt_upd = 0;
                        $cnt_err = 0;
                        while (($itemData = fgetcsv($file, 10000, ",")) !== FALSE) {
                            if ($i > 0) {

                                $stock = trim($itemData[0]); // Stock # 
                                $availability = trim($itemData[1]); // Availability
                                $shape = trim($itemData[2]); // Shape
                                $size = trim($itemData[3]); // Weight
                                $color = trim($itemData[4]); // Color
                                $clarity = trim($itemData[5]); // Clarity
                                $cut = trim($itemData[6]); // Cut Grade
                                $polish = trim($itemData[7]); // Polish
                                $symmetry = trim($itemData[8]); // Symmetry
                                $intensity = trim($itemData[9]); // Fluorescence Intensity
                                $fluorescenecolor = trim($itemData[10]); // Fluorescence Color

                                $Measurements = trim($itemData[11]); // Measurements
                                $rep_sp_char1 = str_replace("-", "|", $Measurements);
                                $rep_sp_char2 = str_replace("x", "|", $rep_sp_char1);
                                $rep_sp_char3 = str_replace("X", "|", $rep_sp_char2);
                                $expMeasurements = explode('|', $rep_sp_char3);
                                $length = trim($expMeasurements[0]);
                                $width = trim($expMeasurements[1]);
                                $depth = trim($expMeasurements[2]);

                                $BGM = trim($itemData[12]); // BGM
                                $eyeclean = trim($itemData[13]); // Eye Clean
                                $lab = trim($itemData[14]); // Lab
                                $reportnumber = trim($itemData[15]); // Report #
                                $RapLab_Report_ID = trim($itemData[16]); // RapLab Report ID
                                $treatment = trim($itemData[17]); // Treatment - Multiple
                                $price = trim($itemData[18]); // Price
                                $savanipercentage = trim($itemData[19]); // Discount %
                                $cash_price = trim($itemData[20]); // Cash Price
                                $cash_discpercentage = trim($itemData[21]); // Cash Price Discount %
                                $depthper = trim($itemData[22]); // Depth %
                                $tableper = trim($itemData[23]); // Table %
                                $gridlemin = trim($itemData[24]);   // Girdle Thin
                                $gridlemax = trim($itemData[25]);   // Girdle Thick
                                $gridleper = trim($itemData[26]);   // Girdle %
                                $gridlecondition = trim($itemData[27]); // Girdle Condition
                                $culetsize = trim($itemData[28]);   // Culet Size
                                $culetcondition = trim($itemData[29]); // Culet Condition
                                $crownheight = trim($itemData[30]); // Crown Height
                                $crownangle = trim($itemData[31]); // Crown Angle
                                $pavilionheight = trim($itemData[32]); // Pavilion Depth
                                $pavilionangle = trim($itemData[33]);   // Pavilion Angle
                                $laserinscription = trim($itemData[34]); // Laser Inscription
                                $reportcomment = trim($itemData[35]);   // Cert comment
                                $keytosymbols = trim($itemData[36]);  //Key to symbols - Multiple
                                $suppliercomment = trim($itemData[37]); // Member Comment
                                $starlength = trim($itemData[38]); // Star Length 
                                $shade = trim($itemData[39]); // Shade
                                $whiteinclusions = trim($itemData[40]);  //White Inclusion -  Multiple
                                $blackinclusions = trim($itemData[41]);  //Black Inclusion - Multiple
                                $openinclusions = trim($itemData[42]);    //Open Inclusion - Multiple
                                $milky = trim($itemData[43]); //Milky
                                $fancycolor1 = trim($itemData[44]); //Fancy Color
                                $fancyintensity = trim($itemData[45]); //Fancy Color Intensity
                                $overtone = trim($itemData[46]); //Fancy Color Overtone - Multiple
                                $country = trim($itemData[47]); //Country
                                $state = trim($itemData[48]); //State
                                $city = trim($itemData[49]); //City
                                $brand = trim($itemData[50]); //Brand
                                $sellerspecification = trim($itemData[51]); //Seller Spec
                                $reportfilelink = trim($itemData[52]); //Report Filename
                                $diamondimglink = trim($itemData[53]); //Diamond Image
                                $videolink = trim($itemData[54]); //Video Link
                                $sarineloupe = trim($itemData[55]);  //Sarine Loupe
                                $tradeshow = trim($itemData[56]); //Trade Show
                                $reportdate = trim($itemData[57]); //Report Issue Date
                                $report_type = trim($itemData[58]); //Report Type
                                $lablocation = trim($itemData[59]); //Lab Location
                                $stocknumber = trim($itemData[60]); //Pair Stock #
                                $ispairseparable = trim($itemData[61]); // Is Matched Pair Separable
                                $isparcel = trim($itemData[62]); // Parcel Stones

                                $ispricectsavani = trim($itemData[61]);
                                $showonsavanigems = trim($itemData[62]);
                                $fancycolor2 = trim($itemData[63]);
                                $matchedpair = trim($itemData[64]);
                                $isdownload = trim($itemData[65]);
                                $numofdiamond = trim($itemData[66]);
                                $roughdiamondsource = trim($itemData[67]);
                                $sieve = trim($itemData[68]);
                                $piecepercarat = trim($itemData[69]);


                                $datetime = $IISMethods->getdatetime();



                                $flttreatment = explode(',', $treatment);
                                $fltkeytosymbols = explode(',', $keytosymbols);
                                $fltovertone = explode(',', $overtone);
                                $fltopeninclusions = explode(',', $openinclusions);
                                $fltblackinclusions = explode(',', $blackinclusions);
                                $fltwhiteinclusions = explode(',', $whiteinclusions);


                                if ($stock && $price && $shape && $size && $color && $clarity) {

                                    $availabilityid = '';
                                    if ($availability) // Availability
                                    {
                                        $qryavailability = "SELECT id FROM tblavailabilitymaster WHERE name=:availability";
                                        $paramavailability = array(':availability' => $availability);
                                        $resavailability = $DB->getmenual($qryavailability, $paramavailability);
                                        if (sizeof($resavailability) > 0) {
                                            $rowavailability = $resavailability[0];
                                            $availabilityid = $rowavailability['id'];
                                        } else {
                                            $availabilityid = $IISMethods->generateuuid();

                                            $insqryavailability['id'] = $availabilityid;
                                            $insqryavailability['name'] = $availability;
                                            $insqryavailability['isactive'] = 1;
                                            $insqryavailability['timestamp'] = $datetime;
                                            $insqryavailability['entry_uid'] = $uid;
                                            $insqryavailability['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblavailabilitymaster', $insqryavailability, '');
                                        }
                                    }

                                    $countryid = '';
                                    if ($country) // Country
                                    {
                                        $qrycountry = "SELECT id FROM tblcountrymaster WHERE country=:country";
                                        $paramcountry = array(':country' => $country);
                                        $rescountry = $DB->getmenual($qrycountry, $paramcountry);
                                        if (sizeof($rescountry) > 0) {
                                            $rowcountry = $rescountry[0];
                                            $countryid = $rowcountry['id'];
                                        } else {
                                            $countryid = $IISMethods->generateuuid();

                                            $insqrycountry['id'] = $countryid;
                                            $insqrycountry['country'] = $country;
                                            $insqrycountry['timestamp'] = $datetime;
                                            $insqrycountry['entry_uid'] = $uid;
                                            $insqrycountry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcountrymaster', $insqrycountry, '');
                                        }
                                    }

                                    $stateid = '';
                                    if ($state) // State
                                    {
                                        $qrystate = "SELECT id FROM tblstatemaster WHERE state=:state";
                                        $paramstate = array(':state' => $state);
                                        $resstate = $DB->getmenual($qrystate, $paramstate);
                                        if (sizeof($resstate) > 0) {
                                            $rowstate = $resstate[0];
                                            $stateid = $rowstate['id'];
                                        } else {
                                            $stateid = $IISMethods->generateuuid();

                                            $insqrystate['id'] = $stateid;
                                            $insqrystate['countryid'] = $countryid;
                                            $insqrystate['state'] = $state;
                                            $insqrystate['timestamp'] = $datetime;
                                            $insqrystate['entry_uid'] = $uid;
                                            $insqrystate['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblstatemaster', $insqrystate, '');
                                        }
                                    }
                                    $shapeid = '';
                                    if ($shape) // Shape
                                    {
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
                                            $insqryshape['timestamp'] = $datetime;
                                            $insqryshape['entry_uid'] = $uid;
                                            $insqryshape['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamondshapemaster', $insqryshape, '');
                                        }
                                    }

                                    $sizeid = '';
                                    if ($size) // Size
                                    {
                                        $qrysize = "SELECT id FROM tblsizemaster WHERE name=:size";
                                        $paramsize = array(':size' => $size);
                                        $ressize = $DB->getmenual($qrysize, $paramsize);
                                        if (sizeof($ressize) > 0) {
                                            $rowsize = $ressize[0];
                                            $sizeid = $rowsize['id'];
                                        } else {
                                            $sizeid = $IISMethods->generateuuid();

                                            $insqrysize['id'] = $sizeid;
                                            $insqrysize['name'] = $size;
                                            $insqrysize['timestamp'] = $datetime;
                                            $insqrysize['isactive'] = 1;
                                            $insqrysize['entry_uid'] = $uid;
                                            $insqrysize['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsizemaster', $insqrysize, '');
                                        }
                                    }
                                    $colorid = '';
                                    if ($color) {
                                        $qrycolor = "SELECT id FROM tbldiamondcolormaster WHERE name=:color";
                                        $paramcolor = array(':color' => $color);
                                        $rescolor = $DB->getmenual($qrycolor, $paramcolor);
                                        if (sizeof($rescolor) > 0) {
                                            $rowcolor = $rescolor[0];
                                            $colorid = $rowcolor['id'];
                                        } else {
                                            $colorid = $IISMethods->generateuuid();

                                            $insqrycolor['id'] = $colorid;
                                            $insqrycolor['name'] = $color;
                                            $insqrycolor['isactive'] = 1;
                                            $insqrycolor['timestamp'] = $datetime;
                                            $insqrycolor['entry_uid'] = $uid;
                                            $insqrycolor['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamondcolormaster', $insqrycolor, '');
                                        }
                                    }

                                    $clarityid = '';
                                    if ($clarity) {
                                        $qryclarity = "SELECT id FROM tblclaritymaster WHERE name=:clarity";
                                        $paramclarity = array(':clarity' => $clarity);
                                        $resclarity = $DB->getmenual($qryclarity, $paramclarity);
                                        if (sizeof($resclarity) > 0) {
                                            $rowclarity = $resclarity[0];
                                            $clarityid = $rowclarity['id'];
                                        } else {
                                            $clarityid = $IISMethods->generateuuid();

                                            $insqryclarity['id'] = $clarityid;
                                            $insqryclarity['name'] = $clarity;
                                            $insqryclarity['isactive'] = 1;
                                            $insqryclarity['timestamp'] = $datetime;
                                            $insqryclarity['entry_uid'] = $uid;
                                            $insqryclarity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblclaritymaster', $insqryclarity, '');
                                        }
                                    }

                                    $cutid = '';
                                    if ($cut) {
                                        $qrycut = "SELECT id FROM tblcutmaster WHERE name=:cut";
                                        $paramcut = array(':cut' => $cut);
                                        $rescut = $DB->getmenual($qrycut, $paramcut);
                                        if (sizeof($rescut) > 0) {
                                            $rowcut = $rescut[0];
                                            $cutid = $rowcut['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblcutmaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $cutid = $IISMethods->generateuuid();

                                            $insqrycut['id'] = $cutid;
                                            $insqrycut['name'] = $cut;
                                            $insqrycut['isactive'] = 1;
                                            $insqrycut['displayorder'] = $maxdo;
                                            $insqrycut['timestamp'] = $datetime;
                                            $insqrycut['entry_uid'] = $uid;
                                            $insqrycut['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcutmaster', $insqrycut, '');
                                        }
                                    }

                                    $polishid = '';
                                    if ($polish) {
                                        $qrypolish = "SELECT id FROM tblpolishmaster WHERE name=:polish";
                                        $parampolish = array(':polish' => $polish);
                                        $respolish = $DB->getmenual($qrypolish, $parampolish);
                                        if (sizeof($respolish) > 0) {
                                            $rowpolish = $respolish[0];
                                            $polishid = $rowpolish['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblpolishmaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;

                                            $polishid = $IISMethods->generateuuid();

                                            $insqrypolish['id'] = $polishid;
                                            $insqrypolish['name'] = $polish;
                                            $insqrypolish['isactive'] = 1;
                                            $insqrypolish['displayorder'] = $maxdo;
                                            $insqrypolish['timestamp'] = $datetime;
                                            $insqrypolish['entry_uid'] = $uid;
                                            $insqrypolish['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblpolishmaster', $insqrypolish, '');
                                        }
                                    }

                                    $symmetryid = '';
                                    if ($symmetry) {
                                        $qrysymmetry = "SELECT id FROM tblsymmetrymaster WHERE name=:symmetry";
                                        $paramsymmetry = array(':symmetry' => $symmetry);
                                        $ressymmetry = $DB->getmenual($qrysymmetry, $paramsymmetry);
                                        if (sizeof($ressymmetry) > 0) {
                                            $rowsymmetry = $ressymmetry[0];
                                            $symmetryid = $rowsymmetry['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblsymmetrymaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $symmetryid = $IISMethods->generateuuid();

                                            $insqrysymmetry['id'] = $symmetryid;
                                            $insqrysymmetry['name'] = $symmetry;
                                            $insqrysymmetry['isactive'] = 1;
                                            $insqrysymmetry['displayorder'] = $maxdo;
                                            $insqrysymmetry['timestamp'] = $datetime;
                                            $insqrysymmetry['entry_uid'] = $uid;
                                            $insqrysymmetry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsymmetrymaster', $insqrysymmetry, '');
                                        }
                                    }

                                    $intensityid = '';
                                    if ($intensity) {
                                        $qryintensity = "SELECT id FROM tblintensitymaster WHERE name=:intensity";
                                        $paramintensity = array(':intensity' => $intensity);
                                        $resintensity = $DB->getmenual($qryintensity, $paramintensity);
                                        if (sizeof($resintensity) > 0) {
                                            $rowintensity = $resintensity[0];
                                            $intensityid = $rowintensity['id'];
                                        } else {
                                            $intensityid = $IISMethods->generateuuid();

                                            $insqryintensity['id'] = $intensityid;
                                            $insqryintensity['name'] = $intensity;
                                            $insqryintensity['isactive'] = 1;
                                            $insqryintensity['timestamp'] = $datetime;
                                            $insqryintensity['entry_uid'] = $uid;
                                            $insqryintensity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblintensitymaster', $insqryintensity, '');
                                        }
                                    }

                                    $fluorescenecolorid = '';
                                    if ($fluorescenecolor) {
                                        $qryfluorescenecolor = "SELECT id FROM tblcolormaster WHERE name=:fluorescenecolor";
                                        $paramfluorescenecolor = array(':fluorescenecolor' => $fluorescenecolor);
                                        $resfluorescenecolor = $DB->getmenual($qryfluorescenecolor, $paramfluorescenecolor);
                                        if (sizeof($resfluorescenecolor) > 0) {
                                            $rowfluorescenecolor = $resfluorescenecolor[0];
                                            $fluorescenecolorid = $rowfluorescenecolor['id'];
                                        } else {
                                            $fluorescenecolorid = $IISMethods->generateuuid();

                                            $insqryfluorescenecolor['id'] = $fluorescenecolorid;
                                            $insqryfluorescenecolor['name'] = $fluorescenecolor;
                                            $insqryfluorescenecolor['colorcode'] = $fluorescenecolor;
                                            $insqryfluorescenecolor['isactive'] = 1;
                                            $insqryfluorescenecolor['timestamp'] = $datetime;
                                            $insqryfluorescenecolor['entry_uid'] = $uid;
                                            $insqryfluorescenecolor['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfluorescenecolor, '');
                                        }
                                    }

                                    $gridleminid = '';
                                    if ($gridlemin) {
                                        $qrygridlemin = "SELECT id FROM tblgridlemaster WHERE name=:gridlemin";
                                        $paramgridlemin = array(':gridlemin' => $gridlemin);
                                        $resgridlemin = $DB->getmenual($qrygridlemin, $paramgridlemin);
                                        if (sizeof($resgridlemin) > 0) {
                                            $rowgridlemin = $resgridlemin[0];
                                            $gridleminid = $rowgridlemin['id'];
                                        } else {
                                            $gridleminid = $IISMethods->generateuuid();

                                            $insqrygridlemin['id'] = $gridleminid;
                                            $insqrygridlemin['name'] = $gridlemin;
                                            $insqrygridlemin['isactive'] = 1;
                                            $insqrygridlemin['timestamp'] = $datetime;
                                            $insqrygridlemin['entry_uid'] = $uid;
                                            $insqrygridlemin['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgridlemaster', $insqrygridlemin, '');
                                        }
                                    }
                                    $gridlemaxid = '';
                                    if ($gridlemax) {
                                        $qrygridlemax = "SELECT id FROM tblgridlemaster WHERE name=:gridlemax";
                                        $paramgridlemax = array(':gridlemax' => $gridlemax);
                                        $resgridlemax = $DB->getmenual($qrygridlemax, $paramgridlemax);
                                        if (sizeof($resgridlemax) > 0) {
                                            $rowgridlemax = $resgridlemax[0];
                                            $gridlemaxid = $rowgridlemax['id'];
                                        } else {
                                            $gridlemaxid = $IISMethods->generateuuid();

                                            $insqrygridlemax['id'] = $gridlemaxid;
                                            $insqrygridlemax['name'] = $gridlemax;
                                            $insqrygridlemax['isactive'] = 1;
                                            $insqrygridlemax['timestamp'] = $datetime;
                                            $insqrygridlemax['entry_uid'] = $uid;
                                            $insqrygridlemax['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgridlemaster', $insqrygridlemax, '');
                                        }
                                    }

                                    $culetconditionid = '';
                                    if ($culetcondition) {
                                        $qryculetcondition = "SELECT id FROM tblculetcondition WHERE name=:culetcondition";
                                        $paramculetcondition = array(':culetcondition' => $culetcondition);
                                        $resculetcondition = $DB->getmenual($qryculetcondition, $paramculetcondition);
                                        if (sizeof($resculetcondition) > 0) {
                                            $rowculetcondition = $resculetcondition[0];
                                            $culetconditionid = $rowculetcondition['id'];
                                        } else {
                                            $maxdoqry = "SELECt MAX(ifnull(displayorder,0)) AS maxdo FROM tblculetcondition";
                                            $maxdoparams = array();
                                            $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                            $maxdorow = $maxdores[0];
                                            $maxdo = $maxdorow['maxdo'] + 1;

                                            $culetconditionid = $IISMethods->generateuuid();

                                            $insqryculetcondition['id'] = $culetconditionid;
                                            $insqryculetcondition['name'] = $culetcondition;
                                            $insqryculetcondition['isactive'] = 1;
                                            $insqryculetcondition['displayorder'] = $maxdo;
                                            $insqryculetcondition['timestamp'] = $datetime;
                                            $insqryculetcondition['entry_uid'] = $uid;
                                            $insqryculetcondition['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblculetcondition', $insqryculetcondition, '');
                                        }
                                    }
                                    $culetsizeid = '';
                                    if ($culetsize) {
                                        $qryculetsize = "SELECT id FROM tblsizemaster WHERE name=:culetsize";
                                        $paramculetsize = array(':culetsize' => $culetsize);
                                        $resculetsize = $DB->getmenual($qryculetsize, $paramculetsize);
                                        if (sizeof($resculetsize) > 0) {
                                            $rowculetsize = $resculetsize[0];
                                            $culetsizeid = $rowculetsize['id'];
                                        } else {
                                            $culetsizeid = $IISMethods->generateuuid();

                                            $insqryculetsize['id'] = $culetsizeid;
                                            $insqryculetsize['name'] = $culetsize;
                                            $insqryculetsize['isactive'] = 1;
                                            $insqryculetsize['timestamp'] = $datetime;
                                            $insqryculetsize['entry_uid'] = $uid;
                                            $insqryculetsize['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsizemaster', $insqryculetsize, '');
                                        }
                                    }

                                    $strtreatmentid = '';
                                    if (sizeof($flttreatment) > 0) // Multiple
                                    {
                                        for ($tr = 0; $tr < sizeof($flttreatment); $tr++) {
                                            $treatmentarr = $flttreatment[$tr];

                                            $qrytreatment = "SELECT id FROM tbltreatmentmaster WHERE name=:treatment";
                                            $paramtreatment = array(':treatment' => $treatmentarr);
                                            $restreatment = $DB->getmenual($qrytreatment, $paramtreatment);
                                            if (sizeof($restreatment) > 0) {
                                                $rowtreatment = $restreatment[0];
                                                $treatmentid = $rowtreatment['id'];
                                            } else {
                                                $treatmentid = $IISMethods->generateuuid();

                                                $insqrytreatment['id'] = $treatmentid;
                                                $insqrytreatment['name'] = $treatmentarr;
                                                $insqrytreatment['isactive'] = 1;
                                                $insqrytreatment['timestamp'] = $datetime;
                                                $insqrytreatment['entry_uid'] = $uid;
                                                $insqrytreatment['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tbltreatmentmaster', $insqrytreatment, '');
                                            }

                                            $strtreatmentid .= $treatmentid;
                                            if (sizeof($flttreatment) != $tr) {
                                                $strtreatmentid .= ',';
                                            }
                                        }
                                    }

                                    $strfltkeytosymbolsid = '';
                                    if (sizeof($fltkeytosymbols) > 0) // Multiple
                                    {
                                        for ($ks = 0; $ks < sizeof($fltkeytosymbols); $ks++) {
                                            $fltkeytosymbolsarr = $fltkeytosymbols[$ks];

                                            $qryfltkeytosymbols = "SELECT id FROM tblkeytosymbolmaster WHERE name=:fltkeytosymbols";
                                            $paramfltkeytosymbols = array(':fltkeytosymbols' => $fltkeytosymbolsarr);
                                            $resfltkeytosymbols = $DB->getmenual($qryfltkeytosymbols, $paramfltkeytosymbols);
                                            if (sizeof($resfltkeytosymbols) > 0) {
                                                $rowfltkeytosymbols = $resfltkeytosymbols[0];
                                                $fltkeytosymbolsid = $rowfltkeytosymbols['id'];
                                            } else {
                                                $fltkeytosymbolsid = $IISMethods->generateuuid();

                                                $insqryfltkeytosymbols['id'] = $fltkeytosymbolsid;
                                                $insqryfltkeytosymbols['name'] = $fltkeytosymbolsarr;
                                                $insqryfltkeytosymbols['isactive'] = 1;
                                                $insqryfltkeytosymbols['displayorder'] = 1;
                                                $insqryfltkeytosymbols['timestamp'] = $datetime;
                                                $insqryfltkeytosymbols['entry_uid'] = $uid;
                                                $insqryfltkeytosymbols['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblkeytosymbolmaster', $insqryfltkeytosymbols, '');
                                            }

                                            $strfltkeytosymbolsid .= $fltkeytosymbolsid;
                                            if (sizeof($fltkeytosymbols) != $ks) {
                                                $strfltkeytosymbolsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltovertoneid = '';
                                    if (sizeof($fltovertone) > 0) // Multiple
                                    {
                                        for ($ot = 0; $ot < sizeof($fltovertone); $ot++) {
                                            $fltovertonearr = $fltovertone[$ot];

                                            $qryfltovertone = "SELECT id FROM tblovertonemaster WHERE name=:fltovertone";
                                            $paramfltovertone = array(':fltovertone' => $fltovertonearr);
                                            $resfltovertone = $DB->getmenual($qryfltovertone, $paramfltovertone);
                                            if (sizeof($resfltovertone) > 0) {
                                                $rowfltovertone = $resfltovertone[0];
                                                $fltovertoneid = $rowfltovertone['id'];
                                            } else {
                                                $fltovertoneid = $IISMethods->generateuuid();

                                                $insqryfltovertone['id'] = $fltovertoneid;
                                                $insqryfltovertone['name'] = $fltovertonearr;
                                                $insqryfltovertone['isactive'] = 1;
                                                $insqryfltovertone['timestamp'] = $datetime;
                                                $insqryfltovertone['entry_uid'] = $uid;
                                                $insqryfltovertone['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblovertonemaster', $insqryfltovertone, '');
                                            }

                                            $strfltovertoneid .= $fltovertoneid;
                                            if (sizeof($fltovertone) != $ot) {
                                                $strfltovertoneid .= ',';
                                            }
                                        }
                                    }

                                    $strfltopeninclusionsid = '';
                                    if (sizeof($fltopeninclusions) > 0) // Multiple
                                    {
                                        for ($oi = 0; $oi < sizeof($fltopeninclusions); $oi++) {
                                            $fltopeninclusionsarr = $fltopeninclusions[$oi];

                                            $qryfltopeninclusions = "SELECT id FROM tblopeninclusionmaster WHERE name=:fltopeninclusions";
                                            $paramfltopeninclusions = array(':fltopeninclusions' => $fltopeninclusionsarr);
                                            $resfltopeninclusions = $DB->getmenual($qryfltopeninclusions, $paramfltopeninclusions);
                                            if (sizeof($resfltopeninclusions) > 0) {
                                                $rowfltopeninclusions = $resfltopeninclusions[0];
                                                $fltopeninclusionsid = $rowfltopeninclusions['id'];
                                            } else {
                                                $fltopeninclusionsid = $IISMethods->generateuuid();

                                                $insqryfltopeninclusions['id'] = $fltopeninclusionsid;
                                                $insqryfltopeninclusions['name'] = $fltopeninclusionsarr;
                                                $insqryfltopeninclusions['isactive'] = 1;
                                                $insqryfltopeninclusions['timestamp'] = $datetime;
                                                $insqryfltopeninclusions['entry_uid'] = $uid;
                                                $insqryfltopeninclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblopeninclusionmaster', $insqryfltopeninclusions, '');
                                            }

                                            $strfltopeninclusionsid .= $fltopeninclusionsid;
                                            if (sizeof($fltopeninclusions) != $oi) {
                                                $strfltopeninclusionsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltblackinclusionsid = '';
                                    if (sizeof($fltblackinclusions) > 0) // Multiple
                                    {
                                        for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                            $fltblackinclusionsarr = $fltblackinclusions[$bi];

                                            $qryfltblackinclusions = "SELECT id FROM tblblackinclusionmaster WHERE name=:fltblackinclusions";
                                            $paramfltblackinclusions = array(':fltblackinclusions' => $fltblackinclusionsarr);
                                            $resfltblackinclusions = $DB->getmenual($qryfltblackinclusions, $paramfltblackinclusions);
                                            if (sizeof($resfltblackinclusions) > 0) {
                                                $rowfltblackinclusions = $resfltblackinclusions[0];
                                                $fltblackinclusionsid = $rowfltblackinclusions['id'];
                                            } else {
                                                $fltblackinclusionsid = $IISMethods->generateuuid();

                                                $insqryfltblackinclusions['id'] = $fltblackinclusionsid;
                                                $insqryfltblackinclusions['name'] = $fltblackinclusionsarr;
                                                $insqryfltblackinclusions['isactive'] = 1;
                                                $insqryfltblackinclusions['timestamp'] = $datetime;
                                                $insqryfltblackinclusions['entry_uid'] = $uid;
                                                $insqryfltblackinclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblblackinclusionmaster', $insqryfltblackinclusions, '');
                                            }

                                            $strfltblackinclusionsid .= $fltblackinclusionsid;
                                            if (sizeof($fltblackinclusions) != $bi) {
                                                $strfltblackinclusionsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltwhiteinclusionsid = '';
                                    if (sizeof($fltwhiteinclusions) > 0) // Multiple
                                    {
                                        for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                            $fltwhiteinclusionsarr = $fltwhiteinclusions[$wi];

                                            $qryfltwhiteinclusions = "SELECT id FROM tblwhiteinclusionmaster WHERE name=:fltwhiteinclusions";
                                            $paramfltwhiteinclusions = array(':fltwhiteinclusions' => $fltwhiteinclusionsarr);
                                            $resfltwhiteinclusions = $DB->getmenual($qryfltwhiteinclusions, $paramfltwhiteinclusions);
                                            if (sizeof($resfltwhiteinclusions) > 0) {
                                                $rowfltwhiteinclusions = $resfltwhiteinclusions[0];
                                                $fltwhiteinclusionsid = $rowfltwhiteinclusions['id'];
                                            } else {
                                                $fltwhiteinclusionsid = $IISMethods->generateuuid();

                                                $insqryfltwhiteinclusions['id'] = $fltwhiteinclusionsid;
                                                $insqryfltwhiteinclusions['name'] = $fltwhiteinclusionsarr;
                                                $insqryfltwhiteinclusions['isactive'] = 1;
                                                $insqryfltwhiteinclusions['timestamp'] = $datetime;
                                                $insqryfltwhiteinclusions['entry_uid'] = $uid;
                                                $insqryfltwhiteinclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblwhiteinclusionmaster', $insqryfltwhiteinclusions, '');
                                            }

                                            $strfltwhiteinclusionsid .= $fltwhiteinclusionsid;
                                            if (sizeof($fltwhiteinclusions) != $wi) {
                                                $strfltwhiteinclusionsid .= ',';
                                            }
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
                                            $insqrylab['displayorder'] = 1;
                                            $insqrylab['isactive'] = 1;
                                            $insqrylab['timestamp'] = $datetime;
                                            $insqrylab['entry_uid'] = $uid;
                                            $insqrylab['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbllabmaster', $insqrylab, '');
                                        }
                                    }

                                    $sieveid = '';
                                    if ($sieve) {
                                        $qrysieve = "SELECT id FROM tblsievemaster WHERE name=:sieve";
                                        $paramsieve = array(':sieve' => $sieve);
                                        $ressieve = $DB->getmenual($qrysieve, $paramsieve);
                                        if (sizeof($ressieve) > 0) {
                                            $rowsieve = $ressieve[0];
                                            $sieveid = $rowsieve['id'];
                                        } else {
                                            $sieveid = $IISMethods->generateuuid();

                                            $insqrysieve['id'] = $sieveid;
                                            $insqrysieve['name'] = $sieve;
                                            $insqrysieve['isactive'] = 1;
                                            $insqrysieve['timestamp'] = $datetime;
                                            $insqrysieve['entry_uid'] = $uid;
                                            $insqrysieve['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsievemaster', $insqrysieve, '');
                                        }
                                    }


                                    $fancyintensityid = '';
                                    if ($fancyintensity) {
                                        $qryfancyintensity = "SELECT id FROM tblfancyintensitymaster WHERE name=:fancyintensity";
                                        $paramfancyintensity = array(':fancyintensity' => $fancyintensity);
                                        $resfancyintensity = $DB->getmenual($qryfancyintensity, $paramfancyintensity);
                                        if (sizeof($resfancyintensity) > 0) {
                                            $rowfancyintensity = $resfancyintensity[0];
                                            $fancyintensityid = $rowfancyintensity['id'];
                                        } else {

                                            $maxdisplayordqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblfancyintensitymaster ";
                                            $maxparmas = array();
                                            $maxdores = $DB->getmenual($maxdisplayordqry, $maxparmas);
                                            $rowod = $maxdores[0];
                                            $maxdo = 1;
                                            if ($rowod['maxdo'] > 0) {
                                                $maxdo = $rowod['maxdo'] + 1;
                                            }
                                            $fancyintensityid = $IISMethods->generateuuid();

                                            $insqryfancyintensity['id'] = $fancyintensityid;
                                            $insqryfancyintensity['name'] = $fancyintensity;
                                            $insqryfancyintensity['isactive'] = 1;
                                            $insqryfancyintensity['displayorder'] = $maxdo;
                                            $insqryfancyintensity['timestamp'] = $datetime;
                                            $insqryfancyintensity['entry_uid'] = $uid;
                                            $insqryfancyintensity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblfancyintensitymaster', $insqryfancyintensity, '');
                                        }
                                    }

                                    $fancycolorid1 = '';
                                    if ($fancycolor1) {
                                        $qryfancycolor1 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor1";
                                        $paramfancycolor1 = array(':fancycolor1' => $fancycolor1);
                                        $resfancycolor1 = $DB->getmenual($qryfancycolor1, $paramfancycolor1);
                                        if (sizeof($resfancycolor1) > 0) {
                                            $rowfancycolor1 = $resfancycolor1[0];
                                            $fancycolorid1 = $rowfancycolor1['id'];
                                        } else {
                                            $fancycolorid1 = $IISMethods->generateuuid();

                                            $insqryfancycolor1['id'] = $fancycolorid1;
                                            $insqryfancycolor1['name'] = $fancycolor1;
                                            $insqryfancycolor1['colorcode'] = $fancycolor1;
                                            $insqryfancycolor1['isactive'] = 1;
                                            $insqryfancycolor1['timestamp'] = $datetime;
                                            $insqryfancycolor1['entry_uid'] = $uid;
                                            $insqryfancycolor1['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfancycolor1, '');
                                        }
                                    }

                                    $fancycolorid2 = '';
                                    if ($fancycolor2) {
                                        $qryfancycolor2 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor2";
                                        $paramfancycolor2 = array(':fancycolor2' => $fancycolor2);
                                        $resfancycolor2 = $DB->getmenual($qryfancycolor2, $paramfancycolor2);
                                        if (sizeof($resfancycolor2) > 0) {
                                            $rowfancycolor2 = $resfancycolor2[0];
                                            $fancycolorid2 = $rowfancycolor2['id'];
                                        } else {
                                            $fancycolorid2 = $IISMethods->generateuuid();

                                            $insqryfancycolor2['id'] = $fancycolorid2;
                                            $insqryfancycolor2['name'] = $fancycolor2;
                                            $insqryfancycolor2['colorcode'] = $fancycolor2;
                                            $insqryfancycolor2['isactive'] = 1;
                                            $insqryfancycolor2['timestamp'] = $datetime;
                                            $insqryfancycolor2['entry_uid'] = $uid;
                                            $insqryfancycolor2['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfancycolor2, '');
                                        }
                                    }

                                    $tradeshowid = '';
                                    if ($tradeshow) {
                                        $qrytradeshow = "SELECT id FROM tbltradeshowmaster WHERE name=:tradeshow";
                                        $paramtradeshow = array(':tradeshow' => $tradeshow);
                                        $restradeshow = $DB->getmenual($qrytradeshow, $paramtradeshow);
                                        if (sizeof($restradeshow) > 0) {
                                            $rowtradeshow = $restradeshow[0];
                                            $tradeshowid = $rowtradeshow['id'];
                                        } else {
                                            $tradeshowid = $IISMethods->generateuuid();

                                            $insqrytradeshow['id'] = $tradeshowid;
                                            $insqrytradeshow['name'] = $tradeshow;
                                            $insqrytradeshow['isactive'] = 1;
                                            $insqrytradeshow['timestamp'] = $datetime;
                                            $insqrytradeshow['entry_uid'] = $uid;
                                            $insqrytradeshow['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbltradeshowmaster', $insqrytradeshow, '');
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
                                            $insqrybrand['displayorder'] = 1;
                                            $insqrybrand['isactive'] = 1;
                                            $insqrybrand['timestamp'] = $datetime;
                                            $insqrybrand['entry_uid'] = $uid;
                                            $insqrybrand['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblbrandmaster', $insqrybrand, '');
                                        }
                                    }

                                    $shadeid = '';
                                    if ($shade) {
                                        $qryshade = "SELECT id FROM tblshademaster WHERE name=:shade";
                                        $paramshade = array(':shade' => $shade);
                                        $resshade = $DB->getmenual($qryshade, $paramshade);
                                        if (sizeof($resshade) > 0) {
                                            $rowshade = $resshade[0];
                                            $shadeid = $rowshade['id'];
                                        } else {
                                            $shadeid = $IISMethods->generateuuid();

                                            $insqryshade['id'] = $shadeid;
                                            $insqryshade['name'] = $shade;
                                            $insqryshade['isactive'] = 1;
                                            $insqryshade['timestamp'] = $datetime;
                                            $insqryshade['entry_uid'] = $uid;
                                            $insqryshade['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblshademaster', $insqryshade, '');
                                        }
                                    }
                                    $eyecleanid = '';
                                    if ($eyeclean) {
                                        $qryeyeclean = "SELECT id FROM tbleyecleanmaster WHERE name=:eyeclean";
                                        $parameyeclean = array(':eyeclean' => $eyeclean);
                                        $reseyeclean = $DB->getmenual($qryeyeclean, $parameyeclean);
                                        if (sizeof($reseyeclean) > 0) {
                                            $roweyeclean = $reseyeclean[0];
                                            $eyecleanid = $roweyeclean['id'];
                                        } else {
                                            $eyecleanid = $IISMethods->generateuuid();

                                            $insqryeyeclean['id'] = $eyecleanid;
                                            $insqryeyeclean['name'] = $eyeclean;
                                            $insqryeyeclean['isactive'] = 1;
                                            $insqryeyeclean['timestamp'] = $datetime;
                                            $insqryeyeclean['entry_uid'] = $uid;
                                            $insqryeyeclean['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbleyecleanmaster', $insqryeyeclean, '');
                                        }
                                    }
                                    $milkyid = '';
                                    if ($milky) {
                                        $qrymilky = "SELECT id FROM tblmilkymaster WHERE name=:milky";
                                        $parammilky = array(':milky' => $milky);
                                        $resmilky = $DB->getmenual($qrymilky, $parammilky);
                                        if (sizeof($resmilky) > 0) {
                                            $rowmilky = $resmilky[0];
                                            $milkyid = $rowmilky['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblmilkymaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $milkyid = $IISMethods->generateuuid();

                                            $insqrymilky['id'] = $milkyid;
                                            $insqrymilky['name'] = $milky;
                                            $insqrymilky['isactive'] = 1;
                                            $insqrymilky['displayorder'] = $maxdo;
                                            $insqrymilky['timestamp'] = $datetime;
                                            $insqrymilky['entry_uid'] = $uid;
                                            $insqrymilky['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblmilkymaster', $insqrymilky, '');
                                        }
                                    }

                                    $roughdiamondsourceid = '';
                                    if ($roughdiamondsource) {
                                        $qryroughdiamondsource = "SELECT id FROM tblroughdiamondsourcemaster WHERE name=:roughdiamondsource";
                                        $paramroughdiamondsource = array(':roughdiamondsource' => $roughdiamondsource);
                                        $resroughdiamondsource = $DB->getmenual($qryroughdiamondsource, $paramroughdiamondsource);
                                        if (sizeof($resroughdiamondsource) > 0) {
                                            $rowroughdiamondsource = $resroughdiamondsource[0];
                                            $roughdiamondsourceid = $rowroughdiamondsource['id'];
                                        } else {
                                            $roughdiamondsourceid = $IISMethods->generateuuid();

                                            $insqryroughdiamondsource['id'] = $roughdiamondsourceid;
                                            $insqryroughdiamondsource['name'] = $roughdiamondsource;
                                            $insqryroughdiamondsource['isactive'] = 1;
                                            $insqryroughdiamondsource['displayorder'] = 1;
                                            $insqryroughdiamondsource['timestamp'] = $datetime;
                                            $insqryroughdiamondsource['entry_uid'] = $uid;
                                            $insqryroughdiamondsource['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblroughdiamondsourcemaster', $insqryroughdiamondsource, '');
                                        }
                                    }
                                    $gridleconditionid = '';
                                    if ($gridlecondition) {
                                        $qrygridlecondition = "SELECT id FROM tblgirdleconditionmaster WHERE name=:gridlecondition";
                                        $paramgridlecondition = array(':gridlecondition' => $gridlecondition);
                                        $resgridlecondition = $DB->getmenual($qrygridlecondition, $paramgridlecondition);
                                        if (sizeof($resgridlecondition) > 0) {
                                            $rowgridlecondition = $resgridlecondition[0];
                                            $gridleconditionid = $rowgridlecondition['id'];
                                        } else {
                                            $maxdoqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblgirdleconditionmaster";
                                            $maxdoparams = array();
                                            $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                            $maxdorow = $maxdores[0];
                                            $maxdo = $maxdorow['maxdo'] + 1;
                                            $gridleconditionid = $IISMethods->generateuuid();

                                            $insqrygridlecondition['id'] = $gridleconditionid;
                                            $insqrygridlecondition['name'] = $gridlecondition;
                                            $insqrygridlecondition['isactive'] = 1;
                                            $insqrygridlecondition['displayorder'] = $maxdo;
                                            $insqrygridlecondition['timestamp'] = $datetime;
                                            $insqrygridlecondition['entry_uid'] = $uid;
                                            $insqrygridlecondition['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgirdleconditionmaster', $insqrygridlecondition, '');
                                        }
                                    }



                                    // print_r($treatment);
                                    $flttreatmentname = implode("','", explode(",", $treatment));
                                    $fltkeytosymbolsname = implode("','", explode(",", $keytosymbols));
                                    $fltovertonename = implode("','", explode(",", $overtone));
                                    $fltopeninclusionsname = implode("','", explode(",", $openinclusions));
                                    $fltblackinclusionsname = implode("','", explode(",", $blackinclusions));
                                    $fltwhiteinclusionsname = implode("','", explode(",", $whiteinclusions));
                                    if ($i == 1) {
                                        $qrydiamond = "SELECT id FROM tbldiamond WHERE personid=:personid";
                                        $paramdiamond = array(':personid' => $uid);
                                        $resdiamond = $DB->getmenual($qrydiamond, $paramdiamond);
                                        if (sizeof($resdiamond) > 0) {
                                            for ($dm = 0; $dm < sizeof($resdiamond); $dm++) {
                                                $rowdm = $resdiamond[$dm];
                                                $diamondid = $rowdm['id'];

                                                $params = array(
                                                    'id' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamond', '', $params);
                                                $DB->userwisediamonjewelrylog(1, $uid);

                                                $keytosymbolparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                                                $overtoneparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                                                $openinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                                                $blackinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                                                $whiteinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);
                                            }
                                        }
                                    }


                                    // QUERY GET DATA
                                    $qrydata = "SELECT
                                    IFNULL((SELECT name FROM tblavailabilitymaster WHERE id=:availabilityid),'') AS availability,
                                    IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS country,
                                    IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS state,
                                    IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shape,
                                    IFNULL((SELECT name FROM tblsizemaster WHERE id=:sizeid),'') AS size,
                                    IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:diamondcolorid),'') AS diamondcolor,
                                    IFNULL((SELECT name FROM tblclaritymaster WHERE id=:clarityid),'') AS clarity,
                                    IFNULL((SELECT name FROM tblcutmaster WHERE id=:cutid),'') AS cut,
                                    IFNULL((SELECT name FROM tblpolishmaster WHERE id=:polishid),'') AS polish,
                                    IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:symmetryid),'') AS symmetry,
                                    IFNULL((SELECT name FROM tblintensitymaster WHERE id=:intensityid),'') AS intensity,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:colorid),'') AS color,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:colorcodeid),'') AS colorcode,
                                    IFNULL((SELECT name FROM tblgirdleconditionmaster WHERE id=:conditionid),'') AS conditions,
                                    IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridleminid),'') AS gridlemin,
                                    IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridlemaxid),'') AS gridlemax,
                                    IFNULL((SELECT name FROM tblculetcondition WHERE id=:culetconditionid),'') AS culetcondition,
                                    IFNULL((SELECT name FROM tblsizemaster WHERE id=:culetsizeid),'') AS culetsize,
                                    IFNULL((SELECT group_concat(id) FROM tbltreatmentmaster WHERE name IN ('" . $flttreatmentname . "')),'') AS treatment,
                                    IFNULL((SELECT name FROM tbllabmaster WHERE id=:labid),'') AS lab,
                                    IFNULL((SELECT group_concat(id) FROM tblkeytosymbolmaster WHERE name IN ('" . $fltkeytosymbolsname . "')),'') AS keytosymbol,
                                    IFNULL((SELECT name FROM tblfancyintensitymaster WHERE id=:fancyintensityid),'') AS fancyintensity,
                                    IFNULL((SELECT group_concat(id) FROM tblovertonemaster WHERE name IN ('" . $fltovertonename . "')),'') AS overtone,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid1),'') AS fancycolor1,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid1),'') AS fancycolorcode1,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid2),'') AS fancycolor2,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid2),'') AS fancycolorcode2,
                                    IFNULL((SELECT name FROM tbltradeshowmaster WHERE id=:tradeshowid),'') AS tradeshow,
                                    IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,
                                    IFNULL((SELECT name FROM tblshademaster WHERE id=:shadeid),'') AS shade,
                                    IFNULL((SELECT name FROM tbleyecleanmaster WHERE id=:eyecleanid),'') AS eyeclean,
                                    IFNULL((SELECT name FROM tblmilkymaster WHERE id=:milkyid),'') AS milky,
                                    IFNULL((SELECT group_concat(id) FROM tblopeninclusionmaster WHERE name IN ('" . $fltopeninclusionsname . "')),'') AS openinclusions,
                                    IFNULL((SELECT group_concat(id) FROM tblblackinclusionmaster WHERE name IN ('" . $fltblackinclusionsname . "')),'') AS blackinclusions,
                                    IFNULL((SELECT group_concat(id) FROM tblwhiteinclusionmaster WHERE name IN ('" . $fltwhiteinclusionsname . "')),'') AS whiteinclusions,
                                    IFNULL((SELECT name FROM tblroughdiamondsourcemaster WHERE id=:roughdiamondsourceid),'') AS roughdiamondsource,
                                    IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,
                                    IFNULL((SELECT name FROM tblsievemaster WHERE id=:sieveid),'') AS sievename";
                                    $paramdata = array(
                                        ':availabilityid' => $availabilityid,
                                        ':countryid' => $countryid,
                                        ':stateid' => $stateid,
                                        ':shapeid' => $shapeid,
                                        ':sizeid' => $sizeid,
                                        ':diamondcolorid' => $colorid,
                                        ':clarityid' => $clarityid,
                                        ':cutid' => $cutid,
                                        ':polishid' => $polishid,
                                        ':symmetryid' => $symmetryid,
                                        ':intensityid' => $intensityid,
                                        ':colorid' => $fluorescenecolorid,
                                        ':colorcodeid' => $fluorescenecolorid,
                                        ':conditionid' => $gridleconditionid,
                                        ':gridleminid' => $gridleminid,
                                        ':gridlemaxid' => $gridlemaxid,
                                        ':culetconditionid' => $culetconditionid,
                                        ':culetsizeid' => $culetsizeid,
                                        ':labid' => $labid,
                                        ':fancyintensityid' => $fancyintensityid,
                                        ':fancycolorid1' => $fancycolorid1,
                                        ':fancycolorcodeid1' => $fancycolorid1,
                                        ':fancycolorid2' => $fancycolorid2,
                                        ':fancycolorcodeid2' => $fancycolorid2,
                                        ':tradeshowid' => $tradeshowid,
                                        ':brandid' => $brandid,
                                        ':shadeid' => $shadeid,
                                        ':eyecleanid' => $eyecleanid,
                                        ':milkyid' => $milkyid,
                                        ':roughdiamondsourceid' => $roughdiamondsourceid,
                                        ':personid' => $uid,
                                        ':sieveid' => $sieveid,
                                    );
                                    //  print_r($paramdata);

                                    $resdata = $DB->getmenual($qrydata, $paramdata);
                                    $rowdata = $resdata[0];
                                    //  print_r($rowdata);

                                    $insqry = array(
                                        'personid' => $uid,
                                        'personname' => $rowdata['personname'],
                                        'stock' => $stock,
                                        'price' => $price,
                                        'ispricectsavani' => $ispricectsavani,
                                        'availabilityid' => $availabilityid,
                                        'availability' => $rowdata['availability'],
                                        'countryid' => $countryid,
                                        'country' => $rowdata['country'],
                                        'stateid' => $stateid,
                                        'state' => $rowdata['state'],
                                        'city' => $city,
                                        'shapeid' => $shapeid,
                                        'shape' => $rowdata['shape'],
                                        'sizeid' => $sizeid,
                                        'size' => $rowdata['size'],
                                        'colorid' => $colorid,
                                        'color' => $rowdata['diamondcolor'],
                                        'clarityid' => $clarityid,
                                        'clarity' => $rowdata['clarity'],
                                        'cutid' => $cutid,
                                        'cut' => $rowdata['cut'],
                                        'polishid' => $polishid,
                                        'polish' => $rowdata['polish'],
                                        'symmetryid' => $symmetryid,
                                        'symmetry' => $rowdata['symmetry'],
                                        'intensityid' => $intensityid,
                                        'intensity' => $rowdata['intensity'],
                                        'fluorescenecolorid' => $fluorescenecolorid,
                                        'fluorescenecolor' => $rowdata['color'],
                                        'fluorescenecolorcode' => $rowdata['colorcode'],
                                        'length' => $length,
                                        'width' => $width,
                                        'depth' => $depth,
                                        'depthper' => $depthper,
                                        'tableper' => $tableper,
                                        'crownangle' => $crownangle,
                                        'crownheight' => $crownheight,
                                        'pavilionangle' => $pavilionangle,
                                        'pavilionheight' => $pavilionheight,
                                        'gridleconditionid' => $gridleconditionid,
                                        'gridlecondition' => $rowdata['conditions'],
                                        'gridleminid' => $gridleminid,
                                        'gridlemin' => $rowdata['gridlemin'],
                                        'gridlemaxid' => $gridlemaxid,
                                        'gridlemax' => $rowdata['gridlemax'],
                                        'gridleper' => $gridleper,
                                        'culetconditionid' => $culetconditionid,
                                        'culetcondition' => $rowdata['culetcondition'],
                                        'culetsizeid' => $culetsizeid,
                                        'culetsize' => $rowdata['culetsize'],
                                        'treatmentid' => $rowdata['treatment'],
                                        'treatment' => $treatment,
                                        'laserinscription' => $laserinscription,
                                        'starlength' => $starlength,
                                        'labid' => $labid,
                                        'lab' => $rowdata['lab'],
                                        'reportnumber' => $reportnumber,
                                        'showonsavanigems' => $showonsavanigems,
                                        'reportdate' => $reportdate,
                                        'lablocation' => $lablocation,
                                        'reportcomment' => $reportcomment,
                                        'keytosymbolsid' => $rowdata['keytosymbol'],
                                        'keytosymbols' => $keytosymbols,
                                        'fancyintensityid' => $fancyintensityid,
                                        'fancyintensity' => $rowdata['fancyintensity'],
                                        'overtoneid' => $rowdata['overtone'],
                                        'overtone' => $overtone,
                                        'fancycolorid1' => $fancycolorid1,
                                        'fancycolor1' => $rowdata['fancycolor1'],
                                        'fancycolorcode1' => $rowdata['fancycolorcode1'],
                                        'fancycolorid2' => $fancycolorid2,
                                        'fancycolor2' => $rowdata['fancycolor2'],
                                        'fancycolorcode2' => $rowdata['fancycolorcode2'],
                                        'matchedpair' => $matchedpair,
                                        'stocknumber' => $stocknumber,
                                        'ispairseparable' => $ispairseparable,
                                        'isdownload' => $isdownload,
                                        'tradeshowid' => $tradeshowid,
                                        'tradeshow' => $rowdata['tradeshow'],
                                        'brandid' => $brandid,
                                        'brand' => $rowdata['brand'],
                                        'suppliercomment' => $suppliercomment,
                                        'isparcel' => $isparcel,
                                        'numofdiamond' => $numofdiamond,
                                        'sarineloupe' => $sarineloupe,
                                        'sellerspecification' => $sellerspecification,
                                        'shadeid' => $shadeid,
                                        'shade' => $rowdata['shade'],
                                        'eyecleanid' => $eyecleanid,
                                        'eyeclean' => $rowdata['eyeclean'],
                                        'milkyid' => $milkyid,
                                        'milky' => $rowdata['milky'],
                                        'openinclusionsid' => $rowdata['openinclusions'],
                                        'openinclusions' => $openinclusions,
                                        'blackinclusionsid' => $rowdata['blackinclusions'],
                                        'blackinclusions' => $blackinclusions,
                                        'whiteinclusionsid' => $rowdata['whiteinclusions'],
                                        'whiteinclusions' => $whiteinclusions,
                                        'roughdiamondsourceid' => $roughdiamondsourceid,
                                        'roughdiamondsource' => $rowdata['roughdiamondsource'],
                                        'videolink' => $videolink,
                                        'sieveid' => $sieveid,
                                        'sievename' => $rowdata['sievename'],
                                        'piecepercarat' => $piecepercarat,
                                        'savanipercentage' => $savanipercentage,
                                        'iscsvupload' => 1
                                    );

                                    $typename = 'diamond';
                                    $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";
                                    $seriesparams = array(
                                        ':typename' => $typename,
                                    );
                                    $result_ary = $DB->getmenual($qryseries, $seriesparams);
                                    $rowseries = $result_ary[0];

                                    $seriesid = $rowseries['id'];
                                    $seriesno = $DB->getorderno($seriesid, 'diamond', $currdate);
                                    $maxid = $DB->getmaxid($seriesid, 'diamond');

                                    if ($seriesid) {
                                        try {
                                            $DB->begintransaction();


                                            $diamondid = $IISMethods->generateuuid();

                                            $containreportfileorlink = 0;
                                            if ($reportfilelink) {
                                                $containreportfileorlink = 2;
                                            }

                                            $containdiamondimgorlink = 0;
                                            if ($diamondimglink) {
                                                $containdiamondimgorlink = 2;
                                            }



                                            $insqry['id'] = $diamondid;
                                            $insqry['savanilotnumber'] = $seriesno;
                                            $insqry['diamondimglink'] = $diamondimglink;
                                            $insqry['containdiamondimgorlink'] = $containdiamondimgorlink;
                                            $insqry['containreportfileorlink'] = $containreportfileorlink;
                                            $insqry['reportfilelink'] = $reportfilelink;
                                            $insqry['isactive'] = 1;
                                            $insqry['maxid'] = $maxid;
                                            $insqry['seriesid'] = $seriesid;
                                            $insqry['timestamp'] = $datetime;
                                            $insqry['entry_uid'] = $uid;
                                            $insqry['entry_date'] = $datetime;

                                            // print_r($insqry);exit;
                                            $DB->executedata('i', 'tbldiamond', $insqry, '');

                                            $DB->userwisediamonjewelrylog(1, $uid);


                                            if (sizeof($flttreatment) > 0) {
                                                for ($t = 0; $t < sizeof($flttreatment); $t++) {
                                                    $qrytreatment = "SELECT id from tbltreatmentmaster where name=:id";
                                                    $parmstreatment = array(
                                                        ':id' => $flttreatment[$t],
                                                    );
                                                    $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);
                                                    $mtreatmentid = $IISMethods->generateuuid();
                                                    $inspertreatment = array(
                                                        'id' => $mtreatmentid,
                                                        'diamondid' => $diamondid,
                                                        'treatmentid' => $result_treatment[0]['id'],
                                                        'treatment' => $flttreatment[$t],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondtreatment', $inspertreatment, '');
                                                }
                                            }
                                            if (sizeof($fltkeytosymbols) > 0) {
                                                for ($k = 0; $k < sizeof($fltkeytosymbols); $k++) {
                                                    $qrykeytosymbol = "SELECT id from tblkeytosymbolmaster where name=:id";
                                                    $parmskeytosymbol = array(
                                                        ':id' => $fltkeytosymbols[$k],
                                                    );
                                                    $result_keytosymbol = $DB->getmenual($qrykeytosymbol, $parmskeytosymbol);
                                                    $mkeytosymbolsid = $IISMethods->generateuuid();
                                                    $insperkeytosymbol = array(
                                                        'id' => $mkeytosymbolsid,
                                                        'diamondid' => $diamondid,
                                                        'keytosymbolsid' => $result_keytosymbol[0]['id'],
                                                        'keytosymbols' => $fltkeytosymbols[$k],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondkeytosymbol', $insperkeytosymbol, '');
                                                }
                                            }
                                            if (sizeof($fltovertone) > 0) {
                                                for ($o = 0; $o < sizeof($fltovertone); $o++) {
                                                    $qryovertone = "SELECT id from tblovertonemaster where name=:id";
                                                    $parmsovertone = array(
                                                        ':id' => $fltovertone[$o],
                                                    );
                                                    $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                                    $movertoneid = $IISMethods->generateuuid();
                                                    $insperovertone = array(
                                                        'id' => $movertoneid,
                                                        'diamondid' => $diamondid,
                                                        'overtoneid' => $result_overtone[0]['id'],
                                                        'overtone' => $fltovertone[$o],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondovertone', $insperovertone, '');
                                                }
                                            }

                                            if (sizeof($fltopeninclusions) > 0) {
                                                for ($op = 0; $op < sizeof($fltopeninclusions); $op++) {
                                                    $qryopeninclusion = "SELECT id from tblopeninclusionmaster where name=:id";
                                                    $parmsopeninclusion = array(
                                                        ':id' => $fltopeninclusions[$op],
                                                    );
                                                    $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                                    $mopeninclusionsid = $IISMethods->generateuuid();
                                                    $insperopeninclusion = array(
                                                        'id' => $mopeninclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'openinclusionsid' => $result_openinclusion[0]['id'],
                                                        'openinclusions' => $fltopeninclusions[$op],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondopeninclusions', $insperopeninclusion, '');
                                                }
                                            }

                                            if (sizeof($fltblackinclusions) > 0) {
                                                for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                                    $qryblackinclusion = "SELECT id from tblblackinclusionmaster where name=:id";
                                                    $parmsblackinclusion = array(
                                                        ':id' => $fltblackinclusions[$bi],
                                                    );
                                                    $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                                    $mblackinclusionsid = $IISMethods->generateuuid();
                                                    $insperblackinclusion = array(
                                                        'id' => $mblackinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'blackinclusionsid' => $result_blackinclusion[0]['id'],
                                                        'blackinclusions' => $fltblackinclusions[$bi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondblackinclusions', $insperblackinclusion, '');
                                                }
                                            }

                                            if (sizeof($fltwhiteinclusions) > 0) {
                                                for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                                    $qrywhiteinclusion = "SELECT id from tblwhiteinclusionmaster where name=:id";
                                                    $parmswhiteinclusion = array(
                                                        ':id' => $fltwhiteinclusions[$wi],
                                                    );
                                                    $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                                    $mwhiteinclusionsid = $IISMethods->generateuuid();
                                                    $insperwhiteinclusion = array(
                                                        'id' => $mwhiteinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'whiteinclusionsid' => $result_whiteinclusion[0]['id'],
                                                        'whiteinclusions' => $fltwhiteinclusions[$wi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondwhiteinclusions', $insperwhiteinclusion, '');
                                                }
                                            }

                                            $cnt_ins++;
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
                                } else {
                                    $response['errordata'][$j]['no'] = $IISMethods->sanitize($i + 1);
                                    $response['errordata'][$j]['stock'] = $IISMethods->sanitize($stock);
                                    $response['errordata'][$j]['price'] = $IISMethods->sanitize($price);
                                    $response['errordata'][$j]['shape'] = $IISMethods->sanitize($shape);
                                    $response['errordata'][$j]['size'] = $IISMethods->sanitize($size);
                                    $response['errordata'][$j]['color'] = $IISMethods->sanitize($color);
                                    $response['errordata'][$j]['clarity'] = $IISMethods->sanitize($clarity);
                                    $cnt_err++;

                                    $j++;
                                }
                            }
                            $i++;
                        }

                        // $response['cnt_upddata']=(int)$cnt_upd;
                        $response['cnt_insdata'] = (int)$cnt_ins;
                        $response['cnt_errordata'] = (int)$cnt_err;

                        $status = 1;
                        $message = $errmsg['diamondinsert'];
                    } else {
                        $status = 0;
                        $message = $errmsg['filesel'];
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'uploaddiamondcsv_last') {
                $filename = $_FILES['csvfile']['tmp_name'];
                if ($CanListDiamondXL == 1) {
                    if ($_FILES["csvfile"]["size"] > 0) {
                        $file = fopen($filename, "r");
                        $i = 0;
                        $j = 0;
                        $cnt_ins = 0;
                        $cnt_upd = 0;
                        $cnt_err = 0;
                        while (($itemData = fgetcsv($file, 10000, ",")) !== FALSE) {
                            if ($i > 0) {

                                $stock = trim($itemData[0]); // Stock # 
                                $availability = trim($itemData[1]); // Availability
                                $shape = trim($itemData[2]); // Shape
                                $size = trim($itemData[3]); // Weight
                                $color = trim($itemData[4]); // Color
                                $clarity = trim($itemData[5]); // Clarity
                                $cut = trim($itemData[6]); // Cut Grade
                                $polish = trim($itemData[7]); // Polish
                                $symmetry = trim($itemData[8]); // Symmetry
                                $intensity = trim($itemData[9]); // Fluorescence Intensity
                                $fluorescenecolor = trim($itemData[10]); // Fluorescence Color

                                $Measurements = trim($itemData[11]); // Measurements
                                $rep_sp_char1 = str_replace("-", "|", $Measurements);
                                $rep_sp_char2 = str_replace("x", "|", $rep_sp_char1);
                                $rep_sp_char3 = str_replace("X", "|", $rep_sp_char2);
                                $expMeasurements = explode('|', $rep_sp_char3);
                                $length = trim($expMeasurements[0]);
                                $width = trim($expMeasurements[1]);
                                $depth = trim($expMeasurements[2]);

                                $BGM = trim($itemData[12]); // BGM
                                $eyeclean = trim($itemData[13]); // Eye Clean
                                $lab = trim($itemData[14]); // Lab
                                $reportnumber = trim($itemData[15]); // Report #
                                $treatment = trim($itemData[16]); // Treatment - Multiple
                                $price = trim($itemData[17]); // Price Per Ct
                                $totalprice = trim($itemData[18]); // Total Price
                                $savanipercentage = trim($itemData[19]); // Discount %
                                $totalpriceafterdiscount = trim($itemData[20]); // Toatal Price After Discount

                                $depthper = trim($itemData[21]); // Depth %
                                $tableper = trim($itemData[22]); // Table %
                                $gridlemin = trim($itemData[23]);   // Girdle Thin
                                $gridlemax = trim($itemData[24]);   // Girdle Thick
                                $gridleper = trim($itemData[25]);   // Girdle %
                                $gridlecondition = trim($itemData[26]); // Girdle Condition
                                $culetsize = trim($itemData[27]);   // Culet Size
                                $culetcondition = trim($itemData[28]); // Culet Condition
                                $crownheight = trim($itemData[29]); // Crown Height
                                $crownangle = trim($itemData[30]); // Crown Angle
                                $pavilionheight = trim($itemData[31]); // Pavilion Depth
                                $pavilionangle = trim($itemData[32]);   // Pavilion Angle
                                $laserinscription = trim($itemData[33]); // Laser Inscription
                                $reportcomment = trim($itemData[34]);   // Cert comment
                                $keytosymbols = trim($itemData[35]);  //Key to symbols - Multiple
                                $suppliercomment = trim($itemData[36]); // Member Comment
                                $starlength = trim($itemData[37]); // Star Length 
                                $shade = trim($itemData[38]); // Shade
                                $whiteinclusions = trim($itemData[39]);  //White Inclusion -  Multiple
                                $blackinclusions = trim($itemData[40]);  //Black Inclusion - Multiple
                                $openinclusions = trim($itemData[41]);    //Open Inclusion - Multiple
                                $milky = trim($itemData[42]); //Milky
                                $fancycolor1 = trim($itemData[43]); //Fancy Color
                                $fancyintensity = trim($itemData[44]); //Fancy Color Intensity
                                $overtone = trim($itemData[45]); //Fancy Color Overtone - Multiple
                                $country = trim($itemData[46]); //Country
                                $state = trim($itemData[47]); //State
                                $city = trim($itemData[48]); //City
                                $brand = trim($itemData[49]); //Brand
                                $sellerspecification = trim($itemData[50]); //Seller Spec
                                $reportfilelink = trim($itemData[51]); //Report Filename
                                $diamondimglink = trim($itemData[52]); //Diamond Image
                                $videolink = trim($itemData[53]); //Video Link
                                $sarineloupe = trim($itemData[54]);  //Sarine Loupe
                                $tradeshow = trim($itemData[55]); //Trade Show
                                $reportdate = trim($itemData[56]); //Report Issue Date
                                $report_type = trim($itemData[57]); //Report Type
                                $lablocation = trim($itemData[58]); //Lab Location
                                $stocknumber = trim($itemData[59]); //Pair Stock #
                                $ispairseparable = trim($itemData[60]); // Is Matched Pair Separable
                                $isparcel = trim($itemData[61]); // Parcel Stones

                                $ispricectsavani = trim($itemData[61]);
                                $showonsavanigems = trim($itemData[62]);
                                $fancycolor2 = trim($itemData[63]);
                                $matchedpair = trim($itemData[64]);
                                $isdownload = trim($itemData[65]);
                                $numofdiamond = trim($itemData[66]);
                                $roughdiamondsource = trim($itemData[67]);
                                $sieve = trim($itemData[68]);
                                $piecepercarat = trim($itemData[69]);


                                $datetime = $IISMethods->getdatetime();



                                $flttreatment = explode(',', $treatment);
                                $fltkeytosymbols = explode(',', $keytosymbols);
                                $fltovertone = explode(',', $overtone);
                                $fltopeninclusions = explode(',', $openinclusions);
                                $fltblackinclusions = explode(',', $blackinclusions);
                                $fltwhiteinclusions = explode(',', $whiteinclusions);

                                // echo $stock.'--'.$price.'--'.$shape.'--'.$size.'--'.$color.'--'.$clarity;exit;
                                if ($stock && $price && $shape && $size && $color && $clarity) {

                                    $availabilityid = '';
                                    if ($availability) // Availability
                                    {
                                        $qryavailability = "SELECT id FROM tblavailabilitymaster WHERE name=:availability";
                                        $paramavailability = array(':availability' => $availability);
                                        $resavailability = $DB->getmenual($qryavailability, $paramavailability);
                                        if (sizeof($resavailability) > 0) {
                                            $rowavailability = $resavailability[0];
                                            $availabilityid = $rowavailability['id'];
                                        } else {
                                            $availabilityid = $IISMethods->generateuuid();

                                            $insqryavailability['id'] = $availabilityid;
                                            $insqryavailability['name'] = $availability;
                                            $insqryavailability['isactive'] = 1;
                                            $insqryavailability['timestamp'] = $datetime;
                                            $insqryavailability['entry_uid'] = $uid;
                                            $insqryavailability['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblavailabilitymaster', $insqryavailability, '');
                                        }
                                    }

                                    $countryid = '';
                                    if ($country) // Country
                                    {
                                        $qrycountry = "SELECT id FROM tblcountrymaster WHERE country=:country";
                                        $paramcountry = array(':country' => $country);
                                        $rescountry = $DB->getmenual($qrycountry, $paramcountry);
                                        if (sizeof($rescountry) > 0) {
                                            $rowcountry = $rescountry[0];
                                            $countryid = $rowcountry['id'];
                                        } else {
                                            $countryid = $IISMethods->generateuuid();

                                            $insqrycountry['id'] = $countryid;
                                            $insqrycountry['country'] = $country;
                                            $insqrycountry['timestamp'] = $datetime;
                                            $insqrycountry['entry_uid'] = $uid;
                                            $insqrycountry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcountrymaster', $insqrycountry, '');
                                        }
                                    }

                                    $stateid = '';
                                    if ($state) // State
                                    {
                                        $qrystate = "SELECT id FROM tblstatemaster WHERE state=:state";
                                        $paramstate = array(':state' => $state);
                                        $resstate = $DB->getmenual($qrystate, $paramstate);
                                        if (sizeof($resstate) > 0) {
                                            $rowstate = $resstate[0];
                                            $stateid = $rowstate['id'];
                                        } else {
                                            $stateid = $IISMethods->generateuuid();

                                            $insqrystate['id'] = $stateid;
                                            $insqrystate['countryid'] = $countryid;
                                            $insqrystate['state'] = $state;
                                            $insqrystate['timestamp'] = $datetime;
                                            $insqrystate['entry_uid'] = $uid;
                                            $insqrystate['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblstatemaster', $insqrystate, '');
                                        }
                                    }
                                    $shapeid = '';
                                    if ($shape) // Shape
                                    {
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
                                            $insqryshape['timestamp'] = $datetime;
                                            $insqryshape['entry_uid'] = $uid;
                                            $insqryshape['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamondshapemaster', $insqryshape, '');
                                        }
                                    }

                                    $sizeid = '';
                                    if ($size) // Size
                                    {
                                        $qrysize = "SELECT id FROM tblsizemaster WHERE name=:size";
                                        $paramsize = array(':size' => $size);
                                        $ressize = $DB->getmenual($qrysize, $paramsize);
                                        if (sizeof($ressize) > 0) {
                                            $rowsize = $ressize[0];
                                            $sizeid = $rowsize['id'];
                                        } else {
                                            $sizeid = $IISMethods->generateuuid();

                                            $insqrysize['id'] = $sizeid;
                                            $insqrysize['name'] = $size;
                                            $insqrysize['timestamp'] = $datetime;
                                            $insqrysize['isactive'] = 1;
                                            $insqrysize['entry_uid'] = $uid;
                                            $insqrysize['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsizemaster', $insqrysize, '');
                                        }
                                    }
                                    $colorid = '';
                                    if ($color) {
                                        $qrycolor = "SELECT id FROM tbldiamondcolormaster WHERE name=:color";
                                        $paramcolor = array(':color' => $color);
                                        $rescolor = $DB->getmenual($qrycolor, $paramcolor);
                                        if (sizeof($rescolor) > 0) {
                                            $rowcolor = $rescolor[0];
                                            $colorid = $rowcolor['id'];
                                        } else {
                                            $colorid = $IISMethods->generateuuid();

                                            $insqrycolor['id'] = $colorid;
                                            $insqrycolor['name'] = $color;
                                            $insqrycolor['isactive'] = 1;
                                            $insqrycolor['timestamp'] = $datetime;
                                            $insqrycolor['entry_uid'] = $uid;
                                            $insqrycolor['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbldiamondcolormaster', $insqrycolor, '');
                                        }
                                    }

                                    $clarityid = '';
                                    if ($clarity) {
                                        $qryclarity = "SELECT id FROM tblclaritymaster WHERE name=:clarity";
                                        $paramclarity = array(':clarity' => $clarity);
                                        $resclarity = $DB->getmenual($qryclarity, $paramclarity);
                                        if (sizeof($resclarity) > 0) {
                                            $rowclarity = $resclarity[0];
                                            $clarityid = $rowclarity['id'];
                                        } else {
                                            $clarityid = $IISMethods->generateuuid();

                                            $insqryclarity['id'] = $clarityid;
                                            $insqryclarity['name'] = $clarity;
                                            $insqryclarity['isactive'] = 1;
                                            $insqryclarity['timestamp'] = $datetime;
                                            $insqryclarity['entry_uid'] = $uid;
                                            $insqryclarity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblclaritymaster', $insqryclarity, '');
                                        }
                                    }

                                    $cutid = '';
                                    if ($cut) {
                                        $qrycut = "SELECT id FROM tblcutmaster WHERE name=:cut";
                                        $paramcut = array(':cut' => $cut);
                                        $rescut = $DB->getmenual($qrycut, $paramcut);
                                        if (sizeof($rescut) > 0) {
                                            $rowcut = $rescut[0];
                                            $cutid = $rowcut['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblcutmaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $cutid = $IISMethods->generateuuid();

                                            $insqrycut['id'] = $cutid;
                                            $insqrycut['name'] = $cut;
                                            $insqrycut['isactive'] = 1;
                                            $insqrycut['displayorder'] = $maxdo;
                                            $insqrycut['timestamp'] = $datetime;
                                            $insqrycut['entry_uid'] = $uid;
                                            $insqrycut['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcutmaster', $insqrycut, '');
                                        }
                                    }

                                    $polishid = '';
                                    if ($polish) {
                                        $qrypolish = "SELECT id FROM tblpolishmaster WHERE name=:polish";
                                        $parampolish = array(':polish' => $polish);
                                        $respolish = $DB->getmenual($qrypolish, $parampolish);
                                        if (sizeof($respolish) > 0) {
                                            $rowpolish = $respolish[0];
                                            $polishid = $rowpolish['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblpolishmaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;

                                            $polishid = $IISMethods->generateuuid();

                                            $insqrypolish['id'] = $polishid;
                                            $insqrypolish['name'] = $polish;
                                            $insqrypolish['isactive'] = 1;
                                            $insqrypolish['displayorder'] = $maxdo;
                                            $insqrypolish['timestamp'] = $datetime;
                                            $insqrypolish['entry_uid'] = $uid;
                                            $insqrypolish['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblpolishmaster', $insqrypolish, '');
                                        }
                                    }

                                    $symmetryid = '';
                                    if ($symmetry) {
                                        $qrysymmetry = "SELECT id FROM tblsymmetrymaster WHERE name=:symmetry";
                                        $paramsymmetry = array(':symmetry' => $symmetry);
                                        $ressymmetry = $DB->getmenual($qrysymmetry, $paramsymmetry);
                                        if (sizeof($ressymmetry) > 0) {
                                            $rowsymmetry = $ressymmetry[0];
                                            $symmetryid = $rowsymmetry['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblsymmetrymaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $symmetryid = $IISMethods->generateuuid();

                                            $insqrysymmetry['id'] = $symmetryid;
                                            $insqrysymmetry['name'] = $symmetry;
                                            $insqrysymmetry['isactive'] = 1;
                                            $insqrysymmetry['displayorder'] = $maxdo;
                                            $insqrysymmetry['timestamp'] = $datetime;
                                            $insqrysymmetry['entry_uid'] = $uid;
                                            $insqrysymmetry['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsymmetrymaster', $insqrysymmetry, '');
                                        }
                                    }

                                    $intensityid = '';
                                    if ($intensity) {
                                        $qryintensity = "SELECT id FROM tblintensitymaster WHERE name=:intensity";
                                        $paramintensity = array(':intensity' => $intensity);
                                        $resintensity = $DB->getmenual($qryintensity, $paramintensity);
                                        if (sizeof($resintensity) > 0) {
                                            $rowintensity = $resintensity[0];
                                            $intensityid = $rowintensity['id'];
                                        } else {
                                            $intensityid = $IISMethods->generateuuid();

                                            $insqryintensity['id'] = $intensityid;
                                            $insqryintensity['name'] = $intensity;
                                            $insqryintensity['isactive'] = 1;
                                            $insqryintensity['timestamp'] = $datetime;
                                            $insqryintensity['entry_uid'] = $uid;
                                            $insqryintensity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblintensitymaster', $insqryintensity, '');
                                        }
                                    }

                                    $fluorescenecolorid = '';
                                    if ($fluorescenecolor) {
                                        $qryfluorescenecolor = "SELECT id FROM tblcolormaster WHERE name=:fluorescenecolor";
                                        $paramfluorescenecolor = array(':fluorescenecolor' => $fluorescenecolor);
                                        $resfluorescenecolor = $DB->getmenual($qryfluorescenecolor, $paramfluorescenecolor);
                                        if (sizeof($resfluorescenecolor) > 0) {
                                            $rowfluorescenecolor = $resfluorescenecolor[0];
                                            $fluorescenecolorid = $rowfluorescenecolor['id'];
                                        } else {
                                            $fluorescenecolorid = $IISMethods->generateuuid();

                                            $insqryfluorescenecolor['id'] = $fluorescenecolorid;
                                            $insqryfluorescenecolor['name'] = $fluorescenecolor;
                                            $insqryfluorescenecolor['colorcode'] = $fluorescenecolor;
                                            $insqryfluorescenecolor['isactive'] = 1;
                                            $insqryfluorescenecolor['timestamp'] = $datetime;
                                            $insqryfluorescenecolor['entry_uid'] = $uid;
                                            $insqryfluorescenecolor['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfluorescenecolor, '');
                                        }
                                    }

                                    $gridleminid = '';
                                    if ($gridlemin) {
                                        $qrygridlemin = "SELECT id FROM tblgridlemaster WHERE name=:gridlemin";
                                        $paramgridlemin = array(':gridlemin' => $gridlemin);
                                        $resgridlemin = $DB->getmenual($qrygridlemin, $paramgridlemin);
                                        if (sizeof($resgridlemin) > 0) {
                                            $rowgridlemin = $resgridlemin[0];
                                            $gridleminid = $rowgridlemin['id'];
                                        } else {
                                            $gridleminid = $IISMethods->generateuuid();

                                            $insqrygridlemin['id'] = $gridleminid;
                                            $insqrygridlemin['name'] = $gridlemin;
                                            $insqrygridlemin['isactive'] = 1;
                                            $insqrygridlemin['timestamp'] = $datetime;
                                            $insqrygridlemin['entry_uid'] = $uid;
                                            $insqrygridlemin['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgridlemaster', $insqrygridlemin, '');
                                        }
                                    }
                                    $gridlemaxid = '';
                                    if ($gridlemax) {
                                        $qrygridlemax = "SELECT id FROM tblgridlemaster WHERE name=:gridlemax";
                                        $paramgridlemax = array(':gridlemax' => $gridlemax);
                                        $resgridlemax = $DB->getmenual($qrygridlemax, $paramgridlemax);
                                        if (sizeof($resgridlemax) > 0) {
                                            $rowgridlemax = $resgridlemax[0];
                                            $gridlemaxid = $rowgridlemax['id'];
                                        } else {
                                            $gridlemaxid = $IISMethods->generateuuid();

                                            $insqrygridlemax['id'] = $gridlemaxid;
                                            $insqrygridlemax['name'] = $gridlemax;
                                            $insqrygridlemax['isactive'] = 1;
                                            $insqrygridlemax['timestamp'] = $datetime;
                                            $insqrygridlemax['entry_uid'] = $uid;
                                            $insqrygridlemax['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgridlemaster', $insqrygridlemax, '');
                                        }
                                    }

                                    $culetconditionid = '';
                                    if ($culetcondition) {
                                        $qryculetcondition = "SELECT id FROM tblculetcondition WHERE name=:culetcondition";
                                        $paramculetcondition = array(':culetcondition' => $culetcondition);
                                        $resculetcondition = $DB->getmenual($qryculetcondition, $paramculetcondition);
                                        if (sizeof($resculetcondition) > 0) {
                                            $rowculetcondition = $resculetcondition[0];
                                            $culetconditionid = $rowculetcondition['id'];
                                        } else {
                                            $maxdoqry = "SELECt MAX(ifnull(displayorder,0)) AS maxdo FROM tblculetcondition";
                                            $maxdoparams = array();
                                            $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                            $maxdorow = $maxdores[0];
                                            $maxdo = $maxdorow['maxdo'] + 1;

                                            $culetconditionid = $IISMethods->generateuuid();

                                            $insqryculetcondition['id'] = $culetconditionid;
                                            $insqryculetcondition['name'] = $culetcondition;
                                            $insqryculetcondition['isactive'] = 1;
                                            $insqryculetcondition['displayorder'] = $maxdo;
                                            $insqryculetcondition['timestamp'] = $datetime;
                                            $insqryculetcondition['entry_uid'] = $uid;
                                            $insqryculetcondition['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblculetcondition', $insqryculetcondition, '');
                                        }
                                    }
                                    $culetsizeid = '';
                                    if ($culetsize) {
                                        $qryculetsize = "SELECT id FROM tblsizemaster WHERE name=:culetsize";
                                        $paramculetsize = array(':culetsize' => $culetsize);
                                        $resculetsize = $DB->getmenual($qryculetsize, $paramculetsize);
                                        if (sizeof($resculetsize) > 0) {
                                            $rowculetsize = $resculetsize[0];
                                            $culetsizeid = $rowculetsize['id'];
                                        } else {
                                            $culetsizeid = $IISMethods->generateuuid();

                                            $insqryculetsize['id'] = $culetsizeid;
                                            $insqryculetsize['name'] = $culetsize;
                                            $insqryculetsize['isactive'] = 1;
                                            $insqryculetsize['timestamp'] = $datetime;
                                            $insqryculetsize['entry_uid'] = $uid;
                                            $insqryculetsize['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsizemaster', $insqryculetsize, '');
                                        }
                                    }

                                    $strtreatmentid = '';
                                    if (sizeof($flttreatment) > 0) // Multiple
                                    {
                                        for ($tr = 0; $tr < sizeof($flttreatment); $tr++) {
                                            $treatmentarr = $flttreatment[$tr];

                                            $qrytreatment = "SELECT id FROM tbltreatmentmaster WHERE name=:treatment";
                                            $paramtreatment = array(':treatment' => $treatmentarr);
                                            $restreatment = $DB->getmenual($qrytreatment, $paramtreatment);
                                            if (sizeof($restreatment) > 0) {
                                                $rowtreatment = $restreatment[0];
                                                $treatmentid = $rowtreatment['id'];
                                            } else {
                                                $treatmentid = $IISMethods->generateuuid();

                                                $insqrytreatment['id'] = $treatmentid;
                                                $insqrytreatment['name'] = $treatmentarr;
                                                $insqrytreatment['isactive'] = 1;
                                                $insqrytreatment['timestamp'] = $datetime;
                                                $insqrytreatment['entry_uid'] = $uid;
                                                $insqrytreatment['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tbltreatmentmaster', $insqrytreatment, '');
                                            }

                                            $strtreatmentid .= $treatmentid;
                                            if (sizeof($flttreatment) != $tr) {
                                                $strtreatmentid .= ',';
                                            }
                                        }
                                    }

                                    $strfltkeytosymbolsid = '';
                                    if (sizeof($fltkeytosymbols) > 0) // Multiple
                                    {
                                        for ($ks = 0; $ks < sizeof($fltkeytosymbols); $ks++) {
                                            $fltkeytosymbolsarr = $fltkeytosymbols[$ks];

                                            $qryfltkeytosymbols = "SELECT id FROM tblkeytosymbolmaster WHERE name=:fltkeytosymbols";
                                            $paramfltkeytosymbols = array(':fltkeytosymbols' => $fltkeytosymbolsarr);
                                            $resfltkeytosymbols = $DB->getmenual($qryfltkeytosymbols, $paramfltkeytosymbols);
                                            if (sizeof($resfltkeytosymbols) > 0) {
                                                $rowfltkeytosymbols = $resfltkeytosymbols[0];
                                                $fltkeytosymbolsid = $rowfltkeytosymbols['id'];
                                            } else {
                                                $fltkeytosymbolsid = $IISMethods->generateuuid();

                                                $insqryfltkeytosymbols['id'] = $fltkeytosymbolsid;
                                                $insqryfltkeytosymbols['name'] = $fltkeytosymbolsarr;
                                                $insqryfltkeytosymbols['isactive'] = 1;
                                                $insqryfltkeytosymbols['displayorder'] = 1;
                                                $insqryfltkeytosymbols['timestamp'] = $datetime;
                                                $insqryfltkeytosymbols['entry_uid'] = $uid;
                                                $insqryfltkeytosymbols['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblkeytosymbolmaster', $insqryfltkeytosymbols, '');
                                            }

                                            $strfltkeytosymbolsid .= $fltkeytosymbolsid;
                                            if (sizeof($fltkeytosymbols) != $ks) {
                                                $strfltkeytosymbolsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltovertoneid = '';
                                    if (sizeof($fltovertone) > 0) // Multiple
                                    {
                                        for ($ot = 0; $ot < sizeof($fltovertone); $ot++) {
                                            $fltovertonearr = $fltovertone[$ot];

                                            $qryfltovertone = "SELECT id FROM tblovertonemaster WHERE name=:fltovertone";
                                            $paramfltovertone = array(':fltovertone' => $fltovertonearr);
                                            $resfltovertone = $DB->getmenual($qryfltovertone, $paramfltovertone);
                                            if (sizeof($resfltovertone) > 0) {
                                                $rowfltovertone = $resfltovertone[0];
                                                $fltovertoneid = $rowfltovertone['id'];
                                            } else {
                                                $fltovertoneid = $IISMethods->generateuuid();

                                                $insqryfltovertone['id'] = $fltovertoneid;
                                                $insqryfltovertone['name'] = $fltovertonearr;
                                                $insqryfltovertone['isactive'] = 1;
                                                $insqryfltovertone['timestamp'] = $datetime;
                                                $insqryfltovertone['entry_uid'] = $uid;
                                                $insqryfltovertone['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblovertonemaster', $insqryfltovertone, '');
                                            }

                                            $strfltovertoneid .= $fltovertoneid;
                                            if (sizeof($fltovertone) != $ot) {
                                                $strfltovertoneid .= ',';
                                            }
                                        }
                                    }

                                    $strfltopeninclusionsid = '';
                                    if (sizeof($fltopeninclusions) > 0) // Multiple
                                    {
                                        for ($oi = 0; $oi < sizeof($fltopeninclusions); $oi++) {
                                            $fltopeninclusionsarr = $fltopeninclusions[$oi];

                                            $qryfltopeninclusions = "SELECT id FROM tblopeninclusionmaster WHERE name=:fltopeninclusions";
                                            $paramfltopeninclusions = array(':fltopeninclusions' => $fltopeninclusionsarr);
                                            $resfltopeninclusions = $DB->getmenual($qryfltopeninclusions, $paramfltopeninclusions);
                                            if (sizeof($resfltopeninclusions) > 0) {
                                                $rowfltopeninclusions = $resfltopeninclusions[0];
                                                $fltopeninclusionsid = $rowfltopeninclusions['id'];
                                            } else {
                                                $fltopeninclusionsid = $IISMethods->generateuuid();

                                                $insqryfltopeninclusions['id'] = $fltopeninclusionsid;
                                                $insqryfltopeninclusions['name'] = $fltopeninclusionsarr;
                                                $insqryfltopeninclusions['isactive'] = 1;
                                                $insqryfltopeninclusions['timestamp'] = $datetime;
                                                $insqryfltopeninclusions['entry_uid'] = $uid;
                                                $insqryfltopeninclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblopeninclusionmaster', $insqryfltopeninclusions, '');
                                            }

                                            $strfltopeninclusionsid .= $fltopeninclusionsid;
                                            if (sizeof($fltopeninclusions) != $oi) {
                                                $strfltopeninclusionsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltblackinclusionsid = '';
                                    if (sizeof($fltblackinclusions) > 0) // Multiple
                                    {
                                        for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                            $fltblackinclusionsarr = $fltblackinclusions[$bi];

                                            $qryfltblackinclusions = "SELECT id FROM tblblackinclusionmaster WHERE name=:fltblackinclusions";
                                            $paramfltblackinclusions = array(':fltblackinclusions' => $fltblackinclusionsarr);
                                            $resfltblackinclusions = $DB->getmenual($qryfltblackinclusions, $paramfltblackinclusions);
                                            if (sizeof($resfltblackinclusions) > 0) {
                                                $rowfltblackinclusions = $resfltblackinclusions[0];
                                                $fltblackinclusionsid = $rowfltblackinclusions['id'];
                                            } else {
                                                $fltblackinclusionsid = $IISMethods->generateuuid();

                                                $insqryfltblackinclusions['id'] = $fltblackinclusionsid;
                                                $insqryfltblackinclusions['name'] = $fltblackinclusionsarr;
                                                $insqryfltblackinclusions['isactive'] = 1;
                                                $insqryfltblackinclusions['timestamp'] = $datetime;
                                                $insqryfltblackinclusions['entry_uid'] = $uid;
                                                $insqryfltblackinclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblblackinclusionmaster', $insqryfltblackinclusions, '');
                                            }

                                            $strfltblackinclusionsid .= $fltblackinclusionsid;
                                            if (sizeof($fltblackinclusions) != $bi) {
                                                $strfltblackinclusionsid .= ',';
                                            }
                                        }
                                    }

                                    $strfltwhiteinclusionsid = '';
                                    if (sizeof($fltwhiteinclusions) > 0) // Multiple
                                    {
                                        for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                            $fltwhiteinclusionsarr = $fltwhiteinclusions[$wi];

                                            $qryfltwhiteinclusions = "SELECT id FROM tblwhiteinclusionmaster WHERE name=:fltwhiteinclusions";
                                            $paramfltwhiteinclusions = array(':fltwhiteinclusions' => $fltwhiteinclusionsarr);
                                            $resfltwhiteinclusions = $DB->getmenual($qryfltwhiteinclusions, $paramfltwhiteinclusions);
                                            if (sizeof($resfltwhiteinclusions) > 0) {
                                                $rowfltwhiteinclusions = $resfltwhiteinclusions[0];
                                                $fltwhiteinclusionsid = $rowfltwhiteinclusions['id'];
                                            } else {
                                                $fltwhiteinclusionsid = $IISMethods->generateuuid();

                                                $insqryfltwhiteinclusions['id'] = $fltwhiteinclusionsid;
                                                $insqryfltwhiteinclusions['name'] = $fltwhiteinclusionsarr;
                                                $insqryfltwhiteinclusions['isactive'] = 1;
                                                $insqryfltwhiteinclusions['timestamp'] = $datetime;
                                                $insqryfltwhiteinclusions['entry_uid'] = $uid;
                                                $insqryfltwhiteinclusions['entry_date'] = $datetime;
                                                $DB->executedata('i', 'tblwhiteinclusionmaster', $insqryfltwhiteinclusions, '');
                                            }

                                            $strfltwhiteinclusionsid .= $fltwhiteinclusionsid;
                                            if (sizeof($fltwhiteinclusions) != $wi) {
                                                $strfltwhiteinclusionsid .= ',';
                                            }
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
                                            $insqrylab['displayorder'] = 1;
                                            $insqrylab['isactive'] = 1;
                                            $insqrylab['timestamp'] = $datetime;
                                            $insqrylab['entry_uid'] = $uid;
                                            $insqrylab['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbllabmaster', $insqrylab, '');
                                        }
                                    }

                                    $sieveid = '';
                                    if ($sieve) {
                                        $qrysieve = "SELECT id FROM tblsievemaster WHERE name=:sieve";
                                        $paramsieve = array(':sieve' => $sieve);
                                        $ressieve = $DB->getmenual($qrysieve, $paramsieve);
                                        if (sizeof($ressieve) > 0) {
                                            $rowsieve = $ressieve[0];
                                            $sieveid = $rowsieve['id'];
                                        } else {
                                            $sieveid = $IISMethods->generateuuid();

                                            $insqrysieve['id'] = $sieveid;
                                            $insqrysieve['name'] = $sieve;
                                            $insqrysieve['isactive'] = 1;
                                            $insqrysieve['timestamp'] = $datetime;
                                            $insqrysieve['entry_uid'] = $uid;
                                            $insqrysieve['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblsievemaster', $insqrysieve, '');
                                        }
                                    }


                                    $fancyintensityid = '';
                                    if ($fancyintensity) {
                                        $qryfancyintensity = "SELECT id FROM tblfancyintensitymaster WHERE name=:fancyintensity";
                                        $paramfancyintensity = array(':fancyintensity' => $fancyintensity);
                                        $resfancyintensity = $DB->getmenual($qryfancyintensity, $paramfancyintensity);
                                        if (sizeof($resfancyintensity) > 0) {
                                            $rowfancyintensity = $resfancyintensity[0];
                                            $fancyintensityid = $rowfancyintensity['id'];
                                        } else {

                                            $maxdisplayordqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblfancyintensitymaster ";
                                            $maxparmas = array();
                                            $maxdores = $DB->getmenual($maxdisplayordqry, $maxparmas);
                                            $rowod = $maxdores[0];
                                            $maxdo = 1;
                                            if ($rowod['maxdo'] > 0) {
                                                $maxdo = $rowod['maxdo'] + 1;
                                            }
                                            $fancyintensityid = $IISMethods->generateuuid();

                                            $insqryfancyintensity['id'] = $fancyintensityid;
                                            $insqryfancyintensity['name'] = $fancyintensity;
                                            $insqryfancyintensity['isactive'] = 1;
                                            $insqryfancyintensity['displayorder'] = $maxdo;
                                            $insqryfancyintensity['timestamp'] = $datetime;
                                            $insqryfancyintensity['entry_uid'] = $uid;
                                            $insqryfancyintensity['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblfancyintensitymaster', $insqryfancyintensity, '');
                                        }
                                    }

                                    $fancycolorid1 = '';
                                    if ($fancycolor1) {
                                        $qryfancycolor1 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor1";
                                        $paramfancycolor1 = array(':fancycolor1' => $fancycolor1);
                                        $resfancycolor1 = $DB->getmenual($qryfancycolor1, $paramfancycolor1);
                                        if (sizeof($resfancycolor1) > 0) {
                                            $rowfancycolor1 = $resfancycolor1[0];
                                            $fancycolorid1 = $rowfancycolor1['id'];
                                        } else {
                                            $fancycolorid1 = $IISMethods->generateuuid();

                                            $insqryfancycolor1['id'] = $fancycolorid1;
                                            $insqryfancycolor1['name'] = $fancycolor1;
                                            $insqryfancycolor1['colorcode'] = $fancycolor1;
                                            $insqryfancycolor1['isactive'] = 1;
                                            $insqryfancycolor1['timestamp'] = $datetime;
                                            $insqryfancycolor1['entry_uid'] = $uid;
                                            $insqryfancycolor1['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfancycolor1, '');
                                        }
                                    }

                                    $fancycolorid2 = '';
                                    if ($fancycolor2) {
                                        $qryfancycolor2 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor2";
                                        $paramfancycolor2 = array(':fancycolor2' => $fancycolor2);
                                        $resfancycolor2 = $DB->getmenual($qryfancycolor2, $paramfancycolor2);
                                        if (sizeof($resfancycolor2) > 0) {
                                            $rowfancycolor2 = $resfancycolor2[0];
                                            $fancycolorid2 = $rowfancycolor2['id'];
                                        } else {
                                            $fancycolorid2 = $IISMethods->generateuuid();

                                            $insqryfancycolor2['id'] = $fancycolorid2;
                                            $insqryfancycolor2['name'] = $fancycolor2;
                                            $insqryfancycolor2['colorcode'] = $fancycolor2;
                                            $insqryfancycolor2['isactive'] = 1;
                                            $insqryfancycolor2['timestamp'] = $datetime;
                                            $insqryfancycolor2['entry_uid'] = $uid;
                                            $insqryfancycolor2['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblcolormaster', $insqryfancycolor2, '');
                                        }
                                    }

                                    $tradeshowid = '';
                                    if ($tradeshow) {
                                        $qrytradeshow = "SELECT id FROM tbltradeshowmaster WHERE name=:tradeshow";
                                        $paramtradeshow = array(':tradeshow' => $tradeshow);
                                        $restradeshow = $DB->getmenual($qrytradeshow, $paramtradeshow);
                                        if (sizeof($restradeshow) > 0) {
                                            $rowtradeshow = $restradeshow[0];
                                            $tradeshowid = $rowtradeshow['id'];
                                        } else {
                                            $tradeshowid = $IISMethods->generateuuid();

                                            $insqrytradeshow['id'] = $tradeshowid;
                                            $insqrytradeshow['name'] = $tradeshow;
                                            $insqrytradeshow['isactive'] = 1;
                                            $insqrytradeshow['timestamp'] = $datetime;
                                            $insqrytradeshow['entry_uid'] = $uid;
                                            $insqrytradeshow['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbltradeshowmaster', $insqrytradeshow, '');
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
                                            $insqrybrand['displayorder'] = 1;
                                            $insqrybrand['isactive'] = 1;
                                            $insqrybrand['timestamp'] = $datetime;
                                            $insqrybrand['entry_uid'] = $uid;
                                            $insqrybrand['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblbrandmaster', $insqrybrand, '');
                                        }
                                    }

                                    $shadeid = '';
                                    if ($shade) {
                                        $qryshade = "SELECT id FROM tblshademaster WHERE name=:shade";
                                        $paramshade = array(':shade' => $shade);
                                        $resshade = $DB->getmenual($qryshade, $paramshade);
                                        if (sizeof($resshade) > 0) {
                                            $rowshade = $resshade[0];
                                            $shadeid = $rowshade['id'];
                                        } else {
                                            $shadeid = $IISMethods->generateuuid();

                                            $insqryshade['id'] = $shadeid;
                                            $insqryshade['name'] = $shade;
                                            $insqryshade['isactive'] = 1;
                                            $insqryshade['timestamp'] = $datetime;
                                            $insqryshade['entry_uid'] = $uid;
                                            $insqryshade['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblshademaster', $insqryshade, '');
                                        }
                                    }
                                    $eyecleanid = '';
                                    if ($eyeclean) {
                                        $qryeyeclean = "SELECT id FROM tbleyecleanmaster WHERE name=:eyeclean";
                                        $parameyeclean = array(':eyeclean' => $eyeclean);
                                        $reseyeclean = $DB->getmenual($qryeyeclean, $parameyeclean);
                                        if (sizeof($reseyeclean) > 0) {
                                            $roweyeclean = $reseyeclean[0];
                                            $eyecleanid = $roweyeclean['id'];
                                        } else {
                                            $eyecleanid = $IISMethods->generateuuid();

                                            $insqryeyeclean['id'] = $eyecleanid;
                                            $insqryeyeclean['name'] = $eyeclean;
                                            $insqryeyeclean['isactive'] = 1;
                                            $insqryeyeclean['timestamp'] = $datetime;
                                            $insqryeyeclean['entry_uid'] = $uid;
                                            $insqryeyeclean['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbleyecleanmaster', $insqryeyeclean, '');
                                        }
                                    }
                                    $milkyid = '';
                                    if ($milky) {
                                        $qrymilky = "SELECT id FROM tblmilkymaster WHERE name=:milky";
                                        $parammilky = array(':milky' => $milky);
                                        $resmilky = $DB->getmenual($qrymilky, $parammilky);
                                        if (sizeof($resmilky) > 0) {
                                            $rowmilky = $resmilky[0];
                                            $milkyid = $rowmilky['id'];
                                        } else {
                                            $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblmilkymaster";
                                            $maxparams = array();
                                            $resmax = $DB->getmenual($qrymax, $maxparams);
                                            $rowmax = $resmax[0];
                                            $maxdo = $rowmax['displayorder'] + 1;
                                            $milkyid = $IISMethods->generateuuid();

                                            $insqrymilky['id'] = $milkyid;
                                            $insqrymilky['name'] = $milky;
                                            $insqrymilky['isactive'] = 1;
                                            $insqrymilky['displayorder'] = $maxdo;
                                            $insqrymilky['timestamp'] = $datetime;
                                            $insqrymilky['entry_uid'] = $uid;
                                            $insqrymilky['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblmilkymaster', $insqrymilky, '');
                                        }
                                    }

                                    $roughdiamondsourceid = '';
                                    if ($roughdiamondsource) {
                                        $qryroughdiamondsource = "SELECT id FROM tblroughdiamondsourcemaster WHERE name=:roughdiamondsource";
                                        $paramroughdiamondsource = array(':roughdiamondsource' => $roughdiamondsource);
                                        $resroughdiamondsource = $DB->getmenual($qryroughdiamondsource, $paramroughdiamondsource);
                                        if (sizeof($resroughdiamondsource) > 0) {
                                            $rowroughdiamondsource = $resroughdiamondsource[0];
                                            $roughdiamondsourceid = $rowroughdiamondsource['id'];
                                        } else {
                                            $roughdiamondsourceid = $IISMethods->generateuuid();

                                            $insqryroughdiamondsource['id'] = $roughdiamondsourceid;
                                            $insqryroughdiamondsource['name'] = $roughdiamondsource;
                                            $insqryroughdiamondsource['isactive'] = 1;
                                            $insqryroughdiamondsource['displayorder'] = 1;
                                            $insqryroughdiamondsource['timestamp'] = $datetime;
                                            $insqryroughdiamondsource['entry_uid'] = $uid;
                                            $insqryroughdiamondsource['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblroughdiamondsourcemaster', $insqryroughdiamondsource, '');
                                        }
                                    }
                                    $gridleconditionid = '';
                                    if ($gridlecondition) {
                                        $qrygridlecondition = "SELECT id FROM tblgirdleconditionmaster WHERE name=:gridlecondition";
                                        $paramgridlecondition = array(':gridlecondition' => $gridlecondition);
                                        $resgridlecondition = $DB->getmenual($qrygridlecondition, $paramgridlecondition);
                                        if (sizeof($resgridlecondition) > 0) {
                                            $rowgridlecondition = $resgridlecondition[0];
                                            $gridleconditionid = $rowgridlecondition['id'];
                                        } else {
                                            $maxdoqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblgirdleconditionmaster";
                                            $maxdoparams = array();
                                            $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                            $maxdorow = $maxdores[0];
                                            $maxdo = $maxdorow['maxdo'] + 1;
                                            $gridleconditionid = $IISMethods->generateuuid();

                                            $insqrygridlecondition['id'] = $gridleconditionid;
                                            $insqrygridlecondition['name'] = $gridlecondition;
                                            $insqrygridlecondition['isactive'] = 1;
                                            $insqrygridlecondition['displayorder'] = $maxdo;
                                            $insqrygridlecondition['timestamp'] = $datetime;
                                            $insqrygridlecondition['entry_uid'] = $uid;
                                            $insqrygridlecondition['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblgirdleconditionmaster', $insqrygridlecondition, '');
                                        }
                                    }



                                    // print_r($treatment);
                                    $flttreatmentname = implode("','", explode(",", $treatment));
                                    $fltkeytosymbolsname = implode("','", explode(",", $keytosymbols));
                                    $fltovertonename = implode("','", explode(",", $overtone));
                                    $fltopeninclusionsname = implode("','", explode(",", $openinclusions));
                                    $fltblackinclusionsname = implode("','", explode(",", $blackinclusions));
                                    $fltwhiteinclusionsname = implode("','", explode(",", $whiteinclusions));
                                    if ($i == 1) {
                                        $qrydiamond = "SELECT id FROM tbldiamond WHERE personid=:personid";
                                        $paramdiamond = array(':personid' => $uid);
                                        $resdiamond = $DB->getmenual($qrydiamond, $paramdiamond);
                                        if (sizeof($resdiamond) > 0) {
                                            for ($dm = 0; $dm < sizeof($resdiamond); $dm++) {
                                                $rowdm = $resdiamond[$dm];
                                                $diamondid = $rowdm['id'];

                                                $params = array(
                                                    'id' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamond', '', $params);
                                                $DB->userwisediamonjewelrylog(1, $uid);

                                                $keytosymbolparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                                                $overtoneparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                                                $openinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                                                $blackinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                                                $whiteinclusionsparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);
                                                $treatmentparams = array(
                                                    'diamondid' => $diamondid
                                                );
                                                $DB->executedata('d', 'tbldiamondtreatment', '', $treatmentparams);
                                            }
                                        }
                                    }


                                    // QUERY GET DATA
                                    $qrydata = "SELECT
                                    IFNULL((SELECT name FROM tblavailabilitymaster WHERE id=:availabilityid),'') AS availability,
                                    IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS country,
                                    IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS state,
                                    IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shape,
                                    IFNULL((SELECT name FROM tblsizemaster WHERE id=:sizeid),'') AS size,
                                    IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:diamondcolorid),'') AS diamondcolor,
                                    IFNULL((SELECT name FROM tblclaritymaster WHERE id=:clarityid),'') AS clarity,
                                    IFNULL((SELECT name FROM tblcutmaster WHERE id=:cutid),'') AS cut,
                                    IFNULL((SELECT name FROM tblpolishmaster WHERE id=:polishid),'') AS polish,
                                    IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:symmetryid),'') AS symmetry,
                                    IFNULL((SELECT name FROM tblintensitymaster WHERE id=:intensityid),'') AS intensity,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:colorid),'') AS color,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:colorcodeid),'') AS colorcode,
                                    IFNULL((SELECT name FROM tblgirdleconditionmaster WHERE id=:conditionid),'') AS conditions,
                                    IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridleminid),'') AS gridlemin,
                                    IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridlemaxid),'') AS gridlemax,
                                    IFNULL((SELECT name FROM tblculetcondition WHERE id=:culetconditionid),'') AS culetcondition,
                                    IFNULL((SELECT name FROM tblsizemaster WHERE id=:culetsizeid),'') AS culetsize,
                                    IFNULL((SELECT group_concat(id) FROM tbltreatmentmaster WHERE name IN ('" . $flttreatmentname . "')),'') AS treatment,
                                    IFNULL((SELECT name FROM tbllabmaster WHERE id=:labid),'') AS lab,
                                    IFNULL((SELECT group_concat(id) FROM tblkeytosymbolmaster WHERE name IN ('" . $fltkeytosymbolsname . "')),'') AS keytosymbol,
                                    IFNULL((SELECT name FROM tblfancyintensitymaster WHERE id=:fancyintensityid),'') AS fancyintensity,
                                    IFNULL((SELECT group_concat(id) FROM tblovertonemaster WHERE name IN ('" . $fltovertonename . "')),'') AS overtone,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid1),'') AS fancycolor1,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid1),'') AS fancycolorcode1,
                                    IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid2),'') AS fancycolor2,
                                    IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid2),'') AS fancycolorcode2,
                                    IFNULL((SELECT name FROM tbltradeshowmaster WHERE id=:tradeshowid),'') AS tradeshow,
                                    IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,
                                    IFNULL((SELECT name FROM tblshademaster WHERE id=:shadeid),'') AS shade,
                                    IFNULL((SELECT name FROM tbleyecleanmaster WHERE id=:eyecleanid),'') AS eyeclean,
                                    IFNULL((SELECT name FROM tblmilkymaster WHERE id=:milkyid),'') AS milky,
                                    IFNULL((SELECT group_concat(id) FROM tblopeninclusionmaster WHERE name IN ('" . $fltopeninclusionsname . "')),'') AS openinclusions,
                                    IFNULL((SELECT group_concat(id) FROM tblblackinclusionmaster WHERE name IN ('" . $fltblackinclusionsname . "')),'') AS blackinclusions,
                                    IFNULL((SELECT group_concat(id) FROM tblwhiteinclusionmaster WHERE name IN ('" . $fltwhiteinclusionsname . "')),'') AS whiteinclusions,
                                    IFNULL((SELECT name FROM tblroughdiamondsourcemaster WHERE id=:roughdiamondsourceid),'') AS roughdiamondsource,
                                    IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,
                                    IFNULL((SELECT name FROM tblsievemaster WHERE id=:sieveid),'') AS sievename";
                                    $paramdata = array(
                                        ':availabilityid' => $availabilityid,
                                        ':countryid' => $countryid,
                                        ':stateid' => $stateid,
                                        ':shapeid' => $shapeid,
                                        ':sizeid' => $sizeid,
                                        ':diamondcolorid' => $colorid,
                                        ':clarityid' => $clarityid,
                                        ':cutid' => $cutid,
                                        ':polishid' => $polishid,
                                        ':symmetryid' => $symmetryid,
                                        ':intensityid' => $intensityid,
                                        ':colorid' => $fluorescenecolorid,
                                        ':colorcodeid' => $fluorescenecolorid,
                                        ':conditionid' => $gridleconditionid,
                                        ':gridleminid' => $gridleminid,
                                        ':gridlemaxid' => $gridlemaxid,
                                        ':culetconditionid' => $culetconditionid,
                                        ':culetsizeid' => $culetsizeid,
                                        ':labid' => $labid,
                                        ':fancyintensityid' => $fancyintensityid,
                                        ':fancycolorid1' => $fancycolorid1,
                                        ':fancycolorcodeid1' => $fancycolorid1,
                                        ':fancycolorid2' => $fancycolorid2,
                                        ':fancycolorcodeid2' => $fancycolorid2,
                                        ':tradeshowid' => $tradeshowid,
                                        ':brandid' => $brandid,
                                        ':shadeid' => $shadeid,
                                        ':eyecleanid' => $eyecleanid,
                                        ':milkyid' => $milkyid,
                                        ':roughdiamondsourceid' => $roughdiamondsourceid,
                                        ':personid' => $uid,
                                        ':sieveid' => $sieveid,
                                    );
                                    //  print_r($paramdata);

                                    $resdata = $DB->getmenual($qrydata, $paramdata);
                                    $rowdata = $resdata[0];
                                    //  print_r($rowdata);

                                    $insqry = array(
                                        'personid' => $uid,
                                        'personname' => $rowdata['personname'],
                                        'stock' => $stock,
                                        'price' => $price,
                                        'totalprice' => $totalpriceafterdiscount,
                                        'ispricectsavani' => $ispricectsavani,
                                        'availabilityid' => $availabilityid,
                                        'availability' => $rowdata['availability'],
                                        'countryid' => $countryid,
                                        'country' => $rowdata['country'],
                                        'stateid' => $stateid,
                                        'state' => $rowdata['state'],
                                        'city' => $city,
                                        'shapeid' => $shapeid,
                                        'shape' => $rowdata['shape'],
                                        'sizeid' => $sizeid,
                                        'size' => $rowdata['size'],
                                        'colorid' => $colorid,
                                        'color' => $rowdata['diamondcolor'],
                                        'clarityid' => $clarityid,
                                        'clarity' => $rowdata['clarity'],
                                        'cutid' => $cutid,
                                        'cut' => $rowdata['cut'],
                                        'polishid' => $polishid,
                                        'polish' => $rowdata['polish'],
                                        'symmetryid' => $symmetryid,
                                        'symmetry' => $rowdata['symmetry'],
                                        'intensityid' => $intensityid,
                                        'intensity' => $rowdata['intensity'],
                                        'fluorescenecolorid' => $fluorescenecolorid,
                                        'fluorescenecolor' => $rowdata['color'],
                                        'fluorescenecolorcode' => $rowdata['colorcode'],
                                        'length' => $length,
                                        'width' => $width,
                                        'depth' => $depth,
                                        'depthper' => $depthper,
                                        'tableper' => $tableper,
                                        'crownangle' => $crownangle,
                                        'crownheight' => $crownheight,
                                        'pavilionangle' => $pavilionangle,
                                        'pavilionheight' => $pavilionheight,
                                        'gridleconditionid' => $gridleconditionid,
                                        'gridlecondition' => $rowdata['conditions'],
                                        'gridleminid' => $gridleminid,
                                        'gridlemin' => $rowdata['gridlemin'],
                                        'gridlemaxid' => $gridlemaxid,
                                        'gridlemax' => $rowdata['gridlemax'],
                                        'gridleper' => $gridleper,
                                        'culetconditionid' => $culetconditionid,
                                        'culetcondition' => $rowdata['culetcondition'],
                                        'culetsizeid' => $culetsizeid,
                                        'culetsize' => $rowdata['culetsize'],
                                        'treatmentid' => $rowdata['treatment'],
                                        'treatment' => $treatment,
                                        'laserinscription' => $laserinscription,
                                        'starlength' => $starlength,
                                        'labid' => $labid,
                                        'lab' => $rowdata['lab'],
                                        'reportnumber' => $reportnumber,
                                        'showonsavanigems' => $showonsavanigems,
                                        'reportdate' => $reportdate,
                                        'lablocation' => $lablocation,
                                        'reportcomment' => $reportcomment,
                                        'keytosymbolsid' => $rowdata['keytosymbol'],
                                        'keytosymbols' => $keytosymbols,
                                        'fancyintensityid' => $fancyintensityid,
                                        'fancyintensity' => $rowdata['fancyintensity'],
                                        'overtoneid' => $rowdata['overtone'],
                                        'overtone' => $overtone,
                                        'fancycolorid1' => $fancycolorid1,
                                        'fancycolor1' => $rowdata['fancycolor1'],
                                        'fancycolorcode1' => $rowdata['fancycolorcode1'],
                                        'fancycolorid2' => $fancycolorid2,
                                        'fancycolor2' => $rowdata['fancycolor2'],
                                        'fancycolorcode2' => $rowdata['fancycolorcode2'],
                                        'matchedpair' => $matchedpair,
                                        'stocknumber' => $stocknumber,
                                        'ispairseparable' => $ispairseparable,
                                        'isdownload' => $isdownload,
                                        'tradeshowid' => $tradeshowid,
                                        'tradeshow' => $rowdata['tradeshow'],
                                        'brandid' => $brandid,
                                        'brand' => $rowdata['brand'],
                                        'suppliercomment' => $suppliercomment,
                                        'isparcel' => $isparcel,
                                        'numofdiamond' => $numofdiamond,
                                        'sarineloupe' => $sarineloupe,
                                        'sellerspecification' => $sellerspecification,
                                        'shadeid' => $shadeid,
                                        'shade' => $rowdata['shade'],
                                        'eyecleanid' => $eyecleanid,
                                        'eyeclean' => $rowdata['eyeclean'],
                                        'milkyid' => $milkyid,
                                        'milky' => $rowdata['milky'],
                                        'openinclusionsid' => $rowdata['openinclusions'],
                                        'openinclusions' => $openinclusions,
                                        'blackinclusionsid' => $rowdata['blackinclusions'],
                                        'blackinclusions' => $blackinclusions,
                                        'whiteinclusionsid' => $rowdata['whiteinclusions'],
                                        'whiteinclusions' => $whiteinclusions,
                                        'roughdiamondsourceid' => $roughdiamondsourceid,
                                        'roughdiamondsource' => $rowdata['roughdiamondsource'],
                                        'videolink' => $videolink,
                                        'sieveid' => $sieveid,
                                        'sievename' => $rowdata['sievename'],
                                        'piecepercarat' => $piecepercarat,
                                        'savanipercentage' => $savanipercentage,
                                        'iscsvupload' => 1
                                    );

                                    $typename = 'diamond';
                                    $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";
                                    $seriesparams = array(
                                        ':typename' => $typename,
                                    );
                                    $result_ary = $DB->getmenual($qryseries, $seriesparams);
                                    $rowseries = $result_ary[0];

                                    $seriesid = $rowseries['id'];
                                    $seriesno = $DB->getorderno($seriesid, 'diamond', $currdate);
                                    $maxid = $DB->getmaxid($seriesid, 'diamond');

                                    if ($seriesid) {
                                        try {
                                            $DB->begintransaction();


                                            $diamondid = $IISMethods->generateuuid();

                                            $containreportfileorlink = 0;
                                            if ($reportfilelink) {
                                                $containreportfileorlink = 2;
                                            }

                                            $containdiamondimgorlink = 0;
                                            if ($diamondimglink) {
                                                $containdiamondimgorlink = 2;
                                            }



                                            $insqry['id'] = $diamondid;
                                            $insqry['savanilotnumber'] = $seriesno;
                                            $insqry['diamondimglink'] = $diamondimglink;
                                            $insqry['containdiamondimgorlink'] = $containdiamondimgorlink;
                                            $insqry['containreportfileorlink'] = $containreportfileorlink;
                                            $insqry['reportfilelink'] = $reportfilelink;
                                            $insqry['isactive'] = 1;
                                            $insqry['maxid'] = $maxid;
                                            $insqry['seriesid'] = $seriesid;
                                            $insqry['timestamp'] = $datetime;
                                            $insqry['entry_uid'] = $uid;
                                            $insqry['entry_date'] = $datetime;

                                            // print_r($insqry);exit;
                                            $DB->executedata('i', 'tbldiamond', $insqry, '');

                                            $DB->userwisediamonjewelrylog(1, $uid);


                                            if (sizeof($flttreatment) > 0) {
                                                for ($t = 0; $t < sizeof($flttreatment); $t++) {
                                                    $qrytreatment = "SELECT id from tbltreatmentmaster where name=:id";
                                                    $parmstreatment = array(
                                                        ':id' => $flttreatment[$t],
                                                    );
                                                    $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);
                                                    $mtreatmentid = $IISMethods->generateuuid();
                                                    $inspertreatment = array(
                                                        'id' => $mtreatmentid,
                                                        'diamondid' => $diamondid,
                                                        'treatmentid' => $result_treatment[0]['id'],
                                                        'treatment' => $flttreatment[$t],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondtreatment', $inspertreatment, '');
                                                }
                                            }
                                            if (sizeof($fltkeytosymbols) > 0) {
                                                for ($k = 0; $k < sizeof($fltkeytosymbols); $k++) {
                                                    $qrykeytosymbol = "SELECT id from tblkeytosymbolmaster where name=:id";
                                                    $parmskeytosymbol = array(
                                                        ':id' => $fltkeytosymbols[$k],
                                                    );
                                                    $result_keytosymbol = $DB->getmenual($qrykeytosymbol, $parmskeytosymbol);
                                                    $mkeytosymbolsid = $IISMethods->generateuuid();
                                                    $insperkeytosymbol = array(
                                                        'id' => $mkeytosymbolsid,
                                                        'diamondid' => $diamondid,
                                                        'keytosymbolsid' => $result_keytosymbol[0]['id'],
                                                        'keytosymbols' => $fltkeytosymbols[$k],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondkeytosymbol', $insperkeytosymbol, '');
                                                }
                                            }
                                            if (sizeof($fltovertone) > 0) {
                                                for ($o = 0; $o < sizeof($fltovertone); $o++) {
                                                    $qryovertone = "SELECT id from tblovertonemaster where name=:id";
                                                    $parmsovertone = array(
                                                        ':id' => $fltovertone[$o],
                                                    );
                                                    $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                                    $movertoneid = $IISMethods->generateuuid();
                                                    $insperovertone = array(
                                                        'id' => $movertoneid,
                                                        'diamondid' => $diamondid,
                                                        'overtoneid' => $result_overtone[0]['id'],
                                                        'overtone' => $fltovertone[$o],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondovertone', $insperovertone, '');
                                                }
                                            }

                                            if (sizeof($fltopeninclusions) > 0) {
                                                for ($op = 0; $op < sizeof($fltopeninclusions); $op++) {
                                                    $qryopeninclusion = "SELECT id from tblopeninclusionmaster where name=:id";
                                                    $parmsopeninclusion = array(
                                                        ':id' => $fltopeninclusions[$op],
                                                    );
                                                    $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                                    $mopeninclusionsid = $IISMethods->generateuuid();
                                                    $insperopeninclusion = array(
                                                        'id' => $mopeninclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'openinclusionsid' => $result_openinclusion[0]['id'],
                                                        'openinclusions' => $fltopeninclusions[$op],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondopeninclusions', $insperopeninclusion, '');
                                                }
                                            }

                                            if (sizeof($fltblackinclusions) > 0) {
                                                for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                                    $qryblackinclusion = "SELECT id from tblblackinclusionmaster where name=:id";
                                                    $parmsblackinclusion = array(
                                                        ':id' => $fltblackinclusions[$bi],
                                                    );
                                                    $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                                    $mblackinclusionsid = $IISMethods->generateuuid();
                                                    $insperblackinclusion = array(
                                                        'id' => $mblackinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'blackinclusionsid' => $result_blackinclusion[0]['id'],
                                                        'blackinclusions' => $fltblackinclusions[$bi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondblackinclusions', $insperblackinclusion, '');
                                                }
                                            }

                                            if (sizeof($fltwhiteinclusions) > 0) {
                                                for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                                    $qrywhiteinclusion = "SELECT id from tblwhiteinclusionmaster where name=:id";
                                                    $parmswhiteinclusion = array(
                                                        ':id' => $fltwhiteinclusions[$wi],
                                                    );
                                                    $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                                    $mwhiteinclusionsid = $IISMethods->generateuuid();
                                                    $insperwhiteinclusion = array(
                                                        'id' => $mwhiteinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'whiteinclusionsid' => $result_whiteinclusion[0]['id'],
                                                        'whiteinclusions' => $fltwhiteinclusions[$wi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondwhiteinclusions', $insperwhiteinclusion, '');
                                                }
                                            }

                                            $cnt_ins++;
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
                                } else {
                                    $response['errordata'][$j]['no'] = $IISMethods->sanitize($i + 1);
                                    $response['errordata'][$j]['stock'] = $IISMethods->sanitize($stock);
                                    $response['errordata'][$j]['price'] = $IISMethods->sanitize($price);
                                    $response['errordata'][$j]['shape'] = $IISMethods->sanitize($shape);
                                    $response['errordata'][$j]['size'] = $IISMethods->sanitize($size);
                                    $response['errordata'][$j]['color'] = $IISMethods->sanitize($color);
                                    $response['errordata'][$j]['clarity'] = $IISMethods->sanitize($clarity);
                                    $cnt_err++;

                                    $j++;
                                }
                            }
                            $i++;
                        }

                        // $response['cnt_upddata']=(int)$cnt_upd;
                        $response['cnt_insdata'] = (int)$cnt_ins;
                        $response['cnt_errordata'] = (int)$cnt_err;
                        
                        $status = 1;
                        $message = $errmsg['diamondinsert'];

                        
                

                    } else {
                        $status = 0;
                        $message = $errmsg['filesel'];
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'uploaddiamondcsv') {
                if ($CanListDiamondXL == 1) {
                    $datetime = $IISMethods->getdatetime();
                    $filename = $_FILES['csvfile']['tmp_name'];
                    $ext = pathinfo($_FILES["csvfile"]["name"], PATHINFO_EXTENSION);
                    $unqid = $IISMethods->generateuuid();
                    $uimagePath1 = $IISMethods->uploadallfiles(0, 'diamondcsv', $_FILES['csvfile']['name'], $_FILES['csvfile']['tmp_name'], $unqid);
                    
                    $logunqid = $IISMethods->generateuuid();
                    $inslog = array(
                        'id' => $logunqid,
                        'typeid' => 1,
                        'fileurl' => $uimagePath1,
                        'entry_uid' => $uid,
                        'entry_date' => $datetime,
                        'timestamp' => $datetime,
                    );
                    $DB->executedata('i', 'tblexcelfileslog', $inslog, '');
                    
                    $inputFileName = dirname(__DIR__, 2) . '/assets/' . $uimagePath1;
                    //$inputFileName = 'taskexcel1587204348.xlsx';

                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                    // $objReader->setReadDataOnly(true); //optional
                    // $objPHPExcel = $objReader->load('../../assets/'.$inputFileName);
                    $objPHPExcel = $objReader->load($inputFileName);
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
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $itemData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);

                            $stock = trim($itemData[0][0]); // Stock # 
                            $availability = trim($itemData[0][1]); // Availability
                            $shape = trim($itemData[0][2]); // Shape
                            $size = trim($itemData[0][3]); // Weight
                            $color = trim($itemData[0][4]); // Color
                            $clarity = trim($itemData[0][5]); // Clarity
                            $cut = trim($itemData[0][6]); // Cut Grade
                            $polish = trim($itemData[0][7]); // Polish
                            $symmetry = trim($itemData[0][8]); // Symmetry
                            $intensity = trim($itemData[0][9]); // Fluorescence Intensity
                            $fluorescenecolor = trim($itemData[0][10]); // Fluorescence Color

                            $Measurements = trim($itemData[0][11]); // Measurements
                            $rep_sp_char1 = str_replace("-", "|", $Measurements);
                            $rep_sp_char2 = str_replace("x", "|", $rep_sp_char1);
                            $rep_sp_char3 = str_replace("X", "|", $rep_sp_char2);
                            $expMeasurements = explode('|', $rep_sp_char3);
                            $length = trim($expMeasurements[0]);
                            $width = trim($expMeasurements[1]);
                            $depth = trim($expMeasurements[2]);

                            $BGM = trim($itemData[0][12]); // BGM
                            $eyeclean = trim($itemData[0][13]); // Eye Clean
                            $lab = trim($itemData[0][14]); // Lab
                            $reportnumber = trim($itemData[0][15]); // Report #
                            $treatment = trim($itemData[0][16]); // Treatment - Multiple
                            $price = trim($itemData[0][17]); // Price Per Ct
                            $totalprice = trim($itemData[0][18]); // Total Price
                            $savanipercentage = trim($itemData[0][19]); // Discount %
                            $totalpriceafterdiscount = trim($itemData[0][20]); // Toatal Price After Discount

                            $depthper = trim($itemData[0][21]); // Depth %
                            $tableper = trim($itemData[0][22]); // Table %
                            $gridlemin = trim($itemData[0][23]);   // Girdle Thin
                            $gridlemax = trim($itemData[0][24]);   // Girdle Thick
                            $gridleper = trim($itemData[0][25]);   // Girdle %
                            $gridlecondition = trim($itemData[0][26]); // Girdle Condition
                            $culetsize = trim($itemData[0][27]);   // Culet Size
                            $culetcondition = trim($itemData[0][28]); // Culet Condition
                            $crownheight = trim($itemData[0][29]); // Crown Height
                            $crownangle = trim($itemData[0][30]); // Crown Angle
                            $pavilionheight = trim($itemData[0][31]); // Pavilion Depth
                            $pavilionangle = trim($itemData[0][32]);   // Pavilion Angle
                            $laserinscription = trim($itemData[0][33]); // Laser Inscription
                            $reportcomment = trim($itemData[0][34]);   // Cert comment
                            $keytosymbols = trim($itemData[0][35]);  //Key to symbols - Multiple
                            $suppliercomment = trim($itemData[0][36]); // Member Comment
                            $starlength = trim($itemData[0][37]); // Star Length 
                            $shade = trim($itemData[0][38]); // Shade
                            $whiteinclusions = trim($itemData[0][39]);  //White Inclusion -  Multiple
                            $blackinclusions = trim($itemData[0][40]);  //Black Inclusion - Multiple
                            $openinclusions = trim($itemData[0][41]);    //Open Inclusion - Multiple
                            $milky = trim($itemData[0][42]); //Milky
                            $fancycolor1 = trim($itemData[0][43]); //Fancy Color
                            $fancyintensity = trim($itemData[0][44]); //Fancy Color Intensity
                            $overtone = trim($itemData[0][45]); //Fancy Color Overtone - Multiple
                            $country = trim($itemData[0][46]); //Country
                            $state = trim($itemData[0][47]); //State
                            $city = trim($itemData[0][48]); //City
                            $brand = trim($itemData[0][49]); //Brand
                            $sellerspecification = trim($itemData[0][50]); //Seller Spec
                            $reportfilelink = trim($itemData[0][51]); //Report Filename
                            $diamondimglink = trim($itemData[0][52]); //Diamond Image
                            $videolink = trim($itemData[0][53]); //Video Link
                            $sarineloupe = trim($itemData[0][54]);  //Sarine Loupe
                            $tradeshow = trim($itemData[0][55]); //Trade Show
                            $reportdate = trim($itemData[0][56]); //Report Issue Date
                            $report_type = trim($itemData[0][57]); //Report Type
                            $lablocation = trim($itemData[0][58]); //Lab Location
                            $stocknumber = trim($itemData[0][59]); //Pair Stock #
                            $ispairseparable = trim($itemData[0][60]); // Is Matched Pair Separable
                            $isparcel = trim($itemData[0][61]); // Parcel Stones

                            $ispricectsavani = trim($itemData[0][62]);
                            $showonsavanigems = trim($itemData[0][63]);
                            $fancycolor2 = trim($itemData[0][64]);
                            $matchedpair = trim($itemData[0][65]);
                            $isdownload = trim($itemData[0][66]);
                            $numofdiamond = trim($itemData[0][67]);
                            $roughdiamondsource = trim($itemData[0][68]);
                            $sieve = trim($itemData[0][69]);
                            $piecepercarat = trim($itemData[0][70]);


                            

                            // print_r($rowData);

                            $flttreatment = explode(',', $treatment);
                            $fltkeytosymbols = explode(',', $keytosymbols);
                            $fltovertone = explode(',', $overtone);
                            $fltopeninclusions = explode(',', $openinclusions);
                            $fltblackinclusions = explode(',', $blackinclusions);
                            $fltwhiteinclusions = explode(',', $whiteinclusions);

                            // echo $stock; exit;
                            if ($stock && $price && $shape && $size && $color && $clarity) {

                                $availabilityid = '';
                                if ($availability) // Availability
                                {
                                    $qryavailability = "SELECT id FROM tblavailabilitymaster WHERE name=:availability";
                                    $paramavailability = array(':availability' => $availability);
                                    $resavailability = $DB->getmenual($qryavailability, $paramavailability);
                                    if (sizeof($resavailability) > 0) {
                                        $rowavailability = $resavailability[0];
                                        $availabilityid = $rowavailability['id'];
                                    } else {
                                        $availabilityid = $IISMethods->generateuuid();

                                        $insqryavailability['id'] = $availabilityid;
                                        $insqryavailability['name'] = $availability;
                                        $insqryavailability['isactive'] = 1;
                                        $insqryavailability['timestamp'] = $datetime;
                                        $insqryavailability['entry_uid'] = $uid;
                                        $insqryavailability['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblavailabilitymaster', $insqryavailability, '');
                                    }
                                }

                                $countryid = '';
                                if ($country) // Country
                                {
                                    $qrycountry = "SELECT id FROM tblcountrymaster WHERE country=:country";
                                    $paramcountry = array(':country' => $country);
                                    $rescountry = $DB->getmenual($qrycountry, $paramcountry);
                                    if (sizeof($rescountry) > 0) {
                                        $rowcountry = $rescountry[0];
                                        $countryid = $rowcountry['id'];
                                    } else {
                                        $countryid = $IISMethods->generateuuid();

                                        $insqrycountry['id'] = $countryid;
                                        $insqrycountry['country'] = $country;
                                        $insqrycountry['timestamp'] = $datetime;
                                        $insqrycountry['entry_uid'] = $uid;
                                        $insqrycountry['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblcountrymaster', $insqrycountry, '');
                                    }
                                }

                                $stateid = '';
                                if ($state) // State
                                {
                                    $qrystate = "SELECT id FROM tblstatemaster WHERE state=:state";
                                    $paramstate = array(':state' => $state);
                                    $resstate = $DB->getmenual($qrystate, $paramstate);
                                    if (sizeof($resstate) > 0) {
                                        $rowstate = $resstate[0];
                                        $stateid = $rowstate['id'];
                                    } else {
                                        $stateid = $IISMethods->generateuuid();

                                        $insqrystate['id'] = $stateid;
                                        $insqrystate['countryid'] = $countryid;
                                        $insqrystate['state'] = $state;
                                        $insqrystate['timestamp'] = $datetime;
                                        $insqrystate['entry_uid'] = $uid;
                                        $insqrystate['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblstatemaster', $insqrystate, '');
                                    }
                                }
                                $shapeid = '';
                                if ($shape) // Shape
                                {
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
                                        $insqryshape['timestamp'] = $datetime;
                                        $insqryshape['entry_uid'] = $uid;
                                        $insqryshape['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tbldiamondshapemaster', $insqryshape, '');
                                    }
                                }

                                $sizeid = '';
                                if ($size) // Size
                                {
                                    $qrysize = "SELECT id FROM tblsizemaster WHERE name=:size";
                                    $paramsize = array(':size' => $size);
                                    $ressize = $DB->getmenual($qrysize, $paramsize);
                                    if (sizeof($ressize) > 0) {
                                        $rowsize = $ressize[0];
                                        $sizeid = $rowsize['id'];
                                    } else {
                                        $sizeid = $IISMethods->generateuuid();

                                        $insqrysize['id'] = $sizeid;
                                        $insqrysize['name'] = $size;
                                        $insqrysize['timestamp'] = $datetime;
                                        $insqrysize['isactive'] = 1;
                                        $insqrysize['entry_uid'] = $uid;
                                        $insqrysize['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblsizemaster', $insqrysize, '');
                                    }
                                }
                                $colorid = '';
                                if ($color) {
                                    $qrycolor = "SELECT id FROM tbldiamondcolormaster WHERE name=:color";
                                    $paramcolor = array(':color' => $color);
                                    $rescolor = $DB->getmenual($qrycolor, $paramcolor);
                                    if (sizeof($rescolor) > 0) {
                                        $rowcolor = $rescolor[0];
                                        $colorid = $rowcolor['id'];
                                    } else {
                                        $colorid = $IISMethods->generateuuid();

                                        $insqrycolor['id'] = $colorid;
                                        $insqrycolor['name'] = $color;
                                        $insqrycolor['isactive'] = 1;
                                        $insqrycolor['timestamp'] = $datetime;
                                        $insqrycolor['entry_uid'] = $uid;
                                        $insqrycolor['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tbldiamondcolormaster', $insqrycolor, '');
                                    }
                                }

                                $clarityid = '';
                                if ($clarity) {
                                    $qryclarity = "SELECT id FROM tblclaritymaster WHERE name=:clarity";
                                    $paramclarity = array(':clarity' => $clarity);
                                    $resclarity = $DB->getmenual($qryclarity, $paramclarity);
                                    if (sizeof($resclarity) > 0) {
                                        $rowclarity = $resclarity[0];
                                        $clarityid = $rowclarity['id'];
                                    } else {
                                        $clarityid = $IISMethods->generateuuid();

                                        $insqryclarity['id'] = $clarityid;
                                        $insqryclarity['name'] = $clarity;
                                        $insqryclarity['isactive'] = 1;
                                        $insqryclarity['timestamp'] = $datetime;
                                        $insqryclarity['entry_uid'] = $uid;
                                        $insqryclarity['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblclaritymaster', $insqryclarity, '');
                                    }
                                }

                                $cutid = '';
                                if ($cut) {
                                    $qrycut = "SELECT id FROM tblcutmaster WHERE name=:cut";
                                    $paramcut = array(':cut' => $cut);
                                    $rescut = $DB->getmenual($qrycut, $paramcut);
                                    if (sizeof($rescut) > 0) {
                                        $rowcut = $rescut[0];
                                        $cutid = $rowcut['id'];
                                    } else {
                                        $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblcutmaster";
                                        $maxparams = array();
                                        $resmax = $DB->getmenual($qrymax, $maxparams);
                                        $rowmax = $resmax[0];
                                        $maxdo = $rowmax['displayorder'] + 1;
                                        $cutid = $IISMethods->generateuuid();

                                        $insqrycut['id'] = $cutid;
                                        $insqrycut['name'] = $cut;
                                        $insqrycut['isactive'] = 1;
                                        $insqrycut['displayorder'] = $maxdo;
                                        $insqrycut['timestamp'] = $datetime;
                                        $insqrycut['entry_uid'] = $uid;
                                        $insqrycut['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblcutmaster', $insqrycut, '');
                                    }
                                }

                                $polishid = '';
                                if ($polish) {
                                    $qrypolish = "SELECT id FROM tblpolishmaster WHERE name=:polish";
                                    $parampolish = array(':polish' => $polish);
                                    $respolish = $DB->getmenual($qrypolish, $parampolish);
                                    if (sizeof($respolish) > 0) {
                                        $rowpolish = $respolish[0];
                                        $polishid = $rowpolish['id'];
                                    } else {
                                        $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblpolishmaster";
                                        $maxparams = array();
                                        $resmax = $DB->getmenual($qrymax, $maxparams);
                                        $rowmax = $resmax[0];
                                        $maxdo = $rowmax['displayorder'] + 1;

                                        $polishid = $IISMethods->generateuuid();

                                        $insqrypolish['id'] = $polishid;
                                        $insqrypolish['name'] = $polish;
                                        $insqrypolish['isactive'] = 1;
                                        $insqrypolish['displayorder'] = $maxdo;
                                        $insqrypolish['timestamp'] = $datetime;
                                        $insqrypolish['entry_uid'] = $uid;
                                        $insqrypolish['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblpolishmaster', $insqrypolish, '');
                                    }
                                }

                                $symmetryid = '';
                                if ($symmetry) {
                                    $qrysymmetry = "SELECT id FROM tblsymmetrymaster WHERE name=:symmetry";
                                    $paramsymmetry = array(':symmetry' => $symmetry);
                                    $ressymmetry = $DB->getmenual($qrysymmetry, $paramsymmetry);
                                    if (sizeof($ressymmetry) > 0) {
                                        $rowsymmetry = $ressymmetry[0];
                                        $symmetryid = $rowsymmetry['id'];
                                    } else {
                                        $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblsymmetrymaster";
                                        $maxparams = array();
                                        $resmax = $DB->getmenual($qrymax, $maxparams);
                                        $rowmax = $resmax[0];
                                        $maxdo = $rowmax['displayorder'] + 1;
                                        $symmetryid = $IISMethods->generateuuid();

                                        $insqrysymmetry['id'] = $symmetryid;
                                        $insqrysymmetry['name'] = $symmetry;
                                        $insqrysymmetry['isactive'] = 1;
                                        $insqrysymmetry['displayorder'] = $maxdo;
                                        $insqrysymmetry['timestamp'] = $datetime;
                                        $insqrysymmetry['entry_uid'] = $uid;
                                        $insqrysymmetry['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblsymmetrymaster', $insqrysymmetry, '');
                                    }
                                }

                                $intensityid = '';
                                if ($intensity) {
                                    $qryintensity = "SELECT id FROM tblintensitymaster WHERE name=:intensity";
                                    $paramintensity = array(':intensity' => $intensity);
                                    $resintensity = $DB->getmenual($qryintensity, $paramintensity);
                                    if (sizeof($resintensity) > 0) {
                                        $rowintensity = $resintensity[0];
                                        $intensityid = $rowintensity['id'];
                                    } else {
                                        $intensityid = $IISMethods->generateuuid();

                                        $insqryintensity['id'] = $intensityid;
                                        $insqryintensity['name'] = $intensity;
                                        $insqryintensity['isactive'] = 1;
                                        $insqryintensity['timestamp'] = $datetime;
                                        $insqryintensity['entry_uid'] = $uid;
                                        $insqryintensity['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblintensitymaster', $insqryintensity, '');
                                    }
                                }

                                $fluorescenecolorid = '';
                                if ($fluorescenecolor) {
                                    $qryfluorescenecolor = "SELECT id FROM tblcolormaster WHERE name=:fluorescenecolor";
                                    $paramfluorescenecolor = array(':fluorescenecolor' => $fluorescenecolor);
                                    $resfluorescenecolor = $DB->getmenual($qryfluorescenecolor, $paramfluorescenecolor);
                                    if (sizeof($resfluorescenecolor) > 0) {
                                        $rowfluorescenecolor = $resfluorescenecolor[0];
                                        $fluorescenecolorid = $rowfluorescenecolor['id'];
                                    } else {
                                        $fluorescenecolorid = $IISMethods->generateuuid();

                                        $insqryfluorescenecolor['id'] = $fluorescenecolorid;
                                        $insqryfluorescenecolor['name'] = $fluorescenecolor;
                                        $insqryfluorescenecolor['colorcode'] = $fluorescenecolor;
                                        $insqryfluorescenecolor['isactive'] = 1;
                                        $insqryfluorescenecolor['timestamp'] = $datetime;
                                        $insqryfluorescenecolor['entry_uid'] = $uid;
                                        $insqryfluorescenecolor['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblcolormaster', $insqryfluorescenecolor, '');
                                    }
                                }

                                $gridleminid = '';
                                if ($gridlemin) {
                                    $qrygridlemin = "SELECT id FROM tblgridlemaster WHERE name=:gridlemin";
                                    $paramgridlemin = array(':gridlemin' => $gridlemin);
                                    $resgridlemin = $DB->getmenual($qrygridlemin, $paramgridlemin);
                                    if (sizeof($resgridlemin) > 0) {
                                        $rowgridlemin = $resgridlemin[0];
                                        $gridleminid = $rowgridlemin['id'];
                                    } else {
                                        $gridleminid = $IISMethods->generateuuid();

                                        $insqrygridlemin['id'] = $gridleminid;
                                        $insqrygridlemin['name'] = $gridlemin;
                                        $insqrygridlemin['isactive'] = 1;
                                        $insqrygridlemin['timestamp'] = $datetime;
                                        $insqrygridlemin['entry_uid'] = $uid;
                                        $insqrygridlemin['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblgridlemaster', $insqrygridlemin, '');
                                    }
                                }
                                $gridlemaxid = '';
                                if ($gridlemax) {
                                    $qrygridlemax = "SELECT id FROM tblgridlemaster WHERE name=:gridlemax";
                                    $paramgridlemax = array(':gridlemax' => $gridlemax);
                                    $resgridlemax = $DB->getmenual($qrygridlemax, $paramgridlemax);
                                    if (sizeof($resgridlemax) > 0) {
                                        $rowgridlemax = $resgridlemax[0];
                                        $gridlemaxid = $rowgridlemax['id'];
                                    } else {
                                        $gridlemaxid = $IISMethods->generateuuid();

                                        $insqrygridlemax['id'] = $gridlemaxid;
                                        $insqrygridlemax['name'] = $gridlemax;
                                        $insqrygridlemax['isactive'] = 1;
                                        $insqrygridlemax['timestamp'] = $datetime;
                                        $insqrygridlemax['entry_uid'] = $uid;
                                        $insqrygridlemax['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblgridlemaster', $insqrygridlemax, '');
                                    }
                                }

                                $culetconditionid = '';
                                if ($culetcondition) {
                                    $qryculetcondition = "SELECT id FROM tblculetcondition WHERE name=:culetcondition";
                                    $paramculetcondition = array(':culetcondition' => $culetcondition);
                                    $resculetcondition = $DB->getmenual($qryculetcondition, $paramculetcondition);
                                    if (sizeof($resculetcondition) > 0) {
                                        $rowculetcondition = $resculetcondition[0];
                                        $culetconditionid = $rowculetcondition['id'];
                                    } else {
                                        $maxdoqry = "SELECt MAX(ifnull(displayorder,0)) AS maxdo FROM tblculetcondition";
                                        $maxdoparams = array();
                                        $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                        $maxdorow = $maxdores[0];
                                        $maxdo = $maxdorow['maxdo'] + 1;

                                        $culetconditionid = $IISMethods->generateuuid();

                                        $insqryculetcondition['id'] = $culetconditionid;
                                        $insqryculetcondition['name'] = $culetcondition;
                                        $insqryculetcondition['isactive'] = 1;
                                        $insqryculetcondition['displayorder'] = $maxdo;
                                        $insqryculetcondition['timestamp'] = $datetime;
                                        $insqryculetcondition['entry_uid'] = $uid;
                                        $insqryculetcondition['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblculetcondition', $insqryculetcondition, '');
                                    }
                                }
                                $culetsizeid = '';
                                if ($culetsize) {
                                    $qryculetsize = "SELECT id FROM tblsizemaster WHERE name=:culetsize";
                                    $paramculetsize = array(':culetsize' => $culetsize);
                                    $resculetsize = $DB->getmenual($qryculetsize, $paramculetsize);
                                    if (sizeof($resculetsize) > 0) {
                                        $rowculetsize = $resculetsize[0];
                                        $culetsizeid = $rowculetsize['id'];
                                    } else {
                                        $culetsizeid = $IISMethods->generateuuid();

                                        $insqryculetsize['id'] = $culetsizeid;
                                        $insqryculetsize['name'] = $culetsize;
                                        $insqryculetsize['isactive'] = 1;
                                        $insqryculetsize['timestamp'] = $datetime;
                                        $insqryculetsize['entry_uid'] = $uid;
                                        $insqryculetsize['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblsizemaster', $insqryculetsize, '');
                                    }
                                }

                                $strtreatmentid = '';
                                if (sizeof($flttreatment) > 0) // Multiple
                                {
                                    for ($tr = 0; $tr < sizeof($flttreatment); $tr++) {
                                        $treatmentarr = $flttreatment[$tr];

                                        $qrytreatment = "SELECT id FROM tbltreatmentmaster WHERE name=:treatment";
                                        $paramtreatment = array(':treatment' => $treatmentarr);
                                        $restreatment = $DB->getmenual($qrytreatment, $paramtreatment);
                                        if (sizeof($restreatment) > 0) {
                                            $rowtreatment = $restreatment[0];
                                            $treatmentid = $rowtreatment['id'];
                                        } else {
                                            $treatmentid = $IISMethods->generateuuid();

                                            $insqrytreatment['id'] = $treatmentid;
                                            $insqrytreatment['name'] = $treatmentarr;
                                            $insqrytreatment['isactive'] = 1;
                                            $insqrytreatment['timestamp'] = $datetime;
                                            $insqrytreatment['entry_uid'] = $uid;
                                            $insqrytreatment['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tbltreatmentmaster', $insqrytreatment, '');
                                        }

                                        $strtreatmentid .= $treatmentid;
                                        if (sizeof($flttreatment) != $tr) {
                                            $strtreatmentid .= ',';
                                        }
                                    }
                                }

                                $strfltkeytosymbolsid = '';
                                if (sizeof($fltkeytosymbols) > 0) // Multiple
                                {
                                    for ($ks = 0; $ks < sizeof($fltkeytosymbols); $ks++) {
                                        $fltkeytosymbolsarr = $fltkeytosymbols[$ks];

                                        $qryfltkeytosymbols = "SELECT id FROM tblkeytosymbolmaster WHERE name=:fltkeytosymbols";
                                        $paramfltkeytosymbols = array(':fltkeytosymbols' => $fltkeytosymbolsarr);
                                        $resfltkeytosymbols = $DB->getmenual($qryfltkeytosymbols, $paramfltkeytosymbols);
                                        if (sizeof($resfltkeytosymbols) > 0) {
                                            $rowfltkeytosymbols = $resfltkeytosymbols[0];
                                            $fltkeytosymbolsid = $rowfltkeytosymbols['id'];
                                        } else {
                                            $fltkeytosymbolsid = $IISMethods->generateuuid();

                                            $insqryfltkeytosymbols['id'] = $fltkeytosymbolsid;
                                            $insqryfltkeytosymbols['name'] = $fltkeytosymbolsarr;
                                            $insqryfltkeytosymbols['isactive'] = 1;
                                            $insqryfltkeytosymbols['displayorder'] = 1;
                                            $insqryfltkeytosymbols['timestamp'] = $datetime;
                                            $insqryfltkeytosymbols['entry_uid'] = $uid;
                                            $insqryfltkeytosymbols['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblkeytosymbolmaster', $insqryfltkeytosymbols, '');
                                        }

                                        $strfltkeytosymbolsid .= $fltkeytosymbolsid;
                                        if (sizeof($fltkeytosymbols) != $ks) {
                                            $strfltkeytosymbolsid .= ',';
                                        }
                                    }
                                }

                                $strfltovertoneid = '';
                                if (sizeof($fltovertone) > 0) // Multiple
                                {
                                    for ($ot = 0; $ot < sizeof($fltovertone); $ot++) {
                                        $fltovertonearr = $fltovertone[$ot];

                                        $qryfltovertone = "SELECT id FROM tblovertonemaster WHERE name=:fltovertone";
                                        $paramfltovertone = array(':fltovertone' => $fltovertonearr);
                                        $resfltovertone = $DB->getmenual($qryfltovertone, $paramfltovertone);
                                        if (sizeof($resfltovertone) > 0) {
                                            $rowfltovertone = $resfltovertone[0];
                                            $fltovertoneid = $rowfltovertone['id'];
                                        } else {
                                            $fltovertoneid = $IISMethods->generateuuid();

                                            $insqryfltovertone['id'] = $fltovertoneid;
                                            $insqryfltovertone['name'] = $fltovertonearr;
                                            $insqryfltovertone['isactive'] = 1;
                                            $insqryfltovertone['timestamp'] = $datetime;
                                            $insqryfltovertone['entry_uid'] = $uid;
                                            $insqryfltovertone['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblovertonemaster', $insqryfltovertone, '');
                                        }

                                        $strfltovertoneid .= $fltovertoneid;
                                        if (sizeof($fltovertone) != $ot) {
                                            $strfltovertoneid .= ',';
                                        }
                                    }
                                }

                                $strfltopeninclusionsid = '';
                                if (sizeof($fltopeninclusions) > 0) // Multiple
                                {
                                    for ($oi = 0; $oi < sizeof($fltopeninclusions); $oi++) {
                                        $fltopeninclusionsarr = $fltopeninclusions[$oi];

                                        $qryfltopeninclusions = "SELECT id FROM tblopeninclusionmaster WHERE name=:fltopeninclusions";
                                        $paramfltopeninclusions = array(':fltopeninclusions' => $fltopeninclusionsarr);
                                        $resfltopeninclusions = $DB->getmenual($qryfltopeninclusions, $paramfltopeninclusions);
                                        if (sizeof($resfltopeninclusions) > 0) {
                                            $rowfltopeninclusions = $resfltopeninclusions[0];
                                            $fltopeninclusionsid = $rowfltopeninclusions['id'];
                                        } else {
                                            $fltopeninclusionsid = $IISMethods->generateuuid();

                                            $insqryfltopeninclusions['id'] = $fltopeninclusionsid;
                                            $insqryfltopeninclusions['name'] = $fltopeninclusionsarr;
                                            $insqryfltopeninclusions['isactive'] = 1;
                                            $insqryfltopeninclusions['timestamp'] = $datetime;
                                            $insqryfltopeninclusions['entry_uid'] = $uid;
                                            $insqryfltopeninclusions['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblopeninclusionmaster', $insqryfltopeninclusions, '');
                                        }

                                        $strfltopeninclusionsid .= $fltopeninclusionsid;
                                        if (sizeof($fltopeninclusions) != $oi) {
                                            $strfltopeninclusionsid .= ',';
                                        }
                                    }
                                }

                                $strfltblackinclusionsid = '';
                                if (sizeof($fltblackinclusions) > 0) // Multiple
                                {
                                    for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                        $fltblackinclusionsarr = $fltblackinclusions[$bi];

                                        $qryfltblackinclusions = "SELECT id FROM tblblackinclusionmaster WHERE name=:fltblackinclusions";
                                        $paramfltblackinclusions = array(':fltblackinclusions' => $fltblackinclusionsarr);
                                        $resfltblackinclusions = $DB->getmenual($qryfltblackinclusions, $paramfltblackinclusions);
                                        if (sizeof($resfltblackinclusions) > 0) {
                                            $rowfltblackinclusions = $resfltblackinclusions[0];
                                            $fltblackinclusionsid = $rowfltblackinclusions['id'];
                                        } else {
                                            $fltblackinclusionsid = $IISMethods->generateuuid();

                                            $insqryfltblackinclusions['id'] = $fltblackinclusionsid;
                                            $insqryfltblackinclusions['name'] = $fltblackinclusionsarr;
                                            $insqryfltblackinclusions['isactive'] = 1;
                                            $insqryfltblackinclusions['timestamp'] = $datetime;
                                            $insqryfltblackinclusions['entry_uid'] = $uid;
                                            $insqryfltblackinclusions['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblblackinclusionmaster', $insqryfltblackinclusions, '');
                                        }

                                        $strfltblackinclusionsid .= $fltblackinclusionsid;
                                        if (sizeof($fltblackinclusions) != $bi) {
                                            $strfltblackinclusionsid .= ',';
                                        }
                                    }
                                }

                                $strfltwhiteinclusionsid = '';
                                if (sizeof($fltwhiteinclusions) > 0) // Multiple
                                {
                                    for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                        $fltwhiteinclusionsarr = $fltwhiteinclusions[$wi];

                                        $qryfltwhiteinclusions = "SELECT id FROM tblwhiteinclusionmaster WHERE name=:fltwhiteinclusions";
                                        $paramfltwhiteinclusions = array(':fltwhiteinclusions' => $fltwhiteinclusionsarr);
                                        $resfltwhiteinclusions = $DB->getmenual($qryfltwhiteinclusions, $paramfltwhiteinclusions);
                                        if (sizeof($resfltwhiteinclusions) > 0) {
                                            $rowfltwhiteinclusions = $resfltwhiteinclusions[0];
                                            $fltwhiteinclusionsid = $rowfltwhiteinclusions['id'];
                                        } else {
                                            $fltwhiteinclusionsid = $IISMethods->generateuuid();

                                            $insqryfltwhiteinclusions['id'] = $fltwhiteinclusionsid;
                                            $insqryfltwhiteinclusions['name'] = $fltwhiteinclusionsarr;
                                            $insqryfltwhiteinclusions['isactive'] = 1;
                                            $insqryfltwhiteinclusions['timestamp'] = $datetime;
                                            $insqryfltwhiteinclusions['entry_uid'] = $uid;
                                            $insqryfltwhiteinclusions['entry_date'] = $datetime;
                                            $DB->executedata('i', 'tblwhiteinclusionmaster', $insqryfltwhiteinclusions, '');
                                        }

                                        $strfltwhiteinclusionsid .= $fltwhiteinclusionsid;
                                        if (sizeof($fltwhiteinclusions) != $wi) {
                                            $strfltwhiteinclusionsid .= ',';
                                        }
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
                                        $insqrylab['displayorder'] = 1;
                                        $insqrylab['isactive'] = 1;
                                        $insqrylab['timestamp'] = $datetime;
                                        $insqrylab['entry_uid'] = $uid;
                                        $insqrylab['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tbllabmaster', $insqrylab, '');
                                    }
                                }

                                $sieveid = '';
                                if ($sieve) {
                                    $qrysieve = "SELECT id FROM tblsievemaster WHERE name=:sieve";
                                    $paramsieve = array(':sieve' => $sieve);
                                    $ressieve = $DB->getmenual($qrysieve, $paramsieve);
                                    if (sizeof($ressieve) > 0) {
                                        $rowsieve = $ressieve[0];
                                        $sieveid = $rowsieve['id'];
                                    } else {
                                        $sieveid = $IISMethods->generateuuid();

                                        $insqrysieve['id'] = $sieveid;
                                        $insqrysieve['name'] = $sieve;
                                        $insqrysieve['isactive'] = 1;
                                        $insqrysieve['timestamp'] = $datetime;
                                        $insqrysieve['entry_uid'] = $uid;
                                        $insqrysieve['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblsievemaster', $insqrysieve, '');
                                    }
                                }


                                $fancyintensityid = '';
                                if ($fancyintensity) {
                                    $qryfancyintensity = "SELECT id FROM tblfancyintensitymaster WHERE name=:fancyintensity";
                                    $paramfancyintensity = array(':fancyintensity' => $fancyintensity);
                                    $resfancyintensity = $DB->getmenual($qryfancyintensity, $paramfancyintensity);
                                    if (sizeof($resfancyintensity) > 0) {
                                        $rowfancyintensity = $resfancyintensity[0];
                                        $fancyintensityid = $rowfancyintensity['id'];
                                    } else {

                                        $maxdisplayordqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblfancyintensitymaster ";
                                        $maxparmas = array();
                                        $maxdores = $DB->getmenual($maxdisplayordqry, $maxparmas);
                                        $rowod = $maxdores[0];
                                        $maxdo = 1;
                                        if ($rowod['maxdo'] > 0) {
                                            $maxdo = $rowod['maxdo'] + 1;
                                        }
                                        $fancyintensityid = $IISMethods->generateuuid();

                                        $insqryfancyintensity['id'] = $fancyintensityid;
                                        $insqryfancyintensity['name'] = $fancyintensity;
                                        $insqryfancyintensity['isactive'] = 1;
                                        $insqryfancyintensity['displayorder'] = $maxdo;
                                        $insqryfancyintensity['timestamp'] = $datetime;
                                        $insqryfancyintensity['entry_uid'] = $uid;
                                        $insqryfancyintensity['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblfancyintensitymaster', $insqryfancyintensity, '');
                                    }
                                }

                                $fancycolorid1 = '';
                                if ($fancycolor1) {
                                    $qryfancycolor1 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor1";
                                    $paramfancycolor1 = array(':fancycolor1' => $fancycolor1);
                                    $resfancycolor1 = $DB->getmenual($qryfancycolor1, $paramfancycolor1);
                                    if (sizeof($resfancycolor1) > 0) {
                                        $rowfancycolor1 = $resfancycolor1[0];
                                        $fancycolorid1 = $rowfancycolor1['id'];
                                    } else {
                                        $fancycolorid1 = $IISMethods->generateuuid();

                                        $insqryfancycolor1['id'] = $fancycolorid1;
                                        $insqryfancycolor1['name'] = $fancycolor1;
                                        $insqryfancycolor1['colorcode'] = $fancycolor1;
                                        $insqryfancycolor1['isactive'] = 1;
                                        $insqryfancycolor1['timestamp'] = $datetime;
                                        $insqryfancycolor1['entry_uid'] = $uid;
                                        $insqryfancycolor1['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblcolormaster', $insqryfancycolor1, '');
                                    }
                                }

                                $fancycolorid2 = '';
                                if ($fancycolor2) {
                                    $qryfancycolor2 = "SELECT id FROM tblcolormaster WHERE name=:fancycolor2";
                                    $paramfancycolor2 = array(':fancycolor2' => $fancycolor2);
                                    $resfancycolor2 = $DB->getmenual($qryfancycolor2, $paramfancycolor2);
                                    if (sizeof($resfancycolor2) > 0) {
                                        $rowfancycolor2 = $resfancycolor2[0];
                                        $fancycolorid2 = $rowfancycolor2['id'];
                                    } else {
                                        $fancycolorid2 = $IISMethods->generateuuid();

                                        $insqryfancycolor2['id'] = $fancycolorid2;
                                        $insqryfancycolor2['name'] = $fancycolor2;
                                        $insqryfancycolor2['colorcode'] = $fancycolor2;
                                        $insqryfancycolor2['isactive'] = 1;
                                        $insqryfancycolor2['timestamp'] = $datetime;
                                        $insqryfancycolor2['entry_uid'] = $uid;
                                        $insqryfancycolor2['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblcolormaster', $insqryfancycolor2, '');
                                    }
                                }

                                $tradeshowid = '';
                                if ($tradeshow) {
                                    $qrytradeshow = "SELECT id FROM tbltradeshowmaster WHERE name=:tradeshow";
                                    $paramtradeshow = array(':tradeshow' => $tradeshow);
                                    $restradeshow = $DB->getmenual($qrytradeshow, $paramtradeshow);
                                    if (sizeof($restradeshow) > 0) {
                                        $rowtradeshow = $restradeshow[0];
                                        $tradeshowid = $rowtradeshow['id'];
                                    } else {
                                        $tradeshowid = $IISMethods->generateuuid();

                                        $insqrytradeshow['id'] = $tradeshowid;
                                        $insqrytradeshow['name'] = $tradeshow;
                                        $insqrytradeshow['isactive'] = 1;
                                        $insqrytradeshow['timestamp'] = $datetime;
                                        $insqrytradeshow['entry_uid'] = $uid;
                                        $insqrytradeshow['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tbltradeshowmaster', $insqrytradeshow, '');
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
                                        $insqrybrand['displayorder'] = 1;
                                        $insqrybrand['isactive'] = 1;
                                        $insqrybrand['timestamp'] = $datetime;
                                        $insqrybrand['entry_uid'] = $uid;
                                        $insqrybrand['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblbrandmaster', $insqrybrand, '');
                                    }
                                }

                                $shadeid = '';
                                if ($shade) {
                                    $qryshade = "SELECT id FROM tblshademaster WHERE name=:shade";
                                    $paramshade = array(':shade' => $shade);
                                    $resshade = $DB->getmenual($qryshade, $paramshade);
                                    if (sizeof($resshade) > 0) {
                                        $rowshade = $resshade[0];
                                        $shadeid = $rowshade['id'];
                                    } else {
                                        $shadeid = $IISMethods->generateuuid();

                                        $insqryshade['id'] = $shadeid;
                                        $insqryshade['name'] = $shade;
                                        $insqryshade['isactive'] = 1;
                                        $insqryshade['timestamp'] = $datetime;
                                        $insqryshade['entry_uid'] = $uid;
                                        $insqryshade['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblshademaster', $insqryshade, '');
                                    }
                                }
                                $eyecleanid = '';
                                if ($eyeclean) {
                                    $qryeyeclean = "SELECT id FROM tbleyecleanmaster WHERE name=:eyeclean";
                                    $parameyeclean = array(':eyeclean' => $eyeclean);
                                    $reseyeclean = $DB->getmenual($qryeyeclean, $parameyeclean);
                                    if (sizeof($reseyeclean) > 0) {
                                        $roweyeclean = $reseyeclean[0];
                                        $eyecleanid = $roweyeclean['id'];
                                    } else {
                                        $eyecleanid = $IISMethods->generateuuid();

                                        $insqryeyeclean['id'] = $eyecleanid;
                                        $insqryeyeclean['name'] = $eyeclean;
                                        $insqryeyeclean['isactive'] = 1;
                                        $insqryeyeclean['timestamp'] = $datetime;
                                        $insqryeyeclean['entry_uid'] = $uid;
                                        $insqryeyeclean['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tbleyecleanmaster', $insqryeyeclean, '');
                                    }
                                }
                                $milkyid = '';
                                if ($milky) {
                                    $qrymilky = "SELECT id FROM tblmilkymaster WHERE name=:milky";
                                    $parammilky = array(':milky' => $milky);
                                    $resmilky = $DB->getmenual($qrymilky, $parammilky);
                                    if (sizeof($resmilky) > 0) {
                                        $rowmilky = $resmilky[0];
                                        $milkyid = $rowmilky['id'];
                                    } else {
                                        $qrymax = "SELECT DISTINCT max(IFNULL(displayorder,0)) AS displayorder FROM tblmilkymaster";
                                        $maxparams = array();
                                        $resmax = $DB->getmenual($qrymax, $maxparams);
                                        $rowmax = $resmax[0];
                                        $maxdo = $rowmax['displayorder'] + 1;
                                        $milkyid = $IISMethods->generateuuid();

                                        $insqrymilky['id'] = $milkyid;
                                        $insqrymilky['name'] = $milky;
                                        $insqrymilky['isactive'] = 1;
                                        $insqrymilky['displayorder'] = $maxdo;
                                        $insqrymilky['timestamp'] = $datetime;
                                        $insqrymilky['entry_uid'] = $uid;
                                        $insqrymilky['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblmilkymaster', $insqrymilky, '');
                                    }
                                }

                                $roughdiamondsourceid = '';
                                if ($roughdiamondsource) {
                                    $qryroughdiamondsource = "SELECT id FROM tblroughdiamondsourcemaster WHERE name=:roughdiamondsource";
                                    $paramroughdiamondsource = array(':roughdiamondsource' => $roughdiamondsource);
                                    $resroughdiamondsource = $DB->getmenual($qryroughdiamondsource, $paramroughdiamondsource);
                                    if (sizeof($resroughdiamondsource) > 0) {
                                        $rowroughdiamondsource = $resroughdiamondsource[0];
                                        $roughdiamondsourceid = $rowroughdiamondsource['id'];
                                    } else {
                                        $roughdiamondsourceid = $IISMethods->generateuuid();

                                        $insqryroughdiamondsource['id'] = $roughdiamondsourceid;
                                        $insqryroughdiamondsource['name'] = $roughdiamondsource;
                                        $insqryroughdiamondsource['isactive'] = 1;
                                        $insqryroughdiamondsource['displayorder'] = 1;
                                        $insqryroughdiamondsource['timestamp'] = $datetime;
                                        $insqryroughdiamondsource['entry_uid'] = $uid;
                                        $insqryroughdiamondsource['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblroughdiamondsourcemaster', $insqryroughdiamondsource, '');
                                    }
                                }
                                $gridleconditionid = '';
                                if ($gridlecondition) {
                                    $qrygridlecondition = "SELECT id FROM tblgirdleconditionmaster WHERE name=:gridlecondition";
                                    $paramgridlecondition = array(':gridlecondition' => $gridlecondition);
                                    $resgridlecondition = $DB->getmenual($qrygridlecondition, $paramgridlecondition);
                                    if (sizeof($resgridlecondition) > 0) {
                                        $rowgridlecondition = $resgridlecondition[0];
                                        $gridleconditionid = $rowgridlecondition['id'];
                                    } else {
                                        $maxdoqry = "SELECT MAX(ifnull(displayorder,0)) AS maxdo FROM tblgirdleconditionmaster";
                                        $maxdoparams = array();
                                        $maxdores = $DB->getmenual($maxdoqry, $maxdoparams);
                                        $maxdorow = $maxdores[0];
                                        $maxdo = $maxdorow['maxdo'] + 1;
                                        $gridleconditionid = $IISMethods->generateuuid();

                                        $insqrygridlecondition['id'] = $gridleconditionid;
                                        $insqrygridlecondition['name'] = $gridlecondition;
                                        $insqrygridlecondition['isactive'] = 1;
                                        $insqrygridlecondition['displayorder'] = $maxdo;
                                        $insqrygridlecondition['timestamp'] = $datetime;
                                        $insqrygridlecondition['entry_uid'] = $uid;
                                        $insqrygridlecondition['entry_date'] = $datetime;
                                        $DB->executedata('i', 'tblgirdleconditionmaster', $insqrygridlecondition, '');
                                    }
                                }



                                // print_r($treatment);
                                $flttreatmentname = implode("','", explode(",", $treatment));
                                $fltkeytosymbolsname = implode("','", explode(",", $keytosymbols));
                                $fltovertonename = implode("','", explode(",", $overtone));
                                $fltopeninclusionsname = implode("','", explode(",", $openinclusions));
                                $fltblackinclusionsname = implode("','", explode(",", $blackinclusions));
                                $fltwhiteinclusionsname = implode("','", explode(",", $whiteinclusions));
                                if ($i == 1) {
                                    $qrydiamond = "SELECT id FROM tbldiamond WHERE personid=:personid";
                                    $paramdiamond = array(':personid' => $uid);
                                    $resdiamond = $DB->getmenual($qrydiamond, $paramdiamond);
                                    if (sizeof($resdiamond) > 0) {
                                        for ($dm = 0; $dm < sizeof($resdiamond); $dm++) {
                                            $rowdm = $resdiamond[$dm];
                                            $diamondid = $rowdm['id'];

                                            $params = array(
                                                'id' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamond', '', $params);
                                            $DB->userwisediamonjewelrylog(1, $uid);

                                            $keytosymbolparams = array(
                                                'diamondid' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                                            $overtoneparams = array(
                                                'diamondid' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                                            $openinclusionsparams = array(
                                                'diamondid' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                                            $blackinclusionsparams = array(
                                                'diamondid' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                                            $whiteinclusionsparams = array(
                                                'diamondid' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);
                                            $treatmentparams = array(
                                                'diamondid' => $diamondid
                                            );
                                            $DB->executedata('d', 'tbldiamondtreatment', '', $treatmentparams);
                                        }
                                    }
                                }


                                // QUERY GET DATA
                                $qrydata = "SELECT
                                IFNULL((SELECT name FROM tblavailabilitymaster WHERE id=:availabilityid),'') AS availability,
                                IFNULL((SELECT country FROM tblcountrymaster WHERE id=:countryid),'') AS country,
                                IFNULL((SELECT state FROM tblstatemaster WHERE id=:stateid),'') AS state,
                                IFNULL((SELECT name FROM tbldiamondshapemaster WHERE id=:shapeid),'') AS shape,
                                IFNULL((SELECT name FROM tblsizemaster WHERE id=:sizeid),'') AS size,
                                IFNULL((SELECT name FROM tbldiamondcolormaster WHERE id=:diamondcolorid),'') AS diamondcolor,
                                IFNULL((SELECT name FROM tblclaritymaster WHERE id=:clarityid),'') AS clarity,
                                IFNULL((SELECT name FROM tblcutmaster WHERE id=:cutid),'') AS cut,
                                IFNULL((SELECT name FROM tblpolishmaster WHERE id=:polishid),'') AS polish,
                                IFNULL((SELECT name FROM tblsymmetrymaster WHERE id=:symmetryid),'') AS symmetry,
                                IFNULL((SELECT name FROM tblintensitymaster WHERE id=:intensityid),'') AS intensity,
                                IFNULL((SELECT name FROM tblcolormaster WHERE id=:colorid),'') AS color,
                                IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:colorcodeid),'') AS colorcode,
                                IFNULL((SELECT name FROM tblgirdleconditionmaster WHERE id=:conditionid),'') AS conditions,
                                IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridleminid),'') AS gridlemin,
                                IFNULL((SELECT name FROM tblgridlemaster WHERE id=:gridlemaxid),'') AS gridlemax,
                                IFNULL((SELECT name FROM tblculetcondition WHERE id=:culetconditionid),'') AS culetcondition,
                                IFNULL((SELECT name FROM tblsizemaster WHERE id=:culetsizeid),'') AS culetsize,
                                IFNULL((SELECT group_concat(id) FROM tbltreatmentmaster WHERE name IN ('" . $flttreatmentname . "')),'') AS treatment,
                                IFNULL((SELECT name FROM tbllabmaster WHERE id=:labid),'') AS lab,
                                IFNULL((SELECT group_concat(id) FROM tblkeytosymbolmaster WHERE name IN ('" . $fltkeytosymbolsname . "')),'') AS keytosymbol,
                                IFNULL((SELECT name FROM tblfancyintensitymaster WHERE id=:fancyintensityid),'') AS fancyintensity,
                                IFNULL((SELECT group_concat(id) FROM tblovertonemaster WHERE name IN ('" . $fltovertonename . "')),'') AS overtone,
                                IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid1),'') AS fancycolor1,
                                IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid1),'') AS fancycolorcode1,
                                IFNULL((SELECT name FROM tblcolormaster WHERE id=:fancycolorid2),'') AS fancycolor2,
                                IFNULL((SELECT colorcode FROM tblcolormaster WHERE id=:fancycolorcodeid2),'') AS fancycolorcode2,
                                IFNULL((SELECT name FROM tbltradeshowmaster WHERE id=:tradeshowid),'') AS tradeshow,
                                IFNULL((SELECT title FROM tblbrandmaster WHERE id=:brandid),'') AS brand,
                                IFNULL((SELECT name FROM tblshademaster WHERE id=:shadeid),'') AS shade,
                                IFNULL((SELECT name FROM tbleyecleanmaster WHERE id=:eyecleanid),'') AS eyeclean,
                                IFNULL((SELECT name FROM tblmilkymaster WHERE id=:milkyid),'') AS milky,
                                IFNULL((SELECT group_concat(id) FROM tblopeninclusionmaster WHERE name IN ('" . $fltopeninclusionsname . "')),'') AS openinclusions,
                                IFNULL((SELECT group_concat(id) FROM tblblackinclusionmaster WHERE name IN ('" . $fltblackinclusionsname . "')),'') AS blackinclusions,
                                IFNULL((SELECT group_concat(id) FROM tblwhiteinclusionmaster WHERE name IN ('" . $fltwhiteinclusionsname . "')),'') AS whiteinclusions,
                                IFNULL((SELECT name FROM tblroughdiamondsourcemaster WHERE id=:roughdiamondsourceid),'') AS roughdiamondsource,
                                IFNULL((SELECT personname FROM tblpersonmaster WHERE id=:personid),'') AS personname,
                                IFNULL((SELECT name FROM tblsievemaster WHERE id=:sieveid),'') AS sievename";
                                $paramdata = array(
                                    ':availabilityid' => $availabilityid,
                                    ':countryid' => $countryid,
                                    ':stateid' => $stateid,
                                    ':shapeid' => $shapeid,
                                    ':sizeid' => $sizeid,
                                    ':diamondcolorid' => $colorid,
                                    ':clarityid' => $clarityid,
                                    ':cutid' => $cutid,
                                    ':polishid' => $polishid,
                                    ':symmetryid' => $symmetryid,
                                    ':intensityid' => $intensityid,
                                    ':colorid' => $fluorescenecolorid,
                                    ':colorcodeid' => $fluorescenecolorid,
                                    ':conditionid' => $gridleconditionid,
                                    ':gridleminid' => $gridleminid,
                                    ':gridlemaxid' => $gridlemaxid,
                                    ':culetconditionid' => $culetconditionid,
                                    ':culetsizeid' => $culetsizeid,
                                    ':labid' => $labid,
                                    ':fancyintensityid' => $fancyintensityid,
                                    ':fancycolorid1' => $fancycolorid1,
                                    ':fancycolorcodeid1' => $fancycolorid1,
                                    ':fancycolorid2' => $fancycolorid2,
                                    ':fancycolorcodeid2' => $fancycolorid2,
                                    ':tradeshowid' => $tradeshowid,
                                    ':brandid' => $brandid,
                                    ':shadeid' => $shadeid,
                                    ':eyecleanid' => $eyecleanid,
                                    ':milkyid' => $milkyid,
                                    ':roughdiamondsourceid' => $roughdiamondsourceid,
                                    ':personid' => $uid,
                                    ':sieveid' => $sieveid,
                                );
                                //  print_r($paramdata);

                                $resdata = $DB->getmenual($qrydata, $paramdata);
                                $rowdata = $resdata[0];
                                //  print_r($rowdata);

                                $insqry = array(
                                    'personid' => $uid,
                                    'personname' => $rowdata['personname'],
                                    'stock' => $stock,
                                    'price' => $price,
                                    'totalprice' => $totalpriceafterdiscount,
                                    'ispricectsavani' => $ispricectsavani,
                                    'availabilityid' => $availabilityid,
                                    'availability' => $rowdata['availability'],
                                    'countryid' => $countryid,
                                    'country' => $rowdata['country'],
                                    'stateid' => $stateid,
                                    'state' => $rowdata['state'],
                                    'city' => $city,
                                    'shapeid' => $shapeid,
                                    'shape' => $rowdata['shape'],
                                    'sizeid' => $sizeid,
                                    'size' => $rowdata['size'],
                                    'colorid' => $colorid,
                                    'color' => $rowdata['diamondcolor'],
                                    'clarityid' => $clarityid,
                                    'clarity' => $rowdata['clarity'],
                                    'cutid' => $cutid,
                                    'cut' => $rowdata['cut'],
                                    'polishid' => $polishid,
                                    'polish' => $rowdata['polish'],
                                    'symmetryid' => $symmetryid,
                                    'symmetry' => $rowdata['symmetry'],
                                    'intensityid' => $intensityid,
                                    'intensity' => $rowdata['intensity'],
                                    'fluorescenecolorid' => $fluorescenecolorid,
                                    'fluorescenecolor' => $rowdata['color'],
                                    'fluorescenecolorcode' => $rowdata['colorcode'],
                                    'length' => $length,
                                    'width' => $width,
                                    'depth' => $depth,
                                    'depthper' => $depthper,
                                    'tableper' => $tableper,
                                    'crownangle' => $crownangle,
                                    'crownheight' => $crownheight,
                                    'pavilionangle' => $pavilionangle,
                                    'pavilionheight' => $pavilionheight,
                                    'gridleconditionid' => $gridleconditionid,
                                    'gridlecondition' => $rowdata['conditions'],
                                    'gridleminid' => $gridleminid,
                                    'gridlemin' => $rowdata['gridlemin'],
                                    'gridlemaxid' => $gridlemaxid,
                                    'gridlemax' => $rowdata['gridlemax'],
                                    'gridleper' => $gridleper,
                                    'culetconditionid' => $culetconditionid,
                                    'culetcondition' => $rowdata['culetcondition'],
                                    'culetsizeid' => $culetsizeid,
                                    'culetsize' => $rowdata['culetsize'],
                                    'treatmentid' => $rowdata['treatment'],
                                    'treatment' => $treatment,
                                    'laserinscription' => $laserinscription,
                                    'starlength' => $starlength,
                                    'labid' => $labid,
                                    'lab' => $rowdata['lab'],
                                    'reportnumber' => $reportnumber,
                                    'showonsavanigems' => $showonsavanigems,
                                    'reportdate' => $reportdate,
                                    'lablocation' => $lablocation,
                                    'reportcomment' => $reportcomment,
                                    'keytosymbolsid' => $rowdata['keytosymbol'],
                                    'keytosymbols' => $keytosymbols,
                                    'fancyintensityid' => $fancyintensityid,
                                    'fancyintensity' => $rowdata['fancyintensity'],
                                    'overtoneid' => $rowdata['overtone'],
                                    'overtone' => $overtone,
                                    'fancycolorid1' => $fancycolorid1,
                                    'fancycolor1' => $rowdata['fancycolor1'],
                                    'fancycolorcode1' => $rowdata['fancycolorcode1'],
                                    'fancycolorid2' => $fancycolorid2,
                                    'fancycolor2' => $rowdata['fancycolor2'],
                                    'fancycolorcode2' => $rowdata['fancycolorcode2'],
                                    'matchedpair' => $matchedpair,
                                    'stocknumber' => $stocknumber,
                                    'ispairseparable' => $ispairseparable,
                                    'isdownload' => $isdownload,
                                    'tradeshowid' => $tradeshowid,
                                    'tradeshow' => $rowdata['tradeshow'],
                                    'brandid' => $brandid,
                                    'brand' => $rowdata['brand'],
                                    'suppliercomment' => $suppliercomment,
                                    'isparcel' => $isparcel,
                                    'numofdiamond' => $numofdiamond,
                                    'sarineloupe' => $sarineloupe,
                                    'sellerspecification' => $sellerspecification,
                                    'shadeid' => $shadeid,
                                    'shade' => $rowdata['shade'],
                                    'eyecleanid' => $eyecleanid,
                                    'eyeclean' => $rowdata['eyeclean'],
                                    'milkyid' => $milkyid,
                                    'milky' => $rowdata['milky'],
                                    'openinclusionsid' => $rowdata['openinclusions'],
                                    'openinclusions' => $openinclusions,
                                    'blackinclusionsid' => $rowdata['blackinclusions'],
                                    'blackinclusions' => $blackinclusions,
                                    'whiteinclusionsid' => $rowdata['whiteinclusions'],
                                    'whiteinclusions' => $whiteinclusions,
                                    'roughdiamondsourceid' => $roughdiamondsourceid,
                                    'roughdiamondsource' => $rowdata['roughdiamondsource'],
                                    'videolink' => $videolink,
                                    'sieveid' => $sieveid,
                                    'sievename' => $rowdata['sievename'],
                                    'piecepercarat' => $piecepercarat,
                                    'savanipercentage' => $savanipercentage,
                                    'iscsvupload' => 1
                                );

                                $typename = 'diamond';
                                $qryseries = "SELECT * FROM tblseriesmaster WHERE typename=:typename ORDER BY timestamp DESC LIMIT 1";
                                $seriesparams = array(
                                    ':typename' => $typename,
                                );
                                $result_ary = $DB->getmenual($qryseries, $seriesparams);
                                $rowseries = $result_ary[0];

                                $seriesid = $rowseries['id'];
                                $seriesno = $DB->getorderno($seriesid, 'diamond', $currdate);
                                $maxid = $DB->getmaxid($seriesid, 'diamond');
                                $totaldiamondupload=$DB->getTotalDiamond($LoginInfo->getUid())+$totalpriceafterdiscount;
                                if($CanMembernolimitdiamond==1 || $totaldiamondupload<=$CanMemberlimitdiamond)
                                {
                                    if ($seriesid) 
                                    {
                                        try {
                                            $DB->begintransaction();


                                            $diamondid = $IISMethods->generateuuid();

                                            $containreportfileorlink = 0;
                                            if ($reportfilelink) {
                                                $containreportfileorlink = 2;
                                            }

                                            $containdiamondimgorlink = 0;
                                            if ($diamondimglink) {
                                                $containdiamondimgorlink = 2;
                                            }



                                            $insqry['id'] = $diamondid;
                                            $insqry['savanilotnumber'] = $seriesno;
                                            $insqry['diamondimglink'] = $diamondimglink;
                                            $insqry['containdiamondimgorlink'] = $containdiamondimgorlink;
                                            $insqry['containreportfileorlink'] = $containreportfileorlink;
                                            $insqry['reportfilelink'] = $reportfilelink;
                                            $insqry['isactive'] = 1;
                                            $insqry['maxid'] = $maxid;
                                            $insqry['seriesid'] = $seriesid;
                                            $insqry['timestamp'] = $datetime;
                                            $insqry['entry_uid'] = $uid;
                                            $insqry['entry_date'] = $datetime;

                                            // print_r($insqry);exit;
                                            $DB->executedata('i', 'tbldiamond', $insqry, '');

                                            $DB->userwisediamonjewelrylog(1, $uid);


                                            if (sizeof($flttreatment) > 0) {
                                                for ($t = 0; $t < sizeof($flttreatment); $t++) {
                                                    $qrytreatment = "SELECT id from tbltreatmentmaster where name=:id";
                                                    $parmstreatment = array(
                                                        ':id' => $flttreatment[$t],
                                                    );
                                                    $result_treatment = $DB->getmenual($qrytreatment, $parmstreatment);
                                                    $mtreatmentid = $IISMethods->generateuuid();
                                                    $inspertreatment = array(
                                                        'id' => $mtreatmentid,
                                                        'diamondid' => $diamondid,
                                                        'treatmentid' => $result_treatment[0]['id'],
                                                        'treatment' => $flttreatment[$t],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondtreatment', $inspertreatment, '');
                                                }
                                            }
                                            if (sizeof($fltkeytosymbols) > 0) {
                                                for ($k = 0; $k < sizeof($fltkeytosymbols); $k++) {
                                                    $qrykeytosymbol = "SELECT id from tblkeytosymbolmaster where name=:id";
                                                    $parmskeytosymbol = array(
                                                        ':id' => $fltkeytosymbols[$k],
                                                    );
                                                    $result_keytosymbol = $DB->getmenual($qrykeytosymbol, $parmskeytosymbol);
                                                    $mkeytosymbolsid = $IISMethods->generateuuid();
                                                    $insperkeytosymbol = array(
                                                        'id' => $mkeytosymbolsid,
                                                        'diamondid' => $diamondid,
                                                        'keytosymbolsid' => $result_keytosymbol[0]['id'],
                                                        'keytosymbols' => $fltkeytosymbols[$k],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondkeytosymbol', $insperkeytosymbol, '');
                                                }
                                            }
                                            if (sizeof($fltovertone) > 0) {
                                                for ($o = 0; $o < sizeof($fltovertone); $o++) {
                                                    $qryovertone = "SELECT id from tblovertonemaster where name=:id";
                                                    $parmsovertone = array(
                                                        ':id' => $fltovertone[$o],
                                                    );
                                                    $result_overtone = $DB->getmenual($qryovertone, $parmsovertone);
                                                    $movertoneid = $IISMethods->generateuuid();
                                                    $insperovertone = array(
                                                        'id' => $movertoneid,
                                                        'diamondid' => $diamondid,
                                                        'overtoneid' => $result_overtone[0]['id'],
                                                        'overtone' => $fltovertone[$o],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondovertone', $insperovertone, '');
                                                }
                                            }

                                            if (sizeof($fltopeninclusions) > 0) {
                                                for ($op = 0; $op < sizeof($fltopeninclusions); $op++) {
                                                    $qryopeninclusion = "SELECT id from tblopeninclusionmaster where name=:id";
                                                    $parmsopeninclusion = array(
                                                        ':id' => $fltopeninclusions[$op],
                                                    );
                                                    $result_openinclusion = $DB->getmenual($qryopeninclusion, $parmsopeninclusion);

                                                    $mopeninclusionsid = $IISMethods->generateuuid();
                                                    $insperopeninclusion = array(
                                                        'id' => $mopeninclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'openinclusionsid' => $result_openinclusion[0]['id'],
                                                        'openinclusions' => $fltopeninclusions[$op],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondopeninclusions', $insperopeninclusion, '');
                                                }
                                            }

                                            if (sizeof($fltblackinclusions) > 0) {
                                                for ($bi = 0; $bi < sizeof($fltblackinclusions); $bi++) {
                                                    $qryblackinclusion = "SELECT id from tblblackinclusionmaster where name=:id";
                                                    $parmsblackinclusion = array(
                                                        ':id' => $fltblackinclusions[$bi],
                                                    );
                                                    $result_blackinclusion = $DB->getmenual($qryblackinclusion, $parmsblackinclusion);

                                                    $mblackinclusionsid = $IISMethods->generateuuid();
                                                    $insperblackinclusion = array(
                                                        'id' => $mblackinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'blackinclusionsid' => $result_blackinclusion[0]['id'],
                                                        'blackinclusions' => $fltblackinclusions[$bi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondblackinclusions', $insperblackinclusion, '');
                                                }
                                            }

                                            if (sizeof($fltwhiteinclusions) > 0) {
                                                for ($wi = 0; $wi < sizeof($fltwhiteinclusions); $wi++) {
                                                    $qrywhiteinclusion = "SELECT id from tblwhiteinclusionmaster where name=:id";
                                                    $parmswhiteinclusion = array(
                                                        ':id' => $fltwhiteinclusions[$wi],
                                                    );
                                                    $result_whiteinclusion = $DB->getmenual($qrywhiteinclusion, $parmswhiteinclusion);

                                                    $mwhiteinclusionsid = $IISMethods->generateuuid();
                                                    $insperwhiteinclusion = array(
                                                        'id' => $mwhiteinclusionsid,
                                                        'diamondid' => $diamondid,
                                                        'whiteinclusionsid' => $result_whiteinclusion[0]['id'],
                                                        'whiteinclusions' => $fltwhiteinclusions[$wi],
                                                        'entry_uid' => $uid,
                                                        'entry_date' => $datetime,
                                                        'timestamp' => $datetime,
                                                    );
                                                    $DB->executedata('i', 'tbldiamondwhiteinclusions', $insperwhiteinclusion, '');
                                                }
                                            }
                                            $i++;
                                            $cnt_ins++;
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
                                }else{
                                    $status = 0;
                                    $message = $errmsg['diamondlimitover'];
                                    $i++;
                                    $cnt_ins++;
                                }
                            } else {
                                $response['errordata'][$j]['no'] = $IISMethods->sanitize($row);
                                $response['errordata'][$j]['stock'] = $IISMethods->sanitize($stock);
                                $response['errordata'][$j]['price'] = $IISMethods->sanitize($price);
                                $response['errordata'][$j]['shape'] = $IISMethods->sanitize($shape);
                                $response['errordata'][$j]['size'] = $IISMethods->sanitize($size);
                                $response['errordata'][$j]['color'] = $IISMethods->sanitize($color);
                                $response['errordata'][$j]['clarity'] = $IISMethods->sanitize($clarity);
                                $cnt_err++;

                                $j++;
                            }
                        }

                        // $response['cnt_upddata']=(int)$cnt_upd;
                        $response['cnt_insdata'] = (int)$cnt_ins;
                        $response['cnt_errordata'] = (int)$cnt_err;
                        if($cnt_ins>0){
                            $updqry=array(
                                'isuploaded'=>1,
                                'update_date'=>$datetime,
                            );
                            $params = array(
                                'id' => $logunqid
                            );
                            $DB->executedata('u', 'tblexcelfileslog',$updqry,$params);
                        }
                        $status = 1;
                        $message = $errmsg['diamondinsert'];
                        // unlink($inputFileName);
                    } else {
                        $status = 0;
                        $message = $errmsg['filesel'];
                    }
                } else {
                    $message = $errmsg['permissionrequired'];
                }
            } else if ($action == 'deletediamond') {
                $id = $IISMethods->sanitize($_POST['id']);
                if ($CanListDiamondForList == 1) {
                    if ($id && $uid) {
                        $qrydiamond = "SELECT id FROM tbldiamond WHERE personid=:personid AND id=:id";
                        $paramdiamond = array(':personid' => $uid, ':id' => $id);
                        $resdiamond = $DB->getmenual($qrydiamond, $paramdiamond);

                        if (sizeof($resdiamond) > 0) {
                            try {
                                $DB->begintransaction();
                                $rowdm = $resdiamond[0];
                                $diamondid = $rowdm['id'];

                                $params = array(
                                    'id' => $diamondid
                                );
                                $DB->executedata('d', 'tbldiamond', '', $params);

                                $DB->userwisediamonjewelrylog(1, $uid);

                                $keytosymbolparams = array(
                                    'diamondid' => $diamondid
                                );
                                $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                                $overtoneparams = array(
                                    'diamondid' => $diamondid
                                );
                                $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                                $openinclusionsparams = array(
                                    'diamondid' => $diamondid
                                );
                                $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                                $blackinclusionsparams = array(
                                    'diamondid' => $diamondid
                                );
                                $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                                $whiteinclusionsparams = array(
                                    'diamondid' => $diamondid
                                );
                                $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);

                                $status = 1;
                                $message = $errmsg['diamonddelete'];
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
            } else if ($action == 'insertuniversalprice') {
                $title = $IISMethods->sanitize($_POST['title']);
                $fromdate = $IISMethods->sanitize($_POST['fromdate']);
                $todate = $IISMethods->sanitize($_POST['todate']);
                $pricefile = $_FILES['pricefile']['name'];

                $formevent = $IISMethods->sanitize($_POST['formevent']);
                $id = $IISMethods->sanitize($_POST['id']);
                $datetime = $IISMethods->getdatetime();
                if ($title && $fromdate && $todate && ($pricefile || $formevent == 'update')) {
                    $FileType = strtolower(pathinfo($pricefile, PATHINFO_EXTENSION));

                    if ($FileType == 'jpg'  || $FileType == 'jpeg' || $FileType == 'png' || $FileType == 'pdf') {
                        if ($formevent == 'submit') {
                            $qrydup = "SELECT id 
                                    FROM tbldiamonduniversalprice  
                                    WHERE  ((((STR_TO_DATE(:fromdate,'%d/%m/%Y')>=STR_TO_DATE(fromdate,'%d/%m/%Y') AND STR_TO_DATE(:fromdate,'%d/%m/%Y')<=STR_TO_DATE(todate,'%d/%m/%Y'))) 
                                    OR (STR_TO_DATE(fromdate,'%d/%m/%Y')>=STR_TO_DATE(:fromdate,'%d/%m/%Y') AND STR_TO_DATE(fromdate,'%d/%m/%Y')<=STR_TO_DATE(:todate,'%d/%m/%Y'))))";
                            $paramdup = array(':fromdate' => $fromdate, ':todate' => $todate);

                            $resdup = $DB->getmenual($qrydup, $paramdup);
                            if (sizeof($resdup) > 0) {
                                $message = $errmsg['diamondupriceexist'];
                            } else {
                                try {
                                    $DB->begintransaction();
                                    $diamondid = $IISMethods->generateuuid();

                                    $sourcePath1 = $_FILES['pricefile']['tmp_name'];
                                    $uimagePath1 = $IISMethods->uploadallfiles(0, 'diamondpricefile', $pricefile, $sourcePath1, $diamondid);
                                    $FileTypetext = strtolower(pathinfo($pricefile, PATHINFO_EXTENSION));

                                    $insqry['id'] = $diamondid;
                                    $insqry['personid'] = $uid;
                                    $insqry['title'] = $title;
                                    $insqry['fromdate'] = $fromdate;
                                    $insqry['todate'] = $todate;
                                    $insqry['pricefile'] = $uimagePath1;
                                    $insqry['filetype'] = $FileTypetext;
                                    $insqry['timestamp'] = $datetime;
                                    $insqry['entry_uid'] = $uid;
                                    $insqry['entry_date'] = $datetime;
                                    $DB->executedata('i', 'tbldiamonduniversalprice', $insqry, '');

                                    $status = 1;
                                    $message = $errmsg['diamondupriceinsert'];
                                    $DB->committransaction();
                                } catch (Exception $e) {
                                    $DB->rollbacktransaction($e);
                                    $status = 0;
                                    $message = $errmsg['dbtransactionerror'];
                                }
                            }
                        } else if ($formevent == 'update') {
                            $diamondid = $id;

                            $qrydup = "SELECT id 
                                    FROM tbldiamonduniversalprice  
                                    WHERE id<>:id AND ((((STR_TO_DATE(:fromdate,'%d/%m/%Y')>=STR_TO_DATE(fromdate,'%d/%m/%Y') AND STR_TO_DATE(:fromdate,'%d/%m/%Y')<=STR_TO_DATE(todate,'%d/%m/%Y'))) 
                                    OR (STR_TO_DATE(fromdate,'%d/%m/%Y')>=STR_TO_DATE(:fromdate,'%d/%m/%Y') AND STR_TO_DATE(fromdate,'%d/%m/%Y')<=STR_TO_DATE(:todate,'%d/%m/%Y'))))";
                            $paramdup = array(':fromdate' => $fromdate, ':todate' => $todate, ':id' => $diamondid);

                            $resdup = $DB->getmenual($qrydup, $paramdup);
                            if (sizeof($resdup) > 0) {
                                $message = $errmsg['diamondupriceexist'];
                            } else {
                                try {
                                    $DB->begintransaction();


                                    $qry = "SELECT pricefile FROM tbldiamonduniversalprice WHERE id=:id";
                                    $param = array(':id' => $diamondid);
                                    $res = $DB->getmenual($qry, $param);
                                    $row = $res[0];

                                    if ($pricefile) {
                                        unlink($row['pricefile']);
                                        $sourcePath1 = $_FILES['pricefile']['tmp_name'];
                                        $uimagePath1 = $IISMethods->uploadallfiles(0, 'diamondpricefile', $pricefile, $sourcePath1, $diamondid);
                                        $FileTypetext = strtolower(pathinfo($pricefile, PATHINFO_EXTENSION));
                                    } else {
                                        $uimagePath1 = $row['pricefile'];
                                        $FileTypetext = $row['filetype'];
                                    }


                                    $insqry['id'] = $diamondid;
                                    $insqry['personid'] = $uid;
                                    $insqry['title'] = $title;
                                    $insqry['fromdate'] = $fromdate;
                                    $insqry['todate'] = $todate;
                                    $insqry['pricefile'] = $uimagePath1;
                                    $insqry['filetype'] = $FileTypetext;
                                    $insqry['timestamp'] = $datetime;
                                    $insqry['update_uid'] = $uid;
                                    $insqry['update_date'] = $datetime;
                                    $ary = array(
                                        'id' => $diamondid,
                                    );
                                    $DB->executedata('u', 'tbldiamonduniversalprice', $insqry, $ary);

                                    $status = 1;
                                    $message = $errmsg['diamondupriceupdate'];

                                    $DB->committransaction();
                                } catch (Exception $e) {
                                    $DB->rollbacktransaction($e);
                                    $status = 0;
                                    $message = $errmsg['dbtransactionerror'];
                                }
                            }
                        }
                    } else {
                        $message = $errmsg['invalidfile'];
                    }
                } else {
                    $message = $errmsg['required'];
                }
            } else if ($action == 'listuniversalprice') {
                $currdate = $IISMethods->getcurrdate();
                $managemyuniversalprice = $IISMethods->sanitize($_POST['managemyuniversalprice']);
                $listuniversalprice = new listuniversalprice();
                $query_main = "SELECT dp.`id`,dp.`personid`,dp.`title`,dp.`fromdate`,dp.`todate`,dp.`pricefile`,dp.`filetype`,dp.`entry_uid`,dp.`entry_date`,dp.`update_uid`,dp.`update_date`,dp.`timestamp` 
                        FROM `tbldiamonduniversalprice` dp
                        WHERE 1=1";
                $param = array();
                if ($managemyuniversalprice == 1) {
                    $query_main .= " AND dp.personid=:personid";
                    $param[':personid'] = $uid;
                } else {
                    $query_main .= " AND (STR_TO_DATE('" . $currdate . "','%d/%m/%Y')  BETWEEN  STR_TO_DATE(dp.`fromdate`,'%d/%m/%Y') AND STR_TO_DATE(dp.`todate`,'%d/%m/%Y'))";
                    $param[':currdate'] = $currdate;
                }

                $query_extra .= " ORDER BY dp.timestamp desc";
                $query_extra .= " LIMIT $start, $per_page";
                $query = $query_main . $query_extra;

                $result_ary = $DB->getmenual($query, $param, 'listuniversalprice');
                if (sizeof($result_ary) > 0) {

                    $response['data'] = $result_ary;
                    for ($i = 0; $i < sizeof($result_ary); $i++) {
                        $ins_personid = $result_ary[$i]->getpersonid();
                        $persondetails = new persondetails();
                        $qryperson = "SELECT id,personname,email,companyname,address,additionaladdress,statename,cityname,pincode,emergencypersonname as refname1,emergencypersonname1 as refname2,countryname,businesstype,ifnull(businessphoneno,'') AS businessphoneno,ifnull(businesswebsite,'') AS businesswebsite,businesscompanyno,
                                    case when (ifnull(profileimg,'') = '') then :defualtuserimageurl else concat(:imageurl,profileimg) end as profileimg 
                                    FROM tblpersonmaster 
                                    WHERE id=:id";
                        $paramperson = array(':id' => $ins_personid, ':defualtuserimageurl' => $config->getDefualtUserImageurl(), ':imageurl' => $imageurl);
                        $resperson = $DB->getmenual($qryperson, $paramperson, 'persondetails');
                        if (sizeof($resperson) > 0) {
                            $result_ary[$i]->setpersondetail($resperson);
                        }
                    }
                    $status = 1;
                    $message = $errmsg['success'];
                } else {
                    $message = $errmsg['nodiamonduprice'];
                }
            } else if ($action == 'deleteuniversalprice') {
                $id = $IISMethods->sanitize($_POST['id']);
                if ($id && $uid) {
                    $qrydiamond = "SELECT id,pricefile FROM tbldiamonduniversalprice WHERE personid=:personid AND id=:id";
                    $paramdiamond = array(':personid' => $uid, ':id' => $id);
                    $resdiamond = $DB->getmenual($qrydiamond, $paramdiamond);

                    if (sizeof($resdiamond) > 0) {
                        try {
                            $DB->begintransaction();
                            $rowdm = $resdiamond[0];
                            $diamondid = $rowdm['id'];

                            unlink($rowdm['pricefile']);
                            $params = array(
                                'id' => $diamondid
                            );
                            $DB->executedata('d', 'tbldiamonduniversalprice', '', $params);

                            $status = 1;
                            $message = $errmsg['diamondupricedelete'];
                            $DB->committransaction();
                        } catch (Exception $e) {
                            $DB->rollbacktransaction($e);
                            $status = 0;
                            $message = $errmsg['dbtransactionerror'];
                        }
                    }
                }
            } else if ($action == 'deletereportfile') {
                $diamondid = trim($IISMethods->sanitize($_POST['diamondid']));

                if ($diamondid) {
                    $qrychk = "SELECT id,reportfile FROM tbldiamond WHERE id=:diamondid";
                    $params = array(
                        ':diamondid' => $diamondid,
                    );
                    $reschk = $DB->getmenual($qrychk, $params);

                    if (sizeof($reschk) > 0) {
                        $row = $reschk[0];
                        unlink('../../assets/' . $row['reportfile']);
                        $upddata1 = array(
                            'reportfile' => '',
                        );
                        $extraparams = array(
                            'id' => $diamondid
                        );
                        $DB->executedata('u', 'tbldiamond', $upddata1, $extraparams);
                        $DB->userwisediamonjewelrylog(1, $uid);
                        $status = 1;
                        $message = "File deleted successfully";
                    } else {
                        $status = 0;
                        $message = "You have not permission to delete this message!";
                    }
                }
            } else if ($action == 'deletediamondmediaimage') {
                $diamondid = trim($IISMethods->sanitize($_POST['diamondid']));
                $id = trim($IISMethods->sanitize($_POST['id']));
                if ($CanListDiamondForList == 1) {
                    if ($diamondid && $id) {
                        $qrychk = "SELECT id,image FROM tbldiamondimages WHERE id=:id AND diamondid=:diamondid";
                        $params = array(
                            ':diamondid' => $diamondid,
                            ':id' => $id,
                        );
                        $reschk = $DB->getmenual($qrychk, $params);

                        if (sizeof($reschk) > 0) {
                            $row = $reschk[0];
                            unlink('../../assets/' . $row['image']);

                            $extraparams = array(
                                'id' => $id
                            );
                            $DB->executedata('d', 'tbldiamondimages', '', $extraparams);

                            $qry = "SELECT id,diamondid,image FROM tbldiamondimages WHERE diamondid=:diamondid";
                            $params = array(':diamondid' => $diamondid);
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
            } else if ($action == 'diamondlastupdateddatechange') {
                $id = trim($IISMethods->sanitize($_POST['id']));

                if ($id) {
                    $qrychk = "SELECT id FROM tbldiamond WHERE isactive=1 AND entry_uid=:uid order by entry_date desc LIMIT 1 ";
                    $params = array(
                        ':uid' => $uid,
                    );
                    $reschk = $DB->getmenual($qrychk, $params);

                    if (sizeof($reschk) > 0) {
                        $DB->userwisediamonjewelrylog(1, $uid);
                        $row = $reschk[0];
                        $data = array(
                            'update_date' => $IISMethods->getdatetime()
                        );
                        $extraparams = array(
                            'id' => $row['id']
                        );
                        $DB->executedata('u', 'tbldiamond', $data, $extraparams);
                        $status = 1;
                        $message = "Last Updated Date Update Successfully";
                    } else {
                        $qrychk = "SELECT id FROM tbldiamond WHERE entry_uid=:uid  ";
                        $params = array(
                            ':uid' => $uid,
                        );
                        $reschk = $DB->getmenual($qrychk, $params);
                        if (sizeof($reschk) > 0) {
                            $DB->userwisediamonjewelrylog(1, $uid);
                            $data = array(
                                'update_date' => $IISMethods->getdatetime(),
                                'update_uid' => $uid,
                                'isactive' => 1,
                            );
                            $extraparams = array(
                                'uid' => $uid
                            );
                            $DB->executedata('u', 'tbldiamond', $data, $extraparams);
                            $status = 1;
                            $message = "Last Updated Date Update Successfully";
                        } else {
                            $status = 0;
                            $message = "No Diamond Found!";
                        }
                    }
                }
            } else if ($action == 'deletemydiamond') {
                $bulkid = $_POST['bulkid'];
                $bulk = explode(",", $bulkid);
                if (sizeof($bulk) > 0) {
                    $usemenu = '';
                    for ($i = 0; $i < sizeof($bulk); $i++) {
                        $diamondid = $bulk[$i];
                        $params = array(
                            'id' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamond', '', $params);
                        $DB->userwisediamonjewelrylog(1, $uid);

                        $keytosymbolparams = array(
                            'diamondid' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamondkeytosymbol', '', $keytosymbolparams);

                        $overtoneparams = array(
                            'diamondid' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamondovertone', '', $overtoneparams);

                        $openinclusionsparams = array(
                            'diamondid' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamondopeninclusions', '', $openinclusionsparams);

                        $blackinclusionsparams = array(
                            'diamondid' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamondblackinclusions', '', $blackinclusionsparams);

                        $whiteinclusionsparams = array(
                            'diamondid' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamondwhiteinclusions', '', $whiteinclusionsparams);

                        $treatmentparams = array(
                            'diamondid' => $diamondid
                        );
                        $DB->executedata('d', 'tbldiamondtreatment', '', $treatmentparams);
                    }
                    $status = 1;
                    $message = $errmsg['delete'];
                } else {
                    $status = 0;
                    $message = $errmsg['reqired'];
                }
            }
        }
    }else{
        $status=-1;
        $message="Device Logout";
    }
}
require_once dirname(__DIR__, 2) . '/config/apifoot.php';
