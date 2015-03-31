
<?php 
    $success_message=$this->session->flashdata('messageJob');
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
                <label class="col-lg-12 control-label" style="text-align: left">
                            
                </label>
                <section class="panel">
                    <header class="panel-heading">
                        Draft Dokumen
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-hover table-bordered" id="dynamic-table-draft">
                    <thead>
                    <tr >
                        <th class="center"></th>
                        <th class="center hidden-phone">Judul</th>
                        <th class="center">Waktu Pembuatan</th>
                        <th class="class hidden-phone">Versi</th>
                        <th class="center">Departemen</th>
                        <th class="center">Kategori</th>
                        
                    </tr>
                    </thead>
                    <tbody> 
                        
                    <?php foreach ($drafts as $doc) {?>
                    <tr class="gradeC">
                        <td >        
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li ><a href="#" onclick="window.location='<?php echo base_url().'job/draft/finishDraft/'.$doc->id_dokumen?>'" ><i class="fa fa-check"></i> Finish Draft!</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" onclick="window.location='<?php echo base_url().'job/draft/index/'.$doc->id_dokumen?>'"><i class="fa fa-refresh"></i> Update</a></li>
                                    <li> <a href="#" onclick="window.location='<?php echo base_url().'job/view/index/'.$doc->id_dokumen?>'"><i class="fa fa-eye"></i> View </a></li>
                                    <li> <a href="#" onclick="window.location='<?php 
                                        if ($doc->getlastfile===""|| $doc->getlastfile==null) echo '#';
                                        else {
                                            echo base_url().'file/downloadFile?id_doc='.$doc->id_dokumen.
                                                    '&id_file='.$doc->getlastfile;
                                        }; ?>'">
                                        <i class="fa fa-cloud-download"></i> Download
                                    </a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $doc->nama_dokumen?></td>
                        <td><?php echo $doc->tanggal_dokumen?></td>
                        <td><?php echo $doc->getversiondok?></td>
                        <td><?php echo AkunFactory::Instance()->getNameDepartemen($doc->getdepartemen);?></td>
                        <td><?php print_r (AkunFactory::Instance()->getNameKategori($doc->getkategori));?></td>
                        
                    </tr>
                    <?php } ?>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                </section>
                
                 <section class="panel">
                    <header class="panel-heading">
                        Review Dokumen
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-hover table-bordered" id="dynamic-table-review">
                    <thead>
                    <tr >
                        <th class="center"></th>
                        <th class="center hidden-phone">Judul</th>
                        <th class="center">Waktu Pembuatan</th>
                        
                        <th class="class hidden-phone">Versi</th>
                        <th class="center">Departemen</th>
                        <th class="center">Kategori</th>
                    </tr>
                    </thead>
                    <tbody> 
                        
                    <?php foreach ($reviews as $doc) {?>
                    <tr class="gradeC">
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li ><a href="#" onclick="window.location='<?php echo base_url().'job/review/finishreview/'.$doc->id_dokumen?>'" ><i class="fa fa-check"></i> Finish Review!</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" onclick="window.location='<?php echo base_url().'job/review/index/'.$doc->id_dokumen?>'"><i class="fa fa-ban"></i>Revisi Dokumen</a></li>
                                    <li> <a href="#" onclick="window.location='<?php echo base_url().'job/view/index/'.$doc->id_dokumen?>'"><i class="fa fa-eye"></i> View </a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $doc->nama_dokumen?></td>
                        <td><?php echo $doc->tanggal_dokumen?></td>
                        <td><?php echo $doc->getversiondok?></td>
                        <td><?php echo AkunFactory::Instance()->getNameDepartemen($doc->getdepartemen);?></td>
                        <td><?php print_r (AkunFactory::Instance()->getNameKategori($doc->getkategori));?></td>
                    </tr>
                    <?php } ?>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                </section>
                 
                <section class="panel">
                    <header class="panel-heading">
                        Approval Dokumen
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-hover table-bordered" id="dynamic-table-approval">
                    <thead>
                    <tr >
                        <th class="center"></th>
                        <th class="center hidden-phone">Judul</th>
                        <th class="center">Waktu Pembuatan</th>
                        <th class="class hidden-phone">Versi</th>
                        <th class="center">Departemen</th>
                        <th class="center">Kategori</th>
                        
                    </tr>
                    </thead>
                    <tbody> 
                        
                    <?php foreach ($approvals as $doc) {?>
                    
                    <tr class="gradeC">
                        <td>
                        <div class="btn-group">
                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " role="menu">
                                <li ><a href="#" onclick="window.location='<?php echo base_url().'job/approve/index/'.$doc->id_dokumen?>'" ><i class="fa fa-check"></i> Approve!</a></li>
                                <li class="divider"></li>
                                <li> <a href="#" onclick="window.location='<?php echo base_url().'job/view/index/'.$doc->id_dokumen?>'"><i class="fa fa-eye"></i> View </a></li>
                                <li> <a href="#" onclick="window.location='<?php 
                                        if ($doc->getlastfile===""|| $doc->getlastfile==null) echo '#';
                                        else {
                                            echo base_url().'file/downloadFile?id_doc='.$doc->id_dokumen.
                                                    '&id_file='.$doc->getlastfile;
                                        }; ?>'">
                                        <i class="fa fa-cloud-download"></i> Download
                                    </a></li>
                            </ul>
                        </div>
                        </td>
                        <td><?php echo $doc->nama_dokumen?></td>
                        <td><?php echo $doc->tanggal_dokumen?></td>
                         <td><?php echo $doc->getversiondok?></td>
                         <td><?php echo AkunFactory::Instance()->getNameDepartemen($doc->getdepartemen);?></td>
                        <td><?php print_r (AkunFactory::Instance()->getNameKategori($doc->getkategori));?></td>
                    </tr>
                    <?php } ?>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>