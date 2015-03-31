<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="<?php echo base_url().'dashboard'?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Direktori Saya</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url().'job/'?>">Pekerjaan Saya</a></li>
                        <li><a href="<?php echo base_url().'drive/'?>">Dokumen Saya</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url().'library/'?>">
                        <i class="fa fa-briefcase"></i>
                        <span>Pustaka Dokumen</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Administrasi Dokumen</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url().'documents/'?>">Daftar Dokumen</a></li>
                        <li><a href="<?php echo base_url().'documents/formulir'?>">Tambah Dokumen</a></li>
                        <li><a href="<?php echo base_url().'documents/trash'?>">Arsip</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-rss"></i>
                        <span>Referensi</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo base_url().'status/'?>">Status</a></li>
                        <li><a href="<?php echo base_url().'kategori/'?>">Kategori</a></li>
                    </ul>
                </li>
                
                 <li>
                    <a href="<?php echo base_url().'hakakses'?>">
                        <i class="fa fa-key"></i>
                        <span>Hak Akses</span>
                    </a>
                   
                </li>
                
                
                <li>
                    <a href="<?php echo site_url('dashboard/logout') ?>">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
                
                
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
