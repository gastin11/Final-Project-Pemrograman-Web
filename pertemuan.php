<?php

include_once ("koneksi.php");
$query= "SELECT * FROM tb_pertemuan";
$hasil = mysqli_query ($koneksi, $query);

// Mulai session
session_start();

if (isset($_SESSION['expire_time']) && $_SESSION['expire_time'] < time()) {
    session_unset();
    session_destroy();
    header('location: login.php');
    exit;
} else {
    $_SESSION['expire_time'] = time() + (3 * 60);
}

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

// Ambil data anggota
$query_anggota = "SELECT id_anggota, nama FROM tb_anggota ORDER BY id_anggota DESC";
$result_anggota = mysqli_query($koneksi, $query_anggota);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pertemuan</title>
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
                SiArisan
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
                        <h1 class="mt-4">Pertemuan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Pertemuan</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-table me-1"></i>
                                        Tabel Pertemuan
                                    </div>
                                </div>
                                
                            </div>

                            

                            
                            <div class="card-body">
                                <!-- Button trigger modal Tambah -->
                                <button type="button" class="btn btn-primary d-block mb-3" data-bs-toggle="modal" data-bs-target="#modaltambah">
                                    <i class="fas fa-plus me-1"></i> Tambah Pertemuan
                                </button>

                                <!-- Button trigger modal Hapus Semua -->
                                <button type="button" class="btn btn-danger d-block mb-3" data-bs-toggle="modal" data-bs-target="#modalhapussemua">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus Semua Data
                                </button>

                                <!-- Modal Tambah -->
                                <div class="modal fade" id="modaltambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-handshake"></i>Pertemuan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form method="POST" action="./crudpertemuan.php">
                                            <div class="modal-body">
                                        
                                                <div class="mb-3">
                                                <label for="id_anggota" class="form-label">Tuan Rumah</label>
                                                <select name="id_anggota" id="id_anggota" class="form-control" required>
                                                    <option value="">--Pilih Tuan Rumah--</option>
                                                    <?php while ($row = mysqli_fetch_assoc($result_anggota)): ?>
                                                        <option value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="tlokasi" placeholder="Masukkan lokasi pertemuan" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="exampleFormControlInput1" name="ttanggal" placeholder="Masukkan tanggal pertemuan" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Jam</label>
                                                    <input type="time" class="form-control" id="exampleFormControlInput1" name="tjam" placeholder="Masukkan jam pertemuan" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary" name="btnsimpan">Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Tambah -->

                                <!-- Modal Hapus Semua Data -->
                                <div class="modal fade" id="modalhapussemua" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-trash-alt"></i>Konfirmasi Hapus Semua Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="text-center text-danger">Apakah anda yakin ingin menghapus semua data pertemuan?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="crudpertemuan.php">
                                                    <button type="submit" class="btn btn-danger" name="btnhapussemua">Hapus Semua</button>
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- AKhir Modal Hapus Semua Data -->

                                <table id="datatablesSimple" class="table table-info table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Tuan Rumah</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Tuan Rumah</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Aksi</th>
                                        </tr>

                                    </tfoot>                                    
                                    <tbody>
                                    <?php 
                                    $no = 1;
                                    $tampil = mysqli_query($koneksi,"SELECT * FROM tb_pertemuan ORDER BY id_pertemuan DESC");
                                    while ($data = mysqli_fetch_array($tampil)): 
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['id_pertemuan'] ?></td>
                                            <td><?php echo $data['tuan_rumah'] ?></td>
                                            <td><?php echo $data['lokasi']?></td>
                                            <td><?php echo date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                                            <td><?php echo $data['jam'] ?></td>
                                            <td>
                                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $data['id_pertemuan']; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $data['id_pertemuan']; ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Awal Modal Edit -->
                                        <div class="modal fade" id="modaledit<?php echo $data['id_pertemuan']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-edit"></i>Edit Pertemuan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST" action="crudpertemuan.php">
                                                    <input type="hidden" name="id_pertemuan" value="<?php echo $data['id_pertemuan'] ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                        <?php
                                                        $query_anggota = "SELECT id_anggota, nama FROM tb_anggota ORDER BY id_anggota DESC";
                                                        $result_anggota = mysqli_query($koneksi, $query_anggota);
                                                        
                                                        ?>
                                                            <label for="id_anggota" class="form-label">Tuan Rumah</label>
                                                            <select name="id_anggota" id="id_anggota" class="form-control" required>
                                                                <option value="">--Pilih Tuan Rumah--</option>
                                                                <?php while ($row = mysqli_fetch_assoc($result_anggota)): ?>
                                                                    <option value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="tlokasi" value="<?php echo $data['lokasi'] ?>" placeholder="Masukkan lokasi pertemuan" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                                            <input type="date" class="form-control" id="exampleFormControlInput1" name="ttanggal"value="<?php echo $data['tanggal'] ?>" placeholder="Masukkan tanggal pertemuan" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Jam</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="tjam" value="<?php echo $data['jam'] ?>" placeholder="Masukkan Jam pertemuan" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary" name="btnedit">Ubah</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- AKhir Modal Edit-->

                                        <!-- Awal Modal Hapus -->
                                        <div class="modal fade" id="modalhapus<?php echo $data['id_pertemuan']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fas fa-trash-alt"></i>Konfirmasi Hapus Data Pertemuan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST" action="crudpertemuan.php">
                                                    <input type="hidden" name="id_pertemuan" value="<?php echo $data['id_pertemuan'] ?>">
                                                    <div class="modal-body">
                                                        <h5 class="text-center">Apakah anda yakin ingin menghapus data ini?<br>
                                                        <span class="text-danger"><?php echo $data['lokasi'] ?> </span>
                                                        </h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger" name="btnhapus">Hapus</button>
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- AKhir Modal Hapus-->

                                    <?php endwhile; ?>    
                                    </tbody>


                                </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-5">
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
