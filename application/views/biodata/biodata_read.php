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
        <h2 style="margin-top:0px">Biodata Read</h2>
        <table class="table">
	    <tr><td>Nip</td><td><?php echo $nip; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Pob</td><td><?php echo $pob; ?></td></tr>
	    <tr><td>Dob</td><td><?php echo $dob; ?></td></tr>
	    <tr><td>Agama</td><td><?php echo $agama; ?></td></tr>
	    <tr><td>Ktp</td><td><?php echo $ktp; ?></td></tr>
	    <tr><td>Paspor</td><td><?php echo $paspor; ?></td></tr>
	    <tr><td>Alamat Ktp</td><td><?php echo $alamat_ktp; ?></td></tr>
	    <tr><td>Alamat Akhir</td><td><?php echo $alamat_akhir; ?></td></tr>
	    <tr><td>Pangkat</td><td><?php echo $pangkat; ?></td></tr>
	    <tr><td>Tmt Pangkat</td><td><?php echo $tmt_pangkat; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Tmt Jabatan</td><td><?php echo $tmt_jabatan; ?></td></tr>
	    <tr><td>Masa Kerja</td><td><?php echo $masa_kerja; ?></td></tr>
	    <tr><td>Last Update</td><td><?php echo $last_update; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('biodata') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>