<?php 


class ProjectSetting{
    
	public function __construct()
	{
	
	}

	private $contactno;
	private $whatsappno;

	private $online_fromtime;
	private $online_totime;
	private $offline_fromtime;
	private $offline_totime;

	private $break_fromtime;
	private $break_totime;

	private $bufferminute;
	private $meetingduration;

	private $before_dietminute;
	private $after_dietminute;
	private $before_waterminute;
	private $after_waterminute;

	private $before_pkgexpireday;


	public function getContactNo(){
		return $this->contactno;
	}

	public function setContactNo($contactno){
		$this->contactno = $contactno;
	}

	public function getWhatsappNo(){
		return $this->whatsappno;
	}

	public function setWhatsappNo($whatsappno){
		$this->whatsappno = $whatsappno;
	}

	public function getOnline_fromtime(){
		return $this->online_fromtime;
	}

	public function setOnline_fromtime($online_fromtime){
		$this->online_fromtime = $online_fromtime;
	}

	public function getOnline_totime(){
		return $this->online_totime;
	}

	public function setOnline_totime($online_totime){
		$this->online_totime = $online_totime;
	}

	public function getOffline_fromtime(){
		return $this->offline_fromtime;
	}

	public function setOffline_fromtime($offline_fromtime){
		$this->offline_fromtime = $offline_fromtime;
	}

	public function getOffline_totime(){
		return $this->offline_totime;
	}

	public function setOffline_totime($offline_totime){
		$this->offline_totime = $offline_totime;
	}

	public function getBreak_fromtime(){
		return $this->break_fromtime;
	}

	public function setBreak_fromtime($break_fromtime){
		$this->break_fromtime = $break_fromtime;
	}

	public function getBreak_totime(){
		return $this->break_totime;
	}

	public function setBreak_totime($break_totime){
		$this->break_totime = $break_totime;
	}

	public function getBufferminute(){
		return $this->bufferminute;
	}

	public function setBufferminute($bufferminute){
		$this->bufferminute = $bufferminute;
	}

	public function getMeetingduration(){
		return $this->meetingduration;
	}

	public function setMeetingduration($meetingduration){
		$this->meetingduration = $meetingduration;
	}


	public function getBeforeDietMinute(){
		return $this->before_dietminute;
	}

	public function setBeforeDietMinute($before_dietminute){
		$this->before_dietminute = $before_dietminute;
	}

	public function getAfterDietMinute(){
		return $this->after_dietminute;
	}

	public function setAfterDietMinute($after_dietminute){
		$this->after_dietminute = $after_dietminute;
	}

	public function getBeforeWaterMinute(){
		return $this->before_waterminute;
	}

	public function setBeforeWaterMinute($before_waterminute){
		$this->before_waterminute = $before_waterminute;
	}

	public function getAfterWaterMinute(){
		return $this->after_waterminute;
	}

	public function setAfterWaterMinute($after_waterminute){
		$this->after_waterminute = $after_waterminute;
	}

	public function getBeforePkgExpireDay(){
		return $this->before_pkgexpireday;
	}

	public function setBeforePkgExpireDay($before_pkgexpireday){
		$this->before_pkgexpireday = $before_pkgexpireday;
	}


}


?>