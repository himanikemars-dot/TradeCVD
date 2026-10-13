<?php 
class listjewellery{
    public $id;
    public $personid;

    public $hasjewellerycategory;
    public $jewellerycategorydetail = array();

    public $hasjewellerygemstones;
    public $jewellerygemstonesdetail = array();

    public $hasjewelleryimages;
    public $jewelleryimagesdetail = array();

    public $hasjewelleryvideos;
    public $jewelleryvideosdetail = array();

    public $hasjewellerymetalkarat;
    public $jewellerymetalkaratdetail = array();

    public $hasjewellerymetaltype;
    public $jewellerymetaltypedetail = array();

    public $hasjewellerypricelocation;
    public $jewellerypricelocationdetail = array();

    public $hasjewelleryquality;
    public $jewelleryqualitydetail = array();

    public $hasjewellerytypestyle;
    public $jewellerytypestyledetail = array();

    public $hasperson;
    public $persondetail = array();

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getpersonid(){
        return $this->personid;
    }

    public function setpersonid($personid){
        $this->personid = $personid;
    }

    public function gethasjewellerycategory(){
        return $this->hasjewellerycategory;
    }

    public function sethasjewellerycategory($hasjewellerycategory){
        $this->hasjewellerycategory = $hasjewellerycategory;
    }

    public function getjewellerycategorydetail(){
        return $this->jewellerycategorydetail;
    }

    public function setjewellerycategorydetail($jewellerycategorydetail){
        $this->jewellerycategorydetail = $jewellerycategorydetail;
    }

    public function gethasjewellerygemstones(){
        return $this->hasjewellerygemstones;
    }

    public function sethasjewellerygemstones($hasjewellerygemstones){
        $this->hasjewellerygemstones = $hasjewellerygemstones;
    }

    public function getjewellerygemstonesdetail(){
        return $this->jewellerygemstonesdetail;
    }

    public function setjewellerygemstonesdetail($jewellerygemstonesdetail){
        $this->jewellerygemstonesdetail = $jewellerygemstonesdetail;
    }


    public function gethasjewelleryimages(){
        return $this->hasjewelleryimages;
    }

    public function sethasjewelleryimages($hasjewelleryimages){
        $this->hasjewelleryimages = $hasjewelleryimages;
    }

    public function gethasjewelleryvideos(){
        return $this->hasjewelleryvideos;
    }

    public function sethasjewelleryvideos($hasjewelleryvideos){
        $this->hasjewelleryvideos = $hasjewelleryvideos;
    }

    public function getjewelleryimagesdetail(){
        return $this->jewelleryimagesdetail;
    }



    public function setjewelleryimagesdetail($jewelleryimagesdetail){
        $this->jewelleryimagesdetail = $jewelleryimagesdetail;
    }

    public function getjewelleryvideosdetail(){
        return $this->jewelleryvideosdetail;
    }



    public function setjewelleryvideosdetail($jewelleryvideosdetail){
        $this->jewelleryvideosdetail = $jewelleryvideosdetail;
    }


    public function gethasjewellerymetalkarat(){
        return $this->hasjewellerymetalkarat;
    }

    public function sethasjewellerymetalkarat($hasjewellerymetalkarat){
        $this->hasjewellerymetalkarat = $hasjewellerymetalkarat;
    }

    public function getjewellerymetalkaratdetail(){
        return $this->jewellerymetalkaratdetail;
    }

    public function setjewellerymetalkaratdetail($jewellerymetalkaratdetail){
        $this->jewellerymetalkaratdetail = $jewellerymetalkaratdetail;
    }

    public function gethasjewellerymetaltype(){
        return $this->hasjewellerymetaltype;
    }

    public function sethasjewellerymetaltype($hasjewellerymetaltype){
        $this->hasjewellerymetaltype = $hasjewellerymetaltype;
    }

    public function getjewellerymetaltypedetail(){
        return $this->jewellerymetaltypedetail;
    }

    public function setjewellerymetaltypedetail($jewellerymetaltypedetail){
        $this->jewellerymetaltypedetail = $jewellerymetaltypedetail;
    }


    public function gethasjewellerypricelocation(){
        return $this->hasjewellerypricelocation;
    }

    public function sethasjewellerypricelocation($hasjewellerypricelocation){
        $this->hasjewellerypricelocation = $hasjewellerypricelocation;
    }

    public function getjewellerypricelocationdetail(){
        return $this->jewellerypricelocationdetail;
    }

    public function setjewellerypricelocationdetail($jewellerypricelocationdetail){
        $this->jewellerypricelocationdetail = $jewellerypricelocationdetail;
    }


    public function gethasjewelleryquality(){
        return $this->hasjewelleryquality;
    }

    public function sethasjewelleryquality($hasjewelleryquality){
        $this->hasjewelleryquality = $hasjewelleryquality;
    }

    public function getjewelleryqualitydetail(){
        return $this->jewelleryqualitydetail;
    }

    public function setjewelleryqualitydetail($jewelleryqualitydetail){
        $this->jewelleryqualitydetail = $jewelleryqualitydetail;
    }

    public function gethasjewellerytypestyle(){
        return $this->hasjewellerytypestyle;
    }

    public function sethasjewellerytypestyle($hasjewellerytypestyle){
        $this->hasjewellerytypestyle = $hasjewellerytypestyle;
    }

    public function getjewellerytypestyledetail(){
        return $this->jewellerytypestyledetail;
    }

    public function setjewellerytypestyledetail($jewellerytypestyledetail){
        $this->jewellerytypestyledetail = $jewellerytypestyledetail;
    }

    public function gethasperson(){
        return $this->hasperson;
    }

    public function sethasperson($hasperson){
        $this->hasperson = $hasperson;
    }

    public function getpersondetail(){
        return $this->persondetail;
    }

    public function setpersondetail($persondetail){
        $this->persondetail = $persondetail;
    }
}
class listjewellerycategory{

}
class listjewellerygemstones{
    public $id;
    public $hastreatment;

    public $hasjewellerytreatment;
    public $jewellerytreatmentdetail = array();

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function gethastreatment(){
        return $this->hastreatment;
    }

    public function sethastreatment($hastreatment){
        $this->hastreatment = $hastreatment;
    }

    public function getjewellerytreatmentdetail(){
        return $this->jewellerytreatmentdetail;
    }

    public function setjewellerytreatmentdetail($jewellerytreatmentdetail){
        $this->jewellerytreatmentdetail = $jewellerytreatmentdetail;
    }

}
class listjewellerytreatment{

}
class listjewelleryimages{

}
class listjewelleryvideos{

}
class listjewellerymetalkarat{

}
class listjewellerymetaltype{

}
class listjewellerypricelocation{
    public $id;

    public $hasjewelleryterms;
    public $jewellerytermsdetail = array();

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getjewellerytermsdetail(){
        return $this->jewellerytermsdetail;
    }

    public function setjewellerytermsdetail($jewellerytermsdetail){
        $this->jewellerytermsdetail = $jewellerytermsdetail;
    }

    public function gethasjewelleryterms(){
        return $this->hasjewelleryterms;
    }

    public function sethasjewelleryterms($hasjewelleryterms){
        $this->hasjewelleryterms = $hasjewelleryterms;
    }

}
class listjewelleryterms{
    
}
class listjewelleryquality{

}
class listjewellerytypestyle{

}
class sellerdetails{

}
?>