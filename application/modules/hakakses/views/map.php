
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
                                    <th>NIP</th>
                                    <th>Nama Orang</th>
                                    <th>Hak Akses Sistem</th>
                                </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($users as $st) { ?>
                                        <tr class="">
                                            <td><?php echo $st->nip ?> </td>
                                            <td><?php echo $st->nama ?></td>
                                            <td><?php echo $st->nama_hak_akses ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                
                
            </div>
        </div>
