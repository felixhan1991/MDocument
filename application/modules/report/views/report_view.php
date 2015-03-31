<p style="text-align: center;"><img src="<?= base_url().'application/themes/default/views/images/logo.png' ?>" width="250px" height="80px"alt="logo"/></p>
        <p style="border-bottom: 3px solid black;"></p>
            <div id="toolButton" class="btn-group pull-right">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#" onclick="window.print()">Print</a></li>
                        <li><a href="#" onclick="window.open('<?= site_url('report/exportToPDF?id='.$id_time.'&val1='.$time_start.'&val2='.$time_end)?>','_blank')">Save as PDF</a></li>
                        <li><a href="#" onclick="window.open('<?= site_url('report/exportToExcel?id='.$id_time.'&val1='.$time_start.'&val2='.$time_end)?>','_blank')">Export to Excel</a></li>
                    </ul>
                </div>
            <br/>
            <h3 style="text-align: center">Data Dokumen<br/><?= $ket ?></h3>
            <?php if($state==='List'){?>
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
                    //var_dump($res->nama_departemen);
                    foreach ($res->nama_departemen as $dep)
                    {
                        echo $dep.', ';
                    }
                    ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <?} else if ($state==='departemen') { ?>
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
            <div class="col-lg-8">
            <div id="graph-bar"></div>
                </div>
            <?php } else { ?>
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
            <div class="col-lg-8">
            <div id="graph-bar"></div>
                </div>
        <?php } ?>