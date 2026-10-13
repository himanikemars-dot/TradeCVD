<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';


$qrysel = "SELECT * FROM tbldiamond WHERE maxid BETWEEN 1001 AND 9157";
$param = array();
$res = $DB->getmenual($qrysel, $param);
if (sizeof($res) > 0) {
    // for ($i = 0; $i < 10000; $i++) {
        for ($d = 0; $d < sizeof($res); $d++) {
            $rowdm=$res[0];
            $diamondid=$rowdm['id'];
            $params=array(
                'id'=>$diamondid
            );
            $DB->executedata('d','tbldiamond','',$params);
            $DB->userwisediamonjewelrylog(1,$uid);

            $keytosymbolparams=array(
                'diamondid'=>$diamondid
            );
            $DB->executedata('d','tbldiamondkeytosymbol','',$keytosymbolparams);

            $overtoneparams=array(
                'diamondid'=>$diamondid
            );
            $DB->executedata('d','tbldiamondovertone','',$overtoneparams);

            $openinclusionsparams=array(
                'diamondid'=>$diamondid
            );
            $DB->executedata('d','tbldiamondopeninclusions','',$openinclusionsparams);

            $blackinclusionsparams=array(
                'diamondid'=>$diamondid
            );
            $DB->executedata('d','tbldiamondblackinclusions','',$blackinclusionsparams);

            $whiteinclusionsparams=array(
                'diamondid'=>$diamondid
            );
            $DB->executedata('d','tbldiamondwhiteinclusions','',$whiteinclusionsparams);
        }   
    // }
}
