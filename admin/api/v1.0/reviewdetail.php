<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 3).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/reviewdetail.php';


if($isvalidUser['status'] == 1) 
{
	$status=0;
	$message=$errmsg['invalidrequest'];
	
	if($action=='listreviewdetail')   
	{
		$reviewdetail=new reviewdetail();
		$qry="select e.timestamp as primary_date,e.id,e.personname,e.email,e.entry_date,DATE_FORMAT(e.entry_date,'%d/%m/%Y %h:%i %p')  AS edate,e.productid,pm.name AS productname,e.isactive,e.rating  
			FROM tblreview e 
			INNER JOIN tblproductmaster pm ON pm.id=e.productid 
		where pm.name like :filter or e.personname like :filter or e.rating like :filter or e.email like :filter or DATE_FORMAT(e.entry_date,'%d/%m/%Y %h:%i %p') like :filter order by $ordbycolumnname $ordby LIMIT $start, $per_page";
		$parms = array(
			':filter'=>$filter,
		);
		$reviewdetail=$DB->getmenual($qry,$parms,'reviewdetail');
		
		if($responsetype=='HTML')
		{
			if($reviewdetail)
			{
				$i=0;
				foreach($reviewdetail as $row)
				{
					$id="'".$row->id."'";
					$htmldata.='<tr data-index="'.$i.'">';

					$htmldata.='<td class="tbl-name"><a href="javascript:void(0)" onclick=viewreviewdetailmessage('.$IISMethods->sanitize($id).')>'.$IISMethods->sanitize($row->personname).'</a></td>';
					
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->email).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->productname).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->rating).'</td>';
					$htmldata.='<td class="tbl-name">'.$IISMethods->sanitize($row->edate).'</td>';
					if($row->isactive == 1)
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
				if($page<=0 && sizeof($reviewdetail)<=0)
				{
					// $htmldata.=file_get_contents($config-> getNoDataFound());
					if($filter!='%%')
					{
						$htmldata.=file_get_contents($config->getNoDataFound());
					}else{
						$htmldata.=file_get_contents($config->getNoDataFoundwoReset());
					}
					$message=$errmsg['nodatafound'];
				}
			}
			$response['data']=$htmldata;
		}
		else if($responsetype=='JSON')
		{
			$response['data']= json_encode($reviewdetail);
		}

		$response['nextpage']=$nextpage;
		if(sizeof($reviewdetail)==$per_page){ 
			$showdata=1; 
			$showentries=($nextpage*$per_page);
		}else{ 
			$showdata=0; 
			$showentries=(($nextpage-1)*($per_page))+ sizeof($reviewdetail); }
		$response['loadmore']=$showdata;
		$response['datasize']=sizeof($reviewdetail);
		$response['showentries']=$showentries;
	}    

	else if($action=='viewreviewdetailmessage')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{
			$qrychk="SELECT e.message
					FROM tblreview e
					WHERE e.id = :id";
			$parms = array(
				':id'=>$id,
			);
			$result_ary=$DB->getmenual($qrychk,$parms);
			if(sizeof($result_ary)>0)
			{
				$row=$result_ary[0];
				$tbldata='';
				$tbldata.='<div class="col-12 col-lg-6 col-xl-12 "><div class="row">';
				$tbldata.='<div class="col-12 col-sm-4 col-lg-12 text-dot-right">';
				$tbldata.='<label class="label-view"><b>'.$row['message'].'</b></label>';
				$tbldata.='</div>';
				$tbldata.='</div></div>';
			}

			$response['data']=$tbldata;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['reqired'];
		}
	}

	else if($action=='isactive')   
	{
		$id=$IISMethods->sanitize($_POST['id']);
		if($id)
		{	
			$qrychk="select isactive from tblreview where id=:id";
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
			$DB->executedata('u','tblreview',$insqry,$extraparams);

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

  