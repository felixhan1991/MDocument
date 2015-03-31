
<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Daftar Dokumen
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-hover table-bordered" id="dynamic-table">
                    <thead>
                    <tr >
                        <th class="center hidden-phone">Judul</th>
                        <th class="center">Waktu Pembuatan</th>
                        <th class="center">Pembuat</th>
                        <th class="center">Departemen</th>
                        <th class="center">Kategori</th>
                        <th class="center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    <?php foreach ($documents as $doc) {?>
                    <tr class="gradeC">
                        <td><?php echo $doc->nama_dokumen?></td>
                        <td><?php echo $doc->tanggal_dokumen?></td>
                        
                        <td class="center hidden-phone">
                            <?php foreach ( $authors[$doc->id_dokumen]->author as $a) 
                            {
                                echo $a. ' ,';
                            }
                            ?>
                        </td>
                        <td><?php echo AkunFactory::Instance()->getNameDepartemen($doc->getdepartemen);?></td>
                        <td><?php print_r (AkunFactory::Instance()->getNameKategori($doc->getkategori));?></td>
                        
                        
                        <td class="center">        
                            <button type="button" class="btn btn-success btn-xs" onclick="window.location='<?php echo base_url().'drive/view/'.$doc->id_dokumen?>'"><i class="fa fa-eye"></i> View </button>
                        <button type="button" class="btn btn-default btn-xs " onclick="window.location='<?php 
                                    if ($authors[$doc->id_dokumen]->name_file ==='#') echo '#';
                                    else {
                                     echo base_url().'file/downloadFile?id_doc='.$doc->id_dokumen.
                                                '&id_file='.$authors[$doc->id_dokumen]->name_file;
                                    }; ?>'">
                                <i class="fa fa-cloud-download"></i> Download</button>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>