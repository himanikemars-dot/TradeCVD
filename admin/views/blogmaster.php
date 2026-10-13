<?php 
require_once dirname(__DIR__, 1).'/config/init.php';

?>

<div class="layout-px-spacing">
    <!-- CONTENT AREA -->
    <div class="row layout-top-spacing">
        <div class="col-12 layout-spacing d-none">
            <div class="widget">
                <div class="widget-heading m-0">
                    <div class="row">
                        <div class="col">
                            <h5 class="my-2"></h5>
                        </div>
                        <div class="col-auto ml-auto">
                            <div class="input-group mb-0">
                                <a href="javascript:void(0)" class="btn btn-primary m-0 ml-auto" id="openRightSidebar"><i
                                            class="bi bi-plus-lg"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 layout-spacing" id="layoutContent">
            <div class="widget widget-page">
                <div class="widget-control">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <h5 class="m-0 menunamelbl" id="customernamelbl"></h5>
                        </div>
                        <div class="col-auto ml-auto">
                            <ul class="list-inline">
                                <li><a href="javascript:void(0);" class="btn-tbl content-minimize"><i
                                                class="bi bi-dash-lg"></i></a></li>
                                <li><a href="javascript:void(0);" class="btn-tbl content-expand"><i
                                                class="bi bi-fullscreen"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-lg-6 mb-2 ml-auto text-right">
                            <ul class="page-more-setting">
                                <?php


                                if ((($rightstotalcount) > 0 ? $Pagerights->getDelright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
                                {
                                    ?>
                                    <li class="delete-selected tbl-check d-none mb-2">
                                        <!-- <a href="javascript:void(0);" class="btn btn-primary m-0 " data-toggle="modal" data-target="#modalConfirmation"><i class="bi bi-trash"></i></a> -->
                                        <a href="javascript:void(0);" class="btn btn-primary m-0 btnmultitrash"
                                           data-toggle="modal"><i class="bi bi-trash"></i></a>
                                    </li>
                                    <li class="mb-2">
                                        <div class="dropdown table-setting">
                                            <button class="dropdown-toggle btn btn-primary" type="button"
                                                    id="tableSetting" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="bi bi-check2-circle"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="tableSetting">
                                                <a class="dropdown-item select-bulk-delete"
                                                   href="javascript:void(0);"><i class="bi bi-trash"></i> Bulk
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>

                                <li class="tbl-search mb-2">
                                    <div class="input-group">
                                        <input type="text" name="filter" id="filter" class="form-control control-append"
                                               placeholder="Search...">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="selectBrandDate" id="btnfilter"
                                                   name="btnfilter"><i class="fal fa-search"></i></label>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if ((($rightstotalcount) > 0 ? $Pagerights->getAddright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
                                {
                                    ?>
                                    <li class="mb-2">
                                        <a href="javascript:void(0);" class="btn btn-primary m-0" id="openRightSidebar">Add
                                            New</a>
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
                                <table id="tableDataList" data-show="1" data-nextpage='0'
                                       class="table table-bordered table-hover table-striped datalisttable">
                                    <thead>
                                    <tr>
                                        <?php
                                        if ((($rightstotalcount) > 0 ? $Pagerights->getEditright() : 0) == 1 || (sizeof($Pagerights) > 0 ? $Pagerights->getDelright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
                                        {
                                            ?>
                                            <th class="tbl-grid">
                                                <a href="javascript:void(0);" class="" id="gridMenu"
                                                   data-toggle="griddropdown" data-target="#tblDropdownContent"
                                                   aria-haspopup="true" aria-expanded="false"><i
                                                            class="bi bi-ui-checks-grid"></i></a>
                                            </th>
                                            <?php
                                        }
                                        ?>
                                        <th class="tbl-check d-none">
                                            <div class="text-center">
                                                <div class="custom-control custom-checkbox m-0 w-auto">
                                                    <input type="checkbox" class="custom-control-input" id="tblCheckAll"
                                                           name="tblCheckAll">
                                                    <label class="custom-control-label mb-n1"
                                                           for="tblCheckAll">All</label>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="tbl-name sorting sorting_asc" data-th="title">Title</th>
                                        <th class="tbl-name sorting sorting_asc" data-th="date">Date</th>
                                        <th class="tbl-name sorting sorting_asc" data-th="displayorder">Display Order
                                        </th>
                                        <th class="tbl-name ">Add Image</th>
                                        <?php
                                        if ((($rightstotalcount) > 0 ? $Pagerights->getEditright() : 0) == 1 || $IISMethods->checkutypeexist($config->getAdminutype(), $LoginInfo->getUtypeid()) == 1) //rights check admin and right person
                                        {
                                            ?>
                                            <th class="tbl-name">Is Active</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody id="datalist">
                                    </tbody>
                                </table>
                                <!-- table End -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once 'pagefooter.php'; ?>
            </div>
        </div>
        <!-- rightSidebar Start -->
        <div class="col-12 p-4 lg-sidebar" id="rightSidebar">
            <div class="right-sidebar-content">
                <div class="row">
                    <div class="col-12 mb-4 sidebar-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="my-2"><span class="formnamelbl"></span></h5>
                            </div>
                            <div class="col-auto pl-0">
                                <a href="javascript:void(0)"
                                   class="btn btn-danger m-0 rounded-circle btn-close-right-sidebar"
                                   id="btnCloseRightSidebar" data-toggle="tooltip" data-placement="top"
                                   title="<?php echo $config->getCloseSidebar(); ?>"
                                   data-original-title="<?php echo $config->getCloseSidebar(); ?>"><i
                                            class="bi bi-x-lg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="widget">
                            <div class="widget-content">
                                <form class="row validate-form" id="blogmasterForm" method="post" action="blogmaster"
                                      enctype="multipart/form-data">
                                    <input type="hidden" id="formevent" name="formevent" value='addright'>
                                    <input type="hidden" id="id" name="id" value=''>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Title <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Title" id="title"
                                                   name="title" require/>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="mb-1">Date <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Date" id="date"
                                                   name="date" require/>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="mb-1">Display Order <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Display Order"
                                                   id="displayorder" name="displayorder" onkeypress="numbonly(event)"
                                                   require/>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="mb-1">Author Name <span class="text-danger"></span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Author Name"
                                                   id="authorname" name="authorname"/>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <label class="mb-1">Short Link <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control nospace" placeholder="Short Link"
                                                   id="shortlink" name="shortlink"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Tags <span class="text-danger"></span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <select class="form-control tags select2-multiple" id="tags" name="tags[]"
                                                    multiple> </select>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Short Description <span
                                                        class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="shortdescription" name="shortdescription" class="form-control"
                                                      placeholder="Short Description"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Description <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="description" name="description"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Title Tag <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="titletag" name="titletag" class="form-control"
                                                      placeholder="Title Tag"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Meta Keyword <span class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="metakeyword" name="metakeyword" class="form-control"
                                                      placeholder="Meta Keyword"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="mb-1">Meta Description <span
                                                        class="text-danger">*</span></label>
                                            <label class="ml-auto "></label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea id="metadescription" name="metadescription" class="form-control"
                                                      placeholder="Meta Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-auto ml-auto">
                                        <div class="input-group mb-0">
                                            <button type="submit" class="btn btn-primary m-0"
                                                    id="btnsubmit"><?php echo $config->getSaveSidebar(); ?></button>
                                            <button type="button" class="btn btn-secondary m-0 ml-2" id="btnReset"
                                                    onclick="resetdata()"><?php echo $config->getResetSidebar(); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Blog Image View Modal -->
<div class="modal animated fade" id="BlogImageModal" tabindex="-1" role="dialog" aria-labelledby="modalImgViewLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                                    class="fal fa-times"></i></button>
                        <h5 class="add-event-title modal-title">Upload Image</h5>
                    </div>
                </div>
                <div class="row modal-card-content">
                    <form class="w-100 validate-form1" id="blogupdimageForm" method="post" action="blogmaster"
                          enctype="multipart/form-data">
                        <input type="hidden" name="blogid" id="blogid"/>
                        <div class="row col-12 d-none">
                            <div class="col-6">
                                <div class="radio radio-primary radio-inline">
                                    <input type="radio" id="image" value="1" name="media" checked>
                                    <label for="image">Image </label>
                                </div>
                            </div>
                            <!--                            <div class="col-4">-->
                            <!--                                <div class="radio radio-primary radio-inline" >-->
                            <!--                                    <input type="radio" id="video" value="2" name="media" >-->
                            <!--                                    <label for="video"> Video </label>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="col-6">
                                <div class="radio radio-primary radio-inline">
                                    <input type="radio" id="youtubevideo" value="3" name="media">
                                    <label for="youtubevideo">Youtube Video Id</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 imagediv">
                            <div class="input-group">
                                <label class="mb-1">Blog Image <span class="text-danger">*</span></label>
                                <label class="ml-auto "></label>
                            </div>
                            <div class="input-group mb-3 mb-lg-3">
                                <input type="file" class="form-control d-none" id="blogimg" name="blogimg[]"
                                       multiple="multiple" accept="image/*">
                                <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1"
                                       for="blogimg">
                                    <span style="background-image: url(assets/img/salon.jpg);"></span>
                                    <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                </label>
                                <span style="color:#B00" class="imgsizelbl2">** Please upload image in JPG,JPEG,PNG Format</span>
                                <!-- <span style="color:#B00">** Please upload image of size 456px X 307px</span> -->
                            </div>
                        </div>

                        <div class="col-12 videodiv">
                            <div class="input-group">
                                <label class="mb-1">Upload Video <span class="text-danger">*</span></label>
                                <label class="ml-auto "></label>
                            </div>
                            <div class="input-group mb-3 mb-lg-3">
                                <input id="videofile" type="file" name="videofile" class="form-control d-none"
                                       accept="video/*"/>
                                <label tabindex="1" class="badge outline-badge-primary w-100 text-center btn-file py-1"
                                       for="videofile">
                                    <span style="background-image: url(assets/img/salon.jpg);"></span>
                                    <i class="bi bi-folder2-open d-block pt-1"></i> Browse...
                                </label>
                                <p class="videoerr" style="color:#f00;font-weight: bold;"></p>
                            </div>
                        </div>

                        <div class="col-12 youtubevideodiv">
                            <div class="input-group">
                                <label class="mb-1">Youtube Video Id <span class="text-danger">*</span></label>
                                <label class="ml-auto "></label>
                            </div>
                            <div class="input-group mb-3 mb-lg-3">
                                <input id="youtubeurl" type="text" name="youtubeurl" class="form-control"
                                       placeholder="https://www.youtube.com/watch?v=...PASTE SHORT CODE HERE..."/> <br>

                            </div>
                            <div class="input-group mb-3 mb-lg-3">
                                <label style="color:#B00" class="">** https://www.youtube.com/watch?v=Yg4Egh6yxKQ <br>
                                    ID = <b>Yg4Egh6yxKQ</b></label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="ml-auto">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary m-0  ml-auto"
                                            id="btnupdblogimage"><?php echo $config->getSaveSidebar(); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row viewblogimageblock">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker('refresh');
        $('#blogmasterForm #description').froalaEditor();
    });
    var selecttags = $(".tags").select2({
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Tags'
    });

    function resetdata() {
        $("#blogmasterForm").validate().resetForm();
        $('#blogmasterForm').trigger("reset");
        $('#formevent').val('addright');
        selecttags.val([]).trigger("change");
        $('.selectpicker').selectpicker('refresh');
        $('#btnsubmit').text('<?php echo $config->getSaveSidebar(); ?>');
        Edittimeformnamechange(2);
    }

    $('#date').bootstrapMaterialDatePicker
    ({
        weekStart: 0,
        format: 'DD/MM/YYYY',
        time: false,
        switchOnClick: true,
        okText: "",

    }).on('change', function (e, date) {
        $(this).removeClass('error');
        $(this).parent('div').removeClass('error');
        $(this).parent().find('label.error').html('');
    });

    $('.nospace').keypress(function( e ) {
        if(e.which === 32) 
            return false;
    });

    $('#title').on('input',function(){
        var title=$(this).val();
        if(title)
        {
            var result = title.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '-').replace(/^(-)+|(-)+$/g,'');
            $('#shortlink').val(result);
        }else{
            $('#shortlink').val('');
        }
    })
    
    //Edit Start
    function editdata(id) {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false
        };

        formdata = new FormData();
        formdata.append("action", "editblogmaster");
        formdata.append("id", id);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessblogmaster, OnErrorblogmaster);
    }

    function Onsuccessblogmaster(content) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        console.log(resultdata.tags.split(','));
        $('#id').val(resultdata.id);
        $('#title').val(resultdata.title);
        $('#date').val(resultdata.date);

        var tags = resultdata.tags.split(',');

        tags.forEach(function(e){
            if(!selecttags.find('option:contains(' + e + ')').length)
                selecttags.append($('<option>').text(e));
        });

        selecttags.val(tags).trigger("change");

        $('#displayorder').val(resultdata.displayorder);
        $('#authorname').val(resultdata.authorname);
        $('#shortlink').val(resultdata.shortlink);
        $('#shortdescription').val(resultdata.shortdescription);
        $('#description').froalaEditor('html.set', resultdata.description);
        $('#titletag').val(resultdata.titletag);
        $('#metakeyword').val(resultdata.metakeyword);
        $('#metadescription').val(resultdata.metadescription);

        $('#formevent').val('editright');
        $('#btnsubmit').text('<?php echo $config->getUpdateSidebar(); ?>');

        //Open Side bar
        Edittimeformnamechange(1);
        $("#rightSidebar").toggleClass("active-right-sidebar");
        $('.overlay').addClass('show');
        $("body").addClass("overflow-hidden");
    }

    function OnErrorblogmaster(content) {
        ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
    }

    //Edit End


    if ($('#blogmasterForm').length) {
        $('#blogmasterForm').validate({
            rules: {
                title: {
                    required: true,
                },
                date: {
                    required: true,
                },
                displayorder: {
                    required: true,
                    number: true,
                },
                shortlink: {
                    required: true,
                },
                shortdescription: {
                    required: true,
                },
                titletag: {
                    required: true,
                },
                metakeyword: {
                    required: true,
                },
                metadescription: {
                    required: true,
                },
            }, messages: {
                title: {
                    required: 'Title is required.',
                },
                date: {
                    required: 'Date is required.',
                },
                displayorder: {
                    required: 'Display order is required.',
                },
                shortlink: {
                    required: 'Short Link is required.',
                },
                shortdescription: {
                    required: 'Short description is required.',
                },
                titletag: {
                    required: 'Title tag is required.',
                },
                metakeyword: {
                    required: 'Meta keyword is required.',
                },
                metadescription: {
                    required: 'Meta description is required.',
                },
            },
            submitHandler: function (form) {
                var description = $('#description').froalaEditor('html.get')
                $('#preloader').show();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertblogmaster");
                formdata.append("description", description);
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 1,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, OnsuccessDataSubmit, OnErrorDataSubmit)

            },
        });
    }


    //Change Is Active Start
    function changeisactiveblogmaster(id) {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'editright',
            masterlisting: false
        };
        formdata = new FormData();
        formdata.append("action", "changeisactiveblogmaster");
        formdata.append("id", id);
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccesschangeisactiveblogmaster, OnErrorchangeisactiveblogmaster);
    }

    function Onsuccesschangeisactiveblogmaster(data) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(data);
        var resultdata = jQuery.parseJSON(JsonData);
        if (resultdata.status == 0) {
            alertify(resultdata.message, 0);
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, 1);
        }
        $('#tableDataList').attr('data-nextpage', 0);
        listdata();
    }

    function OnErrorchangeisactiveblogmaster(content) {
        ajaxrequest("POST", "'<?php echo $config->getPage404url(); ?>'", '', '', OnsuccessRender, OnErrorRender);
    }

    //View Details Start
    function viewblogdetaildata(id) {
        var pagename = getpagename();
        var headersdata = {
            Accept: 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: 'viewright',
            masterlisting: false,
            responsetype: 'HTML'
        };

        formdata = new FormData();
        formdata.append("action", "viewblogdata");
        formdata.append("id", id);

        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessviewblogdata, OnErrorviewblogdata);
    }

    function Onsuccessviewblogdata(content) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        $('#GeneralModal').modal('show');
        $('#GeneralModal .modal-dialog').addClass('modal-xl');
        $('#GeneralModal #GeneralModalLabel').html('Blog Details');
        $('#GeneralModal #Generaldata').html(resultdata.data);
    }

    function OnErrorviewblogdata(content) {
        ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
    }

    /************************ Start For Blog Images *****************************/
    //Start Upload Blog Images
    function uploadblogimage(id) {
        $('#BlogImageModal').modal('show');
        $('#BlogImageModal #blogid').val(id);

        $('#BlogImageModal #blogupdimageForm #image').prop('checked', true);
        $('#BlogImageModal .imagediv').removeClass('d-none');
        $('#BlogImageModal .imgblock').removeClass('d-none');
        $('#BlogImageModal .youtubevideodiv').addClass('d-none');
        $('#BlogImageModal .videodiv').addClass('d-none');
        $('#BlogImageModal .videolinkdiv').addClass('d-none');
        $('.fileinput-remove').trigger('click');
        $('#blogupdimageForm #btnupdblogimage').val('Upload');


        getblogimages(id);
    }

    //End Upload Blog Images

    //Start submit Upload Blog Image form
    if ($('#blogupdimageForm').length) {

        $('#blogupdimageForm').validate({
            rules: {}, messages: {},
            submitHandler: function (form) {
                $('#preloader').show();
                var pagename = getpagename();
                var useraction = $('#formevent').val();
                formdata = new FormData(form);
                formdata.append("action", "insertblogimages");
                var headersdata = {
                    'Accept': 'application/json',
                    platform: 1,
                    userpagename: pagename,
                    useraction: useraction,
                    masterlisting: false
                };
                ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, OnsuccessUploadBlogImage, OnErrorUploadBlogImage)

            },
        });
    }


    function OnsuccessUploadBlogImage(content) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);

        if (resultdata.status == 0) {
            alertify(resultdata.message, 0);
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, 1);

            var mediatype = $('input[type=radio][name=media]:checked').val();
            $("#blogupdimageForm").validate().resetForm();
            $('#blogupdimageForm').trigger("reset");
            $('#blogupdimageForm input[type=radio][name=media][value='+mediatype+']').attr('checked', true).trigger("click");


            getblogimages(resultdata.blogid);
        }
    }

    function OnErrorUploadBlogImage(content) {
        ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
    }

    //End submit Upload Blog Image form


    function getblogimages(blogid) {

        $('#preloader').show();
        var pagename = getpagename();
        formdata = new FormData();
        formdata.append("action", "getblogimages");
        formdata.append("blogid", blogid);
        var headersdata = {
            'Accept': 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: '',
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessgetblogimages, OnErrorgetblogimages)
    }

    function Onsuccessgetblogimages(content) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);
        var imgdiv = "";
        if (resultdata.status == 0) {
            $('#BlogImageModal .viewblogimageblock').html(imgdiv);
        } else if (resultdata.status == 1) {
            for (var i in resultdata.result) {

                var id = "'" + resultdata.result[i].id + "'";
                var blogid = "'" + resultdata.result[i].blogid + "'";
                if (resultdata.result[i].mediatype == 1 && $('#blogupdimageForm #image').prop('checked') == true) {
                    imgdiv += '<div class="col-md-4 imgblock">';
                        imgdiv += '<a class="pull-right delimg" href="javascript:void(0)" onclick="removeblogimage(' + id + ',' + blogid + ')" ><i class="bi bi-x-lg"></i></a>';
                        imgdiv += '<a href="' + resultdata.result[i].imgpath + '" class="pdfimg" target="_blank"><img style="width: 100%;border:1px solid #eee;" src="' + resultdata.result[i].imgpath + '"></a>';
                        imgdiv += '<div class="input-group mt-2">';
                            imgdiv += '<input class="form-control control-append" type="number" name="imgdisplayorder" min="1" id="imgorder' + resultdata.result[i].id + '" value="' + resultdata.result[i].displayorder + '">';
                            imgdiv += '<div class="input-group-append">';
                                imgdiv += '<label class="input-group-text btnordsave py-1" for="imgorder' + resultdata.result[i].id + '" data-blogid="' + resultdata.result[i].blogid + '"  data-attr="' + resultdata.result[i].id + '" id="btnordsave' + resultdata.result[i].id + '">Save</label>';
                            imgdiv += '</div>';
                        imgdiv += '</div>';
                        // imgdiv += '<div class="row">';
                        //     imgdiv += '<div class="col">';
                        //         imgdiv += '<input class="form-control" type="number" name="imgdisplayorder" min="1" id="imgorder' + resultdata.result[i].id + '" value="' + resultdata.result[i].displayorder + '" style="width:70px;height:30px">';
                        //     imgdiv += '</div>';
                        //     imgdiv += '<div class="col text-right">';
                        //         imgdiv += '<button class="btnordsave btn btn-primary py-1" data-blogid="' + resultdata.result[i].blogid + '"  data-attr="' + resultdata.result[i].id + '" id="btnordsave' + resultdata.result[i].id + '">Save</button>';
                        //     imgdiv += '</div>';
                        // imgdiv += '</div>';
                    imgdiv += '</div>';
                    $('#BlogImageModal .imagediv').removeClass('d-none');
                    $('#BlogImageModal .imgblock').removeClass('d-none');
                    $('#BlogImageModal .videodiv').addClass('d-none');
                    $('#BlogImageModal .youtubevideodiv').addClass('d-none');
                    $('#blogupdimageForm #btnupdblogimage').val('Upload');
                } else if (resultdata.result[i].mediatype == 2 && $('#blogupdimageForm #video').prop('checked') == true) {
                    imgdiv += '<div class="col-md-4 videodiv ">';
                    imgdiv += '<a class="pull-right delimg" href="javascript:void(0)" onclick="removeblogimage(' + id + ',' + blogid + ')" ><i class="fas fa-times"></i></a>';
                    imgdiv += '<a href="' + resultdata.result[i].imgpath + '" class="pdfimg" target="_blank"><video width="140px" style="border: 1px solid #ddd;" controls><source src="' + resultdata.result[i].imgpath + '"></video></a>';
                    // imgdiv += '<input type="number" name="imgdisplayorder" min="1" id="imgorder' + resultdata.result[i].id + '" value="' + resultdata.result[i].displayorder + '" style="width:70px;height:30px">';
                    // imgdiv += '<button class="btnordsave" data-blogid="' + resultdata.result[i].blogid + '"  data-attr="' + resultdata.result[i].id + '" id="btnordsave' + resultdata.result[i].id + '">Save</button>';
                        imgdiv += '<div class="input-group mt-2">';
                            imgdiv += '<input class="form-control control-append" type="number" name="imgdisplayorder" min="1" id="imgorder' + resultdata.result[i].id + '" value="' + resultdata.result[i].displayorder + '">';
                            imgdiv += '<div class="input-group-append">';
                                imgdiv += '<label class="input-group-text btnordsave py-1" for="imgorder' + resultdata.result[i].id + '" data-blogid="' + resultdata.result[i].blogid + '"  data-attr="' + resultdata.result[i].id + '" id="btnordsave' + resultdata.result[i].id + '">Save</label>';
                            imgdiv += '</div>';
                        imgdiv += '</div>';
                    imgdiv += '</div>';
                    $('#BlogImageModal .imagediv').addClass('d-none');
                    $('#BlogImageModal .youtubevideodiv').addClass('d-none');
                    $('#BlogImageModal .videodiv').removeClass('d-none');
                    $('#BlogImageModal .imgblock').addClass('d-none');
                    $('#blogupdimageForm #btnupdblogimage').val('Upload');
                } else if (resultdata.result[i].mediatype == 3 && $('#blogupdimageForm #youtubevideo').prop('checked') == true) {
                    imgdiv += '<div class="col-md-4 youtubevideodiv ">';
                    imgdiv += '<a class="pull-right delimg" href="javascript:void(0)" onclick="removeblogimage(' + id + ',' + blogid + ')" ><i class="fas fa-times"></i></a>';
                    imgdiv += '<a href="https://www.youtube.com/watch?v=' + resultdata.result[i].imgpath + '" class="pdfimg" target="_blank"><img style="width: 100%;border:1px solid #eee;" src="'+resultdata.result[i].youtubeimg+'" alt="pdfimg"></a>';
                    // imgdiv += '<input type="number" name="imgdisplayorder" min="1" id="imgorder' + resultdata.result[i].id + '" value="' + resultdata.result[i].displayorder + '" style="width:70px;height:30px">';
                    // imgdiv += '<button class="btnordsave" data-blogid="' + resultdata.result[i].blogid + '"  data-attr="' + resultdata.result[i].id + '" id="btnordsave' + resultdata.result[i].id + '">Save</button>';
                        imgdiv += '<div class="input-group mt-2">';
                            imgdiv += '<input class="form-control control-append" type="number" name="imgdisplayorder" min="1" id="imgorder' + resultdata.result[i].id + '" value="' + resultdata.result[i].displayorder + '">';
                            imgdiv += '<div class="input-group-append">';
                                imgdiv += '<label class="input-group-text btnordsave py-1" for="imgorder' + resultdata.result[i].id + '" data-blogid="' + resultdata.result[i].blogid + '"  data-attr="' + resultdata.result[i].id + '" id="btnordsave' + resultdata.result[i].id + '">Save</label>';
                            imgdiv += '</div>';
                        imgdiv += '</div>';
                    imgdiv += '</div>';
                    $('#BlogImageModal .imagediv').addClass('d-none');
                    $('#BlogImageModal .youtubevideodiv').removeClass('d-none');
                    $('#BlogImageModal .videodiv').addClass('d-none');
                    $('#BlogImageModal .imgblock').addClass('d-none');
                    $('#blogupdimageForm #btnupdblogimage').val('Submit');
                }
            }

            $('#BlogImageModal .viewblogimageblock').html(imgdiv);
        }
    }

    function OnErrorgetblogimages(content) {
        ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
    }


    $('body').on('click', '.btnordsave', function () {

        var imgid = $(this).attr('data-attr');
        var displayorder = $('#imgorder' + imgid).val();
        var blogid = $(this).attr('data-blogid');


        $('#preloader').show();
        var pagename = getpagename();
        formdata = new FormData();
        formdata.append("action", "changeblogimgdiplayorder");
        formdata.append("imgid", imgid);
        formdata.append("displayorder", displayorder);
        formdata.append("blogid", blogid);
        var headersdata = {
            'Accept': 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: '',
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessupdatedisorder, OnErrorupdatedisorder)

    });

    function Onsuccessupdatedisorder(content) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);

        if (resultdata.status == 0) {
            alertify(resultdata.message, 0);
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, 1);

            getblogimages(resultdata.blogid);
        }
    }

    function OnErrorupdatedisorder(content) {
        ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
    }


    function removeblogimage(id, blogid) {
        $('#preloader').show();
        var pagename = getpagename();
        formdata = new FormData();
        formdata.append("action", "removeblogimage");
        formdata.append("id", id);
        formdata.append("blogid", blogid);
        var headersdata = {
            'Accept': 'application/json',
            platform: 1,
            userpagename: pagename,
            useraction: '',
            masterlisting: false
        };
        ajaxrequest("POST", '<?php echo $config->getEndpointurl(); ?>' + pagename, formdata, headersdata, Onsuccessremoveblogimage, OnErrorremoveblogimage)
    }

    function Onsuccessremoveblogimage(content) {
        $('#preloader').hide();
        var JsonData = JSON.stringify(content);
        var resultdata = jQuery.parseJSON(JsonData);

        if (resultdata.status == 0) {
            alertify(resultdata.message, 0);
        } else if (resultdata.status == 1) {
            alertify(resultdata.message, 1);

            getblogimages(resultdata.blogid);
        }
    }

    function OnErrorremoveblogimage(content) {
        ajaxrequest("POST", '<?php echo $config->getPage404url(); ?>', '', '', OnsuccessRender, OnErrorRender);
    }

    $('body').on('change', 'input[type=radio][name=media]', function () {
        if (this.value == 2) {
            $('#BlogImageModal .imagediv').addClass('d-none');
            $('#BlogImageModal .youtubevideodiv').addClass('d-none');
            $('#BlogImageModal .videodiv').removeClass('d-none');
            $('#BlogImageModal .imgblock').addClass('d-none');
            $('#blogupdimageForm #btnupdblogimage').val('Upload');
        } else if (this.value == 3) {
            $('#BlogImageModal .imagediv').addClass('d-none');
            $('#BlogImageModal .youtubevideodiv').removeClass('d-none');
            $('#BlogImageModal .videodiv').addClass('d-none');
            $('#BlogImageModal .imgblock').addClass('d-none');
            $('#blogupdimageForm #btnupdblogimage').val('Submit');
        } else {
            $('#BlogImageModal .imagediv').removeClass('d-none');
            $('#BlogImageModal .imgblock').removeClass('d-none');
            $('#BlogImageModal .videodiv').addClass('d-none');
            $('#BlogImageModal .youtubevideodiv').addClass('d-none');
            $('#blogupdimageForm #btnupdblogimage').val('Upload');
        }
        $('.fileinput-remove').trigger('click');
        var blogid = $('#BlogImageModal #blogid').val();
        getblogimages(blogid)
    })
    /************************ End For Blog Images *****************************/
</script>