

        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading">
                        Hak Akses Sistem
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
                                    <th>Nama Hak Akses</th>
                                    <th>Edit</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($hakakses as $st) { ?>
                                        <tr class="">
                                            <td><?php echo $st->id_hak_akses ?></td>
                                            <td><?php echo $st->nama_hak_akses ?></td>
                                            <td><?php if ($st->id_hak_akses!=2) { ?><a class="edit" href="<?php echo base_url().'hakakses/viewDetail?id='.$st->id_hak_akses?>">Edit</a><?php } ?></td>
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
