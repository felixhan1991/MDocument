
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
                        <th class="class hidden-phone">Versi</th>
                        <th class="class hidden-phone">Status</th>
                        <th class="center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    <?php foreach ($documents as $doc) {?>
                    <tr class="gradeC">
                        <td><?php echo $doc->nama_dokumen?></td>
                        <td><?php echo $doc->tanggal_dokumen?></td>
              
                        <td class="center hidden-phone">      
                            <?php echo $doc->getversiondok; ?>
                        </td></td>
                        <td class="center hidden-phone"><?php echo $doc->nama_status?></td>
                        <td class="center">        
                            <button type="button" class="btn btn-success btn-xs" onclick="window.location='<?php echo base_url().'documents/sendToDraft/'.$doc->id_dokumen?>'"><i class="fa fa-power-off"></i>Active</button>
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