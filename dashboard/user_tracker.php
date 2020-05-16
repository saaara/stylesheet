<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>تتبع المنتجات
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12"></div>
                <div class="form-group col-md-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" name="track">
                        <div class="item col-md-12 col-sm-12 col-xs-12">
                            <label>رقم التتبع</label>
                            <input name="track" type="text" data-validate-length-range="14" required="required" class="form-control col-md-12 col-xs-12">
                            <small>ادخل رقم التتبع المكون من 14 رقم الذي تم إرساله لك على البريد  الإلكتروني</small>
                        </div>
                    </form>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <br/>
                        <button type="button" onclick="track_status()" class="btn btn-primary">عرض</button>
                    </div>
                </div>
        </div>
    </div>
</div>
<div  id="msg"></div>