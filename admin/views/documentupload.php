<?php
require_once dirname(__DIR__, 1) . '/config/init.php';

?>

<div class="layout-px-spacing">

    <!-- CONTENT AREA -->
    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-12 col-xl-12 mb-3">
                    <div class="widget">
                        <div class="widget-content">
                            <form class="text-left validate-form" id="documentuploadForm" method="post" action="documentupload" enctype="multipart/form-data">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-10 offset-1">
                                            <div class="input-group">
                                                <label class="mb-1">Type <span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select class="form-control selectpicker" name="typeid" id="typeid" data-size="8" data-dropup-auto="false" data-live-search="true">
                                                    <option value="">Select Type</option>
                                                    <option value="1">Diamond(Single)</option>
                                                    <option value="2">Diamond(Multiple)</option>
                                                    <option value="3">Jewellery(Single)</option>
                                                    <option value="4">Jewellery(Multiple)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-5  offset-1">
                                            <div class="input-group">
                                                <label class="mb-1">Upload Document</label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3 mb-lg-3">
                                                <div class="filepreview">
                                                    <input class="form-control" type="file" name="docfile" id="docfile">
                                                </div>
                                                <p class="imgerr" style="color:#f00;font-weight: bold;"></p>
                                            </div>
                                        </div>
                                        <div class="col-3  offset-1">
                                            <div class="input-group mb-3 mb-lg-3 filepreviewlist">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <?php
                                if ((($rightstotalcount) > 0 ? $Pagerights->getAddright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
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
    $(document).ready(function() {
        $('.selectpicker').selectpicker('refresh');
        
    });


    function resetdata() {
        $("#documentuploadForm").validate().resetForm();
        $('#documentuploadForm').trigger("reset");
        $('#sbcolor').css('background-color', '#FFFFFF');
        Edittimeformnamechange(2);
        $('#imgpreview').addClass('d-none');
        $('.img-remove').addClass('d-none');
    }



    $('body').on('change', '#typeid', function() {
        fillcontent();
    });

    //Fill content
    function fillcontent() {
        var typeid = $('#typeid').val();
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'viewright',
            masterlisting: true
        };

        formdata = new FormData();
        formdata.append("action", "fillcontent");
        formdata.append("typeid", typeid);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillcontent, OnErrorfillcontent);
    }

    function Onsuccessfillcontent(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        if(resultdata.status==1)
        {
            var typeid = resultdata.typeid;
            $('.filepreviewlist').addClass('d-none');
            if (resultdata.fileurl != '') {
                $('.filepreviewlist').removeClass('d-none');

                var htmldata='';
                htmldata+='<a href="'+resultdata.fileurlpath+'" target="_blank"><img src="<?php echo $config->getImageurl() ?>images/files.png" class="mt-1 mb-3" id="imgpreview" style="height: 100px; max-width: 100%;background-color: #cce4e72e;margin-top:20px !important;"></a>';
                htmldata+='<a href="javascript:void(0);" title="Remove" class="remove-file" data-id="' + resultdata.id + '" style="font-size:20px;color:red"><i class="fal fa-times"></i></a>';
                $('.filepreviewlist').html(htmldata);
            }

        }
        else if(resultdata.status==0)
        {
            $('.filepreviewlist').addClass('d-none');
        }
            




    }

    function OnErrorfillcontent(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }


    $('body').on('click', '.remove-file', function() {
        var id = $(this).attr('data-id');
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false
        };
        formdata = new FormData();
        formdata.append("action", "removeimage");
        formdata.append("id", id);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessremoveimage, OnErrorremoveimage);

    });


    function Onsuccessremoveimage(data) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        if (resultdata.status == 0) {
            alertify(resultdata.message, 0);
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, 1);
            $('.filepreviewlist').addClass('d-none');
        }
    }

    function OnErrorremoveimage(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }



    if ($('#documentuploadForm').length) {
        $('#documentuploadForm').validate({
            rules: {
                typeid: {
                    required: true,
                },
            },
            messages: {
                typeid: {
                    required: "Type is required",
                },
            },
            submitHandler: function(form) {
                
                $('#loaderprogress').show();
                var pagename = getpagename();
                formdata = new FormData(form);

                formdata.append("action", "insertdocumentupload");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 1,
                    userpagename: pagename,
                    useraction: 'addright',
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, OnsuccessdocumentuploadDataSubmit, OnErrordocumentuploadDataSubmit)

            },
        });
    }

    function OnsuccessdocumentuploadDataSubmit(data) {
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#loaderprogress').hide();
        if (resultdata.status == 0) {
            alertify(resultdata.message, '0');
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, '1');
            $('#docfile').val('');
            fillcontent();
        }
    }

    function OnErrordocumentuploadDataSubmit(data) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }
</script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->