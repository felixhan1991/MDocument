<form class="cmxform form-horizontal " enctype="multipart/form-data"  id="commentForm" method="post" action="<?php echo base_url().'job/draft/index/'.$document->id_dokumen?>">
<div class="row">
        <div class="col-lg-12">
            <div class="text-right" id="nestable_list_menu">
                <input class="btn btn-success" type="submit" value="Save"/>
                <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'job/'?>'">Cancel</button>
            </div>
        </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="border-head">
                        <h3>Formulir Dokumen</h3>
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
                        <input type="hidden" name="id_dokumen" value="<?php echo $document->id_dokumen?>"/>
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-3">Tanggal</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" name="tanggal"><?php echo $document->tanggal_dokumen?></p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-3">Nomor Dokumen</label>
                                <div class="col-lg-8">
                                    <input class=" form-control" id="nomor" name="nomor" type="text" value="<?php echo $document->no_serial?>"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-3">Judul Dokumen</label>
                                <div class="col-lg-8">
                                    <input class=" form-control" id="judul" name="judul" type="text" value="<?php echo $document->nama_dokumen?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label col-lg-3">Deskripsi Dokumen</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control ckeditor" name="deskripsi" rows="6"><?php echo $document->deskripsi?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class=" col-lg-3 control-label">Kategori</label>
                                 <div class="col-lg-8">
                                    <select multiple name="kategoris[]" id="kategori" style="min-width:300px" class="populate">
                        
                                        <?php foreach ($kategoris as $s) {
                                            if (in_array($s->id_kategori, $get_kategori))
                                                  echo '<option value="'.$s->id_kategori.'" selected>'. $s->nama_kategori.'</option>';  
                                              else {
                                                  echo '<option value="'.$s->id_kategori.'">'. $s->nama_kategori.'</option>';  
                                              }
                                              } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" col-lg-3 control-label">Departemen</label>
                                 <div class="col-lg-8">
                                    <select multiple name="departemens[]" id="departemen" style="min-width:300px" class="populate">
                        
                                        <?php foreach ($departemens as $s) {
                                            if (in_array($s->id_departemen, $get_departemen))
                                                  echo '<option value="'.$s->id_departemen.'" selected>'. $s->nama_departemen.'</option>';  
                                              else {
                                                  echo '<option value="'.$s->id_departemen.'">'. $s->nama_departemen.'</option>';  
                                              }
                                              } ?>
                                    </select>
                                </div>
                            </div>
                           <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-3">Daftar Review</label>
                                <div class="col-lg-8">
                                    <a class="btn btn-success" data-toggle="modal" href="#myModal">
                                        Klik di sini!
                                    </a>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Daftar Review</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php foreach ($reviews as $rev)
                                                        {?>
                                                        <blockquote class="clearfix">
                                                            <p style="font-size:10pt">
                                                                <?php echo $rev->isi_review ?>
                                                            </p>
                                                            <small class="text-right">Direview oleh <?php echo $rev->nama_akun?> (<i><?php echo $rev->tanggal_review?></i>)</small>
                                                        </blockquote>
                                                        <hr>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->
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
                                <label class="control-label col-lg-3">Upload Dokumen </label>
                                <div class="controls col-lg-8">
                                    <input class="default " type="file" name="doc"/>
                                    <font size="1pt">(doc & pdf)</font>
                                </div>
                            </div>
                        <div class="form-group">
                                <label class="control-label col-lg-3">Upload Referensi </label>
                                <div class="controls col-lg-8">
                                    <input class="default " type="file" name="ref"/>
                                    <font size="1pt">(zip, pdf, doc, ppt, jpg/png)</font>
                                </div>
                            </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3  control-label">Versi Terakhir Dokumen</label>
                            <div class="col-lg-8">
                                    <p class="form-control-static" name="version"><?php echo $version?></p>
                            </div>
                        </div>
                    </div>
                </section>
      
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       Daftar Versi Dokumen (<a href="<?php echo base_url().'job/draft/editFiles/'.$document->id_dokumen?>">more details</a>)
                       <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                     </span>
                    </header>
                    <div class="panel-body minimal">
                        <div class="table-inbox-wrap ">
                        <table class="table table-inbox table-hover">
                        <tbody>
                            <?php    
                            $incre = count($files);
                            foreach ($files as $file) {?>
                                <tr class="unread">
                                    <td><?php echo $incre--?></td>
                                    <td class="view-message  dont-show">
                                        <a href="<?php echo base_url().'file/downloadFile?id_doc='.$file->id_dokumen.
                                                '&id_file='.$file->nama_file?>"><?php echo $file->nama_file?>
                                        </a>
                                    </td>
                                    <td class="view-message  text-right"><?php echo $file->tanggal_file?></td>
                                    <td>

                                    <button type="button" class="btn btn-info btn-xs " 
                                            onclick="window.location='<?php echo base_url().'file/downloadFile?id_doc='.$file->id_dokumen.
                                                '&id_file='.$file->nama_file?>'">
                                        <i class="fa fa-cloud-download"></i> Download</button>
                                    </td>
                                    <td></td>
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
<div class="row">
    <div class="col-lg-12">
        <div class="text-center" id="nestable_list_menu">
            <button class="btn btn-success" type="submit">Save</button>
            <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'job/'?>'">Cancel</button>
        </div>
    </div>
</div>
</form>

            <!-- page end-->