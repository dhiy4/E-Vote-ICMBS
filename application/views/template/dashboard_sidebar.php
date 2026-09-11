<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo "#";//site_url(); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-bars"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>
            
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('dashboard'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Menu Utama</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('dashboard/voter'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pemilih</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('dashboard/candidate'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Kandidat</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php //echo site_url('dashboard/setting'); ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logout">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span>
        </a>
    </li>


</ul>
<!-- End of Sidebar -->