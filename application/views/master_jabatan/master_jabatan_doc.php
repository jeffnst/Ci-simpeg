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
        <h2>Master_jabatan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Jabatan</th>
		<th>Jenis Jabatan</th>
		
            </tr><?php
            foreach ($master_jabatan_data as $master_jabatan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $master_jabatan->nama_jabatan ?></td>
		      <td><?php echo $master_jabatan->jenis_jabatan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>