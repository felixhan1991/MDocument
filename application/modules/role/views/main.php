

        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading">
                        Akses Pengguna
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
                                    <th>Nama Akses</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($status as $st) { ?>
                                        <tr class="">
                                            <td><?php echo $st->id_role ?></td>
                                            <td><?php echo $st->nama_role ?></td>
                                            <td><?php if ($st->id_role >=1) { ?><a class="edit" href="javascript:;">Edit</a><?php } ?></td>
                                            <td><?php if ($st->id_role >=1) { ?><a class="delete" href="javascript:;">Delete</a><?php } ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                
                <section class="panel">
                    <header class="panel-heading">
                        Tambah Nama Akses
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal bucket-form" method="post" action="<?php echo base_url();?>role/">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Akses</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nm_role" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info">Tambah</button>
                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>
        
        <!-- page end-->
