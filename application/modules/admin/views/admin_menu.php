<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="active treeview">
    <a href="<?php echo base_url('admin'); ?>">
      <i class="fa fa-dashboard "></i> <span>Dashboard</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-users text-green"></i>
      <span>Master Data </span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url('master_biro'); ?>"><i class="fa fa-circle-o"></i> Data Biro</a></li>
      <li><a href="<?php echo base_url('master_pangkat'); ?>"><i class="fa fa-circle-o"></i> Data Kepangkatan</a></li>
      <li><a href="<?php echo base_url('master_jabatan'); ?>"><i class="fa fa-circle-o"></i> Jenis Jabatan</a></li>
      <li><a href="<?php echo base_url('master_eselon'); ?>"><i class="fa fa-circle-o"></i> Data Eselon</a></li>
      <li><a href="<?php echo base_url('master_status'); ?>"><i class="fa fa-circle-o"></i> Data Status</a></li>
      <li><a href="<?php echo base_url('master_agama'); ?>"><i class="fa fa-circle-o"></i> Data Agama</a></li>
      <li><a href="<?php echo base_url('master_pendidikan'); ?>"><i class="fa fa-circle-o"></i> Data Jenjang Pendidikan</a></li>
      <li><a href="<?php echo base_url('master_diklat'); ?>"><i class="fa fa-circle-o"></i> Data Jenis Diklat</a></li>
      <li><a href="<?php echo base_url('master_periode'); ?>"><i class="fa fa-circle-o"></i> Data Periode Naik Golongan</a></li>
      <li><a href="<?php echo base_url('master_hukuman'); ?>"><i class="fa fa-circle-o"></i> Data Sanksi</a></li>
      <li><a href="<?php echo base_url('master_gapok'); ?>"><i class="fa fa-circle-o"></i> Data Gaji Pokok</a></li>
      <li><a href="<?php echo base_url('master_tunjangan'); ?>"><i class="fa fa-circle-o"></i> Data Jenis Tunjangan</a></li>
      <li><a href="<?php echo base_url('master_pph'); ?>"><i class="fa fa-circle-o"></i> Data PPh 21</a></li>
      <li><a href="<?php echo base_url('master_ppn'); ?>"><i class="fa fa-circle-o"></i> Data PPN</a></li>
      <li><a href="<?php echo base_url('master_potongan'); ?>"><i class="fa fa-circle-o"></i> Data Potongan Lain</a></li>

    </ul>
  </li>

  
  <li class="">
    <a href="#">
      <i class="fa fa-laptop text-aqua"></i>
      <span>Entry Data Pegawai</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
  <ul class="treeview-menu">
      <li><a href="<?php echo base_url('biodata'); ?>"><i class="fa fa-circle-o"></i> Biodata</a></li>
      <li><a href="<?php echo base_url('data_keluarga'); ?>"><i class="fa fa-circle-o"></i> Data Keluarga</a></li>
      <li><a href="<?php echo base_url('riwayat_pendidikan'); ?>"><i class="fa fa-circle-o"></i> Riwayat Pendidikan </a></li>
      <li><a href="<?php echo base_url('riwayat_jabatan'); ?>"><i class="fa fa-circle-o"></i> Riwayat Jabatan </a></li>
      <li><a href="<?php echo base_url('riwayat_kepangkatan'); ?>"><i class="fa fa-circle-o"></i> Riwayat Kepangkatan </a></li>
      <li><a href="<?php echo base_url('dp3'); ?>"><i class="fa fa-circle-o"></i> DP3 </a></li>
      <li><a href="<?php echo base_url('dokumen'); ?>"><i class="fa fa-circle-o"></i> Dokumen </a></li>

    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-edit text-red"></i> <span>Laporan Pegawai</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url('laporan_umum'); ?>"><i class="fa fa-circle-o"></i> Umum</a></li>
      <li><a href="<?php echo base_url('laporan_pensiun'); ?>"><i class="fa fa-circle-o"></i> Pensiun</a></li>
      <li><a href="<?php echo base_url('laporan_naik_gol'); ?>"><i class="fa fa-circle-o"></i> Naik Golongan</a></li>
      <li><a href="<?php echo base_url('laporan_kepangkatan'); ?>"><i class="fa fa-circle-o"></i> Kepangkatan </a></li>
      <li><a href="<?php echo base_url('laporan_golongan'); ?>"><i class="fa fa-circle-o"></i> Golongan </a></li>
      <li><a href="<?php echo base_url('laporan_masa_kerja'); ?>"><i class="fa fa-circle-o"></i> Masa Kerja </a></li>

    </ul>
  </li>
  <li class="">
    <a href="<?php echo base_url('slip_gaji'); ?>">
      <i class="fa fa-table "></i> <span>Slip Gaji</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

  </li>

  <li class="">
    <a href="<?php echo base_url('aturan_kepegawaian'); ?>">
      <i class="fa fa-balance-scale text-maroon"></i> <span>Aturan Kepegawaian</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-gear text-teal"></i> <span>Pengaturan Aplikasi</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url('pengguna'); ?>"><i class="fa fa-circle-o"></i> Pengguna</a></li>
      <li><a href="<?php echo base_url('cadangan'); ?>"><i class="fa fa-circle-o"></i> Cadangan Data</a></li>
      <li><a href="<?php echo base_url('restore'); ?>"><i class="fa fa-circle-o"></i> Pulihkan Data </a></li>


    </ul>
  </li>
  <li><a href="<?php echo base_url('login/logout') ;?>"><i class="fa fa-power-off text-red text-bold"></i> <span>Keluar</span></a></li>
</ul>
