<?php 

class constant
{
      private $protocolname;
      private $servermodename;

    function  __construct()
	{
        $this->protocolname = 'http://';  // http:// or https://
		$this->servermodename= 'prod'; // prod - Live | uat - test | dev = development
    } 


    public function getprotocolname(){
        return $this->protocolname;
	}

	public function setprotocolname($protocolname){
		$this->protocolname = $protocolname;
	}


    public function getservermodename(){
        return $this->servermodename;
	}

	public function setservermodename($servermodename){
		$this->servermodename = $servermodename;
	}


}
?>