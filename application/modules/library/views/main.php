
<?php 
    $success_message=$this->session->flashdata('messageLib');
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
    <div class="col-sm-3">
        <section class="panel">
            <div class="panel-body">
                <div id="FlatTree2" class="tree">
                    <div class = "tree-folder" style="display:none;">
                        <div class="tree-folder-header">
                            <i class="fa fa-folder"></i>
                            <div class="tree-folder-name"></div>
                        </div>
                        <div class="tree-folder-content"></div>
                        <div class="tree-loader" style="display:none"></div>
                    </div>
                    <div class="tree-item" style="display:none;">
                        <i class="tree-dot"></i>
                        <div class="tree-item-name"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

            <div  class="col-sm-9" >
                 <section class="panel">
                    <header class="panel-heading">
                        Perpustakaan Dokumen RSUD Dr. Soetomo
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                     <div id="result" class="panel-body">
                         
                     </div>
                 </section>
            </div>
</div>
