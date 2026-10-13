
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
                            <form class="text-left validate-form" id="" method="post" target="_blank" action="reports/buyrequestreport.php" enctype="multipart/form-data">
                                
                                <div class="row">    
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                        <div class="input-group mb-0">
                                            <label class="mb-1">Customer <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-control selectpicker" data-live-search="true" id="customerid" name="customerid" data-size="10" data-dropup-auto="false">
                                                <option value="">Select Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                        <div class="input-group mb-0">
                                            <label class="mb-1">Shape <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-control selectpicker" data-live-search="true" id="shapeid" name="shapeid" data-size="10" data-dropup-auto="false">
                                                <option value="">Select Shape</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                  

                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="mb-1">From Date<span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control control-append fromdate" placeholder="From Date"  id="fromdate" name="fromdate" require>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="fromdate"><i class="bi bi-calendar4-week"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="mb-1">To Date<span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control control-append todate" placeholder="To Date"  id="todate" name="todate" require>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="todate"><i class="bi bi-calendar4-week"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-3">
                                       <div class="input-group mb-2 mt-4">
                                           <div class="custom-control custom-checkbox m-0">
                                               <input type="checkbox" value="1" name="isdetails" id="isdetails" class="custom-control-input">
                                               <label for="isdetails" class="custom-control-label mb-0">
                                                   With Details
                                               </label>
                                           </div>
                                       </div>
                                   </div>
                                   
                                    <div class="col-2">
                                        <div class="ml-auto mt-4">
                                            <div class="input-group mb-0">
                                                <button type="submit" class="btn btn-primary m-0" id="btnsubmitsales"><?php echo $config->getGeneratereport(); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- CONTENT AREA -->
</div>

    <script>
        $(document).ready(function () {
            
            $('.selectpicker').selectpicker('refresh');
            fillshapes();
            fillseller();
        });
        
        function fillseller()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillbuyrequestseller");
			ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillseller,OnErrorSelectpicker);

           
        }
        function Onsuccessfillseller(content)
        {
            var JsonData = JSON.stringify(content);
            var resultdata = jQuery.parseJSON(JsonData);
            var htmldata = '<option value="">Select Customer</option>';
            htmldata += resultdata.data;
            $('#customerid').html(htmldata);
            $('#customerid').selectpicker('refresh');
                
            
        }
        function fillshapes()
        {
            var pagename=getpagename();
            var headersdata= {Accept: 'application/json',platform: 1,userpagename:pagename,useraction:'viewright',masterlisting:true,responsetype: 'HTML'};
            formdata = new FormData();
            formdata.append("action", "fillshapes");
            ajaxrequest("POST",'<?php echo $config->getEndpointurl(); ?>'+'master',formdata,headersdata,Onsuccessfillshape,OnErrorSelectpicker); 
           
        }
        function Onsuccessfillshape(content)
            {
                var JsonData = JSON.stringify(content);
                var resultdata = jQuery.parseJSON(JsonData);
                var htmldata = '<option value="">Select Shape</option>';
                htmldata += resultdata.data;
                $('#shapeid').html(htmldata);
                $('#shapeid').selectpicker('refresh');
                
            }

        // date filter
        $('.todate').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
			format: 'DD/MM/YYYY',
			time: false,
            switchOnClick: true,
            okText: "",
			
        }).on('change', function(e, date)
        {
            $(this).removeClass('error');
            $(this).parent('div').removeClass('error');  
	        $(this).parent().find('label.error').html('');
        });

        $('.fromdate').bootstrapMaterialDatePicker
        ({
            weekStart: 0, 
			format: 'DD/MM/YYYY', 
			time: false,
            switchOnClick: true,
            okText: "",
			//minDate: moment(), // Current day

        }).on('change', function(e, date)
        {
            $('.todate').bootstrapMaterialDatePicker('setMinDate', date);
            $('.todate').val("");
			$(this).removeClass('error');
            $(this).parent('div').removeClass('error');  
	        $(this).parent().find('label.error').html('');
        });
        function resetdata()
        {
            $("#customerreportForm").validate().resetForm();
            $('#customerreportForm').trigger("reset");
            Edittimeformnamechange(2);   
        }
    </script>
