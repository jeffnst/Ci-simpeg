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
        <h2 style="margin-top:0px">Master_jabatan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Jabatan <?php echo form_error('nama_jabatan') ?></label>
            <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $nama_jabatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Jabatan <?php echo form_error('jenis_jabatan') ?></label>
            <input type="text" class="form-control" name="jenis_jabatan" id="jenis_jabatan" placeholder="Jenis Jabatan" value="<?php echo $jenis_jabatan; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master_jabatan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>