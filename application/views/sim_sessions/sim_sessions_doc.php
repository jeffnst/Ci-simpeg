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
        <h2>Sim_sessions List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>Ip Address</th>
		<th>Timestamp</th>
		<th>Data</th>
		
            </tr><?php
            foreach ($sim_sessions_data as $sim_sessions)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sim_sessions->id ?></td>
		      <td><?php echo $sim_sessions->ip_address ?></td>
		      <td><?php echo $sim_sessions->timestamp ?></td>
		      <td><?php echo $sim_sessions->data ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>