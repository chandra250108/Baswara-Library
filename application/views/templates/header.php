<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #ECF0F1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Navbar Style */
        .navbar {
            background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            border-bottom: 1px solid rgba(26, 188, 156, 0.2);
        }
        
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 500;
        }
        
        .navbar-brand:hover {
            color: #1ABC9C !important;
            transition: all 0.3s ease;
        }
        
        /* Sidebar Style */
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #ECF0F1;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            padding-top: 20px;
            border-right: 1px solid rgba(26, 188, 156, 0.15);
        }
        
        .sidebar .nav-link {
            color: #2C3E50 !important;
            padding: 12px 20px;
            transition: all 0.3s;
            border-radius: 10px;
            margin: 4px 10px;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
            color: white !important;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        
        /* Card Style */
        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            border: none;
            background: white;
        }
        
        .card-header {
            background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
            color: white;
            border-bottom: none;
        }
        
        /* Button Primary Style */
        .btn-primary {
            background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 188, 156, 0.4);
            background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
        }
        
        /* Select2 Custom Styling */
        .select2-dropdown {
            z-index: 10000 !important;
        }

        .select2-container--open {
            z-index: 10000 !important;
        }
        
        /* Table Style */
        .table {
            background: white;
        }
        
        .table thead th {
            background: #2C3E50;
            color: white;
            border: none;
        }
        
        .table tbody tr:hover {
            background: #e8f8f5;
        }
        
        /* Scrollbar Style */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #ECF0F1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #1ABC9C;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #16A085;
        }
        
        /* Footer Style */
        footer {
            background: #ECF0F1;
            border-top: 1px solid rgba(26, 188, 156, 0.2);
            margin-top: 30px;
        }
        
        /* Utility */
        .rounded-4 {
            border-radius: 16px !important;
        }
        .rounded-top-4 {
            border-top-left-radius: 16px !important;
            border-top-right-radius: 16px !important;
        }
        .rounded-3 {
            border-radius: 12px !important;
        }
        .rounded-pill {
            border-radius: 50px !important;
        }
        
        /* Form Control */
        .form-control, select.form-control {
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 10px 12px;
        }
        
        .form-control:focus, select.form-control:focus {
            border-color: #1ABC9C;
            box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
            outline: none;
        }
        
        select.form-control {
            cursor: pointer;
            background-color: white;
        }

        @media (max-width: 768px) {
            /* Sidebar menjadi full width dan muncul di atas konten */
            .sidebar {
                width: 100%;
                min-height: auto;
                margin-bottom: 20px;
                border-right: none;
                border-bottom: 1px solid rgba(26, 188, 156, 0.2);
                padding-top: 10px;
            }
            /* Konten utama menjadi full width */
            .col-md-10 {
                width: 100%;
                flex: 0 0 auto;
            }
            /* Atur ulang margin/padding row */
            .row {
                margin-left: 0;
                margin-right: 0;
            }
            /* Navbar brand dan user info lebih kecil */
            .navbar-brand {
                font-size: 1rem;
            }
            .navbar .ms-auto span {
                font-size: 0.8rem;
            }
            /* Card body padding lebih kecil */
            .card-body {
                padding: 1rem !important;
            }
            /* Tabel dibungkus scroll otomatis (pastikan di view sudah ada class table-responsive) */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            /* Atur ulang grid untuk kartu statistik */
            .stat-card .card-body {
                padding: 0.75rem;
            }
            .stat-card h2 {
                font-size: 1.5rem;
            }
        }

        /* Untuk layar sangat kecil (<= 576px) */
        @media (max-width: 576px) {
            .sidebar .nav-link {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
            .btn {
                font-size: 0.85rem;
                padding: 6px 12px;
            }
            .form-control, .select2-selection {
                font-size: 14px;
            }
            footer p {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-book-open"></i> Baswara Library
            </a>
            <div class="ms-auto">
                <span class="text-white me-3">
                    <i class="fas fa-user"></i> <?= $this->session->userdata('nama') ?>
                    <small class="d-block"><?= ucfirst($this->session->userdata('role')) ?></small>
                </span>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">