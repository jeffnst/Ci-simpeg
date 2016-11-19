

<?php 

header("Content-Disposition: attachment; filename=Master_pangkat.xls");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
?>
 <table border="1" id="tabel" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Pangkat</th>
                        <th>Golongan</th>
                        <th>Ruang</th>
                        <th>Level</th>
                      
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php
		$no=1;
		foreach ($excel->result() as $row ) {		?>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->nama_pangkat ;?></td>
                        <td><?php echo $row->golongan ;?></td>
                        <td><?php echo $row->ruang ;?></td>
                        <td><?php echo $row->level_pangkat ;?></td>
                        
                      </tr>
                     <?php } ;?>
                    </tbody>
                    
                  </table>