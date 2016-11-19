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
        <h2 style="margin-top:0px">Master_potongan Read</h2>
        <table class="table">
	    <tr><td>Nama Potongan</td><td><?php echo $nama_potongan; ?></td></tr>
	    <tr><td>Nominal</td><td><?php echo $nominal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('master_potongan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>