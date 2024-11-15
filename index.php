<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .navbar {
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .main-content {
            padding: 2rem 0;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .btn-action {
            margin: 0 0.25rem;
        }
        .welcome-section {
            text-align: center;
            padding: 3rem 0;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <!-- Enhanced Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-hospital-alt me-2"></i>Poliklinik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Data Master
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?page=dokter.php">Data Dokter</a></li>
                                <li><a class="dropdown-item" href="index.php?page=pasien.php">Data Pasien</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=periksa.php">Periksa</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=loginUser.php">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=registrasiUser.php">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-content">
        <?php
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            
            $protected_pages = ['dokter.php', 'pasien.php', 'periksa.php'];
            
            if(in_array($page, $protected_pages) && !isset($_SESSION['user_id'])) {
                header("Location: index.php?page=loginUser.php");
                exit;
            }
            
            include $page;
        } else {
            // Enhanced welcome section
            ?>
            <div class="welcome-section">
                <h1 class="display-4">Selamat Datang di Poliklinik</h1>
                <p class="lead">Sistem Informasi Manajemen Poliklinik</p>
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <p>Silakan register dan login untuk mengakses fitur-fitur aplikasi.</p>
                    <div>
                        <a href="index.php?page=loginUser.php" class="btn btn-primary me-2">Login</a>
                        <a href="index.php?page=registrasiUser.php" class="btn btn-outline-primary">Register</a>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>