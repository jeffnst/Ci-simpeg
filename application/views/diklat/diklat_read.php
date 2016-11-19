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
        <h2 style="margin-top:0px">Diklat Read</h2>
        <table class="table">
	    <tr><td>Nama Diklat</td><td><?php echo $nama_diklat; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $jenis; ?></td></tr>
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('diklat') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>