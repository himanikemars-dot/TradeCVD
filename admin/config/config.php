<?php 
require_once dirname(__DIR__, 2).'/config/constant.php'; 

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

	private $termsconditionsid;
	private $aboutusreliablemotorid;
	private $privacypolicyid;
	private $missionid;
	private $vissionid;
	private $qualitypolicy;
	private $ourservicesid;
	
	private $customerutypeid;

	private $abouttechchemid;
	private $contactusid;

	private $homeid;
	private $cookiesid;
	private $dealertrustid;
	private $businextprocesscmpid;

	private $insurancepolicyid;
	private $economicanalysis;
	private $organizationalbehaviourid;

	private $PaymentApiKey;
	private $PaymentDomainUrl;

    function  __construct()
	{
		date_default_timezone_set("Asia/Kolkata");        
		
		// $this->protocol = 'http://';  // http:// or https://
		// $this->servermode= 'dev'; // prod - Live | uat - test | dev = development

		$constant = new constant();
		
		$this->protocol = $constant->getprotocolname();  // http:// or https://
		$this->servermode= $constant->getservermodename(); // prod - Live | uat - test | dev = development

		

		//  project lavel configuration 
		$this->sessionname='savanigems_10082022';
		$this->adminutype='98F2B6E0-240A-457B-853A-A0079862315F';
		$this->subadminutype='16E4339F-FFDB-4ACF-95C9-1B617FD47D4F';
		$this->salesheadutype='065F600D-858C-43AE-89A9-1FFFCB002FD5';
		$this->vendorutype='A9C9678F-4093-407F-82D4-12692161BE02';
		$this->customerutype='24D7E055-D61C-4B4D-B40C-284AC129C2B9';
		$this->page404url='/views/404';

		$this->adminuid='034FB884-A865-4127-B90B-3D06047A72CC';


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

		$this->stateid='65754311-A0BB-4A7F-9043-05670385BF13';

		$this->defaultcmpid='B3E18DB5-2A63-4C02-B763-0D3D4A9057CA';

		$this->customerutypeid='24D7E055-D61C-4B4D-B40C-284AC129C2B9';

		// for Content setting

		$this->termsconditionsid='5953856C-1D54-45D5-A44E-088C70309FEA';
		$this->aboutusreliablemotorid='0B7FCE31-D38E-4517-937A-0F401129F952';
		$this->privacypolicyid='FC748AEC-89AA-4607-A480-1324B7ED9627';
		$this->missionid='DAEE6839-BCEF-46E5-AFBA-0F105D40DD92';
		$this->vissionid='A3D3DB6F-34AF-4E17-BC7D-D71C8D82A2D9';
		$this->qualitypolicy='2465B7CA-2908-4574-BDC7-2ABE858398C6';
		$this->ourservicesid = '26654A7B-2FFB-4B41-8392-1BDD6DCC68C7';
		$this->abouttechchemid = '2DFAF9F4-52F8-4845-B5CD-0C097D53B29F';
		$this->homeid='5772406D-A1AE-4379-9ABA-163697A00BE5';
		$this->contactusid='464A25B0-6870-491E-A3F6-2434DBEE1063';
		$this->cookiesid='F6FF5999-6478-4991-8E36-16A2E5B747DE';
		$this->dealertrustid='3FBCE703-0FD2-417F-99BC-2664495850H2';
		$this->businextprocesscmpid='E5650913-538F-4399-9517-083E44397AEE';

		$this->insurancepolicyid='001F2A8D-D671-470E-BDFF-212370C7A0C0';
		$this->economicanalysis='EC756227-A07F-42BA-92AB-1C0804D68F02';
		$this->organizationalbehaviourid='68A44D0E-2515-4AD9-AF86-1C8458B7711A';
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
        $this->dirpath=$this->maindirpath.'admin/';  /* Directory Name also look in index.php script tag*/
        $this->host=$_SERVER['HTTP_HOST'].$this->dirpath;
        $this->weburl = $this->protocol.$this->host;
		$this->docpath = $this->docroot;
        $this->cdnurl =  $this->protocol.$this->host;
        $this->regdomain = '192.168.1.2';
        $this->mailurl = "192.168.1.2/Savanigems_New/admin/";
		$this->endpointverson = 'v1.0/';
		$this->endpointurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath.'api/'.$this->endpointverson;
		$this->imageurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->maindirpath.'assets/';
		$this->page404url=$this->protocol.$this->host.$this->page404url;
		$this->nodatafound=$this->protocol.$this->host.'views/nodatafound.php';
		$this->nodatafoundworeset=$this->protocol.$this->host.'views/nodatafoundworeset.php';

		$this->defaultimageurl=$this->imageurl.'images/defaultitem.png';
		$this->defaultpackageimageurl=$this->imageurl.'images/defaultpackage.png';
		$this->defaultprofileimageurl=$this->imageurl.'images/defaultuser.png';
		
		$this->defaultnotiimageurl=$this->imageurl.'images/defaultnotification.png';
		$this->socketurl='http://192.168.1.4:3001/socket.io/socket.io.js';

		$this->PaymentApiKey='sk_test_51M3SBoG5QHlTrrZxVJuPdytA9vMPIQQAiE9kkZq4zvHNwOHmigtfcJ6rI9Bczj1V2rN7571SUXKhCigC6AGLCOKT00gONEhB3x';
		$this->PaymentDomainUrl=$this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath;
		
    }
    else if($this->servermode=="prod") // live 
    {
		$this->docroot= $_SERVER['DOCUMENT_ROOT'].'/';
		$this->maindirpath='/';
		$this->dirpath=$this->maindirpath.'admin/'; /* Directory Name */
        $this->host=$_SERVER['HTTP_HOST'].$this->dirpath;
        $this->weburl = $this->protocol.$this->host.'/';
		$this->docpath = $this->docroot;
        $this->cdnurl = $this->protocol.$this->host;
        $this->regdomain = 'tradecvd.com';
        $this->mailurl = "tradecvd.com/admin/";
		$this->endpointverson = 'v1.0/';
		$this->endpointurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath.'api/'.$this->endpointverson;
		$this->imageurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->maindirpath.'assets/';
		$this->page404url=$this->protocol.$this->host.$this->page404url;
		$this->nodatafound=$this->protocol.$this->host.'views/nodatafound.php';
		$this->nodatafoundworeset=$this->protocol.$this->host.'views/nodatafoundworeset.php';

		$this->defaultimageurl=$this->imageurl.'images/defaultitem.png';
		$this->defaultpackageimageurl=$this->imageurl.'images/defaultpackage.png';
		$this->defaultprofileimageurl=$this->imageurl.'images/defaultuser.png';
		
		$this->defaultnotiimageurl=$this->imageurl.'images/defaultnotification.png';
		$this->socketurl='http://192.168.1.4:3001/socket.io/socket.io.js';

		$this->PaymentApiKey='sk_test_51M3SBoG5QHlTrrZxVJuPdytA9vMPIQQAiE9kkZq4zvHNwOHmigtfcJ6rI9Bczj1V2rN7571SUXKhCigC6AGLCOKT00gONEhB3x';
		$this->PaymentDomainUrl=$this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath;
    }
    else if($this->servermode=="uat") // test 
    { 
		$this->docroot= $_SERVER['DOCUMENT_ROOT'].'/';
		$this->maindirpath='/Savanigems_New/';
		$this->dirpath=$this->maindirpath.'admin/'; /* Directory Name */
        $this->host=$_SERVER['HTTP_HOST'].$this->dirpath;
        $this->weburl = $this->protocol.$this->host;
		$this->docpath = $this->docroot;
        $this->cdnurl =  $this->protocol.$this->host;
        $this->regdomain = 'demo.instanceit.com/savanigems';
        $this->mailurl = "demo.instanceit.com/savanigems/admin/";
		$this->endpointverson = 'v1.0/';
		$this->endpointurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath.'api/'.$this->endpointverson;
		$this->imageurl = $this->protocol.$_SERVER['HTTP_HOST'].$this->maindirpath.'assets/';
		$this->page404url=$this->protocol.$this->host.$this->page404url;
		$this->nodatafound=$this->protocol.$this->host.'views/nodatafound.php';
		$this->nodatafoundworeset=$this->protocol.$this->host.'views/nodatafoundworeset.php';

		$this->defaultimageurl=$this->imageurl.'images/defaultitem.png';
		$this->defaultpackageimageurl=$this->imageurl.'images/defaultpackage.png';
		$this->defaultprofileimageurl=$this->imageurl.'images/defaultuser.png';
		
		$this->defaultnotiimageurl=$this->imageurl.'images/defaultnotification.png';
		$this->socketurl='http://192.168.1.4:3001/socket.io/socket.io.js';

		$this->PaymentApiKey='sk_test_51M3SBoG5QHlTrrZxVJuPdytA9vMPIQQAiE9kkZq4zvHNwOHmigtfcJ6rI9Bczj1V2rN7571SUXKhCigC6AGLCOKT00gONEhB3x';
		$this->PaymentDomainUrl=$this->protocol.$_SERVER['HTTP_HOST'].$this->dirpath;
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
		'appupdate'=>"We have released new version of archemicals App. Download the update and install to continue use this App.",
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
		'requireforgotusername'=>'Please enter mobile number or email',
		'forgototpsuccess'=>'OTP has been sent to your registered email address and mobile number',
		'wrongotp'=>'You have entered wrong OTP',
		'videofiletype'=>"Invalid file extension for Upload Video",
		'imgrequired'=>"Image is required",
		'imgremoved'=>"Image removed successfully.",
		'isexistusername'=>"Username already exist",
		'disordexist'=>"Display Order Already Exists",
		'logoutalldevice'=>"Logout from all device successfully.",
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

	public function getCdnurl(){
		return $this->cdnurl;
	}

	public function setCdnurl($cdnurl){
		$this->cdnurl = $cdnurl;
	}

	public function getServermode(){
		return $this->servermode;
	}

	public function setcustomerutypeid($customerutypeid){
		$this->customerutypeid = $customerutypeid;
	}

	public function getcustomerutypeid()
	{
		return $this->customerutypeid;
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

	public function getMainDB(){
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
	}
    
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

	public function getDefaultNotiImageurl(){
		return $this->defaultnotiimageurl;
	}
	public function getsocketurl(){
		return $this->socketurl;
	}

	public function getAboutusDefaultImg(){
		return $this->aboutusdefaultimg;
	}

	public function getTermsConditionId(){
		return $this->termsconditionsid;
	}
	public function getAboutUsReliableMotorId(){
		return $this->aboutusreliablemotorid;
	}
	public function getMissionId(){
		return $this->missionid;
	}
	public function getVissionId(){
		return $this->vissionid;
	}
	public function getQualityPolicyId(){
		return $this->qualitypolicy;
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
}


?>