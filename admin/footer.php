<div class="footer-wrapper footer-fixed">
    <div class="row">
        <div class="col ml-auto">

        </div>
        <div class="col ml-auto text-right">
            <ul class="footer-shortcut">
                <!-- <li class="footer-cart"><a href="cartview.php">Cart</a></li>
                <li class="footer-appointment"><a href="appointment.php">Appointment</a></li> -->
            </ul>
        </div>
    </div>
    <!-- <div class="footer-section f-section-1">
        <p class="">Copyright © 2020 <a href="dashboard.php">Kiosist</a>, All
            rights reserved.</p>
    </div>
    <div class="footer-section f-section-2">
        <p class="">Designed & Developed By <a href="https://instanceit.com/" target="_blank">Instance IT Solutions®</a></p>
    </div> -->
</div>



<!-- Advance Order Modal -->
<div class="modal fade info-modal-dialog" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="info-body">
                    <div class="modal-logo"><img src="assets/img/logo.svg"/></div>
                    <h5 class="my-3 px-3" id="infoModalLabel">No internet Connection</h5> 
                </div>
            </div>
            <div class="modal-footer text-center p-0">
                <button type="submit" class="col btn btn-primary" data-dismiss="modal">Retry</button>
            </div>
        </div>
    </div>
</div>

<!-- Advance Order Modal -->
<div class="modal fade info-modal-dialog" id="confirmedDelete" tabindex="-1" role="dialog" aria-labelledby="confirmedDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="info-body">
                    <div class="modal-logo"><img src="assets/img/logo.svg"/></div>
                    <h5 class="my-3 px-3" id="confirmedDeleteLabel">Are you sure!<br> You want delete Requested item?</h5> 
                </div>
            </div>
            <div class="modal-footer text-center p-0">
                <button type="button" class="col btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="col btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Images View Modal -->
<div class="modal animated fade" id="modalImgView" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="modalImgViewLabel">View Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div> -->
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="add-event-title modal-title">View Image</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 text-center">                                                
                        <img src="assets/img/salon.jpg" alt="camera.jpg" class="img-thumbnail"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right border-top-0">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Package View Details Modal -->
<div class="modal animated fade" id="modalPackageViewDetails" tabindex="-1" role="dialog" aria-labelledby="modalPackageViewDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="modalPackageViewDetailsLabel"> Package View Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div> -->
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="modalPackageViewDetailsLabel">Package View Details</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 text-center">                                                
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right border-top-0">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>



<!-- Delete Confirmation Modal -->
<div class="modal delete-confirmation-modal animated fade" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="modalConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body py-lg-0">
                <div class="row mb-4 d-lg-none">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <!--<h5 class="modal-title" id="modalConfirmationLabel">Are you sure!</h5>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 text-center min-height-100 img-trash">
                        <div class="row justify-content-center align-items-center min-height-100">
                            <div class="col-12">
                                <img class="w-100" src="assets/img/trash.png" alt="trash.png" />
                            </div>
                        </div>
                    </div>                         
                    <div class="col-12 col-lg-8 pt-3 py-lg-3">  
                        <div class="row">
                            <div class="col-12 mb-2 mb-lg-4">
                                <button type="button" class="close d-none d-lg-block" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                                <h5 class="modal-title text-left" id="modalConfirmationLabel">Are you sure!</h5>
                            </div>
                        </div>                                              
                        <form class="row" id="deleteForm" onsubmit="return false">
                            <input type="hidden" id="drid" name="drid" >
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <label class="mb-1">Type <b>Delete</b> for delete this record.</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" id="deleteaction" name="deleteaction" class="form-control textuppercase">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" name="confirmdelete" id="confirmdelete" class="btn btn-danger float-right" >Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- General Modal ALl Page Use -->
<div class="modal fade animated scrollmodal" id="GeneralModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="GeneralModalLabel">Details</h5>
                    </div>
                </div>
                <div class="row" id="Generaldata">
                    
                </div>	
            </div>
        </div>
    </div>
</div>
<!-- General Modal ALl Page Use -->


<!--Sub General  Modal ALl Page Use -->
<div class="modal fade animated scrollmodal" id="SubGeneralModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="SubGeneralModalLabel">Details</h5>
                    </div>
                </div>
                <div class="row" id="SubGeneraldata">
                    
                </div>	
            </div>
        </div>
    </div>
</div>
<!--Sub General Modal ALl Page Use -->




<!-- Start For User Role Modal -->
<div class="modal fade animated scrollmodal" id="userrolemodal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="ChkLoadCapacityModalLabel">Change User Type</h5>
                    </div>
                </div>
                <div class="row">
                    <form class="col-12 validate-form" id="userrolemodalForm" method="post">   
                        
                        <div class="col-12">
                            <!-- <div class="input-group">
                                <label class="mb-1">Company <span class="text-danger">*</span></label>
                                <label class="ml-auto "></label>
                            </div> -->
                            <div class="input-group mb-3">
                                <select class="form-control selectpicker" name="hcmpid" id="hcmpid">

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- <div class="input-group">
                                <label class="mb-1">Usertype<span class="text-danger">*</span></label>
                                <label class="ml-auto "></label>
                            </div> -->
                            <div class="input-group mb-3">
                                <select class="form-control selectpicker" name="hutypeid" id="hutypeid">

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="ml-auto ">
                                <div class="mb-0 text-right">
                                    <button type="button" class="btn btn-primary m-0 ml-2" onclick="changeuserrole();"><?php echo $config->getChangeUsertype(); ?></button>
                                </div>
                            </div>
                            
                        </div>        
                    </form>
                </div>	
            </div>
        </div>
    </div>
</div>
<!-- End For User Role Modal -->


<!-- Start For Forgot Password Modal -->
<div class="modal fade animated scrollmodal" id="reserpassModal11" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="ChkLoadCapacityModalLabel">Forgot Password?</h5>
                    </div>
                </div>
                <div class="row">
                    <form class="col-12 validate-form" id="fpassword" method="post">   
                        
                        <div class="col-12">
                            <div class="input-group">
                                <label class="mb-1">Username <span class="text-danger">*</span></label>
                                <label class="ml-auto "></label>
                            </div>
                            <div class="input-group mb-3">
                                <input id="forgotuname" name="forgotuname" type="text" placeholder="Enter User Name" class="form-control" required> 
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="ml-auto ">
                                <div class="mb-0 text-right">
                                    <button type="button" class="btn btn-primary m-0 ml-2" onclick="fpass();"><?php echo $config->getSubmitbutton(); ?></button>
                                </div>
                            </div>
                            
                        </div>        
                    </form>
                </div>	
            </div>
        </div>
    </div>
</div>
<!-- End For Forgot Password Modal -->


<!-- General Modal ALl Page Use -->
<div class="modal fade" id="uploaditemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="AddServicesLabel">Upload CSV File</h5>
                    </div>
                </div>                                       
                <form class="row" id="frmUploadcsv" action="itemmaster.php" method="post" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <label class="mb-1">Canteen <span class="text-danger">*</span></label>
                                    <label class="ml-auto "></label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-control selectpicker" data-live-search="true" id="csvcanteenid" name="csvcanteenid" data-size="10" data-dropup-auto="false">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <label class="mb-1">Upload File</label>
                                </div>
                                <div class="input-group mb-3 mb-lg-3">
                                    <input type="file" class="form-control d-none" id="csvfile" name="csvfile" accept="csv/*">
                                    <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="csvfile">
                                        <span style="background-image: url(assets/img/salon.jpg);"></span>
                                        <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                    </label>
                                </div>
                            </div>  
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <label class="mb-1"><a href="<?php echo $config->getImageurl(); ?>files/item.csv">View CSV Format</a></label>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-auto ml-auto">
                                <input class="btn btn-primary" name="btnupload" id="btnupload" type="submit" value="Upload" />       
                            </div>
                        </div>	           
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
<!-- General Modal ALl Page Use --> 


<!-- General Modal ALl Page Use -->
<div class="modal fade" id="uploademployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="modal-title" id="AddServicesLabel">Upload CSV File</h5>
                    </div>
                </div>                                       
                <form class="row" id="frmemployeeUploadcsv" action="canteenmaster.php" method="post" enctype="multipart/form-data">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <label class="mb-1">Location <span class="text-danger">*</span></label>
                                    <label class="ml-auto "></label>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-control selectpicker" data-live-search="true" id="csvlocationid" name="csvlocationid" data-size="10" data-dropup-auto="false">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <label class="mb-1">Upload File</label>
                                </div>
                                <div class="input-group mb-3 mb-lg-3">
                                    <input type="file" class="form-control d-none" id="empcsvfile" name="empcsvfile" accept="csv/*">
                                    <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="empcsvfile">
                                        <span style="background-image: url(assets/img/salon.jpg);"></span>
                                        <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                    </label>
                                </div>
                            </div>  
                            <div class="col-12">
                                <div class="input-group mb-0">
                                    <label class="mb-1"><a href="<?php echo $config->getImageurl(); ?>files/employee.csv">View CSV Format</a></label>
                                </div>
                            </div> 
                        </div>  
                        <div class="row">
                            <div class="col-auto ml-auto">
                                <input class="btn btn-primary" name="btnupload" id="btnupload" type="submit" value="Upload" />       
                            </div>
                        </div>	           
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
<!-- General Modal ALl Page Use --> 


<div class="modal animated fade" id="imgImgModal" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
                        <h5 class="add-event-title modal-title">Image</h5>
                    </div>
                </div>
                <div class="row modal-card-content">
                    <div class="col-lg-12 col-md-12 col-12 text-center">                                                
                        <a href="" class="clscatimglink" target="_blank"><img src="" alt="seaticon" class="img-thumbnail clscatimg"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>