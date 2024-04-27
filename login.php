<?php
session_start();
if (isset($_SESSION['nama_admin'])){
    header("location:dashboard.php");
    exit();
}

include("koneksi.php");
$username = "";
$password = "";
$err = "";

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username == '' or $password == ''){
        $err .="Silahkan Masukkan Username dan Password Terlebih Dahulu!!</li>";
    }
    if(empty($err)){
        $sql1 = "SELECT * FROM admin WHERE nama_admin = '$username'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        if(!$r1 || $r1['password'] != md5($password)){
            $err .= "Nama atau Password yang anda masukkan salah";
        } else {
            // Simpan informasi level pengguna ke dalam sesi
            $_SESSION['nama_admin'] = $username;
            $_SESSION['level_admin'] = $r1['level_admin'];
            header("location:dashboard.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>

    <!-- Form Login -->
    <section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <?php
                            if($err) {
                                echo '<div class="alert alert-danger" role="alert">';
                                echo $err;
                                echo '</div>';
                            }
                            
                            ?>
							<form action="" method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="username">Nama</label>
									<input id="username" type="text" class="form-control" name="username" value="<?php echo $username?>" required autofocus>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
									</div>
									<input id="password" type="password" class="form-control input" name="password" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="align-items-center">
									<button type="submit" class="btn btn-primary ms-auto w-100" name="login" value="Masuk Ke Sistem">
										Login
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Tidak Punya Akun? <a href="register.html" class="text-dark">Buat Akun Anda</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2024 &mdash; Kelompok 1 Paralel F 
					</div>
				</div>
			</div>
		</div>
	</section>


<!-- js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>