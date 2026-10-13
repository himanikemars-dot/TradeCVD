<?php 

class myprofile
{
    
}
class mypackages
{
    public $id;
    public $mypackagedetail = array();

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getmypackagedetail(){
        return $this->mypackagedetail;
    }

    public function setmypackagedetail($mypackagedetail){
        $this->mypackagedetail = $mypackagedetail;
    } 
}
class mypackagedetail
{

}
?>