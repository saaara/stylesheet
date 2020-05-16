<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> المنتجات في حالة التتبع
                        <small>جميع المنتجات التي لم يتم توصيلها بعد</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>البائع</th>
                            <th>المشتري</th>
                            <th>رقم التتبع</th>
                            <th>تاريخ الشراء</th>
                            <th>خيارات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $usr = USER_ID;
                        if(USER_RANK == 3)
                        {
                            $q = "SELECT * FROM `sales` WHERE (`status` <> 3 AND `uid` = '$usr')  ORDER BY `date` DESC";
                        }
                        else
                        {
                            $q = "SELECT * FROM `sales` WHERE `status` <> 3  ORDER BY `id` DESC";
                        }
                        $sdm = $engine->connect()->query($q);
                        while ($show = $sdm->fetch_array())
                        {
                            $pid    = $show['pid'];
                            $uid    = $show['uid'];
                            $bid    = $show['buyer'];
                            $qp     = "SELECT * FROM `products` WHERE `pid` = '$pid'";
                            $smdp   = $engine->connect()->query($qp);
                            $nm     = $smdp->num_rows;
                            if($nm <= 0)
                            {
                                $qp     = "SELECT * FROM `offers` WHERE `pid` = '$pid'";
                                $smdp   = $engine->connect()->query($qp);
                            }
                            $showp  = $smdp->fetch_array();
                            $qu     = "SELECT * FROM `users` WHERE `id` = '$uid'";
                            $smdu   = $engine->connect()->query($qu);
                            $showu  = $smdu->fetch_array();
                            $qb     = "SELECT * FROM `users` WHERE `id` = '$bid'";
                            $smdb   = $engine->connect()->query($qb);
                            $showb  = $smdb->fetch_array();
                        ?>
                        <tr>
                            <th><?=$showp['name']?></th>
                            <th><?=$showu['name']?></th>
                            <th><?=$showb['name']?></th>
                            <th><?=$show['track']?></th>
                            <th><?=counttime($show['date']);?></th>
                            <th>
                                <button data-toggle="collapse" data-target="#<?=$show['id']?>" class="btn btn-success btn-flat"aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-history"></i> مراحل التوصيل
                                </button>
                            </th>
                        </tr>
                        <!--track history-->
                        <!-- Modal -->
                        <div class="collapse col-md-12" id="<?=$show['id']?>" >
                            <div class="track-stts col-md-12">
                            <?php  
                            $track    = $show['track'];
                            $qt       = "SELECT * FROM `tracker` WHERE `track` = '$track'";
                            $smdt     = $engine->connect()->query($qt);
                            $qpur     = "SELECT * FROM `purchases` WHERE `track` = '$track'";
                            $smdpur   = $engine->connect()->query($qpur);
                            $showpur  = $smdpur->fetch_array();
                            $adr      = $showpur['address'];
                            $qadr     = "SELECT * FROM `addresses` WHERE `id` = '$adr'";
                            $smdadr   = $engine->connect()->query($qadr);
                            $showadr  = $smdadr->fetch_array();
                            ?>
                            <?if(USER_ID == $uid){?>
                            <form name="tracker">
                                <div id="msg"></div>
                                <h3>تغيير حالة الشحنة</h3>
                                <div class="form-group col-md-12">
                                    <div class="col-md-6">
                                        <label>الحالة</label>
                                        <input type="text" class="form-control" name="status" placeholder="ما هي حالة الشحنة الآن">
                                    </div>
                                    <div class="col-md-6">
                                        <label>وصف الحالة</label>
                                        <input type="text" class="form-control" name="desc" placeholder="اشرح للمشتري ما هي حالة شحنته">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-6">
                                        <label>المرحلة</label>
                                        <select name="step" class="form-control">
                                            <option value="0">قيد المراجعة</option>
                                            <option value="1">قيد الشحن</option>
                                            <option value="2">تم شحن المنتج وإرساله للعنوان</option>
                                            <option value="3">تم استلام المنتج</option>
                                        </select>
                                    </div>
                                    </form>
                                    <div class="col-md-6">
                                        <br/>
                                        <button onclick="add_tracker('<?=$track?>')" class="btn btn-primary">إضافة</button>
                                    </div>
                                </div>
                                <?}?>
                            <ul class="col-md-12 thdr">
                                <li><b>الدولة : <?=$showadr['country']?></b></li>
                                <li><b>المدينة  : <?=$showadr['city']?></b></li>
                                <li><b>العنوان  :<?=$showadr['address']?></b></li>
                                <li><b>الهاتف  :<?=$showadr['phone']?></b></li>
                                <li><b>طريقة الاستلام :<?=$showpur['shipping']?></b></li>
                            </ul>
                            <div class="col-md-12 tstts">
                                <div class="col-md-12">
                                    <div class="col-md-3 hdr">الحالة</div>
                                    <div class="col-md-3 hdr">الوصف</div>
                                    <div class="col-md-3 hdr">التاريخ</div>
                                    <div class="col-md-3 hdr">مرحلة الشحن</div>
                                </div>
                                <?while($showt = $smdt->fetch_array()){?>
                                    <div class="col-md-12">
                                        <div class="col-md-3 cnt"> <?=$showt['status']?></div>
                                        <div class="col-md-3 cnt"> <?=$showt['desc']?></div>
                                        <div class="col-md-3 cnt"> <?=$showt['date']?></div>
                                        <div class="col-md-3 cnt"> 
                                            <?php
                                            if($showt['step'] == 1)
                                            {
                                                echo "مرحلة  الموافقة والشحن";
                                            }
                                            else if($showt['step'] == 0)
                                            {
                                                echo "مرحلة  المراجعة";
                                            }
                                            else if($showt['step'] == 2)
                                            {
                                                echo "مرحلة  التوصيل للوجهة المطلوبة";
                                            }
                                            else if($showt['step'] == 3)
                                            {
                                                echo "مرحلة استلام الشحنة من قبل المشتري";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?}?>
                            </div>
                          </div>
                        <!--/track history-->
                        <?}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>