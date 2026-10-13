<?php 
class listbuyrequest{
    public $id;
    public $personid;

    public $hasblackinclusions;
    public $blackinclusionsdetail = array();

    public $haswhiteinclusions;
    public $whiteinclusionsdetail = array();

    public $hasopeninclusions;
    public $openinclusionsdetail = array();

    public $hasbuyrequestcolor;
    public $buyrequestcolordetail = array();

    public $hasbuyrequestcountry;
    public $buyrequestcountrydetail = array();

    public $hasbuyrequesteyeclean;
    public $buyrequesteyecleandetail = array();
     
    public $hasbuyrequestintensity;
    public $buyrequestintensitydetail = array();

    public $hasbuyrequestlab;
    public $buyrequestlabdetail = array();

    public $hasbuyrequestshape;
    public $buyrequestshapedetail = array();

    public $hasperson;
    public $persondetail = array();

    public $hasbuyrequestovertone;
    public $buyrequestovertonedetail = array();

    public $hasbuyrequestfluorescenecolor;
    public $buyrequestfluorescenecolordetail = array();


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


    public function getbuyrequestcolordetail(){
        return $this->buyrequestcolordetail;
    }

    public function setbuyrequestcolordetail($buyrequestcolordetail){
        $this->buyrequestcolordetail = $buyrequestcolordetail;
    }

    public function gethasbuyrequestcolor(){
        return $this->hasbuyrequestcolor;
    }

    public function sethasbuyrequestcolor($hasbuyrequestcolor){
        $this->hasbuyrequestcolor = $hasbuyrequestcolor;
    }


    public function getbuyrequestcountrydetail(){
        return $this->buyrequestcountrydetail;
    }

    public function setbuyrequestcountrydetail($buyrequestcountrydetail){
        $this->buyrequestcountrydetail = $buyrequestcountrydetail;
    }

    public function gethasbuyrequestcountry(){
        return $this->hasbuyrequestcountry;
    }

    public function sethasbuyrequestcountry($hasbuyrequestcountry){
        $this->hasbuyrequestcountry = $hasbuyrequestcountry;
    }

    public function getbuyrequesteyecleandetail(){
        return $this->buyrequesteyecleandetail;
    }

    public function setbuyrequesteyecleandetail($buyrequesteyecleandetail){
        $this->buyrequesteyecleandetail = $buyrequesteyecleandetail;
    }

    public function gethasbuyrequesteyeclean(){
        return $this->hasbuyrequesteyeclean;
    }

    public function sethasbuyrequesteyeclean($hasbuyrequesteyeclean){
        $this->hasbuyrequesteyeclean = $hasbuyrequesteyeclean;
    }

    public function getbuyrequestintensitydetail(){
        return $this->buyrequestintensitydetail;
    }

    public function setbuyrequestintensitydetail($buyrequestintensitydetail){
        $this->buyrequestintensitydetail = $buyrequestintensitydetail;
    }

    public function gethasbuyrequestintensity(){
        return $this->hasbuyrequestintensity;
    }

    public function sethasbuyrequestintensity($hasbuyrequestintensity){
        $this->hasbuyrequestintensity = $hasbuyrequestintensity;
    }

    public function getbuyrequestlabdetail(){
        return $this->buyrequestlabdetail;
    }

    public function setbuyrequestlabdetail($buyrequestlabdetail){
        $this->buyrequestlabdetail = $buyrequestlabdetail;
    }

    public function gethasbuyrequestlab(){
        return $this->hasbuyrequestlab;
    }

    public function sethasbuyrequestlab($hasbuyrequestlab){
        $this->hasbuyrequestlab = $hasbuyrequestlab;
    }

    public function getbuyrequestshapedetail(){
        return $this->buyrequestshapedetail;
    }

    public function setbuyrequestshapedetail($buyrequestshapedetail){
        $this->buyrequestshapedetail = $buyrequestshapedetail;
    }

    public function gethasbuyrequestshape(){
        return $this->hasbuyrequestshape;
    }

    public function sethasbuyrequestshape($hasbuyrequestshape){
        $this->hasbuyrequestshape = $hasbuyrequestshape;
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

    public function getbuyrequestovertonedetail(){
        return $this->buyrequestovertonedetail;
    }

    public function setbuyrequestovertonedetail($buyrequestovertonedetail){
        $this->buyrequestovertonedetail = $buyrequestovertonedetail;
    }

    public function gethasbuyrequestovertone(){
        return $this->hasbuyrequestovertone;
    }

    public function sethasbuyrequestovertone($hasbuyrequestovertone){
        $this->hasbuyrequestovertone = $hasbuyrequestovertone;
    }

    public function getbuyrequestfluorescenecolordetail(){
        return $this->buyrequestfluorescenecolordetail;
    }

    public function setbuyrequestfluorescenecolordetail($buyrequestfluorescenecolordetail){
        $this->buyrequestfluorescenecolordetail = $buyrequestfluorescenecolordetail;
    }

    public function gethasbuyrequestfluorescenecolor(){
        return $this->hasbuyrequestfluorescenecolor;
    }

    public function sethasbuyrequestfluorescenecolor($hasbuyrequestfluorescenecolor){
        $this->hasbuyrequestfluorescenecolor = $hasbuyrequestfluorescenecolor;
    }
    


}
class listblackinclusions{

}
class listwhiteinclusions{

}
class listopeninclusions{

}
class listbuyrequestcolor{

}
class listbuyrequestcountry{

}
class listbuyrequesteyeclean{

}
class listbuyrequestintensity{

}
class listbuyrequestlab{

}
class listbuyrequestshape{

}
class persondetails{

}
class listbuyrequestovertone{

}
class listbuyrequestfluorescenecolor{

}
?>