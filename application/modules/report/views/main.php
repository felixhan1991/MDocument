
<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       Statistik Dokumen
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <?php if($sub_state === 'Waktu'){ ?>
                        <form class="cmxform form-horizontal" method="post" action="<?php site_url('report/pengaduan_waktu')?>">
                            <?= $errormess ?>
                            <h3>Select Time Interval</h3>
                            <div class="form-group">
                            <div class="col-lg-2">
                            <select name="time" onchange="changeInterval(this.selectedIndex)" class="form-control">
                                <option value="1" selected="">By Year</option>
                                <option value="2">By Month</option>
                                <option value="3">By Day</option>
                            </select>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-lg-1">From</label>
                            <div class="col-lg-2" id="startDate">
                                <input id="start1" style="display:none;" class="form-control form-control-inline input-medium default-date-picker dp4" name="start1" size="16" type="text" value="" />
                            <select id="start" name="start" class="form-control">
                                <?php foreach($years as $year){ ?>
                                <option value="<?= $year->parameter_dokumen; ?>"><?= $year->parameter_dokumen; ?></option>
                                <?php } ?>
                            </select>
                                <span class="help-block">Pilih waktu</span>
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-lg-1">To</label>
                            <div class="col-lg-2" id="endDate">
                                <input id="end1" style="display: none;" class="form-control form-control-inline input-medium default-date-picker dp5" name="end1" size="16" type="text" value="" />
                            <select id="end" name="end" class="form-control">
                                <?php foreach($years as $year){ ?>
                                <option value="<?= $year->parameter_dokumen; ?>"><?= $year->parameter_dokumen; ?></option>
                                <?php } ?>
                            </select>
                                <span class="help-block">Pilih waktu</span>
                            </div>
                            </div>
                            <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                            </div>
                        </form>
                        <br/>
                        <?php } else if($sub_state==='List'){ ?>
                        <form class="cmxform form-horizontal" method="post" action="<?php base_url('report')?>">
                            <?= $errormess ?>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-lg-2">Date Range</label>
                                <div class="col-lg-4">
                                    <div class="input-group input-large" >
                                        <input type="text" class="form-control dpd1" data-date-format="dd-mm-yyyy" name="start">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" data-date-format="dd-mm-yyyy" name="end">
                                    </div>
                                    <span class="help-block">Select date range</span>
                                </div>
                            </div>
                            
                            <div class="form-group ">
                                        <label class="control-label col-lg-2">Status</label>
                                        <div class="col-lg-6 ">
                                            <select multiple name="statuses[]" id="status" style="min-width:300px" class="populate">
                                                <?php foreach ($stats as $stat) { ?>
                                                       <option value="<?php echo $stat->id_status?>"><?php echo $stat->nama_status?></option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                            </div>
                            <div class="form-group ">
                                        <label class="control-label col-lg-2">Kategori</label>
                                        <div class="col-lg-6">
                                            <select multiple name="cats[]" id="kategori" style="min-width:300px" class="populate">
                                                <?php foreach ($kategoris as $kategori) { ?>
                                                        <option value="<?php echo $kategori->id_kategori?>"><?php echo $kategori->nama_kategori?></option>
                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                            </div>
                            <div class="form-group ">
                                        <label class="control-label col-lg-2">Departemen</label>
                                        <div class="col-lg-2">
                                            <select multiple name="departemens[]"id="departemen" style="min-width:300px" class="populate">
                                                <?php foreach ($depts as $dept) {?>
                                                    <option value="<?php echo $dept->id_departemen?>"><?php echo $dept->nama_departemen?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                            <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                            </div>
                        </form>
                        <br/>
                        <?php } ?>
                        <?php if(!empty($results) && $sub_state==='List'){ ?>
                        <div class="btn-group pull-right">
                            <button class="btn btn-default" onclick="window.open('<?= base_url('report/viewReport?id='.$url)?>', '_blank');">View
                                    </button>
                                </div>
                        <div>
                            <br/>
                            <table class=" table table-bordered">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>    
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Departemen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($results as $res){ ?>
                                <tr>
                                    <td><?= $res->no_serial; ?></td>
                                    <td><?= $res->nama_dokumen; ?></td>
                                    
                                    <td><?= $res->tanggal_dokumen; ?></td>
                                    
                                    <td><?= $res->nama_status; ?></td>
                                    <td><?php
                                    
                                    foreach ($res->nama_departemen as $dep)
                                    {
                                        echo $dep.', ';
                                    }
                                    ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php } else if(!empty($results) && $sub_state=='Departemen') { ?>
                            
                        <div class="btn-group pull-right">
                            <button class="btn btn-default" onclick="window.open('<?= site_url('report/viewReport?id='.$url)?>', '_blank');">View
                                    </button>
                                </div>
                        <div>
                            <br/>
                            <table class=" table table-bordered">
                                <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Departemen</th>
                                    <th>Jumlah Dokumen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($results as $res){ ?>
                                <tr>
                                    <td><?= $res->parameter_dokumen?></td>
                                    <td><?= AkunFactory::Instance()->getNameDepartemen($res->parameter_dokumen); ?></td>
                                    <td><?= $res->jumlah; ?></td>
                                    
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        
                            <br/>
                        <div id="graph-bar"></div>
                        </div>
                            <?php } else if(!empty($results)) { ?>
                            
                        <div class="btn-group pull-right">
                            <button class="btn btn-default" onclick="window.open('<?= site_url('report/viewReport?id='.$url)?>', '_blank');">View
                                    </button>
                                </div>
                        <div>
                            <br/>
                            <table class=" table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Jumlah Dokumen </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($results as $res){ ?>
                                <tr>
                                    <td><?= $res->parameter_dokumen; ?></td>
                                    <td><?= $res->jumlah; ?></td>
                                    
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        
                            <br/>
                        <div id="graph-bar"></div>
                        </div>
                        <?php } else if($id_time==='1'||$id_time==='2'||$id_time==='3') { echo 'Hasil tidak ditemukan';} ?>
                    </div>
                    </div>
                </section>
            </div>
        </div>
