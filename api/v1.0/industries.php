<?php 
header("Content-Type:application/json");
require_once dirname(__DIR__, 2).'/config/init.php';
require_once dirname(__DIR__, 2).'/config/apiconfig.php';
require_once dirname(__DIR__, 2).'/model/industries.php';

	
if($isvalidUser['status'] == 1) 
{	
	$status=0;
	$message=$errmsg['invalidrequest'];
	$imgpath=$config->getImageurl();

	if($action == 'listindustries')
	{
		$industriesid = $_POST['industriesid'];
		$industries=new industries();
		$qrychk="SELECT im.id,im.title,im.subtitle,im.shortdescr,im.description,im.isactive,im.industryuniqueid,
				IFNULL((SELECT CONCAT(:imgpath, ps.image) AS img FROM `tblindustryimage` ps WHERE ps.industryid = im.id ORDER BY ps.displayorder LIMIT 1),CONCAT(:imgpath,'images/industry/industry-d.png')) AS img
				FROM `tblindustrymaster` im WHERE im.isactive = :isactive ";
		$parms = array(
			':isactive'=>1,
			':imgpath'=>$imgpath
		);
		if($industriesid)
		{
			$qrychk.=" AND im.industryuniqueid = :industriesid ";
			$parms[':industriesid']=$industriesid; 
		}

		
		$industries=$DB->getmenual($qrychk,$parms,'industries');

		if(sizeof($industries)>0)
		{
			$response['result'] = $industries;
			$indid=$industries[0]->id;
			$subqry1 ="SELECT id,industryid, CONCAT(:imgpath, image) as image FROM `tblindustryimage` WHERE industryid = :id";
			$subparms1  = array(
				':id'=>$indid,
				':imgpath'=>$imgpath
			);
			$industryimg = $DB->getmenual($subqry1 ,$subparms1);
			if(sizeof($industryimg)>0)
			{
				$response['industryimg'] = $industryimg;
			}

			$qrychk="SELECT id,contenttypeid,title,description,shortdescr,iconclass FROM `tblcontentsetting` WHERE contenttypeid=:insurancepolicyid";
			$contentparms = array(
				':insurancepolicyid'=>$config->getInsurancePolicyid(),
			);
			$contentsetting=$DB->getmenual($qrychk,$contentparms);
			
			$response['insurancepolicy'] = $contentsetting;

			$qrychkecoanalysis="SELECT id,contenttypeid,title,description,shortdescr,iconclass FROM `tblcontentsetting` WHERE contenttypeid=:economicanalysisid ";
			$ecoanalysisparms = array(
				':economicanalysisid'=>$config->getEconomicAnalysisid(),
			);
			$ecoanalysis=$DB->getmenual($qrychkecoanalysis,$ecoanalysisparms);
			
			$response['economicanalysis'] = $ecoanalysis;

			$qrychkorgbehave="SELECT id,contenttypeid,title,description,shortdescr,iconclass FROM `tblcontentsetting` WHERE contenttypeid=:orgbehaviourid";
			$orgbehaveparms = array(
				':orgbehaviourid'=>$config->getOrganizationalBehaviourid(),
			);
			$orgbehave=$DB->getmenual($qrychkorgbehave,$orgbehaveparms);
			
			$response['orgbehaviour'] = $orgbehave;

			$selque="SELECT idq.id,idq.industryid,idq.questionid,qa.question,qa.answer 
					FROM tblindustryquestion idq
					INNER JOIN tblindustrybenefitquestionmaster qa ON qa.id=idq.questionid
					WHERE idq.industryid=:industryid ";
			$queparams=array(
				':industryid'=>$indid
			);

			$indbenfit=$DB->getmenual($selque,$queparams);
			$response['indbenfit'] = $indbenfit;
			$status=1;
			$message=$errmsg['success'];
		}
		else
		{
			$status=0;
			$message=$errmsg['nodatafound'];
		}
	}
	

}	

require_once dirname(__DIR__, 2).'/config/apifoot.php';

?>

  