<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/team.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='insertteam')   
	{
		$formevent=$IISMethods->sanitize($_POST['formevent']);
		$name=$IISMethods->sanitize($_POST['name']);
		$displayorder=$IISMethods->sanitize($_POST['displayorder']);
		$contact=$IISMethods->sanitize($_POST['contact']);
		$wacontact = $IISMethods->sanitize($_POST['whatsappcontact']);
		$designation = $IISMethods->sanitize($_POST['designation']);

		$id=$IISMethods->sanitize($_POST['id']);
		$datetime=$IISMethods->getdatetime();
		if($name && $displayorder && $contact)
		{			
			$insqry=array(					
				'name'=>$name,
				'contact'=>$contact,
				'wacontact'=>$wacontact,
				'displayorder'=>$displayorder,	
				'designation'=>$designation			
			);

			if($formevent=='addright')
			{
				$unqid = $IISMethods->generateuuid();
				$insqry['id']=$unqid;	
				$insqry['timestamp']=$IISMethods->getdatetime();
				$insqry['entry_uid']=$uid;	
				$insqry['entry_date']=$datetime;

				$DB->executedata('i','tblteam',$insqry,'');

				$status=1;
				$message=$errmsg['insert'];
			}
			else if($formevent=='editright')
			{
				$insqry['update_uid']=$uid;	
				$insqry['update_date']=$datetime;

				$extraparams=array(
					'id'=>$id
				);
				$DB->executedata('u','tblteam',$insqry,$extraparams);

				$status=1;
				$message=$errmsg['update'];
			}		
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='deleteteam')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		$bulkid=$_POST['bulkid'];
		$bulk=explode (",", $bulkid); 
		if($id)
		{
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('d','tblteam','',$extraparams);
			$status=1;
			$message=$errmsg['delete'];
		}
		else if(sizeof($bulk)>0)
		{
			$usemenu='';
			for($i=0;$i<sizeof($bulk);$i++)
			{
				$id=$bulk[$i];

				$extraparams=array(
					'id'=>$IISMethods->sanitize($id)
				);
				$DB->executedata('d','tblteam','',$extraparams);
			}
			$status=1;
			$message=$errmsg['delete'].' '.$usemenu;
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='editteam')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="select id,name,displayorder,contact,whatsappcontact,designation from tblteam where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);

			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$response['id']=$IISMethods->sanitize($row['id']);
				$response['name']=$IISMethods->sanitize($row['name'], 'OUT');
				$response['displayorder']=$IISMethods->sanitize($row['displayorder']);
				$response['contact']=$IISMethods->sanitize($row['contact']);
				$response['whatsappcontact']=$IISMethods->sanitize($row['whatsappcontact']);
				$response['designation']=$IISMethods->sanitize($row['designation']);
			}
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}
	else if($action=='listteam')   
	{
		$teams=new team();
		$qry="select cm.timestamp as primary_date,cm.id,cm.name,cm.displayorder,cm.isactive,cm.contact,cm.whatsappcontact ,cm.designation from tblteam cm 
		where cm.name like :filter or cm.contact like :filter or cm.whatsappcontact like :filter  order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$teams=$DB->getmenual($qry,$parms,'team');
		
		if($responsetype=='HTML')
		{
			if($teams)
			{
				$i=0;
				foreach($teams as $team)
				{
					$id="'".$team->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

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
					$htmldata.='<td class="tbl-check d-none">';
					$htmldata.='<div class="text-center">';
					$htmldata.='<div class="custom-control custom-checkbox m-0 mx-auto w-auto">';
					$htmldata.='<input type="checkbox" class="custom-control-input bulkdelete" id="bulkdelete'.$i.'" value="'.$IISMethods->sanitize($team->id).'" name="bulkdelete[]">';
					$htmldata.='<label class="custom-control-label mb-0" for="bulkdelete'.$i.'"></label>';
					$htmldata.='</div>';
					$htmldata.='</div>';
					$htmldata.='</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($team->name, 'OUT').'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($team->designation, 'OUT').'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($team->contact).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($team->whatsappcontact).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($team->displayorder).'</td>';
					if($team->isactive == 1)
					{
						$htmldata.='<td class="tbl-name text-center"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="isactive('.$id.')" checked>';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}
					else
					{
						$htmldata.='<td class="tbl-name text-center"><label class="switch">';
							$htmldata.='<input type="checkbox" onclick="isactive('.$id.')">';
							$htmldata.='<span class="slider round"></span>';
						$htmldata.='</label></td>';
					}
					$htmldata.='</tr>';
					$i++;
				}
				$status=1;
				$message=$errmsg['success'];
			}
			else
			{	
				$htmldata.=file_get_contents($config-> getNoDataFound());
				$message=$errmsg['nodatafound'];
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($teams);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($teams)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($teams); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($teams);
		$response['showentries']=$showentries;
	}    

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblteam where id=:id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			$row=$result_ary[0];
			if($row['isactive']==1)
			{
				$isactive=0;
			}
			else
			{
				$isactive=1;
			}
			$insqry['isactive']=$isactive;	
			$extraparams=array(
				'id'=>$id
			);
			$DB->executedata('u','tblteam',$insqry,$extraparams);

			$status=1;
			$message=$errmsg['update'];
		}
		else
		{
			$message=$errmsg['reqired'];
		}
	}
}


require_once dirname(__DIR__, 3).'/config/apifoot.php';  

?>

  