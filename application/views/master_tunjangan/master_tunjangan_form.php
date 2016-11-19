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
        <h2 style="margin-top:0px">Master_tunjangan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Tunjangan <?php echo form_error('nama_tunjangan') ?></label>
            <input type="text" class="form-control" name="nama_tunjangan" id="nama_tunjangan" placeholder="Nama Tunjangan" value="<?php echo $nama_tunjangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Nominal <?php echo form_error('nominal') ?></label>
            <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" value="<?php echo $nominal; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_tunjangan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>