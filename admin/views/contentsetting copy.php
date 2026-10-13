<?php 
require_once dirname(__DIR__, 1).'/config/init.php';
?>
    
<div class="layout-px-spacing">

    <!-- CONTENT AREA -->
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12 mb-3">
                    <div class="widget">
                        <div class="widget-content">
                            <form class="text-left validate-form" id="contentsettingForm" method="post" action="contentsetting" enctype="multipart/form-data">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-10 offset-1">
                                        <div class="input-group">
                                            <label class="mb-1">Content Type <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-control selectpicker" name="contenttypeid" id="contenttypeid" data-size="8" data-dropup-auto="false" data-live-search="true">
                                                <option value="">Select Content Type</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 titleDiv2 d-none">
                                        <div class="input-group">
                                            <label class="mb-1">Title <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="text" id="maintitle" name="maintitle" class="form-control" placeholder="Title"/>
                                        </div>
                                    </div>
                                    <div class="col-5 offset-1 titleDiv d-none">
                                        <div class="input-group">
                                            <label class="mb-1">Title 1 <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="text" id="title" name="title" class="form-control" placeholder="Title 1"/>
                                        </div>
                                    </div>
                                    <div class="col-5 titleDiv d-none">
                                        <div class="input-group">
                                            <label class="mb-1">Title 2 <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="text" id="title2" name="title2" class="form-control" placeholder="Title 2"/>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 shortdescrDiv">
                                        <div class="input-group">
                                            <label class="mb-1">Short Description <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="shortdescr" name="shortdescr" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 iconclass d-none">
                                        <div class="input-group">
                                            <label class="mb-1">Icon Class <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                        <input type="text" id="iconclass" name="iconclass" class="form-control" placeholder="ion-compass"/>
                                        </div>
                                    </div>
                                    <div class="col-10 offset-1 descrDiv">
                                        <div class="input-group">
                                            <label class="mb-1">Description <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="contentdescr" name="contentdescr" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="row col-10 offset-1">
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-exl-4 imgDiv">
                                            <div class="input-group mb-0">
                                                <label class="mb-1">Image <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="input-group mb-3 ">
                                                <img src="" class="mt-1 mb-3" id="imgpreview" class="d-none" style="height: 200px; max-width: 100%;background-color: #cce4e72e;" />
                                                <input type="file" class="form-control d-none" id="img" name="img" accept="image/*">
                                                <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="img">
                                                    <span style="background-image: url(assets/img/salon.jpg);"></span>
                                                    <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                                </label>
                                                <span style="color:#B00">** Please upload image in JPG,JPEG,PNG Format</span>
                                                <span style="color:#B00" class="imgsizelbl"></span>
                                            </div> 
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-exl-4 imgDiv2">
                                            <div class="input-group mb-0">
                                                <label class="mb-1">Image <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="input-group mb-3 ">
                                                <img src="" class="mt-1 mb-3" id="imgpreview2" class="d-none" style="height: 200px; max-width: 100%" />
                                                <input type="file" class="form-control d-none" id="img2" name="img2" accept="image/*">
                                                <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="img2">
                                                    <span style="background-image: url(assets/img/salon.jpg);"></span>
                                                    <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                                </label>
                                                <span style="color:#B00">** Please upload image in JPG,JPEG,PNG Format</span>
                                                <span style="color:#B00" class="imgsizelbl2"></span>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-10 offset-1 layout-spacing d-none" id="abtDiv">
                                    <div class="widget mt-10">
                                        <div class="widget-content row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                   
                                                    <div class="col-4">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Title <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Title" id="abttitle" name="abttitle">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Display Order <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Display Order" id="obsdisplayorder" name="obsdisplayorder" onkeypress="numbonly(event)" onpaste="numbonly(event)" require>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Description <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <textarea id="obsdescription" name="obsdescription" class="form-control" placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mt-4 mb-auto">
                                                        <button type="button" class="col-auto btn btn-primary m-0" id="btnaddabtdetail" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add "><i class="bi bi-plus-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="table-responsive pt-2">
                                                        <div class="col-12 p-0">
                                                            <table id="tableabtdetail" class="table table-bordered table-hover table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="tbl-name">Title</th>
                                                                        <th class="tbl-name">Display Order</th>
                                                                        <th class="tbl-name">Description</th>
                                                                        <th class="tbl-action">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tblabt">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 offset-1 layout-spacing ourbestserviceDiv d-none">
                                    <div class="widget mt-10">
                                        <div class="widget-content row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                   
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Title <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Title" id="ostitle" name="ostitle">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Display Order <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Display Order" id="osdisplayorder" name="osdisplayorder" onkeypress="numbonly(event)" onpaste="numbonly(event)" require>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Description <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <textarea id="osdescription" name="osdescription" class="form-control" placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Icon <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="fa fa-wrench" id="osicon" name="osicon">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Image <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-4">
                                                            <input type="file" class="form-control d-none" id="obsimg" name="obsimg" accept="image/*">
                                                            <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="obsimg">
                                                                <span style="background-image: url(assets/img/salon.jpg);"></span>
                                                                <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                                            </label>
                                                            <span style="color:#B00">** Please upload image in JPG,JPEG,PNG Format</span>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-auto mt-4 mb-auto">
                                                        <button type="button" class="col-auto btn btn-primary m-0" id="btnaddobs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add "><i class="bi bi-plus-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="table-responsive pt-2">
                                                        <div class="col-12 p-0">
                                                            <table id="tablevesselmappricing" class="table table-bordered table-hover table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="tbl-name">Title</th>
                                                                        <th class="tbl-name">Display Order</th>
                                                                        <th class="tbl-name">Description</th>
                                                                        <th class="tbl-name">Icon</th>
                                                                        <th class="tbl-action">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tblobs">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-10 offset-1 layout-spacing serviceblockDiv d-none">
                                    <div class="widget mt-10">
                                        <div class="widget-content row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                   
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Title <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Title" id="sbtitle" name="sbtitle">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Display Order <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Display Order" id="sbdisplayorder" name="sbdisplayorder" onkeypress="numbonly(event)" onpaste="numbonly(event)" require>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Persontage (%) <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Persontage (%)" max="100" id="sbpersontage" name="sbpersontage" onkeypress="numbonly(event)" onpaste="numbonly(event)" require>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Color <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" id="sbcolor" name="sbcolor" class="form-control  jscolor{hash:true}"  value="#FFFFFF" require>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-auto mt-4 mb-auto">
                                                        <button type="button" class="col-auto btn btn-primary m-0" id="btnaddsb" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add "><i class="bi bi-plus-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="table-responsive pt-2">
                                                        <div class="col-12 p-0">
                                                            <table id="tablevesselmappricing" class="table table-bordered table-hover table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="tbl-name">Title</th>
                                                                        <th class="tbl-name">Display Order</th>
                                                                        <th class="tbl-name">Persontage (%)</th>
                                                                        <th class="tbl-name">Color</th>
                                                                        <th class="tbl-action">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tblserviceblock">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>

                                <div class="col-10 offset-1 layout-spacing aboutdiv ">
                                    <div class="widget mt-10">
                                        <div class="widget-content row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                   
                                                    <div class="col-3">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Image <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-4">
                                                            <input type="file" class="form-control d-none" id="aboutimg" name="aboutimg" accept="image/*">
                                                            <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1" for="aboutimg">
                                                                <span style="background-image: url(assets/img/salon.jpg);"></span>
                                                                <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                                            </label>
                                                            <span style="color:#B00">** Please upload image in JPG,JPEG,PNG Format</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="input-group mb-0">
                                                            <label class="mb-1">Display Order <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="input-group mb-3 mb-sm-3">
                                                            <input type="text" class="form-control" placeholder="Display Order" id="aboutdisplayorder" name="aboutdisplayorder" onkeypress="numbonly(event)" onpaste="numbonly(event)" require>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mt-4 mb-auto">
                                                        <button type="button" class="col-auto btn btn-primary m-0" id="btnaddaboutdetail" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add "><i class="bi bi-plus-lg"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="table-responsive pt-2">
                                                        <div class="col-12 p-0">
                                                            <table id="tablevesselmappricing" class="table table-bordered table-hover table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="tbl-name">Image</th>
                                                                        <th class="tbl-name">Display Order</th>
                                                                        <th class="tbl-action">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tblaboutdetail">
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    if(($rightstotalcount>0 ? $Pagerights->getAddright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1) //rights check admin and right person
                                    {
                                        ?>
                                        <div class="row col-10 offset-1">
                                            <div class="ml-auto">
                                                <div class="input-group mb-0">
                                                    <button type="submit" class="btn btn-primary m-0" id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
                                                    <button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset" onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- CONTENT AREA -->
</div>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker('refresh');
            $('#contentsettingForm #contentdescr').froalaEditor();
            fillcontenttype();
            $('#sbcolor').css('background-color','#FFFFFF');
        });

        
        function resetdata()
        {
            $("#contentsettingForm").validate().resetForm();
            $('#contentsettingForm').trigger("reset");
            $('#sbcolor').css('background-color','#FFFFFF');
            Edittimeformnamechange(2);   
            fillcontenttype();
        }

        function fillcontenttype()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillcontenttype");
			formdata.append("selectoption", 0);
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillcontenttype,OnErrorSelectpicker);
        }

        function Onsuccessfillcontenttype(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#contenttypeid').html(resultdata.data);
            $('#contenttypeid').selectpicker('refresh');

            $('.descrDiv').removeClass('d-none');
            $('.titleDiv').addClass('d-none');
            $('.titleDiv2').addClass('d-none');
            $('.ourbestserviceDiv').addClass('d-none');
            $('.imgDiv').addClass('d-none');
            $('.imgDiv2').addClass('d-none');
            fillcontent()
        }

  
        // LOGO
        $("#img").on('change',function(){
            var img = $("#img").val();
            if(img)
            {
                $('#imgpreview').addClass('d-none');
            }
            else
            {
                $('#imgpreview').removeClass('d-none');
            }
        });

        $("#img2").on('fileclear',function(){
            $('#imgpreview2').removeClass('d-none');
        });

        $("#img2").on('change',function(){
            var img = $("#img2").val();
            if(img)
            {
                $('#imgpreview2').addClass('d-none');
            }
            else
            {
                $('#imgpreview2').removeClass('d-none');
            }
        });

        $("#img2").on('fileclear',function(){
            $('#imgpreview2').removeClass('d-none');
        });


        $('body').on('change', '#contenttypeid', function () {
            fillcontent();
            var contenttypeid = $(this).val();
            if(contenttypeid == '<?php echo $config->getTermsConditionId(); ?>' || contenttypeid == '<?php echo $config->getPrivacyPolicyId(); ?>' || contenttypeid == '<?php echo $config->getDealerTrustid(); ?>' || contenttypeid == '<?php echo $config->getContactusId(); ?>'  || contenttypeid == '<?php echo $config->getCookiesid(); ?>') // for terms & condition - Privacy Policy,home header description
            {    
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');    
                $('#abtDiv').addClass('d-none'); 
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
                
            }
            else if(contenttypeid == '<?php echo $config->getInsurancePolicyid(); ?>' || contenttypeid == '<?php echo $config->getEconomicAnalysisid(); ?>' || contenttypeid == '<?php echo $config->getOrganizationalBehaviourid(); ?>')
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').removeClass('d-none');
            }
            else if(contenttypeid == '<?php echo $config->getBusinextProcessCmpid(); ?>')
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').removeClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');    
                $('#abtDiv').addClass('d-none'); 
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
            }
            else if(contenttypeid == '<?php echo $config->getAboutUsReliableMotorId(); ?>' || contenttypeid == '<?php echo $config->getAboutsavanigemsid(); ?>') // for About Us
            {
                $('.shortdescrDiv').removeClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgDiv2').addClass('d-none');
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').removeClass('d-none');
                $('.iconclass').addClass('d-none');
            }
            /* else if(contenttypeid == '<?php //echo $config->getwhyARChemicalsid(); ?>') // for About Us
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgDiv2').addClass('d-none');
                $('#abtDiv').removeClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
            } */
            else if(contenttypeid == '<?php echo $config->getMissionId(); ?>' || contenttypeid == '<?php echo $config->getVissionId(); ?>' || contenttypeid == '<?php echo $config->getQualityPolicyId(); ?>')  // for mission, vission - values
            {    
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').removeClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
            }
            /* else if(contenttypeid == '<?php //echo $config->getWelcomeARCid(); ?>' )
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
            } */
            else if( contenttypeid == '<?php echo $config->getOurSevicesid(); ?>')
            {
                $('.shortdescrDiv').removeClass('d-none');
                $('.descrDiv').addClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').removeClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
            }
            
        });


        //Fill content
        function fillcontent()
        {
            var contenttypeid = $('#contenttypeid').val();
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

            formdata = new FormData();
            formdata.append("action", "fillcontent");
            formdata.append("contenttypeid", contenttypeid);

            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessfillcontent,OnErrorfillcontent);
        }
        function Onsuccessfillcontent(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var contenttypeid = resultdata.contenttypeid;
            $('#contentsettingForm  #contentdescr').froalaEditor('html.set',resultdata.description);
            $('#contentsettingForm  #title').val(resultdata.title);
            $('#contentsettingForm  #maintitle').val(resultdata.title);
            $('#contentsettingForm  #title2').val(resultdata.title2);
            $('#contentsettingForm  #shortdescr').val(resultdata.shortdescr);
            $('#contentsettingForm  #iconclass').val(resultdata.iconclass)
            if(resultdata.img)
            {
                $('#imgpreview').removeClass('d-none');
		        $('#imgpreview').attr('src',resultdata.img);
            }
            else
            {
                $('#imgpreview').addClass('d-none');
		        $('#imgpreview').attr('src','');
            }

            if(resultdata.img2)
            {
                $('#imgpreview2').removeClass('d-none');
		        $('#imgpreview2').attr('src',resultdata.img2);
            }
            else
            {
                $('#imgpreview2').addClass('d-none');
		        $('#imgpreview2').attr('src','');
            }

            $('#tblobs').html('');
            $('#tblaboutdetail').html('');
            // $('#tblser').html(tbldata);

            /* var tbldata="";	
            for(var i in resultdata.abtresult)
			{
               
                tbldata+='<tr data-index="'+i+'">';
                tbldata+='<td class="tbl-name">'+resultdata.abtresult[i].title+'<input type="hidden" name="tblabttitle[]" id="tblabttitle'+i+'" value="'+resultdata.abtresult[i].title+'" /></td>';
                tbldata+='<td class="">'+resultdata.abtresult[i].count+'<input type="hidden" name="tblabtcount[]" id="tblabtcount'+i+'" value="'+resultdata.abtresult[i].count+'" /></td>';
                tbldata+='<td class="tbl-name"><img src="'+resultdata.abtresult[i].imgpath+'" style="width:100px;height:100px;"/><input type="hidden" name="tblabtimg[]" id="tblabtimg'+i+'" value="'+resultdata.abtresult[i].imgpath1+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblobs" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';
            }
            $('#tblabt').html(tbldata); */

            if(contenttypeid == '<?php echo $config->getTermsConditionId(); ?>' || contenttypeid == '<?php echo $config->getPrivacyPolicyId(); ?>' || contenttypeid == '<?php echo $config->getDealerTrustid(); ?>'  || contenttypeid == '<?php echo $config->getContactusId(); ?>' || contenttypeid == '<?php echo $config->getCookiesid(); ?>') // for terms & condition - Privacy Policy
            {    
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
            }
            else if(contenttypeid == '<?php echo $config->getInsurancePolicyid(); ?>' || contenttypeid == '<?php echo $config->getEconomicAnalysisid(); ?>' || contenttypeid == '<?php echo $config->getOrganizationalBehaviourid(); ?>')
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').removeClass('d-none');
            }
            else if(contenttypeid == '<?php echo $config->getBusinextProcessCmpid(); ?>')
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').removeClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');    
                $('#abtDiv').addClass('d-none'); 
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
            }
            else if(contenttypeid == '<?php echo $config->getAboutUsReliableMotorId(); ?>' || contenttypeid == '<?php echo $config->getAboutsavanigemsid(); ?>') // for About Us
            {
                $('.shortdescrDiv').removeClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgDiv2').addClass('d-none');
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').removeClass('d-none');
                $('.iconclass').addClass('d-none');
                var tbldata="";	
                for(var i in resultdata.result)
			    {
                    var trtmp=i;
                    tbldata+='<tr data-index="'+trtmp+'">';
                    tbldata+='<td class="tbl-name"><img src="'+resultdata.result[i].imgpath+'" style="width:100px;height:100px;"/><input type="hidden" name="tblaboutimg[]" id="tblaboutimg'+trtmp+'" value="'+resultdata.result[i].imgpath1+'" /></td>';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].displayorder+'<input type="hidden" name="tblaboutdisplayorder[]" id="tblaboutdisplayorder'+trtmp+'" value="'+resultdata.result[i].displayorder+'" /></td>';
                    
                    tbldata+='<td class="tbl-action">';
                    tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblobs" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                    tbldata+='</td>';
                    tbldata+='</tr>';
                }
                    
                $('#tblaboutdetail').html(tbldata);

            }
            else if(contenttypeid == '<?php echo $config->getMissionId(); ?>' || contenttypeid == '<?php echo $config->getVissionId(); ?>'  || contenttypeid == '<?php echo $config->getQualityPolicyId(); ?>') // for mission, vission - values
            {    
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').removeClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');
            }
           /*  else if(contenttypeid == '<?php //echo $config->getWelcomeARCid(); ?>')
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv2').addClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
            } */
            else if( contenttypeid == '<?php echo $config->getOurSevicesid(); ?>')
            {
                $('.shortdescrDiv').removeClass('d-none');
                $('.descrDiv').addClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgsizelbl').html('');     
                $('.imgDiv2').addClass('d-none');
                $('.imgsizelbl2').html('');     
                $('#abtDiv').addClass('d-none');
                $('.ourbestserviceDiv').removeClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');
                $('.iconclass').addClass('d-none');

                var tbldata="";	
                for(var i in resultdata.result)
                {
                    tbldata+='<tr data-index="'+i+'">';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].title+'<input type="hidden" name="tblostitle[]" id="tblostitle'+i+'" value="'+resultdata.result[i].title+'" /></td>';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].displayorder+'<input type="hidden" name="tblosdisplayorder[]" id="tblosdisplayorder'+i+'" value="'+resultdata.result[i].displayorder+'" /></td>';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].descr+'<input type="hidden" name="tblosdescr[]" id="tblosdescr'+i+'" value="'+resultdata.result[i].descr+'" /></td>';
                    tbldata+='<td class="tbl-name"><i class="'+resultdata.result[i].iconname+'" aria-hidden="true"></i><input type="hidden" name="tblosicon[]" id="tblosicon'+i+'" value="'+resultdata.result[i].iconname+'" /></td>';
                    tbldata+='<td class="tbl-action">';
                    tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                    tbldata+='</td>';
                    tbldata+='</tr>';
                }
                $('#tblobs').html(tbldata);
            }
           /*  else if(contenttypeid == '<?php //echo $config->getwhyARChemicalsid(); ?>') // for About Us
            {
                $('.shortdescrDiv').addClass('d-none');
                $('.descrDiv').removeClass('d-none');
                $('.titleDiv2').removeClass('d-none');
                $('.titleDiv').addClass('d-none');
                $('.imgDiv').addClass('d-none');
                $('.imgDiv2').addClass('d-none');
                $('#abtDiv').removeClass('d-none');
                $('.ourbestserviceDiv').addClass('d-none');
                $('.serviceDiv').addClass('d-none');
                $('.serviceblockDiv').addClass('d-none');
                $('.aboutdiv').addClass('d-none');

                var tbldata="";	
                var trtmp = 0;
                for(var i in resultdata.result)
                {
                    tbldata+='<tr data-index="'+trtmp+'">';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].title+'<input type="hidden" name="tblabttitle[]" id="tblabttitle'+trtmp+'" value="'+resultdata.result[i].title+'" /></td>';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].displayorder+'<input type="hidden" name="tblobsdisplayorder[]" id="tblobsdisplayorder'+trtmp+'" value="'+resultdata.result[i].displayorder+'" /></td>';
                    tbldata+='<td class="tbl-name">'+resultdata.result[i].descr+'<input type="hidden" name="tblobsdescr[]" id="tblobsdescr'+trtmp+'" value="'+resultdata.result[i].descr+'" /></td>';
                    tbldata+='<td class="tbl-action">';
                    tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                    tbldata+='</td>';
                    tbldata+='</tr>';
                    trtmp++;    
                }
                $('#tblabt').html(tbldata);
            } */
            

        }

        function OnErrorfillcontent(content)
        { 
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }


        /***************** Start For Add Our Best Service *****************/
		//Add about us in Table
		/* $('body').on('click','#btnaddobs', function () {
            var title=$('#obstitle').val();
            var description=$('#crdescription').val();
            var displayorder=$('#crdisplayorder').val();
            
            var imgfile_data = $("#obsimg").prop("files")[0];   
           
            if(title && description  && displayorder && imgfile_data)
            {
                
                var pagename=getpagename();
                var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

                formdata = new FormData();
                formdata.append("action", "uploadtempfile");
                formdata.append("imgfile", imgfile_data);
                formdata.append("title", title);
                formdata.append("description", description);
                formdata.append("displayorder", displayorder);

                ajaxrequest("POST",'<?php //echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessuploadtempfile,OnErroruploadtempfile); 
            
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        });

        function Onsuccessuploadtempfile(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            if(resultdata.status==0)
			{
				alertify(resultdata.message,0);
			}
			else if(resultdata.status==1)
			{
				$("#tblobs tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblobstitle = $('#tblobstitle'+trtmp).val();

                    if(tblobstitle == resultdata.title)
                    {
                        $(this).remove();
                    }
                });

                var trtmp = $('#tblobs tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+resultdata.title+'<input type="hidden" name="tblobstitle[]" id="tblobstitle'+trtmp+'" value="'+resultdata.title+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.displayorder+'<input type="hidden" name="tblobsdisplayorder[]" id="tblobsdisplayorder'+trtmp+'" value="'+resultdata.displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.description+'<input type="hidden" name="tblobsdescr[]" id="tblobsdescr'+trtmp+'" value="'+resultdata.description+'" /></td>';
               tbldata+='<td class="tbl-name"><img src="'+resultdata.imgurl+'" style="width:100px;height:100px;"/><input type="hidden" name="tblobsimg[]" id="tblobsimg'+trtmp+'" value="'+resultdata.imgurl1+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblobs" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblobs').append(tbldata);
                $('#obstitle').val('');
                $('#crdescription').val('');
                $('#crdisplayorder').val('');

			}
        }

        function OnErroruploadtempfile(content)
        { 
            ajaxrequest("POST",'<?php //echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        } */

        $('body').on('click', '#btnaddobs', function(){
            var title = $('#ostitle').val();
            var descr = $('#osdescription').val();
            var displayorder = $('#osdisplayorder').val();
            var osicon=$('#osicon').val();
            if(title && descr && displayorder && osicon)
            {
                $("#tblobs tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblostitle = $('#tblostitle'+trtmp).val();

                    if(tblostitle == title)
                    {
                        $(this).remove();
                    }
                });
                
                var trtmp = $('#tblobs tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+title+'<input type="hidden" name="tblostitle[]" id="tblostitle'+trtmp+'" value="'+title+'" /></td>';
                tbldata+='<td class="tbl-name">'+displayorder+'<input type="hidden" name="tblosdisplayorder[]" id="tblosdisplayorder'+trtmp+'" value="'+displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+descr+'<input type="hidden" name="tblosdescr[]" id="tblosdescr'+trtmp+'" value="'+descr+'" /></td>';
                tbldata+='<td class="tbl-name"><i class="'+osicon+'" aria-hidden="true"></i><input type="hidden" name="tblosicon[]" id="tblosicon'+trtmp+'" value="'+osicon+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblobs').append(tbldata);
                $('#ostitle').val('');
                $('#osdescription').val('');
                $('#osdisplayorder').val('');
                $('#osicon').val('');
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        })

        //Remove Row in Table
        $('body').on('click','.removetblobs', function () {            
            $(this).parent().parent().remove();
        });

        $('body').on('click','#removetblprice', function () {            
            $(this).parent().parent().remove();
        });
        /***************** End For Add About Us *****************/

        $('body').on('click', '#btnaddabtdetail', function(){
            var title = $('#abttitle').val();
            var descr = $('#obsdescription').val();
            var displayorder = $('#obsdisplayorder').val();

            if(title && descr && displayorder)
            {
                $("#tblabt tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblabttitle = $('#tblabttitle'+trtmp).val();

                    if(tblabttitle == title)
                    {
                        $(this).remove();
                    }
                });
                
                var trtmp = $('#tblabt tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+title+'<input type="hidden" name="tblabttitle[]" id="tblabttitle'+trtmp+'" value="'+title+'" /></td>';
                tbldata+='<td class="tbl-name">'+displayorder+'<input type="hidden" name="tblobsdisplayorder[]" id="tblobsdisplayorder'+trtmp+'" value="'+displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+descr+'<input type="hidden" name="tblobsdescr[]" id="tblobsdescr'+trtmp+'" value="'+descr+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblabt').append(tbldata);
                $('#abttitle').val('');
                $('#obsdescription').val('');
                $('#obsdescription').text('');
                $('#obsdisplayorder').val('');
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        })


        $('body').on('click','#btnaddabt', function () {
            var title=$('#abttitle').val();
            var count=$('#abtcount').val();
            
            var imgfile_data = $("#iconimg").prop("files")[0];   

            if(title && count && imgfile_data)
            {
                
                var pagename=getpagename();
                var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

                formdata = new FormData();
                formdata.append("action", "uploadtempfile");
                formdata.append("iconimg", imgfile_data);
                formdata.append("title", title);
                formdata.append("count", count);
                formdata.append("type", 1);
                ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessabt,OnErrorabt); 
            
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        });

        function Onsuccessabt(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            if(resultdata.status==0)
			{
				alertify(resultdata.message,0);
			}
			else if(resultdata.status==1)
			{
				$("#tblabt tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblabttitle = $('#tblabttitle'+trtmp).val();

                    if(tblabttitle == resultdata.title)
                    {
                        $(this).remove();
                    }
                });

                var trtmp = $('#tblabt tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+resultdata.title+'<input type="hidden" name="tblabttitle[]" id="tblabttitle'+trtmp+'" value="'+resultdata.title+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.count+'<input type="hidden" name="tblabtcount[]" id="tblabtcount'+trtmp+'" value="'+resultdata.count+'" /></td>';
                tbldata+='<td class="tbl-name"><img src="'+resultdata.imgurl+'" style="width:100px;height:100px;"/><input type="hidden" name="tblabtimg[]" id="tblabtimg'+trtmp+'" value="'+resultdata.imgurl1+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblabt').append(tbldata);
                $('#abttitle').val('');
                $('#abtcount').val('');

			}
        }

        function OnErrorabt(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }


        if($('#contentsettingForm').length){		
            $('#contentsettingForm').validate({
                rules:{
                    contenttypeid:{
                        required: true,			
                    },
                    title:{
                        required: true,		
                    },
                    title2:{
                        required: true,		
                    },
                },messages:{
                    contenttypeid:{
                        required:"Content type is required",
                    },
                    title:{
                        required:"Title is required",
                    },
                    title2:{
                        required:"Sub Title is required",
                    }
                },
                submitHandler: function(form){
                    $('#loaderprogress').show();
                    var descr = $('#contentdescr').froalaEditor('html.get')
                    var pagename=getpagename();
                    formdata = new FormData(form);
                    
                    formdata.append("action", "insertcontentsetting");
                    formdata.append("descr", descr);
                    var headersdata= {'Accept': 'application/json',platform: 1,userpagename:pagename,useraction:'addright',masterlisting:false};
                    ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,OnsuccessContentSettingDataSubmit,OnErrorContentSettingDataSubmit)

			    },
            });
        }

        function OnsuccessContentSettingDataSubmit(data)
        {
            var JsonData = JSON.stringify(data);
            var resultdata = jQuery.parseJSON(JsonData);
            $('#loaderprogress').hide();	
            if(resultdata.status==0)
            {
                alertify(resultdata.message, '0');
            }
            else if(resultdata.status==1)
            {
                alertify(resultdata.message, '1');
                fillcontent();
            }
        }

        function OnErrorContentSettingDataSubmit(data)
        {
            ajaxrequest("POST","'<?php echo $config->getPage404url(); ?>'",'','',OnsuccessRender,OnErrorRender);
        }

        // service block details add
        $('body').on('click','#btnaddser', function () {
            var title=$('#sertitle').val();
            var description=$('#serdescription').val();
            var displayorder=$('#serdisplayorder').val();
            
            var imgfile_data = $("#serimg").prop("files")[0];   

            if(title && description && displayorder && imgfile_data)
            {
                
                var pagename=getpagename();
                var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

                formdata = new FormData();
                formdata.append("action", "uploadtempfile");
                formdata.append("imgfile", imgfile_data);
                formdata.append("title", title);
                formdata.append("description", description);
                formdata.append("displayorder", displayorder);

                ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessseruploadtempfile,OnErrorseruploadtempfile); 
            
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        });

        function Onsuccessseruploadtempfile(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);

            if(resultdata.status==0)
			{
				alertify(resultdata.message,0);
			}
			else if(resultdata.status==1)
			{
				$("#tblser tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblobstitle = $('#tblsertitle'+trtmp).val();

                    if(tblobstitle == resultdata.title)
                    {
                        $(this).remove();
                    }
                });

                var trtmp = $('#tblobs tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+resultdata.title+'<input type="hidden" name="tblobstitle[]" id="tblobstitle'+trtmp+'" value="'+resultdata.title+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.displayorder+'<input type="hidden" name="tblobsdisplayorder[]" id="tblobsdisplayorder'+trtmp+'" value="'+resultdata.displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+resultdata.description+'<input type="hidden" name="tblobsdescr[]" id="tblobsdescr'+trtmp+'" value="'+resultdata.description+'" /></td>';
               tbldata+='<td class="tbl-name"><img src="'+resultdata.imgurl+'" style="width:100px;height:100px;"/><input type="hidden" name="tblobsimg[]" id="tblobsimg'+trtmp+'" value="'+resultdata.imgurl1+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblobs" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblser').append(tbldata);
                $('#sertitle').val('');
                $('#serdescription').val('');
                $('#serdisplayorder').val('');

			}
        }

        function OnErrorseruploadtempfile(content)
        { 
            ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
        }
       
        $('body').on('click', '#btnaddabtdetail', function(){
            var title = $('#abttitle').val();
            var descr = $('#obsdescription').val();
            var displayorder = $('#obsdisplayorder').val();

            if(title && descr && displayorder)
            {
                $("#tblabt tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblabttitle = $('#tblabttitle'+trtmp).val();

                    if(tblabttitle == title)
                    {
                        $(this).remove();
                    }
                });
                
                var trtmp = $('#tblabt tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+title+'<input type="hidden" name="tblabttitle[]" id="tblabttitle'+trtmp+'" value="'+title+'" /></td>';
                tbldata+='<td class="tbl-name">'+displayorder+'<input type="hidden" name="tblobsdisplayorder[]" id="tblobsdisplayorder'+trtmp+'" value="'+displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+descr+'<input type="hidden" name="tblobsdescr[]" id="tblobsdescr'+trtmp+'" value="'+descr+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblabt').append(tbldata);
                $('#abttitle').val('');
                $('#obsdescription').val('');
                $('#obsdescription').text('');
                $('#obsdisplayorder').val('');
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        })

        $('body').on('click', '#btnaddsb', function(){
            var title = $('#sbtitle').val();
            var sbpersontage = $('#sbpersontage').val();
            var displayorder = $('#sbdisplayorder').val();
            var sbcolor = $('#sbcolor').val();

            if(title && sbpersontage && displayorder && sbcolor)
            {
                $("#tblabt tr").each(function(){
                    var trtmp = $(this).attr('data-index');
                    var tblsbtitle = $('#tblabttitle'+trtmp).val();

                    if(tblsbtitle == title)
                    {
                        $(this).remove();
                    }
                });
                
                var trtmp = $('#tblabt tr:last').attr('data-index') | 0;
                trtmp = parseInt(trtmp+1);

                var tbldata="";	
                tbldata+='<tr data-index="'+trtmp+'">';
                tbldata+='<td class="tbl-name">'+title+'<input type="hidden" name="tblsbtitle[]" id="tblsbtitle'+trtmp+'" value="'+title+'" /></td>';
                tbldata+='<td class="tbl-name">'+displayorder+'<input type="hidden" name="tblsbdisplayorder[]" id="tblsbdisplayorder'+trtmp+'" value="'+displayorder+'" /></td>';
                tbldata+='<td class="tbl-name">'+sbpersontage+'<input type="hidden" name="tblsbpersontage[]" id="tblsbpersontage'+trtmp+'" value="'+sbpersontage+'" /></td>';
                tbldata+='<td class="tbl-name">'+sbcolor+'<input type="hidden" name="tblsbcolor[]" id="tblsbcolor'+trtmp+'" value="'+sbcolor+'" /></td>';
                tbldata+='<td class="tbl-action">';
                tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblabt" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                tbldata+='</td>';
                tbldata+='</tr>';

                $('#tblserviceblock').append(tbldata);
                $('#sbtitle').val('');
                $('#sbpersontage').val('');
                $('#sbdisplayorder').val('');
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        })

        $('body').on('click','#btnaddaboutdetail', function () {
            var displayorder=$('#aboutdisplayorder').val();
            
            var imgfile_data = $("#aboutimg").prop("files")[0];   
           
            if(displayorder && imgfile_data)
            {
                
                var pagename=getpagename();
                var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true};

                formdata = new FormData();
                formdata.append("action", "uploadabouttempfile");
                formdata.append("imgfile", imgfile_data);
               formdata.append("displayorder", displayorder);

                ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+pagename,formdata,headersdata,Onsuccessuploadabouttempfile,OnErroruploadabouttempfile); 
                function Onsuccessuploadabouttempfile(content)
                {
                    var JsonData = JSON.stringify(content);
                    var resultdata = jQuery.parseJSON(JsonData);

                    if(resultdata.status==0)
                    {
                        alertify(resultdata.message,0);
                    }
                    else if(resultdata.status==1)
                    {
                        

                        var trtmp = $('#tblaboutdetail tr:last').attr('data-index') | 0;
                        trtmp = parseInt(trtmp+1);

                        var tbldata="";	
                        tbldata+='<tr data-index="'+trtmp+'">';
                        tbldata+='<td class="tbl-name"><img src="'+resultdata.imgurl+'" style="width:100px;height:100px;"/><input type="hidden" name="tblaboutimg[]" id="tblaboutimg'+trtmp+'" value="'+resultdata.imgurl1+'" /></td>';
                        tbldata+='<td class="tbl-name">'+resultdata.displayorder+'<input type="hidden" name="tblaboutdisplayorder[]" id="tblaboutdisplayorder'+trtmp+'" value="'+resultdata.displayorder+'" /></td>';
                        
                        tbldata+='<td class="tbl-action">';
                        tbldata+='<a href="javascript:void(0);" class="btn-tbl text-danger m-0 rounded-circle removetblobs" id="removetblprice" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="bi bi-x-lg"></i></a>';
                        tbldata+='</td>';
                        tbldata+='</tr>';

                        $('#tblaboutdetail').append(tbldata);
                         $('#aboutdisplayorder').val('');

                    }
                }
                function OnErroruploadabouttempfile(content)
                { 
                    ajaxrequest("POST",'<?php echo $config->getPage404url(); ?>','','',OnsuccessRender,OnErrorRender);
                }
            
            }
            else
            {
                alertify('Please fill in all required fields',0);
            }
        });

        

        
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
