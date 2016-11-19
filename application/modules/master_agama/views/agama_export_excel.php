<!DOCTYPE html>
<html>
<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Master_Agama.xls");
?>
 <table border="1" id="tabel_dpt" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Agama</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php
		$no=1;
		foreach ($output->result() as $row ) {		?>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->agama ;?></td>
                        
                      </tr>
                     <?php } ;?>
                    </tbody>
                    
                  </table>