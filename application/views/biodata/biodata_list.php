<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Biodata List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('biodata/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('biodata/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('biodata'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nip</th>
		<th>Nama</th>
		<th>Pob</th>
		<th>Dob</th>
		<th>Agama</th>
		<th>Ktp</th>
		<th>Paspor</th>
		<th>Alamat Ktp</th>
		<th>Alamat Akhir</th>
		<th>Pangkat</th>
		<th>Tmt Pangkat</th>
		<th>Jabatan</th>
		<th>Tmt Jabatan</th>
		<th>Masa Kerja</th>
		<th>Last Update</th>
		<th>Action</th>
            </tr><?php
            foreach ($biodata_data as $biodata)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $biodata->nip ?></td>
			<td><?php echo $biodata->nama ?></td>
			<td><?php echo $biodata->pob ?></td>
			<td><?php echo $biodata->dob ?></td>
			<td><?php echo $biodata->agama ?></td>
			<td><?php echo $biodata->ktp ?></td>
			<td><?php echo $biodata->paspor ?></td>
			<td><?php echo $biodata->alamat_ktp ?></td>
			<td><?php echo $biodata->alamat_akhir ?></td>
			<td><?php echo $biodata->pangkat ?></td>
			<td><?php echo $biodata->tmt_pangkat ?></td>
			<td><?php echo $biodata->jabatan ?></td>
			<td><?php echo $biodata->tmt_jabatan ?></td>
			<td><?php echo $biodata->masa_kerja ?></td>
			<td><?php echo $biodata->last_update ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('biodata/read/'.$biodata->uid),'Read'); 
				echo ' | '; 
				echo anchor(site_url('biodata/update/'.$biodata->uid),'Update'); 
				echo ' | '; 
				echo anchor(site_url('biodata/delete/'.$biodata->uid),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('biodata/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('biodata/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>