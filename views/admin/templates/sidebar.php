<?php
$current_page = basename($_SERVER['SCRIPT_NAME']); // Ambil nama file dari URL
?>

<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="dashboard.php" class="<?= ($current_page == 'dashboard.php') ? 'mm-active' : '' ?>">
                        <i class="fas fa-home"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-database"></i>
                        <span key="t-tables">Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="master-kategori.php" class="<?= ($current_page == 'master-kategori.php') ? 'active' : '' ?>" key="t-basic-tables">Master Kategori</a></li>
                        <li><a href="master-ukuran.php" class="<?= ($current_page == 'master-ukuran.php') ? 'active' : '' ?>" key="t-data-tables">Master Ukuran</a></li>
                    </ul>
                </li>

                <li>
                    <a href="data-responden.php" class="<?= ($current_page == 'data-responden.php') ? 'mm-active' : '' ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span key="t-dashboards">Data Responden</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
