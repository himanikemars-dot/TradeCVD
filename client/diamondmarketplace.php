<?php
/* =========================================================================
   Diamond Marketplace  —  Jewellery Search page nu exact clone
   Include from: client/diamond.php  (Search tab, #v-pills-1)
   Jewellery ni j CSS class vaparel chhe → navi CSS ni jarur nathi.
   Badha id/class `dm` prefix sathe chhe → purana code sathe koi conflict nahi.
   ========================================================================= */
?>
<div class="setpagejw">

    <!-- ================= LEFT : FILTERS ================= -->
    <div class="col-xl-2 col-lg-3 col-md-4 setfiljw">
        <div id="dmSidenav" class="sidenav mySidenav py-2 px-0">
            <div class="setnavfilter">
                <h4>Filters</h4>
            </div>
            <div class="col-12">
                <div class="searchje">
                    <input type="text" class="search-bar" id="dm_fltsearch" placeholder="Enter Keyword">
                    <a href="javascript:void(0);" id="dm_btnfltsearch" class="search-icon">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="allfilterse">
                <ul>

                    <!-- SHAPE -->
                    <!-- <li class="setshowje dmShapeBlock">
                        <div class="col-12 p-0 cut-group setmedfli setimgje">
                            <div class="form-check">
                                <h5>Shape</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmShapeSideData"></div>
                                </div>
                            </div>
                        </div>
                    </li> -->

                    <!-- COLOR -->
                    <li class="setshowje dmColorBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Color</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmColorData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- CLARITY -->
                    <li class="setshowje dmClarityBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Clarity</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmClarityData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- SIZE (Carat) -->
                    <li class="setshowje">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Size (Carat)</h5>
                                <div class="col-12 col-md-12">
                                    <div class="row fliterset setcutgrje">
                                        <div class="col-6 cut-group">
                                            <input type="text" id="dm_fromsize" class="fromusd"
                                                onkeypress="numbonly(event);" onpaste="numbonly(event);"
                                                placeholder="From">
                                        </div>
                                        <div class="col-6 mt-auto cut-group">
                                            <input type="text" id="dm_tosize" class="fromusd"
                                                onkeypress="numbonly(event);" onpaste="numbonly(event);"
                                                placeholder="To">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- PRICE -->
                    <li class="setshowje">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Total Price ($)</h5>
                                <div class="col-12 col-md-12">
                                    <div class="row fliterset setcutgrje">
                                        <div class="col-6 cut-group">
                                            <input type="text" id="dm_fromprice" class="fromusd"
                                                onkeypress="numbonly(event);" onpaste="numbonly(event);"
                                                placeholder="From">
                                        </div>
                                        <div class="col-6 mt-auto cut-group">
                                            <input type="text" id="dm_toprice" class="fromusd"
                                                onkeypress="numbonly(event);" onpaste="numbonly(event);"
                                                placeholder="To">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- CUT -->
                    <li class="setshowje dmCutBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Cut</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmCutData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- POLISH -->
                    <li class="setshowje dmPolishBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Polish</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmPolishData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- SYMMETRY -->
                    <li class="setshowje dmSymmetryBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Symmetry</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmSymmetryData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- FLUORESCENCE -->
                    <li class="setshowje dmIntensityBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Fluorescence</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmIntensityData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- LAB -->
                    <li class="setshowje dmLabBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Lab</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmLabData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- SHADE -->
                    <li class="setshowje dmShadeBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Shade</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmShadeData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- EYE CLEAN -->
                    <li class="setshowje dmEyeCleanBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Eye Clean</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmEyeCleanData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- GIRDLE -->
                    <li class="setshowje dmGirdleBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Girdle</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmGirdleData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- ROUGH SOURCE -->
                    <li class="setshowje dmRoughBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Rough Source</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmRoughData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- LOCATION -->
                    <li class="setshowje dmLocationBlock">
                        <div class="col-12 cut-group setmedfli">
                            <div class="form-check">
                                <h5>Location</h5>
                                <div class="col-12 col-md-12 scroll-sidebar-main">
                                    <div class="row" id="dmLocationData"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!-- ================= RIGHT : RESULTS ================= -->
    <div class="col-xl-10 col-lg-9 col-md-8 rightbarjew">

        <div class="loder-div">
            <div class="chart-loading dm-loading" style="display:none;">
                <img alt="loading-img" src="assets/img/loading.gif">
            </div>
        </div>

        <!-- keyword + shape strip -->
        <div class="row shapefilterDiv dmShapeStripDiv mx-0">

            <div class="filter-box setfilterbox bg-transparent">
                <div class="form-group shape-group dash-shape setresjw pt-0">
                    <div class="dm-shape-strip-layout">
                        <div class="filter-container-set dm-shape-strip__items" id="dmShapeStrip"></div>
                        <button type="button" class="dm-shape-toggle" id="dmShapeToggle"
                            aria-controls="dmShapeStrip" aria-expanded="false"
                            aria-label="Show more shapes"></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- count + sort -->
        <div class="productJwelery">
            <div class="card bg-transparent">
                <div class="card-body px-0 pt-0 pb-3">
                    <div class="row jewset mx-0 align-items-center">
                        <div class="col-md-9 col-lg-4 col-xs-12 col-sm-8 moredetail px-0">
                            <ul>
                                <li><b class="dmTotalItems">0 Diamonds</b>&nbsp;|</li>
                                <li>&nbsp;<b class="dmTotalPrice">Total Price : $0</b></li>
                            </ul>
                        </div>

                        <div class="col-lg-4">
                            <ul class="nav responsive-tab nav-material nav-material-white justify-content-md-end justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="white-diamond-tab" data-bs-toggle="pill"
                                        data-bs-target="#white-diamond" type="button" role="tab" aria-controls="white-diamond"
                                        aria-selected="true">Diamond</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="fancy-diamond-tab" data-bs-toggle="pill"
                                        data-bs-target="#fancy-diamond" type="button" role="tab"
                                        aria-controls="fancy-diamond" aria-selected="false">Fancy Diamond</a>
                                </li>

                            </ul>
                        </div>

                        <div class="col-md-3 col-lg-4 col-xs-12 col-sm-2 px-0 px-md-3">
                            <div class="setresfilterbar">
                                <button type="button" class="setfilter dmSetFilter d-sm-block d-md-none d-xl-none d-lg-none">
                                    <img src="<?php echo $config->getImageurl(); ?>images/searchpage/fliter.svg" alt="filter" title="filter">
                                </button>
                            </div>
                            <div class="btsesearch">
                                <div class="text-right searchhead">
                                    <div class="searchgreade searchcom setsho">
                                        <select class="form-control w-auto shortbydianmondse ml-auto" id="dm_sortbyid"></select>
                                    </div>
                                    <!--<div class="searchgreade searchcom">-->
                                    <!--    <button type="button" class="btn searchbtnset" id="dm_btnreset" title="Reset all filters">-->
                                    <!--        <img src="<?php echo $config->getImageurl(); ?>images/searchpage/3.svg" alt="reset" title="reset">-->
                                    <!--    </button>-->
                                    <!--</div>-->
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="shapesearch" id="dmSelectedTags"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- product grid -->
        <div class="dm-view-switch" role="group" aria-label="Product view">
            <button type="button" class="dm-view-switch__button is-active" data-view="grid"
                aria-label="Grid view" aria-pressed="true" title="Grid view">
                <i class="fa fa-th-large" aria-hidden="true"></i>
            </button>
            <button type="button" class="dm-view-switch__button" data-view="list"
                aria-label="List view" aria-pressed="false" title="List view">
                <i class="fa fa-list" aria-hidden="true"></i>
            </button>
        </div>
        <div class="grid-products grid--view-items prd-grid productsetje" id="dmGridData" data-nextpage="0"></div>

        <!-- pagination -->
        <div class="sticky-sec-sec">
            <div class="container-fluid">
                <div class="row sticky-sec">
                    <div class="text-left col-7 col-md-4 m-auto" id="dmPaginationDiv"></div>

                </div>
            </div>
        </div>

    </div>
</div>


<script>
    /* =========================================================================
   DIAMOND MARKETPLACE  —  JS
   ========================================================================= */

    var DM_MASTER_URL = '<?php echo $config->getEndpointurl(); ?>master';
    var DM_DIAMOND_URL = '<?php echo $config->getEndpointurl(); ?>diamond';
    var DM_IMG_URL = '<?php echo $config->getImageurl(); ?>';

    function dm_headers(useraction) {
        return {
            Accept: 'application/json',
            platform: 4,
            userpagename: getpagename(),
            useraction: useraction || 'editright',
            masterlisting: false,
            responsetype: 'JSON'
        };
    }

    /* ---------- generic master list → sidebar checkbox list ---------- */
    function dm_loadmaster(action, targetid, cls, blockcls) {
        var fd = new FormData();
        fd.append('action', action);
        ajaxrequest('POST', DM_MASTER_URL, fd, dm_headers(), dm_ok, function() {});

        function dm_ok(data) {
            var r = jQuery.parseJSON(JSON.stringify(data));
            var h = '';
            $('.' + blockcls).addClass('d-none');
            if (r.status == 1 && r.data && r.data.length > 0) {
                $('.' + blockcls).removeClass('d-none');
                for (var i = 0; i < r.data.length; i++) {
                    var d = r.data[i];
                    h += '<div class="col-4 cut-group px-0">';
                    h += '  <div class="form-check">';
                    h += '    <input class="form-check-input ' + cls + '" type="checkbox"' +
                        ' data-name="' + d.name + '" data-idx="' + i + '"' +
                        ' value="' + d.id + '" id="' + cls + d.id + '">';
                    h += '    <label class="form-check-label ml-4" for="' + cls + d.id + '">' + d.name + '</label>';
                    h += '  </div>';
                    h += '</div>';
                }
            }
            $('#' + targetid).html(h);
        }
    }

    /* ---------- shape : top strip + sidebar list ---------- */
    function dm_loadshape() {
        var fd = new FormData();
        fd.append('action', 'listshape');
        ajaxrequest('POST', DM_MASTER_URL, fd, dm_headers(), dm_ok, function() {});

        function dm_ok(data) {
            var r = jQuery.parseJSON(JSON.stringify(data));
            var strip = '',
                side = '';
            $('.dmShapeStripDiv').addClass('d-none');
            $('.dmShapeBlock').addClass('d-none');
            if (r.status == 1 && r.data && r.data.length > 0) {
                $('.dmShapeStripDiv').removeClass('d-none');
                $('.dmShapeBlock').removeClass('d-none');
                for (var i = 0; i < r.data.length; i++) {
                    var d = r.data[i];

                    strip += '<div class="filter custom-checkbox">';
                    strip += '  <input type="checkbox" id="dmshp' + d.id + '" data-name="' + d.name + '"' +
                        ' class="dashboard-control custom-control-input dm_shapeid" value="' + d.id + '">';
                    strip += '  <label for="dmshp' + d.id + '" class="custom-control-label with-img">';
                    strip += '    <span class="img-wrap"><img src="' + DM_IMG_URL + d.img + '" alt="' + d.name + '" class="img-responsive"></span>';
                    strip += '    <span class="text-label">' + d.name + '</span>';
                    strip += '  </label>';
                    strip += '</div>';

                    side += '<div class="col-12 col-md-12 cut-group">';
                    side += '  <div class="form-check">';
                    side += '    <input class="form-check-input dm_sideshapeid" type="checkbox"' +
                        ' data-name="' + d.name + '" value="' + d.id + '" id="dmsideshp' + d.id + '">';
                    side += '    <div class="jetype"><img src="' + DM_IMG_URL + d.img + '" alt="' + d.name + '" title="' + d.name + '"></div>';
                    side += '    <label class="form-check-label ml-4" for="dmsideshp' + d.id + '">' + d.name + '</label>';
                    side += '  </div>';
                    side += '</div>';
                }
            }
            $('#dmShapeStrip').html(strip);
            $('#dmShapeSideData').html(side);
            $('#dmShapeStrip').removeClass('is-expanded');
            $('#dmShapeToggle').attr({
                'aria-expanded': 'false',
                'aria-label': 'Show more shapes'
            });
            dm_update_shape_toggle();
        }
    }

    function dm_update_shape_toggle() {
        var strip = $('#dmShapeStrip');
        var items = strip.children('.filter');
        var button = $('#dmShapeToggle');

        if (!items.length) {
            button.hide();
            return;
        }

        strip[0].style.setProperty('--dm-shape-row-height', items.first().outerHeight() + 'px');


        var firstRowTop = items.first()[0].getBoundingClientRect().top;
        var hasMoreRows = items.toArray().some(function(item) {
            return item.getBoundingClientRect().top > firstRowTop + 1;
        });

        if (!hasMoreRows) {
            strip.removeClass('is-expanded');
            button.attr({
                'aria-expanded': 'false',
                'aria-label': 'Show more shapes'
            }).hide();
        }
    }

    /* ---------- sort by ---------- */
    function dm_loadsortby() {
        var fd = new FormData();
        fd.append('action', 'listdiamondsortby');
        ajaxrequest('POST', DM_MASTER_URL, fd, dm_headers(), dm_ok, function() {});

        function dm_ok(data) {
            var r = jQuery.parseJSON(JSON.stringify(data));
            var h = '<option value="">Sort By</option>';
            if (r.status == 1 && r.data && r.data.length > 0) {
                for (var i = 0; i < r.data.length; i++) {
                    h += '<option value="' + r.data[i].id + '">' + r.data[i].name + '</option>';
                }
            }
            $('#dm_sortbyid').html(h);
        }
    }

    /* ---------- helpers ---------- */
    function dm_checked(sel) {
        var out = {
            ids: [],
            names: [],
            idx: []
        };
        $(sel).each(function() {
            if ($(this).prop('checked') === true) {
                out.ids.push($(this).val());
                out.names.push($(this).attr('data-name'));
                out.idx.push(parseInt($(this).attr('data-idx')) || 0);
            }
        });
        return out;
    }

    /* Cut / Polish / Symmetry API ma FROM-TO range le chhe (IN list nahi).
       Master list pehla thi displayorder ma sorted aave chhe, etle
       checked ma sauthi pehlo = FROM, sauthi chhello = TO. */
    function dm_range(c) {
        if (c.ids.length === 0) return null;
        var arr = [];
        for (var i = 0; i < c.ids.length; i++) arr.push({
            id: c.ids[i],
            k: c.idx[i]
        });
        arr.sort(function(a, b) {
            return a.k - b.k;
        });
        return {
            from: arr[0].id,
            to: arr[arr.length - 1].id
        };
    }

    function dm_appendarr(fd, key, ids) {
        for (var i = 0; i < ids.length; i++) fd.append(key + '[]', ids[i]);
    }

    /* ---------- selected filter tags ---------- */
    function dm_tags() {
        var map = [
            ['Shape', dm_checked('#dmShapeStrip .dm_shapeid').names.concat(dm_checked('#dmShapeSideData .dm_sideshapeid').names)],
            ['Color', dm_checked('#dmColorData .dm_colorid').names],
            ['Clarity', dm_checked('#dmClarityData .dm_clarityid').names],
            ['Cut', dm_checked('#dmCutData .dm_cutid').names],
            ['Polish', dm_checked('#dmPolishData .dm_polishid').names],
            ['Symmetry', dm_checked('#dmSymmetryData .dm_symmetryid').names],
            ['Fluorescence', dm_checked('#dmIntensityData .dm_intensityid').names],
            ['Lab', dm_checked('#dmLabData .dm_labid').names],
            ['Shade', dm_checked('#dmShadeData .dm_shadeid').names],
            ['Eye Clean', dm_checked('#dmEyeCleanData .dm_eyecleanid').names],
            ['Girdle', dm_checked('#dmGirdleData .dm_girdleid').names],
            ['Rough Source', dm_checked('#dmRoughData .dm_roughid').names],
            ['Location', dm_checked('#dmLocationData .dm_locationid').names]
        ];
        var h = '';
        for (var i = 0; i < map.length; i++) {
            for (var j = 0; j < map[i][1].length; j++) {
                h += '<a href="javascript:void(0);" class="btn m-1 searchbtnset">' +
                    '<b>' + map[i][0] + ' : </b><span>' + map[i][1][j] + '</span></a>';
            }
        }
        $('#dmSelectedTags').html(h);
    }

    /* ---------- MAIN : diamond listing ---------- */
    function dm_listdata(page) {
        page = page || 1;
        $('.dm-loading').show();

        var nextpage = parseInt($('#dmGridData').attr('data-nextpage'));
        if (isNaN(nextpage) || nextpage < 0) nextpage = 0;

        var fd = new FormData();
        fd.append('action', 'listdiamond');
        fd.append('nextpage', nextpage + 1);
        fd.append('fltparcel', 0);
        fd.append('isdiamondsearch', 1);
        fd.append('fltmanagemydiamond', 0);
        fd.append('isfancy', $('#fancy-diamond-tab').hasClass('active') ? 1 : 0);
        fd.append('perpage', $('#dm_per_page').val());
        fd.append('sortbyid', $('#dm_sortbyid').val());

        /* multi-select filters */
        var shapeids = dm_checked('#dmShapeStrip .dm_shapeid').ids
            .concat(dm_checked('#dmShapeSideData .dm_sideshapeid').ids);
        dm_appendarr(fd, 'fltshapeid', shapeids);
        dm_appendarr(fd, 'fltcolorid', dm_checked('#dmColorData .dm_colorid').ids);
        dm_appendarr(fd, 'fltclarityid', dm_checked('#dmClarityData .dm_clarityid').ids);
        dm_appendarr(fd, 'fltintensityid', dm_checked('#dmIntensityData .dm_intensityid').ids);
        dm_appendarr(fd, 'fltlabid', dm_checked('#dmLabData .dm_labid').ids);
        dm_appendarr(fd, 'fltshadeid', dm_checked('#dmShadeData .dm_shadeid').ids);
        dm_appendarr(fd, 'flteyecleanid', dm_checked('#dmEyeCleanData .dm_eyecleanid').ids);
        dm_appendarr(fd, 'fltgridleid', dm_checked('#dmGirdleData .dm_girdleid').ids);
        dm_appendarr(fd, 'fltroughsourceid', dm_checked('#dmRoughData .dm_roughid').ids);
        dm_appendarr(fd, 'fltlocationid', dm_checked('#dmLocationData .dm_locationid').ids);

        /* range filters */
        var cut = dm_range(dm_checked('#dmCutData .dm_cutid'));
        if (cut) {
            fd.append('fltfromcutid', cut.from);
            fd.append('flttocutid', cut.to);
        }

        var pol = dm_range(dm_checked('#dmPolishData .dm_polishid'));
        if (pol) {
            fd.append('fltfrompolishid', pol.from);
            fd.append('flttopolishid', pol.to);
        }

        var sym = dm_range(dm_checked('#dmSymmetryData .dm_symmetryid'));
        if (sym) {
            fd.append('fltfromsymmetryid', sym.from);
            fd.append('flttosymmetryid', sym.to);
        }

        /* from-to inputs */
        fd.append('fltfromsize', $('#dm_fromsize').val());
        fd.append('flttosize', $('#dm_tosize').val());
        fd.append('fltfromprice', $('#dm_fromprice').val());
        fd.append('flttoprice', $('#dm_toprice').val());

        /* keyword — Step 3 (optional) karo pachhi aa line ne 'fltsearch' ma badlo */
        // fd.append('fltstocknumbers', $('#dm_fltsearch').val());
        fd.append('fltsearch', $('#dm_fltsearch').val());

        ajaxrequest('POST', DM_DIAMOND_URL, fd, {
                'Accept': 'application/json',
                platform: 4,
                userpagename: getpagename(),
                useraction: $('#formevent').val(),
                masterlisting: false
            },
            dm_ok, dm_err);

        function dm_ok(data) {
            $('.dm-loading').hide();
            var r = jQuery.parseJSON(JSON.stringify(data));
            $('#dmPaginationDiv').html('');
            dm_tags();

            if (r.IsPackageExpire == 1) {
                Notiflix.Report.Warning(r.ExpiryTitle, r.message, false, function() {
                    window.location = r.ExpiryURL;
                });
                return;
            }

            if (r.status == 0) {
                $('.dmTotalItems').html('0 Diamonds');
                $('.dmTotalPrice').html('Total Price : $0');
                $('#dmGridData').html('<div class="text-center p-5"><h4>' + r.message + '</h4></div>');
                return;
            }

            $('.dmTotalItems').html((r.totaldiamond || 0) + ' Diamonds');
            $('.dmTotalPrice').html('Total Price : $' + (r.totalprice || 0));

            var h = '<div class="all-product-item">';
            for (var i = 0; i < r.data.length; i++) {
                var d = r.data[i];

                /* image : uploaded → link → default */
                var img = d.diamondimgurl;
                if (d.hasdiamondimage == 1 && d.diamondimagedetail && d.diamondimagedetail.length > 0) {
                    img = DM_IMG_URL + d.diamondimagedetail[0].image;
                } else if (d.diamondimglink && d.diamondimglink !== '') {
                    img = d.diamondimglink;
                }

                var title = (d.shape || '') + ' ' +
                    (d.size ? parseFloat(d.size).toFixed(2) + 'ct' : '') + ' ' +
                    (d.color || '') + ' ' + (d.clarity || '');

                h += '<div class="item">';
                h += '  <div class="product-image">';
                h += '    <a href="javascript:void(0);" class="product-img btnshowdiamonddetail" data-diamondid="' + d.id + '">';
                h += '      <img class="primary blur-up lazyloaded" src="' + img + '" alt="' + (d.stock || '') + '" title="' + (d.stock || '') + '">';
                h += '    </a>';
                h += '  </div>';
                h += '  <div class="product-details">';
                h += '    <div class="row prodesje"><div class="text-left"><div class="serjew">' + (d.stock || '') + '</div></div></div>';
                h += '    <div class="product-name text-uppercase">';
                h += '      <a href="javascript:void(0);" class="btnshowdiamonddetail" data-diamondid="' + d.id + '">' + title + '</a>';
                h += '    </div>';
                h += '    <div class="product-price">';
                h += '      <span class="price">$' + (d.totalprice || 0) + '</span>';
                h += '      <div class="text-right prosetm"><button class="ringbtnset">' + (d.lab || '-') + '</button></div>';
                h += '    </div>';
                h += '  </div>';
                h += '</div>';
            }
            h += '</div>';
            $('#dmGridData').html(h);

            /* pagination — 'pagination' ne 'dm-pagination' ma badlo jethi
               juno diamondsearch.php:566 no handler fire na thay */
            var pg = (r.pagedata || '')
                .replace(/pagination/g, 'dm-pagination')
                .replace(/go_btn/g, 'dm_go_btn')
                .replace(/goto/g, 'dm-goto');
            $('#dmPaginationDiv').html(pg);
        }

        // function dm_err() {
        //     $('.dm-loading').hide();
        // }
        function dm_err(xhr) {
            $('.dm-loading').hide();
            var message = xhr && xhr.responseJSON && xhr.responseJSON.message ?
                xhr.responseJSON.message :
                'Could not load diamond listings. Please try again.';
            $('#dmGridData').html('<div class="dm-empty-state" role="alert">' + dm_escape(message) + '</div>');
        }
    }

    /* ---------- events ---------- */
    $('body').on('change', '#dmSidenav .form-check-input', function() {
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('change', '#dmShapeStrip .dm_shapeid', function() {
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('click', '#dm_btnfltsearch', function() {
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('keypress', '#dm_fltsearch', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#dmGridData').attr('data-nextpage', 0);
            dm_listdata(1);
        }
    });

    $('body').on('change', '#dm_sortbyid, #dm_per_page', function() {
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('click', '#pills-tab a', function(e) {
        e.preventDefault();
        $('#pills-tab a').removeClass('active').attr('aria-selected', 'false');
        $(this).addClass('active').attr('aria-selected', 'true');
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('change', '#dm_fromsize, #dm_tosize, #dm_fromprice, #dm_toprice', function() {
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('click', '#dmPaginationDiv .dm-pagination li.active', function() {
        var page = $(this).attr('p');
        $('#dmGridData').attr('data-nextpage', parseInt(page) - 1);
        dm_listdata(page);
    });

    $('body').on('click', '#dm_btnreset', function() {
        $('#dmSidenav input[type=checkbox]').prop('checked', false);
        $('#dmShapeStrip input[type=checkbox]').prop('checked', false);
        $('#dm_fromsize, #dm_tosize, #dm_fromprice, #dm_toprice, #dm_fltsearch').val('');
        $('#dm_sortbyid').val('');
        $('#dmGridData').attr('data-nextpage', 0);
        dm_listdata(1);
    });

    $('body').on('click', '.dm-view-switch__button', function() {
        var view = $(this).attr('data-view');
        var isList = view === 'list';

        $('#dmGridData').toggleClass('dm-view-list', isList);
        $('.dm-view-switch__button').removeClass('is-active').attr('aria-pressed', 'false');
        $(this).addClass('is-active').attr('aria-pressed', 'true');
    });


    /* mobile filter toggle */
    $('body').on('click', '.dmSetFilter', function() {
        $('.setfiljw').toggle(300);
        $('.setfiljw').addClass("filter-sidebar");
    });


    /* ---------- init ---------- */
    $(document).ready(function() {
        dm_loadshape();
        dm_loadsortby();
        dm_loadmaster('listdiamondcolor', 'dmColorData', 'dm_colorid', 'dmColorBlock');
        dm_loadmaster('listclarity', 'dmClarityData', 'dm_clarityid', 'dmClarityBlock');
        dm_loadmaster('listcut', 'dmCutData', 'dm_cutid', 'dmCutBlock');
        dm_loadmaster('listpolish', 'dmPolishData', 'dm_polishid', 'dmPolishBlock');
        dm_loadmaster('listsymmetry', 'dmSymmetryData', 'dm_symmetryid', 'dmSymmetryBlock');
        dm_loadmaster('listintensity', 'dmIntensityData', 'dm_intensityid', 'dmIntensityBlock');
        dm_loadmaster('listlab', 'dmLabData', 'dm_labid', 'dmLabBlock');
        dm_loadmaster('listshade', 'dmShadeData', 'dm_shadeid', 'dmShadeBlock');
        dm_loadmaster('listeyeclean', 'dmEyeCleanData', 'dm_eyecleanid', 'dmEyeCleanBlock');
        dm_loadmaster('listgirdle', 'dmGirdleData', 'dm_girdleid', 'dmGirdleBlock');
        dm_loadmaster('listroughdiamondsource', 'dmRoughData', 'dm_roughid', 'dmRoughBlock');
        dm_loadmaster('listcountry', 'dmLocationData', 'dm_locationid', 'dmLocationBlock');

        dm_listdata(1);
    });
</script>
<style>
    .dm-view-switch {
        display: flex;
        justify-content: flex-end;
        gap: 4px;
        margin: 0 0 10px;
    }

    .dm-view-switch__button {
        display: inline-flex;
        width: 36px;
        height: 34px;
        align-items: center;
        justify-content: center;
        border: 1px solid #d6dce1;
        border-radius: 4px;
        background: #fff;
        color: #536579;
        cursor: pointer;
    }

    .dm-view-switch__button.is-active {
        border-color: #669934;
        background: #669934;
        color: #fff;
    }

    .dm-shape-strip-layout {
        display: flex;
        align-items: flex-start;
        gap: 6px;
    }

    #dmShapeStrip {
        max-height: var(--dm-shape-row-height, 75px);
        overflow: hidden;
    }


    #dmShapeStrip.is-expanded {
        max-height: none;
        overflow: visible;
    }

    .dm-shape-toggle {
        display: inline-flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        padding: 0;
        border: 1px solid #80ad45;
        border-radius: 5px;
        background: #fff;
        color: #669934;
        cursor: pointer;
        line-height: 1.4;
    }

    .dm-shape-toggle::after {
        width: 7px;
        height: 7px;
        border-right: 2px solid currentColor;
        border-bottom: 2px solid currentColor;
        content: "";
        transform: rotate(45deg) translateY(-2px);
        transition: transform 0.2s ease;
    }

    .dm-shape-toggle[aria-expanded="true"]::after {
        transform: rotate(225deg) translateY(-2px);
    }


    #dmGridData.dm-view-list .all-product-item {
        display: grid;
        grid-template-columns: repeat(3, 12fr);
        gap: 10px;
    }

    #dmGridData.dm-view-list .dm-diamond-card {
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }

    #dmGridData .dm-diamond-card__image-wrap {
        height: 205px;
        overflow: hidden;
        background: #f1f2f4;
    }

    #dmGridData.dm-view-list .dm-diamond-card__image-wrap {
        flex: 0 0 180px;
        height: 135px;
    }

    #dmGridData .dm-diamond-card__image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #dmGridData .dm-diamond-card__image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f1f2f4, #e4e8ec);
    }

    #dmGridData .dm-diamond-card__body {
        padding: 10px 8px 8px;
    }

    #dmGridData.dm-view-list .dm-diamond-card__body {
        display: flex;
        flex: 1 1 auto;
        flex-direction: column;
        justify-content: center;
        padding: 12px 16px;
    }

    #dmGridData .dm-diamond-card__stock {
        display: block;
        margin-bottom: 4px;
        color: #5a5a5a;
        font-size: 12px;
        line-height: 1.3;
    }

    #dmGridData .dm-diamond-card__title {
        overflow: hidden;
        margin: 0;
        color: #000;
        font-size: 13px;
        font-weight: 600;
        line-height: 21px;
        text-overflow: ellipsis;
        text-transform: capitalize;
        white-space: nowrap;
    }

    #dmGridData .dm-diamond-card__footer {
        display: flex;
        min-height: 25px;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    #dmGridData .dm-diamond-card__price {
        color: #669934;
        font-size: 20px;
        font-weight: 600;
        line-height: 1.2;
    }

    #dmGridData .dm-diamond-card__lab {
        padding: 3px 8px;
        border-radius: 6px;
        background: #66993421;
        color: #669934;
        font-size: 10px;
        font-weight: 600;
        line-height: 1.3;
    }

    #dmGridData .dm-empty-state {
        grid-column: 1 / -1;
        padding: 24px;
        color: #536579;
        text-align: center;
    }


    @media (max-width: 900px) {
        #dmGridData .dm-diamond-card__image-wrap {
            height: 180px;
        }

        #dmGridData.dm-view-list .dm-diamond-card__image-wrap {
            height: 125px;
        }
    }

    @media (max-width: 600px) {

        #dmGridData .dm-diamond-card__image-wrap {
            height: 150px;
        }

        #dmGridData.dm-view-list .dm-diamond-card__image-wrap {
            flex-basis: 105px;
            height: 110px;
        }

        #dmGridData.dm-view-list .dm-diamond-card__body {
            padding: 8px 10px;
        }
    }



    ul.dm-pagination {
        display: flex;
    }
</style>