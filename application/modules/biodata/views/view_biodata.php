

        <h1 style="font-size:20pt">Tabel Biodata Pegawai </h1>

        <h3></h3>
        <br />
        <button class=" btn btn-raised btn-success btn-sm" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
        <button class="btn btn-raised btn-sm btn-primary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <button class="btn btn-raised btn-sm btn-info" onclick="import_excel()"><i class=" fa fa-file-excel-o"></i> Import Excel</button>
        <a href= "<?php echo base_url('biodata/export_excel') ?>" class="btn btn-raised btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Pangkat</th>
                    <th>Jabatan</th>
                    <th>Foto</th>
                    <th style="width:150px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Pangkat</th>
                    <th>Jabatan</th>
                    <th>Foto</th>
                    <th style="width:150px;">Action</th>

            </tr>
            </tfoot>
        </table>



    

<!-- Bootstrap modal -->
<div class="modal  fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form Biodata Pegawai</h4>
            </div>
            <div style="padding-left:15px;">
            <div class="modal-body form">
                <form action="#" id="form" class="bs-component">
                    <input type="hidden" value="" name="uid"/>
                    <div class="form-body">
                    
                    <div class="col-xs-8" style="padding-left:0px;">
                        <div class="form-group label-floating">
                            <label class="control-label" for="nip" >NIP Pegawai</label>
                                <input name="nip" id="nip"  class="form-control" type="text">
                                <span class="help-block"></span>
                        </div>
                    </div>

                        <div class="col-xs-4">
                        <div class="form-group label-floating">
                            <label class="control-label" for="masa_kerja" >Masa Kerja</label>
                                <input name="masa_kerja" id="masa_kerja"  class="form-control" type="text">
                                <span class="help-block"></span>
                        </div>

                    </div>
                        <div class="col-xs-3" style="padding-left:0px;">
                            <div class="form-group label-floating">
                            <label class="control-label" for="gelar_dpn" >Gelar Depan</label>
                                <input name="gelar_dpn" id="gelar_dpn"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-xs-5 ">
                            <div class="form-group label-floating">
                            <label class="control-label" for="nama" >Nama Pegawai</label>
                                <input name="nama" id="nama"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                         <div class="col-xs-4">
                            <div class="form-group label-floating">
                            <label class="control-label" for="gelar_blkg" >Gelar Belakang</label>
                                <input name="gelar_blkg" id="gelar_blkg"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        
                            
                            <div class="col-xs-3" style="padding-left:0px;">
                         <div class="form-group label-floating">
                            <label class="control-label" for="gender" >Jenis Kelamin</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value=""></option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                                                           
                               <span class="help-block"></span>
                            </div>   
                            </div>

                            <div class="col-xs-3">
                            <div class="form-group label-floating">
                            <label class="control-label" for="pob" >Tempat Lahir</label>
                                <input name="pob" id="pob"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                            
                            <div class="col-xs-3">
                          <div class="form-group label-floating">
                            <label class="control-label" for="dob" >Tanggal Lahir</label>
                                <input name="dob" id="dob"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                            <div class="col-xs-3">
                          <div class="form-group label-floating">
                            <label class="control-label" for="dob" >Agama</label>
                                <input name="agama" id="agama"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                             <div class="col-xs-4" style="padding-left:0px;">
                          <div class="form-group label-floating">
                            <label class="control-label" for="ktp" >No.KTP</label>
                                <input name="ktp" id="ktp"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                             <div class="col-xs-4">
                          <div class="form-group label-floating">
                            <label class="control-label" for="npwp" >No.NPWP</label>
                                <input name="npwp" id="npwp"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                             <div class="col-xs-4">
                          <div class="form-group label-floating">
                            <label class="control-label" for="paspor" >No.paspor</label>
                                <input name="paspor" id="paspor"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>

                             <div class="col-xs-6 " style="padding-left:0px;">
                          <div class="form-group label-floating">
                            <label class="control-label" for="alamat_ktp" >Alamat KTP</label>
                                <input name="alamat_ktp" id="alamat_ktp"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                             <div class="col-xs-6">
                          <div class="form-group label-floating">
                            <label class="control-label" for="alamat_akhir" >Alamat Terakhir</label>
                                <input name="alamat_akhir" id="alamat_akhir"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>

                        <div class="col-xs-3 " style="padding-left:0px;">
                          <div class="form-group label-floating">
                            <label class="control-label" for="pangkat" >Pangkat</label>
                                <input name="pangkat" id="pangkat"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                              <div class="col-xs-3">
                          <div class="form-group label-floating">
                            <label class="control-label" for="tmt_pangkat" >TMT Pangkat</label>
                                <input name="tmt_pangkat" id="tmt_pangkat"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                             <div class="col-xs-3">
                          <div class="form-group label-floating">
                            <label class="control-label" for="jabatan" >Jabatan</label>
                                <input name="jabatan" id="jabatan"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>
                           
                            <div class="col-xs-3">
                            <div class="form-group label-floating">
                            <label class="control-label" for="tmt_jabatan" >TMT Jabatan</label>
                                <input name="tmt_jabatan" id="tmt_jabatan"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                            </div>

                            <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Photo</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                            
                          <div class="col-xs-12" style="padding-left:0px;">  
                       <div class="form-group  label-floating" >
                           <label class="control-label" id="label-photo" for="foto" >Pilih File Foto</label>
                        <input id="foto" name="foto" class="form-control" type="file" style="opacity:100;position:relative;">
                        
                        </div>
                          </div>
                  
                  
                    </div>
                </form>
            </div>
            </div> <br>
            <div class="modal-footer">
            <div class="col-xs-12">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-raised btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-raised btn-sm" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
