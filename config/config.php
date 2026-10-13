<?php 
require_once 'constant.php';
class config {

    private $weburl;
	private $imageurl;
	private $endpointurl;
	private $endpointverson;
    private $docurl;
    private $regdomain;
    private $mailurl;
    private $protocol;
    private $docpath;
    private $cdnurl;
    private $servermode;
	private $maindirpath;
    private $dirpath;
	private $page404url;
	private $nodatafound;
	private $nodatafoundworeset;
	private $reporturl;
	private $pdfurl;


	private $updatesidebar;
	private $docroot;
	private $host;
	private $aboutusdefaultimg;
	private $defaultwaterimg;
	private $defualtdiamondimageurl;
	private $patientid;


    private $mssqldefval;
    private $mysqldefval;
    private $errmsg;

	private $sessionname;
	private $adminutype;
	private $subadminutype;
	private $salesheadutype;
	private $vendorutype;
	private $customerutype;

	private $savesidebar;
	private $resetsidebar;
	private $closesidebar;
	private $applyfiltersidebar;

	private $updatemyprofile;
	private $changepassword;
	private $changeusertype;

	private $submitbutton;
	private $generatereport;

	//for Company Type
	private $cmpregisterid;
	private $cmpunregisterid;
	private $cmpcompositionschemeid;
	

	private $stateid;
	private $defaultbirthdate;

	private $defaultcmpid;

	private $adminuid;
	private $defaultimageurl;
	private $defaultpackageimageurl;
	private $defaultprofileimageurl;
	private $defaultnotiimageurl;

	private $socketurl;
	private $socketserver;
 
	// for Content Setting
	private $termsconditionsid;
	private $aboutusid;
	private $privacypolicyid;
	private $missionid;
	private $vissionid;
	private $valuesid;
	private $ourservicesid;
	
	private $homeid;
	private $abouttechchemid;
	private $qualitypolicy;
	private $contactusid;
	private $cookiesid;
	private $dealertrustid;
	private $businextprocesscmpid;

	private $insurancepolicyid;
	private $economicanalysis;
	private $organizationalbehaviourid;
	private $aboutusreliablemotorid;

	private $customerutypeid;
	private $DefualtUserImageurl;

	private $DefualtDiamondImageurl;
	private $DefualtJewelleryImageurl;
	private $Defualtreportfileurl;

	private $PackageYesImgurl;
	private $PackageNoImgurl;
	private $PackagePricingImgurl;

	private $portalbaseurl;
	private $diamondjewelryexpday;


	private $PackageExpiredTitle;
	private $PackageExpiredMessage;
	private $PackageExpiredURL;

	private $PaymentApiKey;
	private $PaymentDomainUrl;

	private $PaymentSuccessImg;
	private $PaymentFailedImg;
	
	private $PaymentEndPointKey;

	private $devicedeletemin=20;

	private $sendexpiryemailbefore;
	private $sendexpiryemailafter;
	
    function  __construct()
	{
		date_default_timezone_set("Asia/Kolkata");        
		
		

		$constant = new constant();
		
		$this->protocol = $constant->getprotocolname();  // http:// or https://
		$this->servermode= $constant->getservermodename(); // prod - Live | uat - test | dev = development

		



		//  project lavel configuration 
		$this->sessionname='savanigems_100822';
		$this->adminutype='98F2B6E0-240A-457B-853A-A0079862315F';
		$this->subadminutype='16E4339F-FFDB-4ACF-95C9-1B617FD47D4F';
		$this->salesheadutype='065F600D-858C-43AE-89A9-1FFFCB002FD5';
		$this->vendorutype='A9C9678F-4093-407F-82D4-12692161BE02';
		$this->customerutype='24D7E055-D61C-4B4D-B40C-284AC129C2B9';
		$this->page404url='/views/404';

		$this->adminuid='034FB884-A865-4127-B90B-3D06047A72CC';


		$this->PackageExpiredTitle='Package Expired';
		$this->PackageExpiredMessage='Your Package has expired!!';


		$this->sendexpiryemailbefore=3;
		$this->sendexpiryemailafter=3;
		




		$this->savesidebar='Save';
		$this->resetsidebar='Reset';
		$this->closesidebar='Close';
		$this->updatesidebar='Update';
		$this->applyfiltersidebar='Apply';

		$this->updatemyprofile='Update Profile';
		$this->changepassword='Change Password';
		$this->changeusertype='Change Usertype';

		$this->submitbutton='Submit';
		$this->generatereport='Generate Report';

		//company Type configuration
		$this->cmpregisterid='E80F52C1-F01C-4301-9438-62CE1E7DD58A';
		$this->cmpunregisterid='0920A058-CFF3-4000-B018-7F168E87054D';
		$this->cmpcompositionschemeid='4A23364E-8A23-4852-9ACF-D14F1294961E';

		$this->stateid='268EF9CB-623C-42F0-AAF1-00680F7B45D1';

		$this->defaultcmpid='A4E1416A-4F96-4BAC-8295-28A613188590';

		$this->customerutypeid='24D7E055-D61C-4B4D-B40C-284AC129C2B9';

		// for Content setting

		$this->termsconditionsid='5953856C-1D54-45D5-A44E-088C70309FEA';
		$this->aboutusid='0B7FCE31-D38E-4517-937A-0F401129F952';
		$this->privacypolicyid='FC748AEC-89AA-4607-A480-1324B7ED9627';
		$this->missionid='DAEE6839-BCEF-46E5-AFBA-0F105D40DD92';
		$this->vissionid='A3D3DB6F-34AF-4E17-BC7D-D71C8D82A2D9';
		$this->valuesid='2465B7CA-2908-4574-BDC7-2ABE858398C6';
		$this->ourservicesid = '26654A7B-2FFB-4B41-8392-1BDD6DCC68C7';
		$this->abouttechchemid = '2DFAF9F4-52F8-4845-B5CD-0C097D53B29F';
		$this->homeid='5772406D-A1AE-4379-9ABA-163697A00BE5';
		$this->qualitypolicy='2465B7CA-2908-4574-BDC7-2ABE858398C6';
		$this->contactusid='464A25B0-6870-491E-A3F6-2434DBEE1063';
		$this->cookiesid='F6FF5999-6478-4991-8E36-16A2E5B747DE';
		$this->dealertrustid='3FBCE703-0FD2-417F-99BC-2664495850H2';
		$this->businextprocesscmpid='E5650913-538F-4399-9517-083E44397AEE';

		$this->insurancepolicyid='001F2A8D-D671-470E-BDFF-212370C7A0C0';
		$this->economicanalysis='EC756227-A07F-42BA-92AB-1C0804D68F02';
		$this->organizationalbehaviourid='68A44D0E-2515-4AD9-AF86-1C8458B7711A';
		$this->aboutusreliablemotorid='0B7FCE31-D38E-4517-937A-0F401129F952';

		$this->diamondjewelryexpday=7;

	// end of strings 

    /*****************************************************************   
    * 
    * Server Lavel Enviroment Configuration 
    * 
    * 
    */
    if ($this->servermode == "dev") // Development 
    {
		$this->docroot= $_SERVER['DOCUMENT_ROOT'].'/';
		$this->maindirpath='/Savanigems_New/';
        $this->dirpath=$this->maindirpath.'';  /* Directory Name also look in index.php script tag*/
        $this->host=$_SERVER['HTTP_HOST'].$this->dirpath;
        $this->weburl = $this->protocol.$this->host;
		$this->docpath = $this->docroot;
        $this->cdnurl =  $this->protocol.$this->host;
        $this->regdomain = '192.168.1.2';
        $this->mailurl = "192.168.1.2/Savanigems_New/";
		$this->endpointverson = 'v1.0/';
		$this->endpointurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath.'api/'.$this->endpointverson;
		$this->imageurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->maindirpath.'assets/';
		$this->page404url=$this->protocol.$this->host.$this->page404url;
		$this->nodatafound=$this->protocol.$this->host.'views/nodatafound.php';
		$this->nodatafoundworeset=$this->protocol.$this->host.'views/nodatafoundworeset.php';
		$this->reporturl=$this->protocol.$this->host.'report/';
		$this->pdfurl=$this->protocol.$this->host.'generatepdf/';

		$this->portalbaseurl=$this->protocol.$this->host.'client/';

		$this->PackageExpiredURL=$this->protocol.$this->host.'membershipplan';

		$this->defaultimageurl=$this->imageurl.'images/defaultitem.png';
		$this->defaultpackageimageurl=$this->imageurl.'images/defaultpackage.png';
		$this->defaultprofileimageurl=$this->imageurl.'images/defaultuser.png';

		$this->DefualtUserImageurl=$this->imageurl.'images/user.png';
		$this->DefualtDiamondImageurl=$this->imageurl.'images/user.png';
		// $this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.jpg';
		// $this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.gif';
		$this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.png';

		$this->defaultnotiimageurl=$this->imageurl.'images/defaultnotification.png';
		$this->aboutusdefaultimg=$this->imageurl.'images/defaultaboutus.png';
		$this->defaultwaterimg=$this->imageurl.'images/defaultwater.png';
		$this->defualtdiamondimageurl=$this->imageurl.'images/defaultwater.png';
		$this->Defualtreportfileurl=$this->imageurl.'images/defaultwater.png';
		$this->PackageYesImgurl=$this->imageurl.'images/icon-v.svg';
		$this->PackageNoImgurl=$this->imageurl.'images/icon-x.svg';
		$this->PackagePricingImgurl=$this->imageurl.'images/pricing-bg.png';

		$this->PaymentSuccessImg=$this->imageurl.'images/payment-done.gif';
		$this->PaymentFailedImg=$this->imageurl.'images/payment-failed.gif';


		$this->PaymentApiKey='sk_test_51M3SBoG5QHlTrrZxVJuPdytA9vMPIQQAiE9kkZq4zvHNwOHmigtfcJ6rI9Bczj1V2rN7571SUXKhCigC6AGLCOKT00gONEhB3x';
		$this->PaymentEndPointKey='whsec_ole0lGyxw9SLCdp79vZbJUMWmFQ7DPvW';
		$this->PaymentDomainUrl=$this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath;

		$this->socketurl='http://192.168.1.4:3001/socket.io/socket.io.js';

		
    }
    else if($this->servermode=="prod") // live 
    {
		$this->docroot= $_SERVER['DOCUMENT_ROOT'].'/';
		$this->maindirpath='/';
		$this->dirpath=$this->maindirpath.''; /* Directory Name */
		if (isset($_SERVER['HTTP_HOST']) && preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/i', $_SERVER['HTTP_HOST'])) {
			$documentRoot = realpath($_SERVER['DOCUMENT_ROOT']);
			$applicationRoot = realpath(dirname(__DIR__));
			if ($documentRoot && $applicationRoot) {
				$documentRoot = rtrim(str_replace('\\', '/', $documentRoot), '/');
				$applicationRoot = str_replace('\\', '/', $applicationRoot);
				if (stripos($applicationRoot, $documentRoot . '/') === 0) {
					$this->maindirpath = substr($applicationRoot, strlen($documentRoot)) . '/';
					$this->dirpath = $this->maindirpath;
				}
			}
		}
        $this->host=$_SERVER['HTTP_HOST'].$this->dirpath;
        $this->weburl = $this->protocol.$this->host;
		$this->docpath = $this->docroot;
        $this->cdnurl = $this->protocol.$this->host;
        $this->regdomain = 'techchemelectro.in';
        $this->mailurl = "techchemelectro.in/";
		$this->endpointverson = 'v1.0/';
		$this->endpointurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath.'api/'.$this->endpointverson;
		$this->imageurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->maindirpath.'assets/';
		$this->page404url=$this->protocol.$this->host.$this->page404url;
		$this->nodatafound=$this->protocol.$this->host.'views/nodatafound.php';
		$this->nodatafoundworeset=$this->protocol.$this->host.'views/nodatafoundworeset.php';
		$this->reporturl=$this->protocol.$this->host.'report/';
		$this->pdfurl=$this->protocol.$this->host.'generatepdf/';

		$this->portalbaseurl=$this->protocol.$this->host.'client/';

		$this->PackageExpiredURL=$this->protocol.$this->host.'membershipplan';

		$this->defaultimageurl=$this->imageurl.'images/defaultitem.png';
		$this->defaultpackageimageurl=$this->imageurl.'images/defaultpackage.png';
		$this->defaultprofileimageurl=$this->imageurl.'images/defaultuser.png';

		$this->DefualtUserImageurl=$this->imageurl.'images/user.png';
		$this->DefualtDiamondImageurl=$this->imageurl.'images/user.png';
		// $this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.jpg';
		// $this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.gif';
		$this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.png';

		$this->defaultnotiimageurl=$this->imageurl.'images/defaultnotification.png';
		$this->aboutusdefaultimg=$this->imageurl.'images/defaultaboutus.png';
		$this->defaultwaterimg=$this->imageurl.'images/defaultwater.png';
		$this->defualtdiamondimageurl=$this->imageurl.'images/defaultwater.png';
		$this->Defualtreportfileurl=$this->imageurl.'images/defaultwater.png';
		$this->PackageYesImgurl=$this->imageurl.'images/icon-v.svg';
		$this->PackageNoImgurl=$this->imageurl.'images/icon-x.svg';
		$this->PackagePricingImgurl=$this->imageurl.'images/pricing-bg.png';


		$this->PaymentSuccessImg=$this->imageurl.'images/payment-done.gif';
		$this->PaymentFailedImg=$this->imageurl.'images/payment-failed.gif';


		$this->PaymentApiKey='pk_live_51SpBX4LI3X4jRXK4tJFUZPWpIrNfIs7HHjysCWC6kqR207H9RfTDtT5hzPWq4adrFaUEBj8T2gpo0joGRCt1eViH00FzM7eCio';
		$this->PaymentEndPointKey='whsec_bzFjLZ1DhkYtAf7IfTnrCei5bcceM57j';
		$this->PaymentDomainUrl=$this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath;

		$this->socketurl='http://192.168.1.4:3001/socket.io/socket.io.js';
    }
    else if($this->servermode=="uat") // test 
    { 
		$this->docroot= $_SERVER['DOCUMENT_ROOT'].'/';
		$this->maindirpath='/Savanigems_New/';
		$this->dirpath=$this->maindirpath.''; /* Directory Name */
        $this->host=$_SERVER['HTTP_HOST'].$this->dirpath;
        $this->weburl = $this->protocol.$this->host;
		$this->docpath = $this->docroot;
        $this->cdnurl =  $this->protocol.$this->host;
        $this->regdomain = 'demo.instanceit.com/Savanigems_New';
        $this->mailurl = "demo.instanceit.com/Savanigems_New/";
		$this->endpointverson = 'v1.0/';
		$this->endpointurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath.'api/'.$this->endpointverson;
		$this->imageurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->maindirpath.'assets/';
		$this->page404url=$this->protocol.$this->host.$this->page404url;
		$this->nodatafound=$this->protocol.$this->host.'views/nodatafound.php';
		$this->nodatafoundworeset=$this->protocol.$this->host.'views/nodatafoundworeset.php';
		$this->reporturl=$this->protocol.$this->host.'report/';
		$this->pdfurl=$this->protocol.$this->host.'generatepdf/';

		$this->portalbaseurl=$this->protocol.$this->host.'client/';
		$this->PackageExpiredURL=$this->protocol.$this->host.'membershipplan';

		$this->defaultimageurl=$this->imageurl.'images/defaultitem.png';
		$this->defaultpackageimageurl=$this->imageurl.'images/defaultpackage.png';
		$this->defaultprofileimageurl=$this->imageurl.'images/defaultuser.png';

		$this->DefualtUserImageurl=$this->imageurl.'images/user.png';
		$this->DefualtDiamondImageurl=$this->imageurl.'images/user.png';
		// $this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.jpg';
		// $this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.gif';
		$this->DefualtJewelleryImageurl=$this->imageurl.'images/defaultjewellery.png';

		$this->defaultnotiimageurl=$this->imageurl.'images/defaultnotification.png';
		$this->aboutusdefaultimg=$this->imageurl.'images/defaultaboutus.png';
		$this->defaultwaterimg=$this->imageurl.'images/defaultwater.png';
		$this->defualtdiamondimageurl=$this->imageurl.'images/defaultwater.png';
		$this->Defualtreportfileurl=$this->imageurl.'images/defaultwater.png';
		$this->PackageYesImgurl=$this->imageurl.'images/icon-v.svg';
		$this->PackageNoImgurl=$this->imageurl.'images/icon-x.svg';
		$this->PackagePricingImgurl=$this->imageurl.'images/pricing-bg.png';

		$this->PaymentSuccessImg=$this->imageurl.'images/payment-done.gif';
		$this->PaymentFailedImg=$this->imageurl.'images/payment-failed.gif';

		$this->PaymentApiKey='sk_test_51UGjewAe5LkknzqKoRKF63T8FP1AHS71hOUyTGethNJPvkvBhYecD7NTYUVZ2dBpt5Iv0ZhiqNhVedUItJLWEJW300RMD16jC8';
		$this->PaymentEndPointKey='whsec_4GD6LrnwCNtUDdaxZczjIt5SGJgDsUVL';
		$this->PaymentDomainUrl=$this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath;

		$this->socketurl='http://192.168.1.4:3001/socket.io/socket.io.js';
    }
   

		
	$this->mssqldefval=array(
		'int'=>0,
		'bigint'=>0,
		'binary'=>'',
		'bit'=>0,
		'char'=>'',
		'date'=>'1900-01-01',
		'datetime'=>'1900-01-01 00:00:00',
		'datetime2'=>'1900-01-01 00:00:00',
		'datetimeoffset'=>'1900-01-01 00:00:00',
		'decimal'=>0,
		'float'=>0,
		'geography'=>'',
		'geometry'=>'',
		'hierarchyid'=>'',
		'image'=>'',
		'int'=>0,
		'money'=>0,
		'nchar'=>'',
		'ntext'=>'',
		'numeric'=>0,
		'nvarchar'=>'',
		'real'=>0,
		'smalldatetime'=>'1900-01-01 00:00:00',
		'smallint'=>0,
		'smallmoney'=>0,
		'sql_variant'=>'',
		'text'=>'',
		'time'=>'00:00:00',
		'timestamp'=>'DEFAULT',
		'tinyint'=>0,
		'uniqueidentifier'=>'00000000-0000-0000-0000-000000000000',
		'varbinary'=>(binary)'',
		'varchar'=>'',
		'xml'=>''
	);

	//mysql default value array 

	$this->mysqldefval=array(
		'bigint'=>0,
		'binary'=>'',
		'bit'=>0,
		'blob'=>'',
		'bool'=>'',
		'boolean'=>'',
		'char'=>'',
		'date'=>'0000-00-00',
		'datetime'=>'0000-00-00 00:00',
		'decimal'=>0,
		'double'=>0,
		'enum'=>'',
		'float'=>0,
		'int'=>0,
		'longblob'=>'',
		'longtext'=>'',
		'mediumblob'=>'',
		'mediumint'=>0,
		'mediumtext'=>'',
		'numeric'=>0,
		'real'=>0,
		'set'=>'',
		'smallint'=>0,
		'text'=>'',
		'time'=>'00:00:00',
		'timestamp'=>'0000-00-00 00:00',
		'tinyblob'=>'',
		'tinyint'=>0,
		'tinytext'=>'',
		'varbinary'=>'',
		'varchar'=>'',
		'year'=>'0000'
	);


	//for error message

	$this->errmsg=array(
		'insert'=>'Data inserted successfully.',
		'update'=>'Data updated successfully.',
		'delete'=>'Data deleted successfully.',
		'reqired'=>'Please fill in all required fields.',
		'required'=>'Please fill in all required fields.',
		'inuse'=>'Data is already in use.',
		'isexist'=>'Data already exist.',
		'dberror'=>'Something went wrong, Error Code : ',
		'userright'=>"Sorry, You don't have enough permissions to perform this action",
		'size'=>"Sorry, You don't have enough permissions to perform this action",
		'type'=>"Sorry, You don't have enough permissions to perform this action.",
		'success'=>"Data found",
		'error'=>"Error",
		'nodatafound'=>"No data found",
		'uservalidate'=>"User Validate.",
		'deactivate'=>"Your account is suspended, please contact administrator to activate account.",
		'invalidrequest'=>"Invalid request.",
		'sessiontimeout'=>"Session timeout",
		'dataduplicate'=>"Data Duplicated Succesfully",
		'tokenvalidate'=>"Token validated",
		'invalidtoken'=>"Invalid token.",
		'usernotfound'=>"User not found",
		'invalidusername'=>"Invalid Username or Password.",
		'invalidpassword'=>"Invalid Username or Password..",
		'verifyemail'=>"Please verify your email addess",
		'filetype'=>"Invalid file extension",
		'loginright'=>"Sorry, You don't have enough permissions to login. Please contact admin",
		'somethingwrong'=>'Sorry, something went wrong.',
		'registersuccess'=>"Login Successfully",
		'loginsuccess'=>"Login Successfully",
		'logoutsuccess'=>"Logout Successfully",
		'appupdate'=>"We have released new version of a.r. chemicals App. Download the update and install to continue use this App.",
		'profile-update'=>"Profile updated successfully",
		'passchanged'=>"Password changed successfully",
		'correctpass'=>"Please enter correct old password",
		'csvdownload'=>"CSV downloaded successfully",
		'invalidbarcode'=>"Invalid barcode",
		'itemalreadyassign'=>"Item already assigned",
		'itemassign'=>"Item assigned successfully",
		'itemreassign'=>"Item reassigned successfully",
		'newnodeadd'=>"New Nodes added successfully",
		'nodedelnot'=>"Can't delete super admin node",
		'nodedel'=>"Node deleted successfully",
		'noitemfound'=>"No item found",
		'cancelorditem'=>"Order item cancelled successfully",
		'reqorderseries'=>"Order series data is required",
		'nonotifound'=>"No notification found",
		'isexistmobile'=>'Mobile number already exist.',
		'isexistemail'=>'Email already exist.',
		'notregsocial'=>'Not registered with us',
		'passreset'=>'Password reseted successfully.',
		'invaliduser'=>'Invalid Username.',
		'sendotp'=>'Verification Code Send to Your user name',
		'invalidotp'=>'Invalid Verification Code',
		'validotp'=>'Valid Verification Code.',
		'requireforgotusername'=>'Please enter mobile number or email',
		'forgototpsuccess'=>'OTP has been sent to your registered email address and mobile number',
		'wrongotp'=>'You have entered wrong OTP',
		'generalinfo'=>'General Info is required',
		'foodinfo'=>'Food Info is required',
		'measurementinfo'=>'Measurements Info is required',
		'nodietplanfound'=>'Diet plan not found',
		'monthyearnotfound'=>'Month and year not found',
		'foodalreadydone'=>'This diet plan food is already completed',
		'fooddone'=>'Your food has been completed',
		'foodinsert'=>'Food data inserted successfully',
		'nowaterfound'=>'Water glass not found',
		'waterdone'=>'Water glass has been drunk successfully',
		'wateralreadydone'=>'Water glass is already drunk',
		'waterinsert'=>'Water glass data inserted successfully',
		'noworkfound'=>'Workout not found',
		'workdone'=>'Your workout has been completed successfully',
		'workalreadydone'=>'Your workout has been already completed',
		'workinsert'=>'Workout data inserted successfully',
		'nopackagefound'=>'Packages not found',
		'couponreqired'=>'Please enter coupon code.',
		'validcouponreqired'=>'Please enter valid coupon code.',
		'couponusagelimit'=>'Coupon usage limit reached.',
		'couponnotapply'=>"This coupon code can't applied.",
		'couponapply'=>"Coupon code applied successfully.",
		'orderplace'=>"Your order has been placed successfully",
		'meetingsuccess'=>"Your meeting slot has been booked successfully",
		'nopackage'=>"Sorry, currently you don't have any active package",
		'novalidpackage'=>"Sorry, your package has been not valid on #date#",
		'nomeetingsession'=>"Sorry, currently you have no any session available. Please buy package and try again",
		'slotbooked'=>"Meeting Slot is already booked",
		'invalidrate'=>"Invalid rating",
		'sendotptoemail'=>"We have sent you 6 digit verification code on <a class='text-blue' href='javascript:void(0);'>#email#</a>.",
		'registeredemail'=>"Email address already registered.",
		'packageassigned'=>"Package assigned successfully.",
		'invalidpwd'=>"Invalid Password.",
		'invalidcpassword'=>"Password doesn't match with confirm password.",
		'otprequired'=>"Verification code is required.",
		'emailnotregistered'=>"Email address not registered.",
		'emailpwdrequired'=>"Email address and password is required.",
		'invalidoldpwd'=>"Invalid old password.",
		'diamondinsert'=>"Diamond uploaded successfully.",
		'diamondupdate'=>"Diamond updated successfully.",
		'diamonddelete'=>"Diamond deleted successfully.",
		'nodiamondfound'=>"No Diamond Found.",
		'nobuyrequestfound'=>"No Buy Request Found.",
		'nojewelleryfound'=>"No Jewellery Found.",
		'seriesrequired'=>"Series required for add data.",
		'diamondupriceinsert'=>"Diamond price added successfully.",
		'diamondupriceupdate'=>"Diamond price updated successfully.",
		'diamondupricedelete'=>"Diamond price deleted successfully.",
		'invalidfile'=>"Please select valid file.",
		'diamondupriceexist'=>"Diamond price already exist.",
		'nodiamonduprice'=>"No diamond price found.",
		'packageactive'=>"This package is currently activated.",
		'packageunavailable'=>"This package is currently not available.",
		'jewelleryinsert'=>"Jewellery added successfully.",
		'jewelleryupdate'=>"Jewellery updated successfully.",
		'jewellerydelete'=>"Jewellery deleted successfully.",
		'invalidfppassword'=>"New password doesn't match with confirm password.",
		'jewelleryaddfavorite'=>"#jewelleryname# added to favorite.",
		'jewelleryremovefavorite'=>"#jewelleryname# removed from favorite.",
		'buyrequestinsert'=>"Buy request added successfully.",
		'buyrequestupdate'=>"Buy request updated successfully.",
		'buyrequestdelete'=>"Buy request deleted successfully.",
		'filesel'=>"Please select file",
		'diamondshared'=>"Diamond shared successfully.",
		'jewelleryshared'=>"Jewellery shared successfully.",
		'messagesend'=>"Message send successfully.",
		'stocknumberexist'=>"Stock Number already exist.",
		'noactiveplan'=>"No Active Plan Available.",
		'couponcoderequired'=>"Coupon code is required.",
		'couponapplied'=>"Coupon applied.",
		'couponremoved'=>"Coupon code removed successfully.",
		'minispendcoupon'=>"Please spend minimum #minispendamt# amount to apply this coupon",
		'maxspendcoupon'=>"Please spend maximum #maxspendamt# amount to apply this coupon",
		'couponlimitreach'=>"Coupon usage limit reached.",
		'couponnotapplied'=>"This coupon code can't applied.",
		'couponapplied'=>"Coupon code applied successfully.",
		'couponexpired'=>"This coupon has been expired.",
		'invalidcoupon'=>"Please enter valid coupon code.",
		'couponrequired'=>"Please enter coupon code.",
		'couponcodeexpired'=>"This coupon code is expired.",
		'permissionrequired'=>"Sorry, You don't have enough permissions.Please buy or upgrade plan.",
		'couponalreadyremoved'=>"Coupon already removed.",
		'invalidtransaction'=>"Invalid Transaction Request.",
		'transactionsuccess'=>"Your Transaction Successfully Completed.",
		'transactionincomplete'=>"Your Transaction Successfully Completed,But Your Payment Temporarily On Hold.",
		'transactionfailed'=>"Your Transaction Failed.",
		'diamondlimitover'=>"Your diamond upload limit is over.",
		'diamonpriceupdate'=>"Your diamon price has been updated",
		'productrequestsent'        => "Request sent to seller. You will be notified once the seller approves.",
		'productrequestpending'     => "You already have a pending request for this product.",
		'ownproductrequest'         => "You can not send a request on your own product.",
		'productrequestapproved'    => "Request approved. Opening chat...",
		'productrequestcancelled'   => "Request cancelled successfully.",
		'productrequestprocessed'   => "This request is already processed.",
		'productrequestnotfound'    => "Request not found.",
		'productnotavailable'       => "Product is no longer available.",
		'unauthorizedaction'        => "You are not authorized for this action.",
		'dbtransactionerror'        => "Something went wrong. Please try again.",

	);   
}


    
    public function getErrmsg(){
		return $this->errmsg;
	}
    
    public function getMssqldefval(){
		return $this->weburl;
	}
	
    public function getMysqldefval(){
		return $this->weburl;
	}

    public function getWeburl(){
		return $this->weburl;
	}

	public function setportalbaseurl($portalbaseurl){
		$this->portalbaseurl = $portalbaseurl;
	}
 	public function getportalbaseurl(){
		return $this->portalbaseurl;
	}
	

	public function setWeburl($weburl){
		$this->weburl = $weburl;
	}

	public function getEndpointverson(){
		return $this->endpointverson;
	}

	public function setEndpointverson($endpointverson){
		$this->endpointverson = $endpointverson;
	}
	
	public function getEndpointurl(){
		return $this->endpointurl;
	}

	public function setEndpointurl($endpointurl){
		$this->endpointurl = $endpointurl;
	}

	public function getDocurl(){
		return $this->docurl;
	}

	public function setDocurl($docurl){
		$this->docurl = $docurl;
	}

	public function getRegdomain(){
		return $this->regdomain;
	}

	public function setRegdomain($regdomain){
		$this->regdomain = $regdomain;
	}

	public function getMailurl(){
		return $this->mailurl;
	}

	public function setMailurl($mailurl){
		$this->mailurl = $mailurl;
	}

	public function getProtocol(){
		return $this->protocol;
	}

	public function setProtocol($protocol){
		$this->protocol = $protocol;
	}

	public function getDocpath(){
		return $this->docpath;
	}

	public function setDocpath($docpath){
		$this->docpath = $docpath;
	}
	public function setCdnurl($cdnurl){
		$this->cdnurl = $cdnurl;
	}

	public function getCdnurl(){
		return $this->cdnurl;
	}


	public function getServermode(){
		return $this->servermode;
	}

	public function setServermode($servermode){
		$this->servermode = $servermode;
	}

	public function getMainDirpath(){
		return $this->maindirpath;
	}

	public function setMainDirpath($maindirpath){
		$this->maindirpath = $maindirpath;
	}

	public function getDirpath(){
		return $this->dirpath;
	}

	public function setDirpath($dirpath){
		$this->dirpath = $dirpath;
	}

	/* public function getMainDB(){
		return $this->MainDB;
	}

	public function setMainDB($MainDB){
		$this->MainDB = $MainDB;
	}

	public function getDB(){
		return $this->DB;
	}

	public function setDB($DB){
		$this->DB = $DB;
	}

	public function getMainDBUser(){
		return $this->MainDBUser;
	}

	public function setMainDBUser($MainDBUser){
		$this->MainDBUser = $MainDBUser;
	}

	public function getDBUser(){
		return $this->DBUser;
	}

	public function setDBUser($DBUser){
		$this->DBUser = $DBUser;
	}

	public function getMainDBHost(){
		return $this->MainDBHost;
	}

	public function setMainDBHost($MainDBHost){
		$this->MainDBHost = $MainDBHost;
	}

	public function getDBHost(){
		return $this->DBHost;
	}

	public function setDBHost($DBHost){
		$this->DBHost = $DBHost;
	}

	public function getMainDBPass(){
		return $this->MainDBPass;
	}

	public function setMainDBPass($MainDBPass){
		$this->MainDBPass = $MainDBPass;
	}

	public function getDBPass(){
		return $this->DBPass;
	}

	public function setDBPass($DBPass){
		$this->DBPass = $DBPass;
	}

	public function getMainDBPort(){
		return $this->MainDBPort;
	}

	public function setMainDBPort($MainDBPort){
		$this->MainDBPort = $MainDBPort;
	}

	public function getDBPort(){
		return $this->DBPort;
	}

	public function setDBPort($DBPort){
		$this->DBPort = $DBPort;
	}

    public function getDBType(){
		return $this->DBType;
	}

	public function setDBType($DBType){
		$this->DBType = $DBType;
	} */
    
	public function getSessionName(){
		return $this->sessionname;
	}

	public function getAdminutype(){
		return $this->adminutype;
	}
	
	public function getSubAdminutype(){
		return $this->subadminutype;
	}
	
	public function getSalesHeadutype(){
		return $this->salesheadutype;
	}

	public function getVendorutype(){
		return $this->vendorutype;
	}

	public function getCustomerutype(){
		return $this->customerutype;
	}

	public function getSaveSidebar(){
		return $this->savesidebar;
	}

	public function getSubmitbutton(){
		return $this->submitbutton;
	}

	public function getGeneratereport(){
		return $this->generatereport;
	}
	
	public function getApplyFilterSidebar(){
		return $this->applyfiltersidebar;
	}

	public function getUpdateSidebar(){
		return $this->updatesidebar;
	}
	
	public function getResetSidebar(){
		return $this->resetsidebar;
	}
	
	public function getCloseSidebar(){
		return $this->closesidebar;
	}

	public function getUpdateMyProfile(){
		return $this->updatemyprofile;
	}

	public function getChangePassword(){
		return $this->changepassword;
	}

	public function getChangeUsertype(){
		return $this->changeusertype;
	}
	
	public function getPage404url(){
		return $this->page404url;
	}
	
	public function getImageurl(){
		return $this->imageurl;
	}

	public function getNoDataFound(){
		return $this->nodatafound;
	}

	public function getNoDataFoundwoReset(){
		return $this->nodatafoundworeset;
	}

	public function getReporturl(){
		return $this->reporturl;
	}

	public function getCmpRegisterId(){
		return $this->cmpregisterid;
	}

	public function getCmpUnRegisterId(){
		return $this->cmpunregisterid;
	}

	public function getCompositionSchemeId(){
		return $this->cmpcompositionschemeid;
	}

	public function getPdfurl(){
		return $this->pdfurl;
	}
	

	public function getStateId(){
		return $this->stateid;
	}

	public function getPatientId(){
		return $this->patientid;
	}

	public function getDefaultBirthDate(){
		return $this->defaultbirthdate;
	}

	public function getAdminUserId(){
		return $this->adminuid;
	}

	public function getDefaultCmpId(){
		return $this->defaultcmpid;
	}

	public function setDefaultCmpId($defaultcmpid){
		$this->defaultcmpid = $defaultcmpid;
	}
	
	public function getDefaultImageurl(){
		return $this->defaultimageurl;
	}

	public function getDefaultPackageImageurl(){
		return $this->defaultpackageimageurl;
	}

	public function getDefaultProfileImageurl(){
		return $this->defaultprofileimageurl;
	}

	public function setDefualtDiamondImageurl($DefualtDiamondImageurl){
		$this->DefualtDiamondImageurl = $DefualtDiamondImageurl;
	}

	public function getDefualtDiamondImageurl(){
		return $this->DefualtDiamondImageurl;
	}

	public function setDefualtJewelleryImageurl($DefualtJewelleryImageurl){
		$this->DefualtJewelleryImageurl = $DefualtJewelleryImageurl;
	}

	public function getDefualtJewelleryImageurl(){
		return $this->DefualtJewelleryImageurl;
	}

	public function setDefualtreportfileurl($Defualtreportfileurl){
		$this->Defualtreportfileurl = $Defualtreportfileurl;
	}

	public function getDefualtreportfileurl(){
		return $this->Defualtreportfileurl;
	}

	public function getDefaultNotiImageurl(){
		return $this->defaultnotiimageurl;
	}
	public function getsocketurl(){
		return $this->socketurl;
	}

	public function getTermsConditionId(){
		return $this->termsconditionsid;
	}
	public function getAboutUsId(){
		return $this->aboutusid;
	}
	public function getMissionId(){
		return $this->missionid;
	}
	public function getVissionId(){
		return $this->vissionid;
	}
	public function getValuesId(){
		return $this->valuesid;
	}
	public function getPrivacyPolicyId(){
		return $this->privacypolicyid;
	}

	public function getOurSevicesid()
	{
		return $this->ourservicesid;
	}


	public function getAboutTechChemid(){
		return $this->abouttechchemid;
	}

	public function getHomeId(){
		return $this->homeid;
	}
	public function getQualityPolicyId(){
		return $this->qualitypolicy;
	}
	public function getContactusId(){
		return $this->contactusid;
	}

	public function getCookiesid()
	{
		return $this->cookiesid;
	}
	public function getDealerTrustid()
	{
		return $this->dealertrustid;
	}
	public function getBusinextProcessCmpid()
	{
		return $this->businextprocesscmpid;
	}

	public function getInsurancePolicyid()
	{
		return $this->insurancepolicyid;
	}

	public function getEconomicAnalysisid()
	{
		return $this->economicanalysis;
	}

	public function getOrganizationalBehaviourid()
	{
		return $this->organizationalbehaviourid;
	}
	public function getAboutUsReliableMotorId(){
		return $this->aboutusreliablemotorid;
	}

	public function setcustomerutypeid($customerutypeid){
		$this->customerutypeid = $customerutypeid;
	}

	public function getcustomerutypeid()
	{
		return $this->customerutypeid;
	}

	public function getDefualtUserImageurl()
	{
		return $this->DefualtUserImageurl;
	}

	public function setDefualtUserImageurl($DefualtUserImageurl){
		$this->DefualtUserImageurl = $DefualtUserImageurl;
	}

	public function getPackageYesImgurl()
	{
		return $this->PackageYesImgurl;
	}

	public function setPackageYesImgurl($PackageYesImgurl){
		$this->PackageYesImgurl = $PackageYesImgurl;
	}

	public function getPackageNoImgurl()
	{
		return $this->PackageNoImgurl;
	}

	public function setPackageNoImgurl($PackageNoImgurl){
		$this->PackageNoImgurl = $PackageNoImgurl;
	}

	public function getPackagePricingImgurl()
	{
		return $this->PackagePricingImgurl;
	}

	public function setPackagePricingImgurl($PackagePricingImgurl){
		$this->PackagePricingImgurl = $PackagePricingImgurl;
	}

	public function getDiamondjewelryexpday(){
		return $this->diamondjewelryexpday;
	}

	public function setDiamondjewelryexpday($diamondjewelryexpday){
		$this->diamondjewelryexpday = $diamondjewelryexpday;
	}

	public function getPackageExpiredTitle(){
		return $this->PackageExpiredTitle;
	}

	public function setPackageExpiredTitle($PackageExpiredTitle){
		$this->PackageExpiredTitle = $PackageExpiredTitle;
	}

	public function getPackageExpiredMessage(){
		return $this->PackageExpiredMessage;
	}

	public function setPackageExpiredMessage($PackageExpiredMessage){
		$this->PackageExpiredMessage = $PackageExpiredMessage;
	}

	public function getPackageExpiredURL(){
		return $this->PackageExpiredURL;
	}

	public function setPackageExpiredURL($PackageExpiredURL){
		$this->PackageExpiredURL = $PackageExpiredURL;
	}

	public function getPaymentApiKey(){
		return $this->PaymentApiKey;
	}

	public function setPaymentApiKey($PaymentApiKey){
		$this->PaymentApiKey = $PaymentApiKey;
	}

	public function getPaymentDomainUrl(){
		return $this->PaymentDomainUrl;
	}

	public function setPaymentDomainUrl($PaymentDomainUrl){
		$this->PaymentDomainUrl = $PaymentDomainUrl;
	}

	public function getPaymentSuccessImg(){
		return $this->PaymentSuccessImg;
	}

	public function setPaymentSuccessImg($PaymentSuccessImg){
		$this->PaymentSuccessImg = $PaymentSuccessImg;
	}

	public function getPaymentFailedImg(){
		return $this->PaymentFailedImg;
	}

	public function setPaymentFailedImg($PaymentFailedImg){
		$this->PaymentFailedImg = $PaymentFailedImg;
	}

	public function getPaymentEndPointKey(){
		return $this->PaymentEndPointKey;
	}

	public function setPaymentEndPointKey($PaymentEndPointKey){
		$this->PaymentEndPointKey = $PaymentEndPointKey;
	}

	public function getDevicedeletemin(){
		return $this->devicedeletemin;
	}

	public function getSendexpiryemailbefore(){
		return $this->sendexpiryemailbefore;
	}

	public function setSendexpiryemailbefore($sendexpiryemailbefore){
		$this->sendexpiryemailbefore = $sendexpiryemailbefore;
	}

	public function getSendexpiryemailafter(){
		return $this->sendexpiryemailafter;
	}

	public function setSendexpiryemailafter($sendexpiryemailafter){
		$this->sendexpiryemailafter = $sendexpiryemailafter;
	}
}


?>