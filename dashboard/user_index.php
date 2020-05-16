<!-- top tiles -->
<div class="row tile_count">
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-check-circle"></i> المشتريات</span>
        <div class="count">
            <?php
            $uid = USER_ID;
            $qs = $engine->connect()->query("SELECT * FROM `purchases` WHERE `uid` = '$uid'");
            echo $nm = $qs->num_rows;
            ?>
        </div>
        <span class="count_bottom">عدد  مشترياتك</span>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-coppy"></i> منتجات الموقع</span>
        <div class="count">
            <?php
            $uid = USER_ID;
            $qp = $engine->connect()->query("SELECT * FROM `products`");
            echo $nm = $qp->num_rows;
            ?>
        </div>
        <span class="count_bottom">جميع  منتجات الموقع</span>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-comment"></i>  تعليقاتك </span>
        <div class="count green">
            <?php
            $uid = USER_ID;
            $qc = $engine->connect()->query("SELECT * FROM `comments` WHERE `from` = '$uid'");
            echo $nm = $qc->num_rows;
            ?>
        </div>
        <span class="count_bottom">جميع  تعليقاتك على المنتجات</span>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-inbox"></i>  الشكاوى</span>
        <div class="count">
            <?php
            $qm = $engine->connect()->query("SELECT * FROM `reports` WHERE `from` = '$uid'");
            echo $nm = $qm->num_rows;
            ?>
        </div>
        <span class="count_bottom">جميع الشكاوي المقدمة من قبلك</span>
    </div>
</div>
<!-- /top tiles -->