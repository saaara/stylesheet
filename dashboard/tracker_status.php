<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>حالة المنتج
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- Smart Wizard -->
            <div id="wizard" class="form_wizard wizard_horizontal">
                <h4>
                    #<?=$track?> الحالة : 
                    <?
                    if($step == 1)
                    {
                        echo "قيد المراجعة";
                    }
                    else if($step == 0)
                    {
                        echo "قيد الشحن";
                    }
                    else if($step == 2)
                    {
                        echo "تم شحن المنتج وإرساله للعنوان";
                    }
                    else if($step == 3)
                    {
                        echo "تم استلام المنتج";
                    }
                    ?>
                </h4>
                <ul class="wizard_steps">
                    <?if($step == 0){?>
                    <li>
                        <a href="#step-1">
                            <span class="step_no none"><i class="fa fa-spinner"></i></span>
                            <span class="step_descr">
                                المراجعة
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no"><i class="fa fa-shopping-basket"></i></span>
                            <span class="step_descr">
                                  الموافقة والشحن
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="step_no"><i class="fa fa-truck"></i></span>
                            <span class="step_descr">
                                  التوصيل للوجهة المطلوبة
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                            <span class="step_no"><i class="fa fa-check-circle"></i></span>
                            <span class="step_descr">
                                  الاستلام
                              </span>
                        </a>
                    </li>
                    <?}?>
                    <?if($step == 1){?>
                    <li>
                        <a href="#step-1">
                            <span class="step_no none"><i class="fa fa-spinner"></i></span>
                            <span class="step_descr">
                                المراجعة
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no none"><i class="fa fa-shopping-basket"></i></span>
                            <span class="step_descr">
                                  الموافقة والشحن
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="step_no"><i class="fa fa-truck"></i></span>
                            <span class="step_descr">
                                  التوصيل للوجهة المطلوبة
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                            <span class="step_no"><i class="fa fa-check-circle"></i></span>
                            <span class="step_descr">
                                  الاستلام
                              </span>
                        </a>
                    </li>
                    <?}?>
                    <?if($step == 2){?>
                    <li>
                        <a href="#step-1">
                            <span class="step_no none"><i class="fa fa-spinner"></i></span>
                            <span class="step_descr">
                                المراجعة
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no none"><i class="fa fa-shopping-basket"></i></span>
                            <span class="step_descr">
                                  الموافقة والشحن
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="step_no none"><i class="fa fa-truck"></i></span>
                            <span class="step_descr">
                                  التوصيل للوجهة المطلوبة
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                            <span class="step_no"><i class="fa fa-check-circle"></i></span>
                            <span class="step_descr">
                                  الاستلام
                              </span>
                        </a>
                    </li>
                    <?}?>
                    <?if($step == 3){?>
                    <li>
                        <a href="#step-1">
                            <span class="step_no none"><i class="fa fa-spinner"></i></span>
                            <span class="step_descr">
                                المراجعة
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no none"><i class="fa fa-shopping-basket"></i></span>
                            <span class="step_descr">
                                  الموافقة والشحن
                              </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="step_no none"><i class="fa fa-truck"></i></span>
                            <span class="step_descr">
                                  التوصيل للوجهة المطلوبة
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                            <span class="step_no none"><i class="fa fa-check-circle"></i></span>
                            <span class="step_descr">
                                  الاستلام
                              </span>
                        </a>
                    </li>
                    <?}?>
                </ul>
            </div>
            <!-- End SmartWizard Content -->
        </div>
        <!-- board-->
        <div class="x_content">
            <table id="datatable-fixed-header" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>الحالة</th>
                    <th>الوصف</th>
                    <th>التاريخ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $qt   = "SELECT * FROM `tracker` WHERE `track` = '$track'";
                $sdmt = $engine->connect()->query($qt);
                while ($showt = $sdmt->fetch_array()) {?>
                <tr id="users<?=$show['id']?>">
                    <th><?=$showt['status']?></th>
                    <th><?=$showt['desc']?></th>
                    <th><?=$showt['date']?></th>
                </tr>
                <?}?>
                </tbody>
            </table>
        </div>
        <!--/board-->
    </div>
</div>
