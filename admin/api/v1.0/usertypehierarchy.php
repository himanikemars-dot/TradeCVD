<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/usertype.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='gettreedata')   
	{

		$qry="SELECT tuo.utypeid AS id,IFNULL(tuo.parentid,'') AS parent_id,tu.usertype AS utypename FROM tblusertypeorder tuo INNER JOIN tblusertypemaster tu ON tu.id=tuo.utypeid order by tuo.timestamp";
		$parms=array(					
								
		);
		$result_ary=$DB->getmenual($qry,$parms);
		$refs = array();
		$list = array();

		if(sizeof($result_ary)>0)
		{
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$row=$result_ary[$i];

				$thisref = &$refs[ $row['id'] ];
				$thisref['id'] = $IISMethods->sanitize($row['id']);
				$thisref['utypename'] = $IISMethods->sanitize($row['utypename']);
				$thisref['parent_id'] = $IISMethods->sanitize($row['parent_id']);

				$thisref['addright'] = 0;
				if((sizeof($Pagerights)>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
				{
					$thisref['addright'] = 1;
				}

				$thisref['delright'] = 0;
				if((sizeof($Pagerights)>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
				{
					$thisref['delright'] = 1;
				}

	
				if ($IISMethods->sanitize($row['parent_id']) == '') {
					
					$list[  ] = &$thisref;
				} else {
			
					$refs[ $row['parent_id'] ]['children'][] = &$thisref;
				}
			}
		}
		$response["result"] = $list;

		$status=1;
		$message=$errmsg['success'];
	}
	else if($action=='addnode')
	{
		$id=$_POST['id'];
		$htmldata='';
		if($id)
		{
			$qry="SELECT * FROM tblusertypemaster WHERE id<>:utypeid and id NOT IN (SELECT utypeid FROM tblusertypeorder )";
			$parms=array(	
				':utypeid'=>$config->getAdminutype(),					
			);
			$result_ary=$DB->getmenual($qry,$parms);
		
			$htmldata.='<form class="col-12 jQueryForm" id="newnodeform" method="post" action="usertypeorder.php" enctype="multipart/form-data">';
			$htmldata.='<input type="hidden" name="Nodeid" id="Nodeid" value="'.$id.'"/>';
			$htmldata.='<div class="row ml-0">';
			
			$j=1;
			for($i=0;$i<sizeof($result_ary);$i++)
			{
				$rowqry=$result_ary[$i];
				
				$htmldata.='<div class="col-12 col-sm-6 col-lg-4 col-xl-3 layout-spacing pl-0">';
				$htmldata.='<a class="viewdetail clscheckusertype" href="javascript:void(0)" usertypeno="'.$j.'" data-id="'.$rowqry['id'].'" data-name="'.$rowqry['usertype'].'">';
				$htmldata.='<div class="widget widget-hover text-center h-100 py-4">';
				$htmldata.='<div class="widget-content inner'.$j.' innerdivcls">';
				$htmldata.='<h5 class="card-title">'.$rowqry['usertype'].'</h5>';
				$htmldata.='</div>';
				$htmldata.='</div>';
				$htmldata.='</a>';
				$htmldata.='</div>';	
				$j++;
			}
			
			$htmldata.='</div>';
			$htmldata.='</form>';
			$htmldata.='<div class="col-12">';
			$htmldata.='<div class="row">';
			$htmldata.='<div class="col-auto ml-auto">';
			$htmldata.='<div class="input-group mb-0">';



			$htmldata.='<input class="btn btn-primary m-0 btn-default" name="btnsubmit" id="btnsubmit" type="submit" value="Submit" onclick="addnewnode()"/>';
			$htmldata.='<input class="btn btn-secondary m-0 ml-2" name="btngrpreset" id="btngrpreset" type="reset" value="Reset" onclick="nodereset()"/>';
			$htmldata.='</div>';
			$htmldata.='</div>';
			$htmldata.='</div>';
			$htmldata.='</div>';
		}
		$response['data']=$htmldata;
	} 	
	else if($action=='addnewnode')
	{
		$Nodeid=$_POST['Nodeid'];
		$usertypeid=$_POST['usertypeid'];
		$usertypename=$_POST['usertypename'];
		$utidp=$_POST['utidp'];
		$usertypename=$_POST['usertypename'];
		
		if($Nodeid)
		{
			for($j=0;$j<sizeof($usertypeid);$j++)
			{
				$unqid = $IISMethods->generateuuid();
				$data=array(
					'id'=>$unqid,		
					'utypeid'=>$usertypeid[$j],
					'utypename'=>$usertypename[$j],
					'parentid'=>$Nodeid,
					'restrictdelete'=>0,
					'timestamp'=>$IISMethods->getdatetime(),
				);
				$DB->executedata('i','tblusertypeorder',$data,'');
			}
			$status=1;
			$message=$errmsg['newnodeadd'];
		}
	}	
	else if($action=='deletenode')
	{
		$id=$_POST['id'];
		if($id)
		{
			if($id==$config->getAdminutype())
			{
				$message=$errmsg['nodedelnot'];
			}
			else 
			{
				$parms = array(
					'p_utypeid'=>$id,		
				);
				$result_ary=$DB->getdatafromsp('usertype_strhier',$parms);

				$reusertype='';
				if(sizeof($result_ary)>0)
				{
					$reusertype=$result_ary[0]['utypeid'];
					$exutypeid = explode(',',$reusertype);
					for($i=0;$i<sizeof($exutypeid);$i++)
					{
						$extraparams=array(
							'utypeid'=>$exutypeid[$i]
						);
						$DB->executedata('d','tblusertypeorder','',$extraparams);

					}
					$status=1;
					$message=$errmsg['nodedel'];
				}
			}
		}
	}
	else if($action=='personnode')
	{
		$id=$_POST['id'];
		$htmldata='';
		if($id)
		{
			$qrychk="SELECT pm.id,pm.personname,pm.contact,lm.locname FROM tblpersonmaster pm
				INNER JOIN tblpersonutype pu ON pu.pid = pm.id
				INNER JOIN tblpersonlocation pl ON pl.pid = pm.id
				INNER JOIN tbllocationmaster lm ON lm.id = pl.locid
				WHERE pu.utypeid=:id ORDER BY lm.locname,pm.personname";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
	
			$htmldata.='<div class="col-12">';
			$htmldata.='<div class="table-responsive">';
			$htmldata.='<table class="table table-bordered table-hover table-striped">';
			$htmldata.='<thead>';
			$htmldata.='<tr>';
			$htmldata.='<th class="text-center active" colspan="3">Person Details</th>';
			$htmldata.='</tr>';
			$htmldata.='<tr class="info">';
			$htmldata.='<th>Location</th>';
			$htmldata.='<th>Person Name</th>';
			$htmldata.='<th>Contact</th>';
			$htmldata.='</tr>';
			$htmldata.='</thead>';
			$htmldata.='<tbody>';
				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$row=$result_ary[$i];
					
					$htmldata.='<tr>';
					$htmldata.='<th>'.$row['locname'].'</th>';
					$htmldata.='<th>'.$row['personname'].'</th>';
					$htmldata.='<th>'.$row['contact'].'</th>';
					$htmldata.='</tr>';
				}
			$htmldata.='</tbody>';
			$htmldata.='</table>';	
			$htmldata.='</div>';	
			$htmldata.='</div>';	
		}
		$response['data']=$htmldata;
	}
	else if ($action=='settreedata')
	{
		$tid=$_POST['tid'];
    	$sid=$_POST['sid'];
    	if($tid && $sid)
    	{	
			$adminutype=$config->getAdminutype();
			if($sid=="$adminutype")
			{
				
			}
			else 
			{
				$upddata = array(
					'parentid'=>$tid,
				);
				
				$extraparams=array(
					'utypeid'=>$sid,
				);
				$DB->executedata('u','tblusertypeorder',$upddata,$extraparams);
			}
			$status=1;
			$message=$errmsg['update'];
		}
	}
}

require_once dirname(__DIR__, 3).'/config/apifoot.php';    

?>

  