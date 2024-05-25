<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["bukti"]["size"] > 500000) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Periksa jenis file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Periksa apakah uploadOk bernilai 0 karena kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak dapat diunggah.";
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
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }
    }
}
?>
