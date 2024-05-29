<?php
session_start();

if (isset($_SESSION['expire_time']) && $_SESSION['expire_time'] < time()) {
    session_unset();
    session_destroy();
    header('location: login.php');
    exit;
} else {
    $_SESSION['expire_time'] = time() + (5 * 60);
}

include_once("koneksi.php");

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
        <link rel="icon" type="image/x-icon" href="./asset-login/logo-login.png">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 d-flex align-items-center" href="dashboard.php">
                <img src="./assets-dashboard/img/logo.jpg" alt="Logo" class="rounded-circle me-2" width="40" height="40">
                Arisan PKK
            </a>       
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Text-->
            <span class="navbar-text ms-auto me-3 my-2 my-md-0">
            Halo, 
            <?php
                if (isset($_SESSION['nama_admin'])) {
                    echo $_SESSION['nama_admin']; 
                }
            ?>
            </span>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-footer">
                        <hr>
                        <div class="d-flex flex-row align-items-center">
                        <?php
                            // Ambil nama admin dari sesi
                            $nama_admin = $_SESSION['nama_admin'];
                            
                            // Ambil gambar admin dari database
                            $query = "SELECT img_admin FROM admin WHERE nama_admin = '$nama_admin'";
                            $result = mysqli_query($koneksi, $query);
                            
                            if ($row = mysqli_fetch_assoc($result)) {
                                $img_admin = $row['img_admin'];
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($img_admin).'" alt="Admin Image" class="rounded-circle me-2" width="40" height="40">';
                            } else {
                                // Jika gambar tidak ditemukan, tampilkan gambar placeholder atau pesan kesalahan
                                echo '<img src="path_to_placeholder_image.jpg" alt="Admin Image" class="rounded-circle me-2" width="40" height="40">';
                            }
                        ?>
                            <div class="small">
                                <div>Login sebagai:</div>
                                <div>
                                    <?php
                                    if (isset($_SESSION['level_admin'])) {
                                        echo $_SESSION['level_admin']; 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <?php if ($level_admin == 'ketua'): ?>
                            <a class="nav-link" href="kelolaanggota.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Kelola Anggota
                            </a>
                            <?php endif; ?>
                            <?php if ($level_admin == 'ketua' || $level_admin == 'sekretaris'): ?>
                            <a class="nav-link" href="./pertemuan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                                Pertemuan
                            </a>
                            <?php endif; ?>
                            <?php if ($level_admin == 'bendahara'|| $level_admin == 'ketua'): ?>
                            <a class="nav-link" href="./pembayaran.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-check-alt"></i></div>
                                Pembayaran
                            </a>
                            <?php endif; ?>
                            <?php if ($level_admin == 'ketua' || $level_admin == 'sekretaris'): ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link fs-6 fw-lighter" href="./laporanpertemuan.php">Laporan Pertemuan</a>
                                    <a class="nav-link fs-6 fw-lighter" href="./laporanpembayaran.php">Laporan Pembayaran</a>
                                </nav>
                            </div>
                            <?php endif; ?>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                        </div>
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
                                    <div class="card-body"><i class="fas fa-user-friends"></i>
                                        Anggota
                                        <?php 
                                        
                                        $dash_anggota_query = "SELECT * FROM tb_anggota";
                                        $dash_anggota_query_run = mysqli_query($koneksi, $dash_anggota_query);

                                        if($total_anggota = mysqli_num_rows($dash_anggota_query_run)){
                                            echo'<h4 class="mb-0 mt-3"> '.$total_anggota.' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0 mt-3">0</h4>';
                                        }

                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">
                                        <i class="fas fa-handshake"></i> Pertemuan Arisan
                                        <?php 
                                        
                                        $dash_pertemuan_query = "SELECT * FROM tb_pertemuan";
                                        $dash_pertemuan_query_run = mysqli_query($koneksi, $dash_pertemuan_query);

                                        if($total_pertemuan = mysqli_num_rows($dash_pertemuan_query_run)){
                                            echo'<h4 class="mb-0 mt-3"> '.$total_pertemuan.' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0 mt-3">0</h4>';
                                        }

                                        ?>   
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        <i class="fas fa-money-check-alt"></i> Pembayaran Bulan Ini
                                        <?php 
                                        // Menghitung jumlah pembayaran berdasarkan bulan saat ini
                                        $currentMonth = date('m');
                                        $dash_pembayaran_query = "SELECT * FROM tb_pembayaran WHERE MONTH(tanggal) = '$currentMonth'";
                                        $dash_pembayaran_query_run = mysqli_query($koneksi, $dash_pembayaran_query);

                                        $total_pembayaran = 0;
                                        if ($total_pembayaran = mysqli_num_rows($dash_pembayaran_query_run)) {
                                            $total_pembayaran = mysqli_num_rows($dash_pembayaran_query_run);
                                        } else {
                                            $total_pembayaran = 0;
                                        }
                                        ?>
                                        <h4 class="mb-0 mt-3"><?php echo $total_pembayaran; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        <i class="fas fa-users"></i> Admin
                                        <h4 class="mb-0 mt-3">3</h4>     
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
                                            <button id="prevBtn" class="btn btn-sm btn-primary me-2"><i class="fas fa-chevron-left"></i></button>
                                            <h2 id="monthYearText"></h2>
                                            <button id="nextBtn" class="btn btn-sm btn-primary ms-2"><i class="fas fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Chart Pembayaran
                                    </div>
                                    <div class="card-body"><canvas id="myChart"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Informasi Pembayaran Bulan Ini
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-info table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Status Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Status Pembayaran</th>
                                        </tr>
                                    </tfoot>                                    
                                    <tbody>
                                    <?php 
                                    $no = 1;
                                    $currentMonth = date('m');
                                    $tampil = mysqli_query($koneksi,"SELECT * FROM tb_pembayaran WHERE MONTH(tanggal) = '$currentMonth' ORDER BY id_pembayaran");
                                    while ($data = mysqli_fetch_array($tampil)): 
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['nama']?></td>
                                            <td><?php echo $data['tanggal'] ?></td>
                                            <td><?php echo $data['status_pembayaran'] ?></td>
                                        </tr>
                                    <?php endwhile; ?>    
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="assets-dashboard/js/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const data = {
                    labels: ['Red', 'Blue', 'Yellow'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [300, 50, 100],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                };
                const config = {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                };
                const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
            });
        </script>
    </body>
</html>
