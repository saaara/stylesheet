<!-- top tiles -->
<div class="row tile_count">
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-check-circle"></i> المبيعات</span>
        <div class="count">
            <?php
            $uid = USER_ID;
            $qs = $engine->connect()->query("SELECT * FROM `sales` WHERE `uid` = '$uid'");
            echo $nm = $qs->num_rows;
            ?>
        </div>
        <span class="count_bottom">عدد مبيعاتك</span>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-coppy"></i> المنتجات</span>
        <div class="count">
            <?php
            $uid = USER_ID;
            $qp = $engine->connect()->query("SELECT * FROM `products` WHERE `uid` = '$uid'");
            echo $nm = $qp->num_rows;
            ?>
        </div>
        <span class="count_bottom">جميع  منتجاتك</span>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-comment"></i>  التعليقات </span>
        <div class="count green">
            <?php
            $uid = USER_ID;
            $qc = $engine->connect()->query("SELECT * FROM `comments` WHERE `uid` = '$uid'");
            echo $nm = $qc->num_rows;
            ?>
        </div>
        <span class="count_bottom">جميع  التعليقات على منتجاتك</span>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-inbox"></i>  الشكاوى</span>
        <div class="count">
            <?php
            $qm = $engine->connect()->query("SELECT * FROM `reports` WHERE `uid` = '$uid'");
            echo $nm = $qm->num_rows;
            ?>
        </div>
        <span class="count_bottom">جميع  الشكاوى المقدمة ضد منتجاتك</span>
    </div>
</div>
<!-- /top tiles -->