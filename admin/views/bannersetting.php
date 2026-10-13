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
                            <form class="text-left validate-form" id="bannersettingForm" method="post" action="bannersetting" enctype="multipart/form-data">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-10 offset-1">
                                            <div class="input-group">
                                                <label class="mb-1">Page <span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <select class="form-control selectpicker" name="contenttypeid" id="contenttypeid" data-size="8" data-dropup-auto="false" data-live-search="true">
                                                    <option value="">Select Content Type</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 titlediv">
                                            <div class="input-group">
                                                <label class="mb-1">Title<span class="text-danger">*</span></label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Title" id="title" name="title" require>
                                            </div>
                                        </div>
                                        <div class="col-5  offset-1">
                                            <div class="input-group">
                                                <label class="mb-1">Upload Image</label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3 mb-lg-3">
                                                <div class="filepreview">
                                                    <input class="form-control" type="file" name="img" id="img" accept="image/*">
                                                    <label class="filepreviewbg" for="img">
                                                        <img class="d-none filepreviewimg" id="filepreviewimg" src="assets/img/logo-white.png">
                                                    </label>
                                                </div>
                                                <span style="color:#B00" class="imgsizelbl2">** Please upload image in JPG,JPEG,PNG Format size 1920 X 1280</span>
                                                <p class="imgerr" style="color:#f00;font-weight: bold;"></p>
                                            </div>
                                        </div>
                                        <div class="col-3  offset-1">
                                            <div class="input-group mb-3 mb-lg-3">
                                                <img src="" class="mt-1 mb-3" id="imgpreview" class="d-none" style="height: 100px; max-width: 100%;background-color: #cce4e72e;margin-top:20px !important;" />
                                                <p class="img-remove"></p>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1 descrDiv">
                                            <div class="input-group">
                                                <label class="mb-1">Description</label>
                                                <label class="ml-auto "></label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <textarea id="contentdescr" name="contentdescr" class="form-control"></textarea>
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
        fillcontenttype();
        $('#sbcolor').css('background-color', '#FFFFFF');
        img.onchange = evt => {
            const [file] = img.files
            if (file) {
                filepreviewimg.src = URL.createObjectURL(file);
                var imgurlimg = $('#filepreviewimg').attr('src');

                $("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url(" + imgurlimg + ")");
            }
            else 
            {
                $("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url('')");
            }
        }
    });


    function resetdata() {
        $("#bannersettingForm").validate().resetForm();
        $('#bannersettingForm').trigger("reset");
        $('#sbcolor').css('background-color', '#FFFFFF');
        Edittimeformnamechange(2);
        fillcontenttype();
        bannersettingtypewise();
        $('#imgpreview').addClass('d-none');
        $('.img-remove').addClass('d-none');
    }

    function fillcontenttype() {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'viewright',
            masterlisting: true,
            responsetype: 'HTML'
        };
        formdata = new FormData();
        formdata.append("action", "fillcontenttype");
        formdata.append("selectoption", 0);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillcontenttype, OnErrorSelectpicker);
    }

    function Onsuccessfillcontenttype(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#contenttypeid').html(resultdata.data);
        $('#contenttypeid').selectpicker('refresh');
        fillcontent()
    }

    function bannersettingtypewise() {
        var contenttypeid = $('#contenttypeid option:selected').attr('data-typeid');

        if(contenttypeid==30)
        {
            $('.titlediv').addClass('d-none');
			$('.descrDiv').addClass('d-none');
        }

    }


    $('body').on('change', '#contenttypeid', function() {

        bannersettingtypewise();
        fillcontent();
    });

    //Fill content
    function fillcontent() {
        var contenttypeid = $('#contenttypeid').val();
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
        formdata.append("contenttypeid", contenttypeid);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessfillcontent, OnErrorfillcontent);
    }

    function Onsuccessfillcontent(content) {
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        if(resultdata.status==1)
        {
            var contenttypeid = resultdata.contenttypeid;
            $('#bannersettingForm  #contentdescr').val(resultdata.description);
            $('#bannersettingForm #title').val(resultdata.title);
            $('#imgpreview').addClass('d-none');
            $('#imgpreview').attr('src', '');
            $('.img-remove').addClass('d-none');
            if (resultdata.img != '') {
                $('#imgpreview').removeClass('d-none');
                $('.img-remove').removeClass('d-none');
                $('.img-remove').html('<a href="javascript:void(0);" title="Remove" class="remove-img" data-id="' + resultdata.id + '" style="font-size:20px;color:red"><i class="fal fa-times"></i></a>');
                $('#imgpreview').attr('src', resultdata.imgurl);
            }

            if(contenttypeid==30)
            {
                $('.titlediv').addClass('d-none');
                $('.descrDiv').addClass('d-none');
            }
        }
        else if(resultdata.status==0)
        {
            $('#imgpreview').addClass('d-none');
            $('#imgpreview').attr('src', '');
            $('.img-remove').addClass('d-none');
            $('#bannersettingForm  #contentdescr').val('');
            $('#bannersettingForm #title').val('');
        }
            




    }

    function OnErrorfillcontent(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }


    $('body').on('click', '.remove-img', function() {
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

            $('#imgpreview').attr('src', '');
            $('.img-remove').addClass('d-none');
        }
    }

    function OnErrorremoveimage(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }



    if ($('#bannersettingForm').length) {
        $('#bannersettingForm').validate({
            rules: {
                contenttypeid: {
                    required: true,
                },
                title:{
                    required: true,
                }
            },
            messages: {
                contenttypeid: {
                    required: "Content type is required",
                },
                title: {
                    required: "Title is required",
                },
            },
            submitHandler: function(form) {
                var typeid = $('#contenttypeid option:selected').attr('data-typeid');
                
                $('#loaderprogress').show();
                var pagename = getpagename();
                formdata = new FormData(form);

                formdata.append("action", "insertbannersetting");
                formdata.append("typeid", typeid);
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 1,
                    userpagename: pagename,
                    useraction: 'addright',
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, OnsuccessbannersettingDataSubmit, OnErrorbannersettingDataSubmit)

            },
        });
    }

    function OnsuccessbannersettingDataSubmit(data) {
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#loaderprogress').hide();
        if (resultdata.status == 0) {
            alertify(resultdata.message, '0');
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, '1');
       
            $('#img').val('');
            $("#filepreviewimg").parent(".filepreviewbg").css("background-image", "url('')");
            fillcontent();
        }
    }

    function OnErrorbannersettingDataSubmit(data) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }
</script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->