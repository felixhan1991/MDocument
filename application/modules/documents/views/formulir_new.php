<script>
function test()    
{
    var url =window.location.protocol.concat("//");
    url = url.concat(window.location.hostname);
    var url2= window.location.pathname;
    var port= window.location.port;
    url = url.concat(":");
    url = url.concat(port);
    url = url.concat("/");
    var res = url2.split("/");
    url = url.concat(res[1]);
    
    var data = document.getElementById('form');
    console.log(data.value);
    if (data.value==="1 | Dokumen Komplain")
    {
        $.ajax({
            type: "get",
            url: url,
            cache: false,				
            data: {
              id:options.params.id
            },
            success: function(json){						
            try{		
                    var obj = jQuery.parseJSON(json);
                    console.log(obj);
                    document.getElementById('result_panel').innerHTML = obj.docs;
                    var list = obj.list;
                    list.forEach(function(entry) {
                        data1.push({ name: entry.nama_kategori+' <div class="tree-actions"></div>', type: 'folder', params: { id: entry.id_kategori } });
                    });
            }catch(e) {		
                e.toString();
                    alert('Exception while request..');
            }		
            },
            async: false,
            error: function(){						
                    alert('Error while request..');
            }
        });
        document.getElementById('result_panel').innerHTML ='1';
    }
    else if (data.value==="2 | Surat Jalan")
    {
        document.getElementById('result_panel').innerHTML='2';
    }
    
}
</script>
<form class="cmxform form-horizontal " enctype="multipart/form-data" id="commentForm" method="post" action="<?php echo base_url().'documents/form'?>">
<div class="row">
        <div class="col-lg-12">
            <div class="text-right" id="nestable_list_menu">
                <input class="btn btn-success" type="submit" value="Save"/>
                <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'documents/'?>'">Cancel</button>
            </div>
        </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="border-head">
                        <h3>Buat Dokumen</h3>
                        <label class="col-lg-12 control-label" style="text-align: left"><?php echo validation_errors()?></label>
                        
                    </div>                   
                </div>
            </div>
            <br>
<div class="row">
        <div class="col-lg-12">

            <section class="panel">
                <header class="panel-heading">
                    Data Dokumen
                    
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                     </span>
                </header>
                
                <div class="panel-body">
                    
                    <div class="form">
                            <div class="form-group ">
                                <label for="firstname" class="control-label col-lg-3">Tanggal</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static" id="timeDiv" name="tanggal"></p>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="lastname" class="control-label col-lg-3">Pilih Template Dokumen</label>
                                <div class="col-lg-8">
                                    <select id="form" class="form-control m-bot15" onchange="test();">
                                        <option>1 | Dokumen Komplain</option>
                                        <option>2 | Surat Jalan</option>
                                        <option>3 | Dokumen Penerimaan Barang</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
                        
            </section>
            
            
                <section class="panel" id="result_panel">
            
                    <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Kode Dokumen  </label>
                                <div class="controls col-lg-8">
                                    <input class="form-control" type="text" data-mask="***/**/*/****" placeholder="SST/02/2/2015"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Kepada </label>
                                <div class="controls col-lg-8">
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Perihal</label>
                                <div class="controls col-lg-8">
                                    <input class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Latar Belakang</label>
                                <div class="controls col-lg-8">
                                    <textarea class="form-control" rows="6"></textarea>`
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3">Keperluan</label>
                                <div class="controls col-lg-8">
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-lg-3">Penutup</label>
                                <div class="controls col-lg-8">
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        <div class="form-group">
                                <label class="col-lg-3  control-label">Disetujui oleh</label>
                                <div class="col-lg-8">
                                    <select multiple name="drafter[]" id="author" style="min-width:300px" class="populate" required>
                                        <?php foreach ($users as $s) {?>
                                            <option value="<?php echo $s->id_akun?>"><?php echo $s->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                </section>
                
        </div>
    </div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-center" id="nestable_list_menu">
            <button class="btn btn-success" type="submit">Save</button>
            <button class="btn btn-default" type="button" onclick="window.location='<?php echo base_url().'documents/'?>'">Cancel</button>
        </div>
    </div>
</div>
</form>

            <!-- page end-->