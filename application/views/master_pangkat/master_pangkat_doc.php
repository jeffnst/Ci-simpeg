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
        <h2>Master_pangkat List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Pangkat</th>
		<th>Golongan</th>
		<th>Ruang</th>
		
            </tr><?php
            foreach ($master_pangkat_data as $master_pangkat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $master_pangkat->nama_pangkat ?></td>
		      <td><?php echo $master_pangkat->golongan ?></td>
		      <td><?php echo $master_pangkat->ruang ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>