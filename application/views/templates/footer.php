        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk filter (di halaman transaksi)
        if ($('#filter_siswa').length > 0) {
            $('#filter_siswa').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik nama siswa untuk mencari...',
                allowClear: true,
                minimumInputLength: 1
            });
        }
        
        if ($('#filter_buku').length > 0) {
            $('#filter_buku').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik judul buku untuk mencari...',
                allowClear: true,
                minimumInputLength: 1
            });
        }

        // Inisialisasi Select2 untuk filter laporan
        if ($('#filter_siswa_laporan').length > 0) {
            $('#filter_siswa_laporan').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik nama siswa untuk mencari...',
                allowClear: true,
                minimumInputLength: 1
            });
        }
        
        if ($('#filter_buku_laporan').length > 0) {
            $('#filter_buku_laporan').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik judul buku untuk mencari...',
                allowClear: true,
                minimumInputLength: 1
            });
        }
        
        // ========== SELECT2 UNTUK FORM EDIT TRANSAKSI ==========
        // Inisialisasi Select2 untuk edit transaksi (dengan pengaturan yang benar)
        if ($('#edit_id_siswa').length > 0) {
            $('#edit_id_siswa').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik nama siswa untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('#formEditTransaksi')
            });
        }
        
        if ($('#edit_id_buku').length > 0) {
            $('#edit_id_buku').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik judul buku untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('#formEditTransaksi')
            });
        }
        
        // ========== SELECT2 UNTUK FORM PEMINJAMAN ==========
        if ($('#pinjam_id_siswa').length > 0) {
            $('#pinjam_id_siswa').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik nama siswa untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('#formPinjam')
            });
        }
        
        if ($('#pinjam_id_buku').length > 0) {
            $('#pinjam_id_buku').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik judul buku untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('#formPinjam')
            });
        }

        // Inisialisasi Select2 untuk edit laporan (bisa diketik)
        if ($('#edit_laporan_siswa').length > 0) {
            // Destroy jika sudah ada
            if ($('#edit_laporan_siswa').hasClass('select2-hidden-accessible')) {
                $('#edit_laporan_siswa').select2('destroy');
            }
            $('#edit_laporan_siswa').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik nama siswa untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('.card-body'),
                language: {
                    noResults: function() { return "Tidak ada siswa ditemukan"; },
                    searching: function() { return "Mencari..."; },
                    inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
                }
            });
        }

         if ($('#edit_laporan_buku').length > 0) {
            // Destroy jika sudah ada
            if ($('#edit_laporan_buku').hasClass('select2-hidden-accessible')) {
                $('#edit_laporan_buku').select2('destroy');
            }
            $('#edit_laporan_buku').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik judul buku untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('.card-body'),
                language: {
                    noResults: function() { return "Tidak ada buku ditemukan"; },
                    searching: function() { return "Mencari..."; },
                    inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
                }
            });
        }

         if ($('#edit_laporan_buku').length > 0) {
            // Destroy jika sudah ada
            if ($('#edit_laporan_buku').hasClass('select2-hidden-accessible')) {
                $('#edit_laporan_buku').select2('destroy');
            }
            $('#edit_laporan_buku').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Ketik judul buku untuk mencari...',
                allowClear: true,
                minimumInputLength: 1,
                dropdownParent: $('.card-body'),
                language: {
                    noResults: function() { return "Tidak ada buku ditemukan"; },
                    searching: function() { return "Mencari..."; },
                    inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
                }
            });
        }            
        
    });
    </script>

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <hr style="border-color: #1ABC9C; opacity: 0.3;">
                    <p class="mb-0" style="color: #7f8c8d; font-size: 12px;">
                        &copy; <?= date('Y') ?> Baswara Library | Perpustakaan Digital
                    </p>
                    <p class="mt-1" style="color: #bdc3c7; font-size: 11px;">
                        <i class="fas fa-book-open" style="color: #1ABC9C;"></i> 
                        Sistem Informasi Perpustakaan
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>