        <!-- footer content -->
        <footer class="hidden-print">
            <div class="pull-left">
                جميع الحقوق محفوظة <i class="fa fa-copy-right"></i> <?=S_NAME?>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<div id="lock_screen">
    <table>
        <tr>
            <td>
                <div class="clock"></div>
                <span class="unlock">
                    <span class="fa-stack fa-5x">
                      <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                      <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                </span>
            </td>
        </tr>
    </table>
</div>
<!-- jQuery -->
<script src="assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="assets/vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="assets/vendors/iCheck/icheck.min.js"></script>

<!-- bootstrap-daterangepicker -->
<script src="assets/vendors/moment/min/moment.min.js"></script>

<script src="assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Skycons -->
<script src="assets/vendors/skycons/skycons.js"></script>


<!-- DateJS -->
<script src="assets/vendors/DateJS/build/production/date.min.js"></script>


<!-- Custom Theme Scripts -->
<script src="assets/build/js/custom.min.js"></script>
<!-- starrr -->

<!-- jQuery Tags Input -->
<script src="assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="assets/vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="assets/vendors/select2/dist/js/select2.full.min.js"></script>

<!-- validator -->
<script src="assets/vendors/validator/validator.js"></script>
<script src="assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/vendors/map/PlacePicker.js"></script>
<!-- Summernote -->
<script src="assets/vendors/summernote/summernote-bs4.min.js"></script>
<script>
    $('#myDatepicker').datetimepicker({
        format: 'DD-MM-YYYY hh:mm:ss A',
        sideBySide : true
    });
    $('#myDatepicker2').datetimepicker({
        format: 'DD-MM-YYYY hh:mm:ss A',
        sideBySide : true
    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#pickup_country").PlacePicker({
            
            key:"AIzaSyAad-xKZ1Qu5YN47sDTXNK_6iFjDtPnGSg",
            center: {lat: 17.6868, lng: 83.2185},
            btnClass: "btn btn-secondary btn-sm",
            title: "حدد العنوان على الخريطة",
            success:function(data,address){
                //data contains address elements and
                //address conatins you searched text
                //Your logic here
                $("#pickup_country").val(data.formatted_address);
            }
        });
    });
</script>
</body>
</html>
