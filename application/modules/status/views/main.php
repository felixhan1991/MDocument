

        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading">
                        Status Dokumen
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <label class="col-lg-12 control-label"><?php echo validation_errors()?></label>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Status Dokumen</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($status as $st) { ?>
                                        <tr class="">
                                            <td><?php echo $st->id_status ?></td>
                                            <td><?php echo $st->nama_status ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                
            
            </div>
        </div>
        
        <!-- page end-->
