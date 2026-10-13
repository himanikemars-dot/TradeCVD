<?php 
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2) . '/config/apiconfig.php';

$shapeid=$IISMethods->sanitize($_POST['shapeid']);
$customerid=$IISMethods->sanitize($_POST['customerid']);
$startdate=$IISMethods->sanitize($_POST['fromdate']);
$enddate=$IISMethods->sanitize($_POST['todate']);
$isdetails=$_POST['isdetails'];

$qryperson = " SELECT pm.id,pm.personname,d.personid FROM tblpersonmaster pm
                INNER JOIN `tbldiamond` d ON d.personid = pm.id
                GROUP BY pm.id";
$resperson = $DB->getmenual($qryperson);


// ini_set('display_errors', 1);
	// error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title>Diamond Report</title>
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
                                <h5 class="m-0 menunamelbl"><b>Diamond Report</b></h5>
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
                                        

                                            $qry_main = "SELECT d.`id`,d.savanilotnumber,d.personid,d.`stock`,d.`price`,d.`ispricectsavani`,d.`availabilityid`,d.`availability`,d.`countryid`,d.`country`,d.`stateid`,d.`state`,d.`city`,d.`shapeid`,d.`shape`,d.`sizeid`,d.`size`,d.`colorid`,d.`color`,d.`clarityid`,d.`clarity`,d.`cutid`,d.`cut`,d.`polishid`,d.`polish`,d.`symmetryid`,d.`symmetry`,d.`intensityid`,d.`intensity`,
                                                        d.`fluorescenecolorid`,d.`fluorescenecolor`,d.`fluorescenecolorcode`,d.`length`,d.`width`,d.`depth`,d.`depthper`,d.`tableper`,d.`crownangle`,d.`crownheight`,d.`pavilionangle`,d.`pavilionheight`,d.`gridleconditionid`,d.`gridlecondition`,d.`gridleminid`,d.`gridlemin`,d.`gridlemaxid`,d.`gridlemax`,d.`gridleper`,d.`culetconditionid`,d.`culetcondition`,d.`culetsizeid`,d.`culetsize`,
                                                        d.`treatmentid`,d.`treatment`,d.`laserinscription`,d.`starlength`,d.`labid`,d.`lab`,d.`reportnumber`,d.`showonsavanigems`,d.`reportdate`,d.`lablocation`,d.`reportcomment`,d.`keytosymbolsid`,d.`keytosymbols`,d.withfancycolor,d.`fancyintensityid`,d.`fancyintensity`,d.`overtoneid`,d.`overtone`,d.`fancycolorid1`,d.`fancycolor1`,d.`fancycolorcode1`,d.`fancycolorid2`,d.`fancycolorcode2`,d.`fancycolor2`,
                                                        d.`matchedpair`,d.`stocknumber`,d.`ispairseparable`,d.`isdownload`,d.`tradeshowid`,d.`tradeshow`,d.`brandid`,d.`brand`,d.`suppliercomment`,d.`isparcel`,d.`numofdiamond`,d.containreportfileorlink,d.`reportfile`,d.`reportfilelink`,d.`diamondimg`,d.containdiamondimgorlink,d.`diamondimglink`,d.`sarineloupe`,d.`sellerspecification`,d.`shadeid`,d.`shade`,d.`eyecleanid`,d.`eyeclean`,d.`milkyid`,d.`milky`,d.`openinclusionsid`,d.`openinclusions`,
                                                        d.`blackinclusionsid`,d.`blackinclusions`,d.`whiteinclusionsid`,d.`whiteinclusions`,d.`roughdiamondsourceid`,d.`roughdiamondsource`,
                                                        d.`entry_uid`,d.`entry_date`,d.`update_uid`,d.`update_date`,d.`timestamp`,ifnull(d.`videolink`,'') AS videolink,d.ismixsize,`d`.`piecepercarat`,`d`.`sieveid`,d.tosieveid,d.`sievename`,d.tosievename
                                                        ,case when(ifnull(d.reportfile,'')='') then '' ELSE concat(:imgurl,d.reportfile) END AS reportfileurl
                                                        ,:defualtdiamondimageurl AS diamondimgurl,d.maxid,d.seriesid,d.personname,
                                                        ifnull((SELECT companyname FROM tblcompanymaster WHERE isactive=1 and isdefault=1 ORDER BY timestamp desc limit 1),'') AS cmpname,d.savanipercentage,d.isactive,DATE_FORMAT(d.`timestamp`,'%d/%m/%Y') AS dt,d.totalprice
                                                        FROM `diamondlist` d
                                                        inner join tblpersonmaster pm on pm.id=d.personid
                                                        WHERE 1=1 AND d.`personid` LIKE '$personid'";
                                            
                                            $parms = array(':imgurl' => $imageurl, ':defualtdiamondimageurl' => $config->getDefualtDiamondImageurl());


                                    
                                            if($startdate && $enddate)
                                            {
                                                $qry_main.="  AND STR_TO_DATE(d.entry_date,'%Y-%m-%d') BETWEEN str_to_date('$startdate','%d/%m/%Y') AND str_to_date('$enddate','%d/%m/%Y') ";
                                                // $parms[':fltstartdate']=$startdate;
                                                // $parms[':fltenddate']=$enddate;
                                            }
                                            else if($startdate)
                                            {
                                                $qry_main.= "  AND STR_TO_DATE(d.entry_date,'%Y-%m-%d') = str_to_date('$startdate','%d/%m/%Y')";
                                            }
                                           
                                            if($shapeid && $shapeid!='%')
                                            {
                                                $qry_main.=" AND d.shapeid like :fltshapeid ";
                                                $parms[':fltshapeid']=$shapeid;
                                            }
                                            if($customerid && $customerid!='%')
                                            {
                                                $qry_main.=" AND d.personid like :fltcustomerid ";
                                                $parms[':fltcustomerid']=$customerid;
                                            }
                                                
                                            $qry_main.=" GROUP BY d.id ORDER BY d.timestamp desc"; 
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
                                                                    <td colspan="9" style="font-size: 13px;text-align: left; background-color:#dff0d8" class="success" >Customer : <?php echo $rowperson['personname']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="tbl-name text-center" style="width: 10%;">No</th>
                                                                    <th class="tbl-name text-center" style="width: 10%;">location</th>
                                                                    <th class="tbl-name text-center" style="width: 10%;">$/ct</th>
                                                                    <th class="tbl-name text-center" style="width: 10%;">Discount (%)</th>
                                                                    <th class="tbl-name text-center" style="width: 10%;">Total Price</th>
                                                                    <th class="tbl-name text-center" style="width: 10%;">Depth (%)</th>
                                                                    <th class="tbl-name text-center" style="width: 10%;">Table (%)</th>
                                                                    <th class="tbl-name text-center" style="width: 15%;">Measurement</th>
                                                                    <th class="tbl-name text-center" style="width: 15%;">Stock No</th>
                                                                
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
                                                                    <td class="tbl-name text-left"><?php echo $rowcant['country'] ?></td>
                                                                    <td class="tbl-name text-right">$<?php echo $rowcant['price'] ?></td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['savanipercentage'] ?>%</td>
                                                                    <td class="tbl-name text-right">$<?php echo $rowcant['totalprice'] ?></td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['depthper'] ?>%</td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['tableper'] ?>%</td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['length'] ?>-<?php echo $rowcant['width'] ?>-<?php echo $rowcant['depth'] ?></td>
                                                                    <td class="tbl-name text-center"><?php echo $rowcant['stock'] ?></td>
                                                                </tr>
                                                                <?php
                                                                if($isdetails==1)
                                                                {
                                                                ?>
                                                                    <tr> 
                                                                        <td><b>Diamond Details</b></td>
                                                                        <td colspan="8">
                                                                            <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered11 table-hover datalisttable">
                                                                                
                                                                                <thead style="width: 100%;">
                                                                                    <tr>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Shape</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Size</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Color</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Clarity</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Cut</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Polish</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Symm</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Fluor.</th>
                                                                                        <th class="tbl-name text-center" style="width: 10%;">Lab</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="datalist">
                                                                                    <tr>
                                                                                        <td class="tbl-name text-left"><?php echo $rowcant['shape'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['size'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['color'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['clarity'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['cut'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['polish'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['symmetry'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['intensity'] ?></td>
                                                                                        <td class="tbl-name text-center"><?php echo $rowcant['lab'] ?></td>
                                                                                    </tr>
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