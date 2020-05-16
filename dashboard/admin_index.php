<!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> المستخدمون</span>
            <div class="count">
                <?php
                $qu = $engine->connect()->query("SELECT * FROM `users`");
                echo $nm = $qu->num_rows;
                ?>
            </div>
            <span class="count_bottom">جميع المستخدمين</span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-coppy"></i> المنتجات</span>
            <div class="count">
                <?php
                $qp = $engine->connect()->query("SELECT * FROM `products`");
                echo $nm = $qp->num_rows;
                ?>
            </div>
            <span class="count_bottom">جميع المنتجات</span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-comment"></i>  التعليقات </span>
            <div class="count green">
                <?php
                $qc = $engine->connect()->query("SELECT * FROM `comments`");
                echo $nm = $qc->num_rows;
                ?>
            </div>
            <span class="count_bottom">جميع التعليقات</span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-inbox"></i>   الرسائل</span>
            <div class="count">
                <?php
                $qm = $engine->connect()->query("SELECT * FROM `messages`");
                echo $nm = $qm->num_rows;
                ?>
            </div>
            <span class="count_bottom">جميع الرسائل</span>
        </div>
    </div>
    <!-- /top tiles -->
<div class="row col-md-12">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> إجمالي الربح من عمولات التجار</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">سنوي</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false"> شهري</a>
                        </li>
                    </ul>
                    <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                            <?php
                                $date = date("Y");
                                $smd  = $engine->connect()->query("SELECT SUM(commission) AS `total` FROM `trans` WHERE `type` = 'in'");
                                $show = $smd->fetch_array();
                            ?>
                            <h3><?=$show['total']. ' '. DCRC;?></h3>
                            <small>هذه السنة</small> 
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                            <?php
                                $date = date("Y-m");
                                $smd  = $engine->connect()->query("SELECT SUM(commission) AS `total` FROM `trans` WHERE (`type` = 'in' AND `date` LIKE '%$date%')");
                                $show = $smd->fetch_array();
                            ?>
                            <h3><?=$show['total']. ' '. DCRC;?></h3>
                            <small>هذا الشهر</small> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> إجمالي الربح من بيع الموقع</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">سنوي</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false"> شهري</a>
                        </li>
                    </ul>
                    <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <?php
                                $date = date("Y");
                                $uid  = USER_ID;
                                $smd  = $engine->connect()->query("SELECT SUM(commission) AS `total` FROM `trans` WHERE (`type` = 'in' AND `uid` = '$uid')");
                                $show = $smd->fetch_array();
                            ?>
                            <h3><?=$show['total']. ' '. DCRC;?></h3>
                            <small>هذه السنة</small> 
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <?php
                                $date = date("Y-m");
                                $uid  = USER_ID;
                                $smd  = $engine->connect()->query("SELECT SUM(commission) AS `total` FROM `trans` WHERE (`type` = 'in' AND `date` LIKE '%$date%' AND `uid` = '$uid')");
                                $show = $smd->fetch_array();
                            ?>
                            <h3><?=$show['total']. ' '. DCRC;?></h3>
                            <small>هذا الشهر</small> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>