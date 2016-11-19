
    <h1 style="font-size:20pt">Tabel Master Biro</h1>

    <h3></h3>
    <br />
    <button class="btn btn-success btn-raised btn-sm" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
    <button class="btn btn-primary btn-raised btn-sm" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
    <button class="btn btn-info btn-raised btn-sm" onclick="import_excel()"><i class=" fa fa-file-excel-o"></i> Import Excel</button>
    <a href= "<?php echo base_url('master_biro/export_excel') ?>" class="btn btn-warning btn-raised btn-sm"><i class="fa fa-file-excel-o"></i> Export Excel</a>
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>

                <th>No.Urut Biro</th>
                <th>Kode Biro</th>
                <th>Nama Biro</th>
                <th style="width:125px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>

        <tfoot>
        <tr>

          <th>No. Urut Biro</th>
          <th>Kode Biro</th>
          <th>Nama Biro</th>
          <th>Aksi</th>
        </tr>
        </tfoot>
    </table>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Form Master Data Biro</h3>
        </div>
        <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="id"/>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">No. Urut</label>
                        <div class="col-md-9">
                            <input name="urut_biro" placeholder="No. Urut Biro" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Kode Biro</label>
                        <div class="col-md-9">
                            <input name="kode_biro" placeholder="Kode Biro" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Nama Biro</label>
                        <div class="col-md-9">
                            <input name="nama_biro" placeholder="Nama Biro" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>


                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-raised">Save</button>
            <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!-- Bootstrap modal import excel -->
<div class="modal fade" id="modal_excel" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Import Data Biro</h3>
        </div>
        <div class="modal-body form">
            <form method="post" action="<?php echo site_url('master_biro/upload'); ?>" id="excel" name="file" class="form-horizontal" enctype="multipart/form-data">
              <input type="file" name="userfile" id="userfile"/>
             
        </div>
        <div class="modal-footer">
            <button type="submit" value="submit" name="submit" id="submit" class="btn btn-primary btn-raised" data-dismiss="modal">Submit</button>
            <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Cancel</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
