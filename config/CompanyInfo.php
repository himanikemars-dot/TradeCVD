<?php 


class CompanyInfo{
    
	public function __construct()
	{
	
	}

	public $companyname;
	public $shortname;
	public $prefix;
	public $contact1;
	public $contact2;
	public $email1;
	public $email2;
	public $logoimg;
	public $facebook;
	public $instagram;
	public $skype;
	public $twitter;
	public $youtube;
	public $address;

	public $mainaddress;
	public $maincontact1;
	public $maincontct2;
	public $mainemail;
	public $mainemail2;
	public $workhour;
	public $maplink;
	public $support_contact;
	public $support_whatsappno;
	public $support_email;


	public function setCompanyname($companyname){
		$this->companyname = $companyname;
	}
	
	public function getCompanyname(){
		return $this->companyname;
	}

	

	public function getShortname(){
		return $this->shortname;
	}

	public function setShortname($shortname){
		$this->shortname = $shortname;
	}

	public function getPrefix(){
		return $this->prefix;
	}

	public function setPrefix($prefix){
		$this->prefix = $prefix;
	}

	public function getContact1(){
		return $this->contact1;
	}

	public function setContact1($contact1){
		$this->contact1 = $contact1;
	}

	public function getContact2(){
		return $this->contact2;
	}

	public function setContact2($contact2){
		$this->contact2 = $contact2;
	}

	public function getEmail1(){
		return $this->email1;
	}

	public function setEmail1($email1){
		$this->email1 = $email1;
	}

	public function getEmail2(){
		return $this->email2;
	}

	public function setEmail2($email2){
		$this->email2 = $email2;
	}

	public function getLogoimg(){
		return $this->logoimg;
	}

	public function setLogoimg($logoimg){
		$this->logoimg = $logoimg;
	}

	public function getFacebook(){
		return $this->facebook;
	}

	public function setFacebook($facebook){
		$this->facebook = $facebook;
	}

	public function getInstagram(){
		return $this->instagram;
	}

	public function setInstagram($instagram){
		$this->instagram = $instagram;
	}

	public function getSkype(){
		return $this->skype;
	}

	public function setSkype($skype){
		$this->skype = $skype;
	}

	public function getTwitter(){
		return $this->twitter;
	}

	public function setTwitter($twitter){
		$this->twitter = $twitter;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}


	public function getMainAddress(){
		return $this->mainaddress;
	}

	public function setMainAddress($mainaddress){
		$this->mainaddress = $mainaddress;
	}
	public function getMainContact1(){
		return $this->maincontact1;
	}

	public function setMainContact1($maincontact1){
		$this->maincontact1 = $maincontact1;
	}
	public function getMainContact2(){
		return $this->maincontact2;
	}

	public function setMainContact2($maincontact2){
		$this->maincontact2 = $maincontact2;
	}
	public function getMainEmail(){
		return $this->mainemail;
	}

	public function setMainEmail($mainemail){
		$this->mainemail = $mainemail;
	}

	public function getMainEmail2(){
		return $this->mainemail2;
	}

	public function setMainEmail2($mainemail2){
		$this->mainemail2 = $mainemail2;
	}

	public function getWorkhour(){
		return $this->workhour;
	}
	public function setWorkhour($workhour){
		$this->workhour = $workhour;
	}

	public function getMaplink(){
		return $this->maplink;
	}
	public function setMaplink($maplink){
		$this->maplink = $maplink;
	}

	public function getYoutube(){
		return $this->youtube;
	}
	public function setYoutube($youtube){
		$this->youtube = $youtube;
	}
	public function getSupport_contact(){
		return $this->support_contact;
	}

	public function setSupport_contact($support_contact){
		$this->support_contact = $support_contact;
	}

	public function getSupport_whatsappno(){
		return $this->support_whatsappno;
	}

	public function setSupport_whatsappno($support_whatsappno){
		$this->support_whatsappno = $support_whatsappno;
	}

	public function getSupport_email(){
		return $this->support_email;
	}

	public function setSupport_email($support_email){
		$this->support_email = $support_email;
	}
}


?>