<?php
// Mulai session
session_start();

// Periksa apakah session nama_admin telah diset atau belum
if (!isset($_SESSION['nama_admin'])) {
    echo "<script>
        alert('Lakukan Login Terlebih Dahulu');
        document.location.href = 'login.php';
        </script>";
    exit;
}

// Ambil level pengguna dari sesi
$level_admin = $_SESSION['level_admin'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Website Arisan PKK</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets-dashboard/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Website Arisan PKK</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Text-->
            <span class="navbar-text ms-auto me-3 my-2 my-md-0">
                Nama
            </span>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <?php if ($level_admin == 'ketua'): ?>
                            <a class="nav-link" href="kelolagrup.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Kelola Grup
                            </a>
                            <a class="nav-link" href="kelolaanggota.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Kelola Anggota
                            </a>
                            <?php endif; ?>
                            <?php if ($level_admin == 'ketua' || $level_admin == 'sekretaris'): ?>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                                Pertemuan
                            </a>
                            <?php endif; ?>
                            <?php if ($level_admin == 'bendahara'|| $level_admin == 'ketua'): ?>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-check-alt"></i></div>
                                Pembayaran
                            </a>
                            <?php endif; ?>
                            <?php if ($level_admin == 'ketua' || $level_admin == 'sekretaris'): ?>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Laporan
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                        // Periksa apakah session nama_admin telah diset atau belum
                        if (isset($_SESSION['nama_admin'])) {
                            // Jika session sudah diset, tampilkan teks dengan username
                            echo $_SESSION['nama_admin']; // Menampilkan username
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="fas fa-user-friends"></i> Anggota</div>
                                            <div class="font-weight-bold">80</div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="fas fa-users"></i> Grup Arisan</div>
                                            <div class="font-weight-bold">2</div> 
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="fas fa-handshake"></i> Pertemuan Arisan</div>
                                            <div class="font-weight-bold">5</div> 
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="fas fa-money-check-alt"></i> Pembayaran</div>
                                            <div class="font-weight-bold">20</div> 
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Lihat Detail</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-calendar me-1"></i>
                                        Kalender
                                    </div>
                                    <div id="calendar" class="card-body">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button id="prevBtn" class="btn btn-sm btn-secondary me-2"><i class="fas fa-chevron-left"></i></button>
                                            <h2 id="monthYearText"></h2>
                                            <button id="nextBtn" class="btn btn-sm btn-secondary ms-2"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        ppppppp
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Informasi Anggota
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Grup</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Grup</th>
                                            <th>Status Pembayaran</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </tfoot>                                    
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>belum bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>tes</td>
                                            <td>2</td>
                                            <td>sudah bayar</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted">Copyright &copy; Kelompok 1 Paralel F 2024</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets-dashboard/js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="assets-dashboard/js/datatables-simple-demo.js"></script>
    </body>
</html>
