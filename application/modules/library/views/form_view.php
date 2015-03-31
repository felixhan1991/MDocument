<form class="cmxform form-horizontal " enctype="multipart/form-data"  id="commentForm"  action="">

<div class="row">
        <div class="col-lg-12">
        <!--tab nav start-->
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#home">Dokumen</a>
                        </li>
                      
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="home" class="tab-pane active">
                            <div class="panel-body">
                                <?php  $url=base_url()."ViewerJS/#../".$urlView?>
                                   <iframe src="<?php echo $url?>" 
                                           style="width:100%; height:450px;" frameborder="0" allowfullscreen webkitallowfullscreen></iframe>
                            </div>
                            
                             <div class="panel-body">
                                <div class="border-head">
                                   <h3>Rincian</h3>
                                </div> 
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
                                </div>
                             </div>
                            
                        </div>
                        
                        
                      
                    </div>
                </div>
            </section>
            <!--tab nav start-->            
        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-center" id="nestable_list_menu">
            <button class="btn btn-warning" type="button" onclick="window.location='<?php echo base_url().'drive/add/'.$document->id_dokumen?>'">My Favorite!</button>
            <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'library/'?>'">Back</button>
        </div>
    </div>
</div>
</form>
<!-- page end-->