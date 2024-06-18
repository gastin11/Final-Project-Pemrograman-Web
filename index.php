<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Website Sistem Informasi Arisan</title>
        
        <!-- css bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
        <link rel="icon" type="image/x-icon" href="./asset-login/logo-login.png">

        <link href="./asset-homepage/css/style.css" rel="stylesheet">

    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container px-5">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <img src="./assets-dashboard/img/logo.jpg" alt="Logo" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        SiArisan
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link text-white" href="index.php">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="#about">Tentang</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="#fitur">Fitur</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="#contact">Kontak</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="login.php">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Header-->
            <header class="bg-primary py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">SiArisan, Sistem Informasi Arisan Desa Wage</h1>
                                <p class="lead fw-normal text-white mb-4">Sistem informasi berbasis website arisan Desa Wage RT 03 RW 10, yang dirancang untuk membantu mengelola sistem arisan</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-light btn-lg px-4 me-sm-3 text-primary" href="login.php">Mulai</a>
                                    <!-- <a class="btn btn-outline-light btn-lg px-4" href="#!">Learn More</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="asset-homepage/img/img1.jpg" alt="..." /></div>
                    </div>
                </div>
            </header>
            
            <!-- about section-->
            <section id="about" class="py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="text-center">
                                <h2 class="fw-bolder text-primary"><i class="bi bi-info-circle me-2"></i>Tentang</h2>
                                <p class="lead fw-normal text-muted mb-5">Website SiArisan adalah platform digital yang dirancang untuk memudahkan pengelolaan dan partisipasi dalam kegiatan arisan, seperti mengelola anggota arisan, melihat jadwal arisan, mencatat keuangan, dan mencetak laporan. SiArisan memberikan solusi terbaik untuk transparansi dan kemudahan dalam pengelolaan arisan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Features section-->
            <section class="bg-light py-3 py-md-5 py-xl-8" id="fitur">
                <div class="container overflow-hidden">
                    <div class="row gy-4 gy-md-5 gy-lg-0 align-items-center">
                        <div class="col-12 col-lg-5">
                            <div class="row">
                                <div class="col-12 col-xl-11">
                                    <h2 class="fw-bolder text-primary"><i class="bi bi-stars me-2"></i>Fitur</h2>
                                    <h3 class="fs-6 text-secondary mb-3 mb-xl-4 text-uppercase">Apa Yang Kami Tawarkan?</h3>
                                    <h2 class="display-5 mb-3 mb-xl-4">Kami memberikan solusi terbaik untuk kebutuhan arisan Anda.</h2>
                                    <p class="mb-3 mb-xl-4">Layanan lengkap kami dirancang untuk memenuhi setiap kebutuhan Anda dan membantu Anda berkembang dalam dunia arisan yang dinamis. Hubungi kami hari ini untuk memulai perjalanan pertumbuhan, inovasi, dan dukungan yang tiada tanding. Kesuksesan Anda adalah prioritas kami.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 overflow-hidden">
                            <div class="row gy-4">
                                <div class="col-12 col-sm-6">
                                    <div class="card border-0 border-bottom border-primary shadow-sm">
                                        <div class="card-body text-center p-4 p-xxl-5">
                                            <i class="bi bi-calendar3 text-primary mb-4" style="font-size: 2rem;"></i>
                                            <h4 class="mb-4">Pengelolaan Jadwal</h4>
                                            <p class="mb-4 text-secondary">Kami membantu Anda mengatur dan mengelola jadwal arisan dengan mudah, memastikan setiap anggota dapat mengakses informasi terkini.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card border-0 border-bottom border-primary shadow-sm">
                                        <div class="card-body text-center p-4 p-xxl-5">
                                            <i class="bi bi-people text-primary mb-4" style="font-size: 2rem;"></i>
                                            <h4 class="mb-4">Manajemen Anggota</h4>
                                            <p class="mb-4 text-secondary">Kelola informasi anggota dengan efisien, termasuk data pribadi dan kontribusi arisan, semua dalam satu platform yang terintegrasi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card border-0 border-bottom border-primary shadow-sm">
                                        <div class="card-body text-center p-4 p-xxl-5">
                                            <i class="bi bi-cash-coin text-primary mb-4" style="font-size: 2rem;"></i>
                                            <h4 class="mb-4">Pencatatan Keuangan</h4>
                                            <p class="mb-4 text-secondary">Fitur pencatatan keuangan yang lengkap untuk memantau arus kas arisan, memastikan transparansi dan akuntabilitas.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="card border-0 border-bottom border-primary shadow-sm">
                                        <div class="card-body text-center p-4 p-xxl-5">
                                            <i class="bi bi-file-earmark-text text-primary mb-4" style="font-size: 2rem;"></i>
                                            <h4 class="mb-4">Dokumentasi Laporan</h4>
                                            <p class="mb-4 text-secondary">Fitur dokumentasi laporan memungkinkan Anda membuat dan menyimpan laporan arisan secara terperinci dan mudah diakses.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- contact session -->
            <section id="contact" class="py-5">
                <div class="container">
                    <div class="row justify-content-center text-center mb-3 mb-lg-5">
                        <div class="col-lg-8 col-xxl-7">
                            <h2 class="fw-bolder text-primary"><i class="bi bi-envelope me-2"></i>Kontak</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="#" onsubmit="kirimPesanWA()">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input class="form-control bg-light" placeholder="Masukkan Nama Anda" type="text" id="nama">
                                        </div>
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="mb-3">
                                            <input class="form-control bg-light" placeholder="Masukkan Email Anda" type="email">
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <textarea class="form-control bg-light" placeholder="Masukkan Pesan Anda" rows="8" id="pesan"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button class="btn btn-primary " type="submit">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-4 mt-md-0">
                                <a href="https://maps.app.goo.gl/2y4YeKCZ8VDsSbTY8" target="_blank">
                                    <img alt="Map" class="img-fluid" src="asset-homepage/img/map.png">
                                </a>
                            </div>
                            <div class="mt-3">
                                <p>Jalan Gadung RT 03 RW 10 Wage Taman Sidoarjo.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!--  -->
        </main>
        <!-- Footer-->
        <footer class="bg-primary py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-center flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; Kelompok 1 Paralel F 2024</div></div>
                    <!-- <div class="col-auto">
                        <a class="link-light small" href="#!">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Contact</a>
                    </div> -->
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="asset-homepage/js/kirimWA.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlHj1/8rQsDZ7qqT57dUVgRhz09xF4pGpH1xZPtA6kM6v9KKJv0WLYZllhK" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG0Z2yzr4h3LkE21Ad4t4LOCFnVD2BcpH+M9czM+UmFb8v+I5PBwZJp+0t" crossorigin="anonymous"></script>
    </body>
</html>
