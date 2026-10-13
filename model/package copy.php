<?php
class package
{
    public $id;
    public $packagedetail = array();
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getpackagedetail(){
        return $this->packagedetail;
    }

    public function setpackagedetail($packagedetail){
        $this->packagedetail = $packagedetail;
    } 
   
}
class packagetype
{

}


class packagefeatures
{
    public $id;
    public $pfid;
    public $packagedetail = array();

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getpfid(){
        return $this->pfid;
    }

    public function setpfid($pfid){
        $this->pfid = $pfid;
    }

    public function getpackagedetail(){
        return $this->packagedetail;
    }

    public function setpackagedetail($packagedetail){
        $this->packagedetail = $packagedetail;
    } 
}


class packagedetails
{
   
}

class packagedata
{
    public $id;
    public $packagedata = array();
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getpackagedata(){
        return $this->packagedata;
    }

    public function setpackagedata($packagedata){
        $this->packagedata = $packagedata;
    } 
}


class userpackagefeatures
{

}




?>