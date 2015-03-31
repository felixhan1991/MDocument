<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/skycons/skycons.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/calendar/moment-2.2.1.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/evnt.calendar.init.js"></script>

<!--common script init for all pages-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>/js/scripts.js"></script>
<!--script for this page-->


<!-- Dokumen js -->
<!--Easy Pie Chart-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->


<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jquery.validate.min.js"></script>



<!--dynamic table-->
<script type="text/javascript" language="javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/dynamic_table_init.js"></script>

<!--dynamic table initialization -->
<?php if ($state==='dashboard') { include 'js/dashboard.php';  //include 'js/dashboard_status.php';
?>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/skycons/skycons.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/calendar/moment-2.2.1.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/evnt.calendar.init.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/gauge/gauge.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/sparkline/jquery.sparkline.js"></script>
<!--Morris Chart-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/morris-chart/morris.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/morris-chart/raphael-min.js"></script>
<!--jQuery Flot Chart-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/flot-chart/jquery.flot.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/flot-chart/jquery.flot.resize.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/flot-chart/jquery.flot.animator.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/flot-chart/jquery.flot.growraf.js"></script>

<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jquery.customSelect.min.js" ></script>
<?php     } ?>
<!-- Status -->
<?php if ($state==='status' || $state==='kategori' || $state==='dashboard' ||
        $state==='mydrive' ) { ?>
<?php if ($state==='status') {?>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/table-editable-status.js"></script>
<?php } else if ($state==='kategori') { ?>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/table-editable-kategori.js"></script>
<?php } else if ($state==='dashboard' || $state==='mydrive' ) { ?>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/table-editable.js"></script>
<?php } ?>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<?php } ?>
<!-- end Status -->

<!-- Role -->
<?php if ($state==='role') { ?>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/table-editable-role.js"></script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<?php } ?>
<!-- end Role -->

<!-- Form Dokumen -->
<?php if ($state==='form_document' || $state==='edit_form_document' || $state==='view_form_document' || $state==='report') { ?>

<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/validation-init.js"></script>
<?php if ($state!='view_form_document' && $state!='report' ) include 'js/time-refresh-init.php';?>

<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jquery-multi-select/js/jquery.quicksearch.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/toggle-init.js"></script>
<script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/bootstrap-switch.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/jquery-tags-input/jquery.tagsinput.js"></script>

<?php if ($state!='view_form_document') { ?><script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/select2/select2.js"></script> 
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/select-init.js"></script><?php } ?>

<!--script for this page-->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/iCheck/jquery.icheck.js"></script>


<!--icheck init -->
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/icheck-init.js"></script>
<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/advanced-form.js"></script>

<?php  } ?>
<!-- end Dokumen js -->

<?php if ($state === 'report')  { ?>
    <!-- Report Page-->
    <!--Easy Pie Chart-->
    <script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/sparkline/jquery.sparkline.js"></script>
    <!--Morris Chart-->
    <script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/morris-chart/morris.js"></script>
    <script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/morris-chart/raphael-min.js"></script>
<?php include 'js/_morris_init.php' ?>
    <?php if ($sub_state==='Waktu') include 'js/report.php'; } ?>

    <script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/fuelux/js/tree.min.js"></script>
    <!--script for this page-->
    <?php include 'js/tree.php'; ?>
<!--<script src="<?php echo base_url().APPPATH.'themes/default/views/'?>js/tree.js"></script>-->

<script>
    jQuery(document).ready(function() {
        TreeView.init();
    });
</script>


