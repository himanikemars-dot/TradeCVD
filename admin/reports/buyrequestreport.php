<?php 
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';



$shapeid=$IISMethods->sanitize($_POST['shapeid']);
$customerid=$IISMethods->sanitize($_POST['customerid']);
$regionid=$_POST['regionid'];
$locationid=$_POST['locationid'];


$startdate=$IISMethods->sanitize($_POST['fromdate']);
$enddate=$IISMethods->sanitize($_POST['todate']);
if($_POST['fromdate']=='' && $_POST['todate'])
{
    $startdate=$IISMethods->sanitize($_POST['todate']);
}

$isdetails=$_POST['isdetails'];
//$isexpancedetails=$_POST['isexpancedetails'];


$qryperson = " SELECT pm.id,pm.personname,br.personid FROM tblpersonmaster pm
                INNER JOIN `tblbuyrequest` br ON br.personid = pm.id
                GROUP BY pm.id";
$resperson = $DB->getmenual($qryperson);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>Buy Request Report</title>
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
                                <h5 class="m-0 menunamelbl"><b>Buy Request Report</b></h5>
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
                                        /*ccm.companyname,INNER JOIN `tblcompanymaster` ccm ON ccm.id=em.companyid 
                                          */
                                    if(sizeof($resperson) > 0)
                                    {
                                        for($j=0;$j<sizeof($resperson);$j++)
                                        {
                                            $rowperson=$resperson[$j];
                                            $personid = $rowperson['id'];
                                            $imageurl = $config->getImageurl();
                                            $CheckUserRights = $DB->checkpackagewiseuserright($uid);
                                            //  print_r($params);

                                            $qry_main = "SELECT `b`.`id`,`b`.`buyrequestno`,`b`.`isgetnotification`,`b`.`personid`,`b`.`personname`,`b`.`type`,`b`.`typetext`,`b`.`createdate`,`b`.`expirydate`,`b`.`comment`,`b`.`shapeid`,`b`.`shape`,`b`.`fromsize`,`b`.`tosize`,
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
                                            WHERE 1=1 AND b.`personid` LIKE '$personid'";
                                            
                                            $parms = array();


                                    
                                            if($startdate && $enddate)
                                            {
                                                $qry_main.="  AND STR_TO_DATE(b.entry_date,'%Y-%m-%d') BETWEEN str_to_date('$startdate','%d/%m/%Y') AND str_to_date('$enddate','%d/%m/%Y') ";
                                                $parms[':fltstartdate']=$startdate;
                                                $parms[':fltenddate']=$enddate;
                                            }
                                            else if($startdate)
                                            {
                                                $qry_main.= "  AND STR_TO_DATE(b.entry_date,'%Y-%m-%d') = str_to_date('$startdate','%d/%m/%Y')";
                                            }
                                        
                                            if($shapeid && $shapeid!='%')
                                            {
                                                $qry_main.=" AND b.shapeid like :fltshapeid ";
                                                $parms[':fltshapeid']=$shapeid;
                                            }
                                            if($customerid && $customerid!='%')
                                            {
                                                $qry_main.=" AND b.personid like :fltcustomerid ";
                                                $parms[':fltcustomerid']=$customerid;
                                            }
                                                
                                            $qry_main.=" GROUP BY b.id ORDER BY b.timestamp desc"; 
                                            //    echo $qry_main;
                                            //    print_r($parms);
                                            $rescant = $DB->getmenual($qry_main, $parms);
                                            $rowcant=$rescant[0];
                                            if(sizeof($rescant) > 0)
                                            {
                                                ?>
                                                        <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                            
                                                            <thead style="width: 100%;">
                                                            
                                                                    <tr>
                                                                        <td colspan="10" style="font-size: 13px;text-align: left; background-color:#dff0d8" class="success" >Customer : <?php echo $rowperson['personname']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="tbl-name text-center" style="width: 10%;">No</th>
                                                                        <th class="tbl-name text-center" style="width: 10%;">Buy Request#</th>
                                                                        <th class="tbl-name text-center" style="width: 10%;">Request Person</th>
                                                                        <th class="tbl-name text-center" style="width: 10%;">Type</th>
                                                                        <th class="tbl-name text-center" style="width: 10%;">Create Date</th>
                                                                        <th class="tbl-name text-center" style="width: 10%;">Expiration Date</th>
                                                                        <th class="tbl-name text-center" style="width: 10%;">Shape</th>
                                                                        <th class="tbl-name text-center" style="width: 15%;">Size</th>
                                                                        <th class="tbl-name text-center" style="width: 15%;">Color</th>
                                                                        <th class="tbl-name text-center" style="width: 15%;">Location</th>
                                                                    
                                                                    </tr>
                                                                    
                                                            </thead>
                                                            <tbody id="datalist">
                                                                <?php
                                                                for($i=0;$i<sizeof($rescant);$i++)
                                                                {
                                                                    $rowcant=$rescant[$i];

                                                                    $size="";
                                                                    if($rowcant['fromsize'] && $rowcant['tosize'])
                                                                    {
                                                                        $size = $rowcant['fromsize'].'-'.$rowcant['tosize'];
                                                                    }
                                                                
                                                                    $color="";
                                                                    if($rowcant['fromcolor'] && $rowcant['tocolor'])
                                                                    {
                                                                        $color = $rowcant['fromcolor'].'-'.$rowcant['tocolor'];
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td class="tbl-name text-center" ><?php echo $i+1; ?></td>
                                                                        <td class="tbl-name text-center"><?php echo $rowcant['buyrequestno'] ?></td>
                                                                        <td class="tbl-name text-left"><?php echo $rowcant['personname'] ?></td>
                                                                        <td class="tbl-name text-left"><?php echo $rowcant['typetext'] ?></td>
                                                                        <td class="tbl-name text-center"><?php echo $rowcant['createdate'] ?></td>
                                                                        <td class="tbl-name text-center"><?php echo $rowcant['expirydate'] ?></td>
                                                                        <td class="tbl-name text-left"><?php echo $rowcant['shape'] ?></td>
                                                                        <td class="tbl-name text-left"><?php echo  $size; ?></td>
                                                                        <td class="tbl-name text-left"><?php echo $color; ?></td>
                                                                        <td class="tbl-name text-left"><?php echo $rowcant['country'] ?></td>
                                                                    
                                                                    </tr>
                                                                    <?php
                                                                    if($isdetails==1)
                                                                    {
                                                                        $cut="";
                                                                        if($rowcant['fromcut'] && $rowcant['tocut'])
                                                                        {
                                                                            $cut = $rowcant['fromcut'].'-'.$rowcant['tocut'];
                                                                        }
                                                                        
                                                                        $clarity="";
                                                                        if($rowcant['fromclarity'] && $rowcant['toclarity'])
                                                                        {
                                                                            $clarity = $rowcant['fromclarity'].'-'.$rowcant['toclarity'];
                                                                        }

                                                                        $polish="";
                                                                        if($rowcant['frompolish'] && $rowcant['topolish'])
                                                                        {
                                                                            $polish = $rowcant['frompolish'].'-'.$rowcant['topolish'];
                                                                        }

                                                                        $symmetry="";
                                                                        if($rowcant['fromsymmetry'] && $rowcant['tosymmetry'])
                                                                        {
                                                                            $symmetry = $rowcant['fromsymmetry'].'-'.$rowcant['tosymmetry'];
                                                                        }

                                                                        $milky="";
                                                                        if($rowcant['frommilky'] && $rowcant['tomilky'])
                                                                        {
                                                                            $milky = $rowcant['frommilky'].'-'.$rowcant['tomilky'];
                                                                        }
                                                                    ?>
                                                                        <tr> 
                                                                            <td><b>Buy Request Details</b></td>
                                                                            <td colspan="9">
                                                                            <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                                <thead style="width: 100%;">
                                                                                    <tr>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Clarity</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Cut</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Polish</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Symmetry</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Fluorescence Intensity</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Fluorescence Color</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Lab</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Price($)</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Eye Clean</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Milky</th>
                                                                                

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="datalist">
                                                                                    <?php
                                                                                        ?>
                                                                                            <tr>
                                                                                            <td class="tbl-name text-left"><?php echo $clarity; ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $cut; ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $polish; ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $symmetry; ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $rowcant['intensity'] ?></td>

                                                                                            <td class="tbl-name text-left"><?php echo $rowcant['color'] ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $rowcant['lab'] ?></td>
                                                                                            <td class="tbl-name text-right">$<?php echo $rowcant['price'] ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $rowcant['eyeclean'] ?></td>
                                                                                            <td class="tbl-name text-left"><?php echo $milky; ?></td>

                                                                                            </tr>
                                                                                        <?php
                                                                                    ?>
                                                                                
                                                                                </tbody>
                                                                            </table>

                                                                            </td>
                                                                        </tr>
                                                                        <tr> 
                                                                            <td><b>Details</b></td>
                                                                            <td colspan="9">
                                                                            <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                                <thead style="width: 100%;">
                                                                                    <tr>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Black Inclusion</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">White Inclusion</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Open Inclusion</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Length</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Width</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Depth</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Table</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Depth(%)</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Ratio</th>
                                                                                    
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="datalist">
                                                                                    <?php
                                                                                        ?>
                                                                                            <tr>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['blackinclusion'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['whiteinclusion'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['openinclusion'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['fromlength'] ?>-<?php echo $rowcant['tolength'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['fromwidth'] ?>-<?php echo $rowcant['towidth'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['fromdepth'] ?>-<?php echo $rowcant['todepth'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['fromtable'] ?>-<?php echo $rowcant['totable'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['fromdepthper'] ?>-<?php echo $rowcant['todepthper'] ?></td>
                                                                                            <td class="tbl-name text-center"><?php echo $rowcant['fromratio'] ?>-<?php echo $rowcant['toratio'] ?></td>

                                                                                            </tr>
                                                                                        <?php
                                                                                    ?>
                                                                                
                                                                                </tbody>
                                                                            </table>

                                                                            </td>
                                                                        </tr>
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