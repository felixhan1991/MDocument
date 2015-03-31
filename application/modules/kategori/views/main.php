

        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <header class="panel-heading">
                        Kategori Dokumen
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
                                    <th>Nama Kategori Dokumen</th>
                                    <th>Sub</th>
                                    <th>Move</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($kategori as $st) { ?>
                                        <tr class="">
                                            <td><?php echo $st->id_kategori ?></td>
                                            <td><?php echo $st->nama_kategori ?></td>
                                            <td><a href="<?php echo base_url().'kategori/viewChild/'.$st->id_kategori?>"><i class="fa fa-eye"></i> View</a></td>
                                            <td ><a data-toggle="modal" href="#myModal"> <i class="fa fa-briefcase"></i>  Move </a></td>
                                            <td><?php if ($st->id_kategori >=0) { ?><a class="edit" href="javascript:;"><i class="fa fa-pencil"></i> Edit</a><?php } ?></td>
                                            <td><?php if ($st->id_kategori >=0) { ?><a class="delete" href="javascript:;"><i class="fa fa-trash-o"></i> Delete</a><?php } ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Hirarkial Kategori</h4>
                                        </div>
                                        <div class="modal-body">

                                                <div id="FlatTree2" class="tree">
                                                 <div class = "tree-folder" style="display:none;">
                                                     <div class="tree-folder-header">
                                                         <i class="fa fa-folder"></i>
                                                         <div class="tree-folder-name"></div>
                                                     </div>
                                                     <div class="tree-folder-content"></div>
                                                     <div class="tree-loader" style="display:none"></div>
                                                 </div>
                                                 <div class="tree-item" style="display:none;">
                                                     <i class="tree-dot"></i>
                                                     <div class="tree-item-name"></div>
                                                 </div>
                                             </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                            <button class="btn btn-success" type="button">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="panel">
                    <header class="panel-heading">
                        Tambah Kategori Dokumen
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal bucket-form" method="post" action="<?php echo base_url();?>kategori/">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Kategori</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nm_kategori" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info">Tambah</button>
                            </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>
        
        <!-- page end-->
