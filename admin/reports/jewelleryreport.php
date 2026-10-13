<?php 
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';



$typeid=$IISMethods->sanitize($_POST['typeid']);
$customerid=$IISMethods->sanitize($_POST['customerid']);
$startdate=$IISMethods->sanitize($_POST['fromdate']);
$enddate=$IISMethods->sanitize($_POST['todate']);
$isdetails=$_POST['isdetails'];

$qryperson = " SELECT pm.id,pm.personname,j.personid FROM tblpersonmaster pm
                INNER JOIN `tbljewellery` j ON j.personid = pm.id
                GROUP BY pm.id";
$resperson = $DB->getmenual($qryperson);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>Jewellery Report</title>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <?php require_once '../css.php'; ?>
        
        <!-- END GLOBAL MANDATORY STYLES -->
    </head>
    <body class="alt-menu reportdata">
        
        <?php //require_once '../header.php'; ?>
        <div class="main-container sidebar-closed sbar-open" id="container">
            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content" style="margin-left: 10px;margin-right: 10px; margin-top: 5px;">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top: 20px; margin-bottom: 15px;">
                        <input style="float: right" type="button" type="button" style="padding: 5px;" class="printbutton btn btn-warning" onclick="printDiv('mainReportDiv')" value="Print Report"/>
                    </div>
                </div>
                <div class="widget" id="mainReportDiv">
                    <div class="widget-control">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-theme-table-header text-center mb-2">
                                <h5 class="m-0 menunamelbl"><b>Jewellery Report</b></h5>
                                <?php
                                if($startdate && $enddate)
                                {
                                ?>
                                    <p><?php echo $startdate.' To '.$enddate; ?></p>   
                                <?php
                                }
                                ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row min-height-100">
                            <div class="col-12 min-height-100">
                                <div class="table-responsive main-grid">
                                    
                                    <?php
                                    if(sizeof($resperson) > 0)
                                    {
                                        for($j=0;$j<sizeof($resperson);$j++)
                                        {
                                                $rowperson=$resperson[$j];
                                                $personid = $rowperson['id'];
                                                $imageurl = $config->getImageurl();
                                                $CheckUserRights = $DB->checkpackagewiseuserright($uid);
                                                
                                                $qry_main = "SELECT `j`.`id`,`j`.`jewelleryno`,`j`.`personid`,`j`.`personname`,`j`.`itemtitle`,`j`.`stock`,`j`.`isavailable`,
                                                            `j`.`isavailableformemo`,`j`.`description`,`j`.`iteminstock`,`j`.`minimumorder`,`j`.`jewellerytypeid`,`j`.`jewellerytype`,`j`.`typestyleid`,
                                                            `j`.`typestyle`,`j`.`jewellerycategoryid`,`j`.`jewellerycategory`,`j`.`conditionid`,`j`.`conditionname`,`j`.`brandid`,`j`.`brand`,`j`.`jewelleryqualityid`,
                                                            `j`.`jewelleryquality`,`j`.`designername`,`j`.`keyworddescription`,`j`.`metaltypeid`,`j`.`metaltype`,`j`.`metalkaratid`,`j`.`metalkarat`,
                                                            `j`.`jewellerytotalweight`,`j`.`suppliercomment`,`j`.`size`,`j`.`ringsize`,`j`.`unpublished`,`j`.`sharable`,`j`.`ownstockinventory`,
                                                            `j`.`entry_uid`,`j`.`entry_date`,`j`.`update_uid`,`j`.`update_date`,`j`.`timestamp`,`j`.`maxid`,`j`.`seriesid`,`j`.`isactive`,`j`.`minprice`,`j`.`maxprice`,ifnull(`j`.`jewelleryimglink`,'') AS jewelleryimglink,ifnull(`j`.`jewelleryvideolink`,'') AS jewelleryvideolink,
                                                            pm.cityname,pm.statename,pm.countryname,jtm.isringsize,jpl.price,jpl.`shippingfrom`,jpl.`price`,jpl.`termsid`,jpl.`terms`,jpl.`msrp`,jpl.`deliverytimeindays`,
                                                            IFNULL((SELECT CONCAT(:imgurl,image) FROM tbljewelleryimages ji WHERE ji.jewelleryid=j.id ORDER BY ji.timestamp DESC LIMIT 1),case when(ifnull(`j`.`jewelleryimglink`,'')<>'') THEN `j`.`jewelleryimglink` ELSE :defaultjewelleryimgurl END) AS imgurl,
                                                            IFNULL((SELECT CONCAT(:imgurl,video) FROM tbljewelleryimages ji WHERE ji.jewelleryid=j.id ORDER BY ji.timestamp DESC LIMIT 1),case when(ifnull(`j`.`jewelleryvideolink`,'')<>'') THEN `j`.`jewelleryvideolink` ELSE :defaultjewelleryimgurl END) AS videourl,
                                                            
                                                            IFNULL((SELECT COUNT(jf.id) FROM tbljewelleryfavorite jf WHERE jf.jewelleryid=j.id AND jf.personid=:personid),0) AS ismyfavoriteitem,
                                                            CASE WHEN(j.personid<>'" . $uid . "') THEN 1 ELSE 0 END AS canresponse
                                                            FROM `tbljewellery` `j`
                                                            inner join tblpersonmaster pm on pm.id=j.personid
                                                            inner join tbljewelrytypemaster jtm on jtm.id = j.jewellerytypeid
                                                            inner join `tbljewellerypricelocation` jpl ON jpl.jewelleryid = j.id
                                                            WHERE 1=1 AND j.`personid` LIKE '$personid'";
                                                
                                               
                                                $parms = array(':imgurl' => $imageurl, ':defaultjewelleryimgurl' => $config->getDefualtJewelleryImageurl(), ':personid' => $uid);

                                        
                                                if($startdate && $enddate)
                                                {
                                                    $qry_main.="  AND STR_TO_DATE(j.entry_date,'%Y-%m-%d') BETWEEN str_to_date('$startdate','%d/%m/%Y') AND str_to_date('$enddate','%d/%m/%Y') ";
                                                    // $parms[':fltstartdate']=$startdate;
                                                    // $parms[':fltenddate']=$enddate;
                                                }
                                                else if($startdate)
                                                {
                                                    $qry_main.= "  AND STR_TO_DATE(j.entry_date,'%Y-%m-%d') = str_to_date('$startdate','%d/%m/%Y')";
                                                }
                                              
                                                if($typeid && $typeid!='%')
                                                {
                                                    $qry_main.=" AND j.jewellerytypeid like :flttypeid ";
                                                    $parms[':flttypeid']=$typeid;
                                                }
                                                if($customerid && $customerid!='%')
                                                {
                                                    $qry_main.=" AND j.personid like :fltcustomerid ";
                                                    $parms[':fltcustomerid']=$customerid;
                                                }
                                                    
                                                $qry_main.=" GROUP BY j.id ORDER BY j.timestamp desc"; 
                                            //    echo $qry_main;
                                            //    print_r($parms);
                                                $rescant = $DB->getmenual($qry_main, $parms);
                                               
                                                if(sizeof($rescant) > 0)
                                                {
                                                    
                                                       
                                                        
                                                    ?>
                                                    <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                        <thead style="width: 100%;">
                                                            <tr>
                                                                <td colspan="10" style="font-size: 13px;text-align: left; background-color:#dff0d8" class="success" >Customer : <?php echo $rowperson['personname']; ?></td>
                                                            </tr>
                                                            <tr style="font-size: 13px ; background-color:#dff0d8">
                                                                
                                                                <th class="tbl-name text-center" style="width: 10%;">No</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Stock</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Item Title</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Jewellery Type</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Brand</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Price</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Item In Stock</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Minimum Order</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Condition</th>
                                                                <th class="tbl-name text-center" style="width: 10%;">Design Maker</th>
                                                            
                                                            </tr>
                                                        </thead>
                                                        <tbody id="datalist">
                                                            <?php
                                                            for($i=0;$i<sizeof($rescant);$i++)
                                                            {
                                                                $rowcant=$rescant[$i];
                                                            
                                                                ?>
                                                                <tr>
                                                                    <td class="tbl-name text-center" ><?php echo $i+1; ?></td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['stock'] ?></td>
                                                                    <td class="tbl-name text-left"><?php echo $rowcant['itemtitle'] ?></td>
                                                                    <td class="tbl-name text-left"><?php echo $rowcant['jewellerytype'] ?></td>
                                                                    <td class="tbl-name text-left"><?php echo $rowcant['brand'] ?></td>
                                                                    <td class="tbl-name text-right">$<?php echo $rowcant['price'] ?></td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['iteminstock'] ?></td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['minimumorder'] ?></td>
                                                                    <td class="tbl-name text-left"><?php echo $rowcant['conditionname'] ?></td>
                                                                    <td class="tbl-name text-left"><?php echo $rowcant['designername'] ?></td>
                                                                
                                                                </tr>
                                                                <?php
                                                                if($isdetails==1)
                                                                {
                                                                ?>
                                                                    <tr> 
                                                                        <td><b>Price & Location</b></td>
                                                                        <td colspan="9">
                                                                        <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                            <thead style="width: 100%;">
                                                                                <tr>
                                                                                    <th class="tbl-name text-center" style="width: 20%;">Shipping From</th>
                                                                                    <th class="tbl-name text-center" style="width: 20%;">Price Per Piece</th>
                                                                                    <th class="tbl-name text-center" style="width: 20%;">Terms</th>
                                                                                    <th class="tbl-name text-center" style="width: 20%;">Msrp</th>
                                                                                    <th class="tbl-name text-center" style="width: 20%;">Delivery Time</th>
                                                                            
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="datalist">
                                                                                <?php
                                                                                    ?>
                                                                                        <tr>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['shippingfrom'] ?></td>
                                                                                        <td class="tbl-name text-right">$<?php echo $rowcant['price'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['terms'] ?></td>
                                                                                        <td class="tbl-name text-right">$<?php echo $rowcant['msrp'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['deliverytimeindays'] ?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                ?>
                                                                            
                                                                            </tbody>
                                                                        </table>

                                                                        </td>
                                                                    </tr>

                                                                    <tr> 
                                                                        <td><b>Product Information</b></td>
                                                                        <td colspan="9">
                                                                        <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                            <thead style="width: 100%;">
                                                                                <tr>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Jewellery Type</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Type Style</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Jewellery Category</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Condition</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Brand</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Jewellery Quality</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Designer Maker</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="datalist">
                                                                                <?php
                                                                                    ?>
                                                                                        <tr>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['jewellerytype'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['typestyle'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['jewellerycategory'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['conditionname'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['brand'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['jewelleryquality'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['designername'] ?></td>
                                                                                    
                                                                                        </tr>
                                                                                    <?php
                                                                                ?>
                                                                            
                                                                            </tbody>
                                                                        </table>

                                                                        </td>
                                                                    </tr>

                                                                    <tr> 
                                                                        <td><b>Metal</b></td>
                                                                        <td colspan="9">
                                                                        <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                            <thead style="width: 100%;">
                                                                                <tr>
                                                                                    <th class="tbl-name text-center" style="width: 15%;">Metal Type</th>
                                                                                    <th class="tbl-name text-center" style="width: 15%;">Metal Karat</th>
                                                                                    <th class="tbl-name text-center" style="width: 15%;">Jewellery Total Weight</th>

                                                                            
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="datalist">
                                                                                <?php
                                                                                    ?>
                                                                                        <tr>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['metaltype'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['metalkarat'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['jewellerytotalweight'] ?></td>
                                                                                    
                                                                                    </tr>
                                                                                    <?php
                                                                                ?>
                                                                            
                                                                            </tbody>
                                                                        </table>

                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $jewel_id = $rowcant['id'];
                                                                    $qrygemstones = "SELECT jg.`id`,jg.`jewelleryid`,jg.`gemstonetypeid`,jg.`gemstonetype`,jg.shapeid,jg.shape,jg.caratweight,jg.labid,jg.lab,jg.labtext,jg.hastreatment,jg.treatmentid,jg.treatment,jg.stones,jg.savanilot,jg.savanilot,jg.`entry_uid`,jg.`entry_date`,jg.`timestamp` 
                                                                    FROM `tbljewellerygemstones` jg
                                                                    WHERE jg.`jewelleryid`=:jewelleryid";
                                                                    $paramgemstones = array(':jewelleryid' => $jewel_id);
                                                                    $resultgemstones = $DB->getmenual($qrygemstones, $paramgemstones);
                                                                    
                                                                    $rowgems=$resultgemstones[0];
                                                                
                                                                    ?>
                                                                    <tr> 
                                                                        <td><b>Gemstone</b></td>
                                                                        <td colspan="9">
                                                                        <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                            <thead style="width: 100%;">
                                                                                <tr>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Gemstone Type</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Shape</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Carat Weight</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Lab</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Lab#</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Treatment</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">#Stone</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="datalist">
                                                                                <?php
                                                                                    ?>
                                                                                        <tr>
                                                                                        <td class="tbl-name text-left"><?php echo $rowgems['gemstonetype'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowgems['shape'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowgems['caratweight'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowgems['lab'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowgems['labtext'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowgems['treatment'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $rowgems['stones'] ?></td>
                                                                                    
                                                                                        </tr>
                                                                                    <?php
                                                                                ?>
                                                                            
                                                                            </tbody>
                                                                        </table>

                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    $isavailabletext = 'No';
                                                                    if ($rowcant['isavailable'] == 1) {
                                                                        $isavailabletext = 'Yes';
                                                                    }
                                                                    $isavailableformemotext = 'No';
                                                                    if ($rowcant['isavailableformemo'] == 1) {
                                                                        $isavailableformemotext = 'Yes';
                                                                    }
                                                                    $unpublishedtext = 'No';
                                                                    if ($rowcant['unpublished'] == 1) {
                                                                        $unpublishedtext = 'Yes';
                                                                    }
                                                                    ?>
                                                                    <tr> 
                                                                        <td><b>Availability & Measurements</b></td>
                                                                        <td colspan="9">
                                                                        <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                            <thead style="width: 100%;">
                                                                                <tr>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Available</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Memo</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Stock#</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">In Stock</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Min Order</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Size</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Ring Size</th>
                                                                                    <th class="tbl-name text-center" style="width: 10%;">Published</th>
                                                                                    
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="datalist">
                                                                                <?php
                                                                                    ?>
                                                                                        <tr>
                                                                                        <td class="tbl-name text-left"><?php echo $isavailabletext; ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $isavailableformemotext; ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['stock'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['iteminstock'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['minimumorder'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['size'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['ringsize'] ?></td>
                                                                                        <td class="tbl-name text-left"><?php echo $unpublishedtext; ?></td>
                                                                                    
                                                                                        </tr>
                                                                                    <?php
                                                                                ?>
                                                                            
                                                                            </tbody>
                                                                        </table>

                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                        if($rowcant['keyworddescription'])
                                                                        {
                                                                            ?>
                                                                            <tr> 
                                                                                <td><b>Keyword Description</b></td>
                                                                                <td colspan="9">
                                                                                <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                                    <thead style="width: 100%;">
                                                                                        <tr>
                                                                                            <th class="tbl-name text-left" style="width: 15%;">Keyword</th>
                                                                                            
                                                                                            
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="datalist">
                                                                                        <?php
                                                                                            ?>
                                                                                                <tr>
                                                                                                <td class="tbl-name text-left"><?php echo $rowcant['keyworddescription'] ?></td>
                                                                                            
                                                                                                </tr>
                                                                                            <?php
                                                                                        ?>
                                                                                    
                                                                                    </tbody>
                                                                                </table>

                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                    <?php
                                                                        if($rowcant['suppliercomment'])
                                                                        {
                                                                            ?>
                                                                            <tr> 
                                                                                <td><b>Suppliers Comment</b></td>
                                                                                <td colspan="9">
                                                                                <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="tbl-name text-left" style="width: 15%;">Comment</th>
                                                                                            
                                                                                            
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="datalist">
                                                                                        <?php
                                                                                            ?>
                                                                                                <tr>
                                                                                                <td class="tbl-name text-left"><?php echo $rowcant['suppliercomment'] ?></td>
                                                                                            
                                                                                                </tr>
                                                                                            <?php
                                                                                        ?>
                                                                                    
                                                                                    </tbody>
                                                                                </table>

                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                    
                                                                    <?php
                                                                    
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                        <!-- table End -->
                                                    <?php
                                                }
                                               
                                        }
                                    }
                                    else
                                    {
                                    ?>
                                        <h5 class="m-0 menunamelbl text-center mt-5"><b><?php echo $config->getErrmsg()['nodatafound']; ?> </b></h5>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  END CONTENT AREA  -->
            
            <!--  START FOOTER AREA  -->
            <?php //require_once '../footer.php'; ?>
            <!--  END FOOTER AREA  -->
        </div>
        <?php require_once '../js.php'; ?>

        
    </body>
</html>    

<script>
function printDiv(divName) 
{
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
    
        window.print();

        document.body.innerHTML = originalContents;
}

</script>