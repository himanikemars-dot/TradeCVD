<?php 
class listdiamond{
    public $id;
    public $personid;
    public $price;
    public $hasdiamondtreatment;
    public $diamondtreatmentdetail = array();

    public $hasdiamondovertone;
    public $diamondovertonedetail = array();

    public $hasdiamondkeytosymbols;
    public $diamondkeytosymbolsdetail = array();

    public $hasopeninclusions;
    public $openinclusionsdetail = array();

    public $hasblackinclusions;
    public $blackinclusionsdetail = array();

    public $haswhiteinclusions;
    public $whiteinclusionsdetail = array();

    public $hasdiamondimage;
    public $diamondimagedetail = array();

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

    public function getprice(){
        return $this->price;
    }

    public function setprice($price){
        $this->price = $price;
    }

    public function getdiamondtreatmentdetail(){
        return $this->diamondtreatmentdetail;
    }

    public function setdiamondtreatmentdetail($diamondtreatmentdetail){
        $this->diamondtreatmentdetail = $diamondtreatmentdetail;
    }

    public function gethasdiamondtreatment(){
        return $this->hasdiamondtreatment;
    }

    public function sethasdiamondtreatment($hasdiamondtreatment){
        $this->hasdiamondtreatment = $hasdiamondtreatment;
    }

    public function getdiamondkeytosymbolsdetail(){
        return $this->diamondkeytosymbolsdetail;
    }

    public function setdiamondkeytosymbolsdetail($diamondkeytosymbolsdetail){
        $this->diamondkeytosymbolsdetail = $diamondkeytosymbolsdetail;
    }

    public function gethasdiamondkeytosymbols(){
        return $this->hasdiamondkeytosymbols;
    }

    public function sethasdiamondkeytosymbols($hasdiamondkeytosymbols){
        $this->hasdiamondkeytosymbols = $hasdiamondkeytosymbols;
    }


    public function getdiamondovertonedetail(){
        return $this->diamondovertonedetail;
    }

    public function setdiamondovertonedetail($diamondovertonedetail){
        $this->diamondovertonedetail = $diamondovertonedetail;
    }

    public function gethasdiamondovertone(){
        return $this->hasdiamondovertone;
    }

    public function sethasdiamondovertone($hasdiamondovertone){
        $this->hasdiamondovertone = $hasdiamondovertone;
    }

    public function getopeninclusionsdetail(){
        return $this->openinclusionsdetail;
    }

    public function setopeninclusionsdetail($openinclusionsdetail){
        $this->openinclusionsdetail = $openinclusionsdetail;
    }

    public function gethasopeninclusions(){
        return $this->hasopeninclusions;
    }

    public function sethasopeninclusions($hasopeninclusions){
        $this->hasopeninclusions = $hasopeninclusions;
    }

    public function getblackinclusionsdetail(){
        return $this->blackinclusionsdetail;
    }

    public function setblackinclusionsdetail($blackinclusionsdetail){
        $this->blackinclusionsdetail = $blackinclusionsdetail;
    }

    public function gethasblackinclusions(){
        return $this->hasblackinclusions;
    }

    public function sethasblackinclusions($hasblackinclusions){
        $this->hasblackinclusions = $hasblackinclusions;
    }

    public function getwhiteinclusionsdetail(){
        return $this->whiteinclusionsdetail;
    }

    public function setwhiteinclusionsdetail($whiteinclusionsdetail){
        $this->whiteinclusionsdetail = $whiteinclusionsdetail;
    }

    public function gethaswhiteinclusions(){
        return $this->haswhiteinclusions;
    }

    public function sethaswhiteinclusions($haswhiteinclusions){
        $this->haswhiteinclusions = $haswhiteinclusions;
    }

    public function getdiamondimagedetail(){
        return $this->diamondimagedetail;
    }

    public function setdiamondimagedetail($diamondimagedetail){
        $this->diamondimagedetail = $diamondimagedetail;
    }

    public function gethasdiamondimage(){
        return $this->hasdiamondimage;
    }

    public function sethasdiamondimage($hasdiamondimage){
        $this->hasdiamondimage = $hasdiamondimage;
    }

    public function getpersondetail(){
        return $this->persondetail;
    }

    public function setpersondetail($persondetail){
        $this->persondetail = $persondetail;
    }

    public function gethasperson(){
        return $this->hasperson;
    }

    public function sethasperson($hasperson){
        $this->hasperson = $hasperson;
    }

}
class listdiamondtreatment{

}

class listdiamondovertone{

}
class listopeninclusions{

}
class listblackinclusions{

}
class listwhiteinclusions{

}
class listdiamondkeytosymbols{

}
class listdiamondimages{

}
class sellerdetails{

}
class listuniversalprice{
    public $personid;
    public $persondetail = array();

    public function getpersonid(){
        return $this->personid;
    }

    public function setpersonid($personid){
        $this->personid = $personid;
    }

    public function getpersondetail(){
        return $this->persondetail;
    }

    public function setpersondetail($persondetail){
        $this->persondetail = $persondetail;
    }

}
class persondetails{
   
}
?>