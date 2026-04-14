<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #333; }
        .header p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4472C4; color: white; }
        .footer { margin-top: 30px; text-align: right; }
        .badge { padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .badge-warning { background: #ffc107; color: #000; }
        .badge-success { background: #28a745; color: #fff; }
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1>LAPORAN TRANSAKSI PERPUSTAKAAN</h1>
        <p>Periode: <?= ($tanggal_awal ? date('d/m/Y', strtotime($tanggal_awal)) : 'Semua') ?> - <?= ($tanggal_akhir ? date('d/m/Y', strtotime($tanggal_akhir)) : 'Semua') ?></p>
        
        <!-- TAMBAHKAN INI: Menampilkan filter yang dipilih -->
        <?php if(!empty($filter_siswa)): ?>
        <p>Filter Siswa: <?= $filter_siswa ?></p>
        <?php endif; ?>
        
        <?php if(!empty($filter_buku)): ?>
        <p>Filter Buku: <?= $filter_buku ?></p>
        <?php endif; ?>
        
        <p>Tanggal Cetak: <?= date('d/m/Y H:i:s') ?></p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tgl Kembali</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($transaksi as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= date('d/m/Y', strtotime($row->tanggal_pinjam)) ?></td>
                <td><?= date('d/m/Y', strtotime($row->batas_pengembalian)) ?></td>
                <td><?= $row->tanggal_kembali ? date('d/m/Y', strtotime($row->tanggal_kembali)) : '-' ?></td>
                <td><?= $row->nama_lengkap ?></td>
                <td><?= $row->kelas ?></td>
                <td><?= $row->judul ?></td>
                <td>
                    <?php if($row->status == 'dipinjam'): ?>
                        <span class="badge badge-warning">Dipinjam</span>
                    <?php else: ?>
                        <span class="badge badge-success">Dikembalikan</span>
                    <?php endif; ?>
                </td>
                <td>Rp <?= number_format($row->denda, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Mengetahui,</p>
        <p>Kepala Perpustakaan</p>
        <br><br>
        <p>(_____________________)</p>
    </div>
</body>
</html>