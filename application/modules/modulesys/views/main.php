

        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading">
                        Module Sistem
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Module</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($status as $st) { ?>
                                        <tr class="">
                                            <td><?php echo $st->id_module ?></td>
                                            <td><?php echo $st->nama_module ?></td>
                                         
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                
                
                
            </div>

        
        <!-- page end-->
