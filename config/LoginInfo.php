<?php 


class LoginInfo{
    
	public function __construct()
	{
	
	}

	public $iss;
	public $key;
	public $username;
	public $uid;
	public $utypeid;
	public $cmpid;
	public $cmpname;
	public $branchid;
	public $fullname;
	public $adlogin;
	public $unqkey;
	public $yearid;
	public $yearname;
	public $activeyearid;
	public $userrights=array();
	public $dashuserrights=array();

	private $activeuserrole;
	private $activeuserroleid;
	private $activeuserrolename;
	private $companyname;

	private $activecompany;
	private $activecompanyid;

	private $activeUserid;
	private $activeUsername;

	private $isdefaultcmp;

	public $couponapply;
	public $couponid;
	public $couponcode;
	public $coupontype;
	public $couponamount;
	public $couponpercent;
	public $packageformonths;

	public $website_iss;
	public $website_unqkey;
	public $website_key;
	public $website_uid;
	public $website_utypeid;
	public $website_fullname;
	public $website_isguestuser;

	public $email;
	public $contact;
	public $persontype;
	public $isguestuser;
	public $profilepic;
	
	public function getIss(){
		return $this->iss;
	}

	public function setIss($iss){
		$this->iss = $iss;
	}

	public function getKey(){
		return $this->key;
	}

	public function setKey($key){
		$this->key = $key;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}
	
	public function getUid(){
		return $this->uid;
	}

	public function setUid($uid){
		$this->uid = $uid;
	}

	public function getUtypeid(){
		return $this->utypeid;
	}

	public function setUtypeid($utypeid){
		$this->utypeid = $utypeid;
	}

	public function getCmpid(){
		return $this->cmpid;
	}

	public function setCmpid($cmpid){
		$this->cmpid = $cmpid;
	}	

	public function getCmpname(){
		return $this->cmpname;
	}

	public function setCmpname($cmpname){
		$this->cmpname = $cmpname;
	}	
	
	public function getBranchid(){
		return $this->branchid;
	}

	public function setBranchid($branchid){
		$this->branchid = $branchid;
	}

	public function getFullname(){
		return $this->fullname;
	}

	public function setFullname($fullname){
		$this->fullname = $fullname;
	}

	public function getAdlogin(){
		return $this->adlogin;
	}

	public function setAdlogin($adlogin){
		$this->adlogin = $adlogin;
	}

	public function getUnqkey(){
		return $this->unqkey;
	}

	public function setUnqkey($unqkey){
		$this->unqkey = $unqkey;
	}

	public function getYearid(){
		return $this->yearid;
	}

	public function setYearid($yearid){
		$this->yearid = $yearid;
	}

	public function getYearname(){
		return $this->yearname;
	}

	public function setYearname($yearname){
		$this->yearname = $yearname;
	}

	public function getActiveyearid(){
		return $this->activeyearid;
	}

	public function setActiveyearid($activeyearid){
		$this->activeyearid = $activeyearid;
	}

	public function getUserrights(){
		return $this->userrights;
	}

	public function setUserrights($userrights){
		$this->userrights = $userrights;
	}


	public function getdashUserrights(){
		return $this->dashuserrights;
	}

	public function setdashUserrights($dashuserrights){
		$this->dashuserrights = $dashuserrights;
	}


	public function getActiveuserrole(){
		return $this->activeuserrole;
	}

	public function setActiveuserrole($activeuserrole){
		$this->activeuserrole = $activeuserrole;
	}
	
	public function getActiveuserroleid(){
		return $this->activeuserroleid;
	}

	public function setActiveuserroleid($activeuserroleid){
		$this->activeuserroleid = $activeuserroleid;
	}

	public function getActiveuserrolename(){
		return $this->activeuserrolename;
	}

	public function setActiveuserrolename($activeuserrolename){
		$this->activeuserrolename = $activeuserrolename;
	}


	public function getActivecompany(){
		return $this->activecompany;
	}

	public function setActivecompany($activecompany){
		$this->activecompany = $activecompany;
	}

	public function getActivecompanyid(){
		return $this->activecompanyid;
	}

	public function setActivecompanyid($activecompanyid){
		$this->activecompanyid = $activecompanyid;
	}

	public function getactiveUserid(){
		return $this->activeUserid;
	}

	public function setactiveUserid($activeUserid){
		$this->activeUserid = $activeUserid;
	}

	public function getactiveUsername(){
		return $this->activeUsername;
	}

	public function setactiveUsername($activeUsername){
		$this->activeUsername = $activeUsername;
	}

	public function getIsdefaultcmp(){
		return $this->isdefaultcmp;
	}

	public function setIsdefaultcmp($isdefaultcmp){
		$this->isdefaultcmp = $isdefaultcmp;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getContact(){
		return $this->contact;
	}

	public function setContact($contact){
		$this->contact = $contact;
	}

	public function getPersontype(){
		return $this->persontype;
	}

	public function setPersontype($persontype){
		$this->persontype = $persontype;
	}

	public function getIsguestuser(){
		return $this->isguestuser;
	}

	public function setIsguestuser($isguestuser){
		$this->isguestuser = $isguestuser;
	}

	public function getProfilepic(){
		return $this->profilepic;
	}

	public function setProfilepic($profilepic){
		$this->profilepic = $profilepic;
	}

	public function getCompanyname(){
		return $this->companyname;
	}

	public function setCompanyname($companyname){
		$this->companyname = $companyname;
	}

	public function getcouponapply()
	{
		return $this->couponapply;
	}

	public function setcouponapply($couponapply)
	{
		$this->couponapply = $couponapply;
	}

	public function getcouponid()
	{
		return $this->couponid;
	}

	public function setcouponid($couponid)
	{
		$this->couponid = $couponid;
	}

	public function getcouponcode()
	{
		return $this->couponcode;
	}

	public function setcouponcode($couponcode)
	{
		$this->couponcode = $couponcode;
	}

	public function getcoupontype()
	{
		return $this->coupontype;
	}

	public function setcoupontype($coupontype)
	{
		$this->coupontype = $coupontype;
	}
	
	public function getcouponamount()
	{
		return $this->couponamount;
	}

	public function setcouponamount($couponamount)
	{
		$this->couponamount = $couponamount;
	}

	public function getcouponpercent()
	{
		return $this->couponpercent;
	}
	
	public function setcouponpercent($couponpercent)
	{
		$this->couponpercent = $couponpercent;
	}
	public function setWebsite_iss($website_iss) { $this->website_iss = $website_iss; }
	public function getWebsite_iss() { return $this->website_iss; }
	public function setWebsite_unqkey($website_unqkey) { $this->website_unqkey = $website_unqkey; }
	public function getWebsite_unqkey() { return $this->website_unqkey; }
	public function setWebsite_key($website_key) { $this->website_key = $website_key; }
	public function getWebsite_key() { return $this->website_key; }
	public function setWebsite_uid($website_uid) { $this->website_uid = $website_uid; }
	public function getWebsite_uid() { return $this->website_uid; }
	public function setWebsite_utypeid($website_utypeid) { $this->website_utypeid = $website_utypeid; }
	public function getWebsite_utypeid() { return $this->website_utypeid; }
	public function setWebsite_fullname($website_fullname) { $this->website_fullname = $website_fullname; }
	public function getWebsite_fullname() { return $this->website_fullname; }


	public function setWebsite_isguestuser($website_isguestuser) { $this->website_isguestuser = $website_isguestuser; }
	public function getWebsite_isguestuser() { return $this->website_isguestuser; }

	public function getPackageformonths(){
		return $this->packageformonths;
	}

	public function setPackageformonths($packageformonths){
		$this->packageformonths = $packageformonths;
	}
}


?>