<?php
require_once dirname(__DIR__, 1) . '/config/init.php';
require_once dirname(__DIR__, 1) . '/config/apiconfig.php';

// $qry="SELECT * FROM tblcountrymaster";
// $param = array();
// $res = $DB->getmenual($qry, $param);
// if(sizeof($res)>0) 
// {
//     for($i=0;$i<sizeof($res);$i++)
//     {
//         $row=$res[$i];

//         $unqid = $IISMethods->generateuuid();
//         $insqry['id']=$unqid;	
//         $insqry['countrycode']=$row['countrycode'];	
//         $insqry['country']=$row['country'];	
//         $insqry['phonecode']=$row['phonecode'];	
//         $insqry['timestamp']=$IISMethods->getdatetime();
//         $insqry['entry_uid']=$uid;	
//         $insqry['entry_date']=$IISMethods->getdatetime();
//         $DB->executedata('i','tblcountrymaster1',$insqry,'');
//     }
// }
$qry="SELECT * FROM tblcountrymaster";
$param = array();
$res = $DB->getmenual($qry, $param);
if(sizeof($res)>0) 
{
    for($i=0;$i<sizeof($res);$i++)
    {
        $row=$res[$i];

        $qrycount="SELECT id FROM tblcountrymaster1 WHERE countrycode=:countrycode";
        $paramcount=array(':countrycode'=>$row['countrycode']);
        $rescount=$DB->getmenual($qrycount,$paramcount);
        $countryid=$rescount[0]['id'];

        $qrystate="SELECT * FROM tblstatemaster WHERE countryid=:countryid";
        $param1=array(':countryid'=>$row['id']);
        $resstate=$DB->getmenual($qrystate,$param1);
        for($s=0;$s<sizeof($resstate);$s++)
        {
            $rows=$resstate[$s];

            $unqid = $IISMethods->generateuuid();
            $insqry['id']=$unqid;	
            $insqry['countryid']=$countryid;	
            $insqry['state']=$rows['state'];	
            $insqry['timestamp']=$IISMethods->getdatetime();
            $insqry['entry_uid']=$uid;	
            $insqry['entry_date']=$IISMethods->getdatetime();
            $DB->executedata('i','tblstatemaster1',$insqry,'');
        }
           
    }
}
?>