<!DOCTYPE html>
<html>
<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Master_Biro.xls");
?>
 <table border="1" id="tabel_dpt" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>No. Urut Biro</th>
                        <th>Kode Biro</th>
                        <th>Nama Biro</th>
                      
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php
		$no=1;
		foreach ($output->result() as $row ) {		?>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->urut_biro ;?></td>
                        <td><?php echo $row->kode_biro ;?></td>
                        <td><?php echo $row->nama_biro ;?></td>
                        
                      </tr>
                     <?php } ;?>
                    </tbody>
                    
                  </table>