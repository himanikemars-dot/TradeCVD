<?php 

require_once dirname(__DIR__, 1).'/config/init.php';

?>
    
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-12 layout-spacing">
                <div class="widget">
                    <div class="widget-heading m-0">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mx-auto" id="tableDataList" data-show="1" data-nextpage='0' >
                                <div class="input-group">
                                    <input type="search" class="form-control control-append" placeholder="Search..." id="inputMasters">
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="labelMasters" id="labelMasters"><i class="fal fa-search"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 layout-spacing">
                <div class="row ml-0" >
                    <div class="masonry-widget" id="datalist">    
                       <div class="masonry-widget-item"> 
                            <div class="widget">
                                <div class="widget-heading">
                                    <div class="row"> 
                                        <div class="col-12"> 
                                            <h5> Report</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="row"> 
                                        <div class="col-12 px-0"> 
                                            <ul>
                                                <?php
                                                 if($IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                                 {
                                                    echo '<li><a href="report_diamond" target="_blank">Diamond Reports</a></li>';

                                                 }
                                                 if($IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                                 {
                                                    echo '<li><a href="report_jewellery" target="_blank">Jewellery Reports</a></li>';

                                                 }
                                                 if($IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                                 {
                                                    echo '<li><a href="report_buyrequest" target="_blank">Buy Request Reports</a></li>';

                                                 }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            
        </div>
    </div>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
      $("#inputMasters").on("keyup", function() {
            var that = this, $allListElements = $('.masonry-widget ul > li');
            var $matchingListElements = $allListElements.filter(function(i, li){
                var listItemText = $(li).text().toUpperCase(), 
                    searchText = that.value.toUpperCase();
                return ~listItemText.indexOf(searchText);
            });
            $allListElements.hide();
            $matchingListElements.show();
        });
    </script>
