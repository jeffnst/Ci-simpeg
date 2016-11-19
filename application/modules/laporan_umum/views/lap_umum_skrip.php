<script src="<?php echo base_url('aset/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('aset/plugins/datatables/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('aset/plugins/datepicker/bootstrap-datepicker.js')?>"></script>

    <script type="text/javascript">

    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url();?>';

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('laporan_umum/umum_list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [ -2 ], //2 last column (photo)
                    "orderable": false, //set not orderable
                },
            ],

        });

        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });



    function add_person()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Data Pegawai'); // Set Title to Bootstrap modal title
        $('.form-group').addClass('is-empty');
        $('#photo-preview').hide(); // hide photo preview modal

        $('#label-photo').text('Upload Photo'); // label photo upload
    }

    function edit_person(uid)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('.form-group').addClass('is-focused');
        $('.form-group').removeClass('is-empty');

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('biodata/biodata_edit')?>/" + uid,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="uid"]').val(data.uid);
                $('[name="nip"]').val(data.nip);
                $('[name="nama"]').val(data.nama);
                $('[name="gender"]').val(data.gender);
                $('[name="gelar_dpn"]').val(data.gelar_dpn);
                $('[name="gelar_blkg"]').val(data.gelar_blkg);
                $('[name="pob"]').val(data.pob);
                $('[name="dob"]').val(data.dob);
                $('[name="agama"]').val(data.agama);
                $('[name="ktp"]').val(data.ktp);
                $('[name="npwp"]').val(data.npwp);
                $('[name="paspor"]').val(data.paspor);
                $('[name="alamat_ktp"]').val(data.alamat_ktp);
                $('[name="alamat_akhir"]').val(data.alamat_akhir);
                $('[name="pangkat"]').val(data.pangkat);
                $('[name="tmt_pangkat"]').val(data.tmt_pangkat);
                $('[name="jabatan"]').val(data.jabatan);
                $('[name="tmt_jabatan"]').val(data.tmt_jabatan);
                $('[name="masa_kerja"]').val(data.masa_kerja);

                 

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

                $('#photo-preview').show(); // show photo preview modal

                if(data.foto)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'foto/'+data.foto+'" class="img-responsive" style="width:200px;height:300px">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.foto+'"/> Remove photo when saving'); // remove photo

                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('biodata/biodata_add')?>";
        } else {
            url = "<?php echo site_url('biodata/biodata_update')?>";
        }

        // ajax adding data to database

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().addClass('is-focused');
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }

    function delete_person(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('biodata/biodata_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

    </script>