
<?php 
    $success_message=$this->session->flashdata('message');
    if ($success_message) { ?> 
<div class="alert alert-warning fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <strong>Info!</strong> <?php echo $success_message?>
</div>
    <?php }
?>

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
                        
                        <div class="btn-group">
                            <button class="btn btn-primary" onclick="window.location='<?php echo base_url().'documents/form' ?>'">
                                Tambah Dokumen <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-hover table-bordered" id="dynamic-table-draft">
                    <thead>
                    <tr >
                        <th class="center"></th>
                        <th class="center">Kode Dokumen</th>
                        <th class="center hidden-phone">Judul</th>
                        <th class="center">Waktu Pembuatan</th>
                        <th class="center">Version</th>
                        <th class="class hidden-phone">Status</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                        
                    <?php foreach ($documents as $doc) {?>
                    <tr class="gradeC">
                        <td >        
                         
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <?php  if ($doc->id_status==5) {?>
                                    <li ><a href="#" onclick="window.location='<?php echo base_url().'documents/done/'.$doc->id_dokumen?>'" ><i class="fa fa-check"></i> Siap dipublikasikan!</a></li>
                                    <?php } ?>
                                    
                                    <li class="divider"></li>
                                    <?php if ($doc->id_status!=6 && $doc->id_status!=5) { ?>
                                    <li><a href="#" onclick="window.location='<?php echo base_url().'documents/form/edit/'.$doc->id_dokumen?>'"><i class="fa fa-refresh"></i> Update</a></li>
                                    <?php } ?>
                                    <li> <a href="#" onclick="window.location='<?php echo base_url().'documents/form/view/'.$doc->id_dokumen?>'"><i class="fa fa-eye"></i> View </a></li>
                                    <li> <a href="#" onclick="window.location='<?php 
                                        if ($doc->getlastfile===""|| $doc->getlastfile==null) echo '#';
                                        else {
                                            echo base_url().'file/downloadFile?id_doc='.$doc->id_dokumen.
                                                    '&id_file='.$doc->getlastfile;
                                        }; ?>'">
                                        <i class="fa fa-cloud-download"></i> Download
                                    </a></li>
                                    <li><a href="#" onclick="window.location='<?php echo base_url().'documents/sendToTrash/'.$doc->id_dokumen?>'"><i class="fa fa-trash-o"></i>Archive</a></li>
                                </ul>
                            </div>
                         
                        </td>
                        <td><?php echo $doc->no_serial?></td>
                        <td><?php echo $doc->nama_dokumen?></td>
                        
                        <td><?php echo $doc->tanggal_dokumen?></td>
                        <td><?php echo $doc->getversiondok?></td>
                        
                        
                        <td class="center hidden-phone"><?php echo $doc->nama_status?></td>
                       

                    </tr>
                    <?php } ?>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>
