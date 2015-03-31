

<div class="row">

      
    <!--notification start-->
    <div class="col-md-6">
    <section class="panel">
        <header class="panel-heading">
            To Do List
        </header>
        <div class="panel-body">
            <div class="alert alert-info clearfix">
                <span class="alert-icon"><i class="fa fa-pencil"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender">Terdapat <span><a href="#"><?php echo count($draftDoc);?></a></span> dokumen yang harus Anda buat</li>
                    </ul>
                    <p>
                        <a href="<?php echo base_url().'job/'?>">Harap cek Draft Dokumen Anda!</a>
                    </p>
                </div>
            </div>
            <div class="alert alert-danger">
                <span class="alert-icon"><i class="fa fa-search"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender">Terdapat <span><a href="#"><?php echo count($reviewDoc);?></a></span> dokumen yang harus direview</li>
                    </ul>
                    <p>
                        <a href="<?php echo base_url().'job/'?>">Harap cek Review Dokumen Anda!</a>
                    </p>
                </div>
            </div>
            <div class="alert alert-success ">
                <span class="alert-icon"><i class="fa fa-check-circle-o"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender">Kamu mendapatkan <span><a href="#"> <?php echo count($approveDoc); ?></a></span> dokumen yang harus di-approve</li>
                    </ul>
                    <p>
                        <a href="<?php echo base_url().'job/'?>">Harap cek Approval Dokumen Anda!</a>
                    </p>
                </div>
            </div>
            <div class="alert alert-warning ">
                <span class="alert-icon"><i class="fa fa-folder-o"></i></span>
                <div class="notification-info">
                    <ul class="clearfix notification-meta">
                        <li class="pull-left notification-sender">Anda memiliki <?php echo $num_fav ?> dokumen pada Dokumen Favorit Anda</li>
                    </ul>
                    <p>
                        <a href="<?php echo base_url().'drive/'?>">Silahkan akses dokumen Anda!</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    </div>
     <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon orange"><i class="fa fa-book"></i></span>
                <div class="mini-stat-info">
                    <span><?php echo $num_release?></span>
                    New Document Release
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon tar"><i class="fa fa-share-square-o"></i></span>
                <div class="mini-stat-info">
                    <span><?php echo $num_shared?></span>
                    Document Shared
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mini-stat clearfix">
                <div align="center">
                    <button class="btn btn-info btn-lg"  type="button" onclick="window.location='<?php echo base_url().'documents/form' ?>'">
                     <i class="fa fa-plus"></i> Buat Dokumen Baru Sekarang!
                 </button>
                </div>
            </div>
        </div>
    
            
</div>

<!--mini statistics end-->



