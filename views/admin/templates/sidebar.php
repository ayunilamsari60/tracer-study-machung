<?php
$current_page = basename($_SERVER['SCRIPT_NAME']); // Ambil nama file dari URL
?>

<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="/tracer-study-machung/admin" class="<?= ($current_page == 'admin') ? 'mm-active' : '' ?>">
                        <i class="fas fa-home"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="pertanyaan.php" class="<?= ($current_page == 'pertanyaan.php') ? 'mm-active' : '' ?>">
                        <i class="fas fa-list-alt"></i>
                        <span key="t-dashboards">Pertanyaan</span>
                    </a>
                </li>

                <li>
                    <a href="/tracer-study-machung/admin/data-responden" class="<?= ($current_page == 'data-responden') ? 'mm-active' : '' ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span key="t-dashboards">Data Responden</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
