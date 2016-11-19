<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Biodata List</h2>
        <table class="word-table" style="margin-bottom: 10px">
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
		
            </tr><?php
            foreach ($biodata_data as $biodata)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
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
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>