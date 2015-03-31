<form class="cmxform form-horizontal " enctype="multipart/form-data"  id="commentForm" method="post" action="">
<div class="row">
        <div class="col-lg-12">
            <div class="text-right" id="nestable_list_menu">
                <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'job/draft/index/'.$document->id_dokumen?>'">Kembali</button>
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
                    <header class="panel-heading wht-bg">
                       Daftar Versi Dokumen
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
            
            
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       Lampiran Dokumen
                       <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                     </span>
                    </header>
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
                                           <button type="button" class="btn btn-danger btn-xs " 
                                            onclick="window.location='<?php echo base_url().'file/removeFileReferensi?link='.base_url().'job/draft/editFiles/'.$document->id_dokumen.'&id_doc='.$file->id_dokumen.
                                                '&nama_file='.$file->nama_file.'&id_file='.$file->id_file?>'">
                                        <i class="fa fa-times"></i> Delete</button>
                                    
                                    <button type="button" class="btn btn-info btn-xs " 
                                            onclick="window.location='<?php echo base_url().'file/downloadFileReferensi?id_doc='.$file->id_dokumen.
                                                '&id_file='.$file->nama_file?>'">
                                        <i class="fa fa-cloud-download"></i> Download</button>
                                    </td>
                                    
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
            <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'job/draft/index/'.$document->id_dokumen?>'">Kembali</button>
        </div>
    </div>
</div>
</form>

            <!-- page end-->