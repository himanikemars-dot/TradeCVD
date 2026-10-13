<?php header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/financialyear.php';

if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertfinancialyear')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$IISMethods->sanitize($_POST['name']);
		$fromdate=$IISMethods->sanitize($_POST['fromdate']);
		$todate=$IISMethods->sanitize($_POST['todate']);

		$frmdate = str_replace('/', '-', $fromdate);
		$tdate = str_replace('/', '-', $todate);

		$fd = date('Y-m-d', strtotime($frmdate));
		$td = date('Y-m-d', strtotime($tdate));

		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();

		if($name && $fromdate && $todate)
		{			
			$insqry=array(					
				'name'=>$name,
				'fromdate'=>$fromdate,
				'todate'=>$todate,					
			);

			if($formevent=='addright')
			{
				$qrychk="select * from `tblfinancialyear` WHERE 
					(:fd >= STR_TO_DATE(`fromdate`,'%d/%m/%Y') AND :fd <= STR_TO_DATE(`todate`,'%d/%m/%Y')) OR
					(:td >= STR_TO_DATE(`fromdate`,'%d/%m/%Y') AND :td <= STR_TO_DATE(`todate`,'%d/%m/%Y'))";
				$parms=array(            
					':fd'=>$fd,
					':td'=>$td,
				);

				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					try 
					{
						$DB->begintransaction();

						$unqid = $IISMethods->generateuuid();
						$insqry['id']=$unqid;	
						$insqry['isactive']=0;
						$insqry['timestamp']=$datetime;
						$insqry['entry_uid']=$uid;	
						$insqry['entry_date']=$datetime;

						$DB->executedata('i','tblfinancialyear',$insqry,'');

						$status=1;
						$message=$errmsg['insert'];

						$DB->committransaction();
					}
					catch (Exception $e) 
					{
						$DB->rollbacktransaction($e);
						$status=0;
						$message=$errmsg['dbtransactionerror'];
					}		
				}
			}
			else if($formevent=='editright')
			{
				$qrychk = "select * from `tblfinancialyear` 
				where ((:fd >= STR_TO_DATE(`fromdate`,'%d/%m/%Y') AND :fd <= STR_TO_DATE(`todate`,'%d/%m/%Y')) OR
				(:td >= STR_TO_DATE(`fromdate`,'%d/%m/%Y') AND :td <= STR_TO_DATE(`todate`,'%d/%m/%Y'))) and id <>:id";
				$parms=array(            
					':fd'=>$fd,
					':td'=>$td,
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qrychk,$parms);
				if(sizeof($result_ary) > 0)
				{
					$status=0;
					$message=$errmsg['isexist'];
				}
				else
				{
					try 
					{
						$DB->begintransaction();

						$insqry['update_uid']=$uid;	
						$insqry['update_date']=$datetime;

						$extraparams=array(
							'id'=>$id
						);
						$DB->executedata('u','tblfinancialyear',$insqry,$extraparams);

						$status=1;
						$message=$errmsg['update'];

						$DB->committransaction();
					}
					catch (Exception $e) 
					{
						$DB->rollbacktransaction($e);
						$status=0;
						$message=$errmsg['dbtransactionerror'];
					}	
				}
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deletefinancialyear')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$qrychk="SELECT id from tblfinancialyear where isactive = 1 and id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary) > 0)
			{
				$status=0;
				$message=$errmsg['inuse'];
			}
			else
			{
				try 
				{
					$DB->begintransaction();

					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('d','tblfinancialyear','',$extraparams);
					$status=1;
					$message=$errmsg['delete'];

					$DB->committransaction();
				}
				catch (Exception $e) 
				{
					$DB->rollbacktransaction($e);
					$status=0;
					$message=$errmsg['dbtransactionerror'];
				}
			}
		}
		else if(sizeof($bulk)>0)
		{
			try 
			{
				$DB->begintransaction();

				$usemenu='';
				for($i=0;$i<sizeof($bulk);$i++)
				{
					$id=$bulk[$i];
					$qrychk="select id from tblfinancialyear where isactive = 1 and id=:id";
					$parms = array(
						':id'=>$id,
					);
					$result_ary=$DB->getmenual($qrychk,$parms);
					if(sizeof($result_ary) > 0)
					{
						$row=$result_ary[0];
						$usemenu.=$row['name'].",";
					}
					else
					{
						$extraparams=array(
							'id'=>$IISMethods->sanitize($id)
						);
						$DB->executedata('d','tblfinancialyear','',$extraparams);
					}
				}
				$status=1;
				$message=$errmsg['delete'];//.' '.$usemenu;

				$DB->committransaction();
			}
			catch (Exception $e) 
			{
				$DB->rollbacktransaction($e);
				$status=0;
				$message=$errmsg['dbtransactionerror'];
			}	
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='editfinancialyear')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,fromdate,todate from tblfinancialyear where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name'],'OUT');
				$response['fromdate']=$IISMethods->sanitize($row['fromdate']);
				$response['todate']=$IISMethods->sanitize($row['todate']);

			}
			$status=1;
			$message=$errmsg['datafound'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listfinancialyear')   
	{
		$financialyears=new financialyear();
		$qry="SELECT timestamp as primary_date,id,name,fromdate,todate,isactive 
			from tblfinancialyear 
			where name like :filter OR fromdate like :filter OR todate like :filter 
			order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$financialyears=$DB->getmenual($qry,$parms,'financialyear');
		$response['qry']=$qry;
		if($responsetype=='HTML')
		{
			if($financialyears)
			{
				$i=0;
				foreach($financialyears as $financialyear)
				{
					$id="'".$financialyear->id."'";
					$htmldata.='<tr data-index="'.$financialyear->id.'">';
					if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-grid">';
						$htmldata.='<div class="dropdown table-dropdown">';
						$htmldata.='<button class="dropdown-toggle btn-tbl rounded-circle" type="button" id="tableDropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>';
						$htmldata.='<div class="dropdown-menu" aria-labelledby="tableDropdown3">';

						if((($rightstotalcount>0 ? $Pagerights->getEditright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="editdata('.$IISMethods->sanitize($id).')"><i class="bi bi-pencil"></i> Edit</a>';
						}
						if((($rightstotalcount>0 ? $Pagerights->getDelright():0)==1) || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1 ) //admin all right,alleditright - all person data show,selfedit - only self person data show
						{
							$htmldata.='<a class="dropdown-item" href="javascript:void(0);" onclick="deletedata('.$IISMethods->sanitize($id).')"><i class="bi bi-trash"></i> Delete</a>';
						}

						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					if(($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						$htmldata.='<td class="tbl-check d-none">';
						$htmldata.='<div class="text-center">';
						$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
						$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$financialyear->id.'" value="'.$IISMethods->sanitize($financialyear->id).'" name="bulkdelete[]">';
						$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$financialyear->id.'"></label>';
						$htmldata.='</div>';
						$htmldata.='</div>';
						$htmldata.='</td>';
					}
					
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($financialyear->name).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($financialyear->fromdate).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($financialyear->todate).'</td>';
					if((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
					{
						if($financialyear->isactive==1)
						{
							$htmldata.='<td class="tbl-name"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changeactivestatus('.$id.')" checked>';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
						else
						{
							$htmldata.='<td class="tbl-name"><label class="switch">';
								$htmldata.='<input type="checkbox" onclick="changeactivestatus('.$id.')">';
								$htmldata.='<span class="slider round"></span>';
							$htmldata.='</label></td>';
						}
					}
					
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				if($page<=0 && sizeof($financialyears)<=0)
                {
					$htmldata.=file_get_contents($config->getNoDataFound());
					$message=$errmsg['nodatafound'];
                }
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($financialyears);
		}
		
		$common_listdata=$financialyears;
	} 
	else if($action=='changeactivestatus')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{		
			try 
			{
				$DB->begintransaction();

				$qry = "SELECT isactive FROM tblfinancialyear WHERE id = :id";
				$parms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($qry,$parms);
				$row=$result_ary[0];

				$isactive=1;
			
				$insqry['isactive']=$isactive;	
				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblfinancialyear',$insqry,$extraparams);


				$subqry = "SELECT id FROM tblfinancialyear WHERE id <> :id";
				$subparms = array(
					':id'=>$id,
				);
				$result_ary=$DB->getmenual($subqry,$subparms);

				for($i=0;$i<sizeof($result_ary);$i++)
				{
					$subrow=$result_ary[$i];
					$id= $IISMethods->sanitize($subrow['id']);
					$insqry['isactive']=0;	
					$extraparams=array(
						'id'=>$id
					);
					$DB->executedata('u','tblfinancialyear',$insqry,$extraparams);
				}



				$status=1;
				$message=$errmsg['update'];
			
				$DB->committransaction();
			}
			catch (Exception $e) 
			{
				$DB->rollbacktransaction($e);
				$status=0;
				$message=$errmsg['dbtransactionerror'];
			}	
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}   
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  