<form class="cmxform form-horizontal " enctype="multipart/form-data" id="commentForm" method="post" action="<?php echo base_url().'documents/manage/form'?>">
<div class="row">
        <div class="col-lg-12">
            <div class="text-right" id="nestable_list_menu">
                <input class="btn btn-success" type="submit" value="Save"/>
                <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'documents/'?>'">Cancel</button>
            </div>
        </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="border-head">
                        <h3>Formulir Dokumen</h3>
                        <label class="col-lg-12 control-label" style="text-align: left"><?php echo validation_errors()?></label>
                        
                    </div>                   
                </div>
            </div>
            <br>
<div class="row">
        <div class="col-lg-12">

            <section class="panel">
                <header class="panel-heading">
                    Data Dokumen
                    
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                     </span>
                </header>
                
                <div class="panel-body">
                    
                    <div class="form">
                        
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-3">Tanggal</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" id="timeDiv" name="tanggal"></p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-3">Nomor Dokumen</label>
                                <div class="col-lg-8">
                                    <input class=" form-control" id="nomor" name="nomor" type="text" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-3">Judul Dokumen</label>
                                <div class="col-lg-8">
                                    <input class=" form-control" id="judul" name="judul" type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label col-lg-3">Deskripsi Dokumen</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control ckeditor" name="deskripsi" rows="6"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class=" col-lg-3 control-label">Kategori</label>
                                 <div class="col-lg-8">
                                    <select multiple name="kategoris[]" id="kategori" style="min-width:300px" class="populate">
                                        <?php foreach ($kategoris as $s) {?>
                                            <option value="<?php echo $s->id_kategori?>"><?php echo $s->nama_kategori?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-lg-3 control-label">Departemen</label>
                                 <div class="col-lg-8">
                                    <select multiple name="departemens[]" id="departemen" style="min-width:300px" class="populate" >
                                        <?php foreach ($departemens as $s) {?>
                                            <option value="<?php echo $s->id_departemen?>"><?php echo $s->nama_departemen?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                    </div>
                </div>  
            </section>
            
            <section class="panel">
                    <header class="panel-heading">
                    Enroll Pengguna
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                     </span>
                    </header>
                    <div class="panel-body">
                        
                        <div class="form">
                            
                            <div class="form-group">
                                <label class="col-lg-3  control-label">Drafter</label>
                                <div class="col-lg-8">
                                    <select multiple name="drafter[]" id="author" style="min-width:300px" class="populate">
                                        <?php foreach ($users as $s) {?>
                                            <option value="<?php echo $s->id_akun?>"><?php echo $s->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-3  control-label">Reviewer</label>
                                <div class="col-lg-8">
                                    <select multiple name="reviewer[]" id="review" style="min-width:300px" class="populate">
                                        <?php foreach ($users as $s) {?>
                                            <option value="<?php echo $s->id_akun?>"><?php echo $s->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3  control-label">Approval</label>
                                <div class="col-lg-8">
                                    <select multiple name="approval[]" id="editor" style="min-width:300px" class="populate">
                                       <?php foreach ($users as $s) {?>
                                            <option value="<?php echo $s->id_akun?>"><?php echo $s->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="panel">
                    <header class="panel-heading">
                     Files
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                     </span>
                    </header>
                    <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Upload Dokumen</label>
                                <div class="controls col-lg-8">
                                    <input class="default " type="file" name="doc"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Upload Referensi</label>
                                <div class="controls col-lg-8">
                                    <input class="default " type="file" name="ref"/>
                                </div>
                            </div>
                    </div>
                </section>
                
        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-center" id="nestable_list_menu">
            <button class="btn btn-success" type="submit">Save</button>
            <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'documents/'?>'">Cancel</button>
        </div>
    </div>
</div>
</form>

            <!-- page end-->