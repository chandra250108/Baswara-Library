<!-- Sidebar Admin dengan Offcanvas untuk Mobile -->
<div class="col-md-2 sidebar-col">
    <!-- Tombol Toggle untuk Mobile -->
    <button class="btn btn-toggle-sidebar d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarAdminOffcanvas">
        <i class="fas fa-bars"></i> Menu
    </button>

    <!-- Offcanvas untuk Mobile -->
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="sidebarAdminOffcanvas">
        <div class="offcanvas-header" style="background: linear-gradient(135deg, #2C3E50, #34495E); color: white;">
            <h5 class="offcanvas-title">Menu Admin</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="nav flex-column">
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link" href="<?= base_url('admin/profile') ?>">
                    <i class="fas fa-id-card"></i> Profil Saya
                </a>
                <a class="nav-link" href="<?= base_url('admin/buku') ?>">
                    <i class="fas fa-book"></i> Data Buku
                </a>
                <a class="nav-link" href="<?= base_url('admin/anggota') ?>">
                    <i class="fas fa-users"></i> Data Anggota
                </a>
                <a class="nav-link" href="<?= base_url('admin/transaksi') ?>">
                    <i class="fas fa-exchange-alt"></i> Transaksi
                </a>
                <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
                <a class="nav-link" href="<?= base_url('index.php/admin/buku_terhapus') ?>">
                    <i class="fas fa-trash-alt"></i> Arsip Buku
                </a>
                <a class="nav-link" href="<?= base_url('index.php/admin/anggota_terhapus') ?>">
                    <i class="fas fa-trash-alt"></i> Arsip Anggota
                </a>
                <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar Desktop (Tampil di layar >=768px) -->
    <div class="sidebar-desktop d-none d-md-block">
        <div class="nav flex-column">
            <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a class="nav-link" href="<?= base_url('admin/profile') ?>">
                <i class="fas fa-id-card"></i> Profil Saya
            </a>
            <a class="nav-link" href="<?= base_url('admin/buku') ?>">
                <i class="fas fa-book"></i> Data Buku
            </a>
            <a class="nav-link" href="<?= base_url('admin/anggota') ?>">
                <i class="fas fa-users"></i> Data Anggota
            </a>
            <a class="nav-link" href="<?= base_url('admin/transaksi') ?>">
                <i class="fas fa-exchange-alt"></i> Transaksi
            </a>
            <a class="nav-link" href="<?= base_url('admin/laporan') ?>">
                <i class="fas fa-chart-bar"></i> Laporan
            </a>
            <a class="nav-link" href="<?= base_url('index.php/admin/buku_terhapus') ?>">
                <i class="fas fa-trash-alt"></i> Arsip Buku
            </a>
            <a class="nav-link" href="<?= base_url('index.php/admin/anggota_terhapus') ?>">
                <i class="fas fa-trash-alt"></i> Arsip Anggota
            </a>
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</div>

<style>
/* ========== STYLE UNTUK SIDEBAR ADMIN (RESPONSIF SEPERTI SISWA) ========== */
.sidebar-col {
    position: relative;
    padding: 0;
}

/* Tombol Toggle Mobile */
.btn-toggle-sidebar {
    background: #2C3E50;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    margin: 10px 0 10px 15px;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}
.btn-toggle-sidebar:hover {
    background: #1ABC9C;
}

/* Offcanvas Styling */
.offcanvas {
    width: 260px;
    background: #ECF0F1;
}
.offcanvas .nav-link {
    color: #2C3E50 !important;
    padding: 12px 20px;
    transition: all 0.3s;
    border-radius: 10px;
    margin: 4px 10px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}
.offcanvas .nav-link i {
    width: 24px;
    text-align: center;
}
.offcanvas .nav-link:hover {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white !important;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3);
}
.offcanvas .nav-link.active {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
}

/* Sidebar Desktop */
.sidebar-desktop {
    background: #ECF0F1;
    border-radius: 0;
    padding: 20px 0;
    height: 100%;
    min-height: calc(100vh - 56px); /* tinggi navbar */
}
.sidebar-desktop .nav-link {
    color: #2C3E50 !important;
    padding: 12px 20px;
    transition: all 0.3s;
    border-radius: 10px;
    margin: 4px 10px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}
.sidebar-desktop .nav-link i {
    width: 24px;
    text-align: center;
    font-size: 18px;
}
.sidebar-desktop .nav-link:hover {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white !important;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3);
}
.sidebar-desktop .nav-link.active {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
}
.sidebar-desktop .nav-link.active i {
    color: white;
}

/* Menyesuaikan container utama */
.col-md-10 {
    transition: all 0.3s ease;
}

/* Responsif untuk layar ekstra kecil */
@media (max-width: 576px) {
    .btn-toggle-sidebar {
        margin: 8px 0 8px 12px;
        padding: 8px 14px;
        font-size: 14px;
    }
    .offcanvas {
        width: 85%;
    }
}
</style>

<script>
// Tutup offcanvas setelah klik link
document.querySelectorAll('#sidebarAdminOffcanvas .nav-link').forEach(link => {
    link.addEventListener('click', () => {
        const offcanvasEl = document.getElementById('sidebarAdminOffcanvas');
        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (offcanvas) offcanvas.hide();
    });
});
</script>