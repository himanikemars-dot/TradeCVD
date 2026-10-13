<?php 
// require_once dirname(__DIR__, 1).'/config/config.php';
// $config = new config();

require_once dirname(__DIR__, 1).'/config/init.php';


?>
    <div class="layout-px-spacing">
        <!-- CONTENT AREA -->
        <div class="row layout-top-spacing">
            <div class="col-12 layout-spacing" id="layoutContent">
                <div class="widget widget-page">
                    <div class="widget-control">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <h5 class="m-0 menunamelbl" id="customernamelbl"></h5>
                            </div>
                            <div class="col-auto ml-auto">
                                <ul class="list-inline">
                                    <li><a href="javascript:void(0);" class="btn-tbl content-minimize"><i class="bi bi-dash-lg"></i></a></li>
                                    <li><a href="javascript:void(0);" class="btn-tbl content-expand"><i class="bi bi-fullscreen"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 col-lg-6 mb-2 ml-auto text-right">
                                <ul class="page-more-setting">
                                        <?php
										if(($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
										{
											?>
											<li class="delete-selected tbl-check d-none">
											<!-- <a href="javascript:void(0);" class="btn btn-primary m-0 " data-toggle="modal" data-target="#modalConfirmation"><i class="bi bi-trash"></i></a> -->
												<a href="javascript:void(0);" class="btn btn-primary m-0 btnmultitrash" data-toggle="modal" ><i class="bi bi-trash"></i></a>
											</li>
											<li>
												<div class="dropdown table-setting">
													<button class="dropdown-toggle btn btn-primary" type="button" id="tableSetting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Bulk Delete"><i class="bi bi-check2-circle"></i></button>
													<div class="dropdown-menu" aria-labelledby="tableSetting">
														<a class="dropdown-item select-bulk-delete" href="javascript:void(0);"><i class="bi bi-trash"></i> Bulk Delete</a>
													</div>
												</div>
											</li>
											<?php
										}
                                    ?>
                                    <li class="tbl-search">
                                        <div class="input-group">
                                            <input type="text" name="filter" id="filter" class="form-control control-append" placeholder="Search...">
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="selectBrandDate" id="btnfilter" name="btnfilter"><i class="fal fa-search"></i></label>
                                            </div>
                                        </div>
                                    </li>
                                    <?php 
                                        if(($rightstotalcount>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
                                        {
                                            ?>
                                            <li>
                                                <a href="javascript:void(0);" class="btn btn-primary m-0" id="openRightSidebar">Add New</a>
                                            </li>
                                            <?php
                                        }
									?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row min-height-100">
                            <div class="col-12 min-height-100">
                                <div class="table-responsive main-grid">
                                    <table id="tableDataList" data-show="1" data-nextpage='0' class="table table-bordered table-hover table-striped datalisttable">
                                        <thead>
                                            <tr>
                                                <?php 
													if(($rightstotalcount>0 ? $Pagerights->getEditright():0)==1 || ($rightstotalcount>0 ? $Pagerights->getDelright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
													{
														?>
														<th class="tbl-grid">
															<a href="javascript:void(0);" class="" id="gridMenu" data-toggle="griddropdown" data-target="#tblDropdownContent" aria-haspopup="true" aria-expanded="false"><i class="bi bi-ui-checks-grid"></i></a>
														</th>
														<?php
													}
												?>
                                                <th class="tbl-check d-none">
                                                    <div class="text-center">
                                                        <div class="custom-control custom-checkbox m-0 w-auto">
                                                            <input type="checkbox" class="custom-control-input" id="tblCheckAll" name="tblCheckAll">
                                                            <label class="custom-control-label mb-n1" for="tblCheckAll">All</label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="tbl-name sorting_asc sorting" data-th="um.usertype">User Type</th>
                                                <th class="tbl-name sorting_asc sorting" data-th="personname">Employee Name</th>
                                                <th class="tbl-name sorting" data-th="contact">Contact No</th>
                                                <th class="sorting" data-th="email">Email</th>
                                                <th class="tbl-name sorting" data-th="country">Country</th>
                                                <th class="tbl-name sorting" data-th="state">State</th>
                                                <th class="tbl-name sorting" data-th="city">City</th>
                                                <?php 
													if((($rightstotalcount)>0 ? $Pagerights->getEditright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
													{
                                                        echo '<th class="tbl-name">Reset Password</th>';
                                                        echo '<th class="tbl-w100">Is Active</th>';
                                                    }
                                                ?>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="datalist">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- table End -->
                            </div>
                        </div>
                    </div>
                    <?php require_once 'pagefooter.php'; ?>
                </div>
            </div>

            <!-- rightSidebar Start -->
            <div class="col-12 p-4" id="rightSidebar">
                <div class="right-sidebar-content">
                    <div class="row">   
                        <div class="col-12 mb-4 sidebar-header">
                            <div class="row">
                                <div class="col">
                                    <h5 class="my-2"><span class="formnamelbl"></span></h5>
                                </div>
                                <div class="col-auto pl-0">
                                    <a href="javascript:void(0);" class="btn btn-danger m-0 rounded-circle btn-close-right-sidebar" id="btnCloseRightSidebar" data-toggle="tooltip" data-placement="top" title="<?php echo $config->getCloseSidebar(); ?>" data-original-title="<?php echo $config->getCloseSidebar(); ?>"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="col-12">
                            <form class="text-left validate-form row" id="employeeForm" method="post" action="vendor.php" enctype="multipart/form-data">
                                <input type="hidden" id="formevent" name="formevent" value='addright'>
                                <input type="hidden" id="id" name="id" value=''>
                                <div class="col-12 layout-spacing">
                                    <div class="widget">
                                        <div class="widget-title mb-2"><b>Professional Details</b></div>
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Company <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="companyid" name="companyid" data-size="10" data-dropup-auto="false" title="Select Company">
                                                            <option value="">Select Company</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">User Type <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" multiple="multiple" id="utypeid" name="utypeid[]" data-size="10" data-dropup-auto="false" title="Select User Type">
                                                            <option value="">Select User Type</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Department <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" multiple="multiple" id="departmentid" name="departmentid[]" data-size="10" data-dropup-auto="false" title="Select Department">
                                                            <option value="">Select Department</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 d-none">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Designation <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="designationid" name="designationid" data-size="10" data-dropup-auto="false" title="Select Designation">
                                                            <option value="">Select Designation</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 layout-spacing">
                                    <div class="widget">
                                        <div class="widget-title mb-2"><b>Personal Information</b></div>
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">First Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                        <input type="text" class="form-control" placeholder="First Name" id="firstname" name="firstname">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Middle Name</label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                        <input type="text" class="form-control" placeholder="Middle Name" id="middlename" name="middlename">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Last Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                        <input type="text" class="form-control" placeholder="Last Name" id="lastname" name="lastname">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Gender <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="gender" name="gender" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select Gender</option>
                                                            <option value="1">Male</option>
                                                            <option value="2">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Mobile Number <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                    <input type="text" class="form-control" placeholder="Mobile Number" id="mobilenumber1" minlength="7" maxlength="15" onkeypress="numbonly(event)"  name="mobilenumber1" onpaste="numbonly(event)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Alternate Mobile Number</label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                    <input type="text" class="form-control" placeholder="Alternate Mobile Number" id="mobilenumber2" minlength="7" maxlength="15" onkeypress="numbonly(event)"  name="mobilenumber2" onpaste="numbonly(event)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Email Id <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <input type="email" class="form-control" placeholder="Email Id" id="email" name="email">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Date Of Birth <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <input type="text" class="form-control" placeholder="Date Of Birth" id="dob" name="dob">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
													<div class="input-group">
														<label class="mb-1">Profile Picture</label>
														<label class="ml-auto "></label>
													</div>
													<div class="input-group mb-0">													
														<div class="filepreview">
															<input class="form-control" type="file" name="profileimg" id="profileimg" accept="image/*">
															<label class="filepreviewbg" for="profileimg">
																<img class="d-none filepreviewimg" id="filepreviewimg" src="assets/img/logo-white.png">
															</label>
														</div>
														<span style="color:#B00" class="imgsizelbl2">** Please upload image in JPG,JPEG,PNG Format</span>
														<p class="imgerr" style="color:#f00;font-weight: bold;"></p>
													</div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Joining date <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <input type="text" class="form-control" placeholder="Joining date" id="joiningdate" name="joiningdate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 layout-spacing">
                                    <div class="widget">
                                        <div class="widget-title mb-2"><b>Address</b></div>
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Current Address <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                        <textarea class="form-control" placeholder="Current Address" id="address" name="address" rows=3></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Country <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="countryid" name="countryid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select Country</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">State <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="stateid" name="stateid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">City <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="cityid" name="cityid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select City </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">PINCode <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                    <input type="text" class="form-control" placeholder="PINCode" id="pincode" name="pincode" maxlength="6" onkeypress="numbonly(event)" onpaste="numbonly(event)">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="check-box d-inline-block ml-0 ml-md-2">
                                                        <input type="checkbox" id="sameparmanentaddress">
                                                        <label for="sameparmanentaddress">Same Parmanent Address</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Parmanent Address <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                        <textarea class="form-control" placeholder="Parmanent Address" id="p_address" name="p_address" rows=3></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Country <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="p_countryid" name="p_countryid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select Country</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">State <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="p_stateid" name="p_stateid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">City <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <select class="form-control selectpicker" data-live-search="true" id="p_cityid" name="p_cityid" data-size="10" data-dropup-auto="false">
                                                            <option value="">Select City </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">PINCode <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                    <input type="text" class="form-control" placeholder="PINCode" id="p_pincode" name="p_pincode" maxlength="6" onkeypress="numbonly(event)" onpaste="numbonly(event)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 layout-spacing">
                                    <div class="widget">
                                        <div class="widget-title mb-2"><b>Emergency Information</b></div>
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Emergency Person Name <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                        <input type="text" class="form-control" placeholder="Emergency Person Name" id="emergencypersonname" name="emergencypersonname">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Emergency Person Contact Number <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-sm-3">
                                                    <input type="text" class="form-control" placeholder="Emergency Person Contact Number" id="emergencypersoncontact" minlength="7" maxlength="15" onkeypress="numbonly(event)"  name="emergencypersoncontact" onpaste="numbonly(event)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                

                                <div class="col-12 col-md-12 col-lg-12 layout-spacing">
                                    <div class="widget min-height-100">
                                        <div class="widget-title mb-2 clslogindiv"><b>Login Credentials</b></div>
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 clslogindiv">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Username <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                                                    </div> 
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 clslogindiv passwordDiv">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Password <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 clslogindiv passwordDiv">
                                                    <div class="input-group mb-0">
                                                        <label class="mb-1">Confirm password <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="input-group mb-3 mb-lg-3">
                                                        <input type="password" class="form-control" placeholder="Confirm password" id="cpassword" name="cpassword">
                                                    </div>
                                                </div>

                                                <div class="col-12 ml-auto">
                                                    <div class="input-group mb-0">
                                                        <button type="submit" class="btn btn-primary m-0  ml-auto" id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
                                                        <button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset" onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>       
                        </div>       
                    </div>
                </div>
            </div>
            <!-- rightSidebar End -->
        </div>
        <!-- CONTENT AREA -->


        <div class="modal fade" id="resetpassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document" style="width: 400px">
				<div class="modal-content" >
					<div class="modal-body">
						<div class="row mb-4">
							<div class="col-12">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
								<h5 class="modal-title" id="AddServicesLabel">Reset Password</h5>
							</div>
						</div>
						<form class="form-horizontal jQueryForm" id="resetpassForm" method="post" enctype="multipart/form-data">
							<input type="hidden" name="userid" id="userid" />
							<div class="form-group" style="margin-bottom:0;">
								<div class="col-sm-12">
									<p>Username : <label class="form-label unametext"></label></label>
                                    <p>Old Password : <label class="form-label oldpasswordtext"></label></label>
								</div>		
							</div>
							
							<div class="form-group">
								<div class="col-sm-12">
									<label class="form-label">New Password *</label>
									<input type="password" id="npass" name="npass" class="form-control" placeholder="Enter New Password" />
								</div>		
							</div>
							
							<div class="form-group">
								<div class="col-sm-12 text-right">
									<input class="btn btn-primary" name="btnsubmit" id="submitbtn" type="submit" value="Reset"/>
								</div>		
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


    </div>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');
			profileimg.onchange = evt => 
			{
				const [file] = profileimg.files
				if (file) 
				{
					filepreviewimg.src = URL.createObjectURL(file);
					var imgurlimg = $('#filepreviewimg').attr('src');

					$("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url(" + imgurlimg + ")");
				}
			}
			
        });


        function resetdata()
        {
            $("#employeeForm").validate().resetForm();
            $('#employeeForm').trigger("reset");
            $('#formevent').val('addright');

            $('#stateid').html('<option value="">Select State</option>');
            $('#cityid').html('<option value="">Select City</option>');
            $('#p_stateid').html('<option value="">Select State</option>');
            $('#p_cityid').html('<option value="">Select City</option>');
            $('.selectpicker').selectpicker('refresh');
            
            $('#tbldata').html('');
            $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');
			$("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url()");
			$('.imgerr').text('');
			$('.passwordDiv').removeClass('d-none');


            $('.clslogindiv').addClass('d-none');

            Edittimeformnamechange(2); 

            fillcompany();
            fillutype();
            filldepartment();
            // filldesignation();
            fillcountry();
            fillcountry('p_');
        } 

        $('#joiningdate').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
            format: 'DD/MM/YYYY',
            time: false,
            switchOnClick: true,
        });

        $('#dob').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
            format: 'DD/MM/YYYY',
            time: false,
            maxDate: moment(),
            switchOnClick: true,
        });

        function fillcompany(companyid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillcompany");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillcompany,OnErrorSelectpicker); 
            function Onsuccessfillcompany(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#companyid').html(resultdata.data);
                $('#companyid').selectpicker('refresh');
                if(companyid){
                    $('#companyid').val(companyid);
                }
                else{
                    // alert('<?php echo $config->getDefaultCmpId(); ?>')
                    $('#companyid').val('<?php echo $config->getDefaultCmpId(); ?>');
                }
                $('#companyid').selectpicker('refresh');
            }
        }

        function fillutype(utypeid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillutype");
            formdata.append("issalesheadutype", 0);
            formdata.append("issubadminutype", 0);
            formdata.append("isvendorutype", 0);
            formdata.append("iscustomerutype", 0);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillutype,OnErrorSelectpicker); 
            function Onsuccessfillutype(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#utypeid').html(resultdata.data);
                if(utypeid){
                    var bt=utypeid.split(",");
                    $('#utypeid').selectpicker('val',bt);
                }
                $('#utypeid').selectpicker('refresh');
                
                var aryisweblogin = [];
                var aryisapplogin = [];
                var tmputypeid = $('#utypeid').val();
                if(tmputypeid != null){
                    for(var i=0;i<tmputypeid.length;i++)
                    {
                        var isweblogin=$('#utypeid option[value='+tmputypeid[i]+']').attr('data-isweblogin');
                        var isapplogin=$('#utypeid option[value='+tmputypeid[i]+']').attr('data-isapplogin');
                        aryisweblogin.push(isweblogin);
                        aryisapplogin.push(isapplogin);
                        
                    }
                    if($.inArray('1', aryisweblogin)>=0 || $.inArray('1', aryisapplogin)>=0)
                    {
                        $('.clslogindiv').removeClass('d-none');
                        var formevent = $('#formevent').val();
                        if(formevent == 'editright')
                        {
                            $('.passwordDiv').addClass('d-none');
                        }
                        else
                        {
                            $('.passwordDiv').removeClass('d-none');
                        }
                    }
                    else if($.inArray('1', aryisweblogin) <=0 || $.inArray('1', aryisapplogin) <=0)
                    {
                        $('.clslogindiv').addClass('d-none');
                    }
                }
            }
        }

        function filldepartment(departmentid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "filldepartment");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfilldepartment,OnErrorSelectpicker); 
            function Onsuccessfilldepartment(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#departmentid').html(resultdata.data);
                if(departmentid){
                    var bt=departmentid.split(",");
                    $('#departmentid').selectpicker('val',bt);
                }
                $('#departmentid').selectpicker('refresh');
            }
        }

        function filldesignation(designationid)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "filldesignation");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfilldesignation,OnErrorSelectpicker); 
            function Onsuccessfilldesignation(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                $('#designationid').html(resultdata.data);
                $('#designationid').selectpicker('refresh');
                if(designationid){
                    $('#designationid').val(designationid);
                }
                $('#designationid').selectpicker('refresh');
            }
        }

        function fillcountry(flt,countryid,stateid,cityid)
        {
            if(!flt){
                var flt='';
            }
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillcountry");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillcountry,OnErrorSelectpicker); 
            function Onsuccessfillcountry(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata = '';
                htmldata += '<option value="">Select Country</option>';
                htmldata += resultdata.data;
                $('#'+flt+'countryid').html(htmldata);
                if(countryid){
                    $('#'+flt+'countryid').val(countryid);
                    if(stateid){
                        $('#'+flt+'countryid').val(countryid);
                        fillstate(flt,countryid,stateid,cityid);
                    }
                    else{
                        fillstate(flt,countryid);
                    }
                }
                $('#'+flt+'countryid').selectpicker('refresh');
            }
        }


        $('#employeeForm').on('change','#countryid', function () {
            fillstate('',$(this).val());
        });

        $('#employeeForm').on('change','#p_countryid', function () {
            fillstate('p_',$(this).val());
        });

        function fillstate(flt,countryid,stateid,cityid)
        {
            if(!flt){
                var flt='';
            }
            if(countryid && countryid!=''){
                var pagename=getpagename();
                var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
                formdata = new FormData();
                formdata.append("action", "fillstate");
                formdata.append("countryid", countryid);
                ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillstate,OnErrorSelectpicker); 
                function Onsuccessfillstate(content)
                {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);
                    var htmldata = '';
                    htmldata += '<option value="">Select State</option>';
                    htmldata += resultdata.data;
                    $('#'+flt+'stateid').html(htmldata);
                    $('#'+flt+'stateid').selectpicker('refresh');
                    if(stateid){
                        $('#'+flt+'stateid').val(stateid);
                        $('#'+flt+'stateid').selectpicker('refresh');
                        if(cityid){
                            fillcity(flt,countryid,stateid,cityid);
                        }
                        else{
                            fillcity(flt,countryid,stateid);
                        }
                    }
                }
            }
            else{
                $('#'+flt+'stateid').html('<option value="">Select State</option>');
                $('#'+flt+'stateid').selectpicker('refresh');
            }
        }


        $('#employeeForm').on('change','#stateid', function () {
            fillcity('','',$(this).val());
        });

        $('#employeeForm').on('change','#p_stateid', function () {
            fillcity('p_','',$(this).val());
        });

        function fillcity(flt,countryid,stateid,cityid)
        {
            var pagename=getpagename();
            if(!stateid){
                var stateid=$('#'+flt+'stateid').val();
            }
            if(stateid && stateid!=''){
                var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype:'HTML'};
                formdata = new FormData();
                formdata.append("action", "fillcity");
                formdata.append("stateid",stateid);
                formdata.append("cityid",cityid);
                ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillcity,OnErrorSelectpicker);
                function Onsuccessfillcity(content)
                {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);
                    $('#'+flt+'cityid').html('<option value="">Select City </option>');
                    if(resultdata.status==1)
                    {
                        var htmldata = '';
                        htmldata += '<option value="">Select City </option>';
                        htmldata += resultdata.data;
                        $('#'+flt+'cityid').html(htmldata);
                        $('#'+flt+'cityid').selectpicker('refresh');
                        if(resultdata.cityid){
                            // alert(flt+''+resultdata.cityid);
                            $('#'+flt+'cityid').val(resultdata.cityid);
                            $('#'+flt+'cityid').selectpicker('refresh');
                        }
                    }
                }
            }
            else{
                $('#'+flt+'cityid').html('<option value="">Select City</option>');
                $('#'+flt+'cityid').selectpicker('refresh');
            }
        }

		// Fill Username
		$('#mobilenumber1').on('input',function(){
			$('#username').val($(this).val());
		});

        $('#employeeForm').on('change','#sameparmanentaddress', function () {
            if($(this).is(':checked')){
                var address = $('#employeeForm #address').val();
                var countryid = $('#employeeForm #countryid').val();
                var stateid = $('#employeeForm #stateid').val();
                var cityid = $('#employeeForm #cityid').val();
                var pincode = $('#employeeForm #pincode').val();


                $('#employeeForm #p_address').val(address);
                fillcountry('p_',countryid,stateid,cityid);
               
                // $('#employeeForm #p_stateid').val(stateid);
                // $('#employeeForm #p_stateid').selectpicker('refresh');
                // $('#employeeForm #p_cityid').val(cityid);
                // $('#employeeForm #p_cityid').selectpicker('refresh');
                $('#employeeForm #p_pincode').val(pincode);
            }
        });

        //Edit Start
        function editdata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "editemployeemaster");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessedtemployeemaster,OnErroredtemployeemaster); 
        }

        function Onsuccessedtemployeemaster(content)
        {
            var JsonData = JSON.stringify(content);
            var resulteditdata = jQuery.parseJSON(JsonData);

            $('#id').val(resulteditdata.id);
            fillcompany(resulteditdata.companyid);
            fillutype(resulteditdata.utypeid);
            filldepartment(resulteditdata.departmentid);
            // filldesignation(resulteditdata.designationid);

            $('#firstname').val(resulteditdata.firstname);
            $('#middlename').val(resulteditdata.middlename);
            $('#lastname').val(resulteditdata.lastname);
            $('#gender').val(resulteditdata.gender);
            $('#mobilenumber1').val(resulteditdata.mobilenumber1);
            $('#mobilenumber2').val(resulteditdata.mobilenumber2);
            $('#email').val(resulteditdata.email);
            $('#dob').val(resulteditdata.dob);
            $('#joiningdate').val(resulteditdata.joiningdate);

            $('#address').val(resulteditdata.address);
            $('#pincode').val(resulteditdata.pincode);
            fillcountry('',resulteditdata.countryid,resulteditdata.stateid,resulteditdata.cityid);

            $('#p_address').val(resulteditdata.p_address);
            $('#p_pincode').val(resulteditdata.p_pincode);
            fillcountry('p_',resulteditdata.p_countryid,resulteditdata.p_stateid,resulteditdata.p_cityid);

            $('#emergencypersonname').val(resulteditdata.emergencypersonname);
            $('#emergencypersoncontact').val(resulteditdata.emergencypersoncontact);

            $('#username').val(resulteditdata.username);
            $('#password').val(resulteditdata.password);
            $('#cpassword').val(resulteditdata.password);
            $('.selectpicker').selectpicker('refresh');

            $('.passwordDiv').addClass('d-none');

            $('#formevent').val('editright');       
            $('#btnsubmit').text('<?php echo $config->getUpdateSidebar(); ?>');     

            //Open Side bar
            Edittimeformnamechange(1);
            $("#rightSidebar").toggleClass("active-right-sidebar"); 
            $('.overlay').addClass('show');
            $("body").addClass("overflow-hidden");
        }

        function OnErroredtemployeemaster(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }
        //Edit End

        //change person status
        function changepersonstatus(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
            formdata = new FormData();
            formdata.append("action", "changepersonstatus");
            formdata.append("id", id);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessPersonstatus,OnErrorPersonstatus); 
        }

        function OnsuccessPersonstatus(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if(resultdata.status==0)
            {
                alertify(resultdata.message,0);
            }
            else if(resultdata.status==1)
            {
                alertify(resultdata.message,1);
            }
            $('#tableDataList').attr('data-nextpage',0); 
            listdata();
        }
        function OnErrorPersonstatus(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }


        //View Details Start
        function viewemployeedetaildata(id)
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:false,responsetype: 'HTML'};

            formdata = new FormData();
            formdata.append("action", "viewemployeedata");
            formdata.append("id", id);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessviewemployeedata,OnErrorviewemployeedata); 
        }

		function Onsuccessviewemployeedata(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#GeneralModal').modal('show');
			$('#GeneralModal .modal-dialog').addClass('modal-xl');
			$('#GeneralModal #GeneralModalLabel').html('Employee Details');
			$('#GeneralModal #Generaldata').html(resultdata.data);
        }
        
        function OnErrorviewemployeedata(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }

        //user type change
        $('#utypeid').on('change', function(){
            $('.clslogindiv').addClass('d-none');
          
            var aryisweblogin = [];
            var aryisapplogin = [];
            
            var utypeid = $('#utypeid').val();
            if(utypeid != null){
                for(var i=0;i<utypeid.length;i++)
                {
                    var isweblogin=$('#utypeid option[value='+utypeid[i]+']').attr('data-isweblogin');
                    var isapplogin=$('#utypeid option[value='+utypeid[i]+']').attr('data-isapplogin');
                    aryisweblogin.push(isweblogin);
                    aryisapplogin.push(isapplogin);
            
                }
                
                if($.inArray('1', aryisweblogin)>=0 || $.inArray('1', aryisapplogin)>=0)
                {
                    $('.clslogindiv').removeClass('d-none');
                    var formevent = $('#formevent').val();
                    if(formevent == 'editright')
                    {
                        $('.passwordDiv').addClass('d-none');
                    }
                    else
                    {
                        $('.passwordDiv').removeClass('d-none');
                    }
                    
                }
                else if($.inArray('1', aryisweblogin) <=0 || $.inArray('1', aryisapplogin) <=0)
                {
                    $('.clslogindiv').addClass('d-none');
                    
                }
                
            }
        })

        if($('#employeeForm').length){		
            $('#employeeForm').validate({
                rules:{
                    companyid:{
                        required: true,
                    },
                    "utypeid[]":{
                        required: true,
                    },
                    "departmentid[]":{
                        required: true,
                    },
                    designationid:{
                        required: true,
                    },
                    firstname:{
                        required: true,
                    },
                    lastname:{
                        required: true,
                    },
                    gender:{
                        required: true,
                    },
                    mobilenumber1:{
                        required: true,
                        // mobileno:true,
                        minlength:7,
                        maxlength:15,
                    },
                    mobilenumber2:{
                        // mobileno:true,
                        // maxlength:10,
                        minlength:7,
                        maxlength:15,
                    },
                    email:{
                        required: true,
                    },
                    dob:{
                        required: true,
                    },
                    joiningdate:{
                        required: true,
                    },
                    address:{
                        required: true,
                    },
                    countryid:{
                        required: true,
                    },
                    stateid:{
                        required: true,
                    },
                    cityid:{
                        required: true,
                    },
                    pincode:{
                        required: true,
                    },
                    p_address:{
                        required: true,
                    },
                    p_countryid:{
                        required: true,
                    },
                    p_stateid:{
                        required: true,
                    },
                    p_cityid:{
                        required: true,
                    },
                    p_pincode:{
                        required: true,
                    },
                    emergencypersonname:{
                        required: true,
                    },
                    emergencypersoncontact:{
                        required: true,
                        // mobileno:true,
                        minlength:7,
                        maxlength:15,
                    },
                    username:{
                        required: true,
                    },
                    password:{
                        required: true,
                    },
                    cpassword:{
                        required:true,
                        equalTo:'#password',
                    },
                },messages:{
                    companyid:{
                        required: "Company is required",
                    },
                    "utypeid[]":{
                        required: "User Type is required",
                    },
                    "departmentid[]":{
                        required: "Department is required",
                    },
                    designationid:{
                        required: "Designation is required",
                    },
                    firstname:{
                        required: "First Name is required",
                    },
                    lastname:{
                        required: "Last Name is required",
                    },
                    gender:{
                        required: "Gender is required",
                    },
                    mobilenumber1:{
                        required: "Mobile number is required",
                    },
                    mobilenumber2:{
                        mobileno:"Invalid mobile no",
                    },
                    email:{
                        required: "Email Id is required",
                    },
                    dob:{
                        required: "Date Of Birth is required",
                    },
                    joiningdate:{
                        required: "Joining date is required",
                    },
                    address:{
                        required: "Current Address is required",
                    },
                    stateid:{
                        required: "State is required",
                    },
                    countryid:{
                        required: "Country is required",
                    },
                    cityid:{
                        required: "City is required",
                    },
                    pincode:{
                        required: "PINCode is required",
                    },
                    p_address:{
                        required: "Parmanent Address is required",
                    },
                    p_stateid:{
                        required: "State is required",
                    },
                    p_countryid:{
                        required: "Country is required",
                    },
                    p_cityid:{
                        required: "City is required",
                    },
                    p_pincode:{
                        required: "PINCode is required",
                    },
                    emergencypersonname:{
                        required: "Emergency Person Name is required",
                    },
                    emergencypersoncontact:{
                        required: "Emergency Person Contact Number is required",
                        mobileno:"Invalid mobile no",
                    },
                    username:{
                        required: "Username is required",
                    },
                    password:{
                        required: "Password is required",
                    },
                    cpassword:{
                        required:"Confirm password is required",
                        equalTo:"Confirm password must be same as password"			
                    },
                },
                submitHandler: function(form){

                    $('#loaderprogress').show();
                    var pagename=getpagename();
                    var useraction=$('#formevent').val();
                    formdata = new FormData(form);
                    formdata.append("action", "insertemployeemaster");
                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:useraction,masterlisting:false,responsetype: 'HTML'};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessDataSubmit,OnErrorDataSubmit); 
			    },
            });
        }


        //start reset password
		function resetpassword(id,uname,oldpassword)
		{
			$('#resetpassForm #npass').val('');
			$('#resetpassForm #userid').val(id);
			$('#resetpassForm .unametext').html(uname);
            $('#resetpassForm .oldpasswordtext').html(oldpassword);
            
			$('#resetpassModal').modal('show');	
		}

        //submit reset password form
        if($('#resetpassForm').length)
		{		
			$('#resetpassForm').validate({
				rules:{
					npass:{
						required: true,
					},	
				},
		        messages:{
		        	npass:{
						required: "New password is required",
					},
		        },
		        submitHandler: function(form){
					var pagename=getpagename();
					var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'editright',masterlisting:false};
					formdata = new FormData(form);
					formdata.append("action", "changepassword");
					ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccesschangepassword,OnErrorchangepassword); 

					
		        }	
			});
		}

        function Onsuccesschangepassword(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            if(resultdata.status==0)
            {
                alertify(resultdata.message,0);
            }
            else if(resultdata.status==1)
            {
				$('#resetpassForm').validate().resetForm();
				$('#resetpassForm').trigger("reset");
				$('#resetpassModal').modal('hide');
                alertify(resultdata.message,1);
            }
            $('#tableDataList').attr('data-nextpage',0); 
            listdata();
        }


        function OnErrorchangepassword(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        //reset modal hide event
		$('#resetpassModal').on('hide.bs.modal', function() {
			$('#resetpassForm').validate().resetForm();
			$('#resetpassForm').trigger("reset");
			$('#resetpassForm #userid').val('');
		}); 

    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->




    
