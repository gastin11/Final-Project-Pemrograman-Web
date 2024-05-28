<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_pertemuan'], $_POST['id_anggota'], $_POST['status_pembayaran']) && !empty($_FILES["bukti"]["name"])) {
        $id_pertemuan = $_POST['id_pertemuan'];
        $id_anggota = $_POST['id_anggota'];
        $status_pembayaran = $_POST['status_pembayaran'];

        // Fetch tanggal pertemuan
        $query_tanggal = "SELECT tanggal FROM tb_pertemuan WHERE id_pertemuan = '$id_pertemuan'";
        $result_tanggal = mysqli_query($koneksi, $query_tanggal);
        $row_tanggal = mysqli_fetch_assoc($result_tanggal);
        $tanggal = $row_tanggal['tanggal'];

        // Fetch nama anggota
        $query_nama = "SELECT nama FROM tb_anggota WHERE id_anggota = '$id_anggota'";
        $result_nama = mysqli_query($koneksi, $query_nama);
        $row_nama = mysqli_fetch_assoc($result_nama);
        $nama = $row_nama['nama'];

        // Proses upload bukti pembayaran
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["bukti"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Periksa apakah file adalah gambar asli atau bukan
        $check = getimagesize($_FILES["bukti"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Bukan file gambar";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["bukti"]["size"] > 500000) {
            echo "Ukuran file terlalu besar";
            $uploadOk = 0;
        }

        // Periksa jenis file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Format file harus JPG, JPEG, PNG & GIF";
            $uploadOk = 0;
        }

        // Periksa apakah uploadOk bernilai 0 karena kesalahan
        if ($uploadOk == 0) {
            echo "File tidak bisa diupload";
        // Jika semua periksa dilalui, coba unggah file
        } else {
            if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
                // Ambil id_pembayaran terakhir dan buat id_pembayaran baru
                $query_id = "SELECT MAX(id_pembayaran) AS maxKode FROM tb_pembayaran";
                $hasil_id = mysqli_query($koneksi, $query_id);
                $data_id = mysqli_fetch_array($hasil_id);

                $maxkode = $data_id['maxKode'];
                $nourut = 0;
                if ($maxkode) {
                    $nourut = (int) substr($maxkode, 3);
                }

                $nourut++;
                $char = 'BYR';
                $kodejadi = $char . sprintf("%03s", $nourut);

                // Simpan data ke database
                $query = "INSERT INTO tb_pembayaran (id_pembayaran, id_anggota, nama, id_pertemuan, tanggal, status_pembayaran, bukti) 
                          VALUES ('$kodejadi', '$id_anggota', '$nama', '$id_pertemuan', '$tanggal', '$status_pembayaran', '$target_file')";

                if (mysqli_query($koneksi, $query)) {
                    echo "<script>
                            alert('Pembayaran berhasil disimpan');
                            document.location.href = 'pembayaran.php';
                          </script>";
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                }
            } else {
                echo "Terjadi kesalahan saat upload";
            }
        }
    } 
    // else {
    //     echo "Data tidak lengkap atau file tidak diunggah.";
    // }
}

if(isset($_POST["btnedit"])){
    $id_pembayaran = $_POST['id_pembayaran'];
    $tanggal = $_POST['ttanggal'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $bukti_lama = $_POST['bukti_lama']; 
    $target_file = $bukti_lama; 

    if (!empty($_FILES["bukti"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["bukti"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["bukti"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Bukan file gambar";
            $uploadOk = 0;
        }

        if ($_FILES["bukti"]["size"] > 500000) {
            echo "Ukuran file terlalu besar";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Format file harus JPG, JPEG, PNG & GIF";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "File tidak bisa diupload";
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
                // Optionally, delete the old file if a new one is uploaded
                if ($bukti_lama && file_exists($bukti_lama)) {
                    unlink($bukti_lama);
                }
            } else {
                echo "Terjadi kesalahan saat upload";
            }
        }
    }

    $edit = mysqli_query($koneksi, "UPDATE tb_pembayaran SET tanggal = '$tanggal', status_pembayaran = '$status_pembayaran', bukti = '$target_file' WHERE id_pembayaran = '$id_pembayaran'");

    if($edit){
        echo "<script>
                alert('Data berhasil di edit');
                document.location='detailpembayaran.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal di edit');
                document.location='detailpembayaran.php';
            </script>";
    }
}


if (isset($_POST["btnhapus"])) {
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_pembayaran WHERE id_pembayaran = '$_POST[id_pembayaran]' ");

    if ($hapus) {
        echo "<script>
                alert('Data berhasil di hapus');
                document.location='detailpembayaran.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal di hapus');
                document.location='detailpembayaran.php';
              </script>";
    }
}
?>
