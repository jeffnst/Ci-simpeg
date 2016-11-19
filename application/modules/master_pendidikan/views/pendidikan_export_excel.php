<!DOCTYPE html>
<html>
<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Master_Pendidikan.xls");
?>
 <table border="1" id="tabel" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Jenis Pendidikan</th>
                        <th>Kode</th>
                        <th>Level</th>
                      
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php
		$no=1;
		foreach ($output->result() as $row ) {		?>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->jenis_pendidikan ;?></td>
                        <td><?php echo $row->kode_pendidikan ;?></td>
                        <td><?php echo $row->level_pendidikan ;?></td>
                        
                      </tr>
                     <?php } ;?>
                    </tbody>
                    
                  </table>