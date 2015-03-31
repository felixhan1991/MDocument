<form class="cmxform form-horizontal " enctype="multipart/form-data"  id="commentForm"  action="">
<div class="row">
        <div class="col-lg-12">
            <div class="text-right" id="nestable_list_menu">
                <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'documents/'?>'">Back</button>
            </div>
        </div>
</div>
            <br>
<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#home">Dokumen</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#review">Reviews</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#file">Files</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#log">Logs</a>
                        </li>
                        
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="home" class="tab-pane active">
                            <div class="border-head">
                                <h3>Data Dokumen</h3>
                            </div> 
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
                                            <label for="lastname" class="control-label col-lg-3">No Dokumen</label>
                                            <div class="col-lg-8">
                                                <p class=" form-control-static"  name="nomor" ><?php echo $document->no_serial?></p>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="lastname" class="control-label col-lg-3">Judul Dokumen</label>
                                            <div class="col-lg-8">
                                                <p class=" form-control-static"  name="judul" ><?php echo $document->nama_dokumen?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class=" control-label col-lg-3">Deskripsi Dokumen</label>
                                            <div class="col-lg-8">
                                               <p class="form-control-static" name="deskripsi"><?php echo $document->deskripsi?> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Status Dokumen</label>
                                            <div class="col-lg-8">
                                                <p class="form-control-static" name="status">
                                                    <?php foreach ($status as $s) {
                                                        if ($s->id_status === $document->id_status) 
                                                               echo  $s->nama_status;
                                                        } ?>
                                                </p>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class=" col-lg-3 control-label">Kategori</label>
                                            <div class="col-lg-8">
                                                 <p class="form-control-static" class="authors">
                                                    <?php foreach ($kategoris as $s) {
                                                         if (in_array($s->id_kategori, $get_kategori))
                                                            echo $s->nama_kategori.'<br/>';
                                                    } ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class=" col-lg-3 control-label">Departemen</label>
                                            <div class="col-lg-8">
                                                 <p class="form-control-static" class="authors">
                                                    <?php foreach ($departemens as $s) {
                                                         if (in_array($s->id_departemen, $get_departemen))
                                                            echo $s->nama_departemen.'<br/>';
                                                    } ?>
                                                </p>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-lg-3  control-label">Versi Terakhir Dokumen</label>
                                        <div class="col-lg-8">
                                                <p class="form-control-static" name="version"><?php echo $version?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-head">
                                <h3>Enroll</h3>
                            </div> 
                            <div class="panel-body">
                                <div class="form">
                                    <div class="form-group">
                                        <label class="col-lg-3  control-label">Drafter</label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static" class="authors">
                                                <?php foreach ($users as $s) {
                                                    if (in_array($s->id_akun, $drafters))
                                                        echo $s->nama.'<br/>';
                                                } ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3  control-label">Reviewer</label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static" class="reviewer">
                                                <?php foreach ($users as $s) {
                                                    if (in_array($s->id_akun, $reviewers))
                                                        echo $s->nama.'<br/>';
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3  control-label">Approval</label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static" class="editors">
                                                <?php foreach ($users as $s) {
                                                    if (in_array($s->id_akun, $approvals))
                                                        echo $s->nama.'<br/>';
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div id="review" class="tab-pane">
                            <div class="border-head">
                                <h3>Daftar Review</h3>
                            </div> 
                            <div class="panel-body">
                                <?php foreach ($reviews as $rev)
                                {?>
                                <blockquote class="clearfix">
                                    <p>
                                        <?php echo $rev->isi_review ?>
                                    </p>
                                    <small class="text-right">Direview oleh <?php echo $rev->nama_akun?> (<i><?php echo $rev->tanggal_review?></i>)</small>
                                </blockquote>
                                <hr>
                                <?php } ?>
                            </div>
                        </div>
                        <div id="file" class="tab-pane">
                            <div class="border-head">
                                <h3>Daftar Dokumen</h3>
                            </div> 
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
                                            <button type="button" class="btn btn-default btn-xs " 
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
                            <div class="border-head">
                                <h3>Daftar Lampiran</h3>
                            </div> 
                            <div class="panel-body minimal">
                                <div class="table-inbox-wrap ">
                                <table class="table table-inbox table-hover">
                                <tbody>
                                    <?php    
                                    foreach ($lampiran as $file) {?>
                                        <tr class="unread">
                                            <td>></td>
                                            <td class="view-message  dont-show">
                                                <a href="<?php echo base_url().'file/downloadFileReferensi?id_doc='.$file->id_dokumen.
                                                        '&id_file='.$file->nama_file?>"><?php echo $file->nama_file?>
                                                </a>
                                            </td>
                                            <td class="view-message  text-right"><?php echo $file->tanggal_file?></td>
                                            <td>
                                            <button type="button" class="btn btn-default btn-xs " 
                                                    onclick="window.location='<?php echo base_url().'file/downloadFileReferensi?id_doc='.$file->id_dokumen.
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
                            
                        </div>
                        <div id="log" class="tab-pane">
                            <ul>
                            <?php foreach ($logs as $log)
                            {?>
                            
                                <li><?php echo $log->keterangan_log?> | by <b class="small"><?php echo AkunFactory::Instance()->getNameAkun($log->id_user_log)?></b> ( <i class="small"><?php echo $log->tanggal_log ?></i> ) </li>
                            
                            <?php }?>
                                </ul>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-center" id="nestable_list_menu">
            <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'documents/'?>'">Back</button>
        </div>
    </div>
</div>
</form>
<!-- page end-->