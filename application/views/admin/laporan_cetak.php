<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4472C4;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 18pt;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 9pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 9pt;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #4472C4;
            color: white;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9pt;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8pt;
            display: inline-block;
        }
        .badge-warning {
            background: #ffc107;
            color: #000;
        }
        .badge-success {
            background: #28a745;
            color: #fff;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN TRANSAKSI PERPUSTAKAAN</h1>
        <p>Periode: <?= ($tanggal_awal ? date('d/m/Y', strtotime($tanggal_awal)) : 'Semua') ?> - <?= ($tanggal_akhir ? date('d/m/Y', strtotime($tanggal_akhir)) : 'Semua') ?></p>
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
                <th>Denda (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($transaksi as $row): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= date('d/m/Y', strtotime($row->tanggal_pinjam)) ?></td>
                <td><?= date('d/m/Y', strtotime($row->batas_pengembalian)) ?></td>
                <td><?= $row->tanggal_kembali ? date('d/m/Y', strtotime($row->tanggal_kembali)) : '-' ?></td>
                <td><?= $row->nama_lengkap ?></td>
                <td><?= $row->kelas ?></td>
                <td><?= $row->judul ?></td>
                <td class="text-center">
                    <?php if($row->status == 'dipinjam'): ?>
                        <span class="badge badge-warning">Dipinjam</span>
                    <?php else: ?>
                        <span class="badge badge-success">Dikembalikan</span>
                    <?php endif; ?>
                </td>
                <td class="text-right"><?= number_format($row->denda, 0, ',', '.') ?></td>
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