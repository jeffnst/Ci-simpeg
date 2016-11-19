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
        <h2 style="margin-top:0px">Biodata <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nip <?php echo form_error('nip') ?></label>
            <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip" value="<?php echo $nip; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pob <?php echo form_error('pob') ?></label>
            <input type="text" class="form-control" name="pob" id="pob" placeholder="Pob" value="<?php echo $pob; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Dob <?php echo form_error('dob') ?></label>
            <input type="text" class="form-control" name="dob" id="dob" placeholder="Dob" value="<?php echo $dob; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Agama <?php echo form_error('agama') ?></label>
            <input type="text" class="form-control" name="agama" id="agama" placeholder="Agama" value="<?php echo $agama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ktp <?php echo form_error('ktp') ?></label>
            <input type="text" class="form-control" name="ktp" id="ktp" placeholder="Ktp" value="<?php echo $ktp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Paspor <?php echo form_error('paspor') ?></label>
            <input type="text" class="form-control" name="paspor" id="paspor" placeholder="Paspor" value="<?php echo $paspor; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat Ktp <?php echo form_error('alamat_ktp') ?></label>
            <input type="text" class="form-control" name="alamat_ktp" id="alamat_ktp" placeholder="Alamat Ktp" value="<?php echo $alamat_ktp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat Akhir <?php echo form_error('alamat_akhir') ?></label>
            <input type="text" class="form-control" name="alamat_akhir" id="alamat_akhir" placeholder="Alamat Akhir" value="<?php echo $alamat_akhir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pangkat <?php echo form_error('pangkat') ?></label>
            <input type="text" class="form-control" name="pangkat" id="pangkat" placeholder="Pangkat" value="<?php echo $pangkat; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tmt Pangkat <?php echo form_error('tmt_pangkat') ?></label>
            <input type="text" class="form-control" name="tmt_pangkat" id="tmt_pangkat" placeholder="Tmt Pangkat" value="<?php echo $tmt_pangkat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tmt Jabatan <?php echo form_error('tmt_jabatan') ?></label>
            <input type="text" class="form-control" name="tmt_jabatan" id="tmt_jabatan" placeholder="Tmt Jabatan" value="<?php echo $tmt_jabatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Masa Kerja <?php echo form_error('masa_kerja') ?></label>
            <input type="text" class="form-control" name="masa_kerja" id="masa_kerja" placeholder="Masa Kerja" value="<?php echo $masa_kerja; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Last Update <?php echo form_error('last_update') ?></label>
            <input type="text" class="form-control" name="last_update" id="last_update" placeholder="Last Update" value="<?php echo $last_update; ?>" />
        </div>
	    <input type="hidden" name="uid" value="<?php echo $uid; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('biodata') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>