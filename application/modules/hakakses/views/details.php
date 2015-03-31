<section class="wrapper">

        <!-- page start-->

<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                        <header class="panel-heading">
                            Edit Hak Akses
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" action="<?php echo base_url('hakakses/editDetAkses'); ?>">
                                    <input type="hidden" value="<?php echo $ent->id_hak_akses; ?>" name="id"/>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Nama Hak Akses</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" readonly id="nama" name="nama" type="text" value="<?php echo $ent->nama_hak_akses ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label col-lg-3">Module <span style="color:red; font-size: 12px">*</span></label>
                                        <div class="col-lg-6 icheck">
                                            <div class="flat-grey single-row">
                                                <?php foreach ($cols as $col) { ?>                                                    
                                                    <div class="radio col-lg-9">
                                                        <input type="checkbox" name="modules[]" value="<?php  echo $col->id_module ?>" <?php  if (in_array($col->id_module,$module_data)){echo 'checked="checked"';  }?>>  <label><?php echo $col->nama_module ?></label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                                                    
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <input class="btn btn-primary" type="submit" value="Save">
                                            <button class="btn btn-default" type="button" onclick="window.location=' <?php echo site_url().'/hakakses' ?>'">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
        </section>
       
        <!-- page end-->
