<div class="col-md-2 sidebar">
    <div class="nav flex-column">
        <a class="nav-link" href="<?= base_url('index.php/siswa/dashboard') ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="nav-link" href="<?= base_url('index.php/siswa/daftar_buku') ?>">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <a class="nav-link" href="<?= base_url('index.php/siswa/riwayat') ?>">
            <i class="fas fa-history"></i> 
            <span class="nav-text">Riwayat Peminjaman</span>
        </a>
        <a class="nav-link" href="<?= base_url('index.php/auth/logout') ?>">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<style>
/* Perbaikan text wrap pada sidebar */
.sidebar .nav-link {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    white-space: normal;
    word-wrap: break-word;
}

.sidebar .nav-link i {
    flex-shrink: 0;
    margin-top: 2px;
}

.sidebar .nav-link .nav-text {
    flex: 1;
    line-height: 1.4;
    display: inline-block;
}

/* Untuk memastikan teks wrap dengan rapi */
@media (max-width: 1200px) {
    .sidebar .nav-link .nav-text {
        word-break: break-word;
    }
}
</style>